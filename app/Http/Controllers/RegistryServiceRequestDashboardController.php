<?php

namespace App\Http\Controllers;

use App\Models\RegistryServiceRequest;
use App\Models\RegistryService;
use App\Models\RequestStatus;
use App\Models\RequestAuditTrail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegistryServiceRequestDashboardController extends Controller
{
    /**
     * Listagem completa de solicitações
     */
    public function index(Request $request)
    {
        $query = RegistryServiceRequest::with(['service', 'requestStatus', 'assignedUser']);

        // Pesquisa por protocolo
        if ($request->filled('protocol')) {
            $query->where('protocol_number', 'like', '%' . $request->protocol . '%')
                  ->orWhere('full_name', 'like', '%' . $request->protocol . '%');
        }

        // Filtro por status
        if ($request->filled('status')) {
            $query->whereHas('requestStatus', fn($q) => $q->where('name', $request->status));
        }

        // Filtro por serviço
        if ($request->filled('service_id')) {
            $query->where('registry_service_id', $request->service_id);
        }

        // Filtro por período
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filtro por cliente
        if ($request->filled('client_search')) {
            $query->where('full_name', 'like', '%' . $request->client_search . '%')
                  ->orWhere('email', 'like', '%' . $request->client_search . '%')
                  ->orWhere('phone', 'like', '%' . $request->client_search . '%');
        }

        // Filtro por responsável
        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }

        // Ordenação
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $requests = $query->paginate(15);
        $services = RegistryService::where('is_active', true)->get();
        $statuses = RequestStatus::where('is_active', true)->orderBy('order')->get();
        $users = User::where('active', true)->get();

        return view('admin.blades.registryServiceRequest.index', compact('requests', 'services', 'statuses', 'users'));
    }

    /**
     * Visualizar detalhes da solicitação
     */
    public function show($id)
    {
        $request = RegistryServiceRequest::with(['service', 'requestStatus', 'assignedUser', 'auditTrails', 'auditTrails.user'])->findOrFail($id);
        
        $statuses = RequestStatus::where('is_active', true)->orderBy('order')->get();
        $users = User::where('active', true)->get();
        $history = $request->auditTrails()->ordered()->get();
        $internalNotes = $request->getInternalNotesFormatted();

        return view('admin.blades.registryServiceRequest.show', compact('request', 'statuses', 'users', 'history', 'internalNotes'));
    }

    /**
     * Atualizar status da solicitação
     */
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'request_status_id' => 'required|exists:request_statuses,id',
        ]);

        $registryRequest = RegistryServiceRequest::findOrFail($id);
        $oldStatus = $registryRequest->requestStatus;
        
        // Atualizar status
        $newStatus = RequestStatus::findOrFail($validated['request_status_id']);
        $registryRequest->update([
            'request_status_id' => $newStatus->id,
            'status' => $newStatus->name,
        ]);

        // Registrar no histórico
        RequestAuditTrail::logAction(
            $id,
            'status_changed',
            ['status_id' => $oldStatus?->id, 'status_name' => $oldStatus?->name],
            ['status_id' => $newStatus->id, 'status_name' => $newStatus->name],
            ['old_status' => $oldStatus?->label, 'new_status' => $newStatus->label]
        );

        return redirect()->route('admin.dashboard.registryServiceRequest.show', $id)
            ->with('success', 'Status atualizado com sucesso!');
    }

    /**
     * Adicionar observações internas
     */
    public function addInternalNote(Request $request, $id)
    {
        $validated = $request->validate([
            'note' => 'required|string|min:5|max:1000',
        ]);

        $registryRequest = RegistryServiceRequest::findOrFail($id);
        
        $notes = $registryRequest->internal_notes ?? [];
        if (!is_array($notes)) {
            $notes = [];
        }

        $newNote = [
            'timestamp' => now()->toIso8601String(),
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'text' => $validated['note'],
        ];

        $notes[] = $newNote;
        $registryRequest->update(['internal_notes' => $notes]);

        RequestAuditTrail::logAction(
            $id,
            'internal_note_added',
            null,
            $newNote,
            ['note' => $validated['note']]
        );

        return redirect()->route('admin.dashboard.registryServiceRequest.show', $id)
            ->with('success', 'Observação interna adicionada com sucesso!');
    }

    /**
     * Atribuir solicitação a um usuário
     */
    public function assignUser(Request $request, $id)
    {
        $validated = $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        $registryRequest = RegistryServiceRequest::findOrFail($id);
        $oldAssignee = $registryRequest->assignedUser;
        $newAssignee = User::findOrFail($validated['assigned_to']);

        $registryRequest->update($validated);

        RequestAuditTrail::logAction(
            $id,
            'assigned_to_user',
            ['user_id' => $oldAssignee?->id, 'user_name' => $oldAssignee?->name],
            ['user_id' => $newAssignee->id, 'user_name' => $newAssignee->name],
            ['old_assignee' => $oldAssignee?->name, 'new_assignee' => $newAssignee->name]
        );

        return response()->json([
            'success' => true,
            'message' => 'Solicitação atribuída com sucesso!',
            'assigned_to_name' => $newAssignee->name,
        ]);
    }

    /**
     * Solicitar documentos
     */
    public function requestDocuments(Request $request, $id)
    {
        $validated = $request->validate([
            'required_documents' => 'required|array|min:1',
            'required_documents.*' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:1000',
        ]);

        $registryRequest = RegistryServiceRequest::findOrFail($id);
        
        // Mudança para o novo status de "Aguardando Documentos"
        $awaitingStatus = RequestStatus::where('name', 'awaiting_documents')->first();
        if ($awaitingStatus) {
            $registryRequest->update([
                'request_status_id' => $awaitingStatus->id,
                'status' => $awaitingStatus->name,
            ]);
        }

        // Armazenar documentos solicitados
        $requestedDocuments = [
            'timestamp' => now()->toIso8601String(),
            'requested_by_id' => Auth::id(),
            'requested_by' => Auth::user()->name,
            'documents' => $validated['required_documents'],
            'message' => $validated['message'],
        ];

        $registryRequest->update(['document_requests' => $requestedDocuments]);

        RequestAuditTrail::logAction(
            $id,
            'documents_requested',
            null,
            $requestedDocuments,
            ['documents_count' => count($validated['required_documents'])]
        );

        // Enviar email ao cliente com os documentos solicitados
        try {
            $this->sendDocumentRequestEmail($registryRequest, $validated['required_documents'], $validated['message']);
        } catch (\Exception $e) {
            Log::error('Erro ao enviar email de solicitação de documentos', ['error' => $e->getMessage()]);
        }

        return redirect()->route('admin.dashboard.registryServiceRequest.show', $id)
            ->with('success', 'Solicitação de documentos enviada com sucesso!');
    }

    /**
     * Aprovar documentos
     */
    public function approveDocuments(Request $request, $id)
    {
        $validated = $request->validate([
            'approval_notes' => 'nullable|string|max:500',
        ]);

        $registryRequest = RegistryServiceRequest::findOrFail($id);
        
        // Mudança para o novo status de "Documentos Aprovados"
        $approvedStatus = RequestStatus::where('name', 'documents_approved')->first();
        if ($approvedStatus) {
            $registryRequest->update([
                'request_status_id' => $approvedStatus->id,
                'status' => $approvedStatus->name,
            ]);
        }

        $approvalData = [
            'timestamp' => now()->toIso8601String(),
            'approved_by_id' => Auth::id(),
            'approved_by' => Auth::user()->name,
            'notes' => $validated['approval_notes'] ?? null,
        ];

        $registryRequest->update(['document_approval' => $approvalData]);

        RequestAuditTrail::logAction(
            $id,
            'documents_approved',
            null,
            $approvalData,
            ['approval_notes' => $validated['approval_notes']]
        );

        return redirect()->route('admin.dashboard.registryServiceRequest.show', $id)
            ->with('success', 'Documentos aprovados com sucesso!');
    }

    /**
     * Encerrar solicitação
     */
    public function closeRequest(Request $request, $id)
    {
        $validated = $request->validate([
            'closing_notes' => 'required|string|min:10|max:1000',
            'result' => 'required|in:completed,rejected',
        ]);

        $registryRequest = RegistryServiceRequest::findOrFail($id);
        
        // Definir o status final baseado no resultado
        $finalStatus = RequestStatus::where('name', $validated['result'])->first();
        if ($finalStatus) {
            $registryRequest->update([
                'request_status_id' => $finalStatus->id,
                'status' => $finalStatus->name,
            ]);
        }

        $closingData = [
            'timestamp' => now()->toIso8601String(),
            'closed_by_id' => Auth::id(),
            'closed_by' => Auth::user()->name,
            'result' => $validated['result'],
            'notes' => $validated['closing_notes'],
        ];

        $registryRequest->update(['closing_data' => $closingData]);

        RequestAuditTrail::logAction(
            $id,
            'request_closed',
            null,
            $closingData,
            ['result' => $validated['result']]
        );

        return redirect()->route('admin.dashboard.registryServiceRequest.show', $id)
            ->with('success', 'Solicitação encerrada com sucesso!');
    }

    /**
     * Confirmar pagamento
     */
    public function confirmPayment(Request $request, $id)
    {
        $registryRequest = RegistryServiceRequest::findOrFail($id);

        // Mudança para o novo status de "Pagamento Aprovado" após confirmação de pagamento
        $paymentApprovedStatus = RequestStatus::where('name', 'payment_approved')->first();
        if ($paymentApprovedStatus) {
            $registryRequest->update([
                'request_status_id' => $paymentApprovedStatus->id,
                'status' => $paymentApprovedStatus->name,
            ]);
        }

        // Registrar que pagamento foi confirmado
        $paymentData = [
            'timestamp' => now()->toIso8601String(),
            'confirmed_by_id' => Auth::id(),
            'confirmed_by' => Auth::user()->name,
        ];

        RequestAuditTrail::logAction(
            $id,
            'payment_confirmed',
            null,
            $paymentData,
            ['confirmed_by' => Auth::user()->name]
        );

        return redirect()->route('admin.dashboard.registryServiceRequest.show', $id)
            ->with('success', 'Pagamento confirmado! Status alterado para "Pagamento Aprovado".');
    }

    /**
     * Reabrir solicitação (se foi fechada)
     */
    public function reopenRequest(Request $request, $id)
    {
        $registryRequest = RegistryServiceRequest::findOrFail($id);
        
        // Voltar para status "Em Progresso"
        $inProgressStatus = RequestStatus::where('name', 'in_progress')->first();
        if ($inProgressStatus) {
            $registryRequest->update([
                'request_status_id' => $inProgressStatus->id,
                'status' => $inProgressStatus->name,
            ]);
        }

        $registryRequest->update(['closing_data' => null]);

        RequestAuditTrail::logAction(
            $id,
            'request_reopened',
            null,
            ['status' => $inProgressStatus->name],
            ['reopened_by' => Auth::user()->name]
        );

        return redirect()->route('admin.dashboard.registryServiceRequest.show', $id)
            ->with('success', 'Solicitação reabierta com sucesso!');
    }

    /**
     * Enviar email solicitando documentos
     */
    private function sendDocumentRequestEmail($registryRequest, $documents, $message)
    {
        try {
            // TODO: Implementar envio de email usando Mailable
            // Mail::to($registryRequest->email)->send(new DocumentRequestMailable($registryRequest, $documents, $message));
            
            Log::info('Email de solicitação de documentos deveria ser enviado para ' . $registryRequest->email);
        } catch (\Exception $e) {
            Log::error('Erro ao enviar email de solicitação de documentos', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Exportar solicitações (CSV)
     */
    public function export(Request $request)
    {
        $query = RegistryServiceRequest::with(['service', 'requestStatus']);

        // Aplicar mesmos filtros do index
        if ($request->filled('status')) {
            $query->whereHas('requestStatus', fn($q) => $q->where('name', $request->status));
        }

        if ($request->filled('service_id')) {
            $query->where('registry_service_id', $request->service_id);
        }

        $requests = $query->get();

        $filename = 'solicitacoes_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($requests) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // BOM para UTF-8
            
            // Cabeçalhos
            fputcsv($file, [
                'Protocolo',
                'Cliente',
                'Email',
                'Telefone',
                'Serviço',
                'Status',
                'Data Solicitação',
                'Atribuído a',
            ], ';');

            // Dados
            foreach ($requests as $req) {
                fputcsv($file, [
                    $req->protocol_number,
                    $req->full_name,
                    $req->email,
                    $req->phone,
                    $req->service?->name,
                    $req->requestStatus?->label,
                    $req->created_at->format('d/m/Y H:i'),
                    $req->assignedUser?->name ?? 'Não atribuído',
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Ações em lote
     */
    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:registry_service_requests,id',
            'action' => 'required|in:change_status,assign_user,delete',
            'status_id' => 'required_if:action,change_status|exists:request_statuses,id',
            'user_id' => 'required_if:action,assign_user|exists:users,id',
        ]);

        $ids = $validated['ids'];
        
        switch ($validated['action']) {
            case 'change_status':
                $status = RequestStatus::findOrFail($validated['status_id']);
                RegistryServiceRequest::whereIn('id', $ids)->update([
                    'request_status_id' => $status->id,
                    'status' => $status->name,
                ]);
                $message = "Status de {$request->count()} solicitações atualizado para {$status->label}!";
                break;

            case 'assign_user':
                $user = User::findOrFail($validated['user_id']);
                RegistryServiceRequest::whereIn('id', $ids)->update([
                    'assigned_to' => $user->id,
                ]);
                $message = "Solicitações atribuídas a {$user->name}!";
                break;

            case 'delete':
                RegistryServiceRequest::whereIn('id', $ids)->delete();
                $message = count($ids) . " solicitação(ões) deletada(s)!";
                break;

            default:
                $message = 'Ação realizada!';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }
}

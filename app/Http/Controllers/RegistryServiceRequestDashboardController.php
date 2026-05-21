<?php

namespace App\Http\Controllers;

use App\Models\RegistryServiceRequest;
use App\Models\RegistryService;
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
        $query = RegistryServiceRequest::with('service');

        // Pesquisa por protocolo
        if ($request->filled('protocol')) {
            $query->where('id', 'like', '%' . $request->protocol . '%')
                  ->orWhere('full_name', 'like', '%' . $request->protocol . '%');
        }

        // Filtro por status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
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

        // Ordenação
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $requests = $query->paginate(15);
        $services = RegistryService::where('is_active', true)->get();
        $statuses = [
            'pending' => 'Pendente',
            'in_progress' => 'Em Progresso',
            'awaiting_documents' => 'Aguardando Documentos',
            'documents_approved' => 'Documentos Aprovados',
            'completed' => 'Concluído',
            'rejected' => 'Rejeitado',
        ];

        return view('admin.blades.registryServiceRequest.index', compact('requests', 'services', 'statuses'));
    }

    /**
     * Visualizar detalhes da solicitação
     */
    public function show($id)
    {
        $request = RegistryServiceRequest::with('service')->findOrFail($id);
        
        $statuses = [
            'pending' => 'Pendente',
            'in_progress' => 'Em Progresso',
            'awaiting_documents' => 'Aguardando Documentos',
            'documents_approved' => 'Documentos Aprovados',
            'completed' => 'Concluído',
            'rejected' => 'Rejeitado',
        ];

        $history = $this->getRequestHistory($id);

        return view('admin.blades.registryServiceRequest.show', compact('request', 'statuses', 'history'));
    }

    /**
     * Atualizar status da solicitação
     */
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,awaiting_documents,documents_approved,completed,rejected',
        ]);

        $registryRequest = RegistryServiceRequest::findOrFail($id);
        $oldStatus = $registryRequest->status;
        $registryRequest->update($validated);

        // Registrar no histórico
        $this->logHistory($id, 'status_change', [
            'from' => $oldStatus,
            'to' => $validated['status'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status atualizado com sucesso!',
        ]);
    }

    /**
     * Adicionar observações
     */
    public function addObservation(Request $request, $id)
    {
        $validated = $request->validate([
            'observation' => 'required|string|min:5',
        ]);

        $registryRequest = RegistryServiceRequest::findOrFail($id);
        
        $observations = $registryRequest->admin_notes ?? [];
        if (is_string($observations)) {
            $observations = json_decode($observations, true) ?? [];
        }

        if (!is_array($observations)) {
            $observations = [];
        }

        $observations[] = [
            'timestamp' => now()->toIso8601String(),
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'text' => $validated['observation'],
        ];

        $registryRequest->admin_notes = json_encode($observations);
        $registryRequest->save();

        $this->logHistory($id, 'observation_added', [
            'observation' => $validated['observation'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Observação adicionada com sucesso!',
            'observation' => $observations[count($observations) - 1],
        ]);
    }

    /**
     * Solicitar documentos
     */
    public function requestDocuments(Request $request, $id)
    {
        $validated = $request->validate([
            'required_documents' => 'required|array',
            'required_documents.*' => 'required|string',
            'message' => 'required|string|min:10',
        ]);

        $registryRequest = RegistryServiceRequest::findOrFail($id);
        $registryRequest->status = 'awaiting_documents';

        // Armazenar documentos solicitados
        $requestedDocuments = [
            'timestamp' => now()->toIso8601String(),
            'requested_by' => Auth::user()->name,
            'documents' => $validated['required_documents'],
            'message' => $validated['message'],
        ];

        $registryRequest->document_requests = json_encode($requestedDocuments);
        $registryRequest->save();

        $this->logHistory($id, 'documents_requested', $requestedDocuments);

        // TODO: Enviar email ao cliente com os documentos solicitados
        $this->sendDocumentRequestEmail($registryRequest, $validated['required_documents'], $validated['message']);

        return response()->json([
            'success' => true,
            'message' => 'Solicitação de documentos enviada com sucesso!',
        ]);
    }

    /**
     * Aprovar documentos
     */
    public function approveDocuments(Request $request, $id)
    {
        $validated = $request->validate([
            'approval_notes' => 'nullable|string',
        ]);

        $registryRequest = RegistryServiceRequest::findOrFail($id);
        $registryRequest->status = 'documents_approved';

        $approvalData = [
            'timestamp' => now()->toIso8601String(),
            'approved_by' => Auth::user()->name,
            'notes' => $validated['approval_notes'] ?? null,
        ];

        $registryRequest->document_approval = json_encode($approvalData);
        $registryRequest->save();

        $this->logHistory($id, 'documents_approved', $approvalData);

        return response()->json([
            'success' => true,
            'message' => 'Documentos aprovados com sucesso!',
        ]);
    }

    /**
     * Encerrar solicitação
     */
    public function closeRequest(Request $request, $id)
    {
        $validated = $request->validate([
            'closing_notes' => 'required|string|min:10',
            'result' => 'required|in:approved,rejected',
        ]);

        $registryRequest = RegistryServiceRequest::findOrFail($id);
        $finalStatus = $validated['result'] === 'approved' ? 'completed' : 'rejected';
        $registryRequest->status = $finalStatus;

        $closingData = [
            'timestamp' => now()->toIso8601String(),
            'closed_by' => Auth::user()->name,
            'result' => $validated['result'],
            'notes' => $validated['closing_notes'],
        ];

        $registryRequest->closing_data = json_encode($closingData);
        $registryRequest->save();

        $this->logHistory($id, 'request_closed', $closingData);

        return response()->json([
            'success' => true,
            'message' => 'Solicitação encerrada com sucesso!',
        ]);
    }

    /**
     * Obter histórico da solicitação
     */
    private function getRequestHistory($id)
    {
        $history = [];

        // TODO: Implementar log de histórico em tabela separada
        // Por enquanto, retornar array vazio
        
        return $history;
    }

    /**
     * Registrar ação no histórico
     */
    private function logHistory($requestId, $action, $details)
    {
        try {
            Log::channel('registry-requests')->info("Action: {$action}", [
                'request_id' => $requestId,
                'user_id' => Auth::id(),
                'details' => $details,
            ]);
        } catch (\Exception $e) {
            Log::error('Error logging registry request history', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Enviar email solicitando documentos
     */
    private function sendDocumentRequestEmail($registryRequest, $documents, $message)
    {
        try {
            // TODO: Implementar envio de email
            // Mail::to($registryRequest->email)->send(new DocumentsRequestedMail($registryRequest, $documents, $message));
        } catch (\Exception $e) {
            Log::error('Error sending document request email', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Exportar solicitações (CSV/Excel)
     */
    public function export(Request $request)
    {
        // TODO: Implementar exportação
    }

    /**
     * Reabrir solicitação (se foi fechada)
     */
    public function reopenRequest(Request $request, $id)
    {
        $registryRequest = RegistryServiceRequest::findOrFail($id);
        $registryRequest->status = 'in_progress';
        $registryRequest->closing_data = null;
        $registryRequest->save();

        $this->logHistory($id, 'request_reopened', [
            'reopened_by' => Auth::user()->name,
            'timestamp' => now()->toIso8601String(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Solicitação reabierta com sucesso!',
        ]);
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer',
            'action' => 'required|in:change_status,delete',
            'status' => 'required_if:action,change_status|in:pending,in_progress,awaiting_documents,documents_approved,completed,rejected',
        ]);

        $ids = $validated['ids'];
        $action = $validated['action'];

        if ($action === 'change_status') {
            RegistryServiceRequest::whereIn('id', $ids)->update(['status' => $validated['status']]);
        } elseif ($action === 'delete') {
            RegistryServiceRequest::whereIn('id', $ids)->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Ação em lote realizada com sucesso!',
        ]);
    }
}

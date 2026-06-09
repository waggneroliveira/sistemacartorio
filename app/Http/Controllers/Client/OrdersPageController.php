<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\RegistryServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersPageController extends Controller
{
    /**
     * Exibir página de pedidos/solicitações do cliente
     */
    public function index(Request $request)
    {
        // TEMPORÁRIO: Retorna todos os pedidos para teste
        // Depois você substitui pelo usuário logado: auth()->user()->email
        $clientEmail = $request->query('email') ?? session('client_email') ?? null;
        
        // SE NÃO TIVER EMAIL, BUSCA TODOS OS PEDIDOS (para teste)
        // OU você pode definir um email fixo para teste
        if (!$clientEmail) {
            // Opção 1: Retornar todos os pedidos (para desenvolvimento)
            $dbRequests = RegistryServiceRequest::with('service')
            ->where('client_id', '=', Auth::guard('client')->user()->id)
            ->orderBy('created_at', 'desc')->get();
            
            // Opção 2: Usar um email fixo para teste (descomente a linha abaixo e comente a de cima)
            // $dbRequests = RegistryServiceRequest::where('email', 'teste@teste.com')->with('service')->orderBy('created_at', 'desc')->get();
        } else {
            $dbRequests = RegistryServiceRequest::where('email', $clientEmail)
                ->with('service')
                ->where('client_id', '=', Auth::guard('client')->user()->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $requests = [];
        $stats = [
            'total' => 0,
            'emAndamento' => 0,
            'concluidos' => 0,
            'aguardandoPagamento' => 0,
        ];

        if ($dbRequests && $dbRequests->count() > 0) {
            $requests = $dbRequests->map(function ($request) {
                // Log para debug
                \Log::info('Processando request ID: ' . $request->id . ', Status: ' . $request->status);
                // dd($request);
                return [
                    'id' => $request->id,
                    'protocolo' => $request->protocol_number,
                    'servico' => $request->service?->name ?? 'Serviço indisponível',
                    'dataSolicitacao' => $request->created_at->format('d/m/Y'),
                    'status' => $request->status, // Passar status bruto do BD
                    'statusTexto' => $this->getStatusLabel($request->status),
                    'valor' => $this->getValorServico($request->service),
                    'descricao' => $request->service?->name ?? 'Sem descrição',
                    'documentos' => $this->getUploadedFiles($request),
                    'documentosSolicitados' => $this->getRequestedDocuments($request),
                    'pagamento' => [
                        'status' => $request->payment_status ?? 'pendente',
                        'data' => $request->payment_date ?? null,
                        'metodo' => $request->payment_method ?? null,
                    ],
                    'historico' => $this->buildHistorico($request),
                    'camposAdicionais' => $this->getDynamicFields($request),
                    'clienteNome' => $request->full_name ?? 'Cliente',
                    'clienteEmail' => $request->email ?? 'email@exemplo.com',
                    'clienteTelefone' => $request->phone ?? '(00) 00000-0000',
                    'internalNotes' => $this->getInternalNotes($request),
                ];
            });

            // Calcular estatísticas
            $stats['total'] = $requests->count();
            $stats['emAndamento'] = $requests->filter(fn($r) => in_array($r['status'], ['in_progress', 'awaiting_documents', 'documents_approved']))->count();
            $stats['concluidos'] = $requests->filter(fn($r) => $r['status'] === 'completed')->count();
            $stats['aguardandoPagamento'] = $requests->filter(fn($r) => $r['status'] === 'pending' || $r['status'] === 'awaiting_payment')->count();
        }

        // Log para debug
        \Log::info('Total de requests encontrados: ' . count($requests));
        \Log::info('Stats: ', $stats);
// dd($requests, $stats);
        return view('client.blades.orders', [
            'requests' => $requests,
            'stats' => $stats,
            'clientEmail' => $clientEmail, // Mantido para compatibilidade
        ]);
    }

    /**
     * Mapear status do BD para o frontend
     */
    private function mapStatus($status)
    {
        $map = [
            'pending' => 'pendente',
            'in_progress' => 'andamento',
            'awaiting_documents' => 'analise',
            'documents_approved' => 'andamento',
            'awaiting_payment' => 'aguardando_pagamento',
            'completed' => 'concluido',
            'rejected' => 'cancelado',
        ];

        return $map[$status] ?? 'pendente';
    }

    /**
     * Obter label do status
     */
    private function getStatusLabel($status)
    {
        $labels = [
            'pending' => 'Pendente',
            'in_progress' => 'Em andamento',
            'awaiting_documents' => 'Em análise',
            'documents_approved' => 'Em andamento',
            'awaiting_payment' => 'Aguardando Pagamento',
            'completed' => 'Concluído',
            'rejected' => 'Cancelado',
        ];

        return $labels[$status] ?? 'Desconhecido';
    }

    /**
     * Obter valor do serviço
     */
    private function getValorServico($service)
    {
        if (!$service) {
            return 0;
        }

        return $service->service_value ?? 0;
    }

    /**
     * Obter arquivos enviados
     */
    private function getUploadedFiles($request)
    {
        if (isset($request->uploaded_files) && $request->uploaded_files) {
            if (is_string($request->uploaded_files)) {
                $files = json_decode($request->uploaded_files, true);
                return is_array($files) ? $files : [];
            }
            return is_array($request->uploaded_files) ? $request->uploaded_files : [];
        }
        return [];
    }

    /**
     * Obter campos dinâmicos
     */
    private function getDynamicFields($request)
    {
        if (isset($request->dynamic_fields_data) && $request->dynamic_fields_data) {
            if (is_string($request->dynamic_fields_data)) {
                $fields = json_decode($request->dynamic_fields_data, true);
                return is_array($fields) ? $fields : [];
            }
            return is_array($request->dynamic_fields_data) ? $request->dynamic_fields_data : [];
        }
        return [];
    }

    /**
     * Obter documentos solicitados pelo admin (document_requests)
     */
    private function getRequestedDocuments($request)
    {
        if (!isset($request->document_requests) || !$request->document_requests) {
            return null;
        }

        $docRequest = is_string($request->document_requests)
            ? json_decode($request->document_requests, true)
            : $request->document_requests;

        return is_array($docRequest) ? $docRequest : null;
    }

    /**
     * Construir histórico da solicitação
     */
    private function buildHistorico($request)
    {
        $historico = [];

        // Evento de criação - sempre o primeiro
        $historico[] = [
            'data' => $request->created_at->format('d/m/Y H:i'),
            'status' => 'Solicitação recebida',
            'descricao' => 'Pedido criado com sucesso',
        ];

        // Se tem pagamento
        if ($request->payment_status === 'paid' || ($request->payment_date ?? false)) {
            $historico[] = [
                'data' => $request->payment_date ? date('d/m/Y H:i', strtotime($request->payment_date)) : $request->updated_at->format('d/m/Y H:i'),
                'status' => 'Pagamento confirmado',
                'descricao' => 'Pagamento confirmado para processamento do pedido',
            ];
        }

        // Se tem solicitação de documentos
        if ($request->document_requests) {
            $docRequest = is_string($request->document_requests)
                ? json_decode($request->document_requests, true)
                : $request->document_requests;

            if (is_array($docRequest)) {
                $historico[] = [
                    'data' => isset($docRequest['timestamp']) ? date('d/m/Y H:i', strtotime($docRequest['timestamp'])) : $request->updated_at->format('d/m/Y H:i'),
                    'status' => 'Documentos solicitados',
                    'descricao' => 'Documentos adicionais foram solicitados',
                ];
            }
        }

        // Se tem envio de documentos
        if ($request->uploaded_files) {
            $files = $this->getUploadedFiles($request);
            if (!empty($files)) {
                $historico[] = [
                    'data' => $request->updated_at->format('d/m/Y H:i'),
                    'status' => 'Documentos enviados',
                    'descricao' => count($files) . ' documento(s) enviado(s) pelo cliente',
                ];
            }
        }

        // Se tem aprovação de documentos
        if ($request->document_approval) {
            $approval = is_string($request->document_approval)
                ? json_decode($request->document_approval, true)
                : $request->document_approval;

            if (is_array($approval)) {
                $historico[] = [
                    'data' => isset($approval['timestamp']) ? date('d/m/Y H:i', strtotime($approval['timestamp'])) : $request->updated_at->format('d/m/Y H:i'),
                    'status' => 'Documentos aprovados',
                    'descricao' => 'Documentos verificados e aprovados',
                ];
            }
        }

        // Adiciona evento quando entrar em análise
        if ($request->status === 'awaiting_documents' || $request->status === 'in_progress') {
            $historico[] = [
                'data' => $request->updated_at->format('d/m/Y H:i'),
                'status' => 'Em análise',
                'descricao' => 'Seu pedido entrou em análise pelo cartório',
            ];
        }

        // Adiciona evento quando está em andamento
        if ($request->status === 'in_progress' && $request->status !== 'awaiting_documents') {
            $historico[] = [
                'data' => $request->updated_at->format('d/m/Y H:i'),
                'status' => 'Em andamento',
                'descricao' => 'Seu pedido está sendo processado',
            ];
        }

        // Se tem observações do admin
        if ($request->admin_notes) {
            $notes = is_string($request->admin_notes) 
                ? json_decode($request->admin_notes, true) 
                : $request->admin_notes;

            if (is_array($notes)) {
                foreach ($notes as $note) {
                    $historico[] = [
                        'data' => isset($note['timestamp']) ? date('d/m/Y H:i', strtotime($note['timestamp'])) : $request->updated_at->format('d/m/Y H:i'),
                        'status' => 'Atualização',
                        'descricao' => $note['text'] ?? (is_string($note) ? $note : 'Atualização no pedido'),
                    ];
                }
            }
        }

        // Se tem dados de encerramento (concluído)
        if ($request->status === 'completed' || $request->closing_data) {
            $historico[] = [
                'data' => $request->updated_at->format('d/m/Y H:i'),
                'status' => 'Concluído',
                'descricao' => 'Processo finalizado com sucesso',
            ];
        }

        // Ordenar o histórico por data (crescente)
        usort($historico, function($a, $b) {
            $dateA = \DateTime::createFromFormat('d/m/Y H:i', $a['data']);
            $dateB = \DateTime::createFromFormat('d/m/Y H:i', $b['data']);
            
            if (!$dateA) $dateA = new \DateTime($a['data']);
            if (!$dateB) $dateB = new \DateTime($b['data']);
            
            return $dateA <=> $dateB;
        });

        return $historico;
    }

    /**
     * Obter notas internas (observações do cartório)
     */
    private function getInternalNotes($request)
    {
        if (!isset($request->internal_notes) || !$request->internal_notes) {
            return [];
        }

        $notes = is_string($request->internal_notes)
            ? json_decode($request->internal_notes, true)
            : $request->internal_notes;

        return is_array($notes) ? $notes : [];
    }
}
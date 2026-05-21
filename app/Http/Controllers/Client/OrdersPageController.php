<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\RegistryServiceRequest;
use Illuminate\Http\Request;

class OrdersPageController extends Controller
{
    /**
     * Exibir página de pedidos/solicitações do cliente
     */
    public function index(Request $request)
    {
        // Obter email do cliente (por sessão, query param ou cookie)
        $clientEmail = $request->query('email') ?? session('client_email') ?? null;

        $requests = [];
        $stats = [
            'total' => 0,
            'emAndamento' => 0,
            'concluidos' => 0,
            'aguardandoPagamento' => 0,
        ];

        // Se temos um email, buscar solicitações
        if ($clientEmail) {
            $requests = RegistryServiceRequest::where('email', $clientEmail)
                ->with('service')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($request) {
                    return [
                        'id' => $request->id,
                        'protocolo' => 'CART-' . str_pad($request->id, 5, '0', STR_PAD_LEFT),
                        'servico' => $request->service?->name ?? 'Serviço indisponível',
                        'dataSolicitacao' => $request->created_at->format('Y-m-d'),
                        'status' => $this->mapStatus($request->status),
                        'statusTexto' => $this->getStatusLabel($request->status),
                        'valor' => $this->getValorServico($request->service),
                        'descricao' => $request->service?->description ?? 'Sem descrição',
                        'documentos' => $request->uploaded_files ?? [],
                        'pagamento' => [
                            'status' => 'pendente',
                            'data' => null,
                            'metodo' => null,
                        ],
                        'historico' => $this->buildHistorico($request),
                        'camposAdicionais' => $request->dynamic_fields_data ?? [],
                        'clienteNome' => $request->full_name,
                        'clienteEmail' => $request->email,
                        'clienteTelefone' => $request->phone,
                    ];
                });

            // Calcular estatísticas
            $stats['total'] = $requests->count();
            $stats['emAndamento'] = $requests->filter(fn($r) => in_array($r['status'], ['analise', 'andamento']))->count();
            $stats['concluidos'] = $requests->filter(fn($r) => $r['status'] === 'concluido')->count();
            $stats['aguardandoPagamento'] = $requests->filter(fn($r) => $r['status'] === 'aguardando_pagamento')->count();
        }

        return view('client.blades.orders', [
            'requests' => $requests,
            'stats' => $stats,
            'clientEmail' => $clientEmail,
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
            'completed' => 'Concluído',
            'rejected' => 'Cancelado',
        ];

        return $labels[$status] ?? 'Desconhecido';
    }

    /**
     * Obter valor do serviço (placeholder)
     */
    private function getValorServico($service)
    {
        // TODO: Implementar tabela de valores dos serviços
        // Por enquanto, retornar um valor padrão baseado no tipo de serviço
        
        if (!$service) {
            return 89.90;
        }

        $precos = [
            'Certidão' => 89.90,
            'Escritura' => 450.00,
            'Reconhecimento' => 35.90,
            'Casamento' => 89.90,
            'Inventário' => 580.00,
            'Autenticação' => 25.90,
        ];

        foreach ($precos as $palavra => $preco) {
            if (stripos($service->name, $palavra) !== false) {
                return $preco;
            }
        }

        return 150.00; // Valor padrão
    }

    /**
     * Construir histórico da solicitação
     */
    private function buildHistorico($request)
    {
        $historico = [];

        // Evento de criação
        $historico[] = [
            'data' => $request->created_at->format('Y-m-d H:i'),
            'status' => 'Solicitação recebida',
            'descricao' => 'Pedido criado com sucesso',
        ];

        // Se tem observações (admin_notes), adicionar
        if ($request->admin_notes) {
            $notes = is_string($request->admin_notes) 
                ? json_decode($request->admin_notes, true) 
                : $request->admin_notes;

                if (is_array($notes)) {
                    foreach ($notes as $note) {
                        $historico[] = [
                            'data' => \Carbon\Carbon::parse($note['timestamp'] ?? now())->format('Y-m-d H:i'),
                            'status' => 'Observação adicionada',
                            'descricao' => $note['text'] ?? $note,
                        ];
                    }
                }
        }

        // Se tem solicitação de documentos
        if ($request->document_requests) {
            $docRequest = is_string($request->document_requests)
                ? json_decode($request->document_requests, true)
                : $request->document_requests;

            if (is_array($docRequest)) {
                $historico[] = [
                    'data' => \Carbon\Carbon::parse($docRequest['timestamp'] ?? now())->format('Y-m-d H:i'),
                    'status' => 'Documentos solicitados',
                    'descricao' => 'Documentos foram solicitados ao cliente',
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
                    'data' => \Carbon\Carbon::parse($approval['timestamp'] ?? now())->format('Y-m-d H:i'),
                    'status' => 'Documentos aprovados',
                    'descricao' => 'Seus documentos foram aprovados',
                ];
            }
        }

        // Se tem dados de encerramento
        if ($request->closing_data) {
            $closing = is_string($request->closing_data)
                ? json_decode($request->closing_data, true)
                : $request->closing_data;

            if (is_array($closing)) {
                $resultado = $closing['result'] === 'approved' ? 'Aprovado' : 'Rejeitado';
                $historico[] = [
                    'data' => \Carbon\Carbon::parse($closing['timestamp'] ?? now())->format('Y-m-d H:i'),
                    'status' => "Processo {$resultado}",
                    'descricao' => $closing['notes'] ?? 'Processo finalizado',
                ];
            }
        }

        // Evento de atualização (se diferente da criação)
        if ($request->updated_at != $request->created_at) {
            // Já temos atualizações no histórico acima
        }

        return $historico;
    }
}

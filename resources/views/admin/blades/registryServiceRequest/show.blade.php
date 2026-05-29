@extends('admin.core.admin')
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- Flash Messages -->
                @if($message = session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($message = session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard.registryServiceRequest.index') }}">Solicitações</a>
                                    </li>
                                    <li class="breadcrumb-item active">Protocolo #{{ $request->id }}</li>
                                </ol>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="page-title">Detalhes da Solicitação</h4>
                                <a href="{{ route('admin.dashboard.registryServiceRequest.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left"></i> Voltar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <!-- INFORMAÇÕES PRINCIPAIS -->
                    <div class="col-lg-8">
                        <!-- Card Principal -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-info-circle"></i> Informações da Solicitação
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted">Protocolo</label>
                                        <p class="fw-bold">
                                            <span class="badge bg-primary">{{ $request->protocol_number }}</span>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted">Data de Criação</label>
                                        <p class="fw-bold">{{ $request->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>

                                <hr>

                                <!-- Cliente -->
                                <h6 class="mt-4 mb-3">
                                    <i class="bi bi-person-circle"></i> Dados do Cliente
                                </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted">Nome</label>
                                        <p class="fw-bold">{{ $request->full_name }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted">Email</label>
                                        <p class="fw-bold">
                                            <a href="mailto:{{ $request->email }}">{{ $request->email }}</a>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted">Telefone</label>
                                        <p class="fw-bold">{{ $request->phone }}</p>
                                    </div>
                                </div>

                                <hr>

                                <!-- Serviço -->
                                <h6 class="mt-4 mb-3">
                                    <i class="bi bi-briefcase"></i> Serviço Solicitado
                                </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted">Serviço</label>
                                        <p class="fw-bold">{{ $request->service?->name ?? 'N/A' }}</p>
                                    </div>
                                </div>

                                @if ($request->service?->description)
                                    <div class="alert alert-light" role="alert">
                                        {{ $request->service->description }}
                                    </div>
                                @endif

                                <!-- Campos Dinâmicos -->
                                @if ($request->dynamic_fields_data && count($request->dynamic_fields_data) > 0)
                                    <hr>
                                    <h6 class="mt-4 mb-3">
                                        <i class="bi bi-list-check"></i> Informações Adicionais
                                    </h6>
                                    <div class="row">
                                        @foreach ($request->dynamic_fields_data as $key => $value)
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label text-muted">{{ ucfirst(str_replace('_', ' ', $key)) }}</label>
                                                <p class="fw-bold">{{ $value }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- DOCUMENTOS ENVIADOS -->
                        @if ($request->uploaded_files && count($request->uploaded_files) > 0)
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="bi bi-file-earmark"></i> Documentos Enviados
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        @foreach ($request->uploaded_files as $file)
                                            <a href="{{ asset('storage/' . $file['stored_name']) }}" 
                                                class="list-group-item list-group-item-action" 
                                                target="_blank">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <i class="bi bi-file-pdf"></i>
                                                        <strong>{{ $file['original_name'] }}</strong>
                                                        <br>
                                                        <small class="text-muted">
                                                            {{ round($file['size'] / 1024, 2) }} KB
                                                        </small>
                                                    </div>
                                                    <i class="bi bi-download"></i>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- OBSERVAÇÕES -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-chat-dots"></i> Observações Internas
                                </h5>
                            </div>
                            <div class="card-body">
                                <div id="observationsList">
                                    @php
                                        $notes = is_string($request->admin_notes) 
                                            ? json_decode($request->admin_notes, true) 
                                            : ($request->admin_notes ?? []);
                                    @endphp

                                    @forelse($notes as $note)
                                        <div class="alert alert-info" role="alert">
                                            <div class="d-flex justify-content-between">
                                                <strong>{{ $note['user_name'] ?? 'Admin' }}</strong>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($note['timestamp'])->format('d/m/Y H:i') }}
                                                </small>
                                            </div>
                                            <p class="mb-0 mt-2">{{ $note['text'] }}</p>
                                        </div>
                                    @empty
                                        <p class="text-muted">Nenhuma observação ainda.</p>
                                    @endforelse
                                </div>

                                <!-- Formulário para adicionar observação -->
                                <form method="POST" action="{{ route('admin.dashboard.registryServiceRequest.addInternalNote', $request->id) }}" class="mt-3">
                                    @csrf
                                    <div class="mb-3">
                                        <textarea name="note" class="form-control" 
                                            rows="3" placeholder="Adicionar observação..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus"></i> Adicionar Observação
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- HISTÓRICO -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-clock-history"></i> Histórico da Demanda
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="timeline">
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-primary"></div>
                                        <div class="timeline-content">
                                            <h6 class="mb-1">Solicitação Criada</h6>
                                            <p class="text-muted mb-0">
                                                {{ $request->created_at->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                    </div>

                                    @if ($request->updated_at != $request->created_at)
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-info"></div>
                                            <div class="timeline-content">
                                                <h6 class="mb-1">Última Atualização</h6>
                                                <p class="text-muted mb-0">
                                                    {{ $request->updated_at->format('d/m/Y H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($request->document_requests)
                                        @php
                                            $docRequests = $request->document_requests; // Already an array, no need to decode
                                        @endphp
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-warning"></div>
                                            <div class="timeline-content">
                                                <h6 class="mb-1">Documentos Solicitados</h6>
                                                <p class="text-muted mb-2">
                                                    {{ \Carbon\Carbon::parse($docRequests['timestamp'])->format('d/m/Y H:i') }}
                                                    por {{ $docRequests['requested_by'] }}
                                                </p>
                                                <p class="mb-0">{{ $docRequests['message'] }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($request->document_approval)
                                        @php
                                            $approval = json_decode($request->document_approval, true);
                                        @endphp
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-success"></div>
                                            <div class="timeline-content">
                                                <h6 class="mb-1">Documentos Aprovados</h6>
                                                <p class="text-muted mb-2">
                                                    {{ \Carbon\Carbon::parse($approval['timestamp'])->format('d/m/Y H:i') }}
                                                    por {{ $approval['approved_by'] }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($request->closing_data)
                                        @php
                                            $closing = json_decode($request->closing_data, true);
                                        @endphp
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-{{ $closing['result'] == 'approved' ? 'success' : 'danger' }}"></div>
                                            <div class="timeline-content">
                                                <h6 class="mb-1">
                                                    Solicitação 
                                                    @if($closing['result'] == 'approved')
                                                        <span class="badge bg-success">Aprovada</span>
                                                    @else
                                                        <span class="badge bg-danger">Rejeitada</span>
                                                    @endif
                                                </h6>
                                                <p class="text-muted mb-2">
                                                    {{ \Carbon\Carbon::parse($closing['timestamp'])->format('d/m/Y H:i') }}
                                                    por {{ $closing['closed_by'] }}
                                                </p>
                                                <p class="mb-0">{{ $closing['notes'] }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SIDEBAR COM AÇÕES -->
                    <div class="col-lg-4">
                        <!-- Status Card -->
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-gear"></i> Status Atual
                                </h5>
                            </div>
                            <div class="card-body">
                                @php
                                    $statusColors = [
                                        'pending' => 'warning',
                                        'in_progress' => 'info',
                                        'awaiting_documents' => 'secondary',
                                        'documents_approved' => 'success',
                                        'completed' => 'success',
                                        'rejected' => 'danger',
                                    ];
                                    $color = $statusColors[$request->status] ?? 'secondary';
                                @endphp
                                <div class="text-center mb-3">
                                    <span class="badge bg-{{ $color }} p-3" style="font-size: 1.1rem;">
                                        {{ $statuses[$request->status] ?? $request->status }}
                                    </span>
                                </div>

                                <div id="statusForm" class="d-grid gap-2">
                                    <label class="form-label small text-muted">Alterar para:</label>
                                    <form method="POST" action="{{ route('admin.dashboard.registryServiceRequest.updateStatus', $request->id) }}" class="d-flex gap-2">
                                        @csrf
                                        <select name="request_status_id" class="form-select form-select-sm">
                                            <option value="">-- Selecione --</option>
                                            @foreach($statuses as $status)
                                                @if($status->id != $request->request_status_id)
                                                    <option value="{{ $status->id }}">{{ $status->label }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="bi bi-check-circle"></i> Atualizar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-lightning"></i> Ações Rápidas
                                </h5>
                            </div>
                            <div class="card-body d-grid gap-2">
                                <!-- Solicitar Documentos -->
                                @if($request->status != 'completed' && $request->status != 'rejected')
                                    <button type="button" class="btn btn-outline-primary" 
                                        data-bs-toggle="modal" data-bs-target="#requestDocumentsModal">
                                        <i class="bi bi-file-earmark-arrow-down"></i> Solicitar Documentos
                                    </button>
                                @endif

                                <!-- Aprovar Documentos -->
                                @if($request->status == 'awaiting_documents' || $request->status == 'documents_approved')
                                    <button type="button" class="btn btn-outline-success" 
                                        data-bs-toggle="modal" data-bs-target="#approveDocumentsModal">
                                        <i class="bi bi-check-circle"></i> Aprovar Documentos
                                    </button>
                                @endif

                                <!-- Encerrar Solicitação -->
                                @if($request->status != 'completed' && $request->status != 'rejected')
                                    <button type="button" class="btn btn-outline-danger" 
                                        data-bs-toggle="modal" data-bs-target="#closeRequestModal">
                                        <i class="bi bi-lock"></i> Encerrar Solicitação
                                    </button>
                                @endif

                                <!-- Reabrir (se encerrada) -->
                                @if($request->status == 'completed' || $request->status == 'rejected')
                                    <form method="POST" action="{{ route('admin.dashboard.registryServiceRequest.reopenRequest', $request->id) }}" class="d-grid">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-warning" onclick="return confirm('Tem certeza que deseja reabrir esta solicitação?')">
                                            <i class="bi bi-arrow-repeat"></i> Reabrir Solicitação
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <!-- Info Card -->
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title mb-3">
                                    <i class="bi bi-info-circle"></i> Dicas
                                </h6>
                                <ul class="small text-muted mb-0">
                                    <li>Adicione observações para comunicar com sua equipe</li>
                                    <li>Solicite documentos quando necessário</li>
                                    <li>Aprove os documentos antes de finalizar</li>
                                    <li>Sempre deixe uma nota ao encerrar</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Solicitar Documentos -->
    <div class="modal fade" id="requestDocumentsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Solicitar Documentos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('admin.dashboard.registryServiceRequest.requestDocuments', $request->id) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Documentos Necessários *</label>
                            <div>
                                @php
                                    $commonDocs = [
                                        'Identidade',
                                        'CPF',
                                        'Comprovante de Residência',
                                        'Registro em Cartório',
                                        'Procuração',
                                        'Documento de Autorização',
                                        'Recibos',
                                        'Comprovante de Pagamento',
                                    ];
                                @endphp
                                @foreach($commonDocs as $doc)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                            value="{{ $doc }}" name="required_documents[]">
                                        <label class="form-check-label">{{ $doc }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="messageText" class="form-label">Mensagem ao Cliente *</label>
                            <textarea id="messageText" name="message" class="form-control" 
                                rows="5" placeholder="Detalhe quais documentos são necessários e o prazo..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send"></i> Enviar Solicitação
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Aprovar Documentos -->
    <div class="modal fade" id="approveDocumentsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Aprovar Documentos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('admin.dashboard.registryServiceRequest.approveDocuments', $request->id) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="approvalNotes" class="form-label">Observações (Opcional)</label>
                            <textarea id="approvalNotes" name="approval_notes" class="form-control" 
                                rows="4" placeholder="Deixe alguma observação..."></textarea>
                        </div>
                        <div class="alert alert-info" role="alert">
                            <i class="bi bi-info-circle"></i>
                            Os documentos foram analisados e estão corretos?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check"></i> Confirmar Aprovação
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Encerrar Solicitação -->
    <div class="modal fade" id="closeRequestModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Encerrar Solicitação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('admin.dashboard.registryServiceRequest.closeRequest', $request->id) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="resultSelect" class="form-label">Resultado Final *</label>
                            <select id="resultSelect" name="result" class="form-select" required>
                                <option value="">-- Selecione --</option>
                                <option value="completed">
                                    <i class="bi bi-check-circle"></i> Aprovado
                                </option>
                                <option value="rejected">
                                    <i class="bi bi-x-circle"></i> Rejeitado
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="closingNotes" class="form-label">Motivo/Observações *</label>
                            <textarea id="closingNotes" name="closing_notes" class="form-control" 
                                rows="5" placeholder="Explique o motivo do resultado..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-lock"></i> Encerrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    @endpush

    <style>
        .timeline {
            position: relative;
            padding-left: 40px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
            padding-bottom: 20px;
        }

        .timeline-item:not(:last-child)::before {
            content: '';
            position: absolute;
            left: -30px;
            top: 30px;
            width: 2px;
            height: calc(100% - 30px);
            background-color: #dee2e6;
        }

        .timeline-marker {
            position: absolute;
            left: -38px;
            top: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 0 2px #dee2e6;
        }

        .timeline-content h6 {
            font-size: 0.95rem;
            color: #333;
        }

        .timeline-content p {
            font-size: 0.85rem;
        }
    </style>
@endsection

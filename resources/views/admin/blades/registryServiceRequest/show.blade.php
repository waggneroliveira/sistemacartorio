@extends('admin.core.admin')
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
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
                                            <span class="badge bg-primary">#{{ $request->id }}</span>
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
                                <form id="addObservationForm" class="mt-3">
                                    @csrf
                                    <div class="mb-3">
                                        <textarea name="observation" id="observation" class="form-control" 
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
                                            $docRequests = json_decode($request->document_requests, true);
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
                                    <select id="statusSelect" class="form-select form-select-sm">
                                        <option value="">-- Selecione --</option>
                                        @foreach($statuses as $key => $label)
                                            @if($key != $request->status)
                                                <option value="{{ $key }}">{{ $label }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="updateStatus()">
                                        <i class="bi bi-check-circle"></i> Atualizar Status
                                    </button>
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
                                    <button type="button" class="btn btn-outline-warning" onclick="reopenRequest()">
                                        <i class="bi bi-arrow-repeat"></i> Reabrir Solicitação
                                    </button>
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
                <form id="requestDocumentsForm">
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
                                        <input class="form-check-input required-doc" type="checkbox" 
                                            value="{{ $doc }}" name="required_documents">
                                        <label class="form-check-label">{{ $doc }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">Ou adicione um documento customizado:</small>
                                <input type="text" id="customDoc" class="form-control form-control-sm" 
                                    placeholder="Digite o documento...">
                                <button type="button" class="btn btn-sm btn-outline-secondary mt-1" 
                                    onclick="addCustomDocument()">
                                    Adicionar
                                </button>
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
                <form id="approveDocumentsForm">
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
                <form id="closeRequestForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="resultSelect" class="form-label">Resultado Final *</label>
                            <select id="resultSelect" name="result" class="form-select" required>
                                <option value="">-- Selecione --</option>
                                <option value="approved">
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
    <script>
        const requestId = {{ $request->id }};

        // Adicionar documento customizado
        function addCustomDocument() {
            const input = document.getElementById('customDoc');
            const value = input.value.trim();
            
            if (!value) return;

            const checkbox = document.createElement('div');
            checkbox.className = 'form-check';
            checkbox.innerHTML = `
                <input class="form-check-input required-doc" type="checkbox" 
                    value="${value}" name="required_documents" checked>
                <label class="form-check-label">${value}</label>
            `;
            
            document.querySelector('[data-bs-target="#requestDocumentsModal"]')
                .parentElement.querySelector('.required-doc').parentElement.insertBefore(
                    checkbox, 
                    document.querySelector('[data-bs-target="#requestDocumentsModal"]').parentElement.querySelector('.mt-2')
                );
            
            input.value = '';
        }

        // Atualizar Status
        function updateStatus() {
            const status = document.getElementById('statusSelect').value;
            
            if (!status) {
                alert('Selecione um status');
                return;
            }

            fetch(`/painel/solicitacoes-de-servicos/${requestId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Status atualizado com sucesso!');
                    location.reload();
                } else {
                    alert('Erro ao atualizar status: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Adicionar Observação
        document.getElementById('addObservationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const observation = document.getElementById('observation').value;
            
            fetch(`/painel/solicitacoes-de-servicos/${requestId}/observation`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({ observation: observation })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Erro: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // Solicitar Documentos
        document.getElementById('requestDocumentsForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const selectedDocs = [];
            document.querySelectorAll('.required-doc:checked').forEach(checkbox => {
                selectedDocs.push(checkbox.value);
            });
            
            const message = document.getElementById('messageText').value;
            
            if (selectedDocs.length === 0) {
                alert('Selecione pelo menos um documento');
                return;
            }

            fetch(`/painel/solicitacoes-de-servicos/${requestId}/request-documents`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    required_documents: selectedDocs,
                    message: message
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    bootstrap.Modal.getInstance(document.getElementById('requestDocumentsModal')).hide();
                    alert('Documentos solicitados com sucesso!');
                    location.reload();
                } else {
                    alert('Erro: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // Aprovar Documentos
        document.getElementById('approveDocumentsForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const notes = document.getElementById('approvalNotes').value;
            
            fetch(`/painel/solicitacoes-de-servicos/${requestId}/approve-documents`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({ approval_notes: notes })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    bootstrap.Modal.getInstance(document.getElementById('approveDocumentsModal')).hide();
                    alert('Documentos aprovados com sucesso!');
                    location.reload();
                } else {
                    alert('Erro: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // Encerrar Solicitação
        document.getElementById('closeRequestForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const result = document.getElementById('resultSelect').value;
            const notes = document.getElementById('closingNotes').value;
            
            if (!result) {
                alert('Selecione um resultado');
                return;
            }

            if (!notes.trim()) {
                alert('Digite uma observação');
                return;
            }

            fetch(`/painel/solicitacoes-de-servicos/${requestId}/close`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    result: result,
                    closing_notes: notes
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    bootstrap.Modal.getInstance(document.getElementById('closeRequestModal')).hide();
                    alert('Solicitação encerrada com sucesso!');
                    location.reload();
                } else {
                    alert('Erro: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // Reabrir Solicitação
        function reopenRequest() {
            if (!confirm('Tem certeza que deseja reabrir esta solicitação?')) {
                return;
            }

            fetch(`/painel/solicitacoes-de-servicos/${requestId}/reopen`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Solicitação reabierta com sucesso!');
                    location.reload();
                } else {
                    alert('Erro: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
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

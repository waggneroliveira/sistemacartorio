@extends('client.core.client')
@section('content')
        <!-- HEADER -->
    <div class="text-center mb-5">
        <h1 class="display-6 fw-bold" style="color: #1a3e2f;">Solicite serviços com agilidade</h1>
        <p class="lead text-secondary">Escolha o serviço, preencha os dados específicos e envie seus documentos</p>
    </div>

    <div class="row g-4">
        <!-- COLUNA ESQUERDA: SERVIÇOS + DOCS NECESSÁRIOS -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h3 class="section-title mb-3"><i class="bi bi-grid-3x3-gap-fill me-2"></i> Escolha um serviço</h3>
                    <p class="text-muted small">Clique em qualquer serviço para ver os documentos exigidos e campos específicos</p>
                    <div class="row g-3" id="servicesContainer">
                        <!-- Serviços serão injetados via JS -->
                    </div>
                </div>
            </div>

            <!-- BLOCOS DE DOCUMENTOS NECESSÁRIOS (explicação clara) -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h3 class="section-title mb-3"><i class="bi bi-pin-map-fill me-2"></i> Documentos necessários</h3>
                    <div id="docsExplanation" class="p-3 bg-light rounded-4" style="min-height: 180px;">
                        <div class="d-flex align-items-center text-secondary">
                            <i class="bi bi-info-circle fs-4 me-2"></i>
                            <span>Selecione um serviço ao lado para visualizar a lista de documentos obrigatórios e orientações.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- COLUNA DIREITA: FORMULÁRIO RÁPIDO + UPLOAD DINÂMICO -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h3 class="section-title mb-0"><i class="bi bi-pencil-square me-2"></i> Formulário de solicitação</h3>
                    <p class="text-muted mt-2">Os campos abaixo se adaptam conforme o serviço escolhido</p>
                </div>
                <div class="card-body p-4">
                    <form id="solicitacaoForm" enctype="multipart/form-data">
                        <!-- Serviço selecionado (hidden) -->
                        <input type="hidden" id="selectedServiceId" name="servicoId" value="">
                        <input type="hidden" id="selectedServiceName" name="servicoNome" value="">
                        
                        <!-- CAMPOS BÁSICOS COMUNS A TODOS OS SERVIÇOS -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold required-field"><i class="bi bi-person-badge"></i> Nome completo</label>
                            <input type="text" class="form-control" id="nomeCompleto" name="nome" placeholder="Ex: Maria da Silva Oliveira" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold required-field"><i class="bi bi-envelope"></i> E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="seuemail@exemplo.com" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold required-field"><i class="bi bi-whatsapp"></i> Telefone/WhatsApp</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="(11) 99999-9999" required>
                            </div>
                        </div>
                        
                        <!-- ÁREA DINÂMICA: CAMPOS ESPECÍFICOS POR SERVIÇO -->
                        <div id="dynamicFieldsContainer" class="mb-4">
                            <!-- Os campos específicos serão inseridos aqui via JavaScript -->
                            <div class="alert alert-light border text-center py-3" id="noServiceSelectedMsg">
                                <i class="bi bi-info-circle"></i> Selecione um serviço para visualizar os campos específicos.
                            </div>
                        </div>

                        <!-- UPLOAD DE ARQUIVOS (RG, CPF, certidões etc) -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold required-field"><i class="bi bi-cloud-upload"></i> Upload de documentos específicos do serviço</label>
                            <div class="upload-area p-4 text-center" id="dropzone">
                                <i class="bi bi-cloud-arrow-up fs-1 text-secondary"></i>
                                <p class="mt-2 mb-1">Arraste e solte arquivos ou clique para selecionar</p>
                                <small class="text-muted">Formatos: PDF, JPG, PNG. Máx. 10MB por arquivo. (até 8 arquivos)</small>
                                <button type="button" class="btn btn-outline-secondary mt-2 rounded-pill" id="selectFilesBtn"><i class="bi bi-folder2-open"></i> Selecionar arquivos</button>
                                <input type="file" id="fileInput" class="d-none" accept=".pdf,.jpg,.jpeg,.png" multiple>
                            </div>
                            <div id="fileListContainer" class="mt-3 file-list bg-white border rounded-3 p-2 d-none">
                                <ul id="fileList" class="list-unstyled mb-0"></ul>
                            </div>
                            <small class="text-muted mt-2 d-block"><i class="bi bi-info-circle"></i> Envie os documentos listados na seção "Documentos necessários" ao lado.</small>
                        </div>

                        <div class="alert alert-info small rounded-4" role="alert">
                            <i class="bi bi-shield-lock"></i> Seus documentos são protegidos e utilizados apenas para finalização do serviço cartorário.
                        </div>

                        <button type="submit" class="btn btn-submit text-white w-100 btn-lg">
                            <i class="bi bi-send-check"></i> Enviar solicitação
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

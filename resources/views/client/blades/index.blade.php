@extends('client.core.client')
@section('content')
<style>
    p{
        font-size: clamp(0.75rem, 0.938vw, 0.938rem);
        line-height: 23px;
    }
    /* ==================== STEP INDICATOR ==================== */
    .step-wrapper {
        max-width: 500px;
        margin: 0 auto 2rem auto;
    }
    
    .step-indicator {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .step-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        min-width: 70px;
    }
    
    .step-circle {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background-color: #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
        color: #64748b;
        transition: all 0.3s ease;
        margin-bottom: 0.5rem;
    }
    
    .step-item.active .step-circle {
        background-color: #1a3e2f;
        color: white;
        box-shadow: 0 0 0 4px rgba(26, 62, 47, 0.2);
        transform: scale(1.05);
    }
    
    .step-item.completed .step-circle {
        background-color: #0d9488;
        color: white;
    }
    
    .step-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
        text-align: center;
        line-height: 15px;
    }
    
    .step-item.active .step-label {
        color: #1a3e2f;
        font-weight: 700;
    }
    
    .step-item.completed .step-label {
        color: #0d9488;
    }
    
    .step-connector {
        width: 40px;
        height: 2px;
        background-color: #e2e8f0;
        margin: 0 0.25rem 1.5rem 0.25rem;
    }
    
    @media (max-width: 576px) {
        .step-circle {
            width: 36px;
            height: 36px;
            font-size: 0.9rem;
        }
        .step-label {
            font-size: 0.6rem;
        }
        .step-connector {
            width: 20px;
        }
        .step-item {
            min-width: 55px;
        }
    }
    
    /* ==================== LAYOUT PRINCIPAL ==================== */
    .services-layout {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    
    @media (min-width: 1200px) {
        .services-layout {
            display: grid;
            grid-template-columns: 320px 1fr 340px;
            gap: 1.5rem;
            align-items: start;
        }
    }
    
    @media (min-width: 768px) and (max-width: 1199px) {
        .services-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        .services-layout .documentos-card {
            grid-column: span 2;
        }
    }
    
    /* ==================== CARD DE SERVIÇOS ==================== */
    .services-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    .services-header {
        background: #1a3e2f;
        color: white;
        padding: 1rem 1.25rem;
    }
    
    .services-list {
        max-height: 500px;
        overflow-y: auto;
        padding: 0.75rem;
    }
    
    .services-list::-webkit-scrollbar {
        width: 6px;
    }
    .services-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    .services-list::-webkit-scrollbar-thumb {
        background: #1a3e2f;
        border-radius: 10px;
    }
    
    /* Item de serviço */
    .service-item {
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.875rem;
        padding: 0.875rem;
        margin-bottom: 0.625rem;
        border-radius: 14px;
        background: #f8f9fa;
        transition: all 0.2s ease;
        border: 2px solid transparent;
    }
    
    .service-item:hover {
        background: #e8f3ec;
        transform: translateX(4px);
    }
    
    .service-item.selected {
        background: linear-gradient(135deg, #e8f3ec 0%, #d4e8db 100%);
        border-color: #1a3e2f;
    }
    
    .service-icon {
        width: 44px;
        height: 44px;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        color: #1a3e2f;
        flex-shrink: 0;
    }
    
    .service-item.selected .service-icon {
        background: #1a3e2f;
        color: white;
    }
    
    .service-info {
        flex: 1;
    }
    
    .service-name {
        font-weight: 700;
        font-size: 0.938rem;
        margin-bottom: 0.2rem;
        color: #1e293b;
        line-height: 18px;
    }
    
    .service-desc {
        font-size: 0.7rem;
        color: #64748b;
    }
    
    .service-check {
        color: #1a3e2f;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    
    .scroll-hint {
        font-size: 0.7rem;
        padding: 0.4rem;
        text-align: center;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 30px;
        margin-top: 0.5rem;
        color: rgba(255, 255, 255, 0.9);
    }
    
    /* ==================== CARD DE DOCUMENTOS ==================== */
    .documentos-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        position: sticky;
        top: 20px;
        border: 1px solid #e2e8f0;
    }
    
    .documentos-header {
        background: #0d9488;
        color: white;
        padding: 1rem 1.25rem;
        border-radius: 20px 20px 0 0;
    }
    
    .documentos-content {
        padding: 1rem;
        max-height: 500px;
        overflow-y: auto;
    }
    
    .documentos-content ul li {
        padding: 0.5rem 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    /* ==================== FORMULÁRIO ==================== */
    .form-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    .form-card .card-header {
        background: white;
        border-bottom: 1px solid #eef2f6;
        padding: 1.25rem 1.5rem;
    }
    
    .form-control, .form-select {
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        transition: all 0.2s;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #1a3e2f;
        box-shadow: 0 0 0 3px rgba(26, 62, 47, 0.1);
        outline: none;
    }
    
    .form-label {
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
        color: #334155;
        font-weight: 600;
    }
    
    .required-field:after {
        content: " *";
        color: #dc2626;
    }
    
    /* Área de upload */
    .upload-area {
        transition: all 0.2s ease;
        cursor: pointer;
        background-color: #fafcfb;
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        padding: 2rem;
    }
    
    .upload-area:hover {
        background-color: #f0f9f4;
        border-color: #1a3e2f;
    }
    
    /* Botão de envio */
    .btn-submit {
        background: linear-gradient(135deg, #1a3e2f 0%, #2a5e45 100%);
        border: none;
        padding: 0.875rem;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.2s;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(26, 62, 47, 0.3);
    }
    
    /* Animações */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .dynamic-fields-wrapper {
        animation: fadeIn 0.3s ease;
    }
    
    /* Dica flutuante para primeiro acesso */
    .guide-tip {
        background: #fef9c3;
        border-left: 4px solid #eab308;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-size: 0.75rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .guide-tip i {
        color: #eab308;
        font-size: 1rem;
    }
    
    /* Responsividade */
    @media (max-width: 768px) {
        .services-list {
            max-height: 300px;
        }
        .documentos-content {
            max-height: 300px;
        }
        .service-item {
            padding: 0.7rem;
        }
        .service-icon {
            width: 36px;
            height: 36px;
            font-size: 1.1rem;
        }
        .service-name {
            font-size: 0.85rem;
        }
    }
</style>

<!-- HEADER -->
<div class="text-center mb-4">
    <h1 class="display-6 fw-bold" style="color: #1a3e2f;">
        <i class="bi bi-building-check"></i> Cartório Online
    </h1>
    <p class="lead text-secondary">Solicite serviços de forma rápida e segura</p>
</div>

<!-- STEP INDICATOR - PASSO A PASSO VISUAL -->
<div class="step-wrapper">
    <div class="step-indicator" id="stepIndicator">
        <div class="step-item active" data-step="1">
            <div class="step-circle">1</div>
            <span class="step-label">Escolher serviço</span>
        </div>
        <div class="step-connector"></div>
        <div class="step-item" data-step="2">
            <div class="step-circle">2</div>
            <span class="step-label">Ver documentos</span>
        </div>
        <div class="step-connector"></div>
        <div class="step-item" data-step="3">
            <div class="step-circle">3</div>
            <span class="step-label">Preencher dados</span>
        </div>
        <div class="step-connector"></div>
        <div class="step-item" data-step="4">
            <div class="step-circle">4</div>
            <span class="step-label">Enviar</span>
        </div>
    </div>
    
    <!-- Dica amigável para novos usuários -->
    <div class="guide-tip mt-2" id="guideTip">
        <i class="bi bi-lightbulb"></i>
        <span>✨ <strong>Dica:</strong> Comece clicando em um serviço na lista ao lado →</span>
    </div>
</div>

<!-- LAYOUT PRINCIPAL - 3 COLUNAS -->
<div class="services-layout">
    
    <!-- COLUNA 1: LISTA DE SERVIÇOS -->
    <div class="services-card">
        <div class="services-header">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-grid-3x3-gap-fill fs-5"></i>
                <span class="fw-bold">1. Escolha o serviço</span>
            </div>
            <div class="scroll-hint">
                <i class="bi bi-arrow-down-short"></i> Role para ver mais serviços
            </div>
        </div>
        <div class="services-list" id="servicesContainer">
            <div class="text-center py-4 text-secondary">
                <i class="bi bi-hourglass-split fs-2 d-block mb-2"></i>
                <span>Carregando serviços...</span>
            </div>
        </div>
        <div class="p-2 text-center border-top bg-light">
            <small class="text-muted">
                <i class="bi bi-hand-index-thumb"></i> Clique no serviço desejado
            </small>
        </div>
    </div>
    
    <!-- COLUNA 2: FORMULÁRIO PRINCIPAL -->
    <div class="card form-card">
        <div class="card-header">
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle bg-primary bg-opacity-10 p-2">
                    <i class="bi bi-pencil-square fs-5 text-primary"></i>
                </div>
                <div>
                    <h3 class="mb-0 fs-6 fw-bold">2. Preencha seus dados</h3>
                    <p class="text-muted small mb-0">Campos adaptados para cada serviço</p>
                </div>
            </div>
        </div>
        
        <div class="card-body p-4">
            <form id="solicitacaoForm" enctype="multipart/form-data">
                
                <input type="hidden" id="selectedServiceId" name="servicoId" value="">
                <input type="hidden" id="selectedServiceName" name="servicoNome" value="">
                
                <!-- Dados básicos -->
                <div class="mb-3">
                    <label class="form-label required-field">
                        <i class="bi bi-person-badge"></i> Nome completo
                    </label>
                    <input type="text" class="form-control" id="nomeCompleto" name="nome" 
                        placeholder="Digite seu nome completo" required>
                </div>
                
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label required-field">
                            <i class="bi bi-envelope"></i> E-mail
                        </label>
                        <input type="email" class="form-control" id="email" name="email" 
                            placeholder="seuemail@exemplo.com" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required-field">
                            <i class="bi bi-whatsapp"></i> Telefone/WhatsApp
                        </label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" 
                            placeholder="(11) 99999-9999" required>
                    </div>
                </div>
                
                <!-- Campos dinâmicos -->
                <div id="dynamicFieldsContainer" class="mb-4">
                    <div class="alert alert-light border text-center py-4" id="noServiceSelectedMsg">
                        <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
                        <span>Selecione um serviço para começar</span>
                    </div>
                </div>

                <!-- Upload -->
                <div class="mb-4">
                    <label class="form-label required-field">
                        <i class="bi bi-cloud-upload"></i> 3. Envie os documentos
                    </label>
                    
                    <div class="upload-area text-center" id="dropzone">
                        <i class="bi bi-cloud-arrow-up fs-1 text-secondary"></i>
                        <p class="mt-2 mb-1 fw-semibold">Arraste arquivos ou clique aqui</p>
                        <small class="text-muted">PDF, JPG, PNG (máx. 10MB cada)</small>
                        <button type="button" class="btn btn-outline-secondary mt-2 rounded-pill px-4" id="selectFilesBtn">
                            <i class="bi bi-folder2-open"></i> Selecionar arquivos
                        </button>
                        <input type="file" id="fileInput" class="d-none" accept=".pdf,.jpg,.jpeg,.png" multiple>
                    </div>
                    
                    <div id="fileListContainer" class="mt-2 d-none">
                        <div class="alert alert-success py-2 small">
                            <i class="bi bi-check-circle"></i> Arquivos selecionados:
                        </div>
                        <ul id="fileList" class="list-unstyled"></ul>
                    </div>
                    
                    <small class="text-muted mt-2 d-block">
                        <i class="bi bi-info-circle"></i> Envie os documentos listados ao lado
                    </small>
                </div>

                <div class="alert alert-info small rounded-4 d-flex align-items-center gap-2" role="alert">
                    <i class="bi bi-shield-lock fs-5"></i>
                    <div>Seus documentos são protegidos e utilizados apenas para finalização do serviço cartorário.</div>
                </div>

                <button type="submit" class="btn btn-submit text-white w-100">
                    <i class="bi bi-send-check"></i> Enviar solicitação
                </button>
            </form>
        </div>
    </div>
    
    <!-- COLUNA 3: DOCUMENTOS NECESSÁRIOS (SEMPRE VISÍVEL) -->
    <div class="documentos-card">
        <div class="documentos-header">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-file-earmark-check fs-5"></i>
                <span class="fw-bold">Documentos necessários</span>
            </div>
            <div class="small mt-1 opacity-75">
                <i class="bi bi-info-circle"></i> Tenha estes documentos em mãos
            </div>
        </div>
        <div class="documentos-content" id="docsExplanation">
            <div class="text-center py-4 text-secondary">
                <i class="bi bi-folder2-open fs-1 d-block mb-2"></i>
                <span>Selecione um serviço<br>para ver os documentos necessários</span>
            </div>
        </div>
        <div class="p-2 text-center border-top bg-light">
            <small class="text-muted">
                <i class="bi bi-camera"></i> Tire foto ou digitalize os documentos
            </small>
        </div>
    </div>
</div>
@endsection

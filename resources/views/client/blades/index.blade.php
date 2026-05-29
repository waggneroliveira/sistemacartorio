@extends('client.core.client')
@section('content')
<!-- HEADER -->
<div class="text-center mb-4">
    <h1 class="display-6 fw-bold" style="color: #0a2b3e;">
        <i class="bi bi-building-check"></i> Cartório Online
    </h1>
    <p class="lead text-secondary">Solicite serviços de forma rápida e segura</p>
</div>

<!-- LAYOUT PRINCIPAL - 3 COLUNAS -->
<div class="services-layout">
    
    <aside class="sidebar">
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
                @forelse($services as $service)
                    <div class="service-item" data-id="{{ $service->id }}" data-name="{{ $service->name }}">
                        <div class="service-icon">
                            <i class="bi {{ $service->icon ?? 'bi-file-text' }}"></i>
                        </div>
                        <div class="service-info">
                            <div class="service-name">{{ $service->name }}</div>
                            <div class="service-desc">
                                {{ Str::limit($service->instructions ?? 'Clique para ver detalhes', 50) }}
                            </div>
                        </div>
                        <div class="service-check" style="display: none;">
                            <i class="bi bi-check-circle-fill text-success"></i>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4 text-secondary">
                        <i class="bi bi-hourglass-split fs-2 d-block mb-2"></i>
                        <span>Nenhum serviço disponível no momento</span>
                    </div>
                @endforelse
            </div>
            <div class="p-2 text-center border-top bg-light">
                <small class="text-muted">
                    <i class="bi bi-hand-index-thumb"></i> Clique no serviço desejado
                </small>
            </div>
        </div>

        <div class="sidebar-card mt-3">
            <div class="sidebar-title">
                <i class="fas fa-gem"></i> Benefícios do cadastro
            </div>
            <div class="benefit-item">
                <div class="benefit-icon"><i class="fas fa-tachometer-alt"></i></div>
                <div class="benefit-text">
                <h4>Atendimento prioritário</h4>
                <p>Agende seus serviços com antecedência</p>
                </div>
            </div>
            <div class="benefit-item">
                <div class="benefit-icon"><i class="fas fa-file-signature"></i></div>
                <div class="benefit-text">
                <h4>Certidões online</h4>
                <p>Solicite certidões sem sair de casa</p>
                </div>
            </div>
            <div class="benefit-item">
                <div class="benefit-icon"><i class="fas fa-bell"></i></div>
                <div class="benefit-text">
                <h4>Acompanhamento em tempo real</h4>
                <p>Receba notificações sobre seus processos</p>
                </div>
            </div>
            <div class="benefit-item">
                <div class="benefit-icon"><i class="fas fa-shield-alt"></i></div>
                <div class="benefit-text">
                <h4>Segurança garantida</h4>
                <p>Dados protegidos conforme a LGPD</p>
                </div>
            </div>
        </div>

        <div class="sidebar-card">
        <div class="sidebar-title">
            <i class="fas fa-clock"></i> Prazo de análise
        </div>
        <div class="benefit-text" style="text-align: center; padding: 0.5rem 0;">
            <p style="font-size: 1.3rem; font-weight: 700; color: #1b4f6e;">24h úteis</p>
            <p style="font-size: 0.7rem;">Seus documentos serão analisados em até 24 horas úteis</p>
            <div style="margin-top: 0.8rem;">
            <span class="badge-security"><i class="fas fa-lock"></i> Ambiente 100% seguro</span>
            </div>
        </div>
        </div>
    </aside>
    
    <!-- COLUNA 2: FORMULÁRIO PRINCIPAL -->
    <div class="card form-card">
        <!-- STEP INDICATOR - PASSO A PASSO VISUAL -->
        <div class="step-wrapper mt-3">
            <div class="step-indicator" id="stepIndicator">
                <div class="step-item" data-step="1">
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
            
            <div class="guide-tip mt-2" id="guideTip">
                <i class="bi bi-lightbulb"></i>
                <span>✨ <strong>Dica:</strong> Comece clicando em um serviço na lista ao lado →</span>
            </div>
        </div>

        <div class="card-header">
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle p-2" style="background: rgba(10, 43, 62, 0.1);">
                    <i class="bi bi-pencil-square fs-5" style="color: #0a2b3e;"></i>
                </div>
                <div>
                    <h3 class="mb-0 fs-6 fw-bold">2. Preencha seus dados</h3>
                    <p class="text-muted small mb-0">Campos adaptados para cada serviço</p>
                </div>
            </div>
        </div>
        
        <div class="card-body p-4">
            <form id="solicitacaoForm" enctype="multipart/form-data">
                @csrf
                
                <input type="hidden" id="selectedServiceId" name="servico_id" value="">
                <input type="hidden" id="selectedServiceName" name="servico_nome" value="">
                
                <!-- Dados básicos -->
                <div class="mb-3">
                    <label class="form-label required-field">
                        <i class="bi bi-person-badge"></i> Nome completo
                    </label>
                    <input type="text" class="form-control" id="nomeCompleto" 
                        placeholder="Digite seu nome completo" readonly disabled value="{{ Auth::guard('client')->user()->name }}" required>
                </div>
                
                <div class="row g-3 mb-3">
                    <div class="col-md-7">
                        <label class="form-label required-field">
                            <i class="bi bi-envelope"></i> E-mail
                        </label>
                        <input type="email" class="form-control" id="email" readonly disabled value="{{ Auth::guard('client')->user()->email }}" 
                            placeholder="seuemail@exemplo.com" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label required-field">
                            <i class="bi bi-whatsapp"></i> Telefone/WhatsApp
                        </label>
                        <input type="tel" class="form-control" id="telefone" readonly disabled value="{{ Auth::guard('client')->user()->whatsapp }}"
                            placeholder="(11) 99999-9999" required>
                    </div>
                </div>
                
                <!-- Campos dinâmicos (serão preenchidos via JS) -->
                <div id="dynamicFieldsContainer" class="mb-4">
                    <div class="alert alert-light border text-center py-4">
                        <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
                        <span>Selecione um serviço para começar</span>
                    </div>
                </div>

                <!-- Upload -->
                <div class="mb-4" id="uploadSection" style="display: none;">
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

                <div class="alert alert-info small rounded-4 d-flex align-items-center gap-2" role="alert" style="background: #e8f0ec; border-color: #0a2b3e; color: #0a2b3e;">
                    <i class="bi bi-shield-lock fs-5"></i>
                    <div>Seus documentos são protegidos e utilizados apenas para finalização do serviço cartorário.</div>
                </div>

                <button type="submit" class="btn btn-submit text-white w-100">
                    <i class="bi bi-send-check"></i> Enviar solicitação
                </button>
            </form>
        </div>
    </div>
    
    <!-- SIDEBAR DIREITA - Contato e Ajuda -->
    <aside class="sidebar">
        <!-- COLUNA 3: DOCUMENTOS NECESSÁRIOS -->
        <div class="documentos-card" id="documentosCard">
            <div class="documentos-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-check fs-5"></i>
                    <span class="fw-bold">2. Documentos necessários</span>
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

        <div class="sidebar-card mt-3">
            <div class="sidebar-title"><i class="fas fa-headset"></i> Precisa de ajuda?</div>
            <div class="contact-item"><i class="fab fa-whatsapp"></i> <a href="#">(11) 99999-1234</a></div>
            <div class="contact-item"><i class="fas fa-phone-alt"></i> (11) 3456-7890</div>
            <div class="contact-item"><i class="fas fa-envelope"></i> <a href="mailto:suporte@cartoriocentral.com.br">suporte@cartoriocentral.com.br</a></div>
            <div class="hours"><i class="fas fa-clock"></i> Segunda a Sexta: 9h às 18h</div>
        </div>

        <div class="sidebar-card">
            <div class="sidebar-title"><i class="fas fa-question-circle"></i> Dúvidas frequentes</div>
            <div class="benefit-item">
                <div class="benefit-icon"><i class="fas fa-file"></i></div>
                <div class="benefit-text"><h4>Quais documentos enviar?</h4><p>RG, CPF e comprovante de residência</p></div>
            </div>
            <div class="benefit-item">
                <div class="benefit-icon"><i class="fas fa-clock"></i></div>
                <div class="benefit-text"><h4>Quanto tempo demora?</h4><p>Análise em até 24h úteis</p></div>
            </div>
            <div class="benefit-item">
                <div class="benefit-icon"><i class="fas fa-lock"></i></div>
                <div class="benefit-text"><h4>Meus dados estão seguros?</h4><p>Sim, seguimos a LGPD</p></div>
            </div>
        </div>

        <div class="sidebar-card">
            <div class="sidebar-title"><i class="fas fa-star"></i> Avaliação do serviço</div>
            <div style="text-align: center;">
                <div style="color: #ffc107; font-size: 1rem;">★★★★★</div>
                <p style="font-size: 0.7rem; margin-top: 0.3rem;">4.9 de 5 - Baseado em 2.500+ avaliações</p>
            </div>
        </div>
    </aside>

</div>

<script>
    // ==================== VARIÁVEIS GLOBAIS ====================
let selectedServiceId = null;
let uploadedFiles = [];
const MAX_FILES = 8;

// ==================== ATUALIZAR STEP INDICATOR ====================
function updateStepIndicator(step) {
    const steps = document.querySelectorAll('.step-item');
    steps.forEach((item, index) => {
        const stepNum = index + 1;
        item.classList.remove('active', 'completed');
        
        if (stepNum < step) {
            item.classList.add('completed');
        } else if (stepNum === step) {
            item.classList.add('active');
        }
    });
    
    const guideTip = document.getElementById('guideTip');
    if (guideTip) {
        const tips = {
            1: '✨ <strong>Dica:</strong> Comece clicando em um serviço na lista ao lado →',
            2: '📋 <strong>Dica:</strong> Verifique os documentos necessários e organize-os antes de enviar',
            3: '✏️ <strong>Dica:</strong> Preencha todos os campos em vermelho (são obrigatórios)',
            4: '📎 <strong>Dica:</strong> Selecione os documentos e clique em Enviar'
        };
        guideTip.innerHTML = `<i class="bi bi-lightbulb"></i> ${tips[step] || tips[1]}`;
    }
}

// ==================== RENDERIZAR CAMPOS DINÂMICOS ====================
function renderDynamicFields(fields) {
    if (!fields || !Array.isArray(fields) || fields.length === 0) {
        return '<div class="alert alert-light border text-center py-4">Nenhum campo adicional necessário para este serviço.</div>';
    }
    
    let html = '<div class="dynamic-fields-wrapper">';
    html += '<div class="alert alert-success py-2 mb-3 small" style="background: #e8f0ec; border-color: #0a2b3e; color: #0a2b3e;"><i class="bi bi-file-text"></i> <strong>Dados específicos do serviço selecionado</strong></div>';
    
    fields.forEach(campo => {
        const obrigatorio = campo.required ? 'required' : '';
        const requiredStar = campo.required ? '<span class="text-danger">*</span>' : '';
        
        html += `<div class="mb-3 dynamic-field">`;
        html += `<label class="form-label">${campo.label} ${requiredStar}</label>`;
        
        switch(campo.type) {
            case 'text':
                html += `<input type="text" class="form-control" name="${campo.name}" placeholder="${campo.placeholder || ''}" ${obrigatorio}>`;
                break;
            case 'number':
                html += `<input type="number" class="form-control" name="${campo.name}" placeholder="${campo.placeholder || ''}" ${obrigatorio} step="any">`;
                break;
            case 'date':
                html += `<input type="date" class="form-control" name="${campo.name}" ${obrigatorio}>`;
                break;
            case 'email':
                html += `<input type="email" class="form-control" name="${campo.name}" placeholder="${campo.placeholder || ''}" ${obrigatorio}>`;
                break;
            case 'tel':
                html += `<input type="tel" class="form-control" name="${campo.name}" placeholder="${campo.placeholder || ''}" ${obrigatorio}>`;
                break;
            case 'select':
                html += `<select class="form-select" name="${campo.name}" ${obrigatorio}>`;
                html += `<option value="">Selecione...</option>`;
                if (Array.isArray(campo.options) && campo.options.length > 0) {
                    campo.options.forEach(op => {
                        html += `<option value="${op}">${op}</option>`;
                    });
                }
                html += `</select>`;
                break;
            case 'textarea':
                html += `<textarea class="form-control" name="${campo.name}" rows="3" placeholder="${campo.placeholder || ''}" ${obrigatorio}></textarea>`;
                break;
            default:
                html += `<input type="text" class="form-control" name="${campo.name}" ${obrigatorio}>`;
        }
        
        html += `</div>`;
    });
    
    html += '</div>';
    return html;
}

// ==================== ATUALIZAR DOCUMENTOS ====================
function updateDocuments(documents, serviceName, instructions) {
    const docsDiv = document.getElementById('docsExplanation');
    const uploadSection = document.getElementById('uploadSection');
    
    if (!docsDiv || !uploadSection) return;
    
    // Garantir que documents seja um array
    let docsArray = [];
    if (Array.isArray(documents)) {
        docsArray = documents;
    } else if (typeof documents === 'string') {
        try {
            const parsed = JSON.parse(documents);
            docsArray = Array.isArray(parsed) ? parsed : [];
        } catch (e) {
            docsArray = [];
        }
    }
    
    if (!docsArray || docsArray.length === 0) {
        // Sem documentos necessários - esconder apenas upload
        uploadSection.style.display = 'none';
        docsDiv.innerHTML = `
            <div class="text-center py-4 text-secondary">
                <i class="bi bi-folder2-open fs-1 d-block mb-2"></i>
                <span>Este serviço não requer documentos específicos</span>
            </div>
        `;
        return;
    }
    
    // Com documentos necessários - mostrar upload
    uploadSection.style.display = 'block';
    
    let docsHtml = `
        <div class="mb-3 pb-2 border-bottom">
            <strong class="fw-bold" style="color: #0a2b3e;">${escapeHtml(serviceName)}</strong>
            <p class="small text-muted mt-1 mb-0">${instructions || 'Envie os documentos abaixo:'}</p>
        </div>
        <ul class="list-unstyled mb-3">
    `;
    
    docsArray.forEach(doc => {
        if (doc && typeof doc === 'string') {
            docsHtml += `<li class="mb-2 d-flex align-items-start gap-2">
                            <i class="bi bi-check-circle-fill mt-1" style="font-size: 0.75rem; color: #1b4f6e;"></i>
                            <span>${escapeHtml(doc)}</span>
                        </li>`;
        }
    });
    
    docsHtml += `</ul>
        <div class="alert alert-warning small mt-2 mb-0 py-2">
            <i class="bi bi-exclamation-triangle"></i>
            <strong>Atenção:</strong> Documentos ilegíveis ou incompletos podem atrasar seu pedido.
        </div>
    `;
    
    docsDiv.innerHTML = docsHtml;
}

// ==================== FUNÇÃO DE ESCAPE HTML ====================
function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ==================== SELECIONAR SERVIÇO ====================
async function selectService(serviceId, serviceName) {
    selectedServiceId = serviceId;
    document.getElementById('selectedServiceId').value = serviceId;
    document.getElementById('selectedServiceName').value = serviceName;
    
    // Atualizar UI dos cards
    document.querySelectorAll('.service-item').forEach(item => {
        item.classList.remove('selected');
        const badge = item.querySelector('.service-check');
        if (badge) badge.style.display = 'none';
    });
    
    const targetItem = document.querySelector(`.service-item[data-id="${serviceId}"]`);
    if (targetItem) {
        targetItem.classList.add('selected');
        const badge = targetItem.querySelector('.service-check');
        if (badge) badge.style.display = 'flex';
    }
    
    // Mostrar loading nos campos dinâmicos
    const dynamicContainer = document.getElementById('dynamicFieldsContainer');
    dynamicContainer.innerHTML = '<div class="text-center py-4"><div class="spinner-border text-primary"></div><p class="mt-2">Carregando campos do serviço...</p></div>';
    
    // Buscar dados do serviço via AJAX
    try {
        const response = await fetch(`/api/registry-services/${serviceId}`);
        const result = await response.json();
        
        if (result.success) {
            const service = result.data;
            
            // Garantir que documentos seja array
            let documentos = [];
            if (Array.isArray(service.documentos)) {
                documentos = service.documentos;
            } else if (typeof service.documentos === 'string') {
                try {
                    const parsed = JSON.parse(service.documentos);
                    documentos = Array.isArray(parsed) ? parsed : [];
                } catch (e) {
                    documentos = [];
                }
            }
            
            // Garantir que camposDinamicos seja array
            let campos = [];
            if (Array.isArray(service.camposDinamicos)) {
                campos = service.camposDinamicos;
            } else if (typeof service.camposDinamicos === 'string') {
                try {
                    const parsed = JSON.parse(service.camposDinamicos);
                    campos = Array.isArray(parsed) ? parsed : [];
                } catch (e) {
                    campos = [];
                }
            }
            
            // Atualizar documentos
            updateDocuments(documentos, service.nome, service.instrucoes);
            
            // Renderizar campos dinâmicos
            dynamicContainer.innerHTML = renderDynamicFields(campos);
            
            updateStepIndicator(3);
        } else {
            dynamicContainer.innerHTML = '<div class="alert alert-danger text-center">Erro ao carregar campos do serviço.</div>';
        }
    } catch (error) {
        console.error('Erro ao carregar serviço:', error);
        dynamicContainer.innerHTML = '<div class="alert alert-danger text-center">Erro ao carregar campos do serviço. Tente novamente.</div>';
    }
}

// ==================== FUNÇÕES DE UPLOAD ====================
function updateFileListUI() {
    const fileListContainer = document.getElementById('fileListContainer');
    const fileListUl = document.getElementById('fileList');
    
    if (!fileListContainer || !fileListUl) return;
    
    if (uploadedFiles.length === 0) {
        fileListContainer.classList.add('d-none');
        return;
    }
    
    fileListContainer.classList.remove('d-none');
    fileListUl.innerHTML = '';
    
    uploadedFiles.forEach((file, idx) => {
        const sizeMB = (file.size / 1024 / 1024).toFixed(2);
        const li = document.createElement('li');
        li.className = 'd-flex justify-content-between align-items-center border-bottom pb-2 mb-2';
        li.innerHTML = `
            <div><i class="bi bi-file-earmark-text me-2"></i> <strong>${escapeHtml(file.name)}</strong> <span class="text-muted small">(${sizeMB} MB)</span></div>
            <button type="button" class="btn btn-sm btn-outline-danger rounded-circle remove-file" data-index="${idx}"><i class="bi bi-x-lg"></i></button>
        `;
        fileListUl.appendChild(li);
    });
    
    document.querySelectorAll('.remove-file').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const index = parseInt(btn.getAttribute('data-index'));
            if (!isNaN(index)) {
                uploadedFiles.splice(index, 1);
                updateFileListUI();
                const fileInput = document.getElementById('fileInput');
                if (fileInput) fileInput.value = '';
                
                if (uploadedFiles.length > 0) {
                    updateStepIndicator(4);
                } else {
                    updateStepIndicator(3);
                }
            }
            e.stopPropagation();
        });
    });
}

function addFiles(files) {
    const fileArray = Array.from(files);
    let addedCount = 0;
    
    for (let f of fileArray) {
        if (uploadedFiles.length >= MAX_FILES) {
            alert(`Máximo de ${MAX_FILES} arquivos permitidos.`);
            break;
        }
        if (!f.type.match('image.*') && !f.type.match('application/pdf')) {
            alert(`Arquivo ${f.name} não é suportado. Use PDF, JPG ou PNG.`);
            continue;
        }
        if (f.size > 10 * 1024 * 1024) {
            alert(`Arquivo ${f.name} excede 10MB.`);
            continue;
        }
        uploadedFiles.push(f);
        addedCount++;
    }
    
    if (addedCount > 0) {
        updateFileListUI();
        updateStepIndicator(4);
    }
}

// ==================== ENVIO DO FORMULÁRIO ====================
async function submitForm(event) {
    event.preventDefault();
    
    const nome = document.getElementById('nomeCompleto').value.trim();
    const email = document.getElementById('email').value.trim();
    const telefone = document.getElementById('telefone').value.trim();
    const servicoId = document.getElementById('selectedServiceId').value;
    
    if (!nome || !email || !telefone) {
        Swal.fire({
            icon: 'warning',
            title: 'Dados incompletos',
            text: 'Por favor, preencha nome, e-mail e telefone.',
            confirmButtonText: 'OK'
        });
        return;
    }
    
    if (!servicoId) {
        Swal.fire({
            icon: 'warning',
            title: 'Serviço não selecionado',
            text: 'Você deve selecionar um serviço para continuar.',
            confirmButtonText: 'OK'
        });
        return;
    }
    
    // Validar campos dinâmicos obrigatórios
    const dynamicFields = document.querySelectorAll('#dynamicFieldsContainer .dynamic-field');
    for (let field of dynamicFields) {
        const requiredInput = field.querySelector('[required]');
        if (requiredInput && !requiredInput.value.trim()) {
            const label = field.querySelector('.form-label')?.innerText || 'Campo';
            Swal.fire({
                icon: 'warning',
                title: 'Campo obrigatório',
                text: `Por favor, preencha o campo "${label.replace('*', '')}".`,
                confirmButtonText: 'OK'
            });
            requiredInput.focus();
            return;
        }
    }
    
    // Validar documentos apenas se a seção de upload estiver visível
    const uploadSection = document.getElementById('uploadSection');
    if (uploadSection && uploadSection.style.display !== 'none' && uploadedFiles.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Documentos não enviados',
            text: 'Envie ao menos um documento para processar a solicitação.',
            confirmButtonText: 'OK'
        });
        return;
    }
    
    // Mostrar loading
    Swal.fire({
        title: 'Processando...',
        html: 'Enviando sua solicitação. Por favor, aguarde.',
        allowOutsideClick: false,
        didOpen: async () => {
            Swal.showLoading();
            
            const formData = new FormData();
            formData.append('nome', nome);
            formData.append('email', email);
            formData.append('telefone', telefone);
            formData.append('servico_id', servicoId);
            
            // Campos dinâmicos
            const dynamicInputs = document.querySelectorAll('#dynamicFieldsContainer input, #dynamicFieldsContainer select, #dynamicFieldsContainer textarea');
            dynamicInputs.forEach(input => {
                if (input.name) {
                    formData.append(input.name, input.value);
                }
            });
            
            // Arquivos
            uploadedFiles.forEach((file, idx) => {
                formData.append(`documento_${idx}`, file);
            });
            
            try {
                const response = await fetch('/api/registry-service-requests', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    Swal.close();
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Solicitação enviada!',
                        html: `
                            <p>Olá, <strong>${escapeHtml(nome)}</strong>! Sua solicitação foi recebida com sucesso.</p>
                            <p>Você enviou <strong>${uploadedFiles.length} arquivo(s)</strong>.</p>
                            <p>Em breve um atendente entrará em contato.</p>
                            <hr>
                            <small class="text-muted">Protocolo: <strong>${result.protocol_number || result.request_id}</strong></small>
                        `,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro ao enviar',
                        text: result.message || 'Ocorreu um erro ao processar sua solicitação.',
                        confirmButtonText: 'OK'
                    });
                }
            } catch (error) {
                console.error('Erro:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Erro de conexão',
                    text: 'Não foi possível enviar sua solicitação. Verifique sua conexão.',
                    confirmButtonText: 'OK'
                });
            }
        }
    });
}

// ==================== INICIALIZAÇÃO ====================
document.addEventListener('DOMContentLoaded', function() {
    // Clique nos serviços
    document.querySelectorAll('.service-item').forEach(item => {
        item.addEventListener('click', () => {
            const id = parseInt(item.getAttribute('data-id'));
            const name = item.getAttribute('data-name');
            selectService(id, name);
        });
    });
    
    // Upload de arquivos
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('fileInput');
    const selectBtn = document.getElementById('selectFilesBtn');
    
    if (dropzone) {
        dropzone.addEventListener('click', () => fileInput.click());
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.style.backgroundColor = '#e9f3ef';
            dropzone.style.borderColor = '#0a2b3e';
        });
        dropzone.addEventListener('dragleave', () => {
            dropzone.style.backgroundColor = '#fafcfb';
            dropzone.style.borderColor = '#cbd5e1';
        });
        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.style.backgroundColor = '#fafcfb';
            dropzone.style.borderColor = '#cbd5e1';
            if (e.dataTransfer.files.length) addFiles(e.dataTransfer.files);
        });
    }
    
    if (selectBtn) {
        selectBtn.addEventListener('click', () => fileInput.click());
    }
    
    if (fileInput) {
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length) addFiles(e.target.files);
            fileInput.value = '';
        });
    }
    
    // Envio do formulário
    const form = document.getElementById('solicitacaoForm');
    if (form) {
        form.addEventListener('submit', submitForm);
    }
    
    // Selecionar primeiro serviço automaticamente
    const firstService = document.querySelector('.service-item');
    if (firstService) {
        const id = parseInt(firstService.getAttribute('data-id'));
        const name = firstService.getAttribute('data-name');
        selectService(id, name);
    }
});
</script>
@endsection
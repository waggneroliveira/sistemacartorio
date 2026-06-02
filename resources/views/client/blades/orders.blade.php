@extends('client.core.client')

@section('content')

<!-- Cabeçalho -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
    <div>
        <h1 class="display-6 fw-bold" style="color: #1a3e2f;">Meus Pedidos</h1>
        <p class="text-secondary">Acompanhe o status e histórico das suas solicitações</p>
    </div>
    <a href="{{ route('index') }}" class="btn btn-outline-success rounded-pill mt-2 mt-md-0">
        <i class="bi bi-plus-circle"></i> Nova solicitação
    </a>
</div>

<!-- Cards de estatísticas -->
<div class="row g-3 mb-5">
    <div class="col-sm-6 col-lg-3">
        <div class="stats-card p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-secondary small">Total de pedidos</span>
                    <h2 class="mb-0 fw-bold" id="totalPedidos">0</h2>
                </div>
                <i class="bi bi-files fs-1 text-success opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="stats-card p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-secondary small">Em andamento</span>
                    <h2 class="mb-0 fw-bold text-primary" id="emAndamentoCount">0</h2>
                </div>
                <i class="bi bi-hourglass-split fs-1 text-primary opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="stats-card p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-secondary small">Concluídos</span>
                    <h2 class="mb-0 fw-bold text-success" id="concluidosCount">0</h2>
                </div>
                <i class="bi bi-check2-circle fs-1 text-success opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="stats-card p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-secondary small">Aguardando pagamento</span>
                    <h2 class="mb-0 fw-bold text-warning" id="aguardandoPagamentoCount">0</h2>
                </div>
                <i class="bi bi-credit-card fs-1 text-warning opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<!-- Filtros e busca -->
<div class="row g-3 mb-4 align-items-center">
    <div class="col-md-5">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0 rounded-start-pill"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control search-box border-start-0 rounded-end-pill" id="searchInput" placeholder="Buscar por serviço, protocolo...">
        </div>
    </div>
    <div class="col-md-7">
        <div class="d-flex flex-wrap gap-2">
            <button class="btn btn-outline-secondary filter-btn active" data-filter="todos">Todos</button>
            <button class="btn btn-outline-secondary filter-btn" data-filter="pendente">📋 Pendente</button>
            <button class="btn btn-outline-secondary filter-btn" data-filter="analise">🔍 Em análise</button>
            <button class="btn btn-outline-secondary filter-btn" data-filter="aguardando_pagamento">💰 Aguardando pagamento</button>
            <button class="btn btn-outline-secondary filter-btn" data-filter="andamento">⚙️ Em andamento</button>
            <button class="btn btn-outline-secondary filter-btn" data-filter="concluido">✅ Concluído</button>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Coluna da esquerda: Lista de pedidos -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h5 class="mb-0 fw-semibold"><i class="bi bi-list-ul"></i> Histórico de solicitações</h5>
            </div>
            <div class="card-body p-3" id="ordersListContainer">
                <div class="text-center py-4" id="loadingOrders">
                    <div class="spinner-border text-success" role="status"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Coluna da direita: Detalhes e acompanhamento -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 90px;">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h5 class="mb-0 fw-semibold"><i class="bi bi-info-circle"></i> Detalhes e acompanhamento</h5>
            </div>
            <div class="card-body p-4" id="orderDetailContainer">
                <div class="text-center py-5 text-secondary">
                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                    <p>Selecione um pedido ao lado para visualizar os detalhes completos, documentos e linha do tempo.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Pagamento -->
<div class="modal fade" id="paymentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-credit-card me-2"></i>Pagamento do Pedido
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="paymentModalBody">
                <!-- Conteúdo dinâmico do pagamento -->
            </div>
        </div>
    </div>
</div>

<script>
// ==================== DADOS REAIS DO BACKEND ====================
const requests = @json($requests ?? []);
let currentFilter = "todos";
let currentSearch = "";
let selectedOrderId = null;

// Helper: obter classe de cor do status
function getStatusClass(status) {
    const statusInfo = getStatusInfo();
    if (statusInfo[status]) {
        return `status-${statusInfo[status].color}`;
    }
    
    const classes = {
        'pendente': 'status-warning',
        'analise': 'status-info',
        'aguardando_pagamento': 'status-warning',
        'andamento': 'status-primary',
        'concluido': 'status-success',
        'cancelado': 'status-danger',
        'rejected': 'status-danger'
    };
    return classes[status] || 'status-warning';
}

function getStatusIcon(status) {
    const statusInfo = getStatusInfo();
    if (statusInfo[status]) {
        return statusInfo[status].icon;
    }
    
    const icons = {
        'pendente': 'bi-clock',
        'analise': 'bi-search',
        'aguardando_pagamento': 'bi-credit-card',
        'andamento': 'bi-gear',
        'concluido': 'bi-check-circle',
        'cancelado': 'bi-x-circle',
        'rejected': 'bi-x-circle'
    };
    return icons[status] || 'bi-question-circle';
}

// Helper: formatação de data
function formatDate(dateStr) {
    if (!dateStr) return 'Data não informada';
    const date = new Date(dateStr);
    return date.toLocaleDateString('pt-BR');
}

// Formatar valor monetário
function formatMoney(value) {
    if (!value && value !== 0) return 'R$ 0,00';
    return value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
}

// Renderizar lista de pedidos com filtros
function renderOrdersList() {
    if (!requests || requests.length === 0) {
        const container = document.getElementById('ordersListContainer');
        container.innerHTML = `
            <div class="text-center py-5">
                <i class="bi bi-folder2-open fs-1 text-secondary"></i>
                <p class="mt-2 text-secondary">Você ainda não possui solicitações.</p>
                <a href="{{ route('index') }}" class="btn btn-sm btn-success mt-2">
                    <i class="bi bi-plus-circle"></i> Fazer Solicitação
                </a>
            </div>
        `;
        return;
    }

    let filtered = requests.filter(request => {
        if (currentFilter !== "todos" && request.status !== currentFilter && request.statusTexto !== currentFilter) return false;
        if (currentSearch) {
            const searchLower = currentSearch.toLowerCase();
            return request.protocolo.toLowerCase().includes(searchLower) ||
                   request.servico.toLowerCase().includes(searchLower) ||
                   request.descricao.toLowerCase().includes(searchLower);
        }
        return true;
    });

    filtered.sort((a, b) => new Date(b.dataSolicitacao) - new Date(a.dataSolicitacao));

    const container = document.getElementById('ordersListContainer');
    if (filtered.length === 0) {
        container.innerHTML = `
            <div class="text-center py-5">
                <i class="bi bi-folder2-open fs-1 text-secondary"></i>
                <p class="mt-2 text-secondary">Nenhum pedido encontrado com os filtros atuais.</p>
            </div>
        `;
        return;
    }

    container.innerHTML = filtered.map(request => `
        <div class="order-card p-3 mb-2 ${selectedOrderId === request.id ? 'selected' : ''}" 
             data-order-id="${request.id}">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <span class="fw-bold">${request.servico}</span>
                    <br>
                    <small class="text-muted">Protocolo: ${request.protocolo}</small>
                </div>
                <span class="status-badge ${getStatusClass(request.status)}">
                    <i class="bi ${getStatusIcon(request.status)}"></i> ${request.statusTexto}
                </span>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2">
                <small class="text-muted"><i class="bi bi-calendar3"></i> ${formatDate(request.dataSolicitacao)}</small>
                <small class="text-success">${request.status === 'pending' ? formatMoney(request.valor) : 'Ver detalhes →'}</small>
            </div>
        </div>
    `).join('');

    document.querySelectorAll('.order-card').forEach(card => {
        card.addEventListener('click', () => {
            const orderId = parseInt(card.getAttribute('data-order-id'));
            selectOrder(orderId);
        });
    });
}

// Atualizar estatísticas
function updateStats() {
    if (!requests || requests.length === 0) {
        document.getElementById('totalPedidos').textContent = '0';
        document.getElementById('emAndamentoCount').textContent = '0';
        document.getElementById('concluidosCount').textContent = '0';
        document.getElementById('aguardandoPagamentoCount').textContent = '0';
        return;
    }
    
    const total = requests.length;
    const emAndamento = requests.filter(r => r.status === 'in_progress' || r.status === 'awaiting_documents' || r.status === 'documents_approved').length;
    const concluidos = requests.filter(r => r.status === 'completed').length;
    const aguardandoPagamento = requests.filter(r => r.status === 'pending').length;
    
    const totalEl = document.getElementById('totalPedidos');
    const emAndamentoEl = document.getElementById('emAndamentoCount');
    const concluidosEl = document.getElementById('concluidosCount');
    const aguardandoEl = document.getElementById('aguardandoPagamentoCount');
    
    if (totalEl) totalEl.textContent = total;
    if (emAndamentoEl) emAndamentoEl.textContent = emAndamento;
    if (concluidosEl) concluidosEl.textContent = concluidos;
    if (aguardandoEl) aguardandoEl.textContent = aguardandoPagamento;
}

// Função de Pagamento
function abrirPagamento(request) {
    const modalBody = document.getElementById('paymentModalBody');
    let metodoSelecionado = null;
    
    modalBody.innerHTML = `
        <div class="payment-container">
            <div class="text-center mb-4">
                <i class="bi bi-receipt fs-1 text-success"></i>
                <h4>Pagamento do Pedido</h4>
                <p class="text-muted">Protocolo: ${request.protocolo}</p>
            </div>
            
            <div class="payment-card">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <strong>${request.servico}</strong>
                        <p class="text-muted small mb-0">${request.descricao.substring(0, 100)}</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="payment-value">${formatMoney(request.valor)}</div>
                        <small>em até 12x no cartão</small>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <label class="fw-bold mb-2">Selecione a forma de pagamento:</label>
                <div class="payment-methods">
                    <div class="payment-method-btn" data-metodo="cartao">
                        <i class="bi bi-credit-card-2-front"></i>
                        <small>Cartão</small>
                    </div>
                    <div class="payment-method-btn" data-metodo="pix">
                        <i class="bi bi-qr-code"></i>
                        <small>PIX (5% OFF)</small>
                    </div>
                    <div class="payment-method-btn" data-metodo="boleto">
                        <i class="bi bi-receipt"></i>
                        <small>Boleto</small>
                    </div>
                </div>
            </div>
            
            <div id="paymentDetailsForm" class="mt-4"></div>
            
            <div class="alert alert-info mt-3">
                <i class="bi bi-shield-check"></i> 
                Ambiente 100% seguro com criptografia SSL
            </div>
        </div>
    `;
    
    const methods = modalBody.querySelectorAll('.payment-method-btn');
    methods.forEach(btn => {
        btn.addEventListener('click', () => {
            methods.forEach(b => b.classList.remove('selected'));
            btn.classList.add('selected');
            metodoSelecionado = btn.getAttribute('data-metodo');
            mostrarFormularioPagamento(metodoSelecionado, request, modalBody);
        });
    });
    
    const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
    modal.show();
}

function mostrarFormularioPagamento(metodo, request, container) {
    const formContainer = container.querySelector('#paymentDetailsForm');
    const valorComDesconto = metodo === 'pix' ? request.valor * 0.95 : request.valor;
    
    let html = '';
    
    if (metodo === 'cartao') {
        html = `
            <div class="card p-3">
                <h6 class="mb-3">Dados do Cartão</h6>
                <div class="mb-3">
                    <label class="form-label small">Número do cartão</label>
                    <input type="text" class="form-control" id="cardNumber" placeholder="0000 0000 0000 0000" maxlength="19">
                </div>
                <div class="mb-3">
                    <label class="form-label small">Nome no cartão</label>
                    <input type="text" class="form-control" placeholder="Como está no cartão">
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label small">Validade</label>
                        <input type="text" class="form-control" placeholder="MM/AA">
                    </div>
                    <div class="col-6">
                        <label class="form-label small">CVV</label>
                        <input type="password" class="form-control" placeholder="123" maxlength="4">
                    </div>
                </div>
                <div class="mt-3">
                    <label class="form-label small">Parcelamento</label>
                    <select class="form-select">
                        <option value="1">1x de ${formatMoney(valorComDesconto)}</option>
                        <option value="2">2x de ${formatMoney(valorComDesconto/2)}</option>
                        <option value="3">3x de ${formatMoney(valorComDesconto/3)}</option>
                        <option value="4">4x de ${formatMoney(valorComDesconto/4)}</option>
                        <option value="5">5x de ${formatMoney(valorComDesconto/5)}</option>
                        <option value="6">6x de ${formatMoney(valorComDesconto/6)}</option>
                    </select>
                </div>
                <button class="btn-pagar mt-3" onclick="confirmarPagamento(${request.id}, 'cartao', ${valorComDesconto})">
                    <i class="bi bi-lock-fill"></i> Pagar ${formatMoney(valorComDesconto)}
                </button>
            </div>
        `;
    } else if (metodo === 'pix') {
        html = `
            <div class="card p-3 text-center">
                <div class="pix-discount-badge mb-3">
                    <i class="bi bi-tag-fill"></i> Desconto de 5% aplicado!
                </div>
                <div class="qrcode-placeholder mb-3">
                    <i class="bi bi-qr-code" style="font-size: 100px;"></i>
                    <p class="small">Escaneie o QR Code pelo seu banco</p>
                </div>
                <div class="pix-info">
                    <div class="small text-muted">Chave PIX (CNPJ)</div>
                    <strong>12.345.678/0001-90</strong>
                </div>
                <button class="btn-pagar mt-3" onclick="confirmarPagamento(${request.id}, 'pix', ${valorComDesconto})">
                    <i class="bi bi-check-circle"></i> Simular Pagamento PIX
                </button>
            </div>
        `;
    } else if (metodo === 'boleto') {
        html = `
            <div class="card p-3 text-center">
                <i class="bi bi-receipt" style="font-size: 60px; color: #1976d2;"></i>
                <h6 class="mt-2">Boleto Bancário</h6>
                <p class="small text-muted">Vencimento em 3 dias úteis</p>
                <button class="btn-pagar mt-2" onclick="confirmarPagamento(${request.id}, 'boleto', ${valorComDesconto})">
                    <i class="bi bi-file-pdf"></i> Gerar Boleto
                </button>
            </div>
        `;
    }
    
    formContainer.innerHTML = html;
    
    const cardNumber = document.getElementById('cardNumber');
    if (cardNumber) {
        cardNumber.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
            e.target.value = value.substring(0, 19);
        });
    }
}

function confirmarPagamento(requestId, metodo, valor) {
    const request = requests.find(r => r.id === requestId);
    if (!request) return;
    
    // Atualizar status do pedido
    request.status = 'in_progress';
    request.statusTexto = 'Em andamento';
    request.pagamento = {
        status: 'pago',
        data: new Date().toISOString().split('T')[0],
        metodo: metodo,
        valor: valor
    };
    
    // Adicionar ao histórico
    if (!request.historico) request.historico = [];
    request.historico.unshift({
        data: new Date().toLocaleString('pt-BR'),
        status: 'Pagamento confirmado',
        descricao: `Pagamento de ${formatMoney(valor)} via ${metodo.toUpperCase()} confirmado`
    });
    
    // Fechar modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
    if (modal) modal.hide();
    
    // Atualizar a lista e estatísticas
    renderOrdersList();
    updateStats();
    
    // Recarregar detalhes do pedido se for o selecionado
    if (selectedOrderId === requestId) {
        renderOrderDetails(request);
    }
    
    // Mostrar mensagem de sucesso
    alert(`✅ Pagamento confirmado!\n\nPedido: ${request.protocolo}\nValor: ${formatMoney(valor)}\nMétodo: ${metodo.toUpperCase()}\n\nSeu pedido agora está em análise.`);
}

// Selecionar pedido e exibir detalhes
function selectOrder(orderId) {
    selectedOrderId = orderId;
    const request = requests.find(r => r.id === orderId);
    if (!request) return;
    
    renderOrdersList();
    renderOrderDetails(request);
}

// Renderizar detalhes do pedido selecionado
function renderOrderDetails(request) {
    const container = document.getElementById('orderDetailContainer');
    
    const progressPercent = getTimelineProgress(request.status);
    const statusInfo = getStatusInfo();
    const currentStatusInfo = statusInfo[request.status] || statusInfo['pending'];
    
    // Garantir que documentos existe
    const documentos = request.documentos || [];
    
    // Garantir que campos adicionais existe
    const camposAdicionais = request.camposAdicionais || {};
    
    // Garantir que notas internas existem
    const internalNotes = request.internalNotes || [];
    
    // Garantir que histórico existe
    let historico = request.historico || [];
    
    // Ordenar o histórico por data (do mais antigo para o mais recente)
    historico.sort((a, b) => {
        const dateA = parseDateString(a.data);
        const dateB = parseDateString(b.data);
        return dateB - dateA;
    });
    
    // Construir a timeline com todos os status
    const allStatuses = ['pending', 'in_progress', 'awaiting_documents', 'documents_approved', 'awaiting_payment', 'completed'];
    const currentStatusIndex = allStatuses.indexOf(request.status);
    
    const timelineHtml = `
        <div class="timeline-container">
            ${allStatuses.map((status, idx) => {
                const info = statusInfo[status];
                const isCompleted = idx < currentStatusIndex || (idx === currentStatusIndex && request.status !== 'rejected');
                const isCurrent = idx === currentStatusIndex && request.status !== 'rejected';
                const isRejected = request.status === 'rejected';
                
                return `
                    <div class="timeline-step d-flex gap-3">
                        <div class="timeline-icon ${isCompleted ? 'completed' : isCurrent ? 'active' : ''}" 
                             style="${isRejected && idx >= currentStatusIndex ? 'opacity: 0.5;' : ''}">
                            <i class="bi ${info.icon} small"></i>
                        </div>
                        <div class="flex-grow-1" style="${isRejected && idx >= currentStatusIndex ? 'opacity: 0.6;' : ''}">
                            <div class="d-flex justify-content-between flex-wrap gap-2">
                                <strong>${info.label}</strong>
                                ${isCurrent ? '<span class="d-flex align-items-center justify-content-center text-primary fw-semibold"> <i class="fas fa-circle-check me-1"></i> Atual </span>' : ''}
                                ${isCompleted && !isCurrent ? '<span class="d-flex align-items-center justify-content-center text-success"> <i class="fas fa-check-circle me-1"></i> Concluído </span>' : ''}
                            </div>
                            <p class="mb-0 small text-secondary">${info.description}</p>
                        </div>                        
                    </div>
                    ${idx !== allStatuses.length - 1 ? '<div class="timeline-connector" style="' + (isRejected && idx >= currentStatusIndex ? 'background: rgba(0,0,0,0.1);' : '') + '"></div>' : ''}
                `;
            }).join('')}
        </div>
    `;
    
    const html = `
        <div class="fade-in">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h4 class="fw-bold">${request.servico}</h4>
                    <p class="text-muted mb-0">Protocolo: ${request.protocolo}</p>
                    <p class="text-muted small"><i class="bi bi-calendar"></i> Solicitado em: ${formatDate(request.dataSolicitacao)}</p>
                </div>
                <span class="status-badge ${getStatusClass(request.status)} fs-6">
                    <i class="bi ${getStatusIcon(request.status)}"></i> ${request.statusTexto}
                </span>
            </div>
            
            ${request.status === 'awaiting_payment' ? `
                <div class="payment-required-card mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <i class="bi bi-credit-card fs-3 text-warning"></i>
                            <strong class="ms-2">Pagamento pendente</strong>
                            <p class="mb-0 small text-muted mt-1">Efetue o pagamento para dar continuidade ao seu pedido</p>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold text-success fs-4">${formatMoney(request.valor)}</div>
                            <button class="btn-pagar mt-2" onclick="abrirPagamento(${JSON.stringify(request).replace(/"/g, '&quot;')})">
                                <i class="bi bi-lock-fill"></i> Realizar Pagamento
                            </button>
                        </div>
                    </div>
                </div>
            ` : ''}
            
            <div class="mb-4">
                <div class="d-flex justify-content-between mb-1">
                    <small>Progresso</small>
                    <small class="text-success">${Math.round(progressPercent)}%</small>
                </div>
                <div class="progress" style="height: 8px; border-radius: 10px;">
                    <div class="progress-bar bg-success" style="width: ${progressPercent}%; border-radius: 10px;"></div>
                </div>
            </div>
            
            ${request.pagamento && request.pagamento.status === 'pago' ? `
                <div class="detail-card">
                    <h6 class="fw-bold mb-2"><i class="bi bi-receipt"></i> Informações do Pagamento</h6>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <small class="text-muted">Valor pago</small>
                            <div class="fw-bold">${formatMoney(request.pagamento.valor || request.valor)}</div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Método</small>
                            <div>${request.pagamento.metodo ? request.pagamento.metodo.toUpperCase() : '-'}</div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Data do pagamento</small>
                            <div>${request.pagamento.data || '-'}</div>
                        </div>
                    </div>
                </div>
            ` : ''}
            
            <div class="detail-card">
                <h6 class="fw-bold mb-2"><i class="bi bi-person-circle"></i> Dados do cliente</h6>
                <div class="row">
                    <div class="col-md-6">
                        <small class="text-muted">Nome</small>
                        <p class="mb-0 fw-bold">${request.clienteNome || 'Não informado'}</p>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Email</small>
                        <p class="mb-0 fw-bold">${request.clienteEmail || 'Não informado'}</p>
                    </div>
                    <div class="col-md-6 mt-2">
                        <small class="text-muted">Telefone</small>
                        <p class="mb-0 fw-bold">${request.clienteTelefone || 'Não informado'}</p>
                    </div>
                </div>
            </div>
            
            <div class="detail-card">
                <h6 class="fw-bold mb-2"><i class="bi bi-card-text"></i> Descrição</h6>
                <p class="mb-0">${request.descricao || 'Sem descrição'}</p>
            </div>
            
            ${documentos.length > 0 ? `
                <div class="detail-card">
                    <h6 class="fw-bold mb-2"><i class="bi bi-file-earmark-text"></i> Documentos enviados</h6>
                    <div class="d-flex flex-wrap">
                        ${documentos.map(doc => {
                            const docName = typeof doc === 'string' ? doc : (doc.original_name || 'documento.pdf');
                            return `<span class="file-tag"><i class="bi bi-file-earmark-check text-success"></i> ${docName}</span>`;
                        }).join('')}
                    </div>
                </div>
            ` : ''}
            
            ${Object.keys(camposAdicionais).length > 0 ? `
                <div class="detail-card">
                    <h6 class="fw-bold mb-2"><i class="bi bi-info-square"></i> Informações adicionais</h6>
                    <div class="row g-2">
                        ${Object.entries(camposAdicionais).map(([key, value]) => `
                            <div class="col-12">
                                <small class="text-muted">${formatLabel(key)}:</small>
                                <span class="ms-2">${typeof value === 'object' ? JSON.stringify(value) : value}</span>
                            </div>
                        `).join('')}
                    </div>
                </div>
            ` : ''}
            
            <!-- Notas Internas do Cartório -->
            ${internalNotes.length > 0 ? `
                <div class="detail-card">
                    <h6 class="fw-bold mb-3"><i class="bi bi-chat-left-text"></i> Comunicados do Cartório</h6>
                    <div class="notes-container">
                        ${internalNotes.map((note, idx) => `
                            <div class="note-item p-3 mb-2 bg-light rounded-3" style="border-left: 4px solid #007bff;">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <strong class="text-primary">${note.user_name || 'Cartório'}</strong>
                                    <small class="text-muted">${note.timestamp ? new Date(note.timestamp).toLocaleDateString('pt-BR', {
                                        year: 'numeric',
                                        month: '2-digit',
                                        day: '2-digit',
                                        hour: '2-digit',
                                        minute: '2-digit'
                                    }) : 'Data não informada'}</small>
                                </div>
                                <p class="mb-0 text-secondary">${note.text || note}</p>
                            </div>
                        `).join('')}
                    </div>
                </div>
            ` : ''}
            
            <!-- Timeline com todos os status -->
            <div class="detail-card">
                <h6 class="fw-bold mb-3"><i class="bi bi-clock-history"></i> Linha do tempo de progresso</h6>
                ${timelineHtml}
            </div>
            
            ${historico.length > 0 ? `
                <div class="detail-card">
                    <h6 class="fw-bold mb-3"><i class="bi bi-list-check"></i> Histórico de eventos</h6>
                    <div class="timeline-container">
                        ${historico.map((item, idx) => `
                            <div class="timeline-step d-flex gap-3">
                                <div class="timeline-icon completed">
                                    <i class="bi bi-check2 small"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <strong>${item.status}</strong>
                                        <small class="text-muted">${item.data}</small>
                                    </div>
                                    <p class="mb-2 small text-secondary">${item.descricao}</p>
                                </div>
                            </div>
                            ${idx !== historico.length-1 ? '<div class="timeline-connector"></div>' : ''}
                        `).join('')}
                    </div>
                </div>
            ` : ''}
        </div>
    `;
    
    container.innerHTML = html;
}

// Função auxiliar para converter string de data para objeto Date
function parseDateString(dateStr) {
    // Tenta diferentes formatos de data
    // Formato: DD/MM/YYYY HH:MM ou DD/MM/YYYY
    if (dateStr.includes('/')) {
        const parts = dateStr.split(/[\s\/:]+/);
        if (parts.length >= 3) {
            // Formato brasileiro: dia/mês/ano
            const day = parseInt(parts[0]);
            const month = parseInt(parts[1]) - 1;
            const year = parseInt(parts[2]);
            const hour = parts.length > 3 ? parseInt(parts[3]) : 0;
            const minute = parts.length > 4 ? parseInt(parts[4]) : 0;
            return new Date(year, month, day, hour, minute);
        }
    }
    
    // Tenta formato ISO
    const isoDate = new Date(dateStr);
    if (!isNaN(isoDate.getTime())) {
        return isoDate;
    }
    
    // Se não conseguir, retorna data atual
    return new Date();
}

// Mapa de status do BD para informações de timeline
function getStatusInfo() {
    return {
        'pending': {
            label: 'Pendente',
            icon: 'bi-clock',
            color: 'warning',
            description: 'Solicitação recebida e aguardando processamento'
        },
        'in_progress': {
            label: 'Em Andamento',
            icon: 'bi-hourglass-split',
            color: 'primary',
            description: 'Seu pedido está sendo processado'
        },
        'awaiting_payment': {
            label: 'Aguardando Pagamento',
            icon: 'bi-credit-card',
            color: 'warning',
            description: 'Aguardando confirmação do pagamento'
        },
        'awaiting_documents': {
            label: 'Aguardando Documentos',
            icon: 'bi-file-earmark-arrow-down',
            color: 'info',
            description: 'Documentos foram solicitados'
        },
        'documents_approved': {
            label: 'Documentos Aprovados',
            icon: 'bi-check-circle',
            color: 'success',
            description: 'Documentos foram analisados e aprovados'
        },
        'completed': {
            label: 'Concluído',
            icon: 'bi-check2-circle',
            color: 'success',
            description: 'Seu pedido foi concluído com sucesso'
        },
        'rejected': {
            label: 'Rejeitado',
            icon: 'bi-x-circle',
            color: 'danger',
            description: 'Sua solicitação foi rejeitada'
        }
    };
}

// Determinar progresso na timeline
function getTimelineProgress(currentStatus) {
    const statusOrder = ['pending', 'in_progress', 'awaiting_documents', 'documents_approved', 'awaiting_payment', 'completed'];
    const currentIndex = statusOrder.indexOf(currentStatus);
    
    return currentIndex >= 0 ? ((currentIndex + 1) / statusOrder.length) * 100 : 20;
}

function formatLabel(key) {
    const labels = {
        tipoCertidao: "Tipo de certidão",
        nomeMae: "Nome da mãe",
        dataNascimento: "Data de nascimento",
        nomeComprador: "Comprador",
        valorVenda: "Valor da venda",
        enderecoImovel: "Endereço do imóvel",
        tipoReconhecimento: "Tipo de reconhecimento",
        documentoReconhecer: "Documento",
        nomeConjuge1: "Cônjuge 1",
        nomeConjuge2: "Cônjuge 2",
        dataCasamento: "Data do casamento",
        nomeFalecido: "Falecido",
        dataObito: "Data do óbito",
        numeroHerdeiros: "Nº de herdeiros",
        quantidadeDocs: "Quantidade de documentos",
        tipoAutenticacao: "Tipo de autenticação"
    };
    return labels[key] || key;
}

// Eventos de filtro e busca
function initFilters() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    if (filterBtns.length > 0) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentFilter = btn.getAttribute('data-filter');
                renderOrdersList();
            });
        });
    }
    
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            currentSearch = e.target.value;
            renderOrdersList();
        });
    }
}

// Inicialização
function init() {
    if (requests && requests.length > 0) {
        renderOrdersList();
        updateStats();
        initFilters();
        selectOrder(requests[0].id);
    } else {
        const container = document.getElementById('ordersListContainer');
        if (container) {
            container.innerHTML = `
                <div class="text-center py-5">
                    <i class="bi bi-folder2-open fs-1 text-secondary"></i>
                    <p class="mt-2 text-secondary">Você ainda não possui solicitações.</p>
                    <a href="{{ route('index') }}" class="btn btn-sm btn-success mt-2">
                        <i class="bi bi-plus-circle"></i> Fazer Solicitação
                    </a>
                </div>
            `;
        }
        updateStats();
    }
}

// Aguardar o DOM carregar
document.addEventListener('DOMContentLoaded', init);
</script>

@endsection
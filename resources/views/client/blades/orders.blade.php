@extends('client.core.client')

@section('content')

<!-- Cabeçalho -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
    <div>
        <h1 class="display-6 fw-bold" style="color: #1a3e2f;">Meus Pedidos</h1>
        <p class="text-secondary">Acompanhe o status e histórico das suas solicitações</p>
    </div>
    <a href="#" class="btn btn-outline-success rounded-pill mt-2 mt-md-0">
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

<style>
/* Estilos adicionais para o botão de pagamento */
.btn-pagar {
    background: linear-gradient(135deg, #1a5c42, #0a2b1f);
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
    width: 100%;
}

.btn-pagar:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(26,92,66,0.3);
}

.payment-card {
    background: #f8fbf9;
    border-radius: 15px;
    padding: 20px;
    margin-top: 20px;
}

.payment-value {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1a5c42;
}

.payment-methods {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 10px;
    margin-top: 15px;
}

.payment-method-btn {
    background: white;
    border: 2px solid #e0e8e4;
    border-radius: 12px;
    padding: 10px;
    cursor: pointer;
    transition: all 0.3s;
    text-align: center;
}

.payment-method-btn:hover {
    border-color: #1a5c42;
    background: #f0f7f3;
}

.payment-method-btn.selected {
    border-color: #1a5c42;
    background: #1a5c42;
    color: white;
}

.payment-method-btn i {
    font-size: 1.5rem;
    display: block;
    margin-bottom: 5px;
}
</style>

<script>
// ==================== DADOS MOCKADOS DE PEDIDOS COM VALORES ====================
let pedidos = [
    {
        id: 1001,
        protocolo: "CART-28471",
        servico: "Certidão de Nascimento",
        dataSolicitacao: "2025-04-28",
        status: "concluido",
        statusTexto: "Concluído",
        valor: 89.90,
        descricao: "2ª via de certidão de nascimento - solicitante: Maria Silva",
        documentos: ["RG_front.pdf", "CPF.png", "comprovante_endereco.pdf"],
        pagamento: { status: "pago", data: "2025-04-28", metodo: "cartao" },
        historico: [
            { data: "2025-04-28 09:23", status: "Solicitação recebida", descricao: "Pedido criado com sucesso" },
            { data: "2025-04-28 14:15", status: "Pagamento confirmado", descricao: "Pagamento aprovado" },
            { data: "2025-04-29 10:00", status: "Documentos em análise", descricao: "Documentos recebidos e em validação" },
            { data: "2025-04-30 16:20", status: "Em processamento", descricao: "Certidão sendo emitida pelo cartório" },
            { data: "2025-05-02 11:45", status: "Concluído", descricao: "Certidão disponível para retirada/envio" }
        ],
        camposAdicionais: { tipoCertidao: "2ª Via", nomeMae: "Ana Silva", dataNascimento: "15/03/1990" }
    },
    {
        id: 1002,
        protocolo: "CART-29102",
        servico: "Escritura de Compra e Venda",
        dataSolicitacao: "2025-05-10",
        status: "andamento",
        statusTexto: "Em andamento",
        valor: 450.00,
        descricao: "Escritura de imóvel - comprador: João Santos",
        documentos: ["rg_joao.pdf", "cpf_joao.pdf", "matricula_imovel.pdf", "comprovante_iptu.pdf"],
        pagamento: { status: "pago", data: "2025-05-10", metodo: "pix" },
        historico: [
            { data: "2025-05-10 08:30", status: "Solicitação recebida", descricao: "Pedido criado" },
            { data: "2025-05-10 08:45", status: "Pagamento confirmado", descricao: "Pagamento via PIX aprovado" },
            { data: "2025-05-11 09:45", status: "Documentos em análise", descricao: "Documentos sendo verificados pelo cartório" },
            { data: "2025-05-13 14:20", status: "Em andamento", descricao: "Análise jurídica da escritura iniciada" }
        ],
        camposAdicionais: { nomeComprador: "João Santos", valorVenda: "320.000", enderecoImovel: "Rua das Flores, 123 - Centro" }
    },
    {
        id: 1003,
        protocolo: "CART-30567",
        servico: "Reconhecimento de Firma",
        dataSolicitacao: "2025-05-15",
        status: "aguardando_pagamento",
        statusTexto: "Aguardando pagamento",
        valor: 35.90,
        descricao: "Reconhecimento de firma em contrato de aluguel",
        documentos: ["documento_reconhecer.pdf", "rg_requerente.jpg"],
        pagamento: { status: "pendente" },
        historico: [
            { data: "2025-05-15 10:15", status: "Solicitação recebida", descricao: "Pedido criado aguardando pagamento" }
        ],
        camposAdicionais: { tipoReconhecimento: "Por semelhança", documentoReconhecer: "Contrato de aluguel residencial" }
    },
    {
        id: 1004,
        protocolo: "CART-29834",
        servico: "Certidão de Casamento",
        dataSolicitacao: "2025-05-05",
        status: "analise",
        statusTexto: "Em análise",
        valor: 89.90,
        descricao: "2ª via de certidão de casamento - casamento realizado em 2018",
        documentos: ["rg_conjuge1.jpg", "rg_conjuge2.jpg", "comprovante_residencia.pdf"],
        pagamento: { status: "pago", data: "2025-05-05", metodo: "boleto" },
        historico: [
            { data: "2025-05-05 11:20", status: "Solicitação recebida", descricao: "Pedido registrado" },
            { data: "2025-05-06 09:30", status: "Pagamento confirmado", descricao: "Boleto compensado" },
            { data: "2025-05-06 10:00", status: "Em análise", descricao: "Documentos sendo verificados" }
        ],
        camposAdicionais: { nomeConjuge1: "Carlos Alberto", nomeConjuge2: "Fernanda Lima", dataCasamento: "12/10/2018" }
    },
    {
        id: 1005,
        protocolo: "CART-31245",
        servico: "Abertura de Inventário",
        dataSolicitacao: "2025-05-18",
        status: "aguardando_pagamento",
        statusTexto: "Aguardando pagamento",
        valor: 580.00,
        descricao: "Inventário extrajudicial - falecido: José Oliveira",
        documentos: ["certidao_obito.pdf", "rg_herdeiros.pdf"],
        pagamento: { status: "pendente" },
        historico: [
            { data: "2025-05-18 15:45", status: "Solicitação recebida", descricao: "Aguardando pagamento para iniciar processo" }
        ],
        camposAdicionais: { nomeFalecido: "José Oliveira", dataObito: "10/05/2025", numeroHerdeiros: "3" }
    },
    {
        id: 1006,
        protocolo: "CART-32088",
        servico: "Certidão de Nascimento",
        dataSolicitacao: "2025-05-20",
        status: "concluido",
        statusTexto: "Concluído",
        valor: 89.90,
        descricao: "1ª via de certidão de nascimento - recém-nascido",
        documentos: ["declaracao_nascido.pdf", "rg_mae.pdf", "cpf_mae.pdf"],
        pagamento: { status: "pago", data: "2025-05-20", metodo: "cartao" },
        historico: [
            { data: "2025-05-20 07:30", status: "Solicitação recebida", descricao: "Pedido criado" },
            { data: "2025-05-20 07:35", status: "Pagamento confirmado", descricao: "Pagamento aprovado" },
            { data: "2025-05-20 13:20", status: "Documentos em análise", descricao: "Documentos validados com sucesso" },
            { data: "2025-05-21 10:00", status: "Concluído", descricao: "Certidão emitida e enviada por e-mail" }
        ],
        camposAdicionais: { tipoCertidao: "1ª Via", nomeMae: "Patrícia Souza", dataNascimento: "18/05/2025" }
    },
    {
        id: 1007,
        protocolo: "CART-32599",
        servico: "Autenticação de Documentos",
        dataSolicitacao: "2025-05-22",
        status: "aguardando_pagamento",
        statusTexto: "Aguardando pagamento",
        valor: 25.90,
        descricao: "Autenticação de cópias de documentos pessoais",
        documentos: ["rg_copia.pdf", "cpf_copia.pdf", "comprovante_residencia_copia.pdf"],
        pagamento: { status: "pendente" },
        historico: [
            { data: "2025-05-22 09:00", status: "Solicitação recebida", descricao: "Aguardando pagamento" }
        ],
        camposAdicionais: { quantidadeDocs: "3", tipoAutenticacao: "Cópia simples" }
    }
];

let currentFilter = "todos";
let currentSearch = "";
let selectedOrderId = null;

// Helper: obter classe de cor do status
function getStatusClass(status) {
    const classes = {
        'pendente': 'status-pendente',
        'analise': 'status-analise',
        'aguardando_pagamento': 'status-aguardando-pagamento',
        'andamento': 'status-andamento',
        'concluido': 'status-concluido',
        'cancelado': 'status-cancelado'
    };
    return classes[status] || 'status-pendente';
}

// Helper: formatação de data
function formatDate(dateStr) {
    const date = new Date(dateStr);
    return date.toLocaleDateString('pt-BR');
}

// Formatar valor monetário
function formatMoney(value) {
    return value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
}

// Renderizar lista de pedidos com filtros
function renderOrdersList() {
    let filtered = pedidos.filter(pedido => {
        if (currentFilter !== "todos" && pedido.status !== currentFilter) return false;
        if (currentSearch) {
            const searchLower = currentSearch.toLowerCase();
            return pedido.protocolo.toLowerCase().includes(searchLower) ||
                   pedido.servico.toLowerCase().includes(searchLower) ||
                   pedido.descricao.toLowerCase().includes(searchLower);
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

    container.innerHTML = filtered.map(pedido => `
        <div class="order-card p-3 mb-2 ${selectedOrderId === pedido.id ? 'selected' : ''}" 
             data-order-id="${pedido.id}">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <span class="fw-bold">${pedido.servico}</span>
                    <br>
                    <small class="text-muted">Protocolo: ${pedido.protocolo}</small>
                </div>
                <span class="status-badge ${getStatusClass(pedido.status)}">
                    <i class="bi ${getStatusIcon(pedido.status)}"></i> ${pedido.statusTexto}
                </span>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2">
                <small class="text-muted"><i class="bi bi-calendar3"></i> ${formatDate(pedido.dataSolicitacao)}</small>
                <small class="text-success">${pedido.status === 'aguardando_pagamento' ? formatMoney(pedido.valor) : 'Ver detalhes →'}</small>
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

function getStatusIcon(status) {
    const icons = {
        'pendente': 'bi-clock',
        'analise': 'bi-search',
        'aguardando_pagamento': 'bi-credit-card',
        'andamento': 'bi-gear',
        'concluido': 'bi-check-circle',
        'cancelado': 'bi-x-circle'
    };
    return icons[status] || 'bi-question-circle';
}

// Atualizar estatísticas
function updateStats() {
    const total = pedidos.length;
    const emAndamento = pedidos.filter(p => p.status === 'andamento' || p.status === 'analise').length;
    const concluidos = pedidos.filter(p => p.status === 'concluido').length;
    const aguardandoPagamento = pedidos.filter(p => p.status === 'aguardando_pagamento').length;
    
    document.getElementById('totalPedidos').textContent = total;
    document.getElementById('emAndamentoCount').textContent = emAndamento;
    document.getElementById('concluidosCount').textContent = concluidos;
    document.getElementById('aguardandoPagamentoCount').textContent = aguardandoPagamento;
}

// Função de Pagamento
function abrirPagamento(pedido) {
    const modalBody = document.getElementById('paymentModalBody');
    let metodoSelecionado = null;
    
    modalBody.innerHTML = `
        <div class="payment-container">
            <div class="text-center mb-4">
                <i class="bi bi-receipt fs-1 text-success"></i>
                <h4>Pagamento do Pedido</h4>
                <p class="text-muted">Protocolo: ${pedido.protocolo}</p>
            </div>
            
            <div class="payment-card">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <strong>${pedido.servico}</strong>
                        <p class="text-muted small mb-0">${pedido.descricao}</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="payment-value">${formatMoney(pedido.valor)}</div>
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
    
    // Adicionar eventos aos métodos de pagamento
    const methods = modalBody.querySelectorAll('.payment-method-btn');
    methods.forEach(btn => {
        btn.addEventListener('click', () => {
            methods.forEach(b => b.classList.remove('selected'));
            btn.classList.add('selected');
            metodoSelecionado = btn.getAttribute('data-metodo');
            mostrarFormularioPagamento(metodoSelecionado, pedido, modalBody);
        });
    });
    
    const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
    modal.show();
}

function mostrarFormularioPagamento(metodo, pedido, container) {
    const formContainer = container.querySelector('#paymentDetailsForm');
    const valorComDesconto = metodo === 'pix' ? pedido.valor * 0.95 : pedido.valor;
    
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
                <button class="btn-pagar mt-3" onclick="confirmarPagamento(${pedido.id}, 'cartao', ${valorComDesconto})">
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
                <button class="btn-pagar mt-3" onclick="confirmarPagamento(${pedido.id}, 'pix', ${valorComDesconto})">
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
                <button class="btn-pagar mt-2" onclick="confirmarPagamento(${pedido.id}, 'boleto', ${valorComDesconto})">
                    <i class="bi bi-file-pdf"></i> Gerar Boleto
                </button>
            </div>
        `;
    }
    
    formContainer.innerHTML = html;
    
    // Máscara para número do cartão
    const cardNumber = document.getElementById('cardNumber');
    if (cardNumber) {
        cardNumber.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
            e.target.value = value.substring(0, 19);
        });
    }
}

function confirmarPagamento(pedidoId, metodo, valor) {
    const pedido = pedidos.find(p => p.id === pedidoId);
    
    // Atualizar status do pedido
    pedido.status = 'analise';
    pedido.statusTexto = 'Em análise';
    pedido.pagamento = {
        status: 'pago',
        data: new Date().toISOString().split('T')[0],
        metodo: metodo,
        valor: valor
    };
    
    // Adicionar ao histórico
    pedido.historico.unshift({
        data: new Date().toLocaleString('pt-BR'),
        status: 'Pagamento confirmado',
        descricao: `Pagamento de ${formatMoney(valor)} via ${metodo.toUpperCase()} confirmado`
    });
    
    // Fechar modal
    bootstrap.Modal.getInstance(document.getElementById('paymentModal')).hide();
    
    // Atualizar a lista e estatísticas
    renderOrdersList();
    updateStats();
    
    // Recarregar detalhes do pedido se for o selecionado
    if (selectedOrderId === pedidoId) {
        renderOrderDetails(pedido);
    }
    
    // Mostrar mensagem de sucesso
    alert(`✅ Pagamento confirmado!\n\nPedido: ${pedido.protocolo}\nValor: ${formatMoney(valor)}\nMétodo: ${metodo.toUpperCase()}\n\nSeu pedido agora está em análise.`);
}

// Selecionar pedido e exibir detalhes
function selectOrder(orderId) {
    selectedOrderId = orderId;
    const pedido = pedidos.find(p => p.id === orderId);
    if (!pedido) return;
    
    renderOrdersList();
    renderOrderDetails(pedido);
}

// Renderizar detalhes do pedido selecionado
function renderOrderDetails(pedido) {
    const container = document.getElementById('orderDetailContainer');
    
    const statusOrder = ['aguardando_pagamento', 'pendente', 'analise', 'andamento', 'concluido'];
    const currentIndex = statusOrder.indexOf(pedido.status);
    const progressPercent = currentIndex >= 0 ? ((currentIndex + 1) / statusOrder.length) * 100 : 50;
    
    const html = `
        <div class="fade-in">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h4 class="fw-bold">${pedido.servico}</h4>
                    <p class="text-muted mb-0">Protocolo: ${pedido.protocolo}</p>
                    <p class="text-muted small"><i class="bi bi-calendar"></i> Solicitado em: ${formatDate(pedido.dataSolicitacao)}</p>
                </div>
                <span class="status-badge ${getStatusClass(pedido.status)} fs-6">
                    <i class="bi ${getStatusIcon(pedido.status)}"></i> ${pedido.statusTexto}
                </span>
            </div>
            
            ${pedido.status === 'aguardando_pagamento' ? `
                <div class="payment-required-card mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <i class="bi bi-credit-card fs-3 text-warning"></i>
                            <strong class="ms-2">Pagamento pendente</strong>
                            <p class="mb-0 small text-muted mt-1">Efetue o pagamento para dar continuidade ao seu pedido</p>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold text-success fs-4">${formatMoney(pedido.valor)}</div>
                            <button class="btn-pagar mt-2" onclick="abrirPagamento(${JSON.stringify(pedido).replace(/"/g, '&quot;')})">
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
            
            ${pedido.pagamento && pedido.pagamento.status === 'pago' ? `
                <div class="detail-card">
                    <h6 class="fw-bold mb-2"><i class="bi bi-receipt"></i> Informações do Pagamento</h6>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <small class="text-muted">Valor pago</small>
                            <div class="fw-bold">${formatMoney(pedido.pagamento.valor || pedido.valor)}</div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Método</small>
                            <div>${pedido.pagamento.metodo ? pedido.pagamento.metodo.toUpperCase() : '-'}</div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Data do pagamento</small>
                            <div>${pedido.pagamento.data || '-'}</div>
                        </div>
                    </div>
                </div>
            ` : ''}
            
            <div class="detail-card">
                <h6 class="fw-bold mb-2"><i class="bi bi-card-text"></i> Descrição</h6>
                <p class="mb-0">${pedido.descricao}</p>
            </div>
            
            <div class="detail-card">
                <h6 class="fw-bold mb-2"><i class="bi bi-file-earmark-text"></i> Documentos enviados</h6>
                <div class="d-flex flex-wrap">
                    ${pedido.documentos.map(doc => `
                        <span class="file-tag"><i class="bi bi-file-earmark-check text-success"></i> ${doc}</span>
                    `).join('')}
                </div>
            </div>
            
            <div class="detail-card">
                <h6 class="fw-bold mb-2"><i class="bi bi-info-square"></i> Informações adicionais</h6>
                <div class="row g-2">
                    ${Object.entries(pedido.camposAdicionais).map(([key, value]) => `
                        <div class="col-12">
                            <small class="text-muted">${formatLabel(key)}:</small>
                            <span class="ms-2">${value}</span>
                        </div>
                    `).join('')}
                </div>
            </div>
            
            <div class="detail-card">
                <h6 class="fw-bold mb-3"><i class="bi bi-clock-history"></i> Linha do tempo</h6>
                <div>
                    ${pedido.historico.map((item, idx) => `
                        <div class="timeline-step d-flex gap-3 ${idx === pedido.historico.length-1 ? 'mb-0' : ''}">
                            <div class="timeline-icon ${idx === pedido.historico.length-1 ? 'active' : 'completed'}">
                                <i class="bi ${idx === pedido.historico.length-1 ? 'bi-hourglass-split' : 'bi-check2'} small"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between flex-wrap">
                                    <strong>${item.status}</strong>
                                    <small class="text-muted">${item.data}</small>
                                </div>
                                <p class="mb-2 small text-secondary">${item.descricao}</p>
                            </div>
                        </div>
                    `).join('')}
                </div>
            </div>
        </div>
    `;
    
    container.innerHTML = html;
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
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentFilter = btn.getAttribute('data-filter');
            renderOrdersList();
        });
    });
    
    document.getElementById('searchInput').addEventListener('input', (e) => {
        currentSearch = e.target.value;
        renderOrdersList();
    });
}

// Inicialização
function init() {
    renderOrdersList();
    updateStats();
    initFilters();
    if (pedidos.length > 0) {
        selectOrder(pedidos[0].id);
    }
}

init();
</script>

<style>
/* Estilos adicionais */
.status-aguardando-pagamento {
    background: #fff3e0;
    color: #ed6c02;
}

.payment-required-card {
    background: linear-gradient(135deg, #fff8e1, #fff3e0);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
    border: 1px solid #ffe0b2;
}

.pix-discount-badge {
    background: #e8f5e9;
    color: #2e7d32;
    padding: 8px;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 600;
}

.qrcode-placeholder {
    background: white;
    padding: 20px;
    border-radius: 15px;
    border: 2px solid #e0e8e4;
}

.pix-info {
    background: #f8fbf9;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
}
</style>

@endsection
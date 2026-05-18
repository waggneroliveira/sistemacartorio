@extends('client.core.client')

@section('content')
    <style>
        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', Roboto, system-ui, -apple-system, 'Helvetica Neue', sans-serif;
        }
        .navbar-custom {
            background: #1a3e2f;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.3px;
            color: white !important;
        }
        .nav-link-custom {
            color: rgba(255,255,255,0.85) !important;
            transition: 0.2s;
        }
        .nav-link-custom:hover, .nav-link-custom.active {
            color: white !important;
            background: rgba(255,255,255,0.15);
            border-radius: 30px;
        }
        .section-title {
            font-weight: 700;
            color: #1f2f29;
            border-left: 5px solid #1a3e2f;
            padding-left: 16px;
        }
        .stats-card {
            background: white;
            border-radius: 24px;
            transition: all 0.2s;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        }
        .order-card {
            background: white;
            border-radius: 20px;
            border: none;
            transition: all 0.2s;
            cursor: pointer;
        }
        .order-card:hover {
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            transform: translateY(-2px);
        }
        .order-card.selected {
            border: 2px solid #1a3e2f;
            background: #f8fbf9;
        }
        .status-badge {
            padding: 6px 14px;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .status-pendente { background: #fff3cd; color: #856404; }
        .status-analise { background: #cfe2ff; color: #084298; }
        .status-documentos { background: #cff4fc; color: #055160; }
        .status-andamento { background: #d1e7dd; color: #0f5132; }
        .status-concluido { background: #d1e7dd; color: #0f5132; }
        .status-cancelado { background: #f8d7da; color: #721c24; }
        
        .timeline-step {
            position: relative;
            padding-bottom: 30px;
        }
        .timeline-step:not(:last-child)::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 30px;
            bottom: 0;
            width: 2px;
            background: #dee2e6;
        }
        .timeline-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: white;
            border: 2px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
            position: relative;
        }
        .timeline-step.active .timeline-icon {
            background: #1a3e2f;
            border-color: #1a3e2f;
            color: white;
        }
        .timeline-step.completed .timeline-icon {
            background: #28a745;
            border-color: #28a745;
            color: white;
        }
        .detail-card {
            background: #f8f9fa;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 16px;
        }
        .file-tag {
            background: white;
            border-radius: 30px;
            padding: 6px 12px;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 4px;
            border: 1px solid #dee2e6;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 24px;
        }
        footer {
            border-top: 1px solid #dce5e1;
            background: white;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.3s ease;
        }
        .filter-btn {
            border-radius: 30px;
            padding: 6px 18px;
            transition: 0.2s;
        }
        .filter-btn.active {
            background: #1a3e2f;
            color: white;
            border-color: #1a3e2f;
        }
        .search-box {
            border-radius: 50px;
            padding: 10px 18px;
            border: 1px solid #dee2e6;
        }
    </style>
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
                        <span class="text-secondary small">Aguardando docs</span>
                        <h2 class="mb-0 fw-bold text-warning" id="aguardandoDocsCount">0</h2>
                    </div>
                    <i class="bi bi-file-earmark-text fs-1 text-warning opacity-50"></i>
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
                <button class="btn btn-outline-secondary filter-btn" data-filter="documentos">📄 Aguardando docs</button>
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
                    <!-- Lista dinâmica de pedidos -->
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

    <script>
    // ==================== DADOS MOCKADOS DE PEDIDOS ====================
    let pedidos = [
        {
            id: 1001,
            protocolo: "CART-28471",
            servico: "Certidão de Nascimento",
            dataSolicitacao: "2025-04-28",
            status: "concluido",
            statusTexto: "Concluído",
            descricao: "2ª via de certidão de nascimento - solicitante: Maria Silva",
            documentos: ["RG_front.pdf", "CPF.png", "comprovante_endereco.pdf"],
            historico: [
                { data: "2025-04-28 09:23", status: "Solicitação recebida", descricao: "Pedido criado com sucesso" },
                { data: "2025-04-28 14:15", status: "Documentos em análise", descricao: "Documentos recebidos e em validação" },
                { data: "2025-04-29 10:00", status: "Análise concluída", descricao: "Documentos aprovados" },
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
            descricao: "Escritura de imóvel - comprador: João Santos",
            documentos: ["rg_joao.pdf", "cpf_joao.pdf", "matricula_imovel.pdf", "comprovante_iptu.pdf"],
            historico: [
                { data: "2025-05-10 08:30", status: "Solicitação recebida", descricao: "Pedido criado" },
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
            status: "documentos",
            statusTexto: "Aguardando documentos",
            descricao: "Reconhecimento de firma em contrato de aluguel",
            documentos: ["documento_reconhecer.pdf", "rg_requerente.jpg"],
            historico: [
                { data: "2025-05-15 10:15", status: "Solicitação recebida", descricao: "Pedido criado aguardando documentos adicionais" },
                { data: "2025-05-16 08:00", status: "Documentos pendentes", descricao: "Solicitado envio de comprovante de residência atualizado" }
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
            descricao: "2ª via de certidão de casamento - casamento realizado em 2018",
            documentos: ["rg_conjuge1.jpg", "rg_conjuge2.jpg", "comprovante_residencia.pdf"],
            historico: [
                { data: "2025-05-05 11:20", status: "Solicitação recebida", descricao: "Pedido registrado" },
                { data: "2025-05-06 09:30", status: "Em análise", descricao: "Documentos sendo verificados" }
            ],
            camposAdicionais: { nomeConjuge1: "Carlos Alberto", nomeConjuge2: "Fernanda Lima", dataCasamento: "12/10/2018" }
        },
        {
            id: 1005,
            protocolo: "CART-31245",
            servico: "Abertura de Inventário",
            dataSolicitacao: "2025-05-18",
            status: "pendente",
            statusTexto: "Pendente",
            descricao: "Inventário extrajudicial - falecido: José Oliveira",
            documentos: ["certidao_obito.pdf", "rg_herdeiros.pdf"],
            historico: [
                { data: "2025-05-18 15:45", status: "Solicitação recebida", descricao: "Aguardando análise inicial" }
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
            descricao: "1ª via de certidão de nascimento - recém-nascido",
            documentos: ["declaracao_nascido.pdf", "rg_mae.pdf", "cpf_mae.pdf"],
            historico: [
                { data: "2025-05-20 07:30", status: "Solicitação recebida", descricao: "Pedido criado" },
                { data: "2025-05-20 13:20", status: "Documentos em análise", descricao: "Documentos validados com sucesso" },
                { data: "2025-05-21 10:00", status: "Concluído", descricao: "Certidão emitida e enviada por e-mail" }
            ],
            camposAdicionais: { tipoCertidao: "1ª Via", nomeMae: "Patrícia Souza", dataNascimento: "18/05/2025" }
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
            'documentos': 'status-documentos',
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

    // Renderizar lista de pedidos com filtros
    function renderOrdersList() {
        let filtered = pedidos.filter(pedido => {
            // filtro por status
            if (currentFilter !== "todos" && pedido.status !== currentFilter) return false;
            // busca por texto
            if (currentSearch) {
                const searchLower = currentSearch.toLowerCase();
                return pedido.protocolo.toLowerCase().includes(searchLower) ||
                       pedido.servico.toLowerCase().includes(searchLower) ||
                       pedido.descricao.toLowerCase().includes(searchLower);
            }
            return true;
        });

        // Ordenar por data (mais recentes primeiro)
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
                    <small class="text-success">Ver detalhes →</small>
                </div>
            </div>
        `).join('');

        // Adicionar eventos de clique nos pedidos
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
            'documentos': 'bi-file-earmark-text',
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
        const aguardandoDocs = pedidos.filter(p => p.status === 'documentos' || p.status === 'pendente').length;
        
        document.getElementById('totalPedidos').textContent = total;
        document.getElementById('emAndamentoCount').textContent = emAndamento;
        document.getElementById('concluidosCount').textContent = concluidos;
        document.getElementById('aguardandoDocsCount').textContent = aguardandoDocs;
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
        
        // Calcular progresso do status
        const statusOrder = ['pendente', 'analise', 'documentos', 'andamento', 'concluido'];
        const currentIndex = statusOrder.indexOf(pedido.status);
        const progressPercent = ((currentIndex + 1) / statusOrder.length) * 100;
        
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
                
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-1">
                        <small>Progresso</small>
                        <small class="text-success">${Math.round(progressPercent)}%</small>
                    </div>
                    <div class="progress" style="height: 8px; border-radius: 10px;">
                        <div class="progress-bar bg-success" style="width: ${progressPercent}%; border-radius: 10px;"></div>
                    </div>
                </div>
                
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
                
                ${pedido.status !== 'concluido' ? `
                    <div class="alert alert-info mt-3">
                        <i class="bi bi-chat-dots"></i> <strong>Próximos passos:</strong> O cartório está processando sua solicitação. Em breve atualizaremos o status.
                    </div>
                ` : `
                    <div class="alert alert-success mt-3">
                        <i class="bi bi-check-circle-fill"></i> <strong>Pedido concluído!</strong> O documento final está disponível. Entre em contato para mais detalhes.
                    </div>
                `}
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
            numeroHerdeiros: "Nº de herdeiros"
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
        // Selecionar primeiro pedido por padrão
        if (pedidos.length > 0) {
            selectOrder(pedidos[0].id);
        }
    }
    
    init();
</script>
@endsection
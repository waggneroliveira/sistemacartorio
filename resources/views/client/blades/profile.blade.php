@extends('client.core.client')
@section('content')
<!-- CONTEÚDO PRINCIPAL DA PÁGINA DE PERFIL -->
<div class="perfil-page">
    <!-- Header da Página -->
    <div class="perfil-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Início</a></li>
                            <li class="breadcrumb-item active">Meu Perfil</li>
                        </ol>
                    </nav>
                    <h1 class="perfil-title">Meu Perfil</h1>
                    <p class="perfil-subtitle">Gerencie suas informações pessoais, segurança e preferências</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <div class="perfil-status">
                        <span class="status-badge verified">
                            <i class="bi bi-check-circle-fill"></i> Conta verificada
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Sidebar - Menu Lateral -->
            <div class="col-lg-3 mb-4">
                <div class="perfil-sidebar">
                    <div class="user-avatar-large">
                        <div class="avatar-circle">
                            <span class="avatar-initials">JD</span>
                            <button class="avatar-edit-btn" data-bs-toggle="tooltip" title="Alterar foto">
                                <i class="bi bi-camera-fill"></i>
                            </button>
                        </div>
                        <h4 class="user-name-sidebar">João da Silva</h4>
                        <p class="user-email-sidebar">joao.silva@email.com</p>
                        <div class="user-badge">
                            <i class="bi bi-star-fill"></i> Cliente desde 2024
                        </div>
                    </div>
                    
                    <nav class="nav-sidebar">
                        <a href="#" class="nav-link-sidebar active" data-tab="dados-pessoais">
                            <i class="bi bi-person"></i> Dados Pessoais
                        </a>
                        <a href="#" class="nav-link-sidebar" data-tab="seguranca">
                            <i class="bi bi-shield-lock"></i> Segurança
                        </a>
                        <a href="#" class="nav-link-sidebar" data-tab="documentos">
                            <i class="bi bi-folder2"></i> Meus Documentos
                        </a>
                        <a href="#" class="nav-link-sidebar" data-tab="preferencias">
                            <i class="bi bi-bell"></i> Preferências
                        </a>
                        <a href="#" class="nav-link-sidebar" data-tab="pedidos">
                            <i class="bi bi-clock-history"></i> Histórico de Pedidos
                        </a>
                        <a href="#" class="nav-link-sidebar" data-tab="enderecos">
                            <i class="bi bi-geo-alt"></i> Endereços
                        </a>
                    </nav>
                    
                    <div class="sidebar-footer">
                        <button class="btn-logout" onclick="confirmarLogout()">
                            <i class="bi bi-box-arrow-right"></i> Sair da Conta
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Conteúdo Principal -->
            <div class="col-lg-9">
                <!-- Aba: Dados Pessoais -->
                <div class="tab-content active" id="dados-pessoais">
                    <div class="perfil-card">
                        <div class="card-header-custom">
                            <h3><i class="bi bi-person-circle"></i> Informações Pessoais</h3>
                            <button class="btn-edit" onclick="habilitarEdicao('formDadosPessoais')">
                                <i class="bi bi-pencil"></i> Editar
                            </button>
                        </div>
                        
                        <form id="formDadosPessoais" class="disabled-form" onsubmit="salvarAlteracoes(event, 'formDadosPessoais')">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">Nome completo</label>
                                    <input type="text" class="form-control" value="João da Silva" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">E-mail</label>
                                    <input type="email" class="form-control" value="joao.silva@email.com" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">CPF</label>
                                    <input type="text" class="form-control" value="***.***.***-**" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Data de Nascimento</label>
                                    <input type="date" class="form-control" value="1990-05-15" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Telefone</label>
                                    <input type="tel" class="form-control" value="(11) 98765-4321" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Celular</label>
                                    <input type="tel" class="form-control" value="(11) 99999-9999" disabled>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Profissão</label>
                                    <input type="text" class="form-control" value="Advogado" disabled>
                                </div>
                            </div>
                            <div class="form-actions" style="display: none;">
                                <button type="submit" class="btn-save">Salvar Alterações</button>
                                <button type="button" class="btn-cancel" onclick="cancelarEdicao('formDadosPessoais')">Cancelar</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="perfil-card">
                        <div class="card-header-custom">
                            <h3><i class="bi bi-building"></i> Informações Complementares</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="info-box">
                                    <label>Total de Pedidos</label>
                                    <span class="info-value">24</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-box">
                                    <label>Último Pedido</label>
                                    <span class="info-value">15/03/2025</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-box">
                                    <label>Certidões Emitidas</label>
                                    <span class="info-value">18</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-box">
                                    <label>Tempo de Cadastro</label>
                                    <span class="info-value">1 ano e 3 meses</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Aba: Segurança -->
                <div class="tab-content" id="seguranca">
                    <div class="perfil-card">
                        <div class="card-header-custom">
                            <h3><i class="bi bi-shield-lock"></i> Alterar Senha</h3>
                        </div>
                        <form onsubmit="alterarSenha(event)">
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label">Senha atual</label>
                                    <input type="password" class="form-control" id="senhaAtual" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nova senha</label>
                                    <input type="password" class="form-control" id="novaSenha" required>
                                    <div class="password-strength mt-2">
                                        <div class="strength-bar"></div>
                                        <small class="strength-text">Digite uma senha forte</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirmar nova senha</label>
                                    <input type="password" class="form-control" id="confirmarSenha" required>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn-save">Atualizar Senha</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="perfil-card">
                        <div class="card-header-custom">
                            <h3><i class="bi bi-envelope-check"></i> Verificação em Duas Etapas</h3>
                        </div>
                        <div class="two-factor-info">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <p class="mb-1"><strong>Proteja sua conta com verificação em duas etapas</strong></p>
                                    <p class="text-muted small">Receba um código por SMS ou aplicativo autenticador ao fazer login</p>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <button class="btn-enable-2fa" onclick="ativar2FA()">
                                        <i class="bi bi-shield-plus"></i> Ativar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="perfil-card">
                        <div class="card-header-custom">
                            <h3><i class="bi bi-device-ssd"></i> Sessões Ativas</h3>
                        </div>
                        <div class="sessions-list">
                            <div class="session-item">
                                <div class="session-info">
                                    <i class="bi bi-laptop"></i>
                                    <div>
                                        <strong>Chrome no Windows</strong><br>
                                        <small>São Paulo, Brasil • Último acesso hoje às 14:30</small>
                                    </div>
                                </div>
                                <button class="session-remove" onclick="removerSessao(this)">Remover</button>
                            </div>
                            <div class="session-item">
                                <div class="session-info">
                                    <i class="bi bi-phone"></i>
                                    <div>
                                        <strong>App Mobile (iOS)</strong><br>
                                        <small>São Paulo, Brasil • Último acesso ontem às 20:15</small>
                                    </div>
                                </div>
                                <button class="session-remove" onclick="removerSessao(this)">Remover</button>
                            </div>
                        </div>
                        <button class="btn-link-danger mt-3" onclick="encerrarTodasSessoes()">
                            <i class="bi bi-trash"></i> Encerrar todas as sessões
                        </button>
                    </div>
                </div>
                
                <!-- Aba: Meus Documentos -->
                <div class="tab-content" id="documentos">
                    <div class="perfil-card">
                        <div class="card-header-custom">
                            <h3><i class="bi bi-cloud-upload"></i> Documentos Digitalizados</h3>
                            <button class="btn-upload" data-bs-toggle="modal" data-bs-target="#uploadDocumentoModal">
                                <i class="bi bi-plus-circle"></i> Novo Documento
                            </button>
                        </div>
                        
                        <div class="documentos-grid">
                            <div class="documento-item">
                                <i class="bi bi-file-pdf-fill"></i>
                                <div class="documento-info">
                                    <strong>RG.pdf</strong>
                                    <small>Enviado em 10/01/2025</small>
                                </div>
                                <div class="documento-actions">
                                    <button class="doc-action" onclick="visualizarDocumento(this)"><i class="bi bi-eye"></i></button>
                                    <button class="doc-action" onclick="baixarDocumento(this)"><i class="bi bi-download"></i></button>
                                    <button class="doc-action text-danger" onclick="excluirDocumento(this)"><i class="bi bi-trash"></i></button>
                                </div>
                            </div>
                            <div class="documento-item">
                                <i class="bi bi-file-image-fill"></i>
                                <div class="documento-info">
                                    <strong>Comprovante Residência.jpg</strong>
                                    <small>Enviado em 15/02/2025</small>
                                </div>
                                <div class="documento-actions">
                                    <button class="doc-action" onclick="visualizarDocumento(this)"><i class="bi bi-eye"></i></button>
                                    <button class="doc-action" onclick="baixarDocumento(this)"><i class="bi bi-download"></i></button>
                                    <button class="doc-action text-danger" onclick="excluirDocumento(this)"><i class="bi bi-trash"></i></button>
                                </div>
                            </div>
                            <div class="documento-item">
                                <i class="bi bi-file-pdf-fill"></i>
                                <div class="documento-info">
                                    <strong>Certidão Nascimento.pdf</strong>
                                    <small>Enviado em 05/03/2025</small>
                                </div>
                                <div class="documento-actions">
                                    <button class="doc-action" onclick="visualizarDocumento(this)"><i class="bi bi-eye"></i></button>
                                    <button class="doc-action" onclick="baixarDocumento(this)"><i class="bi bi-download"></i></button>
                                    <button class="doc-action text-danger" onclick="excluirDocumento(this)"><i class="bi bi-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="storage-info mt-4">
                            <div class="d-flex justify-content-between mb-2">
                                <small>Espaço utilizado: 15MB de 100MB</small>
                                <small>15%</small>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: 15%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Aba: Preferências -->
                <div class="tab-content" id="preferencias">
                    <div class="perfil-card">
                        <div class="card-header-custom">
                            <h3><i class="bi bi-bell"></i> Notificações</h3>
                        </div>
                        <div class="preferencia-item">
                            <div class="preferencia-info">
                                <i class="bi bi-envelope"></i>
                                <div>
                                    <strong>E-mail de confirmação</strong>
                                    <p>Receba confirmações de pedidos e pagamentos</p>
                                </div>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="emailConfirmacao" checked>
                            </div>
                        </div>
                        <div class="preferencia-item">
                            <div class="preferencia-info">
                                <i class="bi bi-whatsapp"></i>
                                <div>
                                    <strong>Notificações por WhatsApp</strong>
                                    <p>Receba atualizações de status pelo WhatsApp</p>
                                </div>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="whatsappNotif" checked>
                            </div>
                        </div>
                        <div class="preferencia-item">
                            <div class="preferencia-info">
                                <i class="bi bi-megaphone"></i>
                                <div>
                                    <strong>Newsletter e promoções</strong>
                                    <p>Receba ofertas exclusivas e novidades</p>
                                </div>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="newsletter">
                            </div>
                        </div>
                    </div>
                    
                    <div class="perfil-card">
                        <div class="card-header-custom">
                            <h3><i class="bi bi-palette"></i> Aparência</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Tema</label>
                                <select class="form-select" id="tema">
                                    <option value="light">Claro</option>
                                    <option value="dark">Escuro</option>
                                    <option value="system">Sistema</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Idioma</label>
                                <select class="form-select" id="idioma">
                                    <option value="pt">Português</option>
                                    <option value="en">English</option>
                                    <option value="es">Español</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Aba: Histórico de Pedidos -->
                <div class="tab-content" id="pedidos">
                    <div class="perfil-card">
                        <div class="card-header-custom">
                            <h3><i class="bi bi-clock-history"></i> Últimos Pedidos</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table-pedidos">
                                <thead>
                                    <tr>
                                        <th>Protocolo</th>
                                        <th>Serviço</th>
                                        <th>Data</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#CART-2025-001</td>
                                        <td>Certidão de Nascimento</td>
                                        <td>15/03/2025</td>
                                        <td><span class="status-badge success">Concluído</span></td>
                                        <td><a href="#" class="btn-link">Ver detalhes</a></td>
                                    </tr>
                                    <tr>
                                        <td>#CART-2025-002</td>
                                        <td>Certidão de Casamento</td>
                                        <td>10/03/2025</td>
                                        <td><span class="status-badge warning">Em andamento</span></td>
                                        <td><a href="#" class="btn-link">Ver detalhes</a></td>
                                    </tr>
                                    <tr>
                                        <td>#CART-2025-003</td>
                                        <td>Procuração Pública</td>
                                        <td>01/03/2025</td>
                                        <td><span class="status-badge success">Concluído</span></td>
                                        <td><a href="#" class="btn-link">Ver detalhes</a></td>
                                    </tr>
                                    <tr>
                                        <td>#CART-2025-004</td>
                                        <td>Autenticação de Documento</td>
                                        <td>20/02/2025</td>
                                        <td><span class="status-badge success">Concluído</span></td>
                                        <td><a href="#" class="btn-link">Ver detalhes</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{route('orders')}}" class="btn-ver-todos">Ver todos os pedidos →</a>
                        </div>
                    </div>
                </div>
                
                <!-- Aba: Endereços -->
                <div class="tab-content" id="enderecos">
                    <div class="perfil-card">
                        <div class="card-header-custom">
                            <h3><i class="bi bi-geo-alt"></i> Meus Endereços</h3>
                            <button class="btn-upload" onclick="adicionarEndereco()">
                                <i class="bi bi-plus-circle"></i> Novo Endereço
                            </button>
                        </div>
                        
                        <div class="enderecos-list">
                            <div class="endereco-card principal">
                                <div class="endereco-badge">Principal</div>
                                <h4>João da Silva</h4>
                                <p>Rua das Flores, 123 - Apto 45<br>
                                Bairro Jardim América<br>
                                São Paulo - SP, CEP: 01234-567</p>
                                <div class="endereco-actions">
                                    <button class="btn-endereco" onclick="editarEndereco(this)">Editar</button>
                                    <button class="btn-endereco text-danger" onclick="excluirEndereco(this)">Excluir</button>
                                </div>
                            </div>
                            <div class="endereco-card">
                                <h4>João da Silva (Trabalho)</h4>
                                <p>Av. Paulista, 1000 - Sala 101<br>
                                Bela Vista<br>
                                São Paulo - SP, CEP: 01310-100</p>
                                <div class="endereco-actions">
                                    <button class="btn-endereco" onclick="definirPrincipal(this)">Definir como principal</button>
                                    <button class="btn-endereco" onclick="editarEndereco(this)">Editar</button>
                                    <button class="btn-endereco text-danger" onclick="excluirEndereco(this)">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal de Upload de Documento -->
    <div class="modal fade" id="uploadDocumentoModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-cloud-upload"></i> Upload de Documento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="upload-area-doc" onclick="document.getElementById('fileInput').click()">
                        <i class="bi bi-cloud-arrow-up"></i>
                        <p>Clique para selecionar ou arraste um arquivo</p>
                        <small>Formatos suportados: PDF, JPG, PNG (máx. 10MB)</small>
                        <input type="file" id="fileInput" style="display: none;" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Nome do documento (opcional)</label>
                        <input type="text" class="form-control" placeholder="Ex: RG, CPF, Comprovante...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary-modal" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn-primary-modal" onclick="uploadDocumento()">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* ========== ESTILOS DA PÁGINA DE PERFIL ========== */
    
    .perfil-page {
        background: #f8fbf9;
        min-height: calc(100vh - 300px);
    }
    
    /* Header do Perfil */
    .perfil-header {
        background: white;
        border-bottom: 1px solid #e8ece9;
        padding: 30px 0;
        margin-bottom: 30px;
    }
    
    .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 15px;
    }
    
    .breadcrumb-item a {
        color: #7a8f85;
        text-decoration: none;
    }
    
    .breadcrumb-item.active {
        color: #1a5c42;
        font-weight: 500;
    }
    
    .perfil-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1f2f29;
        margin-bottom: 10px;
    }
    
    .perfil-subtitle {
        color: #7a8f85;
        margin: 0;
    }
    
    .status-badge.verified {
        background: #e8f5e9;
        color: #2e7d32;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    
    /* Sidebar */
    .perfil-sidebar {
        background: white;
        border-radius: 20px;
        padding: 30px 20px;
        position: sticky;
        top: 100px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }
    
    .user-avatar-large {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f0f2f5;
    }
    
    .avatar-circle {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #1a5c42, #0a2b1f);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        position: relative;
        cursor: pointer;
    }
    
    .avatar-initials {
        font-size: 2rem;
        font-weight: 600;
        color: white;
    }
    
    .avatar-edit-btn {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 32px;
        height: 32px;
        background: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .avatar-edit-btn:hover {
        background: #1a5c42;
        color: white;
    }
    
    .user-name-sidebar {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    .user-email-sidebar {
        color: #7a8f85;
        font-size: 0.85rem;
        margin-bottom: 10px;
    }
    
    .user-badge {
        background: #f0f7f3;
        color: #1a5c42;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        display: inline-block;
    }
    
    .nav-sidebar {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    
    .nav-link-sidebar {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 15px;
        border-radius: 12px;
        color: #5a6e65;
        text-decoration: none;
        transition: all 0.3s;
        font-weight: 500;
    }
    
    .nav-link-sidebar i {
        font-size: 1.2rem;
    }
    
    .nav-link-sidebar:hover {
        background: #f0f7f3;
        color: #1a5c42;
    }
    
    .nav-link-sidebar.active {
        background: #1a5c42;
        color: white;
    }
    
    .sidebar-footer {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 2px solid #f0f2f5;
    }
    
    .btn-logout {
        width: 100%;
        background: #fee;
        color: #c62828;
        border: none;
        padding: 12px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-logout:hover {
        background: #fcc;
        transform: translateY(-2px);
    }
    
    /* Cards de Conteúdo */
    .perfil-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 25px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }
    
    .card-header-custom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f2f5;
    }
    
    .card-header-custom h3 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1f2f29;
        margin: 0;
    }
    
    .card-header-custom h3 i {
        color: #1a5c42;
        margin-right: 10px;
    }
    
    .btn-edit, .btn-upload {
        background: #f0f7f3;
        border: none;
        padding: 8px 20px;
        border-radius: 50px;
        color: #1a5c42;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-edit:hover, .btn-upload:hover {
        background: #1a5c42;
        color: white;
    }
    
    /* Formulário Desabilitado */
    .disabled-form input:disabled {
        background: #f8fbf9;
        cursor: not-allowed;
    }
    
    .form-actions {
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e8ece9;
    }
    
    .btn-save {
        background: #1a5c42;
        color: white;
        border: none;
        padding: 10px 30px;
        border-radius: 50px;
        font-weight: 600;
        margin-right: 10px;
        transition: all 0.3s;
    }
    
    .btn-save:hover {
        background: #0a2b1f;
        transform: translateY(-2px);
    }
    
    .btn-cancel {
        background: #e0e0e0;
        color: #666;
        border: none;
        padding: 10px 30px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .info-box {
        background: #f8fbf9;
        padding: 15px;
        border-radius: 15px;
    }
    
    .info-box label {
        display: block;
        font-size: 0.8rem;
        color: #7a8f85;
        margin-bottom: 5px;
    }
    
    .info-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a5c42;
    }
    
    /* Segurança */
    .password-strength {
        margin-top: 8px;
    }
    
    .strength-bar {
        height: 4px;
        background: #e0e0e0;
        border-radius: 2px;
        width: 0%;
        transition: width 0.3s;
    }
    
    .two-factor-info {
        background: #f8fbf9;
        padding: 20px;
        border-radius: 15px;
    }
    
    .btn-enable-2fa {
        background: #1a5c42;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 500;
    }
    
    .sessions-list {
        margin-top: 10px;
    }
    
    .session-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #e8ece9;
    }
    
    .session-info {
        display: flex;
        gap: 15px;
        align-items: center;
    }
    
    .session-info i {
        font-size: 1.5rem;
        color: #1a5c42;
    }
    
    .session-remove {
        background: none;
        border: none;
        color: #c62828;
        cursor: pointer;
    }
    
    .btn-link-danger {
        background: none;
        border: none;
        color: #c62828;
        font-size: 0.85rem;
        cursor: pointer;
    }
    
    /* Documentos */
    .documentos-grid {
        display: grid;
        gap: 15px;
    }
    
    .documento-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: #f8fbf9;
        border-radius: 15px;
        transition: all 0.3s;
    }
    
    .documento-item:hover {
        background: #f0f7f3;
    }
    
    .documento-item i {
        font-size: 2rem;
    }
    
    .documento-info {
        flex: 1;
    }
    
    .documento-info strong {
        display: block;
        margin-bottom: 5px;
    }
    
    .documento-info small {
        color: #7a8f85;
        font-size: 0.7rem;
    }
    
    .documento-actions {
        display: flex;
        gap: 10px;
    }
    
    .doc-action {
        background: white;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .doc-action:hover {
        background: #1a5c42;
        color: white;
    }
    
    .storage-info {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e8ece9;
    }
    
    .progress {
        height: 6px;
        background: #e8ece9;
    }
    
    .progress-bar {
        background: #1a5c42;
    }
    
    /* Preferências */
    .preferencia-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #e8ece9;
    }
    
    .preferencia-info {
        display: flex;
        gap: 15px;
        align-items: center;
    }
    
    .preferencia-info i {
        font-size: 1.5rem;
        color: #1a5c42;
    }
    
    .preferencia-info p {
        margin: 0;
        font-size: 0.8rem;
        color: #7a8f85;
    }
    
    .form-switch .form-check-input {
        width: 50px;
        height: 25px;
    }
    
    .form-switch .form-check-input:checked {
        background-color: #1a5c42;
        border-color: #1a5c42;
    }
    
    /* Tabela de Pedidos */
    .table-pedidos {
        width: 100%;
        border-collapse: collapse;
    }
    
    .table-pedidos th {
        text-align: left;
        padding: 12px;
        background: #f8fbf9;
        color: #5a6e65;
        font-weight: 600;
        font-size: 0.85rem;
    }
    
    .table-pedidos td {
        padding: 15px 12px;
        border-bottom: 1px solid #e8ece9;
    }
    
    .status-badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .status-badge.success {
        background: #e8f5e9;
        color: #2e7d32;
    }
    
    .status-badge.warning {
        background: #fff3e0;
        color: #ed6c02;
    }
    
    .btn-link {
        color: #1a5c42;
        text-decoration: none;
        font-weight: 500;
    }
    
    .btn-ver-todos {
        color: #1a5c42;
        text-decoration: none;
        font-weight: 600;
    }
    
    /* Endereços */
    .enderecos-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    
    .endereco-card {
        background: #f8fbf9;
        padding: 20px;
        border-radius: 15px;
        position: relative;
        transition: all 0.3s;
    }
    
    .endereco-card.principal {
        border: 2px solid #ffd966;
        background: #fffef7;
    }
    
    .endereco-badge {
        position: absolute;
        top: -10px;
        right: 20px;
        background: #ffd966;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
    }
    
    .endereco-card h4 {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .endereco-card p {
        font-size: 0.85rem;
        color: #5a6e65;
        margin-bottom: 15px;
    }
    
    .endereco-actions {
        display: flex;
        gap: 10px;
    }
    
    .btn-endereco {
        background: white;
        border: none;
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        cursor: pointer;
    }
    
    /* Modal Upload */
    .upload-area-doc {
        border: 2px dashed #cbd5e1;
        border-radius: 15px;
        padding: 40px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .upload-area-doc:hover {
        border-color: #1a5c42;
        background: #f8fbf9;
    }
    
    .upload-area-doc i {
        font-size: 3rem;
        color: #1a5c42;
        margin-bottom: 15px;
    }
    
    .btn-primary-modal {
        background: #1a5c42;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
    }
    
    .btn-secondary-modal {
        background: #e0e0e0;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
    }
    
    /* Abas */
    .tab-content {
        display: none;
    }
    
    .tab-content.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @media (max-width: 768px) {
        .perfil-header {
            padding: 20px 0;
        }
        
        .perfil-title {
            font-size: 1.5rem;
        }
        
        .perfil-sidebar {
            position: relative;
            top: 0;
            margin-bottom: 20px;
        }
        
        .card-header-custom {
            flex-direction: column;
            gap: 15px;
            align-items: stretch;
        }
        
        .enderecos-list {
            grid-template-columns: 1fr;
        }
        
        .table-pedidos {
            font-size: 0.8rem;
        }
    }
</style>

<script>
    // Navegação entre abas
    document.querySelectorAll('.nav-link-sidebar').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const tabId = this.getAttribute('data-tab');
            
            // Remove active de todas as abas
            document.querySelectorAll('.nav-link-sidebar').forEach(l => l.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
            
            // Adiciona active na aba clicada
            this.classList.add('active');
            document.getElementById(tabId).classList.add('active');
            
            // Scroll suave para o topo do conteúdo
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
    
    // Habilitar edição do formulário
    function habilitarEdicao(formId) {
        const form = document.getElementById(formId);
        const inputs = form.querySelectorAll('input, select');
        const actions = form.querySelector('.form-actions');
        
        inputs.forEach(input => input.disabled = false);
        actions.style.display = 'block';
    }
    
    // Cancelar edição
    function cancelarEdicao(formId) {
        const form = document.getElementById(formId);
        const inputs = form.querySelectorAll('input, select');
        const actions = form.querySelector('.form-actions');
        
        inputs.forEach(input => input.disabled = true);
        actions.style.display = 'none';
        location.reload(); // Recarrega para restaurar valores originais
    }
    
    // Salvar alterações
    function salvarAlteracoes(event, formId) {
        event.preventDefault();
        alert('Alterações salvas com sucesso!');
        cancelarEdicao(formId);
    }
    
    // Alterar senha
    function alterarSenha(event) {
        event.preventDefault();
        const novaSenha = document.getElementById('novaSenha').value;
        const confirmarSenha = document.getElementById('confirmarSenha').value;
        
        if (novaSenha !== confirmarSenha) {
            alert('As senhas não coincidem!');
            return;
        }
        
        if (novaSenha.length < 6) {
            alert('A senha deve ter no mínimo 6 caracteres!');
            return;
        }
        
        alert('Senha alterada com sucesso!');
        event.target.reset();
    }
    
    // Ativar 2FA
    function ativar2FA() {
        alert('Um código de verificação foi enviado para seu e-mail.');
    }
    
    // Remover sessão
    function removerSessao(btn) {
        if (confirm('Deseja encerrar esta sessão?')) {
            btn.closest('.session-item').remove();
            alert('Sessão encerrada com sucesso!');
        }
    }
    
    // Encerrar todas as sessões
    function encerrarTodasSessoes() {
        if (confirm('Deseja encerrar todas as sessões ativas? Você será desconectado em todos os dispositivos.')) {
            alert('Todas as sessões foram encerradas!');
        }
    }
    
    // Upload de documento
    function uploadDocumento() {
        const fileInput = document.getElementById('fileInput');
        if (fileInput.files.length === 0) {
            alert('Selecione um arquivo primeiro!');
            return;
        }
        alert('Documento enviado com sucesso!');
        location.reload();
    }
    
    // Visualizar documento
    function visualizarDocumento(btn) {
        alert('Visualizando documento...');
    }
    
    // Baixar documento
    function baixarDocumento(btn) {
        alert('Download iniciado...');
    }
    
    // Excluir documento
    function excluirDocumento(btn) {
        if (confirm('Deseja excluir este documento permanentemente?')) {
            btn.closest('.documento-item').remove();
            alert('Documento excluído com sucesso!');
        }
    }
    
    // Adicionar endereço
    function adicionarEndereco() {
        alert('Funcionalidade de adicionar endereço será implementada em breve.');
    }
    
    // Editar endereço
    function editarEndereco(btn) {
        alert('Editar endereço - funcionalidade em desenvolvimento.');
    }
    
    // Excluir endereço
    function excluirEndereco(btn) {
        if (confirm('Deseja excluir este endereço?')) {
            btn.closest('.endereco-card').remove();
            alert('Endereço excluído com sucesso!');
        }
    }
    
    // Definir endereço principal
    function definirPrincipal(btn) {
        const enderecoCard = btn.closest('.endereco-card');
        const enderecos = document.querySelectorAll('.endereco-card');
        
        enderecos.forEach(end => {
            end.classList.remove('principal');
            const badge = end.querySelector('.endereco-badge');
            if (badge) badge.remove();
        });
        
        enderecoCard.classList.add('principal');
        const badge = document.createElement('div');
        badge.className = 'endereco-badge';
        badge.textContent = 'Principal';
        enderecoCard.insertBefore(badge, enderecoCard.firstChild);
        
        alert('Endereço principal atualizado com sucesso!');
    }
    
    // Confirmar logout
    function confirmarLogout() {
        if (confirm('Deseja realmente sair da sua conta?')) {
            window.location.href = "{{route('index')}}";
        }
    }
    
    // Força de senha
    document.getElementById('novaSenha')?.addEventListener('input', function() {
        const strength = this.value.length;
        const bar = document.querySelector('.strength-bar');
        const text = document.querySelector('.strength-text');
        
        if (strength === 0) {
            bar.style.width = '0%';
            bar.style.background = '#e0e0e0';
            text.textContent = 'Digite uma senha forte';
        } else if (strength < 4) {
            bar.style.width = '33%';
            bar.style.background = '#f44336';
            text.textContent = 'Senha fraca';
        } else if (strength < 8) {
            bar.style.width = '66%';
            bar.style.background = '#ff9800';
            text.textContent = 'Senha média';
        } else {
            bar.style.width = '100%';
            bar.style.background = '#4caf50';
            text.textContent = 'Senha forte!';
        }
    });
</script>
@endsection
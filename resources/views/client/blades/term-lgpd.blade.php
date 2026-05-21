<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <title>Termos LGPD | Cartório Central</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #f4f7fc;
      min-height: 100vh;
    }

    /* Container principal com layout de duas colunas */
    .lgpd-wrapper {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* Header */
    .lgpd-header {
      background: linear-gradient(135deg, #0a2b3e 0%, #1b4f6e 100%);
      padding: 1rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 1rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .logo-area {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .logo-icon {
      font-size: 2rem;
      color: #ffd966;
    }

    .logo-text {
      color: white;
      font-size: 1.3rem;
      font-weight: 700;
    }

    .logo-text span {
      color: #ffda7c;
    }

    .back-button {
      background: rgba(255, 255, 255, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.3);
      padding: 0.6rem 1.2rem;
      border-radius: 40px;
      color: white;
      text-decoration: none;
      font-weight: 500;
      font-size: 0.9rem;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .back-button:hover {
      background: rgba(255, 255, 255, 0.25);
      transform: translateY(-2px);
    }

    /* Container principal com sidebar + conteúdo */
    .lgpd-main {
      display: flex;
      flex: 1;
      max-width: 1400px;
      margin: 2rem auto;
      padding: 0 2rem;
      gap: 2rem;
    }

    /* SIDEBAR - Navegação lateral */
    .lgpd-sidebar {
      width: 280px;
      flex-shrink: 0;
      position: sticky;
      top: 90px;
      align-self: flex-start;
      max-height: calc(100vh - 100px);
      overflow-y: auto;
      background: white;
      border-radius: 20px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
      padding: 1.5rem;
    }

    .sidebar-title {
      font-size: 1rem;
      font-weight: 700;
      color: #0a2b3e;
      margin-bottom: 1.2rem;
      padding-bottom: 0.7rem;
      border-bottom: 2px solid #ffda7c;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .sidebar-nav {
      list-style: none;
    }

    .sidebar-nav li {
      margin-bottom: 0.5rem;
    }

    .sidebar-nav a {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 0.7rem 0.8rem;
      color: #4a5c6c;
      text-decoration: none;
      font-size: 0.85rem;
      font-weight: 500;
      border-radius: 12px;
      transition: all 0.2s;
    }

    .sidebar-nav a i {
      width: 20px;
      font-size: 0.9rem;
      color: #8ba0ae;
    }

    .sidebar-nav a:hover {
      background: #eef2ff;
      color: #1b4f6e;
    }

    .sidebar-nav a:hover i {
      color: #1b4f6e;
    }

    .sidebar-nav a.active {
      background: linear-gradient(135deg, #0a2b3e 0%, #1b4f6e 100%);
      color: white;
    }

    .sidebar-nav a.active i {
      color: #ffda7c;
    }

    /* ÁREA DE ANÚNCIOS */
    .ads-area {
      margin-top: 2rem;
      padding-top: 1.5rem;
      border-top: 1px solid #e2e8f0;
    }

    .ads-title {
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #8ba0ae;
      margin-bottom: 1rem;
      text-align: center;
    }

    .ad-card {
      background: linear-gradient(135deg, #f7fafc 0%, #eef2ff 100%);
      border-radius: 16px;
      padding: 1rem;
      margin-bottom: 1rem;
      text-align: center;
      transition: transform 0.2s;
      cursor: pointer;
    }

    .ad-card:hover {
      transform: translateY(-3px);
    }

    .ad-icon {
      font-size: 2rem;
      color: #1b4f6e;
      margin-bottom: 0.5rem;
    }

    .ad-card h4 {
      font-size: 0.85rem;
      font-weight: 700;
      color: #0a2b3e;
      margin-bottom: 0.3rem;
    }

    .ad-card p {
      font-size: 0.7rem;
      color: #6c7e8e;
    }

    .ad-badge {
      display: inline-block;
      background: #ffda7c;
      color: #0a2b3e;
      font-size: 0.6rem;
      font-weight: 700;
      padding: 0.2rem 0.6rem;
      border-radius: 20px;
      margin-top: 0.5rem;
    }

    /* CONTEÚDO PRINCIPAL */
    .lgpd-content {
      flex: 1;
      min-width: 0;
    }

    .lgpd-card {
      background: white;
      border-radius: 28px;
      box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .card-header {
      background: linear-gradient(135deg, #0a2b3e 0%, #1b4f6e 100%);
      padding: 2rem 2.5rem;
      color: white;
    }

    .card-header h1 {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
      gap: 12px;
      flex-wrap: wrap;
    }

    .card-header h1 i {
      color: #ffd966;
      font-size: 2rem;
    }

    .card-header p {
      opacity: 0.9;
      font-size: 0.95rem;
    }

    .last-update {
      margin-top: 1rem;
      font-size: 0.8rem;
      opacity: 0.7;
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .card-body {
      padding: 2.5rem;
    }

    /* Seções de termos */
    .terms-section {
      margin-bottom: 2rem;
      border-bottom: 1px solid #e2e8f0;
      padding-bottom: 1.5rem;
      scroll-margin-top: 100px;
    }

    .terms-section:last-child {
      border-bottom: none;
      margin-bottom: 0;
      padding-bottom: 0;
    }

    .section-title {
      font-size: 1.3rem;
      font-weight: 700;
      color: #0a2b3e;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .section-title i {
      color: #1b4f6e;
      font-size: 1.3rem;
    }

    .section-content {
      color: #2d3748;
      line-height: 1.6;
      font-size: 0.95rem;
    }

    .section-content p {
      margin-bottom: 1rem;
    }

    .section-content ul,
    .section-content ol {
      margin: 0.8rem 0 0.8rem 1.8rem;
    }

    .section-content li {
      margin-bottom: 0.5rem;
    }

    .highlight-box {
      background: #eef2ff;
      border-left: 4px solid #1b4f6e;
      padding: 1.2rem;
      border-radius: 12px;
      margin: 1rem 0;
    }

    .data-table {
      width: 100%;
      border-collapse: collapse;
      margin: 1rem 0;
    }

    .data-table th,
    .data-table td {
      border: 1px solid #e2e8f0;
      padding: 0.75rem;
      text-align: left;
      vertical-align: top;
    }

    .data-table th {
      background: #f7fafc;
      font-weight: 600;
      color: #0a2b3e;
    }

    .data-table tr:hover {
      background: #f7fafc;
    }

    /* Botões de ação */
    .action-buttons {
      margin-top: 2rem;
      padding-top: 1.5rem;
      border-top: 1px solid #e2e8f0;
      display: flex;
      gap: 1rem;
      justify-content: flex-end;
      flex-wrap: wrap;
    }

    .btn-primary {
      background: #0a2b3e;
      border: none;
      padding: 0.8rem 1.8rem;
      border-radius: 40px;
      font-weight: 600;
      font-size: 0.9rem;
      color: white;
      cursor: pointer;
      transition: all 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
    }

    .btn-primary:hover {
      background: #1b4f6e;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary {
      background: white;
      border: 2px solid #e2e8f0;
      padding: 0.8rem 1.8rem;
      border-radius: 40px;
      font-weight: 600;
      font-size: 0.9rem;
      color: #1b4f6e;
      cursor: pointer;
      transition: all 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
    }

    .btn-secondary:hover {
      border-color: #1b4f6e;
      background: #f7fafc;
    }

    /* Footer */
    .lgpd-footer {
      background: #f7fafc;
      padding: 1.5rem;
      text-align: center;
      color: #6c7e8e;
      font-size: 0.8rem;
      border-top: 1px solid #e2e8f0;
    }

    /* Scrollbar personalizada */
    .lgpd-sidebar::-webkit-scrollbar {
      width: 5px;
    }

    .lgpd-sidebar::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }

    .lgpd-sidebar::-webkit-scrollbar-thumb {
      background: #c1c1c1;
      border-radius: 10px;
    }

    /* Responsividade */
    @media (max-width: 992px) {
      .lgpd-main {
        flex-direction: column;
        padding: 0 1.5rem;
      }

      .lgpd-sidebar {
        width: 100%;
        position: relative;
        top: 0;
        max-height: none;
        margin-bottom: 1.5rem;
      }

      .sidebar-nav {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
      }

      .sidebar-nav li {
        margin-bottom: 0;
      }

      .sidebar-nav a {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
      }

      .ads-area {
        display: none;
      }
    }

    @media (max-width: 768px) {
      .lgpd-header {
        padding: 1rem 1.5rem;
      }

      .logo-text {
        font-size: 1rem;
      }

      .card-header {
        padding: 1.5rem;
      }

      .card-header h1 {
        font-size: 1.4rem;
      }

      .card-body {
        padding: 1.5rem;
      }

      .section-title {
        font-size: 1.1rem;
      }

      .data-table th,
      .data-table td {
        padding: 0.5rem;
        font-size: 0.85rem;
      }

      .action-buttons {
        justify-content: center;
      }

      .btn-primary,
      .btn-secondary {
        flex: 1;
        justify-content: center;
      }
    }

    @media (max-width: 480px) {
      .data-table {
        display: block;
        overflow-x: auto;
      }

      .section-content {
        font-size: 0.85rem;
      }
    }

    /* Scroll suave */
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>
<body>
<div class="lgpd-wrapper">
  <!-- Header -->
  <header class="lgpd-header">
    <div class="logo-area">
      <div class="logo-icon">
        <i class="fas fa-landmark"></i>
      </div>
      <div class="logo-text">
        Cartório <span>Central</span>
      </div>
    </div>
    <a href="javascript:history.back()" class="back-button">
      <i class="fas fa-arrow-left"></i> Voltar
    </a>
  </header>

  <!-- Main com sidebar + conteúdo -->
  <div class="lgpd-main">
    <!-- Sidebar de navegação -->
    <aside class="lgpd-sidebar">
      <div class="sidebar-title">
        <i class="fas fa-bars"></i>
        Navegação rápida
      </div>
      <ul class="sidebar-nav">
        <li><a href="#intro" class="nav-link"><i class="fas fa-info-circle"></i> Introdução</a></li>
        <li><a href="#dados" class="nav-link"><i class="fas fa-database"></i> Dados Coletados</a></li>
        <li><a href="#coleta" class="nav-link"><i class="fas fa-hand-holding-heart"></i> Como Coletamos</a></li>
        <li><a href="#base-legal" class="nav-link"><i class="fas fa-balance-scale"></i> Base Legal</a></li>
        <li><a href="#compartilhamento" class="nav-link"><i class="fas fa-share-alt"></i> Compartilhamento</a></li>
        <li><a href="#direitos" class="nav-link"><i class="fas fa-user-check"></i> Seus Direitos</a></li>
        <li><a href="#seguranca" class="nav-link"><i class="fas fa-shield-virus"></i> Segurança</a></li>
        <li><a href="#retencao" class="nav-link"><i class="fas fa-hourglass-half"></i> Retenção</a></li>
        <li><a href="#cookies" class="nav-link"><i class="fas fa-cookie-bite"></i> Cookies</a></li>
        <li><a href="#dpo" class="nav-link"><i class="fas fa-headset"></i> Contato DPO</a></li>
        <li><a href="#atualizacoes" class="nav-link"><i class="fas fa-sync-alt"></i> Atualizações</a></li>
        <li><a href="#consentimento" class="nav-link"><i class="fas fa-check-double"></i> Consentimento</a></li>
      </ul>

      <!-- Área de anúncios -->
      <div class="ads-area">
        <div class="ads-title">
          <i class="fas fa-tag"></i> SERVIÇOS EM DESTAQUE
        </div>
        <div class="ad-card" onclick="alert('Redirecionando para Certidão Online')">
          <div class="ad-icon">
            <i class="fas fa-file-certificate"></i>
          </div>
          <h4>Certidão Online</h4>
          <p>Emita certidões sem sair de casa</p>
          <span class="ad-badge">50% OFF</span>
        </div>
        <div class="ad-card" onclick="alert('Agende sua visita agora')">
          <div class="ad-icon">
            <i class="fas fa-calendar-check"></i>
          </div>
          <h4>Agendamento Rápido</h4>
          <p>Evite filas, agende seu horário</p>
          <span class="ad-badge">Prioridade</span>
        </div>
        <div class="ad-card" onclick="alert('Saiba mais sobre a LGPD')">
          <div class="ad-icon">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h4>Proteção de Dados</h4>
          <p>Seus dados sempre seguros</p>
          <span class="ad-badge">LGPD</span>
        </div>
        <div class="ad-card" onclick="alert('Consulte nossos serviços digitais')">
          <div class="ad-icon">
            <i class="fas fa-mobile-alt"></i>
          </div>
          <h4>App Cartório Central</h4>
          <p>Tudo na palma da sua mão</p>
          <span class="ad-badge">Baixe Grátis</span>
        </div>
      </div>
    </aside>

    <!-- Conteúdo principal -->
    <div class="lgpd-content">
      <div class="lgpd-card">
        <div class="card-header">
          <h1>
            <i class="fas fa-shield-alt"></i>
            Política de Privacidade e LGPD
          </h1>
          <p>Cartório Central - Compromisso com a proteção dos seus dados pessoais</p>
          <div class="last-update">
            <i class="far fa-calendar-alt"></i>
            Última atualização: 21 de maio de 2026
            <span style="margin-left: auto;">
              <i class="fas fa-eye"></i> Versão 2.0
            </span>
          </div>
        </div>

        <div class="card-body">
          <!-- Seções com IDs para navegação -->
          <div id="intro" class="terms-section">
            <div class="section-title">
              <i class="fas fa-info-circle"></i>
              <span>1. Introdução</span>
            </div>
            <div class="section-content">
              <p>O Cartório Central, em conformidade com a Lei Geral de Proteção de Dados Pessoais (Lei nº 13.709/2018 - LGPD), apresenta esta Política de Privacidade para demonstrar seu compromisso com a transparência, segurança e proteção dos dados pessoais dos seus clientes, colaboradores, parceiros e usuários do nosso site e sistemas.</p>
              <p>Esta política descreve como coletamos, utilizamos, armazenamos, compartilhamos e protegemos suas informações pessoais, bem como os direitos que você possui em relação aos seus dados.</p>
              <div class="highlight-box">
                <i class="fas fa-gavel"></i> <strong>Base Legal:</strong> Esta política é fundamentada na LGPD (Lei 13.709/2018) e nas normas complementares da Autoridade Nacional de Proteção de Dados (ANPD).
              </div>
            </div>
          </div>

          <div id="dados" class="terms-section">
            <div class="section-title">
              <i class="fas fa-database"></i>
              <span>2. Dados Coletados</span>
            </div>
            <div class="section-content">
              <p>Coletamos diferentes tipos de dados pessoais para diferentes finalidades:</p>
              <table class="data-table">
                <thead>
                  <tr><th>Categoria</th><th>Dados Coletados</th><th>Finalidade</th></tr>
                </thead>
                <tbody>
                  <tr><td>Dados Cadastrais</td><td>Nome completo, CPF, RG, data de nascimento</td><td>Identificação e registro de atos notariais</td></tr>
                  <tr><td>Dados de Contato</td><td>E-mail, telefone, WhatsApp, endereço</td><td>Comunicação, envio de certidões e atendimento</td></tr>
                  <tr><td>Dados de Acesso</td><td>E-mail, senha, logs de acesso, IP</td><td>Acesso ao sistema e segurança</td></tr>
                  <tr><td>Dados Documentais</td><td>Documentos digitalizados, procurações, escrituras</td><td>Execução de serviços cartorários</td></tr>
                  <tr><td>Dados de Pagamento</td><td>Informações bancárias, comprovantes</td><td>Cobrança de emolumentos e taxas</td></tr>
                </tbody>
              </table>
            </div>
          </div>

          <div id="coleta" class="terms-section">
            <div class="section-title">
              <i class="fas fa-hand-holding-heart"></i>
              <span>3. Como Coletamos Seus Dados</span>
            </div>
            <div class="section-content">
              <ul>
                <li><i class="fas fa-user-plus"></i> <strong>Cadastro no site:</strong> Quando você cria uma conta ou solicita pré-cadastro em nosso sistema.</li>
                <li><i class="fas fa-file-signature"></i> <strong>Atendimento presencial:</strong> Durante serviços realizados em nossas unidades.</li>
                <li><i class="fas fa-envelope"></i> <strong>Formulários de contato:</strong> Quando você entra em contato por e-mail ou WhatsApp.</li>
                <li><i class="fas fa-chart-line"></i> <strong>Navegação no site:</strong> Cookies e tecnologias similares para melhorar sua experiência.</li>
                <li><i class="fas fa-handshake"></i> <strong>Parceiros e fontes públicas:</strong> Quando necessário para cumprimento de obrigações legais.</li>
              </ul>
            </div>
          </div>

          <div id="base-legal" class="terms-section">
            <div class="section-title">
              <i class="fas fa-balance-scale"></i>
              <span>4. Base Legal para Tratamento</span>
            </div>
            <div class="section-content">
              <p>Tratamos seus dados pessoais com base nas seguintes hipóteses legais da LGPD:</p>
              <ul>
                <li><strong>Consentimento:</strong> Quando você aceita nossos termos e políticas.</li>
                <li><strong>Cumprimento de obrigação legal ou regulatória:</strong> Para atender às exigências do serviço cartorário e da legislação brasileira.</li>
                <li><strong>Execução de contrato:</strong> Para prestar os serviços solicitados.</li>
                <li><strong>Exercício regular de direitos:</strong> Em processos judiciais, administrativos ou arbitrais.</li>
                <li><strong>Proteção ao crédito:</strong> Quando necessário.</li>
              </ul>
            </div>
          </div>

          <div id="compartilhamento" class="terms-section">
            <div class="section-title">
              <i class="fas fa-share-alt"></i>
              <span>5. Compartilhamento de Dados</span>
            </div>
            <div class="section-content">
              <p>Seus dados pessoais podem ser compartilhados nas seguintes situações:</p>
              <ul>
                <li><i class="fas fa-gavel"></i> <strong>Autoridades públicas:</strong> Para cumprimento de ordens judiciais ou requisições de órgãos reguladores.</li>
                <li><i class="fas fa-laptop-code"></i> <strong>Fornecedores e parceiros tecnológicos:</strong> Empresas que nos auxiliam na operação do sistema.</li>
                <li><i class="fas fa-building"></i> <strong>Outros cartórios:</strong> Quando necessário para a realização de atos intercartorários.</li>
              </ul>
            </div>
          </div>

          <div id="direitos" class="terms-section">
            <div class="section-title">
              <i class="fas fa-user-check"></i>
              <span>6. Seus Direitos como Titular</span>
            </div>
            <div class="section-content">
              <ul>
                <li><i class="fas fa-check-circle"></i> <strong>Confirmação de existência</strong> - Saber se tratamos seus dados.</li>
                <li><i class="fas fa-eye"></i> <strong>Acesso</strong> - Solicitar uma cópia dos seus dados.</li>
                <li><i class="fas fa-edit"></i> <strong>Correção</strong> - Corrigir dados incompletos ou desatualizados.</li>
                <li><i class="fas fa-trash-alt"></i> <strong>Eliminação</strong> - Remover seus dados mediante solicitação.</li>
                <li><i class="fas fa-download"></i> <strong>Portabilidade</strong> - Transferir seus dados para outro fornecedor.</li>
              </ul>
            </div>
          </div>

          <div id="seguranca" class="terms-section">
            <div class="section-title">
              <i class="fas fa-shield-virus"></i>
              <span>7. Segurança dos Dados</span>
            </div>
            <div class="section-content">
              <p>Adotamos criptografia SSL/TLS, controles de acesso rigorosos, backups regulares e treinamento contínuo de colaboradores para garantir a proteção dos seus dados.</p>
            </div>
          </div>

          <div id="retencao" class="terms-section">
            <div class="section-title">
              <i class="fas fa-hourglass-half"></i>
              <span>8. Retenção de Dados</span>
            </div>
            <div class="section-content">
              <p>Mantemos seus dados pelo tempo necessário para cumprir obrigações legais, especialmente as normas do serviço cartorário. Após esse período, os dados são eliminados ou anonimizados.</p>
            </div>
          </div>

          <div id="cookies" class="terms-section">
            <div class="section-title">
              <i class="fas fa-cookie-bite"></i>
              <span>9. Uso de Cookies</span>
            </div>
            <div class="section-content">
              <p>Utilizamos cookies para melhorar sua experiência de navegação. Você pode gerenciar suas preferências através das configurações do seu navegador.</p>
            </div>
          </div>

          <div id="dpo" class="terms-section">
            <div class="section-title">
              <i class="fas fa-headset"></i>
              <span>10. Encarregado (DPO) e Contato</span>
            </div>
            <div class="section-content">
              <div class="highlight-box">
                <p><i class="fas fa-user-tie"></i> <strong>DPO: Dra. Mariana Oliveira</strong></p>
                <p><i class="fas fa-envelope"></i> <strong>E-mail:</strong> privacidade@cartoriocentral.com.br</p>
                <p><i class="fas fa-phone-alt"></i> <strong>Telefone:</strong> (11) 99999-1234</p>
              </div>
            </div>
          </div>

          <div id="atualizacoes" class="terms-section">
            <div class="section-title">
              <i class="fas fa-sync-alt"></i>
              <span>11. Atualizações desta Política</span>
            </div>
            <div class="section-content">
              <p>Esta política pode ser atualizada periodicamente. A data da última atualização está indicada no topo do documento.</p>
            </div>
          </div>

          <div id="consentimento" class="terms-section">
            <div class="section-title">
              <i class="fas fa-check-double"></i>
              <span>12. Consentimento e Aceitação</span>
            </div>
            <div class="section-content">
              <p>Ao utilizar nossos serviços, você declara estar ciente e de acordo com os termos desta Política de Privacidade.</p>
            </div>
          </div>

          <div class="action-buttons">
            <a href="javascript:window.print()" class="btn-secondary">
              <i class="fas fa-print"></i> Imprimir
            </a>
            <a href="javascript:history.back()" class="btn-primary">
              <i class="fas fa-arrow-left"></i> Voltar ao cadastro
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="lgpd-footer">
    <p><i class="fas fa-copyright"></i> 2026 Cartório Central - Todos os direitos reservados</p>
    <p style="margin-top: 0.5rem;">Compromisso com a transparência e proteção de dados pessoais</p>
  </footer>
</div>

<script>
  // Navegação com rolagem suave e destaque do item ativo
  document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const targetId = this.getAttribute('href').substring(1);
      const targetElement = document.getElementById(targetId);
      
      if (targetElement) {
        const offset = 90;
        const elementPosition = targetElement.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - offset;
        
        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });
        
        // Atualizar classe ativa
        document.querySelectorAll('.nav-link').forEach(nav => nav.classList.remove('active'));
        this.classList.add('active');
      }
    });
  });

  // Detectar seção visível ao rolar e atualizar menu ativo
  window.addEventListener('scroll', function() {
    const sections = document.querySelectorAll('.terms-section');
    const scrollPosition = window.scrollY + 100;
    
    let currentSection = '';
    sections.forEach(section => {
      const sectionTop = section.offsetTop;
      const sectionBottom = sectionTop + section.offsetHeight;
      if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
        currentSection = section.getAttribute('id');
      }
    });
    
    document.querySelectorAll('.nav-link').forEach(link => {
      link.classList.remove('active');
      const href = link.getAttribute('href').substring(1);
      if (href === currentSection) {
        link.classList.add('active');
      }
    });
  });
</script>
</body>
</html>
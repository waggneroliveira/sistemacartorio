<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login | Cartório Central</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- jQuery Mask Plugin -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    .text-success{
        color: #198754 !important;
    }
    .text-danger{
        color: #dc3545 !important;
    }
    body {
      font-family: 'Inter', sans-serif;
      background: #f4f7fc;
      height: 100vh;
      width: 100vw;
      overflow: hidden;
    }

    .login-container {
      display: flex;
      width: 100%;
      height: 100%;
      flex-direction: row;
      background: #fff;
    }

    /* LADO ESQUERDO - BANNER */
    .banner-section {
      flex: 1.4;
      background: linear-gradient(135deg, #0a2b3e 0%, #1b4f6e 100%);
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 3rem;
      overflow-y: auto;
      transition: all 0.3s ease;
    }

    .banner-content {
      max-width: 580px;
      color: white;
      text-align: left;
      z-index: 2;
    }

    .banner-icon {
      font-size: 3.2rem;
      margin-bottom: 1.5rem;
      color: #ffd966;
    }

    .banner-content h1 {
      font-size: 2.6rem;
      font-weight: 700;
      letter-spacing: -0.02em;
      line-height: 1.2;
      margin-bottom: 1.2rem;
    }

    .banner-content .highlight {
      color: #ffda7c;
      border-left: 4px solid #ffda7c;
      padding-left: 1rem;
      font-weight: 500;
    }

    .banner-description {
      font-size: 1.1rem;
      line-height: 1.5;
      margin-top: 1.2rem;
      margin-bottom: 2rem;
      opacity: 0.9;
    }

    .service-list {
      list-style: none;
      margin-top: 1.8rem;
    }

    .service-list li {
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      font-size: 1rem;
      font-weight: 400;
    }

    .service-list li i {
      width: 24px;
      color: #ffda7c;
      font-size: 1.2rem;
    }

    .banner-footer {
      margin-top: 2.5rem;
      font-size: 0.85rem;
      border-top: 1px solid rgba(255,255,255,0.2);
      padding-top: 1.5rem;
      display: inline-block;
      width: 100%;
    }

    /* LADO DIREITO - FORMULÁRIO */
    .form-section {
      flex: 0.9;
      background: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      box-shadow: -5px 0 25px rgba(0, 0, 0, 0.03);
    }

    .login-card {
      width: 100%;
      max-width: 420px;
      margin: 0 auto;
    }

    .logo-mobile {
      display: none;
      text-align: center;
      margin-bottom: 1rem;
    }

    .form-header {
      margin-bottom: 2rem;
    }

    .form-header h2 {
      font-size: 1.9rem;
      font-weight: 700;
      color: #0a2b3e;
      margin-bottom: 0.5rem;
    }

    .form-header p {
      color: #5c6f7e;
      font-size: 0.95rem;
    }

    .input-group {
      margin-bottom: 1.5rem;
      position: relative;
    }

    .input-group label {
      display: block;
      font-size: 0.85rem;
      font-weight: 600;
      margin-bottom: 0.4rem;
      color: #1f3b4a;
      letter-spacing: -0.2px;
    }

    .input-wrapper {
      position: relative;
      display: flex;
      align-items: center;
      width: 100%;
    }

    .input-wrapper i:first-child {
      position: absolute;
      left: 14px;
      color: #8ba0ae;
      font-size: 1.1rem;
      z-index: 1;
    }
    .register-input-wrapper .far.fa-eye-slash, .register-input-wrapper .far.fa-eye, 
    .input-wrapper .far.fa-eye-slash, .input-wrapper .far.fa-eye{
        left: -14px;
    }
    .input-wrapper input {
      width: 100%;
      padding: 0.9rem 0.9rem 0.9rem 2.8rem;
      padding-right: 45px;
      border: 1.5px solid #e2e8f0;
      border-radius: 14px;
      font-size: 1rem;
      font-family: 'Inter', sans-serif;
      transition: all 0.2s ease;
      background: #fefefe;
      outline: none;
    }

    .input-wrapper input:focus {
      border-color: #1b4f6e;
      box-shadow: 0 0 0 3px rgba(27, 79, 110, 0.1);
    }

    /* Botão de visualizar senha - ajustado */
    .toggle-password {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #8ba0ae;
      cursor: pointer;
      font-size: 1.1rem;
      z-index: 2;
      transition: color 0.2s;
      padding: 8px 4px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .toggle-password:hover {
      color: #1b4f6e;
    }

    .forgot-password {
      text-align: right;
      margin-bottom: 1.8rem;
    }

    .forgot-password a {
      font-size: 0.8rem;
      color: #1b4f6e;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.2s;
    }

    .forgot-password a:hover {
      color: #0a2b3e;
      text-decoration: underline;
    }

    .btn-login {
      width: 100%;
      background: #0a2b3e;
      border: none;
      padding: 0.9rem;
      border-radius: 40px;
      font-weight: 700;
      font-size: 1rem;
      color: white;
      cursor: pointer;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-bottom: 1.5rem;
    }

    .btn-login:hover {
      background: #1b4f6e;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .register-link {
      text-align: center;
      font-size: 0.9rem;
      color: #4a5c6c;
    }

    .register-link a {
      color: #1b4f6e;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .register-link a:hover {
      text-decoration: underline;
    }

    /* Área de mensagens */
    .message-area {
      margin-top: 1rem;
      background: #eef2ff;
      border-left: 4px solid #1b4f6e;
      padding: 0.7rem;
      border-radius: 12px;
      font-size: 0.8rem;
      color: #1f3b4a;
      text-align: center;
    }

    .message-area.error {
      background: #ffe6e5;
      border-left-color: #b91c1c;
    }

    .message-area.success {
      background: #e0f2fe;
      border-left-color: #198754;
    }

    /* MODAL DE CADASTRO */
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(4px);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1000;
      visibility: hidden;
      opacity: 0;
      transition: visibility 0.2s, opacity 0.2s;
    }

    .modal-overlay.active {
      visibility: visible;
      opacity: 1;
    }

    .modal-container {
      background: white;
      width: 90%;
      max-width: 540px;
      border-radius: 28px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
      overflow: hidden;
      transform: scale(0.95);
      transition: transform 0.2s ease;
      max-height: 90vh;
      display: flex;
      flex-direction: column;
    }

    .modal-overlay.active .modal-container {
      transform: scale(1);
    }

    .modal-header {
      background: #0a2b3e;
      color: white;
      padding: 1.2rem 1.8rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-shrink: 0;
    }

    .modal-header h3 {
      font-size: 1.3rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.6rem;
    }

    .modal-close {
      background: none;
      border: none;
      color: white;
      font-size: 1.8rem;
      cursor: pointer;
      line-height: 1;
      transition: opacity 0.2s;
    }

    .modal-close:hover {
      opacity: 0.7;
    }

    .modal-body {
      padding: 1.8rem;
      overflow-y: auto;
      flex: 1;
    }

    .modal-body::-webkit-scrollbar {
      width: 5px;
    }

    .modal-body::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }

    .modal-body::-webkit-scrollbar-thumb {
      background: #c1c1c1;
      border-radius: 10px;
    }

    .register-input-group {
      margin-bottom: 1.2rem;
    }

    .register-input-group label {
      display: block;
      font-size: 0.85rem;
      font-weight: 600;
      margin-bottom: 0.4rem;
      color: #1f3b4a;
    }

    .register-input-wrapper {
      position: relative;
      display: flex;
      align-items: center;
      width: 100%;
    }

    .register-input-wrapper i:first-child {
      position: absolute;
      left: 14px;
      color: #8ba0ae;
      font-size: 1rem;
      z-index: 1;
    }

    .register-input-wrapper input {
      width: 100%;
      padding: 0.8rem 0.8rem 0.8rem 2.8rem;
      padding-right: 45px;
      border: 1.5px solid #e2e8f0;
      border-radius: 14px;
      font-size: 0.95rem;
      font-family: 'Inter', sans-serif;
      transition: all 0.2s;
      outline: none;
    }

    .register-input-wrapper input:focus {
      border-color: #1b4f6e;
      box-shadow: 0 0 0 3px rgba(27, 79, 110, 0.1);
    }

    /* Botão de visualizar senha no modal */
    .register-input-wrapper .toggle-password {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #8ba0ae;
      cursor: pointer;
      font-size: 1rem;
      z-index: 2;
      transition: color 0.2s;
      padding: 8px 4px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .register-input-wrapper .toggle-password:hover {
      color: #1b4f6e;
    }

    .checkbox-group {
      display: flex;
      align-items: flex-start;
      gap: 0.75rem;
      margin: 1rem 0 1.2rem;
    }

    .checkbox-group input {
      width: 18px;
      height: 18px;
      margin-top: 2px;
      accent-color: #0a2b3e;
      cursor: pointer;
      flex-shrink: 0;
    }

    .checkbox-group label {
      font-size: 0.8rem;
      color: #2d4a62;
      line-height: 1.4;
      cursor: pointer;
    }

    .checkbox-group a {
      color: #1b4f6e;
      text-decoration: none;
      font-weight: 600;
    }

    .checkbox-group a:hover {
      text-decoration: underline;
    }

    .btn-register-submit {
      width: 100%;
      background: #0a2b3e;
      border: none;
      padding: 0.85rem;
      border-radius: 40px;
      font-weight: 700;
      font-size: 1rem;
      color: white;
      cursor: pointer;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-top: 0.5rem;
    }

    .btn-register-submit:hover {
      background: #1b4f6e;
      transform: translateY(-2px);
    }

    .modal-message {
      margin-top: 1rem;
      padding: 0.7rem;
      border-radius: 12px;
      font-size: 0.8rem;
      display: none;
    }

    .modal-message.show {
      display: block;
    }
    .modal-message.error {
      background: #ffe6e5;
      border-left: 4px solid #b91c1c;
    }
    .modal-message.success {
      background: #e0f2fe;
      border-left: 4px solid #198754;
    }

    .info-text {
      font-size: 0.7rem;
      text-align: center;
      margin-top: 1rem;
      color: #6c7e8e;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 5px;
    }

    /* MODAL DE SUCESSO (VERIFICAÇÃO DE E-MAIL) */
    .success-modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.7);
      backdrop-filter: blur(5px);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 2000;
      visibility: hidden;
      opacity: 0;
      transition: visibility 0.3s, opacity 0.3s;
    }

    .success-modal-overlay.active {
      visibility: visible;
      opacity: 1;
    }

    .success-modal-container {
      background: white;
      width: 90%;
      max-width: 450px;
      border-radius: 28px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.3);
      transform: scale(0.9);
      transition: transform 0.3s ease;
      overflow: hidden;
    }

    .success-modal-overlay.active .success-modal-container {
      transform: scale(1);
    }

    .success-modal-content {
      padding: 2rem;
      text-align: center;
    }

    .success-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, #0a2b3e 0%, #1b4f6e 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.5rem;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0%, 100% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(27, 79, 110, 0.4);
      }
      50% {
        transform: scale(1.05);
        box-shadow: 0 0 0 15px rgba(27, 79, 110, 0);
      }
    }

    .success-icon svg {
      width: 45px;
      height: 45px;
      color: #ffd966;
    }

    .success-modal-content h2 {
      font-size: 1.8rem;
      font-weight: 700;
      color: #0a2b3e;
      margin-bottom: 0.8rem;
    }

    .success-modal-content .email-highlight {
      font-weight: 600;
      color: #1b4f6e;
      background: #eef2ff;
      padding: 0.2rem 0.6rem;
      border-radius: 20px;
      display: inline-block;
      margin-top: 0.3rem;
    }

    .success-message-box {
      background: #eef2ff;
      border-left: 4px solid #1b4f6e;
      border-radius: 12px;
      padding: 1rem;
      margin: 1.5rem 0;
      text-align: left;
    }

    .success-message-box .flex {
      display: flex;
      gap: 0.75rem;
      align-items: flex-start;
    }

    .success-message-box svg {
      width: 20px;
      height: 20px;
      color: #1b4f6e;
      flex-shrink: 0;
    }

    .resend-btn {
      background: none;
      border: none;
      color: #1b4f6e;
      font-weight: 600;
      cursor: pointer;
      font-size: 0.9rem;
      transition: color 0.2s;
    }

    .resend-btn:hover {
      color: #0a2b3e;
      text-decoration: underline;
    }

    .back-to-login {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: #0a2b3e;
      color: white;
      padding: 0.7rem 1.5rem;
      border-radius: 40px;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.9rem;
      transition: all 0.2s;
      margin-top: 0.5rem;
      border: none;
      cursor: pointer;
    }

    .back-to-login:hover {
      background: #1b4f6e;
      transform: translateY(-2px);
    }

    .divider {
      border-top: 1px solid #e2e8f0;
      margin: 1rem 0;
    }

    /* RESPONSIVIDADE */
    @media (max-width: 992px) {
      .banner-section {
        flex: 1.2;
        padding: 2rem;
      }
      .banner-content h1 {
        font-size: 2rem;
      }
      .banner-description {
        font-size: 0.95rem;
      }
      .form-section {
        flex: 1;
      }
    }

    @media (max-width: 768px) {
      body {
        overflow: auto;
      }
      .login-container {
        flex-direction: column;
        height: auto;
        min-height: 100vh;
      }
      .banner-section {
        flex: auto;
        width: 100%;
        min-height: 40vh;
        padding: 2rem 1.5rem;
        text-align: center;
      }
      .banner-content {
        text-align: center;
        max-width: 100%;
      }
      .service-list li {
        justify-content: center;
      }
      .banner-content h1 {
        font-size: 1.8rem;
      }
      .highlight {
        border-left: none !important;
        padding-left: 0 !important;
        display: inline-block;
      }
      .form-section {
        flex: auto;
        width: 100%;
        padding: 2rem 1.5rem;
        box-shadow: none;
      }
      .logo-mobile {
        display: block;
      }
      .form-header h2 {
        font-size: 1.7rem;
      }
      .login-card {
        max-width: 100%;
      }
      .modal-body {
        padding: 1.5rem;
      }
      .modal-container {
        max-height: 85vh;
      }
      .success-modal-content h2 {
        font-size: 1.4rem;
      }
    }

    @media (max-width: 480px) {
      .banner-content h1 {
        font-size: 1.6rem;
      }
      .service-list li {
        font-size: 0.85rem;
      }
      .btn-login {
        padding: 0.8rem;
      }
      .modal-header h3 {
        font-size: 1.1rem;
      }
    }
  </style>
</head>
<body>
<div class="login-container">
  <!-- Banner esquerdo -->
  <div class="banner-section">
    <div class="banner-content">
      <div class="banner-icon">
        <i class="fas fa-landmark"></i>
      </div>
      <h1>Cartório <span class="highlight">Central</span><br>Confiança e Agilidade</h1>
      <p class="banner-description">
        Há mais de 30 anos oferecendo segurança jurídica e serviços notariais de excelência. 
        Digitalize processos, agilize suas demandas e tenha acesso a documentos com total transparência.
      </p>
      <ul class="service-list">
        <li><i class="fas fa-check-circle"></i> Registro de Imóveis e Certidões</li>
        <li><i class="fas fa-file-signature"></i> Tabelionato de Notas & Procurações</li>
        <li><i class="fas fa-handshake"></i> Autenticações e Reconhecimento de Firmas</li>
        <li><i class="fas fa-chart-line"></i> Plataforma digital integrada 24h</li>
        <li><i class="fas fa-shield-alt"></i> Segurança e validação com selo digital</li>
      </ul>
      <div class="banner-footer">
        <i class="fas fa-clock"></i> Atendimento remoto facilitado | Selo de qualidade Cartório Cidadão
      </div>
    </div>
  </div>

  <!-- Formulário de Login -->
  <div class="form-section">
    <div class="login-card">
      <div class="logo-mobile">
        <i class="fas fa-gavel" style="font-size: 2rem; color: #0a2b3e;"></i>
      </div>
      <div class="form-header">
        <h2>Acessar minha conta</h2>
        <p>Informe seus dados para acessar o sistema do Cartório</p>
      </div>

      <form id="loginForm" action="{{ route('client.user.authenticate') }}" method="POST">
        @csrf
        <div class="input-group">
          <label for="email">E-mail</label>
          <div class="input-wrapper">
            <i class="fas fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="seu@email.com" required autocomplete="email">
          </div>
        </div>

        <div class="input-group">
          <label for="password">Senha</label>
          <div class="input-wrapper">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
            <button type="button" class="toggle-password" data-target="password">
              <i class="far fa-eye-slash"></i>
            </button>
          </div>
        </div>

        <div class="forgot-password">
          <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
        </div>

        <button type="submit" class="btn-login">
          <i class="fas fa-arrow-right-to-bracket"></i> Entrar
        </button>
        <div class="register-link">
          <a id="openRegisterModal">
            <i class="fas fa-user-plus"></i> Criar nova conta → Pré-cadastro gratuito
          </a>
        </div>
      </form>

      <div id="messageArea" class="message-area">
        @if(session('error'))
            <div class="text-danger">
                <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
            </div>
        @elseif(session('success'))
            <div class="text-success">
                <i class="fas fa-circle-check"></i> {{ session('success') }}
            </div>
        @else
          <i class="fas fa-info-circle"></i> Ainda não tem acesso? Crie sua conta agora mesmo!
        @endif
      </div>
    </div>
  </div>
</div>

<!-- MODAL DE PRÉ-CADASTRO -->
<div id="registerModal" class="modal-overlay">
  <div class="modal-container">
    <div class="modal-header">
      <h3><i class="fas fa-user-plus"></i> Criar nova conta</h3>
      <button class="modal-close" id="closeModalBtn">&times;</button>
    </div>
    <div class="modal-body">
      <form id="registerForm" method="POST" action="{{ route('register-client') }}">
        @csrf
        <div class="register-input-group">
          <label for="reg_name">Nome completo *</label>
          <div class="register-input-wrapper">
            <i class="fas fa-user"></i>
            <input type="text" id="reg_name" name="name" placeholder="Digite seu nome completo" required autocomplete="name">
          </div>
        </div>

        <div class="register-input-group">
          <label for="reg_email">E-mail *</label>
          <div class="register-input-wrapper">
            <i class="fas fa-envelope"></i>
            <input type="email" id="reg_email" name="email" placeholder="seu@email.com" required autocomplete="email">
          </div>
        </div>

        <div class="register-input-group">
          <label for="reg_whatsapp">WhatsApp *</label>
          <div class="register-input-wrapper">
            <i class="fab fa-whatsapp"></i>
            <input type="tel" id="reg_whatsapp" name="whatsapp" placeholder="(99) 99999-9999" required>
          </div>
        </div>

        <div class="register-input-group">
          <label for="reg_password">Senha *</label>
          <div class="register-input-wrapper">
            <i class="fas fa-lock"></i>
            <input type="password" id="reg_password" name="password" placeholder="Crie uma senha forte" required>
            <button type="button" class="toggle-password" data-target="reg_password">
              <i class="far fa-eye-slash"></i>
            </button>
          </div>
        </div>

        <div class="checkbox-group">
          <input type="checkbox" id="lgpd_accept" name="lgpd_accept" required>
          <label for="lgpd_accept">
            Li e aceito os <a href="{{ route('lgpd-index') }}" target="_blank">termos da LGPD</a> e autorizo o tratamento dos meus dados conforme a Política de Privacidade do Cartório.
          </label>
        </div>

        <button type="submit" class="btn-register-submit">
          <i class="fas fa-paper-plane"></i> Solicitar pré-cadastro
        </button>

        <div id="modalMessage" class="modal-message"></div>
        <div class="info-text">
          <i class="fas fa-envelope"></i> Após enviar, você receberá um link de verificação por e‑mail para ativar sua conta.
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL DE SUCESSO (VERIFICAÇÃO DE E-MAIL) -->
<div id="successModal" class="success-modal-overlay">
  <div class="success-modal-container">
    <div class="success-modal-content">
      <div class="success-icon">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
        </svg>
      </div>
      <h2>Verifique seu e-mail</h2>
      <p style="margin-bottom: 0.5rem; color: #4a5c6c;">
        Enviamos um link de confirmação para
      </p>
      <span class="email-highlight" id="successEmail">usuario@exemplo.com</span>
      
      <div class="success-message-box">
        <div class="flex">
          <svg fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
          </svg>
          <p style="font-size: 0.9rem; color: #1f3b4a;">
            Confirme seu e-mail clicando no link que enviamos para você.
          </p>
        </div>
      </div>
      
      <p style="font-size: 0.9rem; color: #6c7e8e;">
        Não recebeu o e-mail?
        <button type="button" id="resendEmailBtn" class="resend-btn">
          Reenviar e-mail de confirmação
        </button>
      </p>
      
      <div class="divider"></div>
      
      <button id="closeSuccessAndGoToLogin" class="back-to-login">
        <i class="fas fa-arrow-left"></i> Voltar para o login
      </button>
    </div>
  </div>
</div>

<script>
  (function() {
    // Máscara para WhatsApp
    if (typeof $ !== 'undefined' && $.fn.mask) {
      $('#reg_whatsapp').mask('(00) 00000-0000');
    } else {
      const whatsappField = document.getElementById('reg_whatsapp');
      if (whatsappField) {
        whatsappField.addEventListener('input', function(e) {
          let value = e.target.value.replace(/\D/g, '');
          if (value.length > 11) value = value.slice(0, 11);
          if (value.length > 2) {
            value = `(${value.slice(0,2)}) ${value.slice(2,7)}-${value.slice(7,11)}`;
          } else if (value.length > 0) {
            value = `(${value}`;
          }
          e.target.value = value;
        });
      }
    }

    // Visualizar senha
    function setupTogglePassword(button) {
      const targetId = button.getAttribute('data-target');
      const passwordInput = document.getElementById(targetId);
      if (!passwordInput) return;

      button.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        const icon = button.querySelector('i');
        if (icon) {
          icon.classList.toggle('fa-eye-slash');
          icon.classList.toggle('fa-eye');
        }
      });
    }

    document.querySelectorAll('.toggle-password').forEach(btn => setupTogglePassword(btn));

    // Modal de cadastro
    const modal = document.getElementById('registerModal');
    const openBtn = document.getElementById('openRegisterModal');
    const closeBtn = document.getElementById('closeModalBtn');
    const modalMessageDiv = document.getElementById('modalMessage');

    // Modal de sucesso
    const successModal = document.getElementById('successModal');
    
    function showSuccessModal(email) {
      document.getElementById('successEmail').textContent = email;
      successModal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeSuccessModal() {
      successModal.classList.remove('active');
      if (window.innerWidth <= 768) {
        document.body.style.overflow = 'auto';
      } else {
        document.body.style.overflow = 'hidden';
      }
    }

    if (openBtn) {
      openBtn.addEventListener('click', function(e) {
        e.preventDefault();
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
        if (modalMessageDiv) {
          modalMessageDiv.innerHTML = '';
          modalMessageDiv.classList.remove('show', 'error', 'success');
        }
        const form = document.getElementById('registerForm');
        if (form) form.reset();
        document.querySelectorAll('.toggle-password').forEach(btn => {
          const targetId = btn.getAttribute('data-target');
          const input = document.getElementById(targetId);
          if (input && input.getAttribute('type') !== 'password') {
            input.setAttribute('type', 'password');
            const icon = btn.querySelector('i');
            if (icon && icon.classList.contains('fa-eye')) {
              icon.classList.remove('fa-eye');
              icon.classList.add('fa-eye-slash');
            }
          }
        });
      });
    }

    function closeModal() {
      modal.classList.remove('active');
      if (window.innerWidth <= 768) {
        document.body.style.overflow = 'auto';
      } else {
        document.body.style.overflow = 'hidden';
      }
    }

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', function(e) {
      if (e.target === modal) closeModal();
    });

    // Interceptar o submit do formulário para tratar sucesso via AJAX
    const registerFormElem = document.getElementById('registerForm');
    if (registerFormElem) {
      registerFormElem.addEventListener('submit', function(e) {
        // Validações básicas antes de enviar
        const name = document.getElementById('reg_name')?.value.trim();
        const email = document.getElementById('reg_email')?.value.trim();
        const whatsapp = document.getElementById('reg_whatsapp')?.value.trim();
        const password = document.getElementById('reg_password')?.value;
        const lgpd = document.getElementById('lgpd_accept')?.checked;

        if (!name || !email || !whatsapp || !password) {
          e.preventDefault();
          showModalMessage('Preencha todos os campos obrigatórios.', true);
          return;
        }
        const emailRegex = /^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$/;
        if (!emailRegex.test(email)) {
          e.preventDefault();
          showModalMessage('Informe um e-mail válido.', true);
          return;
        }
        const whatsappDigits = whatsapp.replace(/\D/g, '');
        if (whatsappDigits.length < 10) {
          e.preventDefault();
          showModalMessage('Informe um número de WhatsApp válido com DDD.', true);
          return;
        }
        if (!lgpd) {
          e.preventDefault();
          showModalMessage('Você precisa aceitar os termos da LGPD para continuar.', true);
          return;
        }

        // Se passou nas validações, deixa o formulário enviar normalmente
        // Mas vamos adicionar um listener para capturar a resposta do servidor via session
        // O Laravel redirecionará com session('success') ou session('error')
        // Como o formulário é submetido normalmente, a página recarregará
        // Precisamos verificar na próxima carga se há uma session de sucesso para abrir o modal
        
        const submitBtn = registerFormElem.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-pulse"></i> Enviando...';
        submitBtn.disabled = true;
        
        // O formulário será enviado, e a página recarregará
        // O código abaixo será executado, mas a página vai recarregar
        setTimeout(() => {
          if (submitBtn.disabled === true && document.body.contains(submitBtn)) {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
          }
        }, 5000);
      });
    }

    // Verificar se há uma session de sucesso do cadastro e abrir o modal
    @if(session('cadastro_success'))
        // Usar múltiplos eventos para garantir
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                showSuccessModal('{{ session('cadastro_email') }}');
            });
        } else {
            // DOM já está carregado
            showSuccessModal('{{ session('cadastro_email') }}');
        }
        
        // Fallback: tentar novamente após um pequeno delay
        setTimeout(function() {
            if (document.getElementById('successModal') && !document.getElementById('successModal').classList.contains('active')) {
                showSuccessModal('{{ session('cadastro_email') }}');
            }
        }, 500);
    @endif

    function showModalMessage(message, isError = false) {
      if (modalMessageDiv) {
        modalMessageDiv.innerHTML = `<i class="fas ${isError ? 'fa-exclamation-triangle' : 'fa-circle-check'}"></i> ${message}`;
        modalMessageDiv.classList.add('show');
        if (isError) {
          modalMessageDiv.classList.add('error');
          modalMessageDiv.classList.remove('success');
        } else {
          modalMessageDiv.classList.add('success');
          modalMessageDiv.classList.remove('error');
        }
        setTimeout(() => {
          if (modalMessageDiv) modalMessageDiv.classList.remove('show');
        }, 4000);
      }
    }

    // Reenviar e-mail
    const resendBtn = document.getElementById('resendEmailBtn');
    if (resendBtn) {
      resendBtn.addEventListener('click', function() {
        const email = document.getElementById('successEmail').textContent;
        // Fazer requisição AJAX para reenviar o e-mail
        fetch('{{ route('resend.verification') }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
          alert(data.message || 'E-mail de confirmação reenviado com sucesso!');
        })
        .catch(error => {
          alert('Erro ao reenviar o e-mail. Tente novamente.');
        });
      });
    }

    // Fechar modal de sucesso e voltar ao login
    const closeSuccessBtn = document.getElementById('closeSuccessAndGoToLogin');
    if (closeSuccessBtn) {
      closeSuccessBtn.addEventListener('click', function(e) {
        e.preventDefault();
        closeSuccessModal();
      });
    }

    // Clicar fora do modal de sucesso fecha
    successModal.addEventListener('click', function(e) {
      if (e.target === successModal) closeSuccessModal();
    });

    function handleOverflow() {
      if (window.innerWidth <= 768) {
        document.body.style.overflow = 'auto';
      } else {
        if (!modal || !modal.classList.contains('active')) {
          document.body.style.overflow = 'hidden';
        }
      }
    }

    window.addEventListener('resize', function() {
      if (modal && modal.classList.contains('active')) {
        document.body.style.overflow = 'hidden';
      } else if (successModal && successModal.classList.contains('active')) {
        document.body.style.overflow = 'hidden';
      } else {
        handleOverflow();
      }
    });

    if (window.innerWidth <= 768) {
      document.body.style.overflow = 'auto';
    } else {
      document.body.style.overflow = 'hidden';
    }
  })();
</script>
</body>
</html>
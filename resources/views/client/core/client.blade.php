<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#0a2b3e">
    <meta name="description" content="Cartório Central - Confiança e Agilidade em serviços notariais e registros">
    <meta name="keywords" content="cartório, registro de imóveis, certidões, tabelionato de notas, autenticação, reconhecimento de firma">
    <title>Cartório Central | Portal do Cliente</title>
    
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="copyright" content="Cartório Central">
    <meta name="author" content="Cartório Central">
    <link rel="shortcut icon" href="{{ asset('build/client/images/favicon.png') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f4f7fc;
            overflow-x: hidden;
        }
        
        /* ========== HEADER CARTÓRIO CENTRAL ========== */
        .top-bar {
            background: #0a2b3e;
            color: rgba(255,255,255,0.75);
            font-size: 0.8rem;
            padding: 8px 0;
        }
        
        .top-bar a {
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .top-bar a:hover {
            color: #ffd966;
        }
        
        .navbar-custom {
            background: #ffffff;
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
            padding: 0.8rem 0;
        }
        
        .navbar-brand {
            font-weight: 800;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #0a2b3e 0%, #1b4f6e 100%);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.6rem;
        }
        
        .navbar-brand i {
            background: linear-gradient(135deg, #0a2b3e, #1b4f6e);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.8rem;
        }
        
        .nav-link-custom {
            color: #2c3e35 !important;
            font-weight: 500;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 40px;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-link-custom:hover {
            background: #f0f7f3;
            color: #1b4f6e !important;
            transform: translateY(-2px);
        }
        
        .nav-link-custom.active {
            background: #0a2b3e;
            color: white !important;
        }
        
        /* User Dropdown Melhorado */
        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 6px 12px;
            border-radius: 50px;
            transition: all 0.3s ease;
            background: #f8fbf9;
        }
        
        .user-dropdown:hover {
            background: #e8f0ec;
        }
        
        .user-avatar {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #0a2b3e, #1b4f6e);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
        }
        
        .user-name {
            font-weight: 700;
            color: #0a2b3e;
            font-size: 0.9rem;
            line-height: 1.3;
        }
        
        .user-role {
            font-size: 0.7rem;
            color: #7a8f85;
        }
        
        .dropdown-menu-custom {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-top: 12px;
            padding: 8px 0;
            min-width: 220px;
        }
        
        .dropdown-menu-custom .dropdown-item {
            padding: 10px 20px;
            font-size: 0.85rem;
            transition: all 0.2s;
        }
        
        .dropdown-menu-custom .dropdown-item i {
            width: 20px;
            margin-right: 10px;
            color: #1b4f6e;
        }
        
        .dropdown-menu-custom .dropdown-item:hover {
            background: #f0f7f3;
            color: #0a2b3e;
        }
        
        .dropdown-menu-custom .dropdown-divider {
            margin: 6px 0;
        }
        
        /* Notification Badge */
        .notification-badge {
            position: relative;
            cursor: pointer;
        }
        
        .notification-icon {
            width: 40px;
            height: 40px;
            background: #f8fbf9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .notification-icon:hover {
            background: #e8f0ec;
        }
        
        .notification-icon i {
            font-size: 1.2rem;
            color: #1b4f6e;
        }
        
        .badge-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #e74c3c;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.65rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        /* Botão Voltar ao Topo */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #0a2b3e;
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }
        
        .back-to-top:hover {
            background: #ffd966;
            color: #0a2b3e;
            transform: translateY(-5px);
        }
        
        /* ========== FOOTER CARTÓRIO CENTRAL ========== */
        .footer {
            background: linear-gradient(135deg, #0a2b3e 0%, #0d3527 100%);
            color: #e0e7e3;
            margin-top: 4rem;
            position: relative;
        }
        
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffd966, #1b4f6e, #ffd966);
        }
        
        .footer h5 {
            color: #ffd966;
            font-weight: 700;
            margin-bottom: 1.2rem;
            position: relative;
            display: inline-block;
            font-size: 1.1rem;
        }
        
        .footer h5::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 3px;
            background: #ffd966;
            border-radius: 2px;
        }
        
        .footer-links {
            list-style: none;
            padding-left: 0;
        }
        
        .footer-links li {
            margin-bottom: 0.75rem;
        }
        
        .footer-links a {
            color: #c0d4cc;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }
        
        .footer-links a:hover {
            color: #ffd966;
            transform: translateX(5px);
        }
        
        .social-icon {
            width: 38px;
            height: 38px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            margin-right: 0.5rem;
        }
        
        .social-icon:hover {
            background: #ffd966;
            transform: translateY(-3px);
        }
        
        .social-icon:hover i {
            color: #0a2b3e !important;
        }
        
        .contact-info p {
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.9rem;
        }
        
        .contact-info i {
            width: 24px;
            color: #ffd966;
            font-size: 1rem;
        }
        
        .newsletter-input {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 50px;
            padding: 0.7rem 1.2rem;
            color: white;
            width: 100%;
        }
        
        .newsletter-input::placeholder {
            color: rgba(255,255,255,0.6);
        }
        
        .newsletter-input:focus {
            background: rgba(255,255,255,0.15);
            border-color: #ffd966;
            outline: none;
            box-shadow: none;
        }
        
        .btn-newsletter {
            background: #ffd966;
            color: #0a2b3e;
            border: none;
            border-radius: 50px;
            padding: 0.7rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-newsletter:hover {
            background: #ffcd38;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255,217,102,0.3);
        }
        
        .footer-bottom {
            background: rgba(0,0,0,0.3);
            padding: 1.5rem 0;
            margin-top: 3rem;
        }
        
        .footer-bottom a {
            color: #ffd966;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-bottom a:hover {
            color: white;
            text-decoration: underline;
        }
        
        .footer-bottom small {
            font-size: 0.8rem;
            opacity: 0.8;
        }
        
        .payment-methods {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        
        .payment-methods i {
            font-size: 1.8rem;
            opacity: 0.7;
            transition: opacity 0.3s, transform 0.3s;
            cursor: pointer;
        }
        
        .payment-methods i:hover {
            opacity: 1;
            transform: translateY(-2px);
        }
        
        .security-badges .badge {
            background: rgba(255,255,255,0.15) !important;
            color: #ffd966 !important;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 50px;
        }
        
        .security-badges .badge i {
            margin-right: 6px;
        }
        
        /* Animações */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease;
        }
        
        /* Responsividade */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.3rem;
            }
            
            .nav-link-custom {
                margin: 0.3rem 0;
            }
            
            .user-dropdown {
                padding: 4px 8px;
            }
            
            .user-name {
                display: none;
            }
            
            .user-role {
                display: none;
            }
            
            .footer h5::after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .footer h5 {
                text-align: center;
                display: block;
            }
            
            .contact-info p {
                justify-content: center;
            }
            
            .footer-links a {
                justify-content: center;
            }
            
            .social-icons {
                text-align: center;
                margin-top: 1rem;
            }
            
            .back-to-top {
                bottom: 20px;
                right: 20px;
                width: 40px;
                height: 40px;
            }
            
            .payment-methods {
                justify-content: center;
                margin-bottom: 1rem;
            }
            
            .security-badges {
                text-align: center;
            }
        }
        
        @media (max-width: 480px) {
            .notification-badge {
                display: none;
            }
            
            .footer-bottom .row {
                text-align: center;
            }
            
            .footer-bottom .col-md-6 {
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body>

    <!-- HEADER CARTÓRIO CENTRAL -->
    <header>
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <small>
                            <i class="bi bi-clock me-1"></i> Segunda a Sexta: 8h às 18h | 
                            <i class="bi bi-telephone ms-2 me-1"></i> (11) 4000-1234
                        </small>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <small>
                            <a href="#" class="me-3"><i class="bi bi-envelope me-1"></i> contato@cartoriocentral.com</a>
                            <a href="#"><i class="bi bi-whatsapp me-1"></i> (11) 99999-9999</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Navbar Principal -->
        <nav class="navbar navbar-custom navbar-expand-lg sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <i class="bi bi-file-text-fill me-2"></i>Cartório Central
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom {{ request()->routeIs('index') ? 'active' : '' }}" href="{{ route('index') }}">
                                <i class="bi bi-house-door me-1"></i>Início
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom {{ request()->routeIs('orders') ? 'active' : '' }}" href="{{ route('orders') }}">
                                <i class="bi bi-files me-1"></i>Meus Pedidos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                                <i class="bi bi-question-circle me-1"></i>Atendimento
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom {{ request()->routeIs('payment') ? 'active' : '' }}" href="{{ route('payment') }}">
                                <i class="bi bi-coin me-2"></i>Pagamentos
                            </a>
                        </li>
                    </ul>
                    
                    <div class="d-flex align-items-center gap-3">
                        <!-- Botão de notificações -->
                        <div class="notification-badge">
                            <div class="notification-icon">
                                <i class="bi bi-bell"></i>
                            </div>
                            <span class="badge-count">3</span>
                        </div>
                        
                        <!-- Dropdown do usuário -->
                        <div class="dropdown">
                            <div class="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div class="user-info">
                                    <span class="user-name">{{ Auth::guard('client')->user()->name ?? 'Cliente' }}</span>
                                    <span class="user-role">Cliente Gold</span>
                                </div>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom">
                                <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi bi-person"></i> Meu Perfil</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Configurações</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-shield-lock"></i> Segurança</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="{{ route('client.user.logout') }}"><i class="bi bi-box-arrow-right"></i> Sair</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="container py-4 py-md-5">
        @yield('content')
    </main>

    <!-- FOOTER CARTÓRIO CENTRAL -->
    <footer class="footer">
        <div class="container pt-5 pb-3">
            <div class="row g-4">
                <!-- Coluna 1: Logo e descrição -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="mb-3">
                        <i class="bi bi-file-text-fill fs-1" style="color: #ffd966;"></i>
                        <h4 class="text-white mt-2 fw-bold">Cartório Central</h4>
                    </div>
                    <p class="mb-3" style="color: #c0d4cc; line-height: 1.6;">
                        Há mais de 30 anos oferecendo segurança jurídica e serviços notariais de excelência. 
                        Digitalize processos, agilize suas demandas e tenha acesso a documentos com total transparência.
                    </p>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="bi bi-facebook text-white"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-instagram text-white"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-linkedin text-white"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-youtube text-white"></i></a>
                    </div>
                </div>
                
                <!-- Coluna 2: Links rápidos -->
                <div class="col-lg-2 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <h5>Navegação</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('index') }}"><i class="bi bi-chevron-right"></i> Início</a></li>
                        <li><a href="{{ route('orders') }}"><i class="bi bi-chevron-right"></i> Meus Pedidos</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Serviços</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Preços</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Blog</a></li>
                    </ul>
                </div>
                
                <!-- Coluna 3: Atendimento -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <h5>Atendimento</h5>
                    <div class="contact-info">
                        <p><i class="bi bi-telephone-fill"></i> (11) 4000-1234</p>
                        <p><i class="bi bi-whatsapp"></i> (11) 99999-9999</p>
                        <p><i class="bi bi-envelope-fill"></i> contato@cartoriocentral.com</p>
                        <p><i class="bi bi-clock-fill"></i> Seg-Sex: 8h às 18h</p>
                        <p><i class="bi bi-geo-alt-fill"></i> São Paulo - SP</p>
                    </div>
                </div>
                
                <!-- Coluna 4: Newsletter -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <h5>Newsletter</h5>
                    <p style="color: #c0d4cc; font-size: 0.9rem;">Receba novidades e ofertas exclusivas</p>
                    <div class="input-group mb-3">
                        <input type="email" class="newsletter-input" placeholder="Seu melhor e-mail">
                    </div>
                    <button class="btn-newsletter">
                        <i class="bi bi-send me-2"></i>Cadastrar
                    </button>
                    <p class="mt-3 small" style="color: #8aa99a;">
                        <i class="bi bi-shield-check"></i> Seu e-mail está seguro
                    </p>
                </div>
            </div>
            
            <!-- Selos de segurança e parcerias -->
            <div class="row mt-4 pt-3" data-aos="fade-up" data-aos-delay="500">
                <div class="col-12">
                    <hr style="border-color: rgba(255,255,255,0.1);">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div class="payment-methods">
                            <i class="bi bi-credit-card-2-front" title="Cartão de Crédito"></i>
                            <i class="bi bi-bank" title="Boleto Bancário"></i>
                            <i class="bi bi-cash-stack" title="PIX"></i>
                            <i class="bi bi-safe2" title="Pagamento Seguro"></i>
                        </div>
                        <div class="security-badges">
                            <span class="badge me-2 py-2 px-3">
                                <i class="bi bi-lock-fill me-1"></i> SSL Secure
                            </span>
                            <span class="badge py-2 px-3">
                                <i class="bi bi-shield-check me-1"></i> Certificado Digital
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom Bar -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <small>© 2025 Cartório Central — Segurança jurídica e agilidade digital.</small>
                    </div>
                    <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                        <small>
                            <a href="#" class="me-3">Política de Privacidade</a>
                            <a href="#" class="me-3">Termos de Uso</a>
                            <a href="#">LGPD</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Botão Voltar ao Topo -->
    <div class="back-to-top" id="backToTop">
        <i class="bi bi-arrow-up fs-5"></i>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Inicializar AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });
        
        // Botão Voltar ao Topo
        const backToTopBtn = document.getElementById('backToTop');
        
        if (backToTopBtn) {
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopBtn.classList.add('show');
                } else {
                    backToTopBtn.classList.remove('show');
                }
            });
            
            backToTopBtn.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
        
        // Mensagens flash com SweetAlert
        document.addEventListener('DOMContentLoaded', function() {
            let successMessage = @json(session('success'));
            let errorMessage = @json(session('error'));
            
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 4000,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
            
            if (successMessage) {
                Toast.fire({
                    icon: 'success',
                    title: successMessage,
                    background: '#f0fdf4',
                    color: '#166534',
                    iconColor: '#22c55e'
                });
            }
            
            if (errorMessage) {
                Toast.fire({
                    icon: 'error',
                    title: errorMessage,
                    background: '#fef2f2',
                    color: '#991b1b',
                    iconColor: '#ef4444'
                });
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
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
    <link rel="stylesheet" href="{{ asset('build/client/css/style.css') }}">
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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
                        <div class="payment-methods d-flex">
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
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#0d0d0d">
    <meta name="description" content="A Girollato é uma distribuidora especializada em rações, alimentos e artigos pet, oferecendo produtos de qualidade para cães, gatos e outros animais com variedade, cuidado e confiança.">
    <meta name="keywords" content="Girollato, distribuidora de rações, artigos pet, produtos pet, ração para cães, ração para gatos, acessórios pet, pet shop, alimentos para animais, higiene pet, brinquedos para pets, areia para gatos, distribuidora pet, casa de ração, produtos para cães e gatos, pet store, ração premium, produtos pet em Lauro de Freitas, distribuidora de rações Bahia">    <meta name="google-site-verification" content="-bUd4PZJ-3xvnf7cOkcmNLV7jzTk5106hfB0mPtvhqE" />
    <title>Girollato</title>
    @if(isset($blogInner))
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="article">
        <meta property="og:title" content="{{ $blogInner->title }}">
        <meta property="og:description" content="{{ Str::limit(strip_tags($blogInner->text), 150) }}">
        <meta property="og:image" content="{{ asset('storage/' . $blogInner->path_image_thumbnail) }}">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="{{ url()->current() }}">
        <meta name="twitter:title" content="{{ $blogInner->title }}">
        <meta name="twitter:description" content="{{ Str::limit(strip_tags($blogInner->text), 150) }}">
        <meta name="twitter:image" content="{{ asset('storage/' . $blogInner->path_image_thumbnail) }}">
    @else
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Girollato">
        <meta property="og:description" content="A Girollato é uma distribuidora especializada em rações, alimentos e artigos pet, oferecendo produtos de qualidade para cães, gatos e outros animais com variedade, cuidado e confiança.">
        <meta property="og:image" content="https://girolato.com.br/build/client/images/logo.svg">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="{{ url()->current() }}">
        <meta name="twitter:title" content="Girollato">
        <meta name="twitter:description" content="A Girollato é uma distribuidora especializada em rações, alimentos e artigos pet, oferecendo produtos de qualidade para cães, gatos e outros animais com variedade, cuidado e confiança.">
        <meta name="twitter:image" content="https://girolato.com.br/build/client/images/logo.svg">
    @endif

    
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="copyright" content="Direitos reservados WHI">
    <meta name="author" content="WHI">
    <link rel="shortcut icon" href="https://girolato.com.br/build/client/images/favicon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>    
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Changa:wght@200..800&display=swap" onload='this.onload=null,this.rel="stylesheet"'>
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Changa:wght@200..800&display=swap">
    </noscript>

    <link rel="preload" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css"></noscript>
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"></noscript>
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"></noscript>
    <link href="{{ asset('build/client/lgpd/style.css') }}" rel="stylesheet" type="text/css" />

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="{{ asset('build/client/css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="preload" href="{{ asset('build/client/css/bootstrap-icons/bootstrap-icons.css') }}" as="style" onload="this.rel='stylesheet'">
    <link href="{{ asset('build/client/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('build/client/css/responsivo.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="organization" hidden></div>

    @include('client/includes/lgpd/lgpd')

     @if (isset($contact) && $contact->phone_one <> null)
        @php
            // Remove caracteres não numéricos do telefone
            $phone = preg_replace('/\D/', '', $contact->phone_one);

            // Monta mensagem com ícones e quebras de linha
            $mensagem = "Olá! Encontrei seu site e gostaria de conhecer mais sobre os planos disponíveis.%0A";
        @endphp

        <a
            href="https://wa.me/55{{ $phone }}?text={{ $mensagem }}"
            class="whatsapp-float"
            aria-label="Fale conosco no WhatsApp"
            target="_blank"
            rel="noopener noreferrer"
            >
            <!-- Ícone SVG do WhatsApp -->
            <svg viewBox="0 0 32 32" aria-hidden="true">
                <path d="M19.11 17.27c-.23-.12-1.37-.67-1.58-.75-.21-.08-.36-.12-.52.12-.16.23-.6.74-.74.89-.14.15-.27.17-.5.06-.23-.12-.97-.36-1.85-1.12-.68-.6-1.14-1.34-1.27-1.57-.13-.23-.01-.35.1-.47.1-.1.23-.27.35-.4.12-.13.16-.23.24-.39.08-.16.04-.3-.02-.42-.06-.12-.52-1.25-.71-1.72-.19-.46-.38-.4-.52-.4h-.45c-.16 0-.42.06-.64.3-.22.23-.84.82-.84 2 0 1.18.86 2.32.98 2.48.12.16 1.69 2.58 4.1 3.61.57.25 1.01.4 1.35.52.57.18 1.1.16 1.52.1.46-.07 1.37-.56 1.57-1.1.19-.54.19-1 .13-1.1-.06-.1-.21-.16-.44-.27zM16 3.2c-7.06 0-12.8 5.73-12.8 12.8 0 2.26.61 4.36 1.67 6.17L3.2 28.8l6.78-1.6c1.74.95 3.74 1.5 5.87 1.5 7.07 0 12.8-5.73 12.8-12.8S23.07 3.2 16 3.2zm0 22.94c-1.98 0-3.81-.58-5.35-1.57l-.38-.24-4.02.95.95-3.92-.25-.4a10.58 10.58 0 0 1-1.64-5.62c0-5.86 4.77-10.62 10.63-10.62S26.62 9.38 26.62 15.24 21.86 26.14 16 26.14z"/>
            </svg>
        </a>
    @endif

    <style>
        .whatsapp-float{
            position: fixed;
            bottom: 30%;
            right: 18px;
            transform: translateY(-30%);
            width: 56px;
            height: 56px;
            border-radius: 9999px;
            background: #25D366;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 10px 25px rgba(0,0,0,.15);
            z-index: 9999;
            transition: transform .15s ease, filter .15s ease, box-shadow .15s ease;
        }
        .whatsapp-float svg{
            width: 40px;
            height: 40px;
            fill: #fff;
            display: block;
        }
        .whatsapp-float:hover{
            transform: translateY(-30%) scale(1.05);
            filter: brightness(1.05);
            box-shadow: 0 14px 32px rgba(0,0,0,.2);
        }
        /* Ajuste em telas menores */
        @media (max-width: 768px){
            .whatsapp-float{
            right: 12px;
            width: 52px;
            height: 52px;
            }
            .whatsapp-float svg{ width: 35px; height: 35px; }
        }
        /* Não mostrar na impressão */
        @media print{
            .whatsapp-float{ display: none; }
        }
        /* Respeita usuários com redução de movimento */
        @media (prefers-reduced-motion: reduce){
            .whatsapp-float{ transition: none; }
            .whatsapp-float:hover{ transform: translateY(-50%); }
        }
    </style>

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

        /* ========== HEADER MELHORADO ========== */
        .top-bar {
            background: #0a2b1f;
            color: rgba(255,255,255,0.7);
            font-size: 0.8rem;
            padding: 8px 0;
        }
        
        .top-bar a {
            color: rgba(255,255,255,0.7);
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
            background: linear-gradient(135deg, #0a2b1f 0%, #1a5c42 100%);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.6rem;
        }
        
        .navbar-brand i {
            background: linear-gradient(135deg, #0a2b1f, #1a5c42);
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
            color: #1a5c42 !important;
            transform: translateY(-2px);
        }
        
        .nav-link-custom.active {
            background: #1a5c42;
            color: white !important;
        }
        
        .btn-custom-outline {
            border: 2px solid #1a5c42;
            color: #1a5c42;
            border-radius: 40px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            background: transparent;
        }
        
        .btn-custom-outline:hover {
            background: #1a5c42;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(26,92,66,0.3);
        }
        
        .btn-custom-primary {
            background: linear-gradient(135deg, #1a5c42 0%, #0a2b1f 100%);
            color: white;
            border-radius: 40px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-custom-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(26,92,66,0.4);
            color: white;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #1a5c42, #0a2b1f);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .user-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(26,92,66,0.4);
        }
        
        /* Badge de notificação */
        .notification-badge {
            position: relative;
        }
        
        .notification-badge .badge-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #e74c3c;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.3rem;
            }
            
            .nav-link-custom {
                margin: 0.3rem 0;
            }
            
            .btn-custom-outline, .btn-custom-primary {
                margin-top: 0.5rem;
                text-align: center;
            }
        }
        /* ========== FOOTER MELHORADO ========== */
        .footer {
            background: linear-gradient(135deg, #0a2b1f 0%, #0d3527 100%);
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
            background: linear-gradient(90deg, #ffd966, #1a5c42, #ffd966);
        }
        
        .footer h5 {
            color: white;
            font-weight: 700;
            margin-bottom: 1.2rem;
            position: relative;
            display: inline-block;
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
            color: #0a2b1f !important;
        }
        
        .contact-info p {
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .contact-info i {
            width: 24px;
            color: #ffd966;
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
            color: #0a2b1f;
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
            background: rgba(0,0,0,0.2);
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
        
        .payment-methods i {
            font-size: 2rem;
            margin: 0 0.5rem;
            opacity: 0.8;
            transition: opacity 0.3s;
        }
        
        .payment-methods i:hover {
            opacity: 1;
        }
        
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #1a5c42;
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
            color: #0a2b1f;
            transform: translateY(-5px);
        }
        
        @media (max-width: 768px) {
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
        }
    </style>

    <!-- HEADER MELHORADO -->
    <header>
        <!-- Top Bar com informações de contato -->
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
                            <a href="#" class="me-3"><i class="bi bi-envelope me-1"></i> contato@cartoriofacil.com</a>
                            <a href="#"><i class="bi bi-whatsapp me-1"></i> (11) 99999-9999</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Navbar Principal -->
        <nav class="navbar navbar-custom navbar-expand-lg sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{route('index')}}">
                    <i class="bi bi-file-text-fill me-2"></i>Cartório Fácil
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="{{route('index')}}">
                                <i class="bi bi-house-door me-1"></i>Início
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="{{route('orders')}}">
                                <i class="bi bi-files me-1"></i>Meus Pedidos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="{{route('contact')}}">
                                <i class="bi bi-question-circle me-1"></i>Atendimento
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="{{route('profile')}}">
                                <i class="bi bi-person me-2"></i>Meu Perfil
                            </a>
                        </li>
                    </ul>
                    
                    <div class="d-flex align-items-center gap-2">
                        <!-- Botão de notificações -->
                        <div class="notification-badge me-2">
                            <div class="user-avatar" style="background: #e8f0ec; color: #1a5c42;">
                                <i class="bi bi-bell"></i>
                            </div>
                            <span class="badge-count">3</span>
                        </div>
                        
                        <!-- Botão de login/usuário -->
                        <div class="dropdown">
                            <div class="user-avatar" data-bs-toggle="dropdown" style="cursor: pointer;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{route('profile')}}"><i class="bi bi-person me-2"></i>Meu Perfil</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Configurações</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i>Sair</a></li>
                            </ul>
                        </div>
                        
                        <!-- Botão de ação principal -->
                        <button class="btn btn-custom-primary" data-bs-toggle="modal" data-bs-target="#novoServicoModal">
                            <i class="bi bi-plus-circle me-1"></i>Novo Pedido
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="container py-4 py-md-5">
        @yield('content') 
    </main>

    <!-- FOOTER MELHORADO -->
    <footer class="footer">
        <div class="container pt-5 pb-3">
            <div class="row g-4">
                <!-- Coluna 1: Logo e descrição -->
                <div class="col-lg-4 col-md-6">
                    <div class="mb-3">
                        <i class="bi bi-file-text-fill fs-1" style="color: #ffd966;"></i>
                        <h4 class="text-white mt-2 fw-bold">Cartório Fácil</h4>
                    </div>
                    <p class="mb-3" style="color: #c0d4cc; line-height: 1.6;">
                        Soluções digitais para serviços cartorários com agilidade, segurança e transparência. 
                        Simplificamos processos para você economizar tempo.
                    </p>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="bi bi-facebook text-white"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-instagram text-white"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-linkedin text-white"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-youtube text-white"></i></a>
                    </div>
                </div>
                
                <!-- Coluna 2: Links rápidos -->
                <div class="col-lg-2 col-md-6">
                    <h5>Navegação</h5>
                    <ul class="footer-links">
                        <li><a href="{{route('index')}}"><i class="bi bi-chevron-right"></i> Início</a></li>
                        <li><a href="{{route('orders')}}"><i class="bi bi-chevron-right"></i> Meus Pedidos</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Serviços</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Preços</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Blog</a></li>
                    </ul>
                </div>
                
                <!-- Coluna 3: Atendimento -->
                <div class="col-lg-3 col-md-6">
                    <h5>Atendimento</h5>
                    <div class="contact-info">
                        <p><i class="bi bi-telephone-fill"></i> (11) 4000-1234</p>
                        <p><i class="bi bi-whatsapp"></i> (11) 99999-9999</p>
                        <p><i class="bi bi-envelope-fill"></i> contato@cartoriofacil.com</p>
                        <p><i class="bi bi-clock-fill"></i> Seg-Sex: 8h às 18h</p>
                        <p><i class="bi bi-geo-alt-fill"></i> São Paulo - SP</p>
                    </div>
                </div>
                
                <!-- Coluna 4: Newsletter -->
                <div class="col-lg-3 col-md-6">
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
            <div class="row mt-4 pt-3">
                <div class="col-12">
                    <hr style="border-color: rgba(255,255,255,0.1);">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div class="payment-methods">
                            <i class="bi bi-credit-card-2-front"></i>
                            <i class="bi bi-bank"></i>
                            <i class="bi bi-cash-stack"></i>
                            <i class="bi bi-safe2"></i>
                        </div>
                        <div class="security-badges">
                            <span class="badge bg-light text-dark me-2 py-2 px-3">
                                <i class="bi bi-lock-fill me-1"></i> SSL Secure
                            </span>
                            <span class="badge bg-light text-dark py-2 px-3">
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
                        <small>© 2025 Cartório Fácil — Atendimento digital com segurança e agilidade.</small>
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

    <script>
        // Script para o botão "Voltar ao Topo"
        (function() {
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
        })();
    </script>
    
    <script src="https://cdn.ckeditor.com/4.22.1/basic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('build/client/css/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('build/client/lgpd/script.js') }}"></script>
    <script src="{{ asset('build/client/js/default.js') }}"></script>

    <script>
        // ==================== FUNÇÃO PARA ATUALIZAR O STEP INDICATOR ====================
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
            
            // Atualizar a dica baseada no passo atual
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
        
        // ==================== DEFINIÇÃO DOS SERVIÇOS COM CAMPOS DINÂMICOS ====================
        let servicos = [];

        // Carregar serviços da API
        async function loadServicesFromAPI() {
            try {
                const response = await fetch('/api/registry-services');
                
                if (!response.ok) {
                    throw new Error(`Erro ao buscar serviços: ${response.statusText}`);
                }

                const result = await response.json();

                if (result.success && Array.isArray(result.data)) {
                    servicos = result.data;
                    console.log('Serviços carregados com sucesso:', servicos);
                    renderServices();
                    
                    // Selecionar o primeiro serviço automaticamente
                    if (servicos.length > 0) {
                        selectService(servicos[0]);
                    }
                } else {
                    console.error('Formato inválido de resposta:', result);
                    showErrorAlert('Erro ao carregar serviços');
                }
            } catch (error) {
                console.error('Erro ao buscar serviços:', error);
                showErrorAlert('Não foi possível carregar os serviços. Por favor, recarregue a página.');
            }
        }

        // Mostrar alerta de erro
        function showErrorAlert(message) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: message,
                confirmButtonText: 'OK'
            });
        }

        let selectedService = null;
        let uploadedFiles = [];
        const MAX_FILES = 8;

        // Renderizar serviços em lista vertical
        function renderServices() {
            const container = document.getElementById('servicesContainer');
            if (!container) return;
            
            let html = '';
            servicos.forEach(serv => {
                html += `
                    <div class="service-item" data-id="${serv.id}">
                        <div class="service-icon">
                            <i class="bi ${serv.icone}"></i>
                        </div>
                        <div class="service-info">
                            <div class="service-name">${serv.nome}</div>
                            <div class="service-desc">Clique para ver detalhes</div>
                        </div>
                        <div class="service-check" id="checkBadge-${serv.id}" style="display: none;">
                            <i class="bi bi-check-circle-fill text-success"></i>
                        </div>
                    </div>
                `;
            });
            container.innerHTML = html;
            
            // Adicionar eventos de clique
            document.querySelectorAll('.service-item').forEach(item => {
                item.addEventListener('click', () => {
                    const id = parseInt(item.getAttribute('data-id'));
                    const servico = servicos.find(s => s.id === id);
                    if (servico) {
                        selectService(servico);
                    }
                });
            });
        }

        // Gerar campos dinâmicos baseado no serviço
        function generateDynamicFields(servico) {
            if (!servico || !servico.camposDinamicos) return '';
            
            let html = '<div class="dynamic-fields-wrapper">';
            html += '<div class="alert alert-success py-2 mb-3 small"><i class="bi bi-file-text"></i> <strong>Dados específicos para:</strong> ' + servico.nome + '</div>';
            
            servico.camposDinamicos.forEach(campo => {
                const obrigatorioAttr = campo.required ? 'required' : '';
                const requiredSpan = campo.required ? '<span class="text-danger">*</span>' : '';
                
                html += `<div class="mb-3 dynamic-field">`;
                html += `<label class="form-label">${campo.label} ${requiredSpan}</label>`;
                
                switch(campo.type) {
                    case 'text':
                        html += `<input type="text" class="form-control" name="${campo.name}" placeholder="${campo.placeholder || ''}" ${obrigatorioAttr}>`;
                        break;
                    case 'number':
                        html += `<input type="number" class="form-control" name="${campo.name}" placeholder="${campo.placeholder || ''}" ${obrigatorioAttr} step="any">`;
                        break;
                    case 'date':
                        html += `<input type="date" class="form-control" name="${campo.name}" ${obrigatorioAttr}>`;
                        break;
                    case 'email':
                        html += `<input type="email" class="form-control" name="${campo.name}" placeholder="${campo.placeholder || ''}" ${obrigatorioAttr}>`;
                        break;
                    case 'tel':
                        html += `<input type="tel" class="form-control" name="${campo.name}" placeholder="${campo.placeholder || ''}" ${obrigatorioAttr}>`;
                        break;
                    case 'select':
                        html += `<select class="form-select" name="${campo.name}" ${obrigatorioAttr}>`;
                        html += `<option value="">Selecione...</option>`;
                        if (Array.isArray(campo.options)) {
                            campo.options.forEach(op => {
                                html += `<option value="${op}">${op}</option>`;
                            });
                        }
                        html += `</select>`;
                        break;
                    case 'textarea':
                        html += `<textarea class="form-control" name="${campo.name}" rows="3" placeholder="${campo.placeholder || ''}" ${obrigatorioAttr}></textarea>`;
                        break;
                    default:
                        html += `<input type="text" class="form-control" name="${campo.name}" ${obrigatorioAttr}>`;
                }
                
                html += `</div>`;
            });
            
            html += '</div>';
            return html;
        }

        // Atualizar a explicação dos documentos
        function updateDocsExplanation(servico) {
            const docsDiv = document.getElementById('docsExplanation');
            let docsHtml = `
                <div class="mb-3 pb-2 border-bottom">
                    <strong class="text-success">${servico.nome}</strong>
                    <p class="small text-muted mt-1 mb-0">${servico.instrucoes || 'Envie os documentos abaixo:'}</p>
                </div>
                <ul class="list-unstyled mb-3">
            `;
            servico.documentos.forEach(doc => {
                docsHtml += `<li class="mb-2 d-flex align-items-start gap-2">
                                <i class="bi bi-check-circle-fill text-success mt-1" style="font-size: 0.75rem;"></i>
                                <span>${doc}</span>
                            </li>`;
            });
            docsHtml += `</ul>
                <div class="alert alert-warning small mt-2 mb-0 py-2">
                    <i class="bi bi-exclamation-triangle"></i>
                    <strong>Atenção:</strong> Documentos ilegíveis ou incompletos podem atrasar seu pedido.
                </div>
            `;
            docsDiv.innerHTML = docsHtml;
            
            // Atualizar step para 2 (documentos visíveis)
            updateStepIndicator(2);
        }

        // Selecionar serviço e atualizar tudo
        function selectService(servico) {
            // Atualizar UI dos cards
            document.querySelectorAll('.service-item').forEach(item => {
                item.classList.remove('selected');
                const badge = item.querySelector('.service-check');
                if (badge) badge.style.display = 'none';
            });
            const targetItem = document.querySelector(`.service-item[data-id="${servico.id}"]`);
            if (targetItem) {
                targetItem.classList.add('selected');
                const badge = targetItem.querySelector('.service-check');
                if (badge) badge.style.display = 'flex';
            }

            selectedService = servico;
            document.getElementById('selectedServiceId').value = servico.id;
            document.getElementById('selectedServiceName').value = servico.nome;

            // Atualizar documentos necessários
            updateDocsExplanation(servico);

            // Gerar e injetar campos dinâmicos
            const dynamicContainer = document.getElementById('dynamicFieldsContainer');
            const dynamicFieldsHtml = generateDynamicFields(servico);
            dynamicContainer.innerHTML = dynamicFieldsHtml;
            
            // Adicionar animação sutil
            const wrapper = dynamicContainer.querySelector('.dynamic-fields-wrapper');
            if (wrapper) {
                wrapper.style.animation = 'fadeIn 0.4s ease';
            }
            
            // Atualizar step para 3 (campos de formulário visíveis)
            updateStepIndicator(3);
            
            // Rolar suavemente para o formulário em mobile
            if (window.innerWidth < 768) {
                const formCard = document.querySelector('.form-card');
                if (formCard) {
                    setTimeout(() => {
                        formCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }, 100);
                }
            }
        }

        // FUNÇÕES DE UPLOAD DE ARQUIVOS
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('fileInput');
        const selectBtn = document.getElementById('selectFilesBtn');
        const fileListContainer = document.getElementById('fileListContainer');
        const fileListUl = document.getElementById('fileList');

        function updateFileListUI() {
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
                    <div><i class="bi bi-file-earmark-text me-2"></i> <strong>${file.name}</strong> <span class="text-muted small">(${sizeMB} MB)</span></div>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-circle" data-index="${idx}"><i class="bi bi-x-lg"></i></button>
                `;
                fileListUl.appendChild(li);
            });
            document.querySelectorAll('#fileList .btn-outline-danger').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const index = parseInt(btn.getAttribute('data-index'));
                    if (!isNaN(index)) {
                        uploadedFiles.splice(index, 1);
                        updateFileListUI();
                        fileInput.value = '';
                        
                        // Se tiver arquivos, mantém step 4, senão volta step 3
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
                    alert(`Máximo de ${MAX_FILES} arquivos permitidos. Remova algum antes de adicionar novo.`);
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
                updateStepIndicator(4); // Arquivos adicionados, passo 4 ativo
            }
        }

        if (dropzone) {
            dropzone.addEventListener('click', () => fileInput.click());
            selectBtn.addEventListener('click', () => fileInput.click());
            dropzone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropzone.style.backgroundColor = '#e9f3ef';
                dropzone.style.borderColor = '#1a3e2f';
            });
            dropzone.addEventListener('dragleave', () => {
                dropzone.style.backgroundColor = '#fafcfb';
                dropzone.style.borderColor = '#cbd5e1';
            });
            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropzone.style.backgroundColor = '#fafcfb';
                dropzone.style.borderColor = '#cbd5e1';
                const droppedFiles = e.dataTransfer.files;
                if (droppedFiles.length) addFiles(droppedFiles);
            });
            fileInput.addEventListener('change', (e) => {
                if (e.target.files.length) addFiles(e.target.files);
                fileInput.value = '';
            });
        }

        // Envio do formulário
        const form = document.getElementById('solicitacaoForm');
        if (form) {
            form.addEventListener('submit', async (event) => {
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
                if (selectedService && selectedService.camposDinamicos) {
                    for (let campo of selectedService.camposDinamicos) {
                        if (campo.required) {
                            const campoElement = document.querySelector(`[name="${campo.name}"]`);
                            if (campoElement && !campoElement.value.trim()) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Campo obrigatório',
                                    text: `Por favor, preencha o campo "${campo.label}" (obrigatório).`,
                                    confirmButtonText: 'OK'
                                });
                                campoElement.focus();
                                return;
                            }
                        }
                    }
                }
                
                if (uploadedFiles.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Documentos não enviados',
                        text: 'Envie ao menos um documento (conforme lista de documentos necessários) para processar a solicitação.',
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
                        
                        if (selectedService && selectedService.camposDinamicos) {
                            for (let campo of selectedService.camposDinamicos) {
                                const valor = document.querySelector(`[name="${campo.name}"]`)?.value || '';
                                formData.append(campo.name, valor);
                            }
                        }
                        
                        uploadedFiles.forEach((file, idx) => {
                            formData.append(`documento_${idx}`, file, file.name);
                        });
                        
                        try {
                            const response = await fetch('/api/registry-service-requests', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                }
                            });

                            const result = await response.json();

                            if (result.success) {
                                Swal.close();
                                
                                const modalHtml = `
                                    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-4 border-0 shadow">
                                                <div class="modal-header bg-success text-white border-0">
                                                    <h5 class="modal-title"><i class="bi bi-check-circle-fill text-success"></i> Solicitação enviada!</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Olá, <strong>${nome}</strong>! Sua solicitação de <strong>${document.getElementById('selectedServiceName').value}</strong> foi recebida com sucesso.</p>
                                                    <p>Você enviou <strong>${uploadedFiles.length} arquivo(s)</strong>. Em breve um atendente entrará em contato via e-mail ou WhatsApp.</p>
                                                    <hr>
                                                    <small class="text-muted">Protocolo gerado: <strong>#CART-${result.request_id}</strong></small>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Fechar</button>
                                                    <button type="button" id="resetFormBtn" class="btn btn-success rounded-pill" data-bs-dismiss="modal">Nova solicitação</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                
                                const existingModal = document.getElementById('successModal');
                                if(existingModal) existingModal.remove();
                                document.body.insertAdjacentHTML('beforeend', modalHtml);
                                const modalElement = document.getElementById('successModal');
                                const modal = new bootstrap.Modal(modalElement);
                                modal.show();
                                
                                const resetBtn = document.getElementById('resetFormBtn');
                                resetBtn.addEventListener('click', () => {
                                    form.reset();
                                    
                                    // Limpar campos básicos
                                    document.getElementById('nomeCompleto').value = '';
                                    document.getElementById('email').value = '';
                                    document.getElementById('telefone').value = '';
                                    
                                    // Limpar campos dinâmicos
                                    const dynamicFields = document.querySelectorAll('#dynamicFieldsContainer input, #dynamicFieldsContainer select, #dynamicFieldsContainer textarea');
                                    dynamicFields.forEach(field => {
                                        field.value = '';
                                    });
                                    
                                    // Limpar seleção de serviço
                                    selectedService = null;
                                    document.getElementById('selectedServiceId').value = '';
                                    document.getElementById('selectedServiceName').value = '';
                                    
                                    // Limpar classe selected dos serviços
                                    document.querySelectorAll('.service-item').forEach(item => {
                                        item.classList.remove('selected');
                                        const badge = item.querySelector('.service-check');
                                        if (badge) badge.style.display = 'none';
                                    });
                                    
                                    // Limpar documentos
                                    uploadedFiles = [];
                                    updateFileListUI();
                                    fileInput.value = '';
                                    
                                    // Resetar área de documentos
                                    document.getElementById('docsExplanation').innerHTML = `
                                        <div class="text-center py-4 text-secondary">
                                            <i class="bi bi-folder2-open fs-1 d-block mb-2"></i>
                                            <span>Selecione um serviço<br>para ver os documentos necessários</span>
                                        </div>
                                    `;
                                    
                                    // Resetar área de campos dinâmicos
                                    document.getElementById('dynamicFieldsContainer').innerHTML = `
                                        <div class="alert alert-light border text-center py-4" id="noServiceSelectedMsg">
                                            <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
                                            <span>Selecione um serviço para começar</span>
                                        </div>
                                    `;
                                    
                                    // Resetar step para 1
                                    updateStepIndicator(1);
                                    
                                    // Opcional: selecionar primeiro serviço automaticamente
                                    if (servicos.length > 0) {
                                        selectService(servicos[0]);
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erro ao enviar',
                                    html: result.message || 'Ocorreu um erro ao processar sua solicitação. Tente novamente.',
                                    confirmButtonText: 'OK'
                                });
                            }
                        } catch (error) {
                            console.error('Erro:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro de conexão',
                                text: 'Não foi possível enviar sua solicitação. Verifique sua conexão e tente novamente.',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                });
            });
        }

        // Inicialização
        loadServicesFromAPI();
    </script>

    {{-- Modais alert --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            let successMessage = @json(session('success'));
            let errorMessage = @json(session('error'));

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 3000,
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
</body>
</html>
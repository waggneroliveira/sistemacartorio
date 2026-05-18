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
        .card-service {
            border: none;
            border-radius: 24px;
            transition: all 0.2s ease;
            cursor: pointer;
            background: white;
            height: 100%;
            box-shadow: 0 8px 20px rgba(0,0,0,0.03);
        }
        .card-service:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 28px rgba(0,0,0,0.08);
            border-color: #d4e2dc;
        }
        .service-check {
            background-color: #1a3e2f;
            border-radius: 30px;
            padding: 6px 12px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .selected-card {
            border: 2px solid #1a3e2f;
            background: #f8fbf9;
            box-shadow: 0 12px 24px rgba(26,62,47,0.12);
        }
        .badge-docs {
            background: #eef2f0;
            color: #1e4d3a;
            font-weight: 500;
            padding: 8px 14px;
            border-radius: 40px;
            font-size: 0.85rem;
        }
        .upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 20px;
            background: #fafcfb;
            transition: all 0.2s;
            cursor: pointer;
        }
        .upload-area:hover {
            background: #f0f6f2;
            border-color: #1a3e2f;
        }
        .file-list {
            max-height: 200px;
            overflow-y: auto;
        }
        .btn-submit {
            background: #1a3e2f;
            border: none;
            padding: 12px 28px;
            font-weight: 600;
            border-radius: 60px;
            transition: 0.2s;
        }
        .btn-submit:hover {
            background: #0f2e22;
            transform: scale(1.02);
        }
        .form-control, .form-select {
            border-radius: 16px;
            padding: 12px 16px;
            border: 1px solid #dee2e6;
        }
        .form-control:focus, .form-select:focus {
            border-color: #1a3e2f;
            box-shadow: 0 0 0 0.2rem rgba(26,62,47,0.2);
        }
        .section-title {
            font-weight: 700;
            color: #1f2f29;
            border-left: 5px solid #1a3e2f;
            padding-left: 16px;
        }
        footer {
            border-top: 1px solid #dce5e1;
            background: white;
        }
        .dynamic-field {
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media (max-width: 768px) {
            .card-service {
                margin-bottom: 12px;
            }
        }
        .required-field::after {
            content: " *";
            color: #dc3545;
            font-weight: bold;
        }
    </style>
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

    <header class="shadow-sm bg-white">
        <!-- NAVBAR -->
        <nav class="navbar navbar-custom navbar-expand-lg sticky-top">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <i class="bi bi-file-text-fill me-2"></i>Cartório Fácil
                </a>
                <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link text-white-50" href="{{route('index')}}">Início</a></li>
                        <li class="nav-item"><a class="nav-link text-white-50" href="{{route('orders')}}">Meus Pedidos</a></li>
                        <li class="nav-item"><a class="nav-link text-white-50" href="#">Atendimento</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container py-4 py-md-5">
        @yield('content') 
    </main>

    <footer class="mt-5 py-4 text-center text-muted small">
        <div class="container">© 2025 Cartório Fácil — Atendimento digital com segurança e agilidade.</div>
    </footer>
    
    <script src="https://cdn.ckeditor.com/4.22.1/basic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('build/client/css/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('build/client/lgpd/script.js') }}"></script>
    <script src="{{ asset('build/client/js/default.js') }}"></script>

    <script>
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

        // Renderizar cards de serviços em carrossel
        function renderServices() {
            const container = document.getElementById('servicesContainer');
            if (!container) return;
            
            // Criar estrutura do Swiper
            container.innerHTML = `
                <div class="swiper servicesSwiper">
                    <div class="swiper-wrapper" id="servicesWrapper"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            `;
            
            const wrapper = document.getElementById('servicesWrapper');
            
            // Adicionar serviços ao swiper-wrapper
            servicos.forEach(serv => {
                const slide = document.createElement('div');
                slide.className = 'swiper-slide';
                slide.innerHTML = `
                    <div class="card-service card p-3 h-100" data-id="${serv.id}">
                        <div class="d-flex justify-content-between align-items-center">
                            <i class="bi ${serv.icone} fs-2" style="color: #1a3e2f;"></i>
                            <span class="service-check text-white small" id="checkBadge-${serv.id}" style="display: none;">
                                <i class="bi bi-check-lg"></i> Selecionado
                            </span>
                        </div>
                        <h5 class="mt-2 fw-bold">${serv.nome}</h5>
                        <p class="text-muted small mb-0">Clique para detalhes</p>
                    </div>
                `;
                wrapper.appendChild(slide);
            });
            
            // Inicializar Swiper apenas com navigation (arrows)
            const swiper = new Swiper('.servicesSwiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2.5,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 3.5,
                        spaceBetween: 30,
                    },
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                loop: servicos.length > 3,
            });
            
            // Adicionar eventos de clique
            document.querySelectorAll('.card-service').forEach(card => {
                card.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const id = parseInt(card.getAttribute('data-id'));
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
            html += '<h6 class="fw-bold mb-3 text-success"><i class="bi bi-file-text"></i> Dados específicos do serviço: ' + servico.nome + '</h6>';
            
            servico.camposDinamicos.forEach(campo => {
                const obrigatorioAttr = campo.required ? 'required' : '';
                const requiredSpan = campo.required ? '<span class="text-danger">*</span>' : '';
                
                html += `<div class="mb-3 dynamic-field">`;
                html += `<label class="form-label fw-semibold">${campo.label} ${requiredSpan}</label>`;
                
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
                <div class="d-flex align-items-start">
                    <i class="bi bi-file-earmark-check fs-3 me-3 text-success"></i>
                    <div>
                        <h6 class="fw-bold mb-2">📄 ${servico.nome}</h6>
                        <p class="small text-secondary">${servico.instrucoes}</p>
                        <ul class="list-unstyled">
            `;
            servico.documentos.forEach(doc => {
                docsHtml += `<li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2" style="font-size: 0.9rem;"></i> ${doc}</li>`;
            });
            docsHtml += `</ul><div class="alert alert-light border mt-2 py-2 small"><i class="bi bi-chat-right-quote"></i> <strong>Orientação extra:</strong> Todos os arquivos devem estar legíveis e em formato PDF ou imagem (JPG/PNG). Certifique-se de que os documentos estão atualizados.</div></div></div>`;
            docsDiv.innerHTML = docsHtml;
        }

        // Selecionar serviço e atualizar tudo
        function selectService(servico) {
            // Atualizar UI dos cards
            document.querySelectorAll('.card-service').forEach(card => {
                card.classList.remove('selected-card');
                const badge = card.querySelector('[class*="service-check"]');
                if (badge) badge.style.display = 'none';
            });
            const targetCard = document.querySelector(`.card-service[data-id="${servico.id}"]`);
            if (targetCard) {
                targetCard.classList.add('selected-card');
                const badge = targetCard.querySelector('.service-check');
                if (badge) badge.style.display = 'inline-block';
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
            if (addedCount > 0) updateFileListUI();
        }

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

        // Envio do formulário
        const form = document.getElementById('solicitacaoForm');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            
            const nome = document.getElementById('nomeCompleto').value.trim();
            const email = document.getElementById('email').value.trim();
            const telefone = document.getElementById('telefone').value.trim();
            const servicoId = document.getElementById('selectedServiceId').value;

            if (!nome || !email || !telefone) {
                alert('Por favor, preencha nome, e-mail e telefone.');
                return;
            }
            if (!servicoId) {
                alert('Você deve selecionar um serviço para continuar.');
                return;
            }
            
            // Validar campos dinâmicos obrigatórios
            if (selectedService && selectedService.camposDinamicos) {
                for (let campo of selectedService.camposDinamicos) {
                    if (campo.obrigatorio) {
                        const campoElement = document.querySelector(`[name="${campo.nome}"]`);
                        if (campoElement && !campoElement.value.trim()) {
                            alert(`Por favor, preencha o campo "${campo.label}" (obrigatório).`);
                            campoElement.focus();
                            return;
                        }
                    }
                }
            }
            
            if (uploadedFiles.length === 0) {
                alert('Envie ao menos um documento (conforme lista de documentos necessários) para processar a solicitação.');
                return;
            }

            const formData = new FormData();
            formData.append('nome', nome);
            formData.append('email', email);
            formData.append('telefone', telefone);
            formData.append('servico_id', servicoId);
            formData.append('servico_nome', document.getElementById('selectedServiceName').value);
            
            // Adicionar campos dinâmicos
            if (selectedService && selectedService.camposDinamicos) {
                for (let campo of selectedService.camposDinamicos) {
                    const valor = document.querySelector(`[name="${campo.nome}"]`)?.value || '';
                    formData.append(campo.nome, valor);
                }
            }
            
            uploadedFiles.forEach((file, idx) => {
                formData.append(`documento_${idx}`, file, file.name);
            });
            
            console.log('Dados enviados (simulação):');
            for (let pair of formData.entries()) {
                if (pair[1] instanceof File) {
                    console.log(`${pair[0]}: ${pair[1].name} (${pair[1].size} bytes)`);
                } else {
                    console.log(`${pair[0]}: ${pair[1]}`);
                }
            }

            // Modal de sucesso
            const modalHtml = `
                <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4 border-0 shadow">
                            <div class="modal-header bg-success text-white border-0">
                                <h5 class="modal-title"><i class="bi bi-check-circle-fill"></i> Solicitação enviada!</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Olá, <strong>${nome}</strong>! Sua solicitação de <strong>${document.getElementById('selectedServiceName').value}</strong> foi recebida com sucesso.</p>
                                <p>Você enviou <strong>${uploadedFiles.length} arquivo(s)</strong>. Em breve um atendente entrará em contato via e-mail ou WhatsApp.</p>
                                <hr>
                                <small class="text-muted">Protocolo gerado: #CART-${Math.floor(Math.random() * 100000)}</small>
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
                selectedService = null;
                document.getElementById('selectedServiceId').value = '';
                document.getElementById('selectedServiceName').value = '';
                document.querySelectorAll('.card-service').forEach(card => {
                    card.classList.remove('selected-card');
                    const badge = card.querySelector('.service-check');
                    if (badge) badge.style.display = 'none';
                });
                document.getElementById('docsExplanation').innerHTML = `
                    <div class="d-flex align-items-center text-secondary">
                        <i class="bi bi-info-circle fs-4 me-2"></i>
                        <span>Selecione um serviço ao lado para visualizar a lista de documentos obrigatórios e orientações.</span>
                    </div>
                `;
                document.getElementById('dynamicFieldsContainer').innerHTML = `
                    <div class="alert alert-light border text-center py-3" id="noServiceSelectedMsg">
                        <i class="bi bi-info-circle"></i> Selecione um serviço para visualizar os campos específicos.
                    </div>
                `;
                uploadedFiles = [];
                updateFileListUI();
                fileInput.value = '';
            });
        });

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
@extends('client.core.client')
@section('content')
<!-- CONTEÚDO PRINCIPAL DA PÁGINA DE ATENDIMENTO -->
<div class="atendimento-page">
    <!-- Hero Section -->
    <section class="hero-atendimento">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start">
                    <div class="hero-badge mb-3">
                        <i class="bi bi-headset"></i> Atendimento Premium 24/7
                    </div>
                    <h1 class="hero-title">
                        Como podemos <span class="highlight">ajudar</span> você?
                    </h1>
                    <p class="hero-subtitle">
                        Tire suas dúvidas, acompanhe processos ou solicite suporte técnico. 
                        Nossa equipe está pronta para oferecer o melhor atendimento.
                    </p>
                    <div class="hero-stats mt-4">
                        <div class="stat-item">
                            <div class="stat-number">98%</div>
                            <div class="stat-label">Satisfação</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">15min</div>
                            <div class="stat-label">Resposta média</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">24/7</div>
                            <div class="stat-label">Disponibilidade</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center mt-4 mt-lg-0">
                    <div class="hero-illustration">
                        <img src="https://cdn-icons-png.flaticon.com/512/906/906337.png" alt="Atendimento" class="img-fluid" style="max-width: 300px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Canais de Atendimento -->
    <section class="canais-section">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title-main">Canais de <span class="highlight">Atendimento</span></h2>
                <p class="section-subtitle">Escolha a melhor forma para falar conosco</p>
            </div>
            
            <div class="row g-4">
                <!-- WhatsApp -->
                <div class="col-lg-3 col-md-6">
                    <div class="canal-card canal-whatsapp">
                        <div class="canal-icon">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <h3>WhatsApp</h3>
                        <p>Atendimento rápido e prático pelo seu celular</p>
                        <div class="canal-info">
                            <span class="status online">
                                <i class="bi bi-check-circle-fill"></i> Online
                            </span>
                            <span class="response-time">Resposta em até 5min</span>
                        </div>
                        <a href="https://wa.me/5511999999999" class="btn-canal" target="_blank">
                            Falar agora <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Chat Online -->
                <div class="col-lg-3 col-md-6">
                    <div class="canal-card canal-chat">
                        <div class="canal-icon">
                            <i class="bi bi-chat-dots-fill"></i>
                        </div>
                        <h3>Chat Online</h3>
                        <p>Converse diretamente no site com nossos atendentes</p>
                        <div class="canal-info">
                            <span class="status online">
                                <i class="bi bi-check-circle-fill"></i> 3 atendentes
                            </span>
                            <span class="response-time">Tempo médio: 2min</span>
                        </div>
                        <button class="btn-canal" onclick="abrirChat()">
                            Iniciar chat <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <!-- E-mail -->
                <div class="col-lg-3 col-md-6">
                    <div class="canal-card canal-email">
                        <div class="canal-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <h3>E-mail</h3>
                        <p>Para solicitações mais detalhadas ou documentos</p>
                        <div class="canal-info">
                            <span class="status offline">
                                <i class="bi bi-clock-fill"></i> 24h úteis
                            </span>
                            <span class="response-time">Resposta até 1 dia útil</span>
                        </div>
                        <button class="btn-canal" data-bs-toggle="modal" data-bs-target="#emailModal">
                            Enviar e-mail <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Telefone -->
                <div class="col-lg-3 col-md-6">
                    <div class="canal-card canal-phone">
                        <div class="canal-icon">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <h3>Telefone</h3>
                        <p>Para atendimento mais pessoal e imediato</p>
                        <div class="canal-info">
                            <span class="status online">
                                <i class="bi bi-check-circle-fill"></i> Disponível
                            </span>
                            <span class="response-time">Seg à Sex: 8h-18h</span>
                        </div>
                        <a href="tel:1140001234" class="btn-canal">
                            Ligar agora <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="faq-header-sticky">
                        <span class="faq-badge">FAQ</span>
                        <h2 class="section-title-main">Perguntas <span class="highlight">Frequentes</span></h2>
                        <p>Encontre respostas rápidas para as dúvidas mais comuns sobre nossos serviços</p>
                        <div class="faq-contact-box mt-4">
                            <i class="bi bi-question-circle-fill"></i>
                            <h5>Ainda com dúvidas?</h5>
                            <p>Nossa equipe está disponível para te ajudar</p>
                            <button class="btn-faq-contact" data-bs-toggle="modal" data-bs-target="#emailModal">
                                Falar com especialista
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-7">
                    <div class="accordion" id="faqAccordion">
                        <!-- FAQ 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Como funciona o processo de solicitação de certidão?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    O processo é totalmente digital. Você seleciona o tipo de certidão desejada, anexa os documentos necessários, realiza o pagamento e acompanha o status pelo nosso sistema. O prazo médio de entrega é de 3 a 5 dias úteis.
                                </div>
                            </div>
                        </div>
                        
                        <!-- FAQ 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Quais formas de pagamento são aceitas?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Aceitamos cartões de crédito (Visa, Mastercard, Elo, American Express), boleto bancário, PIX e transferência bancária. Todas as transações são processadas com segurança através de ambiente criptografado.
                                </div>
                            </div>
                        </div>
                        
                        <!-- FAQ 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    É seguro enviar documentos pelo sistema?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sim! Utilizamos criptografia de ponta a ponta (SSL/TLS) e armazenamento em servidores seguros. Seus documentos são protegidos por leis de privacidade (LGPD) e apenas nossa equipe autorizada tem acesso durante o processo.
                                </div>
                            </div>
                        </div>
                        
                        <!-- FAQ 4 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Como acompanhar o andamento do meu pedido?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Você pode acompanhar todos os seus pedidos na página "Meus Pedidos" após fazer login. Também enviamos notificações por e-mail e WhatsApp a cada atualização de status do seu processo.
                                </div>
                            </div>
                        </div>
                        
                        <!-- FAQ 5 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    Qual o prazo para cancelamento e reembolso?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Solicitações de cancelamento podem ser feitas em até 7 dias após a compra, desde que o serviço ainda não tenha sido iniciado. O reembolso é processado em até 10 dias úteis, conforme o Código de Defesa do Consumidor.
                                </div>
                            </div>
                        </div>
                        
                        <!-- FAQ 6 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                                    Atendimento é realmente 24 horas?
                                </button>
                            </h2>
                            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Nosso chatbot e sistema de abertura de chamados funcionam 24/7. O atendimento humano via chat e WhatsApp acontece de segunda a sexta, das 8h às 20h, e sábados das 9h às 14h (exceto feriados).
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Formulário de Contato Rápido -->
    <section class="contact-form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="contact-form-card">
                        <div class="row align-items-center">
                            <div class="col-lg-5 contact-form-info">
                                <i class="bi bi-envelope-paper-fill"></i>
                                <h3>Fale com a gente</h3>
                                <p>Tem alguma dúvida específica? Preencha o formulário e nossa equipe retornará o mais breve possível.</p>
                                
                                <div class="info-item">
                                    <i class="bi bi-clock-history"></i>
                                    <div>
                                        <strong>Resposta garantida em até</strong><br>
                                        24 horas úteis
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <i class="bi bi-shield-check"></i>
                                    <div>
                                        <strong>Dados protegidos</strong><br>
                                        Conforme a LGPD
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-7">
                                <form id="formContato" onsubmit="enviarContato(event)">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Nome completo *</label>
                                            <input type="text" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">E-mail *</label>
                                            <input type="email" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Telefone</label>
                                            <input type="tel" class="form-control" placeholder="(11) 99999-9999">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Assunto *</label>
                                            <select class="form-select" required>
                                                <option value="">Selecione...</option>
                                                <option>Dúvida sobre serviço</option>
                                                <option>Acompanhamento de pedido</option>
                                                <option>Problemas técnicos</option>
                                                <option>Sugestão ou reclamação</option>
                                                <option>Outros</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Mensagem *</label>
                                            <textarea class="form-control" rows="4" required placeholder="Descreva sua dúvida ou solicitação..."></textarea>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="privacyCheck" required>
                                                <label class="form-check-label" for="privacyCheck">
                                                    Concordo com a <a href="#" class="text-link">Política de Privacidade</a> e autorizo o tratamento dos meus dados *
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn-submit-form">
                                                Enviar mensagem <i class="bi bi-send"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal de E-mail -->
    <div class="modal fade" id="emailModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-envelope-fill me-2"></i>Enviar e-mail
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Envie sua mensagem diretamente para nosso e-mail:</p>
                    <div class="email-display">
                        <i class="bi bi-envelope-paper"></i>
                        <span>contato@cartoriofacil.com</span>
                        <button class="btn-copy" onclick="copiarEmail()">
                            <i class="bi bi-copy"></i> Copiar
                        </button>
                    </div>
                    <p class="mt-3 mb-0 small text-muted">
                        Responderemos em até 24 horas úteis. 
                        Para agilizar, informe seu número de protocolo (se houver) no assunto.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <a href="mailto:contato@cartoriofacil.com" class="btn btn-primary">Abrir e-mail</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* ========== ESTILOS DA PÁGINA DE ATENDIMENTO ========== */
    
    /* Hero Section */
    .hero-atendimento {
        background: linear-gradient(135deg, #f8fbf9 0%, #ffffff 100%);
        padding: 60px 0 40px 0;
        position: relative;
        overflow: hidden;
    }
    
    .hero-atendimento::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(26,92,66,0.05) 0%, transparent 70%);
        border-radius: 50%;
    }
    
    .hero-badge {
        display: inline-block;
        background: #e8f0ec;
        color: #1a5c42;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .hero-title {
        font-size: 3rem;
        font-weight: 800;
        color: #1f2f29;
        margin: 20px 0 15px;
    }
    
    .hero-title .highlight {
        color: #1a5c42;
        position: relative;
        display: inline-block;
    }
    
    .hero-title .highlight::after {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 0;
        right: 0;
        height: 10px;
        background: rgba(26,92,66,0.2);
        z-index: -1;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
        color: #5a6e65;
        line-height: 1.6;
        margin-bottom: 25px;
    }
    
    .hero-stats {
        display: flex;
        gap: 40px;
    }
    
    .stat-number {
        font-size: 1.8rem;
        font-weight: 800;
        color: #1a5c42;
    }
    
    .stat-label {
        font-size: 0.85rem;
        color: #7a8f85;
    }
    
    /* Canais de Atendimento */
    .canais-section {
        padding: 60px 0;
        background: #ffffff;
    }
    
    .section-header {
        margin-bottom: 50px;
    }
    
    .section-title-main {
        font-size: 2.2rem;
        font-weight: 700;
        color: #1f2f29;
        margin-bottom: 15px;
    }
    
    .section-title-main .highlight {
        color: #1a5c42;
    }
    
    .section-subtitle {
        color: #7a8f85;
        font-size: 1.1rem;
    }
    
    .canal-card {
        background: white;
        border-radius: 20px;
        padding: 30px 25px;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid #e8ece9;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        height: 100%;
    }
    
    .canal-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 30px rgba(26,92,66,0.1);
        border-color: #1a5c42;
    }
    
    .canal-icon {
        width: 80px;
        height: 80px;
        background: #f0f7f3;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    
    .canal-icon i {
        font-size: 2.5rem;
    }
    
    .canal-whatsapp .canal-icon i { color: #25D366; }
    .canal-chat .canal-icon i { color: #1a5c42; }
    .canal-email .canal-icon i { color: #EA4335; }
    .canal-phone .canal-icon i { color: #34B7F1; }
    
    .canal-card h3 {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 12px;
        color: #1f2f29;
    }
    
    .canal-card p {
        color: #7a8f85;
        font-size: 0.9rem;
        margin-bottom: 20px;
    }
    
    .canal-info {
        margin: 15px 0;
    }
    
    .status {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .status.online { color: #25D366; }
    .status.offline { color: #ffa500; }
    
    .response-time {
        font-size: 0.75rem;
        color: #a0b0a8;
    }
    
    .btn-canal {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #f0f7f3;
        color: #1a5c42;
        border: none;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: 10px;
        cursor: pointer;
    }
    
    .btn-canal:hover {
        background: #1a5c42;
        color: white;
        transform: translateX(5px);
    }
    
    /* FAQ Section */
    .faq-section {
        padding: 60px 0;
        background: #f8fbf9;
    }
    
    .faq-badge {
        display: inline-block;
        background: #1a5c42;
        color: white;
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 20px;
    }
    
    .faq-contact-box {
        background: white;
        border-radius: 20px;
        padding: 30px 25px;
        text-align: center;
        border: 1px solid #e0e8e4;
    }
    
    .faq-contact-box i {
        font-size: 2rem;
        color: #1a5c42;
        margin-bottom: 15px;
    }
    
    .faq-contact-box h5 {
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .faq-contact-box p {
        font-size: 0.9rem;
        color: #7a8f85;
        margin-bottom: 20px;
    }
    
    .btn-faq-contact {
        background: #1a5c42;
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-faq-contact:hover {
        background: #0a2b1f;
        transform: translateY(-2px);
    }
    
    .accordion-item {
        border: none;
        background: transparent;
        margin-bottom: 15px;
        border-radius: 12px !important;
        overflow: hidden;
    }
    
    .accordion-button {
        background: white;
        border-radius: 12px !important;
        padding: 20px;
        font-weight: 600;
        color: #1f2f29;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    
    .accordion-button:not(.collapsed) {
        background: #1a5c42;
        color: white;
    }
    
    .accordion-button:focus {
        box-shadow: none;
        border-color: transparent;
    }
    
    .accordion-body {
        background: white;
        padding: 20px;
        color: #5a6e65;
        line-height: 1.6;
    }
    
    /* Formulário de Contato */
    .contact-form-section {
        padding: 60px 0;
        background: white;
    }
    
    .contact-form-card {
        background: linear-gradient(135deg, #f8fbf9 0%, #ffffff 100%);
        border-radius: 30px;
        padding: 50px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        border: 1px solid #e8ece9;
    }
    
    .contact-form-info {
        text-align: center;
        padding-right: 30px;
        border-right: 2px solid #e0e8e4;
    }
    
    .contact-form-info i:first-child {
        font-size: 3rem;
        color: #1a5c42;
        margin-bottom: 20px;
    }
    
    .contact-form-info h3 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 15px;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 25px;
        text-align: left;
    }
    
    .info-item i {
        font-size: 1.5rem;
        color: #1a5c42;
    }
    
    .btn-submit-form {
        width: 100%;
        background: linear-gradient(135deg, #1a5c42 0%, #0a2b1f 100%);
        color: white;
        border: none;
        padding: 14px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-submit-form:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(26,92,66,0.3);
    }
    
    .text-link {
        color: #1a5c42;
        text-decoration: none;
    }
    
    .text-link:hover {
        text-decoration: underline;
    }
    
    /* Modal */
    .email-display {
        background: #f8fbf9;
        padding: 15px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 15px 0;
    }
    
    .email-display span {
        font-size: 1rem;
        font-weight: 500;
        color: #1a5c42;
    }
    
    .btn-copy {
        background: white;
        border: 1px solid #1a5c42;
        color: #1a5c42;
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .btn-copy:hover {
        background: #1a5c42;
        color: white;
    }
    
    /* Responsividade */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-stats {
            justify-content: center;
        }
        
        .contact-form-card {
            padding: 30px 20px;
        }
        
        .contact-form-info {
            border-right: none;
            border-bottom: 2px solid #e0e8e4;
            padding-bottom: 30px;
            margin-bottom: 30px;
        }
        
        .section-title-main {
            font-size: 1.8rem;
        }
        
        .canais-section, .faq-section, .contact-form-section {
            padding: 40px 0;
        }
    }
</style>

<script>
    // Função para abrir o chat (simulação)
    function abrirChat() {
        alert("Chat online disponível! Em breve um atendente irá te atender.");
    }
    
    // Função para copiar e-mail
    function copiarEmail() {
        const email = "contato@cartoriofacil.com";
        navigator.clipboard.writeText(email).then(() => {
            alert("E-mail copiado com sucesso!");
        });
    }
    
    // Função para enviar formulário de contato
    function enviarContato(event) {
        event.preventDefault();
        alert("Mensagem enviada com sucesso! Responderemos em até 24 horas.");
        document.getElementById('formContato').reset();
    }
</script>
@endsection
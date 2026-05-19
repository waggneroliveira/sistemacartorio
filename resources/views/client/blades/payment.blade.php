@extends('client.core.client')
@section('content')
<!-- CONTEÚDO PRINCIPAL DA PÁGINA DE PAGAMENTO -->
<main class="pagamento-page">
    <!-- Cabeçalho da página -->
    <div class="pagamento-header">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">Início</a></li>
                    <li class="breadcrumb-item"><a href="{{route('orders')}}">Meus Pedidos</a></li>
                    <li class="breadcrumb-item active">Pagamento</li>
                </ol>
            </nav>
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="pagamento-title">Finalizar Pagamento</h1>
                    <p class="pagamento-subtitle">Escolha a melhor forma de pagamento para o seu pedido</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div class="pedido-info-header">
                        <span>Pedido: <strong>#CART-2025-001</strong></span>
                        <span class="badge-status">Aguardando pagamento</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Coluna Principal - Métodos de Pagamento -->
            <div class="col-lg-8">
                <!-- Resumo do Pedido (Mobile) -->
                <div class="resumo-mobile d-block d-lg-none mb-4">
                    <div class="resumo-card-mobile">
                        <h3>Resumo do Pedido</h3>
                        <div class="resumo-item">
                            <span>Certidão de Nascimento</span>
                            <span>R$ 89,90</span>
                        </div>
                        <div class="resumo-item">
                            <span>Taxa de emissão</span>
                            <span>R$ 15,00</span>
                        </div>
                        <div class="resumo-item">
                            <span>Entrega (Sedex)</span>
                            <span>R$ 12,90</span>
                        </div>
                        <div class="resumo-total">
                            <strong>Total</strong>
                            <strong>R$ 117,80</strong>
                        </div>
                    </div>
                </div>

                <!-- Métodos de Pagamento -->
                <div class="pagamento-card">
                    <h3 class="card-title">
                        <i class="bi bi-credit-card"></i> Métodos de Pagamento
                    </h3>
                    
                    <!-- Opção: Cartão de Crédito -->
                    <div class="payment-method">
                        <div class="payment-method-header" onclick="togglePayment('cartao')">
                            <div class="payment-radio">
                                <div class="custom-radio" data-method="cartao">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </div>
                                <div class="payment-info">
                                    <strong>Cartão de Crédito</strong>
                                    <small>Pague com cartão de crédito em até 12x</small>
                                </div>
                            </div>
                            <div class="payment-icons">
                                <i class="bi bi-credit-card"></i>
                                <span>Visa • Mastercard • Elo • Amex</span>
                            </div>
                        </div>
                        
                        <div class="payment-form" id="form-cartao" style="display: none;">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Número do cartão</label>
                                    <input type="text" class="form-control" placeholder="0000 0000 0000 0000" id="cardNumber" maxlength="19">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nome no cartão</label>
                                    <input type="text" class="form-control" placeholder="Como está no cartão">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Validade</label>
                                    <input type="text" class="form-control" placeholder="MM/AA">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">CVV</label>
                                    <input type="password" class="form-control" placeholder="123" maxlength="4">
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="salvarCartao">
                                        <label class="form-check-label" for="salvarCartao">
                                            Salvar cartão para próximas compras
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="installments-box">
                                        <label class="form-label">Parcelamento</label>
                                        <select class="form-select" id="parcelas">
                                            <option value="1">1x de R$ 117,80 sem juros</option>
                                            <option value="2">2x de R$ 58,90 sem juros</option>
                                            <option value="3">3x de R$ 39,27 sem juros</option>
                                            <option value="4">4x de R$ 29,45 sem juros</option>
                                            <option value="5">5x de R$ 23,56 sem juros</option>
                                            <option value="6">6x de R$ 19,63 sem juros</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Opção: PIX -->
                    <div class="payment-method">
                        <div class="payment-method-header" onclick="togglePayment('pix')">
                            <div class="payment-radio">
                                <div class="custom-radio" data-method="pix">
                                    <i class="bi bi-qr-code"></i>
                                </div>
                                <div class="payment-info">
                                    <strong>PIX</strong>
                                    <small>Pagamento instantâneo com desconto</small>
                                </div>
                            </div>
                            <div class="payment-icons">
                                <i class="bi bi-qr-code-scan"></i>
                                <span>Imediato • 5% OFF</span>
                            </div>
                        </div>
                        
                        <div class="payment-form" id="form-pix" style="display: none;">
                            <div class="pix-container">
                                <div class="pix-discount-banner">
                                    <i class="bi bi-tag-fill"></i>
                                    <span>Ganhe 5% de desconto pagando com PIX!</span>
                                </div>
                                
                                <div class="pix-qrcode text-center">
                                    <div class="qrcode-placeholder">
                                        <i class="bi bi-qr-code"></i>
                                        <p>QR Code para pagamento</p>
                                    </div>
                                    <button class="btn-copy-pix" onclick="copiarPix()">
                                        <i class="bi bi-copy"></i> Copiar código PIX
                                    </button>
                                </div>
                                
                                <div class="pix-info">
                                    <div class="pix-details">
                                        <span>Beneficiário:</span>
                                        <strong>Cartório Fácil Serviços LTDA</strong>
                                    </div>
                                    <div class="pix-details">
                                        <span>Chave PIX (CNPJ):</span>
                                        <strong>12.345.678/0001-90</strong>
                                    </div>
                                </div>
                                
                                <div class="pix-timer">
                                    <i class="bi bi-clock"></i>
                                    <span>Este QR Code expira em:</span>
                                    <strong id="pixTimer">29:59</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Opção: Boleto Bancário -->
                    <div class="payment-method">
                        <div class="payment-method-header" onclick="togglePayment('boleto')">
                            <div class="payment-radio">
                                <div class="custom-radio" data-method="boleto">
                                    <i class="bi bi-receipt"></i>
                                </div>
                                <div class="payment-info">
                                    <strong>Boleto Bancário</strong>
                                    <small>Imprima ou pague pelo app do banco</small>
                                </div>
                            </div>
                            <div class="payment-icons">
                                <i class="bi bi-bank2"></i>
                                <span>Vencimento em 3 dias úteis</span>
                            </div>
                        </div>
                        
                        <div class="payment-form" id="form-boleto" style="display: none;">
                            <div class="boleto-container">
                                <div class="boleto-info-card">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <div>
                                        <strong>Prazo de pagamento:</strong>
                                        <p>O boleto tem validade de 3 dias úteis. Após este prazo, será necessário gerar um novo.</p>
                                    </div>
                                </div>
                                
                                <div class="boleto-customer-info">
                                    <h4>Dados para emissão</h4>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">CPF/CNPJ *</label>
                                            <input type="text" class="form-control" placeholder="000.000.000-00" value="123.456.789-00">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Nome completo *</label>
                                            <input type="text" class="form-control" value="João da Silva">
                                        </div>
                                    </div>
                                </div>
                                
                                <button class="btn-gerar-boleto" onclick="gerarBoleto()">
                                    <i class="bi bi-file-pdf"></i> Gerar Boleto
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Opção: Link de Pagamento (Admin) -->
                    <div class="payment-method external-link">
                        <div class="payment-method-header" onclick="togglePayment('link')">
                            <div class="payment-radio">
                                <div class="custom-radio" data-method="link">
                                    <i class="bi bi-link-45deg"></i>
                                </div>
                                <div class="payment-info">
                                    <strong>Link de Pagamento</strong>
                                    <small>Pague com o link enviado pelo atendente</small>
                                </div>
                            </div>
                            <div class="payment-icons">
                                <i class="bi bi-envelope-paper"></i>
                                <span>Link personalizado</span>
                            </div>
                        </div>
                        
                        <div class="payment-form" id="form-link" style="display: none;">
                            <div class="link-container">
                                <div class="link-info-card">
                                    <i class="bi bi-shield-check"></i>
                                    <div>
                                        <strong>Link de pagamento personalizado</strong>
                                        <p>Você recebeu um link de pagamento por e-mail ou WhatsApp? Cole abaixo para prosseguir com o pagamento seguro.</p>
                                    </div>
                                </div>
                                
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Cole o link de pagamento aqui" id="linkPagamento">
                                    <button class="btn-validar-link" onclick="validarLink()">
                                        <i class="bi bi-check-circle"></i> Validar
                                    </button>
                                </div>
                                
                                <div class="link-example">
                                    <small>Exemplo: https://pagamento.cartoriofacil.com/pay/abc123def456</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cupom de Desconto -->
                <div class="pagamento-card">
                    <h3 class="card-title">
                        <i class="bi bi-ticket-perforated"></i> Cupom de Desconto
                    </h3>
                    <div class="cupom-container">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Digite seu cupom" id="cupomInput">
                            <button class="btn-aplicar-cupom" onclick="aplicarCupom()">Aplicar</button>
                        </div>
                        <div class="cupom-message" id="cupomMessage"></div>
                    </div>
                </div>

                <!-- Botão Finalizar -->
                <div class="action-buttons">
                    <button class="btn-voltar" onclick="window.history.back()">
                        <i class="bi bi-arrow-left"></i> Voltar
                    </button>
                    <button class="btn-finalizar" onclick="finalizarPagamento()" id="btnFinalizar">
                        <i class="bi bi-lock-fill"></i> Finalizar Pagamento
                    </button>
                </div>
            </div>

            <!-- Coluna Lateral - Resumo do Pedido -->
            <div class="col-lg-4">
                <div class="resumo-card">
                    <h3>Resumo do Pedido</h3>
                    
                    <div class="resumo-items">
                        <div class="resumo-item">
                            <span>Certidão de Nascimento</span>
                            <span>R$ 89,90</span>
                        </div>
                        <div class="resumo-item">
                            <span>Taxa de emissão</span>
                            <span>R$ 15,00</span>
                        </div>
                        <div class="resumo-item">
                            <span>Entrega (Sedex)</span>
                            <span>R$ 12,90</span>
                        </div>
                        <div class="resumo-item desconto" id="descontoItem" style="display: none;">
                            <span>Desconto</span>
                            <span id="descontoValor">-R$ 0,00</span>
                        </div>
                    </div>
                    
                    <div class="resumo-total">
                        <strong>Total</strong>
                        <strong id="totalValor">R$ 117,80</strong>
                    </div>
                    
                    <div class="resumo-detalhes">
                        <div class="detalhe-item">
                            <i class="bi bi-shield-check"></i>
                            <span>Pagamento 100% seguro</span>
                        </div>
                        <div class="detalhe-item">
                            <i class="bi bi-clock"></i>
                            <span>Confirmação em até 2 horas</span>
                        </div>
                        <div class="detalhe-item">
                            <i class="bi bi-headset"></i>
                            <span>Suporte 24/7</span>
                        </div>
                    </div>
                </div>

                <!-- Selos de Segurança -->
                <div class="security-seals">
                    <div class="seal-item">
                        <i class="bi bi-shield-lock-fill"></i>
                        <div>
                            <strong>Ambiente Seguro</strong>
                            <small>Criptografia SSL 256 bits</small>
                        </div>
                    </div>
                    <div class="seal-item">
                        <i class="bi bi-pci-card"></i>
                        <div>
                            <strong>PCI Certified</strong>
                            <small>Padrão de segurança internacional</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmação -->
    <div class="modal fade" id="confirmacaoModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <div class="success-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h4>Pagamento Confirmado!</h4>
                    <p>Seu pagamento foi processado com sucesso. Você receberá a confirmação por e-mail.</p>
                    <div class="protocolo-box">
                        <small>Protocolo de transação</small>
                        <strong>PIX-2025-03-15-9A3F2B</strong>
                    </div>
                    <button class="btn-ok" data-bs-dismiss="modal" onclick="redirecionarPedidos()">
                        Ver meus pedidos
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Boleto Gerado -->
    <div class="modal fade" id="boletoModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <div class="boleto-icon">
                        <i class="bi bi-file-pdf-fill"></i>
                    </div>
                    <h4>Boleto Gerado!</h4>
                    <p>Seu boleto foi gerado com sucesso. Clique no botão abaixo para baixar ou imprimir.</p>
                    <div class="boleto-linha-digitavel">
                        <small>Linha digitável</small>
                        <strong>00190.00009 01234.567890 12345.678901 2 12345678901234</strong>
                    </div>
                    <div class="mt-3">
                        <button class="btn-baixar-boleto" onclick="baixarBoleto()">
                            <i class="bi bi-download"></i> Baixar Boleto
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    let metodoSelecionado = null;
    let descontoAplicado = 0;
    let valorOriginal = 117.80;
    
    // Alternar método de pagamento
    function togglePayment(metodo) {
        // Esconder todos os forms
        document.querySelectorAll('.payment-form').forEach(form => {
            form.style.display = 'none';
        });
        
        // Remover selected de todos
        document.querySelectorAll('.payment-method').forEach(method => {
            method.classList.remove('selected');
        });
        
        // Mostrar o form selecionado
        const formToShow = document.getElementById(`form-${metodo}`);
        if (formToShow) {
            formToShow.style.display = 'block';
        }
        
        // Adicionar selected ao método pai
        const parentMethod = event.currentTarget.closest('.payment-method');
        parentMethod.classList.add('selected');
        
        metodoSelecionado = metodo;
        
        // Se for PIX, aplicar desconto
        if (metodo === 'pix') {
            aplicarDescontoPix();
        } else {
            if (descontoAplicado === 5) {
                removerDesconto();
            }
        }
    }
    
    // Aplicar desconto do PIX
    function aplicarDescontoPix() {
        if (descontoAplicado === 0) {
            descontoAplicado = 5;
            const valorComDesconto = valorOriginal * 0.95;
            
            document.getElementById('descontoItem').style.display = 'flex';
            document.getElementById('descontoValor').innerHTML = `-R$ ${(valorOriginal * 0.05).toFixed(2)}`;
            document.getElementById('totalValor').innerHTML = `R$ ${valorComDesconto.toFixed(2)}`;
            
            // Atualizar parcelas
            atualizarParcelas(valorComDesconto);
            
            const cupomMsg = document.getElementById('cupomMessage');
            cupomMsg.innerHTML = '<i class="bi bi-tag-fill"></i> Desconto de 5% aplicado via PIX!';
            cupomMsg.style.color = '#2e7d32';
        }
    }
    
    // Remover desconto
    function removerDesconto() {
        descontoAplicado = 0;
        document.getElementById('descontoItem').style.display = 'none';
        document.getElementById('totalValor').innerHTML = `R$ ${valorOriginal.toFixed(2)}`;
        atualizarParcelas(valorOriginal);
        
        const cupomMsg = document.getElementById('cupomMessage');
        cupomMsg.innerHTML = '';
    }
    
    // Atualizar opções de parcelamento
    function atualizarParcelas(valorTotal) {
        const parcelasSelect = document.getElementById('parcelas');
        if (parcelasSelect) {
            const valorParcela = valorTotal / 6;
            parcelasSelect.innerHTML = `
                <option value="1">1x de R$ ${valorTotal.toFixed(2)} sem juros</option>
                <option value="2">2x de R$ ${(valorTotal/2).toFixed(2)} sem juros</option>
                <option value="3">3x de R$ ${(valorTotal/3).toFixed(2)} sem juros</option>
                <option value="4">4x de R$ ${(valorTotal/4).toFixed(2)} sem juros</option>
                <option value="5">5x de R$ ${(valorTotal/5).toFixed(2)} sem juros</option>
                <option value="6">6x de R$ ${(valorTotal/6).toFixed(2)} sem juros</option>
            `;
        }
    }
    
    // Aplicar cupom
    function aplicarCupom() {
        const cupom = document.getElementById('cupomInput').value;
        const cupomMsg = document.getElementById('cupomMessage');
        
        if (cupom === 'CARTORIO10') {
            if (descontoAplicado === 0) {
                descontoAplicado = 10;
                const valorComDesconto = valorOriginal * 0.9;
                document.getElementById('descontoItem').style.display = 'flex';
                document.getElementById('descontoValor').innerHTML = `-R$ ${(valorOriginal * 0.1).toFixed(2)}`;
                document.getElementById('totalValor').innerHTML = `R$ ${valorComDesconto.toFixed(2)}`;
                atualizarParcelas(valorComDesconto);
                cupomMsg.innerHTML = '<i class="bi bi-check-circle-fill"></i> Cupom aplicado! Desconto de 10%';
                cupomMsg.style.color = '#2e7d32';
            } else {
                cupomMsg.innerHTML = '<i class="bi bi-exclamation-triangle-fill"></i> Não é possível acumular descontos';
                cupomMsg.style.color = '#ed6c02';
            }
        } else if (cupom === 'PRIMEIRACOMPRA') {
            if (descontoAplicado === 0) {
                descontoAplicado = 15;
                const valorComDesconto = valorOriginal * 0.85;
                document.getElementById('descontoItem').style.display = 'flex';
                document.getElementById('descontoValor').innerHTML = `-R$ ${(valorOriginal * 0.15).toFixed(2)}`;
                document.getElementById('totalValor').innerHTML = `R$ ${valorComDesconto.toFixed(2)}`;
                atualizarParcelas(valorComDesconto);
                cupomMsg.innerHTML = '<i class="bi bi-check-circle-fill"></i> Cupom aplicado! Desconto de 15% para primeira compra';
                cupomMsg.style.color = '#2e7d32';
            } else {
                cupomMsg.innerHTML = '<i class="bi bi-exclamation-triangle-fill"></i> Não é possível acumular descontos';
                cupomMsg.style.color = '#ed6c02';
            }
        } else if (cupom) {
            cupomMsg.innerHTML = '<i class="bi bi-x-circle-fill"></i> Cupom inválido ou expirado';
            cupomMsg.style.color = '#d32f2f';
        }
    }
    
    // Copiar código PIX
    function copiarPix() {
        const pixCode = '00020126360014br.gov.bcb.pix011234567890000158025800000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000';
        navigator.clipboard.writeText(pixCode).then(() => {
            alert('Código PIX copiado com sucesso!');
        });
    }
    
    // Gerar boleto
    function gerarBoleto() {
        const modal = new bootstrap.Modal(document.getElementById('boletoModal'));
        modal.show();
    }
    
    // Baixar boleto
    function baixarBoleto() {
        alert('Download do boleto iniciado...');
        // Aqui seria implementado o download real do PDF
    }
    
    // Validar link de pagamento
    function validarLink() {
        const link = document.getElementById('linkPagamento').value;
        if (link.includes('pagamento.cartoriofacil.com')) {
            alert('Link validado com sucesso! Redirecionando para pagamento...');
            // Redirecionar para o link do gateway
            window.open(link, '_blank');
        } else {
            alert('Link inválido! Verifique o link enviado pelo atendente.');
        }
    }
    
    // Finalizar pagamento
    function finalizarPagamento() {
        if (!metodoSelecionado) {
            alert('Selecione um método de pagamento primeiro!');
            return;
        }
        
        if (metodoSelecionado === 'cartao') {
            const cardNumber = document.getElementById('cardNumber').value;
            if (!cardNumber || cardNumber.length < 16) {
                alert('Preencha os dados do cartão corretamente!');
                return;
            }
        }
        
        if (metodoSelecionado === 'pix') {
            alert('Aguardando confirmação do pagamento PIX...');
            // Simular confirmação do PIX
            setTimeout(() => {
                const modal = new bootstrap.Modal(document.getElementById('confirmacaoModal'));
                modal.show();
            }, 2000);
            return;
        }
        
        if (metodoSelecionado === 'boleto') {
            alert('Boleto gerado com sucesso!');
            return;
        }
        
        if (metodoSelecionado === 'link') {
            const link = document.getElementById('linkPagamento').value;
            if (!link) {
                alert('Cole o link de pagamento recebido!');
                return;
            }
            return;
        }
        
        // Para cartão de crédito
        const modal = new bootstrap.Modal(document.getElementById('confirmacaoModal'));
        modal.show();
    }
    
    // Formatação do número do cartão
    document.getElementById('cardNumber')?.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
        e.target.value = value.substring(0, 19);
    });
    
    // Formatação da validade
    document.querySelector('input[placeholder="MM/AA"]')?.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 2) {
            value = value.substring(0, 2) + '/' + value.substring(2, 4);
        }
        e.target.value = value;
    });
    
    // Timer do PIX
    function startPixTimer() {
        let time = 30 * 60; // 30 minutos em segundos
        const timerElement = document.getElementById('pixTimer');
        
        if (timerElement) {
            const interval = setInterval(() => {
                const minutes = Math.floor(time / 60);
                const seconds = time % 60;
                timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                
                if (time <= 0) {
                    clearInterval(interval);
                    timerElement.innerHTML = 'Expirado';
                    timerElement.style.color = '#d32f2f';
                }
                time--;
            }, 1000);
        }
    }
    
    // Redirecionar para pedidos
    function redirecionarPedidos() {
        window.location.href = "{{route('orders')}}";
    }
    
    // Iniciar timer se a página for carregada com PIX selecionado
    document.addEventListener('DOMContentLoaded', function() {
        startPixTimer();
        
        // Adicionar máscara de telefone se necessário
        const telefoneInput = document.querySelector('input[placeholder="(11) 99999-9999"]');
        if (telefoneInput) {
            telefoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length <= 11) {
                    value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
                    value = value.replace(/(\d{5})(\d)/, '$1-$2');
                }
                e.target.value = value;
            });
        }
    });
</script>
@endsection
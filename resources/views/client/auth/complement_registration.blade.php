<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Complete seu Cadastro | Cartório Central</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('build/client/css/style.css') }}">
</head>
<body>

<div class="simple-header">
  <div class="logo-simple">
    <i class="fas fa-landmark"></i>
    <span>Cartório Central <small>| Cadastro seguro</small></span>
  </div>
  <button class="btn-exit" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fas fa-sign-out-alt"></i> Sair
  </button>
  <form id="logout-form" action="{{ route('client.user.logout') }}" method="POST" style="display: none;">@csrf</form>
</div>

<div class="layout-3cols">
  
  <!-- SIDEBAR ESQUERDA - Benefícios e Informações -->
  <aside class="sidebar">
    <div class="sidebar-card">
      <div class="sidebar-title">
        <i class="fas fa-gem"></i> Benefícios do cadastro
      </div>
      <div class="benefit-item">
        <div class="benefit-icon"><i class="fas fa-tachometer-alt"></i></div>
        <div class="benefit-text">
          <h4>Atendimento prioritário</h4>
          <p>Agende seus serviços com antecedência</p>
        </div>
      </div>
      <div class="benefit-item">
        <div class="benefit-icon"><i class="fas fa-file-signature"></i></div>
        <div class="benefit-text">
          <h4>Certidões online</h4>
          <p>Solicite certidões sem sair de casa</p>
        </div>
      </div>
      <div class="benefit-item">
        <div class="benefit-icon"><i class="fas fa-bell"></i></div>
        <div class="benefit-text">
          <h4>Acompanhamento em tempo real</h4>
          <p>Receba notificações sobre seus processos</p>
        </div>
      </div>
      <div class="benefit-item">
        <div class="benefit-icon"><i class="fas fa-shield-alt"></i></div>
        <div class="benefit-text">
          <h4>Segurança garantida</h4>
          <p>Dados protegidos conforme a LGPD</p>
        </div>
      </div>
    </div>

    <div class="sidebar-card">
      <div class="sidebar-title">
        <i class="fas fa-clock"></i> Prazo de análise
      </div>
      <div class="benefit-text" style="text-align: center; padding: 0.5rem 0;">
        <p style="font-size: 1.3rem; font-weight: 700; color: #1b4f6e;">24h úteis</p>
        <p style="font-size: 0.7rem;">Seus documentos serão analisados em até 24 horas úteis</p>
        <div style="margin-top: 0.8rem;">
          <span class="badge-security"><i class="fas fa-lock"></i> Ambiente 100% seguro</span>
        </div>
      </div>
    </div>
  </aside>

  <!-- FORMULÁRIO CENTRAL -->
  <div class="form-card">
    <div class="card-title">
      <h2><i class="fas fa-user-check"></i> Complete seu cadastro</h2>
      <p>Precisamos de alguns dados para liberar seu acesso completo</p>
    </div>

    <div class="step-progress">
      <div class="steps">
        <div class="step active" id="step1Indicator"><div class="step-circle">1</div><div class="step-label">Quem é você?</div></div>
        <div class="step" id="step2Indicator"><div class="step-circle">2</div><div class="step-label">Seu endereço</div></div>
        <div class="step" id="step3Indicator"><div class="step-circle">3</div><div class="step-label">Documentos</div></div>
      </div>
    </div>

    <form method="POST" action="{{ route('complementary-add-on.store') }}" enctype="multipart/form-data" id="complementForm">
      @csrf
      
      @if(session('error'))
        <div class="message-area message-error" style="margin: 0 1.5rem; margin-bottom: 15px; background:#ffe6e5; color:#b91c1c;"><i class="fas fa-exclamation-triangle"></i> {{ session('error') }}</div>
      @endif
      @if(session('success'))
        <div class="message-area message-success" style="margin: 0 1.5rem; margin-bottom: 15px; background:#e0f2fe; color:#198754;"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
      @endif

      <div class="step-content">
        <!-- ETAPA 1 -->
        <div class="step-pane active-pane" id="step1">
            @if ($errors->any())
                <div class="alert alert-error">
                    <strong><i class="fas fa-exclamation-circle"></i> Erros ao preencher o formulário:</strong>
                    <ul style="margin: 10px 0 0 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="info-box"><i class="fas fa-info-circle"></i> Seus dados ficarão protegidos conforme a LGPD.</div>
            <div class="input-group-friendly"><label><i class="fas fa-user"></i> Nome completo *</label><input type="text" name="name" value="{{$client->name}}" readonly disabled class="input-friendly" required></div>
            <div class="row-2">
                <div class="input-group-friendly"><label><i class="fas fa-id-card"></i> CPF *</label><input type="text" name="cpf" id="cpf" maxlength="14" class="input-friendly" required placeholder="000.000.000-00"></div>
                <div class="input-group-friendly"><label><i class="fas fa-id-card"></i> RG *</label><input type="text" name="rg" id="rg" maxlength="13" class="input-friendly" required placeholder="Nº do RG"></div>
            </div>
            <div class="row-3">
                <div class="input-group-friendly"><label><i class="fas fa-building"></i> Órgão emissor *</label><input type="text" name="issuing_body" class="input-friendly" required placeholder="Ex: SSP"></div>
                <div class="input-group-friendly"><label><i class="fas fa-calendar-alt"></i> Data de nascimento *</label><input type="date" name="birth_date" class="input-friendly" required></div>
                <div class="input-group-friendly">
                  <label for="gender">Gênero</label>
                  <select id="gender" name="gender" class="input-friendly" required>
                      <option value="">Selecione...</option>
                      <option value="male" {{ old('gender', $client->gender) == 'male' ? 'selected' : '' }}>Masculino</option>
                      <option value="female" {{ old('gender', $client->gender) == 'female' ? 'selected' : '' }}>Feminino</option>
                      <option value="other" {{ old('gender', $client->gender) == 'other' ? 'selected' : '' }}>Outro</option>
                  </select>
                  @error('gender')
                      <span class="error-text">{{ $message }}</span>
                  @enderror
                </div>
            </div>
            <div class="row-2">
                <div class="input-group-friendly">
                    <label><i class="fas fa-globe"></i> Nacionalidade *</label>
                    <select name="nationality" class="input-friendly" required>
                        <option value="">Selecione</option>
                        <option value="brasileiro">Brasileiro</option>
                        <option value="naturalizado">Naturalizado</option>
                        <option value="estrangeiro">Estrangeiro</option>
                    </select>
                </div>
                <div class="input-group-friendly">
                    <label><i class="fas fa-heart"></i> Estado civil *</label>
                    <select name="marital_status" class="input-friendly" required>
                        <option value="">Selecione</option>
                        <option value="solteiro">Solteiro(a)</option>
                        <option value="casado">Casado(a)</option>
                        <option value="divorciado">Divorciado(a)</option>
                        <option value="viuvo">Viúvo(a)</option>
                        <option value="uniao_estavel">União Estável</option>
                    </select>
                </div>
            </div>
            <div class="input-group-friendly"><label><i class="fas fa-female"></i> Nome da mãe *</label><input type="text" name="mother_name" class="input-friendly" required placeholder="Nome completo da sua mãe"></div>
            <div class="input-group-friendly"><label><i class="fas fa-male"></i> Nome do pai</label><input type="text" name="father_name" class="input-friendly" placeholder="Nome completo do seu pai (opcional)"></div>
        </div>
        <!-- ETAPA 2 -->
        <div class="step-pane" id="step2">
            <div class="info-box"><i class="fas fa-map-marker-alt"></i> Digite seu CEP para preencher automaticamente.</div>
            <div class="input-group-friendly"><label><i class="fas fa-mail-bulk"></i> CEP *</label><input type="text" name="cep" id="cep" class="input-friendly" required placeholder="00000-000"></div>
            <div class="input-group-friendly"><label><i class="fas fa-road"></i> Rua *</label><input type="text" name="street" id="street" class="input-friendly" required></div>
            <div class="row-2">
                <div class="input-group-friendly"><label><i class="fas fa-hashtag"></i> Número *</label><input type="text" name="number" class="input-friendly" required placeholder="Número"></div>
                <div class="input-group-friendly"><label><i class="fas fa-building"></i> Complemento</label><input type="text" name="complement" class="input-friendly" placeholder="Apto, bloco"></div>
            </div>
            <div class="input-group-friendly"><label><i class="fas fa-location-dot"></i> Bairro *</label><input type="text" name="neighborhood" id="neighborhood" class="input-friendly" required></div>
            <div class="row-2">
                <div class="input-group-friendly"><label><i class="fas fa-city"></i> Cidade *</label><input type="text" name="city" id="city" class="input-friendly" required></div>
                <div class="input-group-friendly">
                    <label><i class="fas fa-map-pin"></i> Estado *</label>
                    <select name="state" id="state" class="input-friendly" required>
                        <option value="">Selecione</option>
                        <option value="BA">Bahia</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- ETAPA 3 -->
        <div class="step-pane" id="step3">
            <div class="info-box"><i class="fas fa-cloud-upload-alt"></i> Envie fotos legíveis dos seus documentos.</div>
            <div class="input-group-friendly">
                <label><i class="fas fa-id-card"></i> Foto do RG *</label>
                <div class="upload-box" onclick="document.getElementById('rg_file').click()">
                    <i class="fas fa-image"></i>
                    <div>Clique para enviar</div>
                    <div class="btn-upload">Selecionar arquivo</div>
                </div>
                <input type="file" id="rg_file" name="rg_file" accept=".pdf,.jpg,.jpeg,.png" style="display:none;" required>
                <div class="file-status" id="rg_status"></div>
            </div>
            <div class="input-group-friendly">
                <label><i class="fas fa-id-card"></i> Foto do CPF *</label>
                <div class="upload-box" onclick="document.getElementById('cpf_file').click()">
                    <i class="fas fa-image"></i>
                    <div>Clique para enviar</div>
                    <div class="btn-upload">Selecionar arquivo</div>
                </div>
                <input type="file" id="cpf_file" name="cpf_file" accept=".pdf,.jpg,.jpeg,.png" style="display:none;" required>
                <div class="file-status" id="cpf_status"></div>
            </div>
            <div class="input-group-friendly">
                <label><i class="fas fa-home"></i> Comprovante de residência *</label>
                <div class="upload-box" onclick="document.getElementById('proof_address').click()">
                    <i class="fas fa-file-alt"></i>
                    <div>Conta de luz, água ou internet</div>
                    <div class="btn-upload">Selecionar arquivo</div>
                </div>
                <input type="file" id="proof_address" name="proof_address" accept=".pdf,.jpg,.jpeg,.png" style="display:none;" required>
                <div class="file-status" id="proof_status"></div>
            </div>
            <div class="input-group-friendly">
                <label><i class="fas fa-folder-open"></i> Outros documentos (opcional)</label>
                <div class="upload-box" onclick="document.getElementById('other_docs').click()">
                    <i class="fas fa-plus-circle"></i>
                    <div>Envie outros documentos se necessário</div>
                    <div class="btn-upload">Selecionar arquivos</div>
                </div>
                <input type="file" id="other_docs" name="other_documents[]" multiple accept=".pdf,.jpg,.jpeg,.png" style="display:none;">
                <div class="file-status" id="other_status"></div>
            </div>
        </div>

        <div class="nav-buttons">
          <button type="button" class="btn-prev" id="prevBtn" style="display: none;"><i class="fas fa-arrow-left"></i> Voltar</button>
          <button type="button" class="btn-next" id="nextBtn">Continuar <i class="fas fa-arrow-right"></i></button>
          <button type="submit" class="btn-submit-final" id="submitBtn" style="display: none;"><i class="fas fa-check-circle"></i> Finalizar cadastro</button>
        </div>
      </div>
    </form>
  </div>

  <!-- SIDEBAR DIREITA - Contato e Ajuda -->
  <aside class="sidebar">
    <div class="sidebar-card">
      <div class="sidebar-title"><i class="fas fa-headset"></i> Precisa de ajuda?</div>
      <div class="contact-item"><i class="fab fa-whatsapp"></i> <a href="#">(11) 99999-1234</a></div>
      <div class="contact-item"><i class="fas fa-phone-alt"></i> (11) 3456-7890</div>
      <div class="contact-item"><i class="fas fa-envelope"></i> <a href="mailto:suporte@cartoriocentral.com.br">suporte@cartoriocentral.com.br</a></div>
      <div class="hours"><i class="fas fa-clock"></i> Segunda a Sexta: 9h às 18h</div>
    </div>

    <div class="sidebar-card">
      <div class="sidebar-title"><i class="fas fa-question-circle"></i> Dúvidas frequentes</div>
      <div class="benefit-item">
        <div class="benefit-icon"><i class="fas fa-file"></i></div>
        <div class="benefit-text"><h4>Quais documentos enviar?</h4><p>RG, CPF e comprovante de residência</p></div>
      </div>
      <div class="benefit-item">
        <div class="benefit-icon"><i class="fas fa-clock"></i></div>
        <div class="benefit-text"><h4>Quanto tempo demora?</h4><p>Análise em até 24h úteis</p></div>
      </div>
      <div class="benefit-item">
        <div class="benefit-icon"><i class="fas fa-lock"></i></div>
        <div class="benefit-text"><h4>Meus dados estão seguros?</h4><p>Sim, seguimos a LGPD</p></div>
      </div>
    </div>

    <div class="sidebar-card">
      <div class="sidebar-title"><i class="fas fa-star"></i> Avaliação do serviço</div>
      <div style="text-align: center;">
        <div style="color: #ffc107; font-size: 1rem;">★★★★★</div>
        <p style="font-size: 0.7rem; margin-top: 0.3rem;">4.9 de 5 - Baseado em 2.500+ avaliações</p>
      </div>
    </div>
  </aside>
</div>

<script>
  // Máscara RG
  const rgInput = document.getElementById('rg');

  rgInput.addEventListener('input', function (e) {
      let value = e.target.value;

      // Remove tudo que não for número
      value = value.replace(/\D/g, '');

      // Limita a 9 números
      value = value.substring(0, 10);

      // Aplica a máscara
      value = value.replace(/^(\d{2})(\d)/, '$1.$2');
      value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
      value = value.replace(/\.(\d{3})(\d)/, '.$1-$2');

      e.target.value = value;
  });

  // Máscara CPF
  const cpfInput = document.getElementById('cpf');
  if(cpfInput) {
    cpfInput.addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, '');
      if(value.length <= 11) {
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        e.target.value = value;
      }
    });
  }

  // CEP
  const cepElement = document.getElementById('cep');
  if(cepElement) {
    cepElement.addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, '');
      if(value.length <= 8) value = value.replace(/(\d{5})(\d)/, '$1-$2');
      e.target.value = value;
    });
    cepElement.addEventListener('blur', function() {
      const cep = this.value.replace(/\D/g, '');
      if(cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
          .then(r => r.json())
          .then(data => {
            if(!data.erro) {
              document.getElementById('street').value = data.logradouro || '';
              document.getElementById('neighborhood').value = data.bairro || '';
              document.getElementById('city').value = data.localidade || '';
              document.getElementById('state').value = data.uf || '';
            }
          });
      }
    });
  }

  // Navegação
  let currentStep = 1;
  const step1 = document.getElementById('step1'), step2 = document.getElementById('step2'), step3 = document.getElementById('step3');
  const step1Ind = document.getElementById('step1Indicator'), step2Ind = document.getElementById('step2Indicator'), step3Ind = document.getElementById('step3Indicator');
  const prevBtn = document.getElementById('prevBtn'), nextBtn = document.getElementById('nextBtn'), submitBtn = document.getElementById('submitBtn');

  function updateSteps() {
    step1.classList.remove('active-pane'); step2.classList.remove('active-pane'); step3.classList.remove('active-pane');
    if(currentStep === 1) step1.classList.add('active-pane');
    if(currentStep === 2) step2.classList.add('active-pane');
    if(currentStep === 3) step3.classList.add('active-pane');
    
    step1Ind.classList.remove('active','completed');
    step2Ind.classList.remove('active','completed');
    step3Ind.classList.remove('active','completed');
    if(currentStep >= 1) step1Ind.classList.add(currentStep > 1 ? 'completed' : 'active');
    if(currentStep >= 2) step2Ind.classList.add(currentStep > 2 ? 'completed' : 'active');
    if(currentStep >= 3) step3Ind.classList.add('active');
    
    prevBtn.style.display = currentStep === 1 ? 'none' : 'flex';
    nextBtn.style.display = currentStep === 3 ? 'none' : 'flex';
    submitBtn.style.display = currentStep === 3 ? 'flex' : 'none';
  }

  function validateStep() {
    let currentPane = document.querySelector('.step-pane.active-pane');
    let required = currentPane.querySelectorAll('input[required], select[required]');
    for(let f of required) {
      if(f.type === 'file') { if(f.files.length === 0) { alert('Por favor, anexe o arquivo solicitado'); return false; } }
      else if(!f.value.trim()) { alert('Preencha todos os campos obrigatórios'); return false; }
    }
    return true;
  }

  nextBtn.addEventListener('click', () => { if(validateStep()) { currentStep++; updateSteps(); } });
  prevBtn.addEventListener('click', () => { currentStep--; updateSteps(); });
  updateSteps();

  function showFileName(inputId, statusId) {
    const inp = document.getElementById(inputId), stat = document.getElementById(statusId);
    if(inp && stat) inp.addEventListener('change', () => { if(inp.files.length) stat.innerHTML = '<i class="fas fa-check-circle"></i> Arquivo selecionado'; else stat.innerHTML = ''; });
  }
  showFileName('rg_file','rg_status'); showFileName('cpf_file','cpf_status'); showFileName('proof_address','proof_status');
  const otherDocs = document.getElementById('other_docs'), otherStatus = document.getElementById('other_status');
  if(otherDocs && otherStatus) otherDocs.addEventListener('change', () => { if(otherDocs.files.length) otherStatus.innerHTML = `<i class="fas fa-check-circle"></i> ${otherDocs.files.length} arquivo(s) selecionado(s)`; else otherStatus.innerHTML = ''; });

</script>
</body>
</html>
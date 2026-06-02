<div class="row">
    <!-- Nome do Serviço -->
    <div class="mb-3 col-12 col-md-6">
        <label for="name" class="form-label">Nome do Serviço <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $service->name ?? '') }}" required>
    </div>
    
    <!-- Ícone do Serviço -->
    <div class="mb-3 col-12 col-md-6">
        <label for="icon" class="form-label">Selecione um ícone para representar o serviço</label>
        <div class="position-relative">
            <select name="icon" class="form-control" id="icon">
                <option value="">Selecione um ícone...</option>
                
                <optgroup label="📄 Certidões e Documentos">
                    <option value="bi-baby" {{ isset($service) && $service->icon == 'bi-baby' ? 'selected' : '' }}>👶 bi-baby - Certidão de Nascimento</option>
                    <option value="bi-hearts" {{ isset($service) && $service->icon == 'bi-hearts' ? 'selected' : '' }}>💕 bi-hearts - Certidão de Casamento</option>
                    <option value="bi-file-text" {{ isset($service) && $service->icon == 'bi-file-text' ? 'selected' : '' }}>📄 bi-file-text - Certidão em Geral</option>
                    <option value="bi-file-earmark-text" {{ isset($service) && $service->icon == 'bi-file-earmark-text' ? 'selected' : '' }}>📋 bi-file-earmark-text - Documento Oficial</option>
                    <option value="bi-journal" {{ isset($service) && $service->icon == 'bi-journal' ? 'selected' : '' }}>📘 bi-journal - Registro/Livro</option>
                </optgroup>
                
                <optgroup label="🏠 Imóveis e Escrituras">
                    <option value="bi-house-door" {{ isset($service) && $service->icon == 'bi-house-door' ? 'selected' : '' }}>🏠 bi-house-door - Escritura de Compra e Venda</option>
                    <option value="bi-building" {{ isset($service) && $service->icon == 'bi-building' ? 'selected' : '' }}>🏛️ bi-building - Escritura em Geral</option>
                    <option value="bi-tree" {{ isset($service) && $service->icon == 'bi-tree' ? 'selected' : '' }}>🌳 bi-tree - Imóvel Rural</option>
                    <option value="bi-geo-alt" {{ isset($service) && $service->icon == 'bi-geo-alt' ? 'selected' : '' }}>📍 bi-geo-alt - Localização/Matrícula</option>
                </optgroup>
                
                <optgroup label="✍️ Autenticação e Firmas">
                    <option value="bi-pen" {{ isset($service) && $service->icon == 'bi-pen' ? 'selected' : '' }}>✍️ bi-pen - Reconhecimento de Firma</option>
                    <option value="bi-shield-check" {{ isset($service) && $service->icon == 'bi-shield-check' ? 'selected' : '' }}>🛡️ bi-shield-check - Autenticação</option>
                    <option value="bi-check2-circle" {{ isset($service) && $service->icon == 'bi-check2-circle' ? 'selected' : '' }}>✅ bi-check2-circle - Validação</option>
                    <option value="bi-person-badge" {{ isset($service) && $service->icon == 'bi-person-badge' ? 'selected' : '' }}>🆔 bi-person-badge - Identificação</option>
                </optgroup>
                
                <optgroup label="⚖️ Inventário e Sucessão">
                    <option value="bi-folder-symlink" {{ isset($service) && $service->icon == 'bi-folder-symlink' ? 'selected' : '' }}>📁 bi-folder-symlink - Inventário</option>
                    <option value="bi-people" {{ isset($service) && $service->icon == 'bi-people' ? 'selected' : '' }}>👥 bi-people - Herdeiros</option>
                    <option value="bi-clock-history" {{ isset($service) && $service->icon == 'bi-clock-history' ? 'selected' : '' }}>🕐 bi-clock-history - Histórico</option>
                </optgroup>
                
                <optgroup label="📊 Financeiro e Taxas">
                    <option value="bi-cash-stack" {{ isset($service) && $service->icon == 'bi-cash-stack' ? 'selected' : '' }}>💰 bi-cash-stack - Emolumentos/Taxas</option>
                    <option value="bi-wallet2" {{ isset($service) && $service->icon == 'bi-wallet2' ? 'selected' : '' }}>👛 bi-wallet2 - Pagamento</option>
                    <option value="bi-graph-up" {{ isset($service) && $service->icon == 'bi-graph-up' ? 'selected' : '' }}>📊 bi-graph-up - Estatísticas</option>
                </optgroup>
                
                <optgroup label="🔍 Consultas e Pesquisas">
                    <option value="bi-search" {{ isset($service) && $service->icon == 'bi-search' ? 'selected' : '' }}>🔍 bi-search - Consulta</option>
                    <option value="bi-qr-code" {{ isset($service) && $service->icon == 'bi-qr-code' ? 'selected' : '' }}>📱 bi-qr-code - Código/Autenticação</option>
                    <option value="bi-download" {{ isset($service) && $service->icon == 'bi-download' ? 'selected' : '' }}>⬇️ bi-download - Emissão/Download</option>
                    <option value="bi-upload" {{ isset($service) && $service->icon == 'bi-upload' ? 'selected' : '' }}>⬆️ bi-upload - Envio</option>
                </optgroup>
                
                <optgroup label="📅 Atendimento e Agendamento">
                    <option value="bi-calendar-event" {{ isset($service) && $service->icon == 'bi-calendar-event' ? 'selected' : '' }}>📅 bi-calendar-event - Agendamento</option>
                    <option value="bi-telephone" {{ isset($service) && $service->icon == 'bi-telephone' ? 'selected' : '' }}>📞 bi-telephone - Contato</option>
                    <option value="bi-envelope-paper" {{ isset($service) && $service->icon == 'bi-envelope-paper' ? 'selected' : '' }}>✉️ bi-envelope-paper - Correspondência</option>
                    <option value="bi-printer" {{ isset($service) && $service->icon == 'bi-printer' ? 'selected' : '' }}>🖨️ bi-printer - Impressão</option>
                </optgroup>
                
                <optgroup label="🏢 Empresarial e Comercial">
                    <option value="bi-briefcase" {{ isset($service) && $service->icon == 'bi-briefcase' ? 'selected' : '' }}>💼 bi-briefcase - Empresarial</option>
                    <option value="bi-truck" {{ isset($service) && $service->icon == 'bi-truck' ? 'selected' : '' }}>🚚 bi-truck - Veículos</option>
                    <option value="bi-card-text" {{ isset($service) && $service->icon == 'bi-card-text' ? 'selected' : '' }}>🪪 bi-card-text - Documentos Pessoais</option>
                    <option value="bi-mortarboard" {{ isset($service) && $service->icon == 'bi-mortarboard' ? 'selected' : '' }}>🎓 bi-mortarboard - Diplomas/Educação</option>
                </optgroup>
            </select>
            <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%); pointer-events: none;">
                <i class="bi bi-chevron-down"></i>
            </div>
        </div>
        <small class="text-muted">O ícone será exibido na lista de serviços do frontend</small>
    </div>
    
    <!-- Ordem de Exibição -->
    <div class="mb-3 col-12 col-md-2">
        <label for="display_order" class="form-label">Ordem de Exibição</label>
        <input type="number" name="display_order" class="form-control" id="display_order" value="{{ old('display_order', $service->display_order ?? 0) }}">
        <small class="text-muted">Números menores aparecem primeiro</small>
    </div>
    
    <!-- Valor do Serviço -->
    <div class="mb-3 col-12 col-md-5">
        <label for="service_value" class="form-label">Valor do Serviço (R$)</label>
        <input type="number" name="service_value" class="form-control" id="service_value" step="0.01" min="0" value="{{ old('service_value', $service->service_value ?? '') }}" placeholder="0.00">
        <small class="text-muted">Deixe em branco se o serviço for gratuito</small>
    </div>
    
    <!-- Status -->
    <div class="mb-3 col-12 col-md-5">
        <label for="is_active" class="form-label">Status</label>
        <select name="is_active" class="form-select" id="is_active">
            <option value="1" {{ old('is_active', $service->is_active ?? 1) == 1 ? 'selected' : '' }}>Ativo</option>
            <option value="0" {{ old('is_active', $service->is_active ?? 1) == 0 ? 'selected' : '' }}>Inativo</option>
        </select>
    </div>
    
    <!-- Instruções -->
    <div class="col-12 mb-3">
        <label for="instructions" class="form-label">Instruções do Serviço</label>
        <textarea name="instructions" class="form-control" id="instructions" rows="3" placeholder="Instruções para o cliente sobre este serviço">{{ old('instructions', $service->instructions ?? '') }}</textarea>
    </div>
</div>

<hr>

<!-- Campos Dinâmicos do Formulário -->
<h5 class="mt-3 mb-3">Campos Dinâmicos do Formulário</h5>
<p class="text-muted small mb-3">Defina os campos que o cliente deverá preencher ao solicitar este serviço</p>

<div id="dynamic-fields-container">
    @php
        $dynamicFields = old('dynamic_fields', isset($service) && $service->dynamic_fields ? $service->dynamic_fields : []);
        if (!is_array($dynamicFields)) {
            $dynamicFields = [];
        }
    @endphp
    
    @if(count($dynamicFields) > 0)
        @foreach($dynamicFields as $index => $field)
            <div class="dynamic-field-item card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label>Nome do Campo <span class="text-danger">*</span></label>
                            <input type="text" name="dynamic_fields[{{ $index }}][name]" class="form-control" value="{{ $field['name'] ?? '' }}" placeholder="ex: nome_conjuge" required>
                            <small class="text-muted">Usado internamente (sem espaços)</small>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>Label <span class="text-danger">*</span></label>
                            <input type="text" name="dynamic_fields[{{ $index }}][label]" class="form-control" value="{{ $field['label'] ?? '' }}" placeholder="ex: Nome do Cônjuge" required>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label>Tipo</label>
                            <select name="dynamic_fields[{{ $index }}][type]" class="form-control field-type" data-index="{{ $index }}">
                                <option value="text" {{ ($field['type'] ?? '') == 'text' ? 'selected' : '' }}>📝 Texto</option>
                                <option value="number" {{ ($field['type'] ?? '') == 'number' ? 'selected' : '' }}>🔢 Número</option>
                                <option value="date" {{ ($field['type'] ?? '') == 'date' ? 'selected' : '' }}>📅 Data</option>
                                <option value="email" {{ ($field['type'] ?? '') == 'email' ? 'selected' : '' }}>📧 E-mail</option>
                                <option value="tel" {{ ($field['type'] ?? '') == 'tel' ? 'selected' : '' }}>📞 Telefone</option>
                                <option value="select" {{ ($field['type'] ?? '') == 'select' ? 'selected' : '' }}>📋 Select</option>
                                <option value="textarea" {{ ($field['type'] ?? '') == 'textarea' ? 'selected' : '' }}>📄 Textarea</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label>Obrigatório</label>
                            <select name="dynamic_fields[{{ $index }}][required]" class="form-control">
                                <option value="0" {{ ($field['required'] ?? 0) == 0 ? 'selected' : '' }}>❌ Não</option>
                                <option value="1" {{ ($field['required'] ?? 0) == 1 ? 'selected' : '' }}>✅ Sim</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label>&nbsp;</label>
                            <button type="button" class="btn btn-danger form-control remove-field">
                                <i class="bi bi-trash"></i> Remover
                            </button>
                        </div>
                        
                        <div class="col-md-12 mt-2 options-container" style="display: {{ ($field['type'] ?? '') == 'select' ? 'block' : 'none' }}">
                            <label>Opções (separadas por vírgula)</label>
                            <input type="text" name="dynamic_fields[{{ $index }}][options]" class="form-control" value="{{ is_array($field['options'] ?? null) ? implode(', ', $field['options']) : ($field['options'] ?? '') }}" placeholder="ex: Opção 1, Opção 2, Opção 3">
                            <small class="text-muted">Apenas para campos do tipo Select</small>
                        </div>
                        
                        <div class="col-md-12 mt-2">
                            <label>Placeholder</label>
                            <input type="text" name="dynamic_fields[{{ $index }}][placeholder]" class="form-control" value="{{ $field['placeholder'] ?? '' }}" placeholder="Texto de exemplo dentro do campo">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<button type="button" class="btn btn-secondary mb-4" id="add-field-btn">
    <i class="bi bi-plus-circle"></i> Adicionar Campo
</button>

<hr>

<!-- Documentos Necessários -->
<h5 class="mt-3 mb-3">Documentos Necessários</h5>
<p class="text-muted small mb-3">Liste os documentos que o cliente precisa enviar para este serviço</p>

<div id="documents-container">
    @php
        $requiredDocs = old('required_documents', isset($service) && $service->required_documents ? $service->required_documents : []);
        if (!is_array($requiredDocs)) {
            $requiredDocs = [];
        }
    @endphp
    
    @if(count($requiredDocs) > 0)
        @foreach($requiredDocs as $index => $doc)
            <div class="document-item input-group mb-2">
                <span class="input-group-text"><i class="bi bi-file-earmark-text"></i></span>
                <input type="text" name="required_documents[]" class="form-control" value="{{ $doc }}" placeholder="Digite o documento necessário">
                <button type="button" class="btn btn-danger remove-document">
                    <i class="bi bi-trash"></i> Remover
                </button>
            </div>
        @endforeach
    @endif
</div>

<button type="button" class="btn btn-secondary mb-4" id="add-document-btn">
    <i class="bi bi-plus-circle"></i> Adicionar Documento
</button>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Contador para novos campos
    let fieldIndex = {{ isset($dynamicFields) && is_array($dynamicFields) ? count($dynamicFields) : 0 }};
    let docIndex = {{ isset($requiredDocs) && is_array($requiredDocs) ? count($requiredDocs) : 0 }};
    
    // ==================== CAMPOS DINÂMICOS ====================
    
    // Função para anexar eventos a um campo
    function attachFieldEvents(fieldElement) {
        // Remover campo
        const removeBtn = fieldElement.querySelector('.remove-field');
        if (removeBtn) {
            removeBtn.addEventListener('click', function() {
                fieldElement.remove();
            });
        }
        
        // Mostrar/esconder opções baseado no tipo
        const typeSelect = fieldElement.querySelector('.field-type');
        const optionsContainer = fieldElement.querySelector('.options-container');
        
        if (typeSelect && optionsContainer) {
            typeSelect.addEventListener('change', function() {
                optionsContainer.style.display = this.value === 'select' ? 'block' : 'none';
            });
        }
    }
    
    // Adicionar campo dinâmico
    const addFieldBtn = document.getElementById('add-field-btn');
    if (addFieldBtn) {
        addFieldBtn.addEventListener('click', function() {
            const container = document.getElementById('dynamic-fields-container');
            const newIndex = fieldIndex++;
            
            const fieldHtml = `
                <div class="dynamic-field-item card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label>Nome do Campo <span class="text-danger">*</span></label>
                                <input type="text" name="dynamic_fields[${newIndex}][name]" class="form-control" placeholder="ex: nome_campo" required>
                                <small class="text-muted">Usado internamente (sem espaços)</small>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Label <span class="text-danger">*</span></label>
                                <input type="text" name="dynamic_fields[${newIndex}][label]" class="form-control" placeholder="ex: Nome do Campo" required>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label>Tipo</label>
                                <select name="dynamic_fields[${newIndex}][type]" class="form-control field-type" data-index="${newIndex}">
                                    <option value="text">📝 Texto</option>
                                    <option value="number">🔢 Número</option>
                                    <option value="date">📅 Data</option>
                                    <option value="email">📧 E-mail</option>
                                    <option value="tel">📞 Telefone</option>
                                    <option value="select">📋 Select</option>
                                    <option value="textarea">📄 Textarea</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label>Obrigatório</label>
                                <select name="dynamic_fields[${newIndex}][required]" class="form-control">
                                    <option value="0">❌ Não</option>
                                    <option value="1">✅ Sim</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-danger form-control remove-field">
                                    <i class="bi bi-trash"></i> Remover
                                </button>
                            </div>
                            <div class="col-md-12 mt-2 options-container" style="display: none;">
                                <label>Opções (separadas por vírgula)</label>
                                <input type="text" name="dynamic_fields[${newIndex}][options]" class="form-control" placeholder="ex: Opção 1, Opção 2, Opção 3">
                                <small class="text-muted">Apenas para campos do tipo Select</small>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label>Placeholder</label>
                                <input type="text" name="dynamic_fields[${newIndex}][placeholder]" class="form-control" placeholder="Texto de exemplo dentro do campo">
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', fieldHtml);
            
            // Adicionar eventos ao novo campo
            const newField = container.lastElementChild;
            attachFieldEvents(newField);
        });
    }
    
    // Anexar eventos aos campos existentes
    document.querySelectorAll('.dynamic-field-item').forEach(field => {
        attachFieldEvents(field);
    });
    
    // ==================== DOCUMENTOS NECESSÁRIOS ====================
    
    // Adicionar documento
    const addDocumentBtn = document.getElementById('add-document-btn');
    if (addDocumentBtn) {
        addDocumentBtn.addEventListener('click', function() {
            const container = document.getElementById('documents-container');
            const docHtml = `
                <div class="document-item input-group mb-2">
                    <span class="input-group-text"><i class="bi bi-file-earmark-text"></i></span>
                    <input type="text" name="required_documents[]" class="form-control" placeholder="Digite o documento necessário">
                    <button type="button" class="btn btn-danger remove-document">
                        <i class="bi bi-trash"></i> Remover
                    </button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', docHtml);
            
            // Adicionar evento ao novo botão de remover
            const newDoc = container.lastElementChild;
            const removeBtn = newDoc.querySelector('.remove-document');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    newDoc.remove();
                });
            }
        });
    }
    
    // Anexar eventos aos documentos existentes
    document.querySelectorAll('.document-item .remove-document').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.document-item').remove();
        });
    });
    
    // ==================== PRÉ-VISUALIZAÇÃO DO ÍCONE ====================
    
    // Mostrar pré-visualização do ícone selecionado
    const iconSelect = document.getElementById('icon');
    if (iconSelect) {
        // Criar elemento de pré-visualização
        const previewDiv = document.createElement('div');
        previewDiv.className = 'mt-2 p-2 border rounded bg-light text-center';
        previewDiv.style.display = 'none';
        previewDiv.innerHTML = `
            <small class="text-muted">Pré-visualização do ícone:</small>
            <div class="mt-1">
                <i class="bi fs-1" id="icon-preview"></i>
                <span id="icon-name" class="ms-2"></span>
            </div>
        `;
        iconSelect.parentElement.parentElement.appendChild(previewDiv);
        
        const updatePreview = () => {
            const selectedOption = iconSelect.options[iconSelect.selectedIndex];
            const iconValue = iconSelect.value;
            
            if (iconValue) {
                const iconClass = iconValue;
                const iconText = selectedOption.textContent.split('-')[1]?.trim() || iconValue;
                
                const previewIcon = document.getElementById('icon-preview');
                const previewName = document.getElementById('icon-name');
                
                if (previewIcon && previewName) {
                    previewIcon.className = `bi ${iconClass} fs-1`;
                    previewName.textContent = iconText;
                    previewDiv.style.display = 'block';
                }
            } else {
                previewDiv.style.display = 'none';
            }
        };
        
        iconSelect.addEventListener('change', updatePreview);
        updatePreview(); // Executar inicial
    }
});
</script>

<style>
.dynamic-field-item {
    transition: all 0.3s ease;
    border-left: 3px solid #4B9CD3;
}
.dynamic-field-item:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.document-item {
    transition: all 0.2s ease;
}
.document-item:hover {
    transform: translateX(5px);
}
</style>
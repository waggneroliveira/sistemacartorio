@php
    $textareaId = 'instructions' . (isset($service->id) ? $service->id : '');
    $documentsId = 'documents' . (isset($service->id) ? $service->id : '');
@endphp

<div class="row">
    <div class="mb-3 col-12 col-md-6">
        <label for="name" class="form-label">Nome do Serviço</label>
        <input type="text" name="name" class="form-control" id="name{{isset($service->id)?$service->id:''}}" value="{{isset($service)?$service->name:''}}" placeholder="Informe o nome do serviço">
    </div>
    
    <div class="mb-3 col-12 col-md-6">
        <label for="icon" class="form-label">Selecione um ícone para representar o serviço</label>
        <div class="position-relative">
                <select name="icon" class="form-control" id="icon{{isset($service->id)?$service->id:''}}">
            <option value="">Selecione um ícone...</option>
            
            <optgroup label="📄 Certidões e Documentos">
                <option value="bi-baby" {{isset($service) && $service->icon == 'bi-baby' ? 'selected' : ''}}>👶 bi-baby - Certidão de Nascimento</option>
                <option value="bi-hearts" {{isset($service) && $service->icon == 'bi-hearts' ? 'selected' : ''}}>💕 bi-hearts - Certidão de Casamento</option>
                <option value="bi-file-text" {{isset($service) && $service->icon == 'bi-file-text' ? 'selected' : ''}}>📄 bi-file-text - Certidão em Geral</option>
                <option value="bi-file-earmark-text" {{isset($service) && $service->icon == 'bi-file-earmark-text' ? 'selected' : ''}}>📋 bi-file-earmark-text - Documento Oficial</option>
                <option value="bi-journal" {{isset($service) && $service->icon == 'bi-journal' ? 'selected' : ''}}>📘 bi-journal - Registro/Livro</option>
            </optgroup>
            
            <optgroup label="🏠 Imóveis e Escrituras">
                <option value="bi-house-door" {{isset($service) && $service->icon == 'bi-house-door' ? 'selected' : ''}}>🏠 bi-house-door - Escritura de Compra e Venda</option>
                <option value="bi-building" {{isset($service) && $service->icon == 'bi-building' ? 'selected' : ''}}>🏛️ bi-building - Escritura em Geral</option>
                <option value="bi-tree" {{isset($service) && $service->icon == 'bi-tree' ? 'selected' : ''}}>🌳 bi-tree - Imóvel Rural</option>
                <option value="bi-geo-alt" {{isset($service) && $service->icon == 'bi-geo-alt' ? 'selected' : ''}}>📍 bi-geo-alt - Localização/Matrícula</option>
            </optgroup>
            
            <optgroup label="✍️ Autenticação e Firmas">
                <option value="bi-pen" {{isset($service) && $service->icon == 'bi-pen' ? 'selected' : ''}}>✍️ bi-pen - Reconhecimento de Firma</option>
                <option value="bi-shield-check" {{isset($service) && $service->icon == 'bi-shield-check' ? 'selected' : ''}}>🛡️ bi-shield-check - Autenticação</option>
                <option value="bi-check2-circle" {{isset($service) && $service->icon == 'bi-check2-circle' ? 'selected' : ''}}>✅ bi-check2-circle - Validação</option>
                <option value="bi-person-badge" {{isset($service) && $service->icon == 'bi-person-badge' ? 'selected' : ''}}>🆔 bi-person-badge - Identificação</option>
            </optgroup>
            
            <optgroup label="⚖️ Inventário e Sucessão">
                <option value="bi-folder-symlink" {{isset($service) && $service->icon == 'bi-folder-symlink' ? 'selected' : ''}}>📁 bi-folder-symlink - Inventário</option>
                <option value="bi-people" {{isset($service) && $service->icon == 'bi-people' ? 'selected' : ''}}>👥 bi-people - Herdeiros</option>
                <option value="bi-clock-history" {{isset($service) && $service->icon == 'bi-clock-history' ? 'selected' : ''}}>🕐 bi-clock-history - Histórico</option>
            </optgroup>
            
            <optgroup label="📊 Financeiro e Taxas">
                <option value="bi-cash-stack" {{isset($service) && $service->icon == 'bi-cash-stack' ? 'selected' : ''}}>💰 bi-cash-stack - Emolumentos/Taxas</option>
                <option value="bi-wallet2" {{isset($service) && $service->icon == 'bi-wallet2' ? 'selected' : ''}}>👛 bi-wallet2 - Pagamento</option>
                <option value="bi-graph-up" {{isset($service) && $service->icon == 'bi-graph-up' ? 'selected' : ''}}>📊 bi-graph-up - Estatísticas</option>
            </optgroup>
            
            <optgroup label="🔍 Consultas e Pesquisas">
                <option value="bi-search" {{isset($service) && $service->icon == 'bi-search' ? 'selected' : ''}}>🔍 bi-search - Consulta</option>
                <option value="bi-qr-code" {{isset($service) && $service->icon == 'bi-qr-code' ? 'selected' : ''}}>📱 bi-qr-code - Código/Autenticação</option>
                <option value="bi-download" {{isset($service) && $service->icon == 'bi-download' ? 'selected' : ''}}>⬇️ bi-download - Emissão/Download</option>
                <option value="bi-upload" {{isset($service) && $service->icon == 'bi-upload' ? 'selected' : ''}}>⬆️ bi-upload - Envio</option>
            </optgroup>
            
            <optgroup label="📅 Atendimento e Agendamento">
                <option value="bi-calendar-event" {{isset($service) && $service->icon == 'bi-calendar-event' ? 'selected' : ''}}>📅 bi-calendar-event - Agendamento</option>
                <option value="bi-telephone" {{isset($service) && $service->icon == 'bi-telephone' ? 'selected' : ''}}>📞 bi-telephone - Contato</option>
                <option value="bi-envelope-paper" {{isset($service) && $service->icon == 'bi-envelope-paper' ? 'selected' : ''}}>✉️ bi-envelope-paper - Correspondência</option>
                <option value="bi-printer" {{isset($service) && $service->icon == 'bi-printer' ? 'selected' : ''}}>🖨️ bi-printer - Impressão</option>
            </optgroup>
            
            <optgroup label="🏢 Empresarial e Comercial">
                <option value="bi-briefcase" {{isset($service) && $service->icon == 'bi-briefcase' ? 'selected' : ''}}>💼 bi-briefcase - Empresarial</option>
                <option value="bi-truck" {{isset($service) && $service->icon == 'bi-truck' ? 'selected' : ''}}>🚚 bi-truck - Veículos</option>
                <option value="bi-card-text" {{isset($service) && $service->icon == 'bi-card-text' ? 'selected' : ''}}>🪪 bi-card-text - Documentos Pessoais</option>
                <option value="bi-mortarboard" {{isset($service) && $service->icon == 'bi-mortarboard' ? 'selected' : ''}}>🎓 bi-mortarboard - Diplomas/Educação</option>
            </optgroup>
        </select>
            <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%); pointer-events: none;">
                <i class="bi bi-chevron-down"></i>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <label for="{{$textareaId}}" class="form-label">Instruções</label>
    <textarea name="instructions" class="form-control" id="{{$textareaId}}" rows="3" placeholder="Informe as instruções do serviço">
        {!!isset($service->instructions)?$service->instructions: ''!!}
    </textarea>
</div>

<!-- Documentos Necessários - Todo List -->
<div class="mb-3">
    <label class="form-label">Documentos Necessários</label>
    <div class="card">
        <div class="card-body px-0">
            <div id="{{$documentsId}}-list">
                @if(isset($service) && $service->required_documents && is_array($service->required_documents))
                    @foreach($service->required_documents as $index => $document)
                        <div class="input-group mb-2 document-item">
                            <input type="text" class="form-control" name="required_documents[]" value="{{ $document }}" placeholder="Digite o documento necessário">
                            <button type="button" class="btn btn-danger remove-document">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
            <button type="button" class="btn btn-primary btn-sm mt-2 add-document" data-list="{{$documentsId}}-list">
                <i class="bi bi-plus-circle"></i> Adicionar Documento
            </button>
        </div>
    </div>
    <p class="text-muted mt-1 mb-0">Adicione os documentos necessários para este serviço</p>
</div>

<div class="mb-3">
    <label for="display_order" class="form-label">Ordem de Exibição</label>
    <input type="number" name="display_order" class="form-control" id="display_order{{isset($service->id)?$service->id:''}}" value="{{isset($service)?$service->display_order:0}}" placeholder="0">
</div>

<div class="col-lg-12">
    <div class="mb-3">
        <label for="image" class="form-label">Imagem do Serviço</label>
        <input type="file" name="path_image" data-plugins="dropify" data-default-file="{{isset($service) && $service->path_image != '' ? url('storage/'.$service->path_image) : ''}}"  />
        <p class="text-muted text-center mt-2 mb-0">{{__('dashboard.text_img_size')}} <b class="text-danger">2 MB</b>.</p>
    </div>
</div>

<div class="mb-3">
    <div class="form-check">
        <input name="active" {{ isset($service->active) && $service->active == 1 ? 'checked' : (isset($service) ? '' : 'checked') }} type="checkbox" class="form-check-input" id="invalidCheck{{isset($service->id)?$service->id:''}}" />
        <label class="form-check-label" for="invalidCheck">{{__('dashboard.active')}}?</label>
        <div class="invalid-feedback">
            You must agree before submitting.
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize CKEditor with minimal toolbar
        if (document.getElementById("{{$textareaId}}")) {
            CKEDITOR.replace("{{$textareaId}}", {
                toolbar: [
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList'] }
                ],
                removeButtons: '',
                removePlugins: 'elementspath',
                resize_enabled: false,
                height: 150,
                toolbarCanCollapse: true
            });
        }
        
        // Dynamic documents list
        const documentsContainer = document.getElementById("{{$documentsId}}-list");
        
        // Function to add new document input
        window.addDocumentItem = function() {
            const newItem = document.createElement('div');
            newItem.className = 'input-group mb-2 document-item';
            newItem.innerHTML = `
                <input type="text" class="form-control" name="required_documents[]" placeholder="Digite o documento necessário">
                <button type="button" class="btn btn-danger remove-document">
                    <i class="bi bi-trash"></i>
                </button>
            `;
            documentsContainer.appendChild(newItem);
            
            // Add remove event to new button
            newItem.querySelector('.remove-document').addEventListener('click', function() {
                newItem.remove();
            });
        };
        
        // Add click event to add button
        const addButton = document.querySelector('.add-document');
        if (addButton) {
            addButton.addEventListener('click', window.addDocumentItem);
        }
        
        // Add remove event to existing remove buttons
        document.querySelectorAll('.remove-document').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.document-item').remove();
            });
        });
    });
</script>
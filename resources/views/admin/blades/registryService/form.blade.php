@php
    $textareaId = 'instructions' . (isset($service->id) ? $service->id : '');
@endphp

<div class="mb-3">
    <label for="name" class="form-label">Nome do Serviço</label>
    <input type="text" name="name" class="form-control" id="name{{isset($service->id)?$service->id:''}}" value="{{isset($service)?$service->name:''}}" placeholder="Informe o nome do serviço">
</div>

<div class="mb-3">
    <label for="icon" class="form-label">Ícone (Bootstrap Icons)</label>
    <input type="text" name="icon" class="form-control" id="icon{{isset($service->id)?$service->id:''}}" value="{{isset($service)?$service->icon:''}}" placeholder="Ex: bi-baby, bi-hearts, bi-house-door">
    <p class="text-muted mt-1 mb-0">Use ícones do Bootstrap Icons (https://icons.getbootstrap.com)</p>
</div>

<div class="mb-3">
    <label for="{{$textareaId}}" class="form-label">Instruções</label>
    <textarea name="instructions" class="form-control" id="{{$textareaId}}" rows="3" placeholder="Informe as instruções do serviço">
        {!!isset($service->instructions)?$service->instructions: ''!!}
    </textarea>
</div>

<div class="mb-3">
    <label for="required_documents" class="form-label">Documentos Necessários</label>
    <textarea name="required_documents_json" class="form-control" id="required_documents{{isset($service->id)?$service->id:''}}" rows="5" placeholder='Informe os documentos em formato JSON&#10;Exemplo: ["Documento 1", "Documento 2", "Documento 3"]'>{{isset($service) && $service->required_documents ? json_encode($service->required_documents, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : ''}}</textarea>
    <p class="text-muted mt-1 mb-0">Informe os documentos em formato JSON (array de strings)</p>
</div>

<div class="mb-3">
    <label for="dynamic_fields" class="form-label">Campos Dinâmicos</label>
    <textarea name="dynamic_fields_json" class="form-control" id="dynamic_fields{{isset($service->id)?$service->id:''}}" rows="10" placeholder='Informe os campos dinâmicos em formato JSON&#10;Exemplo: [{"tipo":"select","nome":"tipoCertidao","label":"Tipo de certidão","obrigatorio":true,"opcoes":["1ª Via","2ª Via"]}]'>{{isset($service) && $service->dynamic_fields ? json_encode($service->dynamic_fields, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : ''}}</textarea>
    <p class="text-muted mt-1 mb-0">Informe os campos dinâmicos em formato JSON (array de objetos)</p>
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
        if (document.getElementById("{{$textareaId}}")) {
            CKEDITOR.replace("{{$textareaId}}");
        }
    });
</script>
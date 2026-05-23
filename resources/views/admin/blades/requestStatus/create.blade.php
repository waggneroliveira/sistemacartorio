@extends('admin.core.admin')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard.requestStatus.index') }}">Status de Solicitações</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    {{ isset($requestStatus) ? 'Editar' : 'Novo' }} Status
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            {{ isset($requestStatus) ? 'Editar Status' : 'Novo Status' }}
                        </h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($requestStatus) ? route('admin.dashboard.requestStatus.update', $requestStatus) : route('admin.dashboard.requestStatus.store') }}" 
                                method="POST">
                                @csrf
                                @if(isset($requestStatus))
                                    @method('PUT')
                                @endif

                                <!-- Nome do Status -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nome do Status (Identificador) *</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                        value="{{ old('name', $requestStatus->name ?? '') }}" 
                                        placeholder="Ex: pending, in_progress, completed"
                                        {{ isset($requestStatus) ? 'readonly' : '' }}>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Identificador único do status (minúsculas, sem espaços)</small>
                                </div>

                                <!-- Label -->
                                <div class="mb-3">
                                    <label for="label" class="form-label">Label (Exibição) *</label>
                                    <input type="text" name="label" id="label" class="form-control @error('label') is-invalid @enderror" 
                                        value="{{ old('label', $requestStatus->label ?? '') }}" 
                                        placeholder="Ex: Pendente, Em Progresso, Concluído">
                                    @error('label')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Texto que será exibido para os usuários</small>
                                </div>

                                <!-- Descrição -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Descrição</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" 
                                        rows="3" placeholder="Descrição detalhada do status">{{ old('description', $requestStatus->description ?? '') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Cor -->
                                <div class="mb-3">
                                    <label for="color" class="form-label">Cor (Hexadecimal) *</label>
                                    <div class="input-group">
                                        <input type="color" name="color" id="color" class="form-control form-control-color @error('color') is-invalid @enderror" 
                                            value="{{ old('color', $requestStatus->color ?? '#808080') }}" 
                                            style="width: 80px;">
                                        <input type="text" class="form-control @error('color') is-invalid @enderror" 
                                            id="colorText" placeholder="#000000" 
                                            value="{{ old('color', $requestStatus->color ?? '#808080') }}"
                                            readonly>
                                    </div>
                                    @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Ordem -->
                                <div class="mb-3">
                                    <label for="order" class="form-label">Ordem de Exibição *</label>
                                    <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" 
                                        value="{{ old('order', $requestStatus->order ?? 0) }}" 
                                        min="0" placeholder="0">
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Números menores aparecem primeiro</small>
                                </div>

                                <!-- Opções Booleanas -->
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" 
                                            value="1" {{ old('is_active', $requestStatus->is_active ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Status Ativo
                                        </label>
                                        <small class="text-muted d-block">Apenas status ativos podem ser usados</small>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" name="is_default" id="is_default" class="form-check-input" 
                                            value="1" {{ old('is_default', $requestStatus->is_default ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_default">
                                            Status Padrão
                                        </label>
                                        <small class="text-muted d-block">Status inicial das novas solicitações</small>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" name="is_final" id="is_final" class="form-check-input" 
                                            value="1" {{ old('is_final', $requestStatus->is_final ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_final">
                                            Status Final
                                        </label>
                                        <small class="text-muted d-block">Marca a solicitação como finalizada</small>
                                    </div>
                                </div>

                                <!-- Botões -->
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle"></i> 
                                        {{ isset($requestStatus) ? 'Atualizar' : 'Criar' }} Status
                                    </button>
                                    <a href="{{ route('admin.dashboard.requestStatus.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left"></i> Voltar
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Preview -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">Prévia</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="text-muted small">Cor</label>
                                <div style="height: 50px; background-color: {{ old('color', $requestStatus->color ?? '#808080') }}; border-radius: 4px; border: 1px solid #ddd;"></div>
                            </div>

                            <div class="mb-3">
                                <label class="text-muted small">Badge</label>
                                <span class="badge" style="background-color: {{ old('color', $requestStatus->color ?? '#808080') }}; padding: 8px 12px; font-size: 14px;">
                                    {{ old('label', $requestStatus->label ?? 'Novo Status') }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="text-muted small">Informações</label>
                                <ul class="small text-muted">
                                    <li><strong>Nome:</strong> {{ old('name', $requestStatus->name ?? 'pending') }}</li>
                                    <li><strong>Padrão:</strong> {{ old('is_default', $requestStatus->is_default ?? false) ? 'Sim' : 'Não' }}</li>
                                    <li><strong>Final:</strong> {{ old('is_final', $requestStatus->is_final ?? false) ? 'Sim' : 'Não' }}</li>
                                    <li><strong>Ordem:</strong> {{ old('order', $requestStatus->order ?? 0) }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Atualizar o campo de texto com a cor selecionada
    document.getElementById('color').addEventListener('change', function() {
        document.getElementById('colorText').value = this.value;
        document.getElementById('colorText').style.color = this.value;
    });
</script>
@endsection

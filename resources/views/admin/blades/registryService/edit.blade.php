@extends('admin.core.admin')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Editar Serviço: {{ $service->name }}</h4>
                            
                            <form method="POST" action="{{ route('admin.dashboard.registryService.update', $service->id) }}">
                                @csrf
                                @method('PUT')
                                
                                @include('admin.blades.registryService.form', ['service' => $service])
                                
                                <div class="d-flex justify-content-end gap-2 mt-3">
                                    <a href="{{ route('admin.dashboard.registryService.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-x-circle"></i> Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save"></i> Salvar Alterações
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
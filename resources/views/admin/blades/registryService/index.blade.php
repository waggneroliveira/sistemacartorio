@extends('admin.core.admin')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h4>Serviços do Cartório</h4>
                                <a href="{{ route('admin.dashboard.registryService.create') }}" class="btn btn-primary">
                                    <i class="mdi mdi-plus"></i> Novo Serviço
                                </a>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Ícone</th>
                                            <th>Nome</th>
                                            <th>Campos</th>
                                            <th>Documentos</th>
                                            <th>Ordem</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($services as $service)
                                        <tr>
                                            <td>{{ $service->id }}</td>
                                            <td><i class="bi {{ $service->icon }} fs-5"></i></td>
                                            <td>{{ $service->name }}</td>
                                            <td>
                                                @php
                                                    $camposCount = is_array($service->dynamic_fields) ? count($service->dynamic_fields) : 0;
                                                @endphp
                                                <span class="badge bg-info">{{ $camposCount }} campos</span>
                                             </td>
                                            <td>
                                                @php
                                                    $docsCount = is_array($service->required_documents) ? count($service->required_documents) : 0;
                                                @endphp
                                                <span class="badge bg-warning">{{ $docsCount }} docs</span>
                                             </td>
                                            <td>{{ $service->display_order }}</td>
                                            <td>
                                                <span class="badge bg-{{ $service->is_active ? 'success' : 'danger' }}">
                                                    {{ $service->is_active ? 'Ativo' : 'Inativo' }}
                                                </span>
                                             </td>
                                            <td>
                                                <a href="{{ route('admin.dashboard.registryService.edit', $service->id) }}" 
                                                   class="btn btn-sm btn-primary">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.dashboard.registryService.destroy', $service->id) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                             </td>
                                         </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            {{ $services->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
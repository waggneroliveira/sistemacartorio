@extends('admin.core.admin')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{route('admin.dashboard')}}">{{__('dashboard.title_dashboard')}}</a>
                                </li>
                                <li class="breadcrumb-item active">Serviços</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Serviços do Cartório</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-3">
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
                                            <th>Valor</th>
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
                                            <td>
                                                @if($service->service_value)
                                                    <span class="badge bg-success">R$ {{ number_format($service->service_value, 2, ',', '.') }}</span>
                                                @else
                                                    <span class="badge bg-secondary">Gratuito</span>
                                                @endif
                                            </td>
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
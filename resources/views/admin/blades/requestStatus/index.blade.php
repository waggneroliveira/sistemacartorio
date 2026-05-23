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
                                <li class="breadcrumb-item active">Status de Solicitações</li>
                            </ol>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="page-title">Gerenciar Status das Solicitações</h4>
                            <a href="{{ route('admin.dashboard.requestStatus.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Novo Status
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Lista de Status</h5>
                        </div>
                        <div class="card-body">
                            <!-- Filtros -->
                            <form method="GET" action="{{ route('admin.dashboard.requestStatus.index') }}" class="mb-4">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" name="search" class="form-control" 
                                            placeholder="Buscar por nome ou label..." value="{{ request('search') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <select name="active" class="form-select">
                                            <option value="">Todos</option>
                                            <option value="1" {{ request('active') === '1' ? 'selected' : '' }}>Ativos</option>
                                            <option value="0" {{ request('active') === '0' ? 'selected' : '' }}>Inativos</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                                    </div>
                                </div>
                            </form>

                            <!-- Tabela -->
                            @if($statuses->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 50px;">Cor</th>
                                                <th>Nome</th>
                                                <th>Label</th>
                                                <th>Ordem</th>
                                                <th>Padrão</th>
                                                <th>Final</th>
                                                <th>Status</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($statuses as $status)
                                                <tr>
                                                    <td>
                                                        <span class="badge" style="background-color: {{ $status->color }}; width: 50px; height: 50px; display: inline-block;"></span>
                                                    </td>
                                                    <td>
                                                        <code>{{ $status->name }}</code>
                                                    </td>
                                                    <td>{{ $status->label }}</td>
                                                    <td>{{ $status->order }}</td>
                                                    <td>
                                                        @if($status->is_default)
                                                            <span class="badge bg-success">Padrão</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($status->is_final)
                                                            <span class="badge bg-danger">Final</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($status->is_active)
                                                            <span class="badge bg-success">Ativo</span>
                                                        @else
                                                            <span class="badge bg-secondary">Inativo</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="{{ route('admin.dashboard.requestStatus.edit', $status) }}" 
                                                                class="btn btn-outline-primary" title="Editar">
                                                                <i class="bi bi-pencil"></i>
                                                            </a>
                                                            @if(!$status->is_active)
                                                                <form action="{{ route('admin.dashboard.requestStatus.activate', $status) }}" 
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-outline-success btn-sm" title="Ativar">
                                                                        <i class="bi bi-check-circle"></i>
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <form action="{{ route('admin.dashboard.requestStatus.deactivate', $status) }}" 
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-outline-warning btn-sm" title="Desativar">
                                                                        <i class="bi bi-x-circle"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            @if(!$status->is_default && !$status->requests()->exists())
                                                                <form action="{{ route('admin.dashboard.requestStatus.destroy', $status) }}" 
                                                                    method="POST" style="display: inline;" 
                                                                    onsubmit="return confirm('Tem certeza que deseja deletar este status?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Deletar">
                                                                        <i class="bi bi-trash"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Paginação -->
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $statuses->links() }}
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle"></i> Nenhum status encontrado.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

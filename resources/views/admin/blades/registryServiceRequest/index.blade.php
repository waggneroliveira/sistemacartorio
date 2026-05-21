@extends('admin.core.admin')
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Solicitações de Serviços</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Solicitações de Serviços</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- FILTROS AVANÇADOS -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <form action="{{ route('admin.dashboard.registryServiceRequest.index') }}" method="GET" class="mb-4">
                                            <div class="row g-3 mb-3">
                                                <!-- Pesquisa por Protocolo/Nome -->
                                                <div class="col-md-3">
                                                    <label for="protocol" class="form-label">
                                                        <i class="bi bi-search"></i> Protocolo / Cliente
                                                    </label>
                                                    <input type="text" name="protocol" id="protocol" 
                                                        value="{{ request('protocol') }}" 
                                                        class="form-control" 
                                                        placeholder="Buscar protocolo ou nome...">
                                                </div>

                                                <!-- Filtro Status -->
                                                <div class="col-md-2">
                                                    <label for="status" class="form-label">
                                                        <i class="bi bi-filter"></i> Status
                                                    </label>
                                                    <select name="status" id="status" class="form-select">
                                                        <option value="">Todos</option>
                                                        @foreach($statuses as $key => $label)
                                                            <option value="{{ $key }}" 
                                                                {{ request('status') == $key ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Filtro Serviço -->
                                                <div class="col-md-2">
                                                    <label for="service_id" class="form-label">
                                                        <i class="bi bi-briefcase"></i> Serviço
                                                    </label>
                                                    <select name="service_id" id="service_id" class="form-select">
                                                        <option value="">Todos</option>
                                                        @foreach($services as $service)
                                                            <option value="{{ $service->id }}" 
                                                                {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                                                {{ $service->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Período - Data Inicial -->
                                                <div class="col-md-2">
                                                    <label for="date_from" class="form-label">
                                                        <i class="bi bi-calendar"></i> De
                                                    </label>
                                                    <input type="date" name="date_from" id="date_from" 
                                                        value="{{ request('date_from') }}" 
                                                        class="form-control">
                                                </div>

                                                <!-- Período - Data Final -->
                                                <div class="col-md-2">
                                                    <label for="date_to" class="form-label">
                                                        <i class="bi bi-calendar"></i> Até
                                                    </label>
                                                    <input type="date" name="date_to" id="date_to" 
                                                        value="{{ request('date_to') }}" 
                                                        class="form-control">
                                                </div>

                                                <!-- Busca por Cliente -->
                                                <div class="col-md-3">
                                                    <label for="client_search" class="form-label">
                                                        <i class="bi bi-person"></i> Cliente
                                                    </label>
                                                    <input type="text" name="client_search" id="client_search" 
                                                        value="{{ request('client_search') }}" 
                                                        class="form-control" 
                                                        placeholder="Nome, email ou telefone">
                                                </div>

                                                <!-- Botões de Ação -->
                                                <div class="col-md-12">
                                                    <div class="d-flex gap-2 pt-2">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="bi bi-search"></i> Filtrar
                                                        </button>

                                                        @if (request()->has('protocol') || request()->has('status') || 
                                                             request()->has('service_id') || request()->has('date_from') || 
                                                             request()->has('date_to') || request()->has('client_search'))
                                                            <a href="{{ route('admin.dashboard.registryServiceRequest.index') }}" 
                                                                class="btn btn-outline-secondary">
                                                                <i class="bi bi-x-circle"></i> Limpar Filtros
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- TABELA DE SOLICITAÇÕES -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 50px;">
                                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                                </th>
                                                <th>
                                                    <a href="?sort_by=id&sort_order={{ request('sort_order') == 'asc' ? 'desc' : 'asc' }}">
                                                        Protocolo
                                                        @if(request('sort_by') == 'id')
                                                            <i class="bi bi-arrow-{{ request('sort_order') == 'asc' ? 'up' : 'down' }}"></i>
                                                        @endif
                                                    </a>
                                                </th>
                                                <th>Cliente</th>
                                                <th>Serviço</th>
                                                <th>
                                                    <a href="?sort_by=status&sort_order={{ request('sort_order') == 'asc' ? 'desc' : 'asc' }}">
                                                        Status
                                                        @if(request('sort_by') == 'status')
                                                            <i class="bi bi-arrow-{{ request('sort_order') == 'asc' ? 'up' : 'down' }}"></i>
                                                        @endif
                                                    </a>
                                                </th>
                                                <th>
                                                    <a href="?sort_by=created_at&sort_order={{ request('sort_order') == 'asc' ? 'desc' : 'asc' }}">
                                                        Data
                                                        @if(request('sort_by') == 'created_at')
                                                            <i class="bi bi-arrow-{{ request('sort_order') == 'asc' ? 'up' : 'down' }}"></i>
                                                        @endif
                                                    </a>
                                                </th>
                                                <th style="width: 100px;">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($requests as $request)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input request-checkbox" 
                                                            value="{{ $request->id }}">
                                                    </td>
                                                    <td>
                                                        <strong>#{{ $request->id }}</strong>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <strong>{{ $request->full_name }}</strong>
                                                            <br>
                                                            <small class="text-muted">
                                                                <i class="bi bi-envelope"></i> {{ $request->email }}
                                                            </small>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $request->service?->name ?? 'N/A' }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $statusColors = [
                                                                'pending' => 'warning',
                                                                'in_progress' => 'info',
                                                                'awaiting_documents' => 'secondary',
                                                                'documents_approved' => 'success',
                                                                'completed' => 'success',
                                                                'rejected' => 'danger',
                                                            ];
                                                            $color = $statusColors[$request->status] ?? 'secondary';
                                                        @endphp
                                                        <span class="badge bg-{{ $color }}">
                                                            {{ $statuses[$request->status] ?? $request->status }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        {{ $request->created_at->format('d/m/Y H:i') }}
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('admin.dashboard.registryServiceRequest.show', $request->id) }}" 
                                                                class="btn btn-sm btn-outline-primary" 
                                                                title="Visualizar">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                            <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                onclick="deleteRequest({{ $request->id }})">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-muted py-4">
                                                        <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                                                        <br>
                                                        Nenhuma solicitação encontrada.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <!-- PAGINAÇÃO -->
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <p class="text-muted">
                                            Mostrando {{ $requests->firstItem() ?? 0 }} a {{ $requests->lastItem() ?? 0 }} 
                                            de {{ $requests->total() }} solicitações
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $requests->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Selecionar todos
        document.getElementById('selectAll').addEventListener('change', function() {
            const isChecked = this.checked;
            document.querySelectorAll('.request-checkbox').forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        // Deletar solicitação
        function deleteRequest(id) {
            if (confirm('Tem certeza que deseja deletar esta solicitação?')) {
                // Implementar delete via AJAX
                console.log('Deletar solicitação:', id);
            }
        }
    </script>
    @endpush
@endsection

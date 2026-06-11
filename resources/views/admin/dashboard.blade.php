@extends('admin.core.admin')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">{{__('dashboard.title_dashboard')}}</li>
                        <li class="breadcrumb-item">Home</li>
                    </ol>
                </div>
                <h4 class="page-title">{{__('dashboard.title_dashboard')}}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        @include('admin.components.dashboard-card-info', [
            'route' => route('admin.dashboard.slide.index'),
            'icon' => 'mdi mdi-file-multiple-outline',
            'count' => $stats['total'],
            'title' => 'Total de pedidos'
        ])

        @include('admin.components.dashboard-card-info', [
            'route' => route('admin.dashboard.registryServiceRequest.index'),
            'icon' => 'mdi mdi-timer-sand',
            'count' => $stats['emAndamento'],
            'title' => 'Em andamento'
        ])

        @include('admin.components.dashboard-card-info', [
            'route' => route('admin.dashboard.registryServiceRequest.index'),
            'icon' => 'mdi mdi-check-circle-outline',
            'count' => $stats['concluidos'],
            'title' => 'Concluído'
        ])

        @include('admin.components.dashboard-card-info', [
            'route' => route('admin.dashboard.registryServiceRequest.index'),
            'icon' => 'mdi mdi-credit-card-outline',
            'count' => $stats['aguardandoPagamento'],
            'title' => 'Aguardando pagamento'
        ])
    </div>

    <div class="row">
        <div class="col-lg-9">
            <!-- Portlet card -->
            <div class="card">
                <div class="card-body px-2">
                    <div class="card-widgets mt-2 me-1">
                        {{-- <a href="javascript: void(0);" data-bs-toggle="reload"><i class="mdi mdi-refresh"></i></a> --}}
                        <a data-bs-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false" aria-controls="cardCollpase4"><i class="mdi mdi-minus"></i></a>
                        {{-- <a href="javascript: void(0);" data-bs-toggle="remove"><i class="mdi mdi-close"></i></a> --}}
                    </div>

                    <div class="border-start border-4 border-primary bg-light px-3 py-2 mb-3">
                        <h4 class="header-title mb-0">
                            <i class="mdi mdi-file-document-multiple-outline text-primary me-1"></i>
                            Últimas Solicitações
                        </h4>
                    </div>

                    <div id="cardCollpase4" class="collapse show">
                        <div class="table-responsive pt-3">
                            <table class="table table-centered table-nowrap table-borderless mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Protocolo</th>
                                        <th>Serviço</th>
                                        <th>Data da solicitação</th>
                                        <th>Status</th>
                                        <th>Clients</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lastRequestServices as $lastRequestService)                                        
                                        <tr>
                                            <td style="font-size: 0.75rem;">{{ $lastRequestService->protocol_number }}</td>
                                            <td>{{ $lastRequestService->service->name }}</td>
                                            <td>{{ $lastRequestService->created_at->format('d/m/Y H:i') }}</td>
                                            @php
                                                $statusConfig = [
                                                    'pending' => ['class' => 'bg-soft-warning text-warning', 'text' => 'Pendente'],
                                                    'in_progress' => ['class' => 'bg-soft-primary text-primary', 'text' => 'Em andamento'],
                                                    'awaiting_documents' => ['class' => 'bg-soft-secondary text-secondary', 'text' => 'Aguardando documentos'],
                                                    'documents_approved' => ['class' => 'bg-soft-success text-success', 'text' => 'Documentos aprovados'],
                                                    'awaiting_payment' => ['class' => 'bg-soft-info text-info', 'text' => 'Aguardando pagamento'],
                                                    'payment_approved' => ['class' => 'bg-soft-success text-success', 'text' => 'Pagamento aprovado'],
                                                    'completed' => ['class' => 'bg-soft-success text-success', 'text' => 'Concluído'],
                                                    'rejected' => ['class' => 'bg-soft-danger text-danger', 'text' => 'Rejeitado'],
                                                ];

                                                $config = $statusConfig[$lastRequestService->status] ?? [
                                                    'class' => 'bg-soft-dark text-dark',
                                                    'text' => $lastRequestService->status
                                                ];
                                            @endphp

                                            <td>
                                                <span class="badge {{ $config['class'] }} p-1">
                                                    {{ $config['text'] }}
                                                </span>
                                            </td>                                            
                                            <td>{{ $lastRequestService->client->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- .table-responsive -->
                    </div> <!-- end collapse-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-lg-3">
            <div class="card">
                <div class="card-body px-2">
                    <div class="alert alert-warning d-flex align-items-center mb-3 px-2">
                        <i class="mdi mdi-alert-outline fs-3 me-2"></i>

                        <div>
                            <h4 class="mb-0 fw-bold">Alertas do Sistema</h4>
                            <small>Solicitações que exigem atenção imediata.</small>
                        </div>
                    </div>

                    <div class="list-group list-group-flush">

                        @if (isset($todayRequestServices) && $todayRequestServices != null)                            
                            <a href="#"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                            data-bs-toggle="tooltip"
                            title="Solicitações recebidas recentemente que ainda não foram analisadas pela equipe.">
                                <div>
                                    <i class="mdi mdi-bell-outline text-primary me-2"></i>
                                    Novas Solicitações
                                </div>
                                <span class="badge bg-primary rounded-pill">{{ $todayRequestServices }}</span>
                            </a>
                        @endif

                        @if (isset($stats) && $stats['aguardandoPagamento'] != null)  
                            <a href="#"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                            data-bs-toggle="tooltip"
                            title="Solicitações aguardando confirmação ou compensação do pagamento.">
                                <div>
                                    <i class="mdi mdi-cash text-warning me-2"></i>
                                    Pagamentos Pendentes
                                </div>
                                <span class="badge bg-warning text-dark rounded-pill">{{ $stats['aguardandoPagamento'] }}</span>
                            </a>
                        @endif

                        @if (isset($stats) && $stats['aguardandoDocumento'] != null)
                            <a href="#"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                            data-bs-toggle="tooltip"
                            title="Processos que aguardam envio de documentos, correções de informações ou retorno do cliente para continuidade da solicitação.">
                                <div>
                                    <i class="mdi mdi-file-alert-outline text-info me-2"></i>
                                    Pendências do Cliente
                                </div>
                                <span class="badge bg-info rounded-pill">
                                    {{ $stats['aguardandoDocumento'] }}
                                </span>
                            </a>
                        @endif

                        {{-- @if (isset($stats) && $stats != null) 
                            <a href="#"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                            data-bs-toggle="tooltip"
                            title="Solicitações atualmente em conferência, análise ou validação interna.">
                                <div>
                                    <i class="mdi mdi-magnify text-secondary me-2"></i>
                                    Em Análise
                                </div>
                                <span class="badge bg-secondary rounded-pill">8</span>
                            </a>
                        @endif

                        <a href="#"
                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                        data-bs-toggle="tooltip"
                        title="Solicitações próximas da data prevista de entrega ou conclusão.">
                            <div>
                                <i class="mdi mdi-clock-alert-outline text-danger me-2"></i>
                                Prazos Próximos
                            </div>
                            <span class="badge bg-danger rounded-pill">2</span>
                        </a> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3 text-center"> Solicitações por Serviço </h4>
                    <div class="d-flex flex-column">
                        <div id="chart" style="height: 300px;" data-colors="#dcdcdc,#4a81d4,#1abc9c" dir="ltr"></div>
                        <div class="custom-legend" id="customLegend"></div>
                    </div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
               
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3 text-center">Solicitações por mês</h4>
                    <div id="chart-stacked" style="height: 300px;" data-colors="#1abc9c,#4a81d4" dir="ltr"></div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- End row -->  

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div><a href="https://www.whi.dev.br/" target="_blank" style="color:#94a0ad;"><script>document.write(new Date().getFullYear())</script> © WHI - Web de Alta Inspiração</a></div>
                </div>
                <div class="col-md-6">
                    <div class="d-none d-md-flex gap-4 align-item-center justify-content-md-end footer-links">
                        <a href="https://www.whi.dev.br/" target="_blank" rel="noopener noreferrer">Sobre a WHI</a>
                        <a href="https://wa.me/5571992768360" target="_blank" rel="noopener noreferrer">Fale conosco</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    @include('admin.loadPage.loading')
    <!-- end Footer -->
@endsection
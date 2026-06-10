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
            'route' => route('admin.dashboard.slide.index'),
            'icon' => 'mdi mdi-timer-sand',
            'count' => $stats['emAndamento'],
            'title' => 'Em andamento'
        ])

        @include('admin.components.dashboard-card-info', [
            'route' => route('admin.dashboard.slide.index'),
            'icon' => 'mdi mdi-check-circle-outline',
            'count' => $stats['concluidos'],
            'title' => 'Concluído'
        ])

        @include('admin.components.dashboard-card-info', [
            'route' => route('admin.dashboard.slide.index'),
            'icon' => 'mdi mdi-credit-card-outline',
            'count' => $stats['aguardandoPagamento'],
            'title' => 'Aguardando pagamento'
        ])
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Portlet card -->
            <div class="card">
                <div class="card-body">
                    <div class="card-widgets">
                        <a href="javascript: void(0);" data-bs-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                        <a data-bs-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false" aria-controls="cardCollpase4"><i class="mdi mdi-minus"></i></a>
                        <a href="javascript: void(0);" data-bs-toggle="remove"><i class="mdi mdi-close"></i></a>
                    </div>
                    <h4 class="header-title mb-0">Últimas solicitações</h4>

                    <div id="cardCollpase4" class="collapse show">
                        <div class="table-responsive pt-3">
                            <table class="table table-centered table-nowrap table-borderless mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Protocolo</th>
                                        <th>Serviço</th>
                                        <th>Data da solicitação</th>
                                        <th>Data da conclusão</th>
                                        <th>Status</th>
                                        <th>Clients</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lastRequestServices as $lastRequestService)                                        
                                        <tr>
                                            <td>{{ $lastRequestService->protocol_number }}</td>
                                            <td>{{ $lastRequestService->service->name }}</td>
                                            <td>{{ $lastRequestService->created_at->format('d/m/Y H:i') }}</td>
                                            <td>Oct 12, 2018</td>
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
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3 text-center"> Solicitações por Serviço </h4>
                    <div class="d-flex flex-row-reverse">
                        <div id="chart" style="height: 300px;" data-colors="#dcdcdc,#4a81d4,#1abc9c" dir="ltr"></div>
                        <div class="custom-legend" id="customLegend"></div>
                    </div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
               
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Stacked Area Chart</h4>
                    <div id="chart-stacked" style="height: 300px;" data-colors="#1abc9c,#4a81d4" dir="ltr"></div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- End row -->
{{-- {{dd($chartData);}} --}}
  

    {{-- CONTATO --}}
    @if (Auth::user()->hasRole('Super') || 
    Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
    Auth::user()->hasPermissionTo('contato.visualizar') || 
    Auth::user()->hasPermissionTo('lead contato.visualizar'))
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">
                        <i class="mdi mdi-card-account-mail-outline"></i> Contato
                    </h4>
                </div>
            </div>

            {{-- Contato --}}
            @if (Auth::user()->hasRole('Super') || 
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasPermissionTo('contato.visualizar'))
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.contact.index'),
                    'icon' => 'mdi-card-account-mail-outline',
                    'title' => 'Contato'
                ])
            @endif

            {{-- Lead Contato --}}
            @if (Auth::user()->hasRole('Super') || 
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasPermissionTo('lead contato.visualizar'))
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.formIndex.index'),
                    'icon' => 'mdi-account-box-outline',
                    'title' => 'Lead Contato'
                ])
            @endif
            @include('admin.components.dashboard-card', [
                'route' => route('admin.dashboard.leadDownload.index'),
                'icon' => 'mdi-account-box-outline',
                'title' => 'Lead Download'
            ])

        </div>
    @endif

    {{-- SMTP --}}
    @if (Auth::user()->hasRole('Super') || 
    Auth::user()->can('usuario.tornar usuario master') || 
    Auth::user()->can('email.visualizar'))
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">
                        <i class="mdi mdi-email-edit"></i> {{__('dashboard.setting_smtp')}}
                    </h4>
                </div>
            </div>

            @include('admin.components.dashboard-card', [
                'route' => route('admin.dashboard.settingEmail.index'),
                'icon' => 'mdi-email',
                'title' => __('dashboard.setting_email')
            ])

        </div>
    @endif

    {{-- SEGURANÇA --}}
    @if (Auth::user()->hasRole('Super') || 
    Auth::user()->can('usuario.tornar usuario master') || 
    Auth::user()->can('auditoria.visualizar') || 
    Auth::user()->can('usuario.visualizar') || 
    Auth::user()->can('grupo.visualizar'))

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">
                        <i class="mdi mdi-security"></i> {{__('dashboard.security_and_access_control')}}
                    </h4>
                </div>
            </div>
        </div>
    @endif
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
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
            'count' => 2,
            'title' => 'Total de pedidos'
        ])

        @include('admin.components.dashboard-card-info', [
            'route' => route('admin.dashboard.slide.index'),
            'icon' => 'mdi mdi-timer-sand',
            'count' => 1,
            'title' => 'Em andamento'
        ])
        
        @include('admin.components.dashboard-card-info', [
            'route' => route('admin.dashboard.slide.index'),
            'icon' => 'mdi mdi-check-circle-outline',
            'count' => 1,
            'title' => 'Concluído'
        ])

        @include('admin.components.dashboard-card-info', [
            'route' => route('admin.dashboard.slide.index'),
            'icon' => 'mdi mdi-credit-card-outline',
            'count' => 1,
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
                                        <th>Imagem</th>
                                        <th>Status</th>
                                        <th>Clients</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>ESC-26-06-00001</td>
                                        <td>App design and development</td>
                                        <td>Jan 03, 2015</td>
                                        <td>Oct 12, 2018</td>
                                        <td id="tooltip-container">
                                            <div class="avatar-group">
                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="top" title="Mat Helme">
                                                    <img src="{{asset('build/admin/images/users/user-3.jpg')}}" class="rounded-circle avatar-xs" alt="friend">
                                                </a>

                                            </div>
                                        </td>
                                        <td><span class="badge bg-soft-info text-info p-1">Work in Progress</span></td>
                                        <td>Halette Boivin</td>
                                    </tr>
                                    <tr>
                                        <td>ESC-26-06-00001</td>
                                        <td>Coffee detail page - Main Page</td>
                                        <td>Sep 21, 2016</td>
                                        <td>May 05, 2018</td>
                                        <td>
                                            <div class="avatar-group">
                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top" title="James Anderson">
                                                    <img src="{{asset('build/admin/images/users/user-3.jpg')}}" class="rounded-circle avatar-xs" alt="friend">
                                                </a>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-soft-warning text-warning p-1">Pending</span></td>
                                        <td>Durandana Jolicoeur</td>
                                    </tr>
                                    <tr>
                                        <td>ESC-26-06-00001</td>
                                        <th>Poster illustation design</th>
                                        <td>Mar 08, 2018</td>
                                        <td>Sep 22, 2018</td>
                                        <td>
                                            <div class="avatar-group">
                                                
                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Michael Zenaty">
                                                    <img src="{{asset('build/admin/images/users/user-3.jpg')}}" class="rounded-circle avatar-xs" alt="friend">
                                                </a>

                                            </div>
                                        </td>
                                        <td><span class="badge bg-soft-success text-success p-1">Completed</span></td>
                                        <td>Lucas Sabourin</td>
                                    </tr>
                                    <tr>
                                        <td>ESC-26-06-00001</td>
                                        <td>Drinking bottle graphics</td>
                                        <td>Oct 10, 2017</td>
                                        <td>May 07, 2018</td>
                                        <td>
                                            <div class="avatar-group">
                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Mat Helme">
                                                    <img src="{{asset('build/admin/images/users/user-3.jpg')}}" class="rounded-circle avatar-xs" alt="friend">
                                                </a>
        
                                            </div>
                                        </td>
                                        <td><span class="badge bg-soft-info text-info p-1">Work in Progress</span></td>
                                        <td>Donatien Brunelle</td>
                                    </tr>
                                    <tr>
                                        <td>ESC-26-06-00001</td>
                                        <td>Landing page design - Home</td>
                                        <td>Coming Soon</td>
                                        <td>May 25, 2021</td>
                                        <td>
                                            <div class="avatar-group">
        
                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Michael Zenaty">
                                                    <img src="{{asset('build/admin/images/users/user-3.jpg')}}" class="rounded-circle avatar-xs" alt="friend">
                                                </a>
        
                                            </div>
                                        </td>
                                        <td><span class="badge bg-soft-dark text-dark p-1">Coming Soon</span></td>
                                        <td>Karel Auberjo</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div> <!-- .table-responsive -->
                    </div> <!-- end collapse-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row -->

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

            {{-- Auditoria --}}
            @if (Auth::user()->hasRole('Super') || 
            Auth::user()->can('usuario.tornar usuario master') || 
            Auth::user()->can('auditoria.visualizar'))
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.audit.index'),
                    'icon' => 'mdi-clipboard-text',
                    'title' => __('dashboard.audit')
                ])
            @endif

            {{-- Grupos --}}
            @if (Auth::user()->hasRole('Super') || 
            Auth::user()->can('usuario.tornar usuario master') || 
            Auth::user()->can('grupo.visualizar'))
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.group.index'),
                    'icon' => 'mdi-account-group',
                    'title' => __('dashboard.group_and_permission')
                ])
            @endif

            {{-- Usuários --}}
            @if (Auth::user()->hasRole('Super') || 
            Auth::user()->can('usuario.tornar usuario master') || 
            Auth::user()->can('usuario.visualizar'))
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.user.index'),
                    'icon' => 'mdi-account-multiple',
                    'title' => __('dashboard.users')
                ])
            @endif

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
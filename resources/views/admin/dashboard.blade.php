@extends('admin.core.admin')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">{{__('dashboard.title_dashboard')}}</li>
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

    @if (Auth::user()->hasRole('Super') || 
    Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
    Auth::user()->hasPermissionTo('slide.visualizar') || 
    Auth::user()->hasPermissionTo('topico.visualizar') || 
    Auth::user()->hasPermissionTo('passo a passo.visualizar') || 
    Auth::user()->hasPermissionTo('sesssao lets go.visualizar') ||  
    Auth::user()->hasPermissionTo('sesssao faq.visualizar') ||  
    Auth::user()->hasPermissionTo('perguntas e respostas.visualizar') ||  
    Auth::user()->hasPermissionTo('depoimento.visualizar'))
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">
                        <i class="mdi mdi-home"></i> Serviços
                    </h4>
                </div>
            </div>

            @include('admin.components.dashboard-card', [
                'route' => route('admin.dashboard.registryService.index'),
                'icon' => 'mdi-format-list-bulleted',
                'title' => 'Serviços'
            ])

            @include('admin.components.dashboard-card', [
                'route' => route('admin.dashboard.registryServiceRequest.index'),
                'icon' => 'mdi-file-document-multiple',
                'title' => 'Solicitações'
            ])
        </div>
    @endif

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
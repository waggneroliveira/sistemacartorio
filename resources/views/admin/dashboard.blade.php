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
                        <i class="mdi mdi-home"></i> Home
                    </h4>
                </div>
            </div>
            {{-- Slide --}}
            @if (Auth::user()->hasRole('Super') || 
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasPermissionTo('slide.visualizar'))
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.slide.index'),
                    'icon' => 'mdi-image-size-select-actual',
                    'title' => 'Slides'
                ])
            @endif

            @include('admin.components.dashboard-card', [
                'route' => route('admin.dashboard.registryService.index'),
                'icon' => 'mdi-format-list-bulleted',
                'title' => 'Serviços'
            ])

            @include('admin.components.dashboard-card', [
                'route' => route('admin.dashboard.registryService.index'),
                'icon' => 'mdi-format-list-bulleted',
                'title' => 'Solicitações'
            ])
            {{-- Tópicos --}}
            @if (Auth::user()->hasRole('Super') || 
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasPermissionTo('topico.visualizar'))
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.topic.index'),
                    'icon' => 'mdi-format-list-bulleted',
                    'title' => 'Tópicos'
                ])
            @endif

            @if (Auth::user()->hasRole('Super') || 
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasPermissionTo('passo a passo.visualizar'))
                {{-- Passo a passo --}}
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.statute.index'),
                    'icon' => 'mdi-file-document',
                    'title' => 'Passo a passo'
                ])
            @endif

            @if (Auth::user()->hasRole('Super') || 
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasPermissionTo('sesssao lets go.visualizar'))
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.letsgo.index'),
                    'icon' => 'mdi-alert-circle',
                    'title' => 'Sessão Lets Go'
                ])
            @endif

            @if (Auth::user()->hasRole('Super') || 
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasPermissionTo('sesssao faq.visualizar'))
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.sessaoFaq.index'),
                    'icon' => 'mdi-alert-circle',
                    'title' => 'Sessão Faq'
                ])
            @endif

            @if (Auth::user()->hasRole('Super') || 
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasPermissionTo('perguntas e respostas.visualizar'))
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.faq.index'),
                    'icon' => 'mdi-alert-circle',
                    'title' => 'Perguntas/Respostas'
                ])
            @endif

            @if (Auth::user()->hasRole('Super') || 
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasPermissionTo('depoimento.visualizar'))
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.depoiment.index'),
                    'icon' => 'mdi-alert-circle',
                    'title' => 'Depoimentos'
                ])
            @endif

        </div>
    @endif

    @if (Auth::user()->hasRole('Super') || 
    Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
    Auth::user()->hasPermissionTo('sobre nos.visualizar') || 
    Auth::user()->hasPermissionTo('parametro.visualizar') || 
    Auth::user()->hasPermissionTo('missao visao e valores.visualizar') || 
    Auth::user()->hasPermissionTo('video.visualizar') ||  
    Auth::user()->hasPermissionTo('onde atendemos.visualizar'))
        {{-- SOBRE --}}
        <div class="row">

            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title"><i class="mdi mdi-help-circle"></i> Sobre Nós</h4>
                </div>
            </div>

            @if (Auth::user()->hasPermissionTo('sobre nos.visualizar') ||
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasRole('Super'))
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.about.index'),
                    'icon' => 'mdi-help-circle',
                    'title' => 'Sobre Nós'
                ])
            @endif
            @if (Auth::user()->hasPermissionTo('parametro.visualizar') ||
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasRole('Super'))
                {{-- Parametros --}}
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.benefitTopic.index'),
                    'icon' => 'mdi-star',
                    'title' => 'Parametros'
                ])
            @endif
            @if (Auth::user()->hasPermissionTo('missao visao e valores.visualizar') ||
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasRole('Super'))
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.report.index'),
                    'icon' => 'mdi-alert-circle',
                    'title' => 'Missão Visão e Valores'
                ])
            @endif
            @if (Auth::user()->hasPermissionTo('representantes.visualizar') ||
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasRole('Super'))
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.direction.index'),
                    'icon' => 'mdi-account-group',
                    'title' => 'Representantes'
                ])
            @endif
            @if (Auth::user()->hasPermissionTo('video.visualizar') ||
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasRole('Super'))
                {{-- VIDEOS --}}
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.video.index'),
                    'icon' => 'mdi-play-circle',
                    'title' => 'Vídeos'
                ])
            @endif
            @if (Auth::user()->hasPermissionTo('onde atendemos.visualizar') ||
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasRole('Super'))
            @include('admin.components.dashboard-card', [
                'route' => route('admin.dashboard.serviceLocation.index'),
                'icon' => 'mdi-alert-circle',
                'title' => 'Sessão Onde atendemos'
            ])
            @endif
        </div>

    @endif

    @if (Auth::user()->hasRole('Super') || 
    Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
    Auth::user()->hasPermissionTo('marcas.visualizar') || 
    Auth::user()->hasPermissionTo('categorias de produtos.visualizar') || 
    Auth::user()->hasPermissionTo('produtos.visualizar') || 
    Auth::user()->hasPermissionTo('video.visualizar'))
        <div class="row">

            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title"><i class="mdi mdi-toolbox"></i> Produtos</h4>
                </div>
            </div>
            @if (Auth::user()->hasPermissionTo('marcas.visualizar') ||
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasRole('Super'))
                {{-- Marcas --}}
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.brand.index'),
                    'icon' => 'mdi-tag-multiple',
                    'title' => 'Marcas'
                ])
            @endif
            @if (Auth::user()->hasPermissionTo('categorias de produtos.visualizar') ||
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasRole('Super'))
                {{-- Categorias --}}
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.productCategory.index'),
                    'icon' => 'mdi-tag-multiple',
                    'title' => 'Categorias dos produtos'
                ])
            @endif
            @if (Auth::user()->hasPermissionTo('produtos.visualizar') ||
                Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
                Auth::user()->hasRole('Super'))
                {{-- Produtos --}}
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.product.index'),
                    'icon' => 'mdi-tag-multiple',
                    'title' => 'Produtos'
                ])
            @endif
        </div>
    @endif

    @if (Auth::user()->hasRole('Super') || 
    Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
    Auth::user()->hasPermissionTo('categorias de noticias.visualizar') || 
    Auth::user()->hasPermissionTo('noticias.visualizar'))
        {{-- NOTICIAS --}}
        <div class="row">

            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title"><i class="mdi mdi-newspaper-variant"></i> Notícias</h4>
                </div>
            </div>

            @if (Auth::user()->hasPermissionTo('categorias de noticias.visualizar') ||
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasRole('Super'))
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.blogCategory.index'),
                    'icon' => 'mdi-tag-multiple',
                    'title' => 'Categorias das Notícias'
                ])
            @endif
            @if (Auth::user()->hasPermissionTo('noticias.visualizar') ||
            Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
            Auth::user()->hasRole('Super'))
                @include('admin.components.dashboard-card', [
                    'route' => route('admin.dashboard.blog.index'),
                    'icon' => 'mdi-newspaper-variant',
                    'title' => 'Notícias'
                ])
            @endif

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
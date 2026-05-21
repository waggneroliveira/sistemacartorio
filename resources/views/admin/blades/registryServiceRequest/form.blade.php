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
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard.registryServiceRequest.index') }}">Solicitações</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ $request->id ?? 'Nova' }}</li>
                                </ol>
                            </div>
                            <h4 class="page-title">{{ isset($request) ? 'Editar Solicitação' : 'Nova Solicitação' }}</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <p class="text-muted">Esta página é informativa. Para gerenciar solicitações, acesse a listagem ou a visualização detalhada.</p>
                                
                                <div class="mt-4">
                                    <a href="{{ route('admin.dashboard.registryServiceRequest.index') }}" class="btn btn-primary">
                                        <i class="bi bi-arrow-left"></i> Voltar para Listagem
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

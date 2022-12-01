@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">@lang('models/dashboards.header.index')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1">
                        <i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Users</span>
                        <span class="info-box-number">
                            {{$dashboardInfo['user_count']}}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1">
                        <i class="fas fa-user-shield"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Roles</span>
                        <span class="info-box-number">
                            {{$dashboardInfo['user_count']}}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1">
                        <i class="fas fa-shield-alt"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Perrmisons</span>
                        <span class="info-box-number">
                            {{$dashboardInfo['permission_count']}}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1">
                        <i class="fas fa-signal"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Online</span>
                        <span class="info-box-number" id="user_online">{{$dashboardInfo['user_online']}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">

            <!-- inicio -->
            <div class="col-md-6">
                <div class="card  card-primary  card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-producao-tab" data-toggle="pill" href="#custom-tabs-one-producao" role="tab" aria-controls="custom-tabs-one-producao" aria-selected="true">Produção</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-operador-tab" data-toggle="pill" href="#custom-tabs-one-operador" role="tab" aria-controls="custom-tabs-one-operador" aria-selected="false">Operador</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-produtos-tab" data-toggle="pill" href="#custom-tabs-one-produtos" role="tab" aria-controls="custom-tabs-one-produtos" aria-selected="false">Produtos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-turno-tab" data-toggle="pill" href="#custom-tabs-one-turno" role="tab" aria-controls="custom-tabs-one-turno" aria-selected="false">Turno</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade active show" id="custom-tabs-one-producao" role="tabpanel" aria-labelledby="custom-tabs-one-producao-tab">
                                @include('dashboard.producao')
                            </div>
                            <!-- ./card-body -->
                            <div class="tab-pane fade" id="custom-tabs-one-operador" role="tabpanel" aria-labelledby="custom-tabs-one-operador-tab">
                                @include('dashboard.operador')
                            </div>

                            <div class="tab-pane fade" id="custom-tabs-one-produtos" role="tabpanel" aria-labelledby="custom-tabs-one-turno-tab">
                                @include('dashboard.produto')
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-turno" role="tabpanel" aria-labelledby="custom-tabs-one-turno-tab">
                                @include('dashboard.turno')
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
            <!-- fim -->


            <!-- inicio -->
            <div class="col-md-6">
                <div class="card  card-success  card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Montagem</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Montadores</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Retornar Em</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Montagem Dia / 30</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                @include('dashboard.montagem')
                                <!-- ./card-body -->
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                @include('dashboard.montadores')
                                <!--
                                <span class="info-box-text">Peças por Montadores / 30 dias</span>
                                <div class="card-body">
                                    <canvas id="TotalPecasMontadoresChart" height="315" style="height: 180px; display: block; width: 462px;" width="808" class="chartjs-render-monitor"></canvas>
                                </div>
                                 ./card-body -->
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                @include('dashboard.pecasretorno')
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                                @include('dashboard.montagemdia')
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
            <!-- fim -->

            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h5 class="card-title">Total Produção 30 Dias </h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <!--
                           <div class="btn-group">
                               <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                   <i class="fas fa-wrench"></i>
                               </button>
                               <div class="dropdown-menu dropdown-menu-right" role="menu">
                                   <a href="#" class="dropdown-item">Ação</a>
                                   <a href="#" class="dropdown-item">Outra Ação</a>
                                   <a href="#" class="dropdown-item">Outras</a>
                                   <a class="dropdown-divider"></a>
                                   <a href="#" class="dropdown-item">Link separado</a>
                               </div>
                           </div>
                           -->
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    @include('dashboard.totalproducao')
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                    <div class="card-footer">
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="card card-danger">
                    <div class="card-header">
                        <h5 class="card-title">Total Produção Últimas 4 Semanas</h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <!--
                           <div class="btn-group">
                               <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                   <i class="fas fa-wrench"></i>
                               </button>
                               <div class="dropdown-menu dropdown-menu-right" role="menu">
                                   <a href="#" class="dropdown-item">Ação</a>
                                   <a href="#" class="dropdown-item">Outra Ação</a>
                                   <a href="#" class="dropdown-item">Outras</a>
                                   <a class="dropdown-divider"></a>
                                   <a href="#" class="dropdown-item">Link separado</a>
                               </div>
                           </div>
                           -->
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @include('dashboard.producaosemana')
                    </div>
                    <!-- ./card-body -->
                    <div class="card-footer">
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!--/. container-fluid -->
</section>

<!-- /.content -->
@endsection

@push('third_party_scripts')
<!-- ChartJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js" integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@push('page_scripts')

<script>

    @foreach($totalProducao as $key=>$value)
        var totalProducaoChart{{str_replace('/','',$key)}} = new Chart(document.getElementById('totalProducaoChart{{str_replace('/','',$key)}}').getContext('2d'), @json($value));
    @endforeach

    @foreach($producaoMaquina as $key=>$value)
      var producaoMaquinaChart{{str_replace('/','',$key)}} = new Chart(document.getElementById('producaoMaquinaChart{{str_replace('/','',$key)}}').getContext('2d'), @json($value));
    @endforeach

    @foreach($producaoOperador as $key=>$value)
        var producaoOperadorChart{{str_replace('/','',$key)}} = new Chart(document.getElementById('producaoOperadorChart{{str_replace('/','',$key)}}').getContext('2d'), @json($value));
    @endforeach

    @foreach($producaoProdutos as $key=>$value)
        var producaoProdutosChart{{str_replace('/','',$key)}} = new Chart(document.getElementById('producaoProdutosChart{{str_replace('/','',$key)}}').getContext('2d'), @json($value));
    @endforeach

    @foreach($producaoTurno as $key=>$value)
        var producaoTurnoChart{{str_replace('/','',$key)}} = new Chart(document.getElementById('producaoTurnoChart{{str_replace('/','',$key)}}').getContext('2d'), @json($value));
    @endforeach

    @foreach($TotalMontadores as $key=>$value)
       var TotalMontadoresChart{{str_replace('/','',$key)}} = new Chart(document.getElementById('TotalMontadoresChart{{str_replace('/','',$key)}}').getContext('2d'), @json($value));
    @endforeach

    @foreach($TotalMontagem as $key=>$value)
        var TotalMontagemChart{{str_replace('/','',$key)}} = new Chart(document.getElementById('TotalMontagemChart{{str_replace('/','',$key)}}').getContext('2d'), @json($value));
    @endforeach

    @foreach($TotalPecasRetorno as $key=>$value)
        var TotalPecasRetornoChart{{str_replace('/','',$key)}} = new Chart(document.getElementById('TotalPecasRetornoChart{{str_replace('/','',$key)}}').getContext('2d'), @json($value));
    @endforeach

    @foreach($TotalPecasMontagemDia as $key=>$value)
        var TotalPecasMontagemDiaChart{{str_replace('/','',$key)}} = new Chart(document.getElementById('TotalPecasMontagemDiaChart{{str_replace('/','',$key)}}').getContext('2d'), @json($value));
    @endforeach

    @foreach($TotaProducaoSemana as $key=>$value)
        var TotaProducaoSemanaChart{{str_replace('/','',$key)}} = new Chart(document.getElementById('TotaProducaoSemanaChart{{str_replace('/','',$key)}}').getContext('2d'), @json($value));
    @endforeach


   // var TotaProducaoSemanaChart = new Chart(document.getElementById('TotaProducaoSemanaChart').getContext('2d'), @json($TotaProducaoSemana));


</script>

@endpush


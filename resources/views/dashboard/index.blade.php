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
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="card-title">Produção por Máquina 30 dias</h5>

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
                        <canvas id="producaoMaquinaChart" height="315" style="height: 180px; display: block; width: 462px;" width="808" class="chartjs-render-monitor"></canvas>
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
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="card-title">Montagens / Status 30 dias</h5>

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
                        <canvas id="TotalPecasMontagemChart" height="315" style="height: 180px; display: block; width: 462px;" width="808" class="chartjs-render-monitor"></canvas>
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
                <div class="card card-info">
                    <div class="card-header">
                        <h5 class="card-title">Total Produção 30 Dias</h5>

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
                        <canvas id="TotalProducaoChart" height="315" style="height: 180px; display: block; width: 462px;" width="808" class="chartjs-render-monitor"></canvas>
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
                        <canvas id="TotaProducaoSemanaChart" height="315" style="height: 180px; display: block; width: 462px;" width="808" class="chartjs-render-monitor"></canvas>
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
    var producaoMaquinaChart = new Chart(document.getElementById('producaoMaquinaChart').getContext('2d'), @json($producaoMaquina));
    var TotalPecasMontagemChart = new Chart(document.getElementById('TotalPecasMontagemChart').getContext('2d'), @json($TotalPecasMontagem));
    var TotalProducaoChart = new Chart(document.getElementById('TotalProducaoChart').getContext('2d'), @json($TotalProducao));
    var TotaProducaoSemanaChart = new Chart(document.getElementById('TotaProducaoSemanaChart').getContext('2d'), @json($TotaProducaoSemana));
</script>

@endpush


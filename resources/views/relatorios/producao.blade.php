@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Relatório de Produção</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form id="filter-form" method="GET" class="form-horizontal" action="{{ route('relatorios.producao') }}">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="produto_id" class="col-sm-3 control-label">Produto:</label>
                            <div class="col-sm-9">
                                <select name="produto_id" id="produto_id" class="form-control">
                                    <option value="">Todos</option>
                                    @foreach($produtos as $produto)
                                        <option value="{{ $produto->id }}" {{ request('produto_id') == $produto->id ? 'selected' : '' }}>{{ $produto->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="operador_id" class="col-sm-3 control-label">Operador:</label>
                            <div class="col-sm-9">
                                <select name="operador_id" id="operador_id" class="form-control">
                                    <option value="">Todos</option>
                                    @foreach($operadores as $operador)
                                        <option value="{{ $operador->id }}" {{ request('operador_id') == $operador->id ? 'selected' : '' }}>{{ $operador->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="maquina_id" class="col-sm-3 control-label">Máquina:</label>
                            <div class="col-sm-9">
                                <select name="maquina_id" id="maquina_id" class="form-control">
                                    <option value="">Todos</option>
                                    @foreach($maquinas as $maquina)
                                        <option value="{{ $maquina->id }}" {{ request('maquina_id') == $maquina->id ? 'selected' : '' }}>{{ $maquina->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="data_inicio" class="col-sm-3 control-label">Período:</label>
                            <div class="col-sm-4">
                                <input type="date" name="data_inicio" id="data_inicio" class="form-control" value="{{ request('data_inicio') }}">
                            </div>
                            <div class="col-sm-1 text-center">a</div>
                            <div class="col-sm-4">
                                <input type="date" name="data_fim" id="data_fim" class="form-control" value="{{ request('data_fim') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                         <div class="form-group col-sm-12">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                                <a href="{{ route('relatorios.producao') }}" class="btn btn-default">Limpar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link active" id="table-tab" data-toggle="tab" href="#table" role="tab" aria-controls="table" aria-selected="true">Tabela</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="chart-tab" data-toggle="tab" href="#chart" role="tab" aria-controls="chart" aria-selected="false">Gráfico por Produto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="operador-chart-tab" data-toggle="tab" href="#operador-chart" role="tab" aria-controls="operador-chart" aria-selected="false">Gráfico por Operador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="maquina-chart-tab" data-toggle="tab" href="#maquina-chart" role="tab" aria-controls="maquina-chart" aria-selected="false">Gráfico por Máquina</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="total-mes-chart-tab" data-toggle="tab" href="#total-mes-chart" role="tab" aria-controls="total-mes-chart" aria-selected="false">Total por Mês</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade in active" id="table" role="tabpanel" aria-labelledby="table-tab">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Operador</th>
                                    <th>Máquina</th>
                                    <th>Data</th>
                                    <th>Quantidade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $row)
                                    <tr>
                                        <td>{{ $row->produto_nome }}</td>
                                        <td>{{ $row->operador_nome }}</td>
                                        <td>{{ $row->maquina_nome }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->data_producao)->format('d/m/Y') }}</td>
                                        <td>{{ $row->quantidade_total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" style="text-align:right">Total:</th>
                                    <th>{{ $total_quantidade }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="chart" role="tabpanel" aria-labelledby="chart-tab">
                        <canvas id="myChart" style="height: 400px;"></canvas>
                    </div>
                    <div class="tab-pane fade" id="operador-chart" role="tabpanel" aria-labelledby="operador-chart-tab">
                        <canvas id="operadorChart" style="height: 400px;"></canvas>
                    </div>
                    <div class="tab-pane fade" id="maquina-chart" role="tabpanel" aria-labelledby="maquina-chart-tab">
                        <canvas id="maquinaChart" style="height: 400px;"></canvas>
                    </div>
                    <div class="tab-pane fade" id="total-mes-chart" role="tabpanel" aria-labelledby="total-mes-chart-tab">
                        <canvas id="totalMesChart" style="height: 400px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('third_party_scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
@endpush

@push('page_scripts')
<script>
$(function () {
    let myChartInstance = null;
    let myOperadorChartInstance = null;
    let myMaquinaChartInstance = null;
    let myTotalMesChartInstance = null;
    const rawDataFromPHP = {!! json_encode($data) !!};

    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    function formatDate(dateString) {
        if (!dateString) return '';
        const parts = dateString.split('-');
        if (parts.length !== 3) return dateString; // return original if not in expected format
        const [year, month, day] = parts;
        return `${day}/${month}/${year}`;
    }

    function initializeChart(rawData) {
        if (myChartInstance) {
            myChartInstance.destroy();
        }

        const canvas = document.getElementById('myChart');
        if (!canvas) { return; }
        const ctx = canvas.getContext('2d');

        if (!rawData || rawData.length === 0) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.font = "16px Arial";
            ctx.textAlign = "center";
            ctx.fillText("Sem dados para exibir no gráfico.", canvas.width / 2, canvas.height / 2);
            return;
        }

        const uniqueDates = [...new Set(rawData.map(item => item.data_producao))].sort();
        const datasetsMap = new Map();

        rawData.forEach(item => {
            const combinationKey = item.produto_nome;
            if (!datasetsMap.has(combinationKey)) {
                datasetsMap.set(combinationKey, {
                    label: combinationKey,
                    data: {},
                    backgroundColor: getRandomColor(),
                    borderWidth: 1
                });
            }
            if (!datasetsMap.get(combinationKey).data[item.data_producao]) {
                datasetsMap.get(combinationKey).data[item.data_producao] = 0;
            }
            datasetsMap.get(combinationKey).data[item.data_producao] += parseInt(item.quantidade_total, 10);
        });

        const datasets = Array.from(datasetsMap.values()).map(dataset => {
            const dataArray = uniqueDates.map(date => dataset.data[date] || 0);
            return { ...dataset, data: dataArray };
        });

        const formattedDates = uniqueDates.map(date => formatDate(date));

        myChartInstance = new Chart(ctx, {
            type: 'bar',
            data: { labels: formattedDates, datasets: datasets },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{ ticks: { beginAtZero: true } }],
                    xAxes: [{ stacked: false }]
                },
                tooltips: { mode: 'index', intersect: false }
            }
        });
    }

    function initializeOperadorChart(rawData) {
        if (myOperadorChartInstance) {
            myOperadorChartInstance.destroy();
        }

        const canvas = document.getElementById('operadorChart');
        if (!canvas) { return; }
        const ctx = canvas.getContext('2d');

        if (!rawData || rawData.length === 0) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.font = "16px Arial";
            ctx.textAlign = "center";
            ctx.fillText("Sem dados para exibir no gráfico.", canvas.width / 2, canvas.height / 2);
            return;
        }

        const uniqueDates = [...new Set(rawData.map(item => item.data_producao))].sort();
        const datasetsMap = new Map();

        rawData.forEach(item => {
            const combinationKey = item.operador_nome;
            if (!datasetsMap.has(combinationKey)) {
                datasetsMap.set(combinationKey, {
                    label: combinationKey,
                    data: {},
                    backgroundColor: getRandomColor(),
                    borderWidth: 1
                });
            }
            if (!datasetsMap.get(combinationKey).data[item.data_producao]) {
                datasetsMap.get(combinationKey).data[item.data_producao] = 0;
            }
            datasetsMap.get(combinationKey).data[item.data_producao] += parseInt(item.quantidade_total, 10);
        });

        const datasets = Array.from(datasetsMap.values()).map(dataset => {
            const dataArray = uniqueDates.map(date => dataset.data[date] || 0);
            return { ...dataset, data: dataArray };
        });

        const formattedDates = uniqueDates.map(date => formatDate(date));

        myOperadorChartInstance = new Chart(ctx, {
            type: 'bar',
            data: { labels: formattedDates, datasets: datasets },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{ ticks: { beginAtZero: true } }],
                    xAxes: [{ stacked: false }]
                },
                tooltips: { mode: 'index', intersect: false }
            }
        });
    }

    function initializeMaquinaChart(rawData) {
        if (myMaquinaChartInstance) {
            myMaquinaChartInstance.destroy();
        }

        const canvas = document.getElementById('maquinaChart');
        if (!canvas) { return; }
        const ctx = canvas.getContext('2d');

        if (!rawData || rawData.length === 0) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.font = "16px Arial";
            ctx.textAlign = "center";
            ctx.fillText("Sem dados para exibir no gráfico.", canvas.width / 2, canvas.height / 2);
            return;
        }

        const uniqueDates = [...new Set(rawData.map(item => item.data_producao))].sort();
        const datasetsMap = new Map();

        rawData.forEach(item => {
            const combinationKey = item.maquina_nome;
            if (!datasetsMap.has(combinationKey)) {
                datasetsMap.set(combinationKey, {
                    label: combinationKey,
                    data: {},
                    backgroundColor: getRandomColor(),
                    borderWidth: 1
                });
            }
            if (!datasetsMap.get(combinationKey).data[item.data_producao]) {
                datasetsMap.get(combinationKey).data[item.data_producao] = 0;
            }
            datasetsMap.get(combinationKey).data[item.data_producao] += parseInt(item.quantidade_total, 10);
        });

        const datasets = Array.from(datasetsMap.values()).map(dataset => {
            const dataArray = uniqueDates.map(date => dataset.data[date] || 0);
            return { ...dataset, data: dataArray };
        });

        const formattedDates = uniqueDates.map(date => formatDate(date));

        myMaquinaChartInstance = new Chart(ctx, {
            type: 'bar',
            data: { labels: formattedDates, datasets: datasets },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{ ticks: { beginAtZero: true } }],
                    xAxes: [{ stacked: false }]
                },
                tooltips: { mode: 'index', intersect: false }
            }
        });
    }

    function initializeTotalMesChart(rawData) {
        if (myTotalMesChartInstance) {
            myTotalMesChartInstance.destroy();
        }

        const canvas = document.getElementById('totalMesChart');
        if (!canvas) { return; }
        const ctx = canvas.getContext('2d');

        if (!rawData || rawData.length === 0) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.font = "16px Arial";
            ctx.textAlign = "center";
            ctx.fillText("Sem dados para exibir no gráfico.", canvas.width / 2, canvas.height / 2);
            return;
        }

        const monthlyTotals = new Map();
        rawData.forEach(item => {
            const month = item.data_producao.substring(0, 7); // YYYY-MM
            const currentTotal = monthlyTotals.get(month) || 0;
            monthlyTotals.set(month, currentTotal + parseInt(item.quantidade_total, 10));
        });

        const sortedMonths = [...monthlyTotals.keys()].sort();
        const labels = sortedMonths.map(month => {
            const [year, monthNum] = month.split('-');
            return `${monthNum}/${year}`;
        });
        const data = sortedMonths.map(month => monthlyTotals.get(month));

        myTotalMesChartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Produção Total Mensal',
                    data: data,
                    backgroundColor: getRandomColor(),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{ ticks: { beginAtZero: true } }]
                },
                tooltips: {
                    mode: 'index',
                    intersect: false
                }
            }
        });
    }

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        if (e.target.id === 'chart-tab') {
            initializeChart(rawDataFromPHP);
        } else if (e.target.id === 'operador-chart-tab') {
            initializeOperadorChart(rawDataFromPHP);
        } else if (e.target.id === 'maquina-chart-tab') {
            initializeMaquinaChart(rawDataFromPHP);
        } else if (e.target.id === 'total-mes-chart-tab') {
            initializeTotalMesChart(rawDataFromPHP);
        }
    });

    // Initialize chart if a tab is already active on page load
    const activeTab = $('.nav-tabs .active > a').attr('id');
    if (activeTab === 'chart-tab') {
        initializeChart(rawDataFromPHP);
    } else if (activeTab === 'operador-chart-tab') {
        initializeOperadorChart(rawDataFromPHP);
    } else if (activeTab === 'maquina-chart-tab') {
        initializeMaquinaChart(rawDataFromPHP);
    } else if (activeTab === 'total-mes-chart-tab') {
        initializeTotalMesChart(rawDataFromPHP);
    }
});
</script>
@endpush
<?php

namespace App\DataTables;

use App\Models\producao;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Column;

class RelatorioProducaoDataTable extends DataTable
{
    public function dataTable($query)
    {
        return app('datatables')->of($query)->make(true);
    }

    public function query()
    {
        $request = $this->request();

        $query = DB::table('estoque')
            ->join('ordems', 'estoque.ordem_id', '=', 'ordems.id')
            ->join('maquinas', 'ordems.maquina_id', '=', 'maquinas.id')
            ->select(
                'maquinas.nome as maquina_nome',
                DB::raw('SUM(estoque.qtd_estoque) as quantidade_total')
            )
            ->groupBy('maquinas.id', 'maquinas.nome');

        if ($request->filled('maquina_id')) {
            $query->where('maquinas.id', '=', $request->maquina_id);
        }

        return $query;
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax('', '{data: $("#filter-form").serialize(), type: \'GET\'}')
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner', 'text' => '<i class="fa fa-download"></i> Exportar'],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner', 'text' => '<i class="fa fa-print"></i> Imprimir'],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner', 'text' => '<i class="fa fa-refresh"></i> Recarregar'],
                ],
                'language' => __('datatables')
            ]);
    }

    protected function getColumns()
    {
        return [
            'maquina_nome' => new Column(['title' => 'Máquina', 'data' => 'maquina_nome']),
            'quantidade_total' => new Column(['title' => 'Quantidade', 'data' => 'quantidade_total']),
        ];
    }

    protected function filename()
    {
        return 'relatorio_producao_' . time();
    }
}

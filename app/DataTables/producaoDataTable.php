<?php

namespace App\DataTables;

use App\Models\vwproducao;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class producaoDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'producaos.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\vwproducao $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(vwproducao $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false, 'title' => __('crud.action')])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    [
                       'extend' => 'create',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-plus"></i> ' .__('auth.app.create').''
                    ],
                    [
                       'extend' => 'export',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-download"></i> ' .__('auth.app.export').''
                    ],
                    [
                       'extend' => 'print',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-print"></i> ' .__('auth.app.print').''
                    ],
                    [
                       'extend' => 'reset',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-undo"></i> ' .__('auth.app.reset').''
                    ],
                    [
                       'extend' => 'reload',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-refresh"></i> ' .__('auth.app.reload').''
                    ],
                ],
                'language' => __('datatables')
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => new Column(['title' => __('models/producaos.fields.id'), 'data' => 'id','searchable' => false]),
            'Ordem' => new Column(['title' => __('Ordem'), 'data' => 'ordem_id','searchable' => true]),
            'data_ini' => new Column(['title' => __('models/producaos.fields.data_ini'), 'data' => 'data_ini','searchable' => false ]),
            'data_end' => new Column(['title' => __('models/producaos.fields.data_end'), 'data' => 'data_end','searchable' => false]),
            'turnos_nome' => new Column(['title' => __('models/producaos.fields.turnos_nome'), 'data' => 'turnos_nome','searchable' => true]),
            'imagem_produtos_nome' => new Column(['title' => __('models/producaos.fields.imagem_produtos_nome'), 'data' => 'imagem_produtos_nome','searchable' => true]),
            'qtd_diario' => new Column(['title' => __('models/producaos.fields.qtd_diario'), 'data' => 'qtd_diario','searchable' => false]),
            'maquina_nome' => new Column(['title' => __('models/producaos.fields.maquina_nome'), 'data' => 'maquina_nome','searchable' => true]),
            'producao' => new Column(['title' => __('Produção'), 'data' => 'qtd_producao','searchable' => false]),
            'Status' => new Column(['title' => __('Status'), 'data' => 'status_ordem','searchable' => true])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'producaos_datatable_' . time();
    }
}

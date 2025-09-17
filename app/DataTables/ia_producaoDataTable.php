<?php

namespace App\DataTables;

use App\Models\ia_producao;
use App\Models\vwordemcor;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class ia_producaoDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
       // dd($query->toSql());
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'ia_producaos.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ia_producao $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(vwordemcor $model)
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
                 'language' => [
                   'url' => url('//cdn.datatables.net/plug-ins/1.10.12/i18n/English.json'),
                 ],
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
            'id_order' => new Column(['title' => __('models/iaProducaos.fields.id'), 'data' => 'id_ordem','searchable' => true]),
            'nome' => new Column(['title' => __('models/iaProducaos.fields.nome'), 'data' => 'nome','searchable' => true]),
            'referencia' => new Column(['title' => __('models/iaProducaos.fields.referencia'), 'data' => 'referencia','searchable' => true]),
            'cor' => new Column(['title' => __('models/iaProducaos.fields.cor'), 'data' => 'cor','searchable' => true])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ia_producaos_datatable_' . time();
    }
}

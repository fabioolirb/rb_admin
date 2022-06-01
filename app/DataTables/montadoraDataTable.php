<?php

namespace App\DataTables;

use App\Models\montadora;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class montadoraDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'montadoras.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\montadora $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(montadora $model)
    {
        return $model->newQuery()->with('estados')->with('cidades');
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
            'nome' => new Column(['title' => __('models/montadoras.fields.nome'), 'data' => 'nome']),
            'fone' => new Column(['title' => __('models/montadoras.fields.fone'), 'data' => 'fone']),
            'contrato' => new Column(['title' => __('models/montadoras.fields.contrato'), 'data' => 'contrato']),
            'logradouro' => new Column(['title' => __('models/montadoras.fields.logradouro'), 'data' => 'logradouro']),
            'bairro' => new Column(['title' => __('models/montadoras.fields.bairro'), 'data' => 'bairro']),
            'nr' => new Column(['title' => __('models/montadoras.fields.nr'), 'data' => 'nr']),
            'cidade_id' => new Column(['title' => __('models/montadoras.fields.cidade_id'), 'data' => 'cidades.nome']),
            'estado_id' => new Column(['title' => __('models/montadoras.fields.estado_id'), 'data' => 'estados.nome'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'montadoras_datatable_' . time();
    }
}

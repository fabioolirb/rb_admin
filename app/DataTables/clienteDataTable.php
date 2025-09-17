<?php

namespace App\DataTables;

use App\Models\cliente;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class clienteDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'clientes.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\cliente $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(cliente $model)
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
            'nome_cliente' => new Column(['title' => __('models/clientes.fields.nome_cliente'), 'data' => 'nome_cliente']),
            'responsavel_cliente' => new Column(['title' => __('models/clientes.fields.responsavel_cliente'), 'data' => 'responsavel_cliente']),
            'documento_cliente' => new Column(['title' => __('models/clientes.fields.documento_cliente'), 'data' => 'documento_cliente']),
            'contato_cliente' => new Column(['title' => __('models/clientes.fields.contato_cliente'), 'data' => 'contato_cliente']),
            'contato2_cliente' => new Column(['title' => __('models/clientes.fields.contato2_cliente'), 'data' => 'contato2_cliente']),
            'id_endereco_cliente' => new Column(['title' => __('models/clientes.fields.id_endereco_cliente'), 'data' => 'id_endereco_cliente'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'clientes_datatable_' . time();
    }
}

<?php

namespace App\DataTables;

use App\Models\endereco_cliente;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class endereco_clienteDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'endereco_clientes.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\endereco_cliente $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(endereco_cliente $model)
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
            'desc_endereco_cliente' => new Column(['title' => __('models/enderecoClientes.fields.desc_endereco_cliente'), 'data' => 'desc_endereco_cliente']),
            'rua_endereco_cliente' => new Column(['title' => __('models/enderecoClientes.fields.rua_endereco_cliente'), 'data' => 'rua_endereco_cliente']),
            'nr_endereco_cliente' => new Column(['title' => __('models/enderecoClientes.fields.nr_endereco_cliente'), 'data' => 'nr_endereco_cliente']),
            'bairro_endereco_cliente' => new Column(['title' => __('models/enderecoClientes.fields.bairro_endereco_cliente'), 'data' => 'bairro_endereco_cliente']),
            'id_cidade' => new Column(['title' => __('models/enderecoClientes.fields.id_cidade'), 'data' => 'id_cidade']),
            'cep_endereco_cliente' => new Column(['title' => __('models/enderecoClientes.fields.cep_endereco_cliente'), 'data' => 'cep_endereco_cliente']),
            'complemento_endereco_cliente' => new Column(['title' => __('models/enderecoClientes.fields.complemento_endereco_cliente'), 'data' => 'complemento_endereco_cliente'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'endereco_clientes_datatable_' . time();
    }
}

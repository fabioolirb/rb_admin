<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/estoques.fields.id').':') !!}
    <p>{{ $estoque->id }}</p>
</div>

<!-- Qtd Estoque Field -->
<div class="col-sm-12">
    {!! Form::label('qtd_estoque', __('models/estoques.fields.qtd_estoque').':') !!}
    <p>{{ $estoque->qtd_estoque }}</p>
</div>

<!-- Ordem Id Field -->
<div class="col-sm-12">
    {!! Form::label('ordem_id', __('models/estoques.fields.ordem_id').':') !!}
    <p>{{ $estoque->ordem_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/estoques.fields.created_at').':') !!}
    <p>{{ $estoque->created_at->format('d/m/Y') }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/estoques.fields.updated_at').':') !!}
    <p>{{ $estoque->updated_at->format('d/m/Y') }}</p>
</div>

<!-- Data Producao Field -->
<div class="col-sm-12">
    {!! Form::label('data_producao', __('models/estoques.fields.data_producao').':') !!}
    <p>{{ $estoque->data_producao->format('d/m/Y') }}</p>
</div>


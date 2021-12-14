<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/produtos.fields.id').':') !!}
    <p>{{ $produto->id }}</p>
</div>

<!-- Nome Field -->
<div class="col-sm-12">
    {!! Form::label('nome', __('models/produtos.fields.nome').':') !!}
    <p>{{ $produto->nome }}</p>
</div>

<!-- Referencia Field -->
<div class="col-sm-12">
    {!! Form::label('referencia', __('models/produtos.fields.referencia').':') !!}
    <p>{{ $produto->referencia }}</p>
</div>

<!-- Prazo Producao Field -->
<div class="col-sm-12">
    {!! Form::label('prazo_producao', __('models/produtos.fields.prazo_producao').':') !!}
    <p>{{ $produto->prazo_producao }}</p>
</div>

<!-- Categoria Id Field -->
<div class="col-sm-12">
    {!! Form::label('categoria_id', __('models/produtos.fields.categoria_id').':') !!}
    <p>{{ $produto->categoria_id }}</p>
</div>


<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/matrizs.fields.id').':') !!}
    <p>{{ $matriz->id }}</p>
</div>

<!-- Linha Field -->
<div class="col-sm-12">
    {!! Form::label('linha', __('models/matrizs.fields.linha').':') !!}
    <p>{{ $matriz->linha }}</p>
</div>

<!-- Coluna Field -->
<div class="col-sm-12">
    {!! Form::label('coluna', __('models/matrizs.fields.coluna').':') !!}
    <p>{{ $matriz->coluna }}</p>
</div>

<!-- Produto Id Field -->
<div class="col-sm-12">
    {!! Form::label('produto_id', __('models/matrizs.fields.produto_id').':') !!}
    <p>{{ $matriz->produto_id }}</p>
</div>

<!-- Quantidade Field -->
<div class="col-sm-12">
    {!! Form::label('quantidade', __('models/matrizs.fields.quantidade').':') !!}
    <p>{{ $matriz->quantidade }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/matrizs.fields.created_at').':') !!}
    <p>{{ $matriz->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/matrizs.fields.updated_at').':') !!}
    <p>{{ $matriz->updated_at }}</p>
</div>


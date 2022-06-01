<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/categorias.fields.id').':') !!}
    <p>{{ $categoria->id }}</p>
</div>

<!-- Nome Field -->
<div class="col-sm-12">
    {!! Form::label('nome', __('models/categorias.fields.nome').':') !!}
    <p>{{ $categoria->nome }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/categorias.fields.created_at').':') !!}
    <p>{{ $categoria->created_at->format('d/m/Y') }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/categorias.fields.updated_at').':') !!}
    <p>{{ $categoria->updated_at->format('d/m/Y') }}</p>
</div>


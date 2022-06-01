<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/operadors.fields.id').':') !!}
    <p>{{ $operador->id }}</p>
</div>

<!-- Nome Field -->
<div class="col-sm-12">
    {!! Form::label('nome', __('models/operadors.fields.nome').':') !!}
    <p>{{ $operador->nome }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/operadors.fields.created_at').':') !!}
    <p>{{ $operador->created_at->format('d/m/Y') }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/operadors.fields.updated_at').':') !!}
    <p>{{ $operador->updated_at->format('d/m/Y') }}</p>
</div>


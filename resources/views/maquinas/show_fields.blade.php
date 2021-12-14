<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/maquinas.fields.id').':') !!}
    <p>{{ $maquina->id }}</p>
</div>

<!-- Nome Field -->
<div class="col-sm-12">
    {!! Form::label('nome', __('models/maquinas.fields.nome').':') !!}
    <p>{{ $maquina->nome }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/maquinas.fields.created_at').':') !!}
    <p>{{ $maquina->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/maquinas.fields.updated_at').':') !!}
    <p>{{ $maquina->updated_at }}</p>
</div>


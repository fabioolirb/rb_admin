<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/turnos.fields.id').':') !!}
    <p>{{ $turno->id }}</p>
</div>

<!-- Nome Field -->
<div class="col-sm-12">
    {!! Form::label('nome', __('models/turnos.fields.nome').':') !!}
    <p>{{ $turno->nome }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/turnos.fields.created_at').':') !!}
    <p>{{ $turno->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/turnos.fields.updated_at').':') !!}
    <p>{{ $turno->updated_at }}</p>
</div>


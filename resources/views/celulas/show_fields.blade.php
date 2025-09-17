<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/celulas.fields.id').':') !!}
    <p>{{ $celula->id }}</p>
</div>

<!-- Nome Field -->
<div class="col-sm-12">
    {!! Form::label('nome', __('models/celulas.fields.nome').':') !!}
    <p>{{ $celula->nome }}</p>
</div>

<!-- Tuno Id Field -->
<div class="col-sm-12">
    {!! Form::label('tuno_id', __('models/celulas.fields.tuno_id').':') !!}
    <p>{{ $celula->tuno_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/celulas.fields.created_at').':') !!}
    <p>{{ $celula->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/celulas.fields.updated_at').':') !!}
    <p>{{ $celula->updated_at }}</p>
</div>


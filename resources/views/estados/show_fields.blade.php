<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/estados.fields.id').':') !!}
    <p>{{ $estados->id }}</p>
</div>

<!-- Nome Field -->
<div class="col-sm-12">
    {!! Form::label('nome', __('models/estados.fields.nome').':') !!}
    <p>{{ $estados->nome }}</p>
</div>

<!-- Uf Field -->
<div class="col-sm-12">
    {!! Form::label('uf', __('models/estados.fields.uf').':') !!}
    <p>{{ $estados->uf }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/estados.fields.created_at').':') !!}
    <p>{{ $estados->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/estados.fields.updated_at').':') !!}
    <p>{{ $estados->updated_at }}</p>
</div>


<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/ilustradors.fields.id').':') !!}
    <p>{{ $ilustrador->id }}</p>
</div>

<!-- Nome Ilustrador Field -->
<div class="col-sm-12">
    {!! Form::label('nome_ilustrador', __('models/ilustradors.fields.nome_ilustrador').':') !!}
    <p>{{ $ilustrador->nome_ilustrador }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/ilustradors.fields.created_at').':') !!}
    <p>{{ $ilustrador->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/ilustradors.fields.updated_at').':') !!}
    <p>{{ $ilustrador->updated_at }}</p>
</div>


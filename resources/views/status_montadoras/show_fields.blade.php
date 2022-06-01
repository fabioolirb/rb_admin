<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/statusMontadoras.fields.id').':') !!}
    <p>{{ $statusMontadora->id }}</p>
</div>

<!-- Nome Field -->
<div class="col-sm-12">
    {!! Form::label('nome', __('models/statusMontadoras.fields.nome').':') !!}
    <p>{{ $statusMontadora->nome }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/statusMontadoras.fields.created_at').':') !!}
    <p>{{ $statusMontadora->created_at->format('d/m/Y') }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/statusMontadoras.fields.updated_at').':') !!}
    <p>{{ $statusMontadora->updated_at->format('d/m/Y') }}</p>
</div>


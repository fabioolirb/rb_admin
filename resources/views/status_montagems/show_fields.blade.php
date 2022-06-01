<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/statusMontagems.fields.id').':') !!}
    <p>{{ $statusMontagem->id }}</p>
</div>

<!-- Nome Field -->
<div class="col-sm-12">
    {!! Form::label('nome', __('models/statusMontagems.fields.nome').':') !!}
    <p>{{ $statusMontagem->nome }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/statusMontagems.fields.created_at').':') !!}
    <p>{{ $statusMontagem->created_at->format('d/m/Y') }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/statusMontagems.fields.updated_at').':') !!}
    <p>{{ $statusMontagem->updated_at->format('d/m/Y') }}</p>
</div>


<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/statusOrdems.fields.id').':') !!}
    <p>{{ $statusOrdem->id }}</p>
</div>

<!-- Nome Field -->
<div class="col-sm-12">
    {!! Form::label('nome', __('models/statusOrdems.fields.nome').':') !!}
    <p>{{ $statusOrdem->nome }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/statusOrdems.fields.created_at').':') !!}
    <p>{{ $statusOrdem->created_at->format('d/m/Y') }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/statusOrdems.fields.updated_at').':') !!}
    <p>{{ $statusOrdem->updated_at->format('d/m/Y') }}</p>
</div>


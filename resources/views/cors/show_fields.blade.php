<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/cors.fields.id').':') !!}
    <p>{{ $cor->id }}</p>
</div>

<!-- Cor Field -->
<div class="col-sm-12">
    {!! Form::label('cor', __('models/cors.fields.cor').':') !!}
    <span style='background-color:{{$cor->cor}}'></span> <p>{{ $cor->cor }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/cors.fields.created_at').':') !!}
    <p>{{ $cor->created_at->format('d/m/Y') }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/cors.fields.updated_at').':') !!}
    <p>{{ $cor->updated_at->format('d/m/Y') }}</p>
</div>


<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/cncs.fields.id').':') !!}
    <p>{{ $cnc->id }}</p>
</div>

<!-- Desc Cnc Field -->
<div class="col-sm-12">
    {!! Form::label('desc_cnc', __('models/cncs.fields.desc_cnc').':') !!}
    <p>{{ $cnc->desc_cnc }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/cncs.fields.created_at').':') !!}
    <p>{{ $cnc->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/cncs.fields.updated_at').':') !!}
    <p>{{ $cnc->updated_at }}</p>
</div>


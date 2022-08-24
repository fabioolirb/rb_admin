<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/ordems.fields.id').':') !!}
    <p>{{ $ordem->id }}</p>
</div>

<!-- Data Ini Field -->
<div class="col-sm-12">
    {!! Form::label('data_ini', __('models/ordems.fields.data_ini').':') !!}
    <p>{{ $ordem->data_ini }}</p>
</div>

<!-- Data End Field -->
<div class="col-sm-12">
    {!! Form::label('data_end', __('models/ordems.fields.data_end').':') !!}
    <p>{{ $ordem->data_end }}</p>
</div>


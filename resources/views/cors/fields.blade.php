<!-- Cor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cor', __('models/cors.fields.cor').':') !!}
    {!! Form::color('cor', null, ['class' => 'form-control']) !!}
    {!! Form::label('referencia', __('models/cors.fields.referencia').':') !!}
    {!! Form::text('referencia', null, ['class' => 'form-control']) !!}
</div>

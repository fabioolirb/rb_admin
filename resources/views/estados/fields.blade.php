<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', __('models/estados.fields.nome').':') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Uf Field -->
<div class="form-group col-sm-6">
    {!! Form::label('uf', __('models/estados.fields.uf').':') !!}
    {!! Form::text('uf', null, ['class' => 'form-control']) !!}
</div>
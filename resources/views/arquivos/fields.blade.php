<!-- Desc Arquivo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('desc_arquivo', __('models/arquivos.fields.desc_arquivo').':') !!}
    {!! Form::text('desc_arquivo', null, ['class' => 'form-control']) !!}
</div>

<!-- Link Arquivo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link_arquivo', __('models/arquivos.fields.link_arquivo').':') !!}
    {!! Form::text('link_arquivo', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Tipo Arquivo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_tipo_arquivo', __('models/arquivos.fields.id_tipo_arquivo').':') !!}
    {!! Form::text('id_tipo_arquivo', null, ['class' => 'form-control']) !!}
</div>
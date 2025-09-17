<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/tipoArquivos.fields.id').':') !!}
    <p>{{ $tipoArquivo->id }}</p>
</div>

<!-- Desc Tipo Arquivo Field -->
<div class="col-sm-12">
    {!! Form::label('desc_tipo_arquivo', __('models/tipoArquivos.fields.desc_tipo_arquivo').':') !!}
    <p>{{ $tipoArquivo->desc_tipo_arquivo }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/tipoArquivos.fields.created_at').':') !!}
    <p>{{ $tipoArquivo->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/tipoArquivos.fields.updated_at').':') !!}
    <p>{{ $tipoArquivo->updated_at }}</p>
</div>


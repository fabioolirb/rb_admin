<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/arquivos.fields.id').':') !!}
    <p>{{ $arquivo->id }}</p>
</div>

<!-- Desc Arquivo Field -->
<div class="col-sm-12">
    {!! Form::label('desc_arquivo', __('models/arquivos.fields.desc_arquivo').':') !!}
    <p>{{ $arquivo->desc_arquivo }}</p>
</div>

<!-- Link Arquivo Field -->
<div class="col-sm-12">
    {!! Form::label('link_arquivo', __('models/arquivos.fields.link_arquivo').':') !!}
    <p>{{ $arquivo->link_arquivo }}</p>
</div>

<!-- Id Tipo Arquivo Field -->
<div class="col-sm-12">
    {!! Form::label('id_tipo_arquivo', __('models/arquivos.fields.id_tipo_arquivo').':') !!}
    <p>{{ $arquivo->id_tipo_arquivo }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/arquivos.fields.created_at').':') !!}
    <p>{{ $arquivo->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/arquivos.fields.updated_at').':') !!}
    <p>{{ $arquivo->updated_at }}</p>
</div>


<!-- Arquivo Produto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', __('models/arquivoProdutos.fields.nome').':') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Arquivo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_arquivo_id', __('models/arquivoProdutos.fields.tipo_arquivo_id').':') !!}
    <div class="select2-purple">
        {!! Form::select('tipo_arquivo_id', $tipoArquivos,null,['class' => 'form-control custom-select']) !!}
    </div>
</div>

<!-- Produto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('produto_id', __('models/arquivoProdutos.fields.produto_id').':') !!}
      <div class="select2-purple">
        {!! Form::select('produto_id', $produtos,null,['class' => 'form-control custom-select']) !!}
    </div>
</div>

<!-- Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Link', __('models/arquivoProdutos.fields.Link').':') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('link', ['class' => 'custom-file-input']) !!}
            {!! Form::label('Link', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>

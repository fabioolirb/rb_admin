<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/arquivoProdutos.fields.id').':') !!}
    <p>{{ $arquivoProduto->id }}</p>
</div>

<!-- Arquivo Produto Field -->
<div class="col-sm-12">
    {!! Form::label('arquivo_produto', __('models/arquivoProdutos.fields.arquivo_produto').':') !!}
    <p>{{ $arquivoProduto->arquivo_produto }}</p>
</div>

<!-- Tipo Arquivo Id Field -->
<div class="col-sm-12">
    {!! Form::label('tipo_arquivo_id', __('models/arquivoProdutos.fields.tipo_arquivo_id').':') !!}
    <p>{{ $arquivoProduto->tipo_arquivo_id }}-{{ $arquivoProduto->tipoArquivos->desc_tipo_arquivo }}</p>
</div>

<!-- Link Field -->
<div class="col-sm-12">
    {!! Form::label('Link', __('models/arquivoProdutos.fields.Link').':') !!}
    <p><a href="/storage/{{ $arquivoProduto->link }}">{{ $arquivoProduto->link }}</a></p>
   <p><a download={{ $arquivoProduto->nome}} href="{{ Storage::url($arquivoProduto->link) }}" title={{ $arquivoProduto->nome }} class='btn btn-default btn-xs'>Download</a></p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/arquivoProdutos.fields.created_at').':') !!}
    <p>{{ $arquivoProduto->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/arquivoProdutos.fields.updated_at').':') !!}
    <p>{{ $arquivoProduto->updated_at }}</p>
</div>


<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/imagemProdutos.fields.id').':') !!}
    <p>{{ $imagemProduto->id }}</p>
</div>

<!-- Nome Field -->
<div class="col-sm-12">
    {!! Form::label('nome', __('models/imagemProdutos.fields.nome').':') !!}
    <p>{{ $imagemProduto->nome }}</p>
</div>

<!-- Link Field -->
<div class="col-sm-12">
    {!! Form::label('link', __('models/imagemProdutos.fields.link').':') !!}
    <p>{{ $imagemProduto->link }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/imagemProdutos.fields.created_at').':') !!}
    <p>{{ $imagemProduto->created_at->format('d/m/Y') }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/imagemProdutos.fields.updated_at').':') !!}
    <p>{{ $imagemProduto->updated_at->format('d/m/Y') }}</p>
</div>

<!-- Produto Id Field -->
<div class="col-sm-12">
    {!! Form::label('produto_id', __('models/imagemProdutos.fields.produto_id').':') !!}
    <p>{{ $imagemProduto->produto_id }}</p>
</div>


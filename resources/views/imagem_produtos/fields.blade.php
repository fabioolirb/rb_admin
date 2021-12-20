<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', __('models/imagemProdutos.fields.nome').':') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link', __('models/imagemProdutos.fields.link').':') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('link', ['class' => 'custom-file-input']) !!}
            {!! Form::label('link', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>


<!-- Produto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('produto_id', __('models/imagemProdutos.fields.produto_id').':') !!}
      <div class="select2-purple">
        {!! Form::select('produto_id', $produtos,null,['class' => 'form-control custom-select']) !!}
    </div>
</div>

<!-- Cores da imagem a ser utilizada na produção -->
<div class="form-group col-sm-6">
    {!! Form::label('cor', 'Cor:') !!}
    <div class="select2-purple">
        {!! Form::select('cor_data[]', $cors,null, ['class' => 'select2 form-control select2-purple','multiple'=>'multiple']) !!}
    </div>
</div>
@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush

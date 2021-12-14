<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', __('models/produtos.fields.nome').':') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Referencia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('referencia', __('models/produtos.fields.referencia').':') !!}
    {!! Form::text('referencia', null, ['class' => 'form-control']) !!}
</div>

<!-- Prazo Producao Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prazo_producao', __('models/produtos.fields.prazo_producao').':') !!}
    {!! Form::text('prazo_producao', null, ['class' => 'form-control']) !!}
</div>

<!-- Categoria Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('categoria_id', __('models/produtos.fields.categoria_id').':') !!}
    <div class="select2-purple">
        {!! Form::select('categoria_id', $categorias,null,['class' => 'form-control custom-select']) !!}
    </div>
</div>

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush


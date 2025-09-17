<!-- Linha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('linha', __('models/matrizs.fields.linha').':') !!}
    {!! Form::text('linha', null, ['class' => 'form-control']) !!}
</div>

<!-- Coluna Field -->
<div class="form-group col-sm-6">
    {!! Form::label('coluna', __('models/matrizs.fields.coluna').':') !!}
    {!! Form::text('coluna', null, ['class' => 'form-control']) !!}
</div>

<!-- Produto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('produto_id', __('models/matrizs.fields.produto_id').':') !!}
    {!! Form::select('produto_id', $produto,null, ['class' => 'form-control custom-select']) !!}

</div>


<!-- Quantidade Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantidade', __('models/matrizs.fields.quantidade').':') !!}
    {!! Form::number('quantidade', null, ['class' => 'form-control']) !!}
</div>

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush

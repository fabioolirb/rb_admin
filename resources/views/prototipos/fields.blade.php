<!-- Desc Prototipo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('desc_prototipo', __('models/prototipos.fields.desc_prototipo').':') !!}
    {!! Form::text('desc_prototipo', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Imagem Produto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_imagem_produto', __('models/prototipos.fields.id_imagem_produto').':') !!}
    {!! Form::select('id_imagem_produto', $imagem_produto, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Id Cliente Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_cliente', __('models/prototipos.fields.id_cliente').':') !!}
    {!! Form::select('id_cliente', $cliente, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Id Ilustrador Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_ilustrador', __('models/prototipos.fields.id_ilustrador').':') !!}
    {!! Form::select('id_ilustrador', $ilustrador, null, ['class' => 'form-control custom-select']) !!}
</div>


@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush

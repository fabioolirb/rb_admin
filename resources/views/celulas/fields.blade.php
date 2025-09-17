<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', __('models/celulas.fields.nome').':') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Tuno Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tuno_id', __('models/celulas.fields.tuno_id').':') !!}
    {!! Form::select('tuno_id',$turno, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Produto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('maquina_id', __('models/celulas.fields.nome_maquina').':') !!}
    {!! Form::select('maquina_id[]', $maquina,null, ['class' => 'select2 form-control select2-purple','multiple'=>'multiple']) !!}
</div>

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush

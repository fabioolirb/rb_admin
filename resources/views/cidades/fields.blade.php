<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', __('models/cidades.fields.nome').':') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Ibge Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ibge', __('models/cidades.fields.ibge').':') !!}
    {!! Form::text('ibge', null, ['class' => 'form-control']) !!}
</div>

<!-- Estado Id Field
<div class="form-group col-sm-6">
    {!! Form::label('estado_id', __('models/cidades.fields.estado_id').':') !!}
    {!! Form::text('estado_id', null, ['class' => 'form-control']) !!}
</div>
 -->
<div class="form-group col-sm-6">
    {!! Form::label('estado_id', __('models/cidades.fields.estado_id').':') !!}
    <div class="select2-purple">
        {!! Form::select('estado_id', $estados,null,['class' => 'form-control custom-select']) !!}
    </div>
</div>

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush

<!-- Id Cnc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_cnc', __('models/osUsinagems.fields.id_cnc').':') !!}
    {!! Form::select('id_cnc', ['CNC' => 'CNC'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Id Prototipo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_prototipo', __('models/osUsinagems.fields.id_prototipo').':') !!}
    {!! Form::select('id_prototipo', ['Prototipo' => 'Prototipo'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Data Ini Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_ini', __('models/osUsinagems.fields.data_ini').':') !!}
    {!! Form::text('data_ini', null, ['class' => 'form-control','id'=>'data_ini']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#data_ini').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Data Fim Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_fim', __('models/osUsinagems.fields.data_fim').':') !!}
    {!! Form::text('data_fim', null, ['class' => 'form-control','id'=>'data_fim']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#data_fim').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush
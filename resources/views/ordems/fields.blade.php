<!-- Data Ini Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_ini', __('models/ordems.fields.data_ini').':') !!}
    {!! Form::text('data_ini', Helper::outDate($ordem->data_ini),['class' => 'form-control','id'=>'data_ini']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $( function() {
            $( "#data_ini" ).datepicker(
                {format: 'YYYY-MM-DD HH:mm:ss',
                    useCurrent: true,
                    sideBySide: true}
            );
        } );
    </script>
@endpush

<!-- Data End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_end', __('models/ordems.fields.data_end').':') !!}
    {!! Form::text('data_end', Helper::outDate($ordem->data_end), ['class' => 'form-control','id'=>'data_end']) !!}
</div>

<!-- Cidade Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_ordem_id', __('models/statusOrdems.fields.nome').':') !!}
    {!! Form::select('status_ordem_id', $status, null, ['class' => 'form-control custom-select']) !!}
</div>


@push('page_scripts')
    <script type="text/javascript">
        $( function() {
            $( "#data_end" ).datepicker(
                {format: 'YYYY-MM-DD HH:mm:ss',
                    useCurrent: true,
                    sideBySide: true}
            );
        } );

    </script>
@endpush

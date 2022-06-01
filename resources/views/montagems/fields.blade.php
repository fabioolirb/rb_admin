<!-- Data Envio Field -->

<div class="form-group col-sm-6">
    {!! Form::label('data_envio', __('models/montagems.fields.data_envio').':') !!}
    {!! Form::text('data_envio',empty($montagem) ? '   /   /' : Helper::outDate($montagem->data_envio), ['class' => 'form-control','id'=>'data_envio']) !!}
</div>

<!-- Data Retorno Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_retorno', __('models/montagems.fields.data_retorno').':') !!}
    {!! Form::text('data_retorno',empty($montagem) ? '   /   /' : Helper::outDate($montagem->data_retorno),['class' => 'form-control','id'=>'data_retorno']) !!}
</div>

<!-- Status Montagem Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_montagem_id', __('models/montagems.fields.status_montagem_id').':') !!}
    {!! Form::select('status_montagem_id', $status_montagem, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Montadora Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('montadora_id', __('models/montagems.fields.montadora_id').':') !!}
    {!! Form::select('montadora_id', $montadora, null, ['class' => 'form-control custom-select']) !!}
</div>

<div class="container-fluid">
    <hr class="mb-4">
</div>

    <!-- Status Produto Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('produto_id', __('models/montagems.fields.produto_id').':') !!}
        {!! Form::select('produto_id', $produtos, null, ['class' => 'form-control custom-select']) !!}
    </div>

    <!-- Quantidade Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('quantidade', __('models/montagems.fields.quantidade').':') !!}
        {!! Form::text('quantidade', null, ['class' => 'form-control']) !!}
    </div>

<div class="container">
    <div class="form-group" style="display: @if(!empty($montagem['update'])) none @endif">
        <button type="button" name="add" id="add" class="btn btn-success">Incluir Item </button>
    </div>
    <div class="row" id="div_busca" name="div_busca" style="display: none">
        <div class="d-inline p-2 bg-primary text-white col-sm-12" > Produtos selecionados </div>
            <table class="table table-bordered table-hover" id="dynamic_field">
                <tr>
                    <td><label>Produto:</label></td>
                    <td><label>Quantidade:</label></td>
                    <td><label>Remover:</label></td>
                </tr>
            </table>
        </div>
    </div>

@push('page_scripts')
    <script type="text/javascript">
        $( function() {
            $( "#data_envio" ).datepicker(
                {
                    dateFormat: 'dd/mm/yy',
                    showOtherMonths: true,
                    selectOtherMonths: true
                }
            );
            $( "#data_retorno" ).datepicker(
                {
                    dateFormat: 'dd/mm/yy',
                    showOtherMonths: true,
                    selectOtherMonths: true
                }
            );
        } );


    </script>
@endpush

@push('page_scripts')
    <script>
        $(document).ready(function(){
            var i=1;
            $('#add').click(function(){
                i++;
                var data_ini = $('#data_envio').val();
                var produto_id = $("#produto_id option:selected").val();
                var montadora_id = $("#montadora_id option:selected").val();
                var quantidade = $('#quantidade').val();

                if(!data_ini){
                    toastr.error('Data Envio não pode estar em branco!!');
                    return;
                }

               if(!produto_id){
                    toastr.error('Informe um Produto para continuar !!');
                    return;
                };

                if(!quantidade){
                    toastr.error('Informe a Quantidade para continuar !!');
                    return;
                };

                if(!montadora_id){
                    toastr.error('Informe a Quantidade para continuar !!');
                    return;
                };

                $("#div_busca").show("slow");

                var quantidade = $("#quantidade").val();

                // remove o item pra não ficar duplicado
                $('#row'+produto_id+'').remove();


                var operador_id = $("#operador_id option:selected").val();
                var operador_text = $("#operador_id option:selected").text();
                var produto_txt = $("#produto_id option:selected").text();

                $('#dynamic_field').append('<tr id="row'+produto_id+'" class="dynamic-added">' +
                    '<td><input type="hidden" name="_produto_id[]" value="'+ produto_id +'" class="form-control name_list"  />'+produto_txt+'</td>' +
                    '<td><input type="hidden" name="_quantidade[]" value="' + quantidade +'" class="form-control name_list" />'+quantidade+'</td>' +
                    '<td><button type="button" name="remove" id="'+produto_id+'" class="btn btn-danger btn_remove">X</button></td>' +
                    '</tr>');

                toastr.info('Produto <b>'+produto_txt+'</b> selecionada!!');

            });

            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });



        });

    </script>

@endpush

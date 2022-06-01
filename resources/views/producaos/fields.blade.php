
    <!-- cores que estão na maquina -->
    <div role="main" class="form-group col-sm">
        {!! Form::label('cor_data', __('models/cors.fields.cor').':') !!}
        <div class="select2-purple">
            {!! Form::select('cor_data', $cors,null, ['class' => 'select2 form-control select2-purple','multiple'=>'multiple']) !!}
        </div>
    </div>

    <!-- Categoria Id Field -->
    <div class="form-group col-sm">
        {!! Form::label('categoria_id', __('models/produtos.fields.categoria_id').':') !!}
        <div class="select2-purple">
            {!! Form::select('categoria_id', $categorias,null,['class' => 'form-control custom-select']) !!}
        </div>
    </div>

    <div class="form-group col-sm">
        {!! Form::label('busca', __('models/producaos.fields.busca').':') !!}
        {!! Form::text('busca', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <input type="button" name="btn_buscar " id="btn_buscar" class="btn btn-info" value="Buscar" />
    </div>

    <div class="container-fluid" id="div_busca" name="div_busca" style="display: none">
        <hr class="mb-4">
        <div class="px-lg-5">
            <div class="row" id="dynamic_imagem">

            </div>
        </div>
        <hr class="mb-4">
    </div>

    <div id="pecas_cor" style="display: none" class="row mt-3 px-1">
    <!-- Data Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('data_ini', __('models/producaos.fields.data_ini').':') !!}
        {!! Form::text('data_ini', null, ['class' => 'form-control','id'=>'data_ini','required']) !!}
    </div>

    <div class="form-group col-sm-4">
        {!! Form::label('qtd_diario', __('models/producaos.fields.qtd_diario').':') !!}
        {!! Form::text('qtd_diario', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-4">
        {!! Form::label('data_fim', __('models/producaos.fields.data_fim').':') !!}
        {!! Form::text('data_fim', null, ['class' => 'form-control','id'=>'data_fim','required']) !!}
    </div>

    @push('page_scripts')
        <script type="text/javascript">
            $( function() {
                $( "#data_ini" ).datepicker();
                $( "#data_fim" ).datepicker();
            } );
        </script>

    @endpush

    <!-- Maquina Id Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('maquina_id', __('models/producaos.fields.maquina_id').':') !!}
        {!! Form::select('maquina_id', $maquina, null, ['class' => 'form-control custom-select']) !!}
    </div>

<!-- Mostra o formulario apenas com os produtos com as cores selecionadas na ordem de serviço -->

    <div class="form-group col-sm-4">
        {!! Form::label('turno_id', __('models/producaos.fields.turno_id').':') !!}
        <div class="select2-purple">
            {!! Form::select('turno_id', $turno,null, ['class' => 'form-control custom-select']) !!}
        </div>
    </div>

    <!-- Operador Id Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('operador_id', __('models/producaos.fields.operador_id').':') !!}
        {!! Form::select('operador_id', $operador, null, ['class' => 'form-control custom-select']) !!}
    </div>


    <div class="container">
        <div class="form-group">
            <button type="button" name="add" id="add" class="btn btn-success">Incluir Item </button>
        </div>
    </div>

    <div class="d-inline p-2 bg-primary text-white col-sm-12"> Produtos selecionados </div>
        <div  class="form-group col-sm-8 mt-3 ">
            <form name="add_formOrder" id="add_formOrder">
                <div class="table-responsive card card-success">
                    <table class="table table-bordered table-hover" id="dynamic_field">
                            <tr>
                                <td><label>Data:</label></td>
                                <td><label>Imagem:</label></td>
                                <td><label>Maquina:</label></td>
                                <td><label>Operador:</label></td>
                                <td><label>Turno:</label></td>
                                <td><label>Data Fim:</label></td>
                                <td><label>Remover:</label></td>
                            </tr>
                    </table>
                    <input type="submit" name="submit" id="submit" class="btn btn-info" value="Criar OS" />
                    <a href="{{ route('producaos.index') }}" class="btn btn-default">
                        @lang('crud.cancel')
                    </a>
                </div>
            </form>
        </div>

        <div  class="form-group col-sm-4 mt-3">
            <div class="table-responsive card card-success">
                <table class="table table-bordered table-hover dataTable dtr-inline card-footer" id="dynamic_field">
                    <tr>
                        <td> Cores </td>
                        <td> Códigos </td>
                        <td> Maquinas</td>
                    </tr>
                </table>
            </div>
        </div>

</div>


@push('page_scripts')

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });

   $(document).ready(function(){

        var postURL = "{{route('producaos.store')}}";
        var i=1;

        $('#add').click(function(){
            i++;
            var data_ini = $('#data_ini').val();
            var data_fim = $('#data_fim').val();
            var maquina_id = $("#maquina_id option:selected").val();

           if(!data_ini){
                toastr.error('Data Início não pode estar em branco!!');
                return;
            }

            if(!data_fim){
                toastr.error('Data final não pode estar em branco!!');
                return;
            }

            if(!maquina_id){
                toastr.error('Informe um Id de Máquina para continuar !!');
                return;
            };

            var data_ini = $("#data_ini").val();
            var data_fim = $("#data_fim").val();
            var cor_data_id = $("#cor_data option:checked").val();
            var qtd_diario = $("#qtd_diario").val();

            var turno_id = $("#turno_id option:selected").val();
            var operador_id = $("#operador_id option:selected").val();
            var maquina_text = $("#maquina_id option:selected").text();
            var turno_text = $("#turno_id option:selected").text();
            var operador_text = $("#operador_id option:selected").text();
            var cor_data_txt = $("#cor_data option:checked").text();


            var chklistaimage = $('input[name="img_check"]:checked').toArray().map(function(check) {

                var imagem_id = $(check).val();
                var imagem_text = $("#imagem_txt_"+$(check).val()).val();

                $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added">' +
                    '<td><input type="hidden" name="_data_ini[]" value="' + data_ini +'" class="form-control name_list" />'+data_ini+'</td>' +
                    '<td><input type="hidden" name="_imagem_id[]" value="'+ imagem_id +'" class="form-control name_list"  />'+imagem_text+'</td>' +
                    '<td><input type="hidden" name="_operador_id[]" value="'+ operador_id +'" class="form-control name_list"  />'+operador_text+'</td>' +
                    '<td><input type="hidden" name="_maquina_id[]" value="'+ maquina_id +'" class="form-control name_list"  />'+maquina_text+'</td>' +
                    '<td><input type="hidden" name="_turno_id[]" value="'+ turno_id +'" class="form-control name_list"  />'+turno_text+'</td>' +
                    '<td><input type="hidden" name="_data_fim[]" value="' + data_fim+'" class="form-control name_list" />'+data_fim+'</td>' +
                    '<td><input type="hidden" name="_qtd_diario[]" value="'+ qtd_diario + '" class="form-control name_list" />' +
                    '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>' +
                '</tr>');
                    toastr.info('Imagem <b>'+imagem_text+'</b> selecionada!!');
                return  $(check).val();

            });

            if(chklistaimage==''){
                toastr.error('Favor selecionar uma imagem!!');
                return;
            }

            {{--
            $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            --}}
        });

        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });

        $('#btn_buscar').click(function(){

            $("#div_busca").show("slow");
            $("#pecas_cor").show("slow");

            var categoria_id = $("#categoria_id option:selected").val();
            var cor_data = $('#cor_data').val();
            var busca = $('#busca').val();

            $.ajax({
                url: '/admin/producaos/validacor',
                method: 'POST',
                //dataType: 'json',
                data: {cor_data:$('#cor_data').val(),categoria_id:categoria_id,busca:busca},

                success: function(response){

                    $("#dynamic_imagem").html('');
                    var len = 0;
                    len = response['data'].length;
                    var tr_img = "<tr><td>" ;

                    if(len > 0){
                        for(var i=0; i<len; i++){
                            var nome = response['data'][i].nome;
                            var id = response['data'][i].produto_id;
                            var imagem_id = response['data'][i].imagem_id;
                            var cor_id = response['data'][i].cor_id;
                            var referencia = response['data'][i].referencia;
                            var link = response['data'][i].link;
                            var info ='';
                            var info_len = response['data'][i].info.length;
                            var info_referencia = '';

                            for(var a=0; a<info_len; a++){
                                   info = info + "&nbsp;<span class='border border-dark' style='background:" + response['data'][i].info[a].cor +" !important'>&nbsp;&nbsp;&nbsp;&nbsp;</span>" ;
                                   info_referencia = info_referencia + response['data'][i].info[a].cors_referencia +", ";
                                   var produto_referencia =  response['data'][i].info[a].produto_referencia;
                                   var prazo_producao = response['data'][i].info[a].prazo_producao;
                            }

                            var imagem = "<input type='checkbox' name='img_check' id='imagem_" + imagem_id + "' value='"+ imagem_id +"'>"
                                         +"<input type='hidden' value='"+ nome +"' id='imagem_txt_" + imagem_id + "' class='form-control name_list'  />";

                            tr_img = "<div class='col-xl-3 col-lg-4 col-md-6 mb-4'>" +
                                        "<div class='bg-white rounded shadow-sm'>" +
                                            "<img src='{{url('')}}/storage/"+link +"' alt='"+nome+"' class='img-fluid card-img-top'>" +
                                            "<div class='p-4'><h5> <a href='#' class='text-dark'>"+ nome+"</a></h5>" +
                                                "<p class='small text-muted mb-0'> "+ info +"<br>"+ info_referencia + "<br><b>Prazo:</b>"+ prazo_producao + "&nbsp;&nbsp;<b>Estoque:</b> "+ 0 +"&nbsp;&nbsp;<b>Formas:</b> "+ 1 +"  </p>" +
                                                "<div class='d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4'>" +
                                                    "<p class='small mb-0'><i class='fa fa-picture-o mr-2'></i><span class='font-weight-bold'>Selecionar</span>&nbsp;"+imagem+"</p>" +
                                                    "<div class='badge badge-danger px-3 rounded-pill font-weight-normal'></div>" +
                                                "</div>" +
                                            "</div>" +
                                        "</div>" +
                                      "</div>";

                            $("#dynamic_imagem").append(tr_img);
                        }
                    }else{
                        var tr_img = "<tr>" +
                            "<td align='center' colspan='4'>Sem resultados.</td>" +
                            "</tr>";

                        $("#dynamic_imagem").append(tr_img);
                    }

                }
            });
        });

        {{--$('#submit').click(function(){--}}
        {{--    alert('submit');--}}
        {{--    $.ajax({--}}
        {{--        url:"{{route('producaos.store')}}",--}}
        {{--        method:"POST",--}}
        {{--        data:$('#formOrdem').serialize(),--}}
        {{--        type:'json',--}}
        {{--        success:function(data)--}}
        {{--        {--}}
        {{--           // i=1;--}}
        {{--          //  $('.dynamic-added').remove();--}}
        {{--           // $('#add_name')[0].reset();--}}
        {{--            alert('Record Inserted Successfully.');--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

    });

</script>

@endpush





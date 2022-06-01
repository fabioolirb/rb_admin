<!-- Ordem Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ordem_id', __('models/estoques.fields.ordem_id').':') !!}
    {!! Form::select('ordem_id', $ordem, null, ['class' => 'form-control custom-select']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('produto_id', __('models/estoques.fields.produto_id').':') !!}
    {!! Form::select('produto_id', $produto, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Qtd Estoque Field -->
<div class="form-group col-sm-6">
    {!! Form::label('qtd_estoque', __('models/estoques.fields.qtd_estoque').':') !!}
    {!! Form::number('qtd_estoque', null, ['class' => 'form-control']) !!}
</div>


<!-- Data Producao Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_producao', __('models/estoques.fields.data_producao').':') !!}
    {!! Form::text('data_producao', null, ['class' => 'form-control','id'=>'data_producao']) !!}
</div>


@push('page_scripts')

    <script type="text/javascript">
        $( function() {
            $( "#data_producao" ).datepicker();

        } );
    </script>
    <script type="text/javascript">

        $(document).ready(function() {
            $('#ordem_id').on('change', function(e) {
                var ordem_id = e.target.value;

                $.ajax({
                    url: '/admin/estoques/getproduct',
                    method: 'POST',
                    //dataType: 'json',
                    data: {id:ordem_id},

                    success: function(request) {
                        $('#produto_id').empty();
                        var selectbox = $('#produto_id');
                        //console.log(request.produtos);
                        $.each(request.produtos, function(index, produto) {
                            $('<option>').val(produto.id).text(produto.nome).appendTo(selectbox);
                        })
                        if(request.produtos.length <=0){
                            toastr.error('Ordem se serviço não tem Produtos');
                        }else {
                            toastr.info('Total de Produtos <b>' + request.produtos.length + '</b>, selecionada!!');
                        }
                    }
                });

            });
        });
    </script>
@endpush

    <!-- Id Field -->
    <div class="col-sm-6">
        {!! Form::label('id', __('models/imagemProdutos.fields.id').':') !!}
        <p>{{ $imagemProduto->id }}</p>
    </div>

    <!-- Nome Field -->
    <div class="col-sm-6">
        {!! Form::label('nome', __('models/imagemProdutos.fields.nome').':') !!}
        <p>{{ $imagemProduto->nome }}</p>
    </div>

    <!-- Link Field -->
    <div class="col-sm-6">
        {!! Form::label('link', __('models/imagemProdutos.fields.link').':') !!}
        <p>{{ $imagemProduto->link }}</p>
    </div>

    <!-- Created At Field -->
    <div class="col-sm-6">
        {!! Form::label('created_at', __('models/imagemProdutos.fields.created_at').':') !!}
        <p>{{ $imagemProduto->created_at->format('d/m/Y') }}</p>
    </div>

    <!-- Updated At Field -->
    <div class="col-sm-6">
        {!! Form::label('updated_at', __('models/imagemProdutos.fields.updated_at').':') !!}
        <p>{{ $imagemProduto->updated_at->format('d/m/Y') }}</p>
    </div>

    <!-- Produto Id Field -->
    <div class="col-sm-6">
        {!! Form::label('produto_id', __('models/imagemProdutos.fields.produto_id').':') !!}
        <p>{{ $imagemProduto->produto_id }}</p>
    </div>
 </div>
    <div class="row" >
            <div class='col-sm-4'>
                <img src='{{url('')}}/storage/{{$imagemProduto->link}}' alt='{{$imagemProduto->produto_nome}}' class='img-fluid card-img-top'>
                <div class='p-4'><h5> <a href='#' class='text-dark'>{{$imagemProduto->imagem_produtos_nome}}</a></h5>
                    @php
                      $info ='';
                        $info_referencia = '';
                    @endphp
                   @foreach ($imagemProduto->cor as $cor)
                        @php
                            $info = $info . "&nbsp;<span class='border border-dark' style='background:" . $cor['cor'] . " !important'>&nbsp;&nbsp;&nbsp;&nbsp;</span>" ;
                            $info_referencia = $info_referencia . $cor['referencia'] . ", " ;
                        @endphp
                    @endforeach
                    <p class='small text-muted mb-0'> @php echo $info .'<br>'. $info_referencia; @endphp <br><b>Prazo:</b>123&nbsp;&nbsp;<b>Estoque:</b> 0 &nbsp;&nbsp;<b>Formas:</b> 1 </p>

                </div>

            </div>

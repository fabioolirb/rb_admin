<!-- Id Field -->

        <div class="container-fluid">
            <div class="row bg-light">
                <div class="col-sm-8">
                        {!! Form::label('id', __('models/producaos.fields.id').':') !!}
                        {{ $ordem->ordem_id}}
                </div>

                <!-- Data Field -->
                <div class="col-sm-4 bg-light">
                    {!! Form::label('data', __('models/producaos.fields.data').':') !!}
                    {{ date( 'd/m/Y' , strtotime($ordem->data)) }}
                </div>
            </div>
            <div class="row bg-light">
                <!-- Maquina Id Field -->
                <div class="col-sm">
                    {!! Form::label('maquina_id', __('models/producaos.fields.maquina_id').':') !!}
                    {{ $ordem->maquina_nome }}
                </div>

                <!-- Turno Id Field -->
                <div class="col-sm">
                    {!! Form::label('turno_id', __('models/producaos.fields.turno_id').':') !!}
                    {{ $ordem->turnos_nome }}
                </div>

                <!-- Operador Id Field -->
                <div class="col-sm">
                    {!! Form::label('operador_id', __('models/producaos.fields.operador_id').':') !!}
                    {{ $ordem->nome}}
                </div>
            </div>

            <div class="px-lg-5">
                <div class="row" id="dynamic_imagem">
                    @foreach ($producao as $dados )

                        <div class='col-3'>

                                <img src='{{url('')}}/storage/{{$dados['link']}}' alt='{{$dados['produto_nome']}}' class='img-fluid card-img-top'>
                                <div class='p-4'><h5> <a href='#' class='text-dark'>{{$dados->imagem_produtos_nome}}</a></h5>

                                   @php
                                       $info = '' ;
                                       $info_referencia ='';
                                   @endphp

                                    @foreach ($dados->info as $produto)

                                         @php
                                           $info = $info . "&nbsp;<span class='border border-dark' style='background:" . $produto->cor . " !important'>&nbsp;&nbsp;&nbsp;&nbsp;</span>" ;
                                           $info_referencia = $info_referencia . $produto->cors_referencia . ", " ;
                                         @endphp
                                     @endforeach

                                    <p class='small text-muted mb-0'> @php echo $info .'<br>'. $info_referencia; @endphp <br><b>Prazo:</b>123&nbsp;&nbsp;<b>Estoque:</b> 0 &nbsp;&nbsp;<b>Formas:</b> 1 </p>

                                </div>

                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row bg-light">
                <!-- Maquina Id Field -->
                <div class="col-sm">
                    {!! Form::label('maquina_id', __('models/producaos.fields.data_ini').':') !!}
                    ____/____/____
                </div>

                <!-- Turno Id Field -->
                <div class="col-sm">
                    {!! Form::label('turno_id', __('models/producaos.fields.data_end').':') !!}
                    ____/____/____
                </div>

                <!-- Operador Id Field -->
                <div class="col-sm">
                    {!! Form::label('operador_id', __('models/producaos.fields.qtd_diario').':') !!}
                    {{ $ordem->qtd_diario}}
                </div>
            </div>
        </div>

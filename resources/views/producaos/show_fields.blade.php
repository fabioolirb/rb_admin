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
                    {{ $ordem->data }}
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
                    <b>{{ $ordem->turnos_nome }}</b>
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

                        <div class='col-5'>

                                <img src='{{url('')}}/storage/{{$dados['link']}}' alt='{{$dados['produto_nome']}}' class='img-fluid card-img-top'>
                                <div class='p-4'><a href='#' class='text-dark'>{{$dados->imagem_produtos_nome}}</a></br>
                                    @php
                                        $info = '' ;
                                        $info_referencia = '';
                                    @endphp

                                    @foreach ($dados->info as $produto)
                                         @php
                                           $info = $info . "&nbsp;<span class='border border-dark' style='background:" . $produto->cor . " !important'>&nbsp;&nbsp;&nbsp;&nbsp;</span>" ;
                                           $info_referencia = $info_referencia . $produto->cors_referencia . ", " ;
                                         @endphp
                                     @endforeach

                                    <p class='small text-muted mb-0'> @php echo $info .'<br>'. $info_referencia; @endphp <br><b>Prazo:</b>{{$dados->prazo}}&nbsp;&nbsp;<b>Estoque:</b> 0 &nbsp;&nbsp;<b>Formas:</b> 1 </p>
                                    @php
                                      $info = '' ;
                                      $info_referencia = '';
                                    @endphp
                                </div>
                        </div>
                    @endforeach
                    <div class='col-2'>
                        </br>
                        @foreach($dataproducao as $datas)
                            <h7> {{$datas}} |______</h7></br>
                            @php
                                if($index >=20){
                                   echo "</div><div class='col-2'></br>";
                                   $index = 0;
                                }else{
                                  $index++;
                                }
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row bg-light">
                <!-- Maquina Id Field -->
                <div class="col-sm">
                    {!! Form::label('maquina_id', __('models/producaos.fields.data_ini').':') !!}
                    {{$ordem->data_ini}}
                </div>

                <!-- Turno Id Field -->
                <div class="col-sm">
                    {!! Form::label('turno_id', __('models/producaos.fields.data_end').':') !!}
                    {{$ordem->data_end}}
                </div>

                <!-- Operador Id Field -->
                <div class="col-sm">
                    {!! Form::label('operador_id', __('models/producaos.fields.qtd_diario').':') !!}
                    {{ $ordem->qtd_diario}}
                </div>
            </div>
        </div>

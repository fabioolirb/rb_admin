<!-- Id Field -->

<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">Maquinas Em Produção</h6>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Máquinas</th>
                    <th scope="col">Cores</th>
                    <th scope="col">Item</th>
                    <th scope="col">Cores</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($maquinas as $key_maquinas=>$value_maquinas)

                    <tr>
                        <th scope="row">{{$key_maquinas}}</th>
                        <td>
                            {{$rs_maquina[$key_maquinas]['maquina_nome']}} <br>
                            @foreach($rs_maquina[$key_maquinas]['produtos'] as $key_produto=>$value_produto)
                                    {{$value_produto}} <br>
                                    @foreach($rs_maquina[$key_maquinas]['produtos_cor'][$key_produto]['cores'] as $value_cor  )
                                        <span class='border border-dark' style='background:{{$value_cor}}!important'>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    @endforeach
                                    <br>
                            @endforeach

                        </td>
                        <td>
                            @foreach($value_maquinas as $value_cor)
                                &nbsp;<span class='border border-dark' style='background:{{$value_cor['cor']}}!important'>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            @endforeach
                        </td>

                        <td>
                            @foreach($order as $value_order)
                                   @php
                                       if(!empty($value_order['producao_in'])){
                                            if(array_key_exists($key_maquinas,$value_order['producao_in'])){
                                               echo $value_order['nome'].'<br />';
                                               $key_cor[] = $value_order['imagem_produtos_id'];
                                            }
                                       }
                                   @endphp
                            @endforeach
                        </td>
                        <td>

                            @foreach($key_cor as $value_cor)
                                @foreach($cor_imagem[$value_cor] as $value_cor_imagem)
                                    &nbsp;<span class='border border-dark' style='background:{{$value_cor_imagem['cor']}}!important'>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                @endforeach
                                <br />
                            @endforeach
                            @php
                                $key_cor = array();
                            @endphp
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <th scope="row">Produtos Fora das Máquinas</th>
                    <td>
                        @foreach($order as $value_order)
                            @php
                                if(empty($value_order['producao_in'])){
                                        echo $value_order['nome'].'<br />';
                                        $key_cor[] = $value_order['imagem_produtos_id'];
                                }
                            @endphp
                        @endforeach
                    </td>
                    <td>

                        @foreach($key_cor as $value_cor)

                            @foreach($cor_imagem[$value_cor] as $value_cor_imagem)
                                &nbsp;<span class='border border-dark' style='background:{{$value_cor_imagem['cor']}}!important'>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            @endforeach
                            <br />
                        @endforeach
                        @php
                            $key_cor = array();
                        @endphp
                    </td>

                    <td>-</td>
                    <td>-</td>

                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>



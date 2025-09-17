<div class="tab-content">
    <ul class="nav nav-tabs" id="custom-tabs-operador-tab" role="tablist">
        @php
            $select = true;
            $link = 'active' ;
        @endphp

        @foreach ($producaoOperador as $key=> $value_Operador)
            <li class="nav-item">
                <a class="nav-link {{$link}}" id="custom-tabs-one-operador{{str_replace('/','',$key)}}-tab" data-toggle="pill" href="#custom-tabs-one-operador{{str_replace('/','',$key)}}" role="tab" aria-controls="custom-tabs-one-producao{{str_replace('/','',$key)}}" aria-selected="{{$select}}"><h6>{{$key}}</h6></a>
            </li>
            @php
                $select = false;
                $link = '' ;
            @endphp
        @endforeach
    </ul>

    @php
        $arial = 'active show';
    @endphp

    @foreach ($producaoOperador as $key=> $value_Operador)
        <div class="tab-pane fade {{$arial}}" id="custom-tabs-one-operador{{str_replace('/','',$key)}}" role="tablist" aria-labelledby="custom-tabs-one-operador-tab{{str_replace('/','',$key)}}">
            <div class="card-body">
                <canvas id="producaoOperadorChart{{str_replace('/','',$key)}}" height="315" style="height: 180px; display: block; width: 462px;" width="808" class="chartjs-render-monitor"></canvas>
                <!-- /.row -->
            </div>
            <!-- ./card-body -->
        </div>
        @php
            $select = false;
            $arial = '';
        @endphp

    @endforeach
</div>

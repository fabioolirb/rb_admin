<div class="tab-content">
    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
        @php
            $select = true;
            $link = 'active' ;
        @endphp

        @foreach ($TotalPecasMontagemDia as $key=> $value_MontagemDia)
            <li class="nav-item">
                <a class="nav-link {{$link}}" id="custom-tabs-one-MontagemDia{{str_replace('/','',$key)}}-tab" data-toggle="pill" href="#custom-tabs-one-MontagemDia{{str_replace('/','',$key)}}" role="tab" aria-controls="custom-tabs-one-pecasretorno{{str_replace('/','',$key)}}" aria-selected="{{$select}}"><h6>{{$key}}</h6></a>
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

    @foreach ($TotalPecasMontagemDia as $key=> $value_MontagemDia)
        <div class="tab-pane fade {{$arial}}" id="custom-tabs-one-MontagemDia{{str_replace('/','',$key)}}" role="tablist" aria-labelledby="custom-tabs-one-MontagemDia-tab{{str_replace('/','',$key)}}">
            <div class="card-body">
                <canvas id="TotalPecasMontagemDiaChart{{str_replace('/','',$key)}}" height="315" style="height: 180px; display: block; width: 462px;" width="808" class="chartjs-render-MontagemDia"></canvas>
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

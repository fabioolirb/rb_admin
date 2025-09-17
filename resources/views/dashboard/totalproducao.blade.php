<div class="tab-content">
    <ul class="nav nav-tabs" id="custom-tabs-totalproducao-tab" role="tablist">
        @php
            $select = true;
            $link = 'active' ;
        @endphp

        @foreach ($totalProducao as $key=> $value_tdoproducao)
            <li class="nav-item">
                <a class="nav-link {{$link}}" id="custom-tabs-one-tdoproducao{{str_replace('/','',$key)}}-tab" data-toggle="pill" href="#custom-tabs-one-tdoproducao{{str_replace('/','',$key)}}" role="tab" aria-controls="custom-tabs-one-tdoproducao{{str_replace('/','',$key)}}" aria-selected="{{$select}}"><h6>{{$key}}</h6></a>
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

    @foreach ($totalProducao as $key1=> $value_tdoproducao)
        <div class="tab-pane fade {{$arial}}" id="custom-tabs-one-tdoproducao{{str_replace('/','',$key1)}}" role="tablist" aria-labelledby="custom-tabs-one-tdoproducao-tab{{str_replace('/','',$key1)}}">
            <div class="card-body">
                <canvas id="totalProducaoChart{{str_replace('/','',$key1)}}" height="315" style="height: 180px; display: block; width: 462px;" width="808" class="chartjs-render-monitor"></canvas>
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

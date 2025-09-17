<div class="tab-content">
    <ul class="nav nav-tabs" id="custom-tabs-montagem-tab" role="tablist">
        @php
            $select = true;
            $link = 'active' ;
        @endphp

        @foreach ($TotalMontagem as $key=> $value_montagem)
            <li class="nav-item">
                <a class="nav-link {{$link}}" id="custom-tabs-one-montagem{{str_replace('/','',$key)}}-tab" data-toggle="pill" href="#custom-tabs-one-montagem{{str_replace('/','',$key)}}" role="tab" aria-controls="custom-tabs-one-montagem{{str_replace('/','',$key)}}" aria-selected="{{$select}}"><h6>{{$key}}</h6></a>
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

    @foreach ($TotalMontagem as $key=> $value_montagem)
        <div class="tab-pane fade {{$arial}}" id="custom-tabs-one-montagem{{str_replace('/','',$key)}}" role="tablist" aria-labelledby="custom-tabs-one-montagem-tab{{str_replace('/','',$key)}}">
            <div class="card-body">
                <canvas id="TotalMontagemChart{{str_replace('/','',$key)}}" height="315" style="height: 180px; display: block; width: 462px;" width="808" class="chartjs-render-montagem"></canvas>
            </div>
        </div>
        @php
            $select = false;
            $arial = '';
        @endphp

    @endforeach
</div>

<div class="tab-content">
    <ul class="nav nav-tabs" id="custom-tabs-montadores-tab" role="tablist">
        @php
            $select = true;
            $link = 'active' ;
        @endphp

        @foreach ($TotalMontadores as $key=> $value_montador)
            <li class="nav-item">
                <a class="nav-link {{$link}}" id="custom-tabs-one-montadores{{str_replace('/','',$key)}}-tab" data-toggle="pill" href="#custom-tabs-one-montadores{{str_replace('/','',$key)}}" role="tab" aria-controls="custom-tabs-one-montadores{{str_replace('/','',$key)}}" aria-selected="{{$select}}"><h6>{{$key}}</h6></a>
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

    @foreach ($TotalMontadores as $key=> $value_montador)
        <div class="tab-pane fade {{$arial}}" id="custom-tabs-one-montadores{{str_replace('/','',$key)}}" role="tablist" aria-labelledby="custom-tabs-one-montadores-tab{{str_replace('/','',$key)}}">
            <span class="info-box-text">Peças por Montadores  ( {{$value_montador['qtd']}} )</span>
            <div class="card-body">
                <canvas id="TotalMontadoresChart{{str_replace('/','',$key)}}" height="315" style="height: 180px; display: block; width: 462px;" width="808" class="chartjs-render-montadores"></canvas>
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

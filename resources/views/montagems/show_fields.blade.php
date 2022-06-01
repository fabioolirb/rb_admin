<!-- Id Field -->

@php
//dd($montadora->nome,$montadora->fone,$status_montagem->nome);
@endphp
<div class="container card-header">
    <div class="row">
        <div class="col-sm-1 table-bordered" style="margin-top: auto; margin-bottom: auto">
            <h2>Nº{{ $montagem->id }}</h2>
        </div>
        <!-- Data Envio Field -->
        <div class="col-sm">
            {!! Form::label('data_envio', __('models/montagems.fields.data_envio').':') !!}
            {{ empty($montagem->data_envio) ? '__/__/___': $montagem->data_envio->format('d/m/Y') }}
      <br>
            {!! Form::label('data_retorno', __('models/montagems.fields.data_retorno').':') !!}
            {{ empty($montagem->data_retorno) ? '__/__/___': $montagem->data_retorno->format('d/m/Y') }}

        </div>

        <!-- Montadora Id Field -->
        <div class="col-sm">
            {!! Form::label('status_montagem_id', __('models/montagems.fields.status_montagem_id').':') !!}
            {{ $status_montagem->nome}}
        </br>
            {!! Form::label('montadora_id', __('models/montagems.fields.montadora_id').':') !!}
            <p>{{ $montadora->nome . ' - ' . $montadora->fone  }}</p>
        </div>
        <!-- Created At Field -->
        <div class="col-sm">
            {!! Form::label('created_at', __('models/montagems.fields.created_at').':') !!}
            <p>{{ $montagem->created_at->format('d/m/Y') }}</p>
        </br>
            {!! Form::label('updated_at', __('models/montagems.fields.updated_at').':') !!}
            <p>{{ $montagem->updated_at->format('d/m/Y') }}</p>
        </div>
    </div>
</div>
<div class="container-fluid"><br></div>

<div class="container">
    <div class="row table-bordered">
        <div class="col-sm"><b> Produto </b></div>
        <div class="col-sm"><b>Quantidade</b></div>
        <div class="col-sm"><b>Montados</b></div>
        <div class="col-sm"><b>Retornados</b></div>
    </div>

    @foreach($montagem->produto as $itens)
        <div class="row table-bordered">
            <div class="col-sm">{{$itens->nome}}</div>
            <div class="col-sm">{{$itens->pivot->quantidade}}</div>
            <div class="col-sm">_________</div>
            <div class="col-sm">_________</div>
        </div>
    @endforeach
</div>
<div class="container-fluid"><br></div>
<div class="container card-header">
    <div class="row">
        <div class="col-sm"><b>Total de itens : </b> {{$montagem->itens_Qtd}}</div>
        <div class="col-sm"><b>Total de peça' </b> {{$montagem->itens_total}}</div>
        <div class="col-sm">_________</div>
        <div class="col-sm">_________</div>
    </div>
</div>
@php
//dd($montagem->itens_Qtd,$montagem->itens_total)
@endphp



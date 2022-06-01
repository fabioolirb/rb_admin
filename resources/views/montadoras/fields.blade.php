<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', __('models/montadoras.fields.nome').':') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Ddd Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ddd', __('models/montadoras.fields.ddd').':') !!}
    {!! Form::number('ddd', null, ['class' => 'form-control']) !!}
</div>

<!-- Fone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fone', __('models/montadoras.fields.fone').':') !!}
    {!! Form::number('fone', null, ['class' => 'form-control']) !!}
</div>

<!-- Contrato Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contrato', __('models/montadoras.fields.contrato').':') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('contrato', ['class' => 'custom-file-input']) !!}
            {!! Form::label('contrato', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>


<!-- Logradouro Field -->
<div class="form-group col-sm-6">
    {!! Form::label('logradouro', __('models/montadoras.fields.logradouro').':') !!}
    {!! Form::text('logradouro', null, ['class' => 'form-control']) !!}
</div>

<!-- Bairro Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bairro', __('models/montadoras.fields.bairro').':') !!}
    {!! Form::text('bairro', null, ['class' => 'form-control']) !!}
</div>

<!-- Nr Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nr', __('models/montadoras.fields.nr').':') !!}
    {!! Form::text('nr', null, ['class' => 'form-control']) !!}
</div>

<!-- Cidade Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cidade_id', __('models/montadoras.fields.cidade_id').':') !!}
    {!! Form::select('cidade_id', $cidades, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Estado Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado_id', __('models/montadoras.fields.estado_id').':') !!}
    {!! Form::select('estado_id', $estados, null, ['class' => 'form-control custom-select']) !!}
</div>
@section('scripts')
    <script>
        $(document).ready(function(){
            $('#fone').mask('9 9999-9999');
        });

        $(document).ready(function(){
            $('#ddd').mask('(99)');
        });
    </script>
@endsection

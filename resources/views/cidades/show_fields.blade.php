<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/cidades.fields.id').':') !!}
    <p>{{ $cidade->id }}</p>
</div>

<!-- Nome Field -->
<div class="col-sm-12">
    {!! Form::label('nome', __('models/cidades.fields.nome').':') !!}
    <p>{{ $cidade->nome }}</p>
</div>

<!-- Ibge Field -->
<div class="col-sm-12">
    {!! Form::label('ibge', __('models/cidades.fields.ibge').':') !!}
    <p>{{ $cidade->ibge }}</p>
</div>

<!-- Estado Id Field -->
<div class="col-sm-12">
    {!! Form::label('estado_id', __('models/cidades.fields.estado_id').':') !!}
    <p>{{ $cidade->estado_id }}</p>
</div>


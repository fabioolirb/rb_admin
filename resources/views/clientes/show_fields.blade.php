<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/clientes.fields.id').':') !!}
    <p>{{ $cliente->id }}</p>
</div>

<!-- Nome Cliente Field -->
<div class="col-sm-12">
    {!! Form::label('nome_cliente', __('models/clientes.fields.nome_cliente').':') !!}
    <p>{{ $cliente->nome_cliente }}</p>
</div>

<!-- Responsavel Cliente Field -->
<div class="col-sm-12">
    {!! Form::label('responsavel_cliente', __('models/clientes.fields.responsavel_cliente').':') !!}
    <p>{{ $cliente->responsavel_cliente }}</p>
</div>

<!-- Documento Cliente Field -->
<div class="col-sm-12">
    {!! Form::label('documento_cliente', __('models/clientes.fields.documento_cliente').':') !!}
    <p>{{ $cliente->documento_cliente }}</p>
</div>

<!-- Contato Cliente Field -->
<div class="col-sm-12">
    {!! Form::label('contato_cliente', __('models/clientes.fields.contato_cliente').':') !!}
    <p>{{ $cliente->contato_cliente }}</p>
</div>

<!-- Contato2 Cliente Field -->
<div class="col-sm-12">
    {!! Form::label('contato2_cliente', __('models/clientes.fields.contato2_cliente').':') !!}
    <p>{{ $cliente->contato2_cliente }}</p>
</div>

<!-- Id Endereco Cliente Field -->
<div class="col-sm-12">
    {!! Form::label('id_endereco_cliente', __('models/clientes.fields.id_endereco_cliente').':') !!}
    <p>{{ $cliente->id_endereco_cliente }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/clientes.fields.created_at').':') !!}
    <p>{{ $cliente->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/clientes.fields.updated_at').':') !!}
    <p>{{ $cliente->updated_at }}</p>
</div>


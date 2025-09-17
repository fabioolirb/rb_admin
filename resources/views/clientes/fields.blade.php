<!-- Nome Cliente Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome_cliente', __('models/clientes.fields.nome_cliente').':') !!}
    {!! Form::text('nome_cliente', null, ['class' => 'form-control']) !!}
</div>

<!-- Responsavel Cliente Field -->
<div class="form-group col-sm-6">
    {!! Form::label('responsavel_cliente', __('models/clientes.fields.responsavel_cliente').':') !!}
    {!! Form::text('responsavel_cliente', null, ['class' => 'form-control']) !!}
</div>

<!-- Documento Cliente Field -->
<div class="form-group col-sm-6">
    {!! Form::label('documento_cliente', __('models/clientes.fields.documento_cliente').':') !!}
    {!! Form::text('documento_cliente', null, ['class' => 'form-control']) !!}
</div>

<!-- Contato Cliente Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contato_cliente', __('models/clientes.fields.contato_cliente').':') !!}
    {!! Form::text('contato_cliente', null, ['class' => 'form-control']) !!}
</div>

<!-- Contato2 Cliente Field -->
<div class="form-group col-sm-12">
    {!! Form::label('contato2_cliente', __('models/clientes.fields.contato2_cliente').':') !!}
    {!! Form::text('contato2_cliente', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Endereco Cliente Field
<div class="form-group col-sm-6">
    {!! Form::label('id_endereco_cliente', __('models/clientes.fields.id_endereco_cliente').':') !!}
    {!! Form::select('id_endereco_cliente', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
</div>
-->

<div class="card-body">
    <div class="row bg-light">
        @include('endereco_clientes.fields')
    </div>
</div>

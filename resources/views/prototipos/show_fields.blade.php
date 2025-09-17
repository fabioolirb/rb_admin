<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/prototipos.fields.id').':') !!}
    <p>{{ $prototipos->id }}</p>
</div>

<!-- Desc Prototipo Field -->
<div class="col-sm-12">
    {!! Form::label('desc_prototipo', __('models/prototipos.fields.desc_prototipo').':') !!}
    <p>{{ $prototipos->desc_prototipo }}</p>
</div>

<!-- Id Imagem Produto Field -->
<div class="col-sm-12">
    {!! Form::label('id_imagem_produto', __('models/prototipos.fields.id_imagem_produto').':') !!}
    <p>{{ $prototipos->id_imagem_produto }}</p>
</div>

<!-- Id Cliente Field -->
<div class="col-sm-12">
    {!! Form::label('id_cliente', __('models/prototipos.fields.id_cliente').':') !!}
    <p>{{ $prototipos->id_cliente }}</p>
</div>

<!-- Id Ilustrador Field -->
<div class="col-sm-12">
    {!! Form::label('id_ilustrador', __('models/prototipos.fields.id_ilustrador').':') !!}
    <p>{{ $prototipos->id_ilustrador }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/prototipos.fields.created_at').':') !!}
    <p>{{ $prototipos->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/prototipos.fields.updated_at').':') !!}
    <p>{{ $prototipos->updated_at }}</p>
</div>


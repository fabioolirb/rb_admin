{!! Form::open(['route' => ['producaos.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>

    {!! Form::button('<i class="fa fa-ban"></i>', [
        'class' => 'badge badge-info badge-xs',
        'value' => $ordem_id,
        'id'=> 'st_'.$ordem_id,
        'onclick' => 'return check("'.$ordem_id.'")'
    ]) !!}

    <a href="{{ route('producaos.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('producaos.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'badge badge-danger badge-xs',
        'onclick' => 'return confirm("'.__('crud.are_you_sure').'")'
    ]) !!}
</div>

{!! Form::close() !!}

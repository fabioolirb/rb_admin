<div class="table-responsive">
    <table class="table" id="turnos-table">
        <thead>
        <tr>
            <th>@lang('models/turnos.fields.id')</th>
        <th>@lang('models/turnos.fields.nome')</th>
            <th colspan="3">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
         @foreach($turnos as $turno)
            <tr>
                <td>{{ $turno->id }}</td>
            <td>{{ $turno->nome }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['turnos.destroy', $turno->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('turnos.show', [$turno->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('turnos.edit', [$turno->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
         @endforeach
        </tbody>
    </table>
</div>

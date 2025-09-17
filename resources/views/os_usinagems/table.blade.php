<div class="table-responsive">
    <table class="table" id="osUsinagems-table">
        <thead>
        <tr>
            <th>@lang('models/osUsinagems.fields.id_cnc')</th>
        <th>@lang('models/osUsinagems.fields.id_prototipo')</th>
        <th>@lang('models/osUsinagems.fields.data_ini')</th>
        <th>@lang('models/osUsinagems.fields.data_fim')</th>
            <th colspan="3">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
         @foreach($osUsinagems as $osUsinagem)
            <tr>
                <td>{{ $osUsinagem->id_cnc }}</td>
            <td>{{ $osUsinagem->id_prototipo }}</td>
            <td>{{ $osUsinagem->data_ini }}</td>
            <td>{{ $osUsinagem->data_fim }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['osUsinagems.destroy', $osUsinagem->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('osUsinagems.show', [$osUsinagem->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('osUsinagems.edit', [$osUsinagem->id]) }}"
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

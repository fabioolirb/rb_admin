@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                     @lang('models/producaos.singular')
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card card-header">


            {!! Form::open(['route' => 'producaos.store','name'=>'formOrdem','class'=>'needs-validation']) !!}

            <div class="card-body">
                <div class="row">
                    @include('producaos.fields')
                </div>
            </div>

            {{--
            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('producaos.index') }}" class="btn btn-default">
            @lang('crud.cancel')
                </a>
        </div>

        --}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection

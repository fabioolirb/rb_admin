@extends('layouts.app')

@push('page_scripts')
        <script>
            function check(id){
                $.ajax({
                    url: '/admin/producaos/finaliza',
                    method: 'POST',
                    //dataType: 'json',
                    data: {order_id:id},
                    success: function(response){
                        toastr.info('Status da ordem  <b>'+id+'</b> Finalizado!!');
                    }
                });
            }
        </script>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                   @lang('models/producaos.plural')
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('producaos.create') }}">
                         @lang('crud.add_new')
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('producaos.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>@lang('opencart.fields.update_order_status')</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('opencart.update_order_status') }}" method="POST" class="mb-4">
            @csrf
            <div class="form-group">
                <label for="update_order_id">@lang('opencart.fields.order_id')</label>
                <input type="number" class="form-control" id="update_order_id" name="order_id" required>
            </div>
            <div class="form-group">
                <label for="order_status_id">@lang('opencart.fields.order_status_id')</label>
                <input type="number" class="form-control" id="order_status_id" name="order_status_id" required>
                <small class="form-text text-muted">@lang('opencart.fields.refer_status_docs')</small>
            </div>
            <div class="form-group">
                <label for="comment">@lang('opencart.fields.comment_optional')</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="notify" name="notify" value="1">
                <label class="form-check-label" for="notify">@lang('opencart.fields.notify_customer')</label>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="override" name="override" value="1">
                <label class="form-check-label" for="override">@lang('opencart.fields.override')</label>
            </div>
            <button type="submit" class="btn btn-warning">@lang('opencart.fields.update_status')</button>
        </form>
    </div>
@endsection

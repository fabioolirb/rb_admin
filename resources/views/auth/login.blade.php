@extends('layouts.full')
@push('page_body_class')
hold-transition login-page
@endpush

@section('content')

<div class="login-box">
    <div>
        <h2 style="text-align: center !important;"><a href="{{ route('home') }}"><b>{{ config('app.name') }}</b></a></h2>
    <!-- /.login-logo -->

    <!-- /.login-box-body -->
    <div class="container">
        <div class="card">

        <div class="card-body">
           <!-- <p class="login-box-msg">@lang('auth.login.title')</p> -->

            <form method="post" action="{{ url('/login') }}">
                @csrf

                <div class="input-group mb-3">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="@lang('auth.login.field.email')" class="form-control @error('email') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                    @error('email')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password" placeholder="@lang('auth.login.field.password')" class="form-control @error('password') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>

                <div class="row">
                    <div class="col">
                            <button type="submit" class="btn btn-primary btn-block">@lang('auth.login.button.submit')</button>
                    </div>
                </div>

                <div class="row">
                    <div class="form-check mb-3">
                        <input type="checkbox" id="remember">
                        <label for="remember">@lang('auth.login.field.remember')</label>
                    </div>
                </div>
            </form>
            <div class="container">
                <div class="row" >
                    <div class="col" >
                        <a href="{{ route('password.request') }}">@lang('auth.login.button.reset-password')</a>
                    </div>
                    <div class="col" >
                        <a href="{{ route('register') }}" class="text-center">@lang('auth.login.button.register')</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.login-card-body -->
    </div>
    </div>
    </div>
    @include('layouts.lang')
</div>
<!-- /.login-box -->
@endsection

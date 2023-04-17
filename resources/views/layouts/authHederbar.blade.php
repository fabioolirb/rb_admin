<div class="navbar navbar-dark navbar-static py-2">
    <div class="container-fluid">
        <div class="navbar-brand">
            <a href="index" class="d-inline-flex align-items-center">
                <img src={{url('images/logo.png')}} alt="">
                <img src="http://limitless-layout-default.laravel.themesbrand.com/assets/images/logo_text_light.svg" class="d-none d-sm-inline-block h-16px ms-3" alt="">
            </a>
        </div>

        <div class="d-flex justify-content-end align-items-center ms-auto">
            <ul class="navbar-nav flex-row">
                <li class="nav-item">
                    <a href="#" class="navbar-nav-link navbar-nav-link-icon rounded ms-1">
                        <div class="d-flex align-items-center mx-md-1">
                            <i class="ph-lifebuoy"></i>
                            <span class="d-none d-md-inline-block ms-2"><a href="{{ route('password.request') }}">@lang('auth.login.button.reset-password')</a></span>

                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="http://limitless-layout-default.laravel.themesbrand.com/login" class="navbar-nav-link navbar-nav-link-icon rounded ms-1">
                        <div class="d-flex align-items-center mx-md-1">
                            <i class="fa-light fa-person"></i>
                            <span class="d-none d-md-inline-block ms-2"> <a href="{{ route('login') }}" class="text-center">@lang('auth.register.button.login')</a></span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="http://limitless-layout-default.laravel.themesbrand.com/register" class="navbar-nav-link navbar-nav-link-icon rounded ms-1">
                        <div class="d-flex align-items-center mx-md-1">
                            <i class="ph-user-circle-plus"></i>
                            <span class="d-none d-md-inline-block ms-2"><a href="{{ route('register') }}" class="text-center">@lang('auth.login.button.register')</a></span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

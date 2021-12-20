@php
$urlAdmin=config('fast.admin_prefix');
@endphp

@can('dashboard')
@php
$isDashboardActive = Request::is($urlAdmin);
@endphp
<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ $isDashboardActive ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>@lang('menu.dashboard')</p>
    </a>
</li>
@endcan

@can('generator_builder.index')
@php
$isUserActive = Request::is($urlAdmin.'*generator_builder*');
@endphp
<li class="nav-item">
    <a href="{{ route('generator_builder.index') }}" class="nav-link {{ $isUserActive ? 'active' : '' }}">
        <i class="nav-icon fas fa-coins"></i>
        <p>@lang('menu.generator_builder.title')</p>
    </a>
</li>
@endcan

@can('attendances.index')
@php
$isUserActive = Request::is($urlAdmin.'*attendances*');
@endphp

<li class="nav-item">
    <a href="{{ route('attendances.index') }}" class="nav-link {{ $isUserActive ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>@lang('menu.attendances.title')</p>
    </a>
</li>
@endcan

@canany(['users.index','roles.index','permissions.index'])
@php
$isUserActive = Request::is($urlAdmin.'*users*');
$isRoleActive = Request::is($urlAdmin.'*roles*');
$isPermissionActive = Request::is($urlAdmin.'*permissions*');
@endphp
<li class="nav-item {{($isUserActive||$isRoleActive||$isPermissionActive)?'menu-open':''}} ">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-shield-virus"></i>
        <p>
            @lang('menu.user.title')
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        @can('users.index')
        <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link {{ $isUserActive ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    @lang('menu.user.users')
                </p>
            </a>
        </li>
        @endcan
        @can('roles.index')
        <li class="nav-item">
            <a href="{{ route('roles.index') }}" class="nav-link {{ $isRoleActive ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    @lang('menu.user.roles')
                </p>
            </a>
        </li>
        @endcan
        @can('permissions.index')
        <li class="nav-item ">
            <a href="{{ route('permissions.index') }}" class="nav-link {{ $isPermissionActive ? 'active' : '' }}">
                <i class="nav-icon fas fa-shield-alt"></i>
                <p>
                    @lang('menu.user.permissions')
                </p>
            </a>
        </li>
        @endcan
    </ul>
</li>
@endcan
@can('fileUploads.index')
<li class="nav-item">
    <a href="{{ route('fileUploads.index') }}" class="nav-link {{ Request::is('fileUploads*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>@lang('models/fileUploads.plural')</p>
    </a>
</li>
@endcan

@canany(['estado.index','cidade.index','cor.index'])
    @php
        $isEstadoActive = Request::is($urlAdmin.'*estado*');
        $isCidadeActive = Request::is($urlAdmin.'*cidade*');
        $isCorActive = Request::is($urlAdmin.'*cor*');
        $isMaquinaActive =  Request::is($urlAdmin.'*maquina*');
        $isTurnoActive =  Request::is($urlAdmin.'*turno*');
        $isCategoriaActive =  Request::is($urlAdmin.'*categoria*');
        $isProdutoActive =  Request::is($urlAdmin.'*produto*');
        $isOperadorActive =  Request::is($urlAdmin.'*operador*');
       // $isOperadorActive =  Request::is($urlAdmin.'*cor*');
      //  $isOperadorActive =  Request::is($urlAdmin.'*cor*');
      //  $isOperadorActive =  Request::is($urlAdmin.'*cor*');

    @endphp
    <li class="nav-item {{($isEstadoActive||$isCidadeActive||$isCorActive||$isMaquinaActive||$isTurnoActive||$isCategoriaActive||$isProdutoActive||$isOperadorActive)?'menu-open':''}} ">
        <a href="#" class="nav-link">
            <i class="fa fa-gears nav-icon"></i>
            <p>
                Sistema
                <i class="fas fa-angle-left right"></i>

            </p>
        </a>
        <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{ route('estados.index') }}"
                       class="nav-link {{ Request::is('estados*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>@lang('models/estados.plural')</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cidades.index') }}"
                       class="nav-link {{ Request::is('cidades*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>@lang('models/cidades.plural')</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cors.index') }}"
                       class="nav-link {{ Request::is('cors*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>@lang('models/cors.plural')</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('operadors.index') }}"
                       class="nav-link {{ Request::is('operadors*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>@lang('models/operadors.plural')</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('maquinas.index') }}"
                       class="nav-link {{ Request::is('maquinas*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>@lang('models/maquinas.plural')</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('turnos.index') }}"
                       class="nav-link {{ Request::is('turnos*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>@lang('models/turnos.plural')</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('categorias.index') }}"
                       class="nav-link {{ Request::is('categorias*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>@lang('models/categorias.plural')</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('produtos.index') }}"
                       class="nav-link {{ Request::is('produtos*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>@lang('models/produtos.plural')</p>
                    </a>
                </li>

        </ul>
    </li>
@endcan

<li class="nav-item">
    <a href="{{ route('imagemProdutos.index') }}"
       class="nav-link {{ Request::is('imagemProdutos*') ? 'active' : '' }}">
        <p>@lang('models/imagemProdutos.plural')</p>
    </a>
</li>


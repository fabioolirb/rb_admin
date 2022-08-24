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
//dd($isUserActive);
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
<!--
@can('fileUploads.index')
<li class="nav-item">
    <a href="{{ route('fileUploads.index') }}" class="nav-link {{ Request::is('fileUploads*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>@lang('models/fileUploads.plural')</p>
    </a>
</li>
@endcan
-->

    @php

        $isEstadoActive = Request::is($urlAdmin.'*estado*');
        $isCidadeActive = Request::is($urlAdmin.'*cidade*');
        $isCorActive = Request::is($urlAdmin.'*cor*');
        $isMaquinaActive =  Request::is($urlAdmin.'*maquina*');
        $isTurnoActive =  Request::is($urlAdmin.'*turno*');
        $isCategoriaActive =  Request::is($urlAdmin.'*categoria*');
        $isProdutoActive =  Request::is($urlAdmin.'*produto*');
        $isOperadorActive =  Request::is($urlAdmin.'*operador*');
        $isImagemProdutosActive =  Request::is($urlAdmin.'*imagemProdutos*');
        $isStatusOrdemsActive = Request::is($urlAdmin.'*statusOrdem*');
        $isStatusMontadoraActive= Request::is($urlAdmin.'*statusMontadoras*');
        $isStatusMontagemActive= Request::is($urlAdmin.'*statusMontagems*');
        $isOredems = Request::is($urlAdmin.'*ordems*');
        $isProducaes = Request::is($urlAdmin.'*producaos*');
        $isMontadore =  Request::is($urlAdmin.'*montadoras*');
        $isEstoque = Request::is($urlAdmin.'*estoques*');
        $isMontagemsActive = Request::is($urlAdmin.'*montagems*');

        //  $isOperadorActive =  Request::is($urlAdmin.'*cor*');
      //  $isOperadorActive =  Request::is($urlAdmin.'*cor*');

    @endphp
@canany(['ordems.index','producaos.index','Estoque.index'])

    <li class="nav-item {{($isOredems||$isProducaes||$isEstoque)?'menu-open':''}} ">
        <a href="#" class="nav-link">
            <i class="fa fa-ethernet nav-icon"></i>
            <p>
                CRM
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('ordems.index') }}"
                   class="nav-link {{ $isOredems ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('models/ordems.plural')</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('producaos.index') }}"
                   class="nav-link {{  Request::is('*producaos*') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('models/producaos.plural')</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('estoques.index') }}"
                   class="nav-link {{ Request::is('*estoques*') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('models/estoques.plural')</p>
                </a>
            </li>
        </ul>
    </li>
@endcan

@canany(['estados.index','cidades.index','cors.index','operadors.index','maquinas.index','turnos.index','statusOrdems.index'])
    <li class="nav-item {{($isStatusOrdemsActive|| $isEstadoActive||$isCidadeActive||$isCorActive||$isMaquinaActive||$isTurnoActive||$isOperadorActive)?'menu-open':''}} ">
        <a href="#" class="nav-link">
            <i class="fa fa-gears nav-icon"></i>
            <p>
                Sistema
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item {{($isStatusOrdemsActive||$isStatusMontagemActive||$isEstadoActive||$isCidadeActive||$isCorActive||$isMaquinaActive||$isTurnoActive||$isOperadorActive)?'menu-open':''}} ">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                        Parâmetros
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @canany(['estados.index'])
                    <li class="nav-item">
                        <a href="{{ route('estados.index') }}"
                           class="nav-link {{ Request::is('*estados*') ? 'active' : '' }}">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>@lang('models/estados.plural')</p>
                        </a>
                    </li>
                    @endcan
                    @canany(['cidades.index'])
                    <li class="nav-item">
                        <a href="{{ route('cidades.index') }}"
                           class="nav-link {{ Request::is('*cidades*') ? 'active' : '' }}">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>@lang('models/cidades.plural')</p>
                        </a>
                    </li>
                    @endcan
                    @canany(['cors.index'])
                    <li class="nav-item">
                        <a href="{{ route('cors.index') }}"
                           class="nav-link {{ Request::is('*cors*') ? 'active' : '' }}">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>@lang('models/cors.plural')</p>
                        </a>
                    </li>
                    @endcan
                    @canany(['operadors.index'])
                    <li class="nav-item">
                        <a href="{{ route('operadors.index') }}"
                           class="nav-link {{ Request::is('*operadors*') ? 'active' : '' }}">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>@lang('models/operadors.plural')</p>
                        </a>
                    </li>
                    @endcan
                    @canany(['maquinas.index'])
                    <li class="nav-item">
                        <a href="{{ route('maquinas.index') }}"
                           class="nav-link {{ Request::is('*maquinas*') ? 'active' : '' }}">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>@lang('models/maquinas.plural')</p>
                        </a>
                    </li>
                    @endcan
                    @canany(['turnos.index'])
                    <li class="nav-item">
                        <a href="{{ route('turnos.index') }}"
                           class="nav-link {{ Request::is('*turnos*') ? 'active' : '' }}">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>@lang('models/turnos.plural')</p>
                        </a>
                    </li>
                    @endcan
                    @canany(['statusOrdems.index'])
                    <li class="nav-item">
                        <a href="{{ route('statusOrdems.index') }}"
                           class="nav-link {{ Request::is('*statusOrdems*') ? 'active' : '' }}">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>@lang('models/statusOrdems.plural')</p>
                        </a>
                    </li>

                        @endcan
                </ul>
            </li>

        </ul>
    </li>
    @endcan
    @canany(['produtos.index','categorias.index','imagemProdutos.index'])
    <li class="nav-item {{($isProdutoActive||$isCategoriaActive||$isImagemProdutosActive)?'menu-open':''}} ">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-box"></i>
            <p>
                Produtos
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">

            @canany(['categorias.index'])
            <li class="nav-item">
                <a href="{{ route('categorias.index') }}"
                   class="nav-link {{ Request::is('*categorias*') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('models/categorias.plural')</p>
                </a>
            </li>
            @endcan
            @canany(['produtos.index'])
            <li class="nav-item">
                <a href="{{ route('produtos.index') }}"
                   class="nav-link {{ Request::is('*produtos*') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('models/produtos.plural')</p>
                </a>
            </li>
            @endcan
            @canany(['imagemProdutos.index'])
            <li class="nav-item">
                <a href="{{ route('imagemProdutos.index') }}"
                   class="nav-link {{ Request::is('*imagemProdutos*') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('models/imagemProdutos.plural')</p>
                </a>
            </li>
            @endcan
        </ul>
    </li>
    @endcan
    @canany(['montagems.index','montadoras.index','montadoras.index','statusMontadoras.index','statusMontagems.index'])
    <li class="nav-item {{($isStatusMontagemActive|| $isStatusMontadoraActive||$isMontagemsActive||$isStatusMontadoraActive||$isMontadore)?'menu-open':''}} ">
        <a href="#" class="nav-link">
            <i class="fa fa-cubes nav-icon"></i>
            <p>
                Montagem
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">

            @canany(['montagems.index'])
            <li class="nav-item">
                <a href="{{ route('montagems.index') }}"
                   class="nav-link {{ Request::is('*montagems*') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('models/montagems.plural')</p>
                </a>
            </li>
            @endcan
            @canany(['montadoras.index'])
            <li class="nav-item">
                <a href="{{ route('montadoras.index') }}"
                   class="nav-link {{ Request::is('*montadoras*') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('models/montadoras.plural')</p>
                </a>
            </li>
            @endcan
            @canany(['statusMontadoras.index'])
            <li class="nav-item">
                <a href="{{ route('statusMontadoras.index') }}"
                   class="nav-link {{ Request::is('*statusMontadoras*') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('models/statusMontadoras.plural')</p>
                </a>
            </li>
            @endcan
            @canany(['statusMontagems.index'])
            <li class="nav-item">
                <a href="{{ route('statusMontagems.index') }}"
                   class="nav-link {{ Request::is('*statusMontagems*') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('models/statusMontagems.plural')</p>
                </a>
            </li>
            @endcan
        </ul>
    </li>
    @endcan

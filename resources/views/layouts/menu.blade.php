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
{{--
@can('fileUploads.index')
<li class="nav-item">
    <a href="{{ route('fileUploads.index') }}" class="nav-link {{ Request::is('fileUploads*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>@lang('models/fileUploads.plural')</p>
    </a>
</li>
@endcan
--}}

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
        $isOredems = Request::is($urlAdmin.'*ordems');
        $isOredemsMaquina = Request::is($urlAdmin.'*maquina');
        $isProducaes = Request::is($urlAdmin.'*producaos*');
        $isMontadore =  Request::is($urlAdmin.'*montadoras*');
        $isEstoque = Request::is($urlAdmin.'*estoques*');
        $isMontagemsActive = Request::is($urlAdmin.'*montagems*');
        $isMatrizActive = Request::is($urlAdmin.'*matrizs*');
        $isCelulaActive = Request::is($urlAdmin.'*celulas*');
        $istipoArquivosActive = Request::is($urlAdmin.'*tipoArquivos*');
        $isenderecoClientesActive = Request::is($urlAdmin.'*enderecoClientes*');
        $isClientesActive = Request::is($urlAdmin.'*clientes*');
        $isArquivosActive = Request::is($urlAdmin.'*Arquivos*');
        $isMatrizsActive = Request::is($urlAdmin.'*matrizs*');
        $isPrototiposActive = Request::is($urlAdmin.'*prototipos*');
        $isIlustradorsActive = Request::is($urlAdmin.'*ilustradors*');
        $isiaPracaoActive = Request::is($urlAdmin.'*iaProducaos*');
        $isArquivoProdutosActive = Request::is($urlAdmin.'*arquivoProdutos*');


        //  $isOperadorActive =  Request::is($urlAdmin.'*cor*');
      //  $isOperadorActive =  Request::is($urlAdmin.'*cor*');

    @endphp
@canany(['ordems.index','producaos.index','Estoque.index','celulas.index','celulas.index','enderecoClientes.index','clientes.index','iaProducaos.index','ordems.maquina'])

    <li class="nav-item {{($isOredems||$isProducaes||$isEstoque||$isCelulaActive||$isenderecoClientesActive||$isClientesActive||$isiaPracaoActive||$isOredemsMaquina)?'menu-open':''}} ">
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
                <a href="{{ route('ordems.maquina') }}"
                   class="nav-link {{  Request::is('*maquina*') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('models/ordems.maquina')</p>
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
                <a href="{{ route('iaProducaos.index') }}"
                   class="nav-link {{ Request::is('iaProducaos*') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('models/iaProducaos.plural')</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('estoques.index') }}"
                   class="nav-link {{ Request::is('*estoques*') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('models/estoques.plural')</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('celulas.index') }}"
                   class="nav-link {{ Request::is('*celulas*') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('models/celulas.plural')</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('enderecoClientes.index') }}"
                   class="nav-link {{ Request::is('*enderecoClientes*') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('models/enderecoClientes.plural')</p>
                </a>
            </li>

            <li class="nav-item">s
                <a href="{{ route('clientes.index') }}"
                   class="nav-link {{ Request::is('*clientes*') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('models/clientes.plural')</p>
                </a>
            </li>
        </ul>
    </li>
@endcan

@canany(['estados.index','cidades.index','cors.index','operadors.index','maquinas.index','turnos.index','statusOrdems.index','arquivos.index','tipoArquivos.index'])
    <li class="nav-item {{($isStatusOrdemsActive|| $isEstadoActive||$isCidadeActive||$isCorActive||$isMaquinaActive||$isTurnoActive||$isOperadorActive||$istipoArquivosActive||$isArquivosActive)?'menu-open':''}} ">
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
                    @canany(['tipoArquivos.index'])
                    <li class="nav-item">
                        <a href="{{ route('tipoArquivos.index') }}"
                           class="nav-link {{ Request::is('tipoArquivos*') ? 'active' : '' }}">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>@lang('models/tipoArquivos.plural')</p>
                        </a>
                    </li>
                    @endcan
                    @canany(['arquivos.index'])
                    <li class="nav-item">
                        <a href="{{ route('arquivos.index') }}"
                           class="nav-link {{ Request::is('arquivos*') ? 'active' : '' }}">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>@lang('models/arquivos.plural')</p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>

        </ul>
    </li>
    @endcan
    @canany(['produtos.index','categorias.index','imagemProdutos.index','arquivoProdutos.index'])
    <li class="nav-item {{($isProdutoActive||$isCategoriaActive||$isImagemProdutosActive||$isArquivoProdutosActive)?'menu-open':''}} ">
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
            @canany(['arquivoProdutos.index'])
            <li class="nav-item">
                <a href="{{ route('arquivoProdutos.index') }}"
                class="nav-link {{ Request::is('*arquivoProdutos*') ? 'active' : '' }}">
                <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('models/arquivoProdutos.plural')</p>
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

    {{-- Menu de Relatórios --}}
    <li class="nav-item {{ Request::is('*relatorios*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
                Relatórios
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('relatorios.producao') }}" class="nav-link {{ Request::is('*relatorios/producao*') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Produção</p>
                </a>
            </li>
        </ul>
    </li>

    @canany(['matrizs.index'])

        <li class="nav-item {{($isMatrizActive||$isMatrizsActive||$isPrototiposActive||$isIlustradorsActive)?'menu-open':''}} ">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>Usinagem
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                 @canany(['matrizs.index'])
                <li class="nav-item {{($isMatrizActive)?'menu-open':''}}">
                    <a href="{{ route('matrizs.index') }}"
                       class="nav-link {{ Request::is('*matrizs*') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>@lang('models/matrizs.plural')</p>
                    </a>
                </li>
                 @endcan

                 <li class="nav-item">
                     <a href="{{ route('prototipos.index') }}"
                        class="nav-link {{ Request::is('*prototipos*') ? 'active' : '' }}">
                         <i class="far fa-dot-circle nav-icon"></i>
                         <p>@lang('models/prototipos.plural')</p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="{{ route('ilustradors.index') }}"
                        class="nav-link {{ Request::is('*ilustradors*') ? 'active' : '' }}">
                         <i class="far fa-dot-circle nav-icon"></i>
                         <p>@lang('models/ilustradors.plural')</p>
                     </a>
                 </li>

            </ul>
        </li>
    @endcanany
    

    {{-- OpenCart Integration Menu --}}
    <li class="nav-item {{ Request::is('admin/opencart*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-plug"></i> {{-- Icon for integration --}}
            <p>
                @lang('opencart.fields.integration')
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('opencart.index') }}" class="nav-link {{ Request::is('admin/opencart') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('opencart.fields.order_details_menu')</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('opencart.update_status_form') }}" class="nav-link {{ Request::is('admin/opencart/update-status') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>@lang('opencart.fields.update_status_menu')</p>
                </a>
            </li>
            {{-- Add more OpenCart services here as sub-menus --}}
        </ul>
    </li>





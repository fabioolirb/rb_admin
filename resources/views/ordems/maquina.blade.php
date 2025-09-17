@extends('layouts.app')

@push('styles')
    <style>
        .carousel-inner img {
            width: 10% !important;
            height: 10% !important;
        }
        .wrapper {
            width: 10%; /* largura do slider */
            margin: 0 auto;
        }
        .carousel .item {
        height: 20px; /* altura do slider */
        }
        .item img { /* centraliza imagem na vertical no slider */
            position: relative;
            top: 10%;
            transform: translateY(-50%);
        }
    </style>
@endpush



@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
               
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">

            <div class="card-body p-0 any-class" >

                <!-- Id Field -->
                <div class="col-12">
                    <div class="rounded h-100 p-4">
                        <h6 class="mb-4">Maquinas Em Produção</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ordem - Produtos</th>
                                        <th scope="col">Imagens</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach ($maquinas as $key_maquinas => $value_maquinas)
                                    <tr>
                                        <th scope="row">{{$key_maquinas}} - {{ count($maquinas_cor[$key_maquinas])}} Cores <br>
                                            @foreach($maquinas_cor[$key_maquinas] as $value)
                                                <span class='border border-dark' style='background:{{ $value }}!important'>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            @endforeach
                                        <br>
                                        </th>
                                        <td>
                                            @foreach($value_maquinas as $key_produto=>$value_produto)
                                                   {{ $value_produto['ordem_id'] }} - {{ $key_produto }} <br>
                                                    @foreach($value_produto['cor'] as $value_cor)
                                                        <span class='border border-dark' style='background:{{ $value_cor }}!important'>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                    @endforeach
                                                    <br>
                                            @endforeach

                                        </td>
                                        <td>

                                        <div id="carouselControls_{{ $value_produto['maquina_id']}}" class="carousel slide" data-ride="carousel">
                                            @php $aux = 0; @endphp 
                                            <div class="carousel-inner">
                                                 @foreach($value_maquinas as $index => $image)
                                                    <div class="carousel-item {{ $aux == 0 ? 'active' : '' }}" role="listbox">
                                                        <img src='{{ url('') }}/storage/{{$image['link']}}' alt="Image {{$index}}" class="img-responsive" style="width: 200px; height: auto;">
                                                    </div>
                                                    @php $aux++; @endphp
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselControls_{{ $value_produto['maquina_id'] }}" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                 <span class="sr-only">Anterior</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselControls_{{ $value_produto['maquina_id'] }}" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Próximo</span>
                                            </a>
                                        </div>
                                    </td

                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer clearfix float-right">
                    <div class="float-right">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
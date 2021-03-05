@extends('plantilla.web')


    @section('css_pagina')
        <link rel="stylesheet" href="{{ asset('css/menusup.css') }}">
        <link rel="stylesheet" href="{{ asset('css/menu_lateral.css') }}">
        <link rel="stylesheet" href="{{ asset('css/contacto.css') }}">
        <link rel="stylesheet" href="{{ asset('css/pie.css') }}">
    @endsection
    
    @section('title', 'home')


    @section('content')
    
        @include('componentes.MenuSup.menu_sup')
        @include('componentes.MenuLateral.menu-lateral-fisico')
        
        <div class="container margen-sup">

            <!--Carousel Wrapper-->
            <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                <!--Slides-->
                <div class="carousel-inner" role="listbox">

                    <?php  $contador = 0;   ?>
                    @foreach($post->images as $item)
                            
                            @if($item->tipo_id == 1)
                                @if($contador == 0)

                                    <div class="carousel-item active">
                                        <img 
                                                class="d-block w-100" 
                                                src="{{ asset('storage/imagenes/' . $item->image) }}" 
                                                alt="{{ $item->alt }}" 
                                        data-toggle="tooltip" 
                                    data-placement="top"
                                                title="{{ $item->alt }}">
                                    </div>

                                    <?php  $contador = 1;   ?>

                                @else

                                    <div class="carousel-item">
                                        <img 
                                                class="d-block w-100" 
                                                src="{{ asset('storage/imagenes/' . $item->image) }}" 
                                                alt="{{ $item->alt }}" 
                                        data-toggle="tooltip" 
                                    data-placement="top"
                                                title="{{ $item->alt }}">
                                    </div>
                                @endif

                            @endif

                    @endforeach

                </div>
                <!--/.Slides-->
                <!--Controls-->
                <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <!--/.Controls-->
                <ol class="carousel-indicators">

                    <?php  $contador1 = 0;   ?>
                    @foreach($post->images as $item1)

                            @if($item1->tipo_id == 1)
                                @if($contador1 == 0)

                                <li data-target="#carousel-thumb" data-slide-to="0" class="active">
                                    <img 
                                                src="{{ asset('storage/imagenes/' . $item1->image) }}" 
                                            width="100" 
                                            class="rounded-sm" 
                                                alt="{{ $item1->alt }}">
                                </li>

                                    <?php  $contador1 = 1; ?>

                                @else

                                <li data-target="#carousel-thumb" data-slide-to="{{ $contador1 }}">
                                    <img 
                                                src="{{ asset('storage/imagenes/' . $item1->image) }}" 
                                            width="100" 
                                            class="rounded-sm" 
                                                alt="{{ $item1->alt }}">
                                </li>

                                    <?php  $contador1++; ?>

                                @endif

                            @endif

                    @endforeach

                </ol>
            </div>
            <!--/.Carousel Wrapper-->

            <div class="media d-block">
                <div class="media-body text-center text-sm-left ml-md-3 ml-0">
                    <h3 class="mt-0 shadow titulos subrayar text-dark mb-4">{!! $post->titulo !!}</h3>
                    <h5>{!! $post->resena !!}</h5>
                    <h5 class="mt-5 text-black-50 subrayar">{!! $post->subtitulo !!}</h5>
                    <p>{!! $post->contenido !!}</p>

                </div>
            </div>

            <!--Iconos-->  
            <div class="row">

                @foreach($post->images as $item1)
                
                    @if($item1->tipo_id == 5)
                        <div class="col-4 col-md-1 text-center mt-3">
                            @if($item1->image == 'pdf.png')
                                <a target="_blank" href="{{ url('storage/pdfs/' . $post->pdf) }}">
                                    <img 
                                                class="d-block ancho-icono-producto" 
                                                src="{{ asset('storage/imagenes/' . $item1->image) }}" 
                                                alt="{{ $item->alt }}" 
                                        data-toggle="tooltip" 
                                    data-placement="top"
                                                title="{{ $item1->alt }}">
                                </a>
                            @else
                                <img 
                                            class="d-block ancho-icono-producto" 
                                            src="{{ asset('storage/imagenes/' . $item1->image) }}" 
                                            alt="{{ $item->alt }}" 
                                    data-toggle="tooltip" 
                                data-placement="top"
                                            title="{{ $item1->alt }}">
                            @endif
                        </div>
                    @endif
                @endforeach    
            </div>
            <!--/.Iconos-->

            <h5 class="mt-5 text-black-50 subrayar">Colores:</h5>
            <!--Colores-->  
            <div class="row">
                @foreach($post->images as $item1)
                    @if($item1->tipo_id == 6)
                        <div class="col-4 col-md-1 text-center mt-3">
                            <img 
                                        class="d-block ancho-icono-producto" 
                                        src="{{ asset('storage/imagenes/' . $item1->image) }}" 
                                        alt="{{ $item->alt }}" 
                                data-toggle="tooltip" 
                            data-placement="top"
                                        title="{{ $item1->alt }}">
                        </div>
                    @endif
                @endforeach    
            </div>
            <!--/.Colores-->

            <!--Si estas logueado muestra tarifas-->  
            @if (Auth::check()) 

                @foreach($post->images as $item1)
                        @if($item1->tipo_id == 3)
                            <div class="col-md-12 d-flex justify-content-center mt-5">
                                <img 
                                            class="d-block ancho-icono-producto" 
                                            src="{{ asset('storage/imagenes/' . $item1->image) }}" 
                                            alt="{{ $item->alt }}" 
                                    data-toggle="tooltip" 
                                data-placement="top"
                                            title="{{ $item1->alt }}">
                            </div>
                        @endif
                    @endforeach    

            @endif

            <p class="subrayar text-dark mt-5"></p>
            <!--Colores-->  
            <div class="row mb-5">
                @foreach($post->images as $item1)
                    @if($item1->tipo_id == 7)
                        <div class="col-6 col-md-2 text-center mt-3">
                            <img 
                                        class="d-block ancho-icono-producto" 
                                        src="{{ asset('storage/imagenes/' . $item1->image) }}" 
                                        alt="{{ $item->alt }}" 
                                data-toggle="tooltip" 
                            data-placement="top"
                                        title="{{ $item1->alt }}">
                        </div>
                    @endif
                @endforeach    
            </div>
            <!--/.Colores-->


             
        
        </div>
        

        @include('plantilla.footer')
        @include('plantilla.script_web')

    @endsection



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

        @if(isset($tarjetas))

                @foreach($tarjetas as $tarjeta)

                    @if($tarjeta->category_id == 5 && $tarjeta->posted == "yes")
                        @include('componentes.tarjetas.tres_imagenes')
                    @endif

                    @if($tarjeta->category_id == 2 && $tarjeta->posted == "yes")
                        @include('componentes.tarjetas.carousel')
                    @endif

                    @if($tarjeta->category_id == 1 && $tarjeta->posted == "yes")
                        @include('componentes.tarjetas.post')
                    @endif

                    @if($tarjeta->category_id == 3 && $tarjeta->posted == "yes")
                        @include('componentes.tarjetas.una_imagen')
                    @endif

                    @if($tarjeta->category_id == 4 && $tarjeta->posted == "yes")
                        @include('componentes.tarjetas.grid')
                    @endif

                @endforeach

                @if($tarjetas[0]->pagina == "contacto")

                    <form method="POST" action="{{ route('login') }}" class="fondo-form mb-5">
                        @csrf 
                        <div class="md-form">
                        <i class="fas fa-user prefix grey-text"></i>
                        <input type="text" id="form-name" class="form-control" name="nombre">
                        <label for="form-name">Tu nombre</label>
                        </div>
                        <div class="md-form">
                        <i class="fas fa-envelope prefix grey-text"></i>
                        <input type="text" id="form-email" class="form-control" name="email">
                        <label for="form-email">Tu email</label>
                        </div>
                        <div class="md-form">
                        <i class="fas fa-tag prefix grey-text"></i>
                        <input type="text" id="form-Subject" class="form-control" name="asunto">
                        <label for="form-Subject">Asunto</label>
                        </div>
                        <div class="md-form">
                        <i class="fas fa-pencil-alt prefix grey-text"></i>
                        <textarea id="form-text" rows="10" class="form-control md-textarea" rows="3" name="mensaje"></textarea>
                        <label for="form-text">Mensaje</label>
                        </div>

                        <input type="checkbox" class="form-check-input mt-3" id="materialUnchecked">
                        <label class="form-check-label ml-5" for="materialUnchecked">
                            <a href="/login" class="text-white" >
                                He leído y acepto la Política de privacidad
                                <span class="sr-only">(current)</span>
                            </a>
                        </label>

                        <div class="text-right">
                        <button type="submit" class="btn-enviar">Enviar</button>
                        </div>
                    </form>

                    <!--Google map-->
                    <div id="map-container-google-1" class="z-depth-1-half map-container mt-3 mb-5" style="height: 500px">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3041.670039483215!2d-3.777657684196652!3d40.32747997937563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x406f8022200ed711%3A0xfa36e7e71d95143d!2sSUTOLDO+F%C3%A1brica+de+toldos!5e0!3m2!1ses!2ses!4v1492557107256" frameborder="0"
                        style="border:0" allowfullscreen></iframe>
                    </div>
                    <!--Google map-->
                @endif

                @if($tarjetas[0]->pagina == "formacion" && Auth::check())
                    <div class="card card-widget widget-user-2 p-3 mt-4">
                        <h4 class="ml-3 subrayar text-dark">Videos formativos</h4>
                        <h6 class="ml-3">
                            Seleciona el video que quieras ver.
                        </h6>
                        <div class="d-flex align-content-center mb-3 mt-3">
                            <form class="d-flex" role="search" action="{{ url('/estas/formacion/search') }}" method="POST"> 
                                @csrf
                                <select class="browser-default custom-select d-flex align-content-center" name="search">
                                    <option selected></option>
                                @foreach($select_items as $vid)
                                    <option value="{{$vid->miniatura}}">{{$vid->titulo}}</option>
                                @endforeach
                                </select>
                                <button type="submit" class="btn btn-outline-default waves-effect btn-sm active">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="widget-user-header">
                            <div class="container mb-5">
                                @foreach($items as $video)
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <div class="embed-responsive embed-responsive-16by9 z-depth-5">
                                                <iframe class="embed-responsive-item" src="/storage/videos/{{$video->link}}" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12 text-dark mb-5">
                                            <h4 class="widget-user-desc mt-4 subrayar text-dark">{{ $video->titulo }}</h4>
                                            <h6 class="widget-user-desc">{{ $video->descripcion }}</h6>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                        </div>
                    </div>
                @endif
                
            @endif
        
        </div>
        

        @include('plantilla.footer')
        @include('plantilla.script_web')

    @endsection


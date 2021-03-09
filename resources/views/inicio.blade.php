@extends('plantilla.web')

    @section('css_pagina')
        <link rel="stylesheet" href="{{ asset('css/menusup.css') }}">
        <link rel="stylesheet" href="{{ asset('css/menu_lateral.css') }}">
        <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
        <link rel="stylesheet" href="{{ asset('css/pie.css') }}">
    @endsection
    
    @section('title')
        {!! $seo->title !!}
    @endsection
    @section('description')
        {{ $seo->description }}
    @endsection
    @section('canonical')
        {{ $seo->extra }}
    @endsection


    @section('content')
    
        @include('componentes.MenuSup.menu_sup')
        @include('componentes.MenuLateral.menu-lateral-fisico')

        {{-- portada--}}
        <div class="portada margen-superior">

            <div class="container wow animate__backInRight" data-wow-duration="3s" data-wow-delay="1s">
                <h2 class="display-5 d-flex justify-content-end align-items-center portada-texto-sup pr-2">{{ $seo->h2 }}</h2>
                <h1 class="display-4 d-flex justify-content-end align-items-center portada-texto-inf pr-2">{{ $seo->h1 }}</h1>
            </div>

        </div>
        {{-- /fin portada--}}


        <div class="container">
            
            @foreach($posts as $post)
                @if($post->category_id == 5 && $post->posted == "yes")
                    @include('componentes.Posts.tres_imagenes')
                @endif

                @if($post->category_id == 2 && $post->posted == "yes")
                    @include('componentes.Posts.carousel')
                @endif

                @if($post->category_id == 1 && $post->posted == "yes")
                    @include('componentes.Posts.post')
                @endif

                @if($post->category_id == 3 && $post->posted == "yes")
                    @include('componentes.Posts.una_imagen')
                @endif

                @if($post->category_id == 4 && $post->posted == "yes")
                    @include('componentes.Posts.grid')
                @endif
            @endforeach
        
        </div>
        

        @include('plantilla.footer')
        @include('plantilla.script_web')

    @endsection


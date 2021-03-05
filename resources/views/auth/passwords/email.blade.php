@extends('plantilla.web')


    @section('css_pagina')
        <link rel="stylesheet" href="{{ asset('css/menusup.css') }}">
        <link rel="stylesheet" href="{{ asset('css/menu_lateral.css') }}">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
        <link rel="stylesheet" href="{{ asset('css/pie.css') }}">
    @endsection
    
    @section('title', 'home')

    @section('content')

        @include('componentes.MenuSup.menu_sup')
        @include('componentes.MenuLateral.menu-lateral-fisico')

    <div class="container margin-sup margin-inf">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card fondo text-white">
                    <div class="card-header superior-card">
                    <a href="/"><img src="{{ asset('storage/imagenes/generales/logo.svg') }}" alt="logo" height="48" class="mr-3">
                    </a>
                        SUTOLDO. Cambiar clave
                    </div>

                    <div class="card-body fondo">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-enviar">
                                            Enviar email 
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
        </div>

        @include('plantilla.footer')
        @include('plantilla.script_web')

    @endsection

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <!-- ANIMACIÓN -->
        <link href="{{ asset('animate/animate.min.css') }}" rel="stylesheet">

        <!-- AWESOME -->
        <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">

        {{-- BOOTSTRAP Y MDB-PRO --}}
        <link type="text/css" rel="stylesheet" href="{{ asset('mdb/css/bootstrap.min.css') }}"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="{{ asset('mdb/css/mdb.min.css') }}"  media="screen,projection"/>

        {{-- MENU LATERAL --}}
        <link href="{{ asset('js/menu_lateral/mtree.min.css') }}" rel="stylesheet">
        <link href="{{ asset('js/menu_lateral/simple-sidebar.min.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        {{-- CSS DE LA PAGINA --}}
        @yield('css_pagina')

        <title>@yield('title')</title>
        <meta name="description" content="@yield('description')">
        <link rel="canonical" href="@yield('canonical')"/>

    </head>


    <body>

        @yield('content')

        @yield('plantilla.scripts_web')

    </body>
</html>

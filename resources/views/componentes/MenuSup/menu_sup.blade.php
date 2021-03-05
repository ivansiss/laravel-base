
{{-- NAV SUP--}}
    <div class="view">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar menu-sup wow animate__lightSpeedInLeft">
            <div class="mask pattern-0"></div>

                {{-- columna bt burguer --}}
                <div class="col-4 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <ul class="navbar-nav d-flex flex-row d-flex align-items-center">

                        <a href="/"><img src="{{ asset('storage/imagenes/generales/logo.svg') }}" alt="logo" height="48" class="mr-3"></a>

                        {{-- bt lateral --}}
                        <li class="d-flex align-items-center ml-3">
                                <a href="#menu-toggle" class="boton-menu-left" id="menu-toggle" onclick="menu_lateral();">
                                    <i class="fas fa-bars fa-lg aria-hidden='true' white-text"></i>
                                </a>
                        </li>

                        <!-- <li class="separador-horizontal"></li>

                        {{-- idioma --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex flex-row" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('imagenes/flags/es.png')}}" alt="Español flag" class="mr-2">
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item d-flex flex-row" href="#"><img src="{{asset('imagenes/flags/es.png')}}" alt="Español flag" class="d-flex flex-row mr-2">ESPAÑOL</a>
                                <a class="dropdown-item d-flex flex-row" href="#"><img src="{{asset('imagenes/flags/en.png')}}" alt="England flag" class="d-flex flex-row mr-2">ENGLISH</a>
                            </div>
                        </li> -->
                    </ul>
                </div>

                {{-- columna última --}}
                <div class="col-8 col-sm-9 col-md-9 col-lg-9 col-xl-9 d-flex justify-content-end">

                    <ul class="navbar-nav nav-sup-texto-right">

                        @foreach ($menu_sup as $key => $item)
                          
                            @if ($item['padre'] != 0)
                                        @break
                            @endif

                            @include('componentes.MenuSup.submenu-sup', ['item' => $item])

                        @endforeach

                        {{-- SISTEMA DE LOGUEO --}}
                        @if (!Auth::check())             {{-- sin loguear --}}
                                                            {{-- iniciar sesion --}}
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}" >Clientes</a>
                                </li>

                        @else                            {{-- logueado el usuario --}}
                                                            {{-- mi cuenta --}}
                                <li class="nav-item d-flex align-items-center">
                                    <a class="nav-link {{ request()->is('mi-cuenta/*') ? 'active' : '' }}" href="/mi-cuenta/{{ auth()->id() }}/editar">Mi cuenta</a>
                                </li>

                                {{-- BT PANEL CONTROL --}}
                            @can(Auth::user())
                                <li class="separador-horizontal d-flex align-self-center"></li>
                                <li class="nav-item d-flex align-items-center">
                                    <a class="nav-link {{ request()->is('admin/panel-control') ? 'active' : '' }}" href="{{ url('admin/panel-control') }}" >Panel control
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                            @endcan

                                <li class="separador-horizontal d-flex align-self-center"></li>

                                {{-- cerrar sesion --}}
                                <li class="nav-item">
                                    <form method="POST" action="{{route('logout')}}">
                                        @csrf
                                        <button type="submit" class="bt_cerrar_sesion">CERRAR SESIÓN</button>
                                    </form>
                                </li>


                        @endif

                    </ul>

                    {{-- BT COLAPSADO EN DROPDOWN------------------------------------------------------------------------------------- --}}
                    <ul class="navbar-nav d-flex flex-row nav-sup-drowpdown-right">

                        {{-- DROPDOWN FUERA--}}
                        @foreach ($menu_sup as $key => $item)

                            @if ($item['padre'] != 0)
                                        @break
                            @endif

                            @include('componentes.MenuSup.submenu-sup-colapsado', ['item' => $item])

                        @endforeach

                        {{-- DENTRO DEL DROPDOWN --}}
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i></a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  
                                @foreach ($menu_sup as $key => $item)
                                    @if ($item['submenu'] == [] && $item['padre'] == 0)
                                        <a class="dropdown-item {{ request()->is($item['route']) ? 'active' : '' }}" href="{{ $item['route'] }}" >{{ $item['btn'] }}
                                            <span class="sr-only">(current)</span>
                                        </a>
                                    @endif

                                @endforeach

                                {{-- LOGIN --}}
                                @if (!auth::check()) {{-- sin loguear --}}

                                    {{-- iniciar sesion --}}
                                    <a class="dropdown-item" href="/login">Clientes</a>

                                @else  {{-- logueado el usuario --}}

                                    {{-- mi cuenta --}}
                                    <a class="dropdown-item" href="/mi-cuenta/{{ auth()->id() }}/editar">Mi cuenta</a>

                                    {{-- cerrar sesion --}}
                                    <form method="POST" action="{{route('logout')}}" class="mb-0">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-secondary waves-effec">CERRAR SESIÓN</button>
                                    </form>

                                @endif
                                {{-- /LOGIN --}}

                            </div>
                        </li>
                    </ul>
                </div>
        </nav>
    </div>
{{-- /NAV SUP--}}
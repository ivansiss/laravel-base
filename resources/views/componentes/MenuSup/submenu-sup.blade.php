     
    {{-- SI NO TIENE DROPDOWN imprime el nombre--}}
    
    @if ($item['submenu'] == [])

        <li class="nav-item d-flex align-items-center">

            @if($item['btn'] != 'Inicio')
                <a class="nav-link {{ request()->is($item['route']) ? 'active' : '' }}" href="{{ url('/estas/' . $item['route']) }}" >{{ $item['btn'] }}
                    <span class="sr-only">(current)</span>
                </a>
            @else
                <a class="nav-link {{ request()->is($item['route']) ? 'active' : '' }}" href="{{ url( $item['route'] ) }}">{{ $item['btn'] }}
                    <span class="sr-only">(current)</span>
                </a>
            @endif
        </li>

        <li class="separador-horizontal d-flex align-self-center"></li>

    {{-- SI TIENE DROPDOWN --}}
    @else

    <li class="nav-item dropdown d-flex align-self-center">

            <a class="nav-link dropdown-toggle {{ request()->is($item['route']) ? 'active' : '' }}" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                @if($item['btn']!="")
                    {{ $item['btn'] }}
                @endif

                @if($item['icono']!="")
                <i class="{{ $item['icono'] }} fa-lg aria-hidden='true'"></i>
                @endif

            </a>
            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownMenuLink">
                @foreach ($item['submenu'] as $submenu)
                    @if ($submenu['submenu'] == [])                       
                        <a class="dropdown-item d-flex flex-row" href="{{ url('/estas/' . $submenu['route'] ) }}">{{ $submenu['btn'] }} </a>
                    @else
                        @include('componentes.MenuSup.submenu-sup', [ 'item' => $submenu ])
                    @endif
                @endforeach
            </div>

        </li>

        <li class="separador-horizontal d-flex align-self-center"></li>

    @endif
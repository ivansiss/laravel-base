

    {{-- SI NO TIENE DROPDOWN --}}
    @if ($item['submenu'] == [])

    {{-- SI TIENE DROPDOWN --}}
    @else

    <li class="nav-item dropdown">
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
                        <a class="dropdown-item d-flex flex-row" href="{{ url($submenu['route'] ) }}">{{ $submenu['btn'] }} </a>
                    @else
                        @include('componentes.MenuSup.submenu-sup', [ 'item' => $submenu ])
                    @endif
                @endforeach
            </div>

        </li>

        <li class="separador-horizontal d-flex align-self-center"></li>

    @endif
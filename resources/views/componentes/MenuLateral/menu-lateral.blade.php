

    {{-- SI NO TIENE DROPDOWN --}}
    @if ($item['submenu'] == [])

        <li>
            <div class="treeview-colorful-element"><a href="{{ url('/fabricante/' . $item['slug']) }}">{{ $item['titulo'] }}</a></div>
        </li>

    {{-- SI TIENE DROPDOWN --}}
    @else

        {{-- CAPSULA 1--}}
        <li class="treeview-colorful-items">

            {{-- NOMBRE CATEGORIA --}}
            <a class="treeview-colorful-items-header">
                <i class="fas fa-plus ml-3 mr-3"></i>
                <span>{{ $item['titulo'] }}</span>
            </a>

            <ul class="nested">
                {{-- LISTA PRODUCTOS --}}
                @foreach ($item['submenu'] as $submenu)
                    @if ($submenu['submenu'] == [])
                        <li><div class="treeview-colorful-element"><a href="{{ url('/fabricante/' . $submenu['slug']) }}">{{ $submenu['titulo'] }}</a></div></li>
                    @else
                         @include('componentes.MenuLateral.menu-lateral', [ 'item' => $submenu ])
                    @endif
                @endforeach
            </ul>

        </li>
        {{-- /CAPSULA 1 --}}

    @endif

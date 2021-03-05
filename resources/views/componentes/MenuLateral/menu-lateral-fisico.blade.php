{{-- NAV LATERAL --}}
<div id="wrapper" class="mb-5">
    <div id="sidebar-wrapper" class="pt-3 mb-5">

        {{-- arbol--}}
        <div class="treeview-colorful mx-4 my-4 color-fondo-texto">

            <ul class="treeview-colorful-list pb-3 pt-3 text-white">

                @foreach ($productos as $item)

                    @if ($item['padre'] != 0)
                                @break
                    @endif

                    @include('componentes.MenuLateral.menu-lateral', ['item' => $item])

                @endforeach

            </ul>

        </div>
        {{-- /arbol--}}

    </div>
</div>
{{-- /NAV LATERAL--}}
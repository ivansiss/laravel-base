
{{-- carousel --}}
<div class="container altura">
    <!--Carousel Wrapper-->
    <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
        <!--Slides-->
        <div class="carousel-inner" role="listbox">

            <?php  $contador = 0;   ?>
            @foreach($producto->imagenes as $myImg)

                    @if($myImg->tipo == 1)
                        @if($contador == 0)

                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('imagenes/tipoCarousel/' . $myImg->img ) }}" alt="First slide">
                            </div>

                            <?php  $contador = 1;   ?>

                        @else

                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('imagenes/tipoCarousel/' . $myImg->img ) }}" alt="First slide">
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
            @foreach($producto->imagenes as $myImg)

                    @if($myImg->tipo == 1)
                        @if($contador1 == 0)

                        <li data-target="#carousel-thumb" data-slide-to="0" class="active">
                            <img src="{{ asset('imagenes/tipoCarousel/' . $myImg->img ) }}" width="100" class="rounded-sm">
                        </li>

                            <?php  $contador1 = 1; ?>

                        @else

                        <li data-target="#carousel-thumb" data-slide-to="{{ $contador1 }}">
                            <img src="{{ asset('imagenes/tipoCarousel/' . $myImg->img ) }}" width="100" class="rounded-sm">
                        </li>

                            <?php  $contador1++; ?>

                        @endif

                    @endif

            @endforeach

        </ol>
    </div>
    <!--/.Carousel Wrapper-->
</div>
{{-- /carousel --}}
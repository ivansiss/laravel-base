
<?php $config = DB::table('configuraciones')->first(); ?>
{{-- carousel --}}
<div class="container mt-5">
    <!--Carousel Wrapper-->
    <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
        <!--Slides-->
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('imagenes/carousel_portada/' . $config->img_slider_1 ) }}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('imagenes/carousel_portada/' . $config->img_slider_2 ) }}"alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('imagenes/carousel_portada/' . $config->img_slider_3 ) }}" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('imagenes/carousel_portada/' . $config->img_slider_4 ) }}" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('imagenes/carousel_portada/' . $config->img_slider_5 ) }}" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('imagenes/carousel_portada/' . $config->img_slider_6 ) }}" alt="Third slide">
            </div>
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
            <li data-target="#carousel-thumb" data-slide-to="0" class="active">
                <img src="{{ asset('imagenes/carousel_portada/' . $config->img_slider_1 ) }}" width="100" class="rounded-sm">
            </li>
            <li data-target="#carousel-thumb" data-slide-to="1">
                <img src="{{ asset('imagenes/carousel_portada/' . $config->img_slider_2 ) }}" width="100" class="rounded-sm">
            </li>
            <li data-target="#carousel-thumb" data-slide-to="2">
                <img src="{{ asset('imagenes/carousel_portada/' . $config->img_slider_3 ) }}" width="100" class="rounded-sm">
            </li>
            <li data-target="#carousel-thumb" data-slide-to="3">
                <img src="{{ asset('imagenes/carousel_portada/' . $config->img_slider_4 ) }}" width="100" class="rounded-sm">
            </li>
            <li data-target="#carousel-thumb" data-slide-to="4">
                <img src="{{ asset('imagenes/carousel_portada/' . $config->img_slider_5 ) }}" width="100" class="rounded-sm">
            </li>
            <li data-target="#carousel-thumb" data-slide-to="5">
                <img src="{{ asset('imagenes/carousel_portada/' . $config->img_slider_6 ) }}" width="100" class="rounded-sm">
            </li>
        </ol>
    </div>
    <!--/.Carousel Wrapper-->
</div>
{{-- /carousel --}}
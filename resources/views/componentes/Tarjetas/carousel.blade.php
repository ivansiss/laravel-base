<!--Panel-->
{{-- carousel --}}

    <div class="media d-block d-md-flex mb-5">
        <div class="media-body text-center text-sm-left ml-md-3 ml-0">
            <div class="mt-0 d-flex justify-content-end text-black-50"><p class="card-fecha">{!! $tarjeta->getFechaFormateadaAttribute() !!}</p></div>
            <h3 class="mt-0 shadow card-inicio titulos">{!! $tarjeta->title !!}</h3>
            <h5 class="mt-0 text-black-50">{!! $tarjeta->subtitulo !!}</h5>
            <br>
            <p>{!! $tarjeta->content !!}</p>

        </div>
    </div>
    <!--Carousel Wrapper-->
    <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
        <!--Slides-->
        <div class="carousel-inner" role="listbox">

            <?php  $contador = 0;   ?>
            @foreach($tarjeta->images as $item)
                    
                    @if($item->tipo_id == 1)
                        @if($contador == 0)

                            <div class="carousel-item active">
                                <img 
                                        class="d-block w-100" 
                                          src="{{ asset('storage/imagenes/' . $item->image) }}" 
                                          alt="{{ $item->alt }}" 
                                  data-toggle="tooltip" 
                               data-placement="top"
                                        title="{{ $item->alt }}">
                            </div>

                            <?php  $contador = 1;   ?>

                        @else

                            <div class="carousel-item">
                                <img 
                                        class="d-block w-100" 
                                          src="{{ asset('storage/imagenes/' . $item->image) }}" 
                                          alt="{{ $item->alt }}" 
                                  data-toggle="tooltip" 
                               data-placement="top"
                                        title="{{ $item->alt }}">
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
            @foreach($tarjeta->images as $item1)

                    @if($item1->tipo_id == 1)
                        @if($contador1 == 0)

                        <li data-target="#carousel-thumb" data-slide-to="0" class="active">
                            <img 
                                        src="{{ asset('storage/imagenes/' . $item1->image) }}" 
                                    width="100" 
                                    class="rounded-sm" 
                                        alt="{{ $item1->alt }}">
                        </li>

                            <?php  $contador1 = 1; ?>

                        @else

                        <li data-target="#carousel-thumb" data-slide-to="{{ $contador1 }}">
                            <img 
                                        src="{{ asset('storage/imagenes/' . $item1->image) }}" 
                                    width="100" 
                                    class="rounded-sm" 
                                        alt="{{ $item1->alt }}">
                        </li>

                            <?php  $contador1++; ?>

                        @endif

                    @endif

            @endforeach

        </ol>
    </div>
    <!--/.Carousel Wrapper-->

{{-- /carousel --}}
<!--/.Panel-->
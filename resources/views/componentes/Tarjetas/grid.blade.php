  <!--Panel-->

    <div class="media d-block d-md-flex mb-5">
        <div class="media-body text-center text-sm-left ml-md-3 ml-0">
            <h3 class="mt-0 shadow card-inicio titulos">{!! $tarjeta->title !!}</h3>
            <h5 class="mt-0 text-black-50">{!! $tarjeta->subtitulo !!}</h5>
            <br>
            <p>{!! $tarjeta->content !!}</p>

        </div>
    </div>
    
    <!--Panel-->
    <div class="container">
        <div class="row">

            @if(count($tarjeta->images) > 0)

                @foreach($tarjeta->images as $img)
                <div class="col-lg-4 col-md-12 mb-3 d-flex justify-content-center">

                    <a href="{{ url('/fabricante/' . $img['link']) }}">
                        <img 
                                class="mb-3 mr-3 rounded img-fluid z-depth-3"  
                                    id="foto1" src="{{ asset('storage/imagenes/' . $img->image) }}" 
                                    alt="{{$img->alt}}" width="300px"
                            data-toggle="tooltip" 
                        data-placement="top"
                                title="{{$img->alt}}">
                    </a>

                </div>
                @endforeach

            @endif
        
        </div>

    </div>

        <!--/.Panel-->
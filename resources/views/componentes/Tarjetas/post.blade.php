    <!--Panel-->
        
    <div class="media d-block d-md-flex mb-5">
        <div class="media-body text-center text-sm-left ml-md-3 ml-0">
            <h3 class="mt-0 card-inicio titulos">{!! $tarjeta->title !!}</h3>
            <h5 class="mt-0 text-black-50">{!! $tarjeta->subtitulo !!}</h5>
            <br>

            <div class="row">
                <div class="col-md-4">

                    @if(count($tarjeta->images) > 0)
                        <img 
                                    class="mb-3 mr-3 rounded img-fluid z-depth-3"  
                                    id="foto1" src="{{ asset('storage/imagenes/' . $tarjeta['images'][0]->image) }}" 
                                    alt="{{$tarjeta['images'][0]->alt}}"
                            data-toggle="tooltip" 
                        data-placement="top"
                                    title="{{$tarjeta['images'][0]->alt}}">
                    @endif

                </div>
                <div class="col-md-8">
                    <p>{!! $tarjeta->content !!}</p>
                </div>
            </div>
            

        </div>
    </div>

    <!--/.Panel-->
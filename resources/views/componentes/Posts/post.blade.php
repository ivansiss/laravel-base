    <!--Panel-->
    <div class="caja">
        <div class="st-verde-contenedor">
                <img 
                        class="mb-3 mr-3 st-verde"  
                        id="foto2" src="{{ asset('storage/imagenes/st_verde.png') }}" 
                        alt="" width="300px"
                data-toggle="tooltip" 
            data-placement="top"
                    title="Hola">
        </div>
        <div class="media d-block d-md-flex mb-5">
            <div class="media-body text-center text-sm-left ml-md-3 ml-0">
                <h3 class="mt-0 shadow card-inicio titulos">{!! $post->title !!}</h3>
                <h5 class="mt-0 text-black-50">{!! $post->subtitulo !!}</h5>
                <br>

                <div class="row">
                    <div class="col-md-4">
                        @if(count($post->images) > 0)
                            <img 
                                        class="mb-3 mr-3 rounded img-fluid z-depth-3"  
                                        id="foto1" src="{{ asset('storage/imagenes/' . $post['images'][0]->image) }}" 
                                        alt="{{$post['images'][0]->alt}}" width="300px"
                                data-toggle="tooltip" 
                            data-placement="top"
                                        title="{{$post['images'][0]->alt}}">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <p>{!! $post->content !!}</p>
                    </div>
                </div>
                

            </div>
        </div>
    </div>
    <!--/.Panel-->
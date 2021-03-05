  <!--Panel-->
  <div class="caja mb-5">
            <div class="media d-block d-md-flex mb-5">
                <div class="media-body text-center text-sm-left ml-md-3 ml-0">
                    <div class="mt-0 d-flex justify-content-end text-black-50"><p class="card-fecha">{!! $post->getFechaFormateadaAttribute() !!}</p></div>
                    <h3 class="mt-0 shadow card-inicio titulos">{!! $post->title !!}</h3>
                    <h5 class="mt-0 text-black-50">{!! $post->subtitulo !!}</h5>
                    <br>
                    <p>{!! $post->content !!}</p>

                </div>
            </div>
            
            <!--Panel-->
            <div class="container">
                <div class="row">

                    @if(count($post->images) > 0)

                        @foreach($post->images as $img)
                        <div class="col-lg-4 col-md-12 mb-3 d-flex justify-content-center">
                            <img 
                                    class="mb-3 mr-3 rounded img-fluid z-depth-3"  
                                       id="foto1" src="{{ asset('storage/imagenes/' . $img->image) }}" 
                                      alt="{{$img->alt}}" width="300px"
                              data-toggle="tooltip" 
                           data-placement="top"
                                    title="{{$img->alt}}">
                        </div>
                        @endforeach

                    @endif
               
                </div>

            </div>
        </div>
        <!--/.Panel-->
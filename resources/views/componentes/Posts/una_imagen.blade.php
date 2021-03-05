  <!--Panel-->
  <div class="caja">
            <div class="media d-block d-md-flex mb-5">
                <div class="media-body text-center text-sm-left ml-md-3 ml-0">
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
                        <div class="col-lg-12 col-md-12 mb-3 d-flex justify-content-center">
                            <img 
                                    class="mb-3 mr-3"
                                    width="945px" 
                                       id="foto1" src="{{ asset('storage/imagenes/' . $post['images'][0]->image) }}" 
                                      alt="{{$post['images'][0]->alt}}" width="300px"
                              data-toggle="tooltip" 
                           data-placement="top"
                                    title="{{$post['images'][0]->alt}}">
                        </div>
                    @endif
                   
                </div>

            </div>
        </div>
        <!--/.Panel-->
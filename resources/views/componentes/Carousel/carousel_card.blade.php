<!--Carousel Wrapper-->
<div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">

    <!--Controls-->
    <div class="controls-top">
      <a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fas fa-chevron-left"></i></a>
      <a class="btn-floating" href="#multi-item-example" data-slide="next">
          <i class="fas fa-chevron-right"></i>
      </a>
    </div>
    <!--/.Controls-->

    <!--Indicators-->
    <?php
            $i = 1;
            $contador = 3;
            $conjunto = 1;
    ?>
    <ol class="carousel-indicators">
      <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>

      @foreach($producto->imagenes as $img)
          @if($i == $contador)
                <li data-target="#multi-item-example" data-slide-to="{{$conjunto}}"></li>
                <?php
                        $contador = $contador + 3;
                        $conjunto++;
                ?>
          @endif
          <?php $i++; ?>

      @endforeach
    </ol>
    <!--/.Indicators-->

    <!--Slides-->
    <div class="carousel-inner" role="listbox">

      <?php
            $i = 1;
            $contador = 3;
            $conjunto = 1;
      ?>
      @foreach($producto->imagenes as $img)
          @if($i == 1)
             <!--First slide-->
             <div class="carousel-item active">
          @endif
          @if($i == $contador+1)
              </div>
              <div class="carousel-item">
              <?php $contador = $contador + 3; ?>
          @endif

          @if($i <= $contador)
                <div class="col-md-4">
                  <!-- Card Narrower -->
                  <div class="card card-cascade narrower">

                    <!-- Card image -->
                    <div class="view view-cascade overlay">
                      <img class="card-img-top" src="{{ asset('imagenes/tipoCarousel/' . $img->img) }}"
                        alt="Card image cap">
                      <a>
                        <div class="mask rgba-white-slight"></div>
                      </a>
                    </div>

                    <!-- Card content -->
                    <div class="card-body card-body-cascade">

                      <!-- Label -->
                      <h5 class="pink-text pb-2 pt-1"><i class="fas fa-utensils"></i>{{$img->nombre}}</h5>
                      <!-- Title -->
                      <h4 class="font-weight-bold card-title">{{$img->title}}</h4>
                      <!-- Text -->
                      <p class="card-text">{{$img->descripcion}}</p>

                      <!-- Material unchecked -->
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="materialUnchecked" checked="">
                          <label class="form-check-label" for="materialUnchecked">Selecionado</label>
                      </div>
                    </div>
                  </div>
                  <!-- Card Narrower -->
                </div>
          @endif
          <?php $i++; ?>
      @endforeach
    </div>
    <!--/.Slides-->

</div>
</div>
<!--/.Carousel Wrapper-->

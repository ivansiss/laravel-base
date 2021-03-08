
<!-- Footer -->
<footer class="page-footer font-small footer-fondo">
  <div class="footer-arbolito">
      <img src=" /storage/imagenes/web_boj.png " alt="devctheme Logo" height="100">
  </div>
  <div class="footer-cabecera">
    
    <div class="container">

      <!-- Grid row-->
      <div class="row py-4 d-flex align-items-center">

        <!-- Grid column -->
        <div class="col-md-6 col-lg-5 text-center text-md-center mb-4 mb-md-0">
          <h6 class="mb-0">¡Conéctate en redes sociales!</h6>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-6 col-lg-7 text-center text-md-right">

          <!-- Facebook -->
          <a class="fb-ic">
            <i class="fab fa-facebook-f white-text mr-4"> </i>
          </a>
          <!-- Twitter -->
          <a class="tw-ic">
            <i class="fab fa-twitter white-text mr-4"> </i>
          </a>
          <!-- Google +-->
          <a class="gplus-ic">
            <i class="fab fa-google-plus-g white-text mr-4"> </i>
          </a>
          <!--Linkedin -->
          <a class="li-ic">
            <i class="fab fa-linkedin-in white-text mr-4"> </i>
          </a>
          <!--Instagram-->
          <a class="ins-ic">
            <i class="fab fa-instagram white-text"> </i>
          </a>

        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row-->

    </div>
  </div>

  <!-- Footer Links -->
  <div class="container text-center text-md-left mt-5">

    <!-- Grid row -->
    <div class="row mt-3">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

        <!-- Content -->
        <h6 class="text-uppercase font-weight-bold footer-linea-bajo-texto">{!! $pie->empresa !!}</h6>

        <p>{!! $pie->texto !!}</p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold footer-linea-bajo-texto">Novedades</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a class="nav-link" href="'catalogo/producto/'{{ $pie->novedades1 }}">{!!  $pie->novedades1 !!}</a>
        </p>
        <p>
          <a class="nav-link" href="catalogo/producto/{{ $pie->novedades2 }}">{!!  $pie->novedades2 !!}</a>
        </p>
        <p>
          <a class="nav-link" href="catalogo/producto/{{ $pie->novedades3 }}">{!!  $pie->novedades3 !!}</a>
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold footer-linea-bajo-texto">Enlaces</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a class="nav-link" href="catalogo/producto/{{ $pie->enlace1 }}">{!! $pie->enlace1 !!}</a>
        </p>
        <p>
          <a class="nav-link" href="catalogo/producto/{{ $pie->enlace2 }}">{!!  $pie->enlace2 !!}</a>
        </p>
        <p>
          <a class="nav-link" href="catalogo/producto/{{ $pie->enlace3 }}">{!!  $pie->enlace3 !!}</a>
        </p>
      
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold footer-linea-bajo-texto">Contacta</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <i class="fas fa-home mr-3"></i> {!! $pie->direccion !!}</p>
        <p>
          <i class="fas fa-envelope mr-3"></i> {!! $pie->email !!}</p>
        <p>
          <i class="fas fa-phone mr-3"></i> {!! $pie->telefono !!}</p>
        <p>
          <i class="fas fa-print mr-3"></i> {!! $pie->fax !!}</p>
        <p>
          <i class="far fa-clock mr-3"></i> {!! $pie->horario !!}</p>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="https://sutoldo.com/"> Sutoldo.com</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
{{-- /FOOTER --}}

<!DOCTYPE html>
<html lang="en">

@include('plantilla.head_admin')


<body class="hold-transition sidebar-mini">
   
    <div class="wrapper" id="app">

        @if(Auth::check())
      
                <App ruta="{{ route('basepath') }}" :usuario="{{Auth::user()}}"></App>
        @else
  
                <Auth ruta="{{ route('basepath') }}"></App>
        @endif
        
    </div>
    <!-- ./wrapper -->

    @include('plantilla.script_admin')

</body>
</html>

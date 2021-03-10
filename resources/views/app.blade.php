<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Administracion</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/plantilla.css') }}">
  <link rel="stylesheet" href="{{ asset('css/mi_plantilla.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    
    <!-- .wrapper -->
    <div class="wrapper" id="app">

        @if(Auth::check())
      
                <App ruta="{{ route('basepath') }}" :usuario="{{Auth::user()}}"></App>
        @else
  
                <Auth ruta="{{ route('basepath') }}"></App>
        @endif
        
    </div>
    <!-- ./wrapper -->

    <script src="{{ asset('js/jquery/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetAlert2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plantilla.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Page specific script -->
    <script>

        $(document).ready(function() {
            
            bsCustomFileInput.init();
        });

    </script>

</body>
</html>

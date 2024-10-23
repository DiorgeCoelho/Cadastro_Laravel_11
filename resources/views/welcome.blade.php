<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>

    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset( ' ../../admin/plugins/fontawesome-free/css/all.min.css' )}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset( ' ../../admin/dist/css/adminlte.min.css' )}}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    {{-- <script src="{{ asset( ' admin/path/to/bootstrap/js/bootstrap.min.js' )}}"></script> --}}
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

   @vite('resources/css/app.css')

</head>
<body>

    @include('pagina.naverbar')
    @include('pagina.menuLateral')
    @yield('content')

 {{-- @include('pagina.footer') --}}

<script src="{{ asset( ' ../../admin/plugins/jquery/jquery.min.js' )}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset( ' ../../admin/plugins/bootstrap/js/bootstrap.bundle.min.js' )}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset( ' ../../admin/dist/js/adminlte.min.js' )}}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset( ' ../../admin/dist/js/demo.js' )}}"></script> --}}

<script src="{{ asset( 'admin/plugins/jquery/jquery.min.js ' )}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset( 'admin/plugins/jquery-ui/jquery-ui.min.js ' )}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>



</body>
</html>



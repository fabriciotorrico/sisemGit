<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Netpon - Empresas</title>


    <link rel="shortcut icon" href="{{{ asset('img/logoIco.ico') }}}">

    <!-- Styles -->
    <!--link href="{{ asset('css/app.css') }}" rel="stylesheet"-->
    <!-- Styles Matrix admin -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/matrix-login.css" />
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
</head>
<body>
  <div id="loginbox">
      @yield('content')
  </div>

  <div id="footer">
      @include('partials.footer')
  </div>

  <!-- Scripts -->
  <script src="js/jquery.min.js"></script>
  <script src="js/matrix.login.js"></script>
</body>
</html>

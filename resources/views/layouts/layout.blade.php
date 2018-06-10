<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-responsive.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/fullcalendar.css') }}">
<link rel="stylesheet" href="{{ asset('/css/matrix-style.css') }}">
<link rel="stylesheet" href="{{ asset('/css/matrix-media.css') }}">
<link rel="stylesheet" href="{{ asset('/font-awesome/css/font-awesome.css') }}">
<link rel="stylesheet" href="{{ asset('/css/jquery.gritter.css') }}">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>



<!--cabecera-->
@yield('head')

<title>Netpon - Empresas</title>

<link rel="shortcut icon" href="{{ asset('img/logoIco.ico') }}">

</head>
<body>

<!--Header-part-->
<div id="header">
  <!-- Logo -->
  <h4><img src={{ asset('/img/logo_groupon.png') }} alt="Logo" /></h4>
</div>

<!--close-Header-part-->


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">

    <!--Obtenemos el tipo de usuario-->
    <?php $tipo_de_usuario = \DB::table('tipos_de_usuarios')
        ->where('id_tipo_usuario',auth()->user()->id_tipo_usuario)
        ->value('tipo_usuario');?>

    <!--Boton Nombre de Usuario-->
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>
      <span class="text">
        <?php
          $nombre = \DB::table('personas')
                ->where('id_persona', auth()->user()->id_persona)
                ->value('name');
          $apellido = \DB::table('personas')
                ->where('id_persona', auth()->user()->id_persona)
                ->value('lastname');
          echo $nombre." ".$apellido;
        ?>
      </span><b class="caret"></b></a>

      <ul class="dropdown-menu">
        <li>
          <a href=""><i class="icon-user"></i> Usuario
            <?php
            echo $tipo_de_usuario = \DB::table('tipos_de_usuarios')
                  ->where('id_tipo_usuario', auth()->user()->id_tipo_usuario)
                  ->value('tipo_usuario');
            ?>
          </a>
        </li>
        <li class="divider"></li>
        <li><a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();"><i class="icon-key"></i>
            Salir </a></li>
      </ul>
    </li>

    <!--Boton salir-->
    <li class="">
      <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"><i class="icon-key"></i>
          Salir
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
      </form>
    </li>

    <!--Boton ayuda-->
    <li class="">
      <a href="{{ route('ayuda') }}"><i class="icon-question-sign"></i>
          Ayuda
      </a>
    </li>

  </ul>
</div>

<!--incluir el Menu-->
@include('partials.menu')


<!--main-container-part-->
<div id="content">
  <!-- home / inicio-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('inicio') }}" title="Ir al Inicio" class="tip-bottom"><i class="icon-home"></i> Inicio</a></div>
  </div>
  <!--End-home / inicio-->


  <!--contenido-->
  @yield('content')

</div>

<!--end-main-container-part-->

<!--Footer-part-->
<div id="footer">
    @include('partials.footer')
</div>

<!--end-Footer-part-->

<script src="js/excanvas.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.flot.min.js"></script>
<script src="js/jquery.flot.resize.min.js"></script>
<script src="js/jquery.peity.min.js"></script>
<script src="js/fullcalendar.min.js"></script>
<script src="js/matrix.js"></script>
<script src="js/matrix.dashboard.js"></script>
<script src="js/jquery.gritter.min.js"></script>
<script src="js/matrix.interface.js"></script>
<script src="js/matrix.chat.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/matrix.form_validation.js"></script>
<script src="js/jquery.wizard.js"></script>
<script src="js/jquery.uniform.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/matrix.popover.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/matrix.tables.js"></script>

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {

          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();
          }
          // else, send page to designated URL
          else {
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>

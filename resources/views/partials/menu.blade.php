<!--sidebar-menu-->
  <div id="sidebar"><a href="{{ asset('sisem.app/h') }}" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>

      <li class="{{ Request::path() == 'inicio' ? 'active' : '' }}"><a href="{{ route('inicio') }}"><i class="icon icon-home"></i> <span>Inicio</span></a> </li>



      <!--Modificar datos del propio usuario-->
      <li class="submenu {{ Request::path() == 'verMisDatos' ? 'active' : '' }}
                         {{ Request::path() == 'formularioModificarMisDatos' ? 'active' : '' }}
                         {{ Request::path() == 'modificarMisDatos' ? 'active' : '' }}">
                         <a href="#"><i class="icon-user"></i>
                           <span>Mis datos</span>
                         </a>
        <ul>
          <li><a href="{{ route('verMisDatos') }}">Ver mis datos</a></li>
          <li><a href="{{ route('formularioModificarMisDatos') }}">Modificar mis datos</a></li>
        </ul>
      </li>

@if(auth()->user()->id_tipo_usuario == '1')
      <!--Gestion de Usuarios-->
      <li class="submenu {{ Request::path() == 'registrarUsuario' ? 'active' : '' }}
                         {{ Request::path() == 'registroUsuarioExitoso' ? 'active' : '' }}
                         {{ Request::path() == 'usuariosModificar' ? 'active' : '' }}
                         {{ Request::path() == 'formModificarUsuario' ? 'active' : '' }}
                         {{ Request::path() == 'modificarUsuario' ? 'active' : '' }}">
                         <a href="#"><i class="icon icon-group"></i>
                           <span>Gestión de Usuarios</span>
                         </a>
        <ul>
          <li><a href="{{ route('registrarUsuario') }}">Registrar Usuario</a></li>
          <li><a href="{{ route('verModificarUsuarios') }}">Modificar Usuario</a></li>
          <!--li><a href="{{ route('verBorrarUsuarios') }}">Borrar Usuario</a></li-->
        </ul>
      </li>

      <!--Reportes-->
      <li class="submenu {{ Request::path() == 'reporteContratos' ? 'active' : '' }}
                         {{ Request::path() == 'reporteVerUsuarios' ? 'active' : '' }}
                         {{ Request::path() == 'seleccionarReporteDeVentas' ? 'active' : '' }}
                         {{ Request::path() == 'reporteDetalle' ? 'active' : '' }}
                         {{ Request::path() == 'reporteNumero' ? 'active' : '' }}">
                         <a href="#"><i class="icon-file"></i>
                           <span>Reportes</span>
                         </a>
        <ul>
          <li><a href="{{ route('reporteContratos') }}">Contratos</a></li>
          <li><a href="{{ route('reporteVerUsuarios') }}">Usuarios</a></li>
          <li><a href="{{ route('seleccionarReporteDeVentas') }}">Ventas</a></li>
        </ul>
      </li>
@endif

      <!--Ver promociones para introducir un cupon de un cliente-->
      <li class="{{ Request::path() == 'verPromociones' ? 'active' : '' }}
                 {{ Request::path() == 'formularioIntroducirCupon' ? 'active' : '' }}
                 {{ Request::path() == 'introducirCupon' ? 'active' : '' }}">
                 <a href="{{ route('verPromociones') }}"><i class="icon-list-alt"></i>
                   <span>Promociones</span>
                 </a>
      </li>

      <!--Tutorial de cómo usar-->
      <li class="{{ Request::path() == 'ayuda' ? 'active' : '' }}"><a href="{{ route('ayuda') }}"><i class="icon-question-sign"></i> <span>Ayuda</span></a> </li>

    </ul>
  </div>
<!--sidebar-menu-->

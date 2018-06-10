@extends('layouts.layout')
@section('content')
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Error 403</h5>
          </div>
          <div class="widget-content">
            <div class="error_ex">
              <h1>403</h1>
              <h3>Prohibido el acceso a la ruta solicitada</h3>
              <p>Se informará al administrador del intento realizado</p>
              <a class="btn btn-warning btn-big"  href="/inicio">Volver al Inicio</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

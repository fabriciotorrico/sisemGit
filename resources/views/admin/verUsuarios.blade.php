@extends('layouts.layout')

@section('content')

<!--Se le debe pasar la ruta, los usuarios y la accion a realizar, puede ser para borrar o para modificar-->
<div class="container">

  <div class="row-fluid">

    <div class="span3">
    </div>

    <div class="span5">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Usuarios Existentes</h5>
        </div>
        <div class="widget-content nopadding">
          <form class="form-horizontal" role="form" method="POST" action="{{ route($ruta) }}">
              {{ csrf_field() }}


          <label class="control-label">Seleccionar Usuario</label>
          <div class="controls">
            <select name="usuario">
              @foreach($usuarios as $usuario)
                      <option value="{{ $usuario -> email }}">{{ $usuario -> email }}</option>
              @endforeach
            </select>
          </div>


          <div class="form-actions">
            <button type="submit" class="btn btn-success">{{ $accion }} Usuario</button>
          </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

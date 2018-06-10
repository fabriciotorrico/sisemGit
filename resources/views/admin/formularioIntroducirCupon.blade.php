@extends('layouts.layout')

@section('content')

<div class="container">

  <div class="row-fluid">

    <div class="span3">
    </div>

    <div class="span5">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5  style="text-align:center;">Canjear Cupón</h5>
        </div>
        <div class="widget-content nopadding">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('introducirCupon') }}">
              {{ csrf_field() }}

              <input id="id_codigo_promocion" type="hidden" class="form-control" name="id_codigo_promocion" value="{{$id_codigo_promocion}}">

              <div class="form-group">
                <label class="control-label"></label>
                  <h5>{{$nombre}}</h5>
                <label class="control-label"></label>
                  <img width="40" height="40" alt="User" src="{{$imagen}}">
                  <span class="badge badge-important"> Cobrar Bs. {{$precio_pagar}} </span>
              </div>

              <div class="form-group">
                  <label class="control-label">Código del Cupon</label>
                  <div class="controls">
                      <input id="codigo_cupon" type="text" class="form-control" name="codigo_cupon" required autofocus>
                  </div>
              </div>

          <div class="form-actions">
            <button type="submit" class="btn btn-success">Canjear Cupón</button>
          </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

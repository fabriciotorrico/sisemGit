@extends('layouts.layout')
@section('content')

<div class="container">

  <div class="row-fluid">

    <div class="span3">
    </div>

    <div class="span5">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Mis Datos</h5>
        </div>
        <div class="widget-content nopadding">
          <form class="form-horizontal" role="form" method="POST" action="#">
              {{ csrf_field() }}

              @foreach($usuario as $user)
                <div class="form-group">
                  <label for="name" class="control-label">Usuario :</label>
                  <label for="name" class="controls">{{$user->email}}</label>
                </div>
              @endforeach

              @foreach($persona as $person)

                <div class="form-group">
                  <label for="name" class="control-label">Nombre(s) :</label>
                  <label for="name" class="controls">{{$person->name}}</label>
                </div>

                <div class="form-group">
                  <label for="name" class="control-label">Apellido(s) :</label>
                  <label for="name" class="controls">
                    {{$person->lastname}}
                    @if ($person->lastname == "")
                      <br>
                    @endif
                  </label>
                </div>

                <div class="form-group">
                  <label for="name" class="control-label">Edad :</label>
                  <label for="name" class="controls">
                    {{$person->edad}}
                    @if ($person->edad == "")
                      <br>
                    @endif
                  </label>
                </div>

                <div class="form-group">
                  <label for="name" class="control-label">Sexo :</label>
                  <label for="name" class="controls">
                    {{$person->sexo}}
                    @if ($person->sexo == "")
                      <br>
                    @endif
                  </label>
                </div>

                <div class="form-group">
                  <label for="name" class="control-label">Ciudad Actual :</label>
                  <label for="name" class="controls">{{$ciudad}}</label>
                </div>

              @endforeach

              @foreach($usuario as $user)

                <div class="form-group">
                  <label for="name" class="control-label">Tipo de Usuario :</label>
                  <label for="name" class="controls">{{$tipo_usuario}}</label>
                </div>

                <div class="form-group">
                  <label for="name" class="control-label">Activo :</label>
                  @if ($user->activo==1)
                    <label for="name" class="controls">Si</label>
                  @endif
                  @if ($user->activo==0)
                    <label for="name" class="controls">No</label>
                  @endif
                </div>

              @endforeach

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

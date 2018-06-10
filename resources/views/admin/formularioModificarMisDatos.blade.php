@extends('layouts.layout')

@section('content')

<div class="container">

  <div class="row-fluid">

    <div class="span3">
    </div>

    <div class="span5">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5  style="text-align:center;">Modificar Mis Datos</h5>
        </div>
        <div class="widget-content nopadding">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('modificarMisDatos') }}">
              {{ csrf_field() }}

              @foreach($usuario as $user)
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="control-label">Usuario</label>
                    <label for="name" class="control-label">{{$user->email}}</label>
                </div>
              @endforeach


              @foreach($persona as $person)

              <input id="id_persona" type="hidden" class="form-control" name="id_persona" value="{{$person->id_persona}}">

              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name" class="control-label">Nombre(s)</label>
                  <div class="controls">
                      <input id="name" type="text" class="form-control" name="name" value="{{$person->name}}" required autofocus>
                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>


              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name" class="control-label">Apellido(s)</label>
                  <div class="controls">
                      <input id="lastname" type="text" class="form-control" name="lastname" value="{{$person->lastname}}">
                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <label class="control-label">Edad</label>
              <div class="controls">
                <select name="edad">
                  @for ($i=1; $i < 100 ; $i++)
                    <option value= {{ $i }} @if ($person->edad==$i) selected='selected'@endif> {{ $i }} </option>
                  @endfor
                </select>
              </div>

              <label class="control-label">Sexo</label>
              <div class="controls">
                <select name="sexo">
                  <option value="" @if ($person->sexo=="") selected='selected'@endif></option>
                  <option value="Masculino" @if ($person->sexo=="Masculino") selected='selected'@endif>Masculino</option>
                  <option value="Femenino" @if ($person->sexo=="Femenino") selected='selected'@endif>Femenino</option>
                </select>
              </div>

              @endforeach

              @foreach($usuario as $user)

              <input id="email" type="hidden" class="form-control" name="email" value="{{$user->email}}">

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password" class="control-label">Nueva Contraseña</label>
                  <div class="controls">
                      <input id="password" type="password" class="form-control" name="password" required>
                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group">
                  <label for="password-confirm" class="control-label">Confirmar Contraseña</label>
                  <div class="controls">
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                  </div>
              </div>

              @endforeach

          <div class="form-actions">
            <button type="submit" class="btn btn-success">Modificar Datos</button>
          </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

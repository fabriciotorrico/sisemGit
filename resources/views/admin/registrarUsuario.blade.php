@extends('layouts.layout')

@section('content')

<div class="container">

  <div class="row-fluid">

    <div class="span3">
    </div>

    <div class="span5">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Datos del Usuario a Registrar</h5>
        </div>
        <div class="widget-content nopadding">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
              {{ csrf_field() }}

          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="control-label">Nombre(s)</label>

              <div class="controls">
                  <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

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
                  <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">

                  @if ($errors->has('name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <label class="control-label">Tipo de Usuario</label>
          <div class="controls">
            <select name="id_tipo_usuario">
              @foreach($tipo_de_usuario as $tipo)
                      <option value="{{ $tipo -> id_tipo_usuario }}">{{ $tipo -> tipo_usuario }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="control-label">E-Mail</label>

              <div class="controls">
                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="control-label">Contraseña</label>

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



          <div class="form-actions">
            <button type="submit" class="btn btn-success">Registrar Usuario</button>
          </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

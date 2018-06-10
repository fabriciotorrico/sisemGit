@extends('layouts.layoutLogin')

@section('content')



  <form id="loginform" class="form-vertical" role="form" method="post" action="{{ route('login') }}">
      {{ csrf_field() }}

  <!-- Logo -->
  <div class="control-group normal_text"> <h3><img src="img/logo_groupon.png" alt="Logo" /></h3></div>

      <!-- Nombre del sistema -->
      <h3 align="center">Netpon - Empresas</h3>
      <!--p align="center">Por favor, introduzca sus datos</p --!>

      <!-- reCAPTCHA -->
      <div class="control-group">
        <div class="form-group">
            <div class="controls">
                <div class="main_input_box">
                  <div class="col-md-6 col-md-offset-4">
                    {!! Recaptcha::render() !!}
                  </div>
                </div>
            </div>
        </div>
      </div>

      <!-- Usuario -->
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <div class="controls">
              <div class="main_input_box">
                  <span class="add-on bg_lg"><i class="icon-user"> </i></span>
                  <input id="email" type="email" class="form-control" name="email" placeholder="Usuario" value="{{ old('email') }}" required autofocus>

                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif

              </div>
          </div>
      </div>

      <!-- Contraseña -->
      <div class="control-group">
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="icon-lock"></i></span>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
      </div>



      <!-- Recordar >
      <div class="form-group">
          <div class="justify">
              <div class="checkbox">
                  <label>
                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar
                  </label>
              </div>
          </div>
      </div-->

      <div class="form-actions">
        <!-- Boton olvidé mi contraseña -->
          <!--span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Olvidé mi Contraseña</a></span-->
          <!-- Boton iniciar sesión -->
          <span class="pull-right">
            <button type="submit" class="btn btn-success" />
              Iniciar sesión
            </button>
          </span>
      </div>
  </form>


  <!-- Formulario de olvide mi contraseña -->
  <form id="recoverform" action="#" class="form-vertical">
  <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>

          <div class="controls">
              <div class="main_input_box">
                  <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
              </div>
          </div>

      <div class="form-actions">
          <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
          <span class="pull-right"><a class="btn btn-info"/>Reecover</a></span>
      </div>
  </form>


<style>
    /* Centrar reCAPTCHA */
    .g-recaptcha {
      display: inline-block;
    }
</style>
@endsection

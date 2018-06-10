@extends('layouts.layout')
@section('content')
<link rel="stylesheet" href="css/uniform.css" />

<div class="container">
  <div class="row-fluid">

              <!--Si no existen contratos-->
              @if ($contratos->isEmpty())
                <h1></h1>
                <hr>
                <div class="span2">
                </div>

                <div class="span7">
                  <div class="alert alert-block"> <a class="close" data-dismiss="warning" href="#">×</a>
                    <h4 class="alert-heading">Comunicado</h4>
                    Actualmente no cuenta con ningún contrato firmado con la empresa. En caso
                    de existir algún error, favor comunicarse con el administrador.
                  </div>
                </div>
                <p align = justify></p>

              <!--En caso de que existan-->
              @else
                <div class="span3">
                </div>
                <div class="span5">
                  <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                      <h5>Contrtos de la Empresa</h5>
                    </div>
                    <div class="widget-content nopadding">
                      <form class="form-horizontal" role="form" method="POST" action="{{ route('descargarContrato') }}">
                          {{ csrf_field() }}

                        <label class="control-label">Seleccione un contrato</label>
                        <div class="controls">
                          <select name="nombre_archivo">
                            @foreach($contratos as $contrato)
                              <option value={{$contrato->nombre_archivo}}>{{$contrato->descripcion}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-actions">
                          <button type="submit" class="btn btn-success">Descargar Contrato</button>
                        </div>

                        </form>
                      </div>
                    </div>
                  </div>
              @endif
  </div>
</div>
@endsection

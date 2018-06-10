@extends('layouts.layout')

@section('content')

  <!--main-container-part-->
  <div id="content">
    <div class="container-fluid">

      <div class="row-fluid">
        <div class="span9">

          <div class="accordion" id="collapse-group">

            <!--Mostramos las categorias-->
            @foreach ($categorias as $categoria)

              <div class="accordion-group widget-box">
                <div class="accordion-heading">
                  <div class="widget-title">
                    <a data-parent="#collapse-group" href="#{{$categoria->nombre_de_categoria}}" data-toggle="collapse"> <span class="icon"><i class="icon-chevron-down"></i></span>
                      <h5>{{$categoria->nombre_de_categoria}}</h5>
                    </a>
                  </div>
                </div>

                <div class="collapse accordion-body" id="{{$categoria->nombre_de_categoria}}">
                  <div class="widget-content">

                      <div class="widget-content nopadding">
                        <ul class="recent-posts">

                          <!--Para cada promocion que pertenece a esta categoria-->
                          @foreach ($promociones as $promocion)

                            <!--Discriminamos para mostrar las promociones solo en las categoria que pertenece-->
                            @if ($promocion->id_categoria == $categoria->id)

                              <li>
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('formularioIntroducirCupon') }}">
                                    {{ csrf_field() }}

                                  <input id="id_codigo_promocion" type="hidden" class="form-control" name="id_codigo_promocion" value="{{$promocion->codigo_promocion}}">
                                  <input id="imagen" type="hidden" class="form-control" name="imagen" value="{{$promocion->imagen}}">
                                  <input id="nombre" type="hidden" class="form-control" name="nombre" value="{{$promocion->nombre}}">
                                  <input id="precio_pagar" type="hidden" class="form-control" name="precio_pagar" value="{{$promocion->precio_pagar}}">

                                  <div class="user-thumb">
                                    <img width="40" height="40" alt="User" src="img/img_promociones/{{$promocion->imagen}}">
                                  </div>
                                  <div class="article-post">
                                    <div class="fr">
                                      <button type="submit" class="btn btn-success btn-mini">Introducir Cupón</button>
                                    </div>
                                      <h5>{{$promocion->nombre}}</h5>
                                      <div class="fr">
                                        <span class="badge badge-warning"> Bs. {{$promocion->precio_pagar}} </span>
                                      </div>
                                      <p>{{$promocion->descripcion}}</p>
                                  </div>
                                </form>
                              </li>

                            @endif

                          @endforeach

                        </ul>
                      </div>

                  </div>
                </div>
              </div>

            @endforeach

          </div>
        </div>

      </div>
    </div>
  </div>
  <!--main-container-part-->


@endsection

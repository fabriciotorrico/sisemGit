@extends('layouts.layout')
@section('content')

<div class="container">

  <h1></h1>
  <hr>

  <div class="span3">
  </div>

  <div class="span5">
    <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
      <h4 class="alert-heading">Exitoso</h4>
      {{ $mensaje }}
    </div>
  </div>
</div>

@endsection

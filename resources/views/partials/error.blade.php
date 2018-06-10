@extends('layouts.layout')
@section('content')

<div class="container">

  <h1></h1>
  <hr>

  <div class="span2">
  </div>

  <div class="span7">
    <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
      <h4 class="alert-heading">Error</h4>
      {{ $mensaje }}
    </div>
  </div>
</div>

@endsection

@extends('layouts.layout')

@section('content')


<div class="container">
  <div class="container-fluid">
      <div class="row-fluid">
        <div class="span4">
        </div>
        <div class="span5">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-comments"></i> </span>
              <h5>Contáctanos</h5>
            </div>
            <div class="widget-content nopadding">
              <font face="times new roman" size=3><b>
                <p align="center"></p>
                <p align="center"><i class="icon-phone-sign"></i> Teléfono: (+591) 60104841</p>
                <p align="center"><i class="icon-envelope-alt"></i> E-mail: cupon@algo.com</p>
                <p align="center"><i class="icon-facebook-sign"></i> Facebook: cupon empresa</p>
              </font></b>
            </div>
          </div>
        </div>
      </div>
      <div class="row-fluid">
        <div class="span2"></div>
        <div class="span8">
          <h2 align="center"> Video Tutorial</h2>
          <iframe width="800" height="500" src="https://www.youtube.com/embed/NXedjxWnkvw" frameborder="0" allowfullscreen></iframe>
        </div>
      </div>
      <div class="row-fluid">
        <div class="span2"></div>
        <div class="span8">
          <h2 align="center">Manual de Usuario</h2>
          <iframe src="/carpAyudas/groupon.pdf" style="width:800px; height:550px;" frameborder="0"></iframe>
        </div>
      </div>
  </div>
</div>

@endsection

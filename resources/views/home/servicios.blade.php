@extends('home.index')

@section('title', 'Servicios - Residencial Moquegua')

@section('content')
<section ng-controller="carritoController" ng-init="getDias();getTipoCambio();getTiposPago();getBancos();">
  @include('home.car')
</section>
<div class="container" style="width: 100%;background-color: rgb(240,240,240);padding:0;margin:0">
  <div class="row" style="width:90%;margin:30px auto 40px auto">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
              <div class="list-group">
                <a href="#" class="list-group-item active text-center">
                  <h4></h4>Presentaci&oacute;n
                </a>
                @foreach ($datos[1] as $ser)
                <a href="#" class="list-group-item text-center">
                  <h4></h4>{{$ser->nombre}}
                </a>
                @endforeach 
              </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                <!-- flight section -->
                <div class="bhoechie-tab-content active">
                    <center>
                      <h1 class="glyphicon glyphicon-plane" style="font-size:14em;color:#55518a"></h1>
                      <h2 style="margin-top: 0;color:#55518a">Presentaci&oacute;n</h2>
                      <img src="imagen/Categoria/main/{{$datos[0][0]->imagen}}" class="img-responsive" alt="{{$datos[0][0]->nombre}} hotel moquegua residencial moquegua"><br>
                      <h3 style="margin-top: 0;color:#55518a">{!! $datos[0][0]->contenido !!}</h3>
                    </center>
                </div>
                <!-- train section -->
                @foreach ($datos[1] as $ser)
                <div class="bhoechie-tab-content">
                    <center>
                      <h1 class="glyphicon glyphicon-plane" style="font-size:14em;color:#55518a"></h1>
                      <h2 style="margin-top: 0;color:#55518a">{{$ser->nombre}}</h2>
                      <img src="imagen/sliders/{{$ser->foto}}" class="img-responsive" alt="Residencial moquegua {{$ser->nombre}}"><br>
                      {!! $ser->descripcion !!}
                      @foreach ($ser->servicios as $unit)
                      <div class="row" style="width: 90%;margin:10px auto 10px auto">
                        <div class="col-md-7">
                          <h3>{{$unit->servicio}}</h3>
                          {!! $unit->descripcion !!}
                        </div>
                        <div class="col-md-5" style="padding:0">
                          <img src="imagen/Categoria/{{$unit->foto}}" class="img-responsive" alt="residencial moquegua {{$unit->servicio}}" style="border-radius:5px;">
                        </div>
                      </div>
                      @endforeach 
                    </center>
                </div>
                @endforeach 
            </div>
        </div>
  </div>
</div>
@endsection
@extends('home.index')

@section('title', 'Informandote - Residencial Moquegua')

@section('content')
	<section ng-controller="carritoController" ng-init="getDias();getTipoCambio();getTiposPago();getBancos();">
		@include('home.car')
	</section>
	<div class="general">
		<div style="width:80%;margin:20px auto 10px auto">
			<div class="row">
					<div class="col-md-12 col-sm-12 animate-box">
						<div  class="item-grid">
							<div class="v-align">
							<h2 class="title text-center">{{$datos[0]->titulo}}</h2>
							<p class="text-center" style="color:black">{{$datos[0]->resumen}}</p>
							<img class="img-responsive center-block" src="../imagen/Noticia/{{$datos[0]->imagen}}" alt="{{$datos[0]->titulo}}"><br>
								<div class="v-align-middle">
									{!! $datos[0]->contenido !!}
									<strong class="date" style="color:black"><span>{{$datos[0]->fecha}}</span> | <span>{{$datos[0]->fuente}}</span></strong>
								</div>
							</div>
							<div class="col-md-12 text-center animate-box">
							<p><a href="{{ url('/Noticias') }}" class="btn btn-primary with-arrow">Regresar<i class="icon-arrow-left"></i></a></p>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
	
@endsection
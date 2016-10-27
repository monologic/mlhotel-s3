@extends('home.index')

@section('title', 'Noticias - Residencial Moquegua')

@section('content')
	<section ng-controller="carritoController" ng-init="getDias();getTipoCambio();getTiposPago();getBancos();">
		@include('home.car')
	</section>
	<div class="general">
		<div style="width:80%;margin:20px auto 10px auto">
			<div class="row">
				@foreach($datos[0] as $not)
					<div class="col-md-6 col-sm-6 animate-box">
						<div  class="item-grid">
							<img class="img-responsive" src="imagen/Noticia/{{$not->imagen}}" alt="{{$not->titulo}}" style="max-height:250px;width:100%">
							<div class="v-align">
								<div class="v-align-middle">
									<h3 class="title" style=" min-height:55px">{{$not->titulo}}</h3>
									<h5 class="date" style="color:black"><span>{{$not->fecha}}</span> | <span>{{$not->fuente}}</span></h5>
								</div>
							</div>
							<div class="col-md-12 text-center animate-box">
							<p><a href="Noticias/{{$not->id}}" class="btn btn-primary with-arrow">Noticia Completa<i class="icon-arrow-right"></i></a></p>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		
		{!! $datos[0]->render() !!}
	</div>
	
@endsection
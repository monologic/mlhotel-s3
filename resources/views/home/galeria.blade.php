@extends('home.index')

@section('title', 'Galeria - Residencial Moquegua')

@section('content')
	<section ng-controller="carritoController" ng-init="getDias();getTipoCambio();getTiposPago();getBancos();">
		@include('home.car')
	</section>
	<div class="general">
		<h1 class="text-center">Galeria de imagenes</h1>
			<div id="grid-video" class="grid-gallery">
					<section class="grid-wrap animate-box">
						<ul class="grid">
						 @foreach ($datos[0] as $fotos)
							<li>
								<figure>
									<div class="vdo" style="background-image: url('imagen/galery/{{$fotos->imagen}}');background-size: contain;background-repeat: no-repeat;background-position: center;width:100%;height:150px">
								    	
								    </div>
									<p class="text-center">{{$fotos->titulo}}</p>
								</figure>
							</li>
							@endforeach 
						</ul>
					</section><!-- // grid-wrap -->
					<section class="slideshow vid">
						<ul>
						  @foreach ($datos[0] as $fotos)
							<li>
								<figure>
									<figcaption>
										<h4 style="font-size:1.1em;">{{$fotos->titulo}}</h4>
										<p>{!!$fotos->descripcion!!}</p>
									</figcaption>
									<div class="vdo">
								    	<img src="imagen/galery/{{$fotos->imagen}}" alt="{{$fotos->titulo}} residencial moquegua hotel">
								    </div>
								</figure>
							</li>
							@endforeach 
						</ul>
						<nav>
							<span class="icon nav-prev"></span>
							<span class="icon nav-next"></span>
							<span class="icon nav-close"></span>
						</nav>
						
					</section><!-- // slideshow -->
			</div>
		</div>
	<script src="assets/GridGallery/js/imagesloaded.pkgd.min.js"></script>
	<script src="assets/GridGallery/js/masonry.pkgd.min.js"></script>
	<script src="assets/GridGallery/js/classie.js"></script>
	<script src="assets/GridGallery/js/cbpGridGallery.js"></script>
	<script>
		new CBPGridGallery( document.getElementById( 'grid-video') );
	</script>
@endsection
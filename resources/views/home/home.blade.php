@extends('home.index')

@section('title', 'Residencial Moquegua')

@section('content')
<section ng-controller="carritoController" ng-init="getDias();getTipoCambio();getTiposPago();getBancos();">
	@include('home.car')
</section>
<section>
	<aside id="fh5co-hero" class="js-fullheight">
		<div class="flexslider js-fullheight">
			<div class="fechas-reserva" ng-controller="reservaController">
				<div class="row center-block" style="width:220px;">
					<div class="col-xs-12" style="margin-bottom:20px">
						<div>
							<label for="">Fecha entrada : </label>
							<input type="text" class="form-kira" onchange="fe()" id="fechaini">
						</div>
					</div>
					<div class="col-xs-12" style="margin-bottom:20px">
						<label for="">Fecha salida : </label>
						<input type="text" class="form-kira "  id="fechafin">
					</div>
					<div>
						<button class="btn-kira" ng-click='buscarHab();'>Reservar</button>
					</div>
				</div>
			</div>
			<ul class="slides">
			@foreach ($datos[0] as $s)
			   	<li style="background-image: url(imagen/sliders/{{$s->imagen}});">
			   		<div class="overlay-gradient"></div>
			   		<div class="cont">
			   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
			   				<div class="slider-text-inner">
			   					<h2>{{$s->titulo}}</h2>
			   				</div>
			   			</div>
			   		</div>
			   	</li>
			@endforeach 
		  	</ul>
	  	</div>
	</aside>
	<div id="fh5co-services-section" class="ctx">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading animate-box">
					<h2>Nuestros servicios</h2>
				</div>
			</div>
			<div class="row">
			@foreach ($datos[1] as $i)
				@if ($i->estado == 'true')
					<div class="col-md-4 animate-box">
						<div class="services glyph">
							<i class="glyph-icon {{$i->icono}}" style="color:black;font-size:2rem"></i>
							<div class="desc">
								<h3>{{$i->nombre}}</h3>
								<p style="font-size:14px;height:85px">{{$i->descripcion}}</p>
							</div>
						</div>
					</div>
				@endif
			@endforeach
			</div>
		</div>
	</div>
	<div id="fh5co-work-section" class="fh5co-light-grey-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading animate-box">
					<h2>Nuestras Habitaciones</h2>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
				</div>
			</div>
			<div class="row">
			@foreach ($datos[2] as $a)
				<div class="col-md-4 animate-box">
					<a href="#" class="item-grid text-center">
						<div class="image" style="background-image: url(imagen/habitaciones/{{$a->foto}})"></div>
						<div class="v-align">
							<div class="v-align-middle">
								<h3 class="title">{{$a->nombre}}</h3>
								<div style="color:black"><sup class="">S/</sup>{{$a->precio}}</div><br>
								<button class="btn btn-success btn-outline btn-sm" onclick = "javascript:window.location='Habitaciones/{{$a->id}}'"><i class="fa fa-plus"></i> Informaci&oacute;n</button>
							</div>
						</div>
					</a>
				</div>
			@endforeach
			</div>
		</div>
	</div>
	<div id="fh5co-testimony-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading animate-box">
					<h2>Noticias recientes</h2>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-offset-0 to-animate">
					<div class="wrap-testimony animate-box">
						<div class="owl-carousel-fullwidth">
							@foreach ($datos[3] as $not)
							<div class="item">
								<div class="testimony-slide active text-center">
									<figure>
										<img src="imagen/Noticia/{{$not->imagen}}" alt="user">
									</figure>
									<blockquote>
										<p>{{$not->resumen}}</p>
									</blockquote>
									<span><a href="/" class="btn btn-primary">Noticia Completa</a></span>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
	
	<script>
	  function fe(){
	        fecha = $( "#fechaini" ).val();
	        fecha = fecha.split("-")
	        var f = new Date(fecha[2] + "-" + fecha[1] + "-" + fecha[0]);
	        f = f.getTime();
	        f = f + 2*24*60*60*1000;
	        f = new Date(f);
	        //alert(f);
	        fec = twoDigits(f.getDate()) + "-" + twoDigits(f.getMonth()+1) + "-" + f.getFullYear();
	        $( "#fechafin" ).val(fec);
	    }
	    function twoDigits(d) {
	        if(0 <= d && d < 10) return "0" + d.toString();
	        if(-10 < d && d < 0) return "-0" + (-1*d).toString();
	        return d.toString();
	    }

	  $(function() {
	    $( "#fechaini" ).datepicker({
	    showOn: "both",
 		 buttonImageOnly: true,
  		buttonImage: "index/images/minc.png",
  		buttonText: "Calendar",
	    dateFormat: "dd-mm-yy",
      	monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Agos", "Sep", "Oct", "Nov", "Dic" ],
	      dayNamesMin: [ "Do", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab" ],
	      defaultDate: "+1d",
	      minDate: 0,
	      onClose: function() {
	        $( "#fechafin" ).datepicker( "option", "minDate", fec);
	      }
	    });
	    $( "#fechafin" ).datepicker({
	    	showOn: "both",
 		 buttonImageOnly: true,
  		buttonImage: "index/images/minc.png",
  		buttonText: "Calendar",
	      dateFormat: "dd-mm-yy",
	      monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Agos", "Sep", "Oct", "Nov", "Dic" ],
	      dayNamesMin: [ "Do", "Lu", "Mar", "Mi", "Ju", "Vi", "Sa" ],
	      minDate: 1,
	      });
	  });
	</script>
@endsection
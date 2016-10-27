@extends('home.index')

@section('title', 'Habitacion - Residencial Moquegua')

@section('content')
	<section ng-controller="carritoController" ng-init="haburl();">
		@include('home.car')
	</section>
	<div class="general" ng-controller="habtipogalController" ng-init="haburl();">
		<div class="cont row">
			<section class="col-md-9" style="background-color:white;padding:20px">
				<div style=" display: block;position: relative;width:100%;height:500px;margin-bottom:80px">
					<h2> {{$datos[0]->nombre}} <strong id="idb" style="visibility:hidden">{{$datos[0]->id}}</strong></h2>
					<hr>
			        <div class="swiper-container gallery-top">
			            <div class="swiper-wrapper">
			            @foreach($datos as $y)
			            	@foreach($y->habtipofotos as $r)
			                <div class="swiper-slide" style="background-image:url('../imagen/habitaciones/galeria/{{$r->foto}}')"></div>
			                @endforeach 
			            @endforeach 
			            </div>
			            <!-- Add Arrows -->
			            <div class="swiper-button-next swiper-button-white"></div>
			            <div class="swiper-button-prev swiper-button-white"></div>
			        </div>
			        <div class="swiper-container gallery-thumbs">
			            <div class="swiper-wrapper">
			            @foreach($datos as $t)
			            	@foreach($t->habtipofotos as $k)
			                <div class="swiper-slide" style="background-image:url('../imagen/habitaciones/galeria/{{$k->foto}}')"></div>
			                @endforeach 
			            @endforeach 
			            </div>
			        </div>
			      </div>
			      <hr>
			      <div>
			      	<strong>Descripci&oacute;n : </strong>
			      	{!!$datos[0]->descripcion!!}
			      </div>
			</section>
			<section class="col-md-3">
				<div class="box-reservar">
					<ul>
					<li><h4 class="text-center">Servicios : </h4></li>
			           @foreach($datos as $i)
			            	@foreach($i->habtipo_serviciointernos as $j)
			            		@if ($j->estado == 'true')
			            			<li>
			            				<i class="fa {{ $j['serviciointerno']->icono}}" to"></i>&nbsp;
			            				<span> {{ $j['serviciointerno']->nombre}}</span>
			            			</li>
			            		@endif
			            	@endforeach 
			            @endforeach 
			         </ul>
				</div>
			</section>
			<section class="col-md-3">
				<div class="box-reservar" id="box-r" style="min-height:300px">
					<h4 class="text-center">Reserve Ahora !</h4 class="text-center">
					<form ng-submit="buscarHab()">
					<div class="col-md-12">
						<div style="margin-bottom:10px">
							<span for="">Fecha entrada : </span>
							<input type="text" class="form-kira" onchange="fe()" id="fechaini">
						</div>	
					</div>
					<div class="col-md-12"  style="margin-bottom:10px">
						<span for="">Fecha entrada : </span>
						<input type="text" class="form-kira" id="fechafin">
					</div>
					<div class="col-md-12">
						<div id="buscar" style="width:100px;margin:20px auto 20px auto">
							<button type="submit" class="btn btn-primary btn-outline  btn-sm" ng-click='buscarHab();'>Buscar</button>
						</div>
						<div id="reservar" style="display:none">
		                    <div class="text-center info-hab">Disponible : @{{busqueda.habitacionescount-busqueda.habtiporeservascount}}</div>
		                    <div  style="width:100px;margin:20px auto 20px auto">
		                    	<a class="btn btn-primary btn-outline  btn-sm" onclick="alertR()" ng-click='addCarrito(busqueda);'>Reservar</a>
		                    </div>
		       			</div>
					</div>
					</form>
				</div>
			</section>
		</div>

	</div>
	<script src="{{asset('plugins/slider/js/swiper.min.js')}}"></script> 
	<script>
	    var galleryTop = new Swiper('.gallery-top', {
	        nextButton: '.swiper-button-next',
	        prevButton: '.swiper-button-prev',
	        spaceBetween: 10,
	    });
	    var galleryThumbs = new Swiper('.gallery-thumbs', {
	        spaceBetween: 10,
	        centeredSlides: true,
	        slidesPerView: 'auto',
	        touchRatio: 0.2,
	        slideToClickedSlide: true
	    });
	    galleryTop.params.control = galleryThumbs;
	    galleryThumbs.params.control = galleryTop;
    </script> 
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
	  		buttonImage: "../index/images/minc.png",
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
	  		buttonImage: "../index/images/minc.png",
	  		buttonText: "Calendar",
	      	dateFormat: "dd-mm-yy",
	     	 monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Agos", "Sep", "Oct", "Nov", "Dic" ],
	      	dayNamesMin: [ "Do", "Lu", "Mar", "Mi", "Ju", "Vi", "Sa" ],
	      	minDate: 1,
	      });
	  });
	</script>
@endsection
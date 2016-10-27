@extends('home.index')

@section('title', 'Galeria - Residencial Moquegua')

@section('content')
	<section ng-controller="carritoController" ng-init="getDias();getTipoCambio();getTiposPago();getBancos();">
		@include('home.car')
	</section>
	<div class="general">
		<div class="row cont-c">
		    <form  method="POST" action="send"  class="col-md-6"  enctype="multipart/form-data" style="padding:15px">
		      <h3 class="text-center" >Contacto</h3>
		        <div class="form-group">
		            <label for="nombre">Asunto</label>
		            <input class="form-control" placeholder="Asunto" required="required" name="subject" type="text" id="subject">
		        </div>
		        <br>
		      <div class="form-group">
		          <label for="exampleInputEmail1">Correo</label>
		          <input type="email" class="form-control" id="email" name="email" placeholder="Email">
		        </div>
		        <br>  
		        <div class="fomr-group">
		           <label for="tipo">Mensaje</label>
		         <textarea  class="form-control" rows="5" id="body" name="body"></textarea>
		        </div>
		        <br>
		        <input type="submit" class="btn btn-primary" onclick="confir()" style="width:150px" value="Enviar">
		        <div id="msj" class="card-panel teal lighten-3" style="display: none;color:white;text-align: center">Mensaje enviado</div>

		    </form>
		    <div class="col-md-6" style="padding:15px">
		    	<h3>Contact Info.</h3>
				<ul class="contact-info">
					<li><i class="icon-map"></i>{{$datos[0]->direccion}}, {{$datos[0]->ciudad}} - {{$datos[0]->pais}}</li>
					<li><i class="icon-phone"></i>{{$datos[0]->telefono}}</li>
					<li><i class="icon-envelope"></i>{{$datos[0]->correo}}</li>
					<li><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>{{$datos[0]->checkin}}</li>
					<li><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>{{$datos[0]->checkout}}</li>
				</ul>
		    </div>
    	</div>
    	<div class="cont-c">
    			<br>
    			<h3 class="text-center">Nuestra Ubicación</h3>
	    		<div id="map" style="display:block;position: relative;width:100%;height:300"></div>
    	</div>
    	
	</div>
	<script>
	function initMap() {
	  var myLatLng = {lat: -17.195456, lng:-70.934268};

	  var map = new google.maps.Map(document.getElementById('map'), {
	    zoom: 17,
	    center: myLatLng
	  });

	  var marker = new google.maps.Marker({
	    position: myLatLng,
	    map: map,
	    title: 'Residencial Moquegua'
	  });
	}
	</script>
	<script src="http://maps.google.com/maps/api/js?sensor=false&callback=initMap"></script>
@endsection
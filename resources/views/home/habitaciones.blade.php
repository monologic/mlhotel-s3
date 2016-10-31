@extends('home.index')

@section('title', 'Habitaciones - Residencial Moquegua')

@section('content')
	<div class="general" ng-controller="habtipoController" ng-init="buscarAuto();getHabTipo()">
	@include('home.car')
		<div class="cont">
			<section class="row" style="background-color:#FFF;padding:15px;margin:20px auto 30px auto">
				<div class="col-md-5">
					<div>
						<label for="">Fecha entrada : </label>
						<input type="text" class="form-kira" onchange="fe()" id="fechaini">
					</div>
					
				</div>
				<div class="col-md-5">
					<label for="">Fecha salida : </label>
					<input type="text" class="form-kira" id="fechafin">
				</div>
				<div class="col-md-2">
					<button class="btn btn-success btn-outline  btn-sm center-block" ng-click='buscarHab();'>Buscar</button>
				</div>
			</section>
			<section ng-if="dias == null" class="row habit fadeInUp animated animate-box" ng-repeat="y in habtipos" on-finish-render="ngRepeatFinished">
				<div class=" col-md-4 hab-img">
					<img src="imagen/habitaciones/@{{y.foto}}" width="100%" class="img-responsive s" alt="Resiedencial Hoquegua hotel">
				</div>
				<div class="col-md-6 hab-descripcion">
					<h3>@{{y.nombre}}</h3>
					<div style="margin-top:-25px" id="@{{y.id}}"></div>
					<hr>
					<div class="cont-ico" ng-repeat="w in y.habtipo_serviciointernos" ng-if="w.estado=='true'">
							<div class="to"><i class="@{{w.serviciointerno.icono}} to" style="font-size:20px"></i>
								<span class="tooltiptext">@{{w.serviciointerno.nombre}}</span>
							</div>
					</div>
				</div>
				<div class=" col-md-2 Reservar">
					<p>Desde</p>
					<div class="price"><sup class="currency">S/</sup>@{{y.precio}}<br><small>/ Noche</small></div>
					<div style="width:80px;margin:10px auto 10px auto">
						<button class="btn btn-success btn-outline btn-sm" ng-click ="rec(y.id)" style="margin-left:-15px"><i class=" fa fa-plus"></i>&nbsp; Detalles</button>
					</div>
				</div>
			</section>
			<section ng-if="dias != null" class="row habit fadeInUp animated animate-box" ng-repeat="y in tipoPerHabs" on-finish-render="ngRepeatFinished2">
				<div class=" col-md-4 hab-img">
					<img src="imagen/habitaciones/@{{y.foto}}" width="100%" class="img-responsive s" alt="Resiedencial Hoquegua hotel">
				</div>
				<div class="col-md-6 hab-descripcion">
					<h3>@{{y.nombre}}</h3>
					<div style="margin-top:-25px" id="@{{y.id}}"></div>
					
					<div class="cont-ico" ng-repeat="w in y.habtipo_serviciointernos" ng-if="w.estado=='true'">
							<div class="to"><i class="@{{w.serviciointerno.icono}} to"></i>
								<span class="tooltiptext">@{{w.serviciointerno.nombre}}</span>
							</div>
					</div>
				</div>
				<div class=" col-md-2 Reservar">
					<strong class="hd">Disponible : @{{y.habitacionescount-y.habtiporeservascount}}</strong>
					<div class="price"><sup class="currency">S/</sup>@{{y.precio}}<br><small>/ Noche</small></div>
					<div ng-if='(y.habitacionescount-y.habtiporeservascount)>0' style="width: 100px;margin:20px auto 20px auto;"">
						<button class="btn btn-success btn-outline btn-sm" onclick="alertR()" ng-click="addCarrito(y);">Reservar</button>
					</div>
					
				</div>
			</section>
		</div>
	</div>
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
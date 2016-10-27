@extends('home.index')

@section('title', 'Pago por paypal - Residencial Moquegua')

@section('content')
	<div class="general">
		<div ng-controller="hotelController" ng-init="getHotelesF();" style="top:0;width: 60%;margin:10% auto 10% auto">
			<p class="block-center" align="center" style="font-size: 30px">Gracias por hacer su reserva, envíenos un email a <strong>@{{infos.correo}}</strong>  adjuntando el comprobante de depósito con el numero de Operación, le Confirmaremos su reserva por Email.</p>
		</div>
	</div>
@endsection
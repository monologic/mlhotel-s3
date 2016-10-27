<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
	<div class="centrado-porcentual">
  	<h2>Confirmación de Reserva</h2>
  	<p>
  		Estimado Cliente:
  	</p>
  	<p>Le agradecemos su preferencia!</p>
	<p>Ud. ha realizado la siguiente reserva:</p>
  <p>Código de Reserva: {{ $codigo_reserva }}</p>
	<p>Fecha Ingreso o Check in : {{ $fecha_inicio }}</p>
	<p>Fecha Salida o Check out: {{ $fecha_fin }}</p>
  	<p>
  		<table>
  			@foreach ($habtiposcount as $habtipo)
			    <tr>
			    	<td>{{ $habtipo['count'] }}</td>
			    	<td>{{ $habtipo['nombre'] }}</td>
			    </tr>
			@endforeach
  		</table>
  	</p>
  	<p>El horario de Check-in es {{ $hotel['checkin'] }} y el Check-out es {{ $hotel['checkout'] }}.</p>
  	<p>
  		El pago de la reserva, tal como lo solicitó se efectuó debitando su cuenta Paypal el importe de {{ round(($total_pagado / $moneda['tipocambio']), 2) }} dólares.
  		
  	</p>
</div>
</body>
</html>
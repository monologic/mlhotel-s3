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
  		El pago de la reserva, tal como lo solicitó será efectuada vía depósito bancario en nuestra cuenta en el Banco <strong>{{ $banco['banco'] }}</strong> Nro de cuenta <strong>{{ $banco['cuenta'] }}</strong>,CCI <strong>{{ $banco['cci'] }}</strong> por el importe de S/ {{$apagar}}. Le rogamos se sirva enviarnos el voucher del depósito a efectos de confirmar su reserva vía correo electrónico a la dirección {{$hotel['correo']}}.
  	</p>

</div>
</body>
</html>
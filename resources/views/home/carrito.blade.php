@extends('home.index')

@section('title', 'Carrito - Residencial Moquegua')

@section('content')
	<div class="general">
		<div class="newcont" ng-controller="carritoController" ng-init="getDias();getTipoCambio();getTiposPago();getBancos();">
		    <form ng-submit="guardarCliente()">
		    	<div class="row" style="margin:auto">
		    		<section class="col-md-8">
			    		<div class="ctn-cart">
			    			<h3 class="text-center" style="color: #00897b;margin-top:20px">Mis reservas</h3>
				        	<hr>
				        	<div class="row">
				        		<div class="col-md-8">
					        		<table class="table" >
						              <thead>
						                <tr class="font-tab">
						                  <th>Habitación</th>
						                  <th>Cant.</th>
						                  <th>Precio</th>
						                  <th>Subtotal</th>
						                </tr>
						              </thead>
						              <tbody>
						                <tr class="sbr" ng-repeat="o in car">
						                  <td class="sbr">@{{o.nombre}}</td>
						                  <td class="sbr">@{{o.quantity}}</td>
						                  <td class="sbr">S/ @{{o.precio}}</td>
						                  <td id="@{{$index+1}}s" class="sbr">S/ @{{o.precio*o.quantity}}.00</td>
						                </tr>
						                <tr>
						                  <td class="sbr"></td>
						                  <td class="sbr"></td>
						                  <td class="sbr" style="text-align: right;padding-right: 5px">Total/noche: </td>
						                  <td class="sbr">@{{totalq}}</td>
						                </tr>
						                <tr>
						                  <td class="sbr"> Por noches @{{ dias }} </td>
						                  <td class="sbr"></td>
						                  <td class="sbr" style="text-align: right;padding-right: 15px">Total :</td>
						                  <td class="sbr">S/ @{{Total}}</td>
						                </tr>
						              </tbody class="sbr">
						            </table>
					            </div>
					            <div class="col-md-4 col-xs-12" style="border-left:1px solid #D2D7D3">
					            	<p style="color: #00897b">Elija un método de pago</p>
					                <div ng-if="pagoCero==1" class="col-md-12 col-xs-12" id="pagoCeroDiv" style="margin-bottom:20px">
						            	<input name="opciones" type="radio" id="test1" ng-model="formaPago.name" value="pagoCero" ng-change="cambioFormaPago()"/>
						                  <label for="test1" style="color: #1976d2;font-weight: bold;">Pago en destino</label>
					                </div>
					                <div class="col-md-12 col-xs-12" id="paypalDiv">
					                  <input name="opciones" type="radio" id="test2" ng-model="formaPago.name" value="pagoPaypal" ng-change="cambioFormaPago()"/>
					                  <label for="test2" style="color: #009688"><img src="paypal.png" style="width: 60px;margin-top: -10px"></label>
					                </div>
					                <div class="col-md-12 col-xs-12"  id="depositoDiv">
					                  <input name="opciones" type="radio" id="test3" ng-model="formaPago.name" value="pagoDeposito" ng-change="cambioFormaPago()"/>
					                  <label for="test3" style="color: #009688"><img src="deposito.png" style="width: 70px;margin-top: 5px"></label>
					                </div>
					           	</div>
					           	<div class="col-md-12" id="divPorcenBan" style="display: none;">
					            	<hr>
					             	<div id="divBanco" class="col-md-6" style="display: none;">
						                <div class="col-md-12 col-xs-12"  style="color:#00695c" >Seleccione el Banco: </div>
						                <select class="col-md-6 col-xs-6 form-control"  ng-model="banco" id="banco" style="padding:3px">
						                  <option value="" disabled selected></option>
						                  <option ng-repeat="banco in bancos" on-finish-render="ngRepeatFinished" value="@{{banco.id}}" data-icon="banco/@{{ banco.imagen }}" class="left circle">@{{ banco.banco }}</option>
						                </select>
						            </div>
				            	<div class="col-md-6" id="sel-p">
				                	<div class="col-md-12" id="porcentajePago" style="color:#00695c">
				                    	<div class="col-md-12" style="color:#00695c">
				                        	<p>Porcentaje de pago:</p>
				                      	</div>
				                      	<div class="col-md-6">
				                        	<input name="group1" type="radio" ng-model="porcentajeRadio.name" ng-change="calcularTotal()" id="radio1" value="0.2"/>
				                        	<label for="radio1">20%</label>
				                      	</div>
				                    	<div class="col-md-6" >
				                        	<input name="group1" type="radio" ng-model="porcentajeRadio.name" ng-change="calcularTotal()" id="radio2" value="1" />
				                        	<label for="radio2">100%</label>
				                      	</div>
				                	</div>
				                </div>
			                	<div class="totales" style="display: none;visibility: hidden">
				                	<div class="col m12" style="margin-top: 40px;word-spacing:20px;color:#00695c;" id="TotalR">
				                  	</div>
				                	<div class="col m12" style="margin-top: 40px;word-spacing:20px;color:#00695c;" id="TotalRCero">
				                  	</div>
				                </div>
				        	</div>	
			    		</div>
			    	</section>
			    	<section  class="col-md-4">
			    		<div class="ctn-cart">
			    			<section>
					    		<h3 style="color: #00897b;text-align:center;margin-top:20px">Ingrese su información</h3>
					    		<hr>
					            <div class="form-group" style="margin-top:5px">
									<label for="nombre">Nombres</label>
					            	<input id="nombre" type="text" class="form-control" ng-model="nombres"  required> 	
					            </div>
					            <div class="form-group">
					            	<label for="apellido">Apellidos</label>
					              <input id="apellido" type="text" class="form-control" ng-model="apellidos" required>
					            </div>
					            <div class="form-group">
									<label for="dni">Identificación (DNI)</label>
					            	<input id="dni" type="text" class="form-control" ng-model="dni" required>
					            </div>
					            <div class="form-group">
					            	<label for="tel" style="color: #6C7A89;margin-bottom: 0px">Teléfono (opcional)</label>
					              	<input id="tel" type="text" class="form-control" ng-model="telefono" >
					            </div>
					            <div class="form-group">
					            	<label for="email">Email</label>
					              	<input id="email" type="email" class="form-control" ng-model="email" required>
					            </div>
					            <div class="form-group">
					              <input type="checkbox" id="test5" ng-model="terminos" ng-change="activarBtn()" class="validate" /><label for="test5" style="color: black;font-size: 1.2rem">Por favor <a style="font-size: 1rem" class="modal-trigger"  href="#modal1"> leer y aceptar </a>  los términos y condiciones. Gracias.</label>
					              </div>
					            <div style="width:80px;margin:20px auto 20px auto">
					              <button type="submit" class="btn btn-success btn-outline btn-sm" disabled id="btn-res">Reservar</button>
					            </div> 
					    	</section>
			    		</div>
			    	</section> 
		    	</div>
		    </form>
		</div>
	</div>
@endsection
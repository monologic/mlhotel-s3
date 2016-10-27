<div id="caja" style="margin-top:-30px">
    <br>
    <h2 class="text-center mr">Mis Reservas</h2>
    <div class="cont-caja">
    <div id="cont-table">
      <div class="row">
        <p class="text-center"><strong>Estancia : @{{ dias }} noche(s). </strong></p>
      </div>
      <table class="tb-kira">
        <thead>
          <tr>
            <th> Habitación </th>
            <th> Cant. </th>
            <th> Precio </th>
            <th> Subtotal </th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="o in car">
            <td>@{{o.nombre}}</td>
            <td width="50px">
              <select id="@{{$index+1}}" ng-model="myOption" ng-options="range for range in range(1,o.max) track by range"  ng-change="actualizar(@{{$index+1}}, o.id, car);actualizarTotal(car)"></select>
            </td>
            <td style="text-align: center">@{{o.precio}}</td>
            <td id="@{{$index+1}}s" style="text-align: center">@{{o.precio*o.quantity}}.00</td>
            <td class="sbr"><a class="delete-hab" ng-click="eliminarItem(o.id);"><i class="fa fa-trash"></i></a></td>
          </tr>
          <tr>
            <td class="sbr"></td>
            <td colspan="2" class="sbr">Total por Día:</td>
            <td ng-bind="totalq" class="sbr"></td>
          </tr>
          <tr>
            <td class="sbr"></td>
            <td class="sbr"></td>
            <td class="sbr">Total:</td>
            <td class="sbr">S/ @{{Total}}</td>
          </tr>
        </tbody>
      </table>
    </div>
      <hr>
      <div>
        <a id="btnc" class="center-block" ng-click="actualizarCarrito(car)">Continuar</a>
      </div>    
    </div>
</div> 
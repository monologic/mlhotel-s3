app.controller('carritoController', function($scope,$http) {

    $scope.enviarhab = function () {
        $http.post('service/carrito',
            {   'nombre':$scope.nombre,
                'capacidad':$scope.capacidad,
                'precio':$scope.precio
            }).then(function successCallback(response) {
                $scope.mensaje = response.data.mensaje;
            }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            });
    }
    var pre="";
    $scope.haburl = function(){
        pre="../";
        $scope.getDias();
    }
    $scope.actualizarCarrito = function () {
        data = $scope.car;
        var v = 0;
        for(y in data){
            if (parseInt(data[y].quantity) > parseInt(data[y].max) || parseInt(data[y].quantity) <= 0)
                v = 1;
        }
        if (v == 1) {
            $('#alerta-dis').css('display','block');
        }
        else
        {
            for (x in data) {
                $http.get('cart/update/'+data[x].id + '/' + data[x].quantity,
                {
                }).then(function successCallback(response) {
                }, function errorCallback(response) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
                });
            }
            window.location.href = '/Carrito';
        }
    }
    $scope.range = function(min, max, step) {
        step = step || 1;
        var input = [];
        for (var i = min; i <= max; i += step) {
            input.push(i);
        }
        $scope.myOption = input[0];
        return input; 
    };
    $scope.eliminarItem = function (id) {
        $http.get(pre+'cart/delete/'+id,
            {
            }).then(function successCallback(response) {
                $scope.res();
            }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            });
    }

    $scope.vaciarCarrito = function () {
        $http.get(pre+'cart/trash',
            {
            }).then(function successCallback(response) {
                $scope.res();
            }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            });
    }
    $scope.res = function (fechas) {
        
        $http.get(pre+'cart/show',
            {
            }).then(function successCallback(response) {
                $scope.car = response.data;
                $scope.actualizarTotal($scope.car, fechas);
            }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            });
        
    }
    $scope.cambioFormaPago = function () {
        if ($scope.formaPago.name != 'pagoCero'){
            $('#divPorcenBan').css('display','block');
            if ($scope.formaPago.name == 'pagoDeposito')
                $('#divBanco').css('display','block');
            else
                $('#divBanco').css('display','none');
        }
        else
            $('#divPorcenBan').css('display','none');
    }
    $scope.actualizarTotal = function(data, fechas){
        var total=0;
        for (x in data) {
            subp=data[x].precio*data[x].quantity;
            total+=subp;
        }
        $scope.totalN = total.toFixed(2);
        $scope.totalq = 'S/ ' + total + '.00';
        $scope.Total = ($scope.totalN * fechas.dias).toFixed(2);

    }
    $scope.addCarrito = function (data) {
        max = data.habitacionescount-data.habtiporeservascount;
        $http.get(pre+'cart/add/'+data.id+'/'+max,
            {
            }).then(function successCallback(response) {
                $scope.res($scope.dias);
            }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            });
    }
    $scope.guardarCliente = function () {
        elemento = document.getElementById("test5");
        opciones = document.getElementsByName("opciones");
        porcen = document.getElementsByName("group1");
        var seleccionado = false;
        var cobro = false;

        for(var i=0; i<porcen.length; i++) {    
          if(porcen[i].checked) {
            cobro = true;
            break;
          }
        }
        for(var i=0; i<opciones.length; i++) {    
          if(opciones[i].checked) {
            seleccionado = true;
            break;
          }
        }
        if( !elemento.checked ) {
            swal("Faltan datos", "Tienes que aceptar los terminos de condiciones", "warning");
        }
        else{
            if(!seleccionado) {
                swal("Faltan datos", "Debes seleccionar un método de pago", "warning");
            }
            else
            {
               if (!cobro && !(test1.checked) ) {
                    swal("Faltan datos", "Debes seleccionar un porcentaje de pago", "warning");   
                }
                else{
                    if ( test3.checked && $('#banco').val() == null) {
                        swal("Faltan datos", "Debes seleccionar un banco.", "warning");
                    }
                    else {
                        //$('#modalBlanco').css( "display", "block" );
                        
                        $http.post(pre+'cart/cliente',
                        {   'nombres':$scope.nombres,
                            'apellidos':$scope.apellidos,
                            'dni':$scope.dni,
                            'porcentaje':$scope.porcentajeRadio.name,
                            'email':$scope.email,
                            'banco_id':$('#banco').val()
                        }).then(function successCallback(response) {
                             $scope.pagar();
                        }, function errorCallback(response) { 
                        });
                    }
                } 
            }    
        }  
    }
    
    $scope.pagar = function () {
        if(test1.checked == true){
            $scope.PagoCero();
        }
        if(test2.checked == true){
            $scope.PagoPaypal();
        }
        if(test3.checked == true){
            $scope.PagoDeposito();
        }
    }
    $scope.PagoCero = function (){
        $http.get(pre+'operacionPagoCero').then(function successCallback(response) {
            window.location.href = '/PagoEnDestino';
        }, function errorCallback(response) {
        // called asynchronously if an error occurs
        // or server returns response with an error status.
        });
    }
    $scope.PagoPaypal = function (){
        window.location.href = 'payment';
    }
    $scope.PagoDeposito = function (){
        $http.get(pre+'operacionPagoDeposito').then(function successCallback(response) {
            window.location.href = '/PagoDeposito';
        }, function errorCallback(response) {
        // called asynchronously if an error occurs
        // or server returns response with an error status.
        });
    }

    $scope.getTipoCambio = function () {
        $http.get(pre+'admin/getTipoCambio').then(function successCallback(response) {
                $scope.tipoCambio = response.data.tipocambio;
            }, function errorCallback(response) {
            });
    }
    var Fechas;
    $scope.getDias = function () {
        $http.get(pre+'cart/getDias',
            {
            }).then(function successCallback(response) {
                $scope.dias = response.data.dias;
                $scope.res(response.data);
            }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            });
    }
    $scope.getTiposPago = function () {
        $http.get(pre+'admin/getTiposPago').then(function successCallback(response) {
                $scope.pagoCero = response.data[0].activo;
            }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            });
    }
    $scope.activarBtn = function () {
        if ($scope.terminos)
            $('#btn-res').prop("disabled",false);
        else
            $('#btn-res').prop("disabled",true);
    }

    $scope.calcularTotal = function () {
        totalR = $scope.Total * $scope.porcentajeRadio.name;
        totalRDolares = totalR / $scope.tipoCambio;
        $('#TotalR').text('Total: S/' + totalR.toFixed(2) + ' ó $' + totalRDolares.toFixed(2)) ;
    }

    $scope.porcentajeRadio = {
        name:0
    }
    $scope.formaPago = {
        name:'pagoCero'
    }

    $scope.getBancos = function () {
        $http.get(pre+'admin/banco').then(function successCallback(response) {
                $scope.bancos = response.data;
            }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            });
    }

   $scope.actualizarTotal = function(data, fechas){
        var total=0;
        for (x in data) {
            subp=data[x].precio*data[x].quantity;
            total+=subp;
        }
        $scope.totalN = total.toFixed(2);
        $scope.totalq = 'S/' + total + '.00';
        $('#totdia').html($scope.totalq );
        $scope.Total = ($scope.totalN * $scope.dias).toFixed(2);
        $scope.tx = 'S/' + $scope.Total;
        $('#totall').html($scope.tx );

    }
    /**
     * Actualiza la cantidad en el carrito
     */
    $scope.actualizar = function(id, idObjeto, data){
        //alert('entre');
        cantidad = $('#'+id).val();
        for (x in data) {
            if (x == idObjeto){
                data[x].quantity = cantidad;
                $http.get(pre+'cart/update/'+ idObjeto + '/' + cantidad ).then(
                function successCallback(response) {
                }, function errorCallback(response) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
                });
            }
        }
        $scope.car = data;
    }
});
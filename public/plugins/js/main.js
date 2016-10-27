/**
 * AngularJS Tutorial 1
 * @author Nick Kaye <nick.c.kaye@gmail.com>
 */

/**
 * Main AngularJS Web Application
 */
var app = angular.module('tutorialWebApp', [
  'ngRoute'
]);

/**
 * Configure the Routes
 */
app.config(['$routeProvider', function ($routeProvider) {
  $routeProvider
    // Home
    .when("/", {templateUrl: "partials/panelAdmin.html", controller: "panelController"})
    .when("/9dbf7c1488382487931d10235fc84a74bff5d2f4", {templateUrl: "partials/panelAdmin.html", controller: "PageCtrl"})
    .when("/12dea96fec20593566ab75692c9949596833adc9", {templateUrl: "partials/paneluser.html", controller: "PageCtrl"})
    .when("/dc76e9f0c0006e8f919e0c515c66dbba3982f785", {templateUrl: "partials/panelroot.html", controller: "PageCtrl"})
    .when("/Aregistro", {templateUrl: "partials/registrarh.html", controller: "PageCtrl"})
    // Pages
    /*
        Rutas relacionadas a empleados
    */
    //.when("/Cargos/crear", {templateUrl: "partials/emptipo/crear.html", controller: "PageCtrl"})
    //.when("/Cargos/ver", {templateUrl: "partials/emptipo/ver.html", controller: "PageCtrl"})

    .when("/Estadisticas", {templateUrl: "partials/estadisticas/ver.html", controller: "PageCtrl"})

    .when("/Perfil", {templateUrl: "partials/usuario/perfil.html", controller: "PageCtrl"})

    .when("/804ee937289b6ca7015c3230d5f2eaae7a51411c", {templateUrl: "partials/empleado/ver.html", controller: "PageCtrl"})
    .when("/d6ef98a9036dc01f45400ddc327e2c6e3bb2cde9", {templateUrl: "partials/empleado/crear.html", controller: "PageCtrl"})

    .when("/Clientes/ver", {templateUrl: "partials/cliente/ver.html", controller: "PageCtrl"})
    
    .when("/Usuarios/crear", {templateUrl: "partials/usuario/crear.html", controller: "PageCtrl"})
    .when("/Usuarios/ver", {templateUrl: "partials/usuario/ver.html", controller: "PageCtrl"})
    .when("/Usuarios/crearTipo", {templateUrl: "partials/usuariotipo/crear.html", controller: "PageCtrl"})

    .when("/LisServicios", {templateUrl: "partials/admin/servicios/servicios.html", controller: "PageCtrl"})
    .when("/CrearServicios", {templateUrl: "partials/admin/servicios/crear.html", controller: "PageCtrl"})
    .when("/Servicios/:catId", {templateUrl: "partials/admin/servicios/serviciosxCat.html", controller: "PageCtrl"})
    .when("/CrearServiciosCat/:idSer", {templateUrl: "partials/admin/servicios/crearServicios-Cat.html", controller: "PageCtrl"})

    .when("/Banner", {templateUrl: "partials/admin/slider/banner.html", controller: "PageCtrl"})
    .when("/LisBanner", {templateUrl: "partials/admin/slider/ver.html", controller: "PageCtrl"})

     .when("/Galeria", {templateUrl: "partials/admin/galeria/galeria.html", controller: "PageCtrl"})
    .when("/LisGaleria", {templateUrl: "partials/admin/galeria/ver.html", controller: "PageCtrl"})

     .when("/Noticias", {templateUrl: "partials/admin/noticia/noticia.html", controller: "PageCtrl"})
    .when("/LisNoticias", {templateUrl: "partials/admin/noticia/ver.html", controller: "PageCtrl"})

    .when("/tipoHab", {templateUrl: "partials/admin/tipoHab/crear.html", controller: "PageCtrl"})
    .when("/LisHab", {templateUrl: "partials/admin/tipoHab/ver.html", controller: "PageCtrl"})
    .when('/HabGalery/:habtipoId', {templateUrl: "partials/admin/tipoHab/galeria.html", controller: "PageCtrl"})

    .when("/Hoteles", {templateUrl: "partials/admin/hotel/ver.html", controller: "PageCtrl"})
    .when("/Hoteles/crear", {templateUrl: "partials/admin/hotel/crear.html", controller: "PageCtrl"})
    .when("/Hoteles/editar", {templateUrl: "partials/admin/hotel/editar.html", controller: "PageCtrl"})

    .when("/BandejaEntrada", {templateUrl: "partials/admin/Bandeja Entrada/ver.html", controller: "PageCtrl"})

    //.when("/Empleados", {templateUrl: "partials/admin/personal/ver.html", controller: "PageCtrl"})

    .when("/Habitacion", {templateUrl: "partials/habitacion/crear.html", controller: "PageCtrl"})
    .when("/Habitaciones", {templateUrl: "partials/habitacion/ver.html", controller: "PageCtrl"})

    .when("/Buscar", {templateUrl: "partials/registro/buscar.html", controller: "PageCtrl"})
    .when("/disponibilidad", {templateUrl: "partials/registro/disponibles.html", controller: "PageCtrl"})
    .when("/grid", {templateUrl: "partials/registro/grid.html", controller: "PageCtrl"})
    
    .when("/Reservas", {templateUrl: "partials/reserva/ver.html", controller: "PageCtrl"})
    .when("/ReservasHistorial", {templateUrl: "partials/reserva/historial.html", controller: "PageCtrl"})
    .when("/ReservasConfirmar", {templateUrl: "partials/reserva/verconfirmar.html", controller: "PageCtrl"})
    .when("/ReservaAsignar/:idReserva", {templateUrl: "partials/reserva/asignar.html", controller: "PageCtrl"})
    .when("/DetalleHabitaciones", {templateUrl: "partials/habitacion/detalleHabitacion.html", controller: "PageCtrl"})
    .when("/detalleHabitacion/:idRegistro", {templateUrl: "partials/registro/detalle.html", controller: "PageCtrl"})
    .when("/terminarRegistro/:idRegistro", {templateUrl: "partials/registro/terminar.html", controller: "PageCtrl"})
    .when("/LibroHuespedes", {templateUrl: "partials/registro/libroHuespedes.html", controller: "PageCtrl"})

    .when("/configChecks", {templateUrl: "partials/config/horas.html", controller: "PageCtrl"})

    .when("/Moneda/crear", {templateUrl: "partials/moneda/crear.html", controller: "PageCtrl"})
    .when("/Moneda/ver", {templateUrl: "partials/moneda/ver.html", controller: "PageCtrl"})

    .when("/ffdd78bb8155ab90e82546c0a88aa06c9e396e90", {templateUrl: "partials/banco/crear.html", controller: "PageCtrl"})
    .when("/58b38f0df4aa9c385f419877e07cbc5549162398", {templateUrl: "partials/banco/ver.html", controller: "PageCtrl"})

    .when("/Porcentaje/crear", {templateUrl: "partials/porcentaje/crear.html", controller: "PageCtrl"})
    .when("/Porcentaje/ver", {templateUrl: "partials/porcentaje/ver.html", controller: "PageCtrl"})
    .when("/Reporte", {templateUrl: "partials/admin/reporte/reportes.html", controller: "PageCtrl"})
    // else 404
    .otherwise("/404", {templateUrl: "partials/404.html", controller: "PageCtrl"});
}]);

/**
 * Controls all other Pages
 */
app.controller('PageCtrl', function (/* $scope, $location, $http */) {
  console.log("Page Controller reporting for duty(reconocio el controlador).");

});
app.controller('panelController', function($scope, $http) {

    $http.get('admin/panel').then(function successCallback(response) {
            window.location.href = 'admin#/' + response.data.mensaje;
        }, function errorCallback(response) {
        // called asynchronously if an error occurs
        // or server returns response with an error status.
        });
    

});



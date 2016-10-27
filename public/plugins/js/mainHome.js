
 var app = angular.module('homeApp', [
  'ngRoute'
]);



/**
 * Configure the Routes
 */
app.config(['$routeProvider', function ($routeProvider) {
  $routeProvider


    // Panel de Control de Admin
    .when("/", {templateUrl: "index/home.html", controller: "PageCtrl"})
    .when("/galeria", {templateUrl: "index/galery.html", controller: "PageCtrl"})
    .when("/noticias", {templateUrl: "index/noticias.html", controller: "PageCtrl"})
    .when("/contacto", {templateUrl: "index/contacto.html", controller: "PageCtrl"})
    .when("/habitaciones", {templateUrl: "index/habitaciones.html", controller: "PageCtrl"})
    .when('/habitaciones/:habtipoId', {templateUrl: "index/perfil.html", controller: "PageCtrl"})
    .when("/servicios", {templateUrl: "index/servicios.html", controller: "PageCtrl"})
    .when("/micarrito", {templateUrl: "index/carrito.html", controller: "PageCtrl"})
    .when("/mensajeenviado", {templateUrl: "index/mensaje.html", controller: "PageCtrl"})
    .when("/comprarealizada", {templateUrl: "index/endcompras.html", controller: "PageCtrl"})
    .when("/operacionPagoCero", {templateUrl: "index/operacionpagocero.html", controller: "PageCtrl"})
    .when("/operacionPagoDeposito", {templateUrl: "index/operacionpagodeposito.html", controller: "PageCtrl"})

    // Pages
    /*
        Rutas relacionadas a empleados
    */

    // else 404
    .otherwise("/404", {templateUrl: "partials/404.html", controller: "PageCtrl"});
}]);

/**
 * Controls all other Pages
 */
app.controller('PageCtrl', function (/* $scope, $location, $http */) {
  console.log("Page Controller reporting for duty(reconocio el controlador).");

});

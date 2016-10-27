<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @if (Auth::user()->usuariotipo->nombre == "Administrador")
            Administrador
        @endif
        @if (Auth::user()->usuariotipo->nombre=="Root")
            Root
        @endif
        @if (Auth::user()->usuariotipo->nombre != "Administrador" && Auth::user()->usuariotipo->nombre != "Root")
            Recepcionista
        @endif
    </title>
    <meta name="description" content="Blueprint: A basic template for a responsive multi-level menu" />
    <meta name="keywords" content="blueprint, template, html, css, menu, responsive, mobile-friendly" />
    <meta name="author" content="Codrops" />
    <link rel="shortcut icon" href="favicon.ico">
    <script src="plugins/angular/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->

    <!-- Optional theme -->
    
    <link rel="stylesheet" type="text/css" href="plugins/css/bootstrap.css" />
    <!-- Latest compiled and minified JavaScript -->
    <script src="plugins/js/bootstrap.min.js"></script>
    <!-- food icons -->
    <link rel="stylesheet" type="text/css" href="plugins/multilevel/css/organicfoodicons.css" />
    <link rel="stylesheet" type="text/css" href="plugins/css/kira.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    
    <!-- demo styles -->
    <link rel="stylesheet" type="text/css" href="plugins/multilevel/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="plugins/Trumbowyg/ui/trumbowyg.min.css" />
    <!-- menu styles -->
    <link rel="stylesheet" type="text/css" href="plugins/multilevel/css/component.css" />
    <script src="plugins/multilevel/js/modernizr-custom.js"></script>
    <link rel="stylesheet" href="plugins/iconos/flaticon.css">
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <script src="plugins/morris/raphael-min.js"></script>
    <script src="plugins/morris/morris.js"></script>

    <script src="plugins/SweetAlert/sweetalert.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="plugins/SweetAlert/sweetalert.css">

    <link rel="stylesheet" href="plugins/Editor/css/froala_editor.css">
    <link rel="stylesheet" href="plugins/Editor/css/froala_style.css">
    <link rel="stylesheet" href="plugins/Editor/css/plugins/code_view.css">
    <link rel="stylesheet" href="plugins/Editor/css/plugins/colors.css">
    <link rel="stylesheet" href="plugins/Editor/css/plugins/image_manager.css">
    <link rel="stylesheet" href="plugins/Editor/css/plugins/image.css">

</head>

<body ng-app="tutorialWebApp">
    <!-- Main container -->
    <div class="container">
        <!-- Blueprint header -->
        
        <button class="action action--open" aria-label="Open Menu"><span class="icon icon--menu"></span></button>
        <nav id="ml-menu" class="menu">
            <div class="dummy-logo">
                <div ><i class="glyphicon glyphicon-cloud" style="font-size: 6rem"></i></div>
                <a href="/login"><h2 class="dummy-heading" style="margin-top: 0px">PANEL DE CONTROL</h2></a>
            </div>
            <button class="action action--close" aria-label="Close Menu"><span class="icon icon--cross"></span></button>
            <div class="menu__wrap">
                <ul data-menu="main" class="menu__level">

                @if (Auth::user()->usuariotipo->nombre == "Administrador")  
                    <li class="menu__item"><a class="menu__link" href="#/Habitaciones" onclick="closes()" >Info. Habitaciones</a></li>
                    <li class="menu__item"><a class="menu__link" href="#/804ee937289b6ca7015c3230d5f2eaae7a51411c" onclick="closes()">Usuarios</a></li>

                    <li class="menu__item"><a class="menu__link"  href="#/configChecks" onclick="closes()">Hora de E/S</a></li>
                    <li class="menu__item"><a class="menu__link"  href="#/Moneda/ver"onclick="closes()">Tipos de Cambio</a></li>
                    <li class="menu__item"><a class="menu__link"  href="#/58b38f0df4aa9c385f419877e07cbc5549162398" onclick="closes()">Bancos</a></li>
                    <li class="menu__item"><a class="menu__link"  href="#/Porcentaje/ver" onclick="closes()">Config. Pagos</a></li>
                    <li class="menu__item"><a class="menu__link"  href="#/LibroHuespedes" onclick="closes()">Bitácora</a></li> 
                    <li class="menu__item"><a class="menu__link"  href="#/Estadisticas" onclick="closes()">Estadísticas</a></li>

                    <li class="menu__item"><a class="menu__link" data-submenu="submenu-9" href="#/">Recepcionista</a></li>

                     
                @endif

                @if (Auth::user()->usuariotipo->nombre != "Administrador" && Auth::user()->usuariotipo->nombre != "Root")
                    <li class="menu__item"><a class="menu__link" href="#/Reservas" onclick="closes()" >Reservas</a></li>  
                    <li class="menu__item"><a class="menu__link" href="#/ReservasConfirmar" onclick="closes()" >Confirmar reserva</a></li> 
                    <li class="menu__item"><a class="menu__link" href="#/grid" onclick="closes()" >Disponibilidad</a></li>  
                    <li class="menu__item"><a class="menu__link" href="#/Clientes/ver" onclick="closes()" >Clientes</a></li>
                    <li class="menu__item"><a class="menu__link" href="#/Buscar" onclick="closes()" >Registro sin reser.</a></li>
                    <li class="menu__item"><a class="menu__link" href="#/DetalleHabitaciones" onclick="closes()" >Habitaciones</a></li>
                    <li class="menu__item"><a class="menu__link" href="#/ReservasHistorial" onclick="closes()" >Historial reservas</a></li>
                @endif
                    @if (Auth::user()->usuariotipo->nombre=="Root")

                        <li class="menu__item"><a class="menu__link" href="#/LisBanner" onclick="closes()" >Banners</a></li>
                        <li class="menu__item"><a class="menu__link" href="#/LisHab" onclick="closes()" >Tipos de Habitaciones</a></li>
                        <li class="menu__item"><a class="menu__link" href="#/LisGaleria" onclick="closes()" >Galería de Fotos</a></li>
                        <li class="menu__item"><a class="menu__link" href="#/LisNoticias" onclick="closes()" >Noticias</a></li>
                        <li class="menu__item"><a class="menu__link" href="#/LisServicios" onclick="closes()" >Servicios</a></li>
                        <li role="separador" class="menu__item"><a class="menu__separador" href="#" onclick="closes()" ></a></li>
                        <li class="menu__item"><a class="menu__link" href="#/Reporte" onclick="closes()" >Reportes</a></li>
                        <li class="menu__item"><a class="menu__link" href="#/Hoteles" onclick="closes()" >Hotel</a></li>
                    @endif
                </ul>
                <!-- Submenu 1 -->
                <ul data-menu="submenu-1" class="menu__level">
                    <li class="menu__item"><a class="menu__link" href="#" onclick="closes()" >Ver Empleados</a></li>
                    <li class="menu__item"><a class="menu__link" href="#/d6ef98a9036dc01f45400ddc327e2c6e3bb2cde9" onclick="closes()" >Crear Empleado</a></li>
                    <li role="separador" class="menu__item"><a class="menu__separador" href="#" onclick="closes()" ></a></li>
                    <li class="menu__item"><a class="menu__link" href="#" onclick="closes()" >Ver Cargos</a></li>
                    <li class="menu__item"><a class="menu__link" href="#/Cargos/ver" onclick="closes()" >Cargos del Hotel</a></li>
                </ul>
                <ul data-menu="submenu-9" class="menu__level">
                    <li class="menu__item"><a class="menu__link" href="#/Reservas" onclick="closes()" >Reservas</a></li>  
                    <li class="menu__item"><a class="menu__link" href="#/ReservasConfirmar" onclick="closes()" >Confirmar reserva</a></li> 
                    <li class="menu__item"><a class="menu__link" href="#/grid" onclick="closes()" >Disponibilidad</a></li>  
                    <li class="menu__item"><a class="menu__link" href="#/Clientes/ver" onclick="closes()" >Clientes</a></li>

                    <li class="menu__item"><a class="menu__link" href="#/Buscar" onclick="closes()" >Registro sin reser.</a></li>
                    <li class="menu__item"><a class="menu__link" href="#/DetalleHabitaciones" onclick="closes()" >Habitaciones</a></li>
                    <li class="menu__item"><a class="menu__link" href="#/ReservasHistorial" onclick="closes()">Historial reservas</a></li>
                </ul>
                <!-- Submenu 2 -->
                <ul data-menu="submenu-2" class="menu__level">

                </ul>
            </div>
        </nav>
        <!-- sub menu de cabezera --> 
        <div class="fix">
           <nav class="submenu" >
                <ul class="navbar-center" style="width: 100%;">
                    <a href="/login">
                        <li  style="margin-top:10px; color:#446CB3; font-size: 2.5rem; left:0;padding-right:40px;text-align: center;">
                            @if (Auth::user()->usuariotipo->nombre=="Root")
                                Administrador del Sistema
                            @else
                                {{ Auth::user()->empleado->hotel->nombre }}
                            @endif
                        </li>
                    </a>
                    
                  
                   <li class="dropdown" style="left:0;width: 120px;float: right;margin-top: -20px;margin-right: 0px">
                            <a href="" class="dropdown-toggle li" data-toggle="dropdown" role="button" aria-expanded="false">
                                @if (Auth::user()->usuariotipo->nombre=="Root")
                                    Admin <span class="caret"></span>
                                @else
                                    {{ Auth::user()->empleado->nombres . " " . Auth::user()->empleado->apellidos }} <span class="caret"></span>
                                @endif
                            
                            
                            </a>
                           
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#/Perfil"><i class="fa fa-btn fa-sign-out"></i>Perfil</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                  </ul>
                
                <!-- /.dropdown-messages -->
        </nav> 
        </div>
        
        <div class="content">
            <div ng-view style="margin-top: 30px"></div>
        </div>
    </div>

    <script type="text/javascript" src="plugins/Editor/js/froala_editor.min.js" ></script>
    <script type="text/javascript" src="plugins/Editor/js/plugins/align.min.js"></script>
    <script type="text/javascript" src="plugins/Editor/js/plugins/code_beautifier.min.js"></script>
    <script type="text/javascript" src="plugins/Editor/js/plugins/code_view.min.js"></script>
    <script type="text/javascript" src="plugins/Editor/js/plugins/colors.min.js"></script>
    <script type="text/javascript" src="plugins/Editor/js/plugins/draggable.min.js"></script>
    <script type="text/javascript" src="plugins/Editor/js/plugins/font_size.min.js"></script>
    <script type="text/javascript" src="plugins/Editor/js/plugins/font_family.min.js"></script>
    <script type="text/javascript" src="plugins/Editor/js/plugins/lists.min.js"></script>
    <script src="plugins/angular/angular.min.js"></script>
    <script src="plugins/angular/angular-route.min.js"></script>
    <script src="plugins/angular/angular-locale_es-pe.js"></script>

        <!-- Our Website Javascripts -->

    <script src="{{ asset('plugins/js/main.js') }}"></script>
    
    <!-- /view -->
    <script src="plugins/multilevel/js/classie.js"></script>
    <script src="plugins/multilevel/js/dummydata.js"></script>
    <script src="plugins/multilevel/js/main.js"></script>

    <!-- Controladrores de Angular -->
    <script src="plugins/js/controllers/bancoController.js"></script> 
    <script src="plugins/js/controllers/cargoController.js"></script>  
    <script src="plugins/js/controllers/empleadoController.js"></script>  
    <script src="plugins/js/controllers/usuariotipoController.js"></script> 
    <script src="plugins/js/controllers/usuarioController.js"></script> 
    <script src="plugins/js/controllers/hotelController.js"></script> 
    <script src="plugins/js/controllers/bannerController.js"></script> 
    <script src="plugins/js/controllers/habtipoController.js"></script>
    <script src="plugins/js/controllers/personalController.js"></script>
    <script src="plugins/js/controllers/galeryController.js"></script>
    <script src="plugins/js/controllers/noticiaController.js"></script>
    <script src="plugins/js/controllers/contactoController.js"></script>
    <script src="plugins/js/controllers/habtipogalController.js"></script>
    <script src="plugins/js/controllers/habitacionController.js"></script>
    <script src="plugins/js/controllers/registroController.js"></script>
    <script src="plugins/js/controllers/reservaController.js"></script>
    <script src="plugins/js/controllers/serviciosController.js"></script>
    <script src="plugins/js/controllers/monedaController.js"></script>
    <script src="plugins/js/controllers/porcentajeController.js"></script>
    <script src="plugins/js/controllers/graficasController.js"></script>
    <script src="plugins/js/controllers/clienteController.js"></script>
    <script src="plugins/js/controllers/estadisticasController.js"></script>

    <script src="plugins/js/directivas/onFinishRender.js"></script>
    <script>

    (function() {
        var menuEl = document.getElementById('ml-menu'),
            mlmenu = new MLMenu(menuEl, {
                // breadcrumbsCtrl : true, // show breadcrumbs
                // initialBreadcrumb : 'all', // initial breadcrumb text
                backCtrl : false, // show back button
                // itemsDelayInterval : 60, // delay between each menu item sliding animation
                //onItemClick: loadDummyData // callback: item that doesn´t have a submenu gets clicked - onItemClick([event], [inner HTML of the clicked item])
            });

        // mobile menu toggle
        var openMenuCtrl = document.querySelector('.action--open'),
            closeMenuCtrl = document.querySelector('.action--close');

        openMenuCtrl.addEventListener('click', openMenu);
        closeMenuCtrl.addEventListener('click', closeMenu);

        function openMenu() {
            classie.add(menuEl, 'menu--open');
        }

        function closeMenu() {
            classie.remove(menuEl, 'menu--open');
        }

        
        
    })();
    </script>
    <script>
        function closes()
        {
            $('.menu').removeClass('menu--open');
        }
    </script>
</body>

</html>

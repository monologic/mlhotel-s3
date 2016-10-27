
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
	<meta name="keywords" content="free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="FreeHTML5.co" />

  <!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FreeHTML5.co
		
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="{{asset('index/css/animate.css')}}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{asset('index/css/icomoon.css')}}">
	<link rel="stylesheet" href="{{asset('index/awesome/css/font-awesome.min.css')}}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{asset('index/css/bootstrap.css')}}">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="{{asset('index/css/flexslider.css')}}">
	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="{{asset('index/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('index/css/owl.theme.default.min.css')}}">
	<!-- Theme style  -->
	<link rel="stylesheet" href="{{asset('plugins/iconos/flaticon.css')}}">
	<link rel="stylesheet" href="{{asset('index/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('index/css/kira.css')}}">

	<!-- Modernizr JS -->
	<script src="{{asset('index/js/jquery.min.js')}}"></script>
	<script src="{{asset('index/js/modernizr-2.6.2.min.js')}}"></script>
	<!-- FOR IE9 below -->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/GridGallery/css/component.css')}}" />
	<script src="{{asset('assets/GridGallery/js/modernizr.custom.js')}}"></script>

	<link rel="stylesheet" href="{{asset('plugins/datepicker/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datepicker/jquery-ui.theme.css')}}">
    <script src="{{asset('plugins/datepicker/jquery-ui.js')}}"></script>
    <link rel="stylesheet" href="{{asset('plugins/slider/css/swiper.min.css')}}"  media="screen,projection"/>
    <script src="{{asset('plugins/SweetAlert/sweetalert.min.js')}}"></script> 
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/SweetAlert/sweetalert.css')}}">
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body ng-app="homeApp">
	
	
	<div id="fh5co-page">
	<header id="fh5co-header" role="banner">
		<div class="container">
			<div class="header-inner">
				<h1><a href="/">Hotel</a></h1>
				<nav role="navigation">
					<ul>
						<li><a href="{{ url('/Habitaciones') }}">Habitaciones</a></li>
						<li><a href="{{ url('/Servicios') }}">Servicios</a></li>
						<li><a href="{{ url('/Galeria') }}">Galeria</a></li>
						<li><a href="{{ url('/Noticias') }}">Noticias</a></li>
						<li><a href="{{ url('/Contacto') }}">Contacto</a></li>
						<li class="cta"><a href="/login">Sign in</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</header>
	<div id="divActualizarContrato_Success">Añadido al carrito</div>
	@yield('content')
	<footer id="fh5co-footer" role="contentinfo" ng-controller="hotelController" ng-init="getHotelesF();">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-xs-6">
					<h3>SIGUENOS EN :</h3>
					<ul class="fh5co-social">
						<li ng-repeat="q in social" ng-if="q.estado == 'true'"><a href="@{{q.link}}" target="_blank"><i class="fa @{{q.icono}}"></i></a></li>
					</ul>
				</div>
				<div class="col-md-6 col-xs-6">
					<h3>@{{infos.nombre}}</h3>
					<ul class="">
						<li> <i class="fa fa-map-marker"></i> &nbsp;@{{infos.direccion}}</li>
						<li> <i class="fa fa-envelope"></i>&nbsp; @{{infos.correo}}</li>
						<li> <i class="fa fa-phone"></i>&nbsp; @{{infos.telefono}}</li>
						<li> @{{infos.ciudad}}</li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	</div>
		<a class="btn-car" onclick="op()">
			<i id="io" class="fa fa-cart-plus" aria-hidden="true"></i>
			<i id="ic" class="fa fa-times" aria-hidden="true"></i>
		</a>
	<!-- jQuery -->
	
	<!-- jQuery Easing -->
	<script src="{{asset('index/js/jquery.easing.1.3.js')}}"></script>
	<!-- angular -->
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.18/angular.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.18/angular-route.min.js"></script>
	<script src="{{ asset('plugins/js/mainHome.js') }}"></script>
    <script src="{{asset('plugins/js/controllers/hotelController.js')}}"></script>
	<!-- Bootstrap -->
	<script src="{{asset('index/js/bootstrap.min.js')}}"></script>
	<!-- Waypoints -->
	<script src="{{asset('index/js/jquery.waypoints.min.js')}}"></script>
	<!-- Owl Carousel -->
	<script src="{{asset('index/js/owl.carousel.min.js')}}"></script>
	<!-- Flexslider -->
	<script src="{{asset('index/js/jquery.flexslider-min.js')}}"></script>

	<!-- MAIN JS -->
	<script src="{{asset('index/js/main.js')}}"></script>
	<script src="{{asset('plugins/js/controllers/carritoController.js')}}"></script>
	<script src="{{asset('plugins/js/controllers/reservaController.js')}}"></script>
	<script src="{{asset('plugins/js/controllers/habtipoController.js')}}"></script>
	<script src="{{asset('plugins/js/directivas/onFinishRender.js')}}"></script>
	<script src="{{asset('plugins/js/controllers/habtipogalController.js')}}"></script>
	<script>
    	$(document).ready(function() {
	      $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
	          e.preventDefault();
	          $(this).siblings('a.active').removeClass("active");
	          $(this).addClass("active");
	          var index = $(this).index();
	          $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
	          $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
	      });
	  });
    var abierto=0
    function op(){
    	if(abierto == 0){
    		abierto=1;
    		$('#io').css('display','none');
    		$('#ic').css('display','block');
			$('#caja').css('right','0');
    	}
    	else{
    		abierto=0;
    		$('#io').css('display','block');
    		$('#ic').css('display','none');
			$('#caja').css('right','-400px');
    	}
    	
    }
    function alertR(){
    	$('#divActualizarContrato_Success').css('display', 'block');
    	$('#divActualizarContrato_Success').css('background-color', 'rgba(0,105,92,1)');
    	$('#divActualizarContrato_Success').css('top', '78px');
    	$('#divActualizarContrato_Success').css('color', 'white');
		$('#divActualizarContrato_Success').delay(5000).hide(2000);
    }
  </script>
  </body>
</html>


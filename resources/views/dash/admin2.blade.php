<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Multi-Level Push Menu - Demo 1</title>
		<meta name="description" content="Multi-Level Push Menu: Off-screen navigation with multiple levels" />
		<meta name="keywords" content="multi-level, menu, navigation, off-canvas, off-screen, mobile, levels, nested, transform" />
		<meta name="author" content="Codrops" />
		<script src="plugins/angular/jquery.min.js"></script>

	
	    <script src="plugins/js/bootstrap.min.js"></script>

		<link rel="shortcut icon" href="../favicon.ico">

		<link rel="stylesheet" type="text/css" href="plugins/multilevelpush/css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="plugins/multilevelpush/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="plugins/multilevelpush/css/icons.css" />
		<link rel="stylesheet" type="text/css" href="plugins/multilevelpush/css/component.css" />
		<script src="plugins/multilevelpush/js/modernizr.custom.js"></script>

		<script src="plugins/SweetAlert/sweetalert.min.js"></script> 
    	<link rel="stylesheet" type="text/css" href="plugins/SweetAlert/sweetalert.css">
    	<link rel="stylesheet" type="text/css" href="plugins/css/bootstrap.css" />
    	<link rel="stylesheet" type="text/css" href="plugins/css/kira.css" />
	</head>
	<body ng-app="tutorialWebApp">
		<div class="containerp">
			<!-- Push Wrapper -->
			<div class="mp-pusher" id="mp-pusher">

				<!-- mp-menu -->
				<nav id="mp-menu" class="mp-menu">
					<div class="mp-level">
						<h2 class="icon icon-world">All Categories</h2>
						<ul>
							<li class="icon icon-arrow-left">
								<a class="icon icon-display" href="#">Devices</a>
								<div class="mp-level">
									<h2 class="icon icon-display">Devices</h2>
									<a class="mp-back" href="#">back</a>
									<ul>
										<li class="icon icon-arrow-left">
											<a class="icon icon-phone" href="#">Mobile Phones</a>
											<div class="mp-level">
												<h2>Mobile Phones</h2>
												<a class="mp-back" href="#">back</a>
												<ul>
													<li><a href="#">Super Smart Phone</a></li>
													<li><a href="#">Thin Magic Mobile</a></li>
													<li><a href="#">Performance Crusher</a></li>
													<li><a href="#">Futuristic Experience</a></li>
												</ul>
											</div>
										</li>
										<li class="icon icon-arrow-left">
											<a class="icon icon-tv" href="#">Televisions</a>
											<div class="mp-level">
												<h2>Televisions</h2>
												<a class="mp-back" href="#">back</a>
												<ul>
													<li><a href="#">Flat Superscreen</a></li>
													<li><a href="#">Gigantic LED</a></li>
													<li><a href="#">Power Eater</a></li>
													<li><a href="#">3D Experience</a></li>
													<li><a href="#">Classic Comfort</a></li>
												</ul>
											</div>
										</li>
										<li class="icon icon-arrow-left">
											<a class="icon icon-camera" href="#">Cameras</a>
											<div class="mp-level">
												<h2>Cameras</h2>
												<a class="mp-back" href="#">back</a>
												<ul>
													<li><a href="#">Smart Shot</a></li>
													<li><a href="#">Power Shooter</a></li>
													<li><a href="#">Easy Photo Maker</a></li>
													<li><a href="#">Super Pixel</a></li>
												</ul>
											</div>
										</li>
									</ul>
								</div>
							</li>
							<li class="icon icon-arrow-left">
								<a class="icon icon-news" href="#">Magazines</a>
								<div class="mp-level">
									<h2 class="icon icon-news">Magazines</h2>
									<a class="mp-back" href="#">back</a>
									<ul>
										<li><a href="#">National Geographic</a></li>
										<li><a href="#">Scientific American</a></li>
										<li><a href="#">The Spectator</a></li>
										<li><a href="#">The Rambler</a></li>
										<li><a href="#">Physics World</a></li>
										<li><a href="#">The New Scientist</a></li>
									</ul>
								</div>
							</li>
							<li class="icon icon-arrow-left">
								<a class="icon icon-shop" href="#">Store</a>
								<div class="mp-level">
									<h2 class="icon icon-shop">Store</h2>
									<a class="mp-back" href="#">back</a>
									<ul>
										<li class="icon icon-arrow-left">
											<a class="icon icon-t-shirt" href="#">Clothes</a>
											<div class="mp-level">
												<h2 class="icon icon-t-shirt">Clothes</h2>
												<a class="mp-back" href="#">back</a>
												<ul>
													<li class="icon icon-arrow-left">
														<a class="icon icon-female" href="#">Women's Clothing</a>
														<div class="mp-level">
															<h2 class="icon icon-female">Women's Clothing</h2>
															<a class="mp-back" href="#">back</a>
															<ul>
																<li><a href="#">Tops</a></li>
																<li><a href="#">Dresses</a></li>
																<li><a href="#">Trousers</a></li>
																<li><a href="#">Shoes</a></li>
																<li><a href="#">Sale</a></li>
															</ul>
														</div>
													</li>
													<li class="icon icon-arrow-left">
														<a class="icon icon-male" href="#">Men's Clothing</a>
														<div class="mp-level">
															<h2 class="icon icon-male">Men's Clothing</h2>
															<a class="mp-back" href="#">back</a>
															<ul>
																<li><a href="#">Shirts</a></li>
																<li><a href="#">Trousers</a></li>
																<li><a href="#">Shoes</a></li>
																<li><a href="#">Sale</a></li>
															</ul>
														</div>
													</li>
												</ul>
											</div>
										</li>
										<li>
											<a class="icon icon-diamond" href="#">Jewelry</a>
										</li>
										<li>
											<a class="icon icon-music" href="#">Music</a>
										</li>
										<li>
											<a class="icon icon-food" href="#">Grocery</a>
										</li>
									</ul>
								</div>
							</li>
							<li><a class="icon icon-photo" href="#">Collections</a></li>
							<li><a class="icon icon-wallet" href="#">Credits</a></li>
						</ul>
							
					</div>
				</nav>
				<!-- /mp-menu -->

				<div class="scroller"><!-- this is for emulating position fixed of the nav -->
					<div class="scroller-inner">
						<!-- Top Navigation -->
						<div class="block block-40 clearfix">
							<p><a href="#" id="trigger" class="menu-trigger"></a></p>
							<div style="width:90%;margin:0px auto 0px auto;background-color:red">
					            <div ng-view></div>
					        </div>
						</div>

					</div><!-- /scroller-inner -->
				</div><!-- /scroller -->

			</div><!-- /pusher -->
		</div><!-- /container -->

		<script src="plugins/angular/angular.min.js"></script>
    	<script src="plugins/angular/angular-route.min.js"></script>

    	<script src="{{ asset('plugins/js/main.js') }}"></script>

		<script src="{{ asset('plugins/js/main.js') }}"></script>
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

	    <script src="plugins/js/directivas/onFinishRender.js"></script>
		<script src="plugins/multilevelpush/js/classie.js"></script>
		<script src="plugins/multilevelpush/js/mlpushmenu.js"></script>
		<script>
			new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ) );
		</script>
	</body>
</html>
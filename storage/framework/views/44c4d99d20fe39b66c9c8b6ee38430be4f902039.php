<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="utf-8" />
        <title>Portal del contratista</title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
        <meta content="" name="Portal del contratista" />
        <meta content="" name="Secretaría de la Honestidad y Función Pública" />
        
		<link rel="shortcut icon" href="<?php echo e(asset('img/iconos/favicon.ico')); ?>">
        <!-- ================== BEGIN PAGE SHYFP ================== -->
        <!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet"> 
					
		<!-- CSS Global Compulsory -->
		<?php echo Html::style('public/assets/vendor/bootstrap/bootstrap.min.css');; ?>

		<?php echo Html::style('public/assets/vendor/bootstrap/offcanvas.css');; ?>

		<!-- CSS Implementing Plugins -->
		<?php echo Html::style('public/assets/vendor/icon-awesome/css/font-awesome.min.css');; ?>

		<?php echo Html::style('public/assets/vendor/icon-line-pro/style.css');; ?>

		<?php echo Html::style('public/assets/vendor/icon-line/css/simple-line-icons.css');; ?>

		<?php echo Html::style('public/assets/vendor/icon-hs/style.css');; ?>

		<?php echo Html::style('public/assets/vendor/dzsparallaxer/dzsparallaxer.css');; ?>

		<?php echo Html::style('public/assets/vendor/dzsparallaxer/dzsscroller/scroller.css');; ?>

		<?php echo Html::style('public/assets/vendor/dzsparallaxer/advancedscroller/plugin.css');; ?>

		<?php echo Html::style('public/assets/vendor/animate.css');; ?>

		<?php echo Html::style('public/assets//vendor/typedjs/typed.css');; ?>

		<?php echo Html::style('public/assets/vendor/hamburgers/hamburgers.min.css');; ?>

		<?php echo Html::style('public/assets/vendor/fancybox/jquery.fancybox.css');; ?>

		<?php echo Html::style('public/assets/vendor/slick-carousel/slick/slick.css');; ?>

		<?php echo Html::style('public/assets/css/unify-core.css');; ?>

		<?php echo Html::style('public/assets/css/unify-components.css');; ?>

		<?php echo Html::style('public/assets/css/unify-globals.css');; ?>					
		<?php echo Html::style('public/assets/css/custom.css');; ?>

		<?php echo Html::style('public/assets/css/personalizado.css');; ?>

		<?php echo Html::style('public/assets/css/login.css');; ?>

		<link media="all" type="text/css" rel="stylesheet" href="https://declarachiapas.shyfpchiapas.gob.mx/js/sweetalert2-7.33.1/sweetalert2.min.css">
        <!-- ================== END BASE CSS STYLE ================== -->
    </head>

	<style>
		@media (max-width:800px){
			#principalPeque{display:block}
			#principalGrande{display:none}
			#logo{text-align:center}
			#texto{text-align:center}
			#texto h1{font-size:2em}
		}
		@media (min-width:800px){
			#principalPeque{display:none}
			#principalGrande{display:block}
			#logo{text-align:right}
			#texto h1{font-size:3.7em}
		}
	</style>

    <body>
		<header id="js-header" class="u-header u-header--sticky-top u-header--toggle-section" data-header-fix-moment="300">	
			<div class="u-header__section u-header__section--light  g-transition-0_3 g-bg-color-header" data-header-fix-moment-exclude="" data-header-fix-moment-classes="u-shadow-v18 g-py-0">
                <nav class="navbar navbar-expand-lg g-pa-0 g-pt-4 g-pb-4">
                    <div class="container">						
                        <button class="navbar-toggler navbar-toggler-right btn g-line-height-1 g-brd-none g-pa-0 g-pos-abs g-top-3 g-right-0" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
                            <span class="hamburger hamburger--slider">								
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </span>
                        </button>
                    	                    
                        <a href="https://www.chiapas.gob.mx" class="navbar-brand">
                        	<img src="public/assets/logo/escudo-icono.png" alt="">
                        </a>
                        <a href="https://www.chiapas.gob.mx" class="g-color-white-opacity-0_9 g-font-size-16 g-font-weight-300 g-font-secondary">chiapas<span class="g-color-white-opacity-0_6">.gob.mx</span></a>
						
                        <div class="collapse navbar-collapse align-items-center flex-sm-row g-pt-10 g-pt-5--lg" id="navBar">
							<ul class="navbar-nav ml-auto g-font-size-18 g-font-weight-100">
								<!--li class="nav-item g-mx-10--lg"><a href="<?php echo e(route('buscador.index')); ?>" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover">Buscador</a></li-->
								
								<li class="nav-item g-mx-10--lg">
									<a href="<?php echo e(url('/')); ?>" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover">Inicio</a>
								</li>
								<li class="nav-item g-mx-10--lg">
									<a href="<?php echo e(route('videotutorial')); ?>" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover">Videotutorial</a>
								</li>
                                <li class="nav-item g-mx-10--lg">
                                	<a href="<?php echo e(asset('descargas/glosario_terminos.pdf')); ?>" class="nav-link g-color-white-opacity-0_9 g-text-underline--hover" target="_blank">Glosario de Términos</a>
                                </li>
                            </ul>
                        </div>
						
                    </div>
                </nav>
            </div>					
        </header>
					
		<br />
		<br />
		<br />
		<br />
		<br />

		<section class="d-block d-sm-none">
            <div class="g-brd-around  g-brd-1 g-brd-gray-light-v4-top g-brd-gray-light-v4-bottom g-color-white-opacity-0_9 g-bg-color-menu" role="alert">
				<div class="container">
					<nav class="navbar navbar-expand-lg navbar-light g-pa-0 g-right-0 g-pt-4 g-pb-4 g-bg-color-menu">
						<a class="navbar-brand g-color-morado g-font-weight-600 g-font-size-16  d-none d-sm-none d-md-none d-lg-none d-xl-block g-text-underline--hover" href="comision_seg_vig/"></a>
						<a class="navbar-brand g-color-morado g-font-weight-600 g-font-size-16  d-sm-block d-md-block d-lg-block d-xl-none g-text-underline--hover" href="comision_seg_vig/"></a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav ml-auto g-font-size-15 g-font-weight-100">
								<li class="nav-item g-mx-3--lg"><a class="nav-link g-color-black-opacity-0_9 g-color-white--hover g-bg-morado--hover g-rounded-3" href="#">Acerca de</a></li>
								<li class="nav-item g-mx-3--lg"><a class="nav-link g-color-black-opacity-0_9 g-color-white--hover g-bg-morado--hover g-rounded-3" href="crear-cuenta/registro">Crea tu cuenta</a></li>
							</ul>
						</div>
					</nav>
				</div>      
			</div>
		</section>
		
		<section>	
			<?php echo $__env->yieldContent('content'); ?>
			<br>
			<div class="container">
				<div class="note note-default " style="text-align:justify">								
					<div class="note-content">
						<h4><b>Aviso de privacidad</b></h4>
						<p>
							Los datos recabados en este formato, serán protegidos, incorporados y tratados en los términos establecidos en la Ley de Protección de Datos Personales en Posesión de Sujetos Obligados del Estado de Chiapas (LPDPPSOCHIS), así como en los Lineamientos Generales para la Custodia y Protección de Datos Personales e Información Reservada y Confidencial en posesión de los Sujetos Obligados del Estado de Chiapas y demas normatividad aplicable. Para mayor información puede consultar nuestro aviso de privacidad en la página: https://www.shyfpchiapas.gob.mx/
						</p>
					</div>
				</div> 
				<div class="note note-default " style="text-align:justify">								
					<div class="note-content">
						<h5><b>Importante</b></h5>
						<p class="r-d-5">                            
							Para el &oacute;ptimo funcionamiento del sistema utiliza las <b>versiones</b> m&aacute;s <b>actualizadas</b> de los siguientes navegadores:							
							<img src="<?php echo e(asset('public/img/iconos/chrome.png')); ?>"> Google Chrome <img src="<?php echo e(asset('public/img/iconos/mozilla.png')); ?>"> Mozilla Firefox
						</p>
					</div>
				</div>
			</div>                                    
			<br>				
		</section>					
		<!-- PAGINA -->

		<footer class="g-bg-black-opacity-0_9 g-color-white-opacity-0_8 g-py-20">
			<div class="container">
				<div class="row d-sm-block d-md-block d-lg-block d-xl-none">
                    <div class="col-md-10 text-center text-md-left g-mb-10 g-mb-0--md">
                        <small class="d-block g-font-size-default g-mr-10 g-mb-10 g-mb-0--md g-font-weight-300 text-center"><a href="" class="g-color-white-opacity-0_8 g-color-white--hover">Sistema de Registro de Contratistas y de Supervisores Externos</a></small>
         		    </div>
                </div>
														
				<div class="row">
								
					<div class="col-lg-2 col-md-6 g-mb-20 g-mb-0--lg d-none d-sm-none d-md-none d-lg-none d-xl-block">
                        <img class="img-fluid" src="img2/logo-blanco.png" alt="Logo">
                    </div>
								
					<div class="col-md-8 text-center text-md-left g-mb-10 g-mb-0--md d-none d-sm-none d-md-none d-lg-none d-xl-block">
						<div class="row">
							<div class="col-md-12">
								<div class="d-lg-flex">
									<small class="d-block g-font-size-default g-mr-10 g-mb-10 g-mb-0--md g-font-weight-300">Tr&aacute;mites y Servicios:</small>
									<ul class="u-list-inline">
										<li class="list-inline-item"><a class="g-color-white-opacity-0_8 g-color-white--hover" href="http://www.chiapas.gob.mx/tramites">Buscar servicios</a></li>
										    <li class="list-inline-item"><span>|</span></li>
											<li class="list-inline-item"><a class="g-color-white-opacity-0_8 g-color-white--hover" href="https://ventanilla.egob.com/tramitesypagosservicioschiapas/home" target="_blank">Pago de Derechos</a></li>
											<li class="list-inline-item"><span>|</span></li>
											<li class="list-inline-item"><a class="g-color-white-opacity-0_8 g-color-white--hover" href="http://www.chiapas.gob.mx/servicios-por-entidad">Servicios por Entidad</a></li>
											<li class="list-inline-item"><span>|</span></li>
											<li class="list-inline-item"><a class="g-color-white-opacity-0_8 g-color-white--hover" href="http://www.chiapas.gob.mx/servicios-por-internet">Servicios por Internet</a></li>
							        </ul>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="d-lg-flex">
									<small class="d-block g-font-size-default g-mr-10 g-mb-10 g-mb-0--md">Mantente informado:</small>
										<ul class="u-list-inline">
											<li class="list-inline-item"><a class="g-color-white-opacity-0_8 g-color-white--hover" href="http://www.chiapas.gob.mx/tv">TV</a></li>
											<li class="list-inline-item"><span>|</span></li>
											<li class="list-inline-item"><a class="g-color-white-opacity-0_8 g-color-white--hover" href="http://www.chiapas.gob.mx/radio">Radio</a></li>
											<li class="list-inline-item"><span>|</span></li>
											<li class="list-inline-item"><a class="g-color-white-opacity-0_8 g-color-white--hover" href="http://www.chiapas.gob.mx/prensa">Prensa</a></li>
											<li class="list-inline-item"><span>|</span></li>
											<li class="list-inline-item"><a class="g-color-white-opacity-0_8 g-color-white--hover" href="http://www.chiapas.gob.mx/redes">Redes sociales</a></li>
										</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-2 align-self-center d-none d-sm-none d-md-none d-lg-none d-xl-block">
						<ul class="list-inline text-center text-md-right mb-0">
							<li class="list-inline-item g-mr-10"><a class="u-icon-v3 u-icon-size--xs g-bg-white-opacity-0_1 g-bg-white-opacity-0_2--hover g-color-white-opacity-0_6" target="_blank" href="https://www.facebook.com/SHyFPChiapas/"><i class="fa fa-facebook"></i></a></li>
							<li class="list-inline-item g-mr-10"><a class="u-icon-v3 u-icon-size--xs g-bg-white-opacity-0_1 g-bg-white-opacity-0_2--hover g-color-white-opacity-0_6" target="_blank" href="https://www.instagram.com/shyfpchiapas/"><i class="fa fa-instagram"></i></a></li>
							<li class="list-inline-item g-mr-10"><a class="u-icon-v3 u-icon-size--xs g-bg-white-opacity-0_1 g-bg-white-opacity-0_2--hover g-color-white-opacity-0_6" target="_blank" href="https://twitter.com/SHyFP_Chiapas"><i class="fa fa-twitter"></i></a></li>
						</ul>
					</div>
				</div>
							
			</div>
		</footer>

		<?php echo Html::script('public/assets/vendor/jquery/jquery.min.js');; ?>

		<?php echo Html::script('public/assets/vendor/jquery-migrate/jquery-migrate.min.js');; ?>

		<?php echo Html::script('public/assets/vendor/popper.js/popper.min.js');; ?>

		<?php echo Html::script('public/assets/vendor/bootstrap/bootstrap.min.js');; ?>		
		<?php echo Html::script('public/assets/vendor/hs-megamenu/src/hs.megamenu.js');; ?>

		<?php echo Html::script('public/assets/vendor/dzsparallaxer/dzsparallaxer.js');; ?>

		<?php echo Html::script('public/assets/vendor/dzsparallaxer/dzsscroller/scroller.js');; ?>

		<?php echo Html::script('public/assets/vendor/dzsparallaxer/advancedscroller/plugin.js');; ?>

		<?php echo Html::script('public/assets/vendor/fancybox/jquery.fancybox.min.js');; ?>

		<?php echo Html::script('public/assets/vendor/slick-carousel/slick/slick.js');; ?>

		<?php echo Html::script('public/assets/js/hs.core.js');; ?>

		<?php echo Html::script('public/assets/vendor/typedjs/typed.min.js');; ?>

		<?php echo Html::script('public/assets/js/components/hs.header.js');; ?>

		<?php echo Html::script('public/assets/js/helpers/hs.hamburgers.js');; ?>

		<?php echo Html::script('public/assets/js/components/hs.dropdown.js');; ?>

		<?php echo Html::script('public/assets/js/components/hs.popup.js');; ?>

		<?php echo Html::script('public/assets/js/components/hs.carousel.js');; ?>

		<?php echo Html::script('public/assets/js/components/hs.go-to.js');; ?>						
		<?php echo Html::script('public/assets/js/custom.js');; ?>

		<script src="https://declarachiapas.shyfpchiapas.gob.mx/js/sweetalert2-7.33.1/sweetalert2.all.min.js"></script>
        <?php echo Html::script('public/js/backend/recuperar_password.js');; ?>						
		
						
		<script>
			$(document).on('ready', function () {		
				$.HSCore.components.HSHeader.init($('#js-header'));
				$.HSCore.helpers.HSHamburgers.init('.hamburger');						
				$('.js-mega-menu').HSMegaMenu({
					event: 'hover',
					pageContainer: $('.container'),
				    breakpoint: 991
				});						
				$.HSCore.components.HSDropdown.init($('[data-dropdown-target]'), {
					afterOpen: function () {
						$(this).find('input[type="search"]').focus();
					}
				});						
				$.HSCore.components.HSPopup.init('.js-fancybox');						
				$.HSCore.components.HSCarousel.init('.js-carousel');
				$.HSCore.components.HSGoTo.init('.js-go-to');
				
				
				// swal({
				// 	html: '<img src="https://apps.shyfpchiapas.gob.mx/sircse/img/cierre_ventanilla_ii.jpg" width="80%" />',
				// 	width: '700px',
				// 	focusConfirm: false,
				// 	confirmButtonText: '<i class="fa fa-thumbs-up"></i> Cerrar',
				// 	confirmButtonAriaLabel: 'Ok!',
				// 	animation: true,
				// 	customClass: 'animate__hinge'
				// });
				
				
			});
		</script>
		<!-- ================== END BASE JS ================== -->	

	</body>
</html>
<?php /**PATH C:\AppServ\apps\sircse\resources\views/layouts/login.blade.php ENDPATH**/ ?>
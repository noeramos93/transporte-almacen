<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bienvenido</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Webestica.com">
	<meta name="description" content="Creative Multipurpose Bootstrap Template">

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?=base_url()?>static/img/logo_2.jpeg">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900%7CPlayfair+Display:400,400i,700,700i%7CRoboto:400,400i,500,700" rel="stylesheet">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/core/vendor/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/core/vendor/themify-icons/css/themify-icons.css" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/core/vendor/animate/animate.min.css" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/core/vendor/owlcarousel/css/owl.carousel.min.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/core/css/style.css" />
	<!-- CSS Extras por modulo-->
	<?php
        if(!is_null($ccsLibs) && empty($ccsLibs[0]) == false ) :
            foreach ($ccsLibs as $estylos) { ?>
                <link rel="stylesheet" href="<?=base_url()?>static/<?php echo $estylos;?>" type="text/css">
            <?php                                                                 }
        endif;
    ?>
</head>
<body>
	<div class="preloader">
		<img src="<?=base_url()?>static/core/images/preloader.svg" alt="Pre-loader">
	</div>

	<!-- ======================= header Start-->
	<header class="navbar-floating navbar-sticky navbar-light">
		<!-- Logo Nav Start -->
		<nav class="navbar navbar-expand-lg">
			<div class="container shadow">
				<!-- Logo -->
				<a class="navbar-brand" href="<?=base_url()?>Home">
					<!-- SVG Logo Start -->
					<img class="logo-menu" src="<?=base_url()?>static/img/logo_2.jpeg">
					<!-- SVG Logo End -->
				</a>
				<!-- Menu opener button -->
				<button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"> </span>
			  </button>
				<!-- Main Menu Start -->
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<ul class="navbar-nav mx-auto">
						<!-- Menu item 1 Configuraciones-->
						<li class="nav-item dropdown active">
							<a class="nav-link dropdown-toggle active" href="#" id="demosMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Configuración</a>
							<div class="dropdown-menu pb-3 pb-lg-0" aria-labelledby="demosMenu" >
								<div class="d-block d-sm-flex">
									<ul class="list-unstyled w-100 w-sm-50 pr-0 pr-lg-5">
										<li> <a class="dropdown-item" href="<?=base_url()?>configuracion/Roles">Roles</a></li>
										<li> <a class="dropdown-item" href="<?=base_url()?>configuracion/Permisos">Permisos</a> </li>
										<li> <a class="dropdown-item" href="<?=base_url()?>configuracion/Modulos">Modulos</a> </li>
										<li> <a class="dropdown-item" href="<?=base_url()?>configuracion/ModulosPermisos">Modulos - Permisos</a> </li>
										<li> <a class="dropdown-item" href="<?=base_url()?>configuracion/Usuarios">Usuarios</a> </li>
										<li> <a class="dropdown-item" href="<?=base_url()?>configuracion/UsuariosPermisos">Usuarios - Permisos</a> </li>
										<li> <a class="dropdown-item" href="<?=base_url()?>configuracion/Departamentos">Departamentos</a> </li>
										<li> <a class="dropdown-item" href="<?=base_url()?>configuracion/FoliosDocumentos">Folios de Documentos</a> </li>
									</ul>
								</div>
							</div>
						</li>
						<!-- Menu item 2 Codigos Generales-->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="blogMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catalogos Generales</a>
							<ul class="dropdown-menu" aria-labelledby="blogMenu">
								<li><a class="dropdown-item" href="<?=base_url()?>catalogosGenerales/CatalogoGeneral/propietarios">Propietarios</a></li>
								<li><a class="dropdown-item" href="<?=base_url()?>catalogosGenerales/CatalogoGeneral/proveedores">Proveedores</a></li>
								<li><a class="dropdown-item" href="<?=base_url()?>catalogosGenerales/CatalogoGeneral/clientes">Clientes</a></li>
							</ul>
						</li>
						<!-- Menu item 3 Almacen-->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="pagesMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Alamacen</a>
							<ul class="dropdown-menu" aria-labelledby="pagesMenu">
								<li> <a class="dropdown-item" href="<?=base_url()?>almacen/Ubicaciones">Ubicaciones</a></li>
								<li> <a class="dropdown-item" href="<?=base_url()?>almacen/TipoInventario">Tipo de Inventarios</a> </li>
								<li> <a class="dropdown-item" href="<?=base_url()?>almacen/Almacenes">Almacenes</a> </li>
								<li> <a class="dropdown-item" href="<?=base_url()?>almacen/TipoMovimientos">Tipo de movimientos</a> </li>
								<li> <a class="dropdown-item" href="<?=base_url()?>almacen/Partes">Partes</a> </li>
								<li class="dropdown-divider"></li>
								<!-- Segunda parte del submenu -->
								<li> <a class="dropdown-item" href="<?=base_url()?>almacen/OrdenCompra">Ordenes de compra</a> </li>
								<li> <a class="dropdown-item" href="<?=base_url()?>almacen/FacturaCompra">Facturas de compra</a> </li>
								<li> <a class="dropdown-item" href="<?=base_url()?>almacen/MovAlmacen">Movimientos de almancen</a> </li>
								<li> <a class="dropdown-item" href="<?=base_url()?>almacen/Traspasos">Traspasos</a> </li>
								<li> <a class="dropdown-item" href="<?=base_url()?>almacen/ReqTaller">Requisiciones de taller</a> </li>
							</ul>
						</li>
						<!-- Menu item 4 Mantenimiento-->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="portfolioMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Matenimiento</a>
							<ul class="dropdown-menu" aria-labelledby="portfolioMenu">
								<!-- <li> <a class="dropdown-item" href="portfolio-grid-column-3.html">Portfolio Column 3</a> </li>
								<li> <a class="dropdown-item" href="portfolio-grid-column-4.html">Portfolio Column 4</a> </li>
								<li> <a class="dropdown-item" href="portfolio-grid-column-5.html">Portfolio Column 5</a> </li>
								<li> <a class="dropdown-item" href="portfolio-grid-column-6.html">Portfolio Column 6</a> </li>
								<li> <a class="dropdown-item" href="portfolio-single.html">Portfolio Single</a> </li>
								<li> <a class="dropdown-item" href="portfolio-single-02.html">Portfolio Single 2</a> </li>
								<li> <a class="dropdown-item" href="portfolio-case-studies.html">Portfolio case studies <span class="badge badge-success ml-2">Hot</span></a> </li> -->
							</ul>
						</li>
						<!-- Menu item 5 Administracion-->
						<li class="nav-item dropdown megamenu">
							<a class="nav-link dropdown-toggle" href="#" id="elementsMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administracion</a>
							<div class="dropdown-menu" aria-labelledby="elementsMenu" >
								<!-- <div class="container">
									<div class="row">
										<div class="col-sm-6 col-lg-3">
											<ul class="list-unstyled">
												<li> <a class="dropdown-item" href="elements-accordion.html">Accordion</a> </li>
												<li> <a class="dropdown-item" href="elements-action-box.html">Action box</a> </li>
												<li> <a class="dropdown-item" href="elements-alerts.html">Alerts</a> </li>
												<li> <a class="dropdown-item" href="elements-animated-headlines.html">Animated Headlines</a> </li>
												<li> <a class="dropdown-item" href="elements-blockquote.html">Blockquote</a> </li>
												<li> <a class="dropdown-item" href="elements-buttons.html">Buttons</a> </li>
											</ul>
										</div>
										<div class="col-sm-6 col-lg-3">
											<ul class="list-unstyled">
												<li> <a class="dropdown-item" href="elements-clients.html">Clients</a> </li>
												<li> <a class="dropdown-item" href="elements-counter.html">Counter</a> </li>
												<li> <a class="dropdown-item" href="elements-divider.html">Divider</a> </li>
												<li> <a class="dropdown-item" href="elements-feature-box.html">Feature box</a> </li>
												<li> <a class="dropdown-item" href="elements-forms.html">Forms</a> </li>
												<li> <a class="dropdown-item" href="elements-grid.html">Grid</a> </li>
											</ul>
										</div>
										<div class="col-sm-6 col-lg-3">
											<ul class="list-unstyled">
												<li> <a class="dropdown-item" href="elements-list-styles.html">list styles</a> </li>
												<li> <a class="dropdown-item" href="elements-map.html">Map</a> </li>
												<li> <a class="dropdown-item" href="elements-modal.html">Modal</a> </li>
												<li> <a class="dropdown-item" href="elements-skill.html">skill</a> </li>
												<li> <a class="dropdown-item" href="elements-social-icon.html">social icon</a> </li>
												<li> <a class="dropdown-item" href="elements-tab.html">Tab</a> </li>
											</ul>
										</div>
										<div class="col-sm-6 col-lg-3">
											<ul class="list-unstyled">
												<li> <a class="dropdown-item" href="elements-table.html">Table</a> </li>
												<li> <a class="dropdown-item" href="elements-team.html">Team</a> </li>
												<li> <a class="dropdown-item" href="elements-typography.html">Typography</a> </li>
												<li> <a class="dropdown-item" href="elements-video.html">Video</a> </li>
											</ul>
										</div>
									</div>
								</div>-->
							</div>
						</li>
						<!-- Menu item 6 Salir-->
						<li class="nav-item">
							<a class="nav-link" href="<?=base_url()?>Login/logaut" id="docMenu" aria-haspopup="true" aria-expanded="false">Salir</a>
						</li>
					</ul>
				</div>
				<!-- Main Menu End -->
				<!-- Header Extras Start-->
				<div class="navbar-nav">
					<!-- extra item Btn-->
					<div class="nav-item border-0 d-none d-lg-inline-block align-self-center">
						<a href="#" class=" btn btn-sm btn-grad text-white mb-0">Mi perfil</a>
					</div>
				</div>
				<!-- Header Extras End-->
			</div>
		</nav>
		<!-- Logo Nav End -->
	</header>
	<!-- ======================= header End-->

	<!-- **********************************INICIA SECCION VISTA******************************************-->
	<?=$VISTA?>
	<!-- ********************************TERMINA SECCION VISTA*********************************************-->

	<!--Global JS-->
	<script src="<?=base_url()?>static/core/vendor/jquery/jquery.min.js"></script>
	<script src="<?=base_url()?>static/core/vendor/popper.js/umd/popper.min.js"></script>
	<script src="<?=base_url()?>static/core/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>static/core/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!--Vendors-->
	<script src="<?=base_url()?>static/core/vendor/fancybox/js/jquery.fancybox.min.js"></script>
	<script src="<?=base_url()?>static/core/vendor/owlcarousel/js/owl.carousel.min.js"></script>
	<script src="<?=base_url()?>static/core/vendor/swiper/js/swiper.min.js"></script>
	<script src="<?=base_url()?>static/core/vendor/jarallax/jarallax.min.js"></script>
	<script src="<?=base_url()?>static/core/vendor/wow/wow.min.js"></script>
	<script src="<?=base_url()?>static/core/vendor/animated-headline/main.js"></script>

	<!--Template Functions-->
	<script src="<?=base_url()?>static/core/js/functions.js"></script>
	<script src="<?=base_url()?>static/core/js/sweetalert2/sweetalert2.all.min.js"></script>
	<script type="text/javascript">
		const BASE_PATH = "<?=base_url()?>";
	</script>

	<!--Librerias js por vista-->
	<?php
        if(!is_null($jsLibs)) :
            foreach ($jsLibs as $librerias) { ?>
                <script type="text/javascript" src="<?=base_url()?>static/<?php echo $librerias;?>"></script>
            <?php
            }
        endif;
    ?>
</body>
</html>
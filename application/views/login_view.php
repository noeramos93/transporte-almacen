<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
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

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/core/css/style.css" />

</head>

<body>

	<div class="preloader">
		<img src="<?=base_url()?>static/core/images/preloader.svg" alt="Pre-loader">
	</div>

	<?php
    	if($this->session->flashdata('error')){
	?>
    	<div id="alertLogin" class="alert alert-danger alert-dismissible alert-login" role="alert">
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        		<span aria-hidden="true">&times;</span>
        	</button>
        	<strong><?php echo $this->session->flashdata('error');?></strong>
    	</div>
	<?php
  		}
	?>
	<!-- =======================
	Sign in -->
	<section class="p-0 d-flex align-items-center">
		<div class="container-fluid">
			<div class="row">
				<!-- left -->
				<div class="col-12 col-md-5 col-lg-4 d-md-flex align-items-center bg-grad h-sm-100-vh">
					<div class="w-100 p-3 p-lg-5 all-text-white">
						<div class="justify-content-center align-self-center">
							<!-- SVG Logo Start -->
							<img src="<?=base_url()?>static/img/logo_2.jpeg">
							<!-- SVG Logo End -->
						</div>
						<h3 class="font-weight-light">Grupo Barron !</h3>
						<ul class="list-group list-group-borderless mt-4">
							<li class="list-group-item text-white"><i class="fa fa-check"></i>Facil de usar !</li>
							<li class="list-group-item text-white"><i class="fa fa-check"></i>Rapido de usar !</li>
							<li class="list-group-item text-white"><i class="fa fa-check"></i>Responsivo !</li>
						</ul>
					</div>
				</div>
				<!-- Right -->
				<div class="col-12 col-md-7 col-xl-8 mx-auto my-5">
					<div class="row h-100">
						<div class="col-12 col-md-10 col-lg-5 text-left mx-auto d-flex align-items-center">
							<div class="w-100">
								<h2 class="">Bienvenido!</h2>
								<h5 class="font-weight-light">Nos alegra verte! Inicia sesión con tu cuenta.</h5>
								<form  action="<?=base_url()?>Login/userdo" method ="POST">
									
									<div class="form mt-4 ">
										<div>
											<p class="text-left mb-2">Correo Electronico</p>
											<span class="form-group"><input id="txtEmail" name="txtEmail" type="email" class="form-control" placeholder="E-mail"></span>
										</div>
										<div>
											<div class="d-flex justify-content-between align-items-center">
												<p class="text-left mb-2">Contraseña</p>
												<a class="text-muted small mb-2" href="password-recovery.html">Olvidaste tu contraseña? Click aqui.</a>
											</div>
											<span class="form-group"><input id="txtPass" name="txtPass" type="password" class="form-control" placeholder="*********"></span>
										</div>
										<div class="align-items-start">
											<button id="btnLogin" class="btn btn-dark ">Entrar</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- =======================
	Sign in -->

	<!--Global JS-->
	<script src="<?=base_url()?>static/core/vendor/jquery/jquery.min.js"></script>
	<script src="<?=base_url()?>static/core/vendor/popper.js/umd/popper.min.js"></script>
	<script src="<?=base_url()?>static/core/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>static/core/vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="<?=base_url()?>static/core/js/sweetalert2/sweetalert2.all.min.js"></script>
	<!--Template Functions-->
	<script src="<?=base_url()?>static/core/js/functions.js"></script>
	

</body>
</html>
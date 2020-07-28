<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<br>
<br>
<section>
	<div class="container">
		<div class="row">
			<div class="col">
				<nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>Home">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Configuración</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Usuarios - Permisos</li>
                    </ol>
                </nav>
				<div class="card shadow">
					<div class="card-body">
						<div class="row ">
							<div class="col-md-12 col-sm-12">
								<h5 class="card-title text-center">Usuarios - Permisos</h5>
								<!-- Select de usuarios -->
								<div class="row justify-content-md-center">
									<div class="col-md-6">
										<label for="idUsu">Usuarios : </label>
										<select id="idUsu" class="form-control">
											<option value="0"> - Seleccionar - </option>
											<?php
												if(!is_null($usuarios)) :
													foreach ($usuarios as $us) { ?>
														<option value="<?php echo $us->Id_Usuario?>"><?php echo $us->usuario?></option>
											<?php 
                                            		}
                                        		endif;
                                    		?>
										</select>
									</div>
								</div>

								<!-- relacion modulo permiso con ckeck box -->
								<div class="row">
									
										 <?php echo $relPermisos?> 
										<!--
										<div class="col-md-6">
											
											<div class="accordion" id="accordion0">
												
												<div class="accordion-item">
													<div class="accordion-title">
														<a class="h6 mb-0" data-toggle="collapse" href="#collapse-1">How many free samples can i redeem?</a>
													</div>
													<div class="collapse show" id="collapse-1" data-parent="#accordion0">
														<div class="accordion-content">Due to the limited quantity, each member's account is only entitled to 1 unique free sample. You can check out up to 4 free samples in each checkout. We take such matters very seriously and will look into individual cases thoroughly. </div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-6">										
											<div class="accordion" id="accordion1">
												
												
												<div class="accordion-item">
													<div class="accordion-title">
														<a class="collapsed" data-toggle="collapse" href="#collapse-2">What are the payment methods available?</a>
													</div>
													<div class="collapse" id="collapse-2" data-parent="#accordion1">
														<div class="accordion-content"> At the moment, we only accept Credit/Debit cards and Paypal payments. Paypal is the easiest way to make payments online. While checking out your order. Be sure to fill in correct details for fast & hassle-free payment processing.</div>
													</div>
												</div>
											</div>
										</div>
										-->


									
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
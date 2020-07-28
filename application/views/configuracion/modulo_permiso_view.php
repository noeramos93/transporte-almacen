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
                        <li class="breadcrumb-item active" aria-current="page">Modulos - Permisos</li>
                    </ol>
                </nav>
				<div class="card shadow">
					<div class="card-body">
						<div class="row justify-content-md-center">
							<div class="col-md-6 col-sm-12">
								<h5 class="card-title text-center">Modulos - Permisos</h5>
								<!--Aqui metes el cuerpo de la vista formularios, tablas, etc... -->
								<form id="alta_modulo_permiso" action="#" >
									<div class="form-row align-items-center">
										<div class="form-group col-md-5">
											<label>Modelos</label>
											<select id="idMod" class="form-control">
												<option value="0"> - Seleccionar - </option>
												<?php
                                        			if(!is_null($modulos)) :
                                            			foreach ($modulos as $mod) { ?>
                                                			<option value="<?php echo $mod->Id_Modulo?>"><?php echo $mod->Nombre?></option>
                                    			<?php 
                                            			}
                                        			endif;
                                    			?>
											</select>
										</div>
										<div class="form-group col-md-5">
											<label>Permisos</label>
											<select id="idPer" class="form-control">
												<option value="0"> - Seleccionar - </option>
												<?php
                                        			if(!is_null($permisos)) :
                                            			foreach ($permisos as $per) { ?>
                                                			<option value="<?php echo $per->Id_Permiso?>"><?php echo $per->Nombre?></option>
                                    			<?php 
                                            			}
                                        			endif;
                                    			?>
											</select>
										</div>
										<div class="col-md-2">
											<button id="btnAltaModPer" type="submit" class="btn btn-outline-primary">Agregar</button>
										</div>
									</div>
								</form>
								
								<div class="row">
									<div class="table-responsive">
                                    	<table id="tabla_rel_mod_per" class="table table-bordered tabla-paginada text-center">
                                        	<thead class="thead-dark">
                                            	<tr>
                                                	<th>ID</th>
                                                	<th>MODULO</th>
                                                	<th>PERMISO</th>
                                                	<th>ACCIONES</th>
                                            	</tr>
                                        	</thead>
                                        	<tbody>
                                        <?php
                                            if(!is_null($relacionesModPer)) :
                                            	foreach ($relacionesModPer as $rmp) { ?>
                                                	<tr id="tr-<?php echo $rmp->Id_Relacion?>">
                                                		<td><?php echo $rmp->Id_Relacion?></td>
                                                    	<td><?php echo $rmp->Modulo?></td>
                                                    	<td><?php echo $rmp->Permiso?></td>
                                                    	<td>
                                                        	<button type="button" class="btn btn-danger delete-rmp" data-id="<?php echo $rmp->Id_Relacion?>" data-toggle="tooltip" data-placement="top" title="Eliminar relacion modulo-permiso">
                                                            	<i class="fa fa-trash-o"></i>
                                                        	</button>
                                                        	<button type="button" class="btn btn-warning edit-rmp" data-id="<?php echo $rmp->Id_Relacion?>" data-toggle="tooltip" data-placement="top" title="Actualizar relacion modulo-permiso"> 
                                                            	<i class="fa fa-pencil-square-o"></i> 
                                                        	</button>
                                                    	</td>
                                                	</tr>
                                        	<?php
                                                }
                                           	endif;
                                        	?>
                                        	</tbody>
                                    	</table>
                               		</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
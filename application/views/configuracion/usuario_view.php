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
                        <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
                    </ol>
                </nav>
				<div class="card shadow">
					<div class="card-body">
						<div class="row justify-content-md-center">
							<div class="col-md-12 col-sm-12">
								<h5 class="card-title text-center">Usuarios</h5>
								<!--formulario para dar de alta a un usuario -->
								<div class="row justify-content-md-center">
									<div class="col-md-6">
										<form id="form_usuario" action="#">
											<div class="row">
												<div class="col-md-6">
													<label for="usuName">Usuario : </label>
													<input id="usuName" type="text" name="usuName" class="form-control">
													<label for="appUsu">Apeliido paterno : </label>
													<input id="appUsu" type="text" name="appUsu" class="form-control">
													<label for="apmUsu">Apellido materno : </label>
													<input id="apmUsu" type="text" name="apmUsu" class="form-control">
													<label for="nameUsu">Nombre (s) : </label>
													<input id="nameUsu" type="text" name="nameUsu" class="form-control">
												</div>
												<div class="col-md-6">
													<label for="emailUsu">Correo</label>
													<input id="emailUsu" type="email" name="emailUsu" class="form-control">
													<label for="passUsu">Contraseña</label>
													<input id="passUsu" type="password" name="passUsu" class="form-control">
													<div class="invalid-feedback">
													    La contarseña debe ser mayor a 8 digitos
        											</div>
													<label for="rol">Rol</label>
													<select id="rol" class="form-control">
														<option value="0"> - Seleccionar - </option>
														<?php
															if(!is_null($roles)) :
																foreach ($roles as $rol) { ?>
																	<option value="<?php echo $rol->Id_Rol?>"><?php echo $rol->Nombre?></option>
														<?php 
                                            					}
                                        					endif;
                                    					?>
													</select>
													<label for="departamento">Departamento</label>
													<select id="departamento" class="form-control">
														<option value="0"> - Seleccionar - </option>
														<?php
															if(!is_null($departamentos)) :
																foreach ($departamentos as $dp) { ?>
																	<option value="<?php echo $dp->Id_Departamento?>"><?php echo $dp->Nombre?></option>
														<?php 
                                            					}
                                        					endif;
                                    					?>
													</select>
												</div>
											</div>
											<div class="row justify-content-end">
												<div class="col-md-9">
													<button id="btnResetUsu" type="reset" class="btn btn-danger">
														<i class="fa fa-trash-o"></i>Limpiar Formulario
													</button>
                                            		<button id="btnSaveUsu" type="submit" class="btn btn-primary">
                                            			<i class="fa fa-save"></i>Guardar
                                            		</button>
												</div>
											</div>
										</form>
									</div>
								</div>

								<br>
								<!-- Empieza la tabla de usuario -->
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
											<table id="tabla_usuarios" class="table table-bordered text-center">
												<thead class="thead-dark">
													<tr>
														<th>ID</th>
														<th>USUARIO</th>
														<th>NOMBRE</th>
														<th>CORREO</th>
														<th>ROL</th>
														<th>DEPARTAMENTO</th>
														<th>ACCIONES</th>
													</tr>
												</thead>
												<tbody>
												<?php
                                            		if(!is_null($usuarios)) :
                                                		foreach ($usuarios as $usu) { ?>
                                                    		<tr id="tr-<?php echo  $usu->Id_Usuario?>">
                                                        		<td><?php echo $usu->Id_Usuario?></td>
                                                        		<td><?php echo $usu->Usuario?></td>
                                                        		<td><?php echo $usu->Name?></td>
                                                        		<td><?php echo $usu->email?></td>
                                                        		<td><?php echo $usu->Rol?></td>
                                                        		<td><?php echo $usu->Departamento?></td>
                                                        		<td>
                                                   					<button type="button" class="btn btn-danger delete-usu" data-id="<?php echo $usu->Id_Usuario?>" data-toggle="tooltip" data-placement="top" title="Eliminar Usuario">
                                                                		<i class="fa fa-trash-o"></i>
                                                            		</button>
                                                            		<button type="button" class="btn btn-warning edit-usu" data-id="<?php echo $usu->Id_Usuario?>" data-toggle="tooltip" data-placement="top" title="Editar Usuario"> 
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
	</div>
</section>


<div id="modalEditUsuario" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edicion de Usuarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    
                    
                    	<form id="form_usu_edt" action="#" class="form-row">
                    		<input id="usuId" type="text" name="usuId" style="display: none;">
							<div class="col-md-6">
								<label for="usuNameEdt">Usuario : </label>
								<input id="usuNameEdt" type="text" name="usuNameEdt" class="form-control">
								<label for="nameUsuEdt">Nombre : </label>
								<input id="nameUsuEdt" type="text" name="nameUsuEdt" class="form-control">
							</div>
							<div class="col-md-6">
								<label for="emailUsuEdt">Correo</label>
								<input id="emailUsuEdt" type="email" name="emailUsuEdt" class="form-control">
								<label for="passUsuEdt">Cambiar Contraseña</label>
								<input id="passUsuEdt" type="password" name="passUsuEdt" class="form-control">
								<div class="invalid-feedback">
									La contarseña debe ser mayor a 8 digitos
        						</div>
								<label for="rolEdt">Rol</label>
								<select id="rolEdt" class="form-control">
									<option value="0"> - Seleccionar - </option>
									<?php
										if(!is_null($roles)) :
											foreach ($roles as $rol) { ?>
												<option value="<?php echo $rol->Id_Rol?>"><?php echo $rol->Nombre?></option>
									<?php 
	                                        }
	                                    endif;
	                                ?>
								</select>
								
								<label for="departamentoEdt">Departamento</label>
								<select id="departamentoEdt" class="form-control">
									<option value="0"> - Seleccionar - </option>
									<?php
										if(!is_null($departamentos)) :
											foreach ($departamentos as $dp) { ?>
												<option value="<?php echo $dp->Id_Departamento?>"><?php echo $dp->Nombre?></option>
									<?php 
	                                        }
	                                    endif;
	                                ?>
								</select>
							</div>
                    	</form>
					

                </div>
            </div>
            <div class="modal-footer">
                <button id="editUsuInfo" type="button" class="btn btn-primary">Guardar Cambios</button>
                <button id="cancelEditUsu" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
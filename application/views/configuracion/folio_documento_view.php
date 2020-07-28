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
                        <li class="breadcrumb-item active" aria-current="page">Folios - Documentos</li>
                    </ol>
                </nav>
				<div class="card shadow">
					<div class="card-body">
						<div class="row justify-content-md-center">
							<div class="col-md-6 col-sm-12">
								<h5 class="card-title text-center">Folios - Documentos</h5>
								<!--Aqui metes el cuerpo de la vista formularios, tablas, etc... -->
								<form id="form_alta_folio" action="#">
                                    <div class="row ">
                                        <div class="col-md-5">
                                            <label for="idFol">Id Folio : </label>
                                            <input id="idFol" type="text" name="idFol" class="form-control form-control-sm" maxlength="11" value="<?php echo $idNextFol;?>" disabled>
                                            <label for="docName">Documento : </label>
                                            <input id="docName" type="text" name="docName" class="form-control form-control-sm" maxlength="60">
                                            <label for="serieFol">Serie : </label>
                                            <input id="serieFol" type="text" name="serieFol" class="form-control form-control-sm" maxlength="60">
                                            <label for="nextFol">Siguiente Folio : </label>
                                            <input id="nextFol" type="text" name="nextFol" class="form-control form-control-sm" maxlength="60">
                                        </div>

                                    </div>

                                	<div class="row">
                                    	<div class="col-md-12">
                                    		<button id="btnSaveFol" type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Guardar</button>
                                    		<button id="btnReset" type="reset" class="btn btn-danger"><i class="fa fa-trash-o"></i>Limpia Formulario</button>
                                    	</div>
                                	</div>
                                    <div class="row">
                                    	<div class="col-md-12 col-sm-12">
                                			<div class="table-responsive">
                                    			<table id="tabla_folios" class="table table-bordered tabla-paginada text-center">
                                        			<thead class="thead-dark">
                                            			<tr>
                                                			<th>ID</th>
                                                			<th>DOCUMENTO</th>
                                                			<th>SERIE</th>
                                                			<th>SIGUIENTE FOLIO</th>
                                                			<th>ACCIONES</th>
                                            			</tr>
                                        			</thead>
                                        		<tbody>
                                        		<?php
                                            		if(!is_null($folios)) :
                                                		foreach ($folios as $fol) { ?>
                                                    		<tr id="tr-<?php echo  $fol->Id_Folio?>">
                                                        		<td><?php echo $fol->Id_Folio?></td>
                                                        		<td><?php echo $fol->Documento?></td>
                                                        		<td><?php echo $fol->Serie?></td>
                                                        		<td><?php echo $fol->FolioSiguiente?></td>
                                                        		<td>
                                                            		<button type="button" class="btn btn-danger delete-fol" data-id="<?php echo $fol->Id_Folio?>" data-toggle="tooltip" data-placement="top" title="Eliminar Folio">
                                                                		<i class="fa fa-trash-o"></i> 
                                                            		</button>
                                                            		<button type="button" class="btn btn-warning edit-fol" data-id="<?php echo $fol->Id_Folio?>" data-toggle="tooltip" data-placement="top" title="Editar Folio"> 
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
                            </form>
                            <!-- /termina seccion  folio-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<!-- Modal para edita una ubicacion-->
<div id="modalFolEdit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Folio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <label for="docNameEdt">Documento : </label>
                        <input id="docNameEdt" type="text" name="docNameEdt" class="form-control form-control-sm" maxlength="60">
                        <label for="serieFolEdt">Serie : </label>
                        <input id="serieFolEdt" type="text" name="serieFolEdt" class="form-control form-control-sm" maxlength="60">
                        <label for="nextFolEdt">Siguiente Folio : </label>
                        <input id="nextFolEdt" type="text" name="nextFolEdt" class="form-control form-control-sm" maxlength="60">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveEditFol" type="button" class="btn btn-primary">Guardar Cambios</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<br>
<br>
<section>
    <div class="container">
        <div class="row">
            <div class="col align-self-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>Home">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Configuración</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Modulos</li>
                    </ol>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-md-6 col-sm-12">
                                <h5 class="card-title text-center">Modulos</h5>
                                <div class="table-responsive">
                                    <table id="table_modulos" class="table table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>NOMBRE</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                            if(!is_null($modulos)) :
                                                foreach ($modulos as $mod) { ?>
                                                    <tr id="tr-<?php echo  $mod->Id_Modulo?>">
                                                        <td><?php echo $mod->Id_Modulo?></td>
                                                        <td><?php echo $mod->Nombre?></td>
                                                        <td>
                                                   			<button type="button" class="btn btn-danger  delete-mod" data-id="<?php echo $mod->Id_Modulo?>" data-toggle="tooltip" data-placement="top" title="Eliminar Modulo">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning  edit-mod" data-id="<?php echo $mod->Id_Modulo?>" data-toggle="tooltip" data-placement="top" title="Editar Modulo"> 
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
</section>


<div id="modalModulosEdit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambios Modulos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <label for="nameModulo" >Nombre del Modulo a editar</label>
                        <input type="text" id="nameModulo" name="nameModulo" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveEditMod" type="button" class="btn btn-primary">Guardar Cambios</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
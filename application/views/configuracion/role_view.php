<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
                        <li class="breadcrumb-item active" aria-current="page">Roles</li>
                    </ol>
                </nav>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row justify-content-md-center">                        
                            <div class="col-md-6 col-sm-12">
                                <h5 class="card-title text-center">Roles</h5>
                                <div class="table-responsive">
                                    <table id="table_roles" class="table table-bordered text-center">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>NOMBRE</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if(!is_null($roles)) :
                                                foreach ($roles as $rol) { ?>
                                                    <tr id="tr-<?php echo  $rol->Id_Rol?>">
                                                        <td><?php echo $rol->Id_Rol?></td>
                                                        <td><?php echo $rol->Nombre?></td>
                                                        <td>
                                                   			<button type="button" class="btn btn-danger delete-rol" data-id="<?php echo $rol->Id_Rol?>" data-toggle="tooltip" data-placement="top" title="Eliminar Rol">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning edit-rol" data-id="<?php echo $rol->Id_Rol?>" data-toggle="tooltip" data-placement="top" title="Editar Rol"> 
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


<div id="modalRolesEdit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambios Roles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <label for="nameRol" >Nombre del rol a editar</label>
                        <input type="text" id="nameRol" name="nameRol" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveEditRol" type="button" class="btn btn-primary">Guardar Cambios</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

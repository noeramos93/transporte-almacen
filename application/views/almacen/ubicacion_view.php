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
                        <li class="breadcrumb-item"><a href="#">Almacen</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ubicaciones</li>
                    </ol>
                </nav>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-md-6 col-sm-12">
                                <h5 class="card-title text-center">Ubicaciones</h5>
                                <button id="addUbic" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Agregar Ubicacion</button>
                                <div class="table-responsive">
                                    <table id="tabla_ubicaciones" class="table table-bordered tabla-paginada text-center">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>NOMBRE</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if(!is_null($ubicaciones)) :
                                                foreach ($ubicaciones as $ubc) { ?>
                                                    <tr id="tr-<?php echo  $ubc->Id_Ubicacion?>">
                                                        <td><?php echo $ubc->Id_Ubicacion?></td>
                                                        <td><?php echo $ubc->Nombre?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger delete-ubc" data-id="<?php echo $ubc->Id_Ubicacion?>" data-toggle="tooltip" data-placement="top" title="Eliminar Ubicacion">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning edit-ubc" data-id="<?php echo $ubc->Id_Ubicacion?>" data-toggle="tooltip" data-placement="top" title="Editar Ubicacion"> 
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
                               <!-- Termina div table responsive de ubicaciones -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal para agregar una nueva ubicacion-->
<div id="modalNewUbic" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva Ubicacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <label for="nameUbic" >Nombre de la nueva ubicacion</label>
                        <input type="text" id="nameUbic" name="nameUbic" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveNewUbic" type="button" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para edita una ubicacion-->
<div id="modalUbicEdit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Ubicacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <label for="nameUbicEdt" >Nombre de la ubicacion a editar</label>
                        <input type="text" id="nameUbicEdt" name="nameUbicEdt" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveEditUbic" type="button" class="btn btn-primary">Guardar Cambios</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

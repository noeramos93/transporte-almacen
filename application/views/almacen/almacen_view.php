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
                        <li class="breadcrumb-item active" aria-current="page">Almacenes</li>
                    </ol>
                </nav>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-md-6 col-sm-12">
                                <h5 class="card-title text-center">Almacenes</h5>
                                <button id="addAlm" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Agregar Almacen</button>
                                <!--Aqui metes el cuerpo de la vista formularios, tablas, etc... -->
                                <div class="table-responsive">
                                    <table id="tabla_almacenes" class="table table-bordered tabla-paginada text-center">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>NOMBRE</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if(!is_null($almacenes)) :
                                                foreach ($almacenes as $alm) { ?>
                                                    <tr id="tr-<?php echo  $alm->Id_Almacen?>">
                                                        <td><?php echo $alm->Id_Almacen?></td>
                                                        <td><?php echo $alm->Nombre?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger delete-alm" data-id="<?php echo $alm->Id_Almacen?>" data-toggle="tooltip" data-placement="top" title="Eliminar Almacen">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning edit-alm" data-id="<?php echo $alm->Id_Almacen?>" data-toggle="tooltip" data-placement="top" title="Editar Almacen"> 
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
                               <!-- Termina div table responsive de almacenes-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal para agregar un nuevo almacen-->
<div id="modalNewAlm" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo almacen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <label for="nameAlm" >Nombre del nuevo almacen</label>
                        <input type="text" id="nameAlm" name="nameAlm" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveNewAlm" type="button" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para edita una ubicacion-->
<div id="modalAlmEdit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Almacen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <label for="nameAlmEdt" >Nombre de la ubicacion a editar</label>
                        <input type="text" id="nameAlmEdt" name="nameAlmEdt" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveEditAlm" type="button" class="btn btn-primary">Guardar Cambios</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
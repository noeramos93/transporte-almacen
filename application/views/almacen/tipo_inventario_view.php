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
                        <li class="breadcrumb-item active" aria-current="page">Tipo de inventario</li>
                    </ol>
                </nav>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-md-6 col-sm-12">
                                <h5 class="card-title text-center">Tipo de inventario</h5>
                                <button id="addTipInv" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Agregar tipo de inventario</button>
                                <div class="table-responsive">
                                    <table id="tabla_tipo_inv" class="table table-bordered tabla-paginada text-center">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>NOMBRE</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if(!is_null($tipoInventarios)) :
                                                foreach ($tipoInventarios as $tipInv) { ?>
                                                    <tr id="tr-<?php echo  $tipInv->Id_Tipo?>">
                                                        <td><?php echo $tipInv->Id_Tipo?></td>
                                                        <td><?php echo $tipInv->Nombre?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger delete-tipInv" data-id="<?php echo $tipInv->Id_Tipo?>" data-toggle="tooltip" data-placement="top" title="Eliminar Tipo de Inventario">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning edit-tipInv" data-id="<?php echo $tipInv->Id_Tipo?>" data-toggle="tooltip" data-placement="top" title="Editar Tipo de Inventario"> 
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
                               <!-- Termina div table responsive de tipo de inventarios -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal para agregar una nuev tipo de inventario-->
<div id="modalNewTipInv" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo tipo de inventario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <label for="nameTipInv" >Nombre del nuevo tipo de inventario</label>
                        <input type="text" id="nameTipInv" name="nameTipInv" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveNewTipInv" type="button" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para edita una ubicacion-->
<div id="modalTipInvEdit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar tipo de inventario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <label for="nameTipInvEdt" >Nombre de la ubicacion a editar</label>
                        <input type="text" id="nameTipInvEdt" name="nameTipInvEdt" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveEditTipInv" type="button" class="btn btn-primary">Guardar Cambios</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

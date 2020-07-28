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
                        <li class="breadcrumb-item active" aria-current="page">Tipo de movimiento</li>
                    </ol>
                </nav>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-md-6 col-sm-12">
                                <h5 class="card-title text-center">Tipo de movimiento</h5>
                                <button id="addTipMov" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Agregar tipo de movimiento</button>
                                <div class="table-responsive">
                                    <table id="tabla_tipo_mov" class="table table-bordered tabla-paginada text-center">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>NOMBRE</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if(!is_null($tipoMovimientos)) :
                                                foreach ($tipoMovimientos as $tipMov) { ?>
                                                    <tr id="tr-<?php echo  $tipMov->Id_TipoMov?>">
                                                        <td><?php echo $tipMov->Id_TipoMov?></td>
                                                        <td><?php echo $tipMov->Nombre?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger delete-tipMov" data-id="<?php echo $tipMov->Id_TipoMov?>" data-toggle="tooltip" data-placement="top" title="Eliminar Tipo de Movimiento">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning edit-tipMov" data-id="<?php echo $tipMov->Id_TipoMov?>" data-toggle="tooltip" data-placement="top" title="Editar Tipo de Movimiento"> 
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


<!-- Modal para agregar una nuev tipo de movimiento-->
<div id="modalNewTipMov" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo tipo de movimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <label for="nameTipMov" >Nombre del nuevo tipo de movimiento</label>
                        <input type="text" id="nameTipMov" name="nameTipMov" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveNewTipMov" type="button" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para edita un tipo de movimiento-->
<div id="modalTipMovEdit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar tipo de movimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <label for="nameTipMovEdt" >Nombre del tipo de movimiento a editar</label>
                        <input type="text" id="nameTipMovEdt" name="nameTipMovEdt" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveEditTipMov" type="button" class="btn btn-primary">Guardar Cambios</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
                        <li class="breadcrumb-item active" aria-current="page">Departamentos</li>
                    </ol>
                </nav>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-md-8 col-sm-12">                        
                                <h5 class="card-title text-center">Departamentos</h5>
                                <div class="table-responsive">
                                    <table id="table_departamento" class="table table-bordered text-center">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>NOMBRE</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                            if(!is_null($departamentos)) :
                                                foreach ($departamentos as $dep) { ?>
                                                    <tr id="tr-<?php echo  $dep->Id_Departamento?>">
                                                        <td><?php echo $dep->Id_Departamento;?></td>
                                                        <td><?php echo $dep->Nombre;?></td>
                                                        <td>
                                                   			<button type="button" class="btn btn-danger waves-effect delete-dep" data-id="<?php echo $dep->Id_Departamento?>" data-toggle="tooltip" data-placement="top" title="Eliminar Departamento">
                                                                <i class="fa fa-trash-o"></i> 
                                                            </button>
                                                            <button type="button" class="btn btn-warning waves-effect edit-dep" data-id="<?php echo $dep->Id_Departamento?>" data-toggle="tooltip" data-placement="top" title="Editar Departamento"> 
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


<div id="modalDepEdit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar departamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <label for="nameDep" >Nombre del departamento a editar</label>
                        <input type="text" id="nameDep" name="nameDep" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveEditDep" type="button" class="btn btn-primary">Guardar Cambios</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

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
                        <li class="breadcrumb-item"><a href="#">Catalogos generales</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Propietarios</li>
                    </ol>
                </nav>
                <div class="card shadow">
                    <div class="card-body">
                        <!-- Inicia formulario de Propietarios-->
                        <div class="row justify-content-md-center">
                            <div class="col-md-8 col-sm-12">
                                <h5 class="card-title text-center"><i class="fa fa-user-plus"></i> Alta de propietarios</h5>
                                <form id="form_alta_propietario" action="#">
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-5">
                                            <label for="idProp">Id Propietario : </label>
                                            <input id="idProp" type="text" name="idProp" class="form-control form-control-sm" maxlength="11" value="<?php echo $idPropietario;?>" disabled>
                                            <label for="appaternoProp">Apellido paterno : </label>
                                            <input id="appaternoProp" type="text" name="appaternoProp" class="form-control form-control-sm" maxlength="60">
                                            <label for="apmaternoProp">Apellido materno : </label>
                                            <input id="apmaternoProp" type="text" name="apmaternoProp" class="form-control form-control-sm" maxlength="60">
                                            <label for="nombresProp">Nombre (s) : </label>
                                            <input id="nombresProp" type="text" name="nombresProp" class="form-control form-control-sm" maxlength="60">
                                            <label for="razSoProp">Razon social : </label>
                                            <input id="razSoProp" type="text" name="razSoProp" class="form-control form-control-sm" maxlength="200">
                                            <label for="rfcProp">RFC : </label>
                                            <input id="rfcProp" type="text" name="rfcProp" class="form-control form-control-sm" maxlength="13">
                                            <label for="calleProp">Calle</label>
                                            <input id="calleProp" type="text" name="calleProp" class="form-control form-control-sm" maxlength="60">
                                        </div>

                                        <div class="col-md-5">
                                            <label for="colProp">Colonia : </label>
                                            <input id="colProp" type="text" name="colProp" class="form-control form-control-sm" maxlength="60">
                                            <label for="cpProp">CP : </label>
                                            <input id="cpProp" type="text" name="cpProp" class="form-control form-control-sm" maxlength="5">
                                            <label for="estadoProp">Estado : </label>
                                            <select id="estadoProp" class="form-control form-control-sm form-control-sm">
                                                <option value="0"> - Seleccionar - </option>
                                                <?php
                                                    if(!is_null($estados)) :
                                                        foreach ($estados as $est) { ?>
                                                            <option value="<?php echo $est->Id_Estado?>"><?php echo $est->Nombre_Estado?></option>
                                                <?php 
                                                        }
                                                    endif;
                                                ?>
                                            </select>
                                            <label for="celProp">Celular : </label>
                                            <input id="celProp" type="text" name="celProp" class="form-control form-control-sm" maxlength="20">
                                            <label for="telProp">Telefono : </label>
                                            <input id="telProp" type="text" name="telProp" class="form-control form-control-sm" maxlength="20">
                                            <label for="emailProp">Correo : </label>
                                            <input id="emailProp" type="text" name="emailProp" class="form-control form-control-sm" maxlength="60">
                                            <label for="tipoPerProp">Tipo persona : </label>
                                            <select id="tipoPerProp" class="form-control form-control-sm">
                                                <option value="0"> - Seleccionar - </option>
                                                <option value="1">Fisica</option>
                                                <option value="2">Moral</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-md-6">
                                            <button id="btnResetProp" type="reset" class="btn btn-danger"><i class="fa fa-trash-o"></i>Limpia Formulario</button>
                                            <button id="btnSaveProp" type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Termina formulario de Propietarios-->
                        <!-- Inicia Tabla de Propietarios-->
                        <div class="row justify-content-md-center">
                            <div class="col-md-8 col-sm-12">
                                <div class="table-responsive">
                                    <table id="table_propietarios" class="table table-bordered tabla-paginada text-center">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>NOMBRE</th>
                                                <th>RAZON SOCIAL</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                            if(!is_null($propietarios)) :
                                                foreach ($propietarios as $prop) { ?>
                                                    <tr id="tr-<?php echo  $prop->Id_Propietario?>">
                                                        <td><?php echo $prop->Id_Propietario?></td>
                                                        <td><?php echo $prop->NombreCompleto?></td>
                                                        <td><?php echo $prop->RazonSocial?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger delete-prop" data-id="<?php echo $prop->Id_Propietario?>" data-toggle="tooltip" data-placement="top" title="Eliminar Propietario">
                                                                <i class="fa fa-trash-o"></i> 
                                                            </button>
                                                            <button type="button" class="btn btn-warning edit-prop" data-id="<?php echo $prop->Id_Propietario?>" data-toggle="tooltip" data-placement="top" title="Editar Propietario"> 
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
                        <!-- Termina Tabla de propietario-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div id="modalPropietarioEdit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar informacion del propietario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Inicia Formulario alta de propietarios-->
                    <form id="form_edita_propietario" action="#">
                        <div class="row justify-content-md-center">
                            <div class="col-md-5">
                                <label for="idPropEdt">Id Propietario : </label>
                                <input id="idPropEdt" type="text" name="idPropEdt" class="form-control form-control-sm" maxlength="11" disabled>
                                <label for="appaternoPropEdt">Apellido paterno : </label>
                                <input id="appaternoPropEdt" type="text" name="appaternoPropEdt" class="form-control form-control-sm" maxlength="60">
                                <label for="apmaternoPropEdt">Apellido materno : </label>
                                <input id="apmaternoPropEdt" type="text" name="apmaternoPropEdt" class="form-control form-control-sm" maxlength="60">
                                <label for="nombresPropEdt">Nombre (s) : </label>
                                <input id="nombresPropEdt" type="text" name="nombresPropEdt" class="form-control form-control-sm" maxlength="60">
                                <label for="razSoPropEdt">Razon social : </label>
                                <input id="razSoPropEdt" type="text" name="razSoPropEdt" class="form-control form-control-sm" maxlength="200">
                                <label for="rfcPropEdt">RFC : </label>
                                <input id="rfcPropEdt" type="text" name="rfcPropEdt" class="form-control form-control-sm" maxlength="13">
                                <label for="callePropEdt">Calle</label>
                                <input id="callePropEdt" type="text" name="callePropEdt" class="form-control form-control-sm" maxlength="60">
                            </div>

                            <div class="col-md-5">
                                <label for="colPropEdt">Colonia : </label>
                                <input id="colPropEdt" type="text" name="colPropEdt" class="form-control form-control-sm" maxlength="60">
                                <label for="cpPropEdt">CP : </label>
                                <input id="cpPropEdt" type="text" name="cpPropEdt" class="form-control form-control-sm" maxlength="5">
                                <label for="estadoPropEdt">Estado : </label>
                                <select id="estadoPropEdt" class="form-control form-control-sm">
                                    <option value="0"> - Seleccionar - </option>
                                    <?php
                                        if(!is_null($estados)) :
                                            foreach ($estados as $est) { ?>
                                                <option value="<?php echo $est->Id_Estado?>"><?php echo $est->Nombre_Estado?></option>
                                    <?php 
                                            }
                                        endif;
                                    ?>
                                </select>
                                <label for="celPropEdt">Celular : </label>
                                <input id="celPropEdt" type="text" name="celPropEdt" class="form-control form-control-sm" maxlength="20">
                                <label for="telPropEdt">Telefono : </label>
                                <input id="telPropEdt" type="text" name="telPropEdt" class="form-control form-control-sm" maxlength="20">
                                <label for="emailPropEdt">Correo : </label>
                                <input id="emailPropEdt" type="email" name="emailPropEdt" class="form-control form-control-sm" maxlength="60">
                                <label for="tipoPerPropEdt">Tipo persona : </label>
                                <select id="tipoPerPropEdt" class="form-control form-control-sm">
                                    <option value="0"> - Seleccionar - </option>
                                    <option value="1">Fisica</option>
                                    <option value="2">Moral</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveEditProp" type="button" class="btn btn-primary">Guardar Cambios</button>
                <button id="cancelEditProp" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
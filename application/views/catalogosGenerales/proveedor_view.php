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
                        <li class="breadcrumb-item active" aria-current="page">Proveedores</li>
                    </ol>
                </nav>
                <div class="card shadow">
                    <div class="card-body">
                        <!-- Inicia formulario de Proveedores -->
                        <div class="row justify-content-md-center">
                            <div class="col-md-8 col-sm-12">
                                <h5 class="card-title text-center"><i class="fa fa-user-plus"></i> Alta de proveedores</h5>
                                <form id="form_alta_proveedor" action="#">
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-5">
                                            <label for="idProv">id proveedor : </label>
                                            <input id="idProv" type="text" name="idProv" class="form-control form-control-sm"  maxlength="11" value="<?php echo $idProveedor;?>" disabled>
                                            <label for="appaternoProv">Apellido paterno : </label>
                                            <input id="appaternoProv" type="text" name="appaternoProv" class="form-control form-control-sm" maxlength="60">
                                            <label for="apmaternoProv">Apellido materno : </label>
                                            <input id="apmaternoProv" type="text" name="apmaternoProv" class="form-control form-control-sm" maxlength="60">
                                            <label for="nombresProv">Nombre (s) : </label>
                                            <input id="nombresProv" type="text" name="nombresProv" class="form-control form-control-sm" maxlength="60">
                                            <label for="razSoProv">Razon social : </label>
                                            <input id="razSoProv" type="text" name="razSoProv" class="form-control form-control-sm" maxlength="200">
                                            <label for="rfcProv">RFC : </label>
                                            <input id="rfcProv" type="text" name="rfcProv" class="form-control form-control-sm" maxlength="13">
                                            <label for="calleProv">Calle</label>
                                            <input id="calleProv" type="text" name="calleProv" class="form-control form-control-sm" maxlength="60">
                                        </div>

                                        <div class="col-md-5">
                                            <label for="colProv">Colonia : </label>
                                            <input id="colProv" type="text" name="colProv" class="form-control form-control-sm" maxlength="60">
                                            <label for="cpProv">CP : </label>
                                            <input id="cpProv" type="text" name="cpProv" class="form-control form-control-sm" maxlength="5">
                                            <label for="estadoProv">Estado : </label>
                                            <select id="estadoProv" class="form-control form-control-sm">
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
                                            <label for="celProv">Celular : </label>
                                            <input id="celProv" type="text" name="celProv" class="form-control form-control-sm" maxlength="20">
                                            <label for="telProv">Telefono : </label>
                                            <input id="telProv" type="text" name="telProv" class="form-control form-control-sm" maxlength="20">
                                            <label for="emailProv">Correo : </label>
                                            <input id="emailProv" type="email" name="emailProv" class="form-control form-control-sm" maxlength="60">
                                            <label for="tipoPerProv">Tipo persona : </label>
                                            <select id="tipoPerProv" class="form-control form-control-sm">
                                                <option value="0"> - Seleccionar - </option>
                                                <option value="1">Fisica</option>
                                                <option value="2">Moral</option>
                                            </select>
                                            <label for="diasEntProv">Dias de entrega : </label>
                                            <input id="diasEntProv" type="number" name="diasEntProv" class="form-control form-control-sm" min="1" maxlength="11">
                                        </div>
                                    </div>

                                    <div class="row justify-content-end">
                                        <div class="col-md-6">
                                            <button id="btnResetProv" type="reset" class="btn btn-danger"><i class="fa fa-trash-o"></i>Limpia Formulario</button>
                                            <button id="btnSaveProv" type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Guardar</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- Termina formulario de Proveedores-->
                        <!-- Inicia Tabla de Propietarios-->
                        <div class="row justify-content-md-center">
                            <div class="col-md-8 col-sm-12">
                                <div class="table-responsive">
                                    <table id="table_proveedor" class="table table-bordered tabla-paginada text-center">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>NOMBRE COMPLETO</th>
                                                <th>RAZON SOCIAL</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if(!is_null($proveedores)) :
                                                foreach ($proveedores as $prov) { ?>
                                                    <tr id="tr-<?php echo  $prov->Id_Proveedor?>">
                                                        <td><?php echo $prov->Id_Proveedor?></td>
                                                        <td><?php echo $prov->NombreCompleto?></td>
                                                        <td><?php echo $prov->RazonSocial?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger delete-prov" data-id="<?php echo $prov->Id_Proveedor?>" data-toggle="tooltip" data-placement="top" title="Eliminar Proveedor">
                                                                <i class="fa fa-trash-o"></i> 
                                                            </button>
                                                            <button type="button" class="btn btn-warning edit-prov" data-id="<?php echo $prov->Id_Proveedor?>" data-toggle="tooltip" data-placement="top" title="Editar Proveedor"> 
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


<div id="modalProveedorEdit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar informacion del proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Inicia Formulario alta de clientes-->
                    <form id="form_edita_cliente" action="#">
                        <div class="row justify-content-md-center">
                            <div class="col-md-5">
                                <label for="idProvEdt">Id Cliente : </label>
                                <input id="idProvEdt" type="text" name="idProvEdt" class="form-control form-control-sm" maxlength="11" disabled>
                                <label for="appaternoProvEdt">Apellido paterno : </label>
                                <input id="appaternoProvEdt" type="text" name="appaternoProvEdt" class="form-control form-control-sm" maxlength="60">
                                <label for="apmaternoProvEdt">Apellido materno : </label>
                                <input id="apmaternoProvEdt" type="text" name="apmaternoProvEdt" class="form-control form-control-sm" maxlength="60">
                                <label for="nombresProvEdt">Nombre (s) : </label>
                                <input id="nombresProvEdt" type="text" name="nombresProvEdt" class="form-control form-control-sm" maxlength="60">
                                <label for="razSoProvEdt">Razon social : </label>
                                <input id="razSoProvEdt" type="text" name="razSoProvEdt" class="form-control form-control-sm" maxlength="200">
                                <label for="rfcProvEdt">RFC : </label>
                                <input id="rfcProvEdt" type="text" name="rfcProvEdt" class="form-control form-control-sm" maxlength="13">
                                <label for="calleProvEdt">Calle</label>
                                <input id="calleProvEdt" type="text" name="calleProvEdt" class="form-control form-control-sm" maxlength="60">
                            </div>

                            <div class="col-md-5">
                                <label for="colProvEdt">Colonia : </label>
                                <input id="colProvEdt" type="text" name="colProvEdt" class="form-control form-control-sm" maxlength="60">
                                <label for="cpProvEdt">CP : </label>
                                <input id="cpProvEdt" type="text" name="cpProvEdt" class="form-control form-control-sm" maxlength="5">
                                <label for="estadoProvEdt">Estado : </label>
                                <select id="estadoProvEdt" class="form-control form-control-sm">
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
                                <label for="celProvEdt">Celular : </label>
                                <input id="celProvEdt" type="text" name="celProvEdt" class="form-control form-control-sm" maxlength="20">
                                <label for="telProvEdt">Telefono : </label>
                                <input id="telProvEdt" type="text" name="telProvEdt" class="form-control form-control-sm" maxlength="20">
                                <label for="emailProvEdt">Correo : </label>
                                <input id="emailProvEdt" type="email" name="emailProvEdt" class="form-control form-control-sm" maxlength="60">
                                <label for="tipoPerProvEdt">Tipo persona : </label>
                                <select id="tipoPerProvEdt" class="form-control form-control-sm">
                                    <option value="0"> - Seleccionar - </option>
                                    <option value="1">Fisica</option>
                                    <option value="2">Moral</option>
                                </select>
                                <label for="diasEntProvEdt">Dias de entrega : </label>
                                <input id="diasEntProvEdt" type="number" name="diasEntProvEdt" class="form-control form-control-sm" maxlength="11">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveEditProv" type="button" class="btn btn-primary">Guardar Cambios</button>
                <button id="cancelEditProv" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
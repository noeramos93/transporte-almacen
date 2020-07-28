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
                        <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                    </ol>
                </nav>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-md-8 col-sm-12">
                                <h5 class="card-title text-center"><i class="fa fa-user-plus"></i> Alta Clientes</h5>
                                <!-- Inicia Formulario alta de clientes-->
                                <form id="form_alta_cliente" action="#">
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-5">
                                            <label for="idCli">Id Cliente : </label>
                                            <input id="idCli" type="text" name="idCli" class="form-control form-control-sm" maxlength="11" value="<?php echo $idCliente;?>" disabled>
                                            <label for="appaternoCli">Apellido paterno : </label>
                                            <input id="appaternoCli" type="text" name="appaternoCli" class="form-control form-control-sm" maxlength="60">
                                            <label for="apmaternoCli">Apellido materno : </label>
                                            <input id="apmaternoCli" type="text" name="apmaternoCli" class="form-control form-control-sm" maxlength="60">
                                            <label for="nombresCli">Nombre (s) : </label>
                                            <input id="nombresCli" type="text" name="nombresCli" class="form-control form-control-sm" maxlength="60">
                                            <label for="razSoCli">Razon social : </label>
                                            <input id="razSoCli" type="text" name="razSoCli" class="form-control form-control-sm" maxlength="200">
                                            <label for="rfcCli">RFC : </label>
                                            <input id="rfcCli" type="text" name="rfcCli" class="form-control form-control-sm" maxlength="13">
                                            <label for="calleCli">Calle</label>
                                            <input id="calleCli" type="text" name="calleCli" class="form-control form-control-sm" maxlength="60">
                                        </div>

                                        <div class="col-md-5">                                    
                                            <label for="colCli">Colonia : </label>
                                            <input id="colCli" type="text" name="colCli" class="form-control form-control-sm" maxlength="60">
                                            <label for="cpCli">CP : </label>
                                            <input id="cpCli" type="text" name="cpCli" class="form-control form-control-sm" maxlength="5">
                                            <label for="estadoCli">Estado : </label>
                                            <select id="estadoCli" class="form-control form-control-sm">
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
                                            <label for="celCli">Celular : </label>
                                            <input id="celCli" type="text" name="celCli" class="form-control form-control-sm" maxlength="20">
                                            <label for="telCli">Telefono : </label>
                                            <input id="telCli" type="text" name="telCli" class="form-control form-control-sm" maxlength="20">
                                            <label for="emailCli">Correo : </label>
                                            <input id="emailCli" type="email" name="emailCli" class="form-control form-control-sm" maxlength="60">
                                            <label for="tipoPerCli">Tipo persona : </label>
                                            <select id="tipoPerCli" class="form-control form-control-sm">
                                                <option value="0"> - Seleccionar - </option>
                                                <option value="1">Fisica</option>
                                                <option value="2">Moral</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-md-6">
                                            <button id="btnReset" type="reset" class="btn btn-danger"><i class="fa fa-trash-o"></i>Limpia Formulario</button>
                                            <button id="btnSave" type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                        <!-- Termina Formulario alta de clientes-->
                        <!-- Inicia Tabla de clientes-->
                        <div class="row justify-content-md-center">
                            <div class="col-md-8 col-sm-12">
                                <div class="table-responsive">
                                    <table id="table_clientes" class="table table-bordered tabla-paginada text-center">
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

                                            if(!is_null($clientes)) :
                                                foreach ($clientes as $cli) { ?>
                                                    <tr id="tr-<?php echo  $cli->Id_Cliente?>">
                                                        <td><?php echo $cli->Id_Cliente?></td>
                                                        <td><?php echo $cli->NombreCompleto?></td>
                                                        <td><?php echo $cli->RazonSocial?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger delete-cli" data-id="<?php echo $cli->Id_Cliente?>" data-toggle="tooltip" data-placement="top" title="Eliminar Cliente">
                                                                <i class="fa fa-trash-o"></i> 
                                                            </button>
                                                            <button type="button" class="btn btn-warning edit-cli" data-id="<?php echo $cli->Id_Cliente?>" data-toggle="tooltip" data-placement="top" title="Editar Cliente"> 
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
                        <!-- Termina Tabla de clientes-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div id="modalClienteEdit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar informacion del cliente</h5>
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
                                <label for="idCliEdt">Id Cliente : </label>
                                <input id="idCliEdt" type="text" name="idCliEdt" class="form-control form-control-sm" maxlength="11" disabled>
                                <label for="appaternoCliEdt">Apellido paterno : </label>
                                <input id="appaternoCliEdt" type="text" name="appaternoCliEdt" class="form-control form-control-sm" maxlength="60">
                                <label for="apmaternoCliEdt">Apellido materno : </label>
                                <input id="apmaternoCliEdt" type="text" name="apmaternoCliEdt" class="form-control form-control-sm" maxlength="60">
                                <label for="nombresCliEdt">Nombre (s) : </label>
                                <input id="nombresCliEdt" type="text" name="nombresCliEdt" class="form-control form-control-sm" maxlength="60">
                                <label for="razSoCliEdt">Razon social : </label>
                                <input id="razSoCliEdt" type="text" name="razSoCliEdt" class="form-control form-control-sm" maxlength="200">
                                <label for="rfcCliEdt">RFC : </label>
                                <input id="rfcCliEdt" type="text" name="rfcCliEdt" class="form-control form-control-sm" maxlength="13">
                                <label for="calleCliEdt">Calle</label>
                                <input id="calleCliEdt" type="text" name="calleCliEdt" class="form-control form-control-sm" maxlength="60">
                            </div>

                            <div class="col-md-5">
                                <label for="colCliEdt">Colonia : </label>
                                <input id="colCliEdt" type="text" name="colCliEdt" class="form-control form-control-sm" maxlength="60">
                                <label for="cpCliEdt">CP : </label>
                                <input id="cpCliEdt" type="text" name="cpCliEdt" class="form-control form-control-sm" maxlength="5">
                                <label for="estadoCliEdt">Estado : </label>
                                <select id="estadoCliEdt" class="form-control form-control-sm">
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
                                <label for="celCliEdt">Celular : </label>
                                <input id="celCliEdt" type="text" name="celCliEdt" class="form-control form-control-sm" maxlength="20">
                                <label for="telCliEdt">Telefono : </label>
                                <input id="telCliEdt" type="text" name="telCliEdt" class="form-control form-control-sm" maxlength="20">
                                <label for="emailCliEdt">Correo : </label>
                                <input id="emailCliEdt" type="email" name="emailCliEdt" class="form-control form-control-sm" maxlength="60">
                                <label for="tipoPerCliEdt">Tipo persona : </label>
                                <select id="tipoPerCliEdt" class="form-control form-control-sm">
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
                <button id="saveEditCli" type="button" class="btn btn-primary">Guardar Cambios</button>
                <button id="cancelEditCli" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
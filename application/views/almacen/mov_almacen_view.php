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
                        <li class="breadcrumb-item active" aria-current="page">Movimientos de almacen</li>
                    </ol>
                </nav>
                <div class="card shadow">
                    <div class="card-body">
                        <h5>Ajustes</h5>
                        <!-- Botones de arriba-->
                        <div class="row justify-content-md-center">
                            <div class="col-md-8 col-sm-12">
                                <button id="btnNewMov" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Nueva</button>
                                <button id="btnEditMov" class="btn btn-primary"><i class="fa fa-edit"></i>Editar</button>
                                <button id="btnLimpMov" class="btn btn-primary"><i class="fa fa-window-close"></i>Limpiar</button>
                                <button id="btnAutMov" class="btn btn-primary"><i class="fa fa-check-square-o"></i>Autorizar</button>
                                <button id="btnSaveMov" class="btn btn-primary"><i class="fa fa-save"></i>Guardar</button>
                                <button id="btnBajaMov" class="btn btn-danger hide-element"><i class="fa fa-window-close"></i>Cancelar</button>
                            </div>
                        </div>
                        <br>
                        <!-- Formulario-->
                        <div class="row justify-content-md-center">
                            <form action="#">
                                <div class="form-group row">

                                    <label for="idMov" class="col-md-1 col-sm-3 col-form-label col-form-label-sm hide-element">ID</label>
                                    <div class="col-md-1 col-sm-3">
                                        <input id="idMov" type="text" name="idMov" class="form-control form-control-sm hide-element" disabled>
                                    </div>

                                    <label for="folioMov" class="col-md-1 col-sm-3 col-form-label col-form-label-sm">Folio</label>
                                    <div class="col-md-2 col-sm-3">
                                        <input id="folioMov" type="text" name="folioMov" class="form-control form-control-sm">
                                    </div>

                                    <label for="serieMov" class="col-md-1 col-sm-3 col-form-label col-form-label-sm">Serie</label>
                                    <div class="col-md-2 col-sm-3">
                                        <input id="serieMov" type="text" name="serieMov" class="form-control form-control-sm">
                                    </div>

                                    <label class="col-md-1 col-sm-3 col-form-label col-form-label-sm">Fecha</label>
                                    <div class="col-md-3 col-sm-3">
                                        <input id="fechaMov" type="date" name="fechaMov" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-sm-3 col-form-label col-form-label-sm">Concepto</label>
                                    <div class="col-md-3 col-sm-3">
                                        <select id="slcConcepMov" class="form-control form-control-sm">
                                            <option value="0"> - Seleccionar - </option>
                                            <?php
                                                if(!is_null($movimientos)) :
                                                    foreach ($movimientos as $mov) {?>
                                                        <option value="<?php echo $mov->Id_TipoMov?>"><?php echo $mov->Nombre?></option>
                                            <?php
                                                    }
                                                endif;
                                            ?>
                                        </select>        
                                    </div>
                                    <label class="col-md-2 col-sm-3 col-form-label col-form-label-sm">Almacen</label>
                                    <div class="col-md-3 col-sm-3">
                                        <select id="slcAlmMov" class="form-control form-control-sm">
                                            <option value="0"> - Seleccionar - </option>
                                            <?php
                                                if(!is_null($almacenes)) :
                                                    foreach ($almacenes as $alm) {?>
                                                        <option value="<?php echo $alm->Id_Almacen?>"><?php echo $alm->Nombre?></option>
                                            <?php
                                                    }
                                                endif;
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label>Observaciones : </label>
                                    <textarea id="obsMov" rows="3" class="form-control txtArea"></textarea>
                                </div>
                            </form>

                            <br>
                            
                            <div class="row col-md-5 justify-content-md-center" >
                                <div class="col-md-2">
                                    <h6>Tipo :</h6>
                                </div>
                                <div class="custom-control custom-radio ">
                                    <input class="custom-control-input " type="radio" name="tipo_mov" id="Entrada">
                                    <label class="custom-control-label mr-2" for="Entrada"> Entrada</label>
                                </div>

                                <div class="custom-control custom-radio ">
                                    <input class="custom-control-input" type="radio" name="tipo_mov" id="Salida">
                                    <label class="custom-control-label" for="Salida"> Salida</label>
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="divider m-0"></div>
                        <br>
                        <!-- Tabla de partidas-->
                        <div class="row">
                            <button id="newParteMov" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Agregar</button>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table id="tabla_parte" class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>PARTE</th>
                                            <th>DESCRIPCION</th>
                                            <th>CANTIDAD</th>
                                            <th>COSTO UNITARIO</th>
                                            <th>COSTO TOTAL</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <label class="col-md-2 col-sm-3 col-form-label col-form-label-sm">TOTAL</label>
                            <div class="col-md-2 col-sm-3">
                                <input id="total_final" type="text" name="total_final" class="form-control form-control-sm" value="0.00" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<div id="modalPartMov" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Partes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Inicia Formulario alta de clientes -->
                    <form id="form_orden_new" action="#">

                        <div class="form-group row">
                            <div class="col-md-5">
                                <label for="slcParte" >Partes</label>
                                <select id="slcParte" class="form-control">
                                    <option value="0"> - Partes - </option>
                                    <?php
                                        if(!is_null($partes)) :
                                            foreach ($partes as $par) {?>
                                                <option value="<?php echo $par->ID?>"><?php echo $par->PARTE?></option>
                                    <?php
                                            }
                                        endif;
                                    ?>
                                </select>
                            </div>


                            <div class="col-md-5">
                                <label for="cantidadOrden">Cantidad</label>
                                <input id="cantidadOrden" type="number" name="cantidadOrden" class="form-control form-control-sm" min="0">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <button id="addPartMov" type="button" class="btn btn-primary">Agregar</button>
                <button id="cancelPartMov" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
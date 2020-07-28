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
                        <li class="breadcrumb-item active" aria-current="page">Facturas de compra</li>
                    </ol>
                </nav>
                <div class="card shadow">
                    <div class="card-body">
                        <h5>Factura de compra</h5>
                        <!-- Botones de arriba-->
                        <div class="row justify-content-md-center">
                            <div class="col-md-7 col-sm-12">
                                
                                <button id="" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Nueva</button>
                                <button id="" class="btn btn-primary"><i class="fa fa-edit"></i>Editar</button>
                                <button id="" class="btn btn-primary"><i class="fa fa-window-close"></i>Cancelar</button>
                                <button id="" class="btn btn-primary"><i class="fa fa-check-square-o"></i>Autorizar</button>
                            </div>
                        </div>
                        <br>
                        <!-- Formulario-->
                        <div class="row justify-content-md-center">
                            <form id="form_orden_one" action="#">
                                <div class="form-group row">
                                    
                                    <label for="idFactura" class="col-md-2 col-sm-3 col-form-label col-form-label-sm" >ID Folio:</label>
                                    <div class="col-md-2 col-sm-3">
                                        <input id="idFactura" type="text" name="idFactura" class="form-control form-control-sm" value="<?php echo $idFactura?>" disabled>        
                                    </div>

                                    <label class="col-md-2 col-sm-2 col-form-label col-form-label-sm">Factura:</label>
                                    <div class="col-md-2 col-sm-3">
                                        <input type="text" name="" class="form-control form-control-sm">
                                    </div>
                                
                                    <label for="fchFactura" class="col-md-1 col-sm-3 col-form-label col-form-label-sm">Fecha:</label>
                                    <div class="col-md-3 col-sm-3">
                                        <input type="date" id="fchFactura" name="fchFactura" class="form-control form-control-sm">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="provOrden" class="col-md-2 col-sm-3 col-form-label col-form-label-sm" >Proveedor : </label>
                                    <div class="col-md-2 col-sm-3">
                                        <input id="provOrden" type="text" name="provOrden" class="form-control form-control-sm" placeholder="Razon social / Nombre Proveedor">
                                    </div>
                                    <div class="col-md-1 col-sm-2">
                                        <button id="searchOrdProv" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                    <div class="col-md-5 col-sm-4">
                                        <!-- <input id="rsProv" type="text" class="form-control form-control-sm" placeholder="Rozon social del proveedor" disabled>-->
                                        <select id="slcProv" class="form-control form-control-sm">
                                            <option value="0"> - Selecionar Proveedor - </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-sm-3 col-form-label col-form-label-sm" >Propietario</label>
                                    <div class="col-md-2 col-sm-3">
                                        <input id="propOrden" type="text" name="propOrden" class="form-control form-control-sm" placeholder="Razon social / Nombre Propietario">    
                                    </div>
                                    
                                    <div class="col-md-1 col-sm-2">
                                        <button id="searchOrdProp" class="btn btn-primary"><i class="fa fa-search"></i></button>    
                                    </div>

                                    <div class="col-md-5 col-sm-4">
                                        <!-- <input id="rsProp" type="text" class="form-control form-control-sm" placeholder="Rozon social del propietario" disabled>-->
                                        <select id="slcProp" class="form-control form-control-sm">
                                            <option value="0"> - Selecionar Propietario - </option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-2 col-sm-3 col-form-label col-form-label-sm">Almacen:</label>
                                    <div class="col-md-5 col-sm-4">
                                        <select class="form-control form-control-sm">
                                            <option value="0"> - Almacenes - Seleccionar </option>
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
                                    <label class="col-md-2 col-sm-3 col-form-label col-form-label-sm">Observaciones:</label>
                                    <div class="col-md-12 col-sm-3">
                                        <textarea rows="3" class="form-control txtArea"></textarea>    
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Divisor-->
                        <div class="divider m-0"></div>
                        <br>
                        <h5></h5>
                        <div class="row">
                            <div class="col-md-5">
                                <button id="addParOrdenComp" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Agregar</button>
                            </div>
                        </div>
                        <!-- Tabla de partidas-->
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID ORDEN</th>
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

                        <div class="row">
                            <div class="col-md-5">
                                <button class="btn btn-primary"><i class="fa fa-file-pdf-o"></i>Adjuntar PDF</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <button class="btn btn-primary"><i class="fa fa-file-excel-o"></i>Adjuntar XML</button>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="col-md-3">
                                    <label>SUBTOTAL</label>
                                    <input type="text" name="" class="form-control form-control-sm">
                            
                                    <label>IMPUESTOS</label>
                                    <input type="text" name="" class="form-control form-control-sm">

                                    <label>TOTAL</label>
                                    <input type="text" name="" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<div id="modalFacturaCompra" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                            <label for="folioOrdenCompra" class="col-md-2 col-sm-3 col-form-label col-form-label-sm" >Folio de orden de compra: </label>
                            <div class="col-md-2 col-sm-3">
                                <input id="folioOrdenCompra" type="text" name="idOrdenCompra" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-1 col-sm-1">
                                <button id="searchOrdCom" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="slcProducto" >Producto</label>
                                <select id="slcProducto" class="form-control">
                                    <option value="0"> - Productos - </option>
                                    <?php
                                        if(!is_null($productos)) :
                                            foreach ($productos as $prd) {?>
                                                <option value="<?php echo $prd->Id_Parte?>"><?php echo $prd->Descripcion?></option>
                                    <?php
                                            }
                                        endif;
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="cantOrden">Cant. Ordenada</label>
                                <input id="cantOrden" type="text" name="cantOrden" class="form-control form-control-sm" disabled>
                            </div>

                            <div class="col-md-3">
                                <label for="cantPen">Cant. Pendiente</label>
                                <input id="cantPen" type="text" name="cantPen" class="form-control form-control-sm" disabled>
                            </div>

                            <div class="col-md-3">
                                <label for="cantRecibida">Cant. Recibida</label>
                                <input id="cantRecibida" type="text" name="cantRecibida" class="form-control form-control-sm">
                            </div>

                            <div class="col-md-3">
                                <label for="costUnitario">Costo Unitario</label>
                                <input id="costUnitario" type="text" name="costUnitario" class="form-control form-control-sm">
                            </div>

                            <div class="col-md-3">
                                <label for="costTotal">Costo Total</label>
                                <input id="costTotal" type="text" name="costTotal" class="form-control form-control-sm">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <button id="saveEditProv" type="button" class="btn btn-primary">Guardar</button>
                <button id="cancelEditProv" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
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
                        <li class="breadcrumb-item active" aria-current="page">Orden de compra</li>
                    </ol>
                </nav>
                <div class="card shadow">
                    <div class="card-body">
                        <h5>Orden de compra</h5>
                        <!-- Botones de arriba-->
                        <div class="row justify-content-md-center">
                            <div class="col-md-8 col-sm-12">
                                <button id="btnOrdenNew" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Nueva</button>
                                <button id="btnOrdenEdit" class="btn btn-primary"><i class="fa fa-edit"></i>Editar</button>
                                <button id="btnOrdenCan" class="btn btn-primary"><i class="fa fa-window-close"></i>Limpiar</button>
                                <button id="btnOrdenAut" class="btn btn-primary"><i class="fa fa-check-square-o"></i>Autorizar</button>
                                <button id="btnSaveOrden" class="btn btn-primary"><i class="fa fa-save"></i>Guardar</button>
                                <button id="btnBajaOrden" class="btn btn-danger hide-element"><i class="fa fa-window-close"></i>Cancelar</button>
                            </div>
                        </div>
                        <br>
                        <!-- Formulario-->
                        <div class="row justify-content-md-center">
                            <form id="form_orden_one" action="#" >

                                <div class="form-group row">
                                    <label for="idOrden" class="col-md-1 col-sm-3 col-form-label col-form-label-sm">ID :</label>
                                    <div class="col-md-2 col-sm-3">
                                        <input id="idOrden" type="text" name="idOrden" class="form-control form-control-sm" value="<?php echo $idOrden?>" disabled>        
                                    </div>

                                    <label for="folOrden" class="col-md-1 col-sm-3 col-form-label col-form-label-sm">Folio :</label>
                                    <div class="col-md-2 col-sm-3">
                                        <input id="folOrden" type="text" name="folOrden" class="form-control form-control-sm">    
                                    </div>

                                    <label for="serieOrden" class="col-md-1 col-sm-3 col-form-label col-form-label-sm" >Serie :</label>
                                    <div class="col-md-1 col-sm-3">
                                        <input id="serieOrden" type="text" name="serieOrden" class="form-control form-control-sm">
                                    </div>

                                    <label for="fchOrden" class="col-md-1 col-sm-3 col-form-label col-form-label-sm">Fecha :</label>
                                    <div class="col-md-3 col-sm-3">
                                        <input id="fchOrden" type="date" name="fchOrden" class="form-control form-control-sm">
                                    </div>

                                </div>
                                
                                <div class="form-group row">
                                    <label for="provOrden" class="col-md-2 col-sm-3 col-form-label col-form-label-sm" >Proveedor : </label>
                                    <div class="col-md-2 col-sm-3">
                                        <input id="provOrden" type="text" name="provOrden" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-1 col-sm-2">
                                        <button id="searchOrdProv" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                    <div class="col-md-5 col-sm-4">
                                        <!-- <input id="rsProv" type="text" class="form-control form-control-sm" placeholder="Rozon social del proveedor" disabled>-->
                                        <select id="slcProv" class="form-control form-control-sm">
                                            <option value="0"> - Selecionar Propietario - </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    
                                    <label class="col-md-2 col-sm-3 col-form-label col-form-label-sm" >Propietario</label>
                                    <div class="col-md-2 col-sm-3">
                                        <input id="propOrden" type="text" name="propOrden" class="form-control form-control-sm">    
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

                                <label for="txtAreaOrden">Observaciones</label>
                                <textarea id="txtAreaOrden" rows="3" class="form-control txtArea"></textarea>
                            </form>
                        </div>

                        <!-- Divisor-->
                        <div class="divider m-0"></div>
                        <br>
                        <h5>Partidas</h5>
                        <!-- Tabla de partidas-->
                        <div class="row">
                            <button id="newParOrdenComp" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Agregar</button>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table id="table_partidas_orden" class="table table-bordered">
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

                        <div class="row ">
                            <div class="col-md-4">
                                <div class="custom-file">
                                    <form id="fileUploadForm" action="#" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                        <input id="pdfOrden" name="pdfUrl" type="file" class="custom-file-input" id="customFileLang" lang="es" accept="application/pdf" onchange="readURL(this);" /> <br><br>
                                        <label id="filenameLabel" class="custom-file-label" for="customFileLang"><i class="fa fa-file-pdf-o"></i> Adjuntar PDF</label>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="col-md-3">
                                    <label>SUBTOTAL</label>
                                    <input id="txtSub" type="number" name="txtSub" class="form-control form-control-sm" value="0.00" disabled>

                                    <label>IMPUESTOS</label>
                                    <input id="txtImp" type="number" name="txtImp" class="form-control form-control-sm" value="0.00" disabled>

                                    <label>TOTAL</label>
                                    <input id="txtTot" type="number" name="txtTot" class="form-control form-control-sm" value="0.00" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<div id="modalOrdenCompra" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                        <!--<div class="form-group row">
                            <div class="col-md-4">
                                
                                <label for="idOrdenCompra">Orden de compra</label>
                                <input id="idOrdenCompra" type="text" name="idOrdenCompra" class="form-control" value="<?php echo $idOrden?>" disabled>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="slcProducto" >Partes</label>
                                <select id="slcProducto" class="form-control">
                                    <option value="0"> - Partes - </option>
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


                            <div class="col-md-4">
                                <label for="cantidadOrden">Cantidad</label>
                                <input id="cantidadOrden" type="number" name="cantidadOrden" class="form-control form-control-sm">
                            </div>

                            <div class="col-md-4">
                                <label for="costUni">Costo unitario</label>
                                <input id="costUni" type="number" name="costUni" class="form-control form-control-sm">
                            </div>

                        </div>
                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <button id="addPartOrden" type="button" class="btn btn-primary">Agregar</button>
                <button id="cancelPartOrden" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
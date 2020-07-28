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
                        <li class="breadcrumb-item active" aria-current="page">Partes</li>
                    </ol>
                </nav>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-6">
                                <!-- Inicia cuerpo de la card -->
                                <h5 class="card-title text-center">Partes</h5>
                                <!-- Formulario Partes-->
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <button type="button" id="searchPart" class="btn btn-primary"><i class="fa fa-search"></i>Buscar Parte</button>
                                                <!-- <button type="button" id="saveRelation" class="btn btn-primary hide-element"><i class="fa fa-save"></i>Guardar Relacion</button> -->
                                            </div>
                                        </div>
                                        <br>
                                        <form id="form_parte" action="#">
                                            
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label for="idPart">Id Parte : </label>
                                                    <input id="idPart" type="text" name="idPart" class="form-control form-control-sm" value="<?php echo $idPart?>" disabled>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="fechaAlta">Fecha alta : </label>
                                                    <input id="fechaAlta" type="date" name="fechaAlta" class="form-control form-control-sm">
                                                </div>    
                                            </div>
                                            
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label for="codAlterno">Codigo Alterno : </label>
                                                    <input id="codAlterno" type="text" name="codAlterno" class="form-control form-control-sm">    
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="tipoInvt">Tipo Inventario : </label>
                                                    <select id="tipoInvt" class="form-control form-control-sm">
                                                        <option value="0"> - Selecionar - </option>
                                                        <?php 
                                                            if(!is_null($tiposInv)) :
                                                                foreach ($tiposInv as $inv) {?>
                                                                    <option value="<?php echo $inv->Id_Tipo?>"><?php echo $inv->Nombre?></option>
                                                        <?php            
                                                                }
                                                            endif;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    
                                                    <label for="dscTxt">Descripción : </label>
                                                    <input id="dscTxt" type="text" name="dscTxt" class="form-control form-control-sm">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="fichaTecnica">Ficha Tecnica : </label>
                                                    <textarea id="fichaTecnica" rows="5" class="form-control txtArea"></textarea>
                                                </div>
                                            </div>

                                        </form>
                                        <!-- Parametros de inventarios -->
                                        <nav>
                                          <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Parametros de inventarios</a>
                                          </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                              <form>
                                                  <div class="row">
                                                    <div class="form-group col-md-5 col-sm-6">  
                                                        <label for="minimo">Minimo</label>
                                                        <input id="minimo" type="number" name="minimo" class="form-control form-control-sm" min="1">
                                                        <label for="maximo">Maximo</label>
                                                        <input id="maximo" type="number" name="maximo" class="form-control form-control-sm" min="1">
                                                        <label for="reOrden">PTO Reorden</label>
                                                        <input id="reOrden" type="number" name="reOrden" class="form-control form-control-sm" min="1">
                                                    </div>
                                                    <div class="form-group col-md-5 col-sm-6">  
                                                        <label for="costRepo">Costo reposicion</label>
                                                        <input id="costRepo" type="number" name="costRepo" class="form-control form-control-sm" min="1">
                                                        <label for="ultCosto">Ultimo costo</label>
                                                        <input id="ultCosto" type="number" name="ultCosto" class="form-control form-control-sm" min="1">
                                                        <label for="ultCompra">Ultima compra</label>
                                                        <input id="ultCompra" type="date" name="ultCompra" class="form-control form-control-sm" min="1">
                                                    </div>
                                                  </div>
                                              </form>
                                              <button id="btnSavePart" class="btn btn-primary"><i class="fa fa-save"></i>Guardar Parte</button>
                                              <button id="btnDeletePart" class="btn btn-danger hide-element"><i class="fa fa-save"></i>Eliminar Parte</button>
                                          </div>
                                        </div>
                                    </div>
                                <!-- Nav Partes-->
                                
                                    <div class="col-md-6 col-sm-12">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="extencion-tab" data-toggle="tab" href="#extencion" role="tab" aria-controls="extencion" aria-selected="true">Existencias</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="ubicacion-tab" data-toggle="tab" href="#ubicacion" role="tab" aria-controls="ubicacion" aria-selected="false">Ubicaciones</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="proveedor-tab" data-toggle="tab" href="#proveedor" role="tab" aria-controls="proveedor" aria-selected="false">Proveedores</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="cardex-tab" data-toggle="tab" href="#cardex" role="tab" aria-controls="cardex" aria-selected="false">Cardex</a>
                                            </li>
                                        </ul>
                                        <!-- Contenedores para Existencias, Ubicaciones, Proveedores, Cardex-->
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="extencion" role="tabpanel" aria-labelledby="extencion-tab">
                                                <!-- <h5> Area para Existencias </h5> -->
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>ALMACEN</th>
                                                                <th>EXISTENCIAS</th>
                                                                <th>COSTO PROMEDIO</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="ubicacion" role="tabpanel" aria-labelledby="ubicacion-tab">
                                                <!-- <h5> Area para Ubicaciones</h5> -->
                                                <div class="table-responsive">
                                                    <table id="tb_ubicacion" class="table table-bordered">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Almacen</th>
                                                                <th>Nivel 1</th>
                                                                <th>Nivel 2</th>
                                                                <th>Nivel 3</th>
                                                                <th>Nivel 4</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <button id="addUbic" class="btn btn-primary" disabled><i class="fa fa-save"></i>Agregar</button>
                                                        <button id="deleteUbic" class="btn btn-danger" disabled><i class="fa fa-window-close"></i>Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="proveedor" role="tabpanel" aria-labelledby="proveedor-tab">
                                                <!-- <h5>Area para Proveedores</h5> -->
                                                <div class="table-responsive">
                                                    <table id="tb_proveedor" class="table table-bordered">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Proveedor</th>
                                                                <th>Codigo</th>
                                                                <th>Principal</th>
                                                                <th>Tpo Entrega</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <button id="addProv" class="btn btn-primary" disabled><i class="fa fa-save"></i>Agregar</button>
                                                        <button id="deleteProv" class="btn btn-danger" disabled><i class="fa fa-window-close"></i>Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="cardex" role="tabpanel" aria-labelledby="cardex-tab">
                                                <!-- <h5>Area para Cardex</h5>-->
                                                <div class="row">
                                                    <div class="col-md-5 col-sm-5">
                                                        <label>Almacen</label>
                                                        <select class="form-control">
                                                            <option> - Seleccionar - </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>ALMACEN</th>
                                                                <th>ALMACEN</th>
                                                                <th>FECHA</th>
                                                                <th>DESCRIPCION</th>
                                                                <th>EXT. ANT</th>
                                                                <th>ENTRADA</th>
                                                                <th>SALIDA</th>
                                                                <th>EXT. ACT</th>
                                                                <th>COSTO</th>
                                                                <th>COSTO PROM</th>
                                                                <th>USUARIO</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
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
                </div>
            </div>
        </div>
    </div>
</section>


<!-- *************************  MODAL PARA PROVEDORES*********************-->
<div id="modalAddProv" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Proveedores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Inicia Formulario alta de clientes-->
                    <!-- Input para mostrar el proveedor que se va a seleccionar-->
                    <select id="slcProv" class="form-control">
                        <option value="0"> - Seleccione a un proveedor - </option>
                    <?php
                        if(!is_null($proveedores)) :
                            foreach ($proveedores as $prov) { ?>
                                <option value="<?php echo $prov->Id_Proveedor?>"><?php echo $prov->RazonSocial?></option>
                    <?php 
                            }
                        endif;
                    ?>
                    </select>
                    <div class="col-md-6">
                        <div class="custom-control custom-checkbox my-1 mr-sm-2">
                            <input id="provPrin" type="checkbox" class="custom-control-input">
                            <label class="custom-control-label" for="provPrin"> ¿Es principal? </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveAddProv" type="button" class="btn btn-primary">Agregar</button>
                <button id="cancelEditProv" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- *************************  ./MODAL PARA PROVEDORES*********************-->


<!-- *************************  MODAL PARA UBICACIONES*********************-->
<div id="modalAddUbic" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Proveedores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Inicia Formulario alta de clientes-->
                    <!-- Input para mostrar el proveedor que se va a seleccionar-->
                    <select id="slcAlm" class="form-control">
                        <option value="0"> - Seleccione a un almacen - </option>
                    <?php
                        if(!is_null($almacenes)) :
                            foreach ($almacenes as $alm) { ?>
                                <option value="<?php echo $alm->Id_Almacen?>"><?php echo $alm->Nombre?></option>
                    <?php 
                            }
                        endif;
                    ?>
                    </select>

                    <select id="slcNv1" class="form-control">
                        <option value="0"> - Seleccione un Nivel 1 - </option>
                    <?php
                        if(!is_null($ubicaciones)) :
                            foreach ($ubicaciones as $ubc) { ?>
                                <option value="<?php echo $ubc->Id_Ubicacion?>"><?php echo $ubc->Nombre?></option>
                    <?php 
                            }
                        endif;
                    ?>
                    </select>

                    <select id="slcNv2" class="form-control">
                        <option value="0"> - Seleccione un Nivel 2 - </option>
                    </select>

                    <select id="slcNv3" class="form-control">
                        <option value="0"> - Seleccione un Nivel 3 - </option>
                    </select>

                    <select id="slcNv4" class="form-control">
                        <option value="0"> - Seleccione un Nivel 4 - </option>
                    </select>

                </div>
            </div>
            <div class="modal-footer">
                <button id="saveAddUbic" type="button" class="btn btn-primary">Agregar</button>
                <button id="cancelEditProv" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- *************************  ./MODAL PARA UBICACIONES*********************-->
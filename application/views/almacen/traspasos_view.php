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
                        <li class="breadcrumb-item active" aria-current="page">Traspasos</li>
                    </ol>
                </nav>
                <div class="card shadow">
                    <div class="card-body">
                        <h5>TRASPASOS</h5>
                        <!-- Botones de arriba-->
                        <div class="row justify-content-md-center">
                            <div class="col-md-5 col-sm-12">
                                <button class="btn btn-primary"><i class="fa fa-plus-circle"></i>Nueva</button>
                                <button class="btn btn-primary"><i class="fa fa-edit"></i>Editar</button>
                                <button class="btn btn-primary"><i class="fa fa-window-close"></i>Cancelar</button>
                                <button class="btn btn-primary"><i class="fa fa-check-square-o"></i>Autorizar</button>
                            </div>
                        </div>
                        <!-- Formulario-->
                        <div class="row">
                            <form action="#">

                                <div class="form-group row">
                                    <label class="col-md-1 col-sm-3 col-form-label col-form-label-sm">ID:</label>
                                    <div class="col-md-2 col-sm-3">
                                        <input type="text" name="" class="form-control form-control-sm">
                                    </div>

                                    <label class="col-md-1 col-sm-3 col-form-label col-form-label-sm">Folio:</label>
                                    <div class="col-md-2 col-sm-3">
                                        <input type="text" name="" class="form-control form-control-sm">
                                    </div>

                                    <label class="col-md-1 col-sm-3 col-form-label col-form-label-sm">Serie:</label>
                                    <div class="col-md-1 col-sm-2">
                                        <input type="text" name="" class="form-control form-control-sm">
                                    </div>

                                    <label class="col-md-2 col-sm-3 col-form-label col-form-label-sm">Fecha:</label>
                                    <div class="col-md-2 col-sm-3">
                                        <input type="date" name="" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    
                                    <label class="col-md-2 col-sm-3 col-form-label col-form-label-sm">Almacen Origen</label>
                                    <div class="col-md-2 col-sm-3">
                                        <select class="form-control form-control-sm">
                                            <option> - Seleccionar - </option>
                                        </select>
                                    </div>

                                    <label class="col-md-2 col-sm-3 col-form-label col-form-label-sm">Almacen Destino</label>
                                    <div class="col-md-2 col-sm-2">
                                        <select class="form-control form-control-sm">
                                            <option> - Seleccionar - </option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    
                                    <label class="col-md-2 col-sm-3 col-form-label col-form-label-sm">Observaciones</label>
                                    <div class="col-md-2 col-sm-3">
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- Divisor-->
                        <div class="divider m-0"></div>
                        <br>
                        <!-- Tabla de partidas-->
                        <div class="row">
                            <button class="btn btn-primary">Agregar</button>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>PARTE</th>
                                            <th>DESCRIPCION/th>
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

                            <label>TOTAL</label>
                            <input type="text" name="">
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
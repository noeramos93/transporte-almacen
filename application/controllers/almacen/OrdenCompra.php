<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador para el ABC de 
 * de ordenes de compra
 * @author Ing. Noe Ramo Lopez
 * @version 1.0 
 * @copyright Todos los derechos reservados 2019
 */
class OrdenCompra extends CI_Controller {

    /**
     * Constrcutor de la clase Ubicaciones.
     */
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('name') == FALSE) {
            $this->session->set_flashdata("error", "sesion invalida");
            redirect("Login");
        }
        $this->load->model('CatalogoAlmacen_model');
        $this->load->model('OrdenCompra_model');
        $this->load->helper(array('form', 'url'));
    }

    public function index() {
        //consultamos el catalogo de almacenes con la clave 'C'
        $datosAlm = array();
        $datosAlm['idOrden'] = $this->genIdNext('C');
        $datosAlm['productos'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('E');

        $fragment = array();
        $fragment['ccsLibs'] = NULL;
        $fragment['VISTA'] = $this->load->view('almacen/orden_compra_view', $datosAlm, TRUE);
        $fragment['jsLibs'] = ['js/ordenCompra.js'];

        $this->load->view('dashboard_view', $fragment);
    }

    public function genIdNext($catalogo) {
        $idTable = $this->CatalogoAlmacen_model->getIdTableAlm($catalogo);
        $idCat = $idTable->NUM_ID + 1;
        return $idCat;
    }

    /**
     * Metodo para obtener la razon social y el id, ya sea de un proveedor o
     * un propietario
     * @param tipo_search
     * @param name
     */
    public function searchPropProv() {
        $tipoBusqueda = $this->input->post('tipo_search');
        $nombre = $this->input->post('name');
        $jsonSearch = array();

        //buscamos proveedor
        if ($tipoBusqueda == 'A') {

            $jsonSearch['response_code'] = '200';
            $jsonSearch['response_msg'] = 'Operacion exitosa!';
            $jsonSearch['proveedores'] = $this->CatalogoAlmacen_model->buscarPropProvByName($nombre, $tipoBusqueda);

            //buscamos propietario
        } else if ($tipoBusqueda == 'B') {
            $jsonSearch['response_code'] = '200';
            $jsonSearch['response_msg'] = 'Operacion exitosa!';
            $jsonSearch['propietarios'] = $this->CatalogoAlmacen_model->buscarPropProvByName($nombre, $tipoBusqueda);

            // respuesta default
        } else {
            $jsonSearch['response_code'] = '201';
            $jsonSearch['response_msg'] = 'No existe el tipo de busqueda';
        }

        echo json_encode($jsonSearch);
    }

    public function saveOrdenCompra() {

        $id = $this->input->post('idOrden');
        $tipo = $this->input->post('tipoOper');
        $folio = $this->input->post('folioOrden');
        $serie = $this->input->post('serieOrden');
        $fecha = $this->input->post('fechaOrden');
        $proveedor = $this->input->post('proveedorOrden');
        $propietario = $this->input->post('propietarioOrden');
        $observacion = $this->input->post('observacionOrden');
        $partidas = $this->input->post('partidasOrden'); //--> es un array
        $subtotal = $this->input->post('subOrden');
        $impuesto = $this->input->post('impOrden');
        $filename = $this->input->post('filename');
        $total = $this->input->post('totOrden');
        $jsonOrden = array();
        $infoOrden = array();
        $infoDetalleOrden = array();

        //guardamos en la tabla de orden compra
        $infoOrden['Folio'] = $folio;
        $infoOrden['Serie'] = $serie;
        $infoOrden['Id_Proveedor'] = $proveedor;
        $infoOrden['Id_Propietario'] = $propietario;
        $infoOrden['Estado'] = 'PendAutorizar';
        $infoOrden['Id_UsuarioRegistro'] = $this->session->userdata('id');
        $infoOrden['Subtotal'] = $subtotal;
        $infoOrden['Impuestos'] = $impuesto;
        $infoOrden['Total'] = $total;
        $infoOrden['Observaciones'] = $observacion;
        $infoOrden['filePDF'] = $filename;

        //guardamos y obtenermos el id que se guardo con la orden de compra
        if ($tipo == 'A') {
            $ordenCompra = $this->CatalogoAlmacen_model->saveInfoOrden($infoOrden);
        } else if ($tipo == 'C') {
            $this->OrdenCompra_model->updateInfoOrden($infoOrden, $id);
            $this->OrdenCompra_model->deleteDetalleOrden($id);
            $ordenCompra = TRUE;
        }

        //validamos que si venga el id que se ingreso
        if (!is_null($ordenCompra)) {
            for ($i = 0; $i < count($partidas); $i++) {

                if ($tipo == 'A') {
                    $infoDetalleOrden['Id_Orden'] = $ordenCompra;
                } else if ($tipo == 'C') {
                    $infoDetalleOrden['Id_Orden'] = $id;
                }
                $infoDetalleOrden['Id_Parte'] = $partidas[$i]["id"];
                $infoDetalleOrden['Cantidad'] = $partidas[$i]["cantidad"];
                $infoDetalleOrden['Costo'] = $partidas[$i]["costo"];
                $infoDetalleOrden['Costo_Total'] = $partidas[$i]["total"];
                $infoDetalleOrden['Cantidad_Surtida'] = 0; // -> se llenan hasta una factura de compra
                $infoDetalleOrden['Cantidad_Pendiente'] = 0; // -> se llenan hasta una factura de compra

                $this->CatalogoAlmacen_model->saveDetalleOrden($infoDetalleOrden);
            }

            $jsonOrden['response_code'] = '200';
            $jsonOrden['response_msg'] = 'Operacion exitosa!';
        }

        echo json_encode($jsonOrden);
    }

    public function getInfoOrdenCompra() {

        $folio = $this->input->post('folioOrden');
        $serie = $this->input->post('serieOrden');
        $jsonInfo = array();

        if ($folio == NULL || $folio == "") {
            $jsonInfo['response_code'] = "201";
            $jsonInfo['response_msg'] = "el folio no puede ir vacio";
        } else if ($serie == NULL || $serie == "") {
            $jsonInfo['response_code'] = "201";
            $jsonInfo['response_msg'] = "la seria no puede ir vacio";
        } else {

            $ordenComp = $this->OrdenCompra_model->getInfoOrdenByFolio($folio, $serie);

            if (!is_null($ordenComp)) {

                $ordenId = $ordenComp->Id_Orden;
                $jsonInfo['infoOrden'] = $ordenComp;
                $detalle = $this->OrdenCompra_model->getInfoDetalleOrdenById($ordenId);

                if (!is_null($detalle)) {
                    $jsonInfo['response_code'] = "200";
                    $jsonInfo['response_msg'] = "operaicon exitosa!";
                    $jsonInfo['infoDetalleOrden'] = $detalle;
                } else {
                    $jsonInfo['response_code'] = "202";
                    $jsonInfo['response_msg'] = "la orden no tiene detalle!";
                }
            } else {
                $jsonInfo['response_code'] = "201";
                $jsonInfo['response_msg'] = "No se encontro la Orden.";
            }
        }

        echo json_encode($jsonInfo);
    }

    public function uploadPDF() {

        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            "remove_spaces" => TRUE
        );
        $this->load->library('upload', $config);

        $jsonOrden = array();
        if ($this->upload->do_upload('pdfUrl')) {
            $data = $this->upload->data();
            $filename = $data['file_name'];

            $jsonOrden['response_code'] = '200';
            $jsonOrden['response_msg'] = 'Operacion exitosa!';
            $jsonOrden['filename'] = base_url() . "uploads/" . $filename;
        } else {
            $error = array('error' => $this->upload->display_errors());
            //$this->load->view('custom_view', $error);

            $jsonOrden['response_code'] = '500';
            $jsonOrden['response_msg'] = 'Fallo subida de PDF';
            $jsonOrden['errors'] = $error;
        }

        echo json_encode($jsonOrden);
    }

    /**
    * Metodo para autorizar la orden de compra
    * recibe el id de la orden y obtiene le id
    * del que autoriza de la sesion
    */
    public function ordenAut(){
        $orden = $this->input->post('id_orden');
        $jsonAut = array();

        if($orden == NULL || $orden == ""){
            $jsonAut['response_code'] = '201';
            $jsonAut['response_msg'] = 'la orden esta vacia';
        }else{
            
            $idUtor = $this->session->userdata('id');

            if($this->OrdenCompra_model->autorizar($orden,$idUtor)){
                $jsonAut['response_code'] = '200';
                $jsonAut['response_msg'] = 'la orden esta vacia';
            }else{
                $jsonAut['response_code'] = '201';
                $jsonAut['response_msg'] = 'ocurrio un error al intentar autorizar';
            }
        }
        echo json_encode($jsonAut);
    }

    public function cancelarOrden(){
        $orden = $this->input->post('id_orden');
        $jsonCancel = array();

        if($orden == NULL || $orden == ""){
            $jsonCancel['response_code'] = '201';
            $jsonCancel['response_msg'] = 'la orden esta vacia';
        }else{

            if($this->OrdenCompra_model->cancelOrden($orden)){
                $jsonCancel['response_code'] = '200';
                $jsonCancel['response_msg'] = 'La orden se cancelo';
                $jsonCancel['idOrden'] = $this->genIdNext('C');
            }else{
                $jsonCancel['response_code'] = '201';
                $jsonCancel['response_msg'] = 'ocurrio un error al intentar Cancela la orden';
            }
        }
        echo json_encode($jsonCancel);
    }
}

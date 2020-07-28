<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Controlador para el ABC de 
* las facturas de compra
* @author Ing. Noe Ramo Lopez
* @version 1.0 
* @copyright Todos los derechos reservados 2019
*/
class FacturaCompra extends CI_Controller {

	/**
	* Constrcutor de la clase Ubicaciones.
	*/
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('name') == FALSE){
            $this->session->set_flashdata("error","sesion invalida");
            redirect("Login");
        }
        
            $this->load->model('CatalogoAlmacen_model');
	}

	public function index(){
		//consultamos el catalogo de almacenes con la clave 'C'
		$datosAlm = array();		
        $datosAlm['idFactura'] = $this->genIdNext('F');
        $datosAlm['almacenes'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('C');
                
		$fragment = array();
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('almacen/factura_compra_view',$datosAlm,TRUE);
		$fragment['jsLibs'] = ['js/facturaCompra.js'];
		
		$this->load->view('dashboard_view',$fragment);
	}
        
    public function genIdNext($catalogo){
		$idTable = $this->CatalogoAlmacen_model->getIdTableAlm($catalogo);
		$idCat = $idTable->NUM_ID + 1;
		return $idCat;
	}
}
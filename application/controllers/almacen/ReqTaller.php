<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Controlador para el ABC de 
* las requisiciones del taller
* @author Ing. Noe Ramo Lopez
* @version 1.0 
* @copyright Todos los derechos reservados 2019
*/
class ReqTaller extends CI_Controller {

	/**
	* Constrcutor de la clase Ubicaciones.
	*/
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('name') == FALSE){
            $this->session->set_flashdata("error","sesion invalida");
            redirect("Login");
        }
	}

	public function index(){
		//consultamos el catalogo de almacenes con la clave 'C'
		$datosAlm = array();
		//$datosAlm['almacenes'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('C');
		
		$fragment = array();
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('almacen/req_taller_view',$datosAlm,TRUE);
		$fragment['jsLibs'] = NULL;
		
		$this->load->view('dashboard_view',$fragment);
	}
}
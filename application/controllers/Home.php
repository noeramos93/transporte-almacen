<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para la pagina de inicio
* @author Ing.Noe Ramos
* @version 1.0
* @copyright Todos los derechos reservados 2019
*/
class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('name') == FALSE){
            $this->session->set_flashdata("error","sesion invalida");
            redirect("Login");
        }
	}
	/**
	* Metodo para cargar la vista Principal 
	* del sistema.
	*/
	public function index(){
		$fragment = array();
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('home_view','',TRUE);
		$fragment['jsLibs'] = NULL;
		$this->load->view('dashboard_view',$fragment);
	}
}

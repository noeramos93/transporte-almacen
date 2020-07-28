<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el ABC de 
* los Roles
* @author Ing. Noe Ramo Lopez
* @version 1.0 
* @copyright Todos los derechos reservados 2019
*/
class Roles extends CI_Controller {

	/**
	* Constructor para la clase de Roles
	* carga el modelo de configuracion.
	*/
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('name') == FALSE){
            $this->session->set_flashdata("error","sesion invalida");
            redirect("Login");
        }
		$this->load->model('Configuracion_model');
	}

	/**
	* Metodo para cargar la vista inicial
	* de la tabla de Roles.
	*/
	public function index(){
		
		$datosRol = array();
		$fragment = array();

		$datosRol['roles'] = $this->Configuracion_model->getCatConfig(0,'A',0);
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('configuracion/role_view',$datosRol,TRUE);
		$fragment['jsLibs'] = ['js/roles.js'];

		$this->load->view('dashboard_view',$fragment);
	}

	/**
	* Metodo para obtener el nombre del Rol
	* a editar, recibe el id del rol.
	* @param idRol
	*/
	public function getEditRol(){

		$rolId = $this->input->post('idRol');
		$jsonRolEdit = array();

		if($rolId == NULL){
			$jsonRolEdit['response_code'] = '201';
			$jsonRolEdit['response_msg'] = 'Campo vacio';
		}else{
			$jsonRolEdit['rol'] = $this->Configuracion_model->getCatConfig($rolId,'A',1);
			$jsonRolEdit['response_code'] = '200';
			$jsonRolEdit['response_msg'] = 'Campo vacio';
		}
		echo json_encode($jsonRolEdit);
	}

	/**
	* Metodo para hacer la actualizacion de 
	* estatus de los roles, tambien se puede 
	* utilizar para dar una baja logica
	* @param $tipo
	* @param $id del rol
	* @param nombre del rol
	*/
	public function updateRol(){

		$tipoUpdate = $this->input->post('tipo');
		$idRol = $this->input->post('idRol');
		$nameRol = $this->input->post('nameRol');
		$jsonUpdateRol = array();
		$jsonRol = array();

		$jsonRol['Nombre'] = $nameRol;
		
		//dicernimos si es para un cambio o para un delete
		if($tipoUpdate == 'C'){
			
			$jsonRol['Estatus'] = NULL;
			
			if($this->Configuracion_model->updateCatConfig($jsonRol,$idRol,'A')){
				$jsonUpdateRol['response_code'] = '200';
				$jsonUpdateRol['response_msg'] = 'Actualizacion exitosa!';
				$jsonUpdateRol['newRoles'] = $this->Configuracion_model->getCatConfig(0,'A',0);
			}else{
				$jsonUpdateRol['response_code'] = '201';
				$jsonUpdateRol['response_msg'] = 'Ocurrio un error!';
			}

		}else if($tipoUpdate == 'D'){

			$jsonRol['Estatus'] = '0';

			if($this->Configuracion_model->updateCatConfig($jsonRol,$idRol,'A')){
				$jsonUpdateRol['response_code'] = '200';
				$jsonUpdateRol['response_msg'] = 'Borrado exitosa!';
			}else{
				$jsonUpdateRol['response_code'] = '201';
				$jsonUpdateRol['response_msg'] = 'Ocurrio un error!';
			}
		}
		echo json_encode($jsonUpdateRol);
	}
}

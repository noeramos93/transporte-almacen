<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el ABC de 
* de los permisos
* @author Ing. Noe Ramo Lopez
* @version 1.0 
* @copyright Todos los derechos reservados 2019
*/
class Permisos extends CI_Controller {
	
	/**
	* Constructor para la clase de permisos
	* carga el modelo de cofniguracion
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
	* de la tabla de permisos.
	*/
	public function index(){
		
		$datosPer = array();
		$fragment = array();
		
		$datosPer['permisos'] = $this->Configuracion_model->getCatConfig(0,'B',0);
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('configuracion/permiso_view',$datosPer,TRUE);
		$fragment['jsLibs'] = ['js/permisos.js'];

		$this->load->view('dashboard_view',$fragment);
	}

	/**
	* Metodo para obtener el nombre del Permiso
	* a editar, recibe el id del perfil.
	* @param idPer
	*/
	public function getEditPer(){

		$perId = $this->input->post('idPer');
		$jsonPerEdit = array();

		if($perId == NULL){
			$jsonPerEdit['response_code'] = '201';
			$jsonPerEdit['response_msg'] = 'Campo vacio';
		}else{
			$jsonPerEdit['per'] = $this->Configuracion_model->getCatConfig($perId,'B',1);
			$jsonPerEdit['response_code'] = '200';
			$jsonPerEdit['response_msg'] = 'Campo vacio';
		}
		echo json_encode($jsonPerEdit);
	}

	/**
	* Metodo para hacer la actualizacion de 
	* estatus de los Permisos, tambien se puede 
	* utilizar para dar una baja logica
	* @param $tipo
	* @param $id del permiso
	* @param nombre del permiso
	*/
	public function updatePer(){

		$tipoUpdate = $this->input->post('tipo');
		$idPer = $this->input->post('idPer');
		$namePer = $this->input->post('namePer');
		$jsonUpdatePer = array();
		$jsonPer = array();

		$jsonPer['Nombre'] = $namePer;
		
		//dicernimos si es para un cambio o para un delete
		if($tipoUpdate == 'C'){
			
			$jsonPer['Estatus'] = NULL;
			
			if($this->Configuracion_model->updateCatConfig($jsonPer,$idPer,'B')){
				$jsonUpdatePer['response_code'] = '200';
				$jsonUpdatePer['response_msg'] = 'Actualizacion exitosa!';
				$jsonUpdatePer['newPermisos'] = $this->Configuracion_model->getCatConfig(0,'B',0);
			}else{
				$jsonUpdatePer['response_code'] = '201';
				$jsonUpdatePer['response_msg'] = 'Ocurrio un error!';
			}

		}else if($tipoUpdate == 'D'){

			$jsonPer['Estatus'] = '0';

			if($this->Configuracion_model->updateCatConfig($jsonPer,$idPer,'B')){
				$jsonUpdatePer['response_code'] = '200';
				$jsonUpdatePer['response_msg'] = 'Borrado exitosa!';
			}else{
				$jsonUpdatePer['response_code'] = '201';
				$jsonUpdatePer['response_msg'] = 'Ocurrio un error!';
			}
		}
		echo json_encode($jsonUpdatePer);
	}
}

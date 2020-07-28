<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el ABC de 
* de los modulos
* @author Ing. Noe Ramo Lopez
* @version 1.0 
* @copyright Todos los derechos reservados 2019
*/
class Modulos extends CI_Controller {

	/**
	 * Constrcutor de la clase Departamentos
	 * carga el modelo de Configuracion.
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
	* de la tala de modulos. 
	*/
	public function index(){

		$datosMod = array();
		$fragment = array();
		$datosMod['modulos'] = $this->Configuracion_model->getCatConfig(0,'C',0);
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('configuracion/modulo_view',$datosMod,TRUE);
		$fragment['jsLibs'] = ['js/modulos.js'];

		$this->load->view('dashboard_view',$fragment);
	}

	/**
	* Metodo para obtener el nombre del modulo
	* a editar, recibe el id del modulo.
	* @param idMod
	*/
	public function getEditMod(){

		$modId = $this->input->post('idMod');
		$jsonModEdit = array();

		if($modId == NULL){
			$jsonModEdit['response_code'] = '201';
			$jsonModEdit['response_msg'] = 'Campo vacio';
		}else{
			$jsonModEdit['modulo'] = $this->Configuracion_model->getCatConfig($modId,'C',1);
			$jsonModEdit['response_code'] = '200';
			$jsonModEdit['response_msg'] = 'Campo vacio';
		}
		echo json_encode($jsonModEdit);
	}

	/**
	* Metodo para hacer la actualizacion de 
	* estatus de los modulos, tambien se puede 
	* utilizar para dar una baja logica
	* @param $tipo
	* @param $id del modulo
	* @param nombre del modulo
	*/
	public function updateMod(){

		$tipoUpdate = $this->input->post('tipo');
		$idMod = $this->input->post('idMod');
		$nameMod = $this->input->post('nameMod');
		$jsonUpdateMod = array();
		$jsonMod = array();

		$jsonMod['Nombre'] = $nameMod;
		
		//dicernimos si es para un cambio o para un delete
		if($tipoUpdate == 'C'){
			
			$jsonMod['Estatus'] = NULL;
			
			if($this->Configuracion_model->updateCatConfig($jsonMod,$idMod,'C')){
				$jsonUpdateMod['response_code'] = '200';
				$jsonUpdateMod['response_msg'] = 'Actualizacion exitosa!';
				$jsonUpdateMod['newRoles'] = $this->Configuracion_model->getCatConfig(0,'C',0);
			}else{
				$jsonUpdateMod['response_code'] = '201';
				$jsonUpdateMod['response_msg'] = 'Ocurrio un error!';
			}

		}else if($tipoUpdate == 'D'){

			$jsonMod['Estatus'] = '0';

			if($this->Configuracion_model->updateCatConfig($jsonMod,$idMod,'C')){
				$jsonUpdateMod['response_code'] = '200';
				$jsonUpdateMod['response_msg'] = 'Borrado exitosa!';
			}else{
				$jsonUpdateMod['response_code'] = '201';
				$jsonUpdateMod['response_msg'] = 'Ocurrio un error!';
			}
		}
		echo json_encode($jsonUpdateMod);
	}
}

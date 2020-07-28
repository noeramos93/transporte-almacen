<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el ABC de 
* de departamentos
* @author Ing. Noe Ramo Lopez
* @version 1.0 
* @copyright Todos los derechos reservados 2019
*/
class Departamentos extends CI_Controller {
	
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
	* Metodo para cargar la vista incial de 
	* la tabla de departamentos
	*/
	public function index(){

		$datosDepa = array();
		$fragment = array();
		
		$datosDepa['departamentos'] = $this->Configuracion_model->getCatConfig(0,'D',0);
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('configuracion/departamento_view',$datosDepa,TRUE);
		$fragment['jsLibs'] = ['core/js/datatables.min.js','js/departamento.js'];

		$this->load->view('dashboard_view',$fragment);
	}

	public function getEditDet(){
		$depa = $this->input->post('idDep');
		$jsonInfoDep = array();
		if($depa == NULL || $depa == ""){
			$jsonInfoDep['response_code'] = '201';
			$jsonInfoDep['response_msg'] = 'EL departamento es vacio';
		}else{

			$jsonInfoDep['departamento'] = $this->Configuracion_model->getInfoDepa($depa);
			$jsonInfoDep['response_code'] = '200';
			$jsonInfoDep['response_msg'] = 'Operacion exitosa!';
		}

		echo json_encode($jsonInfoDep);
	}

	public function deleteDep(){
		
		$departamento = $this->input->post('depId');
		$jsonDelDep = array();

		if($departamento == NULL || $departamento == ""){
			$jsonDelDep['response_code'] = '201';
			$jsonDelDep['response_msg'] = 'EL departamento esta vacio';
		}else{

			if($this->Configuracion_model->deleteDepartamento($departamento)){
				$jsonDelDep['response_code'] = '200';
				$jsonDelDep['response_msg'] = 'Operacion exitosa';
			}else{
				$jsonDelDep['response_code'] = '201';
				$jsonDelDep['response_msg'] = 'No se pudo hacer el borrado';
			}
		}

		echo json_encode($jsonDelDep);
	}

	/**
	* Metodo para actualizar el nombre del departamento
	* en abse al id que se le mande y el nuevo nombre
	* @param nameDep
	* @param idDep
	*/
	public function updateDep(){
		$idDep = $this->input->post('idDep');
		$nameDep = $this->input->post('nameDep');
		$jsonUpdtDep = array();

		if($idDep == NULL || $idDep == ""){
			$jsonUpdtDep['response_code'] = '201';
			$jsonUpdtDep['response_msg'] = 'El id del departamento no puede estar vacio';
		}else if($nameDep == NULL || $nameDep == ""){
			$jsonUpdtDep['response_code'] = '201';
			$jsonUpdtDep['response_msg'] = 'El nombre del departamento no puede estar vacio';
		}else{

			if($this->Configuracion_model->saveInfoDep($nameDep,$idDep)){
				$jsonUpdtDep['departamentos'] = $this->Configuracion_model->getCatConfig(0,'D',0);
				$jsonUpdtDep['response_code'] = '200';
				$jsonUpdtDep['response_msg'] = 'Operacion exitosa';
			}else{

				$jsonUpdtDep['response_code'] = '201';
				$jsonUpdtDep['response_msg'] = 'No se pudo actualizar';
			}
		}

		echo json_encode($jsonUpdtDep);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el ABC de 
* de folios documentos
* @author Ing. Noe Ramo Lopez
* @version 1.0 
* @copyright Todos los derechos reservados 2019
*/
class ModulosPermisos extends CI_Controller {

	/**
	* Metodo constructor de la clase 
	* Modulos permisos, carga el modelo
	* de configuracion.
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
	* Metodo para cargar la vista principal 
	* de modulos servicios.
	*/
	public function index(){
		$datosModPer = array();
		$datosModPer['modulos'] = $this->Configuracion_model->getCatConfig(0,'C',0);
		$datosModPer['permisos'] = $this->Configuracion_model->getCatConfig(0,'B',0);
		$datosModPer['relacionesModPer'] = $this->Configuracion_model->getRelacionModuloPermiso();

		$fragment = array();
		$fragment['ccsLibs'] = ['core/css/datatables.min.css'];
		$fragment['VISTA'] = $this->load->view('configuracion/modulo_permiso_view',$datosModPer,TRUE);
		$fragment['jsLibs'] = ['core/js/datatables.min.js','js/moduloPermiso.js'];

		$this->load->view('dashboard_view',$fragment);
	}

	/**
	* Metodo para guardar la relacion
	* que existe entre el modulo y el permiso
	* @param idMod modulo
	* @param idPer permiso
	*/
	public function saveRelacionModPer(){

		$id_mod = $this->input->post('idMod');
		$id_per = $this->input->post('idPer');
		$jsonSaveRelModPer = array();
		$infoRel = array();
		$camposValidos = TRUE;
		//validamos que venga informado el campo de modulo y permiso
		if($id_mod == 0 || $id_mod == '0'){
			$jsonSaveRelModPer['response_code'] = "201";
			$jsonSaveRelModPer['response_msg'] = "el campo modulo no debe de estar vacio";
			$camposValidos = FALSE;
		}else if($id_per == 0 || $id_per == '0'){
			$jsonSaveRelModPer['response_code'] = "201";
			$jsonSaveRelModPer['response_msg'] = "el campo permiso no debe de estar vacio";
			$camposValidos = FALSE;
		}

		if($camposValidos == TRUE){
			//varificamos que no exista la relacion, si no existe lo 
			//guardamos en caso contrario lo informamos
			$existeRel = $this->Configuracion_model->existeRelacionModPer($id_mod,$id_per);
			
			if($existeRel->ID == "0"){
				
				$infoRel['Id_Modulo'] = $id_mod;
				$infoRel['Id_Permiso'] = $id_per;
				$infoRel['Estatus'] = '1';

				if($this->Configuracion_model->saveRelModPer($infoRel)){
					$jsonSaveRelModPer['relacionesModPer'] = $this->Configuracion_model->getRelacionModuloPermiso();
					$jsonSaveRelModPer['response_code'] = "200";
					$jsonSaveRelModPer['response_msg'] = "operacion exitosa!";
				}else{
					$jsonSaveRelModPer['response_code'] = "201";
					$jsonSaveRelModPer['response_msg'] = "Algo salio mal! =(";
				}
			}else{
				$jsonSaveRelModPer['response_code'] = "201";
				$jsonSaveRelModPer['response_msg'] = "La relacion ya existe";
			}
		}
		echo json_encode($jsonSaveRelModPer);
	}

	/**
	* Metodo para borrar la relacion de 
	* modulo permiso
	* @param id_relacion
	*/
	public function deleteRelacion(){
		
		$relacion = $this->input->post('idRelacion');
		$jsonDeleteRel = array();
		
		if($relacion == NULL || $relacion == ""){
			$jsonDeleteRel['response_code'] = '201';
			$jsonDeleteRel['response_msg'] = 'El id de la relacion etsa vacia';
		}else{
			//obtenermos el modulo y el permiso que esten relacionados
			$usuarioPer = $this->Configuracion_model->getIdRelByPer($relacion);

			$modulo = $usuarioPer->Id_Modulo;
			$permiso = $usuarioPer->Id_Permiso;
			//eliminamos de la tabla usuario permiso los que coincidan
			$this->Configuracion_model->deleteUsuPerByModAndPer($modulo,$permiso);

			if($this->Configuracion_model->deleteRelModPer($relacion)){
				$jsonDeleteRel['response_code'] = '200';
				$jsonDeleteRel['response_msg'] = 'El id de la recion etsa vacia';
			}else{
				$jsonDeleteRel['response_code'] = '201';
				$jsonDeleteRel['response_msg'] = 'no se pudo borrar el registro';
			}
		}

		echo json_encode($jsonDeleteRel);
	}
}

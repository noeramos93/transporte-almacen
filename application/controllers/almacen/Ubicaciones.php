<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el ABC de 
* de ubicaciones
* @author Ing. Noe Ramo Lopez
* @version 1.0 
* @copyright Todos los derechos reservados 2019
*/
class Ubicaciones extends CI_Controller {

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
		$this->load->model('Ubicacion_model');
	}

	/**
	* Metodo para cargar la vista incial de
	* los Ubicaciones.
	*/
	public function index(){
		//consultamos el catalogo de ubicaciones con la clave 'A'
		$datosUbic = array();
		$datosUbic['ubicaciones'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('A');

		$fragment = array();
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('almacen/ubicacion_view',$datosUbic,TRUE);
		$fragment['jsLibs'] = ['core/js/datatables.min.js','js/ubicacion.js'];
		
		$this->load->view('dashboard_view',$fragment);
	}

	/**
	* Metodo para obtener la informacion de una ubicacion
	* en base al id que se consulte
	* @param id_ubic
	*/
	public function getInfoUbic(){
		$ubicacion = $this->input->post('id_ubic');
		$jsonGetInfo = array();
		if($ubicacion == '' || $ubicacion == NULL){
			$jsonGetInfo['response_code'] = '201';
			$jsonGetInfo['response_msg'] = 'la ubicacion esta vacia';
		}else{
			
			$jsonGetInfo['response_code'] = '200';
			$jsonGetInfo['response_msg'] = 'Operacion exitosa!';
			$jsonGetInfo['ubicacion'] = $this->CatalogoAlmacen_model->getInfoUbicById($ubicacion);
			
		}
		echo json_encode($jsonGetInfo);
	}

	/**
	* Metodo para agregar una nueva ubicacion al catalogo
	* de ubicaciones recibe el nombre de la nueva ubicacion
	* @param nameUbic
	*/
	public function addUbic(){
		
		$ubicacion = $this->input->post('nameUbic');
		$jsonAddUbic = array();
		$infoUbic = array();

		if($ubicacion == NULL || $ubicacion  == ""){
			$jsonAddUbic['response_code'] = '201';
			$jsonAddUbic['response_msg'] = 'el nombre de la ubicacion esta vacio';
		}else{

			$infoUbic['Nombre'] = $ubicacion;
			$infoUbic['Estatus'] = '1';

			if($this->Ubicacion_model->saveInfoUbic($infoUbic)){
				$jsonAddUbic['response_code'] = '200';
				$jsonAddUbic['response_msg'] = 'operacion exitosa!';
				$jsonAddUbic['ubicaciones'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('A');
			}
		}
		echo json_encode($jsonAddUbic);
	}

	/**
	* Metodo para actualizar la informacion de 
	* una ubicacion, recibe el id de la ubicacino
	* y el nombre de la ubicacion y el tipo de
	* actualizacion que se realizara
	* @param $tipoUpd
	* @param id_ubic
	* @param name_ubic
	*/
	public function updateInfoUbic(){

		$tipoUpdate = $this->input->post('tipoUpd');
		$idUbic = $this->input->post('id_ubic');
		$nameUbic = $this->input->post('name_ubic');
		$jsonUpdUbic = array();
		$infoUpdUbic = array();

		if($idUbic == NULL || $idUbic == ""){
			$jsonUpdUbic['response_code'] = '201';
			$jsonUpdUbic['response_msg'] = 'El id de la ubicacion esta vacia';
		}

		// 'A' es para actualizar
		if($tipoUpdate == 'A'){
			if($nameUbic == NULL || $nameUbic == ""){
				$jsonUpdUbic['response_code'] = '201';
				$jsonUpdUbic['response_msg'] = 'El nombre de la ubicacion esta vacia';
			}else{
				$infoUpdUbic['Nombre'] = $nameUbic;
				$infoUpdUbic['Estatus'] = '1';

				//hacemos la actualizacion
				if($this->Ubicacion_model->updInfoUbic($infoUpdUbic,$idUbic)){
					$jsonUpdUbic['response_code'] = '200';
					$jsonUpdUbic['response_msg'] = 'actualizacion exitosa';
					$jsonUpdUbic['ubicaciones'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('A');
				}
			}
		// 'B' es para baja Logica
		}else if($tipoUpdate == 'B'){
			
			$infoUpdUbic['Estatus'] = '0';

			//hacmos la baja logica de la ubicacion
			if($this->Ubicacion_model->updInfoUbic($infoUpdUbic,$idUbic)){
				$jsonUpdUbic['response_code'] = '200';
				$jsonUpdUbic['response_msg'] = 'actualizacion exitosa';
			}

		}

		echo json_encode($jsonUpdUbic);
	}
}

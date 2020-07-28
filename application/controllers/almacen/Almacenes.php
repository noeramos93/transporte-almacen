<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Controlador para el ABC de 
* de Almacenes
* @author Ing. Noe Ramo Lopez
* @version 1.0 
* @copyright Todos los derechos reservados 2019
*/
class Almacenes extends CI_Controller {

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
		$this->load->model('Almacen_model');
	}

	/**
	* Metodo para cargar la vista incial de
	* almacenes
	*/
	public function index(){
		//consultamos el catalogo de almacenes con la clave 'C'
		$datosAlm = array();
		$datosAlm['almacenes'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('C');
		
		$fragment = array();
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('almacen/almacen_view',$datosAlm,TRUE);
		$fragment['jsLibs'] = ['core/js/datatables.min.js','js/almacen.js'];
		
		$this->load->view('dashboard_view',$fragment);
	}

	/**
	* Metodo para obtener la informacion de un almacen
	* en base al id que se consulte
	* @param id_ubic
	*/
	public function getInfoAlm(){
		$almacen = $this->input->post('id_alm');
		$jsonGetInfoAlm = array();
		if($almacen == '' || $almacen == NULL){
			$jsonGetInfoAlm['response_code'] = '201';
			$jsonGetInfoAlm['response_msg'] = 'el id del almacen esta vacia';
		}else{
			
			$jsonGetInfoAlm['response_code'] = '200';
			$jsonGetInfoAlm['response_msg'] = 'Operacion exitosa!';
			$jsonGetInfoAlm['almacen'] = $this->Almacen_model->getInfoAlmById($almacen);
			
		}
		echo json_encode($jsonGetInfoAlm);
	}

	/**
	* Metodo para agregar un nuevo almacen al catalogo
	* de almacen recibe el nombre del nuevo almacen
	* @param nameAlm
	*/
	public function addAlm(){
		
		$almName = $this->input->post('nameAlm');
		$jsonAddAlm = array();
		$infoAlm = array();

		if($almName == NULL || $almName  == ""){
			$jsonAddAlm['response_code'] = '201';
			$jsonAddAlm['response_msg'] = 'el nombre del almacen esta vacio';
		}else{

			$infoAlm['Nombre'] = $almName;
			$infoAlm['Estatus'] = '1';

			if($this->Almacen_model->saveInfoAlm($infoAlm)){
				$jsonAddAlm['response_code'] = '200';
				$jsonAddAlm['response_msg'] = 'operacion exitosa!';
				$jsonAddAlm['almacenes'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('C');
			}
		}
		echo json_encode($jsonAddAlm);
	}

	/**
	* Metodo para actualizar la informacion de 
	* un almacen, recibe el id de la ubicacino
	* y el nombre del almacen y el tipo de
	* actualizacion que se realizara
	* @param $tipoUpd
	* @param id_ubic
	* @param name_ubic
	*/
	public function updateInfoAlm(){

		$tipoUpdate = $this->input->post('tipoUpd');
		$idAlm = $this->input->post('id_alm');
		$nameAlm = $this->input->post('name_alm');
		$jsonUpdAlm = array();
		$infoUpdUAlm = array();

		if($idAlm == NULL || $idAlm == ""){
			$jsonUpdAlm['response_code'] = '201';
			$jsonUpdAlm['response_msg'] = 'El id del almacen esta vacia';
		}

		// 'A' es para actualizar
		if($tipoUpdate == 'A'){
			if($nameAlm == NULL || $nameAlm == ""){
				$jsonUpdAlm['response_code'] = '201';
				$jsonUpdAlm['response_msg'] = 'El nombre del almacen esta vacia';
			}else{
				$infoUpdUAlm['Nombre'] = $nameAlm;
				$infoUpdUAlm['Estatus'] = '1';

				//hacemos la actualizacion
				if($this->Almacen_model->updInfoAlm($infoUpdUAlm,$idAlm)){
					$jsonUpdAlm['response_code'] = '200';
					$jsonUpdAlm['response_msg'] = 'actualizacion exitosa';
					$jsonUpdAlm['almacenes'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('C');
				}
			}
		// 'B' es para baja Logica
		}else if($tipoUpdate == 'B'){
			
			$infoUpdUAlm['Estatus'] = '0';

			//hacmos la baja logica de la ubicacion
			if($this->Almacen_model->updInfoAlm($infoUpdUAlm,$idAlm)){
				$jsonUpdAlm['response_code'] = '200';
				$jsonUpdAlm['response_msg'] = 'actualizacion exitosa';
			}

		}

		echo json_encode($jsonUpdAlm);
	}
}

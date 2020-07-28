<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el ABC de 
* de tipo de movimientos
* @author Ing. Noe Ramo Lopez
* @version 1.0 
* @copyright Todos los derechos reservados 2019
*/
class TipoMovimientos extends CI_Controller {

	/**
	* Constrcutor de la clase tipo de movimientos.
	*/
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('name') == FALSE){
            $this->session->set_flashdata("error","sesion invalida");
            redirect("Login");
        }
		$this->load->model('CatalogoAlmacen_model');
		$this->load->model('TipoMov_model');
	}

	/**
	* Metodo para cargar la vista incial de
	* los tipos de movimientos
	*/
	public function index(){
		
		$datosTipoMov = array();
		$datosTipoMov['tipoMovimientos'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('D');
		
		$fragment = array();
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('almacen/tipo_movimiento_view',$datosTipoMov,TRUE);
		$fragment['jsLibs'] = ['core/js/datatables.min.js','js/tipoMovimiento.js'];
		
		$this->load->view('dashboard_view',$fragment);
	}

	/**
	* Metodo para obtener la informacion de un tipo de movimiento
	* en base al id que se consulte
	* @param id_ubic
	*/
	public function getInfoTipMov(){
		$tipMov = $this->input->post('id_tip_mov');
		$jsonGetInfoTipMov = array();
		if($tipMov == '' || $tipMov == NULL){
			$jsonGetInfoTipMov['response_code'] = '201';
			$jsonGetInfoTipMov['response_msg'] = 'el id del movimiento esta vacia';
		}else{
			
			$jsonGetInfoTipMov['response_code'] = '200';
			$jsonGetInfoTipMov['response_msg'] = 'Operacion exitosa!';
			$jsonGetInfoTipMov['tipoMovimiento'] = $this->TipoMov_model->getInfoTipMovById($tipMov);
			
		}
		echo json_encode($jsonGetInfoTipMov);
	}

	/**
	* Metodo para agregar un nuevo almacen al catalogo
	* de un tipo de movimiento recibe el nombre del nuevo almacen
	* @param nameAlm
	*/
	public function addTipMov(){
		
		$tipMovName = $this->input->post('nameTipMov');
		$jsonAddTipMov = array();
		$infoTipMov = array();

		if($tipMovName == NULL || $tipMovName  == ""){
			$jsonAddTipMov['response_code'] = '201';
			$jsonAddTipMov['response_msg'] = 'el nombre del almacen esta vacio';
		}else{

			$infoTipMov['Nombre'] = $tipMovName;
			$infoTipMov['Estatus'] = '1';

			if($this->TipoMov_model->saveInfoTipMov($infoTipMov)){
				$jsonAddTipMov['response_code'] = '200';
				$jsonAddTipMov['response_msg'] = 'operacion exitosa!';
				$jsonAddTipMov['tipoMovimientos'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('D');
			}
		}
		echo json_encode($jsonAddTipMov);
	}

	/**
	* Metodo para actualizar la informacion de 
	* un tipo de movimeinto, recibe el id del tipo de movimiento
	* y el nombre del tipo de movimiento y el tipo de
	* actualizacion que se realizara
	* @param $tipoUpd
	* @param id_tip_mov
	* @param name_tip_mov
	*/
	public function updateInfoTipMov(){

		$tipoUpdate = $this->input->post('tipoUpd');
		$idTipMov = $this->input->post('id_tip_mov');
		$nameTipMov = $this->input->post('name_tip_mov');
		$jsonUpdTipMov = array();
		$infoUpdUTipMov = array();

		if($idTipMov == NULL || $idTipMov == ""){
			$jsonUpdTipMov['response_code'] = '201';
			$jsonUpdTipMov['response_msg'] = 'El id del almacen esta vacia';
		}

		// 'A' es para actualizar
		if($tipoUpdate == 'A'){
			if($nameTipMov == NULL || $nameTipMov == ""){
				$jsonUpdTipMov['response_code'] = '201';
				$jsonUpdTipMov['response_msg'] = 'El nombre del tipo de movimiento esta vacia';
			}else{
				$infoUpdUTipMov['Nombre'] = $nameTipMov;
				$infoUpdUTipMov['Estatus'] = '1';

				//hacemos la actualizacion
				if($this->TipoMov_model->updInfoAlm($infoUpdUTipMov,$idTipMov)){
					$jsonUpdTipMov['response_code'] = '200';
					$jsonUpdTipMov['response_msg'] = 'actualizacion exitosa';
					$jsonUpdTipMov['tipoMovimientos'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('D');
				}
			}
		// 'B' es para baja Logica
		}else if($tipoUpdate == 'B'){
			
			$infoUpdUTipMov['Estatus'] = '0';

			//hacmos la baja logica de la ubicacion
			if($this->TipoMov_model->updInfoAlm($infoUpdUTipMov,$idTipMov)){
				$jsonUpdTipMov['response_code'] = '200';
				$jsonUpdTipMov['response_msg'] = 'actualizacion exitosa';
			}

		}

		echo json_encode($jsonUpdTipMov);
	}
}

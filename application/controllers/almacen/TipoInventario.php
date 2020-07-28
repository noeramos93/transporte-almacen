<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el ABC de 
* de tipo de inventarios
* @author Ing. Noe Ramo Lopez
* @version 1.0 
* @copyright Todos los derechos reservados 2019
*/
class TipoInventario extends CI_Controller {
	/**
	* Constrcutor de la clase tipo de inventarios.
	*/
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('name') == FALSE){
            $this->session->set_flashdata("error","sesion invalida");
            redirect("Login");
        }
		$this->load->model('CatalogoAlmacen_model');
		$this->load->model('TipoInventario_model');
	}

	/**
	* Metodo para cargar la vista incial de
	* los tipos de inventarios
	*/
	public function index(){
		$datosTipoInv = array();
		$datosTipoInv['tipoInventarios'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('B');

		$fragment = array();
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('almacen/tipo_inventario_view',$datosTipoInv,TRUE);
		$fragment['jsLibs'] = ['core/js/datatables.min.js','js/tipoInventario.js'];
		
		$this->load->view('dashboard_view',$fragment);
	}

	/**
	* Metodo para obtener la informacion de un tipo de inventario
	* en base al id que se consulte
	* @param id_tip_inv
	*/
	public function getInfoTipInv(){
		$tipoInventario = $this->input->post('id_tip_inv');
		$jsonGetInfoInv = array();
		if($tipoInventario == '' || $tipoInventario == NULL){
			$jsonGetInfoInv['response_code'] = '201';
			$jsonGetInfoInv['response_msg'] = 'la ubicacion esta vacia';
		}else{
			
			$jsonGetInfoInv['response_code'] = '200';
			$jsonGetInfoInv['response_msg'] = 'Operacion exitosa!';
			$jsonGetInfoInv['tipoInventario'] = $this->TipoInventario_model->getInfoTipInvById($tipoInventario);
			
		}
		echo json_encode($jsonGetInfoInv);
	}

	/**
	* Metodo para agregar un nuevo tipo de inventario al catalogo
	* de tipo de inventario recibe el nombre del nuevo tipo
	* @param nameTipMov
	*/
	public function addTipInv(){
		
		$tipInv = $this->input->post('nameTipInv');
		$jsonAddTipInv = array();
		$infoTipInv = array();

		if($tipInv == NULL || $tipInv  == ""){
			$jsonAddTipInv['response_code'] = '201';
			$jsonAddTipInv['response_msg'] = 'el nombre del tipo de inventario esta vacio';
		}else{

			$infoTipInv['Nombre'] = $tipInv;
			$infoTipInv['Estatus'] = '1';

			if($this->TipoInventario_model->saveInfoTipInv($infoTipInv)){
				$jsonAddTipInv['response_code'] = '200';
				$jsonAddTipInv['response_msg'] = 'operacion exitosa!';
				$jsonAddTipInv['tipoInventarios'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('B');
			}
		}
		echo json_encode($jsonAddTipInv);
	}

	/**
	* Metodo para actualizar la informacion de 
	* un tipo de inventario, recibe el id del tipo de inventario
	* y el nombre del tipo de inv y el tipo de
	* actualizacion que se realizara
	* @param $tipoUpd
	* @param id_tip_inv
	* @param name_tip_inv
	*/
	public function updateInfoTipInv(){

		$tipoUpdate = $this->input->post('tipoUpd');
		$idTipInv = $this->input->post('id_tip_inv');
		$nameTipInv = $this->input->post('name_tip_inv');
		$jsonUpdTipInv = array();
		$infoUpdTipInv = array();

		if($idTipInv == NULL || $idTipInv == ""){
			$jsonUpdTipInv['response_code'] = '201';
			$jsonUpdTipInv['response_msg'] = 'El id del tipo de inventario esta vacia';
		}

		// 'A' es para actualizar
		if($tipoUpdate == 'A'){
			if($nameTipInv == NULL || $nameTipInv == ""){
				$jsonUpdTipInv['response_code'] = '201';
				$jsonUpdTipInv['response_msg'] = 'El nombre del tipo de inventario esta vacia';
			}else{
				$infoUpdTipInv['Nombre'] = $nameTipInv;
				$infoUpdTipInv['Estatus'] = '1';

				//hacemos la actualizacion
				if($this->TipoInventario_model->updInfoTipInv($infoUpdTipInv,$idTipInv)){
					$jsonUpdTipInv['response_code'] = '200';
					$jsonUpdTipInv['response_msg'] = 'actualizacion exitosa';
					$jsonUpdTipInv['tipoInventarios'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('B');
				}
			}
		// 'B' es para baja Logica
		}else if($tipoUpdate == 'B'){
			
			$infoUpdTipInv['Estatus'] = '0';

			if($this->TipoInventario_model->updInfoTipInv($infoUpdTipInv,$idTipInv)){
				$jsonUpdTipInv['response_code'] = '200';
				$jsonUpdTipInv['response_msg'] = 'actualizacion exitosa';
			}
		}

		echo json_encode($jsonUpdTipInv);
	}
}

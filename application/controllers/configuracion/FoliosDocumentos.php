<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el ABC de 
* de folios documentos
* @author Ing. Noe Ramo Lopez
* @version 1.0 
* @copyright Todos los derechos reservados 2019
*/
class FoliosDocumentos extends CI_Controller {
	
	/**
	* Constructor de la clase Folios Documentos
	* carga el modelo de configuracion
	*/
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('name') == FALSE){
            $this->session->set_flashdata("error","sesion invalida");
            redirect("Login");
        }
		$this->load->model('FoliosDoc_model');

	}

	/**
	* Metodo para cargar la vista inicial
	* de los folios documentos
	*/
	public function index(){
		$datosFol = array();
		$datosFol['idNextFol'] = $this->genIdNext('B');
		$datosFol['folios'] = $this->FoliosDoc_model->getAllTableFolios();

		$fragment = array();
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('configuracion/folio_documento_view',$datosFol,TRUE);
		$fragment['jsLibs'] = ['core/js/datatables.min.js','js/docFolios.js'];

		$this->load->view('dashboard_view',$fragment);
	}

	public function genIdNext($catalogo){
		$idTable = $this->FoliosDoc_model->getIdTableFac($catalogo);
		$idCat = $idTable->NUM_ID + 1;
		return $idCat;
	}

	/**
	* Metodo para hacer la actualizacion o un nuevo registro
	* para la tabla de folio documento, recibe el id del folio
	* , el documento, el numero de serie, el siguiente folio y 
	* el tipo de operacion si es A es para actualizar , si es S
	* es para guardar
	* @param id_fol
	* @param doc_fol
	* @param serie_fol
	* @param sig_fol
	* @param tipo_opr
	* @return json[]
	*/
	public function addFolDoc(){

		$idFol = $this->input->post('id_fol');
		$documento = $this->input->post('doc_fol');
		$serie = $this->input->post('serie_fol');
		$siguiente = $this->input->post('sig_fol');
		$tipoOperacion = $this->input->post('tipo_opr');
		$caposValid = TRUE;
		$jsonAddFol = array();
		$infoFolio = array();

		if($documento == NULL || $documento == ""){
			$caposValid = FALSE;
			$jsonAddFol['response_code'] = '201';
			$jsonAddFol['response_msg'] = 'documento nulo';
		}

		if($serie == NULL || $serie == ""){
			$caposValid = FALSE;
			$jsonAddFol['response_code'] = '201';
			$jsonAddFol['response_msg'] = 'serie nulo';
		}

		if($siguiente == NULL || $siguiente == ""){
			$caposValid = FALSE;
			$jsonAddFol['response_code'] = '201';
			$jsonAddFol['response_msg'] = 'siguiente nulo';
		}


		if($caposValid){

			$infoFolio['Documento'] = $documento;
			$infoFolio['FolioSiguiente'] = $siguiente;
			$infoFolio['Serie'] = $serie;

			if($this->FoliosDoc_model->addDocFol($infoFolio,$tipoOperacion,$idFol)){
				
				$jsonAddFol['response_code'] = '200';

				if($tipoOperacion == 'A'){
					$jsonAddFol['response_msg'] = 'Actualizacion exitosa';
				}else if($tipoOperacion == 'S'){
					$jsonAddFol['response_msg'] = 'Guadado exitoso';
				}
				//obtenemos todos los folios para actualizar la tabla
				$jsonAddFol['folios'] = $this->FoliosDoc_model->getAllTableFolios();
				$jsonAddFol['idNextFol'] = $this->genIdNext('B');
			}
		}

		echo json_encode($jsonAddFol);
	}

	public function getInfoFol(){
		$idFol = $this->input->post('id_fol');
		$jsonInfoFol = array();

		if($idFol == NULL || $idFol == ""){
			$jsonInfoFol['response_code'] = '201';
			$jsonInfoFol['response_msg'] = 'id folio vacio';
		}else{
			$jsonInfoFol['response_code'] = '200';
			$jsonInfoFol['response_msg'] = 'operacion exitosa';
			$jsonInfoFol['folio'] = $this->FoliosDoc_model->getFolInfo($idFol);
		}
		echo json_encode($jsonInfoFol);
	}

	/**
	* Metodo para dar de baja un folio documento
	* @param id del folio
	* @return json []
	*/
	public function dropFolio(){
		$folio = $this->input->post('id_fol');
		$jsonDelFol = array();
		if($folio == NULL || $folio == ""){
			$jsonDelFol['response_code'] = '201';
			$jsonDelFol['response_msg'] = 'folio esta vacio';
		}else{

			if($this->FoliosDoc_model->dropFol($folio)){
				$jsonDelFol['response_code'] = '200';
				$jsonDelFol['response_msg'] = 'Operacion exitosa';
			}else{
				$jsonDelFol['response_code'] = '201';
				$jsonDelFol['response_msg'] = 'No se pudo borrar el folio';
			}
		}
		echo json_encode($jsonDelFol);
	}
}

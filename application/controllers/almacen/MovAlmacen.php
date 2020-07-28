<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Controlador para el ABC de 
* los movimientos de almacen
* @author Ing. Noe Ramo Lopez
* @version 1.0 
* @copyright Todos los derechos reservados 2019
*/
class MovAlmacen extends CI_Controller {

	/**
	* Constrcutor de la clase Ubicaciones.
	*/
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('name') == FALSE){
            $this->session->set_flashdata("error","sesion invalida");
            redirect("Login");
        }

        $this->load->model('MovimientoAlm_model');
	}

	public function index(){
		
		$datosMov = array();
		$datosMov['almacenes'] = $this->MovimientoAlm_model->getAlm();
		$datosMov['movimientos'] = $this->MovimientoAlm_model->getMovimientos();
		$datosMov['partes'] = $this->MovimientoAlm_model->getCardexElement();
		
		$fragment = array();
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('almacen/mov_almacen_view',$datosMov,TRUE);
		$fragment['jsLibs'] = ['js/movimientos.js'];
		
		$this->load->view('dashboard_view',$fragment);
	}

	public function getInfoParte(){
		$parte = $this->input->post('id_parte');
		$jsonInfoPart = array();

		if($parte == ""){
			$jsonInfoPart['response_code'] = '201';
			$jsonInfoPart['response_msg'] = 'La parte esta vacia';
		}else{
			$jsonInfoPart['response_code'] = '200';
			$jsonInfoPart['response_msg'] = 'Operacion Exitosa';
			$jsonInfoPart['numero'] = $this->MovimientoAlm_model->getNumCardex($parte);
		}

		echo json_encode($jsonInfoPart);
	}


	public function addMovAlmacen(){

		$folio = $this->input->post('folio_mov');
		$serie = $this->input->post('serie_mov');
		$fecha = $this->input->post('fech_mov');
		$tipo_mov = $this->input->post('tipo_mov');
		$movimiento = $this->input->post('tipo_mov_id');
		$almacen = $this->input->post('alm_mov_id');
		$observacion = $this->input->post('obs_mov');
		$partidasAjuste = $this->input->post('tabla_parte');

		$jsonAddMov = array();
		$infoAddMov = array();
		$infoDetalleAj = array();
		$validCampos = TRUE;

		if( $folio == NULL || $folio == "" ){
			$validCampos = FALSE;
			$jsonAddMov['response_code'] = '201';
			$jsonAddMov['response_msg'] = 'El folio esta vacio';
		}

		if( $serie == NULL || $serie == "" ){
			$validCampos = FALSE;
			$jsonAddMov['response_code'] = '201';
			$jsonAddMov['response_msg'] = 'El numero de serie esta vacio';
		}

		if( $fecha == NULL || $fecha == "" ){
			$validCampos = FALSE;
			$jsonAddMov['response_code'] = '201';
			$jsonAddMov['response_msg'] = 'La fecha esta vacia';
		}

		if( $movimiento == NULL || $movimiento == "" ){
			$validCampos = FALSE;
			$jsonAddMov['response_code'] = '201';
			$jsonAddMov['response_msg'] = 'El movimiento esta vacio';
		}

		if( $almacen == NULL || $almacen == "" ){
			$validCampos = FALSE;
			$jsonAddMov['response_code'] = '201';
			$jsonAddMov['response_msg'] = 'El almacen esta vacio';
		}

		if( $observacion == NULL || $observacion == "" ){
			$validCampos = FALSE;
			$jsonAddMov['response_code'] = '201';
			$jsonAddMov['response_msg'] = 'La observacion esta vacio';
		}

		if($validCampos){

			$infoAddMov['Folio'] = $folio;
			$infoAddMov['Serie'] = $serie;
			$infoAddMov['Tipo'] = $tipo_mov; // Entrada ó Salida
			$infoAddMov['Id_TipoMov'] = $movimiento;
			$infoAddMov['Id_Almacen'] = $almacen;
			$infoAddMov['Estado'] = 'SinAplicar';
			$infoAddMov['Costotal'] = '';
			$infoAddMov['Id_UsuarioRegistro'] = $this->session->userdata('id');
			$infoAddMov['Observaciones'] = $observacion;

			$movId = $this->MovimientoAlm_model->saveMov($infoAddMov);

			if(!is_null($movId)){

				for ($i = 0; $i < count($partidasAjuste); $i++) {

                	$infoDetalleAj['Id_Ajuste'] = $idMovEdt;
                	$infoDetalleAj['Id_Parte'] = $partidasAjuste[$i]["id"];
                	$infoDetalleAj['Cantidad'] = $partidasAjuste[$i]["cantidad"];
                	$infoDetalleAj['Costo'] = $partidasAjuste[$i]["costo"];
                	$infoDetalleAj['Costototal'] = $partidasAjuste[$i]["total"];

                	$this->MovimientoAlm_model->saveDetalleAjuste($infoDetalleAj);
            	}

				$jsonAddMov['response_code'] = '200';
				$jsonAddMov['response_msg'] = 'Operacion exitosa';
			}

		}

		echo json_encode($jsonAddMov);
	}

	/**
	* Metodo para obtener la informacion del movimiento 
	* en base al folio y el numero de serie que se envie
	* @param $folio
	* @param $serie
	*/
	public function getInfoMov(){

		$folio = $this->input->post('folio_mov_edt');
		$serie = $this->input->post('serie_mov_edt');
		$jsonGetInfo = array();
		$validInfo = TRUE;

		if($folio == "" || $folio == NULL){
			$validInfo = FALSE;
			$jsonGetInfo['response_code'] = '201';
			$jsonGetInfo['response_msg'] = 'Folio esta vacio';
		}else if($serie == NULL || $serie == ""){
			$validInfo = FALSE;
			$jsonGetInfo['response_code'] = '201';
			$jsonGetInfo['response_msg'] = 'Serie esta vacia';
		}

		if($validInfo){

			$infoMov = $this->MovimientoAlm_model->getInfoMovByFolSer($folio,$serie);

			if(!is_null($infoMov)){

				$movId = $infoMov->Id_Ajuste;

				$jsonGetInfo['response_code'] = '200';
				$jsonGetInfo['response_msg'] = 'Operacion exitosa';
				$jsonGetInfo['infoMovimiento'] = $infoMov;
				$jsonGetInfo['detalleMov'] = $this->MovimientoAlm_model->getInfoMovDetalle($movId);

			}else{
				$jsonGetInfo['response_code'] = '202';
				$jsonGetInfo['response_msg'] = 'El movimiento no existe';
			}
		}

		echo json_encode($jsonGetInfo);
	}

	/**
	* Metodo para editar la informacion de los movimeintos de ajustes
	* @param folio_mov
	* @param serie_mov
	* @param tipo_mov
	* @param tipo_mov_id
	* @param alm_mov_id
	* @param obs_mov
	*/
	public function editMovimiento(){

		$idMovEdt = $this->input->post('id_mov');
		$folioEdt = $this->input->post('folio_mov');
		$serieEdt = $this->input->post('serie_mov');
		$tipo_movEdt = $this->input->post('tipo_mov');
		$movimientoEdt = $this->input->post('tipo_mov_id');
		$almacenEdt = $this->input->post('alm_mov_id');
		$observacionEdt = $this->input->post('obs_mov');
		$partidasAjusteEdt = $this->input->post('tabla_parte');

		$validCamposEdt = TRUE;
		$infoMovEdt = array();
		$jsonMovEdt = array();
		$infoDetalleAjuste = array();

		if($folioEdt == NULL || $folioEdt == ""){
			$validCamposEdt = FALSE;
			$jsonMovEdt['response_code'] = "201";
			$jsonMovEdt['response_msg'] = "El folio a editar esta vacio";
		}

		if($serieEdt == NULL || $serieEdt == ""){
			$validCamposEdt = FALSE;
			$jsonMovEdt['response_code'] = "201";
			$jsonMovEdt['response_msg'] = "El numero de serie esta vacio";
		}

		if($validCamposEdt){

			$infoMovEdt['Folio'] = $folioEdt;
			$infoMovEdt['Serie'] = $serieEdt;
			$infoMovEdt['Tipo'] = $tipo_movEdt;
			$infoMovEdt['Id_TipoMov'] = $movimientoEdt;
			$infoMovEdt['Id_Almacen'] = $almacenEdt;
			$infoMovEdt['Estado'] = 'SinAplicar';
			$infoMovEdt['Costotal'] = '';
			$infoMovEdt['Observaciones'] = $observacionEdt;

			if($this->MovimientoAlm_model->editMov($infoMovEdt,$idMovEdt)){
				
				$this->MovimientoAlm_model->dropDetalle($idMovEdt);

				for ($i = 0; $i < count($partidasAjusteEdt); $i++) {

                	$infoDetalleAjuste['Id_Ajuste'] = $idMovEdt;
                	$infoDetalleAjuste['Id_Parte'] = $partidasAjusteEdt[$i]["id"];
                	$infoDetalleAjuste['Cantidad'] = $partidasAjusteEdt[$i]["cantidad"];
                	$infoDetalleAjuste['Costo'] = $partidasAjusteEdt[$i]["costo"];
                	$infoDetalleAjuste['Costototal'] = $partidasAjusteEdt[$i]["total"];

                	$this->MovimientoAlm_model->saveDetalleAjuste($infoDetalleAjuste);
            	}

				$jsonMovEdt['response_code'] = '200';
				$jsonMovEdt['response_msg'] = 'operacion exitosa';
			}
		}
		echo json_encode($jsonMovEdt);
	}

	public function dropMovimiento(){

		$movimiento = $this->input->post('id_mov');
		$jsonDropMov = array();

		if($movimiento == "" || $movimiento == NULL ){
			$jsonDropMov['response_code'] = '201';
			$jsonDropMov['response_msg'] = 'el movimiento esta vacio';
		}else{

			if($this->MovimientoAlm_model->bajaMov($movimiento)){
				$jsonDropMov['response_code'] = '200';
				$jsonDropMov['response_msg'] = 'operacion exitosa';
			}
		}

		echo json_encode($jsonDropMov);
	}

	public function autorizarMovimiento(){
		$movimiento = $this->input->post('id_mov');

		$jsonAutMov = array();

		if($movimiento == "" || $movimiento == NULL ){
			$jsonAutMov['response_code'] = '201';
			$jsonAutMov['response_msg'] = 'el movimiento esta vacio';
		}else{

			if($this->MovimientoAlm_model->autorizarMov($movimiento)){
				$jsonAutMov['response_code'] = '200';
				$jsonAutMov['response_msg'] = 'operacion exitosa';
			}
		}

		echo json_encode($jsonAutMov);	
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el ABC de 
* de Clientes
* @author Ing. Noe Ramo Lopez
* @version 1.0 
* @copyright Todos los derechos reservados 2019
*/
class CatalogoGeneral extends CI_Controller {
	/**
	* Constrcutor de la clase Clientes.
	*/
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('name') == FALSE){
            $this->session->set_flashdata("error","sesion invalida");
            redirect("Login");
        }
		$this->load->model('CatalogoGeneral_model');
	}

	/**
	* Metodo para cargar la vista inicial de los clientes
	* cargando el catalogo de estados y el listado de los
	* clientes registrados
	*/
	public function clientes(){
		
		$datosCli = array();
		$datosCli['clientes'] = $this->CatalogoGeneral_model->getCatalogoGeneral('A');
		$datosCli['estados'] = $this->CatalogoGeneral_model->getCatalogoGeneral('D');
		$datosCli['idCliente'] = $this->getNextIdCat('A');

		$fragment = array();
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('catalogosGenerales/cliente_view',$datosCli,TRUE);
		$fragment['jsLibs'] = ['js/clientes.js'];
		
		$this->load->view('dashboard_view',$fragment);
	}

	/**
	* Metodo para cargar la vista principal
	* de los proveedores
	*/
	public function proveedores(){

		$datosCli = array();
		$datosCli['proveedores'] = $this->CatalogoGeneral_model->getCatalogoGeneral('B');
		$datosCli['estados'] = $this->CatalogoGeneral_model->getCatalogoGeneral('D');
		$datosCli['idProveedor'] = $this->getNextIdCat('B');

		$fragment = array();
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('catalogosGenerales/proveedor_view',$datosCli,TRUE);
		$fragment['jsLibs'] = ['js/proveedores.js'];
		
		$this->load->view('dashboard_view',$fragment);
	}

	/**
	* Metodo para cargar la vista principal de
	* los propietarios.
	*/
	public function propietarios(){

		$datosCli = array();
		$datosCli['propietarios'] = $this->CatalogoGeneral_model->getCatalogoGeneral('C');
		$datosCli['estados'] = $this->CatalogoGeneral_model->getCatalogoGeneral('D');
		$datosCli['idPropietario'] = $this->getNextIdCat('C');

		$fragment = array();
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('catalogosGenerales/propietario_view',$datosCli,TRUE);
		$fragment['jsLibs'] = ['js/propietarios.js'];
		
		$this->load->view('dashboard_view',$fragment);
	}

	/**
	* Metodo para obtener el id del siguiente registro 
	* dependiendo del catalogo
	*/
	public function getNextIdCat($tipoCat){
		$idCliente = $this->CatalogoGeneral_model->getIdCatalogoGeneral($tipoCat);
		$idCat = $idCliente->NUM_ID + 1;
		return $idCat;
	}

	/**
	* Metodo para guardar la informacion
	* de algunos de los siguientes catalogos
	* clientes, proveedores, propietarios
	* @param apellido paterno
	* @param apellido materno
	* @param nombre o nombres
	* @param razon social
	* @param rfc del cliente
	* @param calle del cliente
	* @param col del cliente
	* @param codigo postal del cliente
	* @param estado del cliente
	* @param celular del cliente
	* @param telefono del cliente
	* @param email del cliente
	* @param tipo de persona fiscal
	* @param dias de entrega
	* @param tipo de catalogo en el que se guarde
	*/
	public function saveInfoCat(){

		//se declaran los parametros
		$appCli = $this->input->post("paterno");
		$apmCli = $this->input->post("materno");
		$nameCli = $this->input->post("nombre");
		$razonCli = $this->input->post("social");
		$rfcCli = $this->input->post("rfc");
		$calleCli = $this->input->post("calle");
		$colCli = $this->input->post("col");
		$cpCli = $this->input->post("cp");
		$estadoCli = $this->input->post("estado");
		$celCli = $this->input->post("cel");
		$telCli = $this->input->post("tel");
		$emailCli = $this->input->post("email");
		$tipoPerCli = $this->input->post("tipoPer");
		$numDiasEntrega = $this->input->post("diasEntrega");
		$tipoInsert = $this->input->post("tipoSave");
		$jsonCatalogo = array();
		$responseSavejson = array();

		// hace la asociacion de los parametros
		$jsonCatalogo['APaterno'] = $appCli;
		$jsonCatalogo['AMaterno'] = $apmCli;
		$jsonCatalogo['Nombres'] = $nameCli;
		$jsonCatalogo['RazonSocial'] = $razonCli;
		$jsonCatalogo['RFC'] = $rfcCli;
		$jsonCatalogo['Calle'] = $calleCli;
		$jsonCatalogo['Colonia'] = $colCli;
		$jsonCatalogo['CP'] = $cpCli;
		$jsonCatalogo['Estado'] = $estadoCli;
		$jsonCatalogo['Celular'] = $celCli;
		$jsonCatalogo['Telefono'] = $telCli;
		$jsonCatalogo['email'] = $emailCli;
		$jsonCatalogo['Tipo_Persona'] = $tipoPerCli;
		$jsonCatalogo['Estatus'] = '1';

		// si es de tipo proveedor se agrega este campo al insert
		if($tipoInsert == 'B'){
			$jsonCatalogo['Dias_Entrega'] = $numDiasEntrega;
		}

		$validacionCompleta = FALSE;

		// A = cliente , B Proveedor, C Propietario
		switch ($tipoInsert) {
			case 'A':
				// guardar info de Clientes
				$pasoValiCli = $this->validaCliAndProv($jsonCatalogo,'A');
				if($pasoValiCli != ""){
					$responseSavejson['response_code'] = '400';
					$responseSavejson['response_msg'] = 'El campo '.$pasoValiCli.' No puede estar vacio!';
				}else{
					$validacionCompleta = TRUE;
				}
				break;
			case 'B':
				// guardar info de Proveedores
				$pasoValiProv = $this->validaCliAndProv($jsonCatalogo,'B');
				if($pasoValiProv != ""){
					$responseSavejson['response_code'] = '400';
					$responseSavejson['response_msg'] = 'El campo '.$pasoValiProv.' No puede estar vacio!';
				}else{
					$validacionCompleta = TRUE;
				}
				break;
			case 'C':
				// guardar info de Propietarios.
				$pasoValiProp = $this->validaPropietario($jsonCatalogo);
				if($pasoValiProp != ""){
					$responseSavejson['response_code'] = '400';
					$responseSavejson['response_msg'] = 'El campo '.$pasoValiProp.' No puede estar vacio!';
				}else{
					$validacionCompleta = TRUE;
				}
				break;
		}

		//si la validacion es completa se prcede a guardar la info
		if($validacionCompleta){
			if($this->CatalogoGeneral_model->saveCatGnral($jsonCatalogo,$tipoInsert)){
				$responseSavejson['catalogos'] = $this->CatalogoGeneral_model->getCatalogoGeneral($tipoInsert);
				$responseSavejson['nextIdCat'] = $this->getNextIdCat($tipoInsert);
				$responseSavejson['response_code'] = '200';
				$responseSavejson['response_msg'] = 'Operacion exitosa!';
			}else{
				$responseSavejson['response_code'] = '400';
				$responseSavejson['response_msg'] = 'Algo salio mal!';
			}
		}

		echo json_encode($responseSavejson);
	}

	/**
	* Metodo para hacer las validaciones de los campos
	* que se requiere dependiendo del catalogo que se guarde
	* si es un cliente el tipo sera A, si es un proveedor
	* el tipo sera B
	* @param $tipo 'A' o 'B'
	* @param $datosCliProv array[]
	*/
	public function validaCliAndProv($datosCliProv,$tipo){
		
		$campoNoValido = "";

		if($datosCliProv['Nombres'] == NULL || $datosCliProv['Nombres'] == ""){
			$campoNoValido = "Nombre";
		}

		// si es tipo cliente 'A' se validan los apellidos
		if($tipo == 'A'){
			if($datosCliProv['APaterno'] == NULL || $datosCliProv['APaterno'] == ""){
				$campoNoValido = "Apellido paterno";	
			}

			if($datosCliProv['AMaterno'] == NULL || $datosCliProv['AMaterno'] == ""){
				$campoNoValido = "Apellido materno";	
			}
		}

		if($datosCliProv['RazonSocial'] == NULL || $datosCliProv['RazonSocial'] == ""){
			$campoNoValido = "Razon social";	
		}

		if($datosCliProv['RFC'] == NULL || $datosCliProv['RFC'] == ""){
			$campoNoValido = "RFC";	
		}

		if($datosCliProv['Calle'] == NULL || $datosCliProv['Calle'] == ""){
			$campoNoValido = "Calle";	
		}

		if($datosCliProv['Colonia'] == NULL || $datosCliProv['Colonia'] == ""){
			$campoNoValido = "Colonia";	
		}

		if($datosCliProv['CP'] == NULL || $datosCliProv['CP'] == ""){
			$campoNoValido = "CP (codigo postal)";	
		}

		if($datosCliProv['Estado'] == NULL || $datosCliProv['Estado'] == ""){
			$campoNoValido = "Estado";	
		}

		if($datosCliProv['Celular'] == NULL || $datosCliProv['Celular'] == ""){
			$campoNoValido = "Celular";	
		}

		if($datosCliProv['email'] == NULL || $datosCliProv['email'] == ""){
			$campoNoValido = "Email";	
		}

		if($datosCliProv['Tipo_Persona'] == NULL || $datosCliProv['Tipo_Persona'] == ""){
			$campoNoValido = "Tipo Persona";	
		}

		// si es tipo proveedor 'B' se valida el campo de numero de dias de entrega
		if($tipo == 'B'){
			if($datosCliProv['Dias_Entrega'] == NULL || $datosCliProv['Dias_Entrega'] == ""){
				$campoNoValido = "Numero de dias de entrega";	
			}
		}

		return $campoNoValido;
	}

	/**
	* Metodo para validar los campos requeridos
	* del catalgogo de propietarios
	* @param $datosProp array['Nombres','RazonSocial','RFC','Tipo_Persona']
	*/
	public function validaPropietario($datosProp){
		
		$campoNoValido = '';

		if($datosProp['Nombres'] == NULL || $datosProp['Nombres'] == ""){
			$campoNoValido = "Nombre";
		}

		if($datosProp['RazonSocial'] == NULL || $datosProp['RazonSocial'] == ""){
			$campoNoValido = "Razon social";	
		}

		if($datosProp['RFC'] == NULL || $datosProp['RFC'] == ""){
			$campoNoValido = "RFC";	
		}

		if($datosProp['Tipo_Persona'] == NULL || $datosProp['Tipo_Persona'] == ""){
			$campoNoValido = "Tipo Persona";	
		}

		return $campoNoValido;
	}

	/**
	* Metodo para hacer las los cambios de estatus 
	* o las modificaciones de los campos correspondientes
	*/
	public function updateInfoCat(){

		$tipoUpdate = $this->input->post("tipoUp");
		$tipoDeCat = $this->input->post("tipoCat");
		$idCatRow = $this->input->post("idRowCat");
		//datos del formulario
		$appCliEdt = $this->input->post("paterno");
		$apmCliEdt = $this->input->post("materno");
		$nameCliEdt = $this->input->post("nombre");
		$razonCliEdt = $this->input->post("social");
		$rfcCliEdt = $this->input->post("rfc");
		$calleCliEdt = $this->input->post("calle");
		$colCliEdt = $this->input->post("col");
		$cpCliEdt = $this->input->post("cp");
		$estadoCliEdt = $this->input->post("estado");
		$celCliEdt = $this->input->post("cel");
		$telCliEdt = $this->input->post("tel");
		$emailCliEdt = $this->input->post("email");
		$tipoPerCliEdt = $this->input->post("tipoPer");
		$numDiasEntregaEdt = $this->input->post("diasEntrega");

		$jsonUpdateCat = array();
		$infoUpdateCat = array();

		if($tipoUpdate == 'D'){

			$infoUpdateCat['Estatus'] = '0';
			$jsonUpdateCat['response_msg'] = 'Baja exitosa!';

		}else{

			//los demas campos a actualizar
			$infoUpdateCat['APaterno'] = $appCliEdt;
			$infoUpdateCat['AMaterno'] = $apmCliEdt;
			$infoUpdateCat['Nombres'] = $nameCliEdt;
			$infoUpdateCat['RazonSocial'] = $razonCliEdt;
			$infoUpdateCat['RFC'] = $rfcCliEdt;
			$infoUpdateCat['Calle'] = $calleCliEdt;
			$infoUpdateCat['Colonia'] = $colCliEdt;
			$infoUpdateCat['CP'] = $cpCliEdt;
			$infoUpdateCat['Estado'] = $estadoCliEdt;
			$infoUpdateCat['Celular'] = $celCliEdt;
			$infoUpdateCat['Telefono'] = $telCliEdt;
			$infoUpdateCat['email'] = $emailCliEdt;
			$infoUpdateCat['Tipo_Persona'] = $tipoPerCliEdt;

			//si el catalogo a actualizar es el de proveedores se agrega este campo
			if($tipoDeCat == 'B'){
				$infoUpdateCat['Dias_Entrega'] = $numDiasEntregaEdt;
			}

			$jsonUpdateCat['response_msg'] = 'Actualizacion exitosa!';
		}

		if($this->CatalogoGeneral_model->updateCatGnral($infoUpdateCat,$tipoDeCat,$idCatRow)){
			$jsonUpdateCat['response_code'] = '200';
		}else{
			$jsonUpdateCat['response_code'] = '400';
			$jsonUpdateCat['response_msg'] = 'Ocurrio un error durante la ejecucion!';
		}
		echo json_encode($jsonUpdateCat);
	}

	/**
	* metodo para obtener la informacion de un
	* cliente por el id
	* @param idRowCat
	* @param tipoSelectCat
	*/
	public function selectInfoCat(){
		
		$idSearch = $this->input->post('idRowCat');
		$catSearch = $this->input->post('tipoSelectCat');
		$jsonRowCat = array();

		$jsonRowCat['cliente'] = $this->CatalogoGeneral_model->selectRowCatById($catSearch,$idSearch);
		$jsonRowCat['response_code'] = '200';
		$jsonRowCat['response_msg'] = 'Operacion exitosa!';

		echo json_encode($jsonRowCat);
	}
}

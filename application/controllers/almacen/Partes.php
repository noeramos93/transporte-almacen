<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el ABC de 
* de partes
* @author Ing. Noe Ramo Lopez
* @version 1.0 
* @copyright Todos los derechos reservados 2019
*/
class Partes extends CI_Controller {
	/**
	* Constrcutor de la clase partes.
	*/
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('name') == FALSE){
            $this->session->set_flashdata("error","sesion invalida");
            redirect("Login");
        }
		//para las consultas a las tablas de almacen
		$this->load->model('CatalogoAlmacen_model');
		//para las consultas a las tablas de generales
		$this->load->model('CatalogoGeneral_model');
		//para las consultas de las partes
		$this->load->model('Partes_model');
	}

	/**
	* Metodo para cargar la vista incial de
	* las partes
	*/
	public function index(){
		$datosPartes = array();
		$datosPartes['tiposInv'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('B');
		$datosPartes['almacenes'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('C');
		$datosPartes['ubicaciones'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('A');

		$datosPartes['idPart'] = $this->genIdNext('B');
		$datosPartes['proveedores'] = $this->CatalogoGeneral_model->getCatalogoGeneral('B');

		$fragment = array();
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('almacen/parte_view',$datosPartes,TRUE);
		$fragment['jsLibs'] = ['js/partes.js'];
		
		$this->load->view('dashboard_view',$fragment);
	}

	public function genIdNext($catalogo){
		$idTable = $this->CatalogoAlmacen_model->getIdTableAlm($catalogo);
		$idCat = $idTable->NUM_ID + 1;
		return $idCat;
	}


	public function saveParte(){

		$idParte = $this->input->post('id_parte');
		$fchAlta = $this->input->post('fch_alta');
		$codAlt = $this->input->post('cod_alter');
		$tipoInv = $this->input->post('tipo_invt');
		$dscParte = $this->input->post('dsc_txt');
		$fichaTec = $this->input->post('fch_tec');
		$minPart = $this->input->post('min_part');
		$maxPart = $this->input->post('max_part');
		$ptoPart = $this->input->post('re_ord');
		$costRepoPart = $this->input->post('cost_repo');
		$ultCostPart = $this->input->post('ult_cost');
		$ultFchCompPart = $this->input->post('ult_comp');
		$tipOperacion = $this->input->post('tip_oper'); // 'A' actualizacion , 'S' guardar
 
		$validInfoParte = TRUE;
		$jsonSave = array();
		$infoParte = array();

		if($fchAlta == NULL || $fchAlta == ""){
			$validInfoParte = FALSE;
			$jsonSave['response_code'] = '201';
			$jsonSave['response_msg'] = 'El campo de fecha de alta no puede estar vacio!';
		}

		if($codAlt == NULL || $codAlt == ""){
			$validInfoParte = FALSE;
			$jsonSave['response_code'] = '201';
			$jsonSave['response_msg'] = 'El campo codigo alterno no puede estar vacio!';
		}

		if($tipoInv == NULL || $tipoInv == ""){
			$validInfoParte = FALSE;
			$jsonSave['response_code'] = '201';
			$jsonSave['response_msg'] = 'El campo tipo de inventario no puede estar vacio!';
		}

		if($dscParte == NULL || $dscParte == ""){
			$validInfoParte = FALSE;
			$jsonSave['response_code'] = '201';
			$jsonSave['response_msg'] = 'El campo descripcion no puede estar vacio!';
		}

		if($fichaTec == NULL || $fichaTec == ""){
			$validInfoParte = FALSE;
			$jsonSave['response_code'] = '201';
			$jsonSave['response_msg'] = 'El campo ficha tecnica no puede estar vacio!';
		}

		if($minPart == NULL || $minPart == ""){
			$validInfoParte = FALSE;
			$jsonSave['response_code'] = '201';
			$jsonSave['response_msg'] = 'El campo Minimo no puede estar vacio!';
		}

		if($maxPart == NULL || $maxPart == ""){
			$validInfoParte = FALSE;
			$jsonSave['response_code'] = '201';
			$jsonSave['response_msg'] = 'El campo Maximo no puede estar vacio!';
		}

		if($ptoPart == NULL || $ptoPart == ""){
			$validInfoParte = FALSE;
			$jsonSave['response_code'] = '201';
			$jsonSave['response_msg'] = 'El campo Punto de reorden no puede estar vacio!';
		}

		if($costRepoPart == NULL || $costRepoPart == ""){
			$validInfoParte = FALSE;
			$jsonSave['response_code'] = '201';
			$jsonSave['response_msg'] = 'El campo Costo de reposicion no puede estar vacio!';
		}

		if($ultCostPart == NULL || $ultCostPart == ""){
			$validInfoParte = FALSE;
			$jsonSave['response_code'] = '201';
			$jsonSave['response_msg'] = 'El campo Ultimo costo no puede estar vacio!';
		}

		if($ultFchCompPart == NULL || $ultFchCompPart == ""){			
			$validInfoParte = FALSE;
			$jsonSave['response_code'] = '201';
			$jsonSave['response_msg'] = 'El campo Ultima compra no puede estar vacio!';
		}

		if($validInfoParte){

			$infoParte['Codigo_Alterno'] = $codAlt;
			$infoParte['Descripcion'] = $dscParte;
			$infoParte['Ficha_Tecnica'] = $fichaTec;
			$infoParte['Id_Tipo'] = $tipoInv;
			$infoParte['Minimo'] = $minPart;
			$infoParte['Maixmo'] = $maxPart;
			$infoParte['Punto_Reorden'] = $ptoPart;
			$infoParte['Costo_Reposicion'] = $costRepoPart;
			$infoParte['Ultimo_Costo'] = $ultCostPart;
			$infoParte['Fecha_UltimaCompra'] = $ultFchCompPart;

			if($this->CatalogoAlmacen_model->saveInfoPart($infoParte,$tipOperacion,$idParte)){
				
				$jsonSave['idParteNew'] = $this->genIdNext('B');
				$jsonSave['response_code'] = '200';

				if($tipOperacion == 'A'){
					$jsonSave['response_msg'] = 'Se actualizo correctamente!';
				}else if($tipOperacion == 'S'){
					$jsonSave['response_msg'] = 'Se guardo con exito la informacion!';
				}

			}else{
				$jsonSave['response_code'] = '201';
				$jsonSave['response_msg'] = 'Ocurrio un erro al guardar la info!';
			}
		}
		
		echo json_encode($jsonSave);
	}

	/**
	* Metodo para obtener la informacion del proveedor
	* para mostrarlo en la tabla de proveedores relacionados
	* con la parte que se busca, recibe el id del proveedor
	* @param id_prov
	*/
	public function getInfoProv(){
		$idProv = $this->input->post('id_prov');
		$jsonProv = array();

		if($idProv == NULL || $idProv == ""){
			$jsonProv['response_code'] = "200"; 
			$jsonProv['response_msg'] = "el id de busqueda es nulo";
		}else{
			$jsonProv['response_code'] = "200";
			$jsonProv['response_msg'] = "Consulta exitosa";
			$jsonProv['proveedor'] = $this->CatalogoAlmacen_model->getProvById($idProv);			
		}
		echo json_encode($jsonProv);
	}

	/**
	* Metodo para obtener la info de una parte que se guardo previamente,
	* recibe el codigo alterno para emepzar la busqueda.
	* @param cod_alter
	*/
	public function getInfoPart(){
		$codigoAlterno = $this->input->post('cod_alter');
		$jsonInfoParte = array();
		if($codigoAlterno == "" || $codigoAlterno == NULL){
			$jsonInfoParte['response_code'] = "201";
			$jsonInfoParte['response_msg'] = "El codigo alterno esta vacio =(!";
		}else{
			
			$parteInfo = $this->CatalogoAlmacen_model->getParteByCod($codigoAlterno);
			if(!is_null($parteInfo)){
				$jsonInfoParte['response_code'] = "200";
				$jsonInfoParte['response_msg'] = 'operacion exitosa';
				$jsonInfoParte['infoParte'] = $parteInfo;

				$idParte = $jsonInfoParte['infoParte']->Id_Parte;
				$jsonInfoParte['proveedores'] = $this->CatalogoAlmacen_model->getRelProv($codigoAlterno);
				$jsonInfoParte['ubicaciones'] = $this->CatalogoAlmacen_model->getRelUbic($idParte);
			}else{
				$jsonInfoParte['idPart'] = $this->genIdNext('B');
				$jsonInfoParte['response_code'] = "201";
				$jsonInfoParte['response_msg'] = 'no se encontro informacion';
			}
		}
		echo json_encode($jsonInfoParte);
	}

	/**
	* Metodo para obtener el catalogo de ubicaciones
	* recibe el id de la ubicaicon del nivel 1
	* param @param id_nv1 
	*/
	public function getUbicNv(){
		
		$nv1 = $this->input->post('id_nv1');
		$jsonNv1 = array();

		if($nv1 == NULL || $nv1 == ""){
			$jsonNv1['response_code'] = "201";
			$jsonNv1['response_msg'] = "El nv 1 no puede estar boorado";
		}else{
			$jsonNv1['response_code'] = "200";
			$jsonNv1['response_msg'] = "Exito!";
			$jsonNv1['nvlUbic'] = $this->CatalogoAlmacen_model->getCatalogoAlmacen('A');
		}
		echo json_encode($jsonNv1);
	}


	/**
	* metodo para gaurdar la relacion de una parte
	* con un proveedor
	* @param id_parte
	* @param id_proveedor
	* @param codigo_proveedor
	* @param es_principal
	*/
	public function saveRelPartProv(){

		$idParte = $this->input->post('id_part');
		$idProv = $this->input->post('id_prov');
		$codAlterno = $this->input->post('cod_alterno');
		$isPrincipal = $this->input->post('is_principal');
		$camposValidos = TRUE;
		$jsonSaveRel = array();
		$infoRel = array();

		if($idParte == ""){
			$jsonSaveRel['response_code'] = "201";
			$jsonSaveRel['response_msg'] = "el id del proveedor esta vacio";
			$camposValidos = FALSE;
		}

		if($camposValidos){
			$esPrinc = 'N';
			if($isPrincipal == "Si"){
				$esPrinc = 'S';
			}

			$infoRel['Id_Parte'] = $idParte;
			$infoRel['Id_Proveedor'] = $idProv;
			$infoRel['Codigo_Proveedor'] = $codAlterno;
			$infoRel['EsPrincipal'] = $esPrinc;

			if($this->CatalogoAlmacen_model->saveInfoRelProv($infoRel)){
				$jsonSaveRel['response_code'] = "200";
				$jsonSaveRel['response_msg'] = "Operacion exitosa!.";
			}
		}

		echo json_encode($jsonSaveRel);
	}

	/**
	* Metodo para gaurdar la relacion entre una ubicacion
	* y una parte recibe el id del almacen, el id de la parte
	* el id del nivel1 y son opcionales el id del nivel 2, nivel 3
	* y nivel 4.
	* @param ID_SLC_ALM
	* @param ID_PARTE
	* @param ID_SLC_NV1
	* @param ID_SLC_NV2
	* @param ID_SLC_NV3
	* @param ID_SLC_NV4
	*/
	public function saveRelUbic(){
		
		$almId = $this->input->post('id_alm');
		$parteId = $this->input->post('id_parte');
		$nivel1 = $this->input->post('id_nv1');
		$nivel2 = $this->input->post('id_nv2');
		$nivel3 = $this->input->post('id_nv3');
		$nivel4 = $this->input->post('id_nv4');
		$isValidRel = TRUE;
		$jsonRelUbic = array();
		$infoRelUbic = array();

		if($almId == '0' || $almId == ""){
			$jsonRelUbic['response_code'] = '201';
			$jsonRelUbic['response_msg'] = 'El id del almacen no puede estar vacio!';
			$isValidRel = FALSE;
		}

		if($parteId == "" || $parteId == NULL){
			$jsonRelUbic['response_code'] = '201';
			$jsonRelUbic['response_msg'] = 'El id la parte no puede estar vacio!';
			$isValidRel = FALSE;
		}

		if($nivel1 == "" || $nivel1 == '0'){
			$jsonRelUbic['response_code'] = '201';
			$jsonRelUbic['response_msg'] = 'El nivel 1 no puede estar vacio!';
			$isValidRel = FALSE;
		}

		if($isValidRel){

			$infoRelUbic['Id_Parte'] = $parteId;
			$infoRelUbic['Id_Almacen'] = $almId;
			$infoRelUbic['UbiNivel1'] = $nivel1;
			$infoRelUbic['UbiNivel2'] = $nivel2;
			$infoRelUbic['UbiNivel3'] = $nivel3;
			$infoRelUbic['UbiNivel4'] = $nivel4;

			if($this->CatalogoAlmacen_model->saveRelUbic($infoRelUbic)){
				$jsonRelUbic['response_code'] = '200';
				$jsonRelUbic['response_msg'] = 'Operacion Exitosa';
			}
		}
		echo json_encode($jsonRelUbic);
	}


	public function dropRelProv(){
		$proveedor = $this->input->post('id_prov');
		$parte = $this->input->post('id_part');
		$tipo = $this->input->post('tipo_del');
		$jsonDropRel = array();
		// tipo proveedor
		if($tipo == 'P'){

			if($this->Partes_model->deleteRelProv($parte,$proveedor)){
				$jsonDropRel['response_code'] = '200';
				$jsonDropRel['response_msg'] = 'operacion exitosa';
			}
		//tipo ubicacion
		}else if($tipo == 'U'){

			if($this->Partes_model->deleteRelUbic($parte,$proveedor)){
				$jsonDropRel['response_code'] = '200';
				$jsonDropRel['response_msg'] = 'operacion exitosa';
			}
		}
		echo json_encode($jsonDropRel);
	}

	public function dropAllParte(){
		$parte = $this->input->post('id_parte');
		$jsonDeletePart = array();
		if($parte == NULL || $parte == ""){
			$jsonDeletePart['response_code'] == '201';
			$jsonDeletePart['response_msg'] == 'El id viene vacio';
		}else{
			//boorramos las ubicaciones
			if(!$this->Partes_model->dropUbc($parte)){
				$jsonDeletePart['response_code'] == '201';
				$jsonDeletePart['response_msg'] == 'no se pudo borrar la ubicaicon';
			}
			//boorramos los proveedores
			if(!$this->Partes_model->dropProv($parte)){
				$jsonDeletePart['response_code'] == '201';
				$jsonDeletePart['response_msg'] == 'no se pudo borrar el proveedor';
			}
			//boorramos la parte
			if(!$this->Partes_model->dropParte($parte)){
				$jsonDeletePart['response_code'] == '201';
				$jsonDeletePart['response_msg'] == 'no se pudo borrar la parte';
			}else{
				$jsonDeletePart['response_code'] == '200';
				$jsonDeletePart['response_msg'] == 'Operacion exitosa';
				$jsonDeletePart['idPart'] = $this->genIdNext('B');
			}
		}
		echo json_encode($jsonDeletePart);
	}
}

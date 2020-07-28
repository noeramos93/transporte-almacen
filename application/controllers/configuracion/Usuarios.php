<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el ABC de 
* de usuarios
* @author Ing. Noe Ramo Lopez
* @version 1.0 
* @copyright Todos los derechos reservados 2019
*/
class Usuarios extends CI_Controller {

	/**
	* Metodo constructor de la clase 
	* usuarios, carga el modelo
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
	* Metodo para cargar la vista inicial
	* de los usuarios.
	*/
	public function index(){
		$datosUsuario = array();
		$datosUsuario['usuarios'] = $this->Configuracion_model->getRelUsuario();
		$datosUsuario['roles'] = $this->Configuracion_model->getCatConfig(0,'A',0);
		$datosUsuario['departamentos'] = $this->Configuracion_model->getCatConfig(0,'D',0);

		$fragment = array();
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('configuracion/usuario_view',$datosUsuario,TRUE);
		$fragment['jsLibs'] = ['js/usuarios.js'];
		$this->load->view('dashboard_view',$fragment);
	}

	/**
	* Metodo para guardar la informacion de los usuarios
	* o actualizar la informacion de un usuario.
	* @param tipo_action
	* @param id_usu
	* @param usu_name
	* @param app_usu
	* @param apm_usu
	* @param name_usu
	* @param email_usu
	* @param pass_usu
	* @param rol_usu
	* @param depa_usu
	* @return json[response_code, response_msg, lista de usuarios]
	*/
	public function saveInfoUsu(){

		$tipoAction = $this->input->post('tipo_action');
		$idUsu = $this->input->post('id_usu');
		$usuario = $this->input->post('usu_name');
		$apellidoP = $this->input->post('app_usu');
		$apellidoM = $this->input->post('apm_usu');
		$nombre = $this->input->post('name_usu');
		$email = $this->input->post('email_usu');
		$password = $this->input->post('pass_usu');
		$rolUsu = $this->input->post('rol_usu');
		$depUsu = $this->input->post('depa_usu');

		$jsonSaveUsu = array();
		$camposValid = TRUE;

		if($usuario == NULL || $usuario == ""){
			$camposValid == FALSE;
			$jsonSaveUsu['response_code'] = '201';
			$jsonSaveUsu['response_msg'] = 'el usuario no puede estar vacio';
		}

		if($nombre == NULL || $nombre == ""){
			$camposValid == FALSE;
			$jsonSaveUsu['response_code'] = '201';
			$jsonSaveUsu['response_msg'] = 'el nombre(s) del usuario no puede estar vacio';
		}

		if($email == NULL || $email == ""){
			$camposValid == FALSE;
			$jsonSaveUsu['response_code'] = '201';
			$jsonSaveUsu['response_msg'] = 'el email del usuario no puede estar vacio';
		}

		//si es diferente de una actualizacion validamos si no esta vacio el passowrd
		if($tipoAction != 'A'){

			if($password == NULL || $password == ""){
				$camposValid == FALSE;
				$jsonSaveUsu['response_code'] = '201';
				$jsonSaveUsu['response_msg'] = 'el password del usuario no puede estar vacio';
			}
		}

		if($rolUsu == '0' || $rolUsu == ""){
			$camposValid == FALSE;
			$jsonSaveUsu['response_code'] = '201';
			$jsonSaveUsu['response_msg'] = 'el rol del usuario no puede estar vacio';
		}

		if($depUsu == '0' || $depUsu == ""){
			$camposValid == FALSE;
			$jsonSaveUsu['response_code'] = '201';
			$jsonSaveUsu['response_msg'] = 'el departamento del usuario no puede estar vacio';
		}


		if($camposValid){

			$encriptPass = hash('sha256',$password,FALSE);
			$nameComplete = $nombre." ".$apellidoP." ".$apellidoM;

			$infoUsu = array();
			$infoUsu['usuario'] = $usuario;
			// si el password es diferente de nulo se agrega el campo
			if($password != ""){
				$infoUsu['Password'] = $encriptPass;
			}
			$infoUsu['Nombre'] = $nameComplete;
			$infoUsu['email'] = $email;
			$infoUsu['Activo'] = 'Activo';
			$infoUsu['Id_Rol'] = $rolUsu;
			$infoUsu['Id_Departamento'] = $depUsu;

			//actualizacion
			if($tipoAction == 'A'){
				$this->Configuracion_model->saveOrUpdateUsu($infoUsu,$idUsu,$tipoAction);
				$jsonSaveUsu['response_code'] = '200';
				$jsonSaveUsu['response_msg'] = 'Actualizacion exitosa';
				$jsonSaveUsu['usuarios'] = $this->Configuracion_model->getRelUsuario();
			//guardar la informacion
			}else{
				$this->Configuracion_model->saveOrUpdateUsu($infoUsu,$idUsu,$tipoAction);
				$jsonSaveUsu['response_code'] = '200';
				$jsonSaveUsu['response_msg'] = 'Guardado exitoso';
				$jsonSaveUsu['usuarios'] = $this->Configuracion_model->getRelUsuario();
			}
		}
		echo json_encode($jsonSaveUsu);
	}

	/**
	* Metodo para hacer una baja logica de un usuario
	* @param idUsuario
	*/
	public function deleteUsuario(){
		
		$idUsu = $this->input->post('idUsuario');
		$jsonDeleteUs = array();

		if($idUsu == NULL || $idUsu == ""){
			$jsonDeleteUs['response_code'] = "201";
			$jsonDeleteUs['response_msg'] = "No puede estar vacio el id del usuario";
		}else{
			
			$tipoAction = 'A';
			$infoUsuDe = array();
			$infoUsuDe['Activo'] = 'Inactivo';

			if($this->Configuracion_model->saveOrUpdateUsu($infoUsuDe,$idUsu,$tipoAction)){
				$jsonDeleteUs['response_code'] = "200";
				$jsonDeleteUs['response_msg'] = "Operacion exitosa";
			}else{
				$jsonDeleteUs['response_code'] = "201";
				$jsonDeleteUs['response_msg'] = "No se pudo realizar la accion";
			}
		}
		echo json_encode($jsonDeleteUs);
	}

	/**
	* Metodo para obtener la informacion 
	* de un usario en base al id que se manda
	* @param idUsuario
	*/
	public function getInfoUsu(){
		
		$usuario = $this->input->post('idUsuario');
		$jsonUsuario = array();
		
		if($usuario == NULL || $usuario == ""){
			$jsonUsuario['response_code'] = '201';
			$jsonUsuario['response_msg'] = 'El usuario no puede estar vacio';
		}else{
			$jsonUsuario['response_code'] = '200';
			$jsonUsuario['response_msg'] = 'El usuario no puede estar vacio';
			$jsonUsuario['informacion'] = $this->Configuracion_model->getInformacionById($usuario);
		}
		echo json_encode($jsonUsuario);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el Logeo de los usuarios
* @author Ing.Noe Ramos
* @version 1.0
* @copyright Todos los derechos reservados 2019
*/
class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session'); 
		$this->load->model("Login_model");
	}
	/**
	* Metodo para cargar la vista del logeo
	*/
	public function index(){
		$this->load->view('login_view');
	}

	/**
	* Metodo para hacer las validaciones del
	* usuario que se loguea
	* @param txtEmail email del usuario
	* @param txtPass password del usuario
	*/
	public function userdo(){
		
		$userName = $this->input->post("txtEmail");
		$userPass = $this->input->post("txtPass");
		$encript = NULL;

		if($userName == NULL || $userPass == ""){
			$this->session->set_flashdata('error','LOS CAMPOS ESTAN VACIOS');
			redirect("Login");
		}else{

			$userInfo = $this->Login_model->validUser($userName);

			if(!is_null($userInfo)){
				$encript = hash('sha256',$userPass,FALSE);
				//die($encript);
				if($userInfo->Password == $encript){

					$datos_usuario = array(
						'id' => $userInfo->Id_Usuario,
						'name' => $userInfo->usuario
					);
					
                    $this->session->set_userdata($datos_usuario);

					redirect("Home");
				}else{
					$this->session->set_flashdata('error','LA CONTRASEÑA NO ES VALIDA');
					redirect("Login/");
				}
			}else{
				$this->session->set_flashdata('error','UNO DE LOS CAMPOS ESTA ERRONEO VERIFIQUE POR FAVOR');
				redirect("Login/");
			}
		}
	}

	/**
	* Metodo para destruir la sesion
	* del usario
	*/
	public function logaut(){

		$arr_sesiones = array();
		$arr_sesiones ['id'] = FALSE;
		$arr_sesiones ['name'] = FALSE;

		$this->session->sess_destroy();

		redirect("Login");
	}
}

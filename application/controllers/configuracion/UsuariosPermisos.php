<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el ABC de 
* de folios documentos
* @author Ing. Noe Ramo Lopez
* @version 1.0 
* @copyright Todos los derechos reservados 2019
*/
class UsuariosPermisos extends CI_Controller {

	/**
	* Metodo constructor de la clase 
	* usuarios permisos, carga el modelo
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
	* Metodo par acargar la vista inicial de
	* usuarios permisos.
	*/	
	public function index(){

		$datosUsuario = array();
		$datosUsuario['usuarios'] = $this->Configuracion_model->getCatConfig(0,'E',0);
		$relModulo = $this->Configuracion_model->getRelModPer();
		$relModPer = $this->Configuracion_model->getRelUsuPer();
		$datosUsuario['relPermisos'] = $this->generaTablaRelacion($relModulo,$relModPer);
		//die($this->generaTablaRelacion($relModulo,$relModPer));
		$fragment = array();
		$fragment['ccsLibs'] = NULL;
		$fragment['VISTA'] = $this->load->view('configuracion/usuario_permiso_view',$datosUsuario,TRUE);
		$fragment['jsLibs'] = ['js/usuarioPermiso.js'];
		$this->load->view('dashboard_view',$fragment);
	}

	/**
	* Metodo para construir las listas de la relacion modulo permiso
	* @param $relacion1 modulos que estan en la relacion
	* @param $relacion2 relacion permiso modulo que este relacionados
	* @return String con las construccion HTML y las clases necesarias
	*/
	public function generaTablaRelacion($relacion1,$relacion2){

		//iniamos la lista
		$completeList = "";

		for ($i=0; $i < count($relacion1); $i++) {
			$completeList = $completeList."<div class='col-md-3'>".
											"<div class='accordion accordion-primary' id='accordion".$i."'>".
												"<div class='accordion-item'>".
													"<div class='accordion-title'>". 
														"<a class='h6 mb-0' data-toggle='collapse' href='#collapse-".$i."'>".
															$relacion1[$i]->Nombre.
														"</a>".
													"</div>".
												"<div class='collapse show' id='collapse-".$i."' data-parent='#accordion".$i."'>";
			
			for ($j=0; $j < count($relacion2); $j++) { 
				
				if($relacion1[$i]->Id_Modulo == $relacion2[$j]->Id_Modulo){
					$completeList = $completeList."<div class='accordion-content'> <input id='checkPer-".$relacion2[$j]->Id_Relacion."' type='checkbox' class='check-permiso'> <label for='check-".$j."'>".$relacion2[$j]->Permiso."</label></div>";
				}
			}
			$completeList = $completeList."</div> </div> </div> </div> ";
		}
		
		return $completeList;
	}

	public function getRelPerUsu(){
		
		$usuario = $this->input->post('id_usuario');
		$jsonGetRel = array();
		$infoRelacion = array();
		
		if($usuario == NULL || $usuario == ""){
			$jsonGetRel['response_code'] = "201";
			$jsonGetRel['response_msg'] = "el usuario no puede estar vacio";
		}else{
			$jsonGetRel['response_code'] = "200";
			$jsonGetRel['response_msg'] = "operacion exitosa";
			//obtenemos los permisos para poder buscarlos en la tabla de relacion
			$releacionPermisos = $this->Configuracion_model->getPermisoUsuarios($usuario);

			if(is_array($releacionPermisos)){
				$numPermisos = count($releacionPermisos);
			}else{
				$numPermisos = 0;
			}

			for($i=0; $i < $numPermisos; $i++){
				
				$mod = $releacionPermisos[$i]->Id_Modulo;
				$per = $releacionPermisos[$i]->Id_Permiso;

				$relacion = $this->Configuracion_model->getRelacionPermiso($mod,$per);
				
				if(!is_null($relacion)){
					array_push($infoRelacion, $relacion);
				}
			}
			$jsonGetRel['relacionesPermisos'] = $infoRelacion;
		}

		echo json_encode($jsonGetRel);
	}

	/**
	* Metodo para crear la relacion de los permisos
	* que va a tener un usuario
	* @param id_rel_per
	* @param id_usuario
	* @param status_rel
	*/
	public function addRelModPer(){
		
		$idPer = $this->input->post('id_rel_per');
		$idUsuario = $this->input->post('id_usuario');
		$estatusRel = $this->input->post('status_rel');
		$jsonAddrel = array();
		$infoRel = array();
		if($idUsuario == NULL || $idUsuario == ""){
			$jsonAddrel['response_code'] = "201";
			$jsonAddrel['response_msg'] = "debe de seleccionar un usario para la relacion";
		}else{
			$relacion = $this->Configuracion_model->getIdRelByPer($idPer);

			if(!is_null($relacion)){

				if($estatusRel == "true"){

					$infoRel['Id_Usuario'] = $idUsuario;
					$infoRel['Id_Modulo'] = $relacion->Id_Modulo;
					$infoRel['Id_Permiso'] = $relacion->Id_Permiso;

					if($this->Configuracion_model->saveRelPerUser($infoRel)){
						$jsonAddrel['response_code'] = "200";
						$jsonAddrel['response_msg'] = "permiso asigando";		
					}
				}else{
					
					$modulo = $relacion->Id_Modulo;
					$permiso = $relacion->Id_Permiso;
					
					if($this->Configuracion_model->deleteRelPerUser( $idUsuario, $modulo, $permiso )){
						$jsonAddrel['response_code'] = "200";
						$jsonAddrel['response_msg'] = "permiso asigando";		
					}
				}
			}else{
				$jsonAddrel['response_code'] = "201";
				$jsonAddrel['response_msg'] = "la relacion  no existe";
			}
		}

		echo json_encode($jsonAddrel);
	}
}

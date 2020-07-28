<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el catalogo de ubicaciones
* @author Ing.Noe Ramos
* @version 1.0
* @copyright Todos los derechos reservados 2019
*/
class Ubicacion_model extends CI_Model{
	/**
	* Funcion para el constructor de Login_model
	*/
	public function __construct(){
		$this->load->database();
	}

	/**
	* Metodo para guardar una nueva ubicacion
	* recibe un array con los campos a ingresar
	* @param $infoUbic []
	*/
	public function saveInfoUbic($infoUbic){
		$this->db->set('created_at','NOW()',FALSE);
        $this->db->set('updated_at','NOW()',FALSE);
		$this->db->insert('almUbicaciones',$infoUbic);
		return TRUE;
	}

	/**
	* Metodo para hacer la actualizacion de 
	* las ubicaicones del catalogo, recibe la informacion
	* a actualizar y el id al cual se le hara la actualizacion
	* @param $info
	* @param $idUbic
	*/
	public function updInfoUbic($info, $idUbc){
		$this->db->set('updated_at','NOW()',FALSE);
		$this->db->where('Id_Ubicacion',$idUbc);
		$this->db->update('almUbicaciones',$info);

		return TRUE;
	}
}
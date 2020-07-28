<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el Logeo de los usuarios
* @author Ing.Noe Ramos
* @version 1.0
* @copyright Todos los derechos reservados 2019
*/
class Login_model extends CI_Model{
	/**
	* Funcion para el constructor de Login_model
	*/
	public function __construct(){
		$this->load->database();
	}

	/**
	* Funcion para verificar si exite el nombre de usuario en la base
	*@param name
	*@return arreglo de la informacion de un usario
	*/
	public function validUser($name){

		$this->db->select('Id_Usuario, usuario, Password, email');
		$this->db->from('cfgUsuarios');
		$this->db->where('email',$name);
		$this->db->where('Activo','Activo');
		$query = $this->db->get();
		return ($query->num_rows() <= 0) ? NULL : $query->row(); 
	}

}

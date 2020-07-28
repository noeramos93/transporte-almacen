<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el catalogo de partes
* @author Ing.Noe Ramos
* @version 1.0
* @copyright Todos los derechos reservados 2019
*/
class Partes_model extends CI_Model{
	/**
	* Funcion para el constructor de Login_model
	*/
	public function __construct(){
		$this->load->database();
	}

	public function deleteRelProv($parte,$proveedor){
		$this->db->where('Id_Proveedor',$proveedor);
		$this->db->where('Id_Parte',$parte);
		$this->db->delete('almPartes_Proveedores');
		return TRUE;
	}

	public function deleteRelUbic($parte,$almacen){
		$this->db->where('Id_Parte',$parte);
		$this->db->where('Id_Almacen',$almacen);
		$this->db->delete('almPartes_Ubicaciones');	
		return TRUE;
	}

	public function dropUbc($parte){
		$this->db->where('Id_Parte',$parte);
		$this->db->delete('almPartes_Ubicaciones');	
		return TRUE;
	}

	public function dropProv($parte){
		$this->db->where('Id_Parte',$parte);
		$this->db->delete('almPartes_Proveedores');
		return TRUE;
	}

	public function dropParte($parte){
		$this->db->where('Id_Parte',$parte);
		$this->db->delete('almPartes');
		return TRUE;
	}
}
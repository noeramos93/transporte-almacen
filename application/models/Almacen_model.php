<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el catalogo de almacenes
* @author Ing.Noe Ramos
* @version 1.0
* @copyright Todos los derechos reservados 2019
*/
class Almacen_model extends CI_Model{
	/**
	* Funcion para el constructor de Login_model
	*/
	public function __construct(){
		$this->load->database();
	}

	/**
	* Metodo para obtener la informacion de un almacen
	* en base al id que se le mande
	* @param $idAlm
	*/
	public function getInfoAlmById($idAlm){
		$this->db->select('Id_Almacen, Nombre');
        $this->db->from('almAlmacenes');
        $this->db->where('Id_Almacen',$idAlm);

        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
	}

	/**
	* Metodo para guardar un nuevo almacen
	* recibe un array con los campos a ingresar
	* @param $infoAlm []
	*/
	public function saveInfoAlm($infoAlm){
		$this->db->set('created_at','NOW()',FALSE);
        $this->db->set('updated_at','NOW()',FALSE);
		$this->db->insert('almAlmacenes',$infoAlm);
		return TRUE;
	}

	/**
	* Metodo para hacer la actualizacion de 
	* un almacen del catalogo, recibe la informacion
	* a actualizar y el id al cual se le hara la actualizacion
	* @param $info
	* @param $idAlm
	*/
	public function updInfoAlm($info, $idAlm){
		$this->db->set('updated_at','NOW()',FALSE);
		$this->db->where('Id_Almacen',$idAlm);
		$this->db->update('almAlmacenes',$info);

		return TRUE;
	}
}
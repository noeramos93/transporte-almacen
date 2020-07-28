<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el catalogo de tipo de movimientos
* @author Ing.Noe Ramos
* @version 1.0
* @copyright Todos los derechos reservados 2019
*/
class TipoMov_model extends CI_Model{
	/**
	* Funcion para el constructor de Login_model
	*/
	public function __construct(){
		$this->load->database();
	}

	/**
	* Metodo para obtener la informacion de un tipo de movimiento
	* en base al id que se le mande
	* @param $idTipMov
	*/
	public function getInfoTipMovById($idTipMov){
		$this->db->select('Id_TipoMov, Nombre');
        $this->db->from('almTipos_Mov_Almacen');
        $this->db->where('Id_TipoMov',$idTipMov);

        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
	}

	/**
	* Metodo para guardar un nuevo tipo de movimiento
	* recibe un array con los campos a ingresar
	* @param $infoTipMov []
	*/
	public function saveInfoTipMov($infoTipMov){
		$this->db->set('created_at','NOW()',FALSE);
        $this->db->set('updated_at','NOW()',FALSE);
		$this->db->insert('almTipos_Mov_Almacen',$infoTipMov);
		return TRUE;
	}

	/**
	* Metodo para hacer la actualizacion de 
	* un tipo de movimiento del catalogo, recibe la informacion
	* a actualizar y el id al cual se le hara la actualizacion
	* @param $info
	* @param $idAlm
	*/
	public function updInfoAlm($info, $idAlm){
		$this->db->set('updated_at','NOW()',FALSE);
		$this->db->where('Id_TipoMov',$idAlm);
		$this->db->update('almTipos_Mov_Almacen',$info);

		return TRUE;
	}
}
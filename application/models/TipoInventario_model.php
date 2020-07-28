<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para el catalogo de tipo de inventarios
* @author Ing.Noe Ramos
* @version 1.0
* @copyright Todos los derechos reservados 2019
*/
class TipoInventario_model extends CI_Model{
	/**
	* Funcion para el constructor de Login_model
	*/
	public function __construct(){
		$this->load->database();
	}

	/**
	* Metodo para obtener la informacion de un tipo de 
	* inventario en base al id del tipo inventario
	* @param $idTipoInv
	*/
	public function getInfoTipInvById($idTipoInv){
		$this->db->select('Id_Tipo, Nombre');
        $this->db->from('almTipos_Inventario');
        $this->db->where('Id_Tipo',$idTipoInv);

        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
	}

	/**
	* Metodo para guardar un nuevo tipo de inventario
	* recibe un array con los campos a ingresar
	* @param $infoTipInv []
	*/
	public function saveInfoTipInv($infoTipInv){
		$this->db->set('created_at','NOW()',FALSE);
        $this->db->set('updated_at','NOW()',FALSE);
		$this->db->insert('almTipos_Inventario',$infoTipInv);
		return TRUE;
	}

	/**
	* Metodo para hacer la actualizacion de 
	* un tipo de inventario del catalogo, recibe la informacion
	* a actualizar y el id al cual se le hara la actualizacion
	* @param $info
	* @param $idTipInv
	*/
	public function updInfoTipInv($info, $idTipInv){
		$this->db->set('updated_at','NOW()',FALSE);
		$this->db->where('Id_Tipo',$idTipInv);
		$this->db->update('almTipos_Inventario',$info);

		return TRUE;
	}
}
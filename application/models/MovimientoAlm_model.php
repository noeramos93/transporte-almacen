<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Controlador para los movimeintos de almacen
* @author Ing.Noe Ramos
* @version 1.0
* @copyright Todos los derechos reservados 2019
*/
class MovimientoAlm_model extends CI_Model{
	/**
	* Funcion para el constructor de Login_model
	*/
	public function __construct(){
		$this->load->database();
	}

	/**
	* Metodo para obtener la lista de los movimeintos
	* que se tienen en la base de datos
	*/
	public function getMovimientos(){
		$this->db->select('Id_TipoMov, Nombre');
		$this->db->from('almTipos_Mov_Almacen');
		$this->db->where('Estatus','1');
		$query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->result();
	}

	/**
	* Metodo para obtener el listado de almacenes
	* que estan en la tabla
	*/
	public function getAlm(){
		$this->db->select('Id_Almacen, Nombre');
		$this->db->from('almAlmacenes');
		$this->db->where('Estatus','1');
		$query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->result();
	}

	/**
	* Metodo para cargar las partes existentes en el cardex
	* @return lista de partes
	*/
	public function getCardexElement(){
		$this->db->select('C.Id_Parte AS ID, P.Descripcion AS PARTE');
		$this->db->from('almCardex_Partes C');
		$this->db->join('almPartes P','C.Id_Parte = P.Id_Parte');
		$query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->result();
	}

	public function getNumCardex($idParte){
		$this->db->select('C.Id_Parte AS PARTE, P.Descripcion,Exis_Final,Costo');
		$this->db->from('almCardex_Partes C');
		$this->db->join('almPartes P','C.Id_Parte = P.Id_Parte');
		$this->db->where('C.Id_Parte',$idParte);
		$query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
	}

	/**
	* Metodo para guardar los datos en la tabla de 
	* ajustes de almacen
	* @param $datos
	*/
	public function saveMov($datos){
		
		$this->db->set('created_at','NOW()',FALSE);
        $this->db->set('updated_at','NOW()',FALSE);
		$this->db->insert('almAjuste_Almacen',$datos);

		return $this->db->insert_id();
	}

	/**
	* Metodo para obtener la informacion de un movimiento
	* con el filtro del folio y el numero de serio
	* @param $fol
	* @param $ser
	*/
	public function getInfoMovByFolSer($fol,$ser){
		$this->db->select('Id_Ajuste, Folio, Serie, Tipo, Id_TipoMov, Id_Almacen, Costotal, Observaciones, date_format(created_at,"%Y-%m-%d") AS Fecha');
		$this->db->from('almAjuste_Almacen');
		$this->db->where('Folio',$fol);
		$this->db->where('Serie',$ser);
		$query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
	}

	public function getInfoMovDetalle($idMov){
		$this->db->select('D.Id_Parte AS ID_PART ,Descripcion ,Cantidad, Costo, Costototal');
		$this->db->from('almDetalle_Ajustes D ');
		$this->db->join('almPartes P ', ' D.Id_Parte = P.Id_Parte ');
		$this->db->where('Id_Ajuste',$idMov);
		$query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->result();
	}

	/**
	* Metodo para hacer la actualizacion de la informacion
	* de los movimientos
	* @param $datos
	* @param $idMov
	*/
	public function editMov($datos,$idMov){
		$this->db->set('updated_at','NOW()',FALSE);
		$this->db->where('Id_Ajuste',$idMov);
		$this->db->update('almAjuste_Almacen',$datos);
		return TRUE;
	}

	public function dropDetalle($juste){
		$this->db->where('Id_Ajuste',$juste);
		$this->db->delete('almDetalle_Ajustes');
		return TRUE;
	}

	public function saveDetalleAjuste($datos){
		$this->db->set('created_at','NOW()',FALSE);
		$this->db->set('updated_at','NOW()',FALSE);
		$this->db->insert('almDetalle_Ajustes',$datos);
		return TRUE;
	}

	public function bajaMov($idMov){
		$this->db->set('Estado','Cancelado');
		$this->db->where('Id_Ajuste',$idMov);
		$this->db->update('almAjuste_Almacen');
		return TRUE;
	}

	public function autorizarMov($idMov){
		$this->db->set('Estado','Aplicado');
		$this->db->where('Id_Ajuste',$idMov);
		$this->db->update('almAjuste_Almacen');
		return TRUE;
	}
}

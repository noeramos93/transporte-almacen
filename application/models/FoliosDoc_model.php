<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modelo para los catalogos de factura documento
 * @author Ing. Noé Ramos López
 * @version 0.1
 * @copyright Todos los derechos reservados 2019
*/
class FoliosDoc_model extends CI_Model{
    /**
    * Contrsutor para la clase 
    * Configuracion model.
    */
    public function __construct(){
        $this->load->database();
    }

    /**
    * Metodo para obtener el numero de 
    * registros que tiene la tabla de
    * documentos folios
    * @return int Id_Folio
    */
    public function getIdTableFac(){
    	$this->db->select('COUNT(Id_Folio) AS NUM_ID');
    	$this->db->from('cfgFolios_Doctos');
    	$query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
    }

    /**
    * Metodo para obtener todos los registros
    * de la tabla de folios documentos
    * @return Lista de folios
    */
    public function getAllTableFolios(){
    	$this->db->select('Id_Folio, Documento, FolioSiguiente, Serie');
    	$this->db->from('cfgFolios_Doctos');
    	$query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->result();
    }

    /**
    * Metodo para hacer un insert o una actualizacion
    * de un folio de documento
    * @param $datos datos a actualizar o insertar
    * @param $tipo tipo de operacion 
    * @param $id id para la actualizacion
    * @return TRUE o FALSE
    */
    public function addDocFol($datos,$tipo,$id){
    	
    	if($tipo == 'A'){
    		
    		$this->db->set('updated_at','NOW()',FALSE);
    		$this->db->where('Id_Folio',$id);
    		$this->db->update('cfgFolios_Doctos',$datos);

    	}else if($tipo == 'S'){
    		
    		$this->db->set('created_at','NOW()',FALSE);
        	$this->db->set('updated_at','NOW()',FALSE);
    		$this->db->insert('cfgFolios_Doctos',$datos);

    	}

    	return TRUE;
    }

    /**
    * Metodo para obtener la informacion de un folio
    * en base al id que se le mande
    * @param $idFol
    * @return List<Folios>
    */
    public function getFolInfo($idFol){
    	$this->db->select('Id_Folio, Documento, FolioSiguiente, Serie');
    	$this->db->from('cfgFolios_Doctos');
    	$this->db->where('Id_Folio',$idFol);
    	$query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
    }

    /**
    * Metodo para borrar un folio
    * recibe el id del folio a borrar
    * @param $idFol
    * @return TRUE o FALSE
    */
    public function dropFol($idFol){
		$this->db->where('Id_Folio',$idFol);
    	$this->db->delete('cfgFolios_Doctos');
    	return TRUE;
    }
}
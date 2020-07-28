<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modelo para los catalogos generales.
 * @author Ing. Noé Ramos López
 * @version 0.1
 * @copyright Todos los derechos reservados 2019
*/
class CatalogoGeneral_model extends CI_Model{
    /**
    * Contrsutor para la clase 
    * CatalogoGeneral model.
    */
    public function __construct(){
        $this->load->database();
    }

    /**
    * Metodo para obtener todos los
    * registros de los catalogos de clientes, propietarios, proveedores, estados
    */
    public function getCatalogoGeneral($tipoCatalogo){

        switch ($tipoCatalogo) {
            case 'A':
                //consulta catalogo cliente
                $this->db->select('Id_Cliente, NombreCompleto, RazonSocial');
                $this->db->from('graClientes');
                $this->db->where('Estatus','1');
                break;
            case 'B':
                //consulta catalogo proveedor
                $this->db->select('Id_Proveedor, NombreCompleto, RazonSocial');
                $this->db->from('graProveedores');
                $this->db->where('Estatus','1');
                break;
            case 'C':
                //consulta catalogo propietario
                $this->db->select('Id_Propietario, NombreCompleto, RazonSocial');
                $this->db->from('graPropietarios');
                $this->db->where('Estatus','1');
                break;
            case 'D':
                //consulta catalogo estados
                $this->db->select('Id_Estado, Nombre_Estado');
                $this->db->from('graEstado');
                break;
        }

        //$query = $this->db->get_compiled_select();
        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->result();
    }

    /**
    * Metodo para obtener el numero de registros de 
    * un catalogo dependiendo del tipo
    * 'A' es un cliente, 'B' es un proveedor, 'C' es un propietario.
    * @param $tipoCatalogo 'A' o 'B' o 'C'
    */
    public function getIdCatalogoGeneral($tipoCatalogo){

        switch ($tipoCatalogo) {
            case 'A':
                //consulta catalogo cliente
                $this->db->select('count(Id_Cliente) AS NUM_ID');
                $this->db->from('graClientes');
                break;
            case 'B':
                //consulta catalogo proveedor
                $this->db->select('count(Id_Proveedor) AS NUM_ID');
                $this->db->from('graProveedores');
                break;
            case 'C':
                //consulta catalogo propietario
                $this->db->select('count(Id_Propietario) AS NUM_ID');
                $this->db->from('graPropietarios');
                break;
        }

        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
    }

    /**
    * Metodo para guardar la informacion de un catalogo
    * dependiendo del tipo de catalogo, si es A es un cliente
    * si es B es un provedor, si es C es un propietarios
    * @param $datosCat array[]
    * @param $tipoCat 'A' o 'B' o 'C'
    */
    public function saveCatGnral($datosCat,$tipoCat){

        // sedemos los parametros de fecha de creacion y fecha de actualizacion
        $this->db->set('created_at','NOW()',FALSE);
        $this->db->set('updated_at','NOW()',FALSE);

        switch ($tipoCat) {
            case 'A':
                // tabla de clientes
                $this->db->insert('graClientes',$datosCat);
                break;
            case 'B':
                // tabla de proveedores
                $this->db->insert('graProveedores',$datosCat);
                break;
            case 'C':
                // tabla de propietarios
                $this->db->insert('graPropietarios',$datosCat);
                break;
        }
        return TRUE;
    }

    /**
    * Metodo para hacer una actualizacion de estatus
    * recibe los datos a actualizar, el tipo de catalogo
    * al cual se hara la actualziacion y el id al cual se le hara
    * la actualizacion.
    * @param $datosCat
    * @param $tipoCat
    * @param $idCat
    */
    public function updateCatGnral($datosCat,$tipoCat,$idCat){

        $this->db->set('updated_at','NOW()',FALSE);

        switch ($tipoCat) {
            case 'A':
                //clientes
                $this->db->where('Id_Cliente',$idCat);
                $this->db->update('graClientes',$datosCat);
                break;
            case 'B':
                //proveedores
                $this->db->where('Id_Proveedor',$idCat);
                $this->db->update('graProveedores',$datosCat);
                break;
            case 'C':
                //propietarios
                $this->db->where('Id_Propietario',$idCat);
                $this->db->update('graPropietarios',$datosCat);
                break;
        }
        return TRUE;
    }

    /**
    * Metodo para buscar la informacion de un catalgo
    * en base al id que se le mande
    * @param $tipoCat
    * @param $idRow
    */
    public function selectRowCatById($tipoCat,$idRow){

        switch ($tipoCat) {
            case 'A':
                $this->db->select('Id_Cliente,Nombres,APaterno,AMaterno,RazonSocial,RFC,Calle,Colonia,CP,Estado,Celular,Telefono,email,Tipo_Persona');
                $this->db->from('graClientes');
                $this->db->where('Id_Cliente',$idRow);
                break;
            case 'B':
                $this->db->select('Id_Proveedor,Nombres,APaterno,AMaterno,RazonSocial,RFC,Calle,Colonia,CP,Estado,Celular,Telefono,email,Tipo_Persona,Dias_Entrega');
                $this->db->from('graProveedores');
                $this->db->where('Id_Proveedor',$idRow);
                break;
            case 'C':
                $this->db->select('Id_Propietario,Nombres,APaterno,AMaterno,RazonSocial,RFC,Calle,Colonia,CP,Estado,Celular,Telefono,email,Tipo_Persona');
                $this->db->from('graPropietarios');
                $this->db->where('Id_Propietario',$idRow);
                break;
        }

        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
    }
}
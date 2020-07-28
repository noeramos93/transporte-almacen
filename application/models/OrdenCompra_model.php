<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modelo para la orden de compra.
 * @author Ing. Noé Ramos López
 * @version 0.1
 * @copyright Todos los derechos reservados 2019
*/
class OrdenCompra_model extends CI_Model{
    /**
    * Contrsutor para la clase 
    * CatalogoGeneral model.
    */
    public function __construct(){
        $this->load->database();
    }

    public function getInfoOrdenByFolio($folio,$serie){
    	$this->db->select('Id_Orden, V.Id_Proveedor,V.RazonSocial AS Proveedor ,P.Id_Propietario,P.RazonSocial AS Propietario,Folio ,Serie ,O.Estado, Subtotal, Impuestos, Total, Observaciones, date_format(O.created_at,"%Y-%m-%d") AS FechaAlta');
    	$this->db->from('almOrden_Compra O ');
    	$this->db->join('graProveedores V ',' O.Id_Proveedor  = V.Id_Proveedor');
    	$this->db->join('graPropietarios P ',' O.Id_Propietario  = P.Id_Propietario');
    	$this->db->where('Folio',$folio);
    	$this->db->where('Serie',$serie);
        $this->db->where('O.Estado','PendAutorizar');
    	$query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
    }

    public function getInfoDetalleOrdenById($idOrden){
    	$this->db->select('Id_Registro, P.Id_Parte AS Id_Parte, Descripcion, Cantidad, Costo, Costo_Total, Cantidad_Surtida, Cantidad_Pendiente');
    	$this->db->from('almDetalle_Orden_Compra D ');
    	$this->db->join('almPartes P ',' D.Id_Parte = P.Id_Parte ');
    	$this->db->where('Id_Orden',$idOrden);
    	$query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->result();
    }

    public function updateInfoOrden($infoOrden,$id){
		$this->db->set('updated_at','NOW()',FALSE);
		$this->db->where('Id_Orden',$id);
    	$this->db->update('almOrden_Compra',$infoOrden);
    	return TRUE;
    }

    public function deleteDetalleOrden($idOrden){
    	$this->db->where('Id_Orden',$idOrden);
        $this->db->delete('almDetalle_Orden_Compra');
        return TRUE;
    }

    public function autorizar($idOrden,$idAut){
        $this->db->set('updated_at','NOW()',FALSE);
        $this->db->set('Fecha_Autorizacion','NOW()',FALSE);
        $this->db->set('Id_UsuarioAutoriza',$idAut);
        $this->db->set('Estado','SinSurtir');
        $this->db->where('Id_Orden',$idOrden);
        $this->db->update('almOrden_Compra');
        return TRUE;
    }

    public function cancelOrden($idOrden){
        $this->db->set('updated_at','NOW()',FALSE);
        $this->db->set('Estado','Cancelada');
        $this->db->where('Id_Orden',$idOrden);
        $this->db->update('almOrden_Compra');
        return TRUE;
    }
}
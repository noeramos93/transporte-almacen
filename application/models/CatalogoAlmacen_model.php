<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modelo para los catalogos generales.
 * @author Ing. Noé Ramos López
 * @version 0.1
 * @copyright Todos los derechos reservados 2019
*/
class CatalogoAlmacen_model extends CI_Model{
    /**
    * Contrsutor para la clase 
    * CatalogoGeneral model.
    */
    public function __construct(){
        $this->load->database();
    }

    /**
    * Metodo para obtener todos los
    * registros de los catalogos de Ubicacion, Tipo inventario, Almacenes, Tipo movimiento
    */
    public function getCatalogoAlmacen($tipoCatalogo){

        switch ($tipoCatalogo) {
            case 'A':
                //consulta catalogo de ubicaciones
                $this->db->select('Id_Ubicacion, Nombre');
                $this->db->from('almUbicaciones');
                $this->db->where('Estatus','1');
                break;
            case 'B':
                //consulta catalogo tipo de inventario
                $this->db->select('Id_Tipo, Nombre');
                $this->db->from('almTipos_Inventario');
                $this->db->where('Estatus','1');
                break;
            case 'C':
                //consulta catalogo almacenes
                $this->db->select('Id_Almacen, Nombre');
                $this->db->from('almAlmacenes');
                $this->db->where('Estatus','1');
                break;
            case 'D':
                //consulta catalogo tipo de movimientos
                $this->db->select('Id_TipoMov, Nombre');
                $this->db->from('almTipos_Mov_Almacen');
                $this->db->where('Estatus','1');
                break;
            case 'E':
                //consultamos el catalogo de productos
                $this->db->select('Id_Parte, Descripcion');
                $this->db->from('almPartes');
                break;
        }
        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->result();
    }

    //*
    public function getIdTableAlm($tableCat){
        switch ($tableCat) {
            case 'A':
                $this->db->select('');
                $this->db->from('');
                $this->db->where('');
                break;
            case 'B':
                $this->db->select('count(Id_Parte) AS NUM_ID');
                $this->db->from('almPartes');
                break;
            case 'C':
                $this->db->select('count(Id_Orden) AS NUM_ID');
                $this->db->from('almOrden_Compra');
                break;
            case 'F':
                $this->db->select('count(Id_FactCompra) AS NUM_ID');
                $this->db->from('almFactura_Compra');
                break;
        }
        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
    }

    /**
    * Metodo para guardar la informacion
    * de en la tabla de partes
    * @param $infoParte array[]
    */
    public function saveInfoPart($infoParte,$tipo,$idParte){

        //actualizacion
        if($tipo == 'A'){
            $this->db->set('updated_at','NOW()',FALSE);
            $this->db->where('Id_Parte',$idParte);
            $this->db->update('almPartes',$infoParte);
        //nueva parte
        }else if($tipo == 'S'){
            $this->db->set('created_at','NOW()',FALSE);
            $this->db->set('updated_at','NOW()',FALSE);
            $this->db->insert('almPartes',$infoParte);
        }
        return TRUE;
    }

    /**
    * Metodo para obtener la informacion de un proveedor
    * en base al id que se envie
    * @param idProv id del proveedor
    */
    public function getProvById($idProv){
        $this->db->select('Id_Proveedor,RazonSocial,Dias_Entrega');
        $this->db->from('graProveedores');
        $this->db->where('Id_Proveedor',$idProv);
        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
    }

    /**
    * Metodo par aobtener la informacion de una parte
    * que se haya dado de alta con anterioridad
    * en base al codigo alterno que manden
    * @param $codAlt codigo alterno guardado
    */
    public function getParteByCod($codAlt){
        $this->db->select("Id_Parte, Codigo_Alterno, Descripcion, Ficha_Tecnica, Id_Tipo, Minimo, Maixmo, Punto_Reorden, Costo_Reposicion, Ultimo_Costo, Fecha_UltimaCompra, date_format(created_at,'%Y-%m-%d') AS Fecha");
        $this->db->from('almPartes');
        $this->db->where('Codigo_Alterno',$codAlt);
        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
    }

    /**
    * Metodo para obtener la informacion de la relacion 
    * entre las partes y los proveedores
    * @param codAlterno
    */
    public function getRelProv($codAlterno){
        $this->db->select('almPartes_Proveedores.Id_Proveedor,RazonSocial, Codigo_Proveedor,EsPrincipal,Dias_Entrega');
        $this->db->from('almPartes_Proveedores');
        $this->db->join('graProveedores','almPartes_Proveedores.Id_Proveedor = graProveedores.Id_Proveedor');
        $this->db->where('Codigo_Proveedor',$codAlterno);
        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->result();
    }

    /**
    * metodo  para gaurdar la informacion de la
    * la relacion de la parte con el proveedor
    * @param $infoRel[id_parte,id_proveedor,codigo_alterno,es_principal]
    * @return TRUE o FALSE
    */
    public function saveInfoRelProv($infoRel){
        $this->db->set('created_at','NOW()',FALSE);
        $this->db->set('updated_at','NOW()',FALSE);
        $this->db->insert('almPartes_Proveedores',$infoRel);
        return TRUE;
    }

    /**
    * Metodo para guardar la informacion de la relacion de una
    * parte con una ubicacion
    * @param $infoRel [ ID_SLC_ALM,ID_PARTE,ID_SLC_NV1,ID_SLC_NV2,ID_SLC_NV3,ID_SLC_NV4 ]
    * @return TRUE o FALSE
    */
    public function saveRelUbic($infoRel){
        $this->db->set('created_at','NOW()',FALSE);
        $this->db->set('updated_at','NOW()',FALSE);
        $this->db->insert('almPartes_Ubicaciones',$infoRel);
        return TRUE;   
    }

    /**
    * Metodo apra obtener la relacion de las ubicaciones 
    * en base al id de la parte que se seleccione
    * @param idParte
    */
    public function getRelUbic($idPart){
        $this->db->select('Id_Parte, U.Id_Almacen AS ID_ALM, A.Nombre AS ALMACEN, B.Nombre AS NV1, C.Nombre AS NV2, D.Nombre AS NV3, E.Nombre AS NV4');
        $this->db->from('almPartes_Ubicaciones U');
        $this->db->join('almAlmacenes A ','U.Id_Almacen = A.Id_Almacen');
        $this->db->join('almUbicaciones B ','U.UbiNivel1 = B.Id_Ubicacion');
        $this->db->join('almUbicaciones C ','U.UbiNivel2 = C.Id_Ubicacion','LEFT');
        $this->db->join('almUbicaciones D','U.UbiNivel3 = D.Id_Ubicacion','LEFT');
        $this->db->join('almUbicaciones E ','U.UbiNivel4 = E.Id_Ubicacion','LEFT');
        $this->db->where('Id_Parte', $idPart);
        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->result();
    }

    /**
    * Metodo para buscar y obtener el id el la razon socail de
    * propietario o un proveedor, recibe el nombre del proveedor
    * el propietario y el tipo de busqueda si es A es para un 
    * proveedor y si es B es para un propitario.
    * @param $namePropProv
    * @param $tipo
    */
    public function buscarPropProvByName($namePropProv,$tipo){
        
        if($tipo == 'A'){
            $this->db->select('Id_Proveedor, RazonSocial');
            $this->db->from('graProveedores');
            $this->db->like('RazonSocial',$namePropProv);
        }else{
            $this->db->select('Id_Propietario, RazonSocial');
            $this->db->from('graPropietarios');
            $this->db->like('RazonSocial',$namePropProv);
        }
        
        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->result();
    }

    /**
    * Metodo apra obtener la informacion de una ubicacion
    * en base al id que se le mande
    * @param $idUbicacion
    */
    public function getInfoUbicById($idUbicacion){
        
        $this->db->select('Id_Ubicacion, Nombre');
        $this->db->from('almUbicaciones');
        $this->db->where('Id_Ubicacion',$idUbicacion);

        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
    }


    /**
    * Metodo para gaurdar la informacion de una 
    * orden de compara
    * @param $datosOrden[]
    */
    public function saveInfoOrden($datosOrden){
        $this->db->set('created_at','NOW()',FALSE);
        $this->db->set('updated_at','NOW()',FALSE);
        $this->db->insert('almOrden_Compra',$datosOrden);
        return $this->db->insert_id();
    }


    public function saveDetalleOrden($datosDetalle){
        $this->db->set('created_at','NOW()',FALSE);
        $this->db->set('updated_at','NOW()',FALSE);
        $this->db->insert('almDetalle_Orden_Compra',$datosDetalle);
        return TRUE;
    }
}

/**

SELECT R.Id_Proveedor,RazonSocial, Codigo_Proveedor,EsPrincipal,Dias_Entrega FROM almpartes_proveedores R INNER JOIN graproveedores V ON( R.Id_Proveedor = V.Id_Proveedor);
-- query para mostrar los campos nulos de la relacion
SELECT
    Id_Parte, A.Nombre AS ALMACEN, B.Nombre AS NV1, C.Nombre AS NV2, D.Nombre AS NV3, E.Nombre AS NV4
FROM almPartes_Ubicaciones U INNER JOIN almAlmacenes A ON(U.Id_Almacen = A.Id_Almacen)
    INNER JOIN almUbicaciones B ON( U.UbiNivel1  = B.Id_Ubicacion )
    LEFT JOIN almUbicaciones C ON( U.UbiNivel2  = C.Id_Ubicacion )
    LEFT JOIN almUbicaciones D ON( U.UbiNivel3  = D.Id_Ubicacion )
    LEFT JOIN almUbicaciones E ON( U.UbiNivel4  = E.Id_Ubicacion );

SELECT 
    `Id_Parte`, 
    `almAlmacenes`.`Nombre` AS `ALMACEN`, 
    `almUbicaciones`.`Nombre` AS `NV1`, 
    `almUbicaciones`.`Nombre` AS `NV2`, 
    `almUbicaciones`.`Nombre` AS `NV3`, 
    `almUbicaciones`.`Nombre` AS `NV4` 
FROM 
    `almPartes_Ubicaciones` JOIN `almAlmacenes` ON `almPartes_Ubicaciones`.`Id_Almacen` = `almAlmacenes`.`Id_Almacen` 
    JOIN `almUbicaciones` ON `almPartes_Ubicaciones`.`UbiNivel1` = `almUbicaciones`.`Id_Ubicacion` 
    LEFT JOIN `almUbicaciones` ON `almPartes_Ubicaciones`.`UbiNivel2` = `almUbicaciones`.`Id_Ubicacion` 
    LEFT JOIN `almUbicaciones` ON `almPartes_Ubicaciones`.`UbiNivel3` = `almUbicaciones`.`Id_Ubicacion` 
    LEFT JOIN `almUbicaciones` ON `almPartes_Ubicaciones`.`UbiNivel4` = `almUbicaciones`.`Id_Ubicacion` 
WHERE 
    `Id_Parte` = '2';



*/
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Modelo para los catalogos de configuración.
 * @author Ing. Noé Ramos López
 * @version 0.1
 * @copyright Todos los derechos reservados 2019
*/
class Configuracion_model extends CI_Model{
    /**
    * Contrsutor para la clase 
    * Configuracion model.
    */
    public function __construct(){
        $this->load->database();
    }

    /**
    * Metodo para obteber un registro o todos los registros de los catalagos de
    * de configuracion dependiendo del tipo de conulta que se mande y el tipo de
    * catalogo que se escoja ya sea Roles,Permisos, Modudlos, Departamentos
    * @param $idRowCat id del catalogo
    * @param $tipoCatConf tipo de catalogo a consultar
    * @param $tipoConsulta tipo de consulta 1 o 0, si es 1 es toda la tabla, si es 0 es un campo
    */
    public function getCatConfig($idRowCat,$tipoCatConf,$tipoConsulta){
        $resultadoConsulta;

        switch ($tipoCatConf) {
            case 'A':
                // Roles
                    $this->db->select('Id_Rol, Nombre');
                    $this->db->from('cfgRoles');
                    $this->db->where('Estatus',1);
                    if($tipoConsulta == 1){
                        $this->db->where('Id_Rol',$idRowCat);
                    }
                break;
            case 'B':
                // Permisos
                    $this->db->select('Id_Permiso, Nombre');
                    $this->db->from('cfgPermisos');
                    $this->db->where('Estatus',1);
                    if($tipoConsulta == 1){
                        $this->db->where('Id_Permiso',$idRowCat);
                    }
                break;
            case 'C':
                // Modulos
                    $this->db->select('Id_Modulo, Nombre');
                    $this->db->from('cfgModulos');
                    $this->db->where('Estatus',1);
                    if($tipoConsulta == 1){
                        $this->db->where('Id_Modulo',$idRowCat);
                    }
                break;
            case 'D':
                // Departamento
                    $this->db->select('Id_Departamento, Nombre');
                    $this->db->from('cfgDepartamento');
                    $this->db->where('Estatus',1);
                    if($tipoConsulta == 1){
                        $this->db->where('Id_Departamento',$idRowCat);
                    }
                break;
            case 'E':
                // Catalogo de usuario
                    $this->db->select('Id_Usuario, usuario');
                    $this->db->from('cfgUsuarios');
                    $this->db->where('Activo','Activo');
                    if($tipoConsulta == 1){
                        $this->db->where('Id_Usuario',$idRowCat);
                    }
                break;
        }

        $query = $this->db->get();

        if($tipoConsulta == 0){
            $resultadoConsulta = ($query->num_rows() <= 0) ? NULL : $query->result();
        }else{
            $resultadoConsulta = ($query->num_rows() <= 0) ? NULL : $query->row();            
        }

        return $resultadoConsulta;
    }

    /**
    * Metodo para actualizar el nombre o el estatus
    * del catalogo si el Estatus viene vacio es una actualizacion
    * del nombre, si el Estatus es diferente de vacio actualiza
    * solo el estatus ya que seria una baja
    * @param ['Estatus','Nombre']
    * @param id del catalogo
    */
    public function updateCatConfig($datosRol,$idRol,$cat){

        $this->db->set('updated_at','NOW()',FALSE);

        if($datosRol['Estatus'] != NULL){
            $this->db->set('Estatus',$datosRol['Estatus']);
        }else{
            $this->db->set('Nombre',$datosRol['Nombre']);
        }

        switch ($cat) {
            case 'A':
                // Roles
                    $this->db->where('Id_Rol',$idRol);
                    $this->db->update('cfgroles');
                break;
            case 'B':
                // permisos
                    $this->db->where('Id_Permiso',$idRol);
                    $this->db->update('cfgPermisos');
                break;
            case 'C':
                // Modulos
                    $this->db->where('Id_Modulo',$idRol);
                    $this->db->update('cfgModulos');
                break;
            case 'D':
                // Departamento
                    $this->db->where('Id_Departamento',$idRol);
                    $this->db->update('cfgDepartamento');
                break;
        }
        return TRUE;
    }

    /**
    * Metodo para obtener la relacion 
    * de los modulos con los permisos
    */
    public function getRelacionModuloPermiso(){
        $this->db->select('Id_Relacion,cfgModulos.Nombre AS Modulo ,cfgPermisos.Nombre AS Permiso ');
        $this->db->from('cfgModulos_Permisos ');
        $this->db->join('cfgModulos','cfgModulos_Permisos.Id_Modulo = cfgModulos.Id_Modulo');
        $this->db->join('cfgPermisos','cfgModulos_Permisos.Id_Permiso = cfgPermisos.Id_Permiso');
        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->result();
    }

    /**
    * Metodo para validar si la relacion
    * modulo - permiso existe en la base de datos
    * @param idMod modulo
    * @param idPer permiso
    */
    public function existeRelacionModPer($idMod,$idPer){

        $this->db->select('COUNT(Id_Relacion) AS ID');
        $this->db->from('cfgModulos_Permisos');
        $this->db->where('Id_Modulo',$idMod);
        $this->db->where('Id_Permiso',$idPer);
        $query = $this->db->get();

        return ($query->num_rows() <= 0) ? NULL : $query->row();
    }

    /**
    * Metodo para guardar la relacion 
    * entre el modulo y el permiso
    * @param $datosRel['Id_Modulo','Id_Permiso','Estatus']
    */
    public function saveRelModPer($datosRel){
        //metodos para usar la funcion NOW()
        $this->db->set('created_at','NOW()',FALSE);
        $this->db->set('updated_at','NOW()',FALSE);

        $this->db->insert('cfgModulos_Permisos',$datosRel);
        return TRUE;
    }

    /**
    * Metodo para obtener la informacion
    * a mostrar en la tabla de usuarios
    * en el front
    */
    public function getRelUsuario(){
        
        $this->db->select('Id_Usuario, Usuario, cfgUsuarios.Nombre AS Name, email,  cfgRoles.Nombre AS Rol, cfgDepartamento.Nombre  AS Departamento');
        $this->db->from('cfgUsuarios');
        $this->db->join('cfgRoles','cfgUsuarios.Id_Rol = cfgRoles.Id_Rol');
        $this->db->join('cfgDepartamento','cfgUsuarios.Id_Departamento = cfgDepartamento.Id_Departamento');
        $this->db->where('Activo','Activo');
        
        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->result();
    }

    public function getRelUsuPer(){

        //Relacion con modulos
        $this->db->select('Id_Relacion,Id_Modulo, cfgModulos_Permisos.Id_Permiso AS Id_Per,cfgPermisos.Nombre AS Permiso');
        $this->db->from('cfgModulos_Permisos');
        $this->db->join('cfgPermisos','cfgModulos_Permisos.Id_Permiso = cfgPermisos.Id_Permiso');
        
        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->result();
    }

    public function getRelModPer(){
        $this->db->select('R.Id_Modulo, Nombre');
        $this->db->from('cfgModulos_Permisos R ');
        $this->db->join('cfgModulos M ','R.Id_Modulo = M.Id_Modulo');
        $this->db->group_by('R.Id_Modulo');
        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->result();
    }

    public function getPermisoUsuarios($idUsuario){
        $this->db->select('Id_Modulo, Id_Permiso');
        $this->db->from('cfgUsuarios_Permisos');
        $this->db->where('Id_Usuario',$idUsuario);
        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->result();
    }

    public function getIdRelByPer($idRelPer){
        $this->db->select('Id_Modulo, Id_Permiso');
        $this->db->from('cfgModulos_Permisos');
        $this->db->where('Id_Relacion',$idRelPer);
        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
    }

    /**
    * Metodo para guardar la relacion usuarios permisos
    * @param $datos[Id_Usuario, Id_Modulo, Id_Permiso]
    * @return TRUE o FALSE
    */
    public function saveRelPerUser($datos){
        $this->db->insert('cfgUsuarios_Permisos',$datos);
        return TRUE;
    }

    /**
    * Metodo para obtener el id de la relacion en base al 
    * modulo y permiso que se mande.
    * @param $modulo
    * @param $permiso
    */
    public function getRelacionPermiso($modulo,$permiso){
        $this->db->select('Id_Relacion');
        $this->db->from('cfgModulos_Permisos');
        $this->db->where('Id_Modulo',$modulo);
        $this->db->where('Id_Permiso',$permiso);
        $this->db->where('Estatus','1');
        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
    }

    /**
    * Metodo para guardar p actualizar la informacion 
    * de un usuario, recibe la iformacion, el id del usuario
    * y el tipo de operacion 'A' es para actualizar.
    * @param $info[] 
    * @param $id
    * @param $tipo
    * @return TRUE o FALSE
    */
    public function saveOrUpdateUsu($info,$id,$tipo){
        //si es una actiualizacion
        if($tipo == 'A'){
            $this->db->set('updated_at','NOW()',FALSE);
            $this->db->where('Id_Usuario',$id);
            $this->db->update('cfgUsuarios',$info);
        }else{
        //si es un nuevo usuario
            $this->db->set('created_at','NOW()',FALSE);
            $this->db->set('updated_at','NOW()',FALSE);
            $this->db->insert('cfgUsuarios',$info);
        }
        return TRUE;
    }

    /**
    * Metodo para obtener la informacion de un usuario
    * en base al id que se le manda
    * @param $idUsuario
    */
    public function getInformacionById($idUsuario){
        
        $this->db->select('Id_Usuario, Usuario, Nombre, email, Id_Rol, Id_Departamento');
        $this->db->from('cfgUsuarios'); 
        $this->db->where('Activo','Activo');
        $this->db->where('Id_Usuario',$idUsuario);
        
        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
    }

    /**
    * Metodo para borrar la relacion permiso usuario en base al 
    * usuario , modulo y permiso que se mande
    * @param $usuario
    * @param $modeulo
    * @param $permiso
    */
    public function deleteRelPerUser($usuario,$model,$permiso){
        $this->db->where('Id_Usuario',$usuario);
        $this->db->where('Id_Modulo',$model);
        $this->db->where('Id_Permiso',$permiso);
        $this->db->delete('cfgUsuarios_Permisos');
        return TRUE;
    }

    /**
    * Metodo para borrar la relacion modulo permiso 
    * en base al id de la relacion que se mande
    * @param $idRelacion
    */
    public function deleteRelModPer($idRelacion){
        $this->db->where('Id_Relacion',$idRelacion);
        $this->db->delete('cfgModulos_Permisos');
        return TRUE;
    }

    /**
    * Metodo para borrar la relacion de usuario permiso en 
    * base al modulo y el permiso que coincidan
    * @param $modulo
    * @param $permiso
    */
    public function deleteUsuPerByModAndPer($modulo,$permiso){
        $this->db->where('Id_Modulo',$modulo);
        $this->db->where('Id_Permiso',$permiso);
        $this->db->delete('cfgUsuarios_Permisos');
        return TRUE;
    }

    /**
    * Metodo para hacer el borrado logico de 
    * los departamentos
    * @param $departamento
    */
    public function deleteDepartamento($departamento){
        $this->db->set('updated_at','NOW()',FALSE);
        $this->db->set('Estatus','0');
        $this->db->where('Id_Departamento',$departamento);
        $this->db->update('cfgDepartamento');
        return TRUE;
    }

    /**
    * Metodo para obtener la inforamcion de un departamento
    * en base al id que se le manda
    * @param $idDepa
    */
    public function getInfoDepa($idDepa){
        $this->db->select('Id_Departamento,Nombre');
        $this->db->from('cfgDepartamento');
        $this->db->where('Id_Departamento',$idDepa);
        $query = $this->db->get();
        return ($query->num_rows() <= 0) ? NULL : $query->row();
    }

    /**
    * Metodo para actualizar la informacion del departamento
    * @param $name
    * @param $id
    * @return TRUE o FALSE
    */
    public function saveInfoDep($name,$id){
        $this->db->set('updated_at','NOW()',FALSE);
        $this->db->set('Nombre',$name);
        $this->db->where('Id_Departamento',$id); 
        $this->db->update('cfgDepartamento');
        return TRUE;
    }
}

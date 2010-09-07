<?php
/**
 */
class UsuarioTable extends Doctrine_Table
{
    public static function getComerciales(){

        return Doctrine::getTable("Usuario")
                             ->createQuery("u")
                             ->select("u.*")
                             ->innerJoin("u.UsuarioPerfil up")
                             ->where("up.ca_perfil = ?", 'comercial')
                             ->addWhere("u.ca_activo = true")
                             ->addOrderBy("u.ca_nombre")
                             ->execute();
    }

    public static function getUsuariosSeguros(){

        return Doctrine::getTable("Usuario")
                             ->createQuery("u")
                             ->select("u.*")
                             ->innerJoin("u.UsuarioPerfil up")
                             ->where("up.ca_perfil = ?", 'tramitador-de-polizas')
                             ->addWhere("u.ca_activo = true")
                             ->addOrderBy("u.ca_nombre")
                             ->execute();
    }

    public static function getCoordinadoresAduana(){

        return Doctrine::getTable("Usuario")
                             ->createQuery("u")
                             ->select("u.*")
                             ->innerJoin("u.UsuarioPerfil up")
                             ->where("up.ca_perfil = ?", 'coordinador-de-servicio-al-cliente-aduana')
                             ->addWhere("u.ca_activo = true")
                             ->addOrderBy("u.ca_nombre")
                             ->execute();
        
    }
}
<?php
/**
 */
class UsuarioTable extends Doctrine_Table
{
    public static function getComerciales(){

        return Doctrine::getTable("Usuario")
                             ->createQuery("u")
                             ->where("(u.ca_cargo='Gerente Sucursal' OR u.ca_cargo like '%Ventas%' OR u.ca_departamento='Comercial')")
                             ->addWhere("u.ca_activo = true")
                             ->addOrderBy("u.ca_nombre")
                             ->execute();
    }
}
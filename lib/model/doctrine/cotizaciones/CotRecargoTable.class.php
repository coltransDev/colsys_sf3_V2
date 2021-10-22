<?php
/**
 */
class CotRecargoTable extends Doctrine_Table
{
    public static function retrieveByPk(  $idcotizacion, $idproducto, $idopcion, $idconcepto, $idrecargo, $modalidad ){

        $recargo = Doctrine::getTable("CotRecargo")
                   ->createQuery("r")
                   ->where("r.ca_idcotizacion = ? ", $idcotizacion)
                   ->addWhere("r.ca_idproducto = ? ", $idproducto)
                   ->addWhere("r.ca_idopcion = ? ", $idopcion)
                   ->addWhere("r.ca_idconcepto = ? ", $idconcepto)
                   ->addWhere("r.ca_idrecargo = ? ", $idrecargo)
                   ->addWhere("r.ca_modalidad = ? ", $modalidad)
                   ->fetchOne();

    }
}
<?php
/**
 */
class TrayectoTable extends Doctrine_Table
{
    public static function findByParametros( $impoexpo, $transporte, $origen, $destino, $idlinea, $idagente=null ){
        $q = Doctrine::getTable("Trayecto")->createQuery("t")
               ->select("t.*")
               ->where("t.ca_impoexpo = ? AND t.ca_transporte = ? AND t.ca_origen = ? AND t.ca_destino = ? AND t.ca_idlinea = ?", array( $impoexpo, $transporte, $origen, $destino, $idlinea));

       if( $idagente ){
           $q->addWhere( "t.ca_idagente = ?", $idagente );
       }else{
           $q->addWhere( "t.ca_idagente  IS NULL" );
       }
       return $q->fetchOne();

    }
}
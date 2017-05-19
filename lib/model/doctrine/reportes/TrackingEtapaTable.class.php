<?php
/**
 */
class TrackingEtapaTable extends Doctrine_Table
{
    static public function getIdgXEtapa($idetapa) {
      
      $idg =  Doctrine::getTable("TrackingEtapa")
              ->createQuery("t")
              ->select("*")
              ->where("t.ca_idetapa = ?", $idetapa)      
              ->fetchOne();      
     return($idg->getCaIdg());
    }
}
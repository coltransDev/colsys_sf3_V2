<?php

class IdgTable extends Doctrine_Table {

   static public function getUnIndicador($idg, $fecha, $idsucursal) {
      $suc_array = array($idsucursal, "999");
      $idg_max = Doctrine::getTable("IdgConfig")
              ->createQuery("c")
              ->select("c.*")
              ->where("c.ca_idg = ?", $idg)
              ->whereIn("c.ca_idsucursal", $suc_array)
              ->andWhere("'$fecha' between c.ca_fchini and c.ca_fchfin")
              ->addOrderBy("c.ca_idsucursal")
              ->limit(1)
              //->getSqlQuery();
              ->fetchOne();
      return($idg_max);
   }

}

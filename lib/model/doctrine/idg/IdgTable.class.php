<?php

class IdgTable extends Doctrine_Table {

    static public function getUnIndicador($idg, $fecha, $idsucursal) {        
        $sucursal = Doctrine::getTable('Sucursal')->find($idsucursal);
        $suc_array = array($sucursal->getCaNombre(), "Todas Las sucursales");

        $idg_max = Doctrine::getTable("IdgConfig")
                ->createQuery("c")
                ->select("c.*")
                ->innerJoin("c.Sucursal s")
                ->where("c.ca_idg = ?", $idg)                
                ->whereIn("s.ca_nombre", $suc_array)
                ->addWhere("c.ca_fcheliminado IS NULL")
                ->andWhere("'$fecha' between c.ca_fchini and c.ca_fchfin")
                ->addOrderBy("c.ca_idsucursal")
                ->addOrderBy("c.ca_fchini DESC")
                ->limit(1)                
                ->fetchOne();
        return($idg_max);
    }
}
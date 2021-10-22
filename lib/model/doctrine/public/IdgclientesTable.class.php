<?php

class IdgclientesTable extends Doctrine_Table
{
    
    static public function getIndicador($fecha, array $options = array()) {        
        //$sucursal = Doctrine::getTable('Sucursal')->find($idsucursal);
       //$suc_array = array($sucursal->getCaNombre(), "Todas Las sucursales");
        //print_r($options);
        //echo $fecha;
        
        $q = Doctrine::getTable("Idgclientes")
                ->createQuery("c")
                ->select("c.*")
                ->where("ca_periodo_inicial < ? and ca_periodo_final > ?", array($fecha,$fecha));
                
        switch($options["tipo"]){
            case "Fact":
                $q->addWhere("ca_transporte = ?", $options["transporte"]);
                $q->addWhere("ca_traorigen = ?", $options["traorigen"]);
                $q->addWhere("ca_idcliente = ?", $options["idcliente"]);
        }
        
        $q->limit(1);
        $idg_max = $q->fetchOne();
        return($idg_max);
    }
}

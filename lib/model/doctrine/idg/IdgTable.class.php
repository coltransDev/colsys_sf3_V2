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
    
    static public function getNuevoIndicador($options){
        
        //print_r($options);
        $sucursal = Doctrine::getTable('Sucursal')->find($options["idsucursal"]);
        $suc_array = array($sucursal->getCaNombre(), "Todas Las sucursales");
        
        $fecha = $options["fecha"];
        $idg = $options["idg"];
        $sigla = $options["sigla"];
        $impoexpo = $options["impoexpo"];
        $transporte = $options["transporte"];
        $modalidad = $options["modalidad"];
        $idempresa = $options["idempresa"];
        
        try {
            $q = Doctrine::getTable("IdgConfig")
                ->createQuery("c")
                ->select("c.*")
                ->innerJoin("c.Idg i")
                ->innerJoin("c.Sucursal s")
                ->whereIn("s.ca_nombre", $suc_array)
                ->addWhere("c.ca_fcheliminado IS NULL")
                ->andWhere("'$fecha' between c.ca_fchini and c.ca_fchfin")
                ->addOrderBy("c.ca_idsucursal")
                ->addOrderBy("c.ca_fchini DESC");
   
            if($idg){            
                $q->addWhere("c.ca_idg = ?", $idg);
            }

            if($sigla){            
                $q->addWhere("i.ca_sigla = '$sigla'");
            }

            if($impoexpo){
                $q->addWhere("i.ca_impoexpo = '$impoexpo'");                
                if($transporte){
                    $q->addWhere("i.ca_transporte = '$transporte' OR ca_transporte is NULL");
                    if($modalidad){
                        $q->addWhere("i.ca_modalidad = '$modalidad' OR ca_modalidad is NULL");
                    }
                }
            }
        
            if($idempresa){
                $q->addWhere("i.ca_idempresa = ?", $idempresa);
            }
        
            $q->limit(1);                   
            $idg_max = $q->fetchOne();        
            
            return($idg_max);
            
        } catch (Exception $exc) {
            return($exc->getMessage());
        }
    }
}
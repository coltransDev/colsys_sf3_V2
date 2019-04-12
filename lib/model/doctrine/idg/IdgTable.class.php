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
                }
            }
        
            $q->limit(1);                   
            $idg_max = $q->fetchOne();        
            
            return($idg_max);
            
        } catch (Exception $exc) {
            return($exc->getMessage());
        }
    }
    
    static public function registrarIdg(array $options){
        
        $registro = Doctrine::getTable($options["tabla"])->find($options["value"]);
        
        $conn = Doctrine::getTable("InoComprobante")->getConnection();
        $conn->beginTransaction();
        
        try {
            $datos = json_decode(utf8_encode($registro->getCaDatos()),1);
            $sigla = $options["idg_sigla"];            
            $idgEst = $options["estado"];
            $idgVal = $options["indicador"];
            
            $datos["idg"][$sigla]["valor"] = $idgVal;
            $datos["idg"][$sigla]["estado"] = $idgEst;
            if($idgEst==0){
                $datos["idg"][$sigla]["idexclusion"] = 0;
            }

            $datosJson = json_encode($datos);            
            $registro->setCaDatos($datosJson);
            $registro->save($conn);
            
            $conn->commit();
            
            return array("success" => true, "consecutivo" => $registro->getCaConsecutivo(), "errorInfo"=>"");            
            
        } catch (Exception $ex) {
            $conn->rollback();
            return array("success" => false, "consecutivo" => $registro->getCaConsecutivo(), "errorInfo"=>$ex->getMessage());            
        }
    }
}
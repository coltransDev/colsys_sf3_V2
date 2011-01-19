<?php
/**
 */
class InoMaestraSeaTable extends Doctrine_Table
{
    public static function getNumReferencia($impoexpo, $transporte, $modalidad, $idorigen, $iddestino, $mm, $yy ){        
        $yy = substr($yy,-1,1);
        $sql =  "SELECT fun_referencia('".$transporte."', '".$modalidad."','".$idorigen."','".$iddestino."','".$mm."-".$yy."') as next";
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);        
        return $row['next'];
    }
}
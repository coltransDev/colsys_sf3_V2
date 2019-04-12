<?php
/**
 */
class InoIndicadoresTable extends Doctrine_Table
{    
    public static function registrarIndicador($options){

        $conn = Doctrine::getTable("InoIndicadores")->getConnection();
        $conn->beginTransaction();
        
        try{
        
            $datos = array();
            if($options["observaciones"])            
                $datos["observaciones"] = utf8_encode($options["observaciones"]);        

            $ind = new InoIndicadores();
            $ind->setCaTipo($options["tipo"]);
            $ind->setCaIdcaso($options["idcaso"]);
            $ind->setCaFecha($options["fecha"]);
            $ind->setCaIdindicador($options["idg"]);
            $ind->setCaFchinicial($options["fchini"]);
            $ind->setCaFchfinal($options["fchend"]);
            $ind->setCaIdg($options["val"]);
            $ind->setCaEstado($options["estado"]);
            $ind->setCaUsuario($options["usuario"]);
            $ind->setCaDatos(json_encode($datos));
            $ind->setCaIdetapa($options["idetapa"]);            
            $ind->save($conn);
            
            $conn->commit();
            //echo "Id:".$ind->getCaId()."<br>";
            
            return array("success"=>true, "id"=>$ind->getCaId());
            
        } catch (Exception $e){
            
            return array("success"=>false, "error"=> utf8_encode($e->getMessage()));
        }
    }
}
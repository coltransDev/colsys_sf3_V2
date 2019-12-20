<?php

/**
 * InoIndicadores
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class InoIndicadores extends BaseInoIndicadores
{
    
    public function getResultadoIndicador($idcaso) {
        
        $indicador = Doctrine::getTable("InoIndicadores")->findByDql("ca_tipo = ? AND ca_idcaso = ?", array(1, $idcaso))->getFirst();
        
        if($indicador){
            $idg = Doctrine::getTable("Idg")->find($indicador->getCaIdindicador());
            $datos = json_decode($indicador->getCaDatos());
            if($indicador->getCaEstado() == 0){                    
                $idexclusion = $indicador->getCaIdexclusion();
                if($idexclusion && $idexclusion > 0){
                    $obs = ParametroTable::retrieveByCaso("CU275",null,null,$idexclusion)->getFirst();
                    $exclusion = utf8_encode($obs->getCaValor());
                }
            }
            
            switch ($indicador->getCaEstado()) {
                case 0:
                    if (strlen($datos->observaciones) < 1 && strlen($idexclusion) < 1) {
                        $tagIdg = '<img src="/images/16x16/alert.png" title="'. utf8_encode($idg->getCaNombre()).":".$indicador->getCaIdg().'"/>';                                
                    } else {                                
                        $tagIdg = '<img src="/images/16x16/alert_disabled.png" title="'.utf8_encode($idg->getCaNombre()).":".$indicador->getCaIdg().'&#013;Observacion: '.$exclusion.'"/>';
                    }
                    break;
                case 1;
                    $tagIdg = '<img src="/images/16x16/button_ok.gif" title="'.utf8_encode($idg->getCaNombre()).":".$indicador->getCaIdg().'"/>';                            
                    break;
            }
            
            $datos = array(
                "id"=>$indicador->getCaId(), 
                "idg"=>$indicador->getCaIdindicador(), 
                "valor"=>$indicador->getCaIdg(), 
                "estado"=>$indicador->getCaEstado(), 
                "idexclusion"=>$idexclusion, 
                "exclusion"=>$exclusion, 
                "observaciones"=>$datos->observaciones
            );
                    
            $tag = $tagIdg;
                    
            return array("sucess"=>true, "datos"=>$datos, "tag"=>$tag);
        }else{
            return array("sucess"=>false);
        }
    }
}
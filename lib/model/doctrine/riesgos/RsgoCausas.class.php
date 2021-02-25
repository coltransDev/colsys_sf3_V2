<?php

/**
 * RsgoCausas
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class RsgoCausas extends BaseRsgoCausas
{
    
     /*
     * Retorna la fecha m�s alta de creaci�n de las causas
     * @author: Andres Botero
     */

    public function getMaxFchCreado($idriesgo) {
        
        $q = Doctrine::getTable("RsgoCausas")
                ->createQuery("c")
                ->select("max(ca_fchcreado) AS maxCluster")
                ->where("c.ca_idriesgo = ?", $idriesgo)
                ->fetchOne();
        
        return $q->maxCluster;
    }
    
    public function getMaxRegistro($idriesgo) {
        
        $q = Doctrine::getTable("RsgoCausas")
                ->createQuery("c")
                ->select("max(ca_idcausa) AS maxIdcausa")
                ->where("c.ca_idriesgo = ?", $idriesgo)
                ->fetchOne();
        
        return $q->maxIdcausa;
    }
}

<?php

/**
 * InoComprobante
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
 */
class InoComprobante extends BaseInoComprobante
{

    const ABIERTO = 0;
    const PARA_TRANSFERIR = 1;
    const TRANSFERIDO = 1;

    public function getValor(){
        $tipo = $this->getInoTipoComprobante();

        $q = Doctrine::getTable("InoTransaccion")
                  ->createQuery("t");
        if( $tipo->isDb() ){
            $q->select("SUM(t.ca_cr)-SUM(t.ca_db)");
        }else{
            $q->select("SUM(t.ca_db)-SUM(t.ca_cr)");
        }
        $q->addWhere("t.ca_idcomprobante = ?", $this->getCaIdcomprobante());
        $q->addWhere("t.ca_idcuenta = ?", $tipo->getCaIdctaCierre());
        $val = $q->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)->execute();
        return $val;
    }
    
}
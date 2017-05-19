<?php

/**
 * InoMaster
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class InoMaster extends BaseInoMaster
{
    private $vlrFacturado = null;
    private $vlrNotasCredito = null;
    private $vlrDeducciones = null;
    private $vlrCosto = null;
    private $vlrSobreventa = null;
    
    public function getVlrFacturado(){
        if( $this->vlrFacturado===null ){
            $this->vlrFacturado = Doctrine::getTable("InoComprobante")
                       ->createQuery("c")
                       ->innerJoin("c.InoHouse h")
                       ->innerJoin("c.InoTipoComprobante t")
                       ->innerJoin("h.InoMaster m")
                       ->select("SUM(c.ca_valor*c.ca_tcambio)")
                       ->addWhere("m.ca_idmaster = ? ", $this->getCaIdmaster())
                       ->addWhere("t.ca_tipo =?", "F")
		       ->addWhere("c.ca_fchanulado is null")
                       //->addWhere("c.ca_estado =?", InoComprobante::TRANSFERIDO)
                       ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)        
                       ->execute();
        }
        
        if( $this->vlrNotasCredito===null ){
            $this->vlrNotasCredito = Doctrine::getTable("InoComprobante")
                       ->createQuery("c")
                       ->innerJoin("c.InoHouse h")
                       ->innerJoin("c.InoTipoComprobante t")
                       ->innerJoin("h.InoMaster m")
                       ->select("SUM(c.ca_valor*c.ca_tcambio)")
                       ->addWhere("m.ca_idmaster = ? ", $this->getCaIdmaster())
                       ->addWhere("t.ca_tipo =?", "C")
		       ->addWhere("c.ca_fchanulado is null")
                       //->addWhere("c.ca_estado =?", InoComprobante::TRANSFERIDO)
                       ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)        
                       ->execute();
        }
        return $this->vlrFacturado-$this->vlrNotasCredito;
    }

    public function getVlrDeducciones(){
        if( $this->vlrDeducciones===null ){
             $q= Doctrine::getTable("InoDeduccion")
                       ->createQuery("d")
                       ->innerJoin("d.InoComprobante c")
                       ->innerJoin("c.InoHouse h")
                       ->innerJoin("h.InoMaster m")
                       ->select("SUM(d.ca_neto*d.ca_tcambio)")
                       ->addWhere("m.ca_idmaster = ?", $this->getCaIdmaster())
                       ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR);
            $this->vlrDeducciones=$q->execute();
            
        }
        return $this->vlrDeducciones;
    }
    
    
    public function getVlrCosto(){
        if( $this->vlrCosto===null ){
            $this->vlrCosto = Doctrine::getTable("InoCosto")
                       ->createQuery("c")                       
                       ->innerJoin("c.InoMaster m")
                       ->select("SUM(c.ca_neto*c.ca_tcambio/ca_tcambio_usd)")
                       ->addWhere("m.ca_idmaster = ?", $this->getCaIdmaster())
                       ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)        
                       ->execute();
        }
        return $this->vlrCosto;
    }
    
    public function getVlrSobreventa(){
        if( $this->vlrSobreventa===null ){
            $this->vlrSobreventa = Doctrine::getTable("InoUtilidad")
                       ->createQuery("u")                       
                       ->innerJoin("u.InoCosto c") 
                       ->innerJoin("c.InoMaster m")
                       ->select("SUM(u.ca_valor)")
                       ->addWhere("m.ca_idmaster = ?", $this->getCaIdmaster())
                       ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)        
                       ->execute();
        }
        return $this->vlrSobreventa;
    }
    
    public function getReadOnly(){
        return $this->getCaFchliquidado()||$this->getCaFchcerrado()||$this->getCaFchanulado();
    }
    
}

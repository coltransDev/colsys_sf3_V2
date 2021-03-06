<?php

/**
 * RepExpo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
class RepExpo extends BaseRepExpo
{
    public function getTipoExpo(){

		$modalidad = ParametroTable::retrieveByCaso("CU011", null, null, $this->getCaTipoexpo() );

		if( $modalidad ){
			return $modalidad[0]->getCaValor();
		}else{
			return null;
		}
	}


	public function getTransportadorTerrestre( $con = null ){
		return Doctrine::getTable("IdsProveedor")->find($this->getCaIdlineaterrestre());
	}

    public function getSia( ){
        if($this->getCaIdsia())
        {
            $sia=Doctrine::getTable("Sia")->find($this->getCaIdsia());
            if($sia)
                return $sia->getCaNombre();
        }
        return "";

    }
    
    public function getEsAduana( ){
        
        if($this->getCaIdsia()==17) { // COLMAS
            return true;
        }
        return false;

    }
    
    public function getReferenciaAduana( ){
        
        $reporte = $this->getReporte();
        
        $rep = Doctrine::getTable("RepExpo")
                ->createQuery("re")
                ->select("re.ca_refaduana")
                ->innerJoin("re.Reporte r")
                ->where("r.ca_consecutivo = ? AND re.ca_refaduana IS NOT NULL",array($this->getReporte()->getCaConsecutivo()))
                ->fetchOne();
        
        if($rep)
            return $rep->getCaRefaduana();
        else
            return null;

    }

}
<?php

/**
 * InoEquiposSea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
class InoEquiposSea extends BaseInoEquiposSea
{
    public function getInoContratosSea(){
        return Doctrine::getTable("InoContratosSea")
                        ->createQuery("c")
                        ->where("c.ca_referencia = ?", $this->getcaReferencia())
                        ->addWhere("c.ca_idequipo = ?", $this->getCaIdequipo())
                        ->fetchOne();

    }
}
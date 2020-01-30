<?php

/**
 * InvCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class InvCategory extends BaseInvCategory
{
    public function getPrefijo( $idsucursal ){
        
        $parent = $this->getParent();
        $pref = null;
        if( $parent ){
            $pref = Doctrine::getTable("InvPrefijo")
                              ->createQuery("p")                                      
                              ->addWhere("p.ca_idsucursal = ?", $idsucursal)
                              ->addWhere("p.ca_idcategory = ?", $parent->getCaIdcategory() )
                              ->fetchOne();
           
        }
        
        if( !$pref || $pref&&!$pref->getCaPrefix() ){
            $pref = Doctrine::getTable("InvPrefijo")
                              ->createQuery("p")                                      
                              ->addWhere("p.ca_idsucursal = ?", $idsucursal)
                              ->addWhere("p.ca_idcategory = ?", $this->getCaIdcategory() )
                              ->fetchOne();
        }
        return $pref;        
        
    }
    
    public function getActiveItemsByCategory(){
        
        $activos = Doctrine::getTable("InvActivo")
                ->createQuery("a")
                ->where("a.ca_fchbaja IS NULL")
                ->andWhere("a.ca_idcategory = ?", $this->getCaIdcategory())
                ->execute();
        
        return $activos;
    }    
}
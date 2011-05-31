<?php

/**
 * subastas actions.
 *
 * @package    symfony
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class subastasComponents extends sfComponents {
    

    public function executeListaOfertas() {
            $this->valor = Doctrine::getTable("SubOferta")
                               ->createQuery("o")
                               ->select("MAX(ca_valor)") 
                               ->addWhere("o.ca_idarticulo = ? ", $this->articulo->getCaIdarticulo())
                               ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                               ->execute();  
            $this->ofertas = Doctrine::getTable("SubOferta")
                               ->createQuery("o")                               
                               ->addWhere("o.ca_idarticulo = ? ", $this->articulo->getCaIdarticulo())
                               ->addOrderBy("ca_fchcreado DESC")        
                               ->execute();  
    }
        
    

}


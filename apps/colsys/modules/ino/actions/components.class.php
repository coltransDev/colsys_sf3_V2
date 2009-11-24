<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * ino components.
 *
 * @package    colsys
 * @subpackage ino
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */

class inoComponents extends sfComponents
{
    
    public function executeClientes(){
        $this->inoClientes = Doctrine::getTable("InoCliente")
                                 ->createQuery("c")
                                 ->select("c.*")
                                 ->innerJoin("c.Cliente cl")
                                 ->where("c.ca_idmaestra = ?", $this->referencia->getCaIdmaestra())
                                 ->addOrderBy( "cl.ca_compania" )
                                 ->execute();
    }

    public function executeIngresos(){
        
    }


    public function executeFormComprobantePanel(){

    }

    public function executeFormComprobanteSubpanel(){
        /*$impoexpo = $this->reporte->getCaImpoexpo();
        if( $impoexpo==Constantes::TRIANGULACION ){
            $impoexpo=Constantes::IMPO;
        }*/
        $this->recargos = Doctrine::getTable("InoConcepto")
                                     ->createQuery("c")
                                     ->select("ca_idconcepto,ca_concepto")
                                     //->addWhere("c.ca_tipo = ? ", Constantes::RECARGO_LOCAL )
                                     ->addWhere("c.ca_idcuenta IS NOT NULL" )
                                     /*->addWhere("c.ca_impoexpo LIKE ? ", $impoexpo )
                                     ->addWhere("c.ca_transporte LIKE ? ", $this->reporte->getCaTransporte() )*/
                                     ->addOrderBy("c.ca_concepto")
                                     ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                     ->execute();

         foreach( $this->recargos as $key=>$val){
             $this->recargos[$key]['ca_concepto'] = utf8_encode($this->recargos[$key]['ca_concepto']);

         }
    }
}


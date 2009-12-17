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

class inocostosComponents extends sfComponents
{
    
   
    public function executeFormComprobantePanel(){
        if( !$this->comprobante->getCaIdcomprobante() ){
            $tipos = Doctrine::getTable("InoTipoComprobante")
                                         ->createQuery("t")
                                         ->select("t.ca_idtipo, t.ca_tipo, t.ca_comprobante, t.ca_titulo, e.ca_sigla")
                                         ->innerJoin("t.IdsSucursal s")
                                         ->innerJoin("s.Ids i")
                                         ->innerJoin("i.IdsEmpresa e")
                                         //->where("e.ca_sigla = ?", "Coltrans")
                                         ->addWhere("t.ca_tipo = ?", "P")
                                         ->addOrderBy("t.ca_tipo, t.ca_comprobante")
                                         ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                         ->execute();
            $tiposArray = array();
            foreach( $tipos as $tipo ){
                $tiposArray[] = array("idtipo"=>$tipo["t_ca_idtipo"], "tipo"=>utf8_encode($tipo["e_ca_sigla"]." ".$tipo["t_ca_tipo"]."-".str_pad($tipo["t_ca_comprobante"], 2, "0", STR_PAD_LEFT)." ".$tipo["t_ca_titulo"]));
            }

            $this->tipos = array("root"=>$tiposArray, "total"=>count($tiposArray));
            //$this->tipos = $tiposArray;
           
        }

        $this->ids = Doctrine::getTable("Ids")->find($this->comprobante->getCaId());

    }

    public function executeFormComprobanteSubpanel(){
        /*$impoexpo = $this->reporte->getCaImpoexpo();
        if( $impoexpo==Constantes::TRIANGULACION ){
            $impoexpo=Constantes::IMPO;
        }*/
        $this->recargos = Doctrine::getTable("InoConcepto")
                                     ->createQuery("c")
                                     ->select("ca_idconcepto,ca_concepto, cc.ca_idccosto, cc.ca_centro, cc.ca_subcentro, cc.ca_nombre")
                                     ->innerJoin("c.InoParametroCosto p")
                                     ->innerJoin("p.InoCentroCosto cc")
                                     //->innerJoin("cc.CentroCosto cp")
                                     ->innerJoin("c.InoConceptoModalidad cm")
                                     ->innerJoin("cm.Modalidad m")
                                     //->addWhere("c.ca_tipo = ? ", Constantes::RECARGO_LOCAL )
                                     ->addWhere("p.ca_idcuenta IS NOT NULL" )
                                     //->addWhere("m.ca_impoexpo LIKE ? ", $impoexpo )
                                     //->addWhere("m.ca_transporte LIKE ? ", $this->reporte->getCaTransporte() )
                                     ->addOrderBy("c.ca_concepto")
                                     ->distinct()
                                     ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                     ->execute();

         $centros = Doctrine::getTable("InoCentroCosto")
                              ->createQuery("c")
                              ->select("c.*")
                              ->where("c.ca_subcentro IS NULL")
                              ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                              ->execute();
         $centrosArray = array();
         foreach( $centros as $centro ){
            $centrosArray[ $centro["c_ca_centro"] ] = $centro["c_ca_nombre"];
         }
         foreach( $this->recargos as $key=>$val){
             $this->recargos[$key]['concepto'] = utf8_encode($centrosArray[$this->recargos[$key]['cc_ca_centro']]." ".$this->recargos[$key]['cc_ca_nombre']." » ".$this->recargos[$key]['c_ca_concepto']);
             $this->recargos[$key]['centro'] = str_pad($this->recargos[$key]['cc_ca_centro'], 2, "0", STR_PAD_LEFT)."-".str_pad($this->recargos[$key]['cc_ca_subcentro'], 2, "0", STR_PAD_LEFT);
             $this->recargos[$key]['codigo'] = str_pad($this->recargos[$key]['cc_ca_centro'], 2, "0", STR_PAD_LEFT).str_pad($this->recargos[$key]['cc_ca_subcentro'], 2, "0", STR_PAD_LEFT).str_pad($this->recargos[$key]["c_ca_idconcepto"], 4, "0", STR_PAD_LEFT);
         }
    }
}



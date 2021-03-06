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
 * @subpackage inocomprobantes
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */

class inorcComponents extends sfComponents
{
    
    


    public function executeFormComprobantePanel(){
        

            $q = Doctrine::getTable("InoTipoComprobante")
                                         ->createQuery("t")
                                         ->select("t.ca_idtipo, t.ca_tipo, t.ca_comprobante, t.ca_titulo, e.ca_sigla")
                                         /*->innerJoin("t.IdsSucursal s")
                                         ->innerJoin("s.Ids i")
                                         ->innerJoin("i.IdsEmpresa e")*/

                                         ->addWhere("t.ca_tipo = ?", $this->tipo)
                                         ->addOrderBy("t.ca_tipo, t.ca_comprobante");

            /*if( isset($this->empresa) ){
                $q->addWhere("e.ca_sigla = ?", $this->empresa );                
            }*/
                                         

            $tipos = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->execute();
            $tiposArray = array();
            foreach( $tipos as $tipo ){
                $tipoStr = "";
                if( !isset($this->empresa) ){
                   // $tipoStr .= $tipo["e_ca_sigla"]." ? ";
                }
                $tipoStr .= $tipo["t_ca_tipo"]."-".str_pad($tipo["t_ca_comprobante"], 2, "0", STR_PAD_LEFT)." ".$tipo["t_ca_titulo"];
                $tiposArray[] = array("idtipo"=>$tipo["t_ca_idtipo"], "tipo"=>utf8_encode($tipoStr));
            }

            $this->tipos = array("root"=>$tiposArray, "total"=>count($tiposArray));
           

    }

    public function executeFormComprobanteSubpanel(){
        
        $this->recargos = Doctrine::getTable("InoConcepto")
                                     ->createQuery("c")
                                     ->select("ca_idconcepto,ca_concepto, cc.ca_idccosto, cc.ca_centro, cc.ca_subcentro, cc.ca_nombre")
                                     ->innerJoin("c.InoParametroFacturacion p")
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
             $this->recargos[$key]['concepto'] = utf8_encode($centrosArray[$this->recargos[$key]['cc_ca_centro']]." ".$this->recargos[$key]['cc_ca_nombre']." ? ".$this->recargos[$key]['c_ca_concepto']);
             $this->recargos[$key]['centro'] = str_pad($this->recargos[$key]['cc_ca_centro'], 2, "0", STR_PAD_LEFT)."-".str_pad($this->recargos[$key]['cc_ca_subcentro'], 2, "0", STR_PAD_LEFT);
             $this->recargos[$key]['codigo'] = str_pad($this->recargos[$key]['cc_ca_centro'], 2, "0", STR_PAD_LEFT).str_pad($this->recargos[$key]['cc_ca_subcentro'], 2, "0", STR_PAD_LEFT).str_pad($this->recargos[$key]["c_ca_idconcepto"], 4, "0", STR_PAD_LEFT);
         }
    }

    
}



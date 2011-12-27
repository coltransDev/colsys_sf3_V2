<?php

/**
 * inoReportes actions.
 *
 * @package    symfony
 * @subpackage inoReportes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inoReportesActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
    }
    
    
    /**
     *  
     *
     * @param sfRequest $request A request object
     */
    public function executeCuadroIno(sfWebRequest $request) {
        
    }
    
    /**
     *  
     *
     * @param sfRequest $request A request object
     */
    public function executeCuadroInoResult(sfWebRequest $request) {
        
        $aa = $request->getParameter("aa");        
        $q = Doctrine::getTable("InoMaster") 
                ->createQuery("m")
                ->innerJoin("m.Origen o")
                ->innerJoin("m.Destino d")
                ->innerJoin("m.IdsProveedor p")
                ->innerJoin("p.Ids i")
                ->leftJoin("m.InoViCosto cost")
                ->leftJoin("m.InoViIngreso ing")
                ->leftJoin("m.InoViDeduccion ded")
                ->leftJoin("m.InoViUtilidad uti")
                ->leftJoin("m.InoViUnidadesMaster uni")
                ->select("m.ca_idmaster, m.ca_referencia, uni.ca_numhijas, uni.ca_numpiezas, uni.ca_peso, uni.ca_volumen, 
                            o.ca_ciudad, d.ca_ciudad, p.ca_idproveedor, i.ca_nombre, 
                            cost.ca_valor, cost.ca_venta, ing.ca_valor, ded.ca_valor, uti.ca_valor, m.ca_fchcerrado, m.ca_fchliquidado, m.ca_observaciones")
                ->addWhere("substr(m.ca_referencia,15,1) = ?", $aa%10 );
                
        $impoexpo = $request->getParameter("impoexpo");
        $transporte = $request->getParameter("transporte");
        $idlinea = $request->getParameter("idlinea");
        $idtrafico = $request->getParameter("idtrafico");        
        $modalidad = $request->getParameter("modalidad");
        $idagente = $request->getParameter("idagente");
        $aa = $request->getParameter("aa");
        $mm = $request->getParameter("mm");
        
        if( $impoexpo ){
            $q->addWhere("m.ca_impoexpo = ? ", $impoexpo);
        }
        
        if( $transporte ){
            $q->addWhere("m.ca_transporte = ? ", $transporte);
        }
        
        if( $modalidad ){
            $q->addWhere("m.ca_modalidad = ? ", $modalidad);
        }
        
        if( $idtrafico ){
            if( $impoexpo==Constantes::EXPO ){
                $q->addWhere("m.ca_destino = ? ", $idtrafico);
            }else{
                $q->addWhere("m.ca_origen = ? ", $idtrafico);
            }
        }
        
        if( $idlinea ){
            $q->addWhere("m.ca_idlinea = ? ", $idlinea);
        }
        
        if( $idagente ){
            $q->addWhere("m.ca_idagente = ? ", $idagente);
        }
        
        if( $mm ){
            $q->addWhere("SUBSTR(m.ca_referencia,8,2) = ? ", str_pad($mm, 2, "0", STR_PAD_LEFT ));
        }
        
        if( $aa ){
            $q->addWhere("SUBSTR(m.ca_referencia,15,1) = ? ", $aa%10);
        }
        
        
        
        $this->refs = $q->setHydrationMode(Doctrine::HYDRATE_ARRAY)->execute();
                
        
        // select d.ca_referencia, b.ca_ciudad, d.ca_destino, c.ca_nombre, d.ca_peso, case when d.ca_fchcerrado IS NULL then 0 else 1 end, a.ca_nombre, d.ca_pesovolumen from tb_inomaestra_air d, tb_ciudades b, vi_transporlineas c, tb_traficos a where substr(d.ca_referencia,8,2) like ?  and substr(d.ca_referencia,15,1) like ? and d.ca_origen = b.ca_idciudad and b.ca_idtrafico like ? and d.ca_idlinea = c.ca_idlinea and b.ca_idtrafico = a.ca_idtrafico and d.ca_referencia in (select ca_referencia from tb_inoclientes_air ic, vi_usuarios u where ic.ca_loginvendedor = u.ca_login and u.ca_sucursal like ?)
    }
    
    
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeListadoComprobantes(sfWebRequest $request) {

            
        if( $request->isMethod("post") ){
            $tipo = $request->getParameter("tipo");
            
            if( $tipo == "F" ){
            
                $q = Doctrine::getTable("InoComprobante")
                                    ->createQuery("c")
                                    ->innerJoin("c.Ids id")                            
                                    ->leftJoin("c.InoHouse h")
                                    ->leftJoin("h.InoMaster m")
                                    ->select("c.ca_consecutivo, c.ca_fchcomprobante, id.ca_nombre, id.ca_id, h.ca_doctransporte, m.ca_referencia");


                if( $request->getParameter("fecIni") ){
                    $q->addWhere("c.ca_fchcomprobante >=? ", $request->getParameter("fecIni") );
                }

                if( $request->getParameter("fecFin") ){
                    $q->addWhere("c.ca_fchcomprobante <=? ", $request->getParameter("fecFin") );
                }
                
                
                $orden = $request->getParameter("orden");
                switch( $orden ){
                    case "referencia":
                        $q->addOrderBy("ca_referencia ASC"); 
                        break;
                    case "comprobante":
                        $q->addOrderBy("ca_consecutivo ASC"); 
                        break;
                    case "fchcomprobante":
                        $q->addOrderBy("ca_fchcomprobante ASC"); 
                        break;
                    case "nombre":
                        $q->addOrderBy("id.ca_nombre ASC"); 
                        break;
                    case "doctransporte":
                        $q->addOrderBy("h.ca_doctransporte ASC"); 
                        break;
                }
                
                $this->comps = $q->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                    ->execute();
                $this->setTemplate("listadoComprobantesResult");
            }
            
            
            if( $tipo == "P" ){
            
                $q = Doctrine::getTable("InoCosto")
                                    ->createQuery("c")
                                    ->innerJoin("c.Ids id")
                                    ->leftJoin("c.InoMaster m");
                                    //->select("c.ca_consecutivo, id.ca_nombre, id.ca_id, h.ca_doctransporte, m.ca_referencia");


                if( $request->getParameter("fecIni") ){
                    $q->addWhere("c.ca_fchfactura >=? ", $request->getParameter("fecIni") );
                }

                if( $request->getParameter("fecFin") ){
                    $q->addWhere("c.ca_fchfactura <=? ", $request->getParameter("fecFin") );
                }
                
                $orden = $request->getParameter("orden");
                switch( $orden ){
                    case "referencia":
                        $q->addOrderBy("ca_referencia ASC"); 
                        break;
                    case "comprobante":
                        $q->addOrderBy("ca_factura ASC"); 
                        break;
                    case "fchcomprobante":
                        $q->addOrderBy("ca_fchfactura ASC"); 
                        break;
                    case "nombre":
                        $q->addOrderBy("id.ca_nombre ASC"); 
                        break;
                    case "doctransporte":
                        $q->addOrderBy("m.ca_master ASC"); 
                        break;
                }

                $this->comps = $q->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                    ->execute();
                $this->setTemplate("listadoComprobantesProvResult");
            }
        
        }

    }

}

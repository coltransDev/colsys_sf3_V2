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
                ->select("m.ca_idmaster, m.ca_referencia, m.ca_peso, m.ca_volumen, 
                            o.ca_ciudad, d.ca_ciudad, p.ca_idproveedor, i.ca_nombre, 
                            cost.ca_valor, cost.ca_venta,ing.ca_valor")
                ->addWhere("substr(m.ca_referencia,15,1) = ?", $aa%10 );
                
        
        
        $this->refs = $q->setHydrationMode(Doctrine::HYDRATE_ARRAY)->execute();
                
        
        // select d.ca_referencia, b.ca_ciudad, d.ca_destino, c.ca_nombre, d.ca_peso, case when d.ca_fchcerrado IS NULL then 0 else 1 end, a.ca_nombre, d.ca_pesovolumen from tb_inomaestra_air d, tb_ciudades b, vi_transporlineas c, tb_traficos a where substr(d.ca_referencia,8,2) like ?  and substr(d.ca_referencia,15,1) like ? and d.ca_origen = b.ca_idciudad and b.ca_idtrafico like ? and d.ca_idlinea = c.ca_idlinea and b.ca_idtrafico = a.ca_idtrafico and d.ca_referencia in (select ca_referencia from tb_inoclientes_air ic, vi_usuarios u where ic.ca_loginvendedor = u.ca_login and u.ca_sucursal like ?)
    }

}

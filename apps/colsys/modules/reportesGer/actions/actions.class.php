<?php

/**
 * reportesGer actions.
 *
 * @package    colsys
 * @subpackage reportesGer
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class reportesGerActions extends sfActions
{
	/**
	* Muestra un menu donde el usuario puede seleccionar las comisiones que desa sacar 
	*
	* @param sfRequest $request A request object
	*/
	public function executeReporteComisionesVendedor(sfWebRequest $request)
	{
		$this->userid = $this->getUser()->getUserId();	
	}


	public function executeReporteCargaTraficos(sfWebRequest $request)
	{
        $this->fechainicial=$request->getParameter("fechaInicial");
        $this->fechafinal=$request->getParameter("fechaFinal");
        $this->idpais_origen=$request->getParameter("idpais_origen");
        $this->origen=$request->getParameter("origen");
        $this->idorigen=$request->getParameter("idorigen");
        $this->idpais_destino=$request->getParameter("idpais_destino");
        $this->destino=$request->getParameter("destino");
        $this->iddestino=$request->getParameter("iddestino");
        $this->idmodalidad=$request->getParameter("idmodalidad");
        $this->opcion=$request->getParameter("opcion");

        if($this->opcion)
        {
            $q = Doctrine::getTable("RepCargaTraficos")
                            ->createQuery("ct")
                            ->select("*")
                            ->where("(ca_fchreferencia between ? and ?) and ca_modalidad=?", array($this->fechainicial,$this->fechafinal,$this->idmodalidad))
                            ->setHydrationMode(Doctrine::HYDRATE_ARRAY);
            if($this->idpais_origen)
                $q->addWhere("ori_ca_idtrafico=?",$this->idpais_origen);
            if($this->idorigen)
                $q->addWhere("ca_origen=?",$this->idorigen);
            if($this->idpais_destino)
                $q->addWhere("des_ca_idtrafico=?",$this->idpais_destino);
            if($this->iddestino)
                $q->addWhere("ca_destino=?",$this->iddestino);
            
            $this->resul=$q->execute();
            
            
            
        }
		
	}
}
?>
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
        $this->fechaembinicial=$request->getParameter("fechaEmbInicial");
        $this->fechaembfinal=$request->getParameter("fechaEmbFinal");
        $this->fechaarrinicial=$request->getParameter("fechaArrInicial");
        $this->fechaarrfinal=$request->getParameter("fechaArrFinal");

        $this->idpais_origen=$request->getParameter("idpais_origen");
        $this->origen=$request->getParameter("origen");
        $this->idorigen=$request->getParameter("idorigen");
        $this->idpais_destino=$request->getParameter("idpais_destino");
        $this->destino=$request->getParameter("destino");
        $this->iddestino=$request->getParameter("iddestino");
        $this->idmodalidad=$request->getParameter("idmodalidad");
        $this->opcion=$request->getParameter("opcion");
        $this->idlinea=$request->getParameter("idlinea");
        $this->linea=$request->getParameter("linea");
        $this->incoterms=$request->getParameter("incoterms");

        $this->idagente=$request->getParameter("idagente");
        $this->agente=$request->getParameter("agente");
        $this->idsucursalagente=$request->getParameter("idsucursalagente");
        $this->sucursalagente=$request->getParameter("sucursalagente");

        if($this->opcion)
        {
            $q = Doctrine::getTable("RepCargaTraficos")
                            ->createQuery("ct")
                            ->select("*")
                            ->where("ca_modalidad=?", array($this->idmodalidad))
                            ->setHydrationMode(Doctrine::HYDRATE_ARRAY);

            if($this->fechainicial && $this->fechafinal)
                    $q->addWhere ("(ca_fchreferencia between ? and ?)",array($this->fechainicial,$this->fechafinal));
            if($this->fechaembinicial && $this->fechaembfinal)
                    $q->addWhere ("(ca_fchembarque between ? and ?)",array($this->fechaembinicial,$this->fechaembfinal));
            if($this->fechaarrinicial && $this->fechaarrfinal)
                    $q->addWhere ("(ca_fcharribo between ? and ?)",array($this->fechaarrinicial,$this->fechaarrfinal));
            if($this->idpais_origen)
                $q->addWhere("ori_ca_idtrafico=?",$this->idpais_origen);
            if($this->idorigen)
                $q->addWhere("ca_origen=?",$this->idorigen);
            if($this->idpais_destino)
                $q->addWhere("des_ca_idtrafico=?",$this->idpais_destino);
            if($this->iddestino)
                $q->addWhere("ca_destino=?",$this->iddestino);
            if($this->idlinea)
                $q->addWhere("ca_idlinea=?",$this->idlinea);

            if($this->incoterms)
                $q->addWhere("ca_incoterms like ?","%".$this->incoterms."%");

            if($this->idagente)
                    $q->addWhere("ca_idagente = ?",$this->idagente);

            if($this->idsucursalagente)
                    $q->addWhere("ca_idsucursalagente = ?",$this->idsucursalagente);
            
            $this->resul=$q->execute();
            
            
            
        }
		
	}
}
?>
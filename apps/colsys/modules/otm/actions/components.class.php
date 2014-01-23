<?php

/**
 * homepage components.
 *
 * @package    colsys
 * @subpackage notificaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class otmComponents  extends sfComponents
{
	/**
	* Muestra las novedades de colsys
	*	
	*/
    const RUTINACARGASADUANA = 139;
	public function executeFiltrosListados()
    {
        $this->modalidad = $this->getRequestParameter("modalidad");
        $this->origen    = $this->getRequestParameter("origen");
        $this->idorigen  = $this->getRequestParameter("idorigen");
        $this->destino   = $this->getRequestParameter("destino");
        $this->iddestino = $this->getRequestParameter("iddestino");
        
        $this->etapa    = $this->getRequestParameter("etapa");
        $this->idetapa  = $this->getRequestParameter("idetapa");

        $this->noreporte    = $this->getRequestParameter("noreporte");
        $this->noreferencia  = $this->getRequestParameter("noreferencia");
        //echo $this->etapa;
        $this->fechaInicial = $this->getRequestParameter("fechaInicial");
        $this->fechaFinal = $this->getRequestParameter("fechaFinal");
        
        $this->semanaIni = $this->getRequestParameter("semanaIni");
        $this->semanaFin = $this->getRequestParameter("semanaFin");
        
        if($this->url=="")
            $this->url="otm/listaAprobacion";        
        
        $this->semanas=array();
        for($i=1;$i<53;$i++)
        {
            $this->semanas[]=array("id"=>$i,"valor"=>$i) ;
        }
    }
    
    public function executeGridProgramacionCarga()
    {
        $this->nivel = $this->getUser()->getNivelAcceso( self::RUTINACARGASADUANA );
        $this->campos=array();
        if($this->nivel==1)
        {
            $this->campos=array("semana","referencia","cliente","mercancia","modalidad","origen","destino","piezas","peso","volumen","observaciones","fchsalida","doctransporte","venta");
        }
        else if($this->nivel==2) {
            $this->campos=array("neta","transportador");
        }
        else if($this->nivel==3) {
            $this->campos=array("semana","referencia","cliente","mercancia","modalidad","origen","destino","piezas","peso","volumen","observaciones","fchsalida","doctransporte","neta","venta","transportador");
        }
        
        $this->semanas=array();
        for($i=date("W");$i<53;$i++)
        {
            $this->semanas[]=array("id"=>$i,"valor"=>$i) ;
        }
    }
    
    public function executeFiltrosProgCargas()
    {
        $this->semanas=array();
        for($i=1;$i<53;$i++)
        {
            $this->semanas[]=array("id"=>$i,"valor"=>$i) ;
        }
    }
    
}
?>
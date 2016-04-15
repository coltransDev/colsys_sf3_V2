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
    
    public function executeFiltrosEstadisticasOtm(){
   
        $this->origen = $this->getRequestParameter("origen");
        $this->idorigen = $this->getRequestParameter("idorigen");
        $this->destino = $this->getRequestParameter("destino");
        $this->iddestino = $this->getRequestParameter("iddestino");
        $this->idmodalidad = $this->getRequestParameter("idmodalidad");
        $this->sucursal = $this->getRequestParameter("sucursal");
        $this->idsucursal = $this->getRequestParameter("idsucursal");
        $this->linea = $this->getRequestParameter("linea");
        $this->idlinea = $this->getRequestParameter("idlinea");
        $this->vendedor = $this->getRequestParameter("vendedor");
        $this->login = $this->getRequestParameter("login");
        $this->idcliente = $this->getRequestParameter("idtercero");        
        $this->idimportador = $this->getRequestParameter("idimportador");
        $this->opcion = $this->getRequestParameter("opcion");
        
        $this->fechaInicial = $this->getRequestParameter("fechaInicial");
        $this->fechaFinal = $this->getRequestParameter("fechaFinal");
        
        $this->nempresa = $this->getRequestParameter("nempresa");
        $this->tipo = $this->getRequestParameter("tipo");
        
        if($this->idcliente){
            $tercero = Doctrine::getTable("Tercero")->find($this->idcliente);
            $this->cliente =  $tercero->getCaNombre();
        }
        
        if($this->idimportador){
            $importador = Doctrine::getTable("Tercero")->find($this->idimportador);
            $this->importador =  $importador->getCaNombre();
        }
        
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/SuperBoxSelect", 'last');
        
        $this->meses = array();        
        $this->meses[]=array("valor"=>"a-Enero"       ,"id"=>1);
        $this->meses[]=array("valor"=>"b-Febrero"     ,"id"=>2);
        $this->meses[]=array("valor"=>"c-Marzo"       ,"id"=>3);
        $this->meses[]=array("valor"=>"d-Abril"       ,"id"=>4);
        $this->meses[]=array("valor"=>"e-Mayo"        ,"id"=>5);
        $this->meses[]=array("valor"=>"f-Junio"       ,"id"=>6);
        $this->meses[]=array("valor"=>"g-Julio"       ,"id"=>7);
        $this->meses[]=array("valor"=>"h-Agosto"      ,"id"=>8);
        $this->meses[]=array("valor"=>"i-Septiembre"  ,"id"=>9);
        $this->meses[]=array("valor"=>"j-Octubre"     ,"id"=>10);
        $this->meses[]=array("valor"=>"k-Noviembre"   ,"id"=>11);
        $this->meses[]=array("valor"=>"l-Diciembre"   ,"id"=>12);
        
        $this->anos = array();
        $ano = date("Y");
        
        for($i=2012;$i<=$ano; $i++){
            $this->anos[]=array("valor"=>$i, "id"=>$i);
        }
        //$this->anos[]=array("valor"=>"2012"    ,"id"=>2012);
        //$this->anos[]=array("valor"=>"2013"    ,"id"=>2013);
        //$this->anos[]=array("valor"=>"2014"    ,"id"=>2014);        
        
        $this->nano = $this->getRequestParameter("nano");
        $this->nmes = $this->getRequestParameter("nmes");
    
    }
    
}
?>
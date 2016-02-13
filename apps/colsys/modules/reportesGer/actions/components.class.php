<?php

/**
 * reportesGer components.
 *
 * @package    colsys
 * @subpackage reportesGer
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class reportesGerComponents extends sfComponents
{
	 /*
	* Panel que muestra un arbol con opciones de busqueda
	* @author: Andres Botero
	*/
    public function executePanelConsulta( ){
        

    }



     /*
	* Panel que muestra un arbol con opciones de busqueda
	* @author: Andres Botero
	*/
    public function executeReporteInoPanel( ){
        
    }

    /*
	* Lista de campos que se mostrarqan en el reporte
	* @author: Andres Botero
	*/
    public function executeListaCamposGridPanel( ){        
       $response = sfContext::getInstance()->getResponse();
       $response->addJavaScript("extExtras/CheckColumn",'last');

    }

    /*
	* Lista de campos que se mostrarqan en el reporte
	* @author: Andres Botero
	*/
    public function executeListaFiltrosGridPanel( ){

        

    }

    public function executeFiltrosEstadisticasTraficos()
    {
        $this->opcion=$this->getRequestParameter("opcion");
        $this->fechainicial=$this->getRequestParameter("fechaInicial");
        $this->fechafinal=$this->getRequestParameter("fechaFinal");        
        $this->idsucursal = $this->getRequestParameter("idsucursal");
        $this->sucursal = $this->getRequestParameter("sucursal");
        $this->iddepartamento = $this->getRequestParameter("iddepartamento");
        $this->departamento = $this->getRequestParameter("departamento");
        $this->idtransporte = $this->getRequestParameter("idtransporte");
        $this->transporte = $this->getRequestParameter("transporte");
        
        $this->action=$this->getContext()->getActionName ();
    }
    
    public function executeFiltrosEstadisticasIndicadoresClientes()
    {
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/Spinner.js", 'last');
        $response->addJavaScript("extExtras/SpinnerField.js", 'last');
        $response->addJavaScript("extExtras/NumberFieldMin.js", 'last');
        
        $response->addStyleSheet("extExtras/Spinner.css",'last');
        
        $this->transporte = $this->getRequestParameter("transporte");
        $this->opcion=$this->getRequestParameter("opcion");        
        $this->idcliente=$this->getRequestParameter("idcliente");
        $this->cliente=$this->getRequestParameter("Cliente");
        $this->fechainicial = $this->getRequestParameter("fechaInicial");
        $this->fechafinal = $this->getRequestParameter("fechaFinal");   
        $this->metalcl = $this->getRequestParameter("meta_lcl");   
        $this->metafcl = $this->getRequestParameter("meta_fcl"); 
        $this->meta_air = $this->getRequestParameter("meta_air"); 
        $this->idpais_origen=$this->getRequestParameter("idpais_origen");
        $this->pais_origen=$this->getRequestParameter("pais_origen");
        $this->corigen = $this->getRequestParameter("corigen");
        $this->cdestino = $this->getRequestParameter("cdestino");
        $this->idorigen = $this->getRequestParameter("idorigen");
        $this->iddestino = $this->getRequestParameter("iddestino");
        $this->typeidg = $this->getRequestParameter("type_idg");
        $this->checkOrigen = $this->getRequestParameter("checkOrigen");
        $this->checkDestino = $this->getRequestParameter("checkDestino");
    }

    public function executeFiltrosReporteDesconsolidacion()
    {
        $this->fechainicial=$this->getRequestParameter("fechaInicial");
        $this->fechafinal=$this->getRequestParameter("fechaFinal");        
    }
    
    public function executeFiltrosReporteRecibosCaja()
    {
        $this->fechainicial=$this->getRequestParameter("fechaInicial");
        $this->fechafinal=$this->getRequestParameter("fechaFinal");        
        $this->tipo=$this->getRequestParameter("tipo");
        $this->ntipo=$this->getRequestParameter("ntipo");
        $this->idsucursal = $this->getRequestParameter("idsucursal");
        $this->sucursal = $this->getRequestParameter("sucursal");
        $this->login = $this->getRequestParameter("login");
        $this->vendedor = $this->getRequestParameter("vendedor");
        
        //echo $this->tipo." ".$this->ntipo;
    }
    
    public function executeFormMenuImpresionblPanel(){
        
        $this->fechaInicial=$this->getRequestParameter("fechaInicial");
        $this->fechaFinal=$this->getRequestParameter("fechaFinal");
        
        $this->origen = $this->getRequestParameter("origen");
        $this->idorigen = $this->getRequestParameter("idorigen");
        
        $this->idagente = $this->getRequestParameter("idagente");
        $this->agente = $this->getRequestParameter("agente");
        
        $this->sucursal = $this->getRequestParameter("sucursal");
        $this->idSucursal = $this->getRequestParameter("idSucursal");
        
    }
    
    public function executeFormMenuEstadisticasExportaciones(){
        
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/SuperBoxSelect", 'last');
        
        $this->nmes = $this->getRequestParameter("nmes");
        $this->aa = $this->getRequestParameter("aa");
        
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
        
        $this->transporte = $this->getRequestParameter("transporte");
        $this->idmodalidad = $this->getRequestParameter("idmodalidad");
        $this->ciu_origen = $this->getRequestParameter("ciu_origen");
        $this->origen = $this->getRequestParameter("origen");
        $this->idpais_destino = $this->getRequestParameter("idpais_destino");
        $this->idagente = $this->getRequestParameter("idagente");
        $this->agente = $this->getRequestParameter("agente");
        $this->linea = $this->getRequestParameter("linea");
        $this->idlinea = $this->getRequestParameter("idlinea");
        $this->sucursal = $this->getRequestParameter("sucursal");
        $this->idSucursal = $this->getRequestParameter("idSucursal");
        $this->idcliente = $this->getRequestParameter("idcliente");
        $this->cliente = $this->getRequestParameter("cliente");
        $this->login = $this->getRequestParameter("login");
        $this->vendedor = $this->getRequestParameter("vendedor");
        $this->estado = $this->getRequestParameter("estado");
        
    }
    public function executeFormMenuCargaPorSucursal(){
        
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
        
        $this->aa = $this->getRequestParameter("aa");
        $this->nmes = $this->getRequestParameter("nmes");
        $this->mes = $this->getRequestParameter("mes");
        $this->idpais_origen = $this->getRequestParameter("idpais_origen");
        $this->pais_origen = $this->getRequestParameter("pais_origen");
        $this->idciuorigen = $this->getRequestParameter("idciuorigen");
        $this->ciuorigen = $this->getRequestParameter("ciuorigen");
        $this->idcliente = $this->getRequestParameter("idcliente");
        $this->cliente = $this->getRequestParameter("Cliente");
        $this->idsucursal = $this->getRequestParameter("idsucursal");
        $this->sucursal = $this->getRequestParameter("sucursal");
        $this->estado = $this->getRequestParameter("estado");        
        
    }
    
    public function executeFormReporteElaboracionCotizaciones(sfWebRequest $request){
        $this->annos = array();
        for ($i = (date("Y")); $i >= (date("Y") - 5); $i--) {
            $this->annos[] = $i;
        }

        // "%" => "Todos los Meses", 
        $this->meses = array();
        $this->meses[] = array("idmes" => "01", "nommes" => "Enero");
        $this->meses[] = array("idmes" => "02", "nommes" => "Febrero");
        $this->meses[] = array("idmes" => "03", "nommes" => "Marzo");
        $this->meses[] = array("idmes" => "04", "nommes" => "Abril");
        $this->meses[] = array("idmes" => "05", "nommes" => "Mayo");
        $this->meses[] = array("idmes" => "06", "nommes" => "Junio");
        $this->meses[] = array("idmes" => "07", "nommes" => "Julio");
        $this->meses[] = array("idmes" => "08", "nommes" => "Agosto");
        $this->meses[] = array("idmes" => "09", "nommes" => "Septiembre");
        $this->meses[] = array("idmes" => "10", "nommes" => "Octubre");
        $this->meses[] = array("idmes" => "11", "nommes" => "Noviembre");
        $this->meses[] = array("idmes" => "12", "nommes" => "Diciembre");
            
        //"01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre");
        
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select DISTINCT ca_nombre as ca_sucursal from control.tb_sucursales where ca_idempresa = 2 order by ca_sucursal";
        $rs = $con->execute($sql);
        $sucursales_rs = $rs->fetchAll();
        $this->sucursales = array();
        foreach ($sucursales_rs as $sucursal) {
            $this->sucursales[] = utf8_encode($sucursal["ca_sucursal"]);
        }
        
        $usuarios_rs = Doctrine::getTable("Usuario")
           ->createQuery("u")
           ->innerJoin("u.Sucursal s")
           ->addWhere("u.ca_departamento='Servicio al Cliente' or u.ca_cargo='Asistente Servicio al Cliente'")
           ->orderBy("u.ca_login")
           ->execute();
        $this->operativos = array();
        $this->operativos[] = array("id" => "%", "nombre" => "Usuarios (Todos)");
        foreach ($usuarios_rs as $usuario) {
             $this->operativos[] = array("id" => $usuario->getCaLogin(), "nombre" => utf8_decode($usuario->getCaNombre()));
        }
        
        
    }
}
?>
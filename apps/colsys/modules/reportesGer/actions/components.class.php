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
        $this->meses[] = array("idmes" => "%", "nommes" => "Todos");
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
    
    public function executeFormReporteReportesDeNegocio(sfWebRequest $request){
        $this->annos = array();
        for ($i = (date("Y")); $i >= (date("Y") - 5); $i--) {
            $this->annos[] = $i;
        }

        // "%" => "Todos los Meses", 
        $this->meses = array();
        $this->meses[] = array("idmes" => "%", "nommes" => "Meses (Todos)");
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

        $this->transportes = array();
        $this->transportes[] = utf8_encode(Constantes::AEREO);
        $this->transportes[] = utf8_encode(Constantes::MARITIMO);
        $this->transportes[] = utf8_encode(Constantes::TERRESTRE);
        
        $this->impoexpo = array();
        $this->impoexpo[] = utf8_encode(Constantes::IMPO);
        $this->impoexpo[] = utf8_encode(Constantes::EXPO);

        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select DISTINCT ca_nombre as ca_sucursal from control.tb_sucursales where ca_idempresa = 2 and ca_idsucursal != '999' order by ca_sucursal";
        $rs = $con->execute($sql);
        $sucursales_rs = $rs->fetchAll();
        $this->sucursales = array();
        $this->sucursales[] = "Sucursales (Todas)";
        foreach ($sucursales_rs as $sucursal) {
            $this->sucursales[] = utf8_encode($sucursal["ca_sucursal"]);
        }
        
        $usuarios_rs = Doctrine::getTable("Usuario")
           ->createQuery("u")
           ->innerJoin("u.Sucursal s")
           ->addWhere("u.ca_departamento='Comercial' or u.ca_cargo='Representante de Ventas'")
           ->orderBy("u.ca_login")
           ->execute();
        $this->vendedores = array();
        $this->vendedores[] = array("idUsuario" => "%", "usuario" => "Vendedores (Todos)", "sucursal" => "%");
        foreach ($usuarios_rs as $usuario) {
             $this->vendedores[] = array("idUsuario" => $usuario->getCaLogin(), "usuario" => utf8_encode($usuario->getCaNombre()), "sucursal" => utf8_encode(($usuario->getSucursal()->getCaNombre())));
        }
        
        $traficos_rs = Doctrine::getTable("Trafico")
           ->createQuery("t")
           ->addWhere("t.ca_idtrafico != '99-999'")
           ->addOrderBy("t.ca_nombre")
           ->execute();
        $this->traficos = array();
        $this->traficos[] = array("idTrafico" => "%", "trafico" => "Traficos (Todos)");
        foreach ($traficos_rs as $trafico) {
             $this->traficos[] = array("idTrafico" => $trafico->getCaIdtrafico(), "trafico" => utf8_encode($trafico->getCaNombre()));
        }
        
        $columnas = array();
        $columnas[] = array("text" => utf8_encode("Año"), "sql" => "to_char(ca_fchreporte, 'YYYY')", "alias" => "rp_annio", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Mes"), "sql" => "to_char(ca_fchreporte, 'MM')", "alias" => "rp_mes", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Consecutivo"), "sql" => "rp.ca_consecutivo", "alias" => "rp_ca_consecutivo", "leaf" => true, "default" => true, "groupBy" => false, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Versión"), "sql" => "rp.ca_version", "alias" => "rp_ca_version", "leaf" => true, "default" => false, "groupBy" => false, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Fch.Reporte"), "sql" => "rp.ca_fchreporte", "alias" => "rp_ca_fchreporte", "leaf" => true, "default" => false, "groupBy" => false, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Cotización"), "sql" => "rp.ca_idcotizacion", "alias" => "rp_ca_idcotizacion", "leaf" => true, "default" => false, "groupBy" => false, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Tráfico Org."), "sql" => "org.ca_idtrafico", "alias" => "trg_ca_nombre", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Puerto Org."), "sql" => "rp.ca_origen", "alias" => "org_ca_ciudad", "leaf" => true, "default" => false, "groupBy" => true, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Tráfico Dst."), "sql" => "dst.ca_idtrafico", "alias" => "tds_ca_nombre", "leaf" => true, "default" => false, "groupBy" => false, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Puerto Dst."), "sql" => "rp.ca_destino", "alias" => "dst_ca_ciudad", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Impo/Expo"), "sql" => "rp.ca_impoexpo", "alias" => "rp_ca_impoexpo", "leaf" => true, "default" => true, "groupBy" => false, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Agente"), "sql" => "agt.ca_nombre", "alias" => "agt_ca_nombre", "leaf" => true, "default" => false, "groupBy" => true, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Incoterms"), "sql" => "rprv.ca_incoterms", "alias" => "rprv_ca_incoterms", "leaf" => true, "default" => false, "groupBy" => false, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Descripción Mercancía"), "sql" => "rp.ca_mercancia_desc", "alias" => "rp_ca_mercancia_desc", "leaf" => true, "default" => false, "groupBy" => false, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Transporte"), "sql" => "rp.ca_transporte", "alias" => "rp_ca_transporte", "leaf" => true, "default" => false, "groupBy" => true, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Modalidad"), "sql" => "rp.ca_modalidad", "alias" => "rp_ca_modalidad", "leaf" => true, "default" => true, "groupBy" => false, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Transportista"), "sql" => "prv.ca_nombre", "alias" => "prv_ca_nombre", "leaf" => true, "default" => false, "groupBy" => true, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Cliente"), "sql" => "cli.ca_nombre", "alias" => "cli_ca_nombre", "leaf" => true, "default" => false, "groupBy" => true, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Vendedor"), "sql" => "usr.ca_nombre", "alias" => "usr_ca_nombre", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Sucursal"), "sql" => "suc.ca_nombre", "alias" => "suc_ca_nombre", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Elaboró"), "sql" => "rp.ca_usucreado", "alias" => "rp_ca_usucreado", "leaf" => true, "default" => false, "groupBy" => true, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Información Status"), "sql" => "", "alias" => "status", "leaf" => true, "default" => false, "groupBy" => false, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Datos/Carga"), "sql" => "", "alias" => "equipos", "leaf" => true, "default" => true, "groupBy" => false, "iconCls" => 'no-icon');
        $columnas[] = array("text" => utf8_encode("Tarifas"), "sql" => "", "alias" => "tarifas", "leaf" => true, "default" => false, "groupBy" => false, "iconCls" => 'no-icon');
        
        $this->columnas = array("fields" => $columnas);
        
    }    
}
?>
<?php

/**
 * gestDocumental components.
 *
 * @package    colsys
 * @subpackage config
 * @author     Mauricio Quinche
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class indicadoresAduComponents extends sfComponents
{
    
    
    public function executeFormCabControl() {
        
    }
    
    public function executeGridConsultaCabControl() {
        /*$this->fields=array(
            array("id"=>"ca_fecha"            , "name"=> "ETA"                      , "tipo"=>"date"),
            array("id"=>"ca_referencia"       , "name"=> "DO"),
            array("id"=>"ca_preinspeccion"    , "name"=> "Preinspeccion"),
            array("id"=>"ca_inspeccion"       , "name"=> "Inspeccion Dian"),
            array("id"=>"ca_consolidado"      , "name"=> "Consolidado"),
            array("id"=>"ca_contenedor"       , "name"=> "Contenedor"),
            array("id"=>"ca_tipocontenedor"   , "name"=> "Tipo Contenedor"),
            array("id"=>"ca_carpeta"          , "name"=> "Carpeta"),
            array("id"=>"ca_lognet"           , "name"=> "Lognet"),
            array("id"=>"ca_bl"               , "name"=> "Bl"),
            array("id"=>"ca_blimpresion"      , "name"=> "BL Impresion"),
            array("id"=>"ca_fabricante"       , "name"=> "Fabricante"),
            array("id"=>"ca_proveedor"        , "name"=> "Proveedor"),
            array("id"=>"ca_observaciones"    , "name"=> "Observaciones"),
            array("id"=>"ca_transportador"    , "name"=> "Transportador"),
            array("id"=>"ca_tipocarga"        , "name"=> "Tipo Carga"),
            array("id"=>"ca_valor"            , "name"=> "Valor"),
            array("id"=>"ca_fchcourrier"      , "name"=> "Courrier"                 , "tipo"=>"date"),
            array("id"=>"ca_fchbl"            , "name"=> "Fecha Bl"),
            array("id"=>"ca_factura"          , "name"=> "Factura"),
            array("id"=>"ca_fchfactura"       , "name"=> "Fecha Factura"            , "tipo"=>"date"),
            array("id"=>"ca_fchlistempaque"   , "name"=> "Fecha Lista Empaque"      , "tipo"=>"date"),
            array("id"=>"ca_certfletes"       , "name"=> "Cert. Fletes"),
            array("id"=>"ca_fchcertfletes"    , "name"=> "Fecha Cert. Fletes"       , "tipo"=>"date"),
            array("id"=>"ca_fchpago"          , "name"=> "Fecha Pago"               , "tipo"=>"date"),
            array("id"=>"ca_fchconsinv"       , "name"=> "Fecha Cons. Inventario"   , "tipo"=>"date"),
            array("id"=>"ca_fchrecepcion"     , "name"=> "Fecha Recepcion"          , "tipo"=>"date"),
            array("id"=>"ca_fchdescripciones" , "name"=> "Fecha Descripciones"      , "tipo"=>"date"),
            array("id"=>"ca_fchlevante"       , "name"=> "Fecha levante"            , "tipo"=>"date"),
            array("id"=>"ca_fchentregatrans"  , "name"=> "Fecha Entrega Trans."     , "tipo"=>"date"),
            array("id"=>"ca_embarque"         , "name"=> "Embarque")
        );*/
    }
    
    public function executeGridDetControl() {
        
    }
    
    public function executeFormIndicadores() {
        
        //$response = sfContext::getInstance()->getResponse();
	//$response->addJavaScript("highcharts/js/highcharts4.1/js/highcharts.js");
        
    }
    
    public function executeChartPie() {
        
    }
    
    public function executeGridFiltros() {
     
        $this->fields=array(
            array("id"=>"ca_fecha"            , "name"=> "ETA"                      , "tipo"=>"date"),
            array("id"=>"ca_referencia"       , "name"=> "DO"),
            array("id"=>"ca_preinspeccion"    , "name"=> "Preinspeccion"),
            array("id"=>"ca_inspeccion"       , "name"=> "Inspeccion Dian"),
            array("id"=>"ca_consolidado"      , "name"=> "Consolidado"),
            array("id"=>"ca_contenedor"       , "name"=> "Contenedor"),
            array("id"=>"ca_tipocontenedor"   , "name"=> "Tipo Contenedor"),
            array("id"=>"ca_carpeta"          , "name"=> "Carpeta"),
            array("id"=>"ca_lognet"           , "name"=> "Lognet"),
            array("id"=>"ca_bl"               , "name"=> "Bl"),
            array("id"=>"ca_blimpresion"      , "name"=> "BL Impresion"),
            array("id"=>"ca_fabricante"       , "name"=> "Fabricante"),
            array("id"=>"ca_proveedor"        , "name"=> "Proveedor"),
            array("id"=>"ca_observaciones"    , "name"=> "Observaciones"),
            array("id"=>"ca_transportador"    , "name"=> "Transportador"),
            array("id"=>"ca_tipocarga"        , "name"=> "Tipo Carga"),
            array("id"=>"ca_valor"            , "name"=> "Valor"),
            array("id"=>"ca_fchcourrier"      , "name"=> "Courrier"                 , "tipo"=>"date"),
            array("id"=>"ca_fchbl"            , "name"=> "Fecha Bl"),
            array("id"=>"ca_factura"          , "name"=> "Factura"),
            array("id"=>"ca_fchfactura"       , "name"=> "Fecha Factura"            , "tipo"=>"date"),
            array("id"=>"ca_fchlistempaque"   , "name"=> "Fecha Lista Empaque"      , "tipo"=>"date"),
            array("id"=>"ca_certfletes"       , "name"=> "Cert. Fletes"),
            array("id"=>"ca_fchcertfletes"    , "name"=> "Fecha Cert. Fletes"       , "tipo"=>"date"),
            array("id"=>"ca_fchpago"          , "name"=> "Fecha Pago"               , "tipo"=>"date"),
            array("id"=>"ca_fchconsinv"       , "name"=> "Fecha Cons. Inventario"   , "tipo"=>"date"),
            array("id"=>"ca_fchrecepcion"     , "name"=> "Fecha Recepcion"          , "tipo"=>"date"),
            array("id"=>"ca_fchdescripciones" , "name"=> "Fecha Descripciones"      , "tipo"=>"date"),
            array("id"=>"ca_fchlevante"       , "name"=> "Fecha levante"            , "tipo"=>"date"),
            array("id"=>"ca_fchentregatrans"  , "name"=> "Fecha Entrega Trans."     , "tipo"=>"date"),
            array("id"=>"ca_embarque"         , "name"=> "Embarque")
        );
    }
    
    
    
    public function executeGridFechaCierre() {
        
    }
    public function executeGridCabPlantilla() {
        
    }
    public function executeGridDetPlantilla() {
        
    }
    
    
}
?>

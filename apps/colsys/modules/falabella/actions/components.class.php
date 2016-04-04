<?php

/**
 * falabella actions.
 *
 * @package    colsys
 * @subpackage falabella
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class falabellaComponents extends sfComponents {
    /*
     *   Carga el Registro de la Cabecera
     */

    public function executeMainPanel() {
        $this->header = Doctrine::getTable("FalaHeader")
                ->createQuery("d")
                ->select("d.ca_iddoc, d.ca_reporte, d.ca_num_viaje, d.ca_cod_carrier, d.ca_container_mode, d.ca_numero_invoice, d.ca_monto_invoice_miles, d.ca_concepto, d.ca_documento_tipo")
                ->where("d.ca_iddoc = ? ", $this->fala_header->getCaIddoc())
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();

        $this->invoices = Doctrine::getTable("FalaFacturacion")
                ->createQuery("d")
                ->select("d.ca_numdocumento")
                ->where("d.ca_fcharchivado IS NULL")
                ->addWhere("d.ca_fchanulado IS NULL")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
        
        $this->container = ParametroTable::retrieveByCaso("CU084");
    }

    /*
     *   Carga los Registros del Detalle
     */

    public function executePanelDetalles() {
        //$this->details = $this->fala_header->getFalaDetail();

        $this->details = Doctrine::getTable("FalaDetail")
                ->createQuery("d")
                ->select("d.*")
                ->where("d.ca_iddoc = ? ", $this->fala_header->getCaIddoc())
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();

        $this->container = ParametroTable::retrieveByCaso("CU057");
    }

    /*
     *   Carga los Datos de la Factura
     */

    public function executePanelFacturacion() {

        $this->factura = array();
        if ( $this->getRequestParameter ( 'numdocumento' ) ){
            $this->numdocumento = base64_decode($this->getRequestParameter ( 'numdocumento' ));
            $this->factura = Doctrine::getTable("FalaFacturacion")
                    ->createQuery("d")
                    ->select("d.*")
                    ->where("d.ca_numdocumento = ?", $this->numdocumento)
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();
        }
        $this->factura[] = array("ca_numdocumento" => "", "orden" => "Z");
    }

    public function executeFormMenuIndicadoresPanel($request) {

        $this->grupos = Doctrine::getTable("HdeskGroup")
                ->createQuery("g")
                ->select("g.ca_idgroup, g.ca_name")
                ->distinct()
                ->addOrderBy("g.ca_idgroup")
                ->where("g.ca_iddepartament=13")
                ->execute();

        $this->idpais_origen = $this->getRequestParameter("idpais_origen");
        $this->pais_origen = $this->getRequestParameter("pais_origen");
        $this->opcion = $this->getRequestParameter("opcion");
        $this->fechainicial = $request->getParameter("fechaInicial");
        $this->fechafinal = $request->getParameter("fechaFinal");
        $this->idtransporte = $this->getRequestParameter("idtransporte");
        $this->transporte = $this->getRequestParameter("transporte");
    }
    
    public function executeGridDatosIdg($request) {
        
                
    }
    
    public function executeGridPanelObservaciones($request) {
        
        $this->periodos = array();        
        $this->periodos[]=array("id"=>1, "name"=>"Ene-Feb");
        $this->periodos[]=array("id"=>2, "name"=>"Mar-Abr");
        $this->periodos[]=array("id"=>3, "name"=>"May-Jun");
        $this->periodos[]=array("id"=>4, "name"=>"Jul-Ago");
        $this->periodos[]=array("id"=>5, "name"=>"Sep-Oct");
        $this->periodos[]=array("id"=>6, "name"=>"Nov-Dic");
        
        $this->graficas = array();        
        $this->graficas[]=array("id"=>1, "name"=>"Asn Performance Bimonthly");
        $this->graficas[]=array("id"=>3, "name"=>"Asn Performance by Origin Bimonthly");
        $this->graficas[]=array("id"=>5, "name"=>"Document Performance Bimonthly");
        $this->graficas[]=array("id"=>7, "name"=>"Departure Performance Bimonthly");
        $this->graficas[]=array("id"=>9, "name"=>"Load Performance");
        $this->graficas[]=array("id"=>11, "name"=>"Carrier Allocation");
        
    }
    
    public function executeGridPanelDatosWindow(sfWebRequest $request){
        
        $this->periodos = array();        
        $this->periodos[]=array("id"=>1, "name"=>"Ene-Feb");
        $this->periodos[]=array("id"=>2, "name"=>"Mar-Abr");
        $this->periodos[]=array("id"=>3, "name"=>"May-Jun");
        $this->periodos[]=array("id"=>4, "name"=>"Jul-Ago");
        $this->periodos[]=array("id"=>5, "name"=>"Sep-Oct");
        $this->periodos[]=array("id"=>6, "name"=>"Nov-Dic");
        
        $this->graficas = array();        
        $this->graficas[]=array("id"=>1, "name"=>"Asn Performance Bimonthly");
        $this->graficas[]=array("id"=>3, "name"=>"Asn Performance by Origin Bimonthly");
        $this->graficas[]=array("id"=>5, "name"=>"Document Performance Bimonthly");
        $this->graficas[]=array("id"=>7, "name"=>"Departure Performance Bimonthly");
        $this->graficas[]=array("id"=>9, "name"=>"Load Performance");
        $this->graficas[]=array("id"=>10, "name"=>"Volume By Origin");
        $this->graficas[]=array("id"=>11, "name"=>"Carrier Allocation");
        
        $this->idreportes = $this->getRequestParameter("idreportes");        
    }
}   
?>

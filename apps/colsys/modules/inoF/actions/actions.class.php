<?php

/**
 * ino actions.
 *
 * @package    symfony
 * @subpackage ino
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class inoFActions extends sfActions {    

    
    const RUTINA_TERRESTRE = "137";
    public function preExecute(){
        
        $action = $this->getContext()->getActionName ();
        if($action !="instruccionesOtm" && $action !="enviarInstruccionesOtm" && $action !="reenvioSiigoConect" && $action !="importRCColmas")
            $this->redirect("inoF2/indexExt5");
        $this->idmodo = $this->getRequestParameter("modo");
        
        if( !$this->idmodo && $this->getRequestParameter("idmaster") ){
            $master = Doctrine::getTable("InoMaster")->find( $this->getRequestParameter("idmaster") );
            
            if( $master ){
                
                $this->modo = Doctrine::getTable("Modo")
                                  ->createQuery("m")
                                  ->addWhere("m.ca_impoexpo = ?", $master->getCaImpoexpo())
                                  ->addWhere("m.ca_transporte = ?", $master->getCaTransporte())
                                  ->fetchOne();
                
                $this->idmodo = $this->modo->getCaIdmodo();  
                sfContext::getInstance()->getRequest()->setParameter("modo", $this->idmodo );
            }else{
                $this->modo = null;
            }
        }else{
            $this->modo = Doctrine::getTable("Modo")->find($this->idmodo);   
        }
        
        if (!$this->idmodo || !$this->modo) {                
            $action = $this->getContext()->getActionName ();

            if( $action!="seleccionModo" && $action!="importFac" && $action!="procesarImportFac" && $action!="importRCColmas" && $action!="datosFacturas" && $action!="guardarFactura" && $action!="guardarGridFacturacion" &&  $action!="datosGridCostosPanel" && $action!="EliminarGridFacturacionPanel" && $action!="datosFormFactura" && $action!="formHouseGuardar" && $action !="EnviarSiigoConect"  && $action !="reenvioSiigoConect" ){
                $this->redirect("inoF/seleccionModo");
            }
        }
        
        if( $this->modo ){
            $this->nivel = $this->getUser()->getNivelAcceso( $this->modo->getCaRutina() );
            //echo $this->nivel;
            //$this->nivel=6;
            $this->permisos=array("crear"=>true,"cerrar"=>true,"liquidar"=>true,"reabrir"=>true,"restringido"=>false,"contabilidad"=>false);
            //echo "nivel".$this->nivel;            
            
            switch ($this->nivel)
            {
                case "1":
                    $this->permisos["reabrir"]=false;
                break;
                case "2":
                    $this->permisos["reabrir"]=false;
                    $this->permisos["liquidar"]=false;
                break;
                case "3":
                    $this->permisos["reabrir"]=false;
                    $this->permisos["liquidar"]=false;
                    $this->permisos["cerrar"]=false;
                break;
                case "4":
                    $this->permisos["reabrir"]=false;
                    $this->permisos["liquidar"]=false;
                    $this->permisos["cerrar"]=false;
                    $this->permisos["crear"]=false;
                break;
                case "5":
                    $this->permisos["reabrir"]=false;
                    $this->permisos["liquidar"]=false;
                    $this->permisos["cerrar"]=false;
                    $this->permisos["crear"]=false;
                    $this->permisos["restringido"]=true;
                break;
                case "6":
                    $this->permisos["reabrir"]=false;
                    $this->permisos["liquidar"]=false;
                    $this->permisos["cerrar"]=false;
                    $this->permisos["crear"]=false;
                    $this->permisos["contabilidad"]=true;
                break;
            }
            //print_r($this->permisos);
        }
        parent::preExecute();
    }
    
    public function getNivel() {
        return $this->nivel;
    }

    /**
     * Permite seleccionar el modo de operacion del programa
     * @author: Andres Botero
     */
    public function executeSeleccionModo() {
        
        $modos = Doctrine::getTable("Modo")
                       ->createQuery("m")
                       ->addWhere("m.ca_modulo=?", "INO")
                       ->addOrderBy("m.ca_impoexpo")
                       ->addOrderBy("m.ca_transporte")
                       ->execute();
        
        $this->modos = array();
        $maxSpan=0;
        $span=0;
        foreach( $modos as $m ){
            if( !isset($this->modos[$m->getCaImpoexpo()] ) ){
                $this->modos[$m->getCaImpoexpo()] = array();
                $span=0;
            }
            $this->modos[$m->getCaImpoexpo()][$m->getCaTransporte()] = $m->getCaIdmodo();
            $span++;
            if( $span>$maxSpan){
                $maxSpan = $span;
            }
        }        
        $this->maxSpan = $maxSpan;        
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
        $this->nivel = $this->getNivel();
        $this->comerciales = UsuarioTable::getComerciales();
    }
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeBusqueda(sfWebRequest $request) {
        $criterio = $request->getParameter("criterio");
        $cadena = $request->getParameter("cadena");
        
        $liquidados = $request->getParameter("liquidados");
        $cerrados = $request->getParameter("cerrados");
        
        //$q = Doctrine_Query::create()->from('InoMaster m');
         
        $this->message = "";

        $q = Doctrine::getTable("InoMaster")
                        ->createQuery("m")
                        ->select("*");
        
        if( $cadena ){
        
            $q->addWhere("m.ca_transporte=?", $this->modo->getCaTransporte() );
            $q->addWhere("m.ca_impoexpo=?", $this->modo->getCaImpoexpo() );        
            switch ($criterio) {
                case "ca_referencia":
                case "ca_master":
                case "ca_motonave":
                case "ca_idnave":
                case "ca_origen":
                case "ca_observaciones":
                case "ca_destino":
                    $q->addWhere("lower(m.$criterio) LIKE ?","%". strtolower($cadena) . "%");
                    break;
                case "ca_fchsalida":
                case "ca_fchllegada":
                    $q->addWhere("m.$criterio = ?","'". $cadena . "'");
                    break;
                case "linea":
                    $q->innerJoin("m.IdsProveedor pr");
                    $q->innerJoin("pr.Ids ids");
                    $q->addWhere("lower(ids.ca_nombre) like ?", "%". strtolower($cadena) ."%");

                    break;
                case "cliente":
                case "ca_numorden":
                case "reporte":
                case "proveedor":
                case "ca_house":
                case "ca_doctransporte":
                    $q->innerJoin("m.InoHouse h");
                    
                    if($criterio=="cliente")
                    {   
                        $q->innerJoin("h.Cliente cl");
                        $q->addWhere("lower(cl.ca_compania) like ?", "%". strtolower($cadena) ."%");
                    }
                    else if($criterio=="ca_house")
                    {                         
                        $q->addWhere("lower(h.ca_doctransporte) like ?", "%". strtolower($cadena) ."%");
                    }                    
                    else if($criterio=="proveedor")
                    {
                        $q->innerJoin("h.Tercero pr");
                        $q->addWhere("lower(pr.ca_nombre) like ?", "%". strtolower($cadena) ."%");
                    }
                    else if($criterio=="reporte")
                    {
                        $q->innerJoin("h.Reporte rep");
                        $q->addWhere("lower(rep.ca_consecutivo) like ?", "%". strtolower($cadena) ."%");
                    }
                    else
                    {                       
                        $q->addWhere("lower(h.$criterio) like ?", "%". strtolower($cadena) ."%");
                    }
                    break;
                case "factura_clie":
                    $q->innerJoin("m.InoHouse h");
                    $q->innerJoin("h.InoComprobante comp");
                    $q->addWhere("lower(comp.ca_consecutivo) like ?", "%". strtolower($cadena) ."%");
                    break;
                case "factura_prov":
                    $q->innerJoin("m.InoCosto cost");                
                    $q->addWhere("lower(cost.ca_factura) like ?", "%". strtolower($cadena) ."%");
                    break;
            }
            
            if($liquidados!="")
            {
                if($liquidados=="Si")
                    $q->addWhere("ca_fchliquidado is not null  " );
                else
                    $q->addWhere("ca_fchliquidado is null");
            }
            if($cerrados!="")
            {
                if($cerrados=="Si")
                    $q->addWhere("ca_fchliquidado is not null  " );
                else
                    $q->addWhere("ca_fchliquidado is null");
            }

            $q->addOrderBy("m.ca_idmaster DESC");
            $q->limit(200);

            // Defining initial variables
            $currentPage = $this->getRequestParameter('page', 1);
            $resultsPerPage = 30;

            // Creating pager object
            $this->pager = new Doctrine_Pager(
                            $q,
                            $currentPage,
                            $resultsPerPage
            );

            $this->refList = $this->pager->execute();
        }else{
            $this->message = "Por favor coloque un criterio valido";
        }
        /*if ($this->pager->getResultsInPage() == 1 && $this->pager->getPage() == 1) {
            $refs = $this->refList;
            $this->redirect("inoF/verReferencia?idmaster=" . $refs[0]->getCaIdmaster());
        }*/
        $this->criterio = $criterio;
        $this->cadena = $cadena;
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeFormIno(sfWebRequest $request) {
        
        $this->impoexpo = $this->modo->getCaImpoexpo();
        $this->transporte = $this->modo->getCaTransporte();
        $this->idmaster = $request->getParameter("idmaster");
        if( $this->idmaster ){
            $this->referencia = Doctrine::getTable("InoMaster")->find($this->idmaster);
            
            if( $this->referencia->getReadOnly() ){
                $this->redirect("inoF/verReferenciaExt4?modo=".$this->modo->getCaIdmodo()."&idmaster=" . $this->referencia->getCaIdmaster());
            }
        }
        else{
            $this->referencia = new InoMaster();
        }
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarMaster(sfWebRequest $request) {
        $errors = array();
        //try 
        {
            $idmaster=$request->getParameter("idmaster");
            $tipo=($request->getParameter("tipo")=="")?"full":$request->getParameter("tipo");            
            
            if($tipo=="full")
            {
                $impoexpo = utf8_decode($request->getParameter("impoexpo"));
                $transporte = utf8_decode($request->getParameter("transporte"));
                $modalidad = utf8_decode($request->getParameter("modalidad"));
                $idorigen = $request->getParameter("idorigen");
                $iddestino = $request->getParameter("iddestino");
                $fchreferencia = $request->getParameter("fchreferencia");
                $fchreferenciaTm = strtotime($fchreferencia);                
                
                $fchllegada = $request->getParameter("ca_fchllegada");
                $fchllegadaTm = strtotime($fchllegada);                

                /*
                 * Validaciones
                 */
                $q = Doctrine::getTable("InoMaster")
                               ->createQuery("m")
                               ->addWhere("m.ca_master = ?", $request->getParameter("ca_master") );

                if( $idmaster ){
                    $q->addWhere("m.ca_idmaster != ?", $idmaster);
                }            
                $m = $q->fetchOne();
                if( $m ){               
                    throw new Exception("El numero de master ya se incluyo en la referencia ".$m->getCaReferencia());
                }
                /*
                 * Guarda los datos
                 */
                if( $idmaster ){
                    $ino = Doctrine::getTable("InoMaster")->find($idmaster);
                    $this->forward404Unless( $ino );                
                }else{
                    $ino = new InoMaster();
                    $mmRef = Utils::parseDate($fchllegada, "m");
                    $aaRef = substr(Utils::parseDate($fchllegada, "Y"), -2, 2);
                    if (Utils::parseDate($fchllegada, "d") >= "26") {
                       $mmRef = $mmRef + 1;
                       if ($mmRef >= 13) {
                          $mmRef = "01";
                          $aaRef = $aaRef + 1;
                       }
                    }
                    $numRef = InoMasterTable::getNumReferencia($impoexpo, $transporte, $modalidad, $idorigen, $iddestino, $mmRef , $aaRef);
                    $ino->setCaReferencia($numRef);
                    $ino->setCaImpoexpo($this->modo->getCaImpoexpo());
                    $ino->setCaTransporte($this->modo->getCaTransporte());
                }
                $ino->setCaModalidad($modalidad);
                $ino->setCaFchreferencia($fchreferencia);
                $ino->setCaOrigen($idorigen);
                $ino->setCaDestino($iddestino);
                $ino->setCaIdlinea($request->getParameter("idlinea"));
                if( $request->getParameter("idagente") ){
                    $ino->setCaIdagente($request->getParameter("idagente"));
                }

                if($this->idmodo==6)
                {
                    if($numRef!="")
                        $ino->setCaMaster($numRef);
                }
                else
                    $ino->setCaMaster($request->getParameter("ca_master"));

                $ino->setCaFchsalida($request->getParameter("ca_fchsalida"));
                $ino->setCaFchllegada($request->getParameter("ca_fchllegada"));
                $ino->setCaMotonave(utf8_decode($request->getParameter("ca_motonave")));

                if($request->getParameter("ca_piezas")!="")
                    $ino->setCaPiezas($request->getParameter("ca_piezas"));
                else
                    $ino->setCaPiezas(0);
                
                if($request->getParameter("ca_peso")!="")
                    $ino->setCaPeso($request->getParameter("ca_peso"));
                else
                    $ino->setCaPeso(0);
                
                if($request->getParameter("ca_volumen")!="")
                    $ino->setCaVolumen($request->getParameter("ca_volumen"));
                else
                    $ino->setCaVolumen(0);
                $ino->setCaObservaciones(utf8_decode($request->getParameter("ca_observaciones")));
                $ino->save();
                
                if( !$idmaster && $request->getParameter("idreporte")!="" /*&& $impoexpo==Constantes::EXPO*/ ){
                    
                    $reporte = Doctrine::getTable("Reporte")->find( $request->getParameter("idreporte") );
                    
                    //if($reporte->getCaIdconsignarmaster()=="1")
                    {
                        $house = new InoHouse();
                        $house->setCaIdmaster($ino->getCaIdmaster());
                        $house->setCaIdreporte($request->getParameter("idreporte"));

                        $house->setCaIdcliente($reporte->getCliente()->getCaIdcliente());
                        $house->setCaVendedor($reporte->getCaLogin());
                        //$house->setCaIdtercero($request->getParameter("idtercero"));
                        $house->setCaNumorden($reporte->getCaOrdenClie());
                        $status = $reporte->getUltimoStatus();

                        if($status)
                        {
                            $piezas = explode("|", $status->getCaPiezas());
                            $house->setCaNumpiezas( ($request->getParameter("ca_piezas")!="")?$request->getParameter("ca_piezas"):  ($piezas[0] ? $piezas[0] : 0));
                            $house->setCaMpiezas($piezas[1] ? $piezas[1] : "");

                            $peso = explode("|", $status->getCaPeso());
                            $house->setCaPeso( ($request->getParameter("ca_peso")!="")?$request->getParameter("ca_peso"):  ((isset($peso[0])) ? $peso[0] : 0));

                            $volumen = explode("|", $status->getCaVolumen());
                            $house->setCaVolumen(($request->getParameter("ca_volumen")!="")?$request->getParameter("ca_volumen"):  ((isset($volumen[0])) ? $volumen[0] : 0));
                            $house->setCaFchdoctransporte(null);
                            $house->setCaDoctransporte($status->getCaDoctransporte());
                        }

                        $house->save();
                    }
                    //consigmaster=1
                    //setCaIdconsignarmaster
                }
            }
            else if($tipo=="obs")
            {
                $ino = Doctrine::getTable("InoMaster")->find($idmaster);
                $this->forward404Unless($ino);
                $ino->setCaObservaciones($ino->getCaObservaciones()."\n".utf8_decode($request->getParameter("ca_observaciones")));
                $ino->save();
            }
            $this->responseArray = array("success" => true, "idmaster" => $ino->getCaIdmaster());
        }/* catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }*/
        $this->setTemplate("responseTemplate");
    }
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosMaster(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);

        $ino = Doctrine::getTable("InoMaster")->find($idmaster);
        $this->forward404Unless($ino);

        try {
            $data["impoexpo"]=utf8_encode($ino->getCaImpoexpo());
            $data["transporte"]=utf8_encode($ino->getCaTransporte());
            $data["modalidad"]=$ino->getCaModalidad();
            $data["fchreferencia"]=$ino->getCaFchreferencia();
            $data["idorigen"]=$ino->getCaOrigen();
            $data["iddestino"]=$ino->getCaDestino();

            $data["idlinea"]=$ino->getCaIdlinea();
            $data["linea"]=utf8_encode($ino->getIdsProveedor()->getIds()->getCaNombre());
            $data["idagente"]=$ino->getCaIdagente();
            $data["ca_master"]=$ino->getCaMaster();
            $data["ca_motonave"]=utf8_encode($ino->getCaMotonave());
            $data["ca_fchsalida"]=$ino->getCaFchsalida();
            $data["ca_fchllegada"]=$ino->getCaFchllegada();
            $data["ca_piezas"]=$ino->getCaPiezas();
            $data["ca_peso"]=$ino->getCaPeso();
            $data["ca_volumen"]=$ino->getCaVolumen();
            $data["ca_observaciones"]=utf8_encode($ino->getCaObservaciones());

            $this->responseArray = array("success" => true,"data"=>$data);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeVerReferencia(sfWebRequest $request) {
        
        $this->nivel = $this->getNivel();
        /*$this->permisos=array("crear"=>true,"cerrar"=>true,"liquidar"=>true,"reabrir"=>true);
        switch ($this->nivel)
        {
            case "1":
                $this->permisos["reabrir"]=false;
            break;
            case "2":
                $this->permisos["reabrir"]=false;
                $this->permisos["liquidar"]=false;
            break;
            case "3":
                $this->permisos["reabrir"]=false;
                $this->permisos["liquidar"]=false;
                $this->permisos["cerrar"]=false;
            break;
            case "4":
                $this->permisos["reabrir"]=false;
                $this->permisos["liquidar"]=false;
                $this->permisos["cerrar"]=false;
                $this->permisos["crear"]=false;
            break;
        }*/

        $this->forward404Unless($request->getParameter("idmaster"));
        $this->referencia = Doctrine::getTable("InoMaster")->find($request->getParameter("idmaster"));

        $this->forward404Unless($this->referencia);
    }
    
    public function executeVerReferenciaExt4(sfWebRequest $request) {
        
        $this->nivel = $this->getNivel();
        /*$this->permisos=array("crear"=>true,"cerrar"=>true,"liquidar"=>true,"reabrir"=>true);
        switch ($this->nivel)
        {
            case "1":
                $this->permisos["reabrir"]=false;
            break;
            case "2":
                $this->permisos["reabrir"]=false;
                $this->permisos["liquidar"]=false;
            break;
            case "3":
                $this->permisos["reabrir"]=false;
                $this->permisos["liquidar"]=false;
                $this->permisos["cerrar"]=false;
            break;
            case "4":
                $this->permisos["reabrir"]=false;
                $this->permisos["liquidar"]=false;
                $this->permisos["cerrar"]=false;
                $this->permisos["crear"]=false;
            break;
        }*/

        $this->forward404Unless($request->getParameter("idmaster"));
        $this->referencia = Doctrine::getTable("InoMaster")->find($request->getParameter("idmaster"));
        $this->idmaster=$request->getParameter("idmaster");

        $this->forward404Unless($this->referencia);
    }
    

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeBalanceReferencia(sfWebRequest $request) {
       
        // $this->nivel = $this->getNivel();

        $this->forward404Unless($request->getParameter("id"));
        $ref = Doctrine::getTable("InoMaster")->find($request->getParameter("id"));

        $this->forward404Unless($ref);

        $totales = array();

        $hijas = $ref->getInoHouse();

        foreach( $hijas as $hija ){  
            $comprobantes = $hija->getInoComprobante();
            $totales["factCliente"] = 0;
            foreach( $comprobantes as $comp ){
                //print_r( $comp->getValor() );
                $totales["factCliente"]+=$comp->getValor();
            }
        }
        $this->totales = $totales;
    }

    /*     * ***********************************************************************
     *
     *   Acciones para las guias hijas
     *
     * ************************************************************************* */

    /**
     * Guarda los datos desde la ventana de creación de House
     *
     * @param sfRequest $request A request object
     */
    public function executeFormHouseGuardar(sfWebRequest $request) {

        try {
            $idmaster=$request->getParameter("idmaster");
            $master = Doctrine::getTable("InoMaster")->find($idmaster);

            $q = Doctrine::getTable("InoMaster")
               ->createQuery("m")
               ->select("m.ca_referencia")
               ->innerJoin("m.InoHouse h")               
               ->addWhere("m.ca_idmaster != ?", $idmaster)
               ->addWhere("m.ca_transporte != ?", $master->getCaTransporte())
               ->addWhere("h.ca_doctransporte = ?", $request->getParameter("doctransporte"));

            $m = $q->fetchOne();
            if( $m ){               
                throw new Exception("El numero de Documento de transporte ya se existe ".$m->getCaReferencia());
            }
            
            if ($request->getParameter("idhouse")) {
                $house = Doctrine::getTable("InoHouse")->find($request->getParameter("idhouse"));
                $this->forward404Unless($house);
            } else {
                $house = new InoHouse();
                $house->setCaIdmaster($request->getParameter("idmaster"));
            }
            if($request->getParameter("idreporte")!="")
                $house->setCaIdreporte($request->getParameter("idreporte"));
            $house->setCaIdcliente($request->getParameter("idcliente"));
            $house->setCaVendedor($request->getParameter("vendedor"));
            $house->setCaIdtercero($request->getParameter("tercero"));
            $house->setCaNumorden($request->getParameter("numorden"));
            $house->setCaNumpiezas($request->getParameter("numpiezas"));
            $house->setCaMpiezas(utf8_decode($request->getParameter("mpiezas")));
            $house->setCaPeso($request->getParameter("peso"));
            $house->setCaVolumen($request->getParameter("volumen"));
            
            $house->setCaFchdoctransporte($request->getParameter("fchdoctransporte"));
            
            if($request->getParameter("modo")=="6")                
                $house->setCaDoctransporte($request->getParameter("consecutivo"));
            else
                $house->setCaDoctransporte($request->getParameter("doctransporte"));
            $house->save();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosGridHousePanel(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        $inoHouses = Doctrine::getTable("InoHouse")
                        ->createQuery("c")
                        ->select("c.*, cl.*")
                        //->innerJoin("c.Ids cl")
                        ->innerJoin("c.Cliente cl")
                        ->where("c.ca_idmaster = ?", $idmaster)
                        ->addOrderBy("cl.ca_compania")
                        ->execute();

        $data = array();
        //$totales =array("doctransporte"=>"TOTALES") ;
        foreach ($inoHouses as $inoHouse) {
            $row = array();
            $row["idmaster"] = $inoHouse->getCaIdmaster();
            $row["idhouse"] = $inoHouse->getCaIdhouse();
            $row["doctransporte"] = utf8_encode($inoHouse->getCaDoctransporte());            
            $row["fchdoctransporte"] = $inoHouse->getCaFchdoctransporte();
            $row["numorden"] = utf8_encode($inoHouse->getCaNumorden());
            $row["idcliente"] = $inoHouse->getCliente()->getCaIdcliente();
            $row["cliente"] = utf8_encode($inoHouse->getCliente()->getCaCompania());
            $row["vendedor"] = $inoHouse->getCaVendedor();
            $row["idreporte"] = $inoHouse->getCaIdreporte();
            $row["reporte"] = $inoHouse->getReporte()->getCaConsecutivo();
            $row["numpiezas"] = $inoHouse->getCaNumpiezas()." ".utf8_encode($inoHouse->getCaMpiezas());
            //$totales["numpiezas"] +=$inoHouse->getCaNumpiezas();
            $row["peso"] = $inoHouse->getCaPeso();
            //$totales["peso"] +=$inoHouse->getCaPeso();
            $row["volumen"] = $inoHouse->getCaVolumen();
            //$totales["volumen"] +=$inoHouse->getCaVolumen();
            
            $row["idtercero"] = $inoHouse->getCaIdtercero();
            $row["tercero"] = utf8_encode($inoHouse->getTercero()->getCaNombre());
            
            $comprobantes = $inoHouse->getInoComprobante();
            if(count($comprobantes)<1)
            {
                $row["color"] = "pink";
            }
            $data[] = $row;
        }
        //$data[] = $totales;

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data),"ncomprobantes"=>count($comprobantes));

        $this->setTemplate("responseTemplate");
    }
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosFormHousePanel(sfWebRequest $request) {

        $this->forward404Unless($request->getParameter("idhouse"));
        $idhouse = $request->getParameter("idhouse");
        $inoHouse = Doctrine::getTable("InoHouse")->find($idhouse);
        $this->forward404Unless($inoHouse);

        $data = array();

        $data["idmaster"] = $inoHouse->getCaIdmaster();
        $data["idhouse"] = $inoHouse->getCaIdhouse();
        $data["doctransporte"] = utf8_encode($inoHouse->getCaDoctransporte());
        $data["consecutivo"] = utf8_encode($inoHouse->getCaDoctransporte());
        $data["fchdoctransporte"] = $inoHouse->getCaFchdoctransporte();
        $data["numorden"] = utf8_encode($inoHouse->getCaNumorden());
        $data["idcliente"] = $inoHouse->getCliente()->getCaIdcliente();
        $data["cliente"] = utf8_encode($inoHouse->getCliente()->getCaCompania());
        $data["vendedor"] = $inoHouse->getCaVendedor();
        $data["nombreVendedor"] = utf8_encode($inoHouse->getVendedor()->getCaNombre());
        $data["idreporte"] = $inoHouse->getCaIdreporte();
        $data["reporte"] = $inoHouse->getReporte()->getCaConsecutivo();
        $data["numpiezas"] = $inoHouse->getCaNumpiezas();
        $data["mpiezas"] = utf8_encode($inoHouse->getCaMpiezas());
        $data["peso"] = $inoHouse->getCaPeso();
        $data["volumen"] = $inoHouse->getCaVolumen();
        $data["idtercero"] = $inoHouse->getCaIdtercero();
        $data["tercero"] = utf8_encode($inoHouse->getTercero()->getCaNombre());

        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeEliminarGridHousePanel(sfWebRequest $request) {

        $this->forward404Unless($request->getParameter("idhouse"));
        $idhouse = $request->getParameter("idhouse");
        $inoHouse = Doctrine::getTable("InoHouse")->find($idhouse);
        $this->forward404Unless($inoHouse);

        try {
            $inoHouse->delete();
            $this->responseArray = array("success" => true ,"errorInfo" =>"");
        } catch (Exception $e) {
            $this->responseArray = array("success" => true, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
    
    /**
     * Carga los datos del reporte al crear una hija
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosReporteCarga(sfWebRequest $request) {

        $data=array();
        $reporte = Doctrine::getTable("Reporte")->find( $request->getParameter("idreporte")  );
        $this->forward404Unless( $reporte );
        
        if( $reporte->getCaImpoexpo()==Constantes::EXPO ){
            $cons=$reporte->getConsignatario();            
            if($cons)
            {                
                $data["idtercero"]=$cons->getCaIdtercero();
                $data["tercero"]=utf8_encode($cons->getCaNombre());
            }
        }else{
            $prov=$reporte->getProveedores();
            if(count($prov)>0)
            {
                $data["idtercero"]=$prov[0]->getCaIdtercero();
                $data["tercero"]=utf8_encode($prov[0]->getCaNombre());
            }
        }        
        $data["origen"]=$reporte->getDocTransporte();
        $data["impoexpo"]=utf8_encode($reporte->getCaImpoexpo());
        $data["transporte"]=utf8_encode($reporte->getCaTransporte());
        $data["modalidad"]=$reporte->getCaModalidad();
        $data["origen"]=$reporte->getCaOrigen();
        $data["destino"]=$reporte->getCaDestino();
        $data["idlinea"]=$reporte->getCaIdlinea();
        $data["linea"]=utf8_encode($reporte->getIdsProveedor()->getIds()->getCaNombre());
        
        $data["idagente"]=$reporte->getCaIdagente();
        //$data["ca_idnave"]=$reporte->getIdnave();
        $data["ca_fchsalida"]=$reporte->getEts();
        $data["ca_fchllegada"]=$reporte->getEta();
        $data["ca_master"]=$reporte->getCaDocmaster();
        
        $data["idbodega"] = $reporte->getCaIdbodega();
        //$data["bodega"] = utf8_encode($reporte->getBodega()->getCaNombre()." Nit:".$reporte->getBodega()->getCaIdentificacion() . " " . $reporte->getBodega()->getCaDireccion());
        $data["bodega"] = utf8_encode($reporte->getBodega()->getCaNombre());
        $data["bodega_dir"] = utf8_encode($reporte->getBodega()->getCaDireccion());
        $data["bodega_nit"] = utf8_encode($reporte->getBodega()->getCaIdentificacion());
        $data["bodega_tipo"] = utf8_encode($reporte->getBodega()->getCaTipo());
        $data["bodega_trans"] = utf8_encode($reporte->getBodega()->getCaTransporte());

        if($reporte->getCaTiporep()=="4")
        {
            $repotm=$reporte->getRepOtm();
            $data["peso"]=$repotm->getCaPeso();
            $data["numpiezas"]=$repotm->getCaNumpiezas();
            $data["mpiezas"]=$repotm->getCaNumpiezasun();
            $data["volumen"]=$repotm->getCaVolumen();            
            $data["fchdoctransporte"]=$repotm->getCaFchdoctransporte();
            $data["doctransporte"]=$repotm->getCaHbls();
        }
        else
        {
            //$status=new RepStatus();
            $status = $reporte->getUltimoStatus();
            if($status)
            {
                $piezas = explode("|", $status->getCaPiezas());
                $data["numpiezas"]=$piezas[0] ? $piezas[0] : 0;
                $data["ca_piezas"]=$piezas[0] ? $piezas[0] : 0;
                $data["mpiezas"]=$piezas[1] ? $piezas[1] : "";
                $peso = explode("|", $status->getCaPeso());
                $data["peso"]=$peso[0] ? $peso[0] : 0;
                $data["ca_peso"]=$peso[0] ? $peso[0] : 0;
                $data["volumen"]=$status->getCaVolumen();
                $data["ca_volumen"]=$status->getCaVolumen();
                //$data["ca_master"]=$status->getCaDoctransporte();
                $data["ca_master"]=$status->getCaDocmaster();
                $data["doctransporte"]=$status->getCaDoctransporte();
                
            }
        }
        
        $this->responseArray=array("success"=>true,"data"=>$data);
        $this->setTemplate("responseTemplate");
    }

    /*     * ***********************************************************************
     *
     *   Acciones para las facturas
     *
     * ************************************************************************* */

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosGridFacturacionPanel(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        $q = Doctrine::getTable("InoHouse")
                        ->createQuery("c")
                        ->select("c.*, cl.*")                        
                        ->innerJoin("c.Cliente cl")
                        ->leftJoin("c.InoComprobante comp")
                        ->leftJoin("comp.Ids fact")
                        ->leftJoin("comp.InoTipoComprobante tcomp")
                        ->where("c.ca_idmaster = ? ", $idmaster)
                        ->addOrderBy("cl.ca_compania");

        $inoHouses=$q->execute();
        $data = array();

        foreach ($inoHouses as $inoHouse) {

            $comprobantes = $inoHouse->getInoComprobante();
            $k = 0;
            if (count($comprobantes) > 0) {
                foreach ($comprobantes as $comprobante) {
                    if($comprobante->getCaIdtipo()=="11" || $comprobante->getCaIdtipo()=="12")
                        continue;
                    $tipo = $comprobante->getInoTipoComprobante();

                    $row = array();
                    $row["idmaster"] = $inoHouse->getCaIdmaster();
                    $row["idhouse"] = $inoHouse->getCaIdhouse();
                    $row["group"] = utf8_encode($inoHouse->getCaDoctransporte()." - ".$inoHouse->getCliente()->getCaCompania());
                    $row["doctransporte"] = utf8_encode($inoHouse->getCaDoctransporte());
                    $row["idcliente"] = $inoHouse->getCliente()->getCaIdcliente();
                    $row["cliente"] = utf8_encode($inoHouse->getCliente()->getCaCompania());
                    $row["fact"] = utf8_encode($comprobante->getIds()->getCaNombre());
                    $row["comprobante"] = utf8_encode($tipo . " " . str_pad($comprobante->getCaConsecutivo(), 6, "0", STR_PAD_LEFT));
                    $row["fchcomprobante"] = utf8_encode($comprobante->getCaFchcomprobante());
                    $row["idcomprobante"] = $comprobante->getCaIdcomprobante();
                    $row["valor"] = $comprobante->getCaValor();   
                    $row["tasacambio"] = $comprobante->getCaTcambio(); 
                    $row["idmoneda"] = $comprobante->getCaIdmoneda();
                    $row["color"] = "";

                    $data[] = $row;
                }
            } else {                
                $row = array();
                $row["idmaster"] = $inoHouse->getCaIdmaster();
                $row["idhouse"] = $inoHouse->getCaIdhouse();
                $row["doctransporte"] = utf8_encode($inoHouse->getCaDoctransporte());
                $row["idcliente"] = $inoHouse->getCliente()->getCaIdcliente();
                $row["cliente"] = utf8_encode($inoHouse->getCliente()->getCaCompania());
                $row["fact"] = utf8_encode($inoHouse->getCliente()->getCaCompania());
                $row["comprobante"] = "";
                $row["fchcomprobante"] = "";
                $row["valor"] = 0;
                $row["color"] = "pink";
                $data[] = $row;
            }
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data),"debug"=>$q->getSqlQuery());
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarGridFacturacion(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        
        $datos_det = json_decode($datos);
        //print_r($datos_det);
        //exit;
        $errorInfo = "";
        $ids = array();

        $inoDetalle = new InoDetalle();        
        $conn = $inoDetalle->getTable()->getConnection();
        $conn->beginTransaction();

        try{
        //$house=null;
            $comprobante=$tipoComprobante=null;
            $total=0;
            $impuestos=array();
            $idcomprobante=0;
            foreach ($datos_det as $t) {
                if($t->idconcepto=="" || $t->valor=="" )
                    continue;
                if($comprobante==null)
                {                
                    $comprobante=Doctrine::getTable("InoComprobante")->find($t->idcomprobante);                
                    $this->forward404Unless($comprobante);
                    $idcomprobante=$t->idcomprobante;                
                    $tipoComprobante = $comprobante->getInoTipoComprobante();
                }

                $inoDetalle = Doctrine::getTable("InoDetalle")->find($t->iddetalle);
                if(!$inoDetalle)
                    $inoDetalle = new InoDetalle();            

                $inoDetalle->setCaIdcomprobante( $t->idcomprobante );
                if($tipoComprobante->getCaTipo()=="C")
                    $inoDetalle->setCaDb( $t->valor );
                else
                    $inoDetalle->setCaCr( $t->valor );
                $inoDetalle->setCaIdconcepto( $t->idconcepto );            
                $inoDetalle->setCaId( $comprobante->getCaId() );
                $inoDetalle->save( $conn );

                $ids[] = $t->id;
                $ids_reg[] = $inoDetalle->getCaIddetalle();
                $valor+=$t->valor;            
            }

            //$comprobante->setCaValor( $valor );
            //$comprobante->save($conn);
            $conn->commit();

            $this->responseArray = array("errorInfo" => $errorInfo, "id" => implode(",", $ids), "idreg" => implode(",", $ids_reg), "success" => true);
            $this->setTemplate("responseTemplate");
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function executeGenerarFactura(sfWebRequest $request) {
        $idcomprobante = $request->getParameter("idcomprobante");
        $ncomprobante = $request->getParameter("ncomprobante");
        $errorInfo= $info = "";
        $ids = array();

        $inoDetalle = new InoDetalle();
        $conn = $inoDetalle->getTable()->getConnection();

        $conn->beginTransaction();
        $house=null;
        $total=0;
        $impuestos=array();
        $retfte=array();
        $autoret=0;
        //try
        {
            $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
            $tipoComprobante = $comprobante->getInoTipoComprobante();
            if(trim($ncomprobante)!="")
            {
                $consecutivo=  $ncomprobante;
            }
            else{
                $consecutivo=  intval($tipoComprobante->getCaNumeracionActual())+1;
                $tipoComprobante->setCaNumeracionActual($consecutivo);
                $tipoComprobante->save($conn);
            }
            
            $regContributivo=$comprobante->getIds()->getIdsCliente()->getProperty('regimen_contributivo');

            $house = Doctrine::getTable("InoHouse")->find($comprobante->getCaIdhouse());
            if(!$house)
            {
                echo "dd";
                exit;
            }

            $movs = Doctrine::getTable("InoDetalle")
                ->createQuery("det")
                ->select("det.*,s.*,tcomp.ca_ctarteica,cric.ca_rteica")
                ->innerJoin("det.InoComprobante comp")
                ->innerJoin("comp.InoTipoComprobante tcomp")
                //->innerJoin("tcomp.InoCentroCosto ccosto")
                ->leftJoin('det.InoConSiigo s WITH tcomp.ca_idempresa=s.ca_idempresa ')
                ->leftJoin("tcomp.Ctarteica cric WITH tcomp.ca_idempresa=cric.ca_idempresa ")
                ->addWhere("det.ca_idconcepto IS NOT NULL")
                ->addWhere("det.ca_idcomprobante = ? ",$idcomprobante  )
                ->addOrderBy("s.ca_pt DESC")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
            
            foreach ($movs as $m) {
                if($tipoComprobante->getCaTipo()=="C")
                    $valortmp=$m["det_ca_db"];
                else
                    $valortmp=$m["det_ca_cr"];

                if($m["s_ca_idconceptosiigo"]>0)
                {
                    if($m["s_ca_iva"]=="S")
                    {
                        $q1 = ParametroTable::retrieveByCaso("CU232",$tipoComprobante->getCaIdempresa());
                        if($q1[0])
                        {
                            $cuentaImp = $q1[0];
                            $valoriva=round($valortmp * ($m["s_ca_porciva"]/100));
                            $impuestos[$cuentaImp->getCaValor2()]+=$valoriva;
                            
                            //reteiva
                            if($regContributivo=="G" )//gran contribuyente 
                            {
                                $q1 = ParametroTable::retrieveByCaso("CU251",null,null,$tipoComprobante->getCaIdempresa()."4");
                                if($q1[0])
                                {
                                    $impuestos[$q1[0]->getCaValor()] += round(  ($valoriva * 15)/100);
                                }
                                
                            }
                        }
                    }                    
                    
                    if($m["s_ca_autoret"]=="S" && $valortmp>=$m["s_ca_basear"])
                    {
                        $autoret+=round($valortmp * (4/100));
                        //$valortmp=0;
                        //continue;
                    }
                    //RETEICA
                    if($regContributivo=="G" && $m["s_ca_pt"]=="P")//gran contribuyente e ingresos propios
                    {
                        $impuestos[$m["tcomp_ca_ctarteica"]]+=round($valortmp * ($m["cric_ca_rteica"]/100));
                    }                    
                }                
                $total+=$valortmp;
            }

            $totalsinimpuestos=$total;
            
            foreach($impuestos as $cuenta=>$s)
            {
                $inoDetalle = new InoDetalle();
                $inoDetalle->setCaIdcomprobante( $idcomprobante );                
                if($tipoComprobante->getCaTipo()=="C")
                {
                    $inoDetalle->setCaDb( $s );
                    $total+=$s;
                }
                else
                {
                    if( substr($cuenta,0,1)=="2")
                    {
                        $inoDetalle->setCaCr( $s );
                        $total+=$s;
                    }
                    else if( substr($cuenta,0,1)=="1")
                    {
                        $inoDetalle->setCaDb( $s );
                        $total-=$s;
                    }
                }
                $inoDetalle->setCaIdcuenta( $cuenta );            
                $inoDetalle->setCaId( $comprobante->getIds()->getCaId() );
                $inoDetalle->save( $conn );
                
            }
            


            //cuenta cruce
            $inoDetalle = new InoDetalle();
            $inoDetalle->setCaIdcomprobante( $idcomprobante );
            if($tipoComprobante->getCaTipo()=="C")
                $inoDetalle->setCaCr( $total );
            else
                $inoDetalle->setCaDb( $total );

            $cuenta_pago=($tipoComprobante->getCaIdempresa()=="2")?"cuenta_forma_pago_coltrans":"cuenta_forma_pago_colotm";
            $inoDetalle->setCaIdcuenta( $comprobante->getIds()->getIdsCliente()->getProperty($cuenta_pago) );
            //$inoDetalle->setCaId( $house->getCliente()->getCaIdcliente() );
            $inoDetalle->setCaId( $comprobante->getIds()->getCaId() );
            $inoDetalle->save( $conn );
            
            
            if($autoret>0)
            {
                $q1 = ParametroTable::retrieveByCaso("CU251",null,null,$tipoComprobante->getCaIdempresa()."1");
                
                if($q1[0])
                {
                    $inoDetalle = new InoDetalle();
                    $inoDetalle->setCaIdcomprobante( $idcomprobante );                
                    $inoDetalle->setCaDb( $autoret );                    
                    $inoDetalle->setCaIdcuenta( $q1[0]->getCaValor() );
                    $inoDetalle->setCaId( $comprobante->getIds()->getCaId() );
                    $inoDetalle->save( $conn );
                    //echo "<pre>";echo($q1[0]->getCaValor2());echo "</pre>";
                }
                
                $q1 = ParametroTable::retrieveByCaso("CU251",null,null,$tipoComprobante->getCaIdempresa()."2");                
                if($q1[0])
                {
                    $inoDetalle = new InoDetalle();
                    $inoDetalle->setCaIdcomprobante( $idcomprobante );
                    $inoDetalle->setCaCr( $autoret );
                    $inoDetalle->setCaIdcuenta( $q1[0]->getCaValor() );
                    $inoDetalle->setCaId( $comprobante->getIds()->getCaId() );
                    $inoDetalle->save( $conn );
                    //echo "<pre>";echo( $q1[0]->getCaValor2());echo "</pre>";
                }                
                $total+=$autoret;
                //$inoDetalle->setCaCr( $autoret );
            }

            /***********TABLAS SIIGO**************/
            if($tipoComprobante->getCaTipo()=="F")
            {
            //CABECERA COMPROBANTE
                $comproSiigo = new SiigoComprobante();                
                $comproSiigo->setIdUnegCont($idcomprobante);
                $comproSiigo->setCdDocCont($tipoComprobante->getCaTipo());
                $comproSiigo->setNuDocsopCont($tipoComprobante->getCaComprobante());
                $comproSiigo->setNuCont($consecutivo);        
                $comproSiigo->setTpDocSopCont($tipoComprobante->getCaTipo());
                $comproSiigo->setFechaCont(date("Y-m-d"));
                //$comproSiigo->setFechaCont("2014-02-15");
                $comproSiigo->setIdtpoIdapbCont("C");

                $comproSiigo->setNitApbCont($comprobante->getIds()->getCaIdalterno());
                $dv=($comprobante->getIds()->getCaDv()!="" && $comprobante->getIds()->getCaDv()!=null)?$comprobante->getIds()->getCaDv():"0";
                $comproSiigo->setDvApbCont($dv);
                //$comproSiigo->setNitApbCont($house->getCliente()->getCaIdalterno());
                //$comproSiigo->setDvApbCont($house->getCliente()->getCaDigito());        
                $comproSiigo->setIdSucCont("0");
                $comproSiigo->setTotalDbCont($total);
                $comproSiigo->setTotalCrCont($total);
                $comproSiigo->setIndIncorpCont("2");
                $comproSiigo->setCodaltUnegCont('1');
                $comproSiigo->setCodaltEmpreCont('4');
                //$comproSiigo->setCdErrsiigoCont();
                $comproSiigo->setIndAnulCont("N");
                //$comproSiigo->setArchivo();
                //$comproSiigo->setErrorArchivo();
                $comproSiigo->save($conn);

                $q = Doctrine::getTable("InoDetalle")
                    ->createQuery("det")
                    ->select("det.*,s.*,ids.ca_nombre , ids.ca_idalterno ,  ids.ca_dv")            
                    ->innerJoin("det.InoComprobante comp")
                    ->innerJoin("comp.Ids ids")
                    ->innerJoin("comp.InoTipoComprobante tcomp")
                    //->innerJoin("tcomp.InoCentroCosto ccosto")
                    ->leftJoin('det.InoConSiigo s WITH tcomp.ca_idempresa=s.ca_idempresa ')            
                    ->addWhere("det.ca_idcomprobante = ? ",$idcomprobante  )
                    ->addOrderBy("s.ca_pt DESC")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                $movs=$q->execute();
                /*echo "<pre>";print_r($movs);echo "</pre>";
                $conn->rollback();
                exit;*/

                $ccosto = Doctrine::getTable("InoCentroCosto")
                                  ->createQuery("c")
                                  ->addWhere("c.ca_impoexpo = ?", $this->modo->getCaImpoexpo())
                                  ->addWhere("c.ca_transporte = ?", $this->modo->getCaTransporte())
                                  ->addWhere("c.ca_idsucursal = ?", $comprobante->getInoTipoComprobante()->getCaIdsucursal())
                                  ->fetchOne();

                // $this->getUser()->getSucursal()



                /*echo "<pre>";print_r($movs);echo "</pre>";
                $conn->rollback();
                exit;*/
                foreach ($movs as $m) {
                    //$conSiigo = $m->getInoConSiigo();  
                    if($m["det_ca_idcuenta"]!="")
                    {
                        $cuenta=$m["det_ca_idcuenta"];
                        $cc="0001";
                        $scc="001";
                        $nconcepto="Proceso Automatico Siigoconect";
                        //echo "1::";
                    }
                    else
                    {
                        $cuenta=$m["s_ca_cuenta"];
                        //$cod=$conSiigo->getCaCod();
                        $cc=  "000".$m["s_ca_cc"];
                        $scc="00".$m["s_ca_scc"];
                        $nconcepto=$m["s_ca_descripcion"];
                    }
                    if($cuenta=="")
                    {
                       // echo $m->getCaIddetalle();
                        //exit();
                    }

                    $detComproSiigo=new SiigoDetComprobante();
                    $detComproSiigo->setIdUnegMovcont($comproSiigo->getIdUnegCont());
                    $detComproSiigo->setCodDoccontMovcont($tipoComprobante->getCaTipo());
                    $detComproSiigo->setNumTipDoccontMovcont($tipoComprobante->getCaComprobante());
                    $detComproSiigo->setNumDoccontMovcont($consecutivo);
                    $detComproSiigo->setCtaMovcont($cuenta);
                    $detComproSiigo->setTpIdepcteMovcont("CC");
                    $detComproSiigo->setSucMovcont("0");
                    $detComproSiigo->setIdentPcteMovcont($m["ids_ca_idalterno"]);//nit            
                    $detComproSiigo->setDescripMovcont($nconcepto);//nombre concepto
                    if($m["det_ca_cr"]>0)
                    {
                        $valor=$m["det_ca_cr"];
                        $nat="C";
                    }
                    else
                    {
                        $valor=$m["det_ca_db"];
                        $nat="D";
                    }
                    //$detComproSiigo->setValorMovcont($valor*$comprobante->getCaTcambio());//valor
                    $detComproSiigo->setValorMovcont(round($valor*$comprobante->getCaTcambio(),2) );//valor
                    $detComproSiigo->setNatuMovcont($nat);//naturaleza C o D
                    $detComproSiigo->setVlBaseMovcont(0);//valor Base
                    $detComproSiigo->setIdCcMovcont("0001");//centro de costo
                    $detComproSiigo->setIdBodegaMovcont("0001");
                    //$detComproSiigo->setCodalInvMovcont("0010001000007");
                    $detComproSiigo->setCodalInvMovcont("0");
                    $detComproSiigo->setCantInvMovcont("1");
                    $detComproSiigo->setCodaltDepMovcont("0");
                    $detComproSiigo->setCodaltBodMovcont("0");
                    $detComproSiigo->setCodaltUbiMovcont("0");
                    $detComproSiigo->setCodaltCcMovcont($cc);
                    $detComproSiigo->setIdAreaMovcont("0");
                    $detComproSiigo->setCodaltSccMovcont($scc);//??
                    $detComproSiigo->setTpIdterMovcont("CC");
                    $detComproSiigo->setIdentTerMovcont($m["ids_ca_idalterno"]);//nit
                    $detComproSiigo->setTipConCarMovcont($tipoComprobante->getCaTipo());
                    $detComproSiigo->setComConCarMovcont($tipoComprobante->getCaComprobante());
                    $detComproSiigo->setNumConCarMovcont($consecutivo);
                    $detComproSiigo->setVctConCarMovcont(1);
                    
                    /*if($tipoComprobante->getCaTipo()=="F")
                        $fchDocCruce=Utils::agregarDias($comprobante->getCaFchcomprobante(), $comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito(),  "Y-m-d");
                    else
                        $fchDocCruce=date("Y-m-d");*/
                    
                    if($tipoComprobante->getCaTipo()=="F")
                    {
                        if($comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito()=="" || $comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito()<1 || $comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito()=="0" )
                        {
                            $dcredito=0;
                            $fchDocCruce=date("Y-m-d");
                        }
                        else
                            $dcredito=$comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito();
                        
                        if($dcredito>0)
                            $fchDocCruce=Utils::agregarDias($comprobante->getCaFchcomprobante(), $dcredito,  "Y-m-d");
                        else
                            $fchDocCruce=date("Y-m-d");
                    }
                    else
                    {
                        $fchDocCruce=date("Y-m-d");
                        $dcredito=0;
                    }
                    
                    if($fchDocCruce=="1999-12-30")
                    {
                        $fchDocCruce=date("Y-m-d");
                        $dcredito=0;
                    }
                    
                    
                    //$detComproSiigo->setFecConMovcont(date("Y-m-d"));
                    $detComproSiigo->setFecConMovcont($fchDocCruce);

                    $detComproSiigo->setNomTercMovcont("SIIGONECT");//
                    $detComproSiigo->setConceptoNomMovcont(0);
                    $detComproSiigo->setVariableAcumMovcont(0);
                    $detComproSiigo->setNroquinAcumMovcont(0);
                    $detComproSiigo->setTipModMovhbMovcont($ccosto->getCaTipmodsiigo());
                    $detComproSiigo->setRefMasMovhbMovcont( str_replace(".", "", $house->getInoMaster()->getCaReferencia()));
                    $detComproSiigo->setNroBlhMovhbMovcont($house->getCaDoctransporte());
                    $detComproSiigo->save($conn);
                }
            }
            //$autoret
            /*************************/

    /*        ProjectConfiguration::registerZend();

            $client = new Zend_Soap_Client( "http://10.192.1.97:8000/WebService2/Service1.asmx?wsdl", array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 ));
            $result = $client->actualiza(array(a=>"2014",t=>$tipoComprobante->getCaTipo(),nt=>$tipoComprobante->getCaComprobante(),c=>$consecutivo));

            $comproSiigo->refresh();
            $indincor=$comproSiigo->getIndIncorpCont();

            if($indincor=="+6" || $indincor=="6")
            {
                $comprobante->setCaEstado(InoComprobante::ERROR_TRANSFERIDO);
            }
            else if($indincor=="+5" || $indincor=="5")
            {
                $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
            }*/
            $comprobante->setCaConsecutivo($consecutivo);
            $comprobante->setCaFchcomprobante(date("Y-m-d"));
            $comprobante->setCaValor($totalsinimpuestos);
            $comprobante->setCaValor2($total);
            $comprobante->setCaUsugenero($this->getUser()->getUserId());
            $comprobante->setCaFchgenero(date("Y-m-d H:i:s"));
            $comprobante->setCaPlazo($dcredito);
            //$comprobante->setCaPlazo($comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito());

            //$comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
            if($tipoComprobante->getCaTipo()=="C")
                $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
            
            $comprobante->save($conn);

            if( $tipoComprobante->getCaTipo()=="F" && $comprobante->getCaId()=="800024075" && $tipoComprobante->getCaIdempresa()=="8"  )
            {
                $resultadoCosto=InoCostosSea::setCosto($comprobante,$conn);
                //echo $resultadoCosto;
                if($resultadoCosto<0)
                {
                    switch ($resultadoCosto)
                    {
                        case "-1":
                            $info="error:$resultadoCosto -> HBL: NO ENCONTRADO";
                            break;
                        case "-2":
                            $info="error:$resultadoCosto -> REFERENCIA MARITIMA CERRADA";
                            break;
                        case "-3":
                            $info="error:$resultadoCosto -> REFERENCIA MARITIMA YA POSEE COSTO INGRESADO";
                            break;
                        case "-4":
                            $info="error:$resultadoCosto -> NO SE ENCONTRO LA DEDUCCION EN EL CASO MARITIMO";
                            break;
                    }

                    Utils::sendEmail(
                        array(
                            "from"=>"colsys@coltrans.com.co",
                            "fromname" => "colsys",
                            "to"=>$this->getUser()->getEmail().",gerencia@colotm.com",
                            "subject"=>"Error al enviar costo a ref maritima",
                            "body"=>"Error al enviar costo a ref maritima",
                            "mensaje"=> "No fue posible pasar el costo :$info<br>"
                                        ."Ref :".$house->getInoMaster()->getCaReferencia()."<br>"
                                        ."Comprobante:".$consecutivo."<br>"
                            )
                        );
                }
            }
            $conn->commit();
            
            if($tipoComprobante->getCaTipo()=="F")
            {
                $request->setParameter("idcomprobante", $idcomprobante);
                $request->setParameter("info", $info);
                $this->executeEnviarSiigoConect($request);
            }
            
            
            $success=true;
        }
        /*catch(Exception $e)
        {
            $errorInfo=$e->getMessage();
            $conn->rollback();
            $success=false;
        }*/

        $this->responseArray = array("errorInfo" => $errorInfo,"info" => $info, "id" => implode(",", $ids), "idreg" => implode(",", $ids_reg), "success" => $success,"consecutivo"=>$consecutivo ,"indincor"=>$indincor,"wsdl"=>$result );
        $this->setTemplate("responseTemplate");
    }

    public function executeEnviarSiigoConect(sfWebRequest $request) {
        
        $idcomprobante = $request->getParameter("idcomprobante");
        $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
        $comproSiigo = Doctrine::getTable("SiigoComprobante")->find($idcomprobante);
        $consecutivo=$comprobante->getCaConsecutivo();
        $comprobante->setCaEstado(InoComprobante::ERROR_TRANSFERIDO);
        $comprobante->save($conn);
        
        $tipoComprobante = $comprobante->getInoTipoComprobante();
        
        ProjectConfiguration::registerZend();
        
        //$client = new Zend_Soap_Client( "http://10.192.1.97:8000/WebService2/Service1.asmx?wsdl", array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 ));        ///WebService2/Service1.asmx/HelloWorld
        $config = sfConfig::get('app_soap_siigo');
        //echo $wsdl_uri["wsdl_uri"];
        //echo sfConfig::get('app_soap_adminUsers_wsdl_uri');
        //print_r($config);
        //exit;
        $client = new Zend_Soap_Client( $config["wsdl_uri"], array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 ));
        $result = $client->actualiza(
                array(
                    a=>date("Y", strtotime($comproSiigo->getFechaCont())),
                    t=>$tipoComprobante->getCaTipo(),
                    nt=>$tipoComprobante->getCaComprobante(),
                    c=>$consecutivo,
                    d=>$tipoComprobante->getCaIdempresa()));

        
        $indincor=$comproSiigo->getIndIncorpCont();
        $errorsiigo=$comproSiigo->getCdErrsiigoCont();
        
        if( ($indincor=="+6" || $indincor=="6") && $errorsiigo=="26")
        {
            //$comprobante->setCaEstado(InoComprobante::ERROR_TRANSFERIDO);
            //$comprobante->save($conn);
            $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
            $comprobante->save($conn);
        }
        else if($indincor=="+5" || $indincor=="5")
        {
            $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
            $comprobante->save($conn);
        }

        $this->responseArray = array("success" => true,"consecutivo"=>$consecutivo ,"indincor"=>$indincor,"wsdl"=>$result,"info" => $info );
        $this->setTemplate("responseTemplate");
    }
    
    public function executeReenvioSiigoConect(sfWebRequest $request) {
        
        ProjectConfiguration::registerZend();
        /*$wsdl_uri = sfConfig::get('app_soap_siigo_wsdl_uri');
        $client = new Zend_Soap_Client( $wsdl_uri , array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 ));
        
        for ($i=5092;$i<=5093;$i++)
        {
            $result = $client->actualiza(
                    array(
                        a=>'2014',//date("Y"),
                        t=>"F",
                        nt=>"1",
                        c=>$i,
                        d=>"8"));
            print_r($result);echo "<br>";
        }*/
        
        $config = sfConfig::get('app_soap_siigo');        
        echo $config["wsdl_uri"]."<br>";
        $client = new Zend_Soap_Client( $config["wsdl_uri"], array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 ));
        
        /*for ($i=320;$i<=320;$i++)
        {
            $result = $client->actualiza(
                    array(
                        a=>'2016',//date("Y"),
                        t=>"F",
                        nt=>"6",
                        c=>$i,
                        d=>"2"));
            print_r($result);echo "<br>";
        }
        
        exit;*/
        
        $comprobantesSiigo = Doctrine::getTable("SiigoComprobante")
                                ->createQuery("d")
                                ->where("d.ind_incorp_cont!=? and (cd_errsiigo_cont != ? or cd_errsiigo_cont IS null )", array("+5","26"))
                                ->execute();
        $i=0;
        foreach($comprobantesSiigo as $comproSiigo)
        {
        
            echo "<br>".$i++."||".$comproSiigo->getCd_doc_cont().$comproSiigo->getNu_docsop_cont()."-".$comproSiigo->getNu_cont()."<br>";
            $comprobante=$comproSiigo->getInoComprobante();
            $tipoComprobante = $comprobante->getInoTipoComprobante();
            $consecutivo=$comprobante->getCaConsecutivo();
            
            /*print_r(array(
                    a=>date("Y", strtotime($comproSiigo->getFechaCont())),
                    t=>$tipoComprobante->getCaTipo(),
                    nt=>$tipoComprobante->getCaComprobante(),
                    c=>$consecutivo,
                    d=>$tipoComprobante->getCaIdempresa())
                    );*/
            
            $result = $client->actualiza(
                array(
                    a=>date("Y", strtotime($comproSiigo->getFechaCont())),
                    t=>$tipoComprobante->getCaTipo(),
                    nt=>$tipoComprobante->getCaComprobante(),
                    c=>$consecutivo,
                    d=>$tipoComprobante->getCaIdempresa()));

            //print_r($result);echo "<br>";
            $indincor=$comproSiigo->getIndIncorpCont();
            $errorsiigo=$comproSiigo->getCdErrsiigoCont();

            
            if( ($indincor=="+6" || $indincor=="6") && $errorsiigo=="26")
            {
                //$comprobante->setCaEstado(InoComprobante::ERROR_TRANSFERIDO);
                //$comprobante->save($conn);
                $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
                $comprobante->save($conn);
            }
            else if($indincor=="+5" || $indincor=="5")
            {
                $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
                $comprobante->save($conn);
            }
        }


        $comprobantesSiigo = Doctrine::getTable("SiigoComprobante")
                        ->createQuery("d")
                        ->where("d.ind_incorp_cont!=? and (cd_errsiigo_cont != ? or cd_errsiigo_cont IS null )", array("+5","26"))
                        ->execute();
        $info="<table><tr><td><b>Los siguientes comprobantes no fueron traladados a SIIGO:</b></td></tr>";
        foreach($comprobantesSiigo as $comproSiigo)
        {
            $info.="<tr><td>".$comproSiigo->getCd_doc_cont().$comproSiigo->getNu_docsop_cont()."-".$comproSiigo->getNu_cont()."</td></tr>";
        }
        $info.="</table>";
        
        $destinatarios="lmbeleno@coltrans.com.co,mramon@coltrans.com.co,sporjuela@coltrans.com.co,jlgomez@coltrans.com.co,capulgarin@coltrans.com.co,yuly.gutierrez@colmas.com.co,pereira@coltrans.com.co,maquinche@coltrans.com.co,soporte-sistemas@coltrans.com.co";
            //$destinatarios="maquinche@coltrans.com.co,soporte-sistemas@coltrans.com.co";
            Utils::sendEmail(
            array(
                "from"=>"colsys@coltrans.com.co",
                "to"=>$destinatarios,
                "subject"=>"Fallo en envio trasmision de comprobantes",
                "body"=>"Falló el envio de comprobantes",
                "mensaje"=> "Los siguientes comprobantes no fueron traladados a SIIGO :$info<br>"
                )
            );
        exit;
    }
    
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarGridFacturacionPanel(sfWebRequest $request) {
        //try {
            //throw new Exception("El comprobante ".$request->getParameter("consecutivo")." ya se encuentra incluido" );
            $idcomprobante = $request->getParameter("idcomprobante");
            /*
             * Validaciones
             */
            $q = Doctrine::getTable("InoComprobante")
                           ->createQuery("c")
                           ->addWhere("c.ca_consecutivo = ?", $request->getParameter("consecutivo") );

            if( $idcomprobante ){
                $q->addWhere("c.ca_idcomprobante != ?", $idcomprobante);
            }
            $m = $q->fetchOne();
            if( $m ){
                throw new Exception("El comprobante ".$request->getParameter("consecutivo")." ya se encuentra incluido" );
            }
            /*
             * Guarda los datos
             */
            if ($idcomprobante) {
                $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
                $this->forward404Unless($comprobante);
            } else {
                $comprobante = new InoComprobante();
                //$comprobante->setCaIdtipo( InoComprobante::IDTIPO_F_INO );
            }
            $valor = $request->getParameter("valor");            
            $conn = $comprobante->getTable()->getConnection();
            $conn->beginTransaction();
            $idhouse = $request->getParameter("idhouse");
            $house = Doctrine::getTable("InoHouse")->find( $idhouse );
            $comprobante->setCaIdhouse($idhouse);

            $comprobante->setCaConsecutivo($request->getParameter("consecutivo"));
            $comprobante->setCaIdtipo($request->getParameter("idtipo"));
            $comprobante->setCaFchcomprobante($request->getParameter("fchcomprobante"));

            $comprobante->setCaId($request->getParameter("id"));
            $comprobante->setCaValor( $valor );
            $comprobante->setCaIdmoneda($request->getParameter("idmoneda"));
            $comprobante->setCaTcambio($request->getParameter("tasacambio"));
            $comprobante->setCaPlazo($request->getParameter("plazo"));
            $comprobante->setCaObservaciones($request->getParameter("observaciones"));
            $comprobante->save($conn);

            if( $comprobante->getCaId()=="800024075" && ($this->getUser()->getIdsucursal()=="OBO" || $this->getUser()->getIdsucursal()=="OMD" || $this->getUser()->getUserId()=="maquinche11")  )
            {
                $resultadoCosto=InoCostosSea::setCosto($comprobante,$conn);
                //echo $resultadoCosto;
                if($resultadoCosto<0)
                {
                    switch ($resultadoCosto)
                    {
                        case "-1":
                            $info="error:$resultadoCosto -> HBL: NO ENCONTRADO";
                            break;
                        case "-2":
                            $info="error:$resultadoCosto -> REFERENCIA MARITIMA CERRADA";
                            break;
                        case "-3":
                            $info="error:$resultadoCosto -> REFERENCIA MARITIMA YA POSEE COSTO INGRESADO";
                            break;
                        case "-4":
                            $info="error:$resultadoCosto -> NO SE ENCONTRO LA DEDUCCION EN EL CASO MARITIMO";
                            break;
                    }
                    //throw new Exception("Error : $resultadoCosto");
                }
            }
            //else
            //    throw new Exception("Error : $resultadoCosto");
            //$costo=new InoCostosSea();

            if ($idcomprobante) {
                $detalles = Doctrine::getTable("InoDetalle")
                                ->createQuery("d")
                                ->addWhere("d.ca_idcomprobante=?", $idcomprobante)
                                ->execute();
                foreach( $detalles as $d ){
                    $d->delete( $conn );
                }
            }

            $totalDed = 0;
            $deducciones = $request->getParameter("deducciones");
            if( $deducciones ){
                $deducciones = explode("|", $deducciones);
                
                foreach( $deducciones as $d ){
                    $params =  $array = sfToolkit::stringToArray( $d );
                    if( $params["neto"] ){
                        $inoDeduccion = Doctrine::getTable("InoDeduccion")->find(array($params["iddeduccion"], $comprobante->getCaIdcomprobante()));
                        if(!$inoDeduccion)
                        {
                            $inoDeduccion=new InoDeduccion(); 
                            $inoDeduccion->setCaIdcomprobante($comprobante->getCaIdcomprobante());
                            $inoDeduccion->setCaIddeduccion($params["iddeduccion"]);
                        }
                        $inoDeduccion->setCaNeto($params["neto"]);
                        $inoDeduccion->setCaTcambio($request->getParameter("tasacambio"));
                        $inoDeduccion->save($conn);
                        
                        $inoDetalle = new InoDetalle();
                        //$inoDetalle->setCaIddeduccion( $params["iddeduccion"] );
                        $inoDetalle->setCaIdcomprobante( $comprobante->getCaIdcomprobante() );
                        $inoDetalle->setCaCr( $params["neto"] );
                        $inoDetalle->setCaIdconcepto( $params["iddeduccion"] );
                        $inoDetalle->setCaIdhouse( $house->getCaIdhouse() );
                        $inoDetalle->setCaIdmaster( $house->getCaIdmaster() );
                        $inoDetalle->setCaId( $comprobante->getCaId() );
                        $inoDetalle->save( $conn );
                        $totalDed+=$params["neto"];
                    }
                }
            }
            if($comprobante->getCaIdtipo()!="13")
            {
                if(  $totalDed>$valor ){
                    throw new Exception("El total de las deducciones excede el valor total de la factura.");
                }
            }
            $vlrIngreso = $valor-$totalDed;
            //Cuenta ingreso
            $inoDetalle = new InoDetalle();
            //$inoDetalle->setCaIddeduccion( $params["iddeduccion"] );
            $inoDetalle->setCaIdcomprobante( $comprobante->getCaIdcomprobante() );
            $inoDetalle->setCaCr( $vlrIngreso );
            $inoDetalle->setCaIdconcepto( InoComprobante::ID_FACTURACION );
            $inoDetalle->setCaIdhouse( $house->getCaIdhouse() );
            $inoDetalle->setCaIdmaster( $house->getCaIdmaster() );
            $inoDetalle->setCaId( $comprobante->getCaId() );
            $inoDetalle->save( $conn );
            //Cuenta deudores
            $inoDetalle = new InoDetalle();
            //$inoDetalle->setCaIddeduccion( $params["iddeduccion"] );
            $inoDetalle->setCaIdcomprobante( $comprobante->getCaIdcomprobante() );
            $inoDetalle->setCaDb( $valor );
            $inoDetalle->setCaIdconcepto( InoComprobante::ID_DEUDORES );
            $inoDetalle->setCaIdhouse( $house->getCaIdhouse() );
            $inoDetalle->setCaIdmaster( $house->getCaIdmaster() );
            $inoDetalle->setCaId( $comprobante->getCaId() );
            $inoDetalle->save( $conn );
            $conn->commit();
            //$conn->rollBack();

            $this->responseArray = array("success" => true, "id" => $request->getParameter("id"), "idcomprobante" => $comprobante->getCaIdcomprobante(),"info"=>$info );
       /* } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }*/

        $this->setTemplate("responseTemplate");
    }
    
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeEliminarGridFacturacionPanel(sfWebRequest $request) {
        try {
            $errorInfo="";

            $idcomprobante = $request->getParameter("idcomprobante");
            $iddetalle = $request->getParameter("iddetalle");

            $obj=null;
            if($idcomprobante>0)
            {
                $obj = Doctrine::getTable("InoComprobante")->find($idcomprobante);
                $c=$obj->getCaIdcomprobante();
            }
            else if($iddetalle>0)
            {
                $obj = Doctrine::getTable("InoDetalle")->find($iddetalle);
                $c=$obj->getCaIddetalle();
            }

            if($obj)
            {                
                $obj->delete();
            }
            else 
                $errorInfo="No fue posible encontrar ningun registro";

            $this->responseArray = array("success" => true,"c"=>$c,"errorInfo"=>$errorInfo);
        } catch (Exception $e) {                        
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }    
    
    public function executeDatosGridDeduccionesPanel(sfWebRequest $request) {
        $idcomprobante = $request->getParameter("idcomprobante");
        $data = array();
        if( $idcomprobante ){ 
            $inoDeducciones = Doctrine::getTable("InoDeduccion")
                            ->createQuery("d")
                            ->select("d.*, ded.*")
                            ->innerJoin("d.Deduccion ded")                                                
                            ->where("d.ca_idcomprobante = ?", $idcomprobante)
                            ->addOrderBy("ded.ca_deduccion")
                            ->execute();
       
            foreach ($inoDeducciones as $d) {                
                $row = array();
                $row["iddeduccion"] = $d->getCaIddeduccion();
                $row["deduccion"] = utf8_encode($d->getDeduccion()->getCaDeduccion());                
                $row["neto"] = $d->getCaNeto();
                $row["tcambio"] = $d->getCaTcambio();
                $row["valor"] = $d->getCaNeto()*$d->getCaTcambio();
                $row["orden"] = "A";
                $data[] = $row;            
            }
        }
        
        $data[] = array("iddeduccion"=>"", "deduccion"=>"+", "orden"=>"Z");

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }
    
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosGridFacturacionFormPanel(sfWebRequest $request) {

        $idcomprobante = $request->getParameter("idcomprobante");
        $this->forward404Unless($idcomprobante);
        $comprobante = Doctrine::getTable("InoComprobante")
                        ->createQuery("c")
                        ->select("c.*, ids.*")                        
                        ->innerJoin("c.Ids ids")
                        ->where("c.ca_idcomprobante = ?", $idcomprobante)
                        ->fetchOne();

        $this->forward404Unless($comprobante);

        $tipo = $comprobante->getInoTipoComprobante();
        $data = array();
        $data["idhouse"] = $comprobante->getCaIdhouse();
        $data["ids"] = utf8_encode($comprobante->getIds()->getCaNombre());
        $data["ids_id"] = utf8_encode($comprobante->getCaId());
        //$data["tipo"] = $tipo->getCaTipo() . "-" . str_pad($tipo->getCaComprobante(), 2, "0", STR_PAD_LEFT) . " " . $tipo->getCaTitulo();
        $data["idtipo"] = $tipo->getCaIdtipo();
        $data["comprobante"] = utf8_encode($tipo . " " . str_pad($comprobante->getCaConsecutivo(), 6, "0", STR_PAD_LEFT));
        $data["fchcomprobante"] = utf8_encode($comprobante->getCaFchcomprobante());
        $data["idcomprobante"] = $comprobante->getCaIdcomprobante();
        $data["consecutivo"] = $comprobante->getCaConsecutivo();
        $data["plazo"] = $comprobante->getCaPlazo();
        $data["observaciones"] = $comprobante->getCaObservaciones();
        $data["tasacambio"] = $comprobante->getCaTcambio();
        $data["valor"] = $comprobante->getCaValor();
        $data["idmoneda"] = $comprobante->getCaIdmoneda();        

        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }
    
    
    public function executeDatosFacturas(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        $q = Doctrine::getTable("InoHouse")
                        ->createQuery("c")
                        ->select("c.ca_idhouse,  c.ca_idcliente ,c.ca_doctransporte, 
                        ids.ca_nombre , ids.ca_idalterno ,  ids.ca_dv,cl.ca_propiedades, 
                        comp.ca_idcomprobante, comp.ca_consecutivo,comp.ca_fchcomprobante,comp.ca_idmoneda,comp.ca_usugenero,comp.ca_fchgenero,
                        m.ca_nombre,s.ca_descripcion,det.ca_iddetalle,comp.ca_estado,tcomp.ca_tipo,tcomp.ca_comprobante,tcomp.ca_idempresa,
                        clH.ca_idcliente,clH.ca_compania,cric.ca_rteica,det.*")
                        ->innerJoin("c.InoComprobante comp")
                        ->innerJoin("comp.Ids ids")
                        ->innerJoin("ids.IdsCliente cl")
//                        ->innerJoin("comp.InoHouse h")                        
                        ->innerJoin("c.Cliente clH")
                        ->innerJoin("comp.InoTipoComprobante tcomp")
                        ->leftJoin("comp.InoDetalle det WITH det.ca_idconcepto is not null AND ( (ca_cr>0 AND tcomp.ca_tipo='F') or (ca_db>0 AND tcomp.ca_tipo<>'F' ) )")
                        ->leftJoin("comp.Ids fact")                        
                        ->leftJoin("tcomp.Ctarteica cric WITH tcomp.ca_idempresa=cric.ca_idempresa")
                        //->leftJoin("comp.Ctarteiva criv")
                        //->leftJoin("comp.Ctaiva ci")                
                        //->innerJoin("tcomp.InoCentroCosto ccosto")
                        ->leftJoin("comp.Moneda m")
                        ->leftJoin('det.InoConSiigo s WITH tcomp.ca_idempresa=s.ca_idempresa ')
                        ->where("c.ca_idmaster = $idmaster  ")
                        ->addOrderBy("tcomp.ca_tipo,tcomp.ca_comprobante")
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

//        echo $this->idmaster."<br>";
        //echo $q->getSqlQuery();
        //exit;
        $datos=$q->execute();
        $this->data = array();

        foreach ($datos as $d) {
            $consecutivo=($d["tcomp_ca_tipo"]=="F")?"FACTURA ":(($d["tcomp_ca_tipo"]=="C")?"<span class='row_yellow'>NOTA CREDITO</span>":"");
            $consecutivo.=($d["comp_ca_consecutivo"]=="")?" Sin Generar - ".$d["comp_ca_idcomprobante"]:$d["tcomp_ca_tipo"]."".$d["tcomp_ca_comprobante"]."-".$d["comp_ca_consecutivo"];
            $consecutivo.=" - ".utf8_encode($d["ids_ca_nombre"])." - ".$d["c_ca_doctransporte"];
            
            if($d["clH_ca_compania"]!=$d["ids_ca_nombre"])
                $consecutivo.= " - ".utf8_encode ($d["clH_ca_compania"]);
            
            
            if($d["comp_ca_fchgenero"]!="" && $d["comp_ca_usugenero"]!="")
                $consecutivo.= "({$d["comp_ca_usugenero"]}-{$d["comp_ca_fchgenero"]})";
            
            if($d["comp_ca_estado"]=="5")
            {
                $consecutivo="<span class='row_green'>$consecutivo</span>";
            }
            else if($d["comp_ca_estado"]=="6")
            {
                $consecutivo="<span class='row_pink'>$consecutivo</span>";
            }
            else if($d["comp_ca_estado"]=="8")
            {
                $consecutivo="<span class='row_purple'>$consecutivo</span>";
            }
            $cuenta_forma_pago="";
            if( $d["cl_ca_propiedades"] ){
                $array = sfToolkit::stringToArray( $d["cl_ca_propiedades"] );
                if($d["tcomp_ca_idempresa"]=="2")
                {
                    $cuenta_forma_pago=isset($array["cuenta_forma_pago_coltrans"])?$array["cuenta_forma_pago_coltrans"]:'';
                }
                else if($d["tcomp_ca_idempresa"]=="8")                
                    $cuenta_forma_pago=isset($array["cuenta_forma_pago_colotm"])?$array["cuenta_forma_pago_colotm"]:'';
                else
                    $cuenta_forma_pago='';
            }

            $this->data[]=array(
                "idhouse"=>$d["c_ca_idhouse"]      ,   "idcomprobante"=>$d["comp_ca_idcomprobante"],
                "tipocomprobante"=>$d["tcomp_ca_tipo"],
                "comprobante"=>$consecutivo      ,   "fchcomprobante"=>$d["comp_ca_fchcomprobante"],
                "cliente"=>$d["cl_ca_nombre"]      ,   "doctransporte"=>$d["c_ca_doctransporte"],
                "idmoneda"=>$d["m_ca_idmoneda"]      ,   "moneda"=>$d["m_ca_nombre"],
                "valor"=>($d["det_ca_cr"]>0?$d["det_ca_cr"]:$d["det_ca_db"])      ,   
                /*"valor"=>$d["det_ca_cr"] ,*/
                "idconcepto"=>$d["det_ca_idconcepto"],
                "concepto"=>  utf8_encode($d["det_ca_idconcepto"]."-".$d["s_ca_descripcion"]),
                "iddetalle"=>$d["det_ca_iddetalle"],"estado"=>$d["comp_ca_estado"],
                "cuentapago"=>$cuenta_forma_pago    , "idccosto"=>$d["tcomp_ca_idccosto"]                
                );

        }
        //print_r($this->data);
        //echo $consecutivo;
        $this->responseArray = array("success" => true, "root" => $this->data, "total" => count($this->data),"debug"=>$q->getSqlQuery());
        $this->setTemplate("responseTemplate");
    }
    
    
    
    public function executeDatosFormFactura(sfWebRequest $request) {
        $this->forward404Unless($request->getParameter("idcomprobante"));
        $idcomprobante = $request->getParameter("idcomprobante");
        $inoComprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
        $this->forward404Unless($inoComprobante);

        $data = array();
        
        $data["idcomprobante"] = $idcomprobante;
        $data["idhouse"] = $inoComprobante->getCaIdhouse();
        $data["consecutivo"] = $inoComprobante->getCaConsecutivo();        
        $data["fecha"] = $inoComprobante->getCaFchcomprobante();
        $data["idtipocomprobante"] = $inoComprobante->getCaIdtipo();

        $data["idcliente"] = $inoComprobante->getCaId();
        $data["cliente"] = utf8_encode($inoComprobante->getIds()->getCaNombre());
        
        $data["idsucursal"] = $inoComprobante->getCaIdsucursal();
        $data["ciudad"] = utf8_encode($inoComprobante->getIdsSucursal()->getCiudad()->getCaCiudad());
        
        $data["tcambio"] = $inoComprobante->getCaTcambio();
        $data["idmoneda"] = $inoComprobante->getCaIdmoneda();
        $data["moneda"] = $inoComprobante->getMoneda()->getCaNombre();
        $data["observaciones"] = utf8_encode($inoComprobante->getCaObservaciones());
        
        $data["bienestrans"]=utf8_encode($inoComprobante->getProperty("bienestrans"));
        $data["detalle"]=utf8_encode($inoComprobante->getProperty("detalle"));
        $data["anexos"]=utf8_encode($inoComprobante->getProperty("anexos"));

        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }


    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeFormComprobante(sfWebRequest $request) {
        
        //$this->nivel = $this->getNivel();
        $request->setParameter("tipo", "F");
        $this->forward("inocomprobantes", "formComprobante");
    }

    /*     * ***********************************************************************
     *
     *   Acciones para el cuadro de costos
     *
     * ************************************************************************* */

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosGridCostosPanel(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        
        $costos = Doctrine::getTable("InoCosto")
                        ->createQuery("c")
                        ->select("c.ca_idinocosto, c.ca_idmaster, c.ca_neto, c.ca_venta, c.ca_factura,
                                  c.ca_tcambio, c.ca_tcambio_usd, c.ca_idcosto, p.ca_sigla, i.ca_nombre,
                                  c.ca_idmoneda, cs.ca_concepto,c.ca_fchfactura,c.ca_idproveedor ")
                        ->innerJoin("c.InoConcepto cs")
                        ->innerJoin("c.Ids i")
                        ->where("c.ca_idmaster = ?", $idmaster)
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)  
                        ->execute();
                        //->set
                        //->execute(array(), Doctrine_Core::FETCH_ASSOC);

        
        foreach( $costos as $key=>$val ){
            $costos[$key]["i_ca_nombre"] = utf8_encode($costos[$key]["i_ca_nombre"]);
            $costos[$key]["cs_ca_concepto"] = utf8_encode($costos[$key]["cs_ca_concepto"]);
            $costos[$key]["orden"] = utf8_encode($costos[$key]["ca_idinocosto"]);            
            $costos[$key]["c_ca_factura"] = utf8_encode($costos[$key]["c_ca_factura"]);            
        }
        
        //$costos[]["cs_ca_concepto"]="+";
        //$costos[]["orden"]="z";

        $this->responseArray = array("success" => true, "root" => $costos, "total" => count($costos));
        $this->setTemplate("responseTemplate");
    }
    
    
     /*************************************************************************
    *
    *   Acciones para el cuadro de costos
    *
    ***************************************************************************/
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarGridCostosPanel(sfWebRequest $request) {
        $idcomprobante = $request->getParameter("idcomprobante");
        if ($idcomprobante) {
            $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
            $this->forward404Unless($comprobante);
        } else {
            $comprobante = new InoComprobante();
            $comprobante->setCaIdtipo(InoComprobante::IDTIPO_F_INO);
        }
        try {

            $conn = $comprobante->getTable()->getConnection();
            $conn->beginTransaction();

            if ($request->getParameter("comprobante")) {
                $comprobante->setCaConsecutivo($request->getParameter("comprobante"));
            }

            if ($request->getParameter("fchcomprobante")) {
                $comprobante->setCaFchcomprobante($request->getParameter("fchcomprobante"));
            }

            if ($request->getParameter("valor")) {
                $comprobante->setCaValor($request->getParameter("valor"));
            }

            if ($request->getParameter("idmoneda")) {
                $comprobante->setCaIdmoneda($request->getParameter("idmoneda"));
            }
            if ($request->getParameter("cambio")) {
                $comprobante->setCaTcambio($request->getParameter("cambio"));
            }
            $comprobante->save($conn);

            $conn->commit();
            //$conn->rollBack();
            $this->responseArray = array("success" => true, "id" => $request->getParameter("id"));
        } catch (Exception $e) {

            throw $e;
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }    
    
    /*     * ***********************************************************************
     *
     *   Acciones para el cuadro de costos
     *
     * ************************************************************************* */

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeFormCosto(sfWebRequest $request) {
        $this->proveedor = null;
        $this->utilidades = array();
        $monedaLocal = $this->getUser()->getIdmoneda();
        $idinocosto = $request->getParameter("idinocosto");
        if ($idinocosto) {
            $inoCosto = Doctrine::getTable("InoCosto")->find($idinocosto);
            $this->forward404Unless($inoCosto);
            
            $referencia = $inoCosto->getInoMaster();
            
            $utilidades = Doctrine::getTable("InoUtilidad")
                ->createQuery("u")                
                ->addWhere("u.ca_idinocosto = ?", $inoCosto->getCaIdinocosto())                  
                ->execute();
            foreach ($utilidades as $ut) {
                $this->utilidades[$ut->getCaIdhouse()] = $ut->getCaValor();
            }
            
        } else {
            $inoCosto = new InoCosto();
            
            $this->forward404Unless($request->getParameter("idmaster"));           
            $referencia = Doctrine::getTable("InoMaster")->find($request->getParameter("idmaster"));
            $this->forward404Unless($referencia);
        }
        
        $this->inoHouses = array();
        $this->inoHouses = Doctrine::getTable("InoHouse")
                ->createQuery("h")
                ->innerJoin("h.Cliente cl")
                ->addWhere("h.ca_idmaster = ?", $referencia->getCaIdmaster())
                ->addOrderBy("h.ca_doctransporte")
                ->execute();
        
        $this->form = new CostosINOForm();
        $this->form->setReferencia($referencia);
        $this->form->setInoHouses($this->inoHouses);
        $this->form->configure();

        if ($request->isMethod('post')) {

            $bindValues = array();
            $bindValues["idmaster"] = intval($request->getParameter("idmaster"));
            $bindValues["idinocosto"] = intval($request->getParameter("idinocosto"));
            $bindValues["idcosto"] = intval($request->getParameter("idcosto"));
            $bindValues["idmoneda"] = $request->getParameter("idmoneda");            
            $bindValues["factura"] = $request->getParameter("factura");
            $bindValues["factura_ant"] = $request->getParameter("factura_ant");
            $bindValues["fchfactura"] = $request->getParameter("fchfactura");
            $bindValues["neto"] = $request->getParameter("neto");
            $bindValues["venta"] = $request->getParameter("venta");
            $bindValues["tcambio"] = $request->getParameter("tcambio");
            $bindValues["tcambio_usd"] = $request->getParameter("tcambio_usd");
            $bindValues["idproveedor"] = $request->getParameter("idproveedor");
            $bindValues["proveedor"] = $request->getParameter("proveedor");
            if( $bindValues["idmoneda"]=="USD" || $bindValues["idmoneda"]==$monedaLocal ){                   
                $bindValues["tcambio_usd"] = 1;
            }
            
            if( $bindValues["idmoneda"]==$monedaLocal ){
               $bindValues["tcambio"] = 1;  
            }

            foreach ($this->inoHouses as $ic) {
                $bindValues["util_" . $ic->getCaIdhouse()] = $request->getParameter("util_" . $ic->getCaIdhouse());
            }

            $this->form->bind($bindValues);
            if ($this->form->isValid()) {
                $conn = Doctrine::getTable("Reporte")->getConnection();
                $conn->beginTransaction();
                try {

                    if ($bindValues["idinocosto"]) {
                        $utils = Doctrine::getTable("InoUtilidad")
                                ->createQuery("u")
                                ->addWhere("u.ca_idinocosto = ?", $bindValues["idinocosto"])                                
                                ->execute();
                        foreach ($utils as $u) {
                            $u->delete($conn);
                        }
                    }

                    if (!$idinocosto) {
                        $inoCosto->setCaIdmaster($bindValues["idmaster"]);                        
                    }
                    if( $bindValues["idcosto"] ){
                        $inoCosto->setCaIdcosto($bindValues["idcosto"]);
                    }
                    
                    $inoCosto->setCaIdmoneda($bindValues["idmoneda"]);
                    $inoCosto->setCaFactura($bindValues["factura"]);
                    $inoCosto->setCaFchfactura($bindValues["fchfactura"]);
                    $inoCosto->setCaNeto($bindValues["neto"]);
                    $inoCosto->setCaVenta($bindValues["venta"]);
                    $inoCosto->setCaTcambio($bindValues["tcambio"]);
                    $inoCosto->setCaTcambioUsd($bindValues["tcambio_usd"]);
                    $inoCosto->setCaIdproveedor($bindValues["idproveedor"]);
                    $inoCosto->save($conn);

                    foreach ($bindValues as $key => $val) {
                        if (substr($key, 0, 4) == "util") {
                            if ($val) {   
                                $idhouse = substr($key, 5);
                                $ut = new InoUtilidad();                                                      
                                $ut->setCaIdhouse($idhouse);
                                $ut->setCaIdinocosto( $inoCosto->getCaIdinocosto() );                                
                                $ut->setCaValor($val);
                                $ut->save($conn);
                            }
                        }
                    }
                    $conn->commit();
                    $this->redirect("inoF/verReferenciaExt4?modo=".$this->modo->getCaIdmodo()."&idmaster=" . $referencia->getCaIdmaster());
                } catch (Exception $e) {                    
                    throw $e;
                }
            }
        }                
        $this->referencia = $referencia;
        $this->inoCosto = $inoCosto;
        $this->monedaLocal = $monedaLocal;
    }
    
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeEliminarGridCostosPanel(sfWebRequest $request) {
        try {            
            $idinocosto = $request->getParameter("idinocosto");
            $this->forward404Unless($idinocosto);
            $costo= Doctrine::getTable("InoCosto")->find($idinocosto);
            $this->forward404Unless($costo);
            $costo->delete();
            $this->responseArray = array("success" => true, "errorInfo" =>"");
        } catch (Exception $e) {                        
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
    
    /*     * ***********************************************************************
     *
     *   Acciones para el cuadro de costos discriminados
     *
     * ************************************************************************* */
    
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeFormCostoDiscriminados(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        
        $this->referencia = Doctrine::getTable("InoMaster")->find($request->getParameter("idmaster"));
        $this->forward404Unless($this->referencia);
        if( $request->getParameter("idcomprobante") ){
            $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
            $this->forward404Unless($this->comprobante);
        }else{
            $this->comprobante = null;
        }
    }
    
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosFormCostosDiscriminadosPanel(sfWebRequest $request) {
        $idcomprobante = $request->getParameter("idcomprobante");
        $this->forward404Unless($idcomprobante);
        
        
        $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
        $this->forward404Unless($comprobante);
        
        $data = array();
        //$comprobante = new InoComprobante();
        $data["idcomprobante"] = $comprobante->getCaIdcomprobante();   
        $data["fchfactura"] = $comprobante->getCaFchcomprobante();        
        $data["tcambio_usd"] = $comprobante->getCaTcambioUsd();        
        $data["tcambio"] = $comprobante->getCaTcambio();
        $data["idmoneda"] = $comprobante->getCaIdmoneda();
        $data["factura"] = $comprobante->getCaConsecutivo();
        $data["tipo"] = $comprobante->getCaIdtipo();
        $data["ids"] = $comprobante->getCaId();
        $data["ids_nombre"] = $comprobante->getIds()->getCaNombre();
        
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosFormCostosDiscriminadosGridPanel(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        $inoHouses = Doctrine::getTable("InoHouse")
                        ->createQuery("c")
                        ->select("c.*, cl.*")
                        //->innerJoin("c.Ids cl")
                        ->innerJoin("c.Cliente cl")
                        ->where("c.ca_idmaster = ?", $idmaster)
                        ->addOrderBy("cl.ca_compania")
                        ->execute();

        $data = array();

        foreach ($inoHouses as $inoHouse) {
            $row = array();
            $row["idmaster"] = $inoHouse->getCaIdmaster();
            $row["idhouse"] = $inoHouse->getCaIdhouse();
            $row["doctransporte"] = utf8_encode($inoHouse->getCaDoctransporte());
            $row["fchdoctransporte"] = $inoHouse->getCaFchdoctransporte();
            $row["numorden"] = utf8_encode($inoHouse->getCaNumorden());
            $row["idcliente"] = $inoHouse->getCliente()->getCaIdcliente();
            $row["cliente"] = utf8_encode($inoHouse->getCliente()->getCaCompania());
            $row["vendedor"] = $inoHouse->getCaVendedor();
            $row["idreporte"] = $inoHouse->getCaIdreporte();
            $row["reporte"] = $inoHouse->getReporte()->getCaConsecutivo();
            $row["numpiezas"] = $inoHouse->getCaNumpiezas()." ".utf8_encode($inoHouse->getCaMpiezas());
            $row["peso"] = $inoHouse->getCaPeso();
            $row["volumen"] = $inoHouse->getCaVolumen();
            $row["idtercero"] = $inoHouse->getCaIdtercero();
            $row["tercero"] = utf8_encode($inoHouse->getTercero()->getCaNombre());
            $data[] = $row;
        }


        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }
    
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeFormCostosDiscriminadosPanelGuardar(sfWebRequest $request) {
        
        try {
            
            $idcomprobante = $request->getParameter("idcomprobante");
            if ($idcomprobante) {
                $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
                $this->forward404Unless($comprobante);
            } else {
                $comprobante = new InoComprobante();
                //$comprobante->setCaIdtipo( InoComprobante::IDTIPO_F_INO );
            }

            $conn = $comprobante->getTable()->getConnection();
            $conn->beginTransaction();
            $idhouse = $request->getParameter("idhouse");
            $house = Doctrine::getTable("InoHouse")->find( $idhouse );
            
            //print_r( $_POST );
            
            //$comprobante->setCaIdhouse($idhouse);
            
            $comprobante->setCaConsecutivo($request->getParameter("factura"));            
            $comprobante->setCaIdtipo($request->getParameter("idtipo"));
            $comprobante->setCaFchcomprobante($request->getParameter("fchfactura"));
            $comprobante->setCaId($request->getParameter("id"));
            $comprobante->setCaValor($request->getParameter("valor"));
            $comprobante->setCaIdmoneda($request->getParameter("idmoneda"));            
            $comprobante->setCaTcambio($request->getParameter("tcambio"));
            $comprobante->setCaTcambioUsd($request->getParameter("tcambio_usd"));
            $comprobante->setCaPlazo($request->getParameter("plazo"));
            $comprobante->setCaObservaciones($request->getParameter("observaciones"));

            $comprobante->save($conn);
            
            if ($idcomprobante) {
                $detalles = Doctrine::getTable("InoDetalle")
                                ->createQuery("d")
                                ->addWhere("d.ca_idcomprobante=?", $idcomprobante)
                                ->execute();
                foreach( $detalles as $d ){
                    $d->delete( $conn );
                }
            }
            
            $detalles = $request->getParameter("detalles");
            if( $detalles ){
                
                $total = 0;
                $detalles = explode("|", $detalles);
                
                foreach( $detalles as $d ){
                    $params =  $array = sfToolkit::stringToArray( $d );   
                    if( $params["neto"] ){
                        $inoDetalle = new InoDetalle();
                        $inoDetalle->setCaIdcomprobante( $comprobante->getCaIdcomprobante() );
                        $inoDetalle->setCaDb( $params["neto"] );
                        $inoDetalle->setCaIdconcepto( $request->getParameter("idconcepto") );                        
                        $inoDetalle->setCaIdhouse( $params["idhouse"] );
                        $inoHouse = Doctrine::getTable("InoHouse")->find( $params["idhouse"] );
                        $inoDetalle->setCaIdmaster( $inoHouse->getCaIdmaster() );
                        $inoDetalle->setCaId($request->getParameter("id"));
                        $inoDetalle->save( $conn );
                        $total+=$params["neto"];                        
                   }
                }
                
                if( $total!=0 ){
                    $inoDetalle = new InoDetalle();
                    $inoDetalle->setCaIdcomprobante( $comprobante->getCaIdcomprobante() );
                    $inoDetalle->setCaCr( $total );
                    $inoDetalle->setCaIdconcepto( InoComprobante::ID_PORPAGAR );                        
                    $inoDetalle->setCaIdhouse( null );                
                    $inoDetalle->setCaIdmaster( null );
                    $inoDetalle->setCaId($request->getParameter("id"));
                    $inoDetalle->save( $conn );
                }
            }

            $conn->commit();
            //$conn->rollBack();
            $this->responseArray = array("success" => true, "id" => $request->getParameter("id"), "idcomprobante" => $comprobante->getCaIdcomprobante());
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
    /*     * ***********************************************************************
     *
     *   Acciones para el cuadro de auditoria
     *
     * ************************************************************************* */

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosGridAuditoriaPanel(sfWebRequest $request) {

        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);

        $eventos = Doctrine::getTable("InoAuditor")
                        ->createQuery("a")
                        ->addWhere("a.ca_idmaster = ?", $idmaster)
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();

        foreach ($eventos as $key => $evento) {
            $eventos[$key]["ca_asunto"] = utf8_encode($eventos[$key]["ca_asunto"]);
            $eventos[$key]["ca_detalle"] = utf8_encode($eventos[$key]["ca_detalle"]);
            $eventos[$key]["ca_compromisos"] = utf8_encode($eventos[$key]["ca_compromisos"]);
            $eventos[$key]["ca_respuesta"] = utf8_encode($eventos[$key]["ca_respuesta"]);
        }
        $this->responseArray = array("success" => true, "root" => $eventos, "total" => count($eventos));
        $this->setTemplate("responseTemplate");
    }
    
    public function executeCerrarCaso(sfWebRequest $request) {
        try{
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        
        $ref = Doctrine::getTable("InoMaster")->find($request->getParameter("idmaster"));
        $this->forward404Unless($ref);
        
        $ref->setCaUsucerrado( $this->getUser()->getUserId() );
        $ref->setCaFchcerrado( date("Y-m-d H:i:s") );
        $ref->save();
        }
        catch(Exception $e)
        {
            print_r($e->getTraceAsString());
        }
        //exit;
        $this->redirect("inoF/verReferenciaExt4?modo=".$this->modo->getCaIdmodo()."&idmaster=".$ref->getCaIdmaster());
    }
    
    public function executeAbrirCaso(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        
        $ref = Doctrine::getTable("InoMaster")->find($request->getParameter("idmaster"));
        $this->forward404Unless($ref);
        
        $ref->setCaUsucerrado( null );
        $ref->setCaFchcerrado( null );
        $ref->save();
        $this->redirect("inoF/verReferenciaExt4?modo=".$this->modo->getCaIdmodo()."&idmaster=".$ref->getCaIdmaster());
    }  
    
    public function executeLiquidarCaso(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        
        $ref = Doctrine::getTable("InoMaster")->find($request->getParameter("idmaster"));
        $this->forward404Unless($ref);
        
        $ref->setCaUsuliquidado( $this->getUser()->getUserId() );
        $ref->setCaFchliquidado( date("Y-m-d H:i:s") );
        $ref->save();
        $this->redirect("inoF/verReferenciaExt4?modo=".$this->modo->getCaIdmodo()."&idmaster=".$ref->getCaIdmaster());
    }  
    
    public function executeCancelarLiquidarCaso(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        
        $ref = Doctrine::getTable("InoMaster")->find($request->getParameter("idmaster"));
        $this->forward404Unless($ref);
        
        $ref->setCaUsuliquidado( null );
        $ref->setCaFchliquidado( null );
        $ref->save();
        $this->redirect("inoF/verReferenciaExt4?modo=".$this->modo->getCaIdmodo()."&idmaster=".$ref->getCaIdmaster());
    }
    
    public function executeFormEquipoGuardar(sfWebRequest $request) {
        try {
            $idmaster = $request->getParameter("idmaster");
            $this->forward404Unless( $idmaster );
            $idequipo = $request->getParameter("idequipo");
            if( $idequipo ){
                $equipo = Doctrine::getTable("InoEquipo")->find( $idequipo );
                $this->forward404Unless( $equipo );
            }else{
                $equipo = new InoEquipo();
                $equipo->setCaIdmaster( $request->getParameter("idmaster") );
            }
            $conn = $equipo->getTable()->getConnection();
            $conn->beginTransaction();
            
            $equipo->setCaIdconcepto($request->getParameter("idconcepto"));            
            $equipo->setCaSerial($request->getParameter("serial"));
            $equipo->setCaNumprecinto($request->getParameter("numprecinto"));
            $equipo->setCaObservaciones($request->getParameter("observaciones")); 
            $equipo->save($conn);            
            $conn->commit();           
            $this->responseArray = array("success" => true, "id" => $request->getParameter("id"), "idequipo" => $equipo->getCaIdequipo());
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosGridEquiposPanel(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        $inoEquipos = Doctrine::getTable("InoEquipo")
                        ->createQuery("e")
                        ->select("e.*, con.*")
                        ->innerJoin("e.Concepto con")                        
                        ->where("e.ca_idmaster = ?", $idmaster)
                        ->addOrderBy("con.ca_concepto")
                        ->execute();

        $data = array();

        foreach ($inoEquipos as $e) {
            $row = array();
            $row["idmaster"] = $e->getCaIdmaster();
            $row["idequipo"] = $e->getCaIdequipo();
            $row["concepto"] = utf8_encode($e->getConcepto()->getCaConcepto());
            $row["idconcepto"] = $e->getCaIdconcepto();
            $row["serial"] = utf8_encode($e->getCaSerial());
            $row["numprecinto"] = $e->getCaNumprecinto();
            $row["cantidad"] = $e->getCaCantidad();
            $row["observaciones"] = utf8_encode($e->getCaObservaciones());
            $data[] = $row;
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
    }    
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosFormEquiposPanel(sfWebRequest $request) {

        $this->forward404Unless($request->getParameter("idequipo"));
        $idequipo = $request->getParameter("idequipo");
        $inoEquipo = Doctrine::getTable("InoEquipo")->find($idequipo);
        $this->forward404Unless($inoEquipo);
        $data = array();
        $data["idmaster"] = $inoEquipo->getCaIdmaster();
        $data["idequipo"] = $inoEquipo->getCaIdequipo();
        $data["concepto"] = utf8_encode($inoEquipo->getConcepto()->getCaConcepto());
        $data["idconcepto"] = $inoEquipo->getCaIdconcepto();
        $data["numprecinto"] = utf8_encode($inoEquipo->getCaNumprecinto());
        $data["serial"] = $inoEquipo->getCaSerial();
        $data["observaciones"] = utf8_encode($inoEquipo->getCaObservaciones());
        $data["cantidad"] = $inoEquipo->getCaCantidad();
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }
    
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeEliminarGridEquiposPanel(sfWebRequest $request) {

        $this->forward404Unless($request->getParameter("idequipo"));
        $idequipo = $request->getParameter("idequipo");
        $inoEquipo = Doctrine::getTable("InoEquipo")->find($idequipo);
        $this->forward404Unless($inoEquipo);

        try {
            $inoEquipo->delete();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
    
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeEliminarComprobante(sfWebRequest $request) {

        $this->forward404Unless($request->getParameter("idcomprobante"));
        $idcomprobante = $request->getParameter("idcomprobante");
        $inoComprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
        $this->forward404Unless($inoComprobante);

        try {
            $inoComprobante->delete();
            $this->responseArray = array("success" => true, "id"=>$request->getParameter("id"));
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
    
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeEliminarCosto(sfWebRequest $request) {

        $this->forward404Unless($request->getParameter("idinocosto"));
        $idinocosto = $request->getParameter("idinocosto");
        $inoCosto = Doctrine::getTable("InoCosto")->find($idinocosto);
        $this->forward404Unless($inoCosto);

        try {
            $inoCosto->delete();
            $this->responseArray = array("success" => true, "id"=>$request->getParameter("id"));
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }
    
    public function executeAnularReferencia(sfWebRequest $request) {
        $idmaster=$this->getRequestParameter("idmaster");
        $observaciones=$this->getRequestParameter("observaciones");
        
        $errorInfo="";
        
        $facturas = Doctrine::getTable("InoHouse")
                        ->createQuery("c")
                        ->select("c.*")      
                        ->innerJoin("c.Cliente cl")
                        ->innerJoin("c.InoComprobante comp")
                        ->leftJoin("comp.InoTipoComprobante tcomp")
                        ->innerJoin("comp.Ids fact")
                        ->where("c.ca_idmaster = ? and comp.ca_fchanulado is null and comp.ca_usuanulado is null and tcomp.ca_tipo='F'", $idmaster)
                        ->execute();
        if(count($facturas)>0)
            $errorInfo="La referencia no se puede eliminar porque ya posee ".count($facturas)." factura(s) creada(s)";
        else
        {
            $master = Doctrine::getTable("InoMaster")->find($idmaster);
            if( !$master->getCaFchanulado() ){        
                $master->setCaFchanulado(date('Y-m-d H:i:s'));
                $master->setCaMotivoanulado($observaciones);
                $master->setCaUsuanulado($this->getUser()->getUserId());                
                $master->save();
            }
            else
                $errorInfo="La Referencia ya se encuentra anulada";
        }
        if($errorInfo=="")
        {
            $this->responseArray = array("success" => true);
        }    
        else                
            $this->responseArray = array("success" => false,"errorInfo"=>$errorInfo);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeInstruccionesOtm(sfWebRequest $request) {
        $this->idmaster=$request->getParameter("idmaster");
        
        $this->master = Doctrine::getTable("InoMaster")->find($this->idmaster);
        
        if(!$this->master)
        {
            echo "Noexiste<br>";
            $this->master=new InoMaster();
        }
        $this->conta = ParametroTable::retrieveByCaso("CU098", $this->master->getCaIdlinea());
        
        if($this->conta[0])
        {        
            $this->contactos = $this->conta[0]->getCaValor2();
        }
        
        if($this->master->getCaOrigen()=="CTG-0005")
        {
            $this->contactos .= ",cabolano@colotm.com.co,otmctg@colotm.com";
        }
        else if($idorigen=="BUN-0002")
            $this->contactos .=",otmbun@colotm.com";
    }
    
    public function executeEnviarInstruccionesOtm(sfWebRequest $request)
    {
        $user = $this->getUser();        
        $this->idmaster=$request->getParameter("idmaster");
        $this->master = Doctrine::getTable("InoMaster")->find($this->idmaster);
        $house=$this->master->getInoHouse();
        $totales=array();
        foreach($house as $h)
        {
            $reporte = $h->getReporte();            
            $htmlReportes[]="<tr><td>".$reporte->getCaConsecutivo()."</td><td>".$h->getCaDoctransporte()."</td><td>".$reporte->getCliente("continuacion")->getCaCompania()."</td><td>".$reporte->getRepOtm()->getInoDianDepositos()->getCaNombre()."</td><td>".$reporte->getBodega()->getCaNombre()."/".$reporte->getBodega()->getCaTipo()."</td><td>".$h->getCaNumpiezas()." </td><td>".$h->getCaPeso()."</td><td>".$h->getCaVolumen()."</td><td>".$reporte->getRepOtm()->getCaValorfob()."</td></tr>";
            $totales["volumen"]+=$h->getCaVolumen();
            $totales["piezas"]+=$h->getCaNumpiezas();
            $totales["peso"]+=$h->getCaPeso();
            $totales["valorFob"]+=$reporte->getRepOtm()->getCaValorfob();
        }
        $htmlReportes[]="<tr><td colspan=5>TOTALES</td><td>".$totales["piezas"]." </td><td>".$totales["peso"]."</td><td>".$totales["volumen"]."</td><td>".$totales["valorFob"]."</td></tr>";
        $email = new Email();

        $email->setCaUsuenvio($user->getUserId());
        $email->setCaTipo("InstruccionesOtm"); //Envío de Avisos
        $email->setCaIdcaso(null);

        $from = $request->getParameter("from");
        if ($from) {
            $email->setCaFrom($from);
        } else {
            $email->setCaFrom($user->getEmail());
        }
        $email->setCaFromname($user->getNombre());

        if ($request->getParameter("readreceipt")) {
            $email->setCaReadreceipt(true);
        } else {
            $email->setCaReadreceipt(false);
        }
        
        $email->setCaReplyto($user->getEmail());

        $recips = explode(",", $request->getParameter("destinatario"));
        
        foreach ($recips as $recip) {
            $recip = str_replace(" ", "", $recip);
            if ($recip) {
                $email->addTo($recip);
            }
        }
        
        $recips = explode(",", $request->getParameter("cc"));
        foreach ($recips as $recip) {
            $recip = str_replace(" ", "", $recip);
            if ($recip) {
                $email->addCc($recip);
            }
        }
        if ($from) {
            $email->addCc($from);
        } else {
            $email->addCc($this->getUser()->getEmail());
        }

        $email->setCaSubject($request->getParameter("asunto"));
        $email->setCaBody($request->getParameter("mensaje"));

        $mensaje = Utils::replace($request->getParameter("mensaje")) . "<br />";

        $html ="<div>
            <table class='tableList alignLeft'><tr><td>
            <table class='tableList alignLeft' width='1000' >
            <tr><th colspan='8'>Se Creo la Referencia No: ".$this->master->getCaReferencia()."</th></tr>
            <tr><th>NO REPORTE</th><th>HBL</th><th>IMPORTADOR</th><th>MUELLE</th><th>BODEGA</th><th>PIEZAS</th><th>PESO</th><th>VOLUMEN</th><th>VALOR FOB</th></tr>";
        $html.=implode("",$htmlReportes );
        $html."</table></td></tr></table></div>";

        $this->getRequest()->setParameter('tipo',"INSTRUCCIONES");
        $this->getRequest()->setParameter('mensaje',$request->getParameter("mensaje"));
        $this->getRequest()->setParameter('html',$html);
        $request->setParameter("format", "email");
        $mensaje = sfContext::getInstance()->getController()->getPresentationFor( 'reportesNeg', 'emailReporte');
        $email->setCaBodyhtml($mensaje);
        $email->save($conn);
    }
    
    
    public function executeImportFac() {
        
    }

    public function executeProcesarImportFac(sfWebRequest $request) {
        try {
            $con = Doctrine_Manager::getInstance()->connection();
            $estadisticas = array();
            $folder = "Rc";
            $file = sfConfig::get('app_digitalFile_root') . $folder . DIRECTORY_SEPARATOR . $request->getParameter("archivo");

            chmod($file, 0777);
            $lines = file($file);

            $resultado = array();
            $resultado1 = array();
            $tipos = array("tb_inoingresos_sea", "tb_inoingresos_air", "tb_expo_ingresos", "tb_brk_ingresos");
            $pk = array("tb_inoingresos_sea" => explode(",", "ca_referencia,ca_idcliente,ca_hbls,ca_factura"),
                "tb_inoingresos_air" => explode(",", "ca_referencia,ca_idcliente,ca_hawb,ca_factura"),
                "tb_expo_ingresos" => explode(",", "ca_referencia,ca_idcliente,ca_documento,ca_factura"),
                "tb_brk_ingresos" => explode(",", "ca_referencia,ca_factura"));

            $sql_update = "";
            $total = count($lines);

            $sucRec = array("1" => "BOG", "2" => "MDE", "3" => "CLO", "4" => "BAQ", "5" => "DOLARES", "6" => "PEI", "7" => "BUN", "8" => "CTG", "9" => "BUC");
            $sucFacAssoc = array("BOG" => "1", "CLO" => "2", "MDE" => "3", "BAQ" => "4", "PEI" => "5", "BUN" => "7", "ABO" => "1");
            $sucFac = array("1" => "BOG", "2" => "CLO", "3" => "MDE", "4" => "BAQ", "5" => "PEI", "7" => "PEI");
            $sqltmp = "";
            for ($i = 0; $i < count($lines); $i++) {
                $sql_update = "";
                $datos = explode(",", $lines[$i]);

                $suc_recibo = (int) str_replace("\"", "", $datos[1]);
                $suc_factura = (int) str_replace("\"", "", $datos[11]);

                $tipo_comp = str_replace("\"", "", $datos[10]);

                $nfact = (int) str_replace("\"", "", $datos[12]);
                $pre = str_replace("\"", "", $datos[0]) . ((int) str_replace("\"", "", $datos[1]));

                $nrecibo = (int) str_replace("\"", "", $datos[2]);
                $fecha_pago = Utils::parseDate((int) str_replace("\"", "", $datos[7]));
                $comienzo_log = "<b>linea</b>=" . $i . ":::<b>Factura</b>=" . $nfact . ":::<b>Recibo</b>=" . $nrecibo . " ::: ";
                if (count($datos) != 13) {
                    $resultado[$i] = $comienzo_log . "Existen cantidad de campos diferente a los establecidos<br>";
                    $estadisticas["formato_incorrecto"]++;
                    continue;
                }
                //echo $sucRec[$suc_recibo].'-'.$sucFac[$suc_factura]."<br>";
                if ($sucRec[$suc_recibo] != $sucFac[$suc_factura]) {
                    $resultado[$i] = $comienzo_log . "La sucursal registrada en el recibo es diferente a la de la factura";
                    $estadisticas["direfente_sucursal"]++;
                    continue;
                }
                //echo $nfact."".$tipo_comp."<br>";
                if (!$nfact) {

                    $resultado[$i] = $comienzo_log . "No posee No Factura";
                    $estadisticas["sin_factura"]++;
                    continue;
                }
                if (strcmp($tipo_comp, 'F') != 0) {
                    $resultado[$i] = $comienzo_log . "No posee No Factura " . $tipo_comp . " ";
                    $estadisticas["sin_factura"]++;
                    continue;
                }

                if ($datos[2] == "" && $datos[7] == "") {
                    $resultado[$i] = $comienzo_log . "No posee No Recibo de caja ni fecha de pago";
                    $estadisticas["sin_recibo"]++;
                    $estadisticas["sin_fecha"]++;
                    continue;
                }
                if ($datos[2] == "") {
                    $resultado[$i] = $comienzo_log . "No posee No Recibo de caja";
                    $estadisticas["sin_recibo"]++;
                }
                if ($datos[7] == "") {
                    $resultado[$i] = $comienzo_log . "No posee fecha de pago";
                    $estadisticas["sin_fecha"]++;
                }

                $encontro = false;
                $actualizo = false;

                $sucursal = $sucRec[$suc_recibo];
                if ($sucursal == "BOG" || $sucursal == "ABO" || $sucursal == "OBO")
                    $sucursal = "'BOG','ABO','OBO'";
                else
                    $sucursal = "'$sucursal'";

                foreach ($tipos as $tabla) {
                    //$sql="select t.*,u.ca_idsucursal from ".$tabla." t,control.tb_usuarios u where (ca_factura ='".$nfact."' or ca_factura ='F".$suc_factura."-".$nfact."' ) and t.ca_usucreado=u.ca_login and u.ca_idsucursal in ($sucursal) ";
                    $sql = "select t.*,u.ca_idsucursal from " . $tabla . " t,control.tb_usuarios u where (ca_factura ='" . $nfact . "' or ca_factura ='F" . $suc_factura . "-" . $nfact . "' ) and t.ca_usucreado=u.ca_login and u.ca_idsucursal in ($sucursal) ";
                    //echo  $sql."<br>";
                    $st = $con->execute($sql);
                    $ref = $st->fetch();

                    if ($ref) {
                        //echo "$i<br>";
                        $set = "";
                        $sql_update = "update " . $tabla . " set ";
                        $where = "";
                        if ($nrecibo) {
                            if ($ref["ca_reccaja"] == "" || $ref["ca_reccaja"] == "''") {
                                $set = " ca_reccaja='" . $pre . " " . $nrecibo . "'";
                            } else {
                                $resultado[$i].=($resultado[$i] == "") ? $comienzo_log : "";
                                $resultado[$i].="-" . $tabla . ":: Recibo de caja ya cargado 'No se actualizo',";
                            }
                        }

                        if ($fecha_pago) {
                            if ($ref["ca_fchpago"] == "") {
                                $set.=($set != "") ? "," : "";
                                $set.=" ca_fchpago='" . $fecha_pago . "'";
                            } else {
                                $resultado[$i].=($resultado[$i] == "") ? $comienzo_log : "";
                                $resultado[$i].=$tabla . ":: Fecha de pago ya cargada 'No se actualizo',";
                            }
                        }

                        if ($set != "") {
                            foreach ($pk[$tabla] as $p) {
                                $where.= " and $p='" . $ref[$p] . "' ";
                            }
                            //$sql.=$where;
                            $sql_update.=$set . " where 1=1 $where;";
                            $st = $con->execute($sql_update);
                            $sqltmp.=$sql_update . "<br>";
                            $actualizo = true;
                        } else {
                            $actualizo = false;
                        }

                        $encontro = true;
                    }
                    /* else
                      {
                      $resultado[$i].=($resultado[$i]=="")?$comienzo_log:"";
                      $resultado[$i].=$tabla.":: factura NO ENCONTRADA --";
                      } */
                }

                if (!$encontro || !$actualizo) {
                    $resultado[$i].=($resultado[$i] == "") ? $comienzo_log : "";
                    if (!$encontro) {
                        $resultado[$i].="FACTURA NO ENCONTRADA";
                        $estadisticas["no_encontrado"]++;
                    }
                    if (!$actualizo) {
                        $resultado[$i].="Registro no actualizado";
                        $estadisticas["no_actualizado"]++;
                    }
                } else {
                    $estadisticas["actualizada"]++;

                    $resultado[$i] = $comienzo_log . " REGISTRO IMPORTADO";
                }
            }
            $estadisticas["total"] = $total;
            //print_r($estadisticas);
            //echo $sqltmp;
            $this->responseArray = array("success" => "true", "resultado" => implode("<br>", $resultado), "estadisticas" => $estadisticas, "sqlimpor" => $sqltmp);
        } catch (Exception $e) {
            $this->responseArray = array("success" => "false", "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
    
 
    public function executeImportRCColmas(sfWebRequest $request) {
        
        $con = Doctrine_Manager::getInstance()->connection();
        
        $sql="select m.ca_idmaster,h.ca_idhouse,h.ca_idcliente,h.ca_idcliente,ia.ca_valor,ia.ca_reccaja,ia.ca_tasacambio,ia.ca_fchpago,ia.ca_moneda
            from ino.tb_master m
            inner join ino.tb_house h on m.ca_idmaster=h.ca_idmaster
            left join tb_brk_ingresos ia on  h.ca_doctransporte=ia.ca_referencia
            where ca_impoexpo='INTERNO' 
            and ia.ca_reccaja!='' and h. ca_idhouse not in(select ca_idhouse from ino.vi_comprobantes where m.ca_idmaster=ca_idmaster and h.ca_idhouse = ca_idhouse and ca_idtipo=12)";
        $st = $con->execute($sql);
        $this->refs = $st->fetchAll();
        echo count($this->refs);
        
        foreach($this->refs as $r)
        {
            try
            {
                $comprobante = new InoComprobante();
                $comprobante->setCaIdtipo( InoComprobante::IDTIPO_R_INO );
                $comprobante->setCaConsecutivo($r["ca_reccaja"]);                
                $comprobante->setCaFchcomprobante($r["ca_fchpago"]);
                $comprobante->setCaId($r["ca_idcliente"]);
                $comprobante->setCaIdhouse($r["ca_idhouse"]);
                //$comprobante->setCaIdmaster($r["ca_idmaster"]);
                $comprobante->setCaValor( $r["ca_valor"] );
                $comprobante->setCaIdmoneda($r["ca_moneda"]);
                $comprobante->setCaTcambio($r["ca_tasacambio"]);            
                $comprobante->setCaObservaciones("Generado Automaticamente - ".date("Y-m-d"));
                $comprobante->stopBlaming();
                $comprobante->setCaUsucreado("Administrador");
                $comprobante->setCaFchcreado(date('Y-m-d H:i:s'));
                $comprobante->save();
                echo $comprobante->getCaIdcomprobante()."<br>";
            }
            catch(Exception $e)
            {
                echo "error: ".$e->getMessage()."<br>";
            }
        }
        exit;
        
    }
    
    public function executeGuardarFactura(sfWebRequest $request) { 
        try {
            $idcomprobante = $request->getParameter("idcomprobante");
            $idtipocomprobante = $request->getParameter("idtipocomprobante");
            
            $idsucursal = $request->getParameter("idsucursal");
            
            $sucursal = Doctrine::getTable("IdsSucursal")->find($idsucursal);

            if ($idcomprobante) {
                $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
                /*$comprobante = new InoComprobante();
                $comprobante->getInoDetalle()*/
                $this->forward404Unless($comprobante);
                $idcliente_old=$comprobante->getCaId();
            } else {
                $comprobante = new InoComprobante();
                
            }
            $comprobante->setCaIdtipo( $idtipocomprobante );
            
            $conn = $comprobante->getTable()->getConnection();
            $conn->beginTransaction();

            $idhouse = $request->getParameter("idhouse");
            $house = Doctrine::getTable("InoHouse")->find( $idhouse );
            //$comprobante->setCaConsecutivo($consecutivo);            
            $comprobante->setCaFchcomprobante(date("Y-m-d"));
            //$idcliente = ($request->getParameter("idclienteF")!="")?$request->getParameter("idclienteF"):$house->getCliente()->getCaIdcliente();

            $comprobante->setCaIdsucursal($idsucursal);

            $comprobante->setCaId($sucursal->getIds()->getCaId());
            $comprobante->setCaIdhouse($idhouse );
            //$comprobante->setCaValor( $valor );
            $comprobante->setCaIdmoneda($request->getParameter("idmoneda"));            
            $comprobante->setCaTcambio($request->getParameter("tcambio"));


            //$comprobante->setCaPlazo($request->getParameter("plazo"));
            //$comprobante->setCaObservaciones($request->getParameter("observaciones"));
            
            $comprobante->setProperty("bienestrans",$request->getParameter("bienestrans"));
            $comprobante->setProperty("detalle",$request->getParameter("detalle"));
            $comprobante->setProperty("anexos",$request->getParameter("anexos"));
            
            //$comprobante->save();
            $comprobante->save($conn);
            
            if($idcliente_old!=$idcliente)
            {
                $detalles=$comprobante->getInoDetalle();
                foreach($detalles as $d)
                {
                    $d->setCaId($idcliente);
                    $d->save($conn);                            
                }
            }
            
            $conn->commit();
            
            $this->responseArray = array("success" => "true" );
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => "false", "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
    
    
    //$comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
    public function executeAnularComprobante(sfWebRequest $request) {
        try{
        $idcomprobante = $request->getParameter("idcomprobante");
        $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
        
        $comprobante->anular($this->getUser()->getUserId());
        //InoComprobante::TRANSFERIDO;
        $this->responseArray = array("success" => "true" , "errorInfo" => "");
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => "false", "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
        
    }
 
    
    public function executeVerReferenciaExt5(sfWebRequest $request) {
        
        $this->nivel = $this->getNivel();
        /*$this->permisos=array("crear"=>true,"cerrar"=>true,"liquidar"=>true,"reabrir"=>true);
        switch ($this->nivel)
        {
            case "1":
                $this->permisos["reabrir"]=false;
            break;
            case "2":
                $this->permisos["reabrir"]=false;
                $this->permisos["liquidar"]=false;
            break;
            case "3":
                $this->permisos["reabrir"]=false;
                $this->permisos["liquidar"]=false;
                $this->permisos["cerrar"]=false;
            break;
            case "4":
                $this->permisos["reabrir"]=false;
                $this->permisos["liquidar"]=false;
                $this->permisos["cerrar"]=false;
                $this->permisos["crear"]=false;
            break;
        }*/

        $this->forward404Unless($request->getParameter("idmaster"));
        $this->referencia = Doctrine::getTable("InoMaster")->find($request->getParameter("idmaster"));
        $this->idmaster=$request->getParameter("idmaster");

        $this->forward404Unless($this->referencia);
    }
 
    
    
    
    
    
}

<?php

/**
 * ino actions.
 *
 * @package    symfony
 * @subpackage ino
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class inoActions extends sfActions {    

    public function preExecute() {
        
        $this->idmodo = $this->getRequestParameter("modo");
        
        $this->modo = Doctrine::getTable("Modo")->find($this->idmodo);   
                
        if (!$this->idmodo || !$this->modo) {            
            $action = $this->getContext()->getActionName ();
            if( $action!="seleccionModo" ){
                $this->redirect("ino/seleccionModo");
            }
        }        
        
        if( $this->modo ){
            $this->nivel = $this->getUser()->getNivelAcceso( $this->modo->getCaRutina() );
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
        
        $q = Doctrine_Query::create()->from('InoMaster m');
                

        $q = Doctrine::getTable("InoMaster")
                        ->createQuery("m")
                        ->select("*");
        
        
        $q->addWhere("m.ca_transporte=?", $this->modo->getCaTransporte() );
        $q->addWhere("m.ca_impoexpo=?", $this->modo->getCaImpoexpo() );        
        switch ($criterio) {
            case "ca_referencia":
            case "ca_motonave":
            case "ca_origen":
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
            case "ca_doctransporte":
                $q->innerJoin("m.InoHouse h");
                if($criterio=="cliente")
                {                    
                    $q->innerJoin("h.Cliente cl");
                    $q->addWhere("lower(cl.ca_compania) like ?", "%". strtolower($cadena) ."%");
                }            
                else if($criterio=="proveedor")
                {
                    $q->innerJoin("h.Proveedor pr");
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
        }

        $q->addOrderBy("m.ca_referencia");
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
        /*if ($this->pager->getResultsInPage() == 1 && $this->pager->getPage() == 1) {
            $refs = $this->refList;
            $this->redirect("ino/verReferencia?idmaster=" . $refs[0]->getCaIdmaster());
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
            
            if( $this->referencia->getCaUsuliquidado() || $this->referencia->getCaUsucerrado() ){
                $this->redirect("ino/verReferencia?modo=".$this->modo->getCaIdmodo()."&idmaster=" . $this->referencia->getCaIdmaster());
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

        if (count($errors) > 0) {
            $this->responseArray = array("success" => false, "errors" => $errors);
        }

        try {
            $impoexpo = utf8_decode($request->getParameter("impoexpo"));
            $transporte = utf8_decode($request->getParameter("transporte"));
            $modalidad = utf8_decode($request->getParameter("modalidad"));
            $idorigen = $request->getParameter("idorigen");
            $iddestino = $request->getParameter("iddestino");
            $fchreferencia = $request->getParameter("fchreferencia");
            $fchreferenciaTm = strtotime($fchreferencia);

            $idmaster=$request->getParameter("idmaster");
            
            if( $idmaster ){
                $ino = Doctrine::getTable("InoMaster")->find($idmaster);
                $this->forward404Unless( $ino );                
            }else{
                $ino = new InoMaster();
                $numRef = InoMasterTable::getNumReferencia($impoexpo, $transporte, $modalidad, $idorigen, $iddestino, date("m", $fchreferenciaTm), date("Y", $fchreferenciaTm));
                $ino->setCaReferencia($numRef);
                $ino->setCaImpoexpo($this->modo->getCaImpoexpo());
                $ino->setCaTransporte($this->modo->getCaTransporte());
            }
            
            
            
            
            $ino->setCaModalidad($modalidad);
            $ino->setCaFchreferencia($fchreferencia);
            $ino->setCaOrigen($idorigen);
            $ino->setCaDestino($iddestino);
            $ino->setCaIdlinea($request->getParameter("idlinea"));
            $ino->setCaIdagente($request->getParameter("idagente"));

            $ino->setCaMaster($request->getParameter("ca_master"));
            

            $ino->setCaFchsalida($request->getParameter("ca_fchsalida"));
            $ino->setCaFchllegada($request->getParameter("ca_fchllegada"));
            $ino->setCaMotonave(utf8_decode($request->getParameter("ca_motonave")));
            
            $ino->setCaPiezas($request->getParameter("ca_piezas"));
            $ino->setCaPeso($request->getParameter("ca_peso"));
            $ino->setCaVolumen($request->getParameter("ca_volumen"));
            $ino->setCaObservaciones(utf8_decode($request->getParameter("ca_observaciones")));
            $ino->save();
            $this->responseArray = array("success" => true, "idmaster" => $ino->getCaIdmaster());
            
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
    public function executeDatosMaster(sfWebRequest $request) {   
        
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        try {
            $ino = Doctrine::getTable("InoMaster")->find($idmaster);
            $this->forward404Unless($ino);
     
        
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
        
        // $this->nivel = $this->getNivel();

        $this->forward404Unless($request->getParameter("idmaster"));
        $this->referencia = Doctrine::getTable("InoMaster")->find($request->getParameter("idmaster"));

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
                print_r( $comp->getValor() );
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
        //print_r( $_POST );

        try {
            if ($request->getParameter("idhouse")) {
                $house = Doctrine::getTable("InoHouse")->find($request->getParameter("idhouse"));
                $this->forward404Unless($house);
            } else {
                $house = new InoHouse();
                $house->setCaIdmaster($request->getParameter("idmaster"));
            }
            $house->setCaIdreporte($request->getParameter("idreporte"));
            $house->setCaIdcliente($request->getParameter("idcliente"));
            $house->setCaVendedor($request->getParameter("vendedor"));
            $house->setCaIdtercero($request->getParameter("idtercero"));
            $house->setCaNumorden($request->getParameter("numorden"));
            $house->setCaNumpiezas($request->getParameter("numpiezas"));
            $house->setCaMpiezas(utf8_decode($request->getParameter("mpiezas")));
            $house->setCaPeso($request->getParameter("peso"));
            $house->setCaVolumen($request->getParameter("volumen"));
            $house->setCaDoctransporte($request->getParameter("doctransporte"));
            $house->setCaFchdoctransporte($request->getParameter("fchdoctransporte"));
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
    public function executeDatosFormHousePanel(sfWebRequest $request) {


        $this->forward404Unless($request->getParameter("idhouse"));
        $idhouse = $request->getParameter("idhouse");
        $inoHouse = Doctrine::getTable("InoHouse")->find($idhouse);
        $this->forward404Unless($inoHouse);


        $data = array();

        $data["idmaster"] = $inoHouse->getCaIdmaster();
        $data["idhouse"] = $inoHouse->getCaIdhouse();
        $data["doctransporte"] = utf8_encode($inoHouse->getCaDoctransporte());
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
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
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
                $data["tercero"]=$cons->getCaNombre();
            }
        }else{
            $prov=$reporte->getProveedores();
            if(count($prov)>0)
            {
                $data["idtercero"]=$prov[0]->getCaIdtercero();
                $data["tercero"]=$prov[0]->getCaNombre();
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
        $inoHouses = Doctrine::getTable("InoHouse")
                        ->createQuery("c")
                        ->select("c.*, cl.*")
                        //->innerJoin("c.Ids cl")
                        ->innerJoin("c.Cliente cl")
                        ->leftJoin("c.InoComprobante comp")
                        ->leftJoin("comp.InoTipoComprobante tcomp")
                        ->where("c.ca_idmaster = ?", $idmaster)
                        ->addOrderBy("cl.ca_compania")
                        ->execute();


        $data = array();

        foreach ($inoHouses as $inoHouse) {


            $comprobantes = $inoHouse->getInoComprobante();
            $k = 0;
            if (count($comprobantes) > 0) {
                foreach ($comprobantes as $comprobante) {
                    $tipo = $comprobante->getInoTipoComprobante();

                    $row = array();
                    $row["idmaster"] = $inoHouse->getCaIdmaster();
                    $row["idhouse"] = $inoHouse->getCaIdhouse();
                    $row["doctransporte"] = utf8_encode($inoHouse->getCaDoctransporte());
                    $row["idcliente"] = $inoHouse->getCliente()->getCaIdcliente();
                    $row["cliente"] = utf8_encode($inoHouse->getCliente()->getCaCompania());
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
                $row["comprobante"] = "";
                $row["fchcomprobante"] = "";
                $row["valor"] = 0;
                $row["color"] = "pink";
                $data[] = $row;
            }
        }


        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarGridFacturacionPanel(sfWebRequest $request) {
        try {
            
            $idcomprobante = $request->getParameter("idcomprobante");
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
            $comprobante->setCaId($house->getCaIdcliente());
            $comprobante->setCaValor( $valor );
            $comprobante->setCaIdmoneda($request->getParameter("idmoneda"));            
            $comprobante->setCaTcambio($request->getParameter("tasacambio"));
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
            
            $totalDed = 0; 
            
            $deducciones = $request->getParameter("deducciones");
            if( $deducciones ){
                $deducciones = explode("|", $deducciones);
                
                foreach( $deducciones as $d ){
                    $params =  $array = sfToolkit::stringToArray( $d );   
                    if( $params["neto"] ){
                        
                                                
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
            
            if( $totalDed>$valor ){
                throw new Exception("El total de las deducciones excede el valor total de la factura.");
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

            $this->responseArray = array("success" => true, "id" => $request->getParameter("id"), "idcomprobante" => $comprobante->getCaIdcomprobante());
        } catch (Exception $e) {

            
            $conn->rollBack();
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
        
         $q = Doctrine::getTable("InoComprobante")
                        ->createQuery("c")                            
                        ->select("d.ca_idmaster, c.ca_consecutivo, c.ca_idcomprobante, 
                                  c.ca_tcambio, c.ca_tcambio_usd, i.ca_nombre, i.ca_id,
                                  c.ca_idmoneda, cs.ca_concepto, cs.ca_idconcepto,
                                  SUM(ca_cr-ca_db) as ca_neto") //c.ca_neto, c.ca_venta,c.ca_idcosto,
                //c.ca_tcambio_usd, 
                        ->addGroupBy("d.ca_idmaster, c.ca_consecutivo, 
                                  c.ca_tcambio, c.ca_tcambio_usd, i.ca_nombre, i.ca_id, c.ca_idmoneda,
                                   cs.ca_concepto, cs.ca_idconcepto, c.ca_idcomprobante")
                        ->innerJoin("c.InoDetalle d")
                        ->innerJoin("d.InoConcepto cs")                        
                        ->innerJoin("d.Ids i")                        
                        ->where("d.ca_idmaster = ?", $idmaster);                        
         
         
        //echo $q->getSqlQuery()."<br />";  
        
        $costos = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();
        foreach( $costos as $key=>$val ){
            $costos[$key]["i_ca_nombre"] = utf8_encode($costos[$key]["i_ca_nombre"]);
            $costos[$key]["cs_ca_concepto"] = utf8_encode($costos[$key]["cs_ca_concepto"]);
        } 

        $this->responseArray = array("success" => true, "root" => $costos, "total" => count($costos));
        $this->setTemplate("responseTemplate");
    }
    
    
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosGridCostosDiscriminadosPanel(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        
         $q = Doctrine::getTable("InoComprobante")
                        ->createQuery("c")                            
                        ->select("d.ca_idmaster, c.ca_consecutivo, c.ca_idcomprobante, 
                                  c.ca_tcambio, c.ca_tcambio_usd, i.ca_nombre, i.ca_id,
                                  c.ca_idmoneda, cs.ca_concepto, cs.ca_idconcepto,
                                  SUM(ca_db-ca_cr) as ca_neto") //c.ca_neto, c.ca_venta,c.ca_idcosto,
                //c.ca_tcambio_usd, 
                        ->addGroupBy("d.ca_idmaster, c.ca_consecutivo, 
                                  c.ca_tcambio, c.ca_tcambio_usd, i.ca_nombre, i.ca_id, c.ca_idmoneda,
                                   cs.ca_concepto, cs.ca_idconcepto, c.ca_idcomprobante")
                        ->innerJoin("c.InoDetalle d")
                        ->innerJoin("d.InoConcepto cs")                        
                        ->innerJoin("d.Ids i")                        
                        ->where("d.ca_idmaster = ?", $idmaster);                        
         
         
        //echo $q->getSqlQuery()."<br />";  
        
        $costos = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();
        foreach( $costos as $key=>$val ){
            $costos[$key]["i_ca_nombre"] = utf8_encode($costos[$key]["i_ca_nombre"]);
            $costos[$key]["cs_ca_concepto"] = utf8_encode($costos[$key]["cs_ca_concepto"]);
        } 

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
     *   Acciones para el cuadro de auditoria
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
                $conn = Doctrine::getTable("InoComprobante")->getConnection();
                $conn->beginTransaction();
                try {
                    
                    
                    $idcomprobante = $request->getParameter("idcomprobante");
                    if ($idcomprobante) {
                        $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
                        $this->forward404Unless($comprobante);
                    } else {
                        $comprobante = new InoComprobante();
                        $comprobante->setCaIdtipo( InoComprobante::IDTIPO_P_INO );
                    }
                    
                    

                    $valor = $request->getParameter("valor");

                    $conn = $comprobante->getTable()->getConnection();
                    $conn->beginTransaction();
                    $idhouse = $request->getParameter("idhouse");
                    $house = Doctrine::getTable("InoHouse")->find( $idhouse );

                    //$comprobante->setCaIdhouse($idhouse);

                    $comprobante->setCaConsecutivo( $bindValues["factura"] );                                
                    $comprobante->setCaFchcomprobante( $bindValues["fchfactura"] );
                    $comprobante->setCaId( $bindValues["idproveedor"] );
                    $comprobante->setCaValor( $bindValues["neto"] );
                    $comprobante->setCaIdmoneda($request->getParameter("idmoneda"));            
                    $comprobante->setCaTcambio( $bindValues["tcambio"] );
                    $comprobante->setCaTcambioUsd( $bindValues["tcambio_usd"] );                                
                    //$comprobante->setCaObservaciones($request->getParameter("observaciones"));
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
                    
                    
                    $inoDetalle = new InoDetalle();
                    //$inoDetalle->setCaIddeduccion( $params["iddeduccion"] );                        
                    $inoDetalle->setCaIdcomprobante( $comprobante->getCaIdcomprobante() );
                    $inoDetalle->setCaCr( $val );
                    $inoDetalle->setCaIdconcepto( InoComprobante::ID_UTILIDAD_X_SOBREVENTA );       
                    $house = Doctrine::getTable("InoHouse")->find( $idhouse );
                    $inoDetalle->setCaIdhouse( $house->getCaIdhouse() );                        
                    $inoDetalle->setCaIdmaster( $house->getCaIdmaster() );
                    $inoDetalle->setCaId( $house->getCaIdcliente() );
                    $inoDetalle->save( $conn );  
                    
                    $totalDet = 0; 
                    foreach ($bindValues as $key => $val) {
                        if (substr($key, 0, 4) == "util") {
                            if ($val) {   
                                $idhouse = substr($key, 5);
                                
                                $inoDetalle = new InoDetalle();
                                //$inoDetalle->setCaIddeduccion( $params["iddeduccion"] );                        
                                $inoDetalle->setCaIdcomprobante( $comprobante->getCaIdcomprobante() );
                                $inoDetalle->setCaCr( $val );
                                $inoDetalle->setCaIdconcepto( InoComprobante::ID_UTILIDAD_X_SOBREVENTA );       
                                $house = Doctrine::getTable("InoHouse")->find( $idhouse );
                                $inoDetalle->setCaIdhouse( $house->getCaIdhouse() );                        
                                $inoDetalle->setCaIdmaster( $house->getCaIdmaster() );
                                $inoDetalle->setCaId( $house->getCaIdcliente() );
                                $inoDetalle->save( $conn );  
                                
                                $totalDet+=$val;
                            }
                        }
                    }
/*
                    $totalDed = 0; 

                    $deducciones = $request->getParameter("deducciones");
                    if( $deducciones ){
                        $deducciones = explode("|", $deducciones);

                        foreach( $deducciones as $d ){
                            $params =  $array = sfToolkit::stringToArray( $d );   
                            if( $params["neto"] ){


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

                    if( $totalDed>$valor ){
                        throw new Exception("El total de las deducciones excede el valor total de la factura.");
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



                    $conn->commit();*/
                     
                    exit();
                    

                    $conn->commit();
                    $this->redirect("ino/verReferencia?modo=".$this->modo->getCaIdmodo()."&idmaster=" . $referencia->getCaIdmaster());
                } catch (Exception $e) {                    
                    throw $e;
                }
            }
        }
        
        
                
        $this->referencia = $referencia;

        $this->inoCosto = $inoCosto;
        $this->monedaLocal = $monedaLocal;
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
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        
        $ref = Doctrine::getTable("InoMaster")->find($request->getParameter("idmaster"));
        $this->forward404Unless($ref);
        
        $ref->setCaUsucerrado( $this->getUser()->getUserId() );
        $ref->setCaFchcerrado( date("Y-m-d H:i:s") );
        $ref->save();
        $this->redirect("ino/verReferencia?modo=".$this->modo->getCaIdmodo()."&idmaster=".$ref->getCaIdmaster());
    }  
    
    public function executeAbrirCaso(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        
        $ref = Doctrine::getTable("InoMaster")->find($request->getParameter("idmaster"));
        $this->forward404Unless($ref);
        
        $ref->setCaUsucerrado( null );
        $ref->setCaFchcerrado( null );
        $ref->save();
        $this->redirect("ino/verReferencia?modo=".$this->modo->getCaIdmodo()."&idmaster=".$ref->getCaIdmaster());
    }  
    
    
    public function executeLiquidarCaso(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        
        $ref = Doctrine::getTable("InoMaster")->find($request->getParameter("idmaster"));
        $this->forward404Unless($ref);
        
        $ref->setCaUsuliquidado( $this->getUser()->getUserId() );
        $ref->setCaFchliquidado( date("Y-m-d H:i:s") );
        $ref->save();
        $this->redirect("ino/verReferencia?modo=".$this->modo->getCaIdmodo()."&idmaster=".$ref->getCaIdmaster());
    }  
    
    public function executeCancelarLiquidarCaso(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        
        $ref = Doctrine::getTable("InoMaster")->find($request->getParameter("idmaster"));
        $this->forward404Unless($ref);
        
        $ref->setCaUsuliquidado( null );
        $ref->setCaFchliquidado( null );
        $ref->save();
        $this->redirect("ino/verReferencia?modo=".$this->modo->getCaIdmodo()."&idmaster=".$ref->getCaIdmaster());
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
                        //$inoDetalle->setCaIddeduccion( $params["iddeduccion"] );
                        
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
    
    
    
    
}


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
            }
            
            $numRef = InoMasterTable::getNumReferencia($impoexpo, $transporte, $modalidad, $idorigen, $iddestino, date("m", $fchreferenciaTm), date("Y", $fchreferenciaTm));
            $ino->setCaReferencia($numRef);
            $ino->setCaImpoexpo($impoexpo);
            $ino->setCaTransporte($transporte);
            $ino->setCaModalidad($modalidad);
            $ino->setCaFchreferencia($fchreferencia);
            $ino->setCaOrigen($idorigen);
            $ino->setCaDestino($iddestino);
            $ino->setCaIdlinea($request->getParameter("idlinea"));
            $ino->setCaIdagente($request->getParameter("idagente"));

            $ino->setCaMaster($request->getParameter("ca_master"));
            $ino->setCaFchmaster($request->getParameter("ca_fchmaster"));

            $ino->setCaFchsalida($request->getParameter("ca_fchsalida"));
            $ino->setCaFchllegada($request->getParameter("ca_fchllegada"));
            $ino->setCaMotonave(utf8_decode($request->getParameter("ca_motonave")));

            $ino->save();
            $this->responseArray = array("success" => true, "idmaestra" => $ino->getCaIdmaster(),"modo" => utf8_decode($this->modo) );
            
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
            $data["ca_fchmaster"]=$ino->getCaFchmaster();

            $data["ca_motonave"]=utf8_encode($ino->getCaMotonave());
            $data["ca_fchsalida"]=$ino->getCaFchsalida();
            $data["ca_fchllegada"]=$ino->getCaFchllegada();
            
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
            $house->setCaIdproveedor($request->getParameter("idproveedor"));
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
            $row["idproveedor"] = $inoHouse->getCaIdproveedor();
            $row["proveedor"] = utf8_encode($inoHouse->getProveedor()->getCaNombre());
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
        $data["idproveedor"] = $inoHouse->getCaIdproveedor();
        $data["proveedor"] = utf8_encode($inoHouse->getProveedor()->getCaNombre());



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

        $prov=$reporte->getProveedores();
        if(count($prov)>0)
        {
            $data["idproveedor"]=$prov[0]->getCaIdtercero();
            $data["proveedor"]=$prov[0]->getCaNombre();
        }

        $data["doctransporte"]=$reporte->getDocTransporte();

        $data["numpiezas"]=preg_replace( "{[a-zA-Z]+}", '', $reporte->getPiezas());
        $data["mpiezas"]=trim(preg_replace( "{[0-9.]+}", '', $reporte->getPiezas()));
        $data["peso"]=preg_replace( "{[a-zA-Z]+}", '', $reporte->getPeso());
        $vol=(explode(" ", preg_replace( "{[a-zA-Z]+}", '', $reporte->getVolumen())));
        $data["volumen"]=$vol[0];
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
                    $row["tasacambio"] = $comprobante->getCaTasacambio(); 
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



            $conn = $comprobante->getTable()->getConnection();
            $conn->beginTransaction();
            $idhouse = $request->getParameter("idhouse");
            $house = Doctrine::getTable("InoHouse")->find( $idhouse );
            
            $comprobante->setCaIdhouse($idhouse);
            
            $comprobante->setCaConsecutivo($request->getParameter("consecutivo"));            
            $comprobante->setCaIdtipo($request->getParameter("idtipo"));
            $comprobante->setCaFchcomprobante($request->getParameter("fchcomprobante"));
            $comprobante->setCaId($house->getCaIdcliente());
            $comprobante->setCaValor($request->getParameter("valor"));
            $comprobante->setCaIdmoneda($request->getParameter("idmoneda"));            
            $comprobante->setCaTasacambio($request->getParameter("tasacambio"));
            $comprobante->setCaPlazo($request->getParameter("plazo"));
            $comprobante->setCaObservaciones($request->getParameter("observaciones"));
            

            $comprobante->save($conn);


            $conn->commit();
            //$conn->rollBack();

            $this->responseArray = array("success" => true, "id" => $request->getParameter("id"), "idcomprobante" => $comprobante->getCaIdcomprobante());
        } catch (Exception $e) {

            
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }



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
        $data["tasacambio"] = $comprobante->getCaTasacambio();
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
        
        $costos = Doctrine::getTable("InoCosto")
                        ->createQuery("c")
                        ->select("c.ca_idinocosto, c.ca_idmaster, c.ca_neto, c.ca_venta, c.ca_factura, 
                                  c.ca_tcambio, c.ca_tcambio_usd, c.ca_idcosto, p.ca_sigla, i.ca_nombre, 
                                  c.ca_idmoneda, cs.ca_costo")                        
                        ->innerJoin("c.Costo cs")
                        ->innerJoin("c.IdsProveedor p")
                        ->innerJoin("p.Ids i")
                        ->where("c.ca_idmaster = ?", $idmaster)                        
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();
        
        foreach( $costos as $key=>$val ){
            $costos[$key]["i_ca_nombre"] = utf8_encode($costos[$key]["i_ca_nombre"]);
            $costos[$key]["cs_ca_costo"] = utf8_encode($costos[$key]["cs_ca_costo"]);
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
                $comprobante->setCaTasacambio($request->getParameter("cambio"));
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
                    $inoCosto->setCaIdcosto($bindValues["idcosto"]);
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

    
    
    
    
    
    
}


<?php

/**
 * Modulo de creacion de reportes Basado en el modulo de reportes de Carlos Lopez y
 * solo que ademas permite crear reportes de exportaciones, adicionalmente entra el
 * concepto de embarque.
 *
 * @package    colsys
 * @subpackage reportes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */

// fecha max entrega contenedor  y patio entrega por contenedor,y fecha levante
class reportesNeg2Actions extends sfActions {

   const RUTINA_AEREO = 200;
    const RUTINA_MARITIMO = 201;
    const RUTINA_TERRESTRE = 202;
    const RUTINA_EXPORTACION = 203;
    const RUTINA_OTM = 204;
    const RUTINA_COMISIONES = 214;
    const RUTINA_COLOTM = 216;

    
    public function executeIndexExt5(sfWebRequest $request) {
        $this->permisos = array();

        $user = $this->getUser();

        $permisosRutinas["aereo"] = $user->getControlAcceso(self::RUTINA_AEREO);
        $permisosRutinas["maritimo"] = $user->getControlAcceso(self::RUTINA_MARITIMO);

        $permisosRutinas["terrestre"] = $user->getControlAcceso(self::RUTINA_TERRESTRE);
        $permisosRutinas["exportacion"] = $user->getControlAcceso(self::RUTINA_EXPORTACION);
        $permisosRutinas["otm"] = $user->getControlAcceso(self::RUTINA_OTM);

        $permisosRutinas["colotm"] = $user->getControlAcceso(self::RUTINA_COLOTM);

        $tipopermisos = 
                array(
                    'Consultar' => 0, 'Crear' => 1, 'Editar' => 2, 'Anular' => 3, 'Liquidar' => 4, 'Cerrar' => 5, 'Abrir' => 6, 
                    'General' => 7, 'House' => 8, 'Facturacion' => 9, 'Costos' => 10, 'Documentos' => 11,'NotasCredito' => 12,  
                    'MuiscaEd' => 13, 'MuiscaDig' => 14, 'MuiscaRev' => 15, 'GenerarXml' => 16, 'DarLiberacion' => 17, 
                    'RevLiberacion' => 18, 'LiberacionPto' => 19, 'Comodatos' => 20,'Muisca' => 21,'Balance' => 22);

        foreach ($permisosRutinas as $k => $p) {
            foreach ($tipopermisos as $index => $tp) {
                $this->permisos[$k][$index] = isset($permisosRutinas[$k][$tp]) ? true : false;
            }
        }

        if($request->getParameter("idreporte")!="")
        {
            if($request->getParameter("idreporte")>0)
            {
                $this->reporteM = Doctrine::getTable("Reporte")
                ->createQuery("r")
                ->whereIn("m.ca_idreporte", json_decode($request->getParameter("idreporte")))
                //->addWhere("m.ca_idmaster = ?", array($request->getParameter("idmaster")))
                ->execute();
            }
            else
            {
                $this->reporteM="New";
            }
        } 
        //if($request->getParameter("idrepPrincipal")!="")
            $this->idrepPrincipal=$request->getParameter("idrepPrincipal");
           
    }
    
    
    public  function executeDatosBusqueda($request) {
       
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $this->opcion = $this->getRequestParameter("opcion");
        $this->modo = $this->getRequestParameter("modo");
        $this->impoexpo = $this->getRequestParameter("impoexpo");

        $opcion = $this->getRequestParameter("criterio");
        $criterio = trim($this->getRequestParameter("q"));
        $this->criterio = $this->getRequestParameter("criterio");
        $this->cadena = trim($this->getRequestParameter("q"));
        $this->idimpo = $this->getRequestParameter("idimpo");

        $this->fechaInicial = $this->getRequestParameter("fchinicial");
        $this->fechaFinal = $this->getRequestParameter("fchfinal");

        $this->incoterms = $this->getRequestParameter("incoterms");
        $this->seguro = $this->getRequestParameter("seguro");
        $this->colmas = $this->getRequestParameter("colmas");

        $this->transporte = $this->getRequestParameter("transporte");
        $this->modalidad = $this->getRequestParameter("modalidad");
        $this->idorigen = $this->getRequestParameter("idorigen");
        $this->iddestino = $this->getRequestParameter("iddestino");
        $this->origen = $this->getRequestParameter("origen");
        $this->destino = $this->getRequestParameter("destino");

//        $this->idsucursal = $this->getRequestParameter("idsucursal");
        $this->sucursal = $this->getRequestParameter("sucursal");
        $this->continuacion = $this->getRequestParameter("continuacion");
        //echo $this->continuacion."-".$this->idsucursal;
        $limit=" limit 50";
        $condicion = "";
        $this->tiporep = 0;
        $inner = "  ";
        $select ="ca_consecutivo,ca_version,ca_versiones, ca_idreporte, ca_transporte , ca_impoexpo,ca_modalidad,ca_nombre_cli,ca_usucreado,ca_fchanulado";
        $join="";
        /*if ($this->opcion == "otmmin") {
            $this->tiporep = 4;
        } else
            $condicion.=" and ca_tiporep <> 4";
        */
        foreach ($request->getParameter("opciones") as $o) {        
        //if ($criterio) {
            if($condicion!="")
                $condicion.=" OR ";
            if ($o == 'ca_consecutivo') {
                $condicion.= "  r.$o like '" . $criterio . "%'";
            } else if ($o == 'ca_nombre_cli' or $o == 'ca_nombre_con' or $o == 'ca_orden_prov' or $o == 'ca_orden_clie' or $o == 'ca_idcotizacion' or $o == 'ca_login' or $o == 'ca_mercancia_desc' or $o == 'ca_traorigen' or $o == 'ca_ciuorigen') {
                $condicion.= "  UPPER(r.$o) like ('%" . strtoupper($criterio) . "%')";
            } else if($o == 'ca_nombre_pro'){
                $condicion.= "  lower(ca_proveedores) like lower('%" . $criterio . "%')";
            }
        } /*else {
            if ($opcion == 'ca_login') {
                $condicion.= " and r.$opcion = '" . $this->getUser()->getUserId() . "'";
            }
        }*/
        
        if($condicion!="")
            $condicion = " AND (".$condicion.")";
        //$condicion.="";

        if ($this->fechaInicial != "" && $this->fechaFinal != "") {
            $condicion.=" and r.ca_fchreporte between '" . Utils::parseDate($this->fechaInicial) . "' and '" . Utils::parseDate($this->fechaFinal) . "'";
            $limit="";
        }

        if ($this->incoterms != "") {
            $condicion.=" and r.ca_incoterms= '$this->incoterms'";
        }
        
        if ($this->seguro != "") {
            $condicion.=" and r.ca_seguro= '$this->seguro'";
        }

        if ($this->colmas != "") {
            $condicion.=" and r.ca_colmas = '$this->colmas'";
        }

        if ($this->continuacion != "") {
            $condicion.=" and r.ca_continuacion = '$this->continuacion'";
        }

        if ($this->sucursal != "") {
            $condicion.=" and r.ca_usucreado in (select ca_login from vi_usuarios where ca_sucursal='" . $this->sucursal . "' )";
        }

        if ($this->idorigen != "") {
            $condicion.=" and r.ca_origen = '$this->idorigen'";
        }

        if ($this->iddestino != "") {
            $condicion.=" and r.ca_destino = '$this->iddestino'";
        }

        if ($this->transporte != "") {
            $condicion.=" and r.ca_transporte = '$this->transporte'";
        }

        if ($this->modalidad != "") {
            $condicion.=" and r.ca_modalidad = '$this->modalidad'";
        }

        if (($this->idimpo && $criterio) || !$this->idimpo) {
            $con = Doctrine_Manager::getInstance()->connection();
            $sql = "select  $select from rn.vi_busqueda r $join where  ca_tiporep=5 $condicion $limit ";
            $st = $con->execute($sql);
            
            //echo $sql;
            $datos = $st->fetchAll(PDO::FETCH_ASSOC);
        } else
            $datos = array();
        
        
        foreach ($datos as $k => $d) {
            $datos[$k]["ca_consecutivo"] = $datos[$k]["ca_consecutivo"];
            $datos[$k]["ca_version"] = $datos[$k]["ca_version"];
            $datos[$k]["ca_versiones"] = $datos[$k]["ca_versiones"];
            $datos[$k]["ca_transporte"] = utf8_encode($datos[$k]["ca_transporte"]);
            $datos[$k]["ca_impoexpo"] = utf8_encode($datos[$k]["ca_impoexpo"]);
            $datos[$k]["ca_modalidad"] = utf8_encode($datos[$k]["ca_modalidad"]);
            $datos[$k]["ca_nombre_cli"] = utf8_encode($datos[$k]["ca_nombre_cli"]);
            $datos[$k]["editable"]=($this->getUser()->getUserId()==$datos[$k]["ca_usucreado"])?true:false;
            if($datos[$k]["editable"]==true)
            {
                $datos[$k]["editable"]=($datos[$k]["ca_version"]==$datos[$k]["ca_versiones"])?true:false;
            }

            $class="";
            if($datos[$k]["ca_fchanulado"]!="")
            {
                $class="row_purple";
                $datos[$k]["editable"]=false;
            }
            else if($datos[$k]["ca_fchcerrado"]!="")
            {
                $class="row_gray";
            }
            $datos[$k]["class"]=$class;
            
        }
        
        //print_r($this->datos);
        //print_r($whereq);
        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos), "debug" => $sql, "permisos"=> $permisos);
        $this->setTemplate("responseTemplate");
    }
    
    
    public function executeDatosReporte(sfWebRequest $request)
    {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $reporte=null;
        $reporteP=null;
        if($request->getParameter("idreporte")!="0")
        $reporte = Doctrine::getTable("Reporte")->find($request->getParameter("idreporte"));
        else
        {
            if($request->getParameter("idrepPrincipal")>0)
                $reporteP= Doctrine::getTable("Reporte")->find($request->getParameter("idrepPrincipal"));
        }
//        else
//            echo "226";
        $data = array();
        if ($reporte) {
            $data["idreporte"] = $reporte->getCaIdreporte();
            $data["consecutivo"] = $reporte->getCaConsecutivo();
            $data["version"] = $reporte->getCaVersion();
            $data["impoexpo"] = utf8_encode($reporte->getCaImpoexpo());
            $data["transporte"] = utf8_encode($reporte->getCaTransporte());
            $data["modalidad"] = $reporte->getCaModalidad();

            $data["cotizacion"] = $reporte->getCaIdcotizacion();
            $data["cotizacionotm"] = $reporte->getCaIdcotizacionotm();
            $data["continuacion"] = $reporte->getCaContinuacion();            

            $data["cont-origen"] = $reporte->getCaContOrigen();
            $data["cont-destino"] = $reporte->getCaContDestino();

            $data["proveedor"] = $reporte->getCaIdlinea();
            $data["linea"] = utf8_encode($reporte->getIdsProveedor()->getIds()->getCaNombre());

            $data["idtra_origen_id"] = utf8_encode($reporte->getOrigen()->getTrafico()->getCaIdtrafico());
            $data["tra_origen_id"] = utf8_encode($reporte->getOrigen()->getTrafico()->getCaNombre());

            $data["origen"] = utf8_encode($reporte->getOrigen()->getCaCiudad());
            $data["idorigen"] = $reporte->getCaOrigen();

            $data["idtra_destino_id"] = utf8_encode($reporte->getDestino()->getTrafico()->getCaIdtrafico());
            $data["tra_destino_id"] = utf8_encode($reporte->getDestino()->getTrafico()->getCaNombre());
            $data["destino"] = utf8_encode($reporte->getDestino()->getCaCiudad());
            $data["iddestino"] = $reporte->getCaDestino();

            $data["idcliente"] = $reporte->getCliente()->getCaIdcliente();
            $data["cliente"] = utf8_encode($reporte->getCliente()->getCaCompania());
            
            $data["idclientefac"] = $reporte->getClienteFac()->getCaIdcliente();
            $data["clientefac"] = utf8_encode($reporte->getClienteFac()->getCaCompania());
            

            $data["idconcliente"] = $reporte->getCaIdconcliente();
            $data["contacto"] = utf8_encode($reporte->getContacto('2')->getCaNombres() . " " . $reporte->getContacto('2')->getCaPapellido() . " " . $reporte->getContacto('2')->getCaSapellido());

            $data["orden_clie"] = utf8_encode($reporte->getCaOrdenClie());

            $cliente = $reporte->getCliente();

            $data["ca_liberacion"] = ($cliente->getLibCliente()->getCaDiascredito() > 0) ? "Si" : "No";
            $data["ca_tiempocredito"] = $cliente->getLibCliente()->getCaDiascredito();
            $data["preferencias"] = utf8_encode($reporte->getCaPreferenciasClie());

            $data["fchdespacho"] = $reporte->getCaFchdespacho();
            $data["idvendedor"] = utf8_encode($reporte->getCaLogin());
            $data["vendedor"] = utf8_encode($reporte->getUsuario()->getCaNombre());
            $data["ca_mercancia_desc"] = utf8_encode($reporte->getCaMercanciaDesc());
            $data["ca_mcia_peligrosa"] = $reporte->getCaMciaPeligrosa();

            $data["idlineadu"] = "";
            $data["agencia"] = "";
            
            $data["ordenclie"] = utf8_encode($reporte->getCaOrdenClie());
            
            $data["idcoldepositos"]=utf8_encode($reporte->getDatosJson("idcoldepositos"));
            $data["idciudeposito"]=utf8_encode($reporte->getDatosJson("idciudeposito"));
            $data["ciudeposito"]= utf8_encode($reporte->getDatosJson("ciudeposito"));
            
            $index_datos=array("ca_dimensiones","ca_doc_transporte","ca_observaciones","ca_observaciones2","ca_peso","ca_piezas","ca_valor","ca_volumen","do","idlineaadu","idticket","urbano","traslado","itr","extradimensionada","un","imo","fchbodegaje","respmaritimo","seguro","regimen","escolta");

            foreach($index_datos as $i)
            {
                $data[$i] = $reporte->getDatosJson($i);
            }
            
            $direccion=null;
            if($reporte->getDatosJson("ca_direccion")>0)
                $direccion=Doctrine::getTable("Tercero")->find($reporte->getDatosJson("ca_direccion"));
            
            if($direccion)
            {
                $data["ca_direccion"] = $reporte->getDatosJson("ca_direccion");
                $data["ca_direccion_dir"] = utf8_encode($direccion->getCaDireccion());
                $data["ca_direccion_nombre"] = utf8_encode($direccion->getCaNombre());
            }
            else
            {
                $data["ca_direccion"] = "";
                $data["ca_direccion_dir"] = "";
                $data["ca_direccion_nombre"] = "";
            }
            
            $direccion2=null;
            if($reporte->getDatosJson("ca_direccion2")>0)
                $direccion2=Doctrine::getTable("Tercero")->find($reporte->getDatosJson("ca_direccion2"));
            
            
            if($direccion2)
            {
                $data["ca_direccion2"] = $reporte->getDatosJson("ca_direccion2");
                $data["ca_direccion2_dir"] = utf8_encode($direccion2->getCaDireccion());
                $data["ca_direccion2_nombre"] = utf8_encode($direccion2->getCaNombre());
            }
            else
            {
                $data["ca_direccion2"] = "";
                $data["ca_direccion2_dir"] = "";
                $data["ca_direccion2_nombre"] = "";
            }
        }
        else if ($reporteP) {
            $reporte=$reporteP;
            $data["idreporte"] = 0;
            $data["consecutivo"] = "Nuevo";
            $data["version"] = "";
            $data["impoexpo"] = Constantes::INTERNO;
            $data["transporte"] = Constantes::TERRESTRE;
            $data["modalidad"] = $reporte->getCaModalidad();

            $data["cotizacion"] = $reporte->getCaIdcotizacion();
            $data["cotizacionotm"] = $reporte->getCaIdcotizacionotm();
            $data["continuacion"] = $reporte->getCaContinuacion();
            
            
            $data["cont-origen"] = $reporte->getCaContOrigen();
            $data["cont-destino"] = $reporte->getCaContDestino();

            $data["proveedor"] = $reporte->getCaIdlinea();
            $data["linea"] = utf8_encode($reporte->getIdsProveedor()->getIds()->getCaNombre());

            
            if($reporte->getCaImpoexpo()==Constantes::EXPO)
            {
                $data["idtra_origen_id"] = "";
                $data["tra_origen_id"] = "";
                $data["origen"] = "";
                $data["idorigen"] = "";
                
                $data["idtra_destino_id"] = utf8_encode($reporte->getOrigen()->getTrafico()->getCaIdtrafico());
                $data["tra_destino_id"] = utf8_encode($reporte->getOrigen()->getTrafico()->getCaNombre());
                $data["destino"] = utf8_encode($reporte->getOrigen()->getCaCiudad());
                $data["iddestino"] = $reporte->getCaOrigen();
            }
            else
            {
                $data["idtra_origen_id"] = utf8_encode($reporte->getDestino()->getTrafico()->getCaIdtrafico());
                $data["tra_origen_id"] = utf8_encode($reporte->getDestino()->getTrafico()->getCaNombre());
                $data["origen"] = utf8_encode($reporte->getDestino()->getCaCiudad());
                $data["idorigen"] = $reporte->getCaDestino();

                $data["idtra_destino_id"] = "";
                $data["tra_destino_id"] = "";
                $data["destino"] = "";
                $data["iddestino"] = "";
            }
            
            if($reporte->getCaColmas() == "Sí")            
            {
                $data["idlineaadu"] = "830003960";
            }
           

            $data["idcliente"] = $reporte->getCliente()->getCaIdcliente();
            $data["cliente"] = utf8_encode($reporte->getCliente()->getCaCompania());
            
            $data["idclientefac"] = $reporte->getClienteFac()->getCaIdcliente();
            $data["clientefac"] = utf8_encode($reporte->getClienteFac()->getCaCompania());
            

            $data["idconcliente"] = $reporte->getCaIdconcliente();
            $data["contacto"] = utf8_encode($reporte->getContacto('2')->getCaNombres() . " " . $reporte->getContacto('2')->getCaPapellido() . " " . $reporte->getContacto('2')->getCaSapellido());

            $data["orden_clie"] = utf8_encode($reporte->getCaOrdenClie());

            $cliente = $reporte->getCliente();

            $data["ca_liberacion"] = ($cliente->getLibCliente()->getCaDiascredito() > 0) ? "Si" : "No";
            $data["ca_tiempocredito"] = $cliente->getLibCliente()->getCaDiascredito();
            $data["preferencias"] = utf8_encode($reporte->getCaPreferenciasClie());

            $data["fchdespacho"] = $reporte->getCaFchdespacho();
            $data["idvendedor"] = utf8_encode($reporte->getCaLogin());
            $data["vendedor"] = utf8_encode($reporte->getUsuario()->getCaNombre());
            $data["ca_mercancia_desc"] = utf8_encode($reporte->getCaMercanciaDesc());
            $data["ca_mcia_peligrosa"] = $reporte->getCaMciaPeligrosa();

            $data["idlineadu"] = "";
            $data["agencia"] = "";
            
            $data["ordenclie"] = utf8_encode($reporte->getCaOrdenClie());
            

            $index_datos=array("ca_dimensiones","ca_doc_transporte","ca_observaciones","ca_observaciones2","ca_peso","ca_piezas","ca_valor","ca_volumen","do","idticket","urbano","traslado","itr","extradimensionada","un","imo","fchbodegaje","respmaritimo","seguro","regimen","escolta");

            foreach($index_datos as $i)
            {
                $data[$i] = $reporte->getDatosJson($i);
            }
            
            $direccion=null;
            if($reporte->getDatosJson("ca_direccion")>0)
                $direccion=Doctrine::getTable("Tercero")->find($reporte->getDatosJson("ca_direccion"));
            
            if($direccion)
            {
                $data["ca_direccion"] = $reporte->getDatosJson("ca_direccion");
                $data["ca_direccion_dir"] = utf8_encode($direccion->getCaDireccion());
                $data["ca_direccion_nombre"] = utf8_encode($direccion->getCaNombre());
            }
            else
            {
                $data["ca_direccion"] = "";
                $data["ca_direccion_dir"] = "";
                $data["ca_direccion_nombre"] = "";
            }
            
            $direccion2=null;
            if($reporte->getDatosJson("ca_direccion2")>0)
                $direccion2=Doctrine::getTable("Tercero")->find($reporte->getDatosJson("ca_direccion2"));
            
            
            if($direccion2)
            {
                $data["ca_direccion2"] = $reporte->getDatosJson("ca_direccion2");
                $data["ca_direccion2_dir"] = utf8_encode($direccion2->getCaDireccion());
                $data["ca_direccion2_nombre"] = utf8_encode($direccion2->getCaNombre());
            }
            else
            {
                $data["ca_direccion2"] = "";
                $data["ca_direccion2_dir"] = "";
                $data["ca_direccion2_nombre"] = "";
            }
        }
//        echo "<pre>";print_r($data);echo "</pre>";
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }


    public function executeGuardarReporte(sfWebRequest $request)
    {
        $errors = array();
        //$conn = Doctrine::getTable("Reporte")->getConnection();        
        //$conn->beginTransaction();
        //try 
        {
            

            $idreporte = ($request->getParameter("idreporte") != "") ? $request->getParameter("idreporte") : "0";
            $idrepPrincipal=$request->getParameter("idrepPrincipal");
            $impoexpo = utf8_decode($request->getParameter("impoexpo"));
            $transporte = utf8_decode($request->getParameter("transporte"));            
            $idempresa=$request->getParameter("idempresa");
            $modalidad = utf8_decode($request->getParameter("modalidad"));            
            $idorigen = $request->getParameter("idorigen");
            $iddestino = $request->getParameter("iddestino");
            $fchdespacho = $request->getParameter("fchdespacho");
            $mercancia_desc = $request->getParameter("ca_mercancia_desc");
            $idconcliente = $request->getParameter("idcliente");
            $idcotizacion= $request->getParameter("idcotizacion");
            $vendedor= $request->getParameter("ca_vendedor");
            $proveedor= $request->getParameter("proveedor");
            
            $ca_mcia_peligrosa= $request->getParameter("ca_mcia_peligrosa");
            $extradimensionada= $request->getParameter("extradimensionada");
            
            $contactos= $request->getParameter("contactos");

            $contactos = json_decode($contactos,0);           
            
            $idclientefac= $request->getParameter("idclientefac");
            
            $index_datos=array("ca_dimensiones","ca_direccion","ca_direccion2","ca_doc_transporte","ca_observaciones","ca_observaciones2","ca_peso","ca_piezas","ca_valor","ca_volumen","do","idlineaadu","idticket","urbano","traslado","itr","extradimensionada","un","imo","fchbodegaje","respmaritimo","seguro","regimen","escolta");
            
            $error = "";

            $reporte = Doctrine::getTable("Reporte")->find($idreporte);

                //$reporte= new Reporte();
                if (!$reporte)
                {
                    $reporte = new Reporte();
                    $reporte->setCaFchreporte(date("Y-m-d"));
                    $reporte->setCaTransporte($transporte);
                    $reporte->setCaImpoexpo($impoexpo);
                    $reporte->setCaConsecutivo(ReporteTable::siguienteConsecutivo(date("Y"), utf8_decode($request->getParameter("impoexpo")), utf8_decode($request->getParameter("transporte"))));
                    $reporte->setCaVersion(1);
                    $reporte->setCaTiporep(5);
                }
                else{
                    $reporte->setCaUsuactualizado($this->getUser()->getUserId());
                    $reporte->setCaFchactualizado(date('Y-m-d H:i:s'));
                }
                                
                if ($vendedor != "") {
                    $reporte->setCaLogin($vendedor);
                } else {
                    $errors["vendedor"] = "Debe seleccionar un vendedor";
                    $texto.="Vendedor<br>";
                }
                
                if ($proveedor != "") {
                    $reporte->setCaIdlinea($proveedor);
                } else {
                    $errors["proveedor"] = "Debe seleccionar un proveedor";
                    $texto.="Proveedor<br>";
                }

                if ($idorigen != "") {
                    $reporte->setCaOrigen($idorigen);
                } else {
                    $errors["idorigen"] = "Debe seleccionar un origen";
                    $texto.="Origen<br>";
                }

                if ($iddestino != "") {
                    $reporte->setCaDestino($iddestino);
                } else {
                    $errors["iddestino"] = "Debe seleccionar un destino";
                    $texto.="Destino<br>";
                }

                if ($impoexpo!="") {
                        $reporte->setCaImpoexpo(utf8_decode($impoexpo));
                }
                else {
                    $errors["impoexpo"] = "Debe seleccionar una clase";
                    $texto.="Clase<br>";
                }
                
                if ($fchdespacho!="") {
                    $reporte->setCaFchdespacho($fchdespacho);
                } else {
                    $reporte->setCaFchdespacho(date("Y-m-d"));
                }
                
                 if ($idconcliente!="") {
                    $reporte->setCaIdconcliente($idconcliente);
                } else {
                    $errors["idconcliente"] = "Debe seleccionar un cliente";
                    $texto.="Cliente<br>";
                }
                
                 if ($idticket!="") {
                    $reporte->setProperty("idticket", $idticket);
                    $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);
                    $ticket->setDocumento('Reporte de Negocios',$reporte->getCaConsecutivo());
                }
                
                if ($modalidad) {
                    $reporte->setCaModalidad($modalidad);
                } else {
                    $errors["idmodalidad"] = "Debe seleccionar una modalidad";
                    $texto.="Modalidad<br>";
                }
                
                if ($mercancia_desc!="") {
                    $reporte->setCaMercanciaDesc($mercancia_desc);
                } else {
                    $reporte->setCaMercanciaDesc(" ");
                    //$errors["ca_mercancia_desc"] = "Debe llenar informacion de la descripcion de la mercancia";
                    //$texto.="Modalidad<br>";
                }
                
                if($idclientefac!="")
                    $reporte->setCaIdclientefac($idclientefac);
                else
                    $reporte->setCaIdclientefac(null);
                
                if ($request->getParameter("ordenclie")) {
                    $reporte->setCaOrdenClie(utf8_decode($request->getParameter("ordenclie")));
                }
                else
                    $reporte->setCaOrdenClie("-");
                
                $reporte->setCaConfirmarClie("-");

                $reporte->setCaMciaPeligrosa($ca_mcia_peligrosa);

                foreach($index_datos as $i)
                {
                    $reporte->setDatosJson($i,$request->getParameter($i) );
                }
                
                $cont="";
                foreach($contactos as $c)
                {
                    $cont.=$c.",";
                }
                
                $reporte->setCaConfirmarClie($cont);
                $reporte->setDatosJson("idcoldepositos",$request->getParameter("idcoldepositos"));
                $reporte->setDatosJson("idciudeposito",$request->getParameter("idciudeposito"));
                $reporte->setDatosJson("ciudeposito",$request->getParameter("ciudeposito"));

                $reporte->save();
                if($idrepPrincipal>0)
                {
                    $reporteT = Doctrine::getTable("Reporte")->find($idrepPrincipal);
                    $reporteT->setDatosJson("idreporteT",$reporte->getCaIdreporte());
                    $reporteT->save();
                    $reporte->setDatosJson("idreporteP",$idrepPrincipal);
                    $reporte->save();
                }else
                {
                    $idrepPrincipal=0;
                }
                
                
                $this->responseArray = array("success" => true, "consecutivo" => $reporte->getCaConsecutivo(),"version" =>$reporte->getCaVersion(), "idreporte" => $reporte->getCaIdreporte(),
                    'idtransporte' => utf8_encode($transporte), 'idimpoexpo' => utf8_encode($impoexpo), 'modalidad' => $modalidad,"idrepPrincipal"=>$idrepPrincipal);
                $this->setTemplate("responseTemplate");
            
        } /*catch (Exception $e) {

            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            $this->setTemplate("responseTemplate");
        }*/
        
    }
    
    public function executeCopiarReporte(sfWebRequest $request) {
        $idreporte = ($request->getParameter("idreporte") != "") ? $request->getParameter("idreporte") : "0";
        $reporte = Doctrine::getTable("Reporte")->find($idreporte);
        $reporte = $reporte->copiar(1);
        $this->setTemplate("responseTemplate");
        
        $this->responseArray = array("success" => true, "consecutivo" => $reporte->getCaConsecutivo(),"version" =>$reporte->getCaVersion(), "idreporte" => $reporte->getCaIdreporte(),
                    'idtransporte' => utf8_encode($reporte->getCaTransporte()), 'idimpoexpo' => utf8_encode($reporte->getCaImpoexpo()), 
            'modalidad' => $reporte->getCaModalidad());
        

    }
    
    public function executeNuevaVersion(sfWebRequest $request) {
        $idreporte = ($request->getParameter("idreporte") != "") ? $request->getParameter("idreporte") : "0";
        $reporte = Doctrine::getTable("Reporte")->find($idreporte);
        $reporte1 = $reporte->copiar(2);
        //echo $reporte1->getCaConsecutivo()."-"+.reporte1->getCaVersion();
        //exit;
        $this->setTemplate("responseTemplate");
        
        $this->responseArray = array("success" => true, "consecutivo" => $reporte1->getCaConsecutivo(),"version" =>$reporte1->getCaVersion(), "idreporte" => $reporte1->getCaIdreporte(),
                    'idtransporte' => utf8_encode($reporte1->getCaTransporte()), 'idimpoexpo' => utf8_encode($reporte1->getCaImpoexpo()), 
            'modalidad' => $reporte1->getCaModalidad());
        

    }
    
    
    
    public function executeGuardarContenedores(sfWebRequest $request) {
        $contenedores = $request->getParameter("gridContenedores");
        $contenedores = json_decode($contenedores);

//        try 
//        {
            $ids = array();
            $idequipos = array();
            foreach ($contenedores as $contenedor) {
                if (!$contenedor->idrepequipo) {
                    $equipo = new RepEquipo();
                    //$equipo->setCaUsucreado($this->getUser()->getUserId());
                    //$equipo->setCaFchcreado(date('Y-m-d H:i:s'));
                } else {
                    $equipo = Doctrine::getTable("RepEquipo")->find($contenedor->idrepequipo);
                }
                // $equipo->setCaIdconcepto($contenedor->idconcepto);
                if (is_integer((int)$contenedor->concepto) && (int)$contenedor->concepto > 0) {
                    
                    $equipo->setCaIdconcepto($contenedor->concepto);
                }
                else if (is_integer((int)$contenedor->idconcepto) && (int)$contenedor->idconcepto > 0) {
                    $equipo->setCaIdconcepto((int)$contenedor->idconcepto);
                }
                
                else
                {
                    $equipo->setCaIdconcepto(null);
                }                
                if ($contenedor->idvehiculo != "")
                    $equipo->setCaIdvehiculo($contenedor->idvehiculo);
                $equipo->setCaIdequipo(utf8_decode($contenedor->serial));
                $equipo->setCaIdreporte($request->getParameter("idreporte"));
                //$equipo->setCaNumprecinto(utf8_decode($contenedor->precinto)); 693435273  hasta el 1 febrero
                $equipo->setCaObservaciones(utf8_decode($contenedor->observaciones));
                $equipo->setCaCantidad($contenedor->cantidad===""?0:$contenedor->cantidad);
                
                $equipo->setDatosJson("placa", $contenedor->placa );
                $equipo->setDatosJson("idembalaje", $contenedor->idembalaje );
                //$equipo->setCaUsuactualizado($this->getUser()->getUserId());
                //$equipo->setCaFchactualizado(date('Y-m-d H:i:s'));
                $ids[] = $contenedor->id;

                $equipo->save();
                $idequipos[] = $equipo->getCaIdequipo();
            }
            $this->responseArray = array("success" => true, "ids" => $ids, "idequipos" => $idequipos);
//        } catch (Exception $e) {
//            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
//        } 
        $this->setTemplate("responseTemplate");
    }
    
    
    public function executeDatosContenedores(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idreporte = $request->getParameter("idreporte");
        $q = Doctrine::getTable("RepEquipo")
                ->createQuery("e")
                ->addWhere("e.ca_idreporte = ?", $idreporte);
        $equipos= $q->execute();
        
        $data = array();
        
        
        foreach ($equipos as $equipo) {
            //"idembalaje" =>$equipo->getDatosJson("idembalaje")
            $emb = ParametroTable::retrieveByCaso("CU047",null,null,$equipo->getDatosJson("idembalaje"));
            if(count($emb)>0)
            {            
                $embalaje=$emb[0]->getCaValor();
            }
                    
            $data[] = array(
                "idrepequipo" => $equipo->getCaIdrepequipo(),
                "idequipo" => $equipo->getCaIdequipo(),
                "idconcepto" => $equipo->getCaIdconcepto(),
                "concepto" => utf8_encode($equipo->getConcepto()->getCaConcepto()),
                "idvehiculo" => $equipo->getCaIdvehiculo(),
                "serial" => $equipo->getCaIdequipo(),
                "observaciones" => utf8_encode($equipo->getCaObservaciones()),
                "cantidad" => $equipo->getCaCantidad(),
                "placa" =>$equipo->getDatosJson("placa"),
                "idembalaje" =>$equipo->getDatosJson("idembalaje"),
                "embalaje" => $embalaje
            );
        }
        //echo "<pre>"; print_r($data);echo "</pre>";
        $this->responseArray = array("success" => true, "root" => $data, "count" => count($data));
        $this->setTemplate("responseTemplate");
    }
    
    
    public function executeGuardarItr(sfWebRequest $request) {
        $idreporte = $request->getParameter("idreporte");
        $datos = $request->getParameter("gridDatos");
        $datos = json_decode($datos);

//        try 
//        {
            $ids = array();
            $idequipos = array();
            foreach ($datos as $d) {
                
                if (!$d->itr_idrepitr || $d->itr_idrepitr=="") {
                    $itr = new RepItr();                    
                    $itr->setCaIdreporte($idreporte);
                } else {
                    $itr = Doctrine::getTable("RepItr")->find($d->itr_idrepitr);
                }
                
                $itr->setCaIdvehiculo($d->itr_vehiculo);
                $itr->setCaPlaca( $d->itr_placa );
                $itr->setCaPiezas( $d->itr_piezas );
                $itr->setCaIdembalaje( $d->itr_idembalaje );
                $itr->setCaPeso( $d->itr_peso );
                $itr->setCaVolumen($d->itr_volumen );
                $itr->setCaDireccion($d->itr_direccion );
                $itr->setCaObservaciones($d->itr_observaciones );
                //$equipo->setCaUsuactualizado($this->getUser()->getUserId());
                //$equipo->setCaFchactualizado(date('Y-m-d H:i:s'));
                $ids[] = $d->id;

                $itr->save();
                $iditr[] = $itr->getCaIdrepitr();
            }
            $this->responseArray = array("success" => true, "ids" => $ids, "iditr" => $iditr);
//        } catch (Exception $e) {
//            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
//        } 
        $this->setTemplate("responseTemplate");
    }

    
    function executeEliminarItr(sfWebRequest $request)
    {
        
        $iditr = $request->getParameter("idrepitr");
        $errorInfo = "";
        $ids = array();
            
        $itr = Doctrine::getTable("RepItr")->find($iditr);
        if($itr)
        {
            $itr->delete();
        }
        $this->responseArray = array( "id" => implode(",", $ids), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosItr(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idreporte = $request->getParameter("idreporte");
        $itr = Doctrine::getTable("RepItr")
                ->createQuery("e")
                ->addWhere("e.ca_idreporte = ?", $idreporte)
                ->execute();
        $data = array();
        foreach ($itr as $i) {
            $data[] = array(
                "itr_idrepitr" => $i->getCaIdrepitr(),                
                "itr_vehiculo" => $i->getCaIdvehiculo(),
                "itr_placa" => $i->getCaPlaca(),
                "itr_idembalaje" => $i->getCaIdembalaje(),
                "itr_piezas" => $i->getCaPiezas(),
                "itr_peso" => $i->getCaPeso(),
                "itr_volumen" => $i->getCaVolumen(),
                "itr_direccion" => $i->getCaDireccion(),
                "itr_observaciones" => $i->getCaObservaciones()
            );
        }
        $this->responseArray = array("success" => true, "root" => $data, "count" => count($data));
        $this->setTemplate("responseTemplate");
    }
    
    public function executeGuardarGridTarifas(sfWebRequest $request) {
        
        $datos = $request->getParameter("datos");
        $datos_det = json_decode($datos);

        $errorInfo = "";
        $ids = array();
        
        foreach ($datos_det as $t) {
            if ($t->concepto == "" || $t->neta == "" || $t->venta == "")
                continue;
            
            $repTarifa = Doctrine::getTable("RepTarifa")->find($t->idreptarifa);
            if (!$repTarifa)
                $repTarifa = new RepTarifa();

            $repTarifa->setCaIdreporte($t->idreporte);
            /*if ($tipoComprobante->getCaTipo() == "C")
                $inoDetalle->setCaDb($t->valor);
            else
                $inoDetalle->setCaCr($t->valor);
             * 
             */
            $repTarifa->setCaIdconcepto(is_numeric($t->concepto) ? $t->concepto : $t->idconcepto );
            
            $repTarifa->setCaNetaTar($t->neta );
            $repTarifa->setCaCobrarTar($t->venta );
            $repTarifa->setCaObservaciones($t->observaciones );
            $repTarifa->setDatosJson("sol",$t->sol);
            
            //$inoDetalle->setCaId($comprobante->getCaId());
            $repTarifa->save($conn);

            $ids[] = $t->id;
            $ids_reg[] = $repTarifa->getCaIdreptarifa();
            //$valor += $t->valor;
        }
        
        $this->responseArray = array("errorInfo" => "", "id" => implode(",", $ids), "idreg" => implode(",", $ids_reg), "success" => true);
        
        $this->setTemplate("responseTemplate");
        
    }
    
    public function executeDatosTarifas(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $this->data = array();
        
        if ($request->getParameter("idreporte") > 0) {
            $idreporte = $request->getParameter("idreporte");
            $this->forward404Unless($idreporte);
            $datos = Doctrine::getTable("Reptarifa")
                    ->createQuery("t")
                    ->select("t.*")
                    ->where("t.ca_idreporte = $idreporte  ")
                    ->execute();
            
            foreach ($datos as $d) {
                $this->data[] = array(
                    "idreptarifa" => $d->getCaIdreptarifa(),
                    "idreporte" => $idreporte,
                    "idconcepto" => $d->getCaIdconcepto(),
                    "concepto" => utf8_encode($d->getInoConcepto()->getCaConcepto()),
                    "neta" => $d->getCaNetaTar(), 
                    "venta" => $d->getCaCobrarTar(),
                    "observaciones" => utf8_encode($d->getCaObservaciones()),
                    "sol"=>$d->getDatosJson("sol")
                );
            }
//            $sql = $q->getSqlQuery();
        }
        
        if(count($this->data)==0)
        {
            $this->data[] = array(
                "idreptarifa" => " ",
                "idreporte" => $idreporte,
                "idconcepto" => " ",
                //"idmoneda" => " ",
                //"concepto" => " ",
                "neta" => " ",                
                "venta" => " "
            );
            //$sql = "";
            
        }

        $this->responseArray = array("success" => true, "root" => $this->data, "total" => count($this->data), "debug" => $sql);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeGenerarPDF($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
   
        $idreporte=$request->getParameter("id");
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "LETTER", true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Coltrans');

//        $pdf->SetMargins(1, 1, 1,true);

        //$pdf->setHeaderData('logos/coltrans.jpg','200');
        $pdf->SetHeaderData('logos/coltrans.jpg', 69, '', '', array(0,69,255), array(0,69,128));
//        $pdf->setFooterData(array(0,64,0), array(0,64,128));
        
        
// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->SetFont('helvetica', '', 10);

        $pdf->AddPage('', '',true);

        $pdf->setCellPaddings(1, 1, 1, 1);
        $pdf->setCellMargins(1, 1, 1, 1);
        $pdf->SetFillColor(255, 255, 127);
        $this->getRequest()->setParameter('idreporte',$idreporte);
        $html=sfContext::getInstance()->getController()->getPresentationFor( 'reportesNeg2', 'htmlDTM');
        $html=utf8_encode($html);
        $html=  str_replace("#E1E1E1", "", $html);
        
        //$pdf->writeHTML($html, true, false, true, false, '');
        
        $pdf->lastPage();
        
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");

        $pdf->Output('example.pdf', 'I');

       exit;
   
        
    }

    
    public function executeHtmlCP(sfWebRequest $request) {
        $idreporte=($request->getParameter("idreporte")!="")?$request->getParameter("idreporte"):"0";
        $this->reporte = Doctrine::getTable("Reporte")->find( $idreporte );
        $this->forward404Unless( $this->reporte );
        $this->repotm=$this->reporte->getRepOtm();
        
        if($this->getUser()->getUserId()=="maquinche")
        {
            $house = Doctrine::getTable("InoHouse")
                      ->createQuery("h")
                      ->select("h.ca_idreporte,m.ca_referencia")
                      ->innerJoin("h.InoMaster m")
                      ->addWhere("h.ca_idreporte = ?", $this->repotm->getCaIdreporte() )
                      ->fetchOne();
            if($house)
            {
                $this->referencia=$house->getProperty("ca_referencia");
            }
        }        
        
        $this->setLayout("none");
    }
    
    public function executeHtmlDTM(sfWebRequest $request) {    

        $idreporte=($request->getParameter("idreporte")!="")?$request->getParameter("idreporte"):"0";
        $this->reporte = Doctrine::getTable("Reporte")->find( $idreporte );
        $this->forward404Unless( $this->reporte );
        //$this->repotm=$this->reporte->getRepOtm();
        /*if($this->reporte->getCaModalidad()=="FCL")
        {
            $this->marcas=$this->reporte->getCliente()->getCaCompania()."<br>Contenedor<br> ".$this->repotm->getCaContenedor()."<br>FCL-FCL";
        }
        else
        {
            $this->marcas="Carga Suelta<br>LCL-LCL";
        }*/
        
        $this->agencia= Doctrine::getTable("Ids")->find($this->reporte->getDatosJson("idlineaadu")); 
        
        $this->setLayout("none");
    }
    
    public function executeGenerarServicioPDF(sfWebRequest $request) {
        
        $idreporte=($request->getParameter("id")!="")?$request->getParameter("id"):"0";
        $this->reporte = Doctrine::getTable("Reporte")->find( $idreporte );
        $this->forward404Unless( $this->reporte );
        
        $this->filename = $this->getRequestParameter("filename");
        
        $this->usuario = $this->reporte->getUsuario();
        $this->contacto = $this->reporte->getContacto();
        $this->cliente = $this->contacto->getCliente();
        $this->empresa = Doctrine::getTable("Empresa")->find(2); // Localiza la empresa Colmas

        $this->sucursal =  Doctrine::getTable("Sucursal")
                ->createQuery("s")                
                ->where("ca_nombre = ? and ca_idempresa=2" , $this->usuario->getSucursal()->getcaNombre() )
                ->fetchOne();
        
        $this->equipos = Doctrine::getTable("RepEquipo")
                ->createQuery("e")
                ->addWhere("e.ca_idreporte = ?", $idreporte)
                ->execute();
        
        foreach($this->equipos as $k=>$equipo)
        {
            $datos=array();
            $veh = ParametroTable::retrieveByCaso("CU020",null,null,$equipo->getCaIdvehiculo());
            //if(count($veh)>0)
            {            
                $this->equipos[$k]->setDatosJson("vehiculo",$veh[0]->getCaValor());
            }
        }        
        
        $this->tarifas = Doctrine::getTable("Reptarifa")
                    ->createQuery("t")
                    ->select("t.*")
                    ->where("t.ca_idreporte = $idreporte  ")
                    ->execute();
        

        $this->itr = Doctrine::getTable("RepItr")
                ->createQuery("e")
                ->addWhere("e.ca_idreporte = ?", $idreporte)
                ->execute();        

        $this->direccion=array();
        $this->direccion2=array();
        if($this->reporte->getDatosJson("ca_direccion")>0)
        {
            $this->direccion=Doctrine::getTable("Tercero")->find($this->reporte->getDatosJson("ca_direccion"));
        }
        if($this->reporte->getDatosJson("ca_direccion2")>0)
        {
            $this->direccion2=Doctrine::getTable("Tercero")->find($this->reporte->getDatosJson("ca_direccion2"));
        }
        
        
        
        
        
    }

    public function executeSolicitudServicio(sfWebRequest $request) {    

        $this->idreporte=($request->getParameter("id")!="")?$request->getParameter("id"):"0";
        $reporte = Doctrine::getTable("Reporte")->find( $this->idreporte );
        $this->fchAprobacion=$reporte->getDatosJson("fchAprobacion");
        $this->usuAprobacion=$reporte->getDatosJson("usuAprobacion");
        
         
        $this->emails= Doctrine::getTable("Email")
                        ->createQuery("e")
                        ->select("e.*")                        
                        ->where("ca_tipo=? and ca_idcaso =?", array("EmailSolTT",$this->idreporte))                        
                        ->execute();
        //echo count($this->emails);

        //$this->setLayout("none");
    }
    
    public function executeAprobarReporte(sfWebRequest $request)
    {
        //try
        {
            $idreporte=$request->getParameter("id");
            $reporte = Doctrine::getTable("Reporte")->find( $idreporte );

            if($reporte)
            {
                $reporte->setDatosJson("fchAprobacion",date("Y-m-d H:i:s"));
                $reporte->setDatosJson("usuAprobacion", $this->getUser()->getUserId() );
                $reporte->save();
                $iddoc=80;
                $tipDoc = Doctrine::getTable("TipoDocumental")->find($iddoc);

                $path="";
                $folder = $tipDoc->getCaDirectorio();            
                $path.=$reporte->getCaConsecutivo() . DIRECTORY_SEPARATOR;    
                
                $directory = sfConfig::get('app_digitalFile_root') . date("Y") . DIRECTORY_SEPARATOR . $folder . $path;
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }
                chmod($directory, 0777);                
                $fileName = "Solicitud.pdf";
                
                $mime = "application/pdf";
                $size = -1;
                
                //echo $directory . $fileName;
                //exit;
                
                $this->filename = $fileName;
                $this->getRequest()->setParameter('filename', $directory . $fileName);
                sfContext::getInstance()->getController()->getPresentationFor('reportesNeg2', 'generarServicioPDF');
                
                $archivo = new Archivos();
                $archivo->setCaIddocumental($iddoc);
                $archivo->setCaNombre($fileName);
                $archivo->setCaMime($mime);
                $archivo->setCaSize($size);
                $archivo->setCaPath($directory . $fileName);
                $archivo->setCaRef1($reporte->getCaConsecutivo());
                
                $archivo->save();
                

            
                
                
            }
            
            $this->responseArray=array("success"=>true);
        } 
        /*catch(Exception $e)
        {
            $this->responseArray=array("success"=>false,"err"=>$e->getMessage());
        }*/
        $this->setTemplate("responseTemplate");
    }
    
    //guardarControlMandato',cargarControlMandato
    
    public function executeCargarControlMandato($request) {
        $idrepequipo = $request->getParameter("idrepequipo");
        try {
            $repEquipo = Doctrine::getTable("RepEquipo")->find($idrepequipo); 
            $data = array();
            if ($repEquipo) {
                if($repEquipo->getDatosJson("fecha_arribo")!="")
                {
                    $data ["fecha_arribo"]=$repEquipo->getDatosJson("fecha_arribo");
                }else{
                    $data ["fecha_arribo"]=$repEquipo->getReporte()->getCaFchdespacho();
                }
                
                if($repEquipo->getDatosJson("fecha_entrega")!="")
                {
                    $data ["fecha_entrega"]=$repEquipo->getDatosJson("fecha_entrega");
                }else{
                    $data ["fecha_entrega"]=date('Y-m-d');
                }
                
                $data ["dias_libres"]=$repEquipo->getDatosJson("dias_libres");
                $data ["limite_devolucion"]=$repEquipo->getDatosJson("limite_devolucion");
                $data ["idpatio"]=$repEquipo->getDatosJson("idpatio");
                $data ["patio"]=$repEquipo->getDatosJson("patio");
                $data ["devolucion_fch"]=$repEquipo->getDatosJson("devolucion_fch");
                $data ["observaciones"]=$repEquipo->getDatosJson("observaciones");
                
            }
            else
            {
                //$data ["fecha_arribo"]=$repEquipo->getReporte()->getCaFchdespacho();
                //$data ["fecha_entrega"]=date('Y-m-d');
            }
            $this->responseArray = array("data" => $data, "total" => count($data), "success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarControlMandato($request) {
        $idrepequipo = $request->getParameter("idrepequipo");
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);

        $conn = Doctrine::getTable("InoEquipo")->getConnection();

        if ($idrepequipo) {
            $repEquipo = Doctrine::getTable("RepEquipo")->find($idrepequipo);

            $this->forward404Unless($repEquipo);
            try {
                //$conn->beginTransaction();
                
                $repEquipo->setDatosJson("fecha_arribo",$datos->fecha_arribo);
                $repEquipo->setDatosJson("dias_libres",$datos->dias_libres);
                $repEquipo->setDatosJson("limite_devolucion",$datos->limite_devolucion);
                $repEquipo->setDatosJson("fecha_entrega",$datos->fecha_entrega);
                $repEquipo->setDatosJson("idpatio",$datos->idpatio);
                $repEquipo->setDatosJson("patio",$datos->patio);
                $repEquipo->setDatosJson("devolucion_fch",$datos->devolucion_fch);
                $repEquipo->setDatosJson("observaciones",$datos->observaciones);
                

                //$inoEquipo->setCaDatos($datos);
                $repEquipo->save();
                //$conn->commit();
                $this->responseArray = array("success" => true,"datos"=>$datos);
            } catch (Exception $e) {
                //$conn->rollBack();
                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            }
            $this->setTemplate("responseTemplate");
        }
    }
    
    public function executeEmailSolicitud(sfWebRequest $request) {

//        $numref = str_replace("|", ".", $request->getParameter("ref"));
        $idreporte = $request->getParameter("idreporte");
        $this->forward404Unless($idreporte);

        
//        echo $idreporte;
//        $ref = Doctrine::getTable("InoMaster")->find($idmaster);
        $q = Doctrine::getTable("Reporte")
                ->createQuery("r")
                ->select("ca_consecutivo,ca_idreporte")
                ->where("r.ca_idreporte=?", $idreporte);
                $this->reporte=$q->fetchOne();
        //echo $q->getSqlQuery();
        //exit;
        
        
        
        
        //$this->forward404Unless($this->reporte);
        //echo $this->reporte->getCaIdreporte();
        //exit;

        $this->setLayout($format);        
        $this->user = $this->getUser();
        $this->format = $format;

        $ids=$this->reporte->getIdsProveedor()->getIds();
        $suc=$ids->getIdsSucursal();
        $this->contactos="";
        foreach($suc as  $k=>$s)
        {
            if($s->count()>0)
            {
                if($s->getCaUsueliminado()!="")
                {
                    continue;
                }
                $con=$s->getIdsContacto();
                foreach($con as  $j=>$c)
                {       
                    if($this->contactos!="")
                        $this->contactos.=",";
                    $this->contactos.=utf8_encode($c->getCaEmail());                    
                    
                }
            }
        }
        
        /*$this->conta = ParametroTable::retrieveByCaso("CU098", $this->reporte->getIdsProveedor()->getIds()->getCaIdalterno());


        if ($this->conta[0]) {
            $this->contactos = $this->conta[0]->getCaValor2();
        }*/
        //$this->contactos="";

        /*$folder = "Referencias" . DIRECTORY_SEPARATOR . $this->ref->getCaReferencia();
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;
        $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);

        foreach ($archivos as $archivo) {
            $file = explode("/", $archivo);
            $filenames[]["file"] = $file[count($file) - 1];
        }
        $this->filenames = $filenames;
        $this->setLayout("email");*/
        
    }
    
    public function executeEnviarEmailSolicitud(sfWebRequest $request) {

        $user = $this->getUser();
        $email = new Email();

        
        $idreporte = $request->getParameter("idreporte");
        
        $email->setCaUsuenvio($user->getUserId());
        $email->setCaTipo("EmailSolTT"); //Envío de Avisos
        $email->setCaIdcaso(null);

                
        $from = $request->getParameter("from");
        if ($from) {
            $email->setCaFrom($from);
        } else {
            $email->setCaFrom($user->getEmail());
        }
        $email->setCaFromname($user->getNombre());

        if ($this->getRequestParameter("readreceipt")) {
            $email->setCaReadreceipt(true);
        } else {
            $email->setCaReadreceipt(false);
        }

        $email->setCaReplyto($user->getEmail());
        $email->setCaIdcaso($idreporte);

        $recips = explode(",", $this->getRequestParameter("destinatario"));

        foreach ($recips as $recip) {
            $recip = str_replace(" ", "", $recip);
            if ($recip) {
                $email->addTo($recip);
            }
        }

        $recips = explode(",", $this->getRequestParameter("cc"));
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

        $email->setCaSubject($this->getRequestParameter("asunto"));
        $email->setCaBody($this->getRequestParameter("mensaje"));
        $mensaje = Utils::replace($this->getRequestParameter("mensaje")) . "<br />";
        $email->setCaBodyhtml($mensaje);

        $files = $this->getRequestParameter("files");
        foreach ($files as $archivo) {

            $name = $archivo;
            $email->AddAttachment($name);
        }
        $email->save();
        $this->setLayout("email");
    }
    
    function executeEliminarGridTarifa(sfWebRequest $request)
    {
        
        $datos = $request->getParameter("datos");
        $datos_det = json_decode($datos);

        $errorInfo = "";
        $ids = array();
        
        foreach ($datos_det as $t) {
            if ($t == "null" || $t->idreptarifa == "" )
                continue;
            
            $repTarifa = Doctrine::getTable("RepTarifa")->find($t->idreptarifa);
            if($repTarifa)
            {
                $repTarifa->delete();
            }
            $ids[] = $t->id;            
            //$valor += $t->valor;
        }
        
        $this->responseArray = array( "id" => implode(",", $ids), "success" => true);
        
        $this->setTemplate("responseTemplate");
        
    }
    
    
    function executeEliminarContenedor(sfWebRequest $request)
    {
        
        $idrepequipo = $request->getParameter("idrepequipo");
        $errorInfo = "";
        $ids = array();
            
        $equipo = Doctrine::getTable("RepEquipo")->find($idrepequipo);
        if($equipo)
        {
            $equipo->delete();
        }
        $this->responseArray = array( "id" => implode(",", $ids), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosListadoRn(sfWebRequest $request)
    {
        
        $this->fecha1 = $request->getParameter("fecha1");        
        $this->fecha2 = $request->getParameter("fecha2");
        $this->idcliente = $request->getParameter("idcliente");
        //$this->idsucursal = $request->getParameter("idsucursal");
        $format=$request->getParameter("format");
        
        $sql="select b.*,a.ca_estado,a.ca_fchcreado as ca_fchnotificado,a.ca_usucreado as ca_usuenvio,a.ca_login as ca_usurecibido 
	from rn.vi_busqueda b
        left join tb_repantecedentes a ON b.ca_idreporte=a.ca_idreporte
	where 
               b.ca_tiporep = 5          ";
        
        if($this->fecha1!="")
            $sql.="and  b.ca_fchcreado >= '".$this->fecha1."' ";
        else
            $sql.="and  b.ca_fchcreado >= '".Utils::agregarDias(date("Y-m-d"), -2)."' ";
        
        if($this->fecha2!="")
            $sql.="and  b.ca_fchcreado <= '".$this->fecha2."' ";
        
        if($this->idcliente!="")
            $sql.="and  b.ca_idcliente <= '".$this->idcliente."' ";
        
        $sql.=" order by b.ca_idreporte DESC";
    
        //echo $sql;
        
        $con = Doctrine_Manager::getInstance()->getConnection('replica');
        $st = $con->execute($sql);
            
        $this->resul = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);

        //print_r($this->resul);
        //echo "<pre>";print_r($this->resul);echo "</pre>";
        if(count($this->resul)>0)
        {
            if($format!="json")
            {                
                $this->getRequest()->setParameter('resul', $this->resul);
                $this->html = sfContext::getInstance()->getController()->getPresentationFor('reportesGer', 'cargasenTraslado');
                   
                echo $this->html;
                exit();
            }
            else            
            {
                
                foreach($this->resul as $k=>$r)
                {
                    $this->resul[$k]["ca_ciuorigen"] = utf8_encode($this->resul[$k]["ca_ciuorigen"]);
                    $this->resul[$k]["ca_ciudestino"] = utf8_encode($this->resul[$k]["ca_ciudestino"]);
                    $this->resul[$k]["ca_tradestino"] = utf8_encode($this->resul[$k]["ca_tradestino"]);
                    $this->resul[$k]["ca_impoexpo"] = utf8_encode($this->resul[$k]["ca_impoexpo"]);
                    $this->resul[$k]["ca_transporte"] = utf8_encode($this->resul[$k]["ca_transporte"]);
                    $this->resul[$k]["ca_nomlinea"] = utf8_encode($this->resul[$k]["ca_nomlinea"]);
                    $this->resul[$k]["ca_nombre"] = utf8_encode($this->resul[$k]["ca_nombre"]);
                    $this->resul[$k]["ca_nombre_cli"] = utf8_encode($this->resul[$k]["ca_nombre_cli"]);
                    $this->resul[$k]["ca_contacto_cli"] = utf8_encode($this->resul[$k]["ca_contacto_cli"]);
                    $this->resul[$k]["ca_traorigen"] = utf8_encode($this->resul[$k]["ca_traorigen"]);
                    $this->resul[$k]["ca_tradestino"] = utf8_encode($this->resul[$k]["ca_tradestino"]);
                }
                //echo "<pre>";print_r($this->resul);echo "</pre>";
//exit();
                $this->responseArray = array("success" => true, "total" => count($data), "root" => $this->resul,"debug"=>$sql);
                $this->setTemplate("responseTemplate");
            }
        }
        else
            exit;
    }
    
    
    public function executeAnularReporte($request) {
        $id = $request->getParameter("idreporte");
        $tipo = $request->getParameter("tipo");
        

        $this->forward404Unless(trim($request->getParameter("motivo")));

        $reporte = Doctrine::getTable("Reporte")->find($id);        
        
        if ($tipo=="1") {            
            $reportes[0] = $reporte;            
        }
        else
        {
            $reportes = Doctrine::getTable("Reporte")
                ->createQuery("r")                
                ->where("r.ca_consecutivo = ?", $reporte->getCaConsecutivo())
                ->execute();            
        }        
        foreach($reportes as $reporte)
        {
            
            if($reporte)
            {
                $consecutivo = $reporte->getCaConsecutivo();                
                $reporte->setCaUsuanulado($this->getUser()->getUserId());
                $reporte->setCaFchanulado(date("Y-m-d H:i:s"));
                $reporte->setCaDetanulado(trim($request->getParameter("motivo")));
                $reporte->save();

                $tarea = $reporte->getTareaIDGEnvioOportuno();
                if ($tarea) {
                    $tarea->delete();
                }
                
                $q = Doctrine::getTable("NotTarea")
                    ->createQuery("t")
                    ->innerJoin("t.RepAsignacion a")
                    ->innerJoin("a.Reporte r")
                    ->addWhere("r.ca_idreporte = ?", $request->getParameter("id"));

                $tareas = $q->execute();
                foreach ($tareas as $tarea) {
                    $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
                    $tarea->setCaUsuterminada($this->getUser()->getUserId());
                    $tarea->save();
                }
            }
            else 
                $this->forward404Unless($reporte);
        }
        $this->responseArray = array("success" => true);
        $this->setTemplate("responseTemplate");
    }
    
        
    function executeEliminarReferencia(sfWebRequest $request)
    {
    
        $idrepref = $request->getParameter("idrepreferencia");
        $errorInfo = "";
        $ids = array();
            
        $repref = Doctrine::getTable("RepReferencia")->find($idrepref);
        if($repref)
        {
            $repref->delete();
}
        $this->responseArray = array( "id" => implode(",", $ids), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosReferencia(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idreporte = $request->getParameter("idreporte");
        $objs = Doctrine::getTable("RepReferencia")
                ->createQuery("e")
                ->addWhere("e.ca_idreporte = ?", $idreporte)
                ->execute();
        $data = array();
        foreach ($objs as $o) {
            $data[] = array(
                "idrepreferencia" => $o->getCaIdrepreferencia(),                
                "referencia" => $o->getCaReferencia(),
                "idreporte" => $o->getCaIdreporte()
            );
        }
        $this->responseArray = array("success" => true, "root" => $data, "count" => count($data));
        $this->setTemplate("responseTemplate");
    }
    
    
    public function executeGuardarGridReferencias(sfWebRequest $request) {
        
        $datos = $request->getParameter("datos");
        $datos_det = json_decode($datos);

        $errorInfo = "";
        $ids = array();
        
        foreach ($datos_det as $t) {            
            
            $repReferencia = Doctrine::getTable("RepReferencia")->find($t->idreprferencia);
            if (!$repReferencia)
                $repReferencia = new RepReferencia();

            $repReferencia->setCaIdreporte($t->idreporte);            
            $repReferencia->setCaReferencia($t->referencia );
            $repReferencia->save($conn);

            $ids[] = $t->id;
            $ids_reg[] = $repReferencia->getCaIdrepreferencia();
        }
        
        $this->responseArray = array("errorInfo" => "", "id" => implode(",", $ids), "idreg" => implode(",", $ids_reg), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    
    public function executeGuardarSeguro(sfWebRequest $request) {        
        
        $idreporte = $request->getParameter("idreporte");
        $vlrasegurado=$request->getParameter("vlrasegurado");
        $idmonedavlr=$request->getParameter("idmonedavlr");
        $obtencion_vlr=$request->getParameter("obtencion_vlr");
        $obtencion_mnd=$request->getParameter("obtencion_mnd");
        $neto_vlr=$request->getParameter("neto_vlr");
        $min=$request->getParameter("min");
        $min_mnd=$request->getParameter("min_mnd");
        
        
        $repSeguro = Doctrine::getTable("RepSeguro")->findOneBy("ca_idreporte", $idreporte);
        if (!$repSeguro)
        {
            $repSeguro = new RepSeguro();
            $repSeguro->setCaIdreporte($idreporte);
        }
    
        
        $usuarios = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->select("u.ca_login")
                ->innerJoin("u.UsuarioPerfil up")
                ->where("u.ca_activo=? AND up.ca_perfil=? ", array('TRUE', 'tramitador-de-polizas'))
                ->addOrderBy("u.ca_nombre")
                //->fetchOne();
                ->execute();
        $conta = count($usuarios);
        for ($i = 0; $i < 1; $i++) {
            //$coma = ($i == ($conta - 1)) ? "" : ",";
            $seguro_conf.=$usuarios[$i]->getCaLogin();
        }
        
        

        $repSeguro->setCaSeguroConf($seguro_conf);
        $repSeguro->setCaVlrasegurado($vlrasegurado);
        $repSeguro->setCaIdmonedaVlr($idmonedavlr);
        $repSeguro->setCaObtencionpoliza($obtencion_vlr);
        $repSeguro->setCaIdmonedaPol($obtencion_mnd);        
        $repSeguro->setCaPrimaventa($neto_vlr);
        $repSeguro->setCaMinimaventa($min);        
        $repSeguro->setCaIdmonedaVta($min_mnd);        
        $repSeguro->save();
        
        $reporte=$repSeguro->getReporte();
        if ($vlrasegurado!="" || $obtencion_vlr!="") 
        {
            $reporte->setCaSeguro("Sí");
        } else {
            $reporte->setCaSeguro("No");
        }
        
        $reporte->save();
        
        
        
        $this->responseArray = array("errorInfo" => "", "id" => implode(",", $ids), "idreg" => implode(",", $ids_reg), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosSeguro(sfWebRequest $request) {   
        
        $idreporte = $request->getParameter("idreporte");

        $repseguro = Doctrine::getTable("RepSeguro")->find($idreporte);
        if (!$repseguro) {
            $repseguro = new RepSeguro();
        }
        
        
        $data["notificar"] = $repseguro->getCaSeguroConf();
        $data["vlrasegurado"] = $repseguro->getCaVlrasegurado();
        $data["idmonedavlr"] = $repseguro->getCaIdmonedaVlr();
        $data["obtencion_vlr"] = $repseguro->getCaObtencionpoliza();
        $data["obtencion_mnd"] = $repseguro->getCaIdmonedaPol();
        $data["neto_vlr"] = $repseguro->getCaPrimaventa();
        $data["min"] = $repseguro->getCaMinimaventa();
        $data["min_mnd"] = $repseguro->getCaIdmonedaVta();
        
        $this->responseArray = array("data" => $data, "success" => true);
        $this->setTemplate("responseTemplate");
        
    }
    
    
    
    
    
}

?>

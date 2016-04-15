<?php

/**
 * confirmaciones actions.
 *
 * @package    colsys
 * @subpackage confirmaciones
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class confirmacionesOtmActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->modo = $request->getParameter("modo");
    }

    /**
     * Resultados de la busqueda
     *
     * @param sfRequest $request A request object
     */
    public function executeBusqueda(sfWebRequest $request) {
        $criterio = $request->getParameter("criterio");
        
        $cadena = $request->getParameter("cadena");

        if (!$cadena) {
            $this->redirect("confirmacionesOtm/index");
        }

        $q = Doctrine::getTable("InoMaster")
                ->createQuery("m")
                ->select("m.*")
                ->innerJoin("m.InoHouse h")
                ->where("m.ca_impoexpo = 'OTM-DTA'")
                ->addOrderBy("m.ca_fchreferencia DESC")
                ->distinct()
                ->limit(200);


        switch ($criterio) {
            case "referencia":
                $cadena = str_replace("-", ".", $cadena);
                $q->addWhere("m.ca_referencia like ? ", "%" . $cadena . "%");
                break;
            case "reporte":
                $q->innerJoin("h.Reporte r");
                $q->addWhere("r.ca_consecutivo like ? ", "%" . $cadena . "%");
                break;            
            case "motonave":
                $q->addWhere("m.ca_motonave like ?", array("%" . $cadena . "%"));
                break;
            case "hbl":
                $q->addWhere("h.ca_doctransporte like ?", "%" . $cadena . "%");
                break;
            case "cliente":
                $q->innerJoin("h.Cliente cl");
                $q->addWhere("UPPER(cl.ca_compania) like ? ", strtoupper($cadena) . "%");
                break;
            case "idcliente":
                $q->innerJoin("c.Cliente cl");
                $q->addWhere("cl.ca_idcliente = ? ", $cadena);
                break;
        }

        // Defining initial variables
        $currentPage = $this->getRequestParameter('page', 1);
        $resultsPerPage = 30;

        // Creating pager object
        $this->pager = new Doctrine_Pager(
                $q, $currentPage, $resultsPerPage
        );

        $this->referencias = $this->pager->execute();
        if ($this->pager->getResultsInPage() == 1 && $this->pager->getPage() == 1) {
            $referencias = $this->referencias;
            $this->redirect("confirmacionesOtm/consulta?referencia=" . $referencias[0]->getCaIdmaster());            
        }
        $this->criterio = $criterio;
        $this->cadena = str_replace(".", "-", $cadena);
    }

    /**
     * Muestra  el formulario
     *
     * @param sfRequest $request A request object
     */
    public function executeConsulta(sfWebRequest $request) {

        $referenciaParam = $request->getParameter("referencia");
        $this->referencia = Doctrine::getTable("InoMaster")->find($referenciaParam);
        $this->forward404Unless($this->referencia);

        $this->origen = $this->referencia->getOrigen();
        $this->destino = $this->referencia->getDestino();
        $this->linea = $this->referencia->getIdsProveedor();
        //$this->modo = $request->getParameter("modo");
        $this->coordinadores = array();

        $parametros = ParametroTable::retrieveByCaso("CU046");
        foreach ($parametros as $parametro) {
            $valor = explode("|", $parametro->getCaValor());
            $this->coordinadores[$valor[0]] = $valor[1];
        }

        $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "confirmaciones" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "textos.yml";
        $this->textos = sfYaml::load($config);

        $this->etapas = Doctrine::getTable("TrackingEtapa")
                ->createQuery("t")
                ->where("t.ca_departamento = 'OTM/DTA'")
                ->addOrderBy("t.ca_orden")
                ->execute();

        $q = Doctrine::getTable("InoHouse")
                ->createQuery("h")
                ->select("h.*")
                ->innerJoin("h.Cliente cl")
                ->where("h.ca_idmaster = ?", $this->referencia->getCaIdmaster())
                ->addOrderBy("cl.ca_compania");
        
        $this->inoClientes = $q->execute();
    }

    /**
     * Crea el status
     *
     * @param sfRequest $request A request object
     */
    public function executeCrearStatus(sfWebRequest $request) {
        $referencia = Doctrine::getTable("InoMaster")->find($request->getParameter("idmaster"));
        $this->forward404Unless($referencia);
        $user = sfContext::getInstance()->getUser();
        $ca_referencia = $referencia->getCaReferencia();
        $modo = $request->getParameter("modo");
        $tipo_msg = $request->getParameter("tipo_msg");
        $tipo_fact = $request->getParameter("tipo_fact");
        $oids = $request->getParameter("oid");

        $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "confirmaciones" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "textos.yml";
        $text = sfYaml::load($config);

        $inoClientes = array();

        /*
         * Attachments Principal. Válido para toda la referencia.
         */
        $i=0;
        if (is_uploaded_file($_FILES['attachment']['tmp_name'])) {
            $attachment = $_FILES['attachment'];
        } else {
            $attachment = null;
        }

        if ($attachment) {
            
            $data = array();
            $data["iddocumental"] = 26;            
            $data["ref1"] = $ca_referencia;
            
            $tipDoc = $tipDoc = Doctrine::getTable("TipoDocumental")->find($data['iddocumental']);
            $folder = $tipDoc->getCaDirectorio();   
            
            $directorio = date("Y") . DIRECTORY_SEPARATOR . $folder . $data["ref1"] . "/";
            $fileName = preg_replace('/\s\s+/', ' ', $attachment['name']);
            $fileName=urlencode($fileName);
            $fileName = str_replace("+", " ", $fileName);
            $attachments[] = $directorio . $fileName;
            
        }
        foreach ($oids as $oid) {
            $idcliente = $this->getRequestParameter("idcliente_" . $oid);
            $idhouse = $this->getRequestParameter("idinocliente_".$oid);
            $doctransporte = $this->getRequestParameter("hbls_" . $oid);

            //Archivos que se seleccionan desde el listado de Gestión Documental
            $attachments = array();

            $files = $this->getRequestParameter("files_" . $oid);   

            if($files){
                foreach ($files as $archivo) {
                    $name = str_replace(sfConfig::get('app_digitalFile_root'),"",$archivo);
                    $attachments[] = $name;
                }
            }
            $success = array();
            //Archivo que se adjunta a toda la referencia
            if($i==0){ // Sólo pregunta por éste archivo la primera vez
                if ($attachment) {
                    $success = ArchivosTable::subirDocumento($_FILES['attachment'], $data);
                    if ($success["estado"] != true) {                        
                        echo "<script>alert('El archivo seleccionado en la opción General para toda la referencia no se ha subido correctamente')
                            history.back();
                            </script>";
                        exit;
                    } else {
                        $directory = $success["directory"];
                        $attachments[] = date("Y").DIRECTORY_SEPARATOR.$directory.$fileName;
                        $i++;
                    }
                }
            }else{
                $attachments[] = $directorio.$fileName;
            }

            //Archivo que se adjunta en cada HBL
            if (is_uploaded_file($_FILES['attachment_' . $oid]['tmp_name'])) {
                $attachment2 = $_FILES['attachment_' . $oid];
            } else {
                $attachment2 = null;
            }

            if ($attachment2) {
                $fileName2 = preg_replace('/\s\s+/', ' ', $attachment2['name']);
                $fileName2 = urlencode($fileName2);
                $fileName2 = str_replace("+", " ", $fileName2);
                $data = array();
                $data["iddocumental"] = 26;
                $data["ref1"] = $ca_referencia;
                $data["ref2"] = $doctransporte;                    

                $success = ArchivosTable::subirDocumento($attachment2, $data);

                if ($success["estado"] != true) {
                    echo "<script>alert('El archivo para el Doc.: $doctransporte  no se ha subido correctamente');
                        history.back();
                        </script>";
                    exit;
                }else{
                    $directory = $success["directory"];                        
                    $attachments[] = date("Y").DIRECTORY_SEPARATOR.$directory.$fileName2;
                }
            }

            $options = array();
            $inoCliente = Doctrine::getTable("InoHouse")->find($idhouse);
            $reporteIni = $inoCliente->getReporte();
            $reporte = $reporteIni->getRepUltVersion();

            $status = new RepStatus();
            $status->setCaIdreporte($reporte->getCaIdreporte());
            $status->setCaFchstatus(date("Y-m-d H:i:s"));
            $status->setCaComentarios($this->getRequestParameter("notas"));
            $status->setCaFchenvio(date("Y-m-d H:i:s"));
            $status->setCaUsuenvio($this->getUser()->getUserId());

            if ($request->getParameter("observaciones_idg")) {
               $status->setCaObservacionesIdg($request->getParameter("observaciones_idg"));
            }

            if ($request->getParameter("fchrecibido_" . $oid)) {
                $horaRecibo = $request->getParameter("horarecibido_" . $oid);
                $status->setCaFchrecibo(Utils::parseDate($request->getParameter("fchrecibido_" . $oid), "Y-m-d") . " " . $horaRecibo);
            }

            $status->setCaPiezas($inoCliente->getCaNumpiezas());
            $status->setCaPeso($inoCliente->getCaPeso());
            $status->setCaVolumen($inoCliente->getCaVolumen());
            $status->setCaFchsalida($referencia->getCaFchsalida());
            $status->setCaFchllegada($referencia->getCaFchllegada());
            $status->setCaFchcontinuacion($referencia->getCaFchllegada());
            $status->setCaIdnave($referencia->getCaMotonave());
            $status->setCaDoctransporte($inoCliente->getCaDoctransporte());
            
            $etapa = $this->getRequestParameter("tipo_" . $oid);

            if ($etapa == "IMCOL" && $this->getRequestParameter("modfchllegada_" . $oid)) {
                $status->setCaFchllegada(Utils::parseDate($this->getRequestParameter("fchllegada_" . $oid)));
                $status->setCaFchcontinuacion(Utils::parseDate($this->getRequestParameter("fchllegada_" . $oid)));
            }
            if ($etapa == "IMCOL") {
                $idbodega = $this->getRequestParameter("bodega_" . $oid);
                $status->setProperty("idbodega", $idbodega);
            }
            if ($etapa == "99999") {
                $fchplanilla = $this->getRequestParameter("fchplanilla_" . $oid);
                $status->setProperty("fchplanilla", Utils::parseDate($fchplanilla));
            }
            $status->setCaIdetapa($etapa);
            $mensaje = "\n" . $this->getRequestParameter("mensaje_" . $oid);
                    
            $origen = $reporte->getOrigen()->getCaCiudad();
            $destino = $reporte->getDestino()->getCaCiudad();

            $cliente = $inoCliente->getCliente()->getCaCompania();
            
            $consignatario = $reporte->getConsignatario();
            
            $proveedor = Doctrine::getTable("Tercero")->find($reporte->getCaIdproveedor());
        
            $importador = $reporte->getRepOtm()->getImportador()->getCaNombre(); 
            $comercial = $reporte->getCaLogin();
                    
            if ($comercial == 'consolcargo')
                $options["subject"] = $importador . " / " . $cliente . " [" . $origen . " -> " . $destino . "] " . $reporte->getCaOrdenClie() . "-" . $reporte->getRepOtm()->getCaHbls();
            else{
                if(!$cliente)
                    $cliente = $importador;                
                $proveedor = substr($reporte->getProveedoresStr(), 0, 130);                
                $options["subject"] = $proveedor . " / " . $cliente . " [" . $origen . " -> " . $destino . "] " . $reporte->getCaOrdenClie() . "-" . $reporte->getRepOtm()->getCaHbls();
            }
            
            $options["modo"] = "otm";
            
            $status->setStatus($mensaje);
            

            $destinatarios = array();

            $checkbox = $request->getParameter("em_" . $oid);
            if ($checkbox) {
                foreach ($checkbox as $check) {
                    $destinatarios[] = $request->getParameter("ar_" . $oid . "_" . $check);
                }
            }

            $status->save();
            $status->send($destinatarios, array(), $attachments, $options);

            $this->status = $status;            
            $this->referencia = $referencia;
        }
    }
}
?>
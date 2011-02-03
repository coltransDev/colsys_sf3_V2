<?php

/**
 * antecedentes actions.
 *
 * @package    symfony
 * @subpackage antecedentes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class antecedentesActions extends sfActions {

    private $filetypes = array("MBL", "HBL");

    /**
     * 
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {

    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeBuscarReferencia(sfWebRequest $request) {
        /* Doctrine::getTable("InoMaestraSea")
          ->setAttribute(Doctrine_Core::ATTR_QUERY_LIMIT, Doctrine_Core::LIMIT_ROWS); */

        Doctrine_Core::getTable('InoMaestraSea')->setAttribute(Doctrine_Core::ATTR_QUERY_LIMIT, Doctrine_Core::LIMIT_ROWS);

        $q = Doctrine::getTable("InoMaestraSea")
                        ->createQuery("m")
                        ->select("m.*")
                        ->innerJoin('m.InoClientesSea ic')                        
                        ->addWhere("m.ca_provisional = ?", true);


        $q->distinct();
        $criterio = $this->getRequestParameter("criterio");
        $cadena = trim($this->getRequestParameter("cadena"));

        switch ($criterio) {
            case "reporte":
                $q->innerJoin('ic.Reporte r');
                $q->addWhere("r.ca_consecutivo like ?", $cadena . "%");
                break;
            case "referencia":
                $q->addWhere("m.ca_referencia like ?", $cadena . "%");
                break;
            case "hbl":
                $q->addWhere("ic.ca_hbls like ?", $cadena . "%");
                break;
            case "cliente":
                $q->innerJoin("ic.Cliente cl");
                $q->addWhere("lower(cl.ca_compania) like ?", "%". strtolower($cadena) ."%");
                break;
        }


        $currentPage = $this->getRequestParameter('page', 1);
        $resultsPerPage = 30;

        $this->referencias = $q->execute();
        // Creating pager object
        /* $this->pager = new Doctrine_Pager(
          $q,
          $currentPage,
          $resultsPerPage
          );

          $this->referencias = $this->pager->execute();
          if ($this->pager->getResultsInPage() == 1 && $this->pager->getPage() == 1) {
          $cotizaciones = $this->cotizaciones;
          $this->redirect("antecedentes/verPlanilla?ref=" . str_replace(".", "|", $this->referencias[0]->getCaReferencia()));
          } */
        $this->criterio = $criterio;
        $this->cadena = $cadena;
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeListadoReferencias(sfWebRequest $request) {

        $q = Doctrine::getTable("InoMaestraSea")
                        ->createQuery("m")
                        ->select("m.*")
                        ->addWhere("m.ca_fchreferencia>=?", "2011-01-01")
                        ->innerJoin('m.InoClientesSea ic')
                        ->innerJoin('ic.Reporte r')
                        ->addWhere("m.ca_provisional = ? OR (m.ca_provisional = ? AND ca_fchmuisca IS NULL)", array(true,false));

        $q->distinct();
        $this->referencias = $q->execute();

        $this->format = $this->getRequestParameter("format");
    }

    /**
     * Genra la referencia y las hijas con la información de los reportes.
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarPanelMasterAntecedentes(sfWebRequest $request) {

        $conn = Doctrine::getTable("InoMaestraSea")->getConnection();
        $conn->beginTransaction();
        try {
            $impoexpo = utf8_decode($request->getParameter("impoexpo"));
            $this->forward404Unless($impoexpo);
            $transporte = utf8_decode($request->getParameter("transporte"));
            $this->forward404Unless($transporte);
            $modalidad = utf8_decode($request->getParameter("modalidad"));
            $this->forward404Unless($modalidad);
            $idorigen = $request->getParameter("idorigen");
            $this->forward404Unless($idorigen);
            $iddestino = $request->getParameter("iddestino");
            $this->forward404Unless($iddestino);
            $fchsalida = $request->getParameter("fchsalida");
            $this->forward404Unless($fchsalida);
            $fchllegada = $request->getParameter("fchllegada");
            $this->forward404Unless($fchllegada);
            $motonave = $request->getParameter("motonave");
            $this->forward404Unless($motonave);
            $mbls = $request->getParameter("mbls");
            $this->forward404Unless($mbls);
            $viaje = $request->getParameter("viaje");
            $fchmaster = $request->getParameter("fchmaster");

            $idlinea = ($request->getParameter("idlinea")?$request->getParameter("idlinea"):"0");
            //$idlinea = 0;

            $mmRef = Utils::parseDate($fchllegada, "m");
            $aaRef = substr(Utils::parseDate($fchllegada, "Y"), -1, 1);
            if (Utils::parseDate($fchllegada, "d") >= "26") {
                $mmRef = $mmRef + 1;
                if ($mmRef >= 13) {
                    $mmRef = "01";
                    $aaRef = $aaRef + 1;
                }
            }

            $numref = str_replace("|", ".", $request->getParameter("referencia"));

            if ($numref) {
                $master = Doctrine::getTable("InoMaestraSea")->find($numref);
                $this->forward404Unless($master);
            } else {
                $master = new InoMaestraSea();
                $numref = InoMaestraSeaTable::getNumReferencia($impoexpo, $transporte, $modalidad, $idorigen, $iddestino, $mmRef, $aaRef);
                $master->setCaReferencia($numref);
            }
            $master->setCaImpoexpo($impoexpo);
            $master->setCaModalidad($modalidad);
            $master->setCaOrigen($idorigen);
            $master->setCaDestino($iddestino);
            $master->setCaMotonave($motonave);
            $master->setCaFchembarque($fchsalida);
            $master->setCaFcharribo($fchllegada);
            $master->setCaFchreferencia($fchllegada);
            $master->setCaIdlinea($idlinea);
            $master->setCaMbls($mbls."|".$fchmaster);
            $master->setCa_ciclo($viaje);
            $master->setCaProvisional(true);

            $master->save($conn);

            $q = $conn->createQuery()
                            ->delete("ic.*")
                            ->from('InoClientesSea ic')
                            ->addWhere("ic.ca_referencia = ? ", $numref);
            $q->execute();

            $consecutivos = array_unique(explode("|", $request->getParameter("reportes")));
            $imprimir = array_unique(explode("|", $request->getParameter("imprimirorigen")));
            $i = 0;
            for($i=0;$i<count($consecutivos);$i++) {
                $consecutivo=$consecutivos[$i];
                $reporte = ReporteTable::retrieveByConsecutivo($consecutivo);
                if ($reporte) {

                    $proveedores = $reporte->getProveedores();
                    foreach ($proveedores as $proveedor) {
                        $status = $reporte->getUltimoStatus();
                        if ($status && $status->getCaDoctransporte()) {
                            $inoCliente = new InoClientesSea();
                            $inoCliente->setCaIdreporte($reporte->getCaIdreporte());
                            $inoCliente->setCaReferencia($numref);
                            $inoCliente->setCaIdcliente($reporte->getCliente()->getCaIdcliente());

                            $inoCliente->setCaHbls($status->getCaDoctransporte());
                            $inoCliente->setCaIdproveedor($proveedor->getCaIdtercero());
                            $inoCliente->setCaProveedor($proveedor->getCaNombre());
                            $piezas = explode("|", $status->getCaPiezas());
                            $inoCliente->setCaNumpiezas($piezas[0] ? $piezas[0] : 0);
                            $peso = explode("|", $status->getCaPeso());
                            $inoCliente->setCaPeso($peso[0] ? $peso[0] : 0);
                            $volumen = explode("|", $status->getCaVolumen());
                            $inoCliente->setCaVolumen($volumen[0] ? $volumen[0] : 0);
                            $inoCliente->setCaNumorden($reporte->getCaOrdenClie());

                            $inoCliente->setCaImprimirorigen($imprimir[$i]);                            

                            $inoCliente->setCaLogin($reporte->getCaLogin());
                            $inoCliente->save($conn);
                        }
                    }
                }
            }
            //$conn->rollBack();
            $conn->commit();
            $this->responseArray = array("success" => true, "numref" => $numref);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * 
     *
     * @param sfRequest $request A request object
     */
    public function executeAsignacionMaster(sfWebRequest $request) {

        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/CheckColumn",'last');


        $this->numReferencia = $request->getParameter("numReferencia");

        $numref = str_replace("|", ".", $request->getParameter("ref"));

        if ($numref) {
            $ref = Doctrine::getTable("InoMaestraSea")
                            ->createQuery("m")
                            ->addWhere("m.ca_referencia = ? ", $numref)
                            ->fetchOne();

            $this->forward404Unless($ref);
        } else {
            $ref = new InoMaestraSea();
        }

        $this->ref = $ref;


        $this->numRef = $numref;
    }

    /*
     * Panel que muestra un arbol con opciones de busqueda
     * @author: Andres Botero
     */

    public function executeDatosReferencia($request) {

        $this->forward404Unless($request->getParameter("numRef"));
        $numRef = $request->getParameter("numRef");
        $ref = Doctrine::getTable("InoMaestraSea")->find($numRef);
        $this->forward404Unless($ref);




        $data = array();

        $data["referencia"] = $ref->getCaReferencia();
        $data["motonave"] = $ref->getCaMotonave();
        $data["impoexpo"] = utf8_encode(Constantes::IMPO);
        $data["transporte"] = utf8_encode(Constantes::MARITIMO);
        $data["modalidad"] = $ref->getCaModalidad();
        $data["origen"] = $ref->getOrigen()->getCaCiudad();
        $data["idorigen"] = $ref->getCaOrigen();
        $data["destino"] = $ref->getDestino()->getCaCiudad();
        $data["iddestino"] = $ref->getCaDestino();
        $data["fchsalida"] = $ref->getCaFchembarque();
        $data["fchllegada"] = $ref->getCaFcharribo();
        $data["idlinea"] = $ref->getCaIdlinea();

        $arrMbls = explode("|", $ref->getCaMbls());
        $data["mbls"] = $arrMbls[0];
        if($arrMbls[1])
            $data["fchmaster"] = $arrMbls[1];

        $data["viaje"] = $ref->getCaCiclo();

        $data["linea"] = $ref->getIdsProveedor()->getIds()->getCaNombre();

        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    /**
     * 
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosPanelReportesAntecedentes(sfWebRequest $request) {

        $numRef = $request->getParameter("numRef");
        if ($numRef) {
            $q = Doctrine_Query::create()
                ->select("ic.*, c.ca_idcliente, cl.ca_compania, r.ca_consecutivo, r.ca_idreporte")
                ->from('InoClientesSea ic')
                ->innerJoin('ic.Cliente cl')
                ->leftJoin('ic.Reporte r')
                ->addWhere("ic.ca_referencia = ? ", $numRef)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

            $reportes = $q->execute();

            foreach ($reportes as $key => $val) {
                $reportes[$key]["cl_ca_compania"] = utf8_encode($reportes[$key]["cl_ca_compania"]);
                $reportes[$key]["ic_ca_hbls"] = utf8_encode($reportes[$key]["ic_ca_hbls"]);
                $reportes[$key]["orden"] = $reportes[$key]["r_ca_consecutivo"];
                $reportes[$key]["sel"] = $reportes[$key]["ic_ca_imprimirorigen"];
            }
        } else {
            $reportes = array();
        }

        $reportes[] = array("r_ca_consecutivo" => "+", "cl_ca_compania" => "", "orden" => "Z");

        $this->responseArray = array("success" => true, "total" => count($reportes), "root" => $reportes);

        $this->setTemplate("responseTemplate");
    }

    /**
     * 
     *
     * @param sfRequest $request A request object
     */
    public function executeAsignarMaster(sfWebRequest $request) {


        $this->setTemplate("responseTemplate");



        try {

            $master = $request->getParameter("master");
            $this->forward404Unless($master);

            $assign = $request->getParameter("assign");


            $data = $request->getParameter("data");
            $this->forward404Unless($data);
            $data = explode(",", $data);

            $reportes = Doctrine::getTable("Reporte")
                            ->createQuery("r")
                            ->whereIn("r.ca_idreporte", $data)
                            ->execute();


            foreach ($reportes as $reporte) {
                if ($assign == "true") {
                    $reporte->setCaMaster($master);
                } else {
                    $reporte->setCaMaster(null);
                }
                $reporte->save();
            }


            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeVerPlanilla(sfWebRequest $request) {

        $numref = str_replace("|", ".", $request->getParameter("ref"));
        $format = $request->getParameter("format");

        $this->forward404Unless($numref);

        $ref = Doctrine::getTable("InoMaestraSea")->find($numref);
        $this->forward404Unless($ref);

        $this->hijas = Doctrine::getTable("InoClientesSea")
                        ->createQuery("c")
                        ->where("c.ca_referencia = ?", $numref)
                        ->execute();

        if ($format == "email") {

            foreach ($this->hijas as $hija) {
                $reporte = $hija->getReporte();
                if ($reporte) {
                    $tarea = $reporte->getNotTareaAntecedente();
                    if ($tarea) {
                        $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
                        $tarea->setCaUsuterminada($this->getUser()->getuserId());
                        $tarea->save();
                    }
                }
            }


            $this->setLayout($format);
        }
        $this->ref = $ref;
        $this->user = $this->getUser();
        $this->format = $format;

        $this->emails = Doctrine::getTable("Email")
                        ->createQuery("e")
                        ->addWhere("ca_subject like ?", "%" . $numref . "%")
                        ->addOrderBy("e.ca_fchenvio DESC")
                        ->execute();

        

        $usuarios = Doctrine::getTable("Usuario")
                        ->createQuery("u")
                        ->addWhere("u.ca_departamento = ?", "Marítimo")
                        ->addOrderBy("u.ca_email")
                        ->execute();
        $contactos = array();
        foreach ($usuarios as $usuario) {
            if ($usuario->getCaEmail() != "-") {
                $contactos[] = $usuario->getCaEmail();
            }
        }

        $this->contactos = implode(",", $contactos);
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeEnviarAntecedentes(sfWebRequest $request) {
        $user = $this->getUser();


        $this->numRef = str_replace("|", ".", $request->getParameter("ref"));

        $email = new Email();

        $email->setCaUsuenvio($user->getUserId());
        $email->setCaTipo("Antecedentes"); //Envío de Avisos
        $email->setCaIdcaso(null);

        $from = $this->getRequestParameter("from");
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
        $request->setParameter("format", "email");
        $mensaje .= sfContext::getInstance()->getController()->getPresentationFor('antecedentes', 'verPlanilla');
        $email->setCaBodyhtml($mensaje);
        $email->save();


        $folder = "Antecedentes" . DIRECTORY_SEPARATOR . $this->numRef;
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;

        if (!is_dir($directory)) {
            @mkdir($directory, DEFAULT_PRIVILEGES, true);
        }


        $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);

        $fileTypes = $this->filetypes;
        foreach ($fileTypes as $fileType) {

            foreach ($archivos as $archivo) {
                if (substr(basename($archivo), 0, strlen($fileType)) == $fileType) {
                    $name = str_replace(sfConfig::get('app_digitalFile_root'), "", $archivo);
                    $email->AddAttachment($name);
                }
            }
        }

        $email->save();
        $email->send();
    }

    /*
     * Buscar una referencia de Aduana para el módulo de Falabella
     */

    public function executeListaReportesJSON() {
        $criterio = trim($this->getRequestParameter("query"));
        $queryType = trim($this->getRequestParameter("queryType"));

        if ($criterio) {

           // $transporte = $this->getRequestParameter("transporte");
            /* Doctrine::getTable("Cliente")
              ->setAttribute(Doctrine_Core::ATTR_QUERY_LIMIT, Doctrine_Core::LIMIT_ROWS);
              Doctrine::getTable("Contacto")
              ->setAttribute(Doctrine_Core::ATTR_QUERY_LIMIT, Doctrine_Core::LIMIT_ROWS);
              Doctrine::getTable("InoClientesSea")
              ->setAttribute(Doctrine_Core::ATTR_QUERY_LIMIT, Doctrine_Core::LIMIT_ROWS);
              Doctrine::getTable("Reporte")
              ->setAttribute(Doctrine_Core::ATTR_QUERY_LIMIT, Doctrine_Core::LIMIT_ROWS);
              Doctrine::getTable("RepStatus")
              ->setAttribute(Doctrine_Core::ATTR_QUERY_LIMIT, Doctrine_Core::LIMIT_ROWS);
              Doctrine::getTable("Usuario")
              ->setAttribute(Doctrine_Core::ATTR_QUERY_LIMIT, Doctrine_Core::LIMIT_ROWS);
              Doctrine::getTable("Ciudad")
              ->setAttribute(Doctrine_Core::ATTR_QUERY_LIMIT, Doctrine_Core::LIMIT_ROWS); */

            $q = Doctrine_Query::create()
                            /* ->select("r.ca_idreporte, r.ca_consecutivo,r.ca_version ,o.ca_ciudad, d.ca_ciudad, o.ca_idciudad, d.ca_idciudad,o.ca_idtrafico, d.ca_idtrafico, r.ca_mercancia_desc,
                              r.ca_idlinea, r.ca_impoexpo, r.ca_transporte, r.ca_modalidad, r.ca_incoterms, con.ca_idcontacto, con.ca_nombres, con.ca_papellido, con.ca_sapellido, con.ca_cargo
                              ,cl.ca_idcliente, cl.ca_compania, cl.ca_preferencias, cl.ca_confirmar, cl.ca_coordinador, usu.ca_login, usu.ca_nombre, r.ca_orden_clie, r.ca_idetapa, ic.ca_referencia") */
                            ->select("r.*, o.*, d.*, con.*, cl.*")
                            ->from("Reporte r")
                            ->innerJoin("r.RepStatus s")
                            ->innerJoin("r.Origen o")
                            ->innerJoin("r.Destino d")
                            ->innerJoin("r.Contacto con")
                            ->innerJoin("con.Cliente cl")
                            //->leftJoin("cl.LibCliente libcli")
                            ->leftJoin('r.InoClientesSea ic')
                            
                            ->addWhere("r.ca_usuanulado IS NULL")
                            ->addWhere("ic.ca_referencia IS NULL")
                            ->addWhere("s.ca_doctransporte IS NOT NULL")
                            ->addWhere("r.ca_impoexpo = ? OR r.ca_impoexpo = ?", array(Constantes::IMPO, Constantes::TRIANGULACION))
                            ->addWhere("r.ca_transporte = ? ", Constantes::MARITIMO)
                            ->addWhere("r.ca_idetapa != ?", "99999");


            if( $queryType == "hbl" ){
                $q->addWhere("UPPER(s.ca_doctransporte) LIKE ?", "%".strtoupper($criterio) . "%");
            }else{
                $q->addWhere("r.ca_consecutivo LIKE ?", $criterio . "%");
            }

            $modalidad = $this->getRequestParameter("modalidad");
            if ($modalidad) {
                $q->addWhere("r.ca_modalidad = ?", utf8_decode($modalidad));
            }

            $origen = $this->getRequestParameter("origen");
            if ($origen) {
                $q->addWhere("r.ca_origen = ?", $origen);
            }

            $destino = $this->getRequestParameter("destino");
            if ($destino) {
                $q->addWhere("r.ca_destino = ?", $destino);
            }



            //$q->addOrderBy("to_number(SUBSTR(r.ca_consecutivo , 1 , (POSITION('-' in r.ca_consecutivo)-1) ),'999999')  desc");
            $q->addOrderBy("r.ca_consecutivo desc");
            $q->addOrderBy("r.ca_version  desc");
            //$q->orderBy("r.ca_fchcreado desc");
            //$q->limit(50);
            $q->distinct();
            $reportes = $q->execute();
            //echo $q->getSqlQuery();

            $result = array();

            foreach ($reportes as $reporte) {
                if (!$reporte->esUltimaVersion()) {
                    continue;
                }
                if ($reporte->getInoClientesSea()) {
                    continue;
                }

                $status = $reporte->getUltimoStatus();
                $row = array();
                if( $status && $status->getCaDoctransporte() ){
                    $row["r_ca_idreporte"] = $reporte->getCaIdreporte();
                    $row["r_ca_consecutivo"] = $reporte->getCaConsecutivo();
                    $row["r_ca_version"] = $reporte->getCaVersion();
                    $row["o_ca_ciudad"] = $reporte->getOrigen()->getCaCiudad();
                    $row["d_ca_ciudad"] = $reporte->getDestino()->getCaCiudad();
                    $row["r_ca_mercancia_desc"] = utf8_encode($reporte->getCaMercanciaDesc());
                    $row["r_ca_impoexpo"] = utf8_encode($reporte->getCaImpoexpo());
                    $row["r_ca_transporte"] = utf8_encode($reporte->getCaTransporte());
                    $row["cl_ca_compania"] = utf8_encode($reporte->getCliente()->getCaCompania());
                    $row["r_ca_orden_clie"] = utf8_encode($reporte->getCaOrdenClie());
                    $row["r_ca_idlinea"] = utf8_encode($reporte->getCaIdlinea());
                    $row["ic_ca_referencia"] = utf8_encode($reporte->getInoClientesSea() ? $reporte->getInoClientesSea()->getCaReferencia() : null);
                    $row["s_ca_doctransporte"] = utf8_encode($status->getCaDoctransporte());
                    $result[] = $row;
                }
               
            }
            $this->responseArray = array("total" => count($result), "root" => $result, "success" => true);
        } else {
            $this->responseArray = array("root" => array(), "total" => 0, "success" => true);
        }
        //print_r($reportes);
        $this->setTemplate("responseTemplate");
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeAceptarReferencia(sfWebRequest $request) {

        $numref = str_replace("|", ".", $request->getParameter("ref"));
        $this->forward404Unless($numref);
        $ref = Doctrine::getTable("InoMaestraSea")->find($numref);
        $this->forward404Unless($ref);
        $ref->setCaProvisional(false);
        $ref->save();
        $this->redirect("/colsys_php/inosea.php?boton=Consultar&id=" . $ref->getcaReferencia());
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeVerArchivos(sfWebRequest $request) {
        $numref = str_replace("|", ".", $request->getParameter("ref"));
        
        $this->ref = Doctrine::getTable("InoMaestraSea")->find($numref);
        $this->forward404Unless($this->ref);

        $this->numref = $numref;
    }


}

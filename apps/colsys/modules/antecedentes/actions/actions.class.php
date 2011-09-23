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

    const RUTINA = 104;
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
        if($this->getRequestParameter("reporte"))
        {
            $criterio = "reporte";
            $cadena = trim($this->getRequestParameter("reporte"));
        }
        else
        {
            $criterio = $this->getRequestParameter("criterio");
            $cadena = trim($this->getRequestParameter("cadena"));
        }

        switch ($criterio) {
            case "reporte":
                $q->innerJoin('ic.Reporte r');
                $q->addWhere("r.ca_consecutivo like ?", "%".$cadena . "%");
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
            case "motonave":
                $q->addWhere("m.ca_motonave like ?", $cadena . "%");
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
        //error_reporting(E_ALL);        
        $this->user=$this->getUser();
        $this->nivel = $this->user->getNivelAcceso( antecedentesActions::RUTINA );
        //echo $this->nivel;
        $this->format = $this->getRequestParameter("format");        

        $where="";
        if($this->format=="")
        {
            $where = " and (m.ca_provisional = true and ((m.ca_modalidad='".constantes::FCL."' and u.ca_idsucursal='".$this->user->getIdSucursal()."') or m.ca_modalidad<>'".constantes::FCL."') )  
                and COALESCE(strpos((SELECT ca_subject FROM tb_emails where ca_tipo='Antecedentes' and ca_subject like '%'||m.ca_referencia||'%' order by ca_idemail DESC limit 1), 'Envio de Antecedentes'),-1)<=0";            
        }
        else
        {
            $where =" and ( (m.ca_provisional = true and ((m.ca_modalidad='".constantes::FCL."' and u.ca_idsucursal='".$this->user->getIdSucursal()."') or m.ca_modalidad<>'".constantes::FCL."') 
                and strpos((SELECT ca_subject FROM tb_emails where ca_tipo='Antecedentes' and ca_subject like '%'||m.ca_referencia||'%' order by ca_idemail DESC limit 1), 'Envio de Antecedentes')>0
                ) OR (m.ca_provisional = false AND m.ca_fchmuisca IS NULL and SUBSTR(ca_referencia,1,3) NOT IN ('700','710','720') ))";
            $whereEmail="" ;
        }
        
        $sql="select m.ca_referencia,m.ca_fchreferencia,m.ca_provisional,m.ca_modalidad,m.ca_motonave,m.ca_fchembarque,m.ca_fcharribo,m.ca_usucreado,ori.ca_ciudad as ca_ciu_origen,des.ca_ciudad as ca_ciu_destino,u.ca_idsucursal,m.ca_fchmuisca
                ,COALESCE(strpos((SELECT ca_subject FROM tb_emails where ca_tipo='Antecedentes' and ca_subject like '%'||m.ca_referencia||'%' order by ca_idemail DESC limit 1), 'Envio de Antecedentes'),-1) as refbloqueada
                from tb_inomaestra_sea m
                JOIN tb_ciudades ori ON ori.ca_idciudad = m.ca_origen
                JOIN tb_ciudades des ON des.ca_idciudad = m.ca_destino
                JOIN control.tb_usuarios u ON u.ca_login = m.ca_usucreado
                where m.ca_fchreferencia>='2011-03-01' $where order by m.ca_referencia "  ;
            
            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $referencias = $st->fetchAll();

        $this->refBloqueadas=array();
        $this->refRechazadas=array();
        $this->refSinMuisca=array();
        foreach($referencias as $ref)
        {
            if( trim($ref["ca_provisional"])=="1" )
            {

                if($this->format=="maritimo" )
                {
                    $this->refBloqueadas[]=$ref;
                }
                else
                {
                    if( $ref["refbloqueada"]<0 )
                        $this->refBloqueadas[]=$ref;
                    else 
                        $this->refRechazadas[]=$ref;
                    
                }                
            }
            else
            {
                $this->refSinMuisca[]=$ref;
            }
        }

        $this->sucursal=$this->user->getIdSucursal();

        $this->login=$this->user->getUserId();
        /*if($this->sucursal=="BOG")
        {              
            $sql="select m.ca_referencia,m.ca_modalidad,m.ca_motonave,m.ca_fchembarque,m.ca_fcharribo,m.ca_usucreado,ori.ca_ciudad ca_ciu_origen,des.ca_ciudad ca_ciu_destino
                from tb_inomaestra_sea m
                JOIN tb_ciudades ori ON ori.ca_idciudad = m.ca_origen
                JOIN tb_ciudades des ON des.ca_idciudad = m.ca_destino
                where m.ca_fchmuisca is not null and m.ca_carpeta=false";
            
            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->refcarpetas = $st->fetchAll();

        }*/

        $this->sufijos = ParametroTable::retrieveByCaso("CU010");

        
    }

    /**
     * Genra la referencia y las hijas con la información de los reportes.
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarPanelMasterAntecedentes(sfWebRequest $request) {

        $this->user=$this->getUser();
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
            $master->setCaMbls($mbls);
            $master->setCaFchmbls($fchmaster);
            $master->setCa_ciclo($viaje);
            $master->setCaProvisional(true);
            if($this->user->getIdSucursal()=="BOG")
                $master->setCaCarpeta(true);

            $master->save($conn);

            $q = $conn->createQuery()
                            ->delete("ic.*")
                            ->from('InoClientesSea ic')
                            ->addWhere("ic.ca_referencia = ? ", $numref);
            $q->execute();
            $kk=count(explode("|", $request->getParameter("reportes")));
            $consecutivos = array_unique(explode("|", $request->getParameter("reportes")));
            $imprimir = (explode("|", $request->getParameter("imprimirorigen")));
            $i = 0;            
            
            for($i=0;$i<$kk;$i++) {
                if(!isset($consecutivos[$i]))
                    continue;
                $consecutivo=$consecutivos[$i];                
                $reporte = ReporteTable::retrieveByConsecutivo($consecutivo);
                
                if ($reporte) {
                    
                    $proveedores = $reporte->getProveedores();
                    foreach ($proveedores as $proveedor) {
                        $status = $reporte->getUltimoStatus();
                        if ($status && $status->getCaDoctransporte()) {
                            $inoCliente = Doctrine::getTable("InoClientesSea")->find(array($numref, $reporte->getCliente()->getCaIdcliente(), $status->getCaDoctransporte() ));
                            if(!$inoCliente)
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
                            $inoCliente->setCaImprimirorigen((isset($imprimir[$i]) )?$imprimir[$i]:false);
                            $inoCliente->setCaLogin($reporte->getCaLogin());

                            $inoCliente->setCaContinuacion($reporte->getCaContinuacion());
                            $inoCliente->setCaContinuacionDest($reporte->getCaContinuacionDest());
                            $inoCliente->setCaFchhbls($fchmaster);
                            
                            $idbodega=$reporte->getTerceroBodega();
                            if($reporte->getCaContinuacion()=="OTM" && $idbodega>0)
                            {
                                $inoCliente->setCaIdbodega($reporte->getTerceroBodega());
                            }
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
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()).".bog:".$idbodega);
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

        $data["referencia"] =   $ref->getCaReferencia();
        $data["motonave"]   =   $ref->getCaMotonave();
        $data["impoexpo"]   =   utf8_encode(Constantes::IMPO);
        $data["transporte"] =   utf8_encode(Constantes::MARITIMO);
        $data["modalidad"]  =   $ref->getCaModalidad();
        $data["origen"]     =   $ref->getOrigen()->getCaCiudad();
        $data["idorigen"]   =   $ref->getCaOrigen();
        $data["destino"]    =   $ref->getDestino()->getCaCiudad();
        $data["iddestino"]  =   $ref->getCaDestino();
        $data["fchsalida"]  =   $ref->getCaFchembarque();
        $data["fchllegada"] =   $ref->getCaFcharribo();
        $data["idlinea"]    =   $ref->getCaIdlinea();

//        $ref->getCaMbls();
        $data["mbls"] = $ref->getCaMbls();
        //if($arrMbls[1])
            $data["fchmaster"] = $ref->getCaFchmbls();

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


//        echo($ref->getCountEmails());

        $this->hijas = Doctrine::getTable("InoClientesSea")
                        ->createQuery("c")
                        ->where("c.ca_referencia = ?", $numref)
                        ->execute();

        if ($format == "email") {            

            $this->setLayout($format);
        }
        $this->ref = $ref;
        $this->user = $this->getUser();
        $this->format = $format;

        $this->emails = $ref->getEmails();



        $usuarios = Doctrine::getTable("Usuario")
                        ->createQuery("u")
                        ->addWhere("u.ca_departamento = ? and u.ca_activo=true or (u.ca_login =? or u.ca_login =? or u.ca_login =? ) ", array("Marítimo","nmrey","mflecompte","mjortiz"))
                        ->addOrderBy("u.ca_email")
                        ->execute();
        $contactos = array();
        foreach ($usuarios as $usuario) {
            if ($usuario->getCaEmail() != "-") {
                $contactos[] = $usuario->getCaEmail();
            }
        }

        $this->contactos = implode(",", $contactos);

        $folder = "Referencias" . DIRECTORY_SEPARATOR . $this->ref->getCaReferencia();
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;
        $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);

        foreach ($archivos as $archivo) {
            $file=explode("/", $archivo);
            $filenames[]["file"] = $file[count($file)-1];
        }
        $this->filenames = $filenames;
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
        //$email->addTo($user->getEmail());

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

//        $folder = "Antecedentes" . DIRECTORY_SEPARATOR . $this->numRef;
//        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;

/*        if (!is_dir($directory)) {
            @mkdir($directory, DEFAULT_PRIVILEGES, true);
        }
*/
/*        $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);

        $fileTypes = $this->filetypes;
        foreach ($fileTypes as $fileType) {
            foreach ($archivos as $archivo) {
                if (substr(basename($archivo), 0, strlen($fileType)) == $fileType) {
                    $name = str_replace(sfConfig::get('app_digitalFile_root'), "", $archivo);
                    $email->AddAttachment($name);
                }
            }
        }
 *
 */
/*
        $folder = "Referencias" . DIRECTORY_SEPARATOR . $this->numRef;
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;

        if (!is_dir($directory)) {
            @mkdir($directory, DEFAULT_PRIVILEGES, true);
        }


        $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);
        echo print_r($archivos);
exit;
 *
 */
/*        $filenames = array();

        $fileTypes = $this->filetypes;



        foreach ($archivos as $archivo) {
            $file=explode("/", $archivo);
            $filenames[]["file"] = $file[count($file)-1];
        }

        $this->folder = $folder;
        $this->filenames = $filenames;

  */

        $email->save();
        $email->send();
    }

    /*
     * Buscar una referencia de Aduana para el módulo de Falabella
     */

    public function executeListaReportesJSON() {
        $criterio = trim($this->getRequestParameter("query"));
        $queryType = trim($this->getRequestParameter("queryType"));
        //echo $criterio;

        if ($criterio) {

            $modalidad = $this->getRequestParameter("modalidad");
            $origen = $this->getRequestParameter("origen");
            $destino = $this->getRequestParameter("destino");
            $q = Doctrine_Query::create()
                            ->select("r.ca_consecutivo,r.ca_idreporte,r.ca_version,r.ca_idconcliente,
                                r.ca_usuanulado,r.ca_transporte,r.ca_impoexpo, con.ca_idcontacto,con.ca_idcliente, cl.ca_idcliente,cl.ca_compania")
                            ->from("Reporte r")
                            ->leftJoin("r.RepStatus s")
                            ->innerJoin("r.Contacto con")
                            ->innerJoin("con.Cliente cl")                    
                            ->leftJoin('r.InoClientesSea ic')
                            ->addWhere("r.ca_usuanulado IS NULL")
                            ->addWhere("ic.ca_referencia IS NULL")
                            ->addWhere("s.ca_doctransporte IS NOT NULL")
                            ->addWhere("r.ca_impoexpo = ? OR r.ca_impoexpo = ?", array(Constantes::IMPO, Constantes::TRIANGULACION))
                            ->addWhere("r.ca_transporte = ? ", Constantes::MARITIMO)
                            ->addWhere("r.ca_idetapa != ?", "99999")
                            ->addWhere("r.ca_consecutivo in 
                                (SELECT ca_consecutivo FROM Reporte
                                INNER JOIN r.Origen o
                                WHERE ca_modalidad=? AND o.ca_idtrafico=? AND ca_destino=? )  ",array(utf8_decode($modalidad),$origen,$destino));

            if( $queryType == "hbl" ){
                $q->addWhere("UPPER(s.ca_doctransporte) LIKE ?", "%".strtoupper($criterio) . "%");
                //$q->addWhere("r.ca_modalidad=? and ca_destino=?",array(utf8_decode($modalidad),$destino));
            }else{
                $q->addWhere("r.ca_consecutivo LIKE ?", $criterio . "%");
            }

            $q->addOrderBy("r.ca_consecutivo desc");
            $q->addOrderBy("r.ca_version  desc");
            $q->distinct();
            //echo $q->getSqlQuery();
            $reportes = $q->execute();
            $result = array();
            $conse="";
            foreach ($reportes as $reporte) {
                /*if (!$reporte->esUltimaVersion()) {
                    //echo "1.1";
                    continue;
                }*/
                if ($reporte->getInoClientesSea()) {
                   // echo "2.1";
                    continue;
                }

                $status = $reporte->getUltimoStatus();
                
                $row = array();
                if( $status && $status->getCaDoctransporte() && $reporte->getCaConsecutivo()!=$conse ){

                    $row["r_ca_idreporte"] = $reporte->getCaIdreporte();
                    $row["r_ca_consecutivo"] = $reporte->getCaConsecutivo();
                    $row["r_ca_version"] = $reporte->getCaVersion();
                    $row["r_ca_impoexpo"] = utf8_encode($reporte->getCaImpoexpo());
                    $row["r_ca_transporte"] = utf8_encode($reporte->getCaTransporte());
                    $row["cl_ca_compania"] = utf8_encode($reporte->getCliente()->getCaCompania());                                        
                    $row["ic_ca_referencia"] = utf8_encode($reporte->getInoClientesSea() ? $reporte->getInoClientesSea()->getCaReferencia() : null);
                    $row["s_ca_doctransporte"] = utf8_encode($status->getCaDoctransporte());
                    $result[] = $row;
                }
                $conse=$reporte->getCaConsecutivo();
            }
            $this->responseArray = array("total" => count($result), "root" => $result, "success" => true);
        } else {
            $this->responseArray = array("root" => array(), "total" => 0, "success" => true);
        }
        //print_r($reportes);
        //exit;
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

        $this->hijas = Doctrine::getTable("InoClientesSea")
                        ->createQuery("c")
                        ->where("c.ca_referencia = ?", $numref)
                        ->execute();

        //if ($format == "email") {

            foreach ($this->hijas as $hija) {
                $reporte = $hija->getReporte();
                if ($reporte) {
                    if($reporte->getCaIdtareaAntecedente()>0)
                    {
                        $tarea = $reporte->getNotTareaAntecedente();
                        if ($tarea) {
                            $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
                            $tarea->setCaUsuterminada($this->getUser()->getuserId());
                            $tarea->save();
                        }
                    }                    
                }
                $hija->setCaFchantecedentes(date("Y-m-d H:i:s"));
                $hija->stopBlaming();
                $hija->save();
            }
//            $this->setLayout($format);
//        }
        $this->redirect("/colsys_php/inosea.php?boton=Modificar&id=" . $ref->getcaReferencia());
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

     /**
     *
     *
     * @param sfRequest $request A request object
     */

    public function executeRechazarReferencia(sfWebRequest $request) {
        try{
            $user = $this->getUser();

            $this->numRef = str_replace("|", ".", $request->getParameter("ref"));

            $email = new Email();

            $email->setCaUsuenvio($user->getUserId());
            $email->setCaTipo("Antecedentes"); //Envío de Avisos
            $email->setCaIdcaso(null);

            $email->setCaFrom($user->getEmail());
            $email->setCaFromname($user->getNombre());

            $master = Doctrine::getTable("InoMaestraSea")->find($this->numRef);
            $email->addTo($master->getUsuCreado()->getCaEmail());

            //echo $user->getEmail();
            $email->addCc($user->getEmail());

            $email->setCaSubject("Rechazo de Antecedentes ".$this->numRef);
            $email->setCaBody($this->getRequestParameter("mensaje"));

            $mensaje = Utils::replace($this->getRequestParameter("mensaje")) . "<br />";
            $email->setCaBodyhtml($mensaje);


            $email->save();
            $email->send();
            $this->responseArray = array("success" => true);
        }
        catch(Exception $e)
        {
            print_r($e->getMessage());
            $this->responseArray = array("success" => false);
        }
        $this->setTemplate("responseTemplate");
    }


    public function executeAnularReferencia(sfWebRequest $request) 
    {
        
        $conn = Doctrine::getTable("InoMaestraSea")->getConnection();
        $conn->beginTransaction();

         try {
            $numref = str_replace("|", ".", $request->getParameter("ref"));
            $this->forward404Unless( trim($request->getParameter("motivo")) );
     
/*            Doctrine_Query::create()
                   ->delete()
                   ->from("InoClientesSea ic")
                   ->where("ic.ca_referencia = ? ", $numRef)
                   ->execute($conn);
 *
 */

            $master = Doctrine::getTable("InoMaestraSea")->find($numref);
            //$master= new InoMaestraSea();
            $emails=$master->getEmails();
            $master->delete($conn);

            $this->getUser()->log( "Eliminacion Referencia ".$numref ); 
            
            foreach($emails as $email)
            {
                $email->setCaSubject( str_replace(".", "-", $email->getCaSubject()));
                $email->save($conn);
            }
            
            
            
            

            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }

   public function executeProcesarArchivohbls(sfWebRequest $request)
   {
        $modalidad=$request->getParameter("modalidad");
        $origen=$request->getParameter("origen");
        $destino=$request->getParameter("destino");

        $folder="tmp";
        $file=sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$request->getParameter("archivo");

        $reportes=array();
        $lines = file($file);
        for($i=0;$i<count($lines);$i++)
        {
            if(trim($lines[$i])=="")
            {
                continue;
            }
            $tmp=null;
            $valido=true;
            $lines[$i]=trim($lines[$i]);            
            $patron = '/(\d+)-(20\d\d)/';
            if (preg_match($patron, $lines[$i])) {
                $tmp=ReporteTable::retrieveByConsecutivo($lines[$i]);
                if($tmp)
                {
                    if($tmp->getInoClientesSea())
                    {
                        $resultado.="1.1-linea :".($i+1)."->".$lines[$i]." :El RN esta asociado ya a otra referencia<br>";
                        $valido=false;
                    }
                    if($tmp->getCaModalidad()!=$modalidad)
                    {
                        $resultado.="1.2-linea :".($i+1)."->".$lines[$i]." :Modalidad es diferente<br>";
                        $valido=false;
                    }
                    if($tmp->getOrigen()->getCaIdtrafico()!=$origen)
                    {
                        $resultado.="1.3-linea :".($i+1)."->".$lines[$i]." :Origen es diferente<br>";
                        $valido=false;
                    }
                    if($tmp->getCaDestino()!=$destino)
                    {
                        $resultado.="1.4-linea :".($i+1)."->".$lines[$i]." :destino es diferente<br>";
                        $valido=false;
                    }
                    if($valido)
                        $reportes[]=array("ca_idreporte"=>$tmp->getCaIdreporte(),"ca_consecutivo"=>$lines[$i],"doctransporte"=>$tmp->getUltimoStatus()->getCaDoctransporte(),"compania"=>$tmp->getCliente()->getCaCompania(),"idcliente"=>$tmp->getContacto()->getCaIdcliente(),"idcontacto"=>$tmp->getCaIdconcliente());
                }
                else
                {
                   $resultado.="1.5-linea :".$i."->".$lines[$i]." :Reporte no encontrado<br>";
                }
            } else {
                $tmp=RepStatus::retrieveByHbl($lines[$i]);
                if($tmp)
                {
                    $reporte=$tmp->getUltReporte();
                   // $resultado=$reporte->getCaIdreporte()."<br>";
                    if($reporte->getInoClientesSea())
                    {
                        $resultado.="2.1-linea :".($i+1)."->".$lines[$i]." :El RN esta asociado ya a otra referencia<br>";
                        $valido=false;
                    }
                    if($reporte->getCaModalidad()!=$modalidad)
                    {
                        $resultado.="2.2-linea :".($i+1)."->".$lines[$i]." :Modalidad es diferente<br>";
                        $valido=false;
                    }
                    if($reporte->getOrigen()->getCaIdtrafico()!=$origen)
                    {
                        $resultado.="2.3-linea :".($i+1)."->".$lines[$i]." :Origen es diferente<br>";
                        $valido=false;
                    }
                    if($reporte->getCaDestino()!=$destino)
                    {
                        $resultado.="2.4-linea :".($i+1)."->".$lines[$i]." :destino es diferente<br>";
                        $valido=false;
                    }
                    if($valido)
                        $reportes[]=array("ca_idreporte"=>$tmp->getCaIdreporte(),"ca_consecutivo"=>$reporte->getCaConsecutivo(),"doctransporte"=>$lines[$i],"compania"=>$reporte->getCliente()->getCaCompania(),"idcliente"=>$reporte->getContacto()->getCaIdcliente(),"idcontacto"=>$reporte->getCaIdconcliente());
                }
                else
                {
                   $resultado.="2.5-linea :".($i+1)."->".$lines[$i]." :Hbl no encontrado<br>";
                }
            }
        }

        $this->responseArray = array("success" => true,"reportes"=>$reportes,"resultado"=>$resultado);
        $this->setTemplate("responseTemplate");
   }


   public function executeEliminarReporte(sfWebRequest $request)
   {


       try{
            $numref = str_replace("|", ".", $request->getParameter("referencia"));
            $idreporte = $request->getParameter("idreporte");

             Doctrine_Query::create()
                   ->delete()
                   ->from("InoClientesSea ic")
                   ->addWhere("ic.ca_referencia = ? and ic.ca_idreporte=? ", array($numref,$idreporte))
                   ->execute();

              Doctrine::getTable("Email")
                  ->createQuery("e")
                  ->update()
                  ->set("ca_subject","replcace(ca_subject,'.','-')")
                  ->addWhere("ca_subject like ?", "%" . $this->getCaReferencia() . "%")
                  ->execute();


            $this->responseArray = array("success" => true);
       }
       catch(Exception $e)
       {
           $this->responseArray = array("success" => false,"errorInfo"=>$e->getMessage());
       }
       $this->setTemplate("responseTemplate");
   }
    
    public function executeArchivarReferencia(sfWebRequest $request)  
    {
        try{
            $numref = str_replace("|", ".", $request->getParameter("referencia"));
            $this->forward404Unless($numref);
            $ref = Doctrine::getTable("InoMaestraSea")->find($numref);
            $this->forward404Unless($ref);
            $ref->setCaCarpeta(true);
            $ref->save();  
            $this->responseArray = array("success" => true);
       }
       catch(Exception $e)
       {
           $this->responseArray = array("success" => false,"errorInfo"=>$e->getMessage());
       }
       $this->setTemplate("responseTemplate");
    }
    
    
    public function executeRadicarReferencia(sfWebRequest $request)  
    {
        try{
            $numref = str_replace("|", ".", $request->getParameter("referencia"));
            $this->forward404Unless($numref);
            $ref = Doctrine::getTable("InoMaestraSea")->find($numref);
            $this->forward404Unless($ref);
            $ref->setCaUsumuisca($this->getUser()->getUserId());
            $ref->setCaFchmuisca(date('Y-m-d H:i:s'));
            $ref->save();  
            $this->responseArray = array("success" => true);
       }
       catch(Exception $e)
       {
           $this->responseArray = array("success" => false,"errorInfo"=>$e->getMessage());
       }
       $this->setTemplate("responseTemplate");
    }    
 
    public function executeEmailColoader(sfWebRequest $request) {

        $numref = str_replace("|", ".", $request->getParameter("ref"));
        $this->forward404Unless($numref);

        $ref = Doctrine::getTable("InoMaestraSea")->find($numref);
        $this->forward404Unless($ref);

        $this->setLayout($format);

        $this->ref = $ref;
        $this->user = $this->getUser();
        $this->format = $format;

/*        $usuarios = Doctrine::getTable("Usuario")
                        ->createQuery("u")
                        ->addWhere("u.ca_departamento = ? and u.ca_activo=true or (u.ca_login =? or u.ca_login =? or u.ca_login =? ) ", array("Marítimo","nmrey","mflecompte","mjortiz"))
                        ->addOrderBy("u.ca_email")
                        ->execute();
        $contactos = array();
        foreach ($usuarios as $usuario) {
            if ($usuario->getCaEmail() != "-") {
                $contactos[] = $usuario->getCaEmail();
            }
        }
*/
        $this->conta = ParametroTable::retrieveByCaso("CU098", $this->ref->getCaIdlinea());
        if($this->conta[0])
        {        
            $this->contactos = $this->conta[0]->getCaValor2();
        }

        $folder = "Referencias" . DIRECTORY_SEPARATOR . $this->ref->getCaReferencia();
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;
        $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);

        foreach ($archivos as $archivo) {
            $file=explode("/", $archivo);
            $filenames[]["file"] = $file[count($file)-1];
        }
        $this->filenames = $filenames;
        
    }
    
    public function executeEnviarEmailColoader(sfWebRequest $request) {

        $user = $this->getUser();
       
        
        $email = new Email();

        $email->setCaUsuenvio($user->getUserId());
        $email->setCaTipo("EmailColoader"); //Envío de Avisos
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
        //$email->addTo($user->getEmail());

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
        //$request->setParameter("format", "email");
        //$mensaje .= sfContext::getInstance()->getController()->getPresentationFor('antecedentes', 'verPlanilla');
        $email->setCaBodyhtml($mensaje);
        
        $files=$this->getRequestParameter("files");
        foreach ($files as $archivo) {
            
            $name =  $archivo;            
            $email->AddAttachment($name);            
        }
        $email->send();
        $email->save(); 
    }   
}
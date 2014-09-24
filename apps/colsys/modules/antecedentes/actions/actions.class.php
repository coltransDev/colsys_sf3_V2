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
              ->leftJoin('m.InoClientesSea ic')
              ->addWhere("m.ca_provisional = ?", true);

      $q->distinct();
      if ($this->getRequestParameter("reporte")) {
         $criterio = "reporte";
         $cadena = trim($this->getRequestParameter("reporte"));
      } else {
         $criterio = $this->getRequestParameter("criterio");
         $cadena = trim($this->getRequestParameter("cadena"));
      }

      switch ($criterio) {
         case "reporte":
            $q->innerJoin('ic.Reporte r');
            $q->addWhere("r.ca_consecutivo like ?", "%" . $cadena . "%");
            break;
         case "referencia":
            $q->addWhere("m.ca_referencia like ?", $cadena . "%");
            break;
         case "master":
            $q->addWhere("m.ca_mbls = ?", $cadena);
            break;
         case "hbl":
            $q->addWhere("ic.ca_hbls like ?", $cadena . "%");
            break;
         case "cliente":
            $q->innerJoin("ic.Cliente cl");
            $q->addWhere("lower(cl.ca_compania) like ?", "%" . strtolower($cadena) . "%");
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
      $this->user = $this->getUser();
      $this->nivel = $this->user->getNivelAcceso(antecedentesActions::RUTINA);
      //echo $this->nivel;
      $this->format = $this->getRequestParameter("format");

      $where = "";
      if ($this->format == "") {
         $where = " and (m.ca_provisional = true and ((m.ca_modalidad='" . constantes::FCL . "' and u.ca_idsucursal='" . $this->user->getIdSucursal() . "') or m.ca_modalidad<>'" . constantes::FCL . "') )  
                and (m.ca_estado='A' or m.ca_estado='R' or m.ca_estado is null) 
                ";
      } else {
         $where = " and ( (m.ca_provisional = true and ((m.ca_modalidad='" . constantes::FCL . "' and u.ca_idsucursal='" . $this->user->getIdSucursal() . "') or m.ca_modalidad<>'" . constantes::FCL . "') 
                and m.ca_estado='E'
                ) OR (m.ca_provisional = false AND m.ca_fchmuisca IS NULL and SUBSTR(ca_referencia,1,3) NOT IN ('700','710','720','800','810','820') and ca_impoexpo <> '" . Constantes::TRIANGULACION . "' ))";
         $whereEmail = "";
      }

      $sql = "select m.ca_referencia,m.ca_fchreferencia,m.ca_provisional,m.ca_modalidad,m.ca_motonave,m.ca_mbls, m.ca_fchembarque,m.ca_fcharribo,m.ca_usucreado,ori.ca_ciudad as ca_ciu_origen,des.ca_ciudad as ca_ciu_destino,u.ca_idsucursal,m.ca_fchmuisca                
                ,m.ca_estado,m.ca_impoexpo
                from tb_inomaestra_sea m
                JOIN tb_ciudades ori ON ori.ca_idciudad = m.ca_origen
                JOIN tb_ciudades des ON des.ca_idciudad = m.ca_destino
                JOIN control.tb_usuarios u ON u.ca_login = m.ca_usucreado
                where m.ca_fchcreado>='2011-03-01' $where order by m.ca_referencia ";

      /*            if($this->user->getUserId()!="maquinche")
        {
        $con = Doctrine_Manager::connection();
        $st = $con->execute($sql);
        }
        else
        {
        $con = Doctrine_Manager::connection(new PDO('pgsql:dbname=Coltrans;host=10.192.1.65', 'Administrador', 'lmD125aC-c'));
        $st = $con->execute(utf8_encode($sql));
        }
       * 
       */
      $databaseConf = sfYaml::load(sfConfig::get('sf_config_dir') . '/databases.yml');
      $dsn = explode("=", $databaseConf ['all']['doctrine']['param']['dsn']);
      $host = $dsn[count($dsn) - 1];
      $con = Doctrine_Manager::connection(new PDO("pgsql:dbname=Coltrans;host={$host}", 'Administrador', 'V9p0%rRc9$'));

      $st = $con->execute(utf8_encode($sql));

      $referencias = $st->fetchAll();

      $this->refBloqueadas = array();
      $this->refRechazadas = array();
      $this->refSinMuisca = array();
      foreach ($referencias as $ref) {
         if (trim($ref["ca_provisional"]) == "1") {
            if ($this->format == "maritimo") {
               $this->refBloqueadas[] = $ref;
            } else {
               //if( $ref["refbloqueada"]<0 )
               if ($ref["ca_estado"] != "R")
                  $this->refBloqueadas[] = $ref;
               else
                  $this->refRechazadas[] = $ref;
            }
         }
         else {
            if ($ref["ca_impoexpo"] != Constantes::TRIANGULACION)
               $this->refSinMuisca[] = $ref;
         }
      }

      $this->sucursal = $this->user->getIdSucursal();

      $this->login = $this->user->getUserId();
      /* if($this->sucursal=="BOG")
        {
        $sql="select m.ca_referencia,m.ca_modalidad,m.ca_motonave,m.ca_fchembarque,m.ca_fcharribo,m.ca_usucreado,ori.ca_ciudad ca_ciu_origen,des.ca_ciudad ca_ciu_destino
        from tb_inomaestra_sea m
        JOIN tb_ciudades ori ON ori.ca_idciudad = m.ca_origen
        JOIN tb_ciudades des ON des.ca_idciudad = m.ca_destino
        where m.ca_fchmuisca is not null and m.ca_carpeta=false";

        $con = Doctrine_Manager::getInstance()->connection();
        $st = $con->execute($sql);
        $this->refcarpetas = $st->fetchAll();

        } */

      $this->sufijos = ParametroTable::retrieveByCaso("CU010");
      if ($this->user->getUserId() == "maquinche" /* || $this->user->getUserId()=="sandrade" */) {
         //echo "<br><br><br><pre>"; print_r($refRechazadas);echo "</pre>";
         //echo $sql;
      }
   }

   /**
    * Genra la referencia y las hijas con la información de los reportes.
    *
    * @param sfRequest $request A request object
    */
   public function executeGuardarPanelMasterAntecedentes(sfWebRequest $request) {

      $this->user = $this->getUser();
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
         $observaciones = $request->getParameter("observaciones");
         $ntipo = $request->getParameter("ntipo");
         $idemisionbl = utf8_decode($request->getParameter("idemisionbl"));

         $idlinea = ($request->getParameter("idlinea") ? $request->getParameter("idlinea") : "0");

         $mmRef = Utils::parseDate($fchllegada, "m");
         $aaRef = substr(Utils::parseDate($fchllegada, "Y"), -2, 2);
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
            $master->setCaEstado("A");
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
         $master->setCaObservaciones($observaciones);
         $master->setCaTipo(($ntipo != "") ? $ntipo : null);
         $master->setCaEmisionbl(($idemisionbl != "") ? $idemisionbl : null);
         $master->setCaProvisional(true);
         if ($this->user->getIdSucursal() == "BOG")
            $master->setCaCarpeta(true);

         $master->save($conn);
         
         $q = $conn->createQuery()
                 ->delete("ic.*")
                 ->from('InoClientesSea ic')
                 ->addWhere("ic.ca_referencia = ? ", $numref);
         $q->execute();
         $kk = count(explode("|", $request->getParameter("reportes")));
         $consecutivos = array_unique(explode("|", $request->getParameter("reportes")));
         $imprimir = (explode("|", $request->getParameter("imprimirorigen")));
         $i = 0;

         for ($i = 0; $i < $kk; $i++) {
            if (!isset($consecutivos[$i]))
               continue;
            $consecutivo = $consecutivos[$i];
            $reporte = ReporteTable::retrieveByConsecutivo($consecutivo);

            if ($reporte) {

               $proveedores = $reporte->getProveedores();
               $proveedor=$proveedores[0];
               //foreach ($proveedores as $proveedor) {
                 
                $status = $reporte->getUltimoStatus();
                if ($status && $status->getCaDoctransporte()) {
                      
                    $valida = Doctrine::getTable("InoClientesSea")
                    ->createQuery("m")
                    ->addWhere("m.ca_referencia != ? and m.ca_hbls= ?  ", array($numref,$status->getCaDoctransporte()) )
                    ->fetchOne();
                    
                    if($valida)
                        continue;

                     $inoCliente = Doctrine::getTable("InoClientesSea")->find(array($status->getCaDoctransporte()));

                     if (!$inoCliente)
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
                     $inoCliente->setCaImprimirorigen((isset($imprimir[$i]) ) ? $imprimir[$i] : false);
                     $inoCliente->setCaLogin($reporte->getCaLogin());

                     $inoCliente->setCaContinuacion($reporte->getCaContinuacion());
                     $inoCliente->setCaContinuacionDest($reporte->getCaContinuacionDest());
                     $inoCliente->setCaFchhbls($fchmaster);

                     $idbodega = $reporte->getTerceroBodega();
                     if ($reporte->getCaContinuacion() == "OTM" && $idbodega > 0) {
                        $inoCliente->setCaIdbodega($reporte->getTerceroBodega());
                     }
                     $inoCliente->save($conn);
                  }
               //}
            }
         }         
         //$conn->rollBack();
         $conn->commit();
         $this->responseArray = array("success" => true, "numref" => $numref);
      } catch (Exception $e) {
         $conn->rollBack();
         $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()) . ".bog:" . $idbodega);
      }
      $this->setTemplate("responseTemplate");
   }

   public function executeGuardarPanelEntregaAntecedentes(sfWebRequest $request) {

      $this->user = $this->getUser();
      $conn = Doctrine::getTable("EntregaAntecedentes")->getConnection();
      $conn->beginTransaction();
      try {
         $impoexpo = utf8_decode($request->getParameter("impoexpo"));
         $this->forward404Unless($impoexpo);
         $transporte = utf8_decode($request->getParameter("transporte"));
         $this->forward404Unless($transporte);
         $idtrafico = $request->getParameter("idtrafico");
         $this->forward404Unless($idtrafico);
         $idciudad = ($request->getParameter("idciudad")) ? $request->getParameter("idciudad") : "999-9999";
         $modalidad = utf8_decode($request->getParameter("modalidad"));
         $numdias = $request->getParameter("numdias");
         $observaciones = ($request->getParameter("observaciones")) ? $request->getParameter("observaciones") : "";
         $this->forward404Unless($numdias);

         $antecedente = Doctrine::getTable("EntregaAntecedentes")->find(array($idtrafico, $idciudad, $modalidad));
         if (!$antecedente) {
            $antecedente = new EntregaAntecedentes();
            $antecedente->setCaIdtrafico($idtrafico);
            $antecedente->setCaIdciudad($idciudad);
            $antecedente->setCaModalidad($modalidad);
         }
         $antecedente->setCaImpoexpo($impoexpo);
         $antecedente->setCaTransporte($transporte);
         $antecedente->setCaDias($numdias);
         $antecedente->setCaObservaciones($observaciones);
         $antecedente->save($conn);

         $conn->commit();
         $this->responseArray = array("success" => true);
      } catch (Exception $e) {
         $conn->rollBack();
         $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
      }
      $this->setTemplate("responseTemplate");
   }

   public function executeBorrarPanelEntregaAntecedentes(sfWebRequest $request) {

      $this->user = $this->getUser();
      $conn = Doctrine::getTable("EntregaAntecedentes")->getConnection();
      $conn->beginTransaction();
      try {
         $idtrafico = $request->getParameter("idtrafico");
         $this->forward404Unless($idtrafico);
         $idciudad = ($request->getParameter("idciudad")) ? $request->getParameter("idciudad") : "999-9999";
         $modalidad = utf8_decode($request->getParameter("modalidad"));

         $antecedente = Doctrine::getTable("EntregaAntecedentes")->find(array($idtrafico, $idciudad, $modalidad));
         if ($antecedente) {
            $antecedente->delete();
         }
         $conn->commit();
         $this->responseArray = array("success" => true);
      } catch (Exception $e) {
         $conn->rollBack();
         $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
      }
      $this->setTemplate("responseTemplate");
   }

   public function executeGuardarPanelMasterOTMAntecedentes(sfWebRequest $request) {

      $this->user = $this->getUser();
      $conn = Doctrine::getTable("InoMaestraSea")->getConnection();
      $conn->beginTransaction();
      //try {
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
      $consolidado = $request->getParameter("consolidado");
      //$this->forward404Unless($consolidado);
      $viaje = $request->getParameter("viaje");
      $fchmaster = $request->getParameter("fchmaster");

      $idlinea = ($request->getParameter("idlinea") ? $request->getParameter("idlinea") : "0");

      $mmRef = Utils::parseDate($fchllegada, "m");
      $aaRef = substr(Utils::parseDate($fchllegada, "Y"), -2, 2);
      if (Utils::parseDate($fchllegada, "d") >= "26") {
         $mmRef = $mmRef + 1;
         if ($mmRef >= 13) {
            $mmRef = "01";
            $aaRef = $aaRef + 1;
         }
      }

      $numref = $request->getParameter("referencia");

      if ($numref) {
         $master = Doctrine::getTable("InoMaster")->find($numref);
         $this->forward404Unless($master);
      } else {
         $master = new InoMaster();
         $numref = InoMasterTable::getNumReferencia($impoexpo, $transporte, $modalidad, $idorigen, $iddestino, $mmRef, $aaRef);
         $master->setCaReferencia($numref);
         //$master->setCaEstado("A");
      }

      $master->setCaImpoexpo($impoexpo);
      $master->setCaTransporte($transporte);

      $master->setCaModalidad($modalidad);
      $master->setCaOrigen($idorigen);
      $master->setCaDestino($iddestino);
      $master->setCaMotonave($motonave);

      $master->setCaFchsalida($fchsalida);
      $master->setCaFchllegada($fchllegada);

      $master->setCaFchreferencia($fchllegada);

      $master->setCaIdlinea($idlinea);

      $master->setCaMaster(date("Y-m-d H:i:s"));

      $master->save($conn);
      $idmaster = $master->getCaIdmaster();
      $q = $conn->createQuery()
              ->delete("ic.*")
              ->from('InoHouse ic')
              ->addWhere("ic.ca_idmaster = ? ", $idmaster);
      $q->execute();

      $kk = count(explode("|", $request->getParameter("reportes")));
      $consecutivos = array_unique(explode("|", $request->getParameter("reportes")));

      $i = 0;
      $htmlReportes = "";
      for ($i = 0; $i < $kk; $i++) {
         if (!isset($consecutivos[$i]))
            continue;
         $consecutivo = $consecutivos[$i];
         $reporte = ReporteTable::retrieveByConsecutivo($consecutivo);

         if ($reporte) {
            $proveedores = $reporte->getProveedores();

            $otm = $reporte->getRepOtm();
            if ($otm) {
               $numpiezas = $otm->getCaNumpiezas();
               $mpiezas = $otm->getCaNumpiezas();
               $peso = $otm->getCaPeso();
               $volumen = $otm->getCaVolumen();
               $doctransporte = $otm->getCaHbls();
               $fchdoctransporte = $otm->getCaFchdoctransporte();
               $deposito = $otm->getInoDianDepositos()->getCaNombre();
            }
            /* else
              {
              $status = $reporte->getUltimoStatus();
              $piezas = explode("|", $status->getCaPiezas());
              $numpiezas=$piezas[0] ? $piezas[0] : 0;
              $peso = explode("|", $status->getCaPeso());
              $peso=$peso[0] ? $peso[0] : 0;
              $volumen = explode("|", $status->getCaVolumen());
              $volumen=$volumen[0] ? $volumen[0] : 0;
              $doctransporte=$status->getCaDoctransporte();
              $fchdoctransporte=date("Y-m-d");
              $deposito="";
              } */
            $doctransporte = ($doctransporte != "") ? $doctransporte : "1";
            $fchdoctransporte = ($fchdoctransporte != "") ? $fchdoctransporte : date("Y-m-d");

            $numpiezas = ($numpiezas != "") ? $numpiezas : 0;
            $mpiezas = ($mpiezas != "") ? $mpiezas : 0;
            $peso = ($peso != "") ? $peso : 0;
            $volumen = ($volumen != "") ? $volumen : 0;

            if (count($proveedores) > 0)
               $idtercero = $proveedores[0]->getCaIdtercero();

            if ($request->getParameter("idhouse")) {
               $house = Doctrine::getTable("InoHouse")->find($request->getParameter("idhouse"));
               $this->forward404Unless($house);
            } else {
               $house = new InoHouse();
            }

            $house->setCaIdmaster($idmaster);
            $house->setCaIdreporte($reporte->getCaIdreporte());
            $house->setCaIdcliente($reporte->getContacto("4")->getCaIdcliente());
            $house->setCaVendedor($reporte->getCaLogin());

            $house->setCaIdtercero($idtercero);
            $house->setCaNumorden($reporte->getCaOrdenClie());

            $house->setCaNumpiezas($numpiezas);
            $house->setCaMpiezas($mpiezas);
            $house->setCaPeso($peso);
            $house->setCaVolumen($volumen);
            $house->setCaDoctransporte($doctransporte);
            $house->setCaFchdoctransporte($fchdoctransporte);
            $house->save($conn);

            $htmlReportes[] = "<tr><td>" . $reporte->getCaConsecutivo() . "</td><td>" . $doctransporte . "</td><td>" . $reporte->getCliente("continuacion")->getCaCompania() . "</td><th>" . $deposito . "</td><td>" . $reporte->getBodega()->getCaNombre() . "/" . $reporte->getBodega()->getCaTipo() . "</td><td>" . $numpiezas . " " . $mpiezas . "</td><td>" . $peso . "</td><td>" . $volumen . "</td></tr>";
         }
      }

      /*       * *** */
      /*
        $user = $this->getUser();
        $email = new Email();

        $email->setCaUsuenvio($user->getUserId());
        $email->setCaTipo("InstruccionesOtm"); //Envío de Avisos
        $email->setCaIdcaso(null);

        //$from = $this->getRequestParameter("from");
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


        if($idorigen=="CTG-0005")
        {
        $recips[] = "cabolano@coltrans.com.co";
        $recips[] = "otmctg@colotm.com";
        }
        else if($idorigen=="BUN-0002")
        $recips[]="otmbun@colotm.com";

        //$recips[]="maquinche@coltrans.com.co";
        foreach ($recips as $recip) {
        $recip = str_replace(" ", "", $recip);
        if ($recip) {
        $email->addTo($recip);
        }
        }

        if ($from) {
        $email->addCc($from);
        } else {
        $email->addCc($this->getUser()->getEmail());
        }

        $email->setCaSubject("Instrcciones de cargue de ".$master->getCaMaster()." Numero de referencia:".$numref);
        $email->setCaBody($this->getRequestParameter("mensaje"));

        $mensaje = Utils::replace($this->getRequestParameter("mensaje")) . "<br />";


        $html ="<table class='tableList alignLeft'><tr><td>
        <table class='tableList alignLeft' >
        <tr><th colspan='8'>Se Creo la Referencia No: ".$numref."</th></tr>
        <tr><th>NO REPORTE</th><th>HBL</th><th>IMPORTADOR</th><th>MUELLE</th><th>BODEGA</th><th>PIEZAS</th><th>PESO</th><th>VOLUMEN</th></tr>";
        $html.=implode("",$htmlReportes );
        $html."</table></td></tr></table>";


        $this->getRequest()->setParameter('tipo',"INSTRUCCIONES");
        $this->getRequest()->setParameter('mensaje',"Se genero el nuevo cargue no.".$master->getCaMaster());
        $this->getRequest()->setParameter('html',$html);
        $request->setParameter("format", "email");

        $mensaje = sfContext::getInstance()->getController()->getPresentationFor( 'reportesNeg', 'emailReporte');
        $email->setCaBodyhtml($mensaje);

        $email->save($conn);
       * 
       */
      /*       * *** */

      $conn->commit();
      $this->responseArray = array("success" => true, "numref" => $idmaster);
      /* } catch (Exception $e) {
        $conn->rollBack();
        $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()).".bog:".$idbodega);
        } */
      $this->setTemplate("responseTemplate");
   }

   /**
    *
    *
    * @param sfRequest $request A request object
    */
   public function executeAsignacionMaster(sfWebRequest $request) {

      $response = sfContext::getInstance()->getResponse();
      $response->addJavaScript("extExtras/CheckColumn", 'last');

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

   /**
    *
    *
    * @param sfRequest $request A request object
    */
   public function executeAsignacionMasterOTM(sfWebRequest $request) {

      $response = sfContext::getInstance()->getResponse();
      $response->addJavaScript("extExtras/CheckColumn", 'last');

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

      $parametrosTipo = ParametroTable::retrieveByCaso("CU119", null, null, $ref->getCaTipo());
      foreach ($parametrosTipo as $parametroTipo) {
         $ntipo = $parametroTipo->getCaValor();
      }
      $parametrosEmision = ParametroTable::retrieveByCaso("CU223", null, null, $ref->getCaEmisionbl());
      foreach ($parametrosEmision as $parametroEmision) {
         $emisionbl = $parametroEmision->getCaValor();
      }

      $data = array();

      $data["referencia"] = $ref->getCaReferencia();
      $data["motonave"] = $ref->getCaMotonave();
      $data["impoexpo"] = utf8_encode($ref->getCaImpoexpo());
      $data["transporte"] = utf8_encode(Constantes::MARITIMO);
      $data["modalidad"] = $ref->getCaModalidad();
      $data["origen"] = $ref->getOrigen()->getCaCiudad();
      $data["idorigen"] = $ref->getCaOrigen();
      $data["destino"] = $ref->getDestino()->getCaCiudad();
      $data["iddestino"] = $ref->getCaDestino();
      $data["fchsalida"] = $ref->getCaFchembarque();
      $data["fchllegada"] = $ref->getCaFcharribo();
      $data["idlinea"] = $ref->getCaIdlinea();

//        $ref->getCaMbls();
      $data["mbls"] = $ref->getCaMbls();
      //if($arrMbls[1])
      $data["fchmaster"] = $ref->getCaFchmbls();

      $data["viaje"] = $ref->getCaCiclo();
      $data["observaciones"] = $ref->getCaObservaciones();
      $data["tipo"] = $ntipo;
      $data["emisionbl"] = utf8_encode($emisionbl);

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

   public function executeDatosPanelReportesAntecedentesOTM(sfWebRequest $request) {
      /* $q = Doctrine_Query::create()
        ->select("r.ca_consecutivo, r.ca_idreporte, r.ca_origen, cl.ca_compania,r.ca_impoexpo,r.ca_destino")
        ->from('Reporte r')
        ->where("r.ca_impoexpo = ? or ca_continuacion=?", array(constantes::OTMDTA,"OTM"))
        ->innerJoin('r.Contacto c')
        ->innerJoin('c.Cliente cl')
        ->innerJoin('r.RepStatus rs')

        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
        ->limit(10);

        $reportes = $q->execute();
        //echo $q->getSqlQuery();
        foreach ($reportes as $key => $val) {
        if($val["r_ca_impoexpo"]==constantes::IMPO)
        {
        $reportes[$key]["r_ca_origen"] = utf8_encode($reportes[$key]["r_ca_destino"]);
        }
        else
        $reportes[$key]["r_ca_origen"] = utf8_encode($reportes[$key]["cl_ca_origen"]);

        $reportes[$key]["cl_ca_compania"] = utf8_encode($reportes[$key]["cl_ca_compania"]);
        $reportes[$key]["orden"] = $reportes[$key]["r_ca_consecutivo"];
        $reportes[$key]["sel"] = $reportes[$key]["ic_ca_imprimirorigen"];
        }

        //$reportes[] = array("r_ca_consecutivo" => "+", "cl_ca_compania" => "", "orden" => "Z");
       */
      $origen = $request->getParameter("origen");
      $idorigen = $request->getParameter("idorigen");
      $destino = $request->getParameter("destino");
      $iddestino = $request->getParameter("iddestino");
      $modalidad = $request->getParameter("modalidad");
      $where = "";
      if ($origen != "")
         $where .=" and r.ca_origen='{$origen}'";
      if ($destino != "")
         $where .=" and r.ca_destino='{$destino}'";
      if ($modalidad != "") {
         if ($modalidad == "LCL")
            $where .=" and r.ca_modalidad in('{$modalidad}','COLOADING')";
         else
            $where .=" and r.ca_modalidad='{$modalidad}'";
      }

      $sql = "select distinct(r.ca_consecutivo),
            r.ca_idreporte, r.ca_origen, NULLIF(t.ca_nombre,cl.ca_compania ) as cl_ca_compania , r.ca_impoexpo, 
            (CASE WHEN r.ca_tiporep=4 THEN r.ca_origen
            ELSE r.ca_destino  END) as r_ca_origen, r.ca_fchcreado
            ,COALESCE( ro.ca_numpiezas::text , s.ca_piezas  ) as ca_piezas
            ,COALESCE(ro.ca_peso::text , s.ca_peso  ) as ca_peso
            ,COALESCE(ro.ca_volumen::text , s.ca_volumen  ) as ca_volumen
            ,COALESCE(ro.ca_hbls , s.ca_doctransporte  ) as ca_hbl,
            ro.ca_fcharribo
            from tb_repstatus s, tb_reportes r
            left join tb_inoclientes_sea ic on r.ca_idreporte=ic.ca_idreporte
            inner join tb_repotm ro on r.ca_idreporte=ro.ca_idreporte
            left join tb_terceros t on ro.ca_idcliente=t.ca_idtercero
            inner join tb_concliente ct on r.ca_idconcliente=ct.ca_idcontacto
            inner join vi_clientes_reduc cl on cl.ca_idcliente::text=ct.ca_idcliente::text
            where s.ca_idreporte=r.ca_idreporte  and s.ca_idetapa in ('IMCPD','IMPOD')
            and ic.ca_idreporte is null $where 
            and ((ca_transporte='Marítimo' and ca_impoexpo='Importación' and r.ca_continuacion='OTM') or ca_tiporep=4 ) and ca_usuanulado is null
            and r.ca_fchcreado >'2012-04-01' ";

      $sql = "select distinct(r.ca_consecutivo), 
            r.ca_idreporte, r.ca_origen, NULLIF(t.ca_nombre,cl.ca_compania ) as cl_ca_compania , r.ca_impoexpo, 
            (CASE WHEN r.ca_tiporep=4 THEN r.ca_origen
            ELSE r.ca_destino  END) as r_ca_origen, r.ca_fchcreado
            ,COALESCE( ro.ca_numpiezas::text , s.ca_piezas  ) as ca_piezas
            ,COALESCE(ro.ca_peso::text , s.ca_peso  ) as ca_peso
            ,COALESCE(ro.ca_volumen::text , s.ca_volumen  ) as ca_volumen
            ,COALESCE(ro.ca_hbls , s.ca_doctransporte  ) as ca_hbl
            ,ro.ca_fcharribo, b.ca_nombre as ca_bodega,dp.ca_nombre as muelle
            from tb_repstatus s
            inner join tb_reportes r on s.ca_idreporte=r.ca_idreporte and r.ca_tiporep=4  and r.ca_usuanulado is null and r.ca_fchcreado >'2012-04-15'
            left join ino.tb_house ic on r.ca_idreporte=ic.ca_idreporte
            inner join tb_bodegas b on r.ca_idbodega=b.ca_idbodega
            inner join tb_repotm ro on r.ca_idreporte=ro.ca_idreporte
            left join tb_diandepositos dp on ro.ca_muelle=dp.ca_codigo
            left join tb_terceros t on ro.ca_idcliente=t.ca_idtercero
            inner join tb_concliente ct on r.ca_idconcliente=ct.ca_idcontacto
            inner join vi_clientes_reduc cl on cl.ca_idalterno::text=ct.ca_idcliente::text
            where s.ca_idetapa in ('IMCPD','IMPOD') and ic.ca_idreporte is null $where ";

      $sql = "
            select distinct(r.ca_consecutivo), r.ca_idreporte, r.ca_origen, COALESCE(t.ca_nombre,cl.ca_compania ) as cl_ca_compania,
                r.ca_impoexpo, r.ca_origen, r.ca_fchcreado , ro.ca_numpiezas ,ro.ca_peso,ro.ca_volumen,
                ro.ca_hbls as ca_hbl ,ro.ca_fcharribo, b.ca_nombre as ca_bodega,dp.ca_nombre as muelle
            from  tb_reportes r
                inner join tb_bodegas b on r.ca_idbodega=b.ca_idbodega
                inner join tb_repotm ro on r.ca_idreporte=ro.ca_idreporte 
                left join tb_diandepositos dp on ro.ca_muelle=dp.ca_codigo
                left join tb_terceros t on ro.ca_idcliente=t.ca_idtercero
                inner join tb_concliente ct on r.ca_idconcliente=ct.ca_idcontacto 
                inner join vi_clientes_reduc cl on cl.ca_idcliente::text=ct.ca_idcliente::text
            where
                r.ca_consecutivo in ( select (rr.ca_consecutivo) from tb_repstatus ss,tb_reportes rr where ss.ca_idreporte=rr.ca_idreporte and ss.ca_idetapa in ('OTSDO','OTRDO','OTNDE','OTINS','OTLEV','IMPOD')   ) and
                r.ca_consecutivo not in ( select (rrr.ca_consecutivo) from ino.tb_house icc,tb_reportes rrr where icc.ca_idreporte=rrr.ca_idreporte ) and
                r.ca_tiporep=4 and r.ca_usuanulado is null and r.ca_fchcreado >'2012-06-01'
                $where";

      $con = Doctrine_Manager::getInstance()->connection();
      $st = $con->execute($sql);
      $this->datos = $st->fetchAll();

      foreach ($this->datos as $k => $d) {
         $this->datos[$k]["ca_bodega"] = utf8_decode($d["ca_bodega"]);
         $this->datos[$k]["muelle"] = utf8_decode($d["muelle"]);
      }

      $this->responseArray = array("success" => true, "total" => count($this->datos), "root" => $this->datos, "sql" => $sql);
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
      }else{
         $sql = "select im.ca_referencia, im.ca_fchembarque, im.ca_tipo, ea1.ca_dias::int as ca_numdias, ea2.ca_dias::int as ca_numdias2, ea3.ca_dias::int as ca_numdias3 from tb_inomaestra_sea im inner join tb_ciudades cd on im.ca_origen = cd.ca_idciudad
                left join tb_entrega_antecedentes ea1 on ea1.ca_idtrafico::text = cd.ca_idtrafico::text and ea1.ca_idciudad::text = '999-9999' and ea1.ca_modalidad = ''
                left join tb_entrega_antecedentes ea2 on ea2.ca_idtrafico::text = cd.ca_idtrafico::text and ea2.ca_idciudad::text = im.ca_origen::text
                left join tb_entrega_antecedentes ea3 on ea3.ca_idtrafico::text = cd.ca_idtrafico::text and ea3.ca_modalidad::text = im.ca_modalidad::text
                where im.ca_referencia = '$numref'";

         $con = Doctrine_Manager::getInstance()->connection();
         $st = $con->execute($sql);
         $antecedentes = $st->fetchAll();

         list($ano, $mes, $dia) = sscanf($antecedentes[0]['ca_fchembarque'], "%d-%d-%d");
         if ($antecedentes[0]['ca_numdias3'] !== null){
             $this->ent_opo = date("Y-m-d", mktime(0, 0, 0, $mes, $dia+$antecedentes[0]['ca_numdias3'], $ano));
         }else if ($antecedentes[0]['ca_numdias2'] !== null){
             $this->ent_opo = date("Y-m-d", mktime(0, 0, 0, $mes, $dia+$antecedentes[0]['ca_numdias2'], $ano));
         }else if ($antecedentes[0]['ca_numdias'] !== null){
             $this->ent_opo = date("Y-m-d", mktime(0, 0, 0, $mes, $dia+$antecedentes[0]['ca_numdias'], $ano));
         }else{
             $this->ent_opo = null;
         }
   
         $this->ent_efe = date("Y-m-d");
         $dif_mem = Utils::compararFechas($this->ent_efe,$this->ent_opo);
         $dif_mem = ($antecedentes[0]['ca_tipo']==1 or $antecedentes[0]['ca_tipo']==2)?0:$dif_mem;
         if ($dif_mem > 0){
             $this->antecedente_justifica = true;
         }else{
             $this->antecedente_justifica = false;
         }
      }
      $this->ref = $ref;
      $this->user = $this->getUser();
      $this->format = $format;

      $this->emails = $ref->getEmails();


      $usuarios = Doctrine::getTable("Usuario")
              ->createQuery("u")
              ->addWhere("u.ca_departamento = ?  and u.ca_activo=true or (u.ca_login =? or u.ca_login =? or u.ca_login =? ) ", array("Marítimo", "nmrey", "mflecompte", "mjortiz"))
              ->addOrderBy("u.ca_email")
              ->execute();
      $contactos = array();
      foreach ($usuarios as $usuario) {
         if ($usuario->getCaEmail() != "-") {
            $contactos[] = $usuario->getCaEmail();
         }
      }

      $contactos1 = array();
      $usuarios1 = Doctrine::getTable("Usuario")
              ->createQuery("u")
              ->addWhere("u.ca_departamento = ?  and u.ca_activo=true ", array("Aduanas"))
              ->addOrderBy("u.ca_email")
              ->execute();

      foreach ($usuarios1 as $usuario) {
         if ($usuario->getCaEmail() != "-") {
            $contactos1[] = $usuario->getCaEmail();
         }
      }

      $this->contactos = implode(",", $contactos);
      $this->contactos1 = implode(",", $contactos1);

      $folder = "Referencias" . DIRECTORY_SEPARATOR . $this->ref->getCaReferencia();
      $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;
      $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);
      
      if($archivos){
        $filename = array();
        foreach ($archivos as $archivo) {
           $file = explode("/", $archivo);
           $filenames[]["file"] = $file[count($file) - 1];
        }
        $this->filenames = $filenames;
      }
   }

   /**
    *
    *
    * @param sfRequest $request A request object
    */
   public function executeEnviarAntecedentes(sfWebRequest $request) {
      $user = $this->getUser();

      $this->numRef = str_replace("|", ".", $request->getParameter("ref"));
      $this->justificacion_idg = $request->getParameter("justificacion_idg");

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
      $email->send();

      $ref = Doctrine::getTable("InoMaestraSea")->find($this->numRef);
      $this->forward404Unless($ref);
      $ref->setCaEstado("E"); //Enviado
      $ref->setCaFchenvio(date("Y-m-d H:i:s"));
      if (isset($this->justificacion_idg) and trim($this->justificacion_idg)!=""){
          if (strlen(trim($ref->getCaPropiedades()))!=0){
            $propiedades = trim($ref->getCaPropiedades());
            $propiedades = explode(";", $propiedades);
          }else{
            $propiedades = array();
          }
          $key = 0;
          foreach ($propiedades as $key => $propiedad){
              $item = explode("=", $propiedad);
              if ($item[0] == "idg"){
                  break;
              }
          }
          $propiedades[$key] = "idg=".$this->justificacion_idg;
          $ref->setCaPropiedades(implode(";",$propiedades));
      }
      $ref->save();
   }

   /**
    *
    *
    * @param sfRequest $request A request object
    */
   public function executeEmailComodato(sfWebRequest $request) {

      $numRef = str_replace("|", ".", $request->getParameter("ref"));
      $format = $request->getParameter("format");

      $this->forward404Unless($numRef);

      $ref = Doctrine::getTable("InoMaestraSea")->find($numRef);
      $this->forward404Unless($ref);

      $usrRef = array();
      $usrRef[] = $ref->getCaUsuconfirmado();    // Busca el usuario que haya hecho la confirmación

      $q = Doctrine_Query::create()
              ->select("ie.ca_referencia, ie.ca_idequipo, cp.ca_concepto, pt.ca_nombre, ic.ca_entrega_comodato, ic.ca_inspeccion_nta, ic.ca_inspeccion_fch, ic.ca_observaciones")
              ->from('InoEquiposSea ie')
              ->leftJoin('ie.InoContratosSea ic')
              ->leftJoin('ie.Concepto cp')
              ->leftJoin('ic.PricPatio pt')
              ->addWhere('ie.ca_referencia = ? ', $numRef)
              ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

      $this->equipos = $q->execute();

      $this->hijas = Doctrine::getTable("InoClientesSea")
              ->createQuery("c")
              ->where("c.ca_referencia = ?", $numRef)
              ->execute();

      $sucRef = array();
      $hijas = $this->hijas;
      foreach ($hijas as $hija) {                 // Busca los usuarios involucrados con la referencia
         if ($hija->getVendedor()->getCaSucursal()) {
            if (!in_array($hija->getVendedor()->getCaSucursal(), $sucRef)) {
               $sucRef[] = $hija->getVendedor()->getCaSucursal();
            }
         }
         if (!in_array($hija->getCaUsucreado(), $usrRef)) {
            $usrRef[] = $hija->getCaUsucreado();
         }
      }

      if ($format == "email") {
         $this->setLayout($format);
      }

      $this->ref = $ref;
      $this->user = $this->getUser();
      $this->format = $format;

      $this->emails = $ref->getEmails();

      $usuarios = Doctrine::getTable("Usuario")
              ->createQuery("u")
              ->innerJoin("u.Sucursal s")
              ->whereIn("s.ca_nombre", $sucRef)
              ->addWhere("u.ca_departamento = ? and u.ca_activo=true ", array("Marítimo"))
              ->addOrderBy("u.ca_email")
              //->getSqlQuery();
              ->execute();

      $contactos = array();
      foreach ($usuarios as $usuario) {
         $tiene_perfil = false;
         foreach ($usuario->getUsuarioPerfil() as $perfil) {
            if (strpos($perfil->getCaPerfil(), "contenedores") !== FALSE) {
               $tiene_perfil = true;
            }
         }
         if ($usuario->getCaEmail() != "-" and $tiene_perfil) {
            $contactos[] = $usuario->getCaEmail();
         }
      }
      if (count($contactos) == 0) {
         $usuarios = Doctrine::getTable("Usuario")
                 ->createQuery("u")
                 ->whereIn("u.ca_login", $usrRef)
                 ->addWhere("u.ca_activo = true")
                 ->addOrderBy("u.ca_email")
                 //->getSqlQuery();
                 ->execute();
         foreach ($usuarios as $usuario) {
            if (filter_var($usuario->getCaEmail(), FILTER_VALIDATE_EMAIL)) {
               $contactos[] = $usuario->getCaEmail();
            }
         }
      }

      $this->contactos = implode(",", $contactos);
   }

   /**
    *
    *
    * @param sfRequest $request A request object
    */
   public function executeEmailAutorizacion(sfWebRequest $request) {

      $numRef = str_replace("|", ".", $request->getParameter("ref"));
      $format = $request->getParameter("format");

      $this->forward404Unless($numRef);

      $ref = Doctrine::getTable("InoMaestraSea")->find($numRef);
      $this->forward404Unless($ref);

      $usrRef = array();
      $usrRef[] = $ref->getCaUsucreado();    // Busca los usuarios involucrados con la referencia

      $q = Doctrine_Query::create()
              ->select("ie.ca_referencia, ie.ca_idequipo, cp.ca_concepto, pt.ca_nombre, ic.ca_entrega_comodato, ic.ca_inspeccion_nta, ic.ca_inspeccion_fch, ic.ca_observaciones")
              ->from('InoEquiposSea ie')
              ->leftJoin('ie.InoContratosSea ic')
              ->leftJoin('ie.Concepto cp')
              ->leftJoin('ic.PricPatio pt')
              ->addWhere('ie.ca_referencia = ? ', $numRef)
              ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

      $this->equipos = $q->execute();

      $idsProveedor = $ref->getIdsProveedor();
      $ids = $idsProveedor->getIds();
      $sucursales = $ids->getIdsSucursal();

      $contactos = array();

      foreach ($sucursales as $sucursal) {
         $IdsContactos = Doctrine::getTable("IdsContacto")
                 ->createQuery("c")
                 ->where("c.ca_idsucursal = ?", $sucursal->getCaIdsucursal())
                 ->execute();
         foreach ($IdsContactos as $contacto) {
            if ($contacto) {
               $contactos[] = $contacto->getCaEmail();
            }
         }
      }

      $this->hijas = Doctrine::getTable("InoClientesSea")
              ->createQuery("c")
              ->where("c.ca_referencia = ?", $numRef)
              ->execute();

      $sucRef = array();
      $hijas = $this->hijas;
      foreach ($hijas as $hija) {                 // Busca los usuarios involucrados con la referencia
         if ($hija->getVendedor()->getCaSucursal()) {
            if (!in_array($hija->getVendedor()->getCaSucursal(), $sucRef)) {
               $sucRef[] = $hija->getVendedor()->getCaSucursal();
            }
         }
         if (!in_array($hija->getCaUsucreado(), $usrRef)) {
            $usrRef[] = $hija->getCaUsucreado();
         }
      }

      if ($format == "email") {
         $this->setLayout($format);
      }

      $this->ref = $ref;
      $this->user = $this->getUser();
      $this->format = $format;

      $this->emails = $ref->getEmails();

      $this->contactos = implode(",", $contactos);

      $ciudades = Doctrine::getTable("Ciudad")
              ->createQuery("c")
              ->where("c.ca_idtrafico = ?", "CO-057")
              ->orderBy("c.ca_ciudad")
              ->execute();
      $this->destinos = array();
      foreach ($ciudades as $ciudad){
         $this->destinos[] = $ciudad->getCaCiudad();
      }
   }

   /**
    *
    *
    * @param sfRequest $request A request object
    */
   public function executeEnviarContenedores(sfWebRequest $request) {
      $user = $this->getUser();

      $this->numRef = str_replace("|", ".", $request->getParameter("ref"));

      $email = new Email();

      $email->setCaUsuenvio($user->getUserId());
      $email->setCaTipo("Contenedores"); //Envío de Avisos
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
      $email->addTo($user->getEmail());

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
      $mensaje .= sfContext::getInstance()->getController()->getPresentationFor('antecedentes', 'emailComodato');
      $email->setCaBodyhtml($mensaje);
      $email->save();
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
                                WHERE ca_modalidad=? AND o.ca_idtrafico=? AND ca_destino=? )  ", array(utf8_decode($modalidad), $origen, $destino));

         if ($queryType == "hbl") {
            $q->addWhere("UPPER(s.ca_doctransporte) LIKE ?", "%" . strtoupper($criterio) . "%");
            //$q->addWhere("r.ca_modalidad=? and ca_destino=?",array(utf8_decode($modalidad),$destino));
         } else {
            $q->addWhere("r.ca_consecutivo LIKE ?", $criterio . "%");
         }

         $q->addOrderBy("r.ca_consecutivo desc");
         $q->addOrderBy("r.ca_version  desc");
         $q->distinct();
         //echo $q->getSqlQuery();
         $reportes = $q->execute();
         $result = array();
         $conse = "";
         foreach ($reportes as $reporte) {
            /* if (!$reporte->esUltimaVersion()) {
              //echo "1.1";
              continue;
              } */
            if ($reporte->getInoClientesSea()) {
               // echo "2.1";
               continue;
            }

            $status = $reporte->getUltimoStatus();

            $row = array();
            if ($status && $status->getCaDoctransporte() && $reporte->getCaConsecutivo() != $conse) {

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
            $conse = $reporte->getCaConsecutivo();
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
      $ref->setCaFchrecibido(date("Y-m-d H:i:s"));
      $ref->setCaEstado("D"); //desbloqueado        
      $ref->save();
      
      // Calcula un estimado del tiempo de transito
      $diff = Utils::diffDays($ref->getCaFchembarque(), $ref->getCaFcharribo());
      
      if ($diff > 20) {      // Aplica para Referencias con más de 20 días de tiempo de tránsito
          $titulo = "Seguimiento Referencia $numref por llegada de motonave en ".$ref->getCaFcharribo();
          $texto = "Ha programado un seguimiento para una Referencia, por favor haga click en el link para realizar esta tarea";
          $tarea = new NotTarea();
          $tarea->setCaUrl("/colsys_php/inosea.php?boton=Consultar&id=$numref");
          $tarea->setCaIdlistatarea(12);
          
          list($ano, $mes, $dia) = sscanf($ref->getCaFcharribo(), "%d-%d-%d %d:%d:%d");
          $fch_ven = mktime( 0, 0, 0, $mes, $dia - 5, $ano);  // Calcula 5 días antes de la llegada de la motonave
          $fch_ven = date("Y-m-d", $fch_ven);
          $tarea->setCaFchvencimiento($fch_ven . " 23:59:59");
          $tarea->setCaFchvisible($fch_ven . " 00:00:00");
          $tarea->setCaUsucreado($this->getUser()->getUserId());
          $tarea->setCaTitulo($titulo);
          $tarea->setCaTexto($texto);
          $tarea->save();
          
          $loginsAsignaciones = array($this->getUser()->getUserId());
          $loginsAsignaciones = array_unique($loginsAsignaciones);
          $tarea->setAsignaciones($loginsAsignaciones);
        }

        $this->hijas = Doctrine::getTable("InoClientesSea")
              ->createQuery("c")
              ->where("c.ca_referencia = ?", $numref)
              ->execute();

      //if ($format == "email") {

      foreach ($this->hijas as $hija) {
         $reporte = $hija->getReporte();
         if ($reporte) {
            if ($reporte->getCaIdtareaAntecedente() > 0) {
               $tarea = $reporte->getNotTareaAntecedente();
               if ($tarea) {
                  $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
                  $tarea->setCaUsuterminada($this->getUser()->getuserId());
                  $tarea->setCaObservaciones( $tarea->getCaObservaciones()." terminada:executeAceptarReferencia" );
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
      try {
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

         $email->setCaSubject("Rechazo de Antecedentes " . $this->numRef);
         $email->setCaBody($this->getRequestParameter("mensaje"));

         $mensaje = Utils::replace($this->getRequestParameter("mensaje")) . "<br />";
         $email->setCaBodyhtml($mensaje);


         $email->save();
         $email->send();

         $ref = Doctrine::getTable("InoMaestraSea")->find($this->numRef);
         $this->forward404Unless($ref);
         $ref->setCaEstado("R"); //rechazado

         $ref->save();
         $this->responseArray = array("success" => true);
      } catch (Exception $e) {
         print_r($e->getMessage());
         $this->responseArray = array("success" => false);
      }
      $this->setTemplate("responseTemplate");
   }

   public function executeAnularReferencia(sfWebRequest $request) {

      $conn = Doctrine::getTable("InoMaestraSea")->getConnection();
      $conn->beginTransaction();

      try {
         $numref = str_replace("|", ".", $request->getParameter("ref"));
         $this->forward404Unless(trim($request->getParameter("motivo")));

         $master = Doctrine::getTable("InoMaestraSea")->find($numref);
         //$master= new InoMaestraSea();
         $emails = $master->getEmails();
         $master->delete($conn);

         $this->getUser()->log("Eliminacion Referencia " . $numref);

         foreach ($emails as $email) {
            $email->setCaSubject(str_replace(".", "-", $email->getCaSubject()));
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

   public function executeProcesarArchivohbls(sfWebRequest $request) {
      $modalidad = $request->getParameter("modalidad");
      $origen = $request->getParameter("origen");
      $destino = $request->getParameter("destino");

      $folder = "tmp";
      $file = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $request->getParameter("archivo");

      $reportes = array();
      $lines = file($file);
      for ($i = 0; $i < count($lines); $i++) {
         if (trim($lines[$i]) == "") {
            continue;
         }
         $tmp = null;
         $valido = true;
         $lines[$i] = trim($lines[$i]);
         $patron = '/(\d+)-(20\d\d)/';
         if (preg_match($patron, $lines[$i])) {
            $tmp = ReporteTable::retrieveByConsecutivo($lines[$i]);
            if ($tmp) {
               if ($tmp->getInoClientesSea()) {
                  $resultado.="1.1-linea :" . ($i + 1) . "->" . $lines[$i] . " :El RN esta asociado ya a otra referencia<br>";
                  $valido = false;
               }
               if ($tmp->getCaModalidad() != $modalidad) {
                  $resultado.="1.2-linea :" . ($i + 1) . "->" . $lines[$i] . " :Modalidad es diferente<br>";
                  $valido = false;
               }
               if ($tmp->getOrigen()->getCaIdtrafico() != $origen) {
                  $resultado.="1.3-linea :" . ($i + 1) . "->" . $lines[$i] . " :Origen es diferente<br>";
                  $valido = false;
               }
               if ($tmp->getCaDestino() != $destino) {
                  $resultado.="1.4-linea :" . ($i + 1) . "->" . $lines[$i] . " :destino es diferente<br>";
                  $valido = false;
               }
               if ($valido)
                  $reportes[] = array("ca_idreporte" => $tmp->getCaIdreporte(), "ca_consecutivo" => $lines[$i], "doctransporte" => $tmp->getUltimoStatus()->getCaDoctransporte(), "compania" => $tmp->getCliente()->getCaCompania(), "idcliente" => $tmp->getContacto()->getCaIdcliente(), "idcontacto" => $tmp->getCaIdconcliente());
            }
            else {
               $resultado.="1.5-linea :" . $i . "->" . $lines[$i] . " :Reporte no encontrado<br>";
            }
         } else {
            $tmp = RepStatus::retrieveByHbl($lines[$i]);
            if ($tmp) {
               $reporte = $tmp->getUltReporte();
               if ($reporte->getInoClientesSea()) {
                  $resultado.="2.1-linea :" . ($i + 1) . "->" . $lines[$i] . " :El RN esta asociado ya a otra referencia<br>";
                  $valido = false;
               }
               if ($reporte->getCaModalidad() != $modalidad) {
                  $resultado.="2.2-linea :" . ($i + 1) . "->" . $lines[$i] . " :Modalidad es diferente<br>";
                  $valido = false;
               }
               if ($reporte->getOrigen()->getCaIdtrafico() != $origen) {
                  $resultado.="2.3-linea :" . ($i + 1) . "->" . $lines[$i] . " :Origen es diferente<br>";
                  $valido = false;
               }
               if ($reporte->getCaDestino() != $destino) {
                  $resultado.="2.4-linea :" . ($i + 1) . "->" . $lines[$i] . " :destino es diferente<br>";
                  $valido = false;
               }
               if ($valido)
                  $reportes[] = array("ca_idreporte" => $tmp->getCaIdreporte(), "ca_consecutivo" => $reporte->getCaConsecutivo(), "doctransporte" => $lines[$i], "compania" => $reporte->getCliente()->getCaCompania(), "idcliente" => $reporte->getContacto()->getCaIdcliente(), "idcontacto" => $reporte->getCaIdconcliente());
            }
            else {
               $resultado.="2.5-linea :" . ($i + 1) . "->" . $lines[$i] . " :Hbl no encontrado<br>";
            }
         }
      }
      $this->responseArray = array("success" => true, "reportes" => $reportes, "resultado" => $resultado);
      $this->setTemplate("responseTemplate");
   }

   public function executeEliminarReporte(sfWebRequest $request) {
      try {
         $numref = str_replace("|", ".", $request->getParameter("referencia"));
         $idreporte = $request->getParameter("idreporte");

         Doctrine_Query::create()
                 ->delete()
                 ->from("InoClientesSea ic")
                 ->addWhere("ic.ca_referencia = ? and ic.ca_idreporte=? ", array($numref, $idreporte))
                 ->execute();

         Doctrine::getTable("Email")
                 ->createQuery("e")
                 ->update()
                 ->set("ca_subject", "replcace(ca_subject,'.','-')")
                 ->addWhere("ca_subject like ?", "%" . $this->getCaReferencia() . "%")
                 ->execute();
         $this->responseArray = array("success" => true);
      } catch (Exception $e) {
         $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
      }
      $this->setTemplate("responseTemplate");
   }

   public function executeArchivarReferencia(sfWebRequest $request) {
      try {
         $numref = str_replace("|", ".", $request->getParameter("referencia"));
         $this->forward404Unless($numref);
         $ref = Doctrine::getTable("InoMaestraSea")->find($numref);
         $this->forward404Unless($ref);
         $ref->setCaCarpeta(true);
         $ref->save();
         $this->responseArray = array("success" => true);
      } catch (Exception $e) {
         $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
      }
      $this->setTemplate("responseTemplate");
   }

   public function executeRadicarReferencia(sfWebRequest $request) {
      try {
         $numref = str_replace("|", ".", $request->getParameter("referencia"));
         $this->forward404Unless($numref);
         $ref = Doctrine::getTable("InoMaestraSea")->find($numref);
         $this->forward404Unless($ref);
         $ref->setCaUsumuisca($this->getUser()->getUserId());
         $ref->setCaFchmuisca(date('Y-m-d H:i:s'));
         $ref->save();
         $this->responseArray = array("success" => true);
      } catch (Exception $e) {
         $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
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
      if ($this->conta[0]) {
         $this->contactos = $this->conta[0]->getCaValor2();
      }

      $folder = "Referencias" . DIRECTORY_SEPARATOR . $this->ref->getCaReferencia();
      $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;
      $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);

      foreach ($archivos as $archivo) {
         $file = explode("/", $archivo);
         $filenames[]["file"] = $file[count($file) - 1];
      }
      $this->filenames = $filenames;
   }

   public function executeEmailNotification(sfWebRequest $request) {

      $numref = str_replace("|", ".", $request->getParameter("ref"));
      $this->forward404Unless($numref);

      $ref = Doctrine::getTable("InoMaestraSea")->find($numref);
      $this->forward404Unless($ref);

      //$master=new InoMaestraSea();
      $this->house = $ref->getInoClientesSea();

      $ref = Doctrine::getTable("InoMaestraSea")->find($numref);

      $this->setLayout($format);
      $this->ref = $ref;
      $this->user = $this->getUser();
      $this->format = $format;


      /*        $this->conta = ParametroTable::retrieveByCaso("CU098", $this->ref->getCaIdlinea());
        if($this->conta[0])
        {
        $this->contactos = $this->conta[0]->getCaValor2();
        }
       */
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

      $files = $this->getRequestParameter("files");
      foreach ($files as $archivo) {

         $name = $archivo;
         $email->AddAttachment($name);
      }
      $email->send();
      $email->save();
   }

   /**
    *
    *
    * @param sfRequest $request A request object
    */
   public function executeEntregaOportuna(sfWebRequest $request) {

      $q = Doctrine::getTable("EntregaAntecedentes")
              ->createQuery("e")
              ->innerJoin("e.Trafico t")
              ->innerJoin("e.Ciudad c")
              ->addOrderBy("t.ca_nombre, c.ca_ciudad");

      $this->antecedentes = $q->execute();
   }

   /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
   public function executeEditarEntregaOportuna(sfWebRequest $request) {
      $idtrafico = $request->getParameter("idtrafico");
      $idciudad = $request->getParameter("idciudad");
      $modalidad = $request->getParameter("modalidad");

      if ($idtrafico and $idciudad) {
         $antecedente = Doctrine::getTable("EntregaAntecedentes")->find(array($idtrafico, $idciudad, $modalidad));
         $this->forward404Unless($antecedente);
      } else {
         $antecedente = new EntregaAntecedentes();
      }
      $this->antecedente = $antecedente;
   }

}

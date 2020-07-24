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

    public function executeIndex(sfWebRequest $request) {
        
    }


    public function executeBuscarReferencia(sfWebRequest $request) {
      

        Doctrine_Core::getTable('InoMaster')->setAttribute(Doctrine_Core::ATTR_QUERY_LIMIT, Doctrine_Core::LIMIT_ROWS);

        $q = Doctrine::getTable("InoMaster")
           ->createQuery("m")
           ->select("m.*")
           ->leftJoin('m.InoHouse ic')
           ->addWhere("m.ca_referencia is null");

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
                $q->addWhere("m.ca_master = ?", $cadena);
                break;
            case "doctransporte":
                $q->addWhere("ic.ca_doctransporte like ?", $cadena . "%");
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
//        echo $q->getSqlQuery();
       
        $this->criterio = $criterio;
        $this->cadena = $cadena;
    }

    public function executeListadoReferencias(sfWebRequest $request) {

        $this->user = $this->getUser();
        $this->nivel = $this->user->getNivelAcceso(antecedentesActions::RUTINA);
        $this->format = $this->getRequestParameter("format");

        $where = "";
        if ($this->format == "") {
            $where = " and (m.ca_referencia is null and ((m.ca_modalidad='" . constantes::FCL . "' and u.ca_idsucursal='" . $this->user->getIdSucursal() . "') or (m.ca_modalidad<>'" . constantes::FCL . "' /*and  u.ca_idsucursal != '" . $this->user->getIdSucursal() . "'*/ )) )  
                and (ms.ca_estado='A' or ms.ca_estado='R' or ms.ca_estado is null) 
                ";
        } else {
            $where = " and ( (m.ca_referencia is null and ((m.ca_modalidad='" . constantes::FCL . "' and u.ca_idsucursal='" . $this->user->getIdSucursal() . "') or m.ca_modalidad<>'" . constantes::FCL . "') 
                and ms.ca_estado='E'
                ) OR (m.ca_referencia is not null AND ms.ca_fchmuisca IS NULL and SUBSTR(ca_referencia,1,3) NOT IN ('700','710','720','800','810','820') and ca_impoexpo <> '" . Constantes::TRIANGULACION . "' ))";
            $whereEmail = "";
        }

        $sql = "select m.ca_idmaster, m.ca_referencia,m.ca_fchreferencia,m.ca_modalidad,m.ca_motonave,m.ca_master, m.ca_fchsalida,m.ca_fchllegada,m.ca_usucreado,ori.ca_ciudad as ca_ciu_origen,des.ca_ciudad as ca_ciu_destino,u.ca_idsucursal,ms.ca_fchmuisca
                ,ms.ca_estado,m.ca_impoexpo
                from ino.tb_master m
                INNER JOIN ino.tb_master_sea ms ON m.ca_idmaster = ms.ca_idmaster
                JOIN tb_ciudades ori ON ori.ca_idciudad = m.ca_origen
                JOIN tb_ciudades des ON des.ca_idciudad = m.ca_destino
                JOIN control.tb_usuarios u ON u.ca_login = m.ca_usucreado
                where m.ca_impoexpo IN ('".Constantes::IMPO."','".Constantes::TRIANGULACION."') and ca_transporte='".(Constantes::MARITIMO)."' $where order by m.ca_referencia ";

//        echo $sql;
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $con = Doctrine_Manager::connection();
        $st = $con->execute($sql);        
        $referencias = $st->fetchAll();

        $this->refBloqueadas = array();
        $this->refRechazadas = array();
        $this->refSinMuisca = array();
        foreach ($referencias as $ref) {
            if (trim($ref["ca_referencia"]) == "") {
                if ($this->format == "maritimo") {
                    $this->refBloqueadas[] = $ref;
                } else {                    
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
       

        $this->sufijos = ParametroTable::retrieveByCaso("CU010");
        if ($this->user->getUserId() == "maquinche" /* || $this->user->getUserId()=="sandrade" */) {
          
        }
    }

   
    
    public function executeGuardarPanelMasterAntecedentes(sfWebRequest $request) {

        $this->user = $this->getUser();
        $conn = Doctrine::getTable("InoMasterSea")->getConnection();
        $conn->beginTransaction();
        try 
        {
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

            //$numref = str_replace("|", ".", $request->getParameter("referencia"));
            
            $idmaster = $request->getParameter("idmaster");

            if ($idmaster>0) {
                $master = Doctrine::getTable("InoMaster")->find($idmaster);
                $master->setCaReferencia(null);
                $this->forward404Unless($master);
            } else {
                $master = new InoMaster();
                $numref = "";//InoMasterTable::getNumReferencia($impoexpo, $transporte, $modalidad, $idorigen, $iddestino, $mmRef, $aaRef);
                //$master->setCaReferencia($numref);
                $master->setCaReferencia(null);
            }
            $master->setCaImpoexpo($impoexpo);
            $master->setCaModalidad($modalidad);
            $master->setCaTransporte($transporte);
            $master->setCaOrigen($idorigen);
            $master->setCaDestino($iddestino);
            $master->setCaMotonave($motonave);            
            $master->setCaFchsalida($fchsalida);            
            $master->setCaFchllegada($fchllegada);            
            $master->setCaFchreferencia($fchllegada);
            $master->setCaIdlinea($idlinea);
            $master->setCaMaster($mbls);
            $master->setCaFchmaster($fchmaster);
            
            $masterSea=$master->getInoMasterSea();
            $datos=array();
            if (!$masterSea->count()>0)
            if(!$masterSea || $masterSea->getCaIdmaster() != $master->getCaIdmaster())
            {
                $masterSea=new InoMasterSea();
                $masterSea->setCaEstado("A");
            }
            else
            {
                $datos= json_decode($masterSea->getCaDatos(),true);
            }
                        
            $master->setCaObservaciones($observaciones);
            
            $datos["ca_ciclo"]=$viaje;
            $datos["ca_tipo"]=($ntipo != "") ? $ntipo : null;
            $datos["ca_emisionbl"]=($idemisionbl != "") ? $idemisionbl : null;
            //$master->setCaProvisional(true);
            if ($this->user->getIdSucursal() == "BOG")
                $masterSea->getCaCarpeta(true);
            $masterSea->setCaDatos(json_encode($datos));
            $master->setInoMasterSea($masterSea);
            
            $master->save($conn);
            $idmaster=$master->getCaIdmaster();
            $q = $conn->createQuery()
               ->delete("ic.*")
               ->from('InoHouse ic')
               ->addWhere("ic.ca_idmaster = ? ", $idmaster);
            $q->execute();

            $consecutivos = json_decode($request->getParameter("reportes"),true);
            $imprimir = json_decode($request->getParameter("imprimirorigen"),true); 
            
            
            $i = 0;

            foreach ($consecutivos as $k=>$c) {                
                $consecutivo = $c;
                $reporte = ReporteTable::retrieveByConsecutivo($consecutivo);

                if ($reporte) {

                    $proveedores = $reporte->getProveedores();
                    $proveedor = $proveedores[0];                    

                    $status = $reporte->getUltimoStatus();
                    if ($status && $status->getCaDoctransporte()) {
                        
                
                        $valida = Doctrine::getTable("InoHouse")
                           ->createQuery("h")
                           ->innerJoin("h.InoMaster m")
                           ->addWhere("h.ca_idmaster != ? and h.ca_doctransporte= ? and m.ca_transporte=? ", array($idmaster, $status->getCaDoctransporte() , $reporte->getCaTransporte() ))
                           ->fetchOne();
                        if($consecutivo=="15643-2019")
                            echo $status->getCaDoctransporte()."<br>";
                        if ($valida)
                            continue;
                
                        $inoHouse = Doctrine::getTable("InoHouse")->findByDql( "ca_doctransporte=? and ca_idmaster=?",array($status->getCaDoctransporte(), $idmaster ));
                        
                        if (!$inoHouse->count()>0)
                        {
                            $inoHouse = new InoHouse();
                            $inoHouseSea = new InoHouseSea();
                        }
                        else
                        {
                            echo $status->getCaDoctransporte()."<br/>";                            
                            $inoHouseSea= $inoHouse->getInoHouseSea();
                            if(!$inoHouseSea->count()>0)
                                $inoHouseSea = new InoHouseSea();
                        }

                        $inoHouse->setCaIdreporte($reporte->getCaIdreporte());
                        $inoHouse->setCaIdmaster($idmaster);
                        $inoHouse->setCaIdcliente($reporte->getCliente()->getCaIdcliente());
                        $inoHouse->setCaDoctransporte($status->getCaDoctransporte());                        
                        $inoHouse->setCaIdtercero($proveedor->getCaIdtercero());                        
                        
                        $piezas = explode("|", $status->getCaPiezas());
                        $inoHouse->setCaNumpiezas($piezas[0] ? $piezas[0] : 0);                        
                        $peso = explode("|", $status->getCaPeso());
                        $inoHouse->setCaPeso($peso[0] ? $peso[0] : 0);                        
                        $volumen = explode("|", $status->getCaVolumen());                        
                        $inoHouse->setCaVolumen($volumen[0] ? $volumen[0] : 0);                        
                        $inoHouse->setCaNumorden($reporte->getCaOrdenClie());
                        $inoHouse->setCaVendedor($reporte->getCaLogin());
                        $inoHouse->setCaFchdoctransporte($fchmaster);
                               // echo $imprimir[$k];
                        $inoHouseSea->setCaImprimirorigen( ($imprimir[$k]=="true" || $imprimir[$k]=="1" || $imprimir[$k]==1)?true:false);
                        $inoHouseSea->setCaContinuacion($reporte->getCaContinuacion());                        
                        $inoHouseSea->setCaContinuacionDest($reporte->getCaContinuacionDest());

                        $idbodega = $reporte->getTerceroBodega();
                        if ($reporte->getCaContinuacion() == "OTM" && $idbodega > 0) {
                            $inoHouse->setCaIdbodega($reporte->getTerceroBodega());
                        }                        
                        $inoHouse->setInoHouseSea($inoHouseSea);
                        $inoHouse->save($conn);
                    }
                }
            }

            $conn->commit();
            $this->responseArray = array("success" => true, "idmaster" => $idmaster);
        } 
        catch (Exception $e) {
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
            $iddestino = ($request->getParameter("iddestino")) ? $request->getParameter("iddestino") : "999-9999";
            $modalidad = utf8_decode($request->getParameter("modalidad"));
            $numdias = $request->getParameter("numdias");
            $observaciones = ($request->getParameter("observaciones")) ? $request->getParameter("observaciones") : "";
            $this->forward404Unless($numdias);

            $antecedente = Doctrine::getTable("EntregaAntecedentes")->find(array($idtrafico, $idciudad, $iddestino, $modalidad));
            if (!$antecedente) {
                $antecedente = new EntregaAntecedentes();
                $antecedente->setCaIdtrafico($idtrafico);
                $antecedente->setCaIdciudad($idciudad);
                $antecedente->setCaIddestino($iddestino);
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
            $iddestino = ($request->getParameter("iddestino")) ? $request->getParameter("iddestino") : "999-9999";
            $modalidad = utf8_decode($request->getParameter("modalidad"));

            $antecedente = Doctrine::getTable("EntregaAntecedentes")->find(array($idtrafico, $idciudad, $iddestino, $modalidad));
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
            $numref = InoMasterTable::getNumReferencia($impoexpo, $transporte, $modalidad, $idorigen, $iddestino, $mmRef, $aaRef,"8");
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
        
        $datos = json_decode($master->getCaDatos());
        $datos->idempresa = 8;
        $datos = json_encode($datos);
        $master->setCaDatos($datos);
        
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

        $conn->commit();
        $this->responseArray = array("success" => true, "numref" => $idmaster,"idmaster" => $idmaster);
        /* } catch (Exception $e) {
          $conn->rollBack();
          $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()).".bog:".$idbodega);
          } */
        $this->setTemplate("responseTemplate");
    }

    public function executeAsignacionMaster(sfWebRequest $request) {

        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/CheckColumn", 'last');

        $this->idmaster= $request->getParameter("idmaster");

        if ($this->idmaster) {
            $ref = Doctrine::getTable("InoMaster")
               ->createQuery("m")
               ->addWhere("m.ca_idmaster = ? ", $this->idmaster)
               ->fetchOne();
            $numref = $ref->getCaReferencia();

            $this->forward404Unless($ref);
        } else {
            $ref = new InoMaster();
            $numref="";
        }

        $this->ref = $ref;
        $this->numRef = $numref;
    }

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
   
    
    public function executeDatosReferencia($request) {

         $this->forward404Unless($request->getParameter("idmaster"));
        $idmaster = $request->getParameter("idmaster");
        $ref = Doctrine::getTable("InoMaster")->find($idmaster);
        $this->forward404Unless($ref);
        if($ref->getInoMasterSea())
        {
            $datos=json_decode($ref->getInoMasterSea()->getCaDatos());
            if($datos->ca_tipo){
                $parametrosTipo = ParametroTable::retrieveByCaso("CU119", null, null, $datos->ca_tipo);
                foreach ($parametrosTipo as $parametroTipo) {
                    $tipo = $parametroTipo->getCaValor();
                    $ntipo = $parametroTipo->getCaIdentificacion();
                }
            }

            if($datos->ca_emisionbl){
                $emision=0;
                if($datos->ca_emisionbl==true)
                    $emision=$datos->ca_emisionbl;
                $parametrosEmision = ParametroTable::retrieveByCaso("CU223", null, null, $emision);
                foreach ($parametrosEmision as $parametroEmision) {
                    $emisionbl = $parametroEmision->getCaValor();
                    $idemisionbl = $parametroEmision->getCaIdentificacion();
                }
            }        
        }

        $data = array();

        $data["idmaster"] = $idmaster;
        $data["referencia"] = $ref->getCaReferencia();
        $data["motonave"] = $ref->getCaMotonave();
        $data["impoexpo"] = utf8_encode($ref->getCaImpoexpo());
        $data["transporte"] = utf8_encode(Constantes::MARITIMO);
        $data["modalidad"] = $ref->getCaModalidad();
        $data["origen"] = utf8_encode($ref->getOrigen()->getCaCiudad());
        $data["idorigen"] = $ref->getCaOrigen();
        $data["destino"] = utf8_encode($ref->getDestino()->getCaCiudad());
        $data["iddestino"] = $ref->getCaDestino();
        $data["fchsalida"] = $ref->getCaFchsalida();
        $data["fchllegada"] = $ref->getCaFchllegada();
        $data["idlinea"] = $ref->getCaIdlinea();

        $data["mbls"] = $ref->getCaMaster();
        $data["fchmaster"] = $ref->getCaFchmaster();
        $data["viaje"] = $datos->ca_ciclo;
        $data["observaciones"] = $ref->getCaObservaciones();
        $data["tipo"] = utf8_encode($tipo);
        $data["ntipo"] = $ntipo;
        $data["emisionbl"] = utf8_encode($emisionbl);
        $data["idemisionbl"] = $idemisionbl;
        $data["linea"] = $ref->getIdsProveedor()->getIds()->getCaNombre();
        
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }
    
   
    public function executeDatosPanelReportesAntecedentes(sfWebRequest $request) {

        $idmaster = $request->getParameter("idmaster");

        if ($idmaster) {
            $q = Doctrine_Query::create()
               ->select("*")
               ->from('InoHouse ih')               
               ->addWhere("ih.ca_idmaster = ? ", $idmaster);
            $houses = $q->execute();

            foreach ($houses as $key => $val) {
                $inoHouseSea=$val->getInoHouseSea();
                if($inoHouseSea->count()>0)
                    $datos=json_decode($val->getInoHouseSea()->getCaDatos());
                else
                    $inoHouseSea= new InoHouseSea();
                
                $reportes[$key]["r_ca_consecutivo"] = $val->getReporte()->getCaConsecutivo();
                $reportes[$key]["r_ca_idreporte"] = $val->getCaIdreporte();
                $reportes[$key]["ic_ca_proveedor"] = utf8_encode($val->getTercero()->getCaNombre());
                $reportes[$key]["ic_ca_numorden"] = utf8_encode($val->getCaNumorden());
                $reportes[$key]["cl_ca_compania"] = utf8_encode($val->getCliente()->getCaCompania());
                $reportes[$key]["ic_ca_hbls"] = utf8_encode($val->getCaDoctransporte());
                $reportes[$key]["orden"] = utf8_encode($val->getReporte()->getCaConsecutivo());
                $reportes[$key]["sel"] = $inoHouseSea->getCaImprimirorigen();
            }
        } else {
            $reportes = array();
        }

        $reportes[] = array("r_ca_consecutivo" => "+", "cl_ca_compania" => "", "orden" => "Z");        
        $this->responseArray = array("success" => true, "total" => count($reportes), "root" => $reportes);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosPanelReportesAntecedentesOTM(sfWebRequest $request) {
       
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

        $sql = "select distinct(r.ca_consecutivo), r.ca_idreporte, r.ca_origen, COALESCE(t.ca_nombre,cl.ca_compania ) as cl_ca_compania,
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
                r.ca_consecutivo not in (
                select (rrr.ca_consecutivo) 
                    from ino.tb_house icc
                            INNER JOIN tb_reportes rrr ON rrr.ca_idreporte = icc.ca_idreporte
                            INNER JOIN ino.tb_master m ON m.ca_idmaster = icc.ca_idmaster
                    where icc.ca_idreporte=rrr.ca_idreporte and m.ca_usuanulado is null ) and
                r.ca_tiporep=4 and r.ca_usuanulado is null and r.ca_fchcreado >'2018-01-01'
                $where ORDER BY ca_idreporte DESC";

        $con = Doctrine_Manager::getInstance()->connection();
        $st = $con->execute($sql);
        $this->datos = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
        
        foreach ($this->datos as $k => $d) {
            $this->datos[$k]["ca_bodega"] = utf8_encode($d["ca_bodega"]);
            $this->datos[$k]["muelle"] = utf8_encode($d["muelle"]);
            $this->datos[$k]["cl_ca_compania"] = utf8_encode($d["cl_ca_compania"]);
            $this->datos[$k]["ca_hbl"] = utf8_encode($d["ca_hbl"]);
        }
        
        //echo "<pre>";print_r($this->datos);echo "</pre>";
        
        $this->responseArray = array("success" => true, "total" => count($this->datos), "root" => $this->datos, "sql" => $sql);
        $this->setTemplate("responseTemplate");
    }

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

    public function executeVerPlanilla(sfWebRequest $request) {

        $idmaster = $request->getParameter("idmaster");
        $format = $request->getParameter("format");

        $this->forward404Unless($idmaster);

        $ref = Doctrine::getTable("InoMaster")->find($idmaster);
        $this->forward404Unless($ref);

        $this->hijas = Doctrine::getTable("InoHouse")
           ->createQuery("c")
           ->where("c.ca_idmaster = ?", $idmaster)
           ->execute();

        if ($format == "email") {
            $this->setLayout($format);
        } else {
            $sql = "select 
                            im.ca_referencia, im.ca_fchsalida, ims.ca_datos, ea1.ca_dias::int as ca_numdias, ea2.ca_dias::int as ca_numdias2, ea3.ca_dias::int as ca_numdias3 
                        from ino.tb_master im 
                        inner join  ino.tb_master_sea ims  on im.ca_idmaster=ims.ca_idmaster
                        inner join tb_ciudades cd on im.ca_origen = cd.ca_idciudad
                    left join tb_entrega_antecedentes ea1 on ea1.ca_idtrafico::text = cd.ca_idtrafico::text and ea1.ca_idciudad::text = '999-9999' and ea1.ca_modalidad = ''
                    left join tb_entrega_antecedentes ea2 on ea2.ca_idtrafico::text = cd.ca_idtrafico::text and ea2.ca_idciudad::text = im.ca_origen::text
                    left join tb_entrega_antecedentes ea3 on ea3.ca_idtrafico::text = cd.ca_idtrafico::text and ea3.ca_modalidad::text = im.ca_modalidad::text
                    where im.ca_idmaster = $idmaster";

            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $antecedentes = $st->fetchAll();

            list($ano, $mes, $dia) = sscanf($antecedentes[0]['ca_fchsalida'], "%d-%d-%d");
            if ($antecedentes[0]['ca_numdias3'] !== null) {
                $this->ent_opo = date("Y-m-d", mktime(0, 0, 0, $mes, $dia + $antecedentes[0]['ca_numdias3'], $ano));
            } else if ($antecedentes[0]['ca_numdias2'] !== null) {
                $this->ent_opo = date("Y-m-d", mktime(0, 0, 0, $mes, $dia + $antecedentes[0]['ca_numdias2'], $ano));
            } else if ($antecedentes[0]['ca_numdias'] !== null) {
                $this->ent_opo = date("Y-m-d", mktime(0, 0, 0, $mes, $dia + $antecedentes[0]['ca_numdias'], $ano));
            } else {
                $this->ent_opo = null;
            }

            $this->ent_efe = date("Y-m-d");
            $dif_mem = Utils::compararFechas($this->ent_efe, $this->ent_opo);
            $datos =json_decode($antecedentes[0]['ca_datos']);
            $dif_mem = ($datos->ca_tipo == 1 || $datos->ca_tipo == 2) ? 0 : $dif_mem;
            if ($dif_mem > 0) {
                $this->antecedente_justifica = true;
            } else {
                $this->antecedente_justifica = false;
            }
        }
        $this->ref = $ref;
        $this->datos=$ref->getInoMasterSea()->getCaDatos();
        $this->user = $this->getUser();
        $this->format = $format;

        $this->emails = $ref->getEmails();

        $usuarios = Doctrine::getTable("Usuario")
           ->createQuery("u")
           ->addWhere("u.ca_departamento = ?  and u.ca_activo=true ", array("Marítimo"))
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

        if ($archivos) {
            $filename = array();
            foreach ($archivos as $archivo) {
                $file = explode("/", $archivo);
                $filenames[]["file"] = $file[count($file) - 1];
            }
            $this->filenames = $filenames;
        }
       
    }

    public function executeEnviarAntecedentes(sfWebRequest $request) {
        $user = $this->getUser();

        $this->idmaster = str_replace("|", ".", $request->getParameter("idmaster"));
        $this->justificacion_idg = $request->getParameter("justificacion_idg");
        
        
        $ref = Doctrine::getTable("InoMaster")->find($this->idmaster);
        $this->forward404Unless($ref);
        $inoMasterSea=$ref->getInoMasterSea();

        $email = new Email();

        $email->setCaUsuenvio($user->getUserId());
        $email->setCaTipo("Antecedentes"); //Envío de Avisos
        $email->setCaIdcaso($this->idmaster);

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

        $email->setCaSubject($ref->getCaMaster()." ".$this->getRequestParameter("asunto"));
        $email->setCaBody($this->getRequestParameter("mensaje"));

        $mensaje = Utils::replace($this->getRequestParameter("mensaje")) . "<br />";
        if (isset($this->justificacion_idg) and trim($this->justificacion_idg) != "") {
            $mensaje.= "<br />Justificaci&oacute;n IDG: " . $this->justificacion_idg . "<br />";
        }
        $request->setParameter("format", "email");
        $mensaje .= sfContext::getInstance()->getController()->getPresentationFor('antecedentes', 'verPlanilla');
        $email->setCaBodyhtml($mensaje);
        $email->save();

        
        if($inoMasterSea)
        {
            $inoMasterSea->setCaEstado("E"); //Enviado
            $inoMasterSea->setCaFchenvio(date("Y-m-d H:i:s"));
        }
        else
        {
            $inoMasterSea=new InoMasterSea();
            $inoMasterSea->setCaEstado("E"); //Enviado
            $inoMasterSea->setCaFchenvio(date("Y-m-d H:i:s"));
        }
        
        if (isset($this->justificacion_idg) and trim($this->justificacion_idg) != "") {
            $datos=json_decode($inoMasterSea->getCaDatos());
            $datos->idg=utf8_encode($this->justificacion_idg);
            $inoMasterSea->setCaDatos(json_encode($datos));           
        }
        $ref->setInoMasterSea($inoMasterSea);
        $ref->save();
    }

    /*public function executeEmailComodato(sfWebRequest $request) {

        $numRef = str_replace("|", ".", $request->getParameter("ref"));
        $format = $request->getParameter("format");

        $this->forward404Unless($numRef);

        $ref = Doctrine::getTable("InoMaestraSea")->find($numRef);
        $this->forward404Unless($ref);

        $usrRef = array();
        $usrRef[] = $ref->getCaUsuconfirmado();

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
    }*/

    /*public function executeEmailAutorizacion(sfWebRequest $request) {

        $numRef = str_replace("|", ".", $request->getParameter("ref"));
        $format = $request->getParameter("format");

        $this->forward404Unless($numRef);

        $ref = Doctrine::getTable("InoMaestraSea")->find($numRef);
        $this->forward404Unless($ref);

        $usrRef = array();
        $usrRef[] = $ref->getCaUsucreado();

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
        foreach ($hijas as $hija) {
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
        foreach ($ciudades as $ciudad) {
            $this->destinos[] = $ciudad->getCaCiudad();
        }
    }*/

    /*public function executeEnviarContenedores(sfWebRequest $request) {
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
    }*/

    public function executeListaReportesJSON() {
        $criterio = trim($this->getRequestParameter("query"));
        $queryType = trim($this->getRequestParameter("queryType"));

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
                ->leftJoin('r.InoHouse ic')
                ->leftJoin('ic.InoMaster im')
                ->addWhere("r.ca_usuanulado IS NULL")
                ->addWhere("im.ca_referencia IS NULL")
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
            
            $debug = $q->getSqlQuery();
            $reportes = $q->execute();
            $result = array();
            $conse = "";
            foreach ($reportes as $reporte) {
                //echo $reporte->getInoHouse()->getFirst()->getInoMaster()->getCaFchanulado();
                if ($reporte->getInoHouse()->getFirst()) {
                    if($reporte->getInoHouse()->getFirst()->getCaIdhouse() && $reporte->getInoHouse()->getFirst()->getInoMaster()->getCaFchanulado() === null)                    
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
                    $row["ic_ca_referencia"] = utf8_encode($reporte->getInoHouse()->getFirst() ? $reporte->getInoHouse()->getFirst()->getInoMaster()->getCaReferencia() : null);
                    $row["s_ca_doctransporte"] = utf8_encode($status->getCaDoctransporte());
                    $result[] = $row;
                }
                $conse = $reporte->getCaConsecutivo();
            }
            $this->responseArray = array("total" => count($result), "root" => $result, "success" => true, "debug"=>$debug);
        } else {
            $this->responseArray = array("root" => array(), "total" => 0, "success" => true);
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeAceptarReferencia(sfWebRequest $request) {

        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        $ref = Doctrine::getTable("InoMaster")->find($idmaster);
        $this->forward404Unless($ref);
        
        if(!$ref->getCaReferencia() || $ref->getCaReferencia()=="" || $ref->getCaReferencia()==null){
            $user = $this->getUser();

            $masterSea=$ref->getInoMasterSea();
            $mmRef = Utils::parseDate($ref->getCaFchllegada(), "m");
            $aaRef = substr(Utils::parseDate($ref->getCaFchllegada(), "Y"), -2, 2);

            if (Utils::parseDate($ref->getCaFchllegada(), "d") >= "26") {
                $mmRef = $mmRef + 1;
                if ($mmRef >= 13) {
                    $mmRef = "01";
                    $aaRef = $aaRef + 1;
                }
            }

            $numref = InoMasterTable::getNumReferencia($ref->getCaImpoexpo(), $ref->getCaTransporte(), $ref->getCaModalidad(), $ref->getCaOrigen(), $ref->getCaDestino(), $mmRef, $aaRef);
            $ref->setCaReferencia($numref);
            $houses=$ref->getInoHouse();
            $piezas=$peso=$volumen=0;

            foreach($houses as $h)
            {
                $piezas+=$h->getCaNumpiezas();
                $peso+=$h->getCaPeso();
                $volumen+=$h->getCaVolumen();
                
                $reporte = $h->getReporte();
                $reporte->finTareaAntecedentes();
                
            }
            $masterSea->setCaFchrecibido(date("Y-m-d H:i:s"));
            $masterSea->setCaEstado("D"); //desbloqueado  

            $ref->setCaPiezas($piezas);
            $ref->setCaPeso($peso);
            $ref->setCaVolumen($volumen);
            $ref->setInoMasterSea($masterSea);
            $ref->save();

            $archivos=ArchivosTable::getArchivosActivos(array("ref1"=>$idmaster));

            foreach($archivos as $a)
            {
                $a->mover(array("ref1"=>$numref));
            }

            // Calcula un estimado del tiempo de transito
            $diff = Utils::diffDays($ref->getCaFchsalida(), $ref->getCaFchllegada());

            if ($diff > 20) {      // Aplica para Referencias con más de 20 días de tiempo de tránsito
                $titulo = "Seguimiento Referencia {$ref->getCaReferencia()} por llegada de motonave en " . $ref->getCaFchllegada();
                $texto = "Ha programado un seguimiento para una Referencia, por favor haga click en el link para realizar esta tarea";
                $tarea = new NotTarea();
                $tarea->setCaUrl("/inoF2/indexExt5/idmaster/$idmaster");
                $tarea->setCaIdlistatarea(12);

                list($ano, $mes, $dia) = sscanf($ref->getCaFchllegada(), "%d-%d-%d %d:%d:%d");
                $fch_ven = mktime(0, 0, 0, $mes, $dia - 5, $ano);  // Calcula 5 días antes de la llegada de la motonave
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


            $email = new Email();
            $email->addTo($ref->getUsuCreado()->getCaEmail());
            $email->setCaUsuenvio($this->getUser()->getUserId());
            $email->setCaTipo("Antecedentes"); //Envío de Avisos
            $email->setCaIdcaso($idmaster);
            $from = $this->getRequestParameter("from");
            $email->setCaFrom($user->getEmail());
            $email->setCaFromname($user->getNombre());
            $email->setCaReadreceipt(false);
            $email->setCaReplyto($user->getEmail());
            if($ref->getUsuCreado()->getCaDepartamento()=="Cuentas Globales" || $ref->getUsuCreado()->getCaDepartamento()=="Servicio al Cliente Marítimo")
            {                
                $email->addTo($ref->getUsuCreado()->getCaEmail());                
            }
            $email->setCaSubject("Aceptacion de referencia $numref");                
            $request->setParameter("format", "email");
            $mensaje .= sfContext::getInstance()->getController()->getPresentationFor('antecedentes', 'verPlanilla');
            $email->setCaBodyhtml($mensaje);
            $email->save();
        }
        $this->redirect("/inoF2/indexExt5/idmaster/$idmaster");
    }

    public function executeVerArchivos(sfWebRequest $request) {
        $numref = str_replace("|", ".", $request->getParameter("ref"));

        $this->ref = Doctrine::getTable("InoMaestraSea")->find($numref);
        $this->forward404Unless($this->ref);

        $this->numref = $numref;
    }

    public function executeRechazarReferencia(sfWebRequest $request) {
        try {
            $user = $this->getUser();
            $this->idmaster = $request->getParameter("idmaster");
            
            $ref = Doctrine::getTable("InoMaster")->find($this->idmaster);
            $this->forward404Unless($ref);

            if($ref->getCaReferencia()=="")                
            {
                $this->idmaster = $request->getParameter("idmaster");

                $email = new Email();
                $email->setCaUsuenvio($user->getUserId());
                $email->setCaTipo("Antecedentes"); //Envío de Avisos
                $email->setCaIdcaso(null);
                $email->setCaFrom($user->getEmail());
                $email->setCaFromname($user->getNombre());

                $master = Doctrine::getTable("InoMaster")->find($this->idmaster);
                $email->addTo($master->getUsuCreado()->getCaEmail());

                $email->addCc($user->getEmail());

                $email->setCaSubject("Rechazo de Antecedentes: Master #: " . $ref->getCaMaster());
                $email->setCaIdcaso($this->idmaster);
                $email->setCaBody($this->getRequestParameter("mensaje"));

                $mensaje = Utils::replace($this->getRequestParameter("mensaje")) . "<br />master".$ref->getCaMaster();
                $email->setCaBodyhtml($mensaje);
                $email->save();
                
                $masterSea = $ref->getInoMasterSea();
                $masterSea->setCaEstado("R"); //rechazado
                $ref->save();

                $this->responseArray = array("success" => true);
            }else
            {
                $this->responseArray = array("success" => false,"errorInfo"=>"Referencia ya fue desbloqueada");
            }
        } catch (Exception $e) {
            //print_r($e->getMessage());
            $this->responseArray = array("success" => false,"errorInfo"=>$e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeAnularReferencia(sfWebRequest $request) {

        $conn = Doctrine::getTable("InoMaster")->getConnection();
        $conn->beginTransaction();

        try {
            $idmaster = $request->getParameter("idmaster");
            $this->forward404Unless(trim($request->getParameter("motivo")));

            //$master=new InoMaster();
            $master = Doctrine::getTable("InoMaster")->find($idmaster);            
            $emails = $master->getEmails();
            /*$master->setCaFchanulado(date("Y-m-d H:i:s"));
            $master->setCaUsuanulado($this->getUser()->getUserId());                
            $master->setCaMotivoanulado($request->getParameter("motivo"));
            $master->save();*/
            $master->delete($conn);

            $this->getUser()->log("Eliminacion Referencia " . $idmaster);

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
            //try{
                if (trim($lines[$i]) == "") {
                    continue;
                }
                $tmp = null;
                $valido = true;
                $lines[$i] = trim($lines[$i]);
                $patron = '/(\d+)-(20\d\d)/';
                if (preg_match($patron, $lines[$i])) {                    
                    $tmp = ReporteTable::retrieveByConsecutivo($lines[$i]);
                    if ($tmp!==null) {
                        //print_r($tmp->getInoHouse());
                        if ($tmp->getInoClientesSea() || $tmp->getInoHouse()===null) {
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
                            $reportes[] = array("ca_idreporte" => $tmp->getCaIdreporte(), "ca_consecutivo" => $lines[$i], "doctransporte" => $tmp->getUltimoStatus()->getCaDoctransporte(), "compania" => utf8_encode($tmp->getCliente()->getCaCompania()), "idcliente" => $tmp->getContacto()->getCaIdcliente(), "idcontacto" => $tmp->getCaIdconcliente());
                    }
                    else {
                        $resultado.="1.5-linea :" . $i . "->" . $lines[$i] . " :Reporte no encontrado<br>";
                    }
                } else {                    
                    $tmp = RepStatus::retrieveByHbl($lines[$i]);
                    if ( $tmp->count()>0) {
                        $reporte = $tmp[0]->getUltReporte();

                        if ( count($reporte->getInoClientesSea())<1 && count($reporte->getInoHouse()->count())<1) {
                            $resultado.="2.1-linea :" . ($i + 1) . "->" . $lines[$i] . " :El RN esta asociado ya a otra referencia<br>";
                            $valido = false;
                        }
                        if ($reporte->getCaModalidad() != $modalidad) {
                            $resultado.="2.2-linea :" . ($i + 1) . "->" . $lines[$i] . " :Modalidad es diferente<br>";
                            $valido = false;
                        }
                        if ($reporte->getOrigen()->getCaIdtrafico() != $origen) {
                            $resultado.="2.3-linea :" . ($i + 1) . "->" . $lines[$i] . " :Origen es diferente ".$reporte->getOrigen()->getCaIdtrafico()." :". $origen."<br>";
                            $valido = false;
                        }
                        if ($reporte->getCaDestino() != $destino) {
                            $resultado.="2.4-linea :" . ($i + 1) . "->" . $lines[$i] . " :destino es diferente<br>";
                            $valido = false;
                        }
                        if ($valido)
                        {                             
                            $reportes[] = array("ca_idreporte" => $reporte->getCaIdreporte(), 
                                    "ca_consecutivo" => $reporte->getCaConsecutivo(), 
                                    "doctransporte" => $lines[$i], 
                                    "compania" => utf8_encode($reporte->getCliente()->getCaCompania()), 
                                    "idcliente" => $reporte->getContacto()->getCaIdcliente(), 
                                    "idcontacto" => $reporte->getCaIdconcliente());
                        }
                    }
                    else {
                        $resultado.="2.5-linea :" . ($i + 1) . "->" . $lines[$i] . " :Hbl no encontrado<br>";
                    }
                }                
            /*} catch (Exception $ex) {
                print_r($ex->getMessage());
                continue;

            }*/
            
        }
        $this->responseArray = array("success" => true, "reportes" => $reportes, "resultado" => $resultado);
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarReporte(sfWebRequest $request) {
        //try {
            $idmaster = $request->getParameter("idmaster");
            $idreporte = $request->getParameter("idreporte");

            Doctrine_Query::create()
               ->delete()
               ->from("InoHouse ic")
               ->addWhere("ic.ca_idmaster = ? and ic.ca_idreporte=? ", array($idmaster, $idreporte))
               ->execute();

            /*Doctrine::getTable("Email")
               ->createQuery("e")
               ->update()
               ->set("ca_subject", "replcace(ca_subject,'.','-')")
               ->addWhere("ca_subject like ?", "%" . $this->getCaReferencia() . "%")
               ->execute();*/
            $this->responseArray = array("success" => true);
        /*} catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }*/
        $this->setTemplate("responseTemplate");
    }

    public function executeArchivarReferencia(sfWebRequest $request) {
        try {
            $idmaster = $request->getParameter("idmaster");
            $this->forward404Unless($idmaster);
            $ref = Doctrine::getTable("InoMasterSea")->find($idmaster);
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
            $idmaster = $request->getParameter("idmaster");
            $this->forward404Unless($idmaster);
            $ref = Doctrine::getTable("InoMasterSea")->find($idmaster);
            $this->forward404Unless($ref);            
            $ref->setCaCarpeta(true);
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

//        $numref = str_replace("|", ".", $request->getParameter("ref"));
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);

        $ref = Doctrine::getTable("InoMaster")->find($idmaster);
        $this->forward404Unless($ref);

        $this->setLayout($format);
        $this->ref = $ref;
        $this->user = $this->getUser();
        $this->format = $format;
       
        $this->conta = ParametroTable::retrieveByCaso("CU098", $this->ref->getIdsProveedor()->getIds()->getCaIdalterno());

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
        $this->setLayout("email");
        
    }

    public function executeEmailNotification(sfWebRequest $request) {

        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($numref);

        $ref = Doctrine::getTable("InoMaster")->find($idmaster);
        $this->forward404Unless($ref);

        $this->house = $ref->getInoHouse();
        //$ref = Doctrine::getTable("InoMaestraSea")->find($numref);
        $this->setLayout($format);
        $this->ref = $ref;
        $this->user = $this->getUser();
        $this->format = $format;
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
        $email->setCaBodyhtml($mensaje);

        $files = $this->getRequestParameter("files");
        foreach ($files as $archivo) {

            $name = $archivo;
            $email->AddAttachment($name);
        }
        $email->save();
        $this->setLayout("email");
    }

    public function executeEntregaOportuna(sfWebRequest $request) {

        $q = Doctrine::getTable("EntregaAntecedentes")
           ->createQuery("e")
           ->innerJoin("e.Trafico t")
           ->innerJoin("e.Ciudad c ON e.ca_idciudad = c.ca_idciudad")
           ->innerJoin("e.Ciudad d ON e.ca_iddestino = d.ca_idciudad")
           ->addOrderBy("t.ca_nombre, c.ca_ciudad");

        $this->antecedentes = $q->execute();
    }

    public function executeEditarEntregaOportuna(sfWebRequest $request) {
        $idtrafico = $request->getParameter("idtrafico");
        $idciudad = $request->getParameter("idciudad");
        $iddestino = $request->getParameter("iddestino");
        $modalidad = $request->getParameter("modalidad");

        if ($idtrafico and $idciudad and $iddestino) {
            $antecedente = Doctrine::getTable("EntregaAntecedentes")->find(array($idtrafico, $idciudad, $iddestino, $modalidad));
            $this->forward404Unless($antecedente);
        } else {
            $antecedente = new EntregaAntecedentes();
        }
        $this->antecedente = $antecedente;
    }

    public function executeEliminarEntregaOportuna(sfWebRequest $request) {
        $idtrafico = $request->getParameter("idtrafico");
        $idciudad = $request->getParameter("idciudad");
        $iddestino = $request->getParameter("iddestino");
        $modalidad = $request->getParameter("modalidad");
        try {
            if ($idtrafico and $idciudad and $iddestino and $modalidad) {
                $antecedente = Doctrine::getTable("EntregaAntecedentes")->find(array($idtrafico, $idciudad, $iddestino, $modalidad));
                $this->forward404Unless($antecedente);
                $antecedente->delete();
            }
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
    }
    
    public function executeMigracionAntecedentes(sfWebRequest $request) {
        
        
        //$conn = Doctrine::getTable("InoMasterSea")->getConnection();
        //$con->beginTransaction();
        
            
       
            $this->user = $this->getUser();
            $sql="select m.ca_referencia,m.ca_fchreferencia,m.ca_provisional,m.ca_modalidad,m.ca_motonave,m.ca_mbls, m.ca_fchembarque,
                m.ca_fcharribo,m.ca_usucreado,ori.ca_ciudad as ca_ciu_origen,des.ca_ciudad as ca_ciu_destino,u.ca_idsucursal,m.ca_fchmuisca,m.ca_tipo
                    ,m.ca_estado,m.ca_impoexpo,m.ca_fchcreado,m.ca_usucreado,m.ca_fchactualizado,m.ca_usuactualizado
                    from tb_inomaestra_sea m
                    JOIN tb_ciudades ori ON ori.ca_idciudad = m.ca_origen
                    JOIN tb_ciudades des ON des.ca_idciudad = m.ca_destino
                    JOIN control.tb_usuarios u ON u.ca_login = m.ca_usucreado
                    where m.ca_fchcreado>='2011-03-01' and m.ca_provisional = true
                order by m.ca_referencia";

            $sql="select m.*
                    from tb_inomaestra_sea m                
                    where m.ca_fchcreado>='2011-03-01' and m.ca_provisional = true
                order by m.ca_referencia";

            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->datos = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);

            foreach($this->datos as $d)
            {

                $master = new InoMaster();
                $numref = "";//InoMasterTable::getNumReferencia($impoexpo, $transporte, $modalidad, $idorigen, $iddestino, $mmRef, $aaRef);
                $master->setCaReferencia(null);
                $master->setCaImpoexpo($d["ca_impoexpo"]);
                $master->setCaModalidad($d["ca_modalidad"]);
                $master->setCaTransporte(Constantes::MARITIMO);
                $master->setCaOrigen($d["ca_origen"]);
                $master->setCaDestino($d["ca_destino"]);
                $master->setCaMotonave($d["ca_motonave"]);            
                $master->setCaFchsalida($d["ca_fchembarque"]);            
                $master->setCaFchllegada($d["ca_fcharribo"]);            
                $master->setCaFchreferencia($d["ca_fchreferencia"]);
                $master->setCaIdlinea($d["ca_idlinea"]);
                $master->setCaMaster($d["ca_mbls"]);
                $master->setCaFchmaster($d["ca_fchmbls"]);
                
                $master->setCaFchcreado($d["ca_fchcreado"]);
                $master->setCaUsucreado($d["ca_usucreado"]);
                $master->setCaFchactualizado($d["ca_fchactualizado"]);
                $master->setCaUsuactualizado($d["ca_usuactualizado"]);
                
                $masterSea=$master->getInoMasterSea();
                $datos=array();
                //if (!$masterSea->count()>0)
                if(!$masterSea || $masterSea->getCaIdmaster() != $master->getCaIdmaster())
                {
                    $masterSea=new InoMasterSea();
                    //$masterSea->setCaEstado("A");
                }
                else
                {
                    $datos= json_decode($masterSea->getCaDatos(),true);                    
                }

                $master->setCaObservaciones($d["observaciones"]);

                $datos["ca_ciclo"]=$d["ca_ciclo"];
                $datos["ca_tipo"]=$d["ca_tipo"];
                $datos["ca_emisionbl"]=$d["ca_emisionbl"];
                
                $masterSea->setCaEstado($d["ca_estado"]);
                //$master->setCaProvisional(true);
                if ($this->user->getIdSucursal() == "BOG")
                    $masterSea->getCaCarpeta(true);
                $masterSea->setCaDatos(json_encode($datos));
                $master->setInoMasterSea($masterSea);
                $master->stopBlaming();
                $master->save();
                /*     FIN MASTER        */


                echo "<pre>";
                print_r($d);
                echo "</pre>";

                $sql="select c.*
                    from tb_inoclientes_sea c
                    where c.ca_referencia='".$d["ca_referencia"]."'";

                $st = $con->execute($sql);
                $inoclientes = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);

                foreach($inoclientes as $i)
                {
                    echo "<pre>";
                    print_r($i);
                    echo "</pre>";

                    $house = new InoHouse();
                    $house->setCaIdmaster($master->getCaIdmaster());
                    $house->setCaIdreporte($i["ca_idreporte"]);

                    $house->setCaDoctransporte($i["ca_hbls"]);
                    $house->setCaFchdoctransporte($i["ca_fchhbls"]);
                    $house->setCaIdtercero($i["ca_idproveedor"]);
                    $house->setCaTercero($i["ca_proveedor"]);
                    $house->setCaIdcliente($i["ca_idcliente"]);
                    $house->setCaVendedor($i["ca_login"]);
                    $house->setCaNumorden($i["ca_numorden"]);
                    $house->setCaNumpiezas($i["ca_numpiezas"]);
                    $house->setCaPeso($i["ca_peso"]);
                    $house->setCaVolumen($i["ca_volumen"]);
                    if ($i["ca_idbodega"] > 0)
                        $house->setCaIdbodega($i["ca_idbodega"]);

                    $houseSea = new InoHouseSea();                
                    $houseSea->setCaContinuacion($i["ca_continuacion"]);
                    $houseSea->setCaContinuacionDest($i["ca_continuacion_dest"]);
                    
                    $house->setInoHouseSea($houseSea);
                    
                    $house->setCaFchcreado($d["ca_fchcreado"]);
                    $house->setCaUsucreado($d["ca_usucreado"]);
                    $house->setCaFchactualizado($d["ca_fchactualizado"]);
                    $house->setCaUsuactualizado($d["ca_usuactualizado"]);
                    $house->stopBlaming();
                    $house->save();

                }
            }
        //$con->commit();
        exit;
        
    }
    
    public function executeMigracionAntecedentesDocs(sfWebRequest $request) 
    {
        
        
         $sql="select m.*
                    from tb_inomaestra_sea m                
                    where m.ca_fchcreado>='2011-03-01' and m.ca_provisional = true
                order by m.ca_referencia";

            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $datos = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
            
        $this->idsserie = "2";        
        echo count($datos)."<br>";
        
        
        foreach($datos as $d)
        {

            $ino = Doctrine::getTable("InoMaster")->findOneBy("ca_master", $d["ca_mbls"] );
            
            
            //echo $ino->getCaIdmaster().":".$d["ca_referencia"]."-".$ino->getCaReferencia().":<br>";
            $ref1="";
            if($ino->getCaReferencia()!="")
            {
                echo $d["ca_referencia"]."-".$ino->getCaReferencia()."<br>";
                $ref1=$ino->getCaReferencia();
                
            }
            else
            {
                echo $d["ca_referencia"]."-".$ino->getCaIdmaster()."<br>";
                $ref1=$ino->getCaIdmaster();
            }
            $q = Doctrine::getTable("Archivos")
                    ->createQuery("a")
                    ->select("a.*,t.ca_documento")
                    ->innerJoin("a.TipoDocumental t")
                    ->addWhere("a.ca_fcheliminado IS NULL")
                    //->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                    ->orderBy("ca_ref2 desc")           
                    ->andWhere("a.ca_ref1=?",$d["ca_referencia"]);

            $this->archivos=$q->execute();
            
            echo "<p>";
            foreach($this->archivos as $a)
            {
                echo $a->getCaNombre()."-";
                $a->setCaRef1($ref1);
                $a->stopBlaming();
                $a->save();
            }
            //echo count($this->archivos);
            echo "</p>";
            //exit;
        }
        exit;
    }
    
    public function executeMigracionAntecedentesImprbl(sfWebRequest $request) 
    {
 
        $sql="select m.*
                    from tb_inomaestra_sea m                
                    where m.ca_fchcreado>='2011-03-01' and m.ca_provisional = true
                order by m.ca_referencia";

            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->datos = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);

            foreach($this->datos as $d)
            { 
                $sql="select c.*
                    from tb_inoclientes_sea c
                    where c.ca_referencia='".$d["ca_referencia"]."'";

                $st = $con->execute($sql);
                $inoclientes = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);

                foreach($inoclientes as $i)
                {
                    $inohouse = Doctrine::getTable("InoHouse")->findOneBy("ca_doctransporte", $i["ca_hbls"] );
                    $inohouseSea=$inohouse->getInoHouseSea();
                    if($i["ca_imprimirorigen"]=="1")
                        $inohouseSea->setCaImprimirorigen(true);
                    else
                        $inohouseSea->setCaImprimirorigen(false);
                 
                    $inohouseSea->stopBlaming();
                    $inohouseSea->save();
                        //echo ".............".$inohouseSea->getCaImprimirorigen().".....";
                    echo $inohouseSea->getCaIdhouse().":".$i["ca_hbls"]."--".$i["ca_imprimirorigen"]."<br>";
                }
            }
            exit;
    }
}

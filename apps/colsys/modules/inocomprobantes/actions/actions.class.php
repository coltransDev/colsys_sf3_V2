<?php

/**
 * inocomprobantes actions.
 *
 * @package    colsys
 * @subpackage inocomprobantes
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inocomprobantesActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndexExt4(sfWebRequest $request) {
        
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeFormComprobante(sfWebRequest $request) {

        $this->tipo = $request->getParameter("tipo");

        if ($request->getParameter("idinocliente")) {
            $this->inocliente = Doctrine::getTable("InoCliente")->find($request->getParameter("idinocliente"));
            $this->forward404Unless($this->inocliente);

            $request->setParameter("idmaestra", $this->inocliente->getCaIdmaestra());
        }

        if ($request->getParameter("idcomprobante")) {
            $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
            $this->forward404Unless($this->comprobante);
        } else {
            $this->comprobante = new InoComprobante();
        }

        if ($this->comprobante->getCaEstado() != InoComprobante::ABIERTO) {
            $this->redirect("inocomprobantes/verComprobante?id=" . $this->comprobante->getCaIdcomprobante());
        }
    }

    public function executeFormComprobanteExt4(sfWebRequest $request) {

        $this->tipo = $request->getParameter("tipo");

        /* if( $request->getParameter("idinocliente") ){
          $this->inocliente = Doctrine::getTable("InoCliente")->find($request->getParameter("idinocliente"));
          $this->forward404Unless( $this->inocliente );

          $request->setParameter("idmaestra", $this->inocliente->getCaIdmaestra());
          } */

        if ($request->getParameter("idcomprobante")) {
            $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
            $this->forward404Unless($this->comprobante);
        } else {
            $this->comprobante = new InoComprobante();
        }

        if ($this->comprobante->getCaEstado() != InoComprobante::ABIERTO) {
            $this->redirect("inocomprobantes/verComprobante?id=" . $this->comprobante->getCaIdcomprobante());
        }
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeObserveFormComprobantePanel(sfWebRequest $request) {

        $idinocliente = $request->getParameter("idinocliente");
        $this->responseArray = array("idinocliente" => $idinocliente, "success" => false);


        if ($request->getParameter("idcomprobante")) {
            $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
            $this->forward404Unless($comprobante);
        } else {
            $comprobante = new InoComprobante();
            $comprobante->setCaIdtipo($request->getParameter("idtipo"));
            $comprobante->setCaConsecutivo(InoComprobanteTable::siguienteConsecutivo($request->getParameter("idtipo")));
        }
        if ($request->getParameter("consecutivo")) {
            $comprobante->setCaConsecutivo($request->getParameter("consecutivo"));
        }
        $comprobante->setCaFchcomprobante($request->getParameter("fechacomprobante"));
        $comprobante->setCaIdinocliente($idinocliente);
        $comprobante->setCaId($request->getParameter("id"));
        $comprobante->setCaPlazo($request->getParameter("plazo"));
        $comprobante->setCaTasacambio($request->getParameter("tasacambio"));
        $comprobante->save();

        $this->responseArray["success"] = true;
        $this->responseArray["idcomprobante"] = $comprobante->getCaIdcomprobante();



        $this->setTemplate("responseTemplate");
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeFormComprobanteData(sfWebRequest $request) {

        $this->modo = $request->getParameter("modo");

        $this->forward404Unless($request->getParameter("idcomprobante"));
        $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
        $this->forward404Unless($comprobante);


        $tipo = $comprobante->getInoTipoComprobante();

        $baseRow = array("idinocliente" => $comprobante->getCaIdinocliente(),
            "idcomprobante" => $comprobante->getCaIdcomprobante(),
        );
        $items = array();

        $q = Doctrine::getTable("InoTransaccion")
                ->createQuery("t")
                ->select("t.ca_idtransaccion, t.ca_idconcepto, t.ca_db, t.ca_valor,
                                c.ca_idconcepto,c.ca_concepto, cc.ca_idccosto, cc.ca_centro,
                                cc.ca_subcentro, cc.ca_nombre, cu.ca_cuenta, m.ca_referencia, m.ca_idmaestra")
                ->innerJoin("t.InoConcepto c")
                ->leftJoin("t.InoCentroCosto cc")
                ->leftJoin("t.InoCuenta cu")
                ->leftJoin("t.InoMaestra m")
                ->where("t.ca_idcomprobante = ? ", $comprobante->getCaIdcomprobante())
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        //echo $q->getSqlQuery();
        //exit;
        $transacciones = $q->execute();


        $centros = Doctrine::getTable("InoCentroCosto")
                ->createQuery("c")
                ->select("c.*")
                ->where("c.ca_subcentro IS NULL")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
        $centrosArray = array();
        foreach ($centros as $centro) {
            $centrosArray[$centro["c_ca_centro"]] = $centro["c_ca_nombre"];
        }

        foreach ($transacciones as $transaccion) {
            if ($transaccion["t_ca_db"] !== null) {
                $db = $transaccion["t_ca_db"] ? "D" : "C";
            } else {
                $db = null;
            }
            $items[] = array_merge($baseRow, array(
                "idtransaccion" => $transaccion["t_ca_idtransaccion"],
                "idconcepto" => $transaccion["t_ca_idconcepto"],
                "idccosto" => $transaccion["cc_ca_idccosto"],
                "concepto" => utf8_encode($centrosArray[$transaccion['cc_ca_centro']] . " " . $transaccion['cc_ca_nombre'] . " » " . $transaccion["c_ca_concepto"]),
                "centro" => str_pad($transaccion['cc_ca_centro'], 2, "0", STR_PAD_LEFT) . "-" . str_pad($transaccion['cc_ca_subcentro'], 2, "0", STR_PAD_LEFT),
                "codigo" => str_pad($transaccion['cc_ca_centro'], 2, "0", STR_PAD_LEFT) . str_pad($transaccion['cc_ca_subcentro'], 2, "0", STR_PAD_LEFT) . str_pad($transaccion["c_ca_idconcepto"], 4, "0", STR_PAD_LEFT),
                "db" => $db,
                "valor" => $transaccion["t_ca_valor"],
                "referencia" => $transaccion["m_ca_referencia"],
                "idmaestra" => $transaccion["m_ca_idmaestra"]
            ));
        }

        $items[] = array_merge($baseRow, array("idcuenta" => "",
            "idconcepto" => "",
            "concepto" => "+"
        ));
        $this->responseArray = array("items" => $items);
        $this->setTemplate("responseTemplate");
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeObserveFormComprobanteSubpanel(sfWebRequest $request) {

        $id = $request->getParameter("id");
        $this->responseArray = array("id" => $id, "success" => false);


        $this->forward404Unless($request->getParameter("idcomprobante"));
        $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
        $this->forward404Unless($comprobante);

        $tipo = $comprobante->getInoTipoComprobante();

        if ($request->getParameter("idtransaccion")) {
            $transaccion = Doctrine::getTable("InoTransaccion")->find($request->getParameter("idtransaccion"));
        } else {
            $transaccion = new InoTransaccion();
            $transaccion->setCaIdcomprobante($request->getParameter("idcomprobante"));
        }

        //$transaccion->setCaId( 1 );
        $transaccion->setCaIdconcepto($request->getParameter("idconcepto"));
        if ($request->getParameter("valor") == "D") {
            $transaccion->setCaDb(true);
        } else {
            $transaccion->setCaDb(false);
        }
        if ($request->getParameter("valor") !== null) {
            $transaccion->setCaValor($request->getParameter("valor"));
        }

        if ($request->getParameter("idmaestra") !== null) {
            $transaccion->setCaIdmaestra($request->getParameter("idmaestra"));
        }

        $transaccion->setCaIdccosto($request->getParameter("idccosto"));
        $transaccion->setCaIdmoneda("USD");
        $transaccion->save();

        $this->responseArray["success"] = true;
        $this->responseArray["idtransaccion"] = $transaccion->getCaIdtransaccion();

        $this->setTemplate("responseTemplate");
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeEliminarFormComprobanteSubpanel(sfWebRequest $request) {
        $id = $request->getParameter("id");
        $this->responseArray = array("id" => $id, "success" => false);


        $this->forward404Unless($request->getParameter("idcomprobante"));
        $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
        $this->forward404Unless($comprobante);

        if ($request->getParameter("idtransaccion")) {
            $transaccion = Doctrine::getTable("InoTransaccion")->find($request->getParameter("idtransaccion"));
            $this->forward404Unless($transaccion);
            $transaccion->delete();
            $this->responseArray["success"] = true;
        }

        $this->setTemplate("responseTemplate");
    }

    /**
     * Vista previa del comprobante (Prefactura)
     *
     * @param sfRequest $request A request object
     */
    public function executePreviewComprobante(sfWebRequest $request) {
        $this->forward404Unless($request->getParameter("id"));
        $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("id"));
        $this->forward404Unless($this->comprobante);


        $this->transacciones = Doctrine::getTable("InoTransaccion")
                ->createQuery("t")
                ->innerJoin("t.InoConcepto con")
                ->innerJoin("con.InoCuenta c")
                ->where("t.ca_idcomprobante = ? ", $this->comprobante->getCaIdcomprobante())
                ->addOrderBy("con.ca_ingreso_propio")
                ->addOrderBy("c.ca_cuenta")
                ->execute();

        $this->comprobante->getInoTransaccion();
    }

    /**
     * Genera el comprobante y lo transfiere a SIIGO
     *
     * @param sfRequest $request A request object
     */
    public function executeGenerarComprobante(sfWebRequest $request) {
        $this->forward404Unless($request->getParameter("id"));
        $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("id"));
        $this->forward404Unless($comprobante);
        $modo = $request->getParameter("modo");
        $tipo = $comprobante->getInoTipoComprobante();

        if ($comprobante->getcaEstado() == InoComprobante::ABIERTO) {

            try {
                $tipo = $comprobante->getInoTipoComprobante();

                $conn = $comprobante->getTable()->getConnection();
                $conn->beginTransaction();


                $transacciones = Doctrine::getTable("InoTransaccion")
                        ->createQuery("t")
                        ->select("t.*")
                        ->where("t.ca_idcomprobante = ? ", $comprobante->getCaIdcomprobante())
                        ->execute();

                $impuestos = array();

                $totales = array();
                $total = 0;

                if ($tipo->getCaTipo() == "F") {
                    foreach ($transacciones as $transaccion) {
                        $concepto = $transaccion->getInoConcepto();



                        $parametro = $transaccion->getInoParametroFacturacion();
                        if (!$parametro) {
                            $conn->rollBack();
                            throw new Exception('La parametrizacion no esta correctamente definida: Comprobante:' . $comprobante->getCaIdcomprobante() . " Transaccion: " . $transaccion->getCaIdtransaccion());
                        }

                        $total+=$transaccion->getCaValor();
                        $transaccion->setCaIdcuenta($parametro->getCaIdcuenta());
                        $transaccion->save($conn);

                        $imp = $transaccion->getImpuestos();

                        foreach ($imp as $key => $val) {
                            if (!isset($impuestos[$key])) {
                                $impuestos[$key]["db"] = 0;
                                $impuestos[$key]["cr"] = 0;
                            }
                            $impuestos[$key]["db"]+=$imp[$key]["db"];
                            $impuestos[$key]["cr"]+=$imp[$key]["cr"];
                        }
                    }



                    if ($impuestos["iva"] > 0) {
                        $transaccion = new InoTransaccion();
                        $transaccion->setCaDb(false);
                        $transaccion->setCaValor($impuestos["iva"]["cr"] - $impuestos["iva"]["db"]);
                        $transaccion->setCaIdmoneda("USD");
                        //$transaccion->setCaIdconcepto( 240 );
                        $transaccion->setCaIdcuenta($tipo->getCaIdctaIva());
                        $transaccion->setCaIdcomprobante($comprobante->getCaIdcomprobante());
                        $transaccion->save($conn);
                        $total += $impuestos["iva"]["cr"] - $impuestos["iva"]["db"];
                    }
                }

                if ($tipo->getCaTipo() == "P") {
                    foreach ($transacciones as $transaccion) {
                        $concepto = $transaccion->getInoConcepto();
                        $parametro = $transaccion->getInoParametroCosto();
                        if (!$parametro) {
                            $conn->rollBack();
                            throw new Exception('La parametrizacion no esta correctamente definida: Comprobante:' . $comprobante->getCaIdcomprobante() . " Transaccion: " . $transaccion->getCaIdtransaccion());
                        }
                        if ($transaccion->getCaDb()) {
                            $total-=$transaccion->getCaValor();
                        } else {
                            $total+=$transaccion->getCaValor();
                        }

                        $transaccion->setCaIdcuenta($parametro->getCaIdcuenta());
                        $transaccion->save($conn);
                    }
                }

                $transaccion = new InoTransaccion();
                if ($total > 0) {
                    $transaccion->setCaDb(true);
                    $transaccion->setCaValor($total);
                } else {
                    $transaccion->setCaDb(false);
                    $transaccion->setCaValor($total * (-1));
                }
                $transaccion->setCaIdmoneda("USD");
                $transaccion->setCaIdcuenta($tipo->getCaIdctaCierre());
                $transaccion->setCaIdcomprobante($comprobante->getCaIdcomprobante());
                $transaccion->save($conn);

                $comprobante->setCaEstado(InoComprobante::PARA_TRANSFERIR);
                $comprobante->save();
                $conn->commit();
            } catch (Exception $e) {

                throw $e;
                $conn->rollBack();
            }
        }

        $this->redirect("inocomprobantes/verComprobante?id=" . $comprobante->getCaIdcomprobante());
    }

    /**
     * Muestra el comprobante en un iframe
     *
     * @param sfRequest $request A request object
     */
    public function executeVerComprobante(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $this->forward404Unless($request->getParameter("id"));
        $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("id"));
        $this->forward404Unless($this->comprobante);

        $inoCliente = $this->comprobante->getInoCliente();
        $request->setParameter("idmaestra", $inoCliente->getcaIdmaestra());
    }

    /**
     * Genera el comprobante y lo transfiere a SIIGO
     *
     * @param sfRequest $request A request object
     */
    public function executeGenerarComprobantePDF(sfWebRequest $request) {
        //Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $this->forward404Unless($request->getParameter("id"));
        $this->tipoImpresion = $request->getParameter("tipo");
        $this->orden = $request->getParameter("orden");
        $this->idioma = ($request->getParameter("idioma")!=""?$request->getParameter("idioma"):"esp");
        if($this->idioma== "" || !$this->idioma || $this->idioma==null )
            $this->idioma=="esp";
        
        $this->trd = ($request->getParameter("trd")!=""?$request->getParameter("trd"):"0");

        $ids = json_decode($request->getParameter("id"));


        $this->comprobantes = Doctrine::getTable("InoComprobante")
                ->createQuery("c")
                ->select("*")
                ->andWhereIn("ca_idcomprobante", $ids)
                ->execute();

        $this->transacciones = array();

        $this->userId = $this->getUser()->getUserId();


        foreach ($this->comprobantes as $this->comprobante) {

            $this->forward404Unless($this->comprobante);
            //echo $request->getParameter("id");
            //exit;
            $this->filename = $request->getParameter("filename");

            $tipo = $this->comprobante->getInoTipoComprobante();


            switch ($tipo->getCaTipo()) {
                /* case "P":
                  $this->setTemplate("generarComprobanteP");
                  $this->transacciones = Doctrine::getTable("InoDetalle")
                  ->createQuery("t")
                  ->select("t.*, con.*, p.*")
                  ->innerJoin("t.InoConcepto con")
                  ->innerJoin("con.InoParametroCosto p")
                  ->addWhere("t.ca_idconcepto IS NOT NULL") //TEMPORAL
                  //->innerJoin("con.InoCuenta c")
                  ->addWhere("t.ca_idcomprobante = ? ", $this->comprobante->getCaIdcomprobante() )
                  //->addOrderBy("c.ca_cuenta")
                  ->execute();
                  break;
                  case "F_OLD":
                  $this->setTemplate("generarComprobanteF");
                  $q = Doctrine::getTable("InoDetalle")
                  ->createQuery("t")
                  ->select("t.*, con.*, p.*")
                  ->innerJoin("t.InoConcepto con")
                  ->leftJoin("con.InoParametroFacturacion p")
                  ->addWhere("t.ca_idconcepto IS NOT NULL") //TEMPORAL
                  //->innerJoin("con.InoCuenta c")
                  ->addWhere("t.ca_idcomprobante = ? ", $this->comprobante->getCaIdcomprobante() )
                  ->addOrderBy("p.ca_ingreso_propio");
                  //->addOrderBy("c.ca_cuenta")
                  //                echo $q->getSqlQuery();
                  //                exit;
                  $this->transacciones=$q->execute();
                  break;
                 */
                case "F":
                    $orden=",s.ca_concepto_esp";
                    if ($tipo->getCaAplicacion() == "1") {
                        $this->setTemplate("pdfFacturaSap");
                        switch($this->orden)
                        {
                            case "1";
                                //$orden="";
                                break;
                            case "2";
                                $orden=",s.ca_idconcepto";
                                break;
                            case "3";
                                $orden="";
                                break;
                        }

                        $this->transacciones[$this->comprobante->getCaIdcomprobante()] = Doctrine::getTable("InoDetalle")
                            ->createQuery("det")
                            ->select("det.*,s.*")
                            ->innerJoin("det.InoComprobante comp")
                            ->innerJoin("comp.InoTipoComprobante tcomp")
                            ->leftJoin('det.InoMaestraConceptos s  ')
                            ->addWhere("det.ca_idconcepto IS NOT NULL")
                            ->addWhere("det.ca_idcomprobante = ? ", $this->comprobante->getCaIdcomprobante())
                            ->addOrderBy("det.ca_idcuenta$orden")
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                            ->execute();                        
                    } else {
                        $this->setTemplate("generarComprobanteF");
                        
                        $this->transacciones[
                            $this->comprobante->getCaIdcomprobante()] = 
                                Doctrine::getTable("InoDetalle")
                                    ->createQuery("det")
                                    ->select("det.*,s.*,cric.ca_rteica")
                                    ->innerJoin("det.InoComprobante comp")
                                    ->innerJoin("comp.InoTipoComprobante tcomp")
                                    ->leftJoin('det.InoConSiigo s WITH tcomp.ca_idempresa=s.ca_idempresa ')
                                    ->leftJoin("tcomp.Ctarteica cric WITH tcomp.ca_idempresa=cric.ca_idempresa ")
                                    ->addWhere("det.ca_idconcepto IS NOT NULL")
                                    ->addWhere("det.ca_idcomprobante = ? ",$this->comprobante->getCaIdcomprobante()  )
                                    ->addOrderBy("s.ca_pt DESC,s.ca_cod")
                                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                    ->execute();
                        }

                    
                    /* echo "<pre>";
                      print_r($this->transacciones);
                      echo "</pre>";
                      exit; */

                    break;
                case "C":
                case "D":
                      if ($tipo->getCaAplicacion() == "1") {
                        $this->setTemplate("pdfNotacreditoSap");
                        
                        $this->transacciones[$this->comprobante->getCaIdcomprobante()] = Doctrine::getTable("InoDetalle")
                            ->createQuery("det")
                            ->select("det.*,s.*, im.ca_referencia")
                            ->innerJoin("det.InoComprobante comp")
                            ->innerJoin("comp.InoTipoComprobante tcomp")
                            ->leftJoin('det.InoMaestraConceptos s  ')
                            ->leftJoin('det.InoHouse h  ')
                            ->leftJoin('det.InoMaster im  ')
                            ->addWhere("det.ca_idconcepto IS NOT NULL")
                            ->addWhere("det.ca_idcomprobante = ? ", $this->comprobante->getCaIdcomprobante())
                            ->addOrderBy("det.ca_idcuenta,s.ca_concepto_esp")
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                            ->execute();
//                        echo "<pre>";print_r($this->transacciones);echo "</pre>";
//                        exit;
                        
                    } else {
                        $this->setTemplate("generarComprobanteC");

                        $this->transacciones[$this->comprobante->getCaIdcomprobante()] = Doctrine::getTable("InoDetalle")
                            ->createQuery("det")
                            ->select("det.*,s.*")
                            ->innerJoin("det.InoComprobante comp")
                            ->innerJoin("comp.InoTipoComprobante tcomp")
                            ->leftJoin("tcomp.Ctarteica cric")
                            //->innerJoin("tcomp.InoCentroCosto ccosto")
                            ->leftJoin('det.InoConSiigo s WITH tcomp.ca_idempresa=s.ca_idempresa ')
                            ->addWhere("det.ca_idconcepto IS NOT NULL")
                            ->addWhere("det.ca_idcomprobante = ? ", $this->comprobante->getCaIdcomprobante())
                            ->addOrderBy("s.ca_pt DESC")
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                            ->execute();
                    }

                    break;
                case "R":
                    $this->setTemplate("generarComprobanteR");

                    $inodetalles = Doctrine::getTable("InoDetalle")
                            ->createQuery("det")
                            ->select("det.*")
                            ->innerJoin("det.InoComprobante comp")
                            ->innerJoin("comp.InoTipoComprobante tcomp")
                            //->leftJoin("tcomp.Ctarteica cric")
                            //->innerJoin("tcomp.InoCentroCosto ccosto")
                            //->leftJoin('det.InoConSiigo s WITH tcomp.ca_idempresa=s.ca_idempresa ')
                            //->addWhere("det.ca_idconcepto IS NOT NULL")
                            ->addWhere("det.ca_idcomprobante = ? ", $this->comprobante->getCaIdcomprobante())
                            //->addOrderBy("s.ca_pt DESC")
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                            ->execute();
                    $this->cabecera = array();
                    foreach ($inodetalles as $inodetalle) {

                        if ($inodetalle["det_ca_observaciones"] == "CABECERA") {
                            $this->cabecera[$this->comprobante->getCaIdcomprobante()] = $inodetalle;
                        } else
                            $this->transacciones[$this->comprobante->getCaIdcomprobante()][] = $inodetalle;
                    }
                    break;
                case "P":
                        
                    $this->setTemplate("generarComprobanteP".$tipo->getCaAplicacion());
                                        
                    $q = Doctrine::getTable("InoDetalle")
                            ->createQuery("det")
                            ->select("det.*");
                    
                    switch($tipo->getCaAplicacion()){
                        case 0: // SIIGO
                            $q->addSelect("s.*");
                            $q->innerJoin("det.InoComprobante comp");
                            $q->innerJoin("comp.InoTipoComprobante tcomp");
                            $q->leftJoin("tcomp.Ctarteica cric");
                            $q->leftJoin('det.InoConSiigo s WITH tcomp.ca_idempresa=s.ca_idempresa ');
                            $q->addOrderBy("s.ca_pt DESC");
                            break;
                        case 1: //SAP BO
                            $q->addSelect("mc.*, im.ca_idmaster, im.ca_referencia");
                            $q->leftJoin("det.InoMaestraConceptos mc");
                            $q->innerJoin("det.InoMaster im");
                            break;
                    }
                            
                    $q->addWhere("det.ca_idconcepto IS NOT NULL");
                    $q->addWhere("det.ca_idcomprobante = ? ",$this->comprobante->getCaIdcomprobante());
                    $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                    
                    //echo $q->getSqlQuery();
                            
                    $inodetalles = $q->execute();
                    //echo "<pre>";print_r($inodetalles);echo "</pre>";
			
                    $this->cabecera = array();
                    foreach($inodetalles as $inodetalle){
                        if($inodetalle["det_ca_observaciones"] == "CABECERA"){
                            $this->cabecera[$this->comprobante->getCaIdcomprobante()] = $inodetalle;
                        }else
                            $this->transacciones[$this->comprobante->getCaIdcomprobante()][] = $inodetalle;
                    }       
                    break;
            }
        }
    }

    public function executeGenerarArchivo1(sfWebRequest $request) {
        $idcomprobante = $request->getParameter("idcomprobante");

        $this->filename = "cs.txt";
        $q = Doctrine::getTable("InoTransaccion")
                ->createQuery("t")
                ->innerJoin("t.InoComprobante c")
                ->innerJoin("t.InoCuenta cu");
        if ($idcomprobante) {
            $q->addWhere("t.ca_idcomprobante = ?", $idcomprobante);
            $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
            $this->filename = $comprobante . ".txt";
        }
        $this->transacciones = $q->execute();
        $this->setLayout("none");
    }

    /**
     * Genera el archivo plano para transferir a SIIGO
     *
     * @param sfRequest $request A request object
     */
    public function executeTransferirFactura(sfWebRequest $request) {
        ProjectConfiguration::registerZend();

        //$client = new Zend_Soap_Client( "http://10.194.1.102:85/WebService2/Service1.asmx?wsdl", array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 ));        
        ///WebService2/Service1.asmx/HelloWorld
        //$result = $client->Sumar(array("a" => "5", "b" =>"2"));
        //$result = $client->HelloWorld();

        $client = new Zend_Soap_Client("http://10.194.1.102:85/WebService2/Service1.asmx?wsdl", array('encoding' => 'ISO-8859-1', 'soap_version' => SOAP_1_2));
        $result = $client->actualiza(array(a => "2014", t => "F", nt => "1", c => "201"));

        print_r($result);
        exit();
    }

    public function executeGuardarComprobante(sfWebRequest $request) {


        $this->responseArray = array("errorInfo" => $errorInfo, "id" => implode(",", $ids), "idreg" => implode(",", $ids_reg), "success" => true, "consecutivo" => $consecutivo, "indincor" => $indincor, "wsdl" => $result);
        $this->setTemplate("responseTemplate");
        exit;

        $fecha = $request->getParameter("fecha");
        $idccosto = $request->getParameter("idccosto");
        $idempresa = $request->getParameter("idempresa");
        $idtercero = $request->getParameter("idtercero");
        $idtipocomprobante = $request->getParameter("idtipocomprobante");
        $movimientos = json_decode($request->getParameter("movimientos"));
        $total = $request->getParameter("total");

        $comprobante = new InoComprobante();
        $conn = $comprobante->getTable()->getConnection();
        $conn->beginTransaction();

        /* OBJETOS EXTERNOS */
        $tipoComprobante = Doctrine::getTable("InoTipoComprobante")->find($idtipocomprobante);
        $consecutivo = intval($tipoComprobante->getCaNumeracionActual()) + 1;
        $tipoComprobante->setCaNumeracionActual($consecutivo);
        $tipoComprobante->save($conn);

        $ccosto = Doctrine::getTable("InoCentroCosto")->find($idccosto);
        $cc = $ccosto->getCaCentro();
        $scc = $ccosto->getCaSubcentro();


        /* OBJETOS EXTERNOS */

        $comprobante->setCaConsecutivo($consecutivo);
        $comprobante->setCaIdtipo(15);
        $comprobante->setCaFchcomprobante(date("Y-m-d"));

        $comprobante->setCaId($idtercero);
        $comprobante->setCaValor($valor);
        $comprobante->setCaIdmoneda("COP");
        $comprobante->setCaTcambio("1");
        $comprobante->setCaPlazo("0");
        $comprobante->setCaObservaciones("Siigoconect desde colsys");
        $comprobante->save($conn);



        $idcomprobante = $comprobante->getCaIdcomprobante();
        $totaldb = $totalcr = 0;
        foreach ($movimientos as $t) {
            if ($t->cuenta == "")
                continue;

            $inoDetalle = new InoDetalle();

            $inoDetalle->setCaIdcomprobante($idcomprobante);

            $inoDetalle->setCaIdcuenta($t->cuenta);
            $inoDetalle->setCaId($t->idtercero);
            if ($t->naturaleza == "D") {
                $totaldb+=$t->valor;
                $inoDetalle->setCaDb($t->valor);
            } else {
                $inoDetalle->setCaCr($t->valor);
                $totalcr+=$t->valor;
            }

            $inoDetalle->save($conn);
            $ids[] = $t->id;
            $ids_reg[] = $inoDetalle->getCaIddetalle();
        }

        $cliente = Doctrine::getTable("Cliente")->find($idtercero);

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
        $comproSiigo->setNitApbCont($cliente->getCaIdalterno());
        $comproSiigo->setDvApbCont($cliente->getCaDigito());
        $comproSiigo->setIdSucCont("0");
        $comproSiigo->setTotalDbCont($totaldb);
        $comproSiigo->setTotalCrCont($totalcr);
        $comproSiigo->setIndIncorpCont("2");
        $comproSiigo->setCodaltUnegCont('1');
        $comproSiigo->setCodaltEmpreCont('4');
        //$comproSiigo->setCdErrsiigoCont();
        $comproSiigo->setIndAnulCont("N");
        //$comproSiigo->setArchivo();
        //$comproSiigo->setErrorArchivo();
        $comproSiigo->save($conn);
        //$comproSiigo->setCodaltUnegCont($comproSiigo->getIdUnegCont());
        //$comproSiigo->save($conn);

        /* $movs = Doctrine::getTable("InoDetalle")
          ->createQuery("det")
          ->select("det.*")
          ->addWhere("det.ca_idcomprobante = ? ",$idcomprobante  )
          ->execute();
         */


        foreach ($movimientos as $m) {
            if ($t->cuenta == "")
                continue;
            $detComproSiigo = new SiigoDetComprobante();
            $detComproSiigo->setIdUnegMovcont($comproSiigo->getIdUnegCont());
            $detComproSiigo->setCodDoccontMovcont($tipoComprobante->getCaTipo());
            $detComproSiigo->setNumTipDoccontMovcont($tipoComprobante->getCaComprobante());
            $detComproSiigo->setNumDoccontMovcont($consecutivo);
            $detComproSiigo->setCtaMovcont($t->cuenta);
            $detComproSiigo->setTpIdepcteMovcont("CC");
            $detComproSiigo->setSucMovcont("0");
            $detComproSiigo->setIdentPcteMovcont($m->idtercero); //nit
            //$detComproSiigo->set();
            $detComproSiigo->setDescripMovcont("Proceso Atomatico siigoconnect"); //

            $detComproSiigo->setValorMovcont($t->valor); //valor
            $detComproSiigo->setNatuMovcont($m->naturaleza); //naturaleza C o D
            $detComproSiigo->setVlBaseMovcont(0); //valor Base
            $detComproSiigo->setIdCcMovcont("0001"); //centro de costo
            $detComproSiigo->setIdBodegaMovcont("0001");
            //$detComproSiigo->setCodalInvMovcont("0010001000007");
            $detComproSiigo->setCodalInvMovcont("0");
            $detComproSiigo->setCantInvMovcont("1");
            $detComproSiigo->setCodaltDepMovcont("0");
            $detComproSiigo->setCodaltBodMovcont("0");
            $detComproSiigo->setCodaltUbiMovcont("0");
            $detComproSiigo->setCodaltCcMovcont($cc);
            $detComproSiigo->setIdAreaMovcont("0");
            $detComproSiigo->setCodaltSccMovcont($scc); //??
            $detComproSiigo->setTpIdterMovcont("CC");
            //$detComproSiigo->setIdentTerMovcont("800100600");//nit
            $detComproSiigo->setIdentTerMovcont($t->idtercero); //nit
            $detComproSiigo->setTipConCarMovcont($tipoComprobante->getCaTipo());
            $detComproSiigo->setComConCarMovcont($tipoComprobante->getCaComprobante());
            $detComproSiigo->setNumConCarMovcont($consecutivo);
            $detComproSiigo->setVctConCarMovcont(0);
            $detComproSiigo->setFecConMovcont(date("Y-m-d"));
            $detComproSiigo->setNomTercMovcont("SIIGONECT"); //
            $detComproSiigo->setConceptoNomMovcont(0);
            $detComproSiigo->setVariableAcumMovcont(0);
            $detComproSiigo->setNroquinAcumMovcont(0);
            $detComproSiigo->setTipModMovhbMovcont("");
            $detComproSiigo->setRefMasMovhbMovcont("");
            $detComproSiigo->setNroBlhMovhbMovcont("");
            $detComproSiigo->save($conn);
        }


        $conn->commit();

        ProjectConfiguration::registerZend();

        $client = new Zend_Soap_Client("http://10.192.1.97:8000/WebService2/Service1.asmx?wsdl", array('encoding' => 'ISO-8859-1', 'soap_version' => SOAP_1_2));
        ///WebService2/Service1.asmx/HelloWorld
        //$result = $client->Sumar(array("a" => "5", "b" =>"2"));
        $result = $client->actualiza(array(a => "2014", t => $tipoComprobante->getCaTipo(), nt => $tipoComprobante->getCaComprobante(), c => $consecutivo));

        //$this->referencia = Doctrine::getTable("SiigoDetComprobante")->find($comproSiigo->getIdUnegCont());
        //$comproSiigo->getIdUnegCont()
        $comproSiigo->refresh();
        $indincor = $comproSiigo->getIndIncorpCont();


        if ($indincor == "+6" || $indincor == "6") {
            $comprobante->setCaEstado(InoComprobante::ERROR_TRANSFERIDO);
        } else if ($indincor == "+5" || $indincor == "5") {
            $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
        }
        $comprobante->setCaConsecutivo($consecutivo);
        $comprobante->setCaFchcomprobante(date("Y-m-d"));
        //$comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
        $comprobante->save($conn);

        $this->responseArray = array("errorInfo" => $errorInfo, "id" => implode(",", $ids), "idreg" => implode(",", $ids_reg), "success" => true, "consecutivo" => $consecutivo, "indincor" => $indincor, "wsdl" => $result);
        $this->setTemplate("responseTemplate");
    }

}

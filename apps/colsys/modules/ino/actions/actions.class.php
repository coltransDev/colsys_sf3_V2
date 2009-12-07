<?php

/**
 * ino actions.
 *
 * @package    symfony
 * @subpackage ino
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class inoActions extends sfActions
{

    const RUTINA_AEREO = 15;
    const RUTINA_MARITIMO = 15;
    const RUTINA_ADUANA = 15;
    const RUTINA_EXPO = 15;

    public function getNivel( ){
        $this->modo = $this->getRequestParameter("modo");

        $this->nivel = -1;
		if( !$this->modo ){
			$this->forward( "ino", "seleccionModo" );
		}

		if( $this->modo=="aereo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( inoActions::RUTINA_AEREO );
		}

		if( $this->modo=="maritimo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( inoActions::RUTINA_MARITIMO );
		}

        if( $this->modo=="aduana" ){
			$this->nivel = $this->getUser()->getNivelAcceso( inoActions::RUTINA_ADUANA );
		}

        if( $this->modo=="expo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( inoActions::RUTINA_EXPO );
		}


		if( $this->nivel==-1 ){
			$this->forward404();
		}
        return $this->nivel;
    }


    /**
	 * Permite seleccionar el modo de operacion del programa
	 * @author: Andres Botero
	 */
	public function executeSeleccionModo()
	{
		$this->nivelAereo = $this->getUser()->getNivelAcceso( inoActions::RUTINA_AEREO );
		$this->nivelMaritimo = $this->getUser()->getNivelAcceso( inoActions::RUTINA_MARITIMO );
        $this->nivelAduana = $this->getUser()->getNivelAcceso( inoActions::RUTINA_ADUANA );
        $this->nivelExpo = $this->getUser()->getNivelAcceso( inoActions::RUTINA_EXPO );
	}

    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(sfWebRequest $request)
    {
        $this->nivel = $this->getNivel();
        $this->comerciales = UsuarioTable::getComerciales();
        $this->modo = $request->getParameter("modo");
    }

    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeBusqueda(sfWebRequest $request)
    {
        $this->nivel = $this->getNivel();
        $this->modo = $request->getParameter("modo");


        $criterio = $request->getParameter("criterio");
        $cadena = $request->getParameter("cadena");


        $q = Doctrine_Query::create()->from('InoMaestra m');
        $q->innerJoin( "m.Modalidad mod" );
        switch( $this->modo ){
            case "aereo":
                $q->addWhere( "mod.ca_impoexpo = ? and mod.ca_transporte = ?", array(Constantes::IMPO, Constantes::AEREO) );
                break;
            case "maritimo":
                $q->addWhere( "mod.ca_impoexpo = ? and mod.ca_transporte = ?", array(Constantes::IMPO, Constantes::MARITIMO) );
                break;
        }


        switch( $criterio ){
			case "nombre":
                $q->addWhere("m.ca_referencia LIKE ?", $cadena."%" );
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
		if( $this->pager->getResultsInPage()==1 && $this->pager->getPage()==1 ){
            $refs = $this->refList;
			$this->redirect("ino/verReferencia?modo=".$this->modo."&id=".$refs[0]->getCaIdmaestra());
		}
		$this->criterio = $criterio;
		$this->cadena = $cadena;

        



    }


    /**
    * 
    *
    * @param sfRequest $request A request object
    */
    public function executeFormIno(sfWebRequest $request)
    {

        $this->nivel = $this->getNivel();
        
        $this->modo = $request->getParameter("modo");

        switch( $this->modo ){
            case "maritimo":
                $this->transporte = Constantes::MARITIMO;
                break;
        }
        
        $referencia = Doctrine::getTable("InoMaestra")->find($request->getParameter("id"));
        if( !$referencia ){
            $referencia = new InoMaestra();
        }

        $form = new InoMaestraForm(  );
        

        

        $this->origen = $request->getParameter("origen");
        $this->destino = $request->getParameter("destino");
        if ($request->isMethod('post')){
            

            $ref = $request->getParameter($form->getName());            
            $form->bind( $ref );

			if( $form->isValid() ){
                if( !$request->getParameter("id") ){
                    $referencia->setCaReferencia( InoMaestraTable::getNumReferencia( $ref["ca_idmodalidad"], $ref["ca_origen"], $ref["ca_destino"], "01", "9" ) );
                    $referencia->setCaFchreferencia( date("Y-m-d") );
                }

                $referencia->setCaOrigen( $ref["ca_origen"] );
                $referencia->setCaDestino( $ref["ca_destino"] );
                $referencia->setCaIdlinea( $ref["ca_idlinea"] );
                $referencia->setCaMaster( $ref["ca_master"] );
                $referencia->setCaFchmaster( $ref["ca_fchmaster"] );
                $referencia->setCaIdmodalidad( $ref["ca_idmodalidad"] );
                

                if( $ref["ca_idagente"] ){
                    $referencia->setCaIdagente( $ref["ca_idagente"] );
                }else{
                    $referencia->setCaIdagente( null );
                }

                $referencia->save();
                echo $referencia->getCaIdmaestra();
                $this->redirect("ino/verReferencia?modo=".$this->modo."&id=".$referencia->getCaIdmaestra());
            }
        }

        $this->form = $form;
        $this->referencia = $referencia;
        
    }


    /**
    * 
    *
    * @param sfRequest $request A request object
    */
    public function executeVerReferencia(sfWebRequest $request)
    {
        $this->modo = $request->getParameter("modo");
        $this->nivel = $this->getNivel();

        $this->forward404Unless( $request->getParameter("id") );
        $this->referencia = Doctrine::getTable("InoMaestra")->find($request->getParameter("id"));

        $this->forward404Unless( $this->referencia );

        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("tabpane/tabpane",'last');
        $response->addStylesheet("tabpane/luna/tab",'last');
        
    }


    /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeFormClientes(sfWebRequest $request)
    {
        $this->modo = $request->getParameter("modo");
        $this->nivel = $this->getNivel();

        $this->forward404Unless( $request->getParameter("id") );
        $this->referencia = Doctrine::getTable("InoMaestra")->find($request->getParameter("id"));

        $this->inoCliente = Doctrine::getTable("InoCliente")->find($request->getParameter("idinocliente"));


        $form = new InoClienteForm( $this->inoCliente );
        
        if ($request->isMethod('post')){            
            $bindValues = $request->getParameter($form->getName());
            $bindValues["ca_idmaestra"] = $this->referencia->getCaIdmaestra();
            $form->bind( $bindValues );

            $this->reporte = Doctrine::getTable("Reporte")->find($bindValues["ca_idreporte"]);

			if( $form->isValid() ){

                $inocliente = $form->save();

                $this->redirect("ino/verReferencia?modo=".$this->modo."&id=".$inocliente->getCaIdmaestra());
            }
        }

        $this->form = $form;

    }



    /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeFormComprobante(sfWebRequest $request)
    {
        $this->modo = $request->getParameter("modo");
        $this->nivel = $this->getNivel();

        $this->forward404Unless( $request->getParameter("id") );
        $this->inocliente = Doctrine::getTable("InoCliente")->find($request->getParameter("id"));
        $this->forward404Unless( $this->inocliente );

        $request->setParameter("idmaestra", $this->inocliente->getCaIdmaestra());

        if( $request->getParameter("idcomprobante") ){
            $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
            $this->forward404Unless( $this->comprobante );
        }else{
            $this->comprobante = new InoComprobante();           

        }

        if( $this->comprobante->getCaEstado()!=InoComprobante::ABIERTO ){            
            $this->redirect("ino/verComprobante?modo=".$this->modo."&id=".$this->comprobante->getCaIdcomprobante());
        }
        

    }


     /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeObserveFormComprobantePanel(sfWebRequest $request)
    {
        
        $idinocliente = $request->getParameter("idinocliente");
        $this->responseArray=array("idinocliente"=>$idinocliente,  "success"=>false);


        if( $request->getParameter("idcomprobante") ){
            $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
            $this->forward404Unless( $comprobante );
        }else{
            $comprobante = new InoComprobante();
            $comprobante->setCaIdtipo($request->getParameter("idtipo"));
            $comprobante->setCaConsecutivo(InoComprobanteTable::siguienteConsecutivo($request->getParameter("idtipo")));
        }

        $comprobante->setCaFchcomprobante($request->getParameter("fechacomprobante"));
        $comprobante->setCaIdinocliente($idinocliente);
        $comprobante->setCaId($request->getParameter("id"));
        $comprobante->setCaPlazo($request->getParameter("plazo"));
        $comprobante->setCaTasacambio($request->getParameter("tasacambio"));
        $comprobante->save();

        $this->responseArray["success"]=true;
        $this->responseArray["idcomprobante"]=$comprobante->getCaIdcomprobante();
        


        $this->setTemplate("responseTemplate");
    }

    /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeFormComprobanteData(sfWebRequest $request)
    {

        $this->modo = $request->getParameter("modo");

        $this->forward404Unless( $request->getParameter("idcomprobante") );
        $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
        $this->forward404Unless( $comprobante );
        

        $tipo = $comprobante->getInoTipoComprobante();
        
        $baseRow = array( "idinocliente"=>$comprobante->getCaIdinocliente(),
                          "idcomprobante"=>$comprobante->getCaIdcomprobante(),

                        );
        $items = array();

        $q = Doctrine::getTable("InoTransaccion")
                       ->createQuery("t")
                       ->select("t.ca_idtransaccion, t.ca_idconcepto, t.ca_db, t.ca_cr, c.ca_idconcepto,c.ca_concepto, cc.ca_idccosto, cc.ca_centro, cc.ca_subcentro, cc.ca_nombre")
                       ->innerJoin("t.InoConcepto c")
                       ->leftJoin("t.InoCentroCosto cc")
                       ->where("t.ca_idcomprobante = ? ", $comprobante->getCaIdcomprobante() )
                       ->setHydrationMode(Doctrine::HYDRATE_SCALAR );

        $transacciones = $q->execute();


        $centros = Doctrine::getTable("InoCentroCosto")
                              ->createQuery("c")
                              ->select("c.*")
                              ->where("c.ca_subcentro IS NULL")
                              ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                              ->execute();
         $centrosArray = array();
         foreach( $centros as $centro ){
            $centrosArray[ $centro["c_ca_centro"] ] = $centro["c_ca_nombre"];
         }

        foreach( $transacciones as $transaccion ){

            if( $tipo->isDb() ){
                $valor = $transaccion["t_ca_db"];
            }else{
                $valor = $transaccion["t_ca_cr"];
            }
            $items[] = array_merge($baseRow, array(
                            "idtransaccion"=>$transaccion["t_ca_idtransaccion"],
                            "idconcepto"=>$transaccion["t_ca_idconcepto"],
                            "concepto"=>utf8_encode($centrosArray[$transaccion['cc_ca_centro']]." ".$transaccion['cc_ca_nombre']." » ".$transaccion["c_ca_concepto"]),
                            "centro" => str_pad($transaccion['cc_ca_centro'], 2, "0", STR_PAD_LEFT)."-".str_pad($transaccion['cc_ca_subcentro'], 2, "0", STR_PAD_LEFT),
                            "codigo" => str_pad($transaccion['cc_ca_centro'], 2, "0", STR_PAD_LEFT).str_pad($transaccion['cc_ca_subcentro'], 2, "0", STR_PAD_LEFT).str_pad($transaccion["c_ca_idconcepto"], 4, "0", STR_PAD_LEFT),
                            "valor"=>$valor
                     ));

        }

        $items[] = array_merge($baseRow, array( "idcuenta"=>"",
                            "idconcepto"=>"",
                            "concepto"=>"+"
                     ));
        $this->responseArray = array("items"=>$items);
        $this->setTemplate("responseTemplate");
    }

    /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeObserveFormComprobanteSubpanel(sfWebRequest $request)
    {

        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>false);       


        $this->forward404Unless( $request->getParameter("idcomprobante") );
        $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
        $this->forward404Unless( $comprobante );

        $tipo = $comprobante->getInoTipoComprobante();

        if( $request->getParameter("idtransaccion") ){
            $transaccion = Doctrine::getTable("InoTransaccion")->find($request->getParameter("idtransaccion"));
        }else{
            $transaccion = new InoTransaccion();
            $transaccion->setCaIdcomprobante( $request->getParameter("idcomprobante") );
        }
     
        //$transaccion->setCaId( 1 );
        $transaccion->setCaIdconcepto( $request->getParameter("idconcepto") );
        if( $tipo->isDb() ){
            $transaccion->setCaDb( $request->getParameter("valor") );
        }else{
            $transaccion->setCaCr( $request->getParameter("valor") );
        }
        $transaccion->setCaIdccosto( $request->getParameter("idccosto") );
        $transaccion->setCaIdmoneda( "USD" );
        $transaccion->save();

        $this->responseArray["success"]= true;
        $this->responseArray["idtransaccion"]= $transaccion->getCaIdtransaccion();
        
        $this->setTemplate("responseTemplate");
    }

    /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeEliminarFormComprobanteSubpanel(sfWebRequest $request){
        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>false);


        $this->forward404Unless( $request->getParameter("idcomprobante") );
        $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
        $this->forward404Unless( $comprobante );

        if( $request->getParameter("idtransaccion") ){
            $transaccion = Doctrine::getTable("InoTransaccion")->find($request->getParameter("idtransaccion"));
            $this->forward404Unless( $transaccion );
            $transaccion->delete();
            $this->responseArray["success"]= true;
        }

        $this->setTemplate("responseTemplate");
    }



    /**
    * Vista previa del comprobante (Prefactura)
    *
    * @param sfRequest $request A request object
    */
    public function executePreviewComprobante(sfWebRequest $request){
        $this->forward404Unless( $request->getParameter("id") );
        $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("id"));
        $this->forward404Unless( $this->comprobante );


        $this->transacciones = Doctrine::getTable("InoTransaccion")
                                         ->createQuery("t")                                        
                                         ->innerJoin("t.InoConcepto con")
                                         ->innerJoin("con.InoCuenta c")
                                         ->where("t.ca_idcomprobante = ? ", $this->comprobante->getCaIdcomprobante() )
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
    public function executeGenerarComprobante(sfWebRequest $request){
        $this->forward404Unless( $request->getParameter("id") );
        $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("id"));
        $this->forward404Unless( $comprobante );
        $modo = $request->getParameter("modo");
        if( $comprobante->getcaEstado()==InoComprobante::ABIERTO ){
            
            try{
                $tipo = $comprobante->getInoTipoComprobante();

                $conn = $comprobante->getTable()->getConnection();
                $conn->beginTransaction();


                $transacciones = Doctrine::getTable("InoTransaccion")
                                                 ->createQuery("t")
                                                 ->select("t.*")
                                                 ->where("t.ca_idcomprobante = ? ", $comprobante->getCaIdcomprobante() )
                                                 ->execute();

                $impuestos = array();

                $totales = array();
                $total = 0;

                foreach( $transacciones as $transaccion ){
                    $concepto = $transaccion->getInoConcepto();

                    $parametro = $transaccion->getInoConceptoParametro();
                    if( !$parametro ){
                        $conn->rollBack();
                        throw new Exception('La parametrizacion no esta correctamente definida: Comprobante:'.$comprobante->getCaIdcomprobante()." Transaccion: ".$transaccion->getCaIdtransaccion());
                    }
                    $total+=($transaccion->getCaCr()-$transaccion->getCaDb());
                    $transaccion->setCaIdcuenta( $parametro->getCaIdcuenta() );
                    $transaccion->save( $conn );

                    $imp = $transaccion->getImpuestos();

                    foreach( $imp as $key=>$val ){
                        if(!isset( $impuestos[$key] )){
                            $impuestos[$key]["db"] = 0;
                            $impuestos[$key]["cr"] = 0;
                        }
                        $impuestos[$key]["db"]+=$imp[$key]["db"];
                        $impuestos[$key]["cr"]+=$imp[$key]["cr"];
                    }
                }



                if( $impuestos["iva"]>0 ){
                    $transaccion = new InoTransaccion();
                    $transaccion->setCaDb( 0 );
                    $transaccion->setCaCr( $impuestos["iva"]["cr"]-$impuestos["iva"]["db"] );
                    $transaccion->setCaIdmoneda( "USD" );
                    //$transaccion->setCaIdconcepto( 240 );
                    $transaccion->setCaIdcuenta( $tipo->getCaIdctaIva() );
                    $transaccion->setCaIdcomprobante( $comprobante->getCaIdcomprobante() );
                    $transaccion->save( $conn );
                    $total +=  $impuestos["iva"]["cr"]-$impuestos["iva"]["db"];
                }



                $transaccion = new InoTransaccion();
                $transaccion->setCaDb( $total );
                $transaccion->setCaCr( 0 );
                $transaccion->setCaIdmoneda( "USD" );
                $transaccion->setCaIdcuenta( $tipo->getCaIdctaCierre() );
                $transaccion->setCaIdcomprobante( $comprobante->getCaIdcomprobante() );
                $transaccion->save( $conn );

                $comprobante->setCaEstado( InoComprobante::PARA_TRANSFERIR );
                $comprobante->save();

            
                $conn->commit();
            }
            catch (Exception $e){
                $conn->rollBack();
                throw $e;
            }
        }
        
        $this->redirect("ino/verComprobante?modo=".$modo."&id=".$comprobante->getCaIdcomprobante());


    }


    /**
    * Muestra el comprobante en un iframe
    *
    * @param sfRequest $request A request object
    */
    public function executeVerComprobante(sfWebRequest $request){
        $this->forward404Unless( $request->getParameter("id") );
        $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("id"));
        $this->forward404Unless( $this->comprobante );

        $inoCliente = $this->comprobante->getInoCliente();
        $request->setParameter("idmaestra", $inoCliente->getcaIdmaestra());
    }

    /**
    * Genera el comprobante y lo transfiere a SIIGO
    *
    * @param sfRequest $request A request object
    */
    public function executeGenerarComprobantePDF(sfWebRequest $request){
        $this->forward404Unless( $request->getParameter("id") );
        $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("id"));
        $this->forward404Unless( $this->comprobante );


        $this->transacciones = Doctrine::getTable("InoTransaccion")
                                         ->createQuery("t")
                                         ->select("t.*, con.*, p.*")
                                         ->innerJoin("t.InoConcepto con")
                                         ->innerJoin("con.InoConceptoParametro p")
                                         ->addWhere("t.ca_idconcepto IS NOT NULL") //TEMPORAL
                                         //->innerJoin("con.InoCuenta c")
                                         ->addWhere("t.ca_idcomprobante = ? ", $this->comprobante->getCaIdcomprobante() )
                                         ->addOrderBy("p.ca_ingreso_propio")
                                         //->addOrderBy("c.ca_cuenta")
                                         ->execute();

        
        $this->filename = $request->getParameter("filename");
    }

}


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

    public function getNivel( ){
        $this->modo = $this->getRequestParameter("modo");

        $this->nivel = -1;
		if( !$this->modo ){
			$this->forward( "ids", "seleccionModo" );
		}

		if( $this->modo=="agentes" ){
			$this->nivel = $this->getUser()->getNivelAcceso( idsActions::RUTINA_AGENTES );
		}

		if( $this->modo=="prov" ){
			$this->nivel = $this->getUser()->getNivelAcceso( idsActions::RUTINA_PROV );
		}


		if( $this->nivel==-1 ){
			$this->forward404();
		}
        return $this->nivel;
    }
    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(sfWebRequest $request)
    {
        $this->comerciales = UsuarioTable::getComerciales();
    }

    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeBusqueda(sfWebRequest $request)
    {
        

    }


    /**
    * 
    *
    * @param sfRequest $request A request object
    */
    public function executeFormIno(sfWebRequest $request)
    {
        $this->modo = $request->getParameter("modo");

        switch( $this->modo ){
            case "maritimo":
                $this->transporte = Constantes::MARITIMO;
                break;
        }
        
        $this->referencia = Doctrine::getTable("InoMaestra")->find($request->getParameter("id"));
        if( !$this->referencia ){
            $this->referencia = new InoMaestra();
        }

        $form = new InoMaestraForm( $this->referencia );
        

        $trayectoForm =  new TrayectoForm();

        $this->origen = $request->getParameter("origen");
        $this->destino = $request->getParameter("destino");
        if ($request->isMethod('post')){

            $trayectoObj = $request->getParameter($trayectoForm->getName());
            $trayectoObj["ca_impoexpo"] ="Importación";
            $trayectoObj["ca_transporte"] ="Marítimo";
            $trayectoObj["ca_modalidad"] ="FCL";

            if( isset($trayectoObj["ca_idagente"]) ){
                $idagente = $trayectoObj["ca_idagente"];
            }else{
                $idagente = null;
            }

            $trayecto = TrayectoTable::findByParametros( $trayectoObj["ca_transporte"], $trayectoObj["ca_modalidad"], $trayectoObj["ca_origen"], $trayectoObj["ca_destino"], $trayectoObj["ca_idlinea"], $idagente  );
            if( !$trayecto ){
                $trayecto = new Trayecto();
                $trayecto->setCaImpoexpo($trayectoObj["ca_impoexpo"]);
                $trayecto->setCaTransporte($trayectoObj["ca_transporte"]);
                $trayecto->setCaModalidad($trayectoObj["ca_modalidad"]);
                $trayecto->setCaOrigen($trayectoObj["ca_origen"]);
                $trayecto->setCaDestino($trayectoObj["ca_destino"]);
                $trayecto->setCaIdlinea($trayectoObj["ca_idlinea"]);
                if( $idagente ){
                    $trayecto->setCaIdagente($idagente);
                }
                $trayecto->save();
            }


            $referenciaObj = $request->getParameter($form->getName());
            $referenciaObj["ca_idtrayecto"] = $trayecto->getCaIdtrayecto();
            $referenciaObj["ca_referencia"] =  InoMaestraTable::getNumReferencia( $trayectoObj["ca_transporte"], $trayectoObj["ca_modalidad"], $trayectoObj["ca_origen"], $trayectoObj["ca_destino"], "01", "9" );
            $referenciaObj["ca_fchreferencia"] =  date("Y-m-d H.i:s");
            $form->bind( $referenciaObj );

            if($form->hasErrors()){
                print_r( $obj );
                //print_r($form->getErrorSchema()->getErrors());
                echo "ERROR";
            }
            

			if( $form->isValid() ){
               
                $this->referencia = $form->save();
                echo $this->referencia->getCaIdmaestra();                
                $this->redirect("ino/verReferencia?id=".$this->referencia->getCaIdmaestra());
            }
        }

        $this->form = $form;
        $this->trayectoForm = $trayectoForm;
    }


    /**
    * 
    *
    * @param sfRequest $request A request object
    */
    public function executeVerReferencia(sfWebRequest $request)
    {
        $this->modo = $request->getParameter("modo");

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

        $this->forward404Unless( $request->getParameter("id") );
        $this->referencia = Doctrine::getTable("InoMaestra")->find($request->getParameter("id"));

        $this->inoCliente = Doctrine::getTable("InoCliente")->find($request->getParameter("idinocliente"));


        $form = new InoClienteForm( $this->inoCliente );

        if ($request->isMethod('post')){            
            $bindValues = $request->getParameter($form->getName());
            $bindValues["ca_idmaestra"] = $this->referencia->getCaIdmaestra();
            $form->bind( $bindValues );


			if( $form->isValid() ){

                $inocliente = $form->save();

                $this->redirect("ino/verReferencia?id=".$inocliente->getCaIdmaestra());
            }else{
                echo "Error";
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

        $this->forward404Unless( $request->getParameter("id") );
        $this->referencia = Doctrine::getTable("InoMaestra")->find($request->getParameter("id"));
       
        if( $request->getParameter("idcomprobante") ){
            $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
            $this->forward404Unless( $this->comprobante );
        }else{
            $this->comprobante = new InoComprobante();
        }

        

    }


     /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeObserveFormComprobantePanel(sfWebRequest $request)
    {

        $idmaestra = $request->getParameter("idmaestra");
        $this->responseArray=array("idmaestra"=>$idmaestra,  "success"=>false);


        if( $request->getParameter("idcomprobante") ){
            $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
            $this->forward404Unless( $comprobante );
        }else{
            $comprobante = new InoComprobante();
        }

        $comprobante->setCaIdtipo(1);
        $comprobante->setCaConsecutivo(2);
        $comprobante->setCaIdmaestra($idmaestra);
        $comprobante->setCaId($request->getParameter("id"));
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
        $baseRow = array( "idmaestra"=>$comprobante->getCaIdmaestra(),
                          "idcomprobante"=>$comprobante->getCaIdcomprobante(),

                        );
        $items = array();

        $q = Doctrine::getTable("InoTransaccion")
                       ->createQuery("t")
                       ->select("t.ca_idtransaccion, t.ca_idconcepto, t.ca_db, t.ca_cr, c.ca_recargo as ca_concepto")
                       ->innerJoin("t.TipoRecargo c")
                       ->where("t.ca_idcomprobante = ? ", $comprobante->getCaIdcomprobante() )
                       ->setHydrationMode(Doctrine::HYDRATE_SCALAR );

        $transacciones = $q->execute();
        
        foreach( $transacciones as $transaccion ){
            $items[] = array_merge($baseRow, array(
                            "idtransaccion"=>$transaccion["t_ca_idtransaccion"],
                            "idconcepto"=>$transaccion["t_ca_idconcepto"],
                            "concepto"=>utf8_encode($transaccion["c_ca_concepto"]),
                            "valor"=>$transaccion["t_ca_db"]>0?$transaccion["t_ca_db"]:$transaccion["t_ca_cr"]
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

        if( $request->getParameter("idtransaccion") ){
            $transaccion = Doctrine::getTable("InoTransaccion")->find($request->getParameter("idtransaccion"));
        }else{
            $transaccion = new InoTransaccion();
            $transaccion->setCaIdcomprobante( $request->getParameter("idcomprobante") );
        }


                
        $transaccion->setCaId( 1 );
        $transaccion->setCaIdconcepto( $request->getParameter("idconcepto") );
        $transaccion->setCaDb( $request->getParameter("valor") );
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


}

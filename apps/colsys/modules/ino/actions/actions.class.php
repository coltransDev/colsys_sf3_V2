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



    }

    /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeFormComprobanteData(sfWebRequest $request)
    {

        $this->modo = $request->getParameter("modo");

        $this->forward404Unless( $request->getParameter("id") );
        $referencia = Doctrine::getTable("InoMaestra")->find($request->getParameter("id"));
        $this->forward404Unless( $referencia );
        $baseRow = array( "idmaestra"=>$referencia->getCaIdmaestra(),

                        );
        $items = array();



        $items[] = array_merge($baseRow, array( "idcuenta"=>"",
                            "idconcepto"=>"",
                            "concepto"=>"+"
                     ));
        $this->responseArray = array("items"=>$items);
        $this->setTemplate("responseTemplate");
    }
}

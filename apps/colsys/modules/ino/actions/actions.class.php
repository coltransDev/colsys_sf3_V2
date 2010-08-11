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
		/*if( !$this->modo ){
			$this->forward( "ino", "seleccionModo" );
		}*/

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
        //$q->innerJoin( "m.Modalidad mod" );
        switch( $this->modo ){
            case "aereo":
                $q->addWhere( "m.ca_impoexpo = ? and m.ca_transporte = ?", array(Constantes::IMPO, Constantes::AEREO) );
                break;
            case "maritimo":
                $q->addWhere( "m.ca_impoexpo = ? and m.ca_transporte = ?", array(Constantes::IMPO, Constantes::MARITIMO) );
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
    }


    /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeGuardarMaster(sfWebRequest $request)
    {
        //$this->nivel = $this->getNivel();
        $this->modo = $request->getParameter("modo");
        //----------------------- Validación ---------------------------
        $errors = array();

        //$errors["idagente"]="El agente es requerido";
        if( count($errors)>0 ){
            $this->responseArray = array("success"=>false, "errors"=>$errors);
        }

        //----------------------- Guarda los datos ---------------------------
        try{

            $impoexpo = utf8_decode($request->getParameter("impoexpo"));
            $transporte = utf8_decode($request->getParameter("transporte"));
            $modalidad = utf8_decode($request->getParameter("modalidad"));
            $idorigen = $request->getParameter("idorigen");
            $iddestino = $request->getParameter("iddestino");
            $fchreferencia  = $request->getParameter("fchreferencia");
            $fchreferenciaTm = strtotime($fchreferencia);

            $ino = new InoMaestra();
            $numRef = InoMaestraTable::getNumReferencia( $impoexpo, $transporte, $modalidad, $idorigen, $iddestino, date("m", $fchreferenciaTm), date("Y", $fchreferenciaTm)  );           
            $ino->setCaReferencia( $numRef );
            $ino->setCaImpoexpo( $impoexpo );
            $ino->setCaTransporte( $transporte );
            $ino->setCaModalidad( $modalidad );
            $ino->setCaFchreferencia( $fchreferencia );           
            $ino->setCaOrigen( $idorigen );
            $ino->setCaDestino( $iddestino );
            $ino->setCaIdlinea( $request->getParameter("idlinea") );
            $ino->setCaIdagente( $request->getParameter("idagente") );

            $ino->setCaMaster( $request->getParameter("ca_master") );
            $ino->setCaFchmaster( $request->getParameter("ca_fchmaster") );

            

            $ino->save();            
            $this->responseArray = array("success"=>true, "idmaestra"=>$ino->getCaIdmaestra());
        }catch (Exception $e){
            $this->responseArray = array("success"=>false, "errorInfo"=>$e->getMessage());
        }

        

        $this->setTemplate("responseTemplate");
        
    }


    /**
    * 
    *
    * @param sfRequest $request A request object
    */
    public function executeVerReferencia(sfWebRequest $request)
    {
        $this->modo = $request->getParameter("modo");
       // $this->nivel = $this->getNivel();

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
        //$this->nivel = $this->getNivel();

        $this->forward404Unless( $request->getParameter("id") );
        $this->referencia = Doctrine::getTable("InoMaestra")->find($request->getParameter("id"));

        $this->inoCliente = Doctrine::getTable("InoCliente")->find($request->getParameter("idinocliente"));

        /*

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

        $this->form = $form;*/

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

        $request->setParameter("tipo", "F");

        $this->forward("inocomprobantes", "formComprobante");


    }


    
}


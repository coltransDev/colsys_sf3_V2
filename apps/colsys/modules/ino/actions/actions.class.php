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


        $q = Doctrine_Query::create()->from('InoMaster m');
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
			$this->redirect("ino/verReferencia?modo=".$this->modo."&id=".$refs[0]->getCaIdmaster());
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

            $ino = new InoMaster();
            $numRef = InoMasterTable::getNumReferencia( $impoexpo, $transporte, $modalidad, $idorigen, $iddestino, date("m", $fchreferenciaTm), date("Y", $fchreferenciaTm)  );
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
            $this->responseArray = array("success"=>true, "idmaestra"=>$ino->getCaIdmaster());
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
        $this->referencia = Doctrine::getTable("InoMaster")->find($request->getParameter("id"));

        $this->forward404Unless( $this->referencia );

     
        
    }


    /*************************************************************************
    *
    *   Acciones para las guias hijas
    *
    ***************************************************************************/

    /**
    * Guarda los datos desde la ventana de creación de House
    *
    * @param sfRequest $request A request object
    */
    public function executeFormHouseGuardar(sfWebRequest $request)
    {
        //print_r( $_POST );
        
        try{
            if( $request->getParameter("idhouse") ){
                $house = Doctrine::getTable("InoHouse")->find($request->getParameter("idhouse"));
                $this->forward404Unless( $house );
            }else{
                $house = new InoHouse();
                $house->setCaIdmaster( $request->getParameter("idmaster") );
            }
            $house->setCaIdreporte( $request->getParameter("idreporte"));
            $house->setCaIdcliente( $request->getParameter("idcliente"));
            $house->setCaVendedor( $request->getParameter("vendedor"));
            $house->setCaIdproveedor( $request->getParameter("idproveedor"));
            $house->setCaNumorden( $request->getParameter("numorden"));
            $house->setCaNumpiezas( $request->getParameter("numpiezas"));
            $house->setCaPeso( $request->getParameter("peso"));
            $house->setCaVolumen( $request->getParameter("volumen"));
            $house->setCaDoctransporte( $request->getParameter("doctransporte"));
            $house->setCaFchdoctransporte( $request->getParameter("fchdoctransporte"));
            $house->save();
            $this->responseArray = array("success"=>true);

        }catch (Exception $e){
            $this->responseArray = array("success"=>false, "errorInfo"=>$e->getMessage());
        }

        $this->setTemplate( "responseTemplate" );
    }

    /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeDatosGridHousePanel(sfWebRequest $request)
    {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless( $idmaster );
        $inoHouses = Doctrine::getTable("InoHouse")
                             ->createQuery("c")
                             ->select("c.*, cl.*")
                             //->innerJoin("c.Ids cl")
                             ->innerJoin("c.Cliente cl")
                             ->where("c.ca_idmaster = ?", $idmaster)
                             ->addOrderBy( "cl.ca_compania" )
                             ->execute();

        $data = array();

        foreach( $inoHouses as $inoHouse ){
            $row = array();
            $row["idmaster"] = $inoHouse->getCaIdmaster();
            $row["idhouse"] = $inoHouse->getCaIdhouse();
            $row["doctransporte"] = utf8_encode($inoHouse->getCaDoctransporte());
            $row["fchdoctransporte"] = $inoHouse->getCaFchdoctransporte();
            $row["numorden"] = utf8_encode($inoHouse->getCaNumorden());
            $row["idcliente"] = $inoHouse->getCliente()->getCaIdcliente();
            $row["cliente"] = utf8_encode($inoHouse->getCliente()->getCaCompania());
            $row["vendedor"] = $inoHouse->getCaVendedor();            
            $row["idreporte"] = $inoHouse->getCaIdreporte();
            $row["reporte"] = $inoHouse->getReporte()->getCaConsecutivo();
            $row["numpiezas"] = $inoHouse->getCaNumpiezas();
            $row["peso"] = $inoHouse->getCaPeso();
            $row["volumen"] = $inoHouse->getCaVolumen();
            $row["idproveedor"] = $inoHouse->getCaIdproveedor();
            $row["proveedor"] = utf8_encode($inoHouse->getProveedor()->getCaNombre());
            $data[] = $row;
        }


        $this->responseArray = array("success"=>true, "root"=>$data, "total"=>count($data));

        $this->setTemplate( "responseTemplate" );
    }



    /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeDatosFormHousePanel(sfWebRequest $request)
    {


        $this->forward404Unless( $request->getParameter("idhouse") );
        $idhouse = $request->getParameter("idhouse");
        $inoHouse = Doctrine::getTable("InoHouse")->find( $idhouse );
        $this->forward404Unless( $inoHouse );


        $data = array();

        $data["idmaster"] = $inoHouse->getCaIdmaster();
        $data["idhouse"] = $inoHouse->getCaIdhouse();
        $data["doctransporte"] = utf8_encode($inoHouse->getCaDoctransporte());
        $data["fchdoctransporte"] = $inoHouse->getCaFchdoctransporte();
        $data["numorden"] = utf8_encode($inoHouse->getCaNumorden());
        $data["idcliente"] = $inoHouse->getCliente()->getCaIdcliente();
        $data["cliente"] = utf8_encode($inoHouse->getCliente()->getCaCompania());
        $data["vendedor"] = $inoHouse->getCaVendedor();
        $data["nombreVendedor"] = utf8_encode($inoHouse->getVendedor()->getCaNombre());
        $data["idreporte"] = $inoHouse->getCaIdreporte();
        $data["reporte"] = $inoHouse->getReporte()->getCaConsecutivo();
        $data["numpiezas"] = $inoHouse->getCaNumpiezas();
        $data["peso"] = $inoHouse->getCaPeso();
        $data["volumen"] = $inoHouse->getCaVolumen();
        $data["idproveedor"] = $inoHouse->getCaIdproveedor();
        $data["proveedor"] = utf8_encode($inoHouse->getProveedor()->getCaNombre());
        


        $this->responseArray = array("success"=>true, "data"=>$data);
        $this->setTemplate("responseTemplate");
    }


    /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeEliminarGridHousePanel(sfWebRequest $request)
    {

        $this->forward404Unless( $request->getParameter("idhouse") );
        $idhouse = $request->getParameter("idhouse");
        $inoHouse = Doctrine::getTable("InoHouse")->find( $idhouse );
        $this->forward404Unless( $inoHouse );

        try{
            $inoHouse->delete();
            $this->responseArray = array("success"=>true);

        }catch (Exception $e){
            $this->responseArray = array("success"=>false, "errorInfo"=>$e->getMessage());
        }


        $this->setTemplate("responseTemplate");
    }


    /*************************************************************************
    *
    *   Acciones para las facturas
    *
    ***************************************************************************/


    /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeDatosGridFacturacionPanel(sfWebRequest $request)
    {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless( $idmaster );
        $inoHouses = Doctrine::getTable("InoHouse")
                             ->createQuery("c")
                             ->select("c.*, cl.*")
                             //->innerJoin("c.Ids cl")
                             ->innerJoin("c.Cliente cl")
                             ->leftJoin( "c.InoComprobante comp" )
                             ->leftJoin( "comp.InoTipoComprobante tcomp" )
                             ->where("c.ca_idmaster = ?", $idmaster)
                             ->addOrderBy( "cl.ca_compania" )
                             ->execute();
                            

        $data = array();

        foreach( $inoHouses as $inoHouse ){


            $comprobantes = $inoHouse->getInoComprobante();
            $k = 0;
            if( count($comprobantes)>0 ){
                foreach( $comprobantes as $comprobante ){
                    $tipo = $comprobante->getInoTipoComprobante();

                    $row = array();
                    $row["idmaster"] = $inoHouse->getCaIdmaster();
                    $row["idhouse"] = $inoHouse->getCaIdhouse();
                    $row["doctransporte"] = utf8_encode($inoHouse->getCaDoctransporte());
                    $row["idcliente"] = $inoHouse->getCliente()->getCaIdcliente();
                    $row["cliente"] = utf8_encode($inoHouse->getCliente()->getCaCompania());
                    $row["comprobante"] = utf8_encode( $tipo." ".str_pad($comprobante->getCaConsecutivo(), 6, "0", STR_PAD_LEFT));
                    $row["fchcomprobante"] = utf8_encode( $comprobante->getCaFchcomprobante());
                    $row["valor"] = $comprobante->getValor();
                    $row["color"] = "";

                    $data[] = $row;
                }
            }else{
                $row = array();
                $row["idmaster"] = $inoHouse->getCaIdmaster();
                $row["idhouse"] = $inoHouse->getCaIdhouse();
                $row["doctransporte"] = utf8_encode($inoHouse->getCaDoctransporte());
                $row["idcliente"] = $inoHouse->getCliente()->getCaIdcliente();
                $row["cliente"] = utf8_encode($inoHouse->getCliente()->getCaCompania());
                $row["comprobante"] = "";
                $row["fchcomprobante"] = "";
                $row["valor"] = 0;
                $row["color"] = "pink";
                $data[] = $row;
            }

            
            
        }


        $this->responseArray = array("success"=>true, "root"=>$data, "total"=>count($data));

        $this->setTemplate( "responseTemplate" );



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


<?php

/**
 * parametros actions.
 *
 * @package    symfony
 * @subpackage parametros
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class parametrosActions extends sfActions
{

    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(){
        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/RowExpander",'last');
		$response->addJavaScript("extExtras/CheckColumn",'last');
    }


    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeBusqueda(){
        
    }


    /**
    * Datos de los conceptos para usar en pricing cotizaciones etc.
    *
    * @param sfRequest $request A request object
    */
    public function executeDatosConceptos(sfWebRequest $request)
    {		
		$transporte = utf8_decode($request->getParameter("transporte"));
		$modalidad = utf8_decode($request->getParameter("modalidad"));
		$impoexpo = utf8_decode($request->getParameter("impoexpo"));
		$tipo = utf8_decode($request->getParameter("tipo"));
		$modo = $request->getParameter("modo");

		$this->forward404Unless( $transporte );

		if( $modo=="recargos" ){			

			//$c->setLimit(3);
			$recargos = Doctrine::getTable("TipoRecargo")
                         ->createQuery("c")
                         ->where("c.ca_transporte = ? AND ca_tipo = ? AND c.ca_impoexpo like ?", array($transporte, $tipo, "%".$impoexpo."%" ))
                         ->addOrderBy( "c.ca_recargo" )
                         ->execute();

			$this->conceptos = array();
			foreach( $recargos as $recargo ){
				$row = array("idconcepto"=>$recargo->getCaIdrecargo(),
							 "concepto"=>utf8_encode($recargo->getCaRecargo())
							);
				$this->conceptos[]=$row;

			}
		}else{
			$this->forward404Unless( $modalidad );
				
			$conceptos = Doctrine::getTable("Concepto")
                         ->createQuery("c")
                         ->where("c.ca_transporte = ? AND c.ca_modalidad = ?", array($transporte, $modalidad ))
                         ->addOrderBy( "c.ca_liminferior" )
                         ->addOrderBy( "c.ca_concepto" )
                         ->execute();
			$this->conceptos = array();
			foreach( $conceptos as $concepto ){
				$row = array("idconcepto"=>$concepto->getCaIdconcepto(),
							 "concepto"=>utf8_encode($concepto->getCaConcepto())
							);
				$this->conceptos[]=$row;
			}

			$this->conceptos[] = array("idconcepto"=>9999,
								 "concepto"=>utf8_encode("Recargos generales del trayecto")
								);

		}

        $this->responseArray = array( "totalCount"=>count( $this->conceptos ), "root"=>$this->conceptos  );
		$this->setTemplate("responseTemplate");		

    }

     /**
    * Datos de los conceptos para usar en pricing cotizaciones etc.
    *
    * @param sfRequest $request A request object
    */
    public function executeDatosPanelParametrosConceptos(sfWebRequest $request){
        $tipo = $request->getParameter("tipo");


        $conceptos = Doctrine::getTable("InoConcepto")
                         ->createQuery("c")
                         //->where("c.ca_transporte = ? AND c.ca_modalidad = ?", array($transporte, $modalidad ))
                         ->addOrderBy( "c.ca_liminferior" )
                         ->addOrderBy( "c.ca_concepto" )
                         ->setHydrationMode(Doctrine::HYDRATE_ARRAY )
                         ->execute();

        $k = 0;
        foreach( $conceptos as $key=>$val ){
            $conceptos[ $key ]["ca_concepto"]=utf8_encode( $conceptos[ $key ]["ca_concepto"] );
            $conceptos[ $key ]["orden"]=$k++;
        }
        
        $conceptos[] = array("ca_idconcepto"=>"", "ca_concepto"=>"", "orden"=>"Z");

        $this->responseArray = array( "totalCount"=>count( $conceptos ), "root"=>$conceptos  );

		$this->setTemplate("responseTemplate");
    }



    /*
    * guarda el panel de conceptos
    * @param sfRequest $request A request object
    */
    public function executeObservePanelParametros(sfWebRequest $request){
        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>false);


        $tipo = $request->getParameter("tipo");



        $idconcepto = $request->getParameter("idconcepto");

        if( $idconcepto ){
            $concepto = Doctrine::getTable("InoConcepto")->find($idconcepto);
            $this->forward404Unless($concepto);
        }else{
            $concepto = new InoConcepto();
        }

        if( $request->getParameter("concepto")!==null ){
            $concepto->setCaConcepto( $request->getParameter("concepto") );
        }



        if( $request->getParameter("observaciones")!==null ){
            if( $request->getParameter("observaciones") ){
                $concepto->setCaDetalles( $request->getParameter("observaciones") );
            }else{
                $concepto->setCaDetalles( null );
            }
        }

        $concepto->save();
        $this->responseArray["success"]=true;

        $this->responseArray["idconcepto"]=$concepto->getCaIdconcepto();


        $this->setTemplate("responseTemplate");
    }


    /*
    * guarda el panel de conceptos
    * @param sfRequest $request A request object
    */
    public function executeEliminarPanelParametros(sfWebRequest $request){
        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>false);

        $idconcepto = $request->getParameter("idconcepto");

        if( $idconcepto ){
            $concepto = Doctrine::getTable("InoConcepto")->find($idconcepto);
            $this->forward404Unless($concepto);
            $concepto->delete();
            $this->responseArray["success"]=true;
        }
        $this->setTemplate("responseTemplate");
    }


    /**
    * Datos de los conceptos para usar en pricing cotizaciones etc.
    *
    * @param sfRequest $request A request object
    */
    public function executeDatosModalidadGrid(sfWebRequest $request){
        $tipo = $request->getParameter("tipo");


        /*$conceptos = Doctrine::getTable("InoConcepto")
                         ->createQuery("c")
                         //->where("c.ca_transporte = ? AND c.ca_modalidad = ?", array($transporte, $modalidad ))
                         ->addOrderBy( "c.ca_liminferior" )
                         ->addOrderBy( "c.ca_concepto" )
                         ->setHydrationMode(Doctrine::HYDRATE_ARRAY )
                         ->execute();

        $k = 0;
        foreach( $conceptos as $key=>$val ){
            $conceptos[ $key ]["ca_concepto"]=utf8_encode( $conceptos[ $key ]["ca_concepto"] );
            $conceptos[ $key ]["orden"]=$k++;
        }*/

        $conceptos[] = array("idmodalidad"=>"", "modalidad"=>"+", "orden"=>"Z");

        $this->responseArray = array( "totalCount"=>count( $conceptos ), "root"=>$conceptos  );

		$this->setTemplate("responseTemplate");
    }





}

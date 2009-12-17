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

    public function getNivel(){
        $this->modo = $this->getRequestParameter("modo");

        $this->nivel = -1;
		if( !$this->modo ){
			$this->forward( "parametros", "seleccionModo" );
		}
        return 1;
    }

    /**
	 * Permite seleccionar el modo de operacion del programa
	 * @author: Andres Botero
	 */
	public function executeSeleccionModo()
	{
		//$this->nivelAereo = $this->getUser()->getNivelAcceso( inoActions::RUTINA_AEREO );

	}

    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(){

        $this->modo = $this->getRequestParameter("modo");

        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/RowExpander",'last');
		$response->addJavaScript("extExtras/CheckColumn",'last');

        $this->nivel = $this->getNivel();
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
			$q = Doctrine::getTable("TipoRecargo")
                         ->createQuery("c")
                         ->where("c.ca_transporte = ? AND ca_tipo = ? ", array($transporte, $tipo ))
                         ->innerJoin("c.InoConceptoModalidad cm")
                         ->innerJoin("cm.Modalidad m")
                         ->addWhere("m.ca_impoexpo like ? ", "%".$impoexpo."%" )
                         ->distinct()
                         ->addOrderBy( "c.ca_recargo" );
                         
            $recargos = $q->execute();
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
        $modo = $request->getParameter("modo");
        $nivel = $this->getNivel();

        $idccosto = $request->getParameter("idccosto");

        $q = Doctrine::getTable("InoConcepto")
                         ->createQuery("c")
                         ->select("c.*") //,                                                                      
                         ->addOrderBy( "c.ca_concepto" );
        
        if( $modo == "fv" ){
            $q->leftJoin("c.InoParametroFacturacion p")
              ->leftJoin("p.InoCuenta cu")
              ->leftJoin("p.InoCuentaRetencion cr")
              ->addSelect("p.*, cu.ca_cuenta as ca_cuenta, cr.ca_cuenta as ca_cuentaretencion")
              ->addWhere("p.ca_idccosto = ? OR p.ca_idccosto IS NULL", $idccosto )
              ->addWhere("c.ca_recargolocal = ? OR c.ca_recargoorigen = ?", array(true, true));
        }

        if( $modo=="fc" ){
            $q->addWhere( "c.ca_costo = ? ", true);

            $q->leftJoin("c.InoParametroCosto p")
              ->leftJoin("p.InoCuenta cu")
              ->addSelect("p.*, cu.ca_cuenta as ca_cuenta ")
              ->addWhere("p.ca_idccosto = ? OR p.ca_idccosto IS NULL", $idccosto )
              ->addWhere("c.ca_costo = ? ", array(true));
        }

        $conceptos = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR )->execute();
        
        $k = 0;
        foreach( $conceptos as $key=>$val ){           
            $conceptos[ $key ]["c_ca_concepto"]=utf8_encode( $conceptos[ $key ]["c_ca_concepto"] );
            $conceptos[ $key ]["orden"]=str_pad($k,4, "0",STR_PAD_LEFT);
            $k++;

            if( $modo != "edicion" ){
                $conceptos[ $key ]["idccosto"]=$idccosto;
            }

            $modalidadesConcepto = Doctrine_Query::create()
                                ->select("cm.ca_idmodalidad")
                                ->from("InoConceptoModalidad cm")
                                ->where("cm.ca_idconcepto = ? ", $conceptos[ $key ]["c_ca_idconcepto"] )
                                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                ->execute();
            $modalidades = array();

            foreach( $modalidadesConcepto as $modalidadConcepto ){
                $modalidades[]=$modalidadConcepto["ca_idmodalidad"];
            }
            $conceptos[ $key ]["modalidades"] = implode( "|", $modalidades );


            if( $modo == "fv" && $conceptos[ $key ]["p_ca_iva"] ){
                $conceptos[ $key ]["p_ca_iva"] = $conceptos[ $key ]["p_ca_iva"]*100;
            }

        }
        
        if( $nivel>=1 && $this->modo=="edicion" ){
            $conceptos[] = array("ca_idconcepto"=>"", "ca_concepto"=>"", "orden"=>"Z");
        }

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

        $modo = $request->getParameter("modo");

        $tipo = $request->getParameter("tipo");

        $idconcepto = $request->getParameter("idconcepto");

        if( $idconcepto ){
            $concepto = Doctrine::getTable("InoConcepto")->find($idconcepto);
            $this->forward404Unless($concepto);
        }else{
            $concepto = new InoConcepto();
            $concepto->setCaTipo( $request->getParameter("tipo") );
        }

        if( $request->getParameter("concepto")!==null ){
            $concepto->setCaConcepto( $request->getParameter("concepto") );
        }
        
        if( $modo=="edicion" ){
            if( $request->getParameter("recargoorigen")!==null ){
                if( $request->getParameter("recargoorigen")=="true" ){
                    $concepto->setCaRecargoorigen( true );
                }else{
                    $concepto->setCaRecargoorigen( false );
                }
            }

            if( $request->getParameter("recargolocal")!==null ){
                if( $request->getParameter("recargolocal")=="true" ){
                    $concepto->setCaRecargolocal( true );
                }else{
                    $concepto->setCaRecargolocal( false );
                }
            }


            if( $request->getParameter("observaciones")!==null ){
                if( $request->getParameter("observaciones") ){
                    $concepto->setCaDetalles( $request->getParameter("observaciones") );
                }else{
                    $concepto->setCaDetalles( null );
                }
            }

            if( $concepto->getCaIdconcepto() ){
                if( $request->getParameter("modalidades")!==null ){
                    Doctrine_Query::create()
                                    ->delete()
                                    ->from("InoConceptoModalidad cm")
                                    ->where("cm.ca_idconcepto = ? ", $concepto->getCaIdconcepto() )
                                    ->execute();

                    $modalidadesParam = explode("|",$request->getParameter("modalidades"));

                    foreach( $modalidadesParam as $val ){
                        $cm = new InoConceptoModalidad();
                        $cm->setCaIdconcepto($concepto->getCaIdconcepto());
                        $cm->setCaIdmodalidad($val);
                        $cm->save();
                    }
                }
            }

        }

        $concepto->save();
       
        if( $modo=="fv" ){
            //ca_idparametro
            $idccosto = $request->getParameter("idccosto");
            $parametro = Doctrine::getTable("InoParametroFacturacion")
                                   ->createQuery("p")
                                   ->where("p.ca_idconcepto = ? AND p.ca_idccosto = ?", array($concepto->getCaIdconcepto(), $idccosto) )
                                   ->fetchOne();

            if( !$parametro ){
                $parametro = new InoParametroFacturacion();
                $parametro->setCaIdconcepto( $concepto->getCaIdconcepto() );
                $parametro->setCaIdccosto( $idccosto );
            }
            if( $request->getParameter("idcuenta")!==null ){
                $parametro->setCaIdcuenta( $request->getParameter("idcuenta") );
            }

            if( $request->getParameter("ingreso_propio")!==null ){
                $parametro->setCaIngreso_propio( $request->getParameter("ingreso_propio") );
            }

            if( $request->getParameter("iva")!==null ){
                $parametro->setCaIva( $request->getParameter("iva")/100 );
            }

            if( $request->getParameter("baseretencion")!==null ){
                $parametro->setCaBaseretencion( $request->getParameter("baseretencion") );
            }

            if( $request->getParameter("idcuentaretencion")!==null ){
                $parametro->setCaIdcuentaretencion( $request->getParameter("idcuentaretencion") );
            }

            if( $request->getParameter("valor")!==null ){
                $parametro->setCaValor( $request->getParameter("valor") );
            }
            $parametro->save();

        }
         
        if( $modo=="fc" ){
            //ca_idparametro
            $idccosto = $request->getParameter("idccosto");
            $parametro = Doctrine::getTable("InoParametroCosto")
                                   ->createQuery("p")
                                   ->where("p.ca_idconcepto = ? AND p.ca_idccosto = ?", array($concepto->getCaIdconcepto(), $idccosto) )
                                   ->fetchOne();

            if( !$parametro ){
                $parametro = new InoParametroCosto();
                $parametro->setCaIdconcepto( $concepto->getCaIdconcepto() );
                $parametro->setCaIdccosto( $idccosto );
            }
            if( $request->getParameter("idcuenta")!==null ){
                $parametro->setCaIdcuenta( $request->getParameter("idcuenta") );
            }

            if( $request->getParameter("ingreso_propio")!==null ){
                $parametro->setCaIngreso_propio( $request->getParameter("ingreso_propio") );
            }

            if( $request->getParameter("iva")!==null ){
                $parametro->setCaIva( $request->getParameter("iva")/100 );
            }

            if( $request->getParameter("baseretencion")!==null ){
                $parametro->setCaBaseretencion( $request->getParameter("baseretencion") );
            }

            if( $request->getParameter("idcuentaretencion")!==null ){
                $parametro->setCaIdcuentaretencion( $request->getParameter("idcuentaretencion") );
            }

            if( $request->getParameter("valor")!==null ){
                $parametro->setCaValor( $request->getParameter("valor") );
            }
            $parametro->save();

        }


        

        
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
        $nivel = $this->getNivel();
        if( $nivel==1 ){
            $idconcepto = $request->getParameter("idconcepto");

            if( $idconcepto ){
                $concepto = Doctrine::getTable("InoConcepto")->find($idconcepto);
                $this->forward404Unless($concepto);
                $concepto->delete();
                $this->responseArray["success"]=true;
            }
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
        $modo = $request->getParameter("modo");
        $conceptos = array();
        if( $request->getParameter("modalidades") ){
            
            $modalidadesParam = explode("|", $request->getParameter("modalidades") );

            if( count( $modalidadesParam ) >0 ){
                
                $q = Doctrine::getTable("Modalidad")
                         ->createQuery("m")
                         ->select("m.ca_idmodalidad, m.ca_impoexpo, m.ca_transporte, m.ca_modalidad")
                         ->whereIn("m.ca_idmodalidad", $modalidadesParam)
                         ->addOrderBy( "m.ca_impoexpo" )
                         ->addOrderBy( "m.ca_transporte" )
                         ->addOrderBy( "m.ca_modalidad" );
                

                $modalidades = $q->setHydrationMode(Doctrine::HYDRATE_ARRAY )->execute();

                $k = 0;
                foreach( $modalidades as $modalidad ){
                    $conceptos[] = array("idmodalidad"=>$modalidad["ca_idmodalidad"], "modalidad"=>utf8_encode($modalidad["ca_impoexpo"]." ".$modalidad["ca_transporte"]." ".$modalidad["ca_modalidad"]), "orden"=>$k++);
                }
            }

        }

        $nivel = $this->getNivel();
        if( $nivel>=1 && $modo=="edicion" ){
            $conceptos[] = array("idmodalidad"=>"", "modalidad"=>"+", "orden"=>"Z");
        }

        $this->responseArray = array( "totalCount"=>count( $conceptos ), "root"=>$conceptos  );

		$this->setTemplate("responseTemplate");
    }

}

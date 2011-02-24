<?php

/**
 * confirmaciones actions.
 *
 * @package    colsys
 * @subpackage confirmaciones
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class confirmacionesActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
		$this->modo = $request->getParameter( "modo" );
	}
	
	
	/**
	* Resultados de la busqueda
	*
	* @param sfRequest $request A request object
	*/
	public function executeBusqueda(sfWebRequest $request){
		$criterio = $request->getParameter( "criterio" );
		$this->modo = $request->getParameter( "modo" );
		$cadena = $request->getParameter( "cadena" );
		
		if(!$cadena){
			$this->redirect("confirmaciones/index?modo=".$this->modo);		
		}
		
        $q = Doctrine::getTable("InoMaestraSea")
                       ->createQuery("m")
                       ->select("m.*")
                       ->innerJoin("m.InoClientesSea c")
                       ->addOrderBy("m.ca_fchreferencia DESC")
                       ->distinct()
                       ->limit(200);
        
		
		switch( $criterio ){
			case "referencia":
                $cadena = str_replace("-", ".", $cadena );
                $q->addWhere("m.ca_referencia like ? ", $cadena."%");				
				break;
			case "reporte":

                $q->innerJoin("c.Reporte r");
                $q->addWhere("r.ca_consecutivo like ? ", $cadena."%");
				break;
			case "blmaster":
                $q->addWhere("m.ca_mbls like ? ", $cadena."%");				
				break;
			case "motonave":
                $q->addWhere("m.ca_motonave like ? OR m.ca_mnllegada like ? ", array($cadena."%", $cadena."%"));					
				break;
			case "hbl":
                $q->addWhere("c.ca_hbls like ?", $cadena."%" );							
				break;
			case "cliente":
                $q->innerJoin("c.Cliente cl");
                $q->addWhere("UPPER(cl.ca_compania) like ? ", strtoupper($cadena)."%");
				break;
			case "idcliente":
                $q->innerJoin("c.Cliente cl");
                $q->addWhere("cl.ca_idcliente = ? ", $cadena);
				break;
			case "contenedor":
                $q->innerJoin("c.InoMaestraSea mm");
                $q->innerJoin("mm.InoEquiposSea e");
                $q->addWhere("e.ca_idequipo like ? ", $cadena."%");
				break;
		}
		
		if( $this->modo =="otm" ){
            $q->addWhere("c.ca_continuacion != ? ",'N/A');
		}
        

        // Defining initial variables
        $currentPage = $this->getRequestParameter('page', 1);
        $resultsPerPage = 30;

        // Creating pager object
        $this->pager = new Doctrine_Pager(
              $q,
              $currentPage,
              $resultsPerPage
        );

        $this->referencias = $this->pager->execute();
		if( $this->pager->getResultsInPage()==1 && $this->pager->getPage()==1 ){
            $referencias = $this->referencias;
            $this->redirect("confirmaciones/consulta?referencia=".str_replace(".", "-",$referencias[0]->getCaReferencia())."&modo=".$this->modo);
			//$this->redirect("ids/verIds?modo=".$this->modo."&id=".$ids[0]->getCaId());
		}
		$this->criterio = $criterio;
		$this->cadena = str_replace(".", "-",$cadena);
	}
	
	/**
	* Muestra  el formulario
	*
	* @param sfRequest $request A request object
	*/
	public function executeConsulta(sfWebRequest $request){	
		
		//$response = sfContext::getInstance()->getResponse();
		//$response->addJavaScript("popcalendar",'last');
		
		$referenciaParam = str_replace("-",".",$request->getParameter( "referencia" ));		
		$this->referencia = Doctrine::getTable("InoMaestraSea")->find( $referenciaParam );
		$this->forward404Unless( $this->referencia );	
		
		/*$response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("popcalendar",'last');
		*/
		$this->origen = $this->referencia->getOrigen();
		$this->destino = $this->referencia->getDestino();
		$this->linea = $this->referencia->getIdsProveedor();
		//$this->transportista = $this->linea->getTransportista();
		
		
		$this->modo = $request->getParameter("modo");
		$this->coordinadores = array();
		$parametros = ParametroTable::retrieveByCaso("CU046");
		foreach( $parametros as $parametro ){
			$valor = explode( "|", $parametro->getCaValor() );			
			$this->coordinadores[$valor[0] ] = $valor[1];
			
		}	
		
		$config = sfConfig::get('sf_app_module_dir').DIRECTORY_SEPARATOR."confirmaciones".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."textos.yml";
		$this->textos = sfYaml::load($config);	
		
		
		/*
		* Etapas 
		*/
		
		if( $this->modo=="otm" ){
			$departamento = "OTM/DTA";
		}else{
			$departamento = "Marítimo";
		}
		
		$this->etapas = Doctrine::getTable("TrackingEtapa")
                                  ->createQuery("t")
                                  ->where("t.ca_departamento = ?", $departamento )
                                  ->addOrderBy("t.ca_orden")
                                  ->execute();
		
		if( $this->modo!="otm" ){
			
			/*
			* Confirmaciones de llegada de puerto
			*/
            $this->confirmaciones = Doctrine::getTable("Email")
                                           ->createQuery("e")
                                           ->select("e.*")
                                           ->where( "e.ca_subject like ?", '%'.$this->referencia->getCaReferencia().'%' )
                                           ->addWhere("e.ca_tipo = ? OR e.ca_tipo = ?", array('Not.Llegada', 'Not.Desconsolidación'))
                                           ->addOrderBy("e.ca_fchenvio DESC")
                                           ->execute();

		}

        
        $q = Doctrine::getTable("InoClientesSea")
                                 ->createQuery("c")
                                 ->select("c.*")
                                 ->innerJoin("c.Cliente cl")
                                 ->where("c.ca_referencia = ?" ,$this->referencia->getCaReferencia() )
                                 ->addOrderBy("cl.ca_compania");
        if( $this->modo=="otm"){
            $q->addWhere("c.ca_continuacion != ?", 'N/A');
        }
        $this->inoClientes = $q->execute();
		
		
		
								
	}
	
	/**
	* Crea el status
	*
	* @param sfRequest $request A request object
	*/
	public function executeCrearStatus(sfWebRequest $request){	
		$referencia = Doctrine::getTable("InoMaestraSea")->find( $request->getParameter( "referencia" ) );
		$this->forward404Unless( $referencia );
		
		$modo = $request->getParameter( "modo" );
		$tipo_msg = $request->getParameter( "tipo_msg" );		
		$oids = $request->getParameter( "oid" );
		
		$inoClientes = array();
			
		if( $modo=="conf" && $tipo_msg=="Conf" ){
			if( $request->getParameter( "fchconfirmacion" ) ){	
				$referencia->setCaFchconfirmacion( Utils::parseDate($request->getParameter( "fchconfirmacion" )) );
			}
			$referencia->setCaHoraconfirmacion( $request->getParameter( "horaconfirmacion" ) );
			$referencia->setCaRegistroadu( $request->getParameter( "registroadu" ) );
			if( $request->getParameter( "fchregistroadu" ) ){
				$referencia->setCaFchregistroadu( Utils::parseDate($request->getParameter( "fchregistroadu" )) );
			}
			$referencia->setCaRegistrocap( $request->getParameter( "registrocap" ) );
			$referencia->setCaBandera( $request->getParameter( "bandera" ) );
			$referencia->setCaMensaje( $request->getParameter( "email_body" ) );
			if( $request->getParameter( "fchdesconsolidacion" ) ){
				$referencia->setCaFchdesconsolidacion( Utils::parseDate($request->getParameter( "fchdesconsolidacion" )) );
			}		
			$referencia->setCaMnllegada( $request->getParameter( "mnllegada" ) );
			$referencia->setCaFchconfirmado( date("Y-m-d H:i:s") );
			$referencia->setCaUsuconfirmado( $this->getUser()->getUserId() );
			$referencia->save();				
		}
		
		/*
		* attachments 
		*/		
		if( is_uploaded_file ( $_FILES['attachment']['tmp_name'] ) ){
			$attachment = $_FILES['attachment'];
		}else{
			$attachment = null;
		}
		
		foreach( $oids as $oid ){
					
			if( is_uploaded_file ( $_FILES['attachment_'.$oid]['tmp_name'] ) ){
				$attachment2 = $_FILES['attachment_'.$oid];
			}else{
				$attachment2 = null;
			}
           
            $idcliente = $this->getRequestParameter("idcliente_".$oid);
            $hbls = $this->getRequestParameter("hbls_".$oid);


            
            
			$inoCliente = Doctrine::getTable("InoClientesSea")->find(array($referencia->getCaReferencia(), $idcliente, $hbls));
           
			
			$reporte = $inoCliente->getReporte();
			$directory = $reporte->getDirectorio();
			
			if(!file_exists($directory)){
				@mkdir( $directory ); 
			}
			
			$attachments = array();
			
			if( $attachment ){
				$file = $directory.DIRECTORY_SEPARATOR.$attachment['name'];
				copy( $attachment['tmp_name'] , $file ); 
				$attachments[] = $reporte->getDirectorioBase().$attachment['name'];
			}
			
			if( $attachment2 ){
				$file = $directory.DIRECTORY_SEPARATOR.$attachment2['name'];
				copy( $attachment2['tmp_name'] , $file ); 
				$attachments[] = $reporte->getDirectorioBase().$attachment2['name'];
			}
				
			$ultimostatus = $reporte->getUltimoStatus();
			
			$status = new RepStatus();
						
			$status->setCaIdreporte( $reporte->getCaIdreporte() );
			$status->setCaFchstatus( date("Y-m-d H:i:s") );
			
			
			$status->setCaComentarios( $this->getRequestParameter("notas") );			
			$status->setCaFchenvio( date("Y-m-d H:i:s") );
			$status->setCaUsuenvio( $this->getUser()->getUserId() );

            

			if( $ultimostatus ){
				$status->setCaPiezas( $ultimostatus->getCaPiezas() );
				$status->setCaPeso( $ultimostatus->getCaPeso() );
				$status->setCaVolumen( $ultimostatus->getCaVolumen() );
				$status->setCaIdnave( $ultimostatus->getCaIdnave() );
				$status->setCaFchsalida( $ultimostatus->getCaFchsalida() );
				$status->setCaFchllegada( $ultimostatus->getCaFchllegada() );
				$status->setCaFchcontinuacion( $ultimostatus->getCaFchcontinuacion() );
				$status->setCaDoctransporte( $ultimostatus->getCaDoctransporte() );
			}

            if( substr($referencia->getCaReferencia(),0,1)=="7" ){                
                $status->setCaPiezas( $inoCliente->getCaNumpiezas() );
				$status->setCaPeso( $inoCliente->getCaPeso() );
				$status->setCaVolumen( $inoCliente->getCaVolumen() );				
				$status->setCaFchsalida( $referencia->getCaFchembarque() );
				$status->setCaFchllegada( $referencia->getCaFcharribo() );
                $status->setCaIdnave( $referencia->getCaMotonave() );
				$status->setCaDoctransporte( $inoCliente->getCaHbls() );                                
            }
			
			switch( $modo ){
				case "conf":
                    switch( $tipo_msg ){
                        case "Conf":
                            $status->setCaIdetapa("IMCPD");
                            $status->setCaFchllegada( $referencia->getCaFchconfirmacion() );
                            break;
                        case "Desc":
                                $status->setCaIdetapa("IMDES");
                            break;
                        default:
                            $status->setCaIdetapa("88888");
                            break;

                    }
										
					if( $referencia->getCaMnllegada() ){
						$status->setCaIdnave( $referencia->getCaMnllegada() );
					}else{
						$status->setCaIdnave( $referencia->getCaMotonave() );
					}
                    
                    if( $request->getParameter("mod_fcharribo") ){
                        $referencia->setCaFcharribo( $request->getParameter("fcharribo") );
                        $referencia->save();
                        $status->setCaFchllegada( $request->getParameter("fcharribo") );
                    }
					
					
					break;
				case "otm":				
					$etapa =  $this->getRequestParameter("tipo_".$oid);

                    if( $etapa=="IMCOL" || $this->getRequestParameter("modfchllegada_".$oid) ){
                        $status->setCaFchcontinuacion( Utils::parseDate($this->getRequestParameter("fchllegada_".$oid)));	
                    }

					if( $etapa=="IMCOL" ){
						$idbodega = $this->getRequestParameter("bodega_".$oid); 						
						
						$status->setProperty("idbodega", $idbodega);				
					}

                    if( $etapa=="99999" ){
						$fchplanilla = $this->getRequestParameter("fchplanilla_".$oid);						
						$status->setProperty("fchplanilla", Utils::parseDate($fchplanilla));
					}

					$status->setCaIdetapa($etapa);
					break;				
				default:	
					$status->setCaIdetapa("88888");
					break;	
			}
			
			if( $tipo_msg=="Conf" ){
				$status->setCaIntroduccion( $this->getRequestParameter("intro_body") );
				$status->setStatus( $this->getRequestParameter("mensaje_".$oid) );
			}else{
				$status->setCaIntroduccion( $this->getRequestParameter("status_body_intro") );				
				$mensaje = $this->getRequestParameter("status_body");
				if( $this->getRequestParameter("mensaje_".$oid) ){
					$mensaje .= "\n".$this->getRequestParameter("mensaje_".$oid);
				}
				$status->setStatus( $mensaje );			
			}
						
			$destinatarios = array();
			
			$checkbox = $request->getParameter("em_".$oid);
            if( $checkbox ){
                foreach($checkbox as $check ){
                    $destinatarios[]=$request->getParameter("ar_".$oid."_".$check);
                }
            }
           
							
			$status->save();			
			$status->send($destinatarios, array(), $attachments );		
			
			$this->status = $status;	
			$this->modo = $modo;	
			$this->referencia = $referencia;			
		}				
		
	}
	
	
}




?>

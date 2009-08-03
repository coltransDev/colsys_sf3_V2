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
		
		$c = new Criteria();
		$c->addJoin( InoMaestraSeaPeer::CA_REFERENCIA, InoClientesSeaPeer::CA_REFERENCIA, Criteria::LEFT_JOIN );
		switch( $criterio ){
			case "referencia":
				$c->add( InoMaestraSeaPeer::CA_REFERENCIA, $cadena."%", Criteria::LIKE );	
				break;
			case "reporte":
				$c->addJoin( InoMaestraSeaPeer::CA_REFERENCIA, InoClientesSeaPeer::CA_REFERENCIA );  
				$c->addJoin( InoClientesSeaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE );  				
				$c->add( ReportePeer::CA_CONSECUTIVO, $cadena."%", Criteria::LIKE );	
				break;
			case "blmaster":
				$c->add( InoMaestraSeaPeer::CA_MBLS, $cadena."%", Criteria::LIKE );	
				break;
			case "motonave":
				$c->add( InoMaestraSeaPeer::CA_MOTONAVE, $cadena."%", Criteria::LIKE );	
				$c->addOr( InoMaestraSeaPeer::CA_MNLLEGADA, $cadena."%", Criteria::LIKE );	
				break;
			case "hbl":
				$c->addJoin( InoMaestraSeaPeer::CA_REFERENCIA, InoClientesSeaPeer::CA_REFERENCIA );  	
				$c->add( InoClientesSeaPeer::CA_HBLS, $cadena."%", Criteria::LIKE );				
				break;
			case "cliente":
				$c->addJoin( InoMaestraSeaPeer::CA_REFERENCIA, InoClientesSeaPeer::CA_REFERENCIA );  
				$c->addJoin( InoClientesSeaPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE ); 				
				$c->add( ClientePeer::CA_COMPANIA, strtoupper($cadena)."%", Criteria::LIKE );
				break;
			case "idcliente":
				$c->addJoin( InoMaestraSeaPeer::CA_REFERENCIA, InoClientesSeaPeer::CA_REFERENCIA );  
				$c->addJoin( InoClientesSeaPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE ); 				
				$c->add( ClientePeer::CA_IDCLIENTE, $cadena."%", Criteria::LIKE );
				break;
			case "contenedor":
				$c->addJoin( InoMaestraSeaPeer::CA_REFERENCIA, InoEquiposSeaPeer::CA_REFERENCIA );  
				$c->add( InoEquiposSeaPeer::CA_IDEQUIPO, $cadena."%", Criteria::LIKE );
				break;
		}
		
		if( $this->modo =="otm" ){
			$c->add( InoClientesSeaPeer::CA_CONTINUACION, 'N/A', Criteria::NOT_EQUAL );
		}
		
		$c->addDescendingOrderByColumn( InoMaestraSeaPeer::CA_REFERENCIA );	
		$c->setDistinct();
		$c->setLimit( 200 );
				
		$this->pager = new sfPropelPager('InoMaestraSea', 30);		
		$this->pager->setCriteria($c);	
		$this->pager->setPage($this->getRequestParameter('page', 1));			
		$this->pager->init();
		
		if( count($this->pager->getResults())==1 && count($this->pager->getLinks())==1  ){
			$referencias = $this->pager->getResults();
			$this->redirect("confirmaciones/consulta?referencia=".str_replace(".", "-",$referencias[0]->getCaReferencia())."&modo=".$this->modo);
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
		$this->referencia = InoMaestraSeaPeer::retrieveByPk( $referenciaParam );		
		$this->forward404Unless( $this->referencia );	
		
		/*$response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("popcalendar",'last');
		*/
		$this->origen = $this->referencia->getOrigen();
		$this->destino = $this->referencia->getDestino();
		$this->linea = $this->referencia->getTransportador();
		$this->transportista = $this->linea->getTransportista();		
		
		
		$this->modo = $request->getParameter("modo");
		$this->coordinadores = array();
		$parametros = ParametroPeer::retrieveByCaso("CU046");
		foreach( $parametros as $parametro ){
			$valor = explode( "|", $parametro->getCaValor() );			
			$this->coordinadores[$valor[0] ] = $valor[1];
			
		}	
		
		$config = sfConfig::get('sf_app_module_dir').DIRECTORY_SEPARATOR."confirmaciones".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."textos.yml";
		$this->textos = sfYaml::load($config);	
		
		
		/*
		* Etapas 
		*/
		$c = new Criteria();		
		if( $this->modo=="otm" ){
			$c->add( TrackingEtapaPeer::CA_DEPARTAMENTO, "OTM/DTA" );
		}else{
			$c->add( TrackingEtapaPeer::CA_DEPARTAMENTO, "Marítimo" );
		}
		$c->addAscendingOrderByColumn(TrackingEtapaPeer::CA_ORDEN);
		$this->etapas = TrackingEtapaPeer::doSelect( $c );	
		
		if( $this->modo=="otm" ){
			$c = new Criteria();
			$tipos = array('Zona Franca', 'Zona Aduanera','Depósito Aduanero', 'Depósito Privado', 'Industria Militar');	
			$c->add( BodegaPeer::CA_TIPO, $tipos , Criteria::IN);
			$c->addAscendingOrderByColumn(  BodegaPeer::CA_TIPO );
			$c->addAscendingOrderByColumn(  BodegaPeer::CA_NOMBRE );
			
			$this->bodegas = BodegaPeer::doSelect( $c );
		}else{		
			/*
			* Confirmaciones de llegada de puerto
			*/
			$c = new Criteria();
			$c->add( EmailPeer::CA_TIPO, 'Not.Llegada' );	
			$c->addOr( EmailPeer::CA_TIPO, 'Not.Desconsolidación' );	
			
			$c->add( EmailPeer::CA_SUBJECT, '%'.$this->referencia->getCaReferencia().'%' , Criteria::LIKE );				
			$this->confirmaciones = EmailPeer::doSelect( $c );
		}
		
		
		
		
								
	}
	
	/**
	* Crea el status
	*
	* @param sfRequest $request A request object
	*/
	public function executeCrearStatus(sfWebRequest $request){	
		$referencia = InoMaestraSeaPeer::retrieveByPk( $request->getParameter( "referencia" ) );
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
			$referencia->setCaFchconfirmado( time() );
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
			
			$inoCliente = InoClientesSeaPeer::retrieveByOID( $oid );
			
			$reporte = $inoCliente->getReporte();
			$directory = $reporte->getDirectorio();
			
			if(!file_exists($directory)){
				@mkdir( $directory ); 
			}
			
			$attachments = array();
			
			if( $attachment ){
				$file = $directory.DIRECTORY_SEPARATOR.$attachment['name'];
				copy( $attachment['tmp_name'] , $file ); 
				$attachments[] = $file;
			}
			
			if( $attachment2 ){
				$file = $directory.DIRECTORY_SEPARATOR.$attachment2['name'];
				copy( $attachment2['tmp_name'] , $file ); 
				$attachments[] = $file;
			}
							
			$ultimostatus = $reporte->getUltimoStatus();
			
			$status = new RepStatus();
						
			$status->setCaIdReporte( $reporte->getCaIdreporte() );
			$status->setCaFchStatus( time() );	
			
			
			$status->setCaComentarios( $this->getRequestParameter("notas") );			
			$status->setCaFchenvio( date("Y-m-d H:i:s") );
			$status->setCausuenvio( $this->getUser()->getUserId() );
			
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
			
			
			
			
			switch( $modo ){
				case "conf":
					if( $tipo_msg=="Conf" ){						
						$status->setCaIdEtapa("IMCPD");
						$status->setCaFchllegada( $referencia->getCaFchconfirmacion() );
					}else{
						$status->setCaIdEtapa("88888");
					}
					
					if( $referencia->getCaMnLlegada() ){
						$status->setCaIdnave( $referencia->getCaMnLlegada() );
					}else{
						$status->setCaIdnave( $referencia->getCaMotonave() );
					}
										
					
					
					break;
				case "otm":				
					$etapa =  $this->getRequestParameter("tipo_".$oid);
					
					if( $etapa=="IMCOL" ){
						$idbodega = $this->getRequestParameter("bodega_".$oid); 						
						$status->setCaFchcontinuacion( Utils::parseDate($this->getRequestParameter("fchllegada_".$oid)));	
						$status->setProperty("idbodega", $idbodega);				
					}

                    if( $etapa=="99999" ){
						$fchplanilla = $this->getRequestParameter("fchplanilla_".$oid);						
						$status->setProperty("fchplanilla", Utils::parseDate($fchplanilla));
					}

					$status->setCaIdEtapa($etapa);
					break;				
				default:	
					$status->setCaIdEtapa("88888");
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

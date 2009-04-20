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
	
	}
	
	
	/**
	* Resultados de la busqueda
	*
	* @param sfRequest $request A request object
	*/
	public function executeBusqueda(sfWebRequest $request){
		$criterio = $request->getParameter( "criterio" );
		$cadena = str_replace("-",".",$request->getParameter( "cadena" ));
		$c = new Criteria();
		$c->addJoin( InoMaestraSeaPeer::CA_REFERENCIA, InoClientesSeaPeer::CA_REFERENCIA );
		switch( $criterio ){
			case "referencia":
				$c->add( InoMaestraSeaPeer::CA_REFERENCIA, $cadena."%", Criteria::LIKE );	
				break;
		}
		
		$c->addDescendingOrderByColumn( InoMaestraSeaPeer::CA_REFERENCIA );	
		$c->setLimit( 200 );
		
		$this->pager = new sfPropelPager('InoMaestraSea', 30);		
		$this->pager->setCriteria($c);	
		$this->pager->setPage($this->getRequestParameter('page', 1));			
		$this->pager->init();
		
		if( count($this->pager->getResults())==1 && count($this->pager->getLinks())==1  ){
			$referencias = $this->pager->getResults();
			$this->redirect("confirmaciones/consulta?referencia=".$referencias[0]->getCaReferencia());
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
	}
	
	/**
	* Crea el status
	*
	* @param sfRequest $request A request object
	*/
	public function executeCrearStatus(sfWebRequest $request){	
		//print_r( $_POST );
		
		$referencia = InoMaestraSeaPeer::retrieveByPk( $request->getParameter( "id" ) );
		$this->forward404Unless( $referencia );
		
		$modo = $request->getParameter( "modo" );
		
		$oids = $request->getParameter( "oid" );
		
		$inoClientes = array();
		
		
		
		if( $modo=="conf" ){
			
			$referencia->setCaFchconfirmacion( $request->getParameter( "fchconfirmacion" ) );
			$referencia->setCaHoraconfirmacion( $request->getParameter( "horaconfirmacion" ) );
			$referencia->setCaRegistroadu( $request->getParameter( "registroadu" ) );
			$referencia->setCaFchregistroadu( $request->getParameter( "fchregistroadu" ) );
			$referencia->setCaRegistrocap( $request->getParameter( "registrocap" ) );
			$referencia->setCaBandera( $request->getParameter( "bandera" ) );
			$referencia->setCaMensaje( $request->getParameter( "email_body" ) );
			$referencia->setCaFchdesconsolidacion( $request->getParameter( "fchdesconsolidacion" ) );
			$referencia->setCaMnllegada( $request->getParameter( "mnllegada" ) );
			$referencia->setCaFchconfirmado( time() );
			$referencia->setCaUsuconfirmado( $this->getUser()->getUserId() );
			$referencia->save();				
		}
		
		foreach( $oids as $oid ){
			$inoCliente = InoClientesSeaPeer::retrieveByOID( $oid );
			
			$reporte = $inoCliente->getReporte();
			$ultimostatus = $reporte->getUltimoStatus();
						
			$status = new RepStatus();
						
			$status->setCaIdReporte( $reporte->getCaIdreporte() );
			$status->setCaFchStatus( date("Y-m-d H:i:s") );			
			$status->setCaEtapa("Confirmación");
			$status->setCaIntroduccion( "Confirmación " );
			$status->setCaStatus( $this->getRequestParameter("email_body") );
			$status->setCaComentarios( $this->getRequestParameter("notas") );			
			$status->setCaFchenvio( date("Y-m-d H:i:s") );
			$status->setCausuenvio( $this->getUser()->getUserId() );
			$status->save();
			$status->send();
			
			
						
		}
		
		
		
		
		
		/*
		$status->setCaIdReporte( $this->reporteId );
		$status->setCaFchStatus( date("Y-m-d H:i:s") );
		$status->setCaIntroduccion( Utils::replace( $this->getRequestParameter("introduccion") ) );
		$status->setCaIdEmail( $email->getCaIdemail() );
		$status->setCaStatus( $this->getRequestParameter("mensaje") );
		$status->setCaComentarios( $this->getRequestParameter("notas", '-') );
		$status->setCaEtapa( $this->getRequestParameter("etapa") );
		$status->setCaFchrecibo( $this->getRequestParameter("fchrecibo")." ".$this->getRequestParameter("horarecibo") );
		$status->setCaFchenvio( date("Y-m-d H:i:s") );
		$status->setCausuenvio( $user->getUserId() );
		
		
		$this->getRequest()->setParameter("id", $reporte->getCaIdreporte());
		$this->getRequest()->setParameter("emailid", $email->getCaIdemail());	
				
		
			
		$piezas = $this->getRequestParameter("piezas")."|".$this->getRequestParameter("tipo_piezas");
		$peso = $this->getRequestParameter("peso")."|".$this->getRequestParameter("tipo_peso");
		$volumen = $this->getRequestParameter("volumen")."|".$this->getRequestParameter("tipo_volumen");
		
		if($this->getRequestParameter("piezas")){
			$status->setCaPiezas( $piezas );
		}
		
		if($this->getRequestParameter("peso")){
			$status->setCaPeso( $peso );
		}
		if($this->getRequestParameter("volumen")){
			$status->setCaVolumen( $volumen );
		}	
		
		if( $this->getRequestParameter("doctransporte") ){
			$status->setCaDoctransporte( $this->getRequestParameter("doctransporte") );
		}
		
		if( $this->getRequestParameter("docmaster") ){
			$status->setCaDocmaster( $this->getRequestParameter("docmaster") );
		}
		
		if( $this->getRequestParameter("idnave") ){
			$status->setCaIdnave( $this->getRequestParameter("idnave") );
		}
		
		if( $this->getRequestParameter("fchsalida") ){
			$status->setCaFchsalida( $this->getRequestParameter("fchsalida") );
		}
		if( $this->getRequestParameter("fchllegada") ){
			$status->setCaFchllegada( $this->getRequestParameter("fchllegada") );
		}
		
		if( $this->getRequestParameter("horasalida") ){	
			$status->setCaHorasalida( $this->getRequestParameter("horasalida") );
		}
		
		if( $this->getRequestParameter("horallegada") ){
			$status->setCaHorallegada( $this->getRequestParameter("horallegada") );
		}
			
		if( $this->getRequestParameter("fchcontinuacion") && $reporte->getCaContinuacion()!="N/A" ){
			$status->setCaFchcontinuacion( $this->getRequestParameter("fchcontinuacion") );
		}
		
		if (!$rs->Open("insert into tb_inoavisos_sea (ca_referencia, ca_idcliente, ca_hbls, ca_idemail, ca_fchaviso, ca_aviso, ca_fchenvio, ca_usuenvio) select ca_referencia, ca_idcliente, ca_hbls, $id_email, '".date("Y-M-d")."', '".$$personal."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario' from tb_inoclientes_sea where oid = ".$oid[$i])) {
			echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
			echo "<script>document.location.href = 'confirmaciones.php';</script>";
			exit;
			}
			enviar_email($mail, $rs, $id_email, $i, $_FILES);                                           // Llamado a la función que envia los emails
		}
		
		*/
	}
	
	public function executeVerStatus(sfWebRequest $request){
		$this->status = RepStatusPeer::retrieveByPk( $request->getParameter("idstatus") );
		$this->forward404Unless( $this->status );
		
		$this->reporte = $this->status->getReporte();
		$this->inoCliente = $this->reporte->getInoClientesSea();
		$this->inoMaestra = $this->inoCliente->getInoMaestraSea();
		$this->cliente = $this->inoCliente->getCliente();
		$this->setLayout("email");
		
		$this->user = UsuarioPeer::retrieveByPk( $this->getUser()->getUserId() );
	}
	
}




?>

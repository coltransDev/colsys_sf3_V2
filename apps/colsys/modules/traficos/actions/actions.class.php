<?php

/**
 * traficos actions.
 *
 * @package    colsys
 * @subpackage traficos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class traficosActions extends sfActions
{
	
	const RUTINA_MARITIMO = "78";
	const RUTINA_AEREO = "79";
	const RUTINA_EXPO = "80";
	/***********************************************************************************
	* Pagina inicial y consulta de reportes
	************************************************************************************/
	
	/**
	 * Muestra un formulario para seleccionar un rango de fechas y el cliente
	 * @author: Andres Botero
	 */
	public function executeIndex()
	{
		$this->modo = $this->getRequestParameter("modo");		
		if( !$this->modo ){
			$this->forward( "traficos", "seleccionModo" );	
		}
		
		if( $this->modo=="maritimo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_MARITIMO );
			
			$this->impoexpo=Constantes::IMPO;
			$this->transporte=Constantes::MARITIMO;
		}		
		if( $this->modo=="aereo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_AEREO );
			$this->impoexpo=Constantes::IMPO;
			$this->transporte=Constantes::AEREO;
		}		
		if( $this->modo=="expo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_EXPO );
			$this->impoexpo=Constantes::EXPO;
			$this->transporte=null;
		}		
		if( $this->nivel==-1 ){
			$this->forward404();
		}			
				
		
		
	}
	
	/**
	 * Permite seleccionar el modo de operacion del programa
	 * @author: Andres Botero
	 */
	public function executeSeleccionModo()
	{		
		$this->nivelMaritimo = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_MARITIMO );
		$this->nivelAereo = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_AEREO );
		$this->nivelExpo = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_EXPO );		
	}


	/*
	 * permite ver el estado de cada  carga asi como las notificaciones avisos, status etc
	 * @author: Andres Botero
	 */
	public function executeListaStatus(){
		$this->idCliente = $this->getRequestParameter("idcliente");
				
		$this->modo = $this->getRequestParameter("modo");
		if( $this->modo=="maritimo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_MARITIMO );
		}		
		if( $this->modo=="aereo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_AEREO );
		}		
		if( $this->modo=="expo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_EXPO );
		}		
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		
		
					
		if( $this->getRequestParameter("reporte") ){
			$consecutivo = $this->getRequestParameter("reporte");
			
			if( !$consecutivo ){
				$this->redirect( "traficos/index?modo=".$this->modo );	
			}
			
			$reporte = ReporteTable::retrieveByConsecutivo( $consecutivo );
			$this->forward404Unless( $reporte ); 		
			
			if( $reporte->getCaTransporte()==Constantes::MARITIMO ){
				$this->modo="maritimo";
			}
			
			if( $reporte->getCaTransporte()==Constantes::AEREO ){
				$this->modo="aereo";
			}
			
			if( $reporte->getCaImpoexpo()==Constantes::EXPO ){
				$this->modo="expo";
			}
			
			$this->cliente = $reporte->getCliente(); 			
			$this->idreporte = $reporte->getCaIdreporte();
			$this->getRequest()->setParameter("idcliente", $this->cliente->getCaIdcliente() ); // Para el submenu
			
		}else{		
			if( !$this->idCliente ){
				$this->redirect( "traficos/index?modo=".$this->modo );	
			}
			$this->cliente = Doctrine::getTable("Cliente")->find( $this->idCliente );
			$this->forward404unless( $this->cliente );	
			$this->idreporte = null;
			$reporte = null;
		}
			
		$this->forward404unless( $this->modo );
		
		switch( $this->modo ){
			case "aereo":
				$this->reportes = ReporteTable::getReportesActivos( $this->cliente->getCaIdcliente(), Constantes::IMPO, Constantes::AEREO );
				break;
			case "maritimo":
				$this->reportes = ReporteTable::getReportesActivos( $this->cliente->getCaIdcliente() , Constantes::IMPO, Constantes::MARITIMO );
				break;
			case "expo":
				$this->reportes = ReporteTable::getReportesActivos( $this->cliente->getCaIdcliente() , Constantes::EXPO);
				break;	
		}							
		
		
		/*
		* En caso que no se encuentre entre los activos
		*/
		if( $reporte ){
			$flag = false;
			foreach( $this->reportes as $rep ){
				if( $reporte->getCaIdreporte()==$rep->getCaIdreporte() ){
					$flag=true;
					break;
				}	
			}		
			if( !$flag ){
				$this->reportes[] = $reporte;
			}
		}					
		//$this->getUser()->clearFiles();	
	}
	
	
	/*
	* Muestra la información de los reporte
	*/
	public function executeInfoReporte( $request ){
		
		$this->modo = $this->getRequestParameter("modo");
		if( $this->modo=="maritimo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_MARITIMO );
		}		
		if( $this->modo=="aereo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_AEREO );
		}		
		if( $this->modo=="expo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_EXPO );
		}		
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		$this->forward404Unless( $this->getRequestParameter("idreporte") );
		$this->reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("idreporte") );
		$this->forward404Unless( $this->reporte );
	}
	
	
	/*
	* Muestra un resumen de los status enviados al cliente
	*/
	public function executeHistorialStatus( $request ){
		$this->forward404Unless( $this->getRequestParameter("idreporte") );
		$this->reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("idreporte") );
		$this->forward404Unless( $this->reporte );
	}
	
	/***********************************************************************************
	* Creación de status
	************************************************************************************/
	
	/*
	 * Muestra un formario para agregar un nuevo status u aviso a un reporte
	 * @author: Andres Botero
	 */
	public function executeNuevoStatus( $request ){
		//exit("EN Mantenimiento");
		$this->modo = $request->getParameter( "modo" );
		$this->forward404unless( $this->modo );		
		if( $this->modo=="maritimo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_MARITIMO );
		}		
		if( $this->modo=="aereo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_AEREO );
		}		
		if( $this->modo=="expo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_EXPO );
		}		
		if( $this->nivel<1 ){
			$this->forward404();
		}	
		
		$idreporte = $this->getRequestParameter("idreporte");
		$this->forward404Unless( $idreporte );
		$reporte = Doctrine::getTable("Reporte")->find( $idreporte );
		$this->forward404Unless( $reporte );
		
		$this->modo = $this->getRequestParameter("modo");
		$this->forward404unless( $this->modo );
		
		$this->tipo = $this->getRequestParameter("tipo");
		
		$this->user = $this->getUser();
		
		$this->getRequest()->setParameter("reporte", $reporte->getCaConsecutivo());
		
		if( $this->getRequestParameter("destinatarios") ){
			$this->destinatarios = $this->getRequestParameter("destinatarios");
		}


		/*
		* Configuracion de la forma
		*/		
		$this->form = new NuevoStatusForm();
		if( $reporte->getCaConfirmarClie() ){
				$this->form->setDestinatarios( explode(",",$reporte->getCaConfirmarClie()) );
		}

        $cliente = $reporte->getCLiente();
        $fijos = Doctrine::getTable("Contacto")
                                   ->createQuery("c")
                                   ->addWhere("c.ca_idcliente = ?", $cliente->getCaIdcliente() )
                                   ->addWhere("ca_fijo = ?", true)
                                   ->execute();
        
        $this->form->setDestinatariosFijos( $fijos );
		//Etapas			

        $q = Doctrine::getTable("TrackingEtapa")->createQuery("t");
		if(  $reporte->getCaImpoexpo()==Constantes::TRIANGULACION ){
            $q->addWhere("t.ca_impoexpo = ? OR t.ca_impoexpo IS NULL", Constantes::IMPO);
		}else{
            $q->addWhere("t.ca_impoexpo = ? OR t.ca_impoexpo IS NULL", $reporte->getCaImpoexpo());
		}	
				
		if( $reporte->getCaImpoexpo()==Constantes::IMPO || $reporte->getCaImpoexpo()==Constantes::TRIANGULACION  ){
            $q->addWhere("t.ca_transporte = ? OR t.ca_transporte IS NULL", $reporte->getCaTransporte());
		}
        $q->addWhere("t.ca_departamento = ? OR t.ca_departamento IS NULL","Tráficos");
		$q->addOrderBy("t.ca_orden");
		
		$this->form->setQueryIdEtapa( $q );
		$this->etapas = $q->execute();
		
		// Tipos de piezas			
		$this->form->setQueryPiezas( ParametroTable::retrieveQueryByCaso( "CU047" ) );
		$this->form->setQueryPeso( ParametroTable::retrieveQueryByCaso( "CU049" ) );
	
		
		if( $reporte->getCaTransporte()==Constantes::AEREO ){
			$this->form->setQueryVolumen( ParametroTable::retrieveQueryByCaso( "CU058" ) );
		}else{
			$this->form->setQueryVolumen( ParametroTable::retrieveQueryByCaso( "CU050" ) );
		}
			
		
        $q = Doctrine_Query::create()->from("Concepto c")->where("c.ca_modalidad = ? ", "FCL");

		$this->form->setQueryConceptos( $q );
		
		
				
		//Busca los parametros definidos en CU059 
		//Campos personalizados por cliente			
		$parametros = ParametroTable::retrieveByCaso("CU059", null, null, $reporte->getCliente()->getCaIdgrupo() );
		
		$this->form->setWidgetsClientes( $parametros );
		
		$this->form->configure();	
		/*
		* Fin de la configuración
		*/

        /*$this->count = Doctrine::getTable("RepStatus")
                                 ->createQuery("r")
                                 ->select("count(*)")
                                 ->where("r.ca_idetapa = ? AND r.ca_idreporte = ?", array("IMCEM", $reporte->getCaIdreporte()))
                                 ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                                 ->execute();*/
		
		if ($request->isMethod('post')){		
		
			$bindValues = array();
						
			$destinatarios = $this->form->getDestinatarios();
			for( $i=0; $i< count($destinatarios) ; $i++ ){	
				if( $request->getParameter("destinatarios_".$i) ){	
					$bindValues["destinatarios_".$i] = trim($request->getParameter("destinatarios_".$i));					 				}
			}

            $destinatariosFijos = $this->form->getDestinatariosFijos();
			for( $i=0; $i< count($destinatariosFijos) ; $i++ ){
				if( $request->getParameter("destinatariosfijos_".$i) ){
					$bindValues["destinatariosfijos_".$i] = trim($request->getParameter("destinatariosfijos_".$i));					 				}
			}

			for( $i=0; $i<NuevoStatusForm::NUM_CC ; $i++ ){
				$bindValues["cc_".$i] = trim($request->getParameter("cc_".$i));
			}
						
			$bindValues["remitente"] = $request->getParameter("remitente");
			$bindValues["idetapa"] = $request->getParameter("idetapa");
			
			$bindValues["fchsalida"] = $request->getParameter("fchsalida");
			$bindValues["horasalida"] = $request->getParameter("horasalida");
			$bindValues["fchllegada"] = $request->getParameter("fchllegada");
			$bindValues["fchcontinuacion"] = $request->getParameter("fchcontinuacion");
			$bindValues["piezas"] = $request->getParameter("piezas");
			$bindValues["un_piezas"] = $request->getParameter("un_piezas");
			$bindValues["peso"] = $request->getParameter("peso");
			$bindValues["un_peso"] = $request->getParameter("un_peso");
			$bindValues["volumen"] = $request->getParameter("volumen");
			$bindValues["un_volumen"] = $request->getParameter("un_volumen");			
			$bindValues["doctransporte"] = $request->getParameter("doctransporte");
			$bindValues["idnave"] = $request->getParameter("idnave");
			
			$bindValues["asunto"] = $request->getParameter("asunto");
			$bindValues["introduccion"] = $request->getParameter("introduccion");
			$bindValues["mensaje"] = $request->getParameter("mensaje");
            $bindValues["mensaje_dirty"] = $request->getParameter("mensaje_dirty");
			$bindValues["notas"] = $request->getParameter("notas");
			
			$bindValues["mensaje_mask"] = $request->getParameter("mensaje_mask");
			
			$bindValues["datosbl"] = $request->getParameter("datosbl");		
			
			$bindValues["fchrecibo"] = $request->getParameter("fchrecibo");
			$bindValues["horarecibo"] = $request->getParameter("horarecibo");
						
			for( $i=0; $i<NuevoStatusForm::NUM_EQUIPOS ; $i++ ){
				$bindValues["equipos_tipo_".$i] = $request->getParameter("equipos_tipo_".$i);
				$bindValues["equipos_serial_".$i] = $request->getParameter("equipos_serial_".$i);
				$bindValues["equipos_cant_".$i] = $request->getParameter("equipos_cant_".$i);
			}
			
			$widgets = $this->form->getWidgetsClientes();
			
			foreach( $widgets as $name=>$val ){						
				$bindValues[$name] = $request->getParameter($name);		
			}
			
			$bindValues["prog_seguimiento"] = $request->getParameter("prog_seguimiento");
			if( $request->getParameter("prog_seguimiento") ){
				$bindValues["fchseguimiento"] = $request->getParameter("fchseguimiento");
				$bindValues["txtseguimiento"] = $request->getParameter("txtseguimiento");
			}
			$this->form->bind( $bindValues ); 
			if( $this->form->isValid() ){					
				$this->executeGuardarStatus( $request );				
			}				
		}
					
		
		
		$this->ultStatus = $reporte->getUltimoStatus();	
		
		$this->reporte = $reporte;
		
		
		/*
		Archivos del reporte
		*/
		
		//Para recuperar los archivos seleccionados
		$attachments = $this->getRequestParameter( "attachments" );
		$this->att = array();
		if( $attachments ){
			foreach( $attachments as $attachment){				
				$this->att[]=$this->user->getFile( $attachment );
				
			}
		}
		
		//Busca los archivos del reporte
		$this->files=$this->reporte->getFiles();
			
		
		$this->usuario = Doctrine::getTable("Usuario")->find( $this->getuser()->getUserId() );
		
		$config = sfConfig::get('sf_app_module_dir').DIRECTORY_SEPARATOR."traficos".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."textos.yml";
		$this->textos = sfYaml::load($config);	
			
	}
	
	
	/*
	 * Guarda el mensaje y actualiza el estatus
	 * @author: Andres Botero
	 */
	private function executeGuardarStatus( $request ){
		$idreporte = $this->getRequestParameter("idreporte");
		$this->forward404Unless( $idreporte );
		$reporte = Doctrine::getTable("Reporte")->find( $idreporte );
		$this->forward404Unless( $reporte );
		
		$this->modo = $this->getRequestParameter("modo");
		$this->forward404unless( $this->modo );
		
		$user = $this->getUser();
				
		$status = new RepStatus();
		$status->setCaIdreporte( $reporte->getCaIdreporte() );
		$status->setCaFchstatus( date("Y-m-d H:i:s") );
		$status->setCaIntroduccion( Utils::replace( $request->getParameter("introduccion") ) );	
		
		
		if( $request->getParameter("notas") ){ 
			$status->setCaComentarios( $request->getParameter("notas") );
		}
		$status->setCaIdetapa( $request->getParameter("idetapa") );
		
		
		
	
		if( $request->getParameter("fchrecibo") ){			
			$horaRecibo =  $request->getParameter("horarecibo");            
			if( !$horaRecibo['minute'] ){
				$horaRecibo['minute']='00';
			}

            $horaRecibo['hour']=str_pad($horaRecibo['hour'],2, "0", STR_PAD_LEFT );
            $horaRecibo['minute']=str_pad($horaRecibo['minute'],2, "0", STR_PAD_LEFT );
			$horaRecibo = implode(":", $horaRecibo );            
			$status->setCaFchrecibo( Utils::parseDate($request->getParameter("fchrecibo"), "Y-m-d")." ".$horaRecibo );
		}

        if( $request->getParameter("observaciones_idg") ){
            $status->setCaObservacionesIdg( $request->getParameter("observaciones_idg") );
        }

		$status->setCaFchenvio( date("Y-m-d H:i:s") );
		$status->setCaUsuenvio( $user->getUserId() );
			
		$piezas = $request->getParameter("piezas")."|".$request->getParameter("un_piezas");
		$peso = $request->getParameter("peso")."|".$request->getParameter("un_peso");
		$volumen = $request->getParameter("volumen")."|".$request->getParameter("un_volumen");
		
		if($request->getParameter("piezas")){
			$status->setCaPiezas( $piezas );
		}
		
		if($request->getParameter("peso")){
			$status->setCaPeso( $peso );
		}
		if($request->getParameter("volumen")){
			$status->setCaVolumen( $volumen );
		}	
		
		if( $request->getParameter("doctransporte") ){
			$status->setCaDoctransporte( $request->getParameter("doctransporte") );
		}
					
		if( $request->getParameter("docmaster") ){
			$status->setCaDocmaster( $request->getParameter("docmaster") );
		}
		
		
		if( $request->getParameter("idnave") ){
			$status->setCaIdnave( $request->getParameter("idnave") );
		}
		
		if( $request->getParameter("fchsalida") ){
			$status->setCaFchsalida( Utils::parseDate($request->getParameter("fchsalida")) );
		}
		if( $request->getParameter("fchllegada") ){
			$status->setCaFchllegada( Utils::parseDate($request->getParameter("fchllegada")) );
		}
			
		
		$horaRecibo = $request->getParameter("horasalida");		
		if( $horaRecibo['hour'] ){	
			$horasalida =  $request->getParameter("horasalida");		
			if( !$horasalida['minute'] ){
				$horasalida['minute']='00';
			}
			$horasalida = implode(":", $horasalida );
            $horasalida = $horasalida.":00";
			$status->setCaHorasalida( $horasalida );
		}
		
		if( $request->getParameter("horallegada") ){
			$status->setCaHorallegada( $request->getParameter("horallegada") );
		}
			
		if( trim($request->getParameter("fchcontinuacion")) && $reporte->getCaContinuacion()!="N/A" ){
			$status->setCaFchcontinuacion( Utils::parseDate(trim($request->getParameter("fchcontinuacion")) ));
		}
		
		//borra los equipos viejos
		$repequipos = $reporte->getRepEquipos();
		foreach( $repequipos as $equipo ){
			$equipo->delete();
		}
		
		for( $i=0; $i<NuevoStatusForm::NUM_EQUIPOS ; $i++ ){
			
			if( $request->getParameter("equipos_tipo_".$i) && $request->getParameter("equipos_cant_".$i) ){				
				$repequipo = new RepEquipo();
				$repequipo->setCaIdreporte( $reporte->getCaIdreporte() );
				$repequipo->setCaIdconcepto( $request->getParameter("equipos_tipo_".$i) );
				$repequipo->setCaCantidad( $request->getParameter("equipos_cant_".$i) );	
				if( $reporte->getCaImpoexpo()==Constantes::EXPO ){
					$repequipo->setCaIdequipo( $request->getParameter("equipos_serial_".$i) );
				}
				$repequipo->save();
			}
		}
			
		
		$parametros = ParametroTable::retrieveByCaso("CU059", null, null, $reporte->getCliente()->getCaIdgrupo() );
				
		
		foreach( $parametros as $parametro ){
			$valor = explode(":",$parametro->getCaValor());
			$name = $valor[0];
			$type = $valor[1];						
			if( $request->getParameter($name ) ){		
					
				$reporte->setProperty($name, $request->getParameter($name));
			}
		}
		$reporte->stopBlaming();
		$reporte->save();
		
		if( $reporte->getCaImpoexpo()==Constantes::EXPO ){
			$repExpo = $reporte->getRepexpo();		
			if( $request->getParameter("datosbl") ){
				$repExpo->setCaDatosbl( $request->getParameter("datosbl") );
			}
            if( $request->getParameter("inspeccion_fisica")!==null ){
                if( $request->getParameter("inspeccion_fisica") ){
                    $repExpo->setCaInspeccionFisica( true );
                }else{
                    $repExpo->setCaInspeccionFisica( false );
                }
            }
			$repExpo->save();	
		}			
		
		$status->setStatus( $request->getParameter("mensaje") );		
						
		$status->save();
		
		
		$address = array();			
		foreach( $_POST as $key=>$val ){					
			if( substr($key,0,14 )=="destinatarios_" ){
				if( $request->getParameter($key) ){
					$address[] = trim($request->getParameter($key));					 
				}
			}

            if( substr($key,0,19 )=="destinatariosfijos_" ){
				if( $request->getParameter($key) ){
					$address[] = trim($request->getParameter($key));
				}
			}
		}

        
		
		$cc = array();
		for( $i=0; $i<NuevoStatusForm::NUM_CC ; $i++ ){
			if( $request->getParameter("cc_".$i) ){
				$cc[] = trim($request->getParameter("cc_".$i));
			}
		}
		
		
		
		$user = $this->getUser();
		$attachments = $this->getRequestParameter( "attachments" );
		$att = array();
		if( $attachments ){
			foreach( $attachments as $attachment){				
				$att[]=$reporte->getDirectorioBase().base64_decode( $attachment );				
			}
		}


		
		$options["from"] =  $request->getParameter("remitente");
		
		$options["subject"] =  $request->getParameter("asunto");
		
			
		//$address = array();
		$status->send($address, $cc,  $att, $options);
		
		$tarea = $reporte->getNotTarea();					
		if( $request->getParameter("prog_seguimiento") ){
			
			$titulo = "Seguimiento RN".$reporte->getCaConsecutivo()." [".$reporte->getCaModalidad()." ".$reporte->getOrigen()->getCaCiudad()."->".$reporte->getDestino()->getCaCiudad()."]";
			$texto = "";			
			
			
			if( !$tarea || ($tarea && $tarea->getCaFchterminada()) ){			
				$tarea = new NotTarea(); 
				$tarea->setCaFchcreado( date("Y-m-d H:i:s") );
				$tarea->setCaUsucreado( $this->getUser()->getUserId() );
			}	
			$tarea->setCaUrl( "/traficos/listaStatus/modo/".$this->modo."/reporte/".$reporte->getCaConsecutivo() );
			$tarea->setCaIdlistatarea( 3 );			
			$tarea->setCaFchvencimiento( $request->getParameter("fchseguimiento")." 23:59:59" );
			$tarea->setCaFchvisible( $request->getParameter("fchseguimiento")." 00:00:00" );			
			$tarea->setCaTitulo( $titulo );		
			$tarea->setCaTexto( $request->getParameter("txtseguimiento") );
            if( $request->getParameter("remitente") ){
                $tarea->setCaNotificar( $request->getParameter("remitente") );
            }
			$tarea->save();
			$loginsAsignaciones = array( $this->getUser()->getUserId() );
			$tarea->setAsignaciones( $loginsAsignaciones );	
			
			/*$reporte->setCaIdseguimiento( $tarea->getCaIdtarea() );
            $reporte->stopBlaming();
			$reporte->save();		*/

            $asignacion = Doctrine::getTable("RepAsignacion")->find(array($reporte->getCaIdreporte(), $tarea->getCaIdtarea()));
            if( !$asignacion ){
                $asignacion = new RepAsignacion();
            }
            $asignacion->setCaIdreporte( $reporte->getCaIdreporte() );
            $asignacion->setCaIdtarea( $tarea->getCaIdtarea() );
            $asignacion->save();


            		
		}else{
            //Se lee de la base de datos ya que la etapa es actualizada por los triggers
            $reporte = Doctrine::getTable("Reporte")->find( $reporte->getCaIdreporte() );
			if( $reporte->getCaIdetapa()=="IMETA" || $reporte->getCaIdetapa()=="99999" ){//Quita todas las tareas
                $tareas = $reporte->getTareas( Reporte::IDLISTASEG );
                foreach( $tareas as $tarea ){
                    $tarea->setCaFchterminada( date("Y-m-d H:i:s") );
                    $tarea->save();
                }
			}	
		}				
		$this->redirect("traficos/listaStatus?modo=".$this->modo."&reporte=".$reporte->getCaConsecutivo());
	}
	
	
	
	
	/*
	* Muestra un resumen de los status enviados al cliente
	*/
	public function executeVerHistorialStatus( $request ){
		$this->forward404Unless( $this->getRequestParameter("idreporte") );
		$this->reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("idreporte") );
		$this->forward404Unless( $this->reporte );
	}


    /*
	* Muestra un resumen de los status enviados al cliente
	*/
	public function executeCerrarCaso( $request ){
		$this->forward404Unless( $this->getRequestParameter("idreporte") );
		$reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("idreporte") );
		$this->forward404Unless( $reporte );

        $this->modo = $this->getRequestParameter("modo");
		$this->forward404unless( $this->modo );

        $reporte->setCaIdetapa("99999");
        $reporte->save();

        $tareas = $reporte->getTareas( Reporte::IDLISTASEG );
        foreach( $tareas as $tarea ){
            $tarea->setCaFchterminada( date("Y-m-d H:i:s") );
            $tarea->save();
        }

        $this->redirect("traficos/listaStatus?modo=".$this->modo."&reporte=".$reporte->getCaConsecutivo());

	}
	
	
	/***********************************************************************************
	* Generación de cuadro en excel y correo electronico
	************************************************************************************/

	/*
	 * Genera un cuadro de excel con la informacion de los reportes, tal como la ve el usuario
	 * en verEstatusCarga
	 * @author: Andres Botero
	 */
	public function executeInformeTraficos(){
					
		$formato = $this->getRequestParameter("formato");
		switch( $formato ){
			/*case 2:
				$this->forward("traficos", "informeTraficosFormato2");
				break;*/
			default:
				$this->forward("traficos", "informeTraficosFormato1");
				break;
		}
	}
	
	
	public function executeInformeTraficosFormato1(  ){
				
		$this->idCliente = $this->getRequestParameter("idcliente");

		$this->modo = $this->getRequestParameter("modo");
		$this->cliente = Doctrine::getTable("Cliente")->find( $this->idCliente );

        $this->forward404Unless( $this->cliente );
		$this->forward404unless( $this->modo );
			
		switch( $this->modo ){
			case "aereo":
				$this->reportes = ReporteTable::getReportesActivos( $this->cliente->getCaIdcliente(), Constantes::IMPO, Constantes::AEREO );
				break;
			case "maritimo":
				$this->reportes = ReporteTable::getReportesActivos( $this->cliente->getCaIdcliente() , Constantes::IMPO, Constantes::MARITIMO );
				break;
			case "expo":
				$this->reportes = ReporteTable::getReportesActivos( $this->cliente->getCaIdcliente() , Constantes::EXPO);
				break;	
		}

        $this->parametros = ParametroTable::retrieveByCaso("CU059", null, null, $this->cliente->getCaIdgrupo() );
		
		$this->filename = $this->getRequestParameter("filename");
		
		$this->setLayout("excel");
	}
	
	
	/*
	 * Permite al usuario determinar que archivos se van a enviar por correo
	 * @author: Andres Botero
	 */
	public function executeCorreoTraficos(){
		
		
		$idCliente = $this->getRequestParameter("idcliente");
		$this->idCliente = $idCliente;		
		$this->modo = $this->getRequestParameter("modo");
		
		$this->consecutivo = $this->getRequestParameter("reporte");
		$this->forward404unless( $this->modo );
		$this->forward404unless( $this->idCliente );
		
		
		$this->cliente = Doctrine::getTable("Cliente")->find( $this->idCliente );
		
        switch( $this->modo ){
			case "aereo":
				$this->reportes = ReporteTable::getReportesActivos( $this->cliente->getCaIdcliente(), Constantes::IMPO, Constantes::AEREO );
				break;
			case "maritimo":
				$this->reportes = ReporteTable::getReportesActivos( $this->cliente->getCaIdcliente() , Constantes::IMPO, Constantes::MARITIMO );
				break;
			case "expo":
				$this->reportes = ReporteTable::getReportesActivos( $this->cliente->getCaIdcliente() , Constantes::EXPO);
				break;	
		}
        

		$this->user = $this->getUser();
		
		$this->usuario = Doctrine::getTable("Usuario")->find( $this->user->getUserId() );
		
		
	}
			
	/*
	 * Permite enviar un correo con la informacion de traficos, añade el cuadro de excel generado
	 * por executeInformeTraficos()
	 * @author: Andres Botero
	 */	
    public function executeEnviarCorreoTraficos(){

		$idCliente = $this->getRequestParameter("idcliente");
		$this->idCliente = $idCliente;
		$this->modo = $this->getRequestParameter("modo");

		$this->consecutivo = $this->getRequestParameter("reporte");

		$cliente = Doctrine::getTable("Cliente")->find( $idCliente );
		$adjuntar_excel = $this->getRequestParameter("adjuntar_excel");

		$this->forward404unless( $this->modo );
		$this->forward404unless( $this->idCliente );


		$user = $this->getUser();
		//Guarda el correo y lo envia
		$email = new Email();

		$email->setCaUsuenvio( $user->getUserId() );
		$email->setCaTipo( "Envío de cuadro" ); //Envío de Avisos
		$email->setCaIdcaso( null );

		$from = $this->getRequestParameter("from");
		if( $from ){
			$email->setCaFrom( $from );
		}else{
			$email->setCaFrom( $user->getEmail() );
		}
		$email->setCaFromname( $user->getNombre() );


		if( $this->getRequestParameter("readreceipt") ){
			$email->setCaReadreceipt( true );
		}else{
            $email->setCaReadreceipt( false );
        }

		$email->setCaReplyto( $user->getEmail() );

		$recips = explode(",", $this->getRequestParameter("destinatario") );

		foreach( $recips as $recip ){
			$recip = str_replace(" ", "", $recip );
			if( $recip ){
				$email->addTo( $recip );
			}
		}

		$recips = explode(",", $this->getRequestParameter("cc") );
		foreach( $recips as $recip ){
			$recip = str_replace(" ", "", $recip );
			if( $recip ){
				$email->addCc( $recip );
			}
		}

		if( $from ){
			$email->addCc( $from );
		}else{
			$email->addCc( $this->getUser()->getEmail() );
		}

		$email->setCaSubject( $this->getRequestParameter("asunto") );
        $email->setCaBody( $this->getRequestParameter("mensaje"));
		$email->setCaBodyhtml( Utils::replace($this->getRequestParameter("mensaje"))) ;
		$email->save();

        if( $adjuntar_excel ){
            $this->getRequest()->setParameter("save", "true");
            $directory = $email->getDirectorio();


            if( !is_dir($directory) ){
                @mkdir($directory, 0777, true);
            }
            $fileName = "status".str_replace(".", "", str_replace(" ", "_", $cliente->getCaCompania())).".xls";

			//Genera el archivo de excel
			$this->getRequest()->setParameter('filename',$email->getDirectorio().$fileName);
			sfContext::getInstance()->getController()->getPresentationFor( 'traficos', 'informeTraficosFormato1');
			$email->AddAttachment( $email->getDirectorioBase().$fileName );
		}

		$attachments = $this->getRequestParameter( "attachments" );
		if( $attachments ){
			foreach( $attachments as $attachment){
				$params = explode("_", $attachment );
				$idreporte = $params[0];
				$reporte = Doctrine::getTable("Reporte")->find( $idreporte );
				$this->forward404Unless( $reporte );

				$file = base64_decode($params[1]);
				$directory = $reporte->getDirectorioBase();

				$name = $directory.DIRECTORY_SEPARATOR.$file;
				$email->AddAttachment(  $name  );
			}
		}
		$email->save();
		//$email->send();
	}

	
	/***********************************************************************************
	* Plantillas para el correo de traficos 
	************************************************************************************/
		
	/*
	 * Plantillas para el correo de traficos 
	 * @author: Andres Botero
	 */	
	public function executeVerStatus(){
		
		$this->status = Doctrine::getTable("RepStatus")->find( $this->getRequestParameter("idstatus") );
		$this->forward404Unless( $this->status );
		$this->reporte = $this->status->getReporte();
			
		$this->setTemplate("emailDefaultStatus");	
			
		$etapa = $this->status->getTrackingEtapa();
					
		if( $etapa ){			
			if( $etapa->getCaTemplate() ){			
				$this->setTemplate($etapa->getCaTemplate());							
			}				
		} 
		
		$this->etapa = $etapa;
		
		
		$config = sfConfig::get('sf_app_module_dir').DIRECTORY_SEPARATOR."traficos".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."textos.yml";
		$this->textos = sfYaml::load($config);	
		
		
		$this->user = Doctrine::getTable("Usuario")->find( $this->status->getCaUsuenvio() );
				
		$this->setLayout("email");								
	}
	
	/***********************************************************************************
	* Funciones para manejar los archivos del reporte 
	************************************************************************************/
	
	/*
	* Ejecuta la accion de cargar el archivo en el iframe, en la forma CargarArchivoForm
	* author: Andres Botero
	*/
	public function executeCargarArchivo( $request ){
		
		//toma el valor del id del reporte, la referencia u otro objeto que se desee guardar
		// y determina el directorio
		
		
		$idreporte = $this->getRequestParameter( "idreporte" );
		if( $idreporte ){
            
			$reporte = Doctrine::getTable("Reporte")->find( $idreporte );
			$this->forward404Unless( $reporte );			
			
			$directory = $reporte->getDirectorio();
            
			
			$this->idreporte = $idreporte;
						
			if( !is_dir($directory) ){			
				mkdir($directory, 0777);
			}	
			
			$destPath = $directory.DIRECTORY_SEPARATOR.$_FILES['file']['name']; 
			//mueve el archivo
			move_uploaded_file($_FILES['file']['tmp_name'], $destPath);
			
			$this->setLayout("none");		
		}	
	}
	/*
	* Ejecuta la accion de cargar el archivo en el iframe, en la forma CargarArchivoForm
	* author: Andres Botero
	*/
	
	public function executeListaArchivosReporte( $request ){
		$idreporte = $request->getParameter( "idreporte" );
		$this->forward404Unless( $idreporte );
		$this->reporte = Doctrine::getTable("Reporte")->find( $idreporte );
		$this->forward404Unless( $this->reporte );
			
		$this->modo = $request->getParameter( "modo" );
		$this->forward404unless( $this->modo );		
		if( $this->modo=="maritimo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_MARITIMO );
		}		
		if( $this->modo=="aereo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_AEREO );
		}		
		if( $this->modo=="expo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( traficosActions::RUTINA_EXPO );
		}		
		if( $this->nivel==-1 ){
			$this->forward404();
		}	
	}
	
	
	/*
	* Permite eliminar un archivo de acuerdo al indice
	* author: Andres Botero
	*/
	public function executeEliminarArchivosReporte(){		
	
		$idreporte = $this->getRequestParameter( "idreporte" );
		$this->forward404Unless( $idreporte );
		$reporte = Doctrine::getTable("Reporte")->find( $idreporte );
		$this->forward404Unless( $reporte );				
		$file = base64_decode($this->getRequestParameter("file"));
		
		$directory = $reporte->getDirectorio();
		 
		$name = $directory.DIRECTORY_SEPARATOR.$file;	
		unlink( $name );
		return sfView::NONE;		
	}
	
	
	/*
	* Permite ver el contenido de un archivo
	* author: Andres Botero
	*/	
	public function executeFileViewer(){
		$idreporte = $this->getRequestParameter( "idreporte" );
		$this->forward404Unless( $idreporte );
		$reporte = Doctrine::getTable("Reporte")->find( $idreporte );
		$this->forward404Unless( $reporte );				
		$file = base64_decode($this->getRequestParameter("file"));
		
		$directory = $reporte->getDirectorio();			
		$this->name = $directory.DIRECTORY_SEPARATOR.$file;
		$this->setLayout("none");
	}
	
	/***********************************************************************************
	* Formulario de seguimientos
	************************************************************************************/
	
	/*
	* Permite modificar un seguimiento
	* author: Andres Botero
	*/	
	public function executeFormSeguimiento( $request ){
		$this->form = new SeguimientoForm();
		$reporte = $this->getRequestParameter( "reporte" );
		$this->forward404Unless( $reporte );
		$reporte = ReporteTable::retrieveByConsecutivo( $reporte );
		$this->forward404Unless( $reporte );

		$this->modo = $this->getRequestParameter("modo");		
		if( !$this->modo ){
			$this->forward( "traficos", "seleccionModo" );	
		}

        if( $this->getRequestParameter( "idtarea" ) ){
            $tarea = Doctrine::getTable("NotTarea")->find( $this->getRequestParameter( "idtarea" ) );
            $this->forward404Unless( $tarea );
        }else{
            $tarea = new NotTarea();
            $tarea->setCaFchcreado( date("Y-m-d H:i:s") );
            $tarea->setCaUsucreado( $this->getUser()->getUserId() );
        }
		
		if ($request->isMethod('post')){           
			$bindValues = array();			
			$bindValues["fchseguimiento"] = $request->getParameter("fchseguimiento");
			$bindValues["txtseguimiento"] = $request->getParameter("txtseguimiento");
			
			$this->form->bind( $bindValues ); 
			if( $this->form->isValid() ){					
				$titulo = "Seguimiento RN".$reporte->getCaConsecutivo()." [".$reporte->getCaModalidad()." ".$reporte->getOrigen()->getCaCiudad()."->".$reporte->getDestino()->getCaCiudad()."]";
				$texto = "";			
				
				
				$tarea->setCaUrl( "/traficos/listaStatus/modo/maritimo/reporte/".$reporte->getCaConsecutivo() );
				$tarea->setCaIdlistatarea( 3 );			
				$tarea->setCaFchvencimiento( $request->getParameter("fchseguimiento")." 23:59:59" );
				$tarea->setCaFchvisible( $request->getParameter("fchseguimiento")." 00:00:00" );			
				$tarea->setCaTitulo( $titulo );		
				$tarea->setCaTexto( $request->getParameter("txtseguimiento") );
				$tarea->save();
				$loginsAsignaciones = array( $this->getUser()->getUserId() );
				$tarea->setAsignaciones( $loginsAsignaciones );	
				
                $asignacion = Doctrine::getTable("RepAsignacion")->find(array($reporte->getCaIdreporte(), $tarea->getCaIdtarea()));
                if( !$asignacion ){
                    $asignacion = new RepAsignacion();
                }
                $asignacion->setCaIdreporte( $reporte->getCaIdreporte() );
                $asignacion->setCaIdtarea( $tarea->getCaIdtarea() );
                $asignacion->save();
				
				$this->redirect( "traficos/listaStatus?modo=".$this->modo."&reporte=".$reporte->getCaConsecutivo() );
			}				
		}
		
		$this->reporte = $reporte;
        $this->tarea = $tarea;
	}

    /*
	* Permite modificar un seguimiento
	* author: Andres Botero
	*/
	public function executeTerminarSeguimiento( $request ){
        $this->form = new SeguimientoForm();
		$reporte = $request->getParameter( "reporte" );
		$this->forward404Unless( $reporte );
		$reporte = ReporteTable::retrieveByConsecutivo( $reporte );
        $this->forward404Unless( $reporte );

        $tarea = Doctrine::getTable("NotTarea")->find( $request->getParameter( "idtarea" ) );
        $this->forward404Unless( $tarea );

        
        $asignacion = Doctrine::getTable("RepAsignacion")
                                ->createQuery("a")
                                ->innerJoin("a.Reporte r")
                                ->addWhere("a.ca_idtarea = ? ", $tarea->getCaIdtarea() )
                                ->addWhere("r.ca_consecutivo = ? ", $reporte->getCaConsecutivo() )
                                ->fetchOne();
        
        $this->forward404Unless( $asignacion );

		$this->modo = $this->getRequestParameter("modo");
		if( !$this->modo ){
			$this->forward( "traficos", "seleccionModo" );
		}

		
        
        $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
        $tarea->save();
        if ($request->isXmlHttpRequest()){
            $this->responseArray = array("success"=>true);
            $this->setTemplate("responseTemplate");

        }else{
            $this->redirect( "traficos/listaStatus?modo=".$this->modo."&reporte=".$reporte->getCaConsecutivo() );
        }
    }
	
}
?>
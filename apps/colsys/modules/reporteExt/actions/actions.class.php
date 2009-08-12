<?php

/**
 * reporteExt actions.
 *
 * @package    colsys
 * @subpackage reporteExt
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class reporteExtActions extends sfActions
{
	const RUTINA_MARITIMO = "78";
	const RUTINA_AEREO = "79";
	/**
	* Permite crear un nuevo reporte 
	*
	* @param sfRequest $request A request object
	*/
	public function executeCrearReporte(sfWebRequest $request){
				
		$this->forward404Unless( $this->getRequestParameter("idreporte") );
		$this->reporte = ReportePeer::retrieveByPk( $this->getRequestParameter("idreporte") );		
		$this->forward404Unless( $this->reporte );
		
		$this->forward404Unless( $this->reporte->getCaImpoExpo()==Constantes::IMPO || $this->reporte->getCaImpoExpo()==Constantes::TRIANGULACION );
		
		if( $this->reporte->getCatransporte()==Constantes::MARITIMO ){
			$this->nivel = $this->getUser()->getNivelAcceso( reporteExtActions::RUTINA_MARITIMO );
			$this->modo = "maritimo";		
		}		
		if( $this->reporte->getCatransporte()==Constantes::AEREO ){
			$this->nivel = $this->getUser()->getNivelAcceso( reporteExtActions::RUTINA_AEREO );	
			$this->modo = "aereo";	
		}		
		
		if( $this->nivel<1 ){
			$this->forward404();
		}
		
		$this->user = $this->getuser();
		$this->usuario = UsuarioPeer::retrieveByPk( $this->getuser()->getUserId() );
		
		if( $this->reporte->getCaIdAgente() ){
			$c = new Criteria();
			$c->add( ContactoAgentePeer::CA_IDAGENTE , $this->reporte->getCaIdAgente() );
			$c->add( ContactoAgentePeer::CA_IMPOEXPO , "%".$this->reporte->getCaImpoexpo()."%", Criteria::LIKE );
			$c->add( ContactoAgentePeer::CA_TRANSPORTE ,  "%".$this->reporte->getCaTransporte()."%" , Criteria::LIKE );
			$c->add( ContactoAgentePeer::CA_ACTIVO , true );
			$c->addAscendingOrderByColumn( ContactoAgentePeer::CA_IDCIUDAD );
			$c->addDescendingOrderByColumn( ContactoAgentePeer::CA_SUGERIDO );
			$c->addAscendingOrderByColumn( ContactoAgentePeer::CA_NOMBRE );
			$contactosAg = ContactoAgentePeer::doSelect( $c );
		}
		
		$this->form = new NuevoReporteForm();	
		$this->form->setContactosAg( $contactosAg );
		$this->form->configure();
		
		/*
		* Fin de la configuración
		*/
		
		if ($request->isMethod('post')){		
		
			$bindValues = array();
						
			$contactos = $this->form->getContactosAg();
			foreach( $contactos as $contacto ){	
				if( $request->getParameter("destinatarios_".$contacto->getCaIdcontacto() ) ){	
					$bindValues["destinatarios_".$contacto->getCaIdcontacto()] = trim($request->getParameter("destinatarios_".$contacto->getCaIdcontacto() ));					 
				}
			}
			
			for( $i=0; $i<NuevoReporteForm::NUM_CC ; $i++ ){
				$bindValues["cc_".$i] = trim($request->getParameter("cc_".$i));
			}
						
			$bindValues["remitente"] = $request->getParameter("remitente");
			
			
			$bindValues["asunto"] = $request->getParameter("asunto");
			$bindValues["introduccion"] = $request->getParameter("introduccion");
			$bindValues["instrucciones"] = $request->getParameter("instrucciones");
			
			$bindValues["notas"] = $request->getParameter("notas");
			
			
			$bindValues["prog_seguimiento"] = $request->getParameter("prog_seguimiento");
			if( $request->getParameter("prog_seguimiento") ){
				$bindValues["fchseguimiento"] = $request->getParameter("fchseguimiento");
				$bindValues["txtseguimiento"] = $request->getParameter("txtseguimiento");
			}
			
			
			$bindFiles["archivo"] = $_FILES["archivo"];
			
			$this->form->bind( $bindValues, $bindFiles ); 
			if( $this->form->isValid() ){	
			
				/*
				* programa la tarea
				*/
				
				$reporte = $this->reporte;
				$tarea = $reporte->getNotTarea();					
				if( $request->getParameter("prog_seguimiento") ){
					
					$titulo = "Seguimiento RN".$reporte->getCaConsecutivo()." [".$reporte->getCaModalidad()." ".$reporte->getOrigen()->getCaCiudad()."->".$reporte->getDestino()->getCaCiudad()."]";
					$texto = "";			
					
					
					if( !$tarea || ($tarea && $tarea->getCaFchterminada()) ){			
						$tarea = new NotTarea(); 
						$tarea->setCaFchcreado( time() );								
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
					
					$reporte->setCaIdseguimiento( $tarea->getCaIdtarea() );
					$reporte->save();				
				}else{
					if( $tarea ){
						$tarea->setCaFchterminada( time() );
						$tarea->setCaUsuterminada( $this->getUser()->getUserId()  );									
						$tarea->save();
					}	
				}	
				
				/*
				* Crea el reporte
				*/
							
				$contenido ="<style type='text/css'>";
				$contenido.="td {font-size:9px; font-family:verdana, arial, helvetica, serif; line-height:1.4; border:solid 0.5px; vertical-align:top;}";
				$contenido.="</style>";
		
				$contenido.= nl2br($request->getParameter("introduccion"));
				$contenido.= '<br /><TABLE BORDER="0" WIDTH="500" CELLSPACING="0" CELLPADDING="0">';
				$contenido.= "<TR><TD>";
				
				$request->setParameter('idreporte',$this->reporte->getCaIdreporte());
				$request->setParameter('layout', "email");
				$contenido.= sfContext::getInstance()->getController()->getPresentationFor( 'reporteExt', 'verReporte');
						
				$contenido.= "</TD></TR>";
				$contenido.= "</TABLE>";
				$contenido.= "<BR><B>Shipping Instructions :</B><BR>";
				$contenido.= nl2br($request->getParameter("instrucciones"));
				$contenido.= "<BR><B>Notes :</B><BR>";
				$contenido.= nl2br($request->getParameter("notas"));
				//$contenido = AddSlashes($contenido);
						
				$user = $this->getUser();
				
				$email = new Email();	
								
				$email->setCaUsuenvio( $user->getUserId() );	
				if( $this->reporte->getCaTransporte()==Constantes::MARITIMO ){	
					$email->setCaTipo( "Rep.MarítimoExterior" );
				}
				
				if( $this->reporte->getCaTransporte()==Constantes::AEREO ){				
					$email->setCaTipo( "Rep.AéreoExterior" );
				}
							
				$email->setCaIdcaso( $this->reporte->getCaIdreporte() );
				
				//print_r( $_POST );
				
				if( $request->getParameter("remitente") ){
					$email->setCaFrom( $request->getParameter("remitente") );
					$email->setCaReplyto( $request->getParameter("remitente") );
				}else{
					$email->setCaFrom( $user->getEmail() );
					$email->setCaReplyto( $user->getEmail() );
				}
				$email->setCaFromname( $user->getNombre() );
				
				if( $request->getParameter("readreceipt") ){
					$email->setCaReadReceipt( true );
				}
				
				foreach( $contactos as $contacto ){		
					$recip = $bindValues["destinatarios_".$contacto->getCaIdcontacto()];
					
					$recip = str_replace(" ", "", $recip );			
					if( $recip ){
						$email->addTo( $recip ); 
					}									 
				}
				
				for( $i=0; $i<NuevoReporteForm::NUM_CC ; $i++ ){
					$recip = $bindValues["cc_".$i];
					if( $recip ){
						$email->addCc( $recip ); 
					}
				}
								
				if( $request->getParameter("remitente") ){
					$email->addCc( $request->getParameter("remitente"));
				}else{				
					$email->addCc( $user->getEmail() );
				}
												
				$email->setCaSubject( $request->getParameter("asunto") );
				$email->setCaBodyHtml( $contenido );				
				$email->save();
							
				$fileName = $_FILES['archivo']['tmp_name'];
				
				if( is_uploaded_file( $fileName ) ){ 
					$fileSize = filesize($fileName);			
					$fp = fopen($fileName, "r");
					$data = fread( $fp , $fileSize);
					fclose( $fp );
					
					$attachment = new EmailAttachment();
					$attachment->setCaIdemail( $email->getCaIdemail() );
					$attachment->setCaContent( $data );			
					$attachment->setCaFilesize( $fileSize );
					$attachment->setCaHeaderFile( basename($_FILES['archivo']['name']) );
					$attachment->save();
				}				
								
				$email->send();
				
				if( $this->reporte->getCaIdTareaRext() ){
					$tarea = NotTareaPeer::retrieveByPk( $this->reporte->getCaIdTareaRext() );
					if( $tarea ){
						$tarea->setCaFchterminada( time() );
						$tarea->save();
					}
				}
								
				$this->redirect( "traficos/listaStatus?modo=".$this->modo."&reporte=".$this->reporte->getCaConsecutivo() );
					
			}				
		}				
	}
	
	public function executeVerReporte( sfWebRequest $request ){	
		$this->forward404Unless( $this->getRequestParameter("idreporte") );
		$this->reporte = ReportePeer::retrieveByPk( $this->getRequestParameter("idreporte") );		
		$this->forward404Unless( $this->reporte );
		
		$this->forward404Unless( $this->reporte->getCaImpoExpo()==Constantes::IMPO||$this->reporte->getCaImpoExpo()==Constantes::TRIANGULACION );
		
		if( $this->getRequestParameter("layout") ){
			$this->setLayout( $this->getRequestParameter("layout") );
		}
		
		
	}
	
	
	
	/*
	* Mustra las instrucciones del agente
	*/
	public function executeInstruccionesAgentes( sfWebRequest $request ){
		if( $request->getParameter("transporte")==Constantes::AEREO ){
			$this->parametros = ParametroPeer::retrieveByCaso('CU039');			
		}else{
			$this->parametros = ParametroPeer::retrieveByCaso('CU024');			
		}		
		$this->setLayout("popup");
	}
	
}
?>
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
        
		$this->reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("idreporte") );
		$this->forward404Unless( $this->reporte );


        //Busca la ultima versión. Ver ticket 4633.
        $rep = ReporteTable::retrieveByConsecutivo( $this->reporte->getCaConsecutivo() );
        if( $rep->getCaIdreporte()!=$this->reporte->getCaIdreporte() ){
            $this->redirect("reporteExt/crearReporte?idreporte=".$rep->getCaIdreporte());
        }
		//echo $this->reporte->getCaImpoexpo()."-".Constantes::IMPO;
        //exit;
		$this->forward404Unless( $this->reporte->getCaImpoexpo()==Constantes::IMPO || $this->reporte->getCaImpoexpo()==Constantes::TRIANGULACION );
		
		if( $this->reporte->getCaTransporte()==Constantes::MARITIMO ){
			$this->nivel = $this->getUser()->getNivelAcceso( reporteExtActions::RUTINA_MARITIMO );
			$this->modo = "maritimo";		
		}		
		if( $this->reporte->getCaTransporte()==Constantes::AEREO ){
			$this->nivel = $this->getUser()->getNivelAcceso( reporteExtActions::RUTINA_AEREO );	
			$this->modo = "aereo";	
		}		
        
        if( $this->reporte->getCaTransporte()==Constantes::TERRESTRE ){
            $this->nivel = $this->getUser()->getNivelAcceso( reporteExtActions::RUTINA_MARITIMO );
			$this->modo = "maritimo";
        }
		
		if( $this->nivel<1 ){
			$this->forward404();
		}
		
		$this->user = $this->getuser();
		$this->usuario = Doctrine::getTable("Usuario")->find( $this->getuser()->getUserId() );
		
		if( $this->reporte->getCaIdagente() ){
			
            if( $this->reporte->getCaImpoexpo()==Constantes::TRIANGULACION ){
                $impoexpo = Constantes::IMPO;
            }else{
                $impoexpo = $this->reporte->getCaImpoexpo();
            }

            //$transporte=($this->reporte->getCaTransporte()==constantes::TERRESTRE)?constantes::MARITIMO:$this->reporte->getCaTransporte();
            $contactosAg = Doctrine::getTable("IdsContacto")
                                     ->createQuery("c")
                                     ->innerJoin("c.IdsSucursal s")
                                     ->innerJoin("s.Ids i")
                                     ->innerJoin("i.IdsAgente a")
                                     ->innerJoin("s.Ciudad ci")
                                     ->where("a.ca_idagente = ?", $this->reporte->getCaIdagente() )
                                     ->addWhere("c.ca_impoexpo like ?", "%".$impoexpo."%" )
                                     ->addWhere("c.ca_transporte like ?", "%".$this->reporte->getCaTransporte()."%" )
                                     ->addWhere("c.ca_activo = ?", true )
                                     ->addWhere("c.ca_fcheliminado IS NULL" )
                                     ->addOrderBy("ci.ca_ciudad")
                                     ->addOrderBy("c.ca_sugerido DESC")
                                     ->addOrderBy("c.ca_nombres")
                                     ->execute();

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
                        $bindValues["hbltxt"] = $request->getParameter("hbltxt");
                        //echo $bindValues["hbltxt"];
                        //exit;
			
			
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
				//$tarea = $reporte->getNotTarea();
				if( $request->getParameter("prog_seguimiento") ){
					
					$titulo = "Seguimiento RN".$reporte->getCaConsecutivo()." [".$reporte->getCaModalidad()." ".$reporte->getOrigen()->getCaCiudad()."->".$reporte->getDestino()->getCaCiudad()."]";
					$texto = "";			
					
					
						
                    $tarea = new NotTarea();
                    $tarea->setCaFchcreado( date("Y-m-d H:i:s") );
                    $tarea->setCaUsucreado( $this->getUser()->getUserId() );

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


                    $asignacion = Doctrine::getTable("RepAsignacion")->find(array($reporte->getCaIdreporte(), $tarea->getCaIdtarea()));
                    if( !$asignacion ){
                        $asignacion = new RepAsignacion();
                    }
                    $asignacion->setCaIdreporte( $reporte->getCaIdreporte() );
                    $asignacion->setCaIdtarea( $tarea->getCaIdtarea() );
                    $asignacion->save();

					/*$reporte->setCaIdseguimiento( $tarea->getCaIdtarea() );
                    $reporte->stopBlaming();
					$reporte->save();*/
				}
				
				/*
				* Crea el reporte
				*/
				

                $request->setParameter('layout', "email");
                $request->setParameter('hbltxt', $request->getParameter("hbltxt"));
                
                $contenido = sfContext::getInstance()->getController()->getPresentationFor( 'reporteExt', 'verReporte');
                //$contenido = AddSlashes($contenido);
                $user = $this->getUser();
                $email = new Email();
                $email->setCaUsuenvio( $user->getUserId() );	
                if( $this->reporte->getCaTransporte()==Constantes::MARITIMO || $this->reporte->getCaTransporte()==Constantes::TERRESTRE ){
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
                        @$recip = $bindValues["destinatarios_".$contacto->getCaIdcontacto()];

                        $recip = str_replace(" ", "", $recip );			
                        if( $recip ){
                                $email->addTo( $recip ); 
                        }									 
                }
				
                for( $i=0; $i<NuevoReporteForm::NUM_CC ; $i++ ){
                        @$recip = $bindValues["cc_".$i];
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
                $email->setCaBodyhtml( $contenido );
                $email->save();

                $fileName = $_FILES['archivo']['tmp_name'];

                if( is_uploaded_file( $fileName ) ){
                    $directory = $email->getDirectorio();
                    if( !is_dir($directory) ){
                        @mkdir($directory, 0777, true);
                    }
                    move_uploaded_file($fileName , $directory.basename($_FILES['archivo']['name']) );

                    $email->addAttachment($email->getDirectorioBase().basename($_FILES['archivo']['name']));
                    $email->save();
				}				
								
				$email->send();
				
				if( $this->reporte->getCaIdtareaRext() ){
					$tarea = Doctrine::getTable("NotTarea")->find( $this->reporte->getCaIdtareaRext() );                    
					if( $tarea ){
						$tarea->setCaFchterminada( date("Y-m-d H:i:s") );
                        $tarea->setCaObservaciones( $tarea->getCaObservaciones()." terminada:Crear Reporte al exterior" );
						$tarea->save();
					}
				}

                if( !$reporte->getCaIdetapa() ){

                    if( $reporte->getCaTransporte()==Constantes::MARITIMO || $reporte->getCaTransporte()==Constantes::TERRESTRE ){
                        $reporte->setCaIdetapa( "IMCAG" );
                    }

                    if( $reporte->getCaTransporte()==Constantes::AEREO ){
                        $reporte->setCaIdetapa( "IACAG" );
                    }

                    $reporte->stopBlaming();
					$reporte->save();
                }
								
				$this->redirect( "traficos/listaStatus?modo=".$this->modo."&reporte=".$this->reporte->getCaConsecutivo() );
					
			}				
		}				
	}
	
	


	public function executeVerReporte( sfWebRequest $request ){
            $this->forward404Unless( $this->getRequestParameter("idreporte") );
            $this->reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("idreporte") );
            $this->forward404Unless( $this->reporte );

            $this->layout=$this->getRequestParameter("layout");
            $this->hbltxt=Utils::replace($this->getRequestParameter("hbltxt"));
            
            if($this->reporte->getCaImpoexpo()==Constantes::OTMDTA)
            {
                $this->reporte = Doctrine::getTable("Reporte")
                                     ->createQuery("r")                                     
                                     ->whereIn("r.ca_tiporep", array('1','2','3'))
                                     ->addWhere("r.ca_consecutivo = ? ", $this->reporte->getCaConsecutivo()  )                                     
                                     ->addOrderBy("r.ca_consecutivo DESC")                                     
                                     ->fetchOne();
                $this->forward404Unless( $this->reporte );
            }
		//$this->forward404Unless( $this->reporte->getCaImpoexpo()==Constantes::IMPO||$this->reporte->getCaImpoexpo()==Constantes::TRIANGULACION );

            if( $this->getRequestParameter("layout") ){
                $this->setLayout( $this->layout );
            }

            $this->introduccion = $this->getRequestParameter("introduccion");
            $this->instrucciones = $this->getRequestParameter("instrucciones");
            $this->notas = $this->getRequestParameter("notas");
	}
	
	
	/*
	* Mustra las instrucciones del agente
	*/
	public function executeInstruccionesAgentes( sfWebRequest $request ){
		if( $request->getParameter("transporte")==Constantes::AEREO ){
			$this->parametros = ParametroTable::retrieveByCaso('CU039');
		}else{
			$this->parametros = ParametroTable::retrieveByCaso('CU024');
		}		
		$this->setLayout("popup");
	}
	
}
?>
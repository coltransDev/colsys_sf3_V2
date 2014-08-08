<?php

/**
 * reportes actions.
 *
 * @package    colsys
 * @subpackage reportes
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class reportesActions extends sfActions
{
  /*
	* Muestra una vista previa del reporte cuando el usuario hace click sobre el embarque
	*/
	public function executeDetalleReporte(){
		
		
		
		$reporte_id = $this->getRequestParameter( "rep" );
		$this->reporte = ReporteTable::retrieveByConsecutivo( $reporte_id );
		$this->forward404Unless( $this->reporte );
		
		
		$this->user = $this->getUser();        
		$cliente = $this->reporte->getCliente();
        
        
        
		
		
		if(!$this->user->getTrackingUser()){
			$this->user->setClienteActivo($cliente->getCaIdcliente());
            $this->tipo=0;
		}
        else
        {
            $this->tipo = $this->getUser()->getContacto()->getCaTipo();            
        }
				
		if( $cliente->getCaIdcliente()!= $this->getUser()->getClienteActivo() && $cliente->getCaIdgrupo()!= $this->getUser()->getClienteActivo()){ // En este caso esta tratando de ver informacion que no es del cliente
			$this->forward404();			
		}	
		
		$this->statusReporte = $this->reporte->getRepStatus();
		$this->trackingUser = $this->getUser()->getTrackingUser();
		
		/*
		* Muestra los archivos adjuntos al reporte 
		*/
		$directory = $this->reporte->getDirectorio();									
		if( !is_dir($directory) ){			
			@mkdir($directory, 0777);			
		}		
		$this->files=sfFinder::type('file')->maxDepth(0)->in($directory);								
		$this->user->clearFiles();
			
	}
	
	public function executeVerEmail(){
		$idemail = $this->getRequestParameter( "email" );	
		$idstatus = $this->getRequestParameter( "idstatus" );
		
		$this->forward404Unless( $idemail );
		
		if( $idstatus ){
			$status = Doctrine::getTable("RepStatus")->find($idstatus);
			if( $status ){
				//$this->forward404Unless( $status );
				$reporte = $status->getReporte();
				
				$cliente = $reporte->getCliente();				
				if( $cliente->getCaIdcliente()!= $this->getUser()->getClienteActivo() ){ // En este caso esta tratando de ver informacion que no es del cliente
					$this->forward404();			
				}
			}
		}	
		$this->email = Doctrine::getTable("Email")->find( $idemail );
		$this->forward404Unless( $this->email );
	}
	
	/*
	* Guarda un comentario realizado en un status
	*/
	public function executeGuardarRespuesta( $request ){
        try{
            $this->setLayout("ajax");

            $idstatus = $request->getParameter("idstatus");
            $comentario = $request->getParameter("comentario");

            //print_r($_POST );
            $status = Doctrine::getTable("RepStatus")->find( $idstatus );
            $this->forward404Unless( $status );
            $reporte = $status->getReporte();

            $cliente = $reporte->getCliente();

            if( $cliente->getCaIdcliente()!= $this->getUser()->getClienteActivo() ){ // En este caso esta tratando de ver informacion que no es del cliente
                $this->forward404();
            }

            $respuesta  = new RepStatusRespuesta();
            $respuesta->setCaIdstatus( $idstatus );
            $respuesta->setCaRespuesta( utf8_decode($comentario) );
            $respuesta->setCaFchcreado( time() );

            $user = $this->getUser()->getTrackingUser();

            if( $user ){
                $respuesta->setCaEmail( $user->getCaEmail() );
            }else{
                $respuesta->setCaLogin( $this->getUser()->getUserId() );
            }
            $respuesta->save();
            
            
            
            $respuestas = Doctrine::getTable("RepStatusRespuesta")
                                    ->createQuery("rs")
                                    ->addWhere("rs.ca_idstatus=?", $status->getCaIdstatus())
                                    ->addOrderBy("rs.ca_fchcreado ASC")
                                    ->execute();

            $correosCliente = array();
            $logins = array();
            foreach( $respuestas as $respuesta ){

                if( $respuesta->getCaEmail() ){
                    $correosCliente[]=$respuesta->getCaEmail();
                }else{
                    $logins[] = $respuesta->getCaLogin();
                }
            }
            //Le informa al vendedor
            $logins[] = $reporte->getCaLogin();


            $operativos = $reporte->getUsuariosOperativos();

            foreach( $operativos as $operativo ){
                $logins[] = $operativo->getCaLogin();
            }

            $logins[] = $status->getCaUsuenvio();


            $logins = array_unique($logins);

            /*
            Notifica a todas las personas de Coltrans  y Colmas
            */
            $email = new Email();
            $email->setCaUsuenvio( "Administrador" );

            $email->setCaTipo( "Respuesta a Status" );

            $email->setCaIdcaso( $respuesta->getCaIdrepstatusrespuestas() ); //
            $email->setCaFrom( "no-reply@coltrans.com.co" );
            $email->setCaFromname( "Respuesta a status desde pagina Web" );

            if( is_array($logins) ){
                foreach( $logins as $login ){
                    $usuario = Doctrine::getTable("Usuario")->find( $login );
                    $email->addTo( $usuario->getCaEmail() );
                }
            }

            $recips = explode( ",", $reporte->getCaConfirmarClie() );
            if( is_array($recips) ){
                foreach( $recips as $recip ){
                    $recip = str_replace(" ", "", $recip );
                    if( $recip && strpos($recip, "coltrans.com.co")!==false){
                        $email->addTo( $recip );
                    }
                }
            }

            if ( $reporte->getCaContinuacion() != 'N/A' ){
                if( ($etapa && $etapa->getCaDepartamento()!="OTM/DTA") || !$etapa ){
                    $recips = explode(",",$reporte->getCaContinuacionConf());
                    foreach( $recips as $recip ){
                        $recip = str_replace(" ", "", $recip );
                        if( $recip ){
                            $email->addCc( $recip );
                        }
                    }
                }
            }

            if ( $reporte->getCaColmas() == 'Sí'  ){
                $cordinador = $reporte->getCliente()->getCoordinador();
                if( $cordinador ){
                    $email->addCc( $cordinador->getCaEmail() );
                }
            }

            $email->setCaSubject( "Respuesta a status desde Tracking" );

            $txt = "Reporte: \n\n".$reporte->getCaConsecutivo()." ".$reporte->getCliente()->getCaCompania()."\n"."Respuesta: \n".$comentario."\n\nStatus: \n".$status->getStatus()."";

            foreach( $respuestas as $respuesta ){
                $txt .= " - ".$respuesta->getCaRespuesta()."\n\n";
            }

            $txt.="\n\nPara responder haga click en el siguiente vinculo:\n\n ";

            $link ="https://".sfConfig::get("app_branding_url")."/tracking/reportes/detalleReporte/rep/".$reporte->getCaConsecutivo()."/idstatus/".$idstatus;

            $linkHtml= "<a href='$link'>$link</a>";

            $email->setCaBody( $txt.$link );
            $email->setCaBodyhtml( Utils::replace($txt).$linkHtml );
            $email->save();
            //$email->send();

            /*$email->setCaAddress("abotero@coltrans.com.co");
            $email->setCaCc("abotero@coltrans.com.co");
            $email->send();*/


            /*
            Notifica al cliente
            */
            if( count( $correosCliente )>0 ){
                $email = new Email();
                $email->setCaUsuenvio( "Administrador" );

                $email->setCaTipo( "Respuesta a Status" );

                $email->setCaIdcaso( $respuesta->getCaIdrepstatusrespuestas() ); //
                $email->setCaFrom( "no-reply@coltrans.com.co" );
                $email->setCaFromname( "Respuesta a status desde pagina Web" );

                foreach( $correosCliente as $recip ){
                    $recip = str_replace(" ", "", $recip );
                    $email->addTo( $recip );
                }
                $email->setCaSubject( "Respuesta a status desde Tracking" );
                $email->setCaBody( $txt.$link );
                $email->setCaBodyhtml( Utils::replace($txt).$linkHtml );

                $email->save();
                $email->send();

                /*$email->setCaAddress("abotero@coltrans.com.co");
                $email->setCaCc("abotero@coltrans.com.co");
                $email->send();*/

            }


            if( $user ){ // FIX-ME Se crea una tarea

            }


            $this->idreporte = $reporte->getCaIdreporte();
            $this->idstatus = $idstatus;
        }catch( Exception $e){
            echo $e->getMessage();
        }
		
	}
	
	/*
	* Exporta a Excel el listado
	*/
	public function executeInformeTraficosFormato1(  ){
				
		set_time_limit(0);		
		
		$this->impoexpo = $this->getRequestParameter("impoexpo");
		$this->transporte = $this->getRequestParameter("transporte");
		$this->cliente = Doctrine::getTable("Cliente")->find( $this->getUser()->getClienteActivo() );
				
		$this->forward404Unless( $this->cliente );
		$this->forward404unless( $this->impoexpo );
		
		$historial = $this->getRequestParameter("historial");

		if( $this->impoexpo==Constantes::IMPO ){	
			$this->forward404unless( $this->transporte );
			if( $this->transporte==Constantes::MARITIMO ){
				$this->reportes = ReporteTable::getReportesActivos( $this->getUser()->getClienteActivo(),  Constantes::IMPO, Constantes::MARITIMO, false, "", $historial );
			}elseif( $this->transporte==Constantes::AEREO ){
                $this->reportes = ReporteTable::getReportesActivos( $this->getUser()->getClienteActivo(),  Constantes::IMPO, Constantes::AEREO, false, "", $historial );
			}
		}
        else if( $this->impoexpo==Constantes::EXPO ){
            
            if( $this->transporte=="maritimo" ){                
                $this->reportes = ReporteTable::getReportesActivos( $this->getUser()->getClienteActivo(),  Constantes::EXPO, Constantes::MARITIMO, false, "", $historial );
			}elseif( $this->transporte=="aereo" ){                
                $this->reportes = ReporteTable::getReportesActivos( $this->getUser()->getClienteActivo(),  Constantes::EXPO, Constantes::AEREO, false, "", $historial );
            }elseif( $this->transporte=="terrestre" ){                
                $this->reportes = ReporteTable::getReportesActivos( $this->getUser()->getClienteActivo(),  Constantes::EXPO, Constantes::TERRESTRE, false, "", $historial );
			}
            else
            {                
                $this->reportes = ReporteTable::getReportesActivos( $this->getUser()->getClienteActivo(),  Constantes::EXPO, null, false, "", $historial );
            }
		}
		
		$this->parametros = ParametroTable::retrieveByCaso( "CU059", null , null, $this->getUser()->getClienteActivo() );
		$this->filename = $this->getRequestParameter("filename");
		$this->setLayout("excel");
	}	
}
?>
<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * cotizaciones actions.
 *
 * @package    colsys
 * @subpackage cotizaciones
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
//$this->redirect("/users/logout");
class cotizacionesActions extends sfActions
{
	
	const RUTINA = 12;
	/*************************************************************************
	* OPCIONES GENERALES
	*
	**************************************************************************/
	
	/**
	* Pantalla de bienvenida para el modulo de Cotizaciones 
	* @author Andres Botero
	*/
	public function executeIndex()
	{			
		$this->comerciales = UsuarioTable::getComerciales();
				
		$this->nivel = $this->getUser()->getNivelAcceso( cotizacionesActions::RUTINA );
		
		if( $this->nivel==-1 ){
			$this->forward404();
		}	
		$this->estados = ParametroTable::retrieveByCaso( "CU074" );
	}
		
	/*
	* Muestra los resultados de la busqueda del reporte de negocios 
	* @aut
     * hor Andres Botero
	*/	
	public function executeBusquedaCotizacion()
	{
		$user = $this->getUser();
		$criterio = $this->getRequestParameter("criterio");
		$cadena = $this->getRequestParameter("cadena");
		$login = $this->getRequestParameter("login");
		$seguimiento = $this->getRequestParameter("seguimiento");
		

        $q = Doctrine_Query::create()
                            ->select("c.*")
                            ->from('Cotizacion c');                            
        $q->where("c.ca_consecutivo IS NOT NULL");

        

		switch( $criterio ){
			case "mis_cotizaciones":								
				$q->where("c.ca_usuario = ? OR c.ca_usucreado = ?", array($user->getUserId(), $user->getUserId()) );    
                break;
			case "consecutivo":
                $cadena = str_replace("C", "", $cadena);
                $q->where("c.ca_consecutivo like ?", "".$cadena."%" );
				break;	
			case "nombre_del_cliente":
                $q->innerJoin("c.Contacto con");
                $q->innerJoin("con.Cliente cl");
                $q->where("UPPER(cl.ca_compania) like ?", "%".strtoupper($cadena)."%" );
				
				break;
			case "nombre_del_contacto":
                $q->innerJoin("c.Contacto con");
                $q->where("LOWER(CONCAT(con.ca_nombres, ' ', con.ca_papellido,' ', con.ca_sapellido)) like ?", "%".strtolower($cadena)."%" );
				break;
			case "asunto":
                $q->where("LOWER(c.ca_asunto) like ?", "%".strtolower($cadena)."%" );
				break;	
			case "vendedor":
                $q->where("c.ca_usuario  = ?", $login );				
				break;	
			case "numero_de_cotizacion":
                $q->where("c.ca_idcotizacion = ?",  intval($cadena)  );
				break;	
			case "sucursal":
                $q->innerJoin("c.Usuario u");
                $q->innerJoin("u.Sucursal s");
                $q->where("LOWER(s.ca_nombre) like  ?", "%".strtolower( $cadena )."%" );
				break;
             case "seguimiento":
                $q->where("c.ca_usuario = ? OR c.ca_usucreado = ?", array($user->getUserId(), $user->getUserId()) );
                $q->addWhere("c.ca_usuanulado IS NULL");
				$q->leftJoin("c.CotProducto p");
                $q->addWhere("(p.ca_etapa=? AND p.ca_etapa IS NOT NULL) OR (c.ca_etapa = ? AND p.ca_etapa IS NULL)", array($seguimiento, $seguimiento) );


				break;
		}
        $q->addOrderBy("c.ca_idcotizacion DESC");
        $q->limit(200);
        $q->distinct();
		

        // Defining initial variables
        $currentPage = $this->getRequestParameter('page', 1);
        $resultsPerPage = 30;

        // Creating pager object
        $this->pager = new Doctrine_Pager(
              $q,
              $currentPage,
              $resultsPerPage
        );

        $this->cotizaciones = $this->pager->execute();
		if( $this->pager->getResultsInPage()==1 && $this->pager->getPage()==1 ){
            $cotizaciones = $this->cotizaciones;           
			$this->redirect("cotizaciones/consultaCotizacion?id=".$cotizaciones[0]->getCaIdcotizacion());
		}
				
		$this->criterio = $criterio;
		$this->cadena = $cadena;
		$this->login = $login;
        $this->seguimiento = $seguimiento;

        $estados = ParametroTable::retrieveByCaso( "CU074" );
        $this->estados = array();
        foreach( $estados as $estado ){
            $this->estados[$estado->getCaValor()] = $estado->getCaValor2();
        }
				
	}

	/**
	* Permite consultar una cotizacion ya creada y permite 
	* agregar nuevas  
	* @author Carlos G. López M., Andres Botero
	*/
	public function executeConsultaCotizacion(){

        
		$response = sfContext::getInstance()->getResponse();		
		$response->addJavaScript("extExtras/RowExpander",'last');
		$response->addJavaScript("extExtras/myRowExpander",'last');		
		$response->addJavaScript("extExtras/CheckColumn",'last');
			
		if( !is_null($this->getRequestParameter("id")) ) {
			$id_cotizacion = $this->getRequestParameter("id");	
			$cotizacion = Doctrine::getTable("Cotizacion")->find( $id_cotizacion );
			$this->forward404Unless( $cotizacion );					
			$this->editable = $this->getRequestParameter("editable");	
			$this->option = $this->getRequestParameter("option");
						
			$this->tarea = $cotizacion->getTareaIDGEnvioOportuno();
			if( $this->tarea && $this->tarea->getCaFchterminada() ){
				$this->redirect("cotizaciones/verCotizacion?id=".$cotizacion->getCaIdcotizacion());
			}
			
						
			if($cotizacion->getCaUsuanulado()){
				$this->redirect("cotizaciones/verCotizacion?id=".$cotizacion->getCaIdcotizacion());
			}
			
			$this->cotizacion = $cotizacion;			
		}else {			
			$config = sfConfig::get('sf_app_module_dir').DIRECTORY_SEPARATOR."cotizaciones".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."textos.yml";
			$textos = sfYaml::load($config);			
			$user = $this->getUser()->getUserId();
			$this->cotizacion = new Cotizacion();			
			$this->cotizacion->setCaAsunto($textos['asunto']);
			$this->cotizacion->setCaSaludo($textos['saludo']);
			$this->cotizacion->setCaEntrada( $textos['entrada'] );
			$this->cotizacion->setCaDespedida( $textos['despedida'] );
			$this->cotizacion->setCaAnexos( $textos['anexos'] );
			$this->cotizacion->setCaUsuario($user);
			
			$this->tarea = $this->cotizacion->getTareaIDGEnvioOportuno();
			
			
		}
		$this->user = $this->getUser();
		$this->nivel = $this->getUser()->getNivelAcceso( cotizacionesActions::RUTINA );
		if( $this->nivel==-1 ){
			$this->forward404();
		}
        

	}		

	/*
	* Guarda los cambios realizados al Header de la Cotización  
	* @author Carlos G. López M.
	*/
	public function executeFormCotizacionGuardar(){
		$user_id = $this->getUser()->getUserId();
				
		if( $this->getRequestParameter("cotizacionId") ){
			$cotizacion = Doctrine::getTable("Cotizacion")->find( $this->getRequestParameter("cotizacionId") );
			$this->forward404Unless( $cotizacion );
		}else{		
			$cotizacion = new Cotizacion();
			$sig = CotizacionTable::siguienteConsecutivo( date("Y") );
			$cotizacion->setCaConsecutivo( $sig ); 			
		}
		if( $this->getRequestParameter( "empresa" ) ){
			$cotizacion->setCaEmpresa( $this->getRequestParameter( "empresa" ) );		
		}
			
		
		if( $this->getRequestParameter( "vendedor" ) ){
			$cotizacion->setCaUsuario( $this->getRequestParameter( "vendedor" ) );
		}else{            
			if( $this->getUser()->getIddepartamento()==5 ){ // Si es comercial le coloca la cotizacion
				$cotizacion->setCaUsuario( $this->getUser()->getUserid() );
				
			}elseif(!$cotizacion->getCaUsuario() || $cotizacion->getCaIdcontacto()!=$this->getRequestParameter( "idconcliente" ) ){
				$contacto = Doctrine::getTable("Contacto")->find( $this->getRequestParameter( "idconcliente" ) );
				$vendedor = $contacto->getCliente()->getCaVendedor();
				if(!$vendedor){
					$vendedor = "Comercial";
				}
				$cotizacion->setCaUsuario( $vendedor );
			}
		}
		
		
		$cotizacion->setCaIdcontacto( $this->getRequestParameter( "idconcliente" ) );
		$cotizacion->setCaAsunto( utf8_decode($this->getRequestParameter( "asunto" )) );
		$cotizacion->setCaSaludo( utf8_decode($this->getRequestParameter( "saludo" )) );
		$cotizacion->setCaEntrada( utf8_decode($this->getRequestParameter( "entrada" )) );
		$cotizacion->setCaDespedida( utf8_decode($this->getRequestParameter( "despedida" )) );
		$cotizacion->setCaAnexos( utf8_decode($this->getRequestParameter( "anexos" )) );
		
		if( $this->getRequestParameter( "fuente" ) ){
			$cotizacion->setCaFuente( $this->getRequestParameter( "fuente" ) );
		}
		
		if( !$cotizacion->getCaIdcotizacion() ){
			$cotizacion->setCaFchcreado( date("Y-m-d H:i:s") );
			$cotizacion->setCaUsucreado( $user_id );			
		}else{
			$cotizacion->setCaFchactualizado( date("Y-m-d H:i:s") );
			$cotizacion->setCaUsuactualizado( $user_id );							
		}
		$cotizacion->save();			
		if( $this->getRequestParameter( "fchSolicitud" ) ){            
			$cotizacion->crearTareaIDGEnvioOportuno( $this->getRequestParameter( "fchSolicitud" )." ".$this->getRequestParameter( "horaSolicitud" ));			
		}
		
		
		if( $this->getRequestParameter( "fchPresentacion" ) ){
			$cotizacion->setFchpresentacion( $this->getRequestParameter( "fchPresentacion" )." ".$this->getRequestParameter( "horaPresentacion" ) );			
			
		}
		
		if( $this->getRequestParameter( "observaciones_idg" )!==null ){
			$tarea = $cotizacion->getTareaIDGEnvioOportuno();
			$tarea->setCaObservaciones( $this->getRequestParameter( "observaciones_idg" ) );
			$tarea->save();
		}
						
		if( !$this->getRequestParameter("cotizacionId") ){
			$tarea = $cotizacion->getTareaIDGEnvioOportuno(); //Crea la tarea si no existe
			//$tarea->notificar();
		}
		
		$this->responseArray = array();
		$this->responseArray['idcotizacion']=$cotizacion->getCaIdcotizacion();
		$this->responseArray['success']=true;

		$this->setTemplate("responseTemplate");
		
	}
	
	
	/*
	* Anula una cotizacion 
	* @author Andres Botero
	*/
	
	public function executeAnularCotizacion(){
		$cotizacion = Doctrine::getTable("Cotizacion")->find( $this->getRequestParameter("idcotizacion") );
		$this->forward404Unless($cotizacion);
		$cotizacion->setCaFchanulado(date("Y-m-d H:i:s"));
		$cotizacion->setCaUsuanulado($this->getUser()->getUserId());
		$cotizacion->save();
		
		$tarea = $cotizacion->getTareaIDGEnvioOportuno(); 
		if( $tarea ){
			$tarea->delete();
		}
		
		
		$productos = $cotizacion->getCotProductos();
		
		foreach( $productos as $producto ){
			if( $producto->getCaIdtarea() ){
				$tarea  = Doctrine::getTable("NotTarea")->find( $producto->getCaIdtarea() );
				$tarea->setCaFchterminada( date("Y-m-d H:i:s") );
				$tarea->save();
			}
		}		
		$this->redirect("cotizaciones/consultaCotizacion?id=".$cotizacion->getCaIdcotizacion());
	}
	
	/*
	* Guarda los agentes del directorio de agentes 
	* @author Andres Botero
	*/
	public function executeGuardarAgentes(){
		$cotizacion = Doctrine::getTable("Cotizacion")->find( $this->getRequestParameter("idcotizacion") );
		$this->forward404Unless($cotizacion);
		$datosag = $this->getRequestParameter( "datosag" );
		$this->forward404Unless($datosag!==null);
        if( $datosag!==null ){

            Doctrine_Query::create()
                           ->delete()
                           ->from("CotContactoAg ct")
                           ->where("ct.ca_idcotizacion = ?", $cotizacion->getCaIdcotizacion())
                           ->execute();
            
            if( $datosag ){
                $idcontactos = array_unique(explode("|", $datosag ));
                foreach($idcontactos as $idcontacto ){
                    $contactoAg = new CotContactoAg();
                    $contactoAg->setCaIdcotizacion($cotizacion->getCaIdcotizacion());
                    $contactoAg->setCaIdcontacto( $idcontacto );
                    $contactoAg->save();
                }
            }
        }
		$this->responseArray = array("success"=>true);	
		$this->setTemplate("responseTemplate");		
		
	}
	
	/*
	* Lista de agentes para la grilla
	* @author Andres Botero
	*/
	public function executeDatosAgentes(){
		
		
		$cotizacion = Doctrine::getTable("Cotizacion")->find( $this->getRequestParameter("idcotizacion") );
		$this->forward404Unless( $cotizacion );
		
		
		$mostrarTodos = $this->getRequestParameter("mostrarTodos");
		
		$productos = $cotizacion->getCotProductos();
		
		$lejanoOriente = false;

        if( count($productos)>0 ){
            if( $mostrarTodos ){
                $paises = array();
                foreach( $productos as $producto ){
                    if( $producto->getCaImpoexpo() == Constantes::IMPO ){
                        $paises[] = $producto->getOrigen()->getCaIdtrafico();

                        //Esto es debido a que China y Hong Kong estan separado y no se
                        //pueden unir por que se dañan los consecutivos de marítimo.
                        //FIX-ME Usar el registro idgrupo de la tabla Ids
                        if( $producto->getOrigen()->getCaIdtrafico()=="CN-086" ){
                            $paises[] = "HK-852";
                        }

                        if( $producto->getOrigen()->getCaIdtrafico()=="HK-852" ){
                            $paises[] = "CN-086";
                        }

                        $trafico = $producto->getOrigen()->getTrafico();
                        if( $trafico->getCaIdgrupo()==6 ){
                            $lejanoOriente = true;
                        }

                    }else{
                        $paises[] = $producto->getDestino()->getCaIdtrafico();
                    }
                }
                $paises=array_unique($paises);
            }else{
                $ciudades = array();

                foreach( $productos as $producto ){
                    if( $producto->getCaImpoexpo() == Constantes::IMPO ){
                        $ciudades[] = $producto->getCaOrigen();
                    }else{
                        $ciudades[] = $producto->getCaDestino();
                    }
                }
                $ciudades=array_unique($ciudades);
            }

            $q = Doctrine_Query::create()
                                 ->from("IdsContacto c")
                                 ->innerJoin("c.IdsSucursal s")
                                 ->innerJoin("s.Ids i")
                                 ->innerJoin("s.Ciudad ci")
                                 ->innerJoin("ci.Trafico t")
                                 ->innerJoin("i.IdsAgente ag")
                                 ->where("c.ca_activo = ? AND ag.ca_activo = ? AND ca_fcheliminado IS NULL", array(true, true));

            
           if( $mostrarTodos ){
               $q->andWhereIn("ci.ca_idtrafico", $paises );
            }else{
                $q->andWhereIn("s.ca_idciudad", $ciudades );
            }

            /*
             *  Contactos de los traficos seleccionados
             */
            $contactos1 = $q->distinct()->setHydrationMode(Doctrine::HYDRATE_ARRAY)
              ->execute();
        }else{
            $contactos1 = array();

        }
            
		/*
		* Muestra todos los contactos de ASW 
		*/
		//FIX-ME Usar el registro idgrupo de la tabla Ids
        
		if( $lejanoOriente ){
			


            $contactos3 = Doctrine_Query::create()
                             ->from("IdsContacto c")
                             ->innerJoin("c.IdsSucursal s")
                             ->innerJoin("s.Ids i")
                             ->innerJoin("s.Ciudad ci")
                             ->innerJoin("ci.Trafico t")
                             ->innerJoin("i.IdsAgente ag")
                             ->where("c.ca_activo = ? AND ag.ca_activo = ? AND ca_fcheliminado IS NULL", array(true, true))
                             ->addWhere("i.ca_nombre like ?", "AIR SEA WORLDWIDE%")
                             ->addWhere("t.ca_idgrupo = ?", 6 )
                             ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                             ->execute();
                             
            $contactos1 = array_merge($contactos1, $contactos3);


		}


        /*
        *  Contactos que estan en la cotizacion actualmente
        */
        
        $contactos2 = Doctrine_Query::create()
                                ->from("IdsContacto c")                                
                                ->innerJoin("c.IdsSucursal s")
                                ->innerJoin("s.Ids i")
                                ->innerJoin("s.Ciudad ci")
                                ->innerJoin("ci.Trafico t")
                                ->innerJoin("i.IdsAgente ag")
                                ->innerJoin("c.CotContactoAg ct")
                                ->where("ct.ca_idcotizacion = ? ", $cotizacion->getCaIdcotizacion() )
                                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                ->execute();
        
        $contactos = array_merge($contactos1, $contactos2);
       
        $datosag = array();
        foreach( $contactos2 as $contactoAg ){
            $datosag[]=$contactoAg["ca_idcontacto"];
        }
        
		$agentes = array();
		//$contactos = array_unique($contactos);
        $incluido = array();
   		foreach ( $contactos as $contacto ) {
           
			if( in_array( $contacto["ca_idcontacto"] ,  $datosag ) ){
				$sel = true;
			}else{
				$sel = false;
			}


            if(!in_array( $contacto["ca_idcontacto"] ,  $incluido )){

            			
                $agentes[] = array( 'sel'=>$sel,
                                        'idcontacto'=>$contacto["ca_idcontacto"],
                                         'contacto'=>utf8_encode($contacto["ca_nombres"]." ".$contacto["ca_papellido"]),
                                         'agente'=>utf8_encode($contacto["IdsSucursal"]["Ids"]["ca_nombre"]." » ".$contacto["IdsSucursal"]["Ciudad"]["Trafico"]["ca_nombre"]." (".$contacto["IdsSucursal"]["Ids"]["IdsAgente"]["ca_tipo"].")"),
                                         'cargo'=>utf8_encode($contacto["ca_cargo"]),
                                         'telefonos'=>$contacto["ca_telefonos"],
                                         'operacion'=>utf8_encode(str_replace("|", " ", $contacto["ca_transporte"] )),
                                         'ciudad'=>utf8_encode($contacto["IdsSucursal"]["Ciudad"]["ca_ciudad"]),
                                          'sugerido'=>$contacto["ca_sugerido"]
                );
            }
            $incluido[] = $contacto["ca_idcontacto"];
		}
		
		$this->responseArray = array("agentes"=>$agentes, "total"=>count($this->agentes), "success"=>true);
		$this->setTemplate("responseTemplate");
		
		
	}		
		
	/*
	* Permite ver una cotización en formato PDF
	* @author Andres Botero
	*/
	public function executeVerCotizacion(){
        //$this->redirect( "cotizaciones/consultaCotizacion?id=".$this->getRequestParameter("id") );
		$this->cotizacion =  Doctrine::getTable("Cotizacion")->find( $this->getRequestParameter("id") );
		$this->forward404Unless( $this->cotizacion );
		
		$this->emails = Doctrine::getTable("Email")
                                  ->createQuery("e")
                                  ->where("e.ca_tipo = ? AND e.ca_idcaso = ?", array("Envío de cotización", $this->cotizacion->getCaIdcotizacion() ))
                                  ->addOrderBy("e.ca_fchenvio")
                                  ->execute();
		
		$config = sfConfig::get('sf_app_module_dir').DIRECTORY_SEPARATOR."cotizaciones".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."textos.yml";
		$textos = sfYaml::load($config);	
		$this->asunto = sprintf( $textos['asuntoEmail'], $this->cotizacion->getCaConsecutivo() );
		$this->mensaje = sprintf( $textos['mensajeEmail'], $this->cotizacion->getContacto()->getNombre(), $this->cotizacion->getCaConsecutivo() );
		
		$this->tarea = $this->cotizacion->getTareaIDGEnvioOportuno();
        
        $this->observacionesIdg = ParametroTable::retrieveByCaso("CU076");

        $this->notas = sfYaml::load(sfConfig::get('sf_app_module_dir').DIRECTORY_SEPARATOR."cotizaciones".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."notas.yml");
				
	}
	/*
	* Genera un archivo PDF a partir de una cotización
	* @author Andres Botero
	*/
	public function executeGenerarPDF(){
	
		
		$this->cotizacion =  Doctrine::getTable("Cotizacion")->find( $this->getRequestParameter("id") );
		$this->forward404Unless( $this->cotizacion );
		
		$this->filename=$this->getRequestParameter("filename");
		$this->notas = sfYaml::load(sfConfig::get('sf_app_module_dir').DIRECTORY_SEPARATOR."cotizaciones".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."notas.yml");
		
		$grupos = array();
		
		$rows = Doctrine::getTable("CotProducto")
                                ->createQuery("p")
                                ->select("p.ca_transporte, p.ca_modalidad")
                                ->where("p.ca_idcotizacion=?", $this->cotizacion->getCaIdcotizacion())                                
                                ->distinct()                                
                                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                ->execute();
		
		foreach( $rows as $row ) {
			$grupos[$row["ca_transporte"]][]=$row["ca_modalidad"];
			$grupos[$row["ca_transporte"]] = array_unique( $grupos[$row["ca_transporte"]] );
		}
        		
		$this->grupos = $grupos;
	}



    /*
	* Genera un archivo PDF con las notas unicamente
	* @author Andres Botero
	*/
	public function executeGenerarPDFNotas(){


		$this->cotizacion =  Doctrine::getTable("Cotizacion")->find( $this->getRequestParameter("id") );
		$this->forward404Unless( $this->cotizacion );

		$this->filename=$this->getRequestParameter("filename");
		$this->notas = sfYaml::load(sfConfig::get('sf_app_module_dir').DIRECTORY_SEPARATOR."cotizaciones".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."notas.yml");

		$this->imprimirNotas = $this->getRequestParameter("notas");        
	}
	
	
	/*
	* Envia una cotización por correo 	
	*/
	public function executeEnviarCotizacionEmail( $request ){
		$this->cotizacion =  Doctrine::getTable("Cotizacion")->find( $this->getRequestParameter("id") );
										
		$user = $this->getUser();
					
		//Crea el correo electronico
		$email = new Email();
		$email->setCaUsuenvio( $user->getUserId() );
		$email->setCaTipo( "Envío de cotización" ); 		
		$email->setCaIdcaso( $this->getRequestParameter("id") );
		$email->setCaFrom( $user->getEmail() );
		$email->setCaFromname( $user->getNombre() );
		
		if( $this->getRequestParameter("readreceipt") ){
			$email->setCaReadreceipt( true );
		}else{
            $email->setCaReadreceipt( false );
        }

		$email->setCaReplyto( $user->getEmail() );
				
		$recips = explode(",",$this->getRequestParameter("destinatario"));									
		if( is_array($recips) ){
			foreach( $recips as $recip ){			
				$recip = str_replace(" ", "", $recip );			
				if( $recip ){
					$email->addTo( $recip ); 
				}
			}	
		}
				
		$recips =  explode(",",$this->getRequestParameter("cc")) ;
		if( is_array($recips) ){
			foreach( $recips as $recip ){			
				$recip = str_replace(" ", "", $recip );			
				if( $recip ){
					$email->addCc( $recip ); 
				}
			}
		}
		//$mensaje = utf8_decode($this->getRequestParameter("mensaje")."\n\n");
		$mensaje = ($this->getRequestParameter("mensaje")."\n\n");
		$usuario = Doctrine::getTable("Usuario")->find( $this->getUser()->getUserId() );
				
		$email->addCc( $this->getUser()->getEmail() );					
		//$email->setCaSubject( utf8_decode($this->getRequestParameter("asunto")) );		
		$email->setCaSubject( ($this->getRequestParameter("asunto")) );		
		$email->setCaBody( $mensaje.$usuario->getFirma() );
		$email->setCaBodyhtml( Utils::replace($mensaje).$usuario->getFirmaHTML() );		

        $email->save(); //guarda el cuerpo del mensaje
		$incluirPDF = $this->getRequestParameter("incluirPDF");
		if( $incluirPDF ){
            $directory = $email->getDirectorio();
			if( !is_dir($directory) ){
                @mkdir($directory, 0777, true);                
            }           

            $fileName = "cotizacion".$this->cotizacion->getCaConsecutivo().".pdf" ;
			if(file_exists($fileName)){
				@unlink( $fileName );
			}				
			$this->getRequest()->setParameter('filename',$directory.$fileName);
			sfContext::getInstance()->getController()->getPresentationFor( 'cotizaciones', 'generarPDF') ;

            $email->addAttachment($email->getDirectorioBase().$fileName);
			
		}

        $notas = $request->getParameter("notas");
        
        if( $notas && count($notas)>0 ){
            $directory = $email->getDirectorio();
			if( !is_dir($directory) ){
                @mkdir($directory, 0777, true);
            }

            $fileName = "Notas Importantes C".$this->cotizacion->getCaConsecutivo().".pdf" ;
			if(file_exists($fileName)){
				@unlink( $fileName );
			}
			$this->getRequest()->setParameter('filename',$directory.$fileName);
			sfContext::getInstance()->getController()->getPresentationFor( 'cotizaciones', 'generarPDFNotas') ;
            ///home/abotero/Desarrollo/digitalFile//Attachements/307189/status860003168.xls|reportes/12513-2009//IMOCOM -CORFERIAS HBL.pdf|reportes/14000-2009//CHUAN HBL.pdf
            $email->addAttachment($email->getDirectorioBase().$fileName);
		}
        
		$attachments = $this->getRequestParameter("attachments");
		if( $attachments ){
            $directorioCotizaciones = $this->cotizacion->getDirectorioBase();
            foreach($attachments as $attachment ){
                $fileName = base64_decode($attachment);
                $email->addAttachment($directorioCotizaciones.DIRECTORY_SEPARATOR.$fileName);

            }
        }
		$email->save();
		$this->error = $email->send();	
		//if(!$this->error){
			$tarea  = $this->cotizacion->getTareaIDGEnvioOportuno();
			
			if( $tarea ){		
				$observaciones_idg = $this->getRequestParameter("observaciones_idg");
			
				if( $observaciones_idg!==null ){
					$tarea->setCaObservaciones( $observaciones_idg );		
				}
							
				if( !$tarea->getCaFchterminada() ){
					$tarea->setCaFchterminada( date("Y-m-d H:i:s") );
				}							
				$tarea->save();
			}
		//}		
	}
	
	
	/*
	* Copia una cotización existente en una nueva 
	* @author: Andres Botero
	*/
	public function executeCopiarCotizacion(){
		$cotizacion = Doctrine::getTable("Cotizacion")->find($this->getRequestParameter("idcotizacion"));
		$this->forward404Unless($cotizacion);
		
		$newCotizacion = $cotizacion->copy( false ); //La copia recursiva se hace paso a paso por que las llaves son naturales 
		$user = $this->getUser();		
		$sig = CotizacionTable::siguienteConsecutivo( date("Y") );
		$newCotizacion->setCaConsecutivo( $sig ); 		
		$newCotizacion->setCaIdgEnvioOportuno(null);		
		$newCotizacion->setCaFchcreado( date("Y-m-d H:i:s") );
		$newCotizacion->setCaUsucreado( $user->getUserId() );
		$newCotizacion->setCaFchactualizado( null );
		$newCotizacion->setCaUsuactualizado( null );
		$newCotizacion->setCaFchanulado( null );
		$newCotizacion->setCaUsuanulado( null );	
		$newCotizacion->save();
		
		$productos = $cotizacion->getCotProductos();
                
		foreach( $productos as $producto ){
            
			$newProducto = $producto->copy( false );
			$newProducto->setCaIdcotizacion( $newCotizacion->getCaIdcotizacion() );
            $newProducto->setCaEtapa( Cotizacion::EN_SEGUIMIENTO );
            $newProducto->setCaIdtarea( null );
			$newProducto->save();

			$opciones = $producto->getCotOpciones();
			foreach( $opciones as $opcion ){				
				$newOpcion = $opcion->copy( false );
				$newOpcion->setCaIdcotizacion( $newCotizacion->getCaIdcotizacion() );
				$newOpcion->setCaIdproducto( $newProducto->getCaIdproducto() );
				$newOpcion->save();
				
				$recargos = $opcion->getCotRecargos( );
				foreach( $recargos as $recargo ){	
					$newRecargo = $recargo->copy( false );
					$newRecargo->setCaIdcotizacion( $newCotizacion->getCaIdcotizacion() );
					$newRecargo->setCaIdproducto( $newProducto->getCaIdproducto() );
					$newRecargo->setCaIdopcion( $newOpcion->getCaIdopcion() );
					$newRecargo->setCaIdconcepto( $recargo->getCaIdconcepto() );
					$newRecargo->setCaIdrecargo( $recargo->getCaIdrecargo() );
					$newRecargo->setCaModalidad( $recargo->getCaModalidad() );
					$newRecargo->save();
				}		
			}	

            
			$recargos = $producto->getRecargosGenerales();            
			foreach( $recargos as $recargo ){	
				
				$newRecargo = $recargo->copy( false );
				$newRecargo->setCaIdcotizacion( $newCotizacion->getCaIdcotizacion() );
				$newRecargo->setCaIdproducto(  $newProducto->getCaIdproducto() );
				$newRecargo->setCaIdopcion( $recargo->getCaIdopcion() );
				$newRecargo->setCaIdconcepto( $recargo->getCaIdconcepto() );
				$newRecargo->setCaIdrecargo( $recargo->getCaIdrecargo() );
				$newRecargo->setCaModalidad( $recargo->getCaModalidad() );
				$newRecargo->save();
                //echo $recargo->getCaIdcotrecargo()." ".$newCotizacion->getCaIdcotizacion()." ->antes:".$recargo->getCaIdproducto()." ->despues:".$newProducto->getCaIdproducto()." ".$recargo->getCaIdrecargo()."<br />";
			}
		}
        
		$recargos = $cotizacion->getRecargosLocales();
		foreach( $recargos as $recargo ){	
			$newRecargo = $recargo->copy( false );
			$newRecargo->setCaIdcotizacion( $newCotizacion->getCaIdcotizacion() );
			$newRecargo->setCaIdproducto( $recargo->getCaIdproducto() );
			$newRecargo->setCaIdopcion( $recargo->getCaIdopcion() );
			$newRecargo->setCaIdconcepto( $recargo->getCaIdconcepto() );
			$newRecargo->setCaIdrecargo( $recargo->getCaIdrecargo() );
			$newRecargo->setCaModalidad( $recargo->getCaModalidad() );
			$newRecargo->save();
		}	
		
			
			
		$seguros = $cotizacion->getCotSeguro();
		foreach( $seguros as $seguro ){	
			$newSeguro = $seguro->copy( false );
			$newSeguro->setCaIdcotizacion( $newCotizacion->getCaIdcotizacion() );
			$newSeguro->save();
		}
		
		$continuaciones = $cotizacion->getCotContinuacion();
		foreach( $continuaciones as $continuacion ){	
			$newContinuacion = $continuacion->copy( false );			
			$newContinuacion->setCaIdcotizacion( $newCotizacion->getCaIdcotizacion() );
			$newContinuacion->save();	
					
		}


        $contactos = $cotizacion->getCotContactoAg();
		foreach( $contactos as $contacto ){
			$newContacto = $contacto->copy( false );
			$newContacto->setCaIdcotizacion( $newCotizacion->getCaIdcotizacion() );
			$newContacto->save();

		}
				
		$this->redirect("cotizaciones/consultaCotizacion?id=".$newCotizacion->getCaIdcotizacion());
	}
	
	/*************************************************************************
	* GRILLA PRODUCTOS (TRAYECTOS)
	*
	**************************************************************************/
		
	/*
	* Guarda los cambios realizados a Productos  
	* @author Andres Botero
	*/
	public function executeFormProductoGuardar(){

        
       
		$user_id = $this->getUser()->getUserId();

        if( $this->getRequestParameter("idproducto") ){
			$producto = Doctrine::getTable("CotProducto")->find(  $this->getRequestParameter("idproducto") );
			$this->forward404Unless( $producto );
            $cotizacion = $producto->getCotizacion();
		}else{
			$producto = new CotProducto();
            $cotizacion = Doctrine::getTable("Cotizacion")->find(  $this->getRequestParameter("cotizacionId") );
            $this->forward404Unless( $cotizacion );
			$producto->setCaIdcotizacion( $cotizacion->getCaIdcotizacion() );
		}	
	
		$producto->setCaProducto( utf8_decode($this->getRequestParameter("producto")) );

        if( $this->getRequestParameter("impoexpo") ){
            $impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
            $producto->setCaImpoexpo( $impoexpo );
        }
        if( $this->getRequestParameter("transporte") ){
            $transporte= utf8_decode($this->getRequestParameter("transporte"));
            $producto->setCaTransporte( $transporte );
        }

        if( $this->getRequestParameter("modalidad") ){
            $producto->setCaModalidad( $this->getRequestParameter("modalidad") );
        }

        if( $this->getRequestParameter("vigencia") ){
            $producto->setCaVigencia( $this->getRequestParameter("vigencia") );
        }else{
            $producto->setCaVigencia( null );
        }

		$producto->setCaIncoterms( $this->getRequestParameter("incoterms") );
		$producto->setCaOrigen( $this->getRequestParameter("ciu_origen") );
		if( $this->getRequestParameter("ciu_escala") ){ 
			$producto->setCaEscala( $this->getRequestParameter("ciu_escala") );
		}		
		$producto->setCaDestino( $this->getRequestParameter("ciu_destino") );
		$producto->setCaFrecuencia( utf8_decode($this->getRequestParameter("frecuencia")) );
		$producto->setCaTiempotransito( utf8_decode($this->getRequestParameter("ttransito")) );
		$producto->setCaObservaciones( utf8_decode($this->getRequestParameter("observaciones")) );
		$producto->setCaImprimir( $this->getRequestParameter("imprimir") );
		if( !$producto->getCaIdproducto() ){
			$producto->setCaFchcreado( date("Y-m-d H:i:s") );
			$producto->setCaUsucreado( $user_id );			
		}else{
			$producto->setCaFchactualizado( date("Y-m-d H:i:s") );
			$producto->setCaUsuactualizado( $user_id );							
		}
		
		if( $this->getRequestParameter("idlinea") ){ 
			$producto->setCaIdlinea( $this->getRequestParameter("idlinea") );
		}
		if( $this->getRequestParameter("postular_linea")){
            $producto->setCaPostularlinea( true );
        }else{
            $producto->setCaPostularlinea( false );
        }
		
		
		$producto->save();

        //Elimina el seguimiento por cotizacion y lo establece por trayecto
        if( $cotizacion->getCaEtapa() ){
            $cotizacion->setCaEtapa(null);
            $cotizacion->save();
            $tarea = $cotizacion->getNotTarea();
            if( $tarea ){
                $tarea->delete();
            }
        }

        $tarea = $cotizacion->getTareaIDGEnvioOportuno();
		if( $tarea ){
			$texto = "Debe enviar esta cotizacion por email o colocar la fecha de presentación para cumplir esta tarea.<br />";

            $productos = Doctrine::getTable("CotProducto")
                      ->createQuery("p")
                      ->where("p.ca_idcotizacion = ?", $cotizacion->getCaIdcotizacion() )
                      ->execute();
            foreach( $productos as $producto ){
                 $texto.=$producto->getCaImpoexpo()." ".$producto->getCaModalidad()." ".$producto->getOrigen()." - ".$producto->getDestino()."<br />";
            }

            $tarea->setCaTexto($texto);
            $tarea->save();


        }


        $this->responseArray=array("success"=>true);        
        $this->setTemplate("responseTemplate");
		
	}
	
	/**
	* Permite actualizar en linea los cambios en los campos de opciones y
	* recargos en origen de una cotización
	* @author Andres Botero
	*/
	public function executeObserveItemsOpciones(){       
		$idcotizacion = $this->getRequestParameter("idcotizacion");
		$idproducto = $this->getRequestParameter("idproducto");
		$idcotizacion = $this->getRequestParameter("idcotizacion");
		$idopcion = trim($this->getRequestParameter("idopcion"));
		$idmoneda = $this->getRequestParameter("idmoneda");
		$valor_tar = $this->getRequestParameter("valor_tar");
		$valor_min = $this->getRequestParameter("valor_min");
		$aplica_tar = utf8_decode($this->getRequestParameter("aplica_tar"));
		$aplica_min = utf8_decode($this->getRequestParameter("aplica_min"));
		$observaciones = $this->getRequestParameter("detalles");
		
		$consecutivo = $this->getRequestParameter("consecutivo"); //Consecutivo tarifario
		
		$tipo = $this->getRequestParameter("tipo");
		$id = $this->getRequestParameter("id");
		$parent = $this->getRequestParameter("parent");
		
		$this->responseArray = array("id"=>$id);
			
		if( $tipo=="concepto" && $this->getRequestParameter("iditem")!=9999 ){
			$iditem = $this->getRequestParameter("iditem");
			
			if( !$idopcion ){						
				$opcion = new CotOpcion();
				$opcion->setCaIdcotizacion( $idcotizacion );
				$opcion->setCaIdproducto( $idproducto );
				$opcion->setCaFchcreado( date("Y-m-d H:i:s") );
				$opcion->setCaUsucreado( $this->getUser()->getUserId() );
				$opcion->setCaValorTar( 0 );
				$opcion->setCaValorMin( 0 );	
				
			}else{		
				$opcion = Doctrine::getTable("CotOpcion")->find( $idopcion );
				$this->forward404Unless( $opcion );					
				$opcion->setCaFchactualizado( date("Y-m-d H:i:s") );
				$opcion->setCaUsuactualizado( $this->getUser()->getUserId() );		
			}			
			
			if( $iditem ){	
				$opcion->setCaIdconcepto( $iditem );
			}				
			
			if( $idmoneda ){	
				$opcion->setCaIdmoneda( $idmoneda );
			}
			if( $valor_tar!==null ){
				$opcion->setCaValorTar( $valor_tar );
			}
			
			if( $valor_min!==null ){
				$opcion->setCaValorMin( $valor_min );
			}
			
			if( $aplica_tar ){
				$opcion->setCaAplicaTar( $aplica_tar );
			}
			
			if( $aplica_min ){
				$opcion->setCaAplicaMin( $aplica_min );
			}
			
			if( $observaciones!==null ){
                if( $observaciones ){
                    $opcion->setCaObservaciones( utf8_decode($observaciones) );
                }else{
                    $opcion->setCaObservaciones( null );
                }
			}	
			
			if( $consecutivo ){
				$opcion->setCaConsecutivo( $consecutivo );
			}
			$opcion->save();           
			$this->responseArray["idopcion"]=$opcion->getCaIdopcion();
		}else{
            $this->responseArray["idopcion"]=999;
            
        }


		if( $tipo=="recargo" ){
			
			$iditem = $this->getRequestParameter("iditem");			
			$idconcepto = $this->getRequestParameter("idconcepto");			
			$modalidad = $this->getRequestParameter("modalidad");
            $idcotrecargo = $this->getRequestParameter("idcotrecargo");
			
			if( $idconcepto==9999 ){
				$idopcion = 999;	
			}else{
				
			}
			$this->responseArray["idopcion"]=$idopcion;

            
			if( $idcotrecargo ){                
                $recargo = Doctrine::getTable("CotRecargo")->find( $idcotrecargo );                
            }else{

				$recargo = new CotRecargo();									
				$recargo->setCaIdcotizacion( $idcotizacion );
				$recargo->setCaIdproducto( $idproducto );
				$recargo->setCaIdconcepto( $idconcepto );
				$recargo->setCaIdopcion( $idopcion );
				$recargo->setCaIdrecargo( $iditem );
				$recargo->setCaModalidad( $modalidad );
				$recargo->setCaValorTar( 0 );
				$recargo->setCaValorMin( 0 );
			}		
				
			//$recargo->setCaTipo( "$" ); //FIX-ME
			if( $idmoneda ){	
				$recargo->setCaIdmoneda( $idmoneda );
			}
			if( $valor_tar!==null ){
				$recargo->setCaValorTar( $valor_tar );
			}
			
			if( $valor_min!==null ){
				$recargo->setCaValorMin( $valor_min );
			}
			
			if( $aplica_tar ){
				$recargo->setCaAplicaTar( $aplica_tar );
			}
			
			if( $aplica_min ){
				$recargo->setCaAplicaMin( $aplica_min );
			}	
            
			if( $observaciones!==null ){
				if( $observaciones ){
					$recargo->setCaObservaciones( utf8_decode($observaciones) );
				}else{
					$recargo->setCaObservaciones( null );				
				}
			}	
			
			if( $consecutivo ){
				$recargo->setCaConsecutivo( $consecutivo );
			}								
			$recargo->save();

            $this->responseArray["idcotrecargo"]=$recargo->getCaIdcotrecargo();
		}
		$this->setTemplate("responseTemplate");	
		
	}
	
	/*
	* Muestra los datos de la grilla de prooductos del componente grillaProductos
	*/
	public function executeGrillaProductosData(){
		$id = $this->getRequestParameter("idcotizacion");
        $idproducto = $this->getRequestParameter("idproducto");
		
        $cotizacion = Doctrine::getTable("Cotizacion")->find( $id );

		$cotProductos = $cotizacion->getCotProductos();

        $modo = $this->getRequestParameter("modo");
				
		$this->productos = array();
        
		foreach( $cotProductos as $producto ){

            if( $idproducto && $idproducto!=$producto->getCaIdproducto()){//Se desea uno solo
                continue;
            }

			$j=0;
			$origen = $producto->getOrigen();
			$destino = $producto->getDestino();
			$escala = $producto->getEscala();					
			
			$linea = $producto->getTransportador();
				
			if( $linea ){
				$lineaStr = $linea->getIds()->getCaNombre();
			}else{
				$lineaStr = "";
			}
			
			$trayecto = utf8_encode($producto->getCaImpoexpo())." ".utf8_encode($producto->getCaTransporte())." ".utf8_encode($producto->getCaModalidad())." [".utf8_encode( $origen->getCaCiudad() )." - ".utf8_encode($origen->getTrafico()->getCaNombre()." » ");
			
			if( $escala ){
				$trayecto .= utf8_encode($escala->getCaCiudad())." - ".utf8_encode($escala->getTrafico()->getCaNombre()." » ");
			}
			
			$trayecto .= utf8_encode($destino->getCaCiudad())." - ".utf8_encode($destino->getTrafico()->getCaNombre())."]  ".$lineaStr." ".$producto->getCaIdproducto();
						
			//Se envian las opciones existentes			
			$opciones = $producto->getCotOpciones();
            
			$baseRow = array(
		 					 'trayecto'=>$trayecto,
							 'idproducto'=>$producto->getCaIdproducto(),
							 'producto'=>utf8_encode($producto->getCaProducto()),
							 'idcotizacion'=>$producto->getCaIdcotizacion(),
							 'tra_origen'=>$origen->getCaIdtrafico(),
							 'tra_origen_value'=>utf8_encode($origen->getTrafico()->getCaNombre()),
							 'ciu_origen'=>$origen->getCaIdciudad(),
							 'ciu_origen_value'=>utf8_encode($origen->getCaCiudad()),
							 'tra_destino'=>$destino->getCaIdtrafico(),
							 'tra_destino_value'=>utf8_encode($destino->getTrafico()->getCaNombre()),
							 'ciu_destino'=>$destino->getCaIdciudad(),
							 'ciu_destino_value'=>utf8_encode($destino->getCaCiudad()),
							 'tra_escala'=>$escala?$escala->getCaIdtrafico():"",
							 'tra_escala_value'=>$escala?utf8_encode($escala->getTrafico()->getCaNombre()):"",
							 'ciu_escala'=>$escala?$escala->getCaIdciudad():"",
							 'ciu_escala_value'=>$escala?utf8_encode($escala->getCaCiudad()):"",
							 'transporte'=>utf8_encode($producto->getCaTransporte()),
							 'modalidad'=>utf8_encode($producto->getCaModalidad()),
							 'impoexpo'=>utf8_encode($producto->getCaImpoexpo()),
							 'incoterms'=>utf8_encode($producto->getCaIncoterms()),
							 'frecuencia'=>utf8_encode($producto->getCaFrecuencia()),
							 'ttransito'=>utf8_encode($producto->getCaTiempotransito()),
							 'imprimir'=>utf8_encode($producto->getCaImprimir()),
							 'observaciones'=>utf8_encode($producto->getCaObservaciones()),
							 'idlinea'=>$producto->getCaIdlinea(),
							 'linea'=>utf8_encode($lineaStr),
							 'postular_linea'=>	$producto->getCaPostularlinea(),
                             'vigencia'=>$producto->getCaVigencia(),
						);
						
			foreach( $opciones as $opcion ){
				$concepto = $opcion->getConcepto();
				$row = $baseRow;
				$row['idopcion']=$opcion->getCaIdopcion();
				$row['iditem']=$opcion->getCaIdconcepto();
				$row['item']=utf8_encode($concepto->getCaConcepto());
				$row['valor_tar']=$opcion->getCaValorTar();
				$row['aplica_tar']=utf8_encode($opcion->getCaAplicaTar());
				$row['valor_min']=$opcion->getCaValorMin();
				$row['aplica_min']=utf8_encode($opcion->getCaAplicaMin());
				$row['idmoneda']=$opcion->getCaIdmoneda();
				$row['detalles']=utf8_encode($opcion->getCaObservaciones());
				$row['tipo']="concepto";				
				$row['orden']=$opcion->getCaIdopcion();				
								
				$this->productos[] = $row;
				 //Se muestran los recargos 
				$recargos = $opcion->getCotRecargos();                

				foreach( $recargos as $recargo ){
					$tipoRecargo = $recargo->getTipoRecargo();
					
					$row = $baseRow;
                    $row['idcotrecargo']=$recargo->getCaIdcotrecargo();
					$row['idopcion']=$opcion->getCaIdopcion();
					$row['iditem']=$tipoRecargo->getCaIdrecargo();
					$row['item']=utf8_encode($tipoRecargo->getCaRecargo());
					$row['idconcepto']=$recargo->getCaIdconcepto();
					$row['valor_tar']=$recargo->getCaValorTar();
					$row['aplica_tar']=utf8_encode($recargo->getCaAplicaTar());
					$row['valor_min']=$recargo->getCaValorMin();
					$row['aplica_min']=utf8_encode($recargo->getCaAplicaMin());
					$row['idmoneda']=$recargo->getCaIdmoneda();
					$row['detalles']=utf8_encode($recargo->getCaObservaciones());
					$row['tipo']="recargo";							
					$row['orden']=$opcion->getCaIdopcion()."-".utf8_encode($tipoRecargo->getCaRecargo());
					$this->productos[] = $row;				
				}					
			}
			
			$recargos = $producto->getRecargosGenerales();		
			
			if( count($recargos)>0 ){
				$row = $baseRow;
				$row['idopcion']=999;
				$row['iditem']=9999;
				$row['item']="Recargos generales del trayecto";
				$row['idconcepto']=9999;
				$row['valor_tar']='';
				$row['aplica_tar']='';
				$row['valor_min']='';
				$row['aplica_min']='';
				$row['idmoneda']='';
				$row['detalles']='';
				$row['tipo']="concepto";
				//$row['id']+=$j++;
				$row['orden']="Y";
				//$parent = $row['id'];
				$this->productos[] = $row;									
			}
				
			foreach( $recargos as $recargo ){
				$tipoRecargo = $recargo->getTipoRecargo();		
				$row = $baseRow;
                $row['idcotrecargo']=$recargo->getCaIdcotrecargo();
				$row['idopcion']=999;
				$row['iditem']=$tipoRecargo->getCaIdrecargo();
				$row['item']=utf8_encode($tipoRecargo->getCaRecargo());
				$row['idconcepto']=$recargo->getCaIdconcepto();
				$row['valor_tar']=$recargo->getCaValorTar();
				$row['aplica_tar']=utf8_encode($recargo->getCaAplicaTar());
				$row['valor_min']=$recargo->getCaValorMin();
				$row['aplica_min']=utf8_encode($recargo->getCaAplicaMin());
				$row['idmoneda']=$recargo->getCaIdmoneda();
				$row['detalles']=utf8_encode($recargo->getCaObservaciones());
				$row['tipo']="recargo";			
				
				$row['orden']="Y-".utf8_encode($tipoRecargo->getCaRecargo());
				$this->productos[] = $row;					
			}

            if( $modo!="consulta" ){
                //Se envia una fila vacia por cada grupo para agregar una nueva opción
                $row = $baseRow;
                $row['idopcion']="";
                $row['iditem']="";
                $row['item']="+";
                $row['idconcepto']="";
                $row['valor_tar']="";
                $row['aplica_tar']="";
                $row['valor_min']="";
                $row['aplica_min']="";
                $row['idmoneda']="";
                $row['detalles']="";
                $row['tipo']="concepto";
                $row['orden']="Z";
                $this->productos[] = $row;
           }
			
		}

        $this->responseArray=array("productos"=>$this->productos, "total"=>count($this->productos));
        $this->setTemplate("responseTemplate");

	}
	
	/*
	* Permite eliminar un producto 
	* @author: Andres Botero
	*/
	public function executeEliminarProducto(){
		$idproducto = $this->getRequestParameter("idproducto");
		$this->responseArray = array();
        $this->responseArray["success"] = false;
		if( $idproducto  ){
			$producto = Doctrine::getTable("CotProducto")->find($idproducto);
			if( $producto ){
				$opciones = $producto->getCotOpciones();
				foreach( $opciones as $opcion ){							
					if( $opcion ){
						$recargos = $opcion->getCotRecargos();
						foreach( $recargos as $recargo ){
							$recargo->delete();				
						}
						$opcion->delete();
					}
				}
				
				$recGenerales = $producto->getRecargosGenerales();
				foreach( $recGenerales as $recargo ){
					$recargo->delete();				
				}				
				$producto->delete(); 
			}			
			$this->responseArray["success"] = true;
		}
        
        $this->setTemplate("responseTemplate");
		
	}
	
	
	/*
	* Permite eliminar un item dentro de la cotizacion  
	* @author: Andres Botero
	*/
	public function executeEliminarItemsOpciones(){
		$tipo = $this->getRequestParameter("tipo");		
		$idopcion = $this->getRequestParameter("idopcion");
		$idcotrecargo = $this->getRequestParameter("idcotrecargo");
        $idproducto = $this->getRequestParameter("idproducto");
		$id = $this->getRequestParameter("id");
        $this->responseArray = array();
        $this->responseArray["success"] = false;
		
        if( $tipo=="concepto" ){
            if( $idopcion==999 ){
                $producto = Doctrine::getTable("CotProducto")->find( $idproducto );
                $recargos = $producto->getRecargosGenerales();
                foreach( $recargos as $recargo ){
                    $recargo->delete();
                }
                $this->responseArray["success"] = true;
                $this->responseArray["id"] = $id;
            }else{
                $opcion = Doctrine::getTable("CotOpcion")->find($idopcion);
                if( $opcion ){
                    $recargos = $opcion->getCotRecargos();
                    foreach( $recargos as $recargo ){
                        $recargo->delete();
                    }
                    $opcion->delete();

                    $this->responseArray["success"] = true;
                    $this->responseArray["id"] = $id;
                }
            }
        }

        if( $tipo=="recargo" && $idcotrecargo ){
           
            $recargo = Doctrine::getTable("CotRecargo")->find( $idcotrecargo );
            if( $recargo ){
                $recargo->delete();
                $this->responseArray["success"] = true;
                $this->responseArray["id"] = $id;
            }
        }

        $this->setTemplate("responseTemplate");
		
		
	}
	
	/*************************************************************************
	* RECARGOS LOCALES
	*
	**************************************************************************/
		
	
	/*
	* Muestra los datos de los recargos locales
	* @author Andres Botero
	*/
	public function executeDatosGrillaRecargos(){
		$idcotizacion = $this->getRequestParameter("idcotizacion");
        $idproducto = $this->getRequestParameter("idproducto");
        $modo = $this->getRequestParameter("modo");
		$this->forward404unless( $idcotizacion );
		$tipo = Constantes::RECARGO_LOCAL;
		
		/*
		* Es necesario determinar cuales son los grupos que se deben mostrar de acuerdo 
		* a los trayectos que hay en la cotización
		*/
		$grupos = array();

        if( $idproducto ){ //A esta opcion entra desde los reportes
            $producto = Doctrine::getTable("CotProducto")->find( $idproducto );
            $grupos[$producto->getCaTransporte()]=array($producto->getCaModalidad());            
        }else{
            $rows =  Doctrine_Query::create()
                            ->select("p.ca_transporte, p.ca_modalidad")
                            ->from("CotProducto p")
                            ->where("p.ca_idcotizacion = ? ", $idcotizacion )
                            ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                            ->execute();


            foreach ( $rows as $row ) {
                $grupos[$row["ca_transporte"]][]=$row["ca_modalidad"];
                $grupos[$row["ca_transporte"]] = array_unique( $grupos[$row["ca_transporte"]] );
            }


            /*
            * Incluye grupos para los recargos que ya se han creado
            */


            $rows = Doctrine_Query::create()
                            ->select("tr.ca_transporte, p.ca_modalidad")
                            ->from("CotRecargo p")
                            ->innerJoin("p.TipoRecargo tr")
                            ->where("p.ca_idcotizacion = ? ", $idcotizacion )
                            ->addWhere("tr.ca_tipo like ? ", "%".$tipo."%" )
                            ->distinct()
                            ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                            ->execute();


            foreach ( $rows as $row ) {
                $grupos[$row["TipoRecargo"]["ca_transporte"]][]=$row["ca_modalidad"];
                $grupos[$row["TipoRecargo"]["ca_transporte"]] = array_unique( $grupos[$row["TipoRecargo"]["ca_transporte"]] );
            }

		
            //Recargos de OTM-DTA

            $tipo = Constantes::RECARGO_OTM_DTA;


            $rows = Doctrine::getTable("CotContinuacion")
                              ->createQuery("c")
                              ->select("c.ca_tipo")
                              ->where("c.ca_idcotizacion = ?", $idcotizacion)
                              ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                              ->execute();


            foreach ( $rows as $row  ) {
                $grupos[Constantes::TERRESTRE][]=$row["c_ca_tipo"];
                $grupos[Constantes::TERRESTRE] = array_unique( $grupos[Constantes::TERRESTRE] );
            }
        }
		
		$this->recargos=array();
		
		$id=100;	
		
		foreach( $grupos as $transporte=>$modalidades ){
			
			foreach( $modalidades as $modalidad  ){
				
				
				$agrupamiento = utf8_encode($transporte." ".$modalidad);
				
				$recargos = Doctrine::getTable("CotRecargo")
                                      ->createQuery("r")
                                      ->innerJoin("r.TipoRecargo tr")
                                      ->where("r.ca_idcotizacion = ?", $idcotizacion )
                                      ->addWhere("r.ca_modalidad = ? ",$modalidad )
                                      ->addWhere("tr.ca_transporte = ? ",$transporte )
                                      ->addWhere("tr.ca_tipo like ? OR tr.ca_tipo like ? ", array("%".Constantes::RECARGO_LOCAL."%", Constantes::RECARGO_OTM_DTA."%") )
                                      ->addOrderBy("tr.ca_transporte ASC")
                                      ->addOrderBy("tr.ca_recargo ASC")
                                      ->execute();
				$j=0;
				foreach( $recargos as $recargo ){
							 
					$tipoRecargo = $recargo->getTipoRecargo();
					$this->recargos[] = array( 'idcotrecargo'=>$recargo->getCaIdcotrecargo(),
												'idcotizacion'=>$idcotizacion,
												'agrupamiento'=>$agrupamiento,
												'transporte'=>utf8_encode($transporte),
												'idrecargo'=>$recargo->getCaIdrecargo(),												
												'recargo'=>utf8_encode($tipoRecargo->getCaRecargo()),      
												'valor_tar'=>$recargo->getCaValorTar(),
												'aplica_tar'=>utf8_encode($recargo->getCaAplicaTar()),
												'valor_min'=>$recargo->getCaValorMin(),
												'aplica_min'=>utf8_encode($recargo->getCaAplicaMin()),
												'idmoneda'=>$recargo->getCaIdmoneda(),
												'modalidad'=>$modalidad,
												'detalles'=>utf8_encode($recargo->getCaObservaciones()),
                                                'orden'=>$j++
                                            );

				} 	

				/*
				* Crea una fila vacia para agregar productos en cada trayecto
				*/
                if( $modo!="consulta" ){
                    $this->recargos[] = array( 'idcotrecargo'=>"",
											'idcotizacion'=>$idcotizacion,
											'agrupamiento'=>$agrupamiento,
											'transporte'=>utf8_encode($transporte),
											'idrecargo'=>'',											
											'recargo'=>'+',      
											'valor_tar'=>'',
											'aplica_tar'=>'',
											'valor_min'=>'',
											'aplica_min'=>'',
											'idmoneda'=>'',
											'modalidad'=>utf8_encode($modalidad),
											'detalles'=>'',
                                            'orden'=>'Z'
											);
                }
				$id+=100;	
			}			
		}

        $this->responseArray = array("recargos"=>$this->recargos, "total"=>count($this->recargos), "success"=>true);
		$this->setTemplate("responseTemplate");
	}
	
	
	/*************************************************************************
	* CONTINUACION DE VIAJE 
	*
	**************************************************************************/
	
	/*
	* Guarda los cambios realizados a Continuación de Viaje  
	* @author Carlos G. López M.
	*/
	public function executeFormContViajeGuardar(){
		$user_id = $this->getUser()->getUserId();
		$update = true;
		$continuacion=null;
		if( $this->getRequestParameter("idcontinuacion") ){
			$continuacion = Doctrine::getTable("CotContinuacion")->find( $this->getRequestParameter("idcontinuacion") );
		}
		if ( !$continuacion ) {
				$update = false;
				$continuacion = new CotContinuacion();
				$continuacion->setCaIdcotizacion( $this->getRequestParameter("cotizacionId") );
		}
		
		if( $this->getRequestParameter("tipo") ){
			$continuacion->setCaTipo( $this->getRequestParameter("tipo") );
		}
		
		if( $this->getRequestParameter("modalidad") ){
			$continuacion->setCaModalidad( $this->getRequestParameter("modalidad") );
		}
		
		if( $this->getRequestParameter("origen") ){
			$continuacion->setCaOrigen( $this->getRequestParameter("origen") );
		}
		
		if( $this->getRequestParameter("destino") ){
			$continuacion->setCaDestino( $this->getRequestParameter("destino") );
		}
		
		if( $this->getRequestParameter("idconcepto") ){
			$continuacion->setCaIdconcepto( $this->getRequestParameter("idconcepto") );
		}
		
		if( $this->getRequestParameter("idequipo") ){
			$continuacion->setCaIdequipo( $this->getRequestParameter("idequipo") );
		}
				
		if( $this->getRequestParameter("valor_tar") ){
			$continuacion->setCaValorTar( $this->getRequestParameter("valor_tar") );
		}

		if( $this->getRequestParameter("valor_min") ){
			$continuacion->setCaValorMin( $this->getRequestParameter("valor_min") );
		}
		
		if( $this->getRequestParameter("idmoneda") ){
			$continuacion->setCaIdmoneda( $this->getRequestParameter("idmoneda") );
		}
		
		if( $this->getRequestParameter("frecuencia")!==null ){
			$continuacion->setCaFrecuencia( utf8_decode($this->getRequestParameter("frecuencia")) );
		}
		
		if( $this->getRequestParameter("ttransito")!==null ){
			$continuacion->setCaTiempotransito( utf8_decode($this->getRequestParameter("ttransito")) );
		}
		
		if( $this->getRequestParameter("observaciones")!==null ){
			if( $this->getRequestParameter("observaciones") ){
				$continuacion->setCaObservaciones( utf8_decode($this->getRequestParameter("observaciones")) );
			}else{
				$continuacion->setCaObservaciones( null );
			}
		}
		

		$continuacion->save();
		
		$this->responseArray = array( "id"=>$this->getRequestParameter("id"), "idcontinuacion"=>$continuacion->getCaIdcontinuacion() );		
		$this->setTemplate("responseTemplate");
						
	}
	
	
	public function executeEliminarContViaje(){
	
		$continuacion = Doctrine::getTable("CotContinuacion")->find( $this->getRequestParameter("idcontinuacion") );
		$this->forward404Unless( $continuacion );
		
		$continuacion->delete();		
				
		$this->responseArray = array("id"=>$this->getRequestParameter("id"));
		$this->setTemplate("responseTemplate");
			
	}
	
	
	/*
	* Devuelve los datos para la grilla de OTM/DTA 
	*/
	public function executeDatosContinuacionViaje(){
		
		$id = $this->getRequestParameter("idcotizacion");
				
		$rows  = Doctrine::getTable("CotContinuacion")
                 ->createQuery("cont")
                 ->select("cont.*,o.ca_ciudad,d.ca_ciudad, conc.ca_concepto, e.ca_concepto ")
                 ->innerJoin("cont.Origen o")
                 ->innerJoin("cont.Destino d")
                 ->innerJoin("cont.Concepto conc")
                 ->leftJoin("cont.Equipo e")
                 ->where("cont.ca_idcotizacion=?", $id)

                 ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                 ->execute();





		$this->contviajes = array();
		$i=0;
		
		$tipo = null;
		
   		foreach ( $rows as $row  ) {
            
      		$this->contviajes[] = array('idcotizacion'=>$row["ca_idcotizacion"],
      									'tipo'=>$row["ca_tipo"],
      									'modalidad'=>$row["ca_modalidad"],
										'origen'=>$row["ca_origen"],
										'ciuorigen'=>utf8_encode($row["Origen"]["ca_ciudad"]),
      									'destino'=>$row["ca_destino"],
      									'ciudestino'=>utf8_encode($row["Destino"]["ca_ciudad"]),
      									'idconcepto'=>$row["ca_idconcepto"],
      									'concepto'=>$row["Concepto"]["ca_concepto"],
      									'idequipo'=>$row["ca_idequipo"],
      									'equipo'=>$row["Equipo"]["ca_concepto"],
      									'valor_tar'=>$row["ca_valor_tar"],
      									'valor_min'=>$row["ca_valor_min"],
      									'idmoneda'=>$row["ca_idmoneda"],
										'frecuencia'=>utf8_encode($row["ca_frecuencia"]),
										'ttransito'=>utf8_encode($row["ca_tiempotransito"]),
										'observaciones'=>utf8_encode($row["ca_observaciones"]),
										'id'=>utf8_encode($row["ca_idcontinuacion"]),
										'orden'=>$i++
      		);
		}	
		
		$this->contviajes[] = array('idcotizacion'=>$id,
      									'tipo'=>"OTM",
      									'modalidad'=>'+',
										'origen'=>'',
										'ciuorigen'=>'',
      									'destino'=>'',
      									'ciudestino'=>'',
      									'idconcepto'=>'',
      									'concepto'=>'',
      									'idequipo'=>'',
      									'equipo'=>'',
      									'valor_tar'=>'',
      									'valor_min'=>'',
      									'idmoneda'=>'COP',
										'frecuencia'=>'',
										'ttransito'=>'',
										'observaciones'=>'',
										'oid'=>'',
										'orden'=>9999+$i++,
      			);
				
		$this->contviajes[] = array('idcotizacion'=>$id,
      									'tipo'=>"DTA",
      									'modalidad'=>'+',
										'origen'=>'',
										'ciuorigen'=>'',
      									'destino'=>'',
      									'ciudestino'=>'',
      									'idconcepto'=>'',
      									'concepto'=>'',
      									'idequipo'=>'',
      									'equipo'=>'',
      									'valor_tar'=>'',
      									'valor_min'=>'',
      									'idmoneda'=>'COP',
										'frecuencia'=>'',
										'ttransito'=>'',
										'observaciones'=>'',
										'oid'=>'',
										'orden'=>9999+$i++,
      			);		
		
		$this->responseArray = array("contviajes"=>$this->contviajes, "total"=>count($this->contviajes));
		$this->setTemplate("responseTemplate");
	}
	
	
	/*************************************************************************
	* GRILLA SEGUROS
	*
	**************************************************************************/
	
	/*
	* Guarda los cambios realizados en la Plantilla Seguros  
	* @author Carlos G. López M.
	*/
	public function executeObserveSegurosManagement(){
		$user_id = $this->getUser()->getUserId();
		$id = $this->getRequestParameter( "id" );
		if( $this->getRequestParameter( "oid" ) ) {
			
			$seguro = Doctrine::getTable("CotSeguro")->find( $this->getRequestParameter("oid")  );
			$this->forward404Unless( $seguro );
		}else{
			$seguro = new CotSeguro();
			$seguro->setCaIdcotizacion( $this->getRequestParameter("cotizacionId") );
		}

		if( $this->getRequestParameter("prima_tip") ){
			$seguro->setCaPrimaTip($this->getRequestParameter("prima_tip"));
		}

		if( $this->getRequestParameter("prima_vlr") ){
			$seguro->setCaPrimaVlr($this->getRequestParameter("prima_vlr"));
		}

		if( $this->getRequestParameter("prima_min") ){
			$seguro->setCaPrimaMin($this->getRequestParameter("prima_min"));
		}
		
		if( $this->getRequestParameter("obtencion") ){
			$seguro->setCaObtencion($this->getRequestParameter("obtencion"));
		}
		
		if( $this->getRequestParameter("idmoneda") ){
			$seguro->setCaIdmoneda($this->getRequestParameter("idmoneda"));
		}

		if( $this->getRequestParameter("observaciones")){
			$seguro->setCaObservaciones($this->getRequestParameter("observaciones"));
		}
		
		if( $this->getRequestParameter("transporte")){
			$seguro->setCaTransporte(utf8_decode($this->getRequestParameter("transporte")));
		}

		if( !$this->getRequestParameter( "oid" ) ){ 
			$seguro->setCaFchcreado( date("Y-m-d H:i:s") );
			$seguro->setCaUsucreado( $user_id );			
		}else{
			$seguro->setCaFchactualizado( date("Y-m-d H:i:s") );
			$seguro->setCaUsuactualizado( $user_id );							
		}
		
		$seguro->save();
		$this->responseArray = array("id"=>$id);
		$this->setTemplate("responseTemplate");
			
	}
	
	public function executeEliminarGrillaSeguros(){
		$user_id = $this->getUser()->getUserId();
		$id = $this->getRequestParameter( "id" );
		if( $this->getRequestParameter( "oid" ) ) {			
			$seguro = Doctrine::getTable("CotSeguro")->find( $this->getRequestParameter( "oid" ) );
			if( $seguro ){
				$seguro->delete();
				$this->responseArray = array("id"=>$id);
			}
		}
		
		$this->setTemplate("responseTemplate");
		
	}
	
	
	/*
	* Muestra las tarifas de seguros de acuerdo a los productos cotizados 
	*/	
	public function executeTarifarioSeguros(){

		$idcotizacion = $this->getRequestParameter("idcotizacion");		
		$this->idcomponent = "seguros_".$idcotizacion;
		$cotizacion = Doctrine::getTable("Cotizacion")->find( $idcotizacion );
		$productos = $cotizacion->getCotProductos();
		
		$this->data = array();
		foreach(  $productos as $producto ){
			$origen = $producto->getOrigen();
			$destino = $producto->getDestino();
			if( $producto->getCaImpoexpo()==Constantes::IMPO ){
				$grupo = $origen->getTrafico()->getTraficoGrupo(); 
			}else{
				$grupo = $destino->getTrafico()->getTraficoGrupo();
			}
			
			$seguro = Doctrine::getTable("PricSeguro")->find( array($grupo->getCaIdgrupo(), $producto->getCaTransporte()) );
			if( $seguro ){
				$row = array(			 
					'idgrupo'=>$grupo->getCaIdgrupo(),
					'grupo'=>utf8_encode($grupo->getCaDescripcion()),
					'trayecto'=>utf8_encode($origen->getCaCiudad()."»".$destino->getCaCiudad()),
					'producto'=>utf8_encode($producto->getCaProducto())
				);
			
							
			
				$row['vlrprima']=$seguro->getCaVlrprima();
				$row['vlrminima']=$seguro->getCaVlrminima();
				$row['vlrobtencionpoliza']=$seguro->getCaVlrobtencionpoliza();
				$row['idmoneda']=$seguro->getCaIdmoneda();
				$row['observaciones']=$seguro->getCaObservaciones();
				$row['transporte']=utf8_encode($seguro->getCaTransporte());
				$this->data[] = $row;
			}
			
		}
			
		
		
	}
	
	
	
	/*************************************************************************
	* OTROS
	*
	**************************************************************************/
	/*
	* Datos de las modalidades según sea el medio de transporte
	*/
	public function executeDatosModalidades(){
		$transport_parameter = utf8_decode($this->getRequestParameter("transporte"));
		$impoexpo_parameter = utf8_decode($this->getRequestParameter("impoexpo"));
		
		if ( $transport_parameter == Constantes::MARITIMO)	{
			$transportes = ParametroPeer::retrieveByCaso( "CU051",null, $impoexpo_parameter);
		}else if ( $transport_parameter == Constantes::AEREO )	{
			$transportes = ParametroPeer::retrieveByCaso( "CU052",null, $impoexpo_parameter);
		}else if ( $transport_parameter ==  Constantes::TERRESTRE )	{
			$transportes = ParametroPeer::retrieveByCaso( "CU053",null, $impoexpo_parameter);
		}
		$this->modalidades = array();
		
		foreach($transportes as $transporte){
			$row = array("modalidad"=>$transporte->getCaValor());
			$this->modalidades[]=$row;
		}
		
	}

	
	
	
	/*************************************************************************
	* COTIZACIONES ADUANA
	*
	**************************************************************************/

	/*
	* Guarda los cambios realizados a trayectos
	* @author Andres Botero
	*/
	public function executeFormTrayectoAduanaGuardar(){

		$user_id = $this->getUser()->getUserId();

        if( $this->getRequestParameter("idtrayecto") ){
			$trayecto = Doctrine::getTable("CotTrayectoAduana")->find(  $this->getRequestParameter("idtrayecto") );
			$this->forward404Unless( $trayecto );
            $cotizacion = $trayecto->getCotizacion();
		}else{
			$trayecto = new CotTrayectoAduana();
            $cotizacion = Doctrine::getTable("Cotizacion")->find(  $this->getRequestParameter("idcotizacion") );
            $this->forward404Unless( $cotizacion );
			$trayecto->setCaIdcotizacion( $cotizacion->getCaIdcotizacion() );
		}

		$trayecto->setCaProducto( utf8_decode($this->getRequestParameter("producto")) );
        
        if( $this->getRequestParameter("vigencia") ){
            $trayecto->setCaVigencia( $this->getRequestParameter("vigencia") );
        }else{
            $trayecto->setCaVigencia( null );
        }

		
		$trayecto->setCaOrigen( $this->getRequestParameter("ciu_origen") );
		$trayecto->setCaDestino( $this->getRequestParameter("ciu_destino") );
		$trayecto->setCaObservaciones( utf8_decode($this->getRequestParameter("observaciones")) );
		
		$trayecto->save();

        //Elimina el seguimiento por cotizacion y lo establece por trayecto
        if( $cotizacion->getCaEtapa() ){
            $cotizacion->setCaEtapa(null);
            $cotizacion->save();
            $tarea = $cotizacion->getNotTarea();
            if( $tarea ){
                $tarea->delete();
            }
        }

        /*
        $tarea = $cotizacion->getTareaIDGEnvioOportuno();
		if( $tarea ){
			$texto = "Debe enviar esta cotizacion por email o colocar la fecha de presentación para cumplir esta tarea.<br />";

            $productos = Doctrine::getTable("CotProducto")
                      ->createQuery("p")
                      ->where("p.ca_idcotizacion = ?", $cotizacion->getCaIdcotizacion() )
                      ->execute();
            foreach( $productos as $producto ){
                 $texto.=$producto->getCaImpoexpo()." ".$producto->getCaModalidad()." ".$producto->getOrigen()." - ".$producto->getDestino()."<br />";
            }

            $tarea->setCaTexto($texto);
            $tarea->save();
        }*/


        $this->responseArray=array("success"=>true);
        $this->setTemplate("responseTemplate");

	}



    /*
	* Muestra los datos de la grilla de prooductos del componente grillaProductos
	*/
	public function executeDatosPanelTransporteAduana(){
		$id = $this->getRequestParameter("idcotizacion");
        $idtrayecto = $this->getRequestParameter("idtrayecto");

        $cotizacion = Doctrine::getTable("Cotizacion")->find( $id );

		$cotTrayectos = $cotizacion->getCotTrayectoAduana();

        $modo = $this->getRequestParameter("modo");

		$this->trayectos = array();

		foreach( $cotTrayectos as $trayecto ){

            if( $idtrayecto && $idtrayecto!=$trayecto->getCaIdtrayecto()){//Se desea uno solo
                continue;
            }

			$j=0;
			$origen = $trayecto->getOrigen();
			$destino = $trayecto->getDestino();
			

			

			$trayectoStr = utf8_encode("[". $origen->getCaCiudad() ." » ".$destino->getCaCiudad()."] ".$trayecto->getCaProducto()." ".$trayecto->getCaIdtrayecto());
			

			

			//Se envian las opciones existentes
			

			$baseRow = array(
		 					 'trayecto'=>$trayectoStr,
							 'idtrayecto'=>$trayecto->getCaIdtrayecto(),
							 'producto'=>utf8_encode($trayecto->getCaProducto()),
							 'idcotizacion'=>$trayecto->getCaIdcotizacion(),
							 'ciu_origen'=>$origen->getCaIdciudad(),
							 'ciu_origen_value'=>utf8_encode($origen->getCaCiudad()),							 
							 'ciu_destino'=>$destino->getCaIdciudad(),
							 'ciu_destino_value'=>utf8_encode($destino->getCaCiudad()),							 
							 'observaciones'=>utf8_encode($trayecto->getCaObservaciones()),
                             'vigencia'=>$trayecto->getCaVigencia(),
						);
             /*$opciones = $producto->getCotOpciones();
			foreach( $opciones as $opcion ){
				$concepto = $opcion->getConcepto();
				$row = $baseRow;
				$row['idopcion']=$opcion->getCaIdopcion();
				$row['iditem']=$opcion->getCaIdconcepto();
				$row['item']=utf8_encode($concepto->getCaConcepto());
				$row['valor_tar']=$opcion->getCaValorTar();
				$row['aplica_tar']=utf8_encode($opcion->getCaAplicaTar());
				$row['valor_min']=$opcion->getCaValorMin();
				$row['aplica_min']=utf8_encode($opcion->getCaAplicaMin());
				$row['idmoneda']=$opcion->getCaIdmoneda();
				$row['detalles']=utf8_encode($opcion->getCaObservaciones());
				$row['tipo']="concepto";
				$row['orden']=$opcion->getCaIdopcion();

				$this->productos[] = $row;
				 //Se muestran los recargos
				$recargos = $opcion->getCotRecargos();

				foreach( $recargos as $recargo ){
					$tipoRecargo = $recargo->getTipoRecargo();

					$row = $baseRow;
                    $row['idcotrecargo']=$recargo->getCaIdcotrecargo();
					$row['idopcion']=$opcion->getCaIdopcion();
					$row['iditem']=$tipoRecargo->getCaIdrecargo();
					$row['item']=utf8_encode($tipoRecargo->getCaRecargo());
					$row['idconcepto']=$recargo->getCaIdconcepto();
					$row['valor_tar']=$recargo->getCaValorTar();
					$row['aplica_tar']=utf8_encode($recargo->getCaAplicaTar());
					$row['valor_min']=$recargo->getCaValorMin();
					$row['aplica_min']=utf8_encode($recargo->getCaAplicaMin());
					$row['idmoneda']=$recargo->getCaIdmoneda();
					$row['detalles']=utf8_encode($recargo->getCaObservaciones());
					$row['tipo']="recargo";
					$row['orden']=$opcion->getCaIdopcion()."-".utf8_encode($tipoRecargo->getCaRecargo());
					$this->productos[] = $row;
				}
			}

			$recargos = $producto->getRecargosGenerales();

			if( count($recargos)>0 ){
				$row = $baseRow;
				$row['idopcion']=999;
				$row['iditem']=9999;
				$row['item']="Recargos generales del trayecto";
				$row['idconcepto']=9999;
				$row['valor_tar']='';
				$row['aplica_tar']='';
				$row['valor_min']='';
				$row['aplica_min']='';
				$row['idmoneda']='';
				$row['detalles']='';
				$row['tipo']="concepto";
				//$row['id']+=$j++;
				$row['orden']="Y";
				//$parent = $row['id'];
				$this->productos[] = $row;
			}

			foreach( $recargos as $recargo ){
				$tipoRecargo = $recargo->getTipoRecargo();
				$row = $baseRow;
                $row['idcotrecargo']=$recargo->getCaIdcotrecargo();
				$row['idopcion']=999;
				$row['iditem']=$tipoRecargo->getCaIdrecargo();
				$row['item']=utf8_encode($tipoRecargo->getCaRecargo());
				$row['idconcepto']=$recargo->getCaIdconcepto();
				$row['valor_tar']=$recargo->getCaValorTar();
				$row['aplica_tar']=utf8_encode($recargo->getCaAplicaTar());
				$row['valor_min']=$recargo->getCaValorMin();
				$row['aplica_min']=utf8_encode($recargo->getCaAplicaMin());
				$row['idmoneda']=$recargo->getCaIdmoneda();
				$row['detalles']=utf8_encode($recargo->getCaObservaciones());
				$row['tipo']="recargo";

				$row['orden']="Y-".utf8_encode($tipoRecargo->getCaRecargo());
				$this->productos[] = $row;
			}*/

            if( $modo!="consulta" ){
                //Se envia una fila vacia por cada grupo para agregar una nueva opción
                $row = $baseRow;
                $row['idopcion']="";
                $row['iditem']="";
                $row['item']="+";
                $row['idconcepto']="";
                $row['valor_tar']="";
                $row['aplica_tar']="";
                $row['valor_min']="";
                $row['aplica_min']="";
                $row['idmoneda']="";
                $row['detalles']="";
                $row['tipo']="concepto";
                $row['orden']="Z";
                $this->trayectos[] = $row;
           }

		}

        $this->responseArray=array("productos"=>$this->trayectos, "total"=>count($this->trayectos));
        $this->setTemplate("responseTemplate");

	}


    /*
	* Permite eliminar un trayecto
	* @author: Andres Botero
	*/
	public function executeEliminarPanelTransporteAduana(){
		$idtrayecto = $this->getRequestParameter("idtrayecto");
		$this->responseArray = array();
        $this->responseArray["success"] = false;
		if( $idtrayecto  ){
			$trayecto = Doctrine::getTable("CotTrayectoAduana")->find($idtrayecto);
			if( $trayecto ){
				$trayecto->delete();
			}
			$this->responseArray["success"] = true;
		}

        $this->setTemplate("responseTemplate");

	}

}
?>
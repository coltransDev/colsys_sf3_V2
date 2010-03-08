<?php

/** 
* helpdesk actions.
*
* @package    colsys
* @subpackage helpdesk
* @author     Andrés Botero
* @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
*
* Niveles de acceso 
* 0 Solo tickets puestos por el usuario.
* 1 Tickets de su grupo o área unicamente.
* 2 Acceso a los tickets de su departamento. 
* 3 Acceso a todo.
*/ 
class helpdeskActions extends sfActions
{
	const RUTINA = "39";
			
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request){		

        $departamentos = Doctrine::getTable("Departamento")
                         ->createQuery("d")
                         ->where("d.ca_inhelpdesk = ?", true)
                         ->execute();


		$this->departamentos = array();
		
		foreach( $departamentos as $departamento ){
			$this->departamentos[] = array("iddepartamento"=>$departamento->getCaIddepartamento(), 
										 "nombre"=>$departamento->getCaNombre()
										);		
		}
		
		$this->user = $this->getUser();
		
		$this->nivel = $this->getUser()->getNivelAcceso( helpdeskActions::RUTINA );
		
		if( !$this->nivel ){
			$this->nivel = 0;
		}
	}
	
	
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeListaTickets(sfWebRequest $request){
		
		$nivel = $this->getUser()->getNivelAcceso( helpdeskActions::RUTINA );		
		$opcion = $request->getParameter("opcion");
		$criterio = $request->getParameter("criterio");
		$groupby = $request->getParameter("groupby");
		
		$q = Doctrine_Query::create()
                    ->select("h.*")
                    ->from('HdeskTicket h');
		$q->innerJoin("h.HdeskGroup g");
        $q->leftJoin("h.HdeskTicketUser hu  ");
		switch($opcion){
			case "numero":
				if( intval($criterio) ){					
					$ticket = Doctrine::getTable("HdeskTicket")->find( intval($criterio) );
					if( $ticket ){
						$this->redirect( "helpdesk/verTicket?id=".$ticket->getCaIdticket() );
					}
				}				
				break;				
			case "criterio":
				$q->innerJoin("h.HdeskResponse r");				
				$q->where("(h.ca_title like ?  or r.ca_text like ?) ", array("%". strtolower($criterio)."%", "%". strtolower($criterio)."%" ) );
                $q->addOrderBy("h.ca_idgroup");
                $q->addOrderBy("h.ca_idproject");
                $q->addOrderBy("h.ca_action");
                $q->addOrderBy("h.ca_opened");
				break;	
			case "personalizada":			
				
				if( $request->getParameter("departamento") ){
                    
                    $q->addWhere("g.ca_iddepartament = ? ", $request->getParameter("departamento") );
				}
				
				if( $request->getParameter("area") ){
                    $q->addWhere("h.ca_idgroup = ? ", $request->getParameter("area") );
				}
				
				if( $request->getParameter("project") ){
                    $q->addWhere("h.ca_idproject = ? ", $request->getParameter("project") );
				}
				
				if( $request->getParameter("priority") ){
                    $q->addWhere("h.ca_priority = ? ", $request->getParameter("priority") );
				}
				
				if( $request->getParameter("actionTicket") ){						
                    $q->addWhere("h.ca_action = ? ", $request->getParameter("actionTicket") );
				}
				
				if( $request->getParameter("type") ){
                    $q->addWhere("h.ca_type = ? ", $request->getParameter("type") );
				}	
				
				
				if( $request->getParameter("assignedto") ){
                    $q->addWhere("h.ca_assignedto = ? ", $request->getParameter("assignedto") );	
				}	
				
				if( $request->getParameter("reportedby") ){						                   
                    
                    $q->addWhere("(h.ca_login = ? or hu.ca_login = ?)", array($request->getParameter("reportedby"),$request->getParameter("reportedby")) );
				}
				

                $q->addOrderBy("h.ca_idgroup ASC");
				if( $groupby=="project" ){
                    $q->addOrderBy("h.ca_idproject ASC");
				}
                $q->addOrderBy("h.ca_action ASC");
                $q->addOrderBy("h.ca_opened ASC");
					
				break;
			
			case "group":

                $q->innerJoin("g.HdeskUserGroup ugg " );
                $q->addWhere("( ugg.ca_login = ?)", $this->getUser()->getUserid() );
                				
				if( $request->getParameter("assigned") ){
					if( $request->getParameter("assigned")=="true"){
                        $q->addWhere( "h.ca_assignedto IS NOT NULL" );				
					}else{
						$q->addWhere( "h.ca_assignedto IS NULL" );
					}
				}
				$q->addWhere("h.ca_action = ? ", "Abierto");
				$q->addOrderBy("h.ca_idgroup");
				 
				if( $groupby=="project" ){
                    $q->addOrderBy("h.ca_idproject DESC");


				}
                $q->addOrderBy("h.ca_opened DESC");				
				break;
		}
				
		/*
		* Aplica restricciones de acuerdo al nivel de acceso.
		*/
		switch( $nivel ){
			case 0:
                $q->addWhere("(h.ca_login = ? or hu.ca_login = ?)", array($this->getUser()->getUserid(), $this->getUser()->getUserid()) );
				break;
			case 1:
                $q->innerJoin("g.HdeskUserGroup uggg " );
                
                $q->addWhere("(h.ca_login = ? OR uggg.ca_login = ?)", array($this->getUser()->getUserid(), $this->getUser()->getUserid()) );
                break;
			case 2:
                $q->addWhere("(h.ca_login = ? OR g.ca_iddepartament = ?)", array($this->getUser()->getUserid(), $this->getUser()->getIddepartamento() ) );
				break;
		}
		
		
		$q->distinct();
        //exit($q->getSql());
		$this->tickets = $q->execute();
		
		$this->groupby = $groupby;
		
		$this->nivel = $this->getUser()->getNivelAcceso( helpdeskActions::RUTINA );
	}
	
	/**
	* Vista previa de un ticket y permite adicionar respuestas
	*
	* @param sfRequest $request A request object
	*/
	public function executeVerTicket(sfWebRequest $request){

		$this->nivel = $this->getUser()->getNivelAcceso( helpdeskActions::RUTINA );		
		$this->iddepartamento = $this->getUser()->getIddepartamento();	
		
				
		if( !$this->nivel ){
			$this->nivel = 0;
		}
        
		$idticket = $request->getParameter("id");
		$this->ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel );
		$this->forward404Unless( $this->ticket );	
								
		if( $request->getParameter("format")=="email" ){
			$this->setTemplate("verTicketEmail");
			$this->setLayout("none");
		}
		
		
		$this->loginsGrupo = array();		
		$usuarios = Doctrine::getTable("HdeskUserGroup")->createQuery("ug")
                    ->where("ug.ca_idgroup = ?", $this->ticket->getCaIdgroup())
                    ->addOrderBy("ug.ca_login")
                    ->execute();
		foreach( $usuarios as $usuario ){
			$this->loginsGrupo[]=$usuario->getCaLogin();
		}
		
		
		$this->user = $this->getUser();

        $directorio = $this->ticket->getDirectorio();

        $this->files = sfFinder::type('file')->maxDepth(0)->in($directorio);

        $this->usuarios = Doctrine::getTable("Usuario")->createQuery("u")
                    ->innerJoin("u.HdeskTicketUser ug")
                    ->where("ug.ca_idticket = ?", $this->ticket->getCaIdticket())
                    ->addOrderBy("u.ca_nombre")
                    ->execute();
		
		
		
	}
	
	/**
	* Formulario para crear un n uevo ticket
	*
	* @param sfRequest $request A request object
	*/
	public function executeCrearTicket( sfWebRequest $request ){
		
		$this->nivel = $this->getUser()->getNivelAcceso( helpdeskActions::RUTINA );
        
		if( !$this->nivel ){
			$this->nivel = 0;
		}
        
		$idticket = $request->getParameter("id");
		$this->ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel );
		
		
		if( !$this->ticket ){
			$this->ticket = new HdeskTicket();
		}

        $departamentos = Doctrine::getTable("Departamento")
                         ->createQuery("d")
                         ->where("d.ca_inhelpdesk = ?", true)
                         ->execute();
		
		$this->departamentos = array();
		
		foreach( $departamentos as $departamento ){
			$this->departamentos[] = array("iddepartamento"=>$departamento->getCaIddepartamento(), 
										 "nombre"=>$departamento->getCaNombre()
										);		
		}
		
			
		$this->iddepartamento = $this->getUser()->getIddepartamento();

        $usersGroup = Doctrine::getTable("HdeskUserGroup")
                         ->createQuery("d")
                         ->where("d.ca_login = ?", $this->getUser()->getUserId())
                         ->execute();
        $this->grupos = array();
        foreach( $usersGroup as $usersGroup ){
            $this->grupos[] = $usersGroup->getCaIdgroup();            
        }


        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/FileUploadField",'last');
		
	}
	
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeGuardarRespuestaTicket(sfWebRequest $request){

        $this->nivel = $this->getUser()->getNivelAcceso( helpdeskActions::RUTINA );
        $idticket = $request->getParameter("idticket");
        $ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel );
		$this->forward404Unless( $ticket );

		
		
		$user = $this->getUser();
		
		$respuesta = new HdeskResponse();
		$respuesta->setCaIdticket( $request->getParameter("idticket") );
		$respuesta->setCaText( utf8_decode($request->getParameter("comentario")) );
		$respuesta->setCaLogin( $user->getUserId() );
		$respuesta->setCaCreatedat( date("Y-m-d H:i:s") );
		$respuesta->save();
		
		$logins = array( $ticket->getCaLogin() );
		if( $ticket->getCaAssignedto() ){
			$logins[]=$ticket->getCaAssignedto();
		}else{			
			$usuarios = Doctrine::getTable("HdeskUserGroup")
                        ->createQuery("h")
                        ->where("h.ca_idgroup = ? ", $ticket->getCaIdgroup() )
                        ->addOrderBy("h.ca_login")
                        ->execute();
			foreach( $usuarios as $usuario ){
				$logins[]=$usuario->getCaLogin();
			}
		}


        $usuarios = $ticket->getUsuarios();
        foreach( $usuarios as $usuario ){
            $logins[]=$usuario->getCaLogin();
        }


			
		if( $ticket->getCaAssignedto()==$this->getUser()->getUserId() || in_array($this->getUser()->getUserId(),$logins ) ){			
			$tarea = $ticket->getTareaIdg(); 				
			if( $tarea ){
				if( !$tarea->getCaFchterminada() ){
					$tarea->setCaFchterminada( date("Y-m-d H:i:s") );
					$tarea->setCaUsuterminada( $this->getUser()->getUserId() );	
					$tarea->save();
				}
			}				
		}
		
		$email = new Email();		
		$email->setCaUsuenvio( $this->getUser()->getUserId() );
		$email->setCaTipo( "Notificación" ); 		
		$email->setCaIdcaso( $ticket->getCaIdticket() );
		$email->setCaFrom( "no-reply@coltrans.com.co" );
		$email->setCaFromname( "Colsys Notificaciones" );
		
		
		$email->setCaSubject( "Nueva respuesta Ticket #".$ticket->getCaIdticket()." [".$ticket->getCaTitle()."]" );		
		
		$texto = "Se ha creado una respuesta \n\n<br /><br />" ;					
		$request->setParameter("id", $ticket->getCaIdticket() );
		$request->setParameter("format", "email" );			
		$texto.= sfContext::getInstance()->getController()->getPresentationFor( 'helpdesk', 'verTicket');
		
		$email->setCaBodyhtml( $texto );
			
		foreach( $logins as $login ){
		
			if( $this->getUser()->getUserId()!=$login ){
				$usuario = Doctrine::getTable("Usuario")->find( $login );
				$email->addTo( $usuario->getCaEmail() ); 				
			}
		}
		
		$email->save();
		//$email->send();
		
		$this->ticket = $ticket;
				
	}
	
	
	/**
	* Guarda los datos de un ticket 
	*
	* @param sfRequest $request A request object
	*/
	public function executeFormTicketGuardar(sfWebRequest $request){
		$update = false;
		$user = $this->getUser();
		if( $request->getParameter("idticket") ){
			$ticket = Doctrine::getTable("HdeskTicket")->find( $request->getParameter("idticket") );
			$update = true;

            if( $request->getParameter("area")!=$ticket->getCaIdgroup() ){ //Cuando cambia el area notifica.
                $tarea = $ticket->getNotTarea();
                if( $tarea ){
                    $tarea->delete();
                }
                $update = false;
            }
		}else{
			$ticket = new HdeskTicket();
			$ticket->setCaLogin( $user->getUserId() );
			$ticket->setCaOpened( date("Y-m-d H:i:s") );
		}


		$ticket->setCaIdgroup( $request->getParameter("area") );
		if( $request->getParameter("project") ){
			$ticket->setCaIdproject( $request->getParameter("project") );
		}
        
        $ticket->setCaTitle( ($request->getParameter("title")) );
        $ticket->setCaText( ($request->getParameter("text")) );
        


		if( $request->getParameter("actionTicket") ){	
			$ticket->setCaAction( $request->getParameter("actionTicket") );	
		}
		if( $request->getParameter("type") ){	
			$ticket->setCaType( $request->getParameter("type") );
		}
		
		if( $request->getParameter("priority") ){
			$ticket->setCaPriority( $request->getParameter("priority") );
		}
		
		if( $request->getParameter("assignedto") ){
			$ticket->setCaAssignedto( $request->getParameter("assignedto") );
		}
				
		@$ticket->save();

       
        if( isset( $_FILES["archivo"] )){
            
            $archivo = $_FILES["archivo"];
            $directorio = $ticket->getDirectorio();           

            if( !is_dir($directorio) ){
                mkdir($directorio, 0777, true);
            }
            move_uploaded_file( $archivo["tmp_name"], $directorio.DIRECTORY_SEPARATOR. $archivo["name"]);            
        }
       
       
		if( !$update ){			
			$request->setParameter("id", $ticket->getCaIdticket() );
			$request->setParameter("format", "email" );
			$titulo = "Nuevo Ticket #".$ticket->getCaIdticket()." [".$ticket->getCaTitle()."]";		
				
			$texto = "Se ha creado un nuevo ticket \n\n<br /><br />" ;			
			$texto.= sfContext::getInstance()->getController()->getPresentationFor( 'helpdesk', 'verTicket');	
			
			$grupo = $ticket->getHdeskGroup();
			/*
			* Se crea la tarea para los miembros del grupo. 
			*/
			$tarea = new NotTarea(); 
			$tarea->setCaUrl( "/helpdesk/verTicket?id=".$ticket->getCaIdticket() );
			$tarea->setCaIdlistatarea( 1 );
			$tarea->setCaFchcreado( date("Y-m-d h:i:s") );
									
			$tarea->setTiempo( TimeUtils::getFestivos(), $grupo->getCaMaxresponsetime() );
			
			$tarea->setCaUsucreado( $this->getUser()->getUserId() );
			$tarea->setCaTitulo( $titulo );		
			$tarea->setCaTexto( $texto );
			$tarea->save();
				
			$ticket->setCaIdtarea( $tarea->getCaIdtarea() );
			$ticket->save();			
		}else{
			$tarea = $ticket->getNotTarea(); 
		}
		
		if( $tarea ){				
			//Verifica las asignaciones de la tarea. 							
			$loginsAsignaciones = $ticket->getLoginsGroup();					
			$tarea->setAsignaciones( $loginsAsignaciones );				
		}		
		
		if( !$update ){		
			$tarea->notificar();
		}

        
        


		$this->redirect("helpdesk/verTicket?id=".$ticket->getCaIdticket());


		
	
	}
	
	
	/**
	* Toma asignacion de un ticket 
	*
	* @param sfRequest $request A request object
	*/
	public function executeTomarAsignacion(sfWebRequest $request){
		if( $request->getParameter("id") ){
			$ticket = Doctrine::getTable("HdeskTicket")->find( $request->getParameter("id") );
			$ticket->setCaAssignedto( $this->getUser()->getUserId() );
			$ticket->save();
			$tarea = $ticket->getNotTarea(); 
			if( $tarea ){														
				$tarea->setAsignaciones( array( $this->getUser()->getUserId() ) );	
			}		
		}
		$this->redirect("helpdesk/verTicket?id=".$request->getParameter("id"));
		
	}
	
	/**
	* Toma asignacion de un ticket 
	*
	* @param sfRequest $request A request object
	*/
	public function executeCerrarTicket(sfWebRequest $request){
		if( $request->getParameter("id") ){
			$ticket = Doctrine::getTable("HdeskTicket")->find( $request->getParameter("id") );
			$ticket->setCaAction( "Cerrado" );
			$ticket->save();
			
			$tarea = $ticket->getTareaSeguimiento();
			if( $tarea ){
				$tarea->setCaFchterminada(date("Y-m-d H:i:s"));
				$tarea->setCaUsuterminada( $this->getUser()->getUserId() );	
				$tarea->save();
			}
		}
		$this->redirect("helpdesk/verTicket?id=".$request->getParameter("id"));
		
	}
	
	public function executeNuevoSeguimiento(sfWebRequest $request){
		$this->ticket = null;
		if( $request->getParameter("id") ){
			$this->ticket = Doctrine::getTable("HdeskTicket")->find( $request->getParameter("id") );
		}	
		
		$this->forward404Unless( $this->ticket );
		
		$seguimiento = $request->getParameter("seguimiento");
		
		if( $seguimiento ){			
			$titulo = "Seguimiento Ticket # ".$this->ticket->getCaIdticket()." [".$this->ticket->getCaTitle()."]";
			
			$texto = "Usted ha programado un seguimiento para el ticket # ".$this->ticket->getCaIdticket()." [".$this->ticket->getCaTitle()."]";
			$tarea = $this->ticket->getTareaSeguimiento();
			if( !$tarea ){
				$tarea = new NotTarea(); 
				$tarea->setCaUsucreado( $this->getUser()->getUserId() );
				$tarea->setCaFchcreado( date("Y-m-d H:i:s") );
			}
			$tarea->setCaUrl( "/helpdesk/verTicket?id=".$this->ticket->getCaIdticket() );
			$tarea->setCaIdlistatarea( 5 );
				
			
			$fchvisible = $request->getParameter("fchvisible");
			if( $fchvisible ){
                $fchvisible = Utils::parseDate( $fchvisible );
				$tarea->setCaFchvisible( $fchvisible." 00:00:00" );
			}

            $seguimiento = Utils::parseDate( $seguimiento );
			$tarea->setCaFchvencimiento( $seguimiento." 23:59:59" );
			
			$tarea->setCaTitulo( $titulo );		
			$tarea->setCaTexto( $texto );
			$tarea->save();	
			
			$tarea->setAsignaciones(array($this->getUser()->getUserId()));
			$this->ticket->setCaIdseguimiento( $tarea->getCaIdtarea() );
			$this->ticket->save();
			$this->redirect("helpdesk/verTicket?id=".$this->ticket->getCaIdticket());
			
		}		
	}
	
	
	public function executeEliminarSeguimiento(sfWebRequest $request){
		$this->ticket = null;
		if( $request->getParameter("id") ){
			$this->ticket = Doctrine::getTable("HdeskTicket")->find( $request->getParameter("id") );
		}	
		
		$this->forward404Unless( $this->ticket );
		
		$tarea = $this->ticket->getTareaSeguimiento();
		if( $tarea ){
			$tarea->delete();
		}
		$this->redirect("helpdesk/verTicket?id=".$this->ticket->getCaIdticket());
	}
	

	/**
	* Datos de las areas de acuerdo al departamento
	*
	* @param sfRequest $request A request object
	*/
	public function executeDatosAreas(sfWebRequest $request){
		$departamento = $request->getParameter("departamento");
		$gruposArray = array();

		if( $departamento ){			
            $grupos = Doctrine::getTable("HdeskGroup")
                      ->createQuery("g")
                      ->where("g.ca_iddepartament = ?",  $departamento)
                      ->addOrderBy("g.ca_name")
                      ->execute();

			foreach( $grupos as $grupo ){
				$gruposArray[] = array("idgrupo"=>$grupo->getCaIdgroup(), "nombre"=>utf8_encode($grupo->getCaName()));
			}
		}

		$this->responseArray = array("grupos"=>$gruposArray, "success"=>true);
		$this->setTemplate("responseTemplate");
		
	}

	/**
	* Datos de las areas de acuerdo al grupos
	*
	* @param sfRequest $request A request object
	*/
	public function executeDatosProyectos(sfWebRequest $request){
		$idgrupo = $request->getParameter("idgrupo");
		$proyectosArray = array();

		if( $idgrupo ){			
            $proyectos = Doctrine::getTable("HdeskProject")
                         ->createQuery("p")
                         ->where("p.ca_idgroup = ? and p.ca_active=true", $idgrupo )
                         ->addOrderBy("p.ca_name")
                         ->execute();

			foreach( $proyectos as $proyecto ){
				$proyectosArray[] = array("idproyecto"=>$proyecto->getCaIdproject(), "nombre"=>utf8_encode($proyecto->getCaName()));
			}
		}

		$this->responseArray = array("proyectos"=>$proyectosArray, "success"=>true);
		$this->setTemplate("responseTemplate");
		
	}

	/**
	* Datos de los usuarios de acuerdo al grupos
	*
	* @param sfRequest $request A request object
	*/
	public function executeDatosAsignaciones(sfWebRequest $request){
		$idgrupo = $request->getParameter("idgrupo");
		$usuariosArray = array();

		if( $idgrupo ){
            $usuarios = Doctrine::getTable("HdeskUserGroup")
                         ->createQuery("g")
                         ->where("g.ca_idgroup = ?", $idgrupo )
                         ->addOrderBy("g.ca_login")
                         ->execute();
			foreach( $usuarios as $usuario ){
				$usuariosArray[] = array("login"=>$usuario->getCaLogin());
			}
		}

		$this->responseArray = array("usuarios"=>$usuariosArray, "success"=>true);
		$this->setTemplate("responseTemplate");
		
	}

    /**
	* Datos de las areas de acuerdo al departamento
	*
	* @param sfRequest $request A request object
	*/
	public function executeDatosClasificacion(sfWebRequest $request){
		$departamento = $request->getParameter("departamento");
		$data = array();

		if( $departamento ){
            $clasificaciones = Doctrine::getTable("HdeskDepartamentClasification")
                      ->createQuery("c")
                      ->where("c.ca_iddepartament = ?",  $departamento)
                      ->addOrderBy("c.ca_order")
                      ->execute();

			foreach( $clasificaciones as $clasificacion ){
				$data[] = array("iddepartamento"=>$departamento, "clasification"=>utf8_encode($clasificacion->getCaClasification()));
			}
		}

		$this->responseArray = array("root"=>$data, "success"=>true);
		$this->setTemplate("responseTemplate");

	}

    /**
	* Lista de tickets de acuerdo al numero de horas de trabajo y a l aprioridad
	*
	* @param sfRequest $request A request object
	*/
    public function executeListaTicketsPrioridades(sfWebRequest $request){
        $this->nivel = $this->getUser()->getNivelAcceso( helpdeskActions::RUTINA );
        $this->option = $request->getParameter("option" );
        $this->forward404Unless($request->getParameter("user" ));
        $this->user = Doctrine::getTable("Usuario")->find($request->getParameter("user" ));

        $this->userId = $this->getUser()->getUserId();

        if( $this->user->getCaLogin()!=$this->getUser()->getUserId() ){
            $this->option = "view";
        }


		$q = Doctrine_Query::create()
                    ->from('HdeskTicket h');

        $q->addWhere("h.ca_idgroup = ? ", $request->getParameter("area") );
        $q->addWhere("h.ca_action != ? ", "Cerrado" );
        $q->addWhere("h.ca_assignedto = ? ", $this->user->getCaLogin() );
        $q->addOrderBy("h.ca_order ASC");
		$q->addOrderBy("h.ca_idgroup ASC");				
        $q->addOrderBy("h.ca_action ASC");
        $q->addOrderBy("h.ca_opened ASC");        
		$q->distinct();
		$this->tickets = $q->execute();


		$this->nivel = $this->getUser()->getNivelAcceso( helpdeskActions::RUTINA );


        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("jquery/jquery.tablednd.js",'last');

    }

    /**
	* Lista de tickets de acuerdo al numero de horas de trabajo y a l aprioridad
	*
	* @param sfRequest $request A request object
	*/
    public function executeGuardarListPrioridades(sfWebRequest $request){

        

        $orders = $request->getParameter("table-5");

        foreach( $orders as  $key=>$order  ){
            if(substr($order, 0, 4 )=="row_"){
                $idticket = substr($order, 4, 100 );
                $hours = $request->getParameter("hours_".$idticket );
                $percentage = $request->getParameter("percentage_".$idticket );

                $q = Doctrine_Query::create();
                $q->update('HdeskTicket h');
                $q->set('h.ca_order', $key);
                if( $hours>=0 ){
                    $q->set('h.ca_estimatedhours', $hours);
                }
                if( $percentage>=0 && $percentage<=100  ){
                    $q->set('h.ca_percentage', $percentage);
                }
                $q->where('h.ca_idticket = ?', $idticket);
                $q->execute();
            }
        }        
        return sfView::NONE;
        
    }

    /**
	* Adjunta un archivo a un ticket
	*
	* @param sfRequest $request A request object
	*/
    public function executeAdjuntarArchivo(sfWebRequest $request){
        $this->nivel = $this->getUser()->getNivelAcceso( helpdeskActions::RUTINA );
        $idticket = $request->getParameter("id");
		$this->ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel );
		$this->forward404Unless( $this->ticket );

        $directory =  $this->ticket->getDirectorio();

        $this->form = new NuevoAdjuntoForm();

        

        if ($request->isMethod('post')){
			$bindValues = array();

            $bindFiles["archivo"] = $_FILES["archivo"];

			$this->form->bind( $bindValues, $bindFiles );

			if( $this->form->isValid() ){

                $directorio = $this->ticket->getDirectorio();

                if( !is_dir($directorio) ){
                    mkdir($directorio, 0777, true);
                }
                move_uploaded_file( $bindFiles["archivo"]["tmp_name"], $directorio.DIRECTORY_SEPARATOR. $bindFiles["archivo"]["name"]);
                


                $this->redirect("helpdesk/verTicket?id=".$this->ticket->getCaIdticket() );
            }
        }        
    }


     /**
	* Adjunta un archivo a un ticket
	*
	* @param sfRequest $request A request object
	*/
    public function executeVerArchivo(sfWebRequest $request){
        $this->nivel = $this->getUser()->getNivelAcceso( helpdeskActions::RUTINA );
		$this->iddepartamento = $this->getUser()->getIddepartamento();


		if( !$this->nivel ){
			$this->nivel = 0;
		}
        $idticket = $request->getParameter("id");
		$this->ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel );
		$this->forward404Unless( $this->ticket );

        $directory =  $this->ticket->getDirectorio();

        $filename = base64_decode( $request->getParameter("file") );
        $this->file = $directory.DIRECTORY_SEPARATOR.$filename;
        
        if( !file_exists($this->file) ){
            $this->forward404();
        }
        
       
    }


     /**
	* Adjunta un archivo a un ticket
	*
	* @param sfRequest $request A request object
	*/
    public function executeEliminarArchivo(sfWebRequest $request){
        $this->nivel = $this->getUser()->getNivelAcceso( helpdeskActions::RUTINA );
		$this->iddepartamento = $this->getUser()->getIddepartamento();


		if( !$this->nivel ){
			$this->nivel = 0;
		}

        $idticket = $request->getParameter("id");
		$this->ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel );
		$this->forward404Unless( $this->ticket );

        $directory =  $this->ticket->getDirectorio();

        $filename = base64_decode( $request->getParameter("file") );
        $this->file = $directory.DIRECTORY_SEPARATOR.$filename;

        if( !file_exists($this->file) ){
            $this->forward404();
        }

        unlink( $this->file );        
        $this->redirect("helpdesk/verTicket?id=".$this->ticket->getCaIdticket() );

    }


     /**
	* Agrega un usuario a un ticket para copiarle las comunicaciones o escritbir respuestas
	*
	* @param sfRequest $request A request object
	*/
    public function executeAgregarUsuario(sfWebRequest $request){
        $this->nivel = $this->getUser()->getNivelAcceso( helpdeskActions::RUTINA );
		$this->iddepartamento = $this->getUser()->getIddepartamento();


		if( !$this->nivel ){
			$this->nivel = 0;
		}

       

        $idticket = $request->getParameter("id");
		$this->ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel );
		$this->forward404Unless( $this->ticket );
        
        $this->form = new AdjuntarUsuarioForm();

        

        if ($request->isMethod('post')){
			$bindValues = array();

            $bindValues["ca_login"]=$request->getParameter("ca_login");
            $bindValues["ca_idticket"]=$request->getParameter("id");

			$this->form->bind( $bindValues );

			if( $this->form->isValid() ){

                $usuarioTicket = Doctrine::getTable("HdeskTicketUser")->find(array($this->ticket->getCaIdticket(),$bindValues["ca_login"] ));
                if( !$usuarioTicket ){
                    $usuarioTicket = new HdeskTicketUser();
                    $usuarioTicket->setCaLogin($bindValues["ca_login"]);
                    $usuarioTicket->setCaIdticket($this->ticket->getCaIdticket());
                    $usuarioTicket->save();


                    $email = new Email();
                    $email->setCaUsuenvio( $this->getUser()->getUserId() );
                    $email->setCaTipo( "Notificación" );
                    $email->setCaIdcaso( $this->ticket->getCaIdticket() );
                    $email->setCaFrom( "no-reply@coltrans.com.co" );
                    $email->setCaFromname( "Colsys Notificaciones" );


                    $email->setCaSubject( "Ha sido involucrado en el Ticket #".$this->ticket->getCaIdticket()." [".$this->ticket->getCaTitle()."]" );

                    $texto = "Ha sido involucrado en el Ticket \n\n<br /><br />" ;
                    $request->setParameter("id", $this->ticket->getCaIdticket() );
                    $request->setParameter("format", "email" );
                    $texto.= sfContext::getInstance()->getController()->getPresentationFor( 'helpdesk', 'verTicket');

                    $email->setCaBodyhtml( $texto );
                    $usuario = Doctrine::getTable("Usuario")->find($bindValues["ca_login"]);
                    $email->addTo( $usuario->getCaEmail() );
                    $email->save();
                }
                $this->redirect("helpdesk/verTicket?id=".$this->ticket->getCaIdticket() );
                
            }
        }

    }


    /**
	* Agrega un usuario a un ticket para copiarle las comunicaciones o escritbir respuestas
	*
	* @param sfRequest $request A request object
	*/
    public function executeEliminarUsuario(sfWebRequest $request){

        $this->nivel = $this->getUser()->getNivelAcceso( helpdeskActions::RUTINA );
		
		if( !$this->nivel ){
			$this->nivel = 0;
		}
        $idticket = $request->getParameter("id");
        $this->ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel );


         $usuario = Doctrine::getTable("HdeskTicketUser")->createQuery("ug")
                    ->where("ug.ca_idticket = ?",$this->ticket->getCaIdticket())
                    ->addWhere("ug.ca_login = ?", $request->getParameter("usuario") )
                    ->fetchOne();
         if( $usuario ){
            $usuario->delete();
         }
         $this->redirect("helpdesk/verTicket?id=".$this->ticket->getCaIdticket() );
    }
	

}


?>
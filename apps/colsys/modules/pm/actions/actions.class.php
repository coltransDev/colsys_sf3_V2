<?php

/**
* pm actions.
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
class pmActions extends sfActions
{
    const RUTINA = "89";

    public function getNivel(){
        $this->nivel = $this->getUser()->getNivelAcceso( pmActions::RUTINA );
		if( !$this->nivel ){
			$this->nivel = 0;
		}
        
		$this->forward404Unless($this->nivel!=-1);
		
        //return 1;
        return $this->nivel;
    }

	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request){
        
		$this->nivel = $this->getNivel();
		$response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/RowExpander",'last');
        $response->addJavaScript("extExtras/SliderTip",'last');
        $response->addStylesheet("extExtras/slider",'last');

        $this->idticket = $request->getParameter("idticket");
			
	}
	

    /**
	* Datos del ticket
	*
	* @param sfRequest $request A request object
	*/
	public function executeDatosPanelTickets(sfWebRequest $request){
        $nivel = $this->getNivel();
		$opcion = $request->getParameter("opcion");
		$criterio = $request->getParameter("criterio");
		$groupby = $request->getParameter("groupby");

        $this->forward404Unless( $request->getParameter("idgroup") || $request->getParameter("idproject") );

		$q = Doctrine_Query::create()
                    ->select("h.*, m.ca_due, m.ca_title, p.ca_name, tar.ca_fchterminada, (SELECT MAX(rr.ca_createdat) FROM HdeskResponse rr WHERE rr.ca_idticket = h.ca_idticket ) as ultseg")
                    ->from('HdeskTicket h');
		$q->innerJoin("h.HdeskGroup g");
        $q->leftJoin("h.HdeskTicketUser hu  ");
        $q->leftJoin("h.HdeskProject p");
        $q->leftJoin("h.HdeskMilestone m");
        $q->leftJoin("h.NotTarea tar");		

        if( $request->getParameter("iddepartament") ){

            $q->addWhere("g.ca_iddepartament = ? ", $request->getParameter("iddepartament") );
        }

        if( $request->getParameter("idgroup") ){
            $q->addWhere("h.ca_idgroup = ? ", $request->getParameter("idgroup") );
        }

        if( $request->getParameter("criterio") ){
            $criterio = $request->getParameter("criterio");
            $q->where("(h.ca_title like ?  or r.ca_text like ?) ", array("%". strtolower($criterio)."%", "%". strtolower($criterio)."%" ) );
        }

        if( $request->getParameter("idproject") ){            
            $q->addWhere("h.ca_idproject = ? ", $request->getParameter("idproject") );
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


        if( $request->getParameter("assignedTo") ){
            $q->addWhere("h.ca_assignedto = ? OR h.ca_assignedto IS NULL", $request->getParameter("assignedTo") );
        }

        if( $request->getParameter("reportedBy") ){

            $q->addWhere("(h.ca_login = ? or hu.ca_login = ?)", array($request->getParameter("reportedBy"),$request->getParameter("reportedBy")) );
        }


        $q->addOrderBy("h.ca_idgroup ASC");
        $q->addOrderBy("h.ca_idproject ASC");
        $q->addOrderBy("h.ca_action ASC");
        $q->addOrderBy("h.ca_opened ASC");

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
		}

        if( $nivel==2 || $nivel==3 ){
            $q->addWhere("(h.ca_login = ? OR g.ca_iddepartament = ?)", array($this->getUser()->getUserid(), $this->getUser()->getIddepartamento() ) );
        }


		$q->distinct();
        //exit($q->getSqlQuery());
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $q->limit(200);
		$tickets = $q->execute();
        
        foreach( $tickets as $key=>$val){
            $tickets[$key]["milestone"]=utf8_encode($tickets[$key]["m_ca_title"]." ".Utils::fechaMes($tickets[$key]["m_ca_due"]));
            $tickets[$key]["h_ca_title"]=utf8_encode(str_replace('"', "'",$tickets[$key]["h_ca_title"]));
            $tickets[$key]["h_ca_text"]=utf8_encode(str_replace("</style", "</style2",str_replace("<style", "<style2",str_replace('"', "'", $tickets[$key]["h_ca_text"]))));
            $tickets[$key]["p_ca_name"]=$tickets[$key]["p_ca_name"]?utf8_encode(str_replace('"', "'",$tickets[$key]["p_ca_name"])):"Sin proyecto";
            $tickets[$key]["folder"]=base64_encode( HdeskProject::FOLDER.DIRECTORY_SEPARATOR.$tickets[$key]["h_ca_idticket"]);
        }

        $this->responseArray = array("success"=>true, "root"=>$tickets);

        $this->setTemplate("responseTemplate");
    }

	/**
	* Vista previa de un ticket y permite adicionar respuestas
	*
	* @param sfRequest $request A request object
	*/
	public function executeVerTicket(sfWebRequest $request){

		$this->nivel = $this->getNivel();
		$this->iddepartamento = $this->getUser()->getIddepartamento();



		$idticket = $request->getParameter("id");
        $this->format = $request->getParameter("format");
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
                    ->addWhere("ug.ca_idticket = ?", $this->ticket->getCaIdticket())
                    ->addWhere("u.ca_activo = ?", true)
                    ->addOrderBy("u.ca_nombre")
                    ->execute();


		$response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/RowExpander",'last');
        $response->addJavaScript("extExtras/SliderTip",'last');
        $response->addStylesheet("extExtras/slider",'last');

	}

	/**
	* Formulario para crear un n uevo ticket
	*
	* @param sfRequest $request A request object
	*/
	public function executeCrearTicket( sfWebRequest $request ){

		$this->nivel = $this->getNivel();

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

        $this->user = $this->getuser();
        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/FileUploadField",'last');

	}

	/**
	* Guarda un seguimiento a un ticket
	*
	* @param sfRequest $request A request object
	*/
	public function executeGuardarRespuestaTicket(sfWebRequest $request){

        $this->nivel = $this->getNivel();
        $idticket = $request->getParameter("idticket");
        $ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel );
		$this->forward404Unless( $ticket );

        $idissue = $request->getParameter("idissue");

		$user = $this->getUser();

		$respuesta = new HdeskResponse();
		$respuesta->setCaIdticket( $request->getParameter("idticket") );

        $idresponse = $request->getParameter("idresponse");

        if( $idresponse ){
            $respuesta->setCaResponseto( $idresponse );
        }

        if( $idissue ){
            $issue = Doctrine::getTable("KBIssue")->find( $idissue );
            $this->forward404Unless( $issue );
            $respuesta->setCaIdissue( $idissue );
            $url = "https://www.coltrans.com.co/kbase/viewIssue/idissue/".$idissue;
            $txt = "Adjunto encontrara una soluci&oacute;n al problema reportado.\n<br />";
            $txt .= "Tambien es posible verlo desde el siguiente vinculo: <br />";
            $txt .= "<b><a href='$url'>$url</a></b> <br /> <br />";


            $respuesta->setCaText( utf8_decode($txt) );

        }else{
            $respuesta->setCaText( utf8_decode($request->getParameter("respuesta")) );
        }
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

		
		$request->setParameter("id", $ticket->getCaIdticket() );
		$request->setParameter("format", "email" );
        if( $idissue ){
            $texto  = $txt;
            $texto .=sfContext::getInstance()->getController()->getPresentationFor( 'kbase', 'viewIssue');

            $texto = str_replace('src="/', 'src="https://www.coltrans.com.co/',  $texto);
            //$texto = str_replace('src="/', 'src="https://localhost/',  $texto);
        }else{
            $texto = sfContext::getInstance()->getController()->getPresentationFor( 'pm', 'verTicket');
        }
        
        
		$email->setCaBodyhtml( $texto );

		foreach( $logins as $login ){

			if( $this->getUser()->getUserId()!=$login ){
				$usuario = Doctrine::getTable("Usuario")->find( $login );
				$email->addTo( $usuario->getCaEmail() );
			}
		}

		$email->save();
		//$email->send();

		//$this->ticket = $ticket;
        $request->setParameter("format", "" );
        $texto = sfContext::getInstance()->getController()->getPresentationFor( 'pm', 'verRespuestas');
        
        $this->responseArray = array("success"=>true, "idticket"=>$ticket->getCaIdticket(), "info"=>utf8_encode($texto));
        $this->setTemplate("responseTemplate");


	}


    /**
	* Respuestas de un ticket en formato HTML
	*
	* @param sfRequest $request A request object
	*/
	public function executeVerRespuestas(sfWebRequest $request){
        $this->forward404Unless($request->getParameter("idticket"));
        $ticket = Doctrine::getTable("HdeskTicket")->find( $request->getParameter("idticket") );
        $this->forward404Unless($ticket);
        $this->ticket = $ticket;

        $this->opener = $request->getParameter("opener");
        $this->format = $request->getParameter("format");
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

        if( $request->getParameter("idmilestone") ){
			$ticket->setCaIdmilestone( $request->getParameter("idmilestone") );
		}

        if( $request->getParameter("reportedby") ){
			$ticket->setCaLogin( $request->getParameter("reportedby") );
		}
        
		$ticket->save();
        

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
			$tarea->setCaUrl( "/pm/verTicket?id=".$ticket->getCaIdticket() );
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

        $this->responseArray = array("success"=>true, "idticket"=>$ticket->getCaIdticket());
        $this->setTemplate("responseTemplate");
        $this->setLayout("none");

		
	}


	/**
	* Toma asignacion de un ticket
	*
	* @param sfRequest $request A request object
	*/
	public function executeTomarAsignacion(sfWebRequest $request){
		if( $request->getParameter("idticket") ){
			$ticket = Doctrine::getTable("HdeskTicket")->find( $request->getParameter("idticket") );
			$ticket->setCaAssignedto( $this->getUser()->getUserId() );
			$ticket->save();
			$tarea = $ticket->getNotTarea();
			if( $tarea ){
				$tarea->setAsignaciones( array( $this->getUser()->getUserId() ) );
			}

            $this->responseArray = array("success"=>true, "idticket"=>$ticket->getCaIdticket(), "assignedto"=>$this->getUser()->getUserId());
		}else{
            $this->responseArray = array("success"=>false );
        }


        $this->setTemplate("responseTemplate");

		

	}

	/**
	* Toma asignacion de un ticket
	*
	* @param sfRequest $request A request object
	*/
	public function executeCerrarTicket(sfWebRequest $request){
		if( $request->getParameter("idticket") ){
			$ticket = Doctrine::getTable("HdeskTicket")->find( $request->getParameter("idticket") );
			$ticket->setCaAction( "Cerrado" );
            $ticket->setCaPercentage( 100 );
			$ticket->save();

			$tarea = $ticket->getTareaSeguimiento();
			if( $tarea ){
				$tarea->setCaFchterminada(date("Y-m-d H:i:s"));
				$tarea->setCaUsuterminada( $this->getUser()->getUserId() );
				$tarea->save();
			}
		}


        $this->responseArray = array("success"=>true,"idticket"=>$request->getParameter("idticket"));

		$this->setTemplate("responseTemplate");


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
			$tarea->setCaUrl( "/pm/verTicket?id=".$this->ticket->getCaIdticket() );
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
			$this->redirect("pm/verTicket?id=".$this->ticket->getCaIdticket());

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
		$this->redirect("pm/verTicket?id=".$this->ticket->getCaIdticket());
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
	* Datos del ticket
	*
	* @param sfRequest $request A request object
	*/
	public function executeDatosMilestones(sfWebRequest $request){
        $nivel = $this->getNivel();

        $this->forward404Unless( $request->getParameter("idproject") );

        $project = Doctrine::getTable("HdeskProject")->find( $request->getParameter("idproject") );

        $this->forward404Unless( $project );

		$q = Doctrine_Query::create()
                    ->select("h.ca_idmilestone, h.ca_title")
                    ->from('HdeskMilestone h')
                    ->addWhere("h.ca_idproject = ?", $request->getParameter("idproject") )
                    ->addOrderBy("h.ca_due ASC")
                    ->addOrderBy("h.ca_title ASC");




		//$q->distinct();
        //exit($q->getSql());
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $q->limit(120);
		$milestones = $q->execute();
        $i= 0;
        foreach( $milestones as $key=>$val){
            $milestones[$key]["h_ca_title"]=utf8_encode($milestones[$key]["h_ca_title"]);            
        }

        
        $this->responseArray = array("success"=>true, "root"=>$milestones);
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
	* Datos de los usuarios de acuerdo al grupos
	*
	* @param sfRequest $request A request object
	*/
	public function executeDatosUsuarios(sfWebRequest $request){

		$usuariosArray = array();
        $usuarios = Doctrine::getTable("Usuario")
                     ->createQuery("g")
                     ->where("g.ca_activo = ?", true )
                     ->addOrderBy("g.ca_login")
                     ->execute();
        foreach( $usuarios as $usuario ){
            $usuariosArray[] = array("login"=>$usuario->getCaLogin(), "nombre"=>utf8_encode($usuario->getCaNombre()));
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
        $this->nivel = $this->getNivel();
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


		$this->nivel = $this->getNivel();


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
	* Agrega un usuario a un ticket para copiarle las comunicaciones o escritbir respuestas
	*
	* @param sfRequest $request A request object
	*/
    public function executeAgregarUsuario(sfWebRequest $request){
        $this->nivel = $this->getNivel();
		$this->iddepartamento = $this->getUser()->getIddepartamento();

        $this->nivel = $this->getNivel();

        $idticket = $request->getParameter("idticket");
		$this->ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel );
		$this->forward404Unless( $this->ticket );
        
        $bindValues = array();
        $bindValues["ca_login"]=$request->getParameter("login");
        $bindValues["ca_idticket"]=$request->getParameter("idticket");

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


        $this->responseArray = array("success"=>true, "idticket"=>$this->ticket->getCaIdticket());
        $this->setTemplate("responseTemplate");

        
        

    }


    /**
	* Agrega un usuario a un ticket para copiarle las comunicaciones o escritbir respuestas
	*
	* @param sfRequest $request A request object
	*/
    public function executeEliminarUsuario(sfWebRequest $request){

        $this->nivel = $this->getNivel();

		if( !$this->nivel ){
			$this->nivel = 0;
		}
        $idticket = $request->getParameter("idticket");
        $this->ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel );


         $usuario = Doctrine::getTable("HdeskTicketUser")->createQuery("ug")
                    ->where("ug.ca_idticket = ?",$this->ticket->getCaIdticket())
                    ->addWhere("ug.ca_login = ?", $request->getParameter("login") )
                    ->fetchOne();
         if( $usuario ){
            $usuario->delete();
            $this->responseArray = array("success"=>true, "idticket"=>$this->ticket->getCaIdticket(), "id"=>$request->getParameter("id"));
         }else{
            $this->responseArray = array("success"=>false);
         }

         
         $this->setTemplate("responseTemplate");
    }


    /**
	* Retorna todas las tareas en formato json
	*
	* @param sfRequest $request A request object
	*/
    public function executeDatosPanelTareas(sfWebRequest $request){

        $this->nivel = $this->getNivel();

        $idticket = $request->getParameter("idticket");
        $this->forward404Unless( $idticket );
        $ticket = Doctrine::getTable("HdeskTicket")->find($idticket );
        $this->forward404Unless( $ticket );



        $tareas = Doctrine::getTable("HdeskTask")
                            ->createQuery("t")
                            ->where("t.ca_idticket = ?", $ticket->getCaIdticket() )
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                            ->execute();

        foreach( $tareas as $key=>$val ){
            $tareas[$key]["t_ca_task"]=utf8_encode($tareas[$key]["t_ca_task"]);


        }

        $tareas[]=array("t_ca_task"=>"", "orden"=>"Z");

        $this->responseArray = array("success"=>true, "root"=>$tareas);

        $this->setTemplate("responseTemplate");
    }


    /**
	* guarda una tarea del panel de tareas
	*
	* @param sfRequest $request A request object
	*/
    public function executeGuardarPanelTareas(sfWebRequest $request){
        $idtask = $request->getParameter("idtask");
        if( $idtask ){
            $task = Doctrine::getTable("HdeskTask")->find( $idtask );
        }else{
            $task = new HdeskTask();
            $task->setCaIdticket( $request->getParameter("idticket") );
        }
        $task->setCaTask( $request->getParameter("task") );
        $task->save();
        $this->responseArray = array("success"=>true, "id"=>$request->getParameter("id"), "idtask"=>$task->getCaIdtask());

        $this->setTemplate("responseTemplate");
    }


    /**
	* Pagina de administración de proyectos
	*
	* @param sfRequest $request A request object
	*/
    public function executeListaProyectos(sfWebRequest $request){
        $this->projects = Doctrine::getTable("HdeskProject")
                  ->createQuery("p")
                  ->select("p.ca_idproject, p.ca_name, (SELECT COUNT(*) FROM HdeskTicket ta WHERE ta.ca_idproject = p.ca_idproject AND ta.ca_action ='Abierto') as ta, (SELECT COUNT(*) FROM HdeskTicket tc WHERE tc.ca_idproject = p.ca_idproject AND tc.ca_action ='Cerrado') as tc")                 
                  ->addOrderBy("p.ca_name")
                  ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                  ->execute();
    }

    /**
	* Detalles del proyecto
	*
	* @param sfRequest $request A request object
	*/
    public function executeDetalleProyecto(sfWebRequest $request){
        $this->forward404Unless( $request->getParameter("id") );
        $this->project = Doctrine::getTable("HdeskProject")->find( $request->getParameter("id") );
        $this->forward404Unless( $this->project );
    }


    /**
	* Datos para la bbarra de progreso del panel
	*
	* @param sfRequest $request A request object
	*/
    public function executeEstadoPanelProyectos(sfWebRequest $request){
        $this->responseArray = array("success"=>true);

        $this->forward404Unless( $request->getParameter("idproject") );
        
        $numtickets = Doctrine::getTable("HdeskProject")
                  ->createQuery("p")
                  ->select("p.*, (SELECT COUNT(*) FROM HdeskTicket ta WHERE ta.ca_idproject = p.ca_idproject AND ta.ca_action ='Abierto') as ta, (SELECT COUNT(*) FROM HdeskTicket tc WHERE tc.ca_idproject = p.ca_idproject AND tc.ca_action ='Cerrado') as tc")
                  ->where("p.ca_idproject = ? ", $request->getParameter("idproject") )
                  ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                  ->fetchOne();


        if( $numtickets["p_tc"]+$numtickets["p_ta"]>0 ){
            $porcentaje =  $numtickets["p_tc"]/($numtickets["p_tc"]+$numtickets["p_ta"]);
        }else{
            $porcentaje = 0;
        }
        $this->responseArray["progress"] = $porcentaje;
        $this->responseArray["text"] = $numtickets["p_ta"]." tickets abiertos/ ".$numtickets["p_tc"]." tickets cerrados ".(round($porcentaje*100,1))."% Terminado";
        $this->setTemplate("responseTemplate");


    }
    
    /**
	* Datos del ticket
	*
	* @param sfRequest $request A request object
	*/
	public function executeDatosPanelMilestones(sfWebRequest $request){
        $nivel = $this->getNivel();

        $this->forward404Unless( $request->getParameter("idproject") );

        $project = Doctrine::getTable("HdeskProject")->find( $request->getParameter("idproject") );

        $this->forward404Unless( $project );

		$q = Doctrine_Query::create()
                    ->select("h.*")
                    ->from('HdeskMilestone h')
                    ->addWhere("h.ca_idproject = ?", $request->getParameter("idproject") )
                    ->addOrderBy("h.ca_due ASC")
                    ->addOrderBy("h.ca_title ASC");




		$q->distinct();
        //exit($q->getSql());
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $q->limit(120);
		$milestones = $q->execute();
        $i= 0;
        foreach( $milestones as $key=>$val){
            $milestones[$key]["h_ca_title"]=utf8_encode($milestones[$key]["h_ca_title"]);
            $milestones[$key]["h_ca_text"]=utf8_encode($milestones[$key]["h_ca_text"]);
            $milestones[$key]["orden"] = $i++;
        }

        if( $project->getCaManager()==$this->getUser()->getUserId() ){
            $milestones[] = array("h_ca_title"=>"", "orden"=>"Z");
        }


        $this->responseArray = array("success"=>true, "root"=>$milestones);



        $this->setTemplate("responseTemplate");
    }


    /**
	* Datos del ticket
	*
	* @param sfRequest $request A request object
	*/
	public function executeGuardarPanelMilestones(sfWebRequest $request){
        $this->responseArray = array("success"=>true, "id"=>$request->getParameter("id"));
        
        if( $request->getParameter("idmilestone") ){
            $milestone = Doctrine::getTable("HdeskMilestone")->find( $request->getParameter("idmilestone") );
            $this->forward404Unless( $milestone );
        }else{
            $milestone = new HdeskMilestone();
            $milestone->setCaIdproject( $request->getParameter("idproject") );
        }

        if( $request->getParameter("title") ){
            $milestone->setCaTitle( $request->getParameter("title") );
        }

        if( $request->getParameter("text") ){
            $milestone->setCaText( $request->getParameter("text") );
        }

        if( $request->getParameter("due") ){
            $milestone->setCaDue( substr($request->getParameter("due"), 0, 10));
        }

        if( $request->getParameter("end") ){
            $milestone->setCaEnd( substr($request->getParameter("end"), 0, 10));
        }

        $milestone->save();

        $this->responseArray["idmilestone"] = $milestone->getCaIdmilestone();

        $this->setTemplate("responseTemplate");
    }


    /**
	* Datos del ticket
	*
	* @param sfRequest $request A request object
	*/
	public function executeEliminarPanelMilestones(sfWebRequest $request){
        $this->responseArray = array("success"=>false, "id"=>$request->getParameter("id"));


        $this->forward404Unless( $request->getParameter("idmilestone") );

        $milestone = Doctrine::getTable("HdeskMilestone")->find( $request->getParameter("idmilestone") );

        if( $milestone ){
            $milestone->delete();
            $this->responseArray["success"] = true;
        }        

        $this->setTemplate("responseTemplate");
    }



     /*
	* Panel que muestra un arbol con opciones de busqueda
	* @author: Andres Botero
	*/
    public function executeDatosPanelConsulta( ){
        $this->departamentos = Doctrine::getTable("Departamento")
                         ->createQuery("d")
                         ->where("d.ca_inhelpdesk = ?", true)
                         ->addOrderBy("d.ca_nombre ASC")
                         ->execute();
        $this->user = $this->getUser();
    }





    /*
	* Asigna un milestone a un ticket
	* @author: Andres Botero
	*/
    public function executeAsignarMilestone( $request ){

        $this->forward404Unless( $request->getParameter("idmilestone") );
        $this->forward404Unless( $request->getParameter("idticket") );

        $idmilestone = $request->getParameter("idmilestone");
        $idticket = $request->getParameter("idticket");

        $milestone = Doctrine::getTable("HdeskMilestone")->find( $idmilestone );
        $ticket = Doctrine::getTable("HdeskTicket")->find( $idticket );

        $this->forward404Unless( $milestone );
        $this->forward404Unless( $ticket );

        $ticket->setCaIdmilestone( $milestone->getCaIdmilestone() );
        $ticket->save();


        $this->responseArray = array("success"=>true, 
                                     "id"=>$request->getParameter("id"), 
                                     "idmilestone"=>$milestone->getCaIdmilestone(),
                                     "milestone"=>$milestone->getCaTitle()." ".Utils::fechaMes( $milestone->getCaDue() ),
                                     "due"=>$milestone->getCaDue(),
                                     "due_timestamp"=>strtotime($milestone->getCaDue())
                                    );
        $this->setTemplate("responseTemplate");

    }

    /*
	* Asigna un milestone a un ticket
	* @author: Andres Botero
	*/
    public function executeActualizarPorcentajeTicket( $request ){

        $this->forward404Unless( $request->getParameter("idticket") );
        $this->forward404Unless( $request->getParameter("percentage")!==null );
        $idticket = $request->getParameter("idticket");
        
        $ticket = Doctrine::getTable("HdeskTicket")->find( $idticket );
        $this->forward404Unless( $ticket );

        $ticket->setCaPercentage( $request->getParameter("percentage")  );
        $ticket->save();

        $this->responseArray = array("success"=>true);
        $this->setTemplate("responseTemplate");
    }


     /*
	* Panel que muestra un arbol con opciones de busqueda
	* @author: Andres Botero
	*/
    public function executeDatosTicket( $request ){

        $this->forward404Unless( $request->getParameter("idticket") );        
        $idticket = $request->getParameter("idticket");
        $ticket = Doctrine::getTable("HdeskTicket")->find( $idticket );
        $this->forward404Unless( $ticket );


        $group = $ticket->getHdeskGroup();
        
        $data = array();

        $data["iddepartament"] = $group->getCaIddepartament();
        $data["departamento"] = $group->getDepartamento()->getCaNombre();
        $data["idticket"] = $ticket->getCaIdticket();
        $data["title"] = utf8_encode($ticket->getCaTitle());
        $data["text"] = utf8_encode($ticket->getCaText());
        $data["idgroup"] = $ticket->getCaIdgroup();
        $data["group"] = utf8_encode($group->getCaName());
        $data["idproject"] = $ticket->getCaIdproject();
        $data["project"] = utf8_encode($ticket->getHdeskProject()->getCaName());
        $data["loginName"] = utf8_encode($ticket->getReportedBy()->getCaNombre());
        $data["login"] = $ticket->getCaLogin();
        $data["priority"] = $ticket->getCaPriority();
        $data["opened"] = $ticket->getCaOpened();
        $data["type"] = $ticket->getCaType();
        $data["assignedto"] = $ticket->getCaAssignedto();
        $data["action"] = $ticket->getCaAction();
        $data["idmilestone"] = $ticket->getCaIdmilestone();
        $data["percentage"] = $ticket->getCaPercentage();


        $this->responseArray = array("success"=>true, "data"=>$data);
        $this->setTemplate("responseTemplate");
    }


    /*
	* Panel que muestra un arbol con opciones de busqueda
	* @author: Andres Botero
	*/
    public function executeDatosUsuarioTicket( $request ){

        $this->forward404Unless( $request->getParameter("idticket") );
        $idticket = $request->getParameter("idticket");


        $usuarios = Doctrine::getTable("Usuario")->createQuery("u")
                    ->innerJoin("u.HdeskTicketUser ug")
                    ->where("ug.ca_idticket = ?", $idticket)
                    ->addOrderBy("u.ca_nombre")
                    ->execute();



        $data = array();

        foreach( $usuarios as $usuario ){
            $row = array();
            $row["login"]=$usuario->getCaLogin();
            $row["name"]=$usuario->getCaNombre();           
            $row["icon"]=$usuario->getImagenUrl("60x80");           
            $data[] = $row;
        }


        $this->responseArray = array("success"=>true, "root"=>$data);
        $this->setTemplate("responseTemplate");
    }


    /*
	* Panel que muestra un arbol con opciones de busqueda
	* @author: Andres Botero
	*/
    public function executeCalendar( $request ){
    

       

    }

    /*
	* Panel que muestra un arbol con opciones de busqueda
	* @author: Andres Botero
	*/
    public function executeDatosPanelCalendar( $request ){


        $q = Doctrine::getTable("HdeskMilestone")
                       ->createQuery("m");

        $milestones = $q->execute();

        $data = array();
        foreach( $milestones as $milestone ){
            $row = array();
            $row["idmilestone"] = $milestone->getCaIdmilestone();
            $row["title"] = $milestone->getCaTitle();
            $data[] = $row;
        }

        $this->responseArray = array("success"=>true, "root"=>$data);
        $this->setTemplate("responseTemplate");

    }


    /*
	*
    *
	* @author: Andres Botero
	*/
    public function executeDatosPanelBusquedaTicket( $request ){
        $data = array();


        $option = $request->getParameter("option");
        $query = $request->getParameter("query");


        $q = Doctrine::getTable("HdeskResponse")
                            ->createQuery("r")
                            ->innerJoin("r.HdeskTicket t")
                            ->innerJoin("t.HdeskGroup g")
                            ->select("r.ca_text, t.ca_idticket, t.ca_title, r.ca_createdat, r.ca_login, g.ca_name")                            
                            ->orderBy("r.ca_createdat DESC")
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                            ->limit(100);


         switch( $option ){
             case "idticket":
                 $q->addWhere("t.ca_idticket = ?", intval($query));
                 break;
             case "texto":
                 $q->addWhere("LOWER(t.ca_title) LIKE ? OR LOWER(t.ca_text) LIKE ? OR LOWER(r.ca_text) LIKE ?", array("%".strtolower($query)."%","%".strtolower($query)."%","%".strtolower($query)."%"));
                 break;
             case "reportedBy":
                 $q->innerJoin("t.Usuario u");
                 $q->addWhere("LOWER(u.ca_nombre) LIKE ? OR LOWER(u.ca_login) LIKE ?", array("%".strtolower($query)."%","%".strtolower($query)."%"));
                 break;
             default:
                 $q->addWhere("g.ca_iddepartament = 13"); //Eventos de sistemas
                 break;
         }
                 
        $results = $q->execute();

        $lastDate = null;
        foreach( $results as $result ){
            $row = array();
            $row["idticket"] = $result["t_ca_idticket"];
            $row["text"] = utf8_encode($result["r_ca_text"]);
            $row["idticket"] = $result["t_ca_idticket"];
            $row["fchevento"] = $result["r_ca_createdat"];
            $row["title"] = utf8_encode($result["t_ca_title"]);
            $row["login"] = $result["r_ca_login"];
            $row["group"] = utf8_encode($result["g_ca_name"]);
           
            $data[  ] = $row;

            $lastDate = $result["r_ca_createdat"];
        }

        //Muestra eventos abrio y cerro ticket
        if( !$query ){

            $q = Doctrine::getTable("HdeskTicket")
                                ->createQuery("t")
                                ->innerJoin("t.HdeskGroup g")
                                ->select("t.ca_idticket, t.ca_title, t.ca_opened, t.ca_login, g.ca_name")
                                ->orderBy("t.ca_opened DESC")
                                ->addWhere("g.ca_iddepartament = 13")
                                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

            if( $lastDate ){
                $time = strtotime($lastDate);
                $lastDate = date("Y-m-d H:i:s", $time-86400);
                $q->addWhere("t.ca_opened>=?", $lastDate);
            }

            $results = $q->execute();

            foreach( $results as $result ){
                $row = array();
                $row["idticket"] = $result["t_ca_idticket"];
                $row["text"] = utf8_encode("Se abrió el ticket");
                $row["idticket"] = $result["t_ca_idticket"];
                $row["fchevento"] = $result["t_ca_opened"];
                $row["title"] = utf8_encode($result["t_ca_title"]);
                $row["login"] = $result["t_ca_login"];
                $row["group"] = utf8_encode($result["g_ca_name"]);
                $row["color"] = "yellow";
                $data[  ] = $row;
            }

        }
        $this->responseArray = array("success"=>true, "root"=>$data);
        $this->setTemplate("responseTemplate");
    }
}


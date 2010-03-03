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
    const RUTINA = "39";

    public function getNivel(){
        $this->nivel = $this->getUser()->getNivelAcceso( pmActions::RUTINA );
		if( !$this->nivel ){
			$this->nivel = 0;
		}

        return $this->nivel;
    }

	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request){



		$nivel = $this->getNivel( );
		$opcion = $request->getParameter("opcion");
		$criterio = $request->getParameter("criterio");


		$this->nivel = $this->getNivel();


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


        if( $request->getParameter("assignedto") ){
            $q->addWhere("h.ca_assignedto = ? ", $request->getParameter("assignedto") );
        }

        if( $request->getParameter("reportedby") ){

            $q->addWhere("(h.ca_login = ? or hu.ca_login = ?)", array($request->getParameter("reportedby"),$request->getParameter("reportedby")) );
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
			case 2:
                $q->addWhere("(h.ca_login = ? OR g.ca_iddepartament = ?)", array($this->getUser()->getUserid(), $this->getUser()->getIddepartamento() ) );
				break;
		}


		$q->distinct();
        //exit($q->getSqlQuery());
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $q->limit(120);
		$tickets = $q->execute();

        foreach( $tickets as $key=>$val){
            $tickets[$key]["milestone"]=utf8_encode($tickets[$key]["m_ca_title"]." ".Utils::fechaMes($tickets[$key]["m_ca_due"]));
            $tickets[$key]["h_ca_title"]=utf8_encode($tickets[$key]["h_ca_title"]);
            $tickets[$key]["h_ca_text"]=utf8_encode($tickets[$key]["h_ca_text"]);
            $tickets[$key]["p_ca_name"]=$tickets[$key]["p_ca_name"]?utf8_encode($tickets[$key]["p_ca_name"]):"Sin proyecto";
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


		$response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/RowExpander",'last');

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


        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/FileUploadField",'last');

	}

	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeGuardarRespuestaTicket(sfWebRequest $request){

        $this->nivel = $this->getNivel();
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

        if( $request->getParameter("idmilestone") ){
			$ticket->setCaIdmilestone( $request->getParameter("idmilestone") );
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
			$tarea->setCaUrl( "/pm/verTicket?id=".$ticket->getCaIdticket() );
			$tarea->setCaIdlistatarea( 1 );
			$tarea->setCaFchcreado( date("Y-m-d h:i:s") );

			$tarea->setTiempo( Utils::getFestivos(), $grupo->getCaMaxresponsetime() );

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

		$this->redirect("pm/verTicket?id=".$ticket->getCaIdticket());
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
		$this->redirect("pm/verTicket?id=".$request->getParameter("id"));

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
		$this->redirect("pm/verTicket?id=".$request->getParameter("id"));

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
                $this->redirect("pm/verTicket?id=".$this->ticket->getCaIdticket() );

            }
        }

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
        $idticket = $request->getParameter("id");
        $this->ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel );


         $usuario = Doctrine::getTable("HdeskTicketUser")->createQuery("ug")
                    ->where("ug.ca_idticket = ?",$this->ticket->getCaIdticket())
                    ->addWhere("ug.ca_login = ?", $request->getParameter("usuario") )
                    ->fetchOne();
         if( $usuario ){
            $usuario->delete();
         }
         $this->redirect("pm/verTicket?id=".$this->ticket->getCaIdticket() );
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

}

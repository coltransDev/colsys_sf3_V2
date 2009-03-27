<?php

/**
 * helpdesk actions.
 *
 * @package    colsys
 * @subpackage helpdesk
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
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
		$c = new Criteria();
		$c->add(DepartamentoPeer::CA_INHELPDESK, true);
		$departamentos = DepartamentoPeer::doSelect( $c );
		
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
		
		$opcion = $request->getParameter("opcion");
		$criterio = $request->getParameter("criterio");
				
		switch($opcion){
			case "numero":
				if( intval($criterio) ){					
					$ticket = HdeskTicketPeer::retrieveByPk( intval($criterio) );	
					if( $ticket ){
						$this->redirect( "helpdesk/verTicket?id=".$ticket->getCaIdticket() );
					}
				}
				$this->tickets = array();
				break;				
			case "criterio":
				$c = new Criteria();
				$criterion = $c->getNewCriterion( HdeskTicketPeer::CA_TITLE , "LOWER(".HdeskTicketPeer::CA_TITLE.") LIKE '%". strtolower($criterio)."%'", Criteria::CUSTOM );								
				$criterion->addOr($c->getNewCriterion( HdeskTicketPeer::CA_TEXT , "LOWER(".HdeskTicketPeer::CA_TEXT.") LIKE '%". strtolower($criterio)."%'", Criteria::CUSTOM ));			
				$c->add($criterion);			
				$this->tickets = HdeskTicketPeer::doSelect( $c );
				break;	
			case "personalizada":
				$c = new Criteria();
				
				if( $request->getParameter("departamento") ){
					$c->addJoin( HdeskTicketPeer::CA_IDGROUP, HdeskGroupPeer::CA_IDGROUP );	
					$c->add( HdeskGroupPeer::CA_IDDEPARTAMENT, $request->getParameter("departamento") );					
				}
				
				if( $request->getParameter("area") ){						
					$c->add( HdeskTicketPeer::CA_IDGROUP, $request->getParameter("area") );					
				}
				
				if( $request->getParameter("project") ){						
					$c->add( HdeskTicketPeer::CA_IDPROJECT, $request->getParameter("project") );					
				}
				
				if( $request->getParameter("priority") ){						
					$c->add( HdeskTicketPeer::CA_PRIORITY, $request->getParameter("priority") );					
				}
				
				if( $request->getParameter("actionTicket") ){						
					$c->add( HdeskTicketPeer::CA_ACTION, $request->getParameter("actionTicket") );					
				}
				
				if( $request->getParameter("type") ){						
					$c->add( HdeskTicketPeer::CA_TYPE, $request->getParameter("type") );					
				}	
				
				
				if( $request->getParameter("assignedto") ){						
					$c->add( HdeskTicketPeer::CA_ASSIGNEDTO, $request->getParameter("assignedto") );					
				}	
				
				if( $request->getParameter("reportedby") ){						
					$c->add( HdeskTicketPeer::CA_LOGIN, $request->getParameter("reportedby") );					
				}
				
				$c->addAscendingOrderByColumn( HdeskTicketPeer::CA_IDGROUP );
				$c->addAscendingOrderByColumn( HdeskTicketPeer::CA_ACTION );
				$c->addDescendingOrderByColumn( HdeskTicketPeer::CA_OPENED );							
				$this->tickets = HdeskTicketPeer::doSelect( $c );
				break;
			
			case "group":
				$c = new Criteria();
				$c->addJoin( HdeskTicketPeer::CA_IDGROUP, HdeskUserGroupPeer::CA_IDGROUP);
				$c->add( HdeskUserGroupPeer::CA_LOGIN, $this->getUser()->getUserId() ); 
				if( $request->getParameter("assigned") ){ 
					if( $request->getParameter("assigned")=="true"){
						$c->add( HdeskTicketPeer::CA_ASSIGNEDTO, null , Criteria::ISNOTNULL );
					}else{
						$c->add( HdeskTicketPeer::CA_ASSIGNEDTO, null , Criteria::ISNULL );
					}
				}
				
				$c->add( HdeskTicketPeer::CA_ACTION, "Abierto" );
				
				$c->addAscendingOrderByColumn( HdeskTicketPeer::CA_IDGROUP );				
				$c->addDescendingOrderByColumn( HdeskTicketPeer::CA_OPENED );	
				$this->tickets = HdeskTicketPeer::doSelect( $c );
				break;
		}
		$this->nivel = $this->getUser()->getNivelAcceso( helpdeskActions::RUTINA );
	}
	
	/**
	* Vista previa de un ticket y permite adicionar respuestas
	*
	* @param sfRequest $request A request object
	*/
	public function executeVerTicket(sfWebRequest $request){

		$this->ticket = HdeskTicketPeer::retrieveByPk( $request->getParameter("id") );
		
		$this->forward404Unless( $this->ticket );
		
		$this->nivel = $this->getUser()->getNivelAcceso( helpdeskActions::RUTINA );		
		$this->iddepartamento = $this->getUser()->getIddepartamento();	
		
		$this->nivel = $this->getUser()->getNivelAcceso( helpdeskActions::RUTINA );		
		$this->iddepartamento = $this->getUser()->getIddepartamento();	
		
		if( !$this->nivel ){
			$this->nivel = 0;
		}
						
		if( $request->getParameter("format")=="email" ){
			$this->setTemplate("verTicketEmail");
			$this->setLayout("none");
		}
		
		
	}
	
	/**
	* Formulario para crear un n uevo ticket
	*
	* @param sfRequest $request A request object
	*/
	public function executeCrearTicket( sfWebRequest $request ){
		$this->ticket = HdeskTicketPeer::retrieveByPk( $request->getParameter("id") );
		
		if( !$this->ticket ){
			$this->ticket = new HdeskTicket();
		}
		
		$c = new Criteria();
		$c->add(DepartamentoPeer::CA_INHELPDESK, true);
		$departamentos = DepartamentoPeer::doSelect( $c );
		
		$this->departamentos = array();
		
		foreach( $departamentos as $departamento ){
			$this->departamentos[] = array("iddepartamento"=>$departamento->getCaIddepartamento(), 
										 "nombre"=>$departamento->getCaNombre()
										);		
		}
		
		$this->nivel = $this->getUser()->getNivelAcceso( helpdeskActions::RUTINA );		
		$this->iddepartamento = $this->getUser()->getIddepartamento();
				
		if( !$this->nivel ){
			$this->nivel = 0;
		}
	}
	
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeGuardarRespuestaTicket(sfWebRequest $request){
		
		$ticket = HdeskTicketPeer::retrieveByPk( $request->getParameter("idticket") );
		
		$user = $this->getUser();
		
		$respuesta = new HdeskResponse();
		$respuesta->setCaIdTicket( $request->getParameter("idticket") );
		$respuesta->setCaText( utf8_decode($request->getParameter("comentario")) );
		$respuesta->setCaLogin( $user->getUserId() );
		$respuesta->setCaCreatedat( time() );
		$respuesta->save();
		
		$logins = array( $ticket->getCaLogin() );
		if( $ticket->getCaAssignedto() ){
			$logins[]=$ticket->getCaAssignedto();
		}else{
			$c = new Criteria();		
			$c->add( HdeskUserGroupPeer::CA_IDGROUP, $ticket->getCaIdgroup() );
			$c->addAscendingOrderByColumn( HdeskUserGroupPeer::CA_LOGIN);
			$usuarios = HdeskUserGroupPeer::doSelect( $c );		
			foreach( $usuarios as $usuario ){
				$logins[]=$usuario->getCaLogin();
			}
		}
				
		if( $ticket->getCaAssignedto()==$this->getUser()->getUserId() || in_array($this->getUser()->getUserId(),$logins ) ){
			$ticket->setCaResponsetime( time() );
			$ticket->save();
		}
		
		
		if( $k=array_search( $this->getUser()->getUserId(), $logins)!==false ){
			unset($logins[$k]);
		}
		
		$logins = array_unique( $logins );		
		foreach( $logins as $login ){
			$notificacion = new Notificacion();
			$notificacion->setCaLogin( $login );
			$notificacion->setCaUrl( "helpdesk/verTicket?id=".$ticket->getCaIdticket() );
			$notificacion->setCaFchcreado( time() );
			$notificacion->setCaUsucreado( $this->getUser()->getUserId() );
			
			$request->setParameter("id", $ticket->getCaIdticket() );
			$request->setParameter("format", "email" );
			
			$notificacion->setCaTitulo( "Se ha creado una respuesta Ticket #".$ticket->getCaIdticket() );
			$texto = "Se ha creado una respuesta \n\n<br /><br />" ;
			
			$texto.= sfContext::getInstance()->getController()->getPresentationFor( 'helpdesk', 'verTicket');
			
			$notificacion->setCaTexto( $texto );
			$notificacion->save();	
		}
		
		$this->ticket = $ticket;
		$this->setLayout("ajax");		
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
			$c = new Criteria();		
			$c->add( HdeskGroupPeer::CA_IDDEPARTAMENT, $departamento );
			$grupos = HdeskGroupPeer::doSelect( $c );			
			foreach( $grupos as $grupo ){
				$gruposArray[] = array("idgrupo"=>$grupo->getCaIdgroup(), "nombre"=>utf8_encode($grupo->getCaname()));
			}
		}		
		
		$this->responseArray = array("grupos"=>$gruposArray, "success"=>true);	
		$this->setTemplate("responseTemplate");		
		$this->setLayout("ajax");
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
			$c = new Criteria();		
			$c->add( HdeskProjectPeer::CA_IDGROUP, $idgrupo );
			$proyectos = HdeskProjectPeer::doSelect( $c );			
			foreach( $proyectos as $proyecto ){
				$proyectosArray[] = array("idproyecto"=>$proyecto->getCaIdproject(), "nombre"=>utf8_encode($proyecto->getCaname()));
			}
		}		
		
		$this->responseArray = array("proyectos"=>$proyectosArray, "success"=>true);	
		$this->setTemplate("responseTemplate");		
		$this->setLayout("ajax");
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
			$c = new Criteria();		
			$c->add( HdeskUserGroupPeer::CA_IDGROUP, $idgrupo );
			$c->addAscendingOrderByColumn( HdeskUserGroupPeer::CA_LOGIN);
			$usuarios = HdeskUserGroupPeer::doSelect( $c );			
			foreach( $usuarios as $usuario ){
				$usuariosArray[] = array("login"=>$usuario->getCaLogin());
			}
		}		
		
		$this->responseArray = array("usuarios"=>$usuariosArray, "success"=>true);	
		$this->setTemplate("responseTemplate");		
		$this->setLayout("ajax");
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
			$ticket = HdeskTicketPeer::retrieveByPk( $request->getParameter("idticket") );
			$update = true;
		}else{
			$ticket = new HdeskTicket();
			$ticket->setCaLogin( $user->getUserId() );
			$ticket->setCaOpened( time() );	
		}
			
		$ticket->setCaIdgroup( $request->getParameter("area") );
		$ticket->setCaIdProject( $request->getParameter("project") );
		$ticket->setCaTitle( utf8_decode($request->getParameter("title")) );
		$ticket->setCaText( utf8_decode($request->getParameter("text")) );
		
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
		
		
		$ticket->save();
		
		$logins = array( );
		if( $ticket->getCaAssignedto() ){
			$logins[]=$ticket->getCaAssignedto();
		}else{
			$c = new Criteria();		
			$c->add( HdeskUserGroupPeer::CA_IDGROUP, $ticket->getCaIdgroup() );
			$c->addAscendingOrderByColumn( HdeskUserGroupPeer::CA_LOGIN);
			$usuarios = HdeskUserGroupPeer::doSelect( $c );		
			foreach( $usuarios as $usuario ){
				$logins[]=$usuario->getCaLogin();
			}
		}
		
		if( $k=array_search( $this->getUser()->getUserId(), $logins)!==false ){
			unset($logins[$k]);
		}
		
		$logins = array_unique( $logins );
		foreach( $logins as $login ){ 
			$notificacion = new Notificacion();
			$notificacion->setCaLogin( $login );
			$notificacion->setCaUrl( "helpdesk/verTicket?id=".$ticket->getCaIdticket() );
			$notificacion->setCaFchcreado( time() );
			$notificacion->setCaUsucreado( $this->getUser()->getUserId() );
			
			$request->setParameter("id", $ticket->getCaIdticket() );
			$request->setParameter("format", "email" );
			
			if( !$update ){
				$notificacion->setCaTitulo( "Nuevo ticket #".$ticket->getCaIdticket() );
				
				$texto = "Se ha creado un nuevo ticket \n\n<br /><br />" ;
			}else{
			
				$notificacion->setCaTitulo( "Se ha editado el ticket #".$ticket->getCaIdticket() );
				$texto = "Se ha editado el ticket \n\n<br /><br />" ;
			}
			
			$texto.= sfContext::getInstance()->getController()->getPresentationFor( 'helpdesk', 'verTicket');			
			$notificacion->setCaTexto( $texto );
			$notificacion->save();		
		}
		
		
		$this->responseArray = array("idticket"=>$ticket->getCaIdticket(), "success"=>true);	
		$this->setTemplate("responseTemplate");		
		$this->setLayout("ajax");
	
	}
	
	
	/**
	* Toma asignacion de un ticket 
	*
	* @param sfRequest $request A request object
	*/
	public function executeTomarAsignacion(sfWebRequest $request){
		if( $request->getParameter("id") ){
			$ticket = HdeskTicketPeer::retrieveByPk( $request->getParameter("id") );
			$ticket->setCaAssignedto( $this->getUser()->getUserId() );
			$ticket->save();
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
			$ticket = HdeskTicketPeer::retrieveByPk( $request->getParameter("id") );
			$ticket->setCaAction( "Cerrado" );
			$ticket->save();
		}
		$this->redirect("helpdesk/verTicket?id=".$request->getParameter("id"));
		
	}
	
	
	public function executeLastPosts()
	{
	
	  //error_reporting( E_ERROR );
      	
	  $feed = new sfRss201Feed();
	
	  $feed->initialize(array(
		'title'       => 'Tickets disponibles',
		'link'        => 'http://www.internetnews.com',
		'authorEmail' => 'pclive@myblog.com',
		'authorName'  => 'Peter Clive',
		'description' => "aasdasdalkjalkjdalskjdaljdaljdalkjdalkjdaasdkjaljd",
		'language' => 'en-us'
	  ));
		/*
	  $c = new Criteria;
	  $c->addDescendingOrderByColumn(PostPeer::CREATED_AT);
	  $c->setLimit(5);
	  $posts = PostPeer::doSelect($c);
	
	  foreach ($posts as $post)
	  {*/
		$item = new sfFeedItem();
		$item->initialize(array(
		  'title'       => "Titulo",
		  'link'        => 'helpdesk/verTicket',
		  //'authorName'  => 'Andres',
		  //'authorEmail' => 'abotero@coltrans.com.co',
		  //'pubDate'     => time(),
		  //'uniqueId'    => "helpdesk/verTicket",
		  'description' => "aasdasdalkjalkjdalskjdaljdaljdalkjdalkjdaasdkjaljd",
		   'comments' => "aasdasda",
		));
	
		$feed->addItem($item);
		
		
		
	
		$feed->addItem($item);
	  //}
	  sfConfig::set('sf_web_debug', false) ;
	 // $this->setLayout("none");	
	  $this->feed = $feed;
	}

}
?>
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
	const RUTINA = "0500600000";
			
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
		
		$this->ticket = HdeskTicketPeer::retrieveByPk( $request->getParameter("idticket") );
		
		$user = $this->getUser();
		
		$respuesta = new HdeskResponse();
		$respuesta->setCaIdTicket( $request->getParameter("idticket") );
		$respuesta->setCaText( $request->getParameter("comentario") );
		$respuesta->setCaLogin( $user->getUserId() );
		$respuesta->setCaCreatedat( time() );
		$respuesta->save();
		
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
		
		$user = $this->getUser();
		if( $request->getParameter("idticket") ){
			$ticket = HdeskTicketPeer::retrieveByPk( $request->getParameter("idticket") );
		}else{
			$ticket = new HdeskTicket();	
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
		
		$ticket->setCaLogin( $user->getUserId() );
		$ticket->setCaOpened( time() );
		$ticket->save();
		
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
	
	
	
}
?>
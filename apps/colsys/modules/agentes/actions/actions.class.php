<?php

/**
 * agentes actions.
 *
 * @package    colsys
 * @subpackage agentes
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class agentesActions extends sfActions
{	
	const RUTINA = 8;
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request){		
		$this->nivel = $this->getUser()->getNivelAcceso( agentesActions::RUTINA );
		
		if( $this->nivel==-1 ){
			$this->forward404();
		}	
		
		$c = new Criteria();		
		$c->add( TraficoPeer::CA_IDTRAFICO, '99-999', Criteria::NOT_EQUAL );		
		$c->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
		$this->traficos = TraficoPeer::doSelect( $c );
		
		
	}
	
	/**
	* Muestra la lista de los agentes del trafico seleccionado
	*
	* @param sfRequest $request A request object
	*/
	public function executeConsultarAgentes(sfWebRequest $request){
	
		$this->nivel = $this->getUser()->getNivelAcceso( agentesActions::RUTINA );
		
		if( $this->nivel==-1 ){
			$this->forward404();
		}	
		
		$c = new Criteria();	
		$c->addJoin( AgentePeer::CA_IDCIUDAD,  CiudadPeer::CA_IDCIUDAD );
		$c->addJoin( CiudadPeer::CA_IDTRAFICO ,TraficoPeer::CA_IDTRAFICO );
		
		if( $request->getParameter("idtrafico") ){
			$c->add( TraficoPeer::CA_IDTRAFICO, $request->getParameter("idtrafico") );
		}
		
		if( $request->getParameter("buscar") ){
			$c->add( AgentePeer::CA_NOMBRE, "%".trim(strtoupper($request->getParameter("buscar")))."%", Criteria::LIKE );
		}
		
		$c->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
		$c->addDescendingOrderByColumn( AgentePeer::CA_ACTIVO );		
		$c->addAscendingOrderByColumn( AgentePeer::CA_NOMBRE );
		$this->agentes = AgentePeer::doSelect( $c );
	}
	
	/**
	* Permite editar un agente
	*
	* @param sfRequest $request A request object
	*/
	public function executeFormAgentes(sfWebRequest $request){
	
		$this->nivel = $this->getUser()->getNivelAcceso( agentesActions::RUTINA );
		
		if( $this->nivel<=0 ){
			$this->forward404();
		}	
		
		$this->agente = AgentePeer::retrieveByPk( $request->getParameter("idagente") );
		
		$this->form = new NuevoAgenteForm();
		
		if ($request->isMethod('post')){		
			$bindValues = array();
			
			$bindValues["idagente"] = $request->getParameter("idagente");
			$bindValues["nombre"] = $request->getParameter("nombre");
			$bindValues["direccion"] = $request->getParameter("direccion");
			$bindValues["idciudad"] = $request->getParameter("idciudad");
			$bindValues["telefonos"] = $request->getParameter("telefonos");
			$bindValues["fax"] = $request->getParameter("fax");
			$bindValues["website"] = $request->getParameter("website");
			$bindValues["email"] = $request->getParameter("email");
			$bindValues["zipcode"] = $request->getParameter("zipcode");
			$bindValues["tipo"] = $request->getParameter("tipo");
			$bindValues["activo"] = $request->getParameter("activo");
			
			$this->form->bind( $bindValues ); 
			if( $this->form->isValid() ){
				if( $bindValues["idagente"] ){					
					$agente = AgentePeer::retrieveByPk( $bindValues["idagente"] );
					$agente->setCaFchactualizado(time());
					$agente->setCaUsuactualizado($this->getUser()->getUserId());
				}else{
					$agente = new Agente();
					$agente->setCaFchcreado(time());
					$agente->setCaUsucreado($this->getUser()->getUserId());
				}
				
				$agente->setCaNombre( strtoupper( $bindValues["nombre"] ));
				$agente->setCaDireccion( $bindValues["direccion"] );			
				$agente->setCaIdciudad( $bindValues["idciudad"] );
				$agente->setCaTelefonos( $bindValues["telefonos"] );
				$agente->setCaFax( $bindValues["fax"] );
				$agente->setCaWebsite( $bindValues["website"] );
				$agente->setCaEmail( $bindValues["email"] );
				$agente->setCaZipcode( $bindValues["zipcode"] );
				$agente->setCaTipo( $bindValues["tipo"] );
				if( $bindValues["activo"] ){
					$agente->setCaActivo( true );
				}else{
					$agente->setCaActivo( false );
				}
				$agente->save();
				
				$this->redirect("agentes/consultarAgentes?buscar=".strtoupper($bindValues["nombre"]) );
			}				
		}
	}
	
	public function executeFormContactos( $request ){
		$this->nivel = $this->getUser()->getNivelAcceso( agentesActions::RUTINA );
		
		if( $this->nivel<=0 ){
			$this->forward404();
		}	
		
		$this->agente = AgentePeer::retrieveByPk( $request->getParameter("idagente") );
		$this->forward404Unless( $this->agente );
		$this->contacto = ContactoAgentePeer::retrieveByPk( $request->getParameter("idcontacto") );
		
		$this->form = new NuevoContactoForm();
		
		if ($request->isMethod('post')){
			$bindValues = array();
					
			$bindValues["idcontacto"] = $request->getParameter("idcontacto");
			$bindValues["idagente"] = $request->getParameter("idagente");
			$bindValues["nombre"] = $request->getParameter("nombre");
			$bindValues["apellido"] = $request->getParameter("apellido");
			$bindValues["direccion"] = $request->getParameter("direccion");
			$bindValues["idciudad"] = $request->getParameter("idciudad");
			$bindValues["telefonos"] = $request->getParameter("telefonos");
			$bindValues["fax"] = $request->getParameter("fax");		
			$bindValues["email"] = $request->getParameter("email");						
			$bindValues["cargo"] = $request->getParameter("cargo");
			$bindValues["sugerido"] = $request->getParameter("sugerido");
			$bindValues["activo"] = $request->getParameter("activo");
			
			$bindValues["impoexpo"] =  $request->getParameter("impoexpo");
			$bindValues["transporte"] = $request->getParameter("transporte");
			$this->form->bind( $bindValues ); 
			if( $this->form->isValid() ){
				if( $bindValues["idcontacto"] ){					
					$contacto = ContactoAgentePeer::retrieveByPk( $bindValues["idcontacto"] );
					$contacto->setCaFchactualizado(time());
					$contacto->setCaUsuactualizado($this->getUser()->getUserId());
				}else{
					$idcontacto = substr(strtoupper( trim($bindValues["nombre"])),0,3).substr(strtoupper( trim($bindValues["apellido"])),0,3).substr( $this->agente->getCaIdAgente(), -3, 3 ) ;					
					$contacto = new ContactoAgente();
					$contacto->setCaIdcontacto( $idcontacto );
					$contacto->setCaIdagente( $this->agente->getCaIdAgente() );
					$contacto->setCaFchcreado(time());
					$contacto->setCaUsucreado($this->getUser()->getUserId());
				}
				
				$contacto->setCaNombre( ucfirst( trim($bindValues["nombre"]) ));
				$contacto->setCaApellido( ucfirst( trim($bindValues["apellido"]) ));
				$contacto->setCaDireccion( trim($bindValues["direccion"]) );			
				$contacto->setCaIdciudad( $bindValues["idciudad"] );
				$contacto->setCaTelefonos( $bindValues["telefonos"] );
				$contacto->setCaFax( $bindValues["fax"] );				
				$contacto->setCaEmail( $bindValues["email"] );				
				$contacto->setCaImpoexpo( implode("|",$bindValues["impoexpo"]) );
				$contacto->setCaTransporte( implode("|",$bindValues["transporte"]) );
				$contacto->setCaCargo( $bindValues["cargo"] );
				if( $bindValues["sugerido"] ){
					$contacto->setCaSugerido( true );
				}else{
					$contacto->setCaSugerido( false );
				}
				
				if( $bindValues["activo"] ){
					$contacto->setCaActivo( true );
				}else{
					$contacto->setCaActivo( false );
				}
				$contacto->save();
				
				$this->redirect("agentes/consultarAgentes?buscar=".$this->agente->getCaNombre() );
				
				
			}
		}
	}
	
	
}
?>
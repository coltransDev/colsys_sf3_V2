<?php

class HdeskTicket extends BaseHdeskTicket
{
	/*
	* 
	*/
	public function getAssignedUser(){
		if( $this->getCaAssignedto() ){
			return UsuarioPeer::retrieveByPk( $this->getCaAssignedto() );
		}
		return  null;		
	}
	
	/*
	*  Retorna un array con los logins del grupo
	*/	
	public function getLoginsGroup(){
		$loginsAsignaciones = array( );
		if( $this->getCaAssignedto() ){
			$loginsAsignaciones[]=$this->getCaAssignedto();
		}else{
			$c = new Criteria();		
			$c->add( HdeskUserGroupPeer::CA_IDGROUP, $this->getCaIdgroup() );
			$c->addAscendingOrderByColumn( HdeskUserGroupPeer::CA_LOGIN);
			$usuarios = HdeskUserGroupPeer::doSelect( $c );		
			foreach( $usuarios as $usuario ){
				$loginsAsignaciones[]=$usuario->getCaLogin();
			}
		}
		return array_unique( $loginsAsignaciones );
	}
	
	public function getLastResponse(){
		$c = new Criteria();
		$c->add( HdeskResponsePeer::CA_IDTICKET, $this->getCaIdticket() );
		$c->addDescendingOrderByColumn( HdeskResponsePeer::CA_CREATEDAT );
		return HdeskResponsePeer::doSelectOne( $c );
	}
	
	
	public function getTareaSeguimiento(){
				
		$tarea=null;
		if( $this->getCaIdseguimiento() ){
			$tarea = NotTareaPeer::retrieveByPk( $this->getCaIdseguimiento() );
		}		
		return $tarea;
	}
	
	public function getTareaIdg(){
		
		$tarea=null;
		if( $this->getCaIdtarea() ){
			$tarea = NotTareaPeer::retrieveByPk( $this->getCaIdtarea() );			
		}		
		return $tarea;
	}
	
	
	
}
?>
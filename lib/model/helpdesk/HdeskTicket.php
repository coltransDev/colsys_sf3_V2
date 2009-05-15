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
		if( $ticket->getCaAssignedto() ){
			$loginsAsignaciones[]=$ticket->getCaAssignedto();
		}else{
			$c = new Criteria();		
			$c->add( HdeskUserGroupPeer::CA_IDGROUP, $ticket->getCaIdgroup() );
			$c->addAscendingOrderByColumn( HdeskUserGroupPeer::CA_LOGIN);
			$usuarios = HdeskUserGroupPeer::doSelect( $c );		
			foreach( $usuarios as $usuario ){
				$loginsAsignaciones[]=$usuario->getCaLogin();
			}
		}
		return array_unique( $loginsAsignaciones );
	}
	
}
?>
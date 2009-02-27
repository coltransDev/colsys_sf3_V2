<?php

class HdeskTicket extends BaseHdeskTicket
{
	public function getAssignedUser(){
		if( $this->getCaAssignedto() ){
			return UsuarioPeer::retrieveByPk( $this->getCaAssignedto() );
		}
		return  null;		
	}
}
?>
<?php

/**
 * Subclass for representing a row from the 'tb_contactos' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class Contacto extends BaseContacto
{
	public function getNombre(){
		return $this->getCaNombres()." ".$this->getCaPapellido()." ".$this->getCaSapellido();		
	}	
	
	public function getTrackingUser(){
		$c = new Criteria();
		$c->add( TrackingUserPeer::CA_EMAIL, $this->getCaEmail() );
		$user = TrackingUserPeer::doSelectOne( $c );
		return $user;
	}
}
?>
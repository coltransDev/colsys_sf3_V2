<?php

/**
 * Subclass for representing a row from the 'tb_tracking_users' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class TrackingUser extends BaseTrackingUser
{
	/*
	* Guarda la clave del usuario, a partir del codigo de activacion para evitar 
	* que dos columnas tengan el mismo  hash a pesar de que tengan la misma clave
	*/	
	public function setPasswd( $aPasswd ){
		if( $this->getCaActivationCode() ){
			$passwd = sha1( $this->getCaActivationCode().$aPasswd );
			$this->setCaPasswd( $passwd );
		}
	}
	
	/*
	* Genera un codigo de activacion 
	*/	
	public function generateActivationCode(){
		$string = $this->getCaEmail().date("Y-m-d h:i:s").rand(1000 , 10000);
		$code = sha1( $string );		
		$this->setCaActivationCode( $code );
		return $code;
	}
}
?>
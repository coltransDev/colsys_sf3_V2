<?php

/**
 * Subclass for representing a row from the 'control.tb_usuarios' table.
 *
 * 
 *
 * @package lib.model.control
 */ 
class Usuario extends BaseUsuario
{
	public function getFirmaHTML(){
		$resultado = "<strong>".Utils::replace(strtoupper($this->getCaNombre()))."</strong><br />";
		$resultado .= $this->getCaCargo()."- COLTRANS S.A.<br />";		
		$sucursal = $this->getSucursal();
		if( $sucursal ){
			$resultado .= $sucursal->getCaDireccion()."<br />";
			$resultado .= "Tel.: ".$sucursal->getCaTelefono()." ".$this->getCaExtension()."<br />";
			$resultado .= "Fax.: ".$sucursal->getCaFax()."<br />";	
		}
		$resultado .= Utils::replace($sucursal->getCaNombre())."- Colombia<br />";
		$resultado .= "<a href=\"http://www.coltrans.com.co\">http://www.coltrans.com.co</a>";
		return $resultado;
	}
	
	public function getFirma(){
		$resultado = Utils::replace(strtoupper($this->getCaNombre()))."\n";
		$resultado .= $this->getCaCargo()."- COLTRANS S.A.\n";		
		$sucursal = $this->getSucursal();
		if( $sucursal ){
			$resultado .= $sucursal->getCaDireccion()."\n";
			$resultado .= "Tel.: ".$sucursal->getCaTelefono()." ".$this->getCaExtension()."\n";
			$resultado .= "Fax.: ".$sucursal->getCaFax()."\n";	
		}
		$resultado .= $sucursal->getCaNombre()." - Colombia\n";
		$resultado .= "http://www.coltrans.com.co";
		return $resultado;
	}
	
	public function getCaSucursal(){
		return $this->getSucursal()->getCaNombre();
	}
	
	public function setPasswd( $passwd ){
		$salt = hash("md5", uniqid(rand(), true));
		$this->setCaPasswd( sha1( $passwd.$salt ) );
		$this->setCaSalt( $salt );		
				
	}
}

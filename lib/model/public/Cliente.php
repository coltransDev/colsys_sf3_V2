<?php

/**
 * Subclass for representing a row from the 'tb_clientes' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class Cliente extends BaseCliente
{
	public function __toString(){
		return $this->getCaCompania();
	}
	
	
	public function getId(){
		return $this->getCaIdcliente();
	}
	
	public function getContacto(){
		return $this->getCaNombres()." ".$this->getCaPapellido()." ".$this->getCaSapellido();
	}
	
	/*
	* Retorna el objeto Usuario de tipo coordinador asociado al reporte 
	* @author Andres Botero
	*/
	public function getCoordinador(){
		$coordinador = UsuarioPeer::retrieveByPk( $this->getCaCoordinador() );
		return $coordinador;
	}


    public function getDireccion(){

        $direccion = str_replace ("|"," ",$this->getCaDireccion());

        $direccion.=$this->getCaOficina()." ";
        $direccion.=$this->getCaTorre()." ";
        $direccion.=$this->getCaBloque()." ";
        $direccion.=$this->getCaInterior()." ";       
        $direccion.=$this->getCaComplemento()." ";

		return $direccion;
	}
}
?>
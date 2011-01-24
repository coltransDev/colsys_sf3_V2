<?php

/**
 * Cliente
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class Cliente extends BaseCliente
{
    public function __toString(){
		return $this->getCaCompania();
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

    public function getCaCompania(){
        return $this->getIds()->getCaNombre();
    }

    public function getCaDigito(){
        return $this->getIds()->getCaDv();
    }
}
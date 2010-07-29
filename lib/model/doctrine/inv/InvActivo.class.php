<?php

/**
 * InvActivo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class InvActivo extends BaseInvActivo
{
    /*
	* Devuelve la ubicacion del directorio donde se encuentran los archivos de la referencia
	* @author Andres Botero
	*/
	public function getDirectorio(){
		return sfConfig::get("app_digitalFile_root").$this->getDirectorioBase();
	}

    /*
	* Devuelve la ubicacion del directorio donde se encuentran los archivos de la referencia
	* @author Andres Botero
	*/
	public function getDirectorioBase(){
		return "Inventory".DIRECTORY_SEPARATOR.$this->getCaIdactivo().DIRECTORY_SEPARATOR;
	}
}

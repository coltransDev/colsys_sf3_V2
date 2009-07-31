<?php

class IdsDocumento extends BaseIdsDocumento
{
    const FOLDER = "documentos";
    /*
	* Devuelve la ubicacion del directorio donde se encuentran los archivos 
	* @author Andres Botero
	*/
	public function getDirectorio(){
		return sfConfig::get("app_digitalFile_root").Ids::FOLDER.DIRECTORY_SEPARATOR.IdsDocumento::FOLDER.DIRECTORY_SEPARATOR.$this->getCaIdDocumento();
	}

    /*
	* Devuelve la ubicacion del archivo
	* @author Andres Botero
	*/
	public function getArchivo(){
		return  $this->getDirectorio().DIRECTORY_SEPARATOR.$this->getCaUbicacion();
	}

   
}
sfPropelBehavior::add('IdsDocumento', array( 'traceable' ));
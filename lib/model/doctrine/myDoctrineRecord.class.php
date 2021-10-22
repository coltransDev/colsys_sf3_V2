<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * Description of myDoctrineRecordclass
 *
 * @author abotero
 */
class myDoctrineRecord extends sfDoctrineRecord{
    private $stopBlaming = false;

    private $datos = null;

    public function stopBlaming(){
        $this->stopBlaming = true;
    }
  
    public function save(Doctrine_Connection $con = null){
//	if($con==null)
//		$con = Doctrine_Manager::getInstance()->getConnection('master');        
        
        if( !$this->stopBlaming ){
            if ($this->isNew() ){

                if( $this->contains('ca_usucreado') ){
                    //if(sfContext::getinstance()->getUser()->getUserId())
                        $this->setCaUsucreado(sfContext::getinstance()->getUser()->getUserId());
                    /*else
                        $this->setCaUsucreado("Administrador");*/
                }
                if(  $this->contains('ca_fchcreado') ){
                    $this->setCaFchcreado(date('Y-m-d H:i:s'));
                }

            }else{
                if( $this->isModified() ){
                    if( $this->contains('ca_usuactualizado') ){
                        $this->setCaUsuactualizado(sfContext::getinstance()->getUser()->getUserId());
                    }
                    if( $this->contains('ca_fchactualizado') ){
                        $this->setCaFchactualizado(date('Y-m-d H:i:s'));
                    }
                }
            }
        }

        if($this->datos!=null)
        {
            $this->setCaDatos( json_encode($this->datos) );
        }

        $this->stopBlaming = false;
        return parent::save($con);      
    }


    /*
	* Agrega una nueva propiedad en la columna ca_propiedades, según CU059
	* @author: Andres Botero
	*/
	public function setProperty( $param, $value ){
        if( $this->contains('ca_propiedades') ){
            $array = sfToolkit::stringToArray( $this->getCaPropiedades() );
            $array[$param]=$value;
            $str = "";

            foreach( $array as $key=>$value ){
                if($value == "")
                    continue;
                                
                if(strlen($str)>0){
                    $str.=" ";
                }
                $str.=$key."=".$value;
            }
            $this->setCaPropiedades( $str );
        }
	}

	/*
	* Retorna una propiedad
	* @author: Andres Botero
	*/
	public function getProperty( $param ){
		if( $this->contains('ca_propiedades') ){
		    $array = sfToolkit::stringToArray( $this->getCaPropiedades() );
		    return isset($array[$param])?$array[$param]:null;
		}
	}



        private function getDatos( ){
            if($this->datos=="")
                $this->datos= json_decode(utf8_encode($this->getCaDatos()),true);            
        }
        /*$this->getDatos();
	* Agrega una nueva propiedad en la columna ca_propiedades, según CU059
	* @author: Mauricio Quinche
	*/
	public function setDatosJson( $param, $value ){
            if( $this->contains('ca_datos') ){
                $this->getDatos();
                /*if (mb_detect_encoding($value, 'utf-8', true) === false) {
                    $value = mb_convert_encoding($value, 'utf-8', 'iso-8859-1');
                }*/
                $this->datos[$param]=$value;
            }
	}
    
	/*
	* Retorna una propiedad json
	* @author: Mauricio Quinche
	*/
	public function getDatosJson( $param ){
            if( $this->contains('ca_datos') ){
                $this->getDatos();

                return isset($this->datos[$param])?$this->datos[$param]:null;
            }
	}
}
?>

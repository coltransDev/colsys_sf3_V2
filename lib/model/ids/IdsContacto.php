<?php

class IdsContacto extends BaseIdsContacto
{

    public function getNombre(){
        return $this->getCaNombres()." ".$this->getCaPapellido()." ".$this->getCaSapellido();

    }
    
}

sfPropelBehavior::add('IdsContacto', array( 'traceable' ));


<?php

class IdsTipoDocumento extends BaseIdsTipoDocumento
{
    public function __toString(){
        return $this->getCaTipo();
    }
}
sfPropelBehavior::add('IdsTipoDocumento', array( 'traceable' ));
<?php

class IdsCriterio extends BaseIdsCriterio
{
    public function __toString(){
        return $this->getCaCriterio();
    }
}
sfPropelBehavior::add('IdsCriterio', array( 'traceable' ));
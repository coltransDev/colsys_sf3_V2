<?php

class IdsTipo extends BaseIdsTipo
{
    public function __toString(){
        return $this->getCaNombre();
    }

}

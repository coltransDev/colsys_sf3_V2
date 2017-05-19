<?php

/**
 * IdsCliente
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class IdsCliente extends BaseIdsCliente
{
    public function getDireccion() {

        $direccion = str_replace("|", " ", $this->getCaDireccion());

        if ($this->getCaOficina()) {
            $direccion.="Oficina " . $this->getCaOficina() . " ";
        }
        if ($this->getCaTorre()) {
            $direccion.="Torre " . $this->getCaTorre() . " ";
        }
        if ($this->getCaBloque()) {
            $direccion.="Bloque " . $this->getCaBloque() . " ";
        }
        if ($this->getCaInterior()) {
            $direccion.="Interior " . $this->getCaInterior() . " ";
        }
        $direccion.=$this->getCaComplemento() . " ";

        return $direccion;
    }
}

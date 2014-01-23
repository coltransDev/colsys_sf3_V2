<?php

/**
 * clientes components.
 * @package    colsys
 * @subpackage reportes
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class reportesNegPlugComponents extends sfComponents
{
	public function executeFormMercanciaPanel()
	{
        if($this->impoexpo==constantes::EXPO)
        {
            $this->sia = Doctrine::getTable("Sia")
                                     ->createQuery("s")
                                     ->select("s.ca_idsia,s.ca_nombre")
                                     ->addOrderBy("s.ca_nombre")                                     
                                     ->execute();
            $this->nave="";
            if($this->modo==constantes::AEREO)
            {
                $this->nave="Vuelo";
            }
            else if($this->modo==constantes::MARITIMO)
            {
                $this->nave="Motonave";
            }
            else if($this->modo==constantes::TERRESTRE)
            {
                $this->nave="Transportador";
            }
        }        
	}
    


}
?>

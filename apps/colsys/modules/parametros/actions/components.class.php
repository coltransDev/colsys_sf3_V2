<?php

/**
 * clientes components.
 *
 * @package    colsys
 * @subpackage parametros
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class parametrosComponents extends sfComponents
{


    public function executePanelParametros()
	{

        $this->tipos = array(
                             array("id"=>Constantes::RECARGO_EN_ORIGEN, "value"=>Constantes::RECARGO_EN_ORIGEN),
                             array("id"=>Constantes::RECARGO_LOCAL, "value"=>Constantes::RECARGO_LOCAL)
                           );

	}

    public function executeModalidadWindow()
	{

        

	}

    public function executeModalidadGrid()
	{
        $modalidades = Doctrine::getTable("Modalidad")
                  ->createQuery("m")
                  ->addOrderBy("m.ca_impoexpo")
                  ->execute();
        $this->modalidades = array();
        foreach( $modalidades as $modalidad ){
            $this->modalidades[] = array("id"=>$modalidad->getCaIdmodalidad(),
                                         "value"=>utf8_encode($modalidad->getCaImpoexpo()." ".$modalidad->getCaTransporte()." ".$modalidad->getCaModalidad())
                                     );
        }


	}
		
		
}
?>
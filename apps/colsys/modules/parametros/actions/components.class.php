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
                             array("id"=>Constantes::RECARGO_LOCAL, "value"=>Constantes::RECARGO_LOCAL),
                             array("id"=>Constantes::RECARGO_OTM_DTA, "value"=>Constantes::RECARGO_OTM_DTA),
                             //array("id"=>Constantes::COSTO, "value"=>Constantes::COSTO)
                           );

         
         $this->cuentas = Doctrine::getTable("InoCuenta")
                   ->createQuery("c")
                   ->select("c.ca_idcuenta, c.ca_cuenta")
                   ->addOrderBy("c.ca_cuenta")
                   ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                   ->execute();

         foreach( $this->cuentas as $key=>$val ){
             $this->cuentas[$key]["ca_cuenta"] = utf8_encode($this->cuentas[$key]["ca_cuenta"]);
         }        

	}

    public function executeModalidadWindow()
	{

        

	}

    public function executeModalidadGrid()
	{
        $modalidades = Doctrine::getTable("Modalidad")
                  ->createQuery("m")
                  ->where("m.ca_modalidad IS NOT NULL")
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
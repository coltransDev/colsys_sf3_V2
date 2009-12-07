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

        $this->centros = array();

        $centros = Doctrine::getTable("InoCentroCosto")
                             ->createQuery("c")
                             ->orderBy("c.ca_centro ASC")
                             ->addOrderBy("c.ca_subcentro ASC")
                             ->execute();

        foreach( $centros as $centro ){
            $centroStr = utf8_encode($centro->getCaCentro()." ".$centro->getCaSubcentro()." ".$centro->getCaNombre());
            $this->centros[] = array("id"=>$centro->getCaIdccosto(),
                                    "value"=> $centroStr
            );
        }

         
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
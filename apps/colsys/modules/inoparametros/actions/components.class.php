<?php

/**
 * clientes components.
 *
 * @package    colsys
 * @subpackage parametros
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class inoparametrosComponents extends sfComponents
{
    /*
     * Permite crear cuentas contables dentro del sistema.
     *
     */
    public function executePanelCuentas(){
        $response = sfContext::getInstance()->getResponse();
		$response->addJavascript('extExtras/treegrid/TreeGridSorter');
        $response->addJavascript('extExtras/treegrid/TreeGridColumnResizer');
        $response->addJavascript('extExtras/treegrid/TreeGridNodeUI');
        $response->addJavascript('extExtras/treegrid/TreeGridLoader');
        $response->addJavascript('extExtras/treegrid/TreeGridColumns');
        $response->addJavascript('extExtras/treegrid/TreeGrid');

        $response->addStylesheet('extExtras/treegrid.css');


    }

    /*
     * Permite asociar los conceptos de colsys con cuentas de SIIGO.
     * 
     */
    public function executePanelParametrosCuentas(){
	
        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/CheckColumn",'last');


        $centros = Doctrine::getTable("InoCentroCosto")
                              ->createQuery("c")
                              ->select("c.*")
                              ->where("c.ca_subcentro IS NULL")
                              ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                              ->execute();
        $centrosArray = array();
        foreach( $centros as $centro ){
            $centrosArray[ $centro["c_ca_centro"] ] = $centro["c_ca_nombre"];
        }


        $this->centros = array();

        $centros = Doctrine::getTable("InoCentroCosto")
                             ->createQuery("c")
                             ->where("c.ca_subcentro IS NOT NULL")
                             ->orderBy("c.ca_centro ASC")
                             ->addOrderBy("c.ca_subcentro ASC")
                             ->execute();

        foreach( $centros as $centro ){
            $centroStr = utf8_encode(str_pad($centro->getCaCentro(), 2, "0", STR_PAD_LEFT) ."-".str_pad($centro->getCaSubcentro(), 2, "0", STR_PAD_LEFT)." ".$centrosArray[$centro->getCaCentro()]." » ".$centro->getCaNombre());
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


    /*
     * Permite parametrizar los tipos de comprobantes del sistema
     *
     */
    public function executePanelTiposComprobante(){

        

    }		
}
?>
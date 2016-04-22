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


        //TODO Crear widgets independientas para estos dos items
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

        /*
        $cuentas = Doctrine::getTable("InoCuenta")
                                ->createQuery("c")
                                ->select("c.ca_idcuenta, c.ca_cuenta, c.ca_descripcion")
                                ->addOrderBy("c.ca_cuenta")
                                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                ->execute();

        $last = null;
        $lastKey = null;
        foreach( $cuentas as $key=>$val ){
            //Evita que se cree movimiento en una cuenta que posee subcuentas
            if( $last && strpos($cuentas[$key]["ca_cuenta"], $last)!==false  ){ 
                unset( $cuentas[$lastKey] );
            }
            $cuentas[$key]["ca_cuenta"] = utf8_encode($cuentas[$key]["ca_cuenta"]);
            $cuentas[$key]["ca_descripcion"] = utf8_encode($cuentas[$key]["ca_descripcion"]);
            
            $lastKey = $key;
            $last = $cuentas[$key]["ca_cuenta"];
        }

        //Es necesario que la llave sea consecutivo o la funcion json_encode devolvera un valor incorrecto
        $this->cuentas = array();
        foreach( $cuentas as $cuenta ){
            $this->cuentas[] = $cuenta;
        }*/
    }



    /*
     * Permite parametrizar los tipos de comprobantes del sistema
     *
     */
    public function executePanelTiposComprobante(){

        

    }

    /*
     * Ventana que permite editar los diferentes tipos de documentos
     *
     */
    public function executeEditarTiposComprobanteWindow(){


    }

    /*
     * Formulario que contiene la ventana EditarTiposComprobanteWindow
     *
     */
    public function executeEditarTiposComprobantePropiedadesPanel(){


    }
    
     public function executeGridTrmsExt4(){


    }
}
?>
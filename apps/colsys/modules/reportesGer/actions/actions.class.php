<?php

/**
 * reportesGer actions.
 *
 * @package    colsys
 * @subpackage reportesGer
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class reportesGerActions extends sfActions
{

    /**
	*
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
		
	}


    /*
	* Panel que muestra un arbol con opciones de busqueda
	* @author Andres Botero
    * @param sfRequest $request A request object
	*/
    public function executeDatosPanelConsulta( sfWebRequest $request ){
        $informes = Doctrine::getTable("RepGerInforme")
                                    ->createQuery("n")
                                    ->addOrderBy("n.ca_categoria ASC")
                                    ->addOrderBy("n.ca_titulo ASC")
                                    ->execute();

        $this->informes = array();
        foreach( $informes as $informe ){
            if( !isset( $this->informes[$informe->getCaCategoria()] )){
                $this->informes[$informe->getCaCategoria()] = array();
            }
            $this->informes[$informe->getCaCategoria()][] = $informe;

        }
    }



     /*
	* Lista los campos disponibles para crear un informe
	* @author Andres Botero
    * @param sfRequest $request A request object
	*/
    public function executeListadoCampos( sfWebRequest $request ){
        $idinforme = $request->getParameter("idinforme");
        $this->forward404Unless( $idinforme );
        $campos = Doctrine::getTable("RepGerCampo")
                                    ->createQuery("c")
                                    ->addWhere("c.ca_idinforme = ? ", $idinforme )
                                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                    ->execute();

        foreach( $campos as $key=>$campo ){
            $campos[$key]["c_ca_campo"] = utf8_encode($campos[$key]["c_ca_campo"]);
        }

        $this->responseArray = array("success"=>true, "root"=>$campos);
        $this->setTemplate("responseTemplate");
    }


     /*
	* Lista los filtros disponibles para crear un informe
	* @author Andres Botero
    * @param sfRequest $request A request object
	*/
    public function executeListadoFiltros( sfWebRequest $request ){
        $idinforme = $request->getParameter("idinforme");
        $this->forward404Unless( $idinforme );
        $campos = Doctrine::getTable("RepGerCampo")
                                    ->createQuery("c")
                                    ->addWhere("c.ca_idinforme = ? ", $idinforme )
                                    ->addWhere("c.ca_filtrar = ? ", true)
                                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                    ->execute();

        foreach( $campos as $key=>$campo ){
            $campos[$key]["c_ca_campo"] = utf8_encode($campos[$key]["c_ca_campo"]);
        }

        $this->responseArray = array("success"=>true, "root"=>$campos);
        $this->setTemplate("responseTemplate");
    }
    

    
	/**
	* Muestra un menu donde el usuario puede seleccionar las comisiones que desa sacar 
	*
	* @param sfRequest $request A request object
	*/
	public function executeReporteComisionesVendedor(sfWebRequest $request)
	{
		$this->userid = $this->getUser()->getUserId();	
	}
}
?>
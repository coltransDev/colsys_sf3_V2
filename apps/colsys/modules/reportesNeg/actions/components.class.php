<?php

/**
 * clientes components.
 *
 * @package    colsys
 * @subpackage reportes
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class reportesNegComponents extends sfComponents
{


    public function executeMainPanel()
	{


	}
	/*
	* Muestra los conceptos del reporte y un formulario para agregar un nuevo registro, tambien 
	* permite editar un campo haciendo doble click en el.
	* @author: Andres Botero
	*/
	public function executePanelConceptosFletes()
	{
				
		$this->conceptos = Doctrine::getTable("Concepto")
                                     ->createQuery("c")
                                     ->select("ca_idconcepto, ca_concepto")
                                     ->where("c.ca_transporte = ?", $this->reporte->getCaTransporte() )
                                     ->addWhere("c.ca_modalidad = ?", $this->reporte->getCaModalidad() )
                                     ->addOrderBy("c.ca_liminferior")
                                     ->addOrderBy("c.ca_concepto")
                                     ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                     ->execute();
         
        foreach( $this->conceptos as $key=>$val){
            $this->conceptos[$key]['ca_concepto'] = utf8_encode($this->conceptos[$key]['ca_concepto']);
             
        }

        array_push( $this->conceptos , array("ca_idconcepto"=>"9999", "ca_concepto"=>"Recargo general del trayecto"));

        $impoexpo = $this->reporte->getCaImpoexpo();
        if( $impoexpo==Constantes::TRIANGULACION ){
            $impoexpo=Constantes::IMPO;
        }

        $this->recargos = Doctrine::getTable("TipoRecargo")
                                     ->createQuery("c")
                                     ->select("ca_idrecargo as ca_idconcepto, ca_recargo as ca_concepto")
                                     ->addWhere("c.ca_tipo = ? ", Constantes::RECARGO_EN_ORIGEN )
                                     ->addWhere("c.ca_impoexpo LIKE ? ", $impoexpo )
                                     ->addWhere("c.ca_transporte LIKE ? ", $this->reporte->getCaTransporte() )
                                     ->addOrderBy("c.ca_recargo")
                                     ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                     ->execute();

         foreach( $this->recargos as $key=>$val){
             $this->recargos[$key]['ca_concepto'] = utf8_encode($this->recargos[$key]['ca_concepto']);

         }
	}


    /*
	* Muestra los conceptos del reporte y un formulario para agregar un nuevo registro, tambien
	* permite editar un campo haciendo doble click en el.
	* @author: Andres Botero
	*/
	public function executePanelRecargos()
	{

        $impoexpo = $this->reporte->getCaImpoexpo();
        if( $impoexpo==Constantes::TRIANGULACION ){
            $impoexpo=Constantes::IMPO;
        }
        $this->recargos = Doctrine::getTable("TipoRecargo")
                                     ->createQuery("c")
                                     ->select("ca_idrecargo as ca_idconcepto, ca_recargo as ca_concepto")
                                     ->addWhere("c.ca_tipo = ? ", Constantes::RECARGO_LOCAL )
                                     ->addWhere("c.ca_impoexpo LIKE ? ", $impoexpo )
                                     ->addWhere("c.ca_transporte LIKE ? ", $this->reporte->getCaTransporte() )
                                     ->addOrderBy("c.ca_recargo")
                                     ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                     ->execute();

         foreach( $this->recargos as $key=>$val){
             $this->recargos[$key]['ca_concepto'] = utf8_encode($this->recargos[$key]['ca_concepto']);

         }
	}


    /*
	* Muestra los conceptos del reporte y un formulario para agregar un nuevo registro, tambien
	* permite editar un campo haciendo doble click en el.
	* @author: Andres Botero
	*/
	public function executePanelRecargosAduana()
	{
        $this->recargos = Doctrine::getTable("TipoRecargo")
                                     ->createQuery("c")
                                     ->select("ca_idrecargo as ca_idconcepto, ca_recargo as ca_concepto")
                                     ->addWhere("c.ca_tipo = ? ", Constantes::RECARGO_LOCAL )
                                     ->addWhere("c.ca_transporte LIKE ? ", $this->reporte->getCaTransporte() )
                                     ->addOrderBy("c.ca_recargo")
                                     ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                     ->execute();

         foreach( $this->recargos as $key=>$val){
             $this->recargos[$key]['ca_concepto'] = utf8_encode($this->recargos[$key]['ca_concepto']);

         }
	}

    /*
	* Vista previa de un tercero
	* @author: Andres Botero
	*/
	public function executePreviewTercero()
	{
        $this->tercero = Doctrine::getTable("Tercero")->find($this->idtercero);
    }

	
		
}
?>
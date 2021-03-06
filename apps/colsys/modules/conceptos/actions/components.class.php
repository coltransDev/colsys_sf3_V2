<?php

/**
 * pricing components.
 *
 * @package    colsys
 * @subpackage conceptos
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class conceptosComponents extends sfComponents
{
    const RUTINA = "61";
 	/*
	* Muestra un panel con noticias 
	*/
	public function executePanelNoticias(){
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
		$this->opcion = "";
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		if( $this->nivel==0 ){
			$this->opcion = "consulta";
		}
		
		$notificaciones = Doctrine::getTable("PricNotificacion")
                                    ->createQuery("n")
                                    ->where("n.ca_caducidad >= ?", date("Y-m-d"))
                                    ->addOrderBy("n.ca_fchcreado ASC")
                                    ->execute();
		
		$this->data=array();
		foreach( $notificaciones as $notificacion ){
			$row =  array(	"idnotificacion"=>$notificacion->getCaIdnotificacion(),
							"titulo"=>utf8_encode($notificacion->getCaTitulo()), 
							"mensaje"=>utf8_encode($notificacion->getCaMensaje()), 
							"caducidad"=>$notificacion->getCaCaducidad(),
							"fchcreado"=>$notificacion->getCaFchcreado(), 
							"usucreado"=>$notificacion->getCaUsucreado() );
			$this->data[] = $row;
		}
	}
	
	/*
	* Muestra un arbol con la información de los traficos donde el usuario 
	* puede seleccionar una ciudad
	* @author: Andres Botero 
	*/
	public function executePanelConsultaCiudades(){
		
	}
	
	

    /*
	* Muestra información como deposito, liberacion o creditoen la parte
	* superior del panel de recargos locales
	* puede seleccionar una ciudad
	* @author: Andres Botero
	*/
	public function executePanelRecargosLocalesParametros(){
		
		$this->parametros = ParametroTable::retrieveByCaso("CU071");

	}
	
	/*
	* Muestra información como deposito, liberacion o creditoen la parte 
	* superior del panel de recargos locales
	* puede seleccionar una ciudad
	* @author: Andres Botero 
	*/
	public function executePanelRecargosLocalesPatios(){
		
	}


    /*
	* Incorpora los paneles de recargos locales x naviera, parametros
    * y patios en un TabPanel
	* @author: Andres Botero
	*/
	public function executePanelRecargosLocalesNaviera(){

    }

    
    /***************************************************************************
    *
    *   Creación y edición de trayectos
    *
    ***************************************************************************/

    /*
	* Muestra la lista de trayectos
	* @author: Andres Botero
	*/
    public function executePanelTrayecto(){

    }

    /*
	* Permite crear y editar trayectos
	* @author: Andres Botero
	*/
    public function executePanelTrayectoWindow(){

    }

    /***************************************************************************
    *
    *   Tarifario de fletes
    *
    ***************************************************************************/

    /*
	* Edición de tarifas por trayecto y sus respuectivos recargos.
	* @author: Andres Botero
	*/
    public function executePanelFletesPorTrayecto(){
        $this->nivel = $this->getUser()->getNivelAcceso( pricingComponents::RUTINA );
        $this->aplicacionesAereo = ParametroTable::retrieveByCaso("CU064", null, Constantes::AEREO );
		$this->aplicacionesMaritimo = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO );
    }

    /*
	* Edición de recargos por ciudad
	* @author: Andres Botero
	*/
    public function executePanelRecargosPorCiudad(){
        

        $this->aplicacionesAereo = ParametroTable::retrieveByCaso("CU064", null, Constantes::AEREO );
		$this->aplicacionesMaritimo = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO );
    }

    /*
	* Edición de recargos por linea
	* @author: Andres Botero
	*/
    public function executePanelRecargosPorLinea(){
        $this->aplicacionesAereo = ParametroTable::retrieveByCaso("CU064", null, Constantes::AEREO );
		$this->aplicacionesMaritimo = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO );
        
    }


    /***************************************************************************
    *
    *   Tarifario Aduana
    *
    ***************************************************************************/


    /*
	* Tarifario de aduana x cliente
	* @author: Andres Botero
	*/
    public function executePanelCostosAduana(){

        //$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );

        if(!isset($this->modo)){
            $this->modo = "";
        }


        $this->recargos = Doctrine::getTable("InoConcepto")
                              ->createQuery("c")
                              ->where("c.ca_tarifario_costos_cliente = ?", true)
                              ->execute();


	}


    /*
	* Muestra una ventana con la informacion de las columnas que se pueden
    * desplegar
	* @author: Andres Botero
	*/
    public function executePanelCostosAduanaWindow(){

        //$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );


	}


    /*
	* Muestra los recargos que estan en la ventana anterior
    * desplegar
	* @author: Andres Botero
	*/
    public function executePanelCostosAduanaRecargos(){

        //$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
        $this->recargos = Doctrine::getTable("InoConcepto")
                              ->createQuery("c")
                              ->select("c.ca_idconcepto, c.ca_concepto")
                              ->where("c.ca_tarifario_costos_cliente = ?", true)
                              ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                              ->execute();
        foreach( $this->recargos as $key=>$val){
            $this->recargos[$key]["sel"] = false;
            $this->recargos[$key]["c_ca_concepto"] = utf8_encode( $this->recargos[$key]["c_ca_concepto"] );
        }
	}


    public function executePanelParametros()
	{        

	}

    public function executeModalidadWindow()
	{

	}

    public function executeAKAWindow()
	{

	}

    public function executeModalidadGrid()
	{
        $modalidades = Doctrine::getTable("Modalidad")
                  ->createQuery("m")
                  ->where("m.ca_modalidad IS NOT NULL")
                  ->addOrderBy("m.ca_impoexpo")
                  ->addOrderBy("m.ca_transporte")
                  ->addOrderBy("m.ca_modalidad")
                  ->execute();
        
        $this->modalidades = array();
        foreach( $modalidades as $modalidad ){
            $this->modalidades[] = array("id"=>$modalidad->getCaIdmodalidad(),
                                         "value"=>utf8_encode($modalidad->getCaImpoexpo()." ".$modalidad->getCaTransporte()." ".$modalidad->getCaModalidad())
                                     );
        }


	}

    public function executeAKAGrid()
	{
        $modalidades = Doctrine::getTable("Modalidad")
                  ->createQuery("m")
                  ->where("m.ca_modalidad IS NOT NULL")
                  ->addOrderBy("m.ca_impoexpo")
                  ->addOrderBy("m.ca_transporte")
                  ->addOrderBy("m.ca_modalidad")
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
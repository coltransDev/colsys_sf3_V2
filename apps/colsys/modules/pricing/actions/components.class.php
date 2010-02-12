<?php

/**
 * pricing components.
 *
 * @package    colsys
 * @subpackage pricing
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class pricingComponents extends sfComponents
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
	public function executePanelParametrosRecargosLocales(){
		
		$this->transporte = utf8_decode($this->getRequestParameter( "transporte" ));		
		$this->modalidad = $this->getRequestParameter( "modalidad" );
		$this->impoexpo = utf8_decode($this->getRequestParameter( "impoexpo" ));
		$this->idlinea = $this->getRequestParameter( "idlinea" );
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
		
		$this->parametros = ParametroTable::retrieveByCaso("CU071");
		
	}
	
	/*
	* Permite colocar los valores de los recargos (Locales o en origen) por linea
	* @author: Andres Botero 
	*/
	public function executePanelRecargosLinea(){
	
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
	
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$idlinea = $this->getRequestParameter( "idlinea" );
		$modalidad = $this->getRequestParameter( "modalidad" );
		$impoexpo = utf8_decode($this->getRequestParameter( "impoexpo" ));
		
		if( $idtrafico ){
			$this->trafico = Doctrine::getTable("Trafico")->find($idtrafico);
			
			if( $idtrafico != "99-999" ){
				$tipo = Constantes::RECARGO_EN_ORIGEN;			
				$this->titulo = "Recargos x Linea»".substr( $impoexpo ,0 ,4 )."»".$modalidad."»".$idtrafico;
			}else{
				$tipo = Constantes::RECARGO_LOCAL;	
				$this->titulo = "Recargos Locales";		
			}
		}else{
			$tipo = Constantes::RECARGO_LOCAL;	
			$idtrafico = "99-999"; 
			$this->titulo = "Recargos Locales";		
		}
				
		if( $this->opcion != "consulta" ){				

            $this->recargos = Doctrine::getTable("TipoRecargo")
                              ->createQuery("t")
                              ->where("t.ca_transporte = ? AND t.ca_tipo= ?", array($transporte, $tipo))
                              ->addOrderBy("t.ca_recargo")
                              ->execute();
			
            $this->conceptos = Doctrine::getTable("Concepto")
                              ->createQuery("c")
                              ->where("c.ca_transporte = ? AND c.ca_modalidad= ?", array($transporte, $modalidad))
                              ->addOrderBy("c.ca_concepto")
                              ->execute();

			
			
            $q = Doctrine_Query::create()
                  ->select("p.ca_idproveedor, id.ca_nombre")
                  ->from("IdsProveedor p")
                  ->innerJoin("p.Trayecto t")
                  ->innerJoin("p.Ids id")                  
                  ->where("t.ca_impoexpo = ?", $impoexpo )
                  ->addWhere("t.ca_transporte = ?",  $transporte )
                  ->addWhere("t.ca_modalidad = ?", $modalidad )
                  ->addOrderBy("id.ca_nombre");

            if( $impoexpo==Constantes::IMPO ){
				$q->innerJoin("t.Origen c");
			}else{
				$q->innerJoin("t.Destino c");
			}

            if( $idtrafico != "99-999" ){
				$q->addWhere("c.ca_idtrafico = ?",  $idtrafico );
			}
            $q->distinct();
            $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
            $this->lineas =  $q->execute();
			
		}
		
		$this->modalidad = $modalidad;
		$this->transporte = $transporte;
		$this->idtrafico = $idtrafico;
		$this->idlinea = $idlinea;
		$this->impoexpo = $impoexpo;	
		
	}
	
	
	/*
	* Muestra información como deposito, liberacion o creditoen la parte 
	* superior del panel de recargos locales
	* puede seleccionar una ciudad
	* @author: Andres Botero 
	*/
	public function executePanelPatiosRecargosLocales(){
		
		$this->transporte = utf8_decode($this->getRequestParameter( "transporte" ));		
		$this->modalidad = $this->getRequestParameter( "modalidad" );
		$this->impoexpo = utf8_decode($this->getRequestParameter( "impoexpo" ));
		$this->idlinea = $this->getRequestParameter( "idlinea" );
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );	
	}


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
	* Edicion de tarifas por trayecto y sus respuectivos recargos.
	* @author: Andres Botero
	*/
    public function executePanelFletesPorTrayecto(){
        $this->aplicacionesAereo = ParametroTable::retrieveByCaso("CU064", null, Constantes::AEREO );
		$this->aplicacionesMaritimo = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO );
    }
}
?>
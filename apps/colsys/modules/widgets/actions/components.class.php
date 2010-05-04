<?php

/**
 * widgets actions.
 *
 * @package    colsys
 * @subpackage widgets
 * @author     Andres Botero
 * @version    SVN: $Id: components.class.php 9301 2008-05-27 01:08:46Z abotero $
 */
class widgetsComponents extends sfComponents
{

    /**
	* Muestra un select con las modalidades
	*/
	public function executeComerciales(){
		if(!isset( $this->label )){
			$this->label="";
		}
		if(!isset( $this->id )){
			$this->id="";
		}
		if(!isset( $this->allowBlank )){
			$this->allowBlank="true";
		}

		if(!isset( $this->nivel )){
			$this->nivel=0;
		}

		$comerciales = UsuarioTable::getComerciales();
		$this->comercialesJson = array();
		foreach( $comerciales as $comercial ){
			$this->comercialesJson[]= array("login"=>$comercial->getCaLogin(),
											"nombre"=>utf8_encode($comercial->getCaNombre())
										);
		}

		$this->user = $this->getUser();

		$this->nombre="";
		if( isset($this->value) ){
			$vendedor = Doctrine::getTable("Usuario")->find($this->value);
			if( $vendedor ){
				$this->nombre=$vendedor->getCaNombre();
			}
		}else{
			$this->value="";
		}
	}

    public function executeMonedas(){

        $this->monedas = Doctrine::getTable("Moneda")
                   ->createQuery("m")
                   ->orderBy("m.ca_idmoneda")
                   ->execute();
    }

    public function executeWidgetIncoterms(){
        $incoterms = ParametroTable::retrieveByCaso( "CU062" );  
        $this->incoterms = array();
        foreach( $incoterms as $incoterm ){
            $this->incoterms[] = array( "valor"=>$incoterm->getCaValor() );
        }
    }

    public function executeTransportes(){

        $this->transportes = ParametroTable::retrieveByCaso( "CU063" );

        if(!isset( $this->allowBlank )){
			$this->allowBlank="true";
		}
    }


    /*
	* Muestra un campo que permite autocompletar el numero de reporte.
	*/
	public function executeConcepto()
	{
        if(! isset($this->id) ){
            $this->id="";
        }

        if( !isset($this->transporte) ){
            $this->transporte=Constantes::MARITIMO;
        }
        if( !isset($this->modalidad) ){
            $this->modalidad=null;
        }
	}


    /*
     * Sin probar con doctrine 
     */



	/**
	* Muestra un select con todos los paises
	*/
	public function executePaises()
	{
		$traficos_rs = Doctrine::getTable("Trafico")
                       ->createQuery("t")
                       ->where("t.ca_idtrafico != '99-999' ")
                       ->addOrderBy("t.ca_nombre ASC")
                       ->execute();

		
		$this->traficos = array();
		
		foreach($traficos_rs as $trafico){
			$row = array("idtrafico"=>$trafico->getCaIdtrafico(),"trafico"=>utf8_encode($trafico->getCaNombre()));
			$this->traficos[]=$row;
		}
		if(!isset( $this->label )){
			$this->label="";
		}
		if(!isset( $this->id )){
			$this->id="";
		}	
		if(!isset( $this->allowBlank )){
			$this->allowBlank="true";
		}	
	}
	
	/**
	* Muestra un select con todas las ciudades y las encadena con los paises
	*/
	public function executeCiudades(){
		if(!isset( $this->label )){
			$this->label="";
		}
		if(!isset( $this->id )){
			$this->id="";
		}
				
		if(!isset( $this->allowBlank )){
			$this->allowBlank="true";
		}	
	}
	
	/**
	* Muestra un select con todas las ciudades y las encadena con los paises
	*/
	public function executeContinuaciones(){
		
	}
	
	/**
	* Muestra un select con todas las ciudades y las encadena con los paises
	*/
	public function executeImpoexpo(){
		if(!isset( $this->allowBlank )){
			$this->allowBlank="true";
		}
	}
	
	/**
	* Muestra un select con las empresas Coltrans, Colmas  
	*/
	public function executeEmpresa(){
		
	}
	
	
	/**
	* Muestra un select vacio cuyos datos son alimentados manualmente
	*/
	public function executeEmptyCombo(){
		if(!isset( $this->label )){
			$this->label="";
		}
		if(!isset( $this->id )){
			$this->id="";
		}	
		if(!isset( $this->allowBlank )){
			$this->allowBlank="true";
		}
	}	
	
	/**
	* Muestra un select con los valores de las aplicaciones 
	*/
	public function executeAplicaciones(){
		if(!isset( $this->label )){
			$this->label="";
		}
		if(!isset( $this->id )){
			$this->id="";
		}	
		if(!isset( $this->allowBlank )){
			$this->allowBlank="true";
		}
		$this->aplicaciones = ParametroTable::retrieveByCaso("CU064", null, $this->transporte );
	}
	
	/**
	* Muestra un select con las lineas de transporte 
	*/
	public function executeLineas(){
		if(!isset( $this->label )){
			$this->label="";
		}
		if(!isset( $this->id )){
			$this->id="";
		}	
		if(!isset( $this->allowBlank )){
			$this->allowBlank="true";
		}

        if(!isset( $this->noaprob )){
			$this->noaprob=false;
		}
	}
	
	/**
	* Muestra un select con las modalidades
	*/
	public function executeModalidades(){
		if(!isset( $this->label )){
			$this->label="";
		}
		if(!isset( $this->id )){
			$this->id="";
		}	
		if(!isset( $this->allowBlank )){
			$this->allowBlank="true";
		}
	}
	
	
	
	
	/*
	* Muestra un campo que permite autocompletar el nombre del cliente usando JSON y el id lo guarda 
	 en el atributo id.
	*/
	public function executeComboClientes()
	{		
		if($this->idcliente){
			$this->cliente = ClientePeer::retrieveByPk( $this->cliente );
		}		
	}
	
	
	/*
	* Muestra un campo que permite autocompletar el numero de reporte.
	*/
	public function executeComboReportes()
	{
		
	}


    /*
	* Muestra un campo que permite autocompletar el tercero (Cliente, proveedor, consignatario, etc.).
	*/
	public function executeComboTercero()
	{        
		if($this->value){
			$this->tercero = Doctrine::getTable("Tercero")->find( $this->value );
		}else{
            $this->tercero = new Tercero();
        }
        
	}

    /*
	* Muestra una seleccion de las cotizaciones a partir del numero
	*/
	public function executeComboCotizaciones(){
		/*$response = sfContext::getInstance()->getResponse();
		$response->addJavascript('components/comboCotizaciones');*/
		$this->selected="";
	}




    /*
    *
    */
    public function executeWidgetImpoexpo(){
		$this->data = array();

        $this->data[] = array( "valor"=>utf8_encode(Constantes::IMPO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::TRIANGULACION ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::EXPO ));

	}


    public function executeWidgetTransporte(){
		$this->data = array();

        $this->data[] = array( "valor"=>utf8_encode(Constantes::AEREO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::MARITIMO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::TERRESTRE ));

	}

    public function executeWidgetModalidad(){
		$this->data = array();

        /*$this->data[] = array( "valor"=>utf8_encode(Constantes::AEREO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::MARITIMO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::TERRESTRE ));*/

	}


    public function executeWidgetLinea(){
		$this->data = array();

        /*$this->data[] = array( "valor"=>utf8_encode(Constantes::AEREO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::MARITIMO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::TERRESTRE ));*/

	}

    public function executeWidgetPais(){
		$this->data = array();

        /*$this->data[] = array( "valor"=>utf8_encode(Constantes::AEREO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::MARITIMO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::TERRESTRE ));*/

	}

    public function executeWidgetCiudad(){
		$this->data = array();

        /*$this->data[] = array( "valor"=>utf8_encode(Constantes::AEREO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::MARITIMO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::TERRESTRE ));*/

	}

    public function executeWidgetAgente(){
		
        $agentes = Doctrine_Query::create()
                             ->select("a.*, i.ca_nombre, t.ca_idtrafico, t.ca_nombre")
                             ->from("IdsAgente a")
                             ->innerJoin("a.Ids i")
                             ->innerJoin("i.IdsSucursal s")
                             ->innerJoin("s.Ciudad c")
                             ->innerJoin("c.Trafico t")
                             ->where("s.ca_principal = ?", true)
                             ->addWhere("a.ca_activo = ?", true)
                             ->addOrderBy("t.ca_nombre")
                             ->addOrderBy("i.ca_nombre")
                             ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                             ->execute();
        $this->agentes = array();
        foreach( $agentes as $agente ){       
            $this->agentes[]=array("idagente" => $agente["a_ca_idagente"],
                                                                "nombre" => utf8_encode($agente["t_ca_nombre"]." ".$agente["i_ca_nombre"]),
                                                                "pais" => utf8_encode($agente["t_ca_nombre"]),
                                                                "idtrafico" => $agente["t_ca_idtrafico"]);
        }

       

	}

    public function executeWidgetCliente(){
		$this->data = array();

        /*$this->data[] = array( "valor"=>utf8_encode(Constantes::AEREO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::MARITIMO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::TERRESTRE ));*/

	}


    public function executeWidgetTercero(){
		$this->data = array();

        /*$this->data[] = array( "valor"=>utf8_encode(Constantes::AEREO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::MARITIMO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::TERRESTRE ));*/

	}
}
?>
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
        //$this->data[] = array( "valor"=>utf8_encode(Constantes::OTMDTA ));

	}


    public function executeWidgetTransporte(){
		$this->data = array();

        $this->data[] = array( "valor"=>utf8_encode(Constantes::AEREO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::MARITIMO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::TERRESTRE ));

	}

    public function executeWidgetSucursales(){
		$this->data = array();
        $sucursales = Doctrine::getTable("Sucursal")
                      ->createQuery("s")
                      ->select("s.ca_nombre")
                      ->addOrderBy("s.ca_nombre")
                      ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                      ->execute();

        foreach($sucursales as $sucursal){
            $this->data[] = array( "valor"=>utf8_encode($sucursal["s_ca_nombre"]));

        }

        
	}

    public function executeWidgetModalidad(){
		$this->data = array();

        $modalidades = Doctrine::getTable("Modalidad")
                  ->createQuery("m")
                  ->orderBy("m.ca_impoexpo")
                  ->orderBy("m.ca_transporte")
                  ->orderBy("m.ca_modalidad")
                  ->where("ca_fcheliminado is null")
                  ->execute();

        $this->data = array();
		foreach( $modalidades as $modalidad ){
			$this->data[] = array(  "idmodalidad"=>$modalidad->getCaIdmodalidad(),
                                    "impoexpo"=>utf8_encode($modalidad->getCaImpoexpo()),
									"transporte"=>utf8_encode($modalidad->getCaTransporte()),
                                    "modalidad"=>utf8_encode($modalidad->getCaModalidad())
								   );
		}
//		echo "<pre>";print_r($this->data);echo "</pre>";

	}


    public function executeWidgetMoneda(){
		$this->data = array();

        $monedas = Doctrine::getTable("Moneda")
                   ->createQuery("m")
                   ->orderBy("m.ca_idmoneda")
                   ->execute();
        
//        echo count($monedas);
		foreach( $monedas as $moneda ){
			$this->data[] = array(  "valor"=>$moneda->getCaIdmoneda());
		}
	}


    public function executeWidgetLinea(){
		$this->data = array();
        
		$q = Doctrine_Query::create()
                  ->select("p.ca_idproveedor, p.ca_sigla, id.ca_nombre, p.ca_transporte, p.ca_activo_impo, p.ca_activo_expo ")
                  ->from("IdsProveedor p")
                  ->innerJoin("p.Ids id")
                  ->addOrderBy("id.ca_nombre");
        $q->addWhere("p.ca_tipo = ? OR p.ca_tipo = ?", array("TRI", "TRN") );
        
        //$q->addWhere("p.ca_activo = ?", true );
        
        $q->fetchArray();

        $lineas = $q->execute();

		$this->data = array();
		foreach( $lineas as $linea ){
			$this->data[] = array(  "idlinea"=>$linea['ca_idproveedor'],
									  "linea"=>utf8_encode(($linea['ca_sigla']?$linea['ca_sigla']." - ":"").$linea['Ids']['ca_nombre']),
                                      "transporte"=>utf8_encode($linea['ca_transporte']),
                                      "activo_impo"=>$linea['ca_activo_impo'],
                                      "activo_expo"=>$linea['ca_activo_expo']
								   );
		}


        
	}

    public function executeWidgetPais(){		
        
        $traficos = Doctrine::getTable('Trafico')->createQuery('t')
                            ->where('t.ca_idtrafico != ?', '99-999')
                            ->addOrderBy('t.ca_nombre ASC')
                            ->execute();

        $this->data = array();
        foreach( $traficos as $trafico ){
           $this->data[] = array("nombre"=>utf8_encode($trafico->getCaNombre()),
                                 "idtrafico"=>$trafico->getCaIdtrafico()
                                );
        }

        
	}

    public function executeWidgetCiudad(){
		$this->data = array();

        $ciudades = Doctrine::getTable('Ciudad')->createQuery('c')
                            //->where('c.ca_idtrafico = ?', $ciudad->getCaIdtrafico())
                            ->addOrderBy('c.ca_ciudad ASC')
                            ->execute();
        $this->data = array();
        foreach( $ciudades as $ciudad ){
            $this->data[] = array( "idciudad"=>$ciudad->getCaIdciudad(),
                                   "ciudad"=>utf8_encode($ciudad->getCaCiudad()),
                                   "idtrafico"=>$ciudad->getCaIdtrafico(),
                                 );
        }
	}
    public function executeUsuarios()
    {
        //echo $this->getRequestParameter("perfil");

        $this->usuarios = Doctrine::getTable("Usuario")
                                   ->createQuery("u")
                                   ->innerJoin("u.UsuarioPerfil up")
                                   ->where("u.ca_activo=? AND up.ca_perfil=? ", array('TRUE',$this->perfil))
                                   ->addOrderBy("u.ca_idsucursal")
                                   ->addOrderBy("u.ca_nombre")
                                   ->execute();
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

    public function executeWidgetComerciales()
    {
        $comerciales = UsuarioTable::getComerciales();
		$this->comercialesJson = array();
		foreach( $comerciales as $comercial ){
			$this->comercialesJson[]= array("login"=>$comercial->getCaLogin(),
											"nombre"=>utf8_encode($comercial->getCaNombre())
										);
		}
	}



    public function executeWidgetContinuacion(){
		$this->data = array();

        $this->data[] = array(  "impoexpo"=>utf8_encode(Constantes::IMPO ),
                                "transporte"=>utf8_encode(Constantes::AEREO ),
                                "modalidad"=>"CABOTAJE");
        $this->data[] = array(  "impoexpo"=>utf8_encode(Constantes::IMPO ),
                                "transporte"=>utf8_encode(Constantes::MARITIMO ),
                                "modalidad"=>"OTM");
        $this->data[] = array(  "impoexpo"=>utf8_encode(Constantes::IMPO ),
                                "transporte"=>utf8_encode(Constantes::MARITIMO ),
                                "modalidad"=>"DTA");
        $this->data[] = array(  "impoexpo"=>utf8_encode(Constantes::IMPO ),
                                "transporte"=>utf8_encode(Constantes::AEREO ),
                                "modalidad"=>"DTA");
        $this->data[] = array(  "impoexpo"=>utf8_encode(Constantes::IMPO ),
                                "transporte"=>utf8_encode(Constantes::MARITIMO ),
                                "modalidad"=>"TRASLADO");
		$this->data[] = array(  "impoexpo"=>utf8_encode(Constantes::EXPO ),
                                "transporte"=>utf8_encode(Constantes::AEREO ),
                                "modalidad"=>"DTA");
	}


    public function executeWidgetContactoCliente(){
		$this->data = array();

        /*$this->data[] = array( "valor"=>utf8_encode(Constantes::AEREO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::MARITIMO ));
        $this->data[] = array( "valor"=>utf8_encode(Constantes::TERRESTRE ));*/

	}

    public function executeWidgetCliente(){
		$this->data = array();

	}


    public function executeWidgetTercero(){
		

	}

    public function executeWidgetUsuario(){


	}

    public function executeWidgetTerceroWindow(){
        
    }


    public function executeWidgetConsignar(){
        $this->data = Doctrine::getTable("Bodega")
                                             ->createQuery("b")
                                             ->select("b.*")
                                             ->addOrderBy("b.ca_tipo ASC")
                                             ->addOrderBy("b.ca_nombre ASC")
                                             ->where( "b.ca_tipo = ? OR b.ca_tipo = ?", array('Coordinador Logístico', 'Operador Multimodal'))
                                             ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                             ->execute();

        foreach( $this->data as $key=>$val ){
            $this->data[$key]["b_ca_tipo"] = utf8_encode($this->data[$key]["b_ca_tipo"]);
            $this->data[$key]["b_ca_transporte"] = utf8_encode($this->data[$key]["b_ca_transporte"]);
            $this->data[$key]["b_ca_nombre"] = utf8_encode($this->data[$key]["b_ca_nombre"]);
        }

	}

    public function executeWidgetTipoBodega(){
        $this->data = Doctrine::getTable("Bodega")
                                             ->createQuery("b")
                                             ->select("b.ca_tipo, b.ca_transporte")
                                             ->addOrderBy("b.ca_tipo ASC")
                                             ->where( "b.ca_tipo != ? AND b.ca_tipo != ?", array('Coordinador Logístico', 'Operador Multimodal'))
                                             ->distinct()
                                             ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                             ->execute();

        foreach( $this->data as $key=>$val ){
            $this->data[$key]["b_ca_tipo"] = utf8_encode($this->data[$key]["b_ca_tipo"]);
            $this->data[$key]["b_ca_transporte"] = utf8_encode($this->data[$key]["b_ca_transporte"]);
        }
	}

    public function executeWidgetBodega(){
        $this->data = Doctrine::getTable("Bodega")
						 ->createQuery("b")
						 ->select("b.*")
						 ->addOrderBy("b.ca_tipo ASC")
						 ->addOrderBy("b.ca_nombre ASC")
						 ->distinct()
						 ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
						 ->execute();

        foreach( $this->data as $key=>$val ){
            $arrTransporte=explode("|",$this->data[$key]["b_ca_transporte"]);
            if(count($arrTransporte)<2)
            {
                $this->data[$key]["b_ca_tipo"] = utf8_encode($this->data[$key]["b_ca_tipo"]);
                $this->data[$key]["b_ca_nombre"] = utf8_encode($this->data[$key]["b_ca_nombre"]);
                $this->data[$key]["b_ca_transporte"] = utf8_encode($this->data[$key]["b_ca_transporte"]);
            }
            else
            {
                foreach($arrTransporte as $t)
                {
                    $this->data[$key]["b_ca_tipo"] = utf8_encode($this->data[$key]["b_ca_tipo"]);
                    $this->data[$key]["b_ca_nombre"] = utf8_encode($this->data[$key]["b_ca_nombre"]);
                    $this->data[$key]["b_ca_transporte"] = utf8_encode($t);
                }
            }
        }

	}

    public function executeWidgetCotizacion(){


	}

    public function executeWidgetParametros()
    {
        $this->data = array();
        //echo $this->getRequestParameter("caso_uso");
        $casos=explode(",", $this->caso_uso);
        foreach($casos as $caso)
        {
            $datos = ParametroTable::retrieveByCaso( $caso );
            foreach( $datos as $dato ){
                $this->data[]=array("id"=>utf8_encode($dato->getCaValor()),"name"=>  utf8_encode($dato->getCaValor()),"caso_uso"=>$dato->getCaCasouso());
            }
        }
	}

    public function executeWidgetReporte(){


	}

    public function executeWidgetTicket(){


	}

}
?>

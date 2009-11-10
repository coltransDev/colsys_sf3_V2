<?php

/**
 * widgets actions.
 *
 * @package    colsys
 * @subpackage widgets
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class widgetsActions extends sfActions
{
	/**
	* Retorna un objeto JSON con la información de todos los paises
	*
	* @param sfRequest $request A request object
	*/
	public function executeDatosPaises($request)
	{	
		$query = utf8_decode($this->getRequestParameter("query"));

        $traficos_rs = Doctrine::getTable("Trafico")
                       ->createQuery("c")
                       ->where("c.ca_idtrafico != ? ", '99-999' )
                       ->addWhere("LOWER(c.ca_nombre) like ? ", strtolower($query)."%" )
                       ->addOrderBy("c.ca_nombre")
                       ->execute();

		$traficos = array();
		
		foreach($traficos_rs as $trafico){
			$row = array("idtrafico"=>$trafico->getCaIdTrafico(),"trafico"=>utf8_encode($trafico->getCaNombre()));
			$traficos[]=$row;
		}

        $this->responseArray = array("root"=>$traficos, "total"=>count($traficos), "success"=>true);
		$this->setTemplate("responseTemplate");
		
	}
	
	/**
	* Retorna un objeto JSON con la información de todas las ciudades
	*
	* @param sfRequest $request A request object
	*/
	public function executeDatosCiudades($request)
	{		
		$idpais = utf8_decode($this->getRequestParameter("idpais"));
		$query = utf8_decode($this->getRequestParameter("query"));
		
		if( !$query ){
			$query = "%";
		}
		
		$ciudades_rs = Doctrine::getTable("Ciudad")
                       ->createQuery("c")
                       ->where("c.ca_idtrafico = ? ", $idpais )
                       ->addWhere("LOWER(c.ca_ciudad) like ? ", strtolower($query)."%" )
                       ->addOrderBy("c.ca_ciudad")
                       ->execute();
		
		$ciudades = array();		
		foreach($ciudades_rs as $ciudad){
			$row = array('idciudad'=>$ciudad->getCaIdciudad(),"ciudad"=>utf8_encode($ciudad->getCaCiudad()));
			$ciudades[]=$row;
		}

        $this->responseArray = array("root"=>$ciudades, "total"=>count($ciudades), "success"=>true);
		$this->setTemplate("responseTemplate");
				
	}


    /**
	* Retorna un objeto JSON con la información de todas las ciudades
	*
	* @param sfRequest $request A request object
	*/
	public function executeDatosCiudadesPaises($request)
	{
		$ciudades_rs = Doctrine::getTable("Ciudad")
                       ->createQuery("c")
                       ->select("c.ca_idciudad, c.ca_ciudad, c.ca_idtrafico ")
                       ->addOrderBy("c.ca_idtrafico")
                       ->addOrderBy("c.ca_ciudad")
                       ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                       ->execute();

		$ciudades = array();
		foreach($ciudades_rs as $ciudad){
			$row = array('idciudad'=>$ciudad["c_ca_idciudad"],"ciudad"=>utf8_encode($ciudad["c_ca_ciudad"]));
			$ciudades[$ciudad["c_ca_idtrafico"]][]=$row;
		}

        $this->responseArray = array("root"=>$ciudades, "total"=>count($ciudades), "success"=>true);
		$this->setTemplate("responseTemplate");

	}
	
	/**
	* Retorna un objeto JSON con la información de todas las lineas
	*
	* @param sfRequest $request A request object
	*/
	public function executeDatosLineas($request)
	{		
		$idlinea = utf8_decode($this->getRequestParameter("idlinea"));
		$transporte = utf8_decode($this->getRequestParameter("transporte"));
		$query = utf8_decode($this->getRequestParameter("query"));
		
		$q = Doctrine_Query::create()
                  ->select("p.ca_idproveedor, id.ca_nombre, p.ca_transporte ")
                  ->from("IdsProveedor p")
                  ->innerJoin("p.Ids id")                  
                  ->addOrderBy("id.ca_nombre");

        if( $transporte ){
            $q->where("p.ca_transporte = ?", $transporte );
        }

        if( $query ){
            $q->addWhere("id.ca_nombre like ?", $query."%");
        }

        $q->fetchArray();

        $lineas = $q->execute();
        
		$this->lineas = array();	
		foreach( $lineas as $linea ){            
			$this->lineas[] = array(  "idlinea"=>$linea['ca_idproveedor'],
									  "linea"=>utf8_encode($linea['Ids']['ca_nombre']),
                                      "transporte"=>utf8_encode($linea['ca_transporte']),
								   );
		}						


        $this->responseArray = array("root"=>$this->lineas, "total"=>count($this->lineas), "success"=>true);
		$this->setTemplate("responseTemplate");
				
	}
	
	/*
	* Datos de las modalidades según sea el medio de transporte
	*/
	public function executeDatosModalidades(){
		$transport_parameter = utf8_decode($this->getRequestParameter("transporte"));
		$impoexpo_parameter = utf8_decode($this->getRequestParameter("impoexpo"));
		/*
		if ( $transport_parameter == Constantes::MARITIMO)	{
			$transportes = ParametroTable::retrieveByCaso( "CU051",null, $impoexpo_parameter);
		}else if ( $transport_parameter == Constantes::AEREO )	{
			$transportes = ParametroTable::retrieveByCaso( "CU052",null, $impoexpo_parameter);
		}else if ( $transport_parameter ==  Constantes::TERRESTRE )	{
			$transportes = ParametroTable::retrieveByCaso( "CU053",null, $impoexpo_parameter);
		}*/

        $q = Doctrine::getTable("Modalidad")
                  ->createQuery("m");
                  
        if( $impoexpo_parameter ){
            $q->where( " m.ca_impoexpo = ? ", $impoexpo_parameter);
        }


        if( $transport_parameter ){
            $q->addWhere( "m.ca_transporte = ? ", $transport_parameter );
        }

        $transportes = $q->execute();

		$this->modalidades = array();
		
		foreach($transportes as $transporte){
			$row = array("idmodalidad"=>utf8_encode($transporte->getCaIdmodalidad()),
                         "impoexpo"=>utf8_encode($transporte->getCaImpoexpo()),
                         "transporte"=>utf8_encode($transporte->getCaTransporte()),
                         "modalidad"=>utf8_encode($transporte->getCaModalidad()));
			$this->modalidades[]=$row;
		}

        $this->responseArray = array("root"=>$this->modalidades, "total"=>count($this->modalidades), "success"=>true);
		$this->setTemplate("responseTemplate");
		
	}
	
	
	
	/*
	* 
	*/	
	public function executeDatosComboClientes(){
		$criterio =  $this->getRequestParameter("query");
		

        $rows = Doctrine_Query::create()
                        ->select("cl.ca_idcliente, cl.ca_compania,
                                  cl.ca_preferencias, cl.ca_confirmar
                                  ,cl.ca_status
                                 ")
                        ->from("Cliente cl")
                        ->where("UPPER(cl.ca_compania) like ?", "%".strtoupper( $criterio )."%")
                        ->addOrderBy("cl.ca_compania ASC")
                        ->setHydrationMode( Doctrine::HYDRATE_SCALAR )
                        ->limit(40)
                        ->execute();

		$clientes = array();
 
   		foreach ( $rows as $row ) {
      		$clientes[] = array('ca_idcliente'=>$row["cl_ca_idcliente"],
                              'ca_compania'=>utf8_encode($row["cl_ca_compania"]),
                              'ca_preferencias'=>utf8_encode($row["cl_ca_preferencias"]),
                              'ca_confirmar'=>utf8_encode($row["cl_ca_confirmar"]),
                              'ca_status'=>utf8_encode($row["cl_ca_status"]),
                              );
		}					

        $this->responseArray = array( "totalCount"=>count( $clientes ), "clientes"=>$clientes  );
		$this->setTemplate("responseTemplate");

	}
	
	/*
	* 
	*/	
	public function executeDatosComboReportes(){
		$criterio =  $this->getRequestParameter("query");
		
		$transporte =  utf8_decode($this->getRequestParameter("transporte"));
		$impoexpo =  utf8_decode($this->getRequestParameter("impoexpo"));
		



        $q = Doctrine_Query::create()
                  ->select("r.ca_consecutivo, r.ca_idreporte, r.ca_version, MAX(r.ca_version) as max")
                  ->from("Reporte r")                  
                  ->where("r.ca_consecutivo LIKE ?", $criterio."%" )
                  ->addWhere("r.ca_usuanulado IS NULL")
                  ->addOrderBy("r.ca_fchcreado DESC")
                  ->groupBy("r.ca_consecutivo, r.ca_idreporte, r.ca_version, r.ca_fchcreado")
                  ->limit(40);
                  

			
		if( $transporte ){			
			$q->addWhere("r.ca_transporte = ?", $transporte);
		}
		
		if( $impoexpo ){			
			if( $impoexpo==Constantes::IMPO ){
                $q->addWhere("r.ca_impoexpo = ? OR r.ca_impoexpo = ?", array($impoexpo,  Constantes::TRIANGULACION));
			}else{
                $q->addWhere("r.ca_impoexpo = ?", array($impoexpo));
            }
		}
		
		$reportes = $q->fetchArray();
		
		$this->reportes = array();
 
   		foreach ( $reportes as $reporte ) {            
			if( $reporte['ca_version']==$reporte["max"] ){
      			$this->reportes[] = array('ca_consecutivo'=>$reporte['ca_consecutivo'],
										  'ca_idreporte'=>$reporte['ca_idreporte']
										 
									 );
			}
		}


        $this->responseArray = array( "totalCount"=>count( $this->reportes ), "reportes"=>$this->reportes  );
		$this->setTemplate("responseTemplate");

		$this->setLayout("none");
	}


	public function executeListaContactosClientesJSON(){
		$criterio =  $this->getRequestParameter("query");

        $rows = Doctrine_Query::create()
                        ->select("c.ca_idcontacto, cl.ca_compania, c.ca_nombres,
                                  c.ca_papellido, c.ca_sapellido, c.ca_cargo, 
                                  cl.ca_preferencias, cl.ca_confirmar, cl.ca_vendedor
                                  v.ca_nombre, cl.ca_listaclinton, cl.ca_fchcircular
                                  ,cl.ca_status
                                 ")
                        ->from("Contacto c")
                        ->innerJoin("c.Cliente cl")
                        ->leftJoin("cl.Usuario v")
                        ->where("UPPER(cl.ca_compania) like ?", "%".strtoupper( $criterio )."%")
                        ->addOrderBy("cl.ca_compania ASC")
                        ->addOrderBy("c.ca_nombres ASC")
                        ->setHydrationMode( Doctrine::HYDRATE_SCALAR )
                        ->limit(40)
                        ->execute();
      
                        

		$clientes = array();

   		foreach ( $rows as $row ) {
            $row["ca_idcontacto"]=$row["c_ca_idcontacto"];
			$row["ca_compania"]=utf8_encode($row["cl_ca_compania"]);
			$row["ca_nombres"]=utf8_encode($row["c_ca_nombres"]);
			$row["ca_papellido"]=utf8_encode($row["c_ca_papellido"]);
			$row["ca_sapellido"]=utf8_encode($row["c_ca_sapellido"]);
			$row["ca_preferencias"]=utf8_encode($row["cl_ca_preferencias"]);
			$row["ca_nombre"]=utf8_encode($row["cl_v.ca_nombre"]);
			$row["ca_cargo"]=utf8_encode($row["c_ca_cargo"]);
			$row["ca_listaclinton"]=utf8_encode($row["cl_ca_listaclinton"]);
			$row["ca_fchcircular"]=strtotime($row["cl_ca_fchcircular"]);
            $row["ca_confirmar"]=$row["cl_ca_confirmar"];
            $row["ca_idcontacto"]=$row["c_ca_idcontacto"];
            $row["ca_status"]=$row["cl_ca_status"];
            $clientes[]=$row;
			
		}
        $this->responseArray = array( "totalCount"=>count( $clientes ), "clientes"=>$clientes  );
        $this->setTemplate("responseTemplate");
	}


    public function executeListaIdsJSON(){
		$criterio =  $this->getRequestParameter("query");

        $rows = Doctrine_Query::create()
                        ->select("i.ca_id, i.ca_nombre")
                        ->from("Ids i")
                        ->where("UPPER(i.ca_nombre) like ?", "%".strtoupper( $criterio )."%")
                        ->addOrderBy("i.ca_nombre ASC")
                        ->setHydrationMode( Doctrine::HYDRATE_SCALAR )
                        ->limit(40)
                        ->execute();



		$ids = array();

   		foreach ( $rows as $row ) {
            $row["ca_id"]=$row["i_ca_id"];
			$row["ca_nombre"]=utf8_encode($row["i_ca_nombre"]);

            $ids[]=$row;

		}
        $this->responseArray = array( "totalCount"=>count( $ids ), "root"=>$ids  );
        $this->setTemplate("responseTemplate");
	}


    public function executeListaTercerosJSON(){
		$criterio =  $this->getRequestParameter("query");
        $tipo =  $this->getRequestParameter("tipo");

        $rows = Doctrine_Query::create()
                        ->select("t.ca_idtercero, t.ca_nombre, c.ca_ciudad, p.ca_nombre")
                        ->from("Tercero t")
                        ->innerJoin("t.Ciudad c")
                        ->innerJoin("c.Trafico p")
                        ->where("UPPER(t.ca_nombre) like ?", "%".strtoupper( $criterio )."%")
                        ->addWhere("t.ca_tipo = ?", $tipo)
                        ->addOrderBy("t.ca_nombre ASC")
                        ->setHydrationMode( Doctrine::HYDRATE_SCALAR )
                        ->distinct()
                        ->limit(40)
                        ->execute();



		$terceros = array();

   		foreach ( $rows as $row ) {            
			$row["t_ca_nombre"]=utf8_encode($row["t_ca_nombre"]);
            $row["c_ca_ciudad"]=utf8_encode($row["c_ca_ciudad"]);
            $row["p_ca_nombre"]=utf8_encode($row["p_ca_nombre"]);
            $terceros[]=$row;

		}
        $this->responseArray = array( "totalCount"=>count( $terceros ), "terceros"=>$terceros  );
        $this->setTemplate("responseTemplate");
	}


    /*
	* Permite guardar un tercero
	* @author: Andres Botero
	*/
	public function executeGuardarTercero(){
		$this->tipo=$this->getRequestParameter("tipo");
		$this->forward404unless($this->tipo);

        $fldId = $this->getRequestParameter("fldId");

		if($this->getRequestParameter("nombre")){
			$idtercero = $this->getRequestParameter("idtercero");
			if( !$idtercero ){
				$tercero = new Tercero();
			}else{
				$tercero = Doctrine::getTable("Tercero")->find( $idtercero );
			}
			$tercero->setCaNombre( $this->getRequestParameter("nombre") );
			$tercero->setCaDireccion( $this->getRequestParameter("direccion") );
			$tercero->setCaTelefonos( $this->getRequestParameter("telefono") );
			$tercero->setCaFax( $this->getRequestParameter("fax") );
			$tercero->setCaEmail( $this->getRequestParameter("email") );
			$tercero->setCaContacto( $this->getRequestParameter("contacto") );
			$tercero->setCaIdciudad( $this->getRequestParameter("ciudad") );
			$tercero->setCaIdentificacion( $this->getRequestParameter("identificacion") );
			$tercero->setCaVendedor( $this->getRequestParameter( "vendedor") );
			$tercero->setCaTipo( $this->tipo );
			$tercero->save();
		}

		$this->responseArray = array("success"=>true, "nombre"=>$this->getRequestParameter("nombre"), "idtercero"=>$tercero->getCaIdtercero() , "tipo"=>$this->tipo, "fldId"=>$fldId);
		$this->setTemplate("responseTemplate");
	}


    /*
	* Carga los datos de un tercero en un objeto JSON
	* @author: Andres Botero
	*/
	public function executeDatosTercero(){
		$tercero = Doctrine::getTable("Tercero")->find( $this->getRequestParameter("idtercero") );
		$this->forward404Unless($tercero);

		$this->responseArray = array("success"=>true,
									"nombre"=>utf8_encode($tercero->getCaNombre()),
									"idtercero"=>$tercero->getCaIdtercero(),
									"direccion"=>utf8_encode($tercero->getCaDireccion()),
									"telefonos"=>$tercero->getCaTelefonos(),
									"fax"=>$tercero->getCaFax(),
									"email"=>$tercero->getCaEmail(),
									"contacto"=>utf8_encode($tercero->getCaContacto()),
									"identificacion"=>$tercero->getCaIdentificacion(),
									//"ciudad"=>$tercero->getCaCiudad(),
									"idciudad"=>$tercero->getCaIdciudad(),
                                    "idtrafico"=>$tercero->getCiudad()->getCaIdtrafico()

									);
		$this->setTemplate("responseTemplate");
	}
    /*
	* Datos de los conceptos según sea el medio de transporte y la modalidad
	*/
	public function executeDatosConceptos(){
		$transport_parameter = utf8_decode($this->getRequestParameter("transporte"));
		$modalidad_parameter = utf8_decode($this->getRequestParameter("modalidad"));




		$results = Doctrine::getTable("Concepto")
                          ->createQuery("c")
                          ->select("c.ca_idconcepto,c.ca_concepto")
                          ->where("c.ca_transporte = ? AND c.ca_modalidad = ? ", array($transport_parameter, $modalidad_parameter))
                          ->addOrderBy("c.ca_concepto")
                          ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                          ->execute();

		$this->conceptos = array();

		foreach ( $results as $result ) {
			$row = array('idconcepto'=>$result["ca_idconcepto"], 'concepto'=>utf8_encode($result["ca_concepto"]));
			$this->conceptos[]=$row;
		}
        $this->responseArray = array("root"=>$this->conceptos, "total"=>count($this->conceptos), "success"=>true);

		$this->setTemplate("responseTemplate");
	}
}
?>
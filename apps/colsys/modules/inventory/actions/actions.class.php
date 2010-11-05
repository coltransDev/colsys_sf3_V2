<?php

/**
 * kbase actions.
 *
 * @package    colsys
 * @subpackage kbase
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class inventoryActions extends sfActions
{
	const RUTINA = "38";

    public function getNivel(){        
        $this->nivel = $this->getUser()->getNivelAcceso( inventoryActions::RUTINA );
		if( $this->nivel==-1 ){
			$this->forward404();
		}

        return $this->nivel;
    }
	/**
	* Muestra un listado de la base de datos
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
	
		$this->nivel = $this->getNivel();
	}



    /*
     * 
     */
    public function executeDatosPanelCategorias( $request ){
        $q  = Doctrine::getTable("InvCategory")
                                      ->createQuery("c")
                                      ->addOrderBy("c.ca_parent")
                                      ->addOrderBy("c.ca_order")
                                      ->addOrderBy("c.ca_name");
        $idcategoria = intval($request->getParameter("node"));
        
        if( $idcategoria ){
            $q->addWhere("c.ca_parent = ?", $idcategoria );
        }else{
            $q->addWhere("c.ca_parent IS NULL");
        }
        $this->categorias = $q->execute();
    }


    /*
     *
     */
    public function executeDatosPanelActivos( $request ){

        $idcategory = $request->getParameter("idcategory");
        $this->forward404Unless( $idcategory );
        
        $q  = Doctrine::getTable("InvActivo")
                                      ->createQuery("a");
                                      
        $q->addWhere("a.ca_idcategory = ?", $idcategory );
        //$q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $q->limit(200);
		$activos = $q->execute();
        $result = array();
        foreach( $activos as $activo){
            $row = array();
            $row["idactivo"]=utf8_encode($activo->getCaIdactivo());
            $row["idcategory"]=utf8_encode($activo->getCaIdcategory());
            $row["identificador"]=utf8_encode($activo->getCaIdentificador());
            $row["marca"]=utf8_encode($activo->getCaMarca());
            $row["modelo"]=utf8_encode($activo->getCaModelo());
            $row["version"]=utf8_encode($activo->getCaVersion());
            $row["procesador"]=utf8_encode($activo->getCaProcesador());
            $row["memoria"]=utf8_encode($activo->getCaMemoria());
            $row["disco"]=utf8_encode($activo->getCaDisco());
            $row["optica"]=utf8_encode($activo->getCaOptica());
            $row["serial"]=utf8_encode($activo->getCaSerial());
            $row["noinventario"]=utf8_encode($activo->getCaNoinventario());
            $row["ubicacion"]=utf8_encode($activo->getCaUbicacion());
            $row["fchcompra"]=utf8_encode($activo->getCaFchcompra());
            $row["observaciones"]=utf8_encode($activo->getCaObservaciones());
            $row["contrato"]=utf8_encode($activo->getCaContrato());
            $row["folder"] = utf8_encode(base64_encode($activo->getDirectorioBase()));
            $row["ipaddress"]=utf8_encode($activo->getCaIpaddress());
            $row["empresa"]=utf8_encode($activo->getCaEmpresa());
            $row["proveedor"]=utf8_encode($activo->getCaProveedor());
            $row["factura"]=utf8_encode($activo->getCaFactura());
            $row["reposicion"]=utf8_encode($activo->getCaReposicion());
            $row["so"]=utf8_encode($activo->getCaSo());
            $row["asignadoa"] = utf8_encode($activo->getCaAsignadoa());
            $row["asignadoaNombre"] = utf8_encode($activo->getUsuario()->getCaNombre());
            $result[]=$row;
        }

        $this->responseArray = array("success"=>true, "root"=>$result);

        $this->setTemplate("responseTemplate");
    }


    /*
     *
     */
    public function executeDatosActivo( $request ){
        $idactivo = $request->getParameter("idactivo");
        $this->forward404Unless( $idactivo );

        $activo = Doctrine::getTable("InvActivo")->find( $idactivo );
        $this->forward404Unless( $activo );


        $data = array();
        $data["identificador"] = $activo->getCaIdentificador();
        $data["idactivo"] = $activo->getCaIdactivo();
        $data["idcategory"] = $activo->getCaIdcategory();
        $data["noinventario"] = $activo->getCaNoinventario();
        $data["serial"] = $activo->getCaSerial();
        $data["marca"] = utf8_encode($activo->getCaMarca());
        $data["modelo"] = utf8_encode($activo->getCaModelo());
        $data["version"] = utf8_encode($activo->getCaVersion());
        $data["ipaddress"] = utf8_encode($activo->getCaIpaddress());
        $data["procesador"] = utf8_encode($activo->getCaProcesador());
        $data["memoria"] = utf8_encode($activo->getCaMemoria());
        $data["disco"] = utf8_encode($activo->getCaDisco());
        $data["optica"] = utf8_encode($activo->getCaOptica());
        $data["so"] = utf8_encode($activo->getCaSo());
        $data["ubicacion"] = utf8_encode($activo->getCaUbicacion());
        $data["empresa"] = utf8_encode($activo->getCaEmpresa());
        $data["proveedor"] = utf8_encode($activo->getCaProveedor());
        $data["factura"] = utf8_encode($activo->getCaFactura());
        $data["fchcompra"] = utf8_encode($activo->getCaFchcompra());
        $data["reposicion"] = utf8_encode($activo->getCaReposicion());
        $data["contrato"] = utf8_encode($activo->getCaContrato());
        $data["observaciones"] = utf8_encode($activo->getCaObservaciones());
        $data["asignadoa"] = utf8_encode($activo->getCaAsignadoa());
        $data["asignadoaNombre"] = utf8_encode($activo->getUsuario()->getCaNombre());
        
        $this->responseArray = array("success"=>true, "data"=>$data);

    

        $this->setTemplate("responseTemplate");
    }


    /*
     *
     */
    public function executeFormActivoGuardar( $request ){

        $idactivo = $request->getParameter("idactivo");
        if( $idactivo ){
            $activo = Doctrine::getTable("InvActivo")->find( $idactivo );
            $this->forward404Unless( $activo );
        }else{
            $activo = new InvActivo();
        }
        
        $activo->setCaIdcategory( $request->getParameter("idcategory") );
        $activo->setCaNoinventario( strtoupper($request->getParameter("noinventario")) );
        $activo->setCaIdentificador( utf8_decode(strtoupper($request->getParameter("identificador"))) );
        $activo->setCaSerial( $request->getParameter("serial") );
        $activo->setCaMarca( utf8_decode($request->getParameter("marca")) );
        $activo->setCaModelo( utf8_decode($request->getParameter("modelo")) );
        $activo->setCaVersion( utf8_decode($request->getParameter("version")) );
        $activo->setCaIpaddress( $request->getParameter("ipaddress") );
        $activo->setCaProcesador( utf8_decode($request->getParameter("procesador")) );
        $activo->setCaMemoria( utf8_decode($request->getParameter("memoria")) );
        $activo->setCaDisco( utf8_decode($request->getParameter("disco")) );
        $activo->setCaOptica( utf8_decode($request->getParameter("optica")) );
        $activo->setCaSo( utf8_decode($request->getParameter("so")) );
        $activo->setCaUbicacion( utf8_decode($request->getParameter("ubicacion")) );
        $activo->setCaEmpresa( utf8_decode($request->getParameter("empresa")) );
        $activo->setCaProveedor( utf8_decode($request->getParameter("proveedor")) );
        $activo->setCaFactura( utf8_decode($request->getParameter("factura")) );
        if( $request->getParameter("asignadoa") ){
            $activo->setCaAsignadoa( $request->getParameter("asignadoa") );
        }

        if( $request->getParameter("fchcompra") ){
            $activo->setCaFchcompra( $request->getParameter("fchcompra") );
        }else{
            $activo->setCaFchcompra( null );
        }
        if( floatval($request->getParameter("reposicion")) ){
            $activo->setCaReposicion( floatval($request->getParameter("reposicion")) );
        }else{
            $activo->setCaReposicion( null );
        }
        
        if( $request->getParameter("contrato") ){
            $activo->setCaContrato( utf8_decode($request->getParameter("contrato")) );
        }else{
            $activo->setCaContrato( null);
        }

        if( $request->getParameter("observaciones") ){
            $activo->setCaObservaciones( utf8_decode($request->getParameter("observaciones")) );
        }else{
            $activo->setCaObservaciones( null);
        }


        try{
            $activo->save();
            $this->responseArray = array("success"=>true, "idactivo"=>$activo->getCaIdactivo());
        }catch (Exception $e){
            $this->responseArray = array("success"=>false, "errorInfo"=>$e->getMessage());
        }
        
        $this->setTemplate("responseTemplate");
    }
    
    
    /**
	* Guarda un seguimiento a un activo
	*
	* @param sfRequest $request A request object
	*/
	public function executeGuardarSeguimiento(sfWebRequest $request){

        $this->nivel = $this->getNivel();
        $idactivo = $request->getParameter("idactivo");
		$this->forward404Unless( $idactivo );

        

		$seguimiento = new InvSeguimiento();
		$seguimiento->setCaIdactivo( $idactivo );
		$seguimiento->setCaText( utf8_decode($request->getParameter("text")) );
		$seguimiento->save();

		

        $texto = sfContext::getInstance()->getController()->getPresentationFor( 'inventory', 'verSeguimientos');
        
        $this->responseArray = array("success"=>true, "idactivo"=>$idactivo, "info"=>utf8_encode($texto));
        $this->setTemplate("responseTemplate");


	}

    /**
	* Guarda un seguimiento a un activo
	*
	* @param sfRequest $request A request object
	*/
	public function executeVerSeguimientos(sfWebRequest $request){

        $this->nivel = $this->getNivel();
        $idactivo = $request->getParameter("idactivo");
		$this->forward404Unless( $idactivo );

        $this->seguimientos = Doctrine::getTable("InvSeguimiento")
                              ->createQuery("s")
                              ->addWhere("s.ca_idactivo = ? ", $idactivo)
                              ->addOrderBy("s.ca_fchcreado ASC")
                              ->execute();

	}


    /*
     *
     */
    public function executePanelCategoriaGuardar( $request ){
        $idcategory = $request->getParameter("idcategory");

        if( $idcategory ){
            $categoria = Doctrine::getTable("InvCategory")->find($idcategory);
            $this->forward404Unless( $categoria );
        }else{
            $categoria = new InvCategory();
            $main = $this->getRequestParameter("main");
            $categoria->setCaMain($main=="on");
        }


        $categoria->setCaName(utf8_decode($this->getRequestParameter("name")));
        if( $this->getRequestParameter("parent") ){
            $categoria->setCaParent(utf8_decode($this->getRequestParameter("parent")));
        }else{
            $categoria->setCaParent(null);
        }

        try{
            $categoria->save();
            $this->responseArray = array("success"=>true);
        }catch( Exception $e ){
            $this->responseArray = array("success"=>false, "errorInfo"=>$e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }


    /*
     *
     */
    public function executeEliminarCategoria( $request ){
        $idcategory = $request->getParameter("idcategory");

        if( $idcategory ){
            $categoria = Doctrine::getTable("InvCategory")->find($idcategory);
            $this->forward404Unless( $categoria );

            try{
                $categoria->delete();
                $this->responseArray = array("success"=>true);
            }catch( Exception $e ){
                $this->responseArray = array("success"=>false, "errorInfo"=>$e->getMessage());
            }


        }else{
            $this->responseArray = array("success"=>false);
        }


        $this->setTemplate("responseTemplate");
    }
    /*
     *
     */
    public function executeCambiarCategoria( $request ){
        $idactivo = $request->getParameter("idactivo");
        $idcategory = $request->getParameter("idcategory");

        if( $idactivo ){
            $activo = Doctrine::getTable("InvActivo")->find($idactivo);
            $this->forward404Unless( $activo );

            try{
                $activo->setCaIdcategory($idcategory);
                $activo->stopBlaming();
                $activo->save();
                $this->responseArray = array("success"=>true);
            }catch( Exception $e ){
                $this->responseArray = array("success"=>false, "errorInfo"=>$e->getMessage());
            }


        }else{
            $this->responseArray = array("success"=>false);
        }


        $this->setTemplate("responseTemplate");
    }

     /*
     *
     */
    public function executeDatosPanelAsignaciones( $request ){
        $idactivo = $request->getParameter("idactivo");
        $idcategory = $request->getParameter("idcategory");

        if( $idactivo ){
            $asignaciones = Doctrine::getTable("InvAsignacion")
                            ->createQuery("a")
                            ->addWhere("a.ca_idactivo = ? ", $idactivo)
                            ->execute();

            
            $data = array();

            foreach( $asignaciones as $asignacion ){
                $row = array();
                $row["idactivo"] = $asignacion->getCaIdactivo();
                $row["login"] = $asignacion->getCaLogin();
                $row["fchasignacion"] = $asignacion->getCaFchasignacion();

                $data[] = $row;

            }

            $this->responseArray = array("success"=>true, "root"=>$data);

            


        }else{
            $this->responseArray = array("success"=>false);
        }


        $this->setTemplate("responseTemplate");
    }





}
?>
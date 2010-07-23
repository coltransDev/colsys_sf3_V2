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
            $row["folder"] = utf8_encode(base64_encode($activo->getDirectorioBase()));
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
        $data["reposicion"] = utf8_encode($activo->getCaReposicion());
        $data["contrato"] = utf8_encode($activo->getCaContrato());
        $data["observaciones"] = utf8_encode($activo->getCaObservaciones());        
        
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
        $activo->setCaNoinventario( $request->getParameter("noinventario") );
        $activo->setCaSerial( $request->getParameter("serial") );
        $activo->setCaMarca( $request->getParameter("marca") );
        $activo->setCaModelo( $request->getParameter("modelo") );
        $activo->setCaVersion( $request->getParameter("version") );
        $activo->setCaIpaddress( $request->getParameter("ipaddress") );
        $activo->setCaProcesador( $request->getParameter("procesador") );
        $activo->setCaMemoria( $request->getParameter("memoria") );
        $activo->setCaDisco( $request->getParameter("disco") );
        $activo->setCaOptica( $request->getParameter("optica") );
        $activo->setCaSo( $request->getParameter("so") );
        $activo->setCaUbicacion( $request->getParameter("ubicacion") );
        $activo->setCaEmpresa( $request->getParameter("empresa") );
        $activo->setCaProveedor( $request->getParameter("proveedor") );
        $activo->setCaFactura( $request->getParameter("factura") );
        if( floatval($request->getParameter("reposicion")) ){
            $activo->setCaReposicion( floatval($request->getParameter("reposicion")) );
        }else{
            $activo->setCaReposicion( null );
        }
        $activo->setCaContrato( $request->getParameter("contrato") );
        $activo->setCaObservaciones( $request->getParameter("observaciones") );


        try{
            $activo->save();
            $this->responseArray = array("success"=>true, "idactivo"=>$activo->getCaIdactivo());
        }catch (Exception $e){
            $this->responseArray = array("success"=>false, "errorInfo"=>$e->getMessage());
        }
        
        $this->setTemplate("responseTemplate");
    }

}
?>
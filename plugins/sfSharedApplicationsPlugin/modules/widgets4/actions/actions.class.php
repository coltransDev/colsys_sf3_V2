<?php

/**
 * widgets actions.
 *
 * @package    colsys
 * @subpackage widgets
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class widgets4Actions extends sfActions {

        
    
    public function executeDatosCuentasSiigo( sfWebRequest $request  ){
        
        $idempresa=$request->getParameter("idempresa");
        
        
        $q = Doctrine::getTable("SiigoCuenta")
                       ->createQuery("c")
                       ->addOrderBy("c.codigocuenta")
                       ->setHydrationMode(Doctrine::HYDRATE_ARRAY);

        if($idempresa!="")
            $q->addWhere ("ca_idempresa = ? ", $idempresa);
        $data = $q->execute();

        
        //$data = array();

        foreach( $data as $k=>$d )
        {
            $data[$k]["nombrecuenta"]= $d["codigocuenta"]."-".$d["nombrecuenta"];
        }

        $this->responseArray = array("root"=>$data, "total"=>count($data), "success"=>true );

        $this->setTemplate("responseTemplate");
    }
    
    
    
    public function executeDatosHouse($request ){
        
        $this->idmaster=$request->getParameter("idmaster");
        
        $q = Doctrine::getTable("InoHouse")
                    ->createQuery("h")
                    ->select("h.ca_idhouse,h.ca_doctransporte,cl.ca_idcliente,cl.ca_compania,
                        (SELECT COUNT(*) FROM inoComprobante c WHERE c.ca_idhouse=h.ca_idhouse) as ncomprobante")                    
                    ->innerJoin("h.Cliente cl")                    
                    ->where("h.ca_idmaster = ?", $this->idmaster )
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
                    $sql=$q->getSqlQuery();
                    $datos=$q->execute();
        $this->data=array();
        foreach($datos as $d)
        {
            //print_r($d);
            
            $this->data[]=array(
                "id"=>$d["h_ca_idhouse"],"name"=>  ($d["h_ca_doctransporte"]."-".$d["cl_ca_compania"]) , 
                "idcliente"=>$d["cl_ca_idcliente"], "cliente"=>$d["cl_ca_compania"],
                "class"=>($d["h_ncomprobante"]>0?"":"row_pink")
                );
        }
        
        $this->responseArray = array("root" => $this->data, "total" => count($this->data), "success" => true,"debug"=>$sql);
        $this->setTemplate("responseTemplate");
    }
    
    
    public function executeDatosCuentasParametros($request ){
        
        $idempresa=$request->getParameter("idempresa");
        
        $this->data = array();        
        
        
        $con = Doctrine_Manager::getInstance()->connection();
        
        $sql="SELECT s.codigocuenta,nombrecuenta FROM tb_parametros p
            INNER JOIN t_cuenta s ON s.codigocuenta::TEXT=p.ca_valor2::TEXT AND s.ca_idempresa=".$idempresa."
            WHERE ca_casouso='CU236'  ";
        $st = $con->execute($sql);
        $datos = $st->fetchAll();
        
        foreach( $datos as $d ){
            $this->data[]=array("id"=>$d["codigocuenta"],"name"=>$d["codigocuenta"]." - ".$d["nombrecuenta"]);
        }
        
        $this->responseArray = array("root" => $this->data, "total" => count($this->data), "success" => true);
        $this->setTemplate("responseTemplate");
        
    }
    
    public function executeDatosClienteSucursal($request) {
        $query = $request->getParameter("query");
        $idempresa = $request->getParameter("idempresa");
        
        $q = Doctrine_Query::create()
                ->select("c.ca_ciudad,s.ca_direccion,s.ca_idsucursal,s.ca_id,ids.ca_nombre,cl.ca_propiedades")
                ->from("IdsSucursal s")
                ->innerJoin("s.Ciudad c")
                ->innerJoin("s.Ids ids")
                ->innerJoin("ids.IdsCliente cl")
                ->where("UPPER(ids.ca_nombre) like ?", "%".strtoupper($query)."%")
                ->addOrderBy("c.ca_ciudad")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                
                $sucursales=$q->execute();                
        $sucursal = array();
        //print_r($sucursales);
        foreach ($sucursales as $suc) {

            if( $suc["cl_ca_propiedades"] ){
                $idempresa=($idempresa=="")?$suc["tcomp_ca_idempresa"]:$idempresa;
                $array = sfToolkit::stringToArray( $suc["cl_ca_propiedades"] );
                if($idempresa=="2")
                {
                    $cuenta_forma_pago=isset($array["cuenta_forma_pago_coltrans"])?$array["cuenta_forma_pago_coltrans"]:'';
                }
                else if($idempresa=="8")
                    $cuenta_forma_pago=isset($array["cuenta_forma_pago_colotm"])?$array["cuenta_forma_pago_colotm"]:'';
                else
                    $cuenta_forma_pago='';
            }
            $sucursal[] = array(
                "idsucursal" => $suc["s_ca_idsucursal"],
                "ciudad" => utf8_encode($suc["c_ca_ciudad"]),
                "direccion" => utf8_encode($suc["s_ca_direccion"]),
                "idcliente" => $suc["s_ca_id"],
                "compania" => utf8_encode($suc["ids_ca_nombre"]."-".$suc["c_ca_ciudad"]),
                "cuentapago"=>$cuenta_forma_pago
            );
        }
        $this->responseArray = array("root" => $sucursal, "total" => count($sucursal), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosDocumentos($request ){
        $this->idsserie=$request->getParameter("idsserie");
        
        $q = Doctrine::getTable("TipoDocumental")
                    ->createQuery("t")
                    ->select("*")                            
                    ->where("ca_idsserie = ?", $this->idsserie )
                    ->setHydrationMode(Doctrine::HYDRATE_ARRAY);
                    //echo $q->getSqlQuery();
                    $tipoDocs=$q->execute();
                    
        $this->tipoDocs=array();
        foreach($tipoDocs as $t)
        {
            $this->tipoDocs[]=array("id"=>$t["ca_iddocumental"],"name"=>  utf8_encode($t["ca_documento"]));
        }
        
        $this->responseArray = array("root" => $this->tipoDocs, "total" => count($this->tipoDocs), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
}

?>

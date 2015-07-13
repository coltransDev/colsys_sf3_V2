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

}

?>

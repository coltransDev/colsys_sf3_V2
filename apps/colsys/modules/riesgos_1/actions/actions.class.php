<?php

/**
 * gestDocumental actions.
 *
 * @package    colsys
 * @subpackage gestDocumental
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class contabilidadActions extends sfActions {

    
    
    const RUTINA_TERRESTRE = "158";
    public function preExecute(){        
                
        if(count($this->permisos)<1)
        {
            $this->nivel = $this->getUser()->getNivelAcceso( contabilidadActions::RUTINA_TERRESTRE );
            //echo $this->nivel;
            //$this->nivel=6;
            $this->permisos=array("imprimir"=>false,"anular"=>false,"busquedatotal"=>false,"maestras"=>false,"enviarsiigo"=>false);
            //echo "nivel".$this->nivel;            

            switch ($this->nivel)
            {
                case "1"://operativo
                    $this->permisos["imprimir"]=true;
                    $this->permisos["enviarsiigo"]=true;
                break;
                case "2"://contabilidad
                    $this->permisos["imprimir"]=true;
                    $this->permisos["anular"]=true;
                    $this->permisos["busquedatotal"]=true;
                    $this->permisos["maestras"]=true;
                break;
                case "3"://auditoria
                    $this->permisos["busquedatotal"]=true;

                break;
                case "4"://admin
                    $this->permisos["imprimir"]=true;
                    $this->permisos["anular"]=true;
                    $this->permisos["busquedatotal"]=true;
                    $this->permisos["maestras"]=true;
                    $this->permisos["enviarsiigo"]=true;
                break;            
            }
        }
        //$this->permisos=array("imprimir"=>true,"anular"=>true,"busquedatotal"=>true,"maestras"=>true);
            //print_r($this->permisos);
       
        parent::preExecute();
    }
    
    /**
     * Executes index action
     *
     */
    public function executeIndex() {

        //$response = sfContext::getInstance()->getResponse();
        //$response->addJavaScript("extExtras/FileUploadField",'last');
    }
    
    public function executeIndexExt5() {

        //$response = sfContext::getInstance()->getResponse();
        //$response->addJavaScript("extExtras/FileUploadField",'last');
    }

    

   


    function executeDatosIndex($request) {
        $idproceso = ($request->getParameter("node") != "" && $request->getParameter("node") != "root") ? $request->getParameter("node") : "0";
        $tree = array("text" => "Proceso/Riesgo","leaf" => true,"id" => "1");
        
        if($idproceso==0)
        {
            
            $childrens1=array();
            
            if($this->permisos["maestras"])
            {
                $childrens1[] = array("text" => "Cuentas Contables","leaf" => true,"id" => "1");            
                $childrens1[] = array("text" => "Conceptos","leaf" => true,"id" => "2");
                $childrens[] = array("text" => "Administracion","leaf" =>false,"children"=>$childrens1);
            }
            $childrens1=array();
            $childrens1[] = array("text" => "Consulta","leaf" => true,"id" => "3");
            //$childrens1[] = array("text" => "Conceptos","leaf" => true,"id" => "2");
            
            $childrens[] = array("text" => "Comprobantes","leaf" =>false,"children"=>$childrens1);
            
        }

        $tree["children"] = $childrens;
        
        $this->responseArray = $tree;
        $this->setTemplate("responseTemplate");
    }
    
    
    
    function executeDatosConceptosSiigo($request) {
     
        $q = Doctrine::getTable("InoConSiigo")
                            ->createQuery("s")
                            ->select("s.*,e.ca_nombre")
                            ->innerjoin("s.Empresa e")
                             //->where("SUBSTR(ca_cod::TEXT,1,2)=? and ca_idempresa=?  ",array($ccosto->getCaCentro().$ccosto->getCaSubcentro() , $ccosto->getCaIdempresa()) )
                            ->addOrderBy( "s.ca_idconceptosiigo" )
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
            /*if($query!="")
            {
                $q->addWhere("UPPER(ca_descripcion) like ?",'%'.  strtoupper($query).'%');
            }*/
            $debug=$q->getSqlQuery();

        $conceptosSiigo=$q->execute();
        foreach($conceptosSiigo as $k=>$c)
        {
            $conceptosSiigo[$k]["s_ca_descripcion"]=utf8_encode($conceptosSiigo[$k]["s_ca_descripcion"]);
        }        

        $this->responseArray = array("success" => true, "root" => $conceptosSiigo, "total" => count($conceptosSiigo),"debug"=>$debug);
        $this->setTemplate("responseTemplate");
    }
    
    function executeDatosCuentas($request) {
     
        $q = Doctrine::getTable("SiigoCuenta")
                            ->createQuery("s")
                            ->select("s.codigocuenta,s.nombrecuenta,s.ca_idempresa,e.ca_nombre")
                            ->innerjoin("s.Empresa e")
                             //->where("SUBSTR(ca_cod::TEXT,1,2)=? and ca_idempresa=?  ",array($ccosto->getCaCentro().$ccosto->getCaSubcentro() , $ccosto->getCaIdempresa()) )
                            ->addOrderBy( "s.codigocuenta" )
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

            $debug=$q->getSqlQuery();
        
        $cuentas=$q->execute();
        foreach($cuentas as $k=>$c)
        {
            $cuentas[$k]["s_nombrecuenta"]=utf8_encode($cuentas[$k]["s_nombrecuenta"]);
            $cuentas[$k]["e_ca_nombre"]=utf8_encode($cuentas[$k]["e_ca_nombre"]);
        }

        $this->responseArray = array("success" => true, "root" => $cuentas, "total" => count($cuentas),"debug"=>$debug);
        $this->setTemplate("responseTemplate");
    }
    
    
    function executeGuardarGridCuentas($request) {
        
        $datos = $request->getParameter("datos");
        $cuentas = json_decode($datos);
        $ids = array();
        

        foreach($cuentas as  $c)
        {
            $cuenta = Doctrine::getTable("SiigoCuenta")->find(array($c->codigocuenta,$c->ca_idempresa));
            if(!$cuenta)
            {
                $cuenta= new SiigoCuenta();
                $cuenta->setCodigocuenta($c->codigocuenta);
                $cuenta->setCaIdempresa($c->ca_idempresa);
            }
            $cuenta->setNombrecuenta($c->nombrecuenta);
            $cuenta->save();
            $ids[] = $c->id;
        }
        
        $this->responseArray = array("errorInfo" => $errorInfo, "id" => implode(",", $ids), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    
    function executeGuardarGridConceptos($request) {
        
        $datos = $request->getParameter("datos");
        $cuentas = json_decode($datos);
        $ids = array();
        $errorInfo="";

        foreach($cuentas as  $c)
        {
            try
            {
                $concepto = Doctrine::getTable("InoConSiigo")->find(array($c->ca_idconceptosiigo));
                if(!$concepto)
                {                
                    $concepto= new InoConSiigo();
                    $concepto->setCaCuenta($c->ca_cuenta);
                    $concepto->setCaIdempresa($c->ca_idempresa);
                }            
                $concepto->setCaDescripcion($c->ca_descripcion);
                $concepto->setCaPt($c->ca_pt);
                $concepto->setCaIva($c->ca_iva);
                $concepto->setCaPorciva($c->ca_porciva);
                $concepto->save();
                $ids[] = $c->id;
            }
            catch(Exception $e)
            {
                $errorInfo.=$c->ca_descripcion+":"+$e->getMessage()."<br>";
            }
        }
        
        $this->responseArray = array("errorInfo" => $errorInfo, "id" => implode(",", $ids), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    
    function executeConsultaResult($request) {
        
        $fecha_inicial = $request->getParameter("fecha_inicial");
        
        $fecha_final = $request->getParameter("fecha_final");
        $idtipocomprobante = $request->getParameter("idtipocomprobante");
        $no_comprobante = $request->getParameter("no_comprobante");
        $no_comprobante2 = $request->getParameter("no_comprobante2");
        $ca_referencia = $request->getParameter("ca_referencia");
        $ca_estado = $request->getParameter("ca_estado");
        
        $q = Doctrine::getTable("InoViConsComprobante")
                            ->createQuery("s")
                            ->select("s.*")
                            //->innerjoin("s.Empresa e")
                             //->where("SUBSTR(ca_cod::TEXT,1,2)=? and ca_idempresa=?  ",array($ccosto->getCaCentro().$ccosto->getCaSubcentro() , $ccosto->getCaIdempresa()) )
                            //->addOrderBy( "s.codigocuenta" )
                            ->setHydrationMode(Doctrine::HYDRATE_ARRAY);
        
        if($fecha_inicial!="")
        {
            $q->addWhere("ca_fchgenero >= ?", $fecha_inicial );
        }
        if($fecha_final!="")
        {
            $q->addWhere("ca_fchgenero <= ?", $fecha_final );
        }
        
        if($no_comprobante!="" && $no_comprobante2=="")
        {
            $q->addWhere("ca_consecutivo = ?",$no_comprobante);
        }
        else if($no_comprobante!="" && $no_comprobante2!="")
        {
            $q->addWhere("ca_consecutivo BETWEEN ? AND ?",array($no_comprobante,$no_comprobante2));
        }
            
        
        if($idtipocomprobante!="")
        {
            $q->addWhere("ca_idtipo = ?", $idtipocomprobante );
        }
        
        if($ca_referencia!="")
        {
            $q->addWhere("ca_referencia like ?", '%'.$ca_referencia.'%' );
        }
        if($ca_estado!="")
        {
            $q->addWhere("ca_estado = ?",$ca_estado);
        }
        
        //echo $q->getSqlQuery();
        $comprobantes=$q->execute();
        
        foreach($comprobantes as $k=>$c)
        {
            $comprobantes[$k]["ca_ciuorigen"]=utf8_encode($comprobantes[$k]["ca_ciuorigen"]);
            $comprobantes[$k]["ca_ciudestino"]=utf8_encode($comprobantes[$k]["ca_ciudestino"]);
                    
        }
        //echo "<pre>";print_r($comprobantes);echo "</pre>";
        //echo "<pre>";print_r($comprobantes);echo "</pre>";
        $this->responseArray = array("errorInfo" => $errorInfo, "root" => $comprobantes, "success" => true,"debug"=>$q->getSqlQuery());
        $this->setTemplate("responseTemplate");
        
    }
    
    function executeBusquedaComprobantes($request) {
        
        
        $fecha_inicial = $request->getParameter("fecha_inicial");
        
        $fecha_final = $request->getParameter("fecha_final");
        $idtipocomprobante = $request->getParameter("idtipocomprobante");
        $no_comprobante = $request->getParameter("no_comprobante");
        
        $this->getRequest()->setParameter('fecha_inicial', $fecha_inicial);
        $this->getRequest()->setParameter('fecha_final', $fecha_final);
        $this->getRequest()->setParameter('idtipocomprobante', $idtipocomprobante);
        $this->getRequest()->setParameter('no_comprobante', $no_comprobante);
        $html = sfContext::getInstance()->getController()->getPresentationFor('contabilidad', 'busquedaResult');
        
        $this->responseArray = array("errorInfo" => $errorInfo, "html" => $html, "success" => true);
        $this->setTemplate("responseTemplate");
        
    }
    
    
    function executeAnularComprobantes($request) {
        
        $ids = json_decode($request->getParameter("id"));
        $observaciones=$request->getParameter("observaciones");
        $errorInfo="";
        try{
        
            $this->comprobantes =Doctrine::getTable("InoComprobante")
                                             ->createQuery("c")
                                             ->select("*")                                         
                                             ->andWhereIn("ca_idcomprobante",$ids)
                                             ->execute();

            //$comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);            
            foreach($this->comprobantes as $comprobante)
                $comprobante->anular($this->getUser()->getUserId(),$observaciones);
        }
        catch(Exception $e)
        {
            $errorInfo.=$e->getMessage()."<br>";
        }
        $this->responseArray = array("errorInfo" => $errorInfo, "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    
    public function executeEnviarSiigoConect(sfWebRequest $request) {
    
        $this->forward404Unless( $request->getParameter("idcomprobante") );
        
        //$this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("id"));
        
        
        $ids = json_decode($request->getParameter("idcomprobante"));        
        $html=array();
        foreach($ids as $idcomprobante)
        {
            $this->getRequest()->setParameter('respuesta', "false" );
            $this->getRequest()->setParameter('idcomprobante', $idcomprobante );
            sfContext::getInstance()->getController()->getPresentationFor('ino', 'EnviarSiigoConect');
            //$html[]=json_decode($html);
        }
        //$this->responseArray = array("errorInfo" => $errorInfo, "success" => true,"html"=>$html);
        //$this->setTemplate("responseTemplate");
    }
    

}

?>
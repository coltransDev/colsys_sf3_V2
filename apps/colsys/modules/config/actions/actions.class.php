<?php

/**
 * config actions.
 *
 * @package    symfony
 * @subpackage config
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class configActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
        $this->params = Doctrine::getTable("ColsysConfig")
                                ->createQuery("p")
                                ->addOrderBy("p.ca_param")
                                ->execute();
        
        
    }
    
    
    
    public function executeIndexExt5(sfWebRequest $request) {

    }
    
    
    
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeFormParam(sfWebRequest $request) {
        
        if( $request->getParameter("idconfig") ){
            $config = Doctrine::getTable("ColsysConfig")->find( $request->getParameter("idconfig") );
            $this->forward404Unless($config);
        }else{
            $config = new ColsysConfig();
        }
       
        $this->form = new ParamForm();
        
        if( $request->isMethod("post") ){
            $bindValues = array();
            $bindValues["idconfig"] = $request->getParameter("idconfig");
            $bindValues["module_param"] = $request->getParameter("module_param");
            $bindValues["param"] = $request->getParameter("param");
            $bindValues["description"] = $request->getParameter("description");
            
            $this->form->bind( $bindValues );
            if( $this->form->isValid() ){
                $config->setCaModule( $request->getParameter("module_param") );
                $config->setCaParam( $request->getParameter("param") );
                $config->setCaDescription( $request->getParameter("description") );
                $config->save();                 
                $this->redirect("config/index");            
            }
        }
        $this->config = $config;
    }
    
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeFormValue(sfWebRequest $request) {
                
        if( $request->getParameter("idvalue") ){
            $value = Doctrine::getTable("ColsysConfigValue")->find( $request->getParameter("idvalue") );
            $this->forward404Unless($value);
        }else{
            $this->forward404Unless($request->getParameter("idconfig"));
            $config = Doctrine::getTable("ColsysConfig")->find( $request->getParameter("idconfig") );
            $this->forward404Unless($config);
            $value = new ColsysConfigValue();
            $value->setCaIdconfig( $request->getParameter("idconfig") );
        }
       
        $this->form = new ParamValueForm();
        
        if( $request->isMethod("post") ){
            $bindValues = array();
            $bindValues["idconfig"] = $request->getParameter("idconfig");
            $bindValues["idvalue"] = $request->getParameter("idvalue");
            $bindValues["ident"] = $request->getParameter("ident");
            $bindValues["value"] = $request->getParameter("value");
            $bindValues["value2"] = $request->getParameter("value2");
            
            $this->form->bind( $bindValues );
            if( $this->form->isValid() ){
                $value->setCaIdent( $request->getParameter("ident") );
                $value->setCaValue( $request->getParameter("value") );
                $value->setCaValue2( $request->getParameter("value2") );
                $value->save();                 
                $this->redirect("config/index");            
            }
        }
        $this->value = $value;
    }
    
    
    function executeDatosIndex($request) {
        $idopcion = ($request->getParameter("node") != "" && $request->getParameter("node") != "root") ? $request->getParameter("node") : "0";
        $tree = array("text" => "Opciones","leaf" => true,"id" => "1");
        
        if($idopcion==0)
        {
            $childrens[] = array("text" => "Dian Servicios","leaf" => true,"id" => "1");            
            $childrens[] = array("text" => "No. Radicaci&oacute;n Muisca","leaf" => true,"id" => "2");
            $childrens[] = array("text" => "Bodegas","leaf" => true,"id" => "3");
            $childrens[] = array("text" => "Cargos","leaf" => true,"id" => "4");
        }

        $tree["children"] = $childrens;
        
        $this->responseArray = $tree;
        $this->setTemplate("responseTemplate");
    }
    
    function executeDatosDianServicios($request) {
        
        $q = Doctrine::getTable("DianServicios")
                            ->createQuery("s")
                            ->select("s.*")                            
                             //->where("SUBSTR(ca_cod::TEXT,1,2)=? and ca_idempresa=?  ",array($ccosto->getCaCentro().$ccosto->getCaSubcentro() , $ccosto->getCaIdempresa()) )
                            ->addOrderBy( "s.ca_razonsocial" )
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

            $debug=$q->getSqlQuery();
        
        $servicios=$q->execute();
        //echo count($servicios);
        foreach($servicios as $k=>$c)
        {
            $servicios[$k]["s_ca_razonsocial"]=utf8_encode($servicios[$k]["s_ca_razonsocial"]);
            $servicios[$k]["s_ca_ciudad"]=utf8_encode($servicios[$k]["s_ca_ciudad"]);
            $servicios[$k]["s_ca_tipo"]=utf8_encode($servicios[$k]["s_ca_tipo"]);
        }
        //echo "<pre>";print_r($servicios);echo "</pre>";

        $this->responseArray = array("success" => true, "root" => $servicios, "total" => count($servicios),"debug"=>$debug);
        $this->setTemplate("responseTemplate");
    }
    
    function executeDatosBodegas($request) {
        
        $q = Doctrine::getTable("Bodega")
                            ->createQuery("s")
                            ->select("*")                            
                             //->where("SUBSTR(ca_cod::TEXT,1,2)=? and ca_idempresa=?  ",array($ccosto->getCaCentro().$ccosto->getCaSubcentro() , $ccosto->getCaIdempresa()) )
                            ->addOrderBy( "s.ca_nombre" )
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

            $debug=$q->getSqlQuery();
        
        $bodegas=$q->execute();
        //echo count($servicios);        
        foreach($bodegas as $k=>$c)
        {
            $bodegas[$k]["s_ca_nombre"]=utf8_encode($bodegas[$k]["s_ca_nombre"]);
            $bodegas[$k]["s_ca_tipo"]=utf8_encode($bodegas[$k]["s_ca_tipo"]);
            $bodegas[$k]["s_ca_transporte"]=utf8_encode($bodegas[$k]["s_ca_transporte"]);
            $bodegas[$k]["s_ca_direccion"]=utf8_encode($bodegas[$k]["s_ca_direccion"]);
        }
        //echo "<pre>";print_r($bodegas);echo "</pre>";

        $this->responseArray = array("success" => true, "root" => $bodegas, "total" => count($bodegas),"debug"=>$debug);
        $this->setTemplate("responseTemplate");
    }

    
    function executeGuardarBodegas($request) {
        
        $datos = $request->getParameter("datos");
        $bodegas = json_decode($datos);
        $ids = array();
        
        foreach($bodegas as  $c)
        {
            $bodega = Doctrine::getTable("Bodega")->find(array($c->s_ca_idbodega));
            if(!$bodega)
            {
                $bodega= new bodega();
                //$bodega->setCodigocuenta($c->codigocuenta);
                //$bodega->setCaIdempresa($c->ca_idempresa);
            }
            $bodega->setCaNombre($c->s_ca_nombre);
            
            $bodega->setCaNombre(utf8_decode($c->s_ca_nombre));
            $bodega->setCaTipo(utf8_decode($c->s_ca_tipo));
            $bodega->setCaTransporte(utf8_decode($c->s_ca_transporte));
            $bodega->setCaCodDian($c->s_ca_cod_dian);
            $bodega->setCaDireccion(utf8_decode($c->s_ca_direccion));
            $bodega->setCaIdentificacion($c->s_ca_identificacion);
            
            
            $bodega->save();
            $ids[] = $c->id;
        }
        
        $this->responseArray = array("errorInfo" => $errorInfo, "id" => implode(",", $ids), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    
        /*
     * @Nataly
     * @return arreglo de cargos por empresa
     * @param $request 
        * idempresa: n\FAmero de identificaci\F3n de la empresa
     */
    function executeDatosCargos($request) {
        $empresa = $request->getParameter("idempresa");
        
        $c=Doctrine::getTable("Cargo")
                            ->createQuery("s")
                            ->select("count(*)")
                            ->where("s.ca_idempresa= ?",$empresa) 
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $debug=$c->getSqlQuery();
        $totalc=$c->execute();
        
        $q = Doctrine::getTable("Cargo")
                            ->createQuery("s")
                            ->select("*")
                            ->addOrderBy( "s.ca_cargo ASC" )
                            ->limit(71)
                            ->offset($request->getParameter("start"))
                            ->Where("s.ca_idempresa = ?",$empresa)
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $debug=$q->getSqlQuery();
        $cargos=$q->execute();
        
        foreach($cargos as $k=>$c)
        {
            $cargos[$k]["s_ca_cargo"]=utf8_encode($cargos[$k][utf8_encode("s_ca_cargo")]);
        }
        $this->responseArray = array("success" => true, "root" => $cargos, "total" => $totalc ,"debug"=>$debug,"idempresa"=>$empresa);
        $this->setTemplate("responseTemplate");
    }
    /*
     * @Nataly
     * @return nuevo Cargo
     * @param $request 
        * datos: Json de datos por almacenar
     */
    function executeGuardarGridCargos($request) {
        $datos = $request->getParameter("datos");
        $datos=  utf8_decode($datos);
        $cargos = json_decode($datos);
        $ids = array();
            foreach($cargos as  $c)
            {           
                $cargo = Doctrine::getTable("Cargo")->find($c->s_ca_cargo);
                if(!$cargo)
                {
                    $cargo = new Cargo();
                    $cargo->setCaCargo($c->ca_cargo);  
                }
                $cargo->setCaActivo($c->ca_activo);
                $cargo->setCaManager($c->ca_manager);
                $cargo->setCaIdempresa($c->ca_idempresa);            
                $cargo->save();
                $ids[] = $c->id;
            }
        $this->responseArray = array("errorInfo" => '', "id" => implode(",", $ids), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    
}

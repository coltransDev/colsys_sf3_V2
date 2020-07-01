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

    
    const RUTINA_GENERALES = 210;
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
        $this->params = Doctrine::getTable("ColsysConfig")
                                ->createQuery("p")
                                ->addOrderBy("p.ca_param, p.ca_idconfig")
                                ->execute();
        
        
    }
    
    
    
    public function executeIndexExt5(sfWebRequest $request) {

        $user = $this->getUser();
        $this->permisos = [];

        /*Accesos del usuario*/
        $permisosRutinas = $user->getControlAcceso(self::RUTINA_GENERALES);
        
        for($i=0;$i<count($permisosRutinas);$i++){
            $this->permisos[$permisosRutinas[$i]]=true;
        }
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
    

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */    
    function executeDatosIndex($request) {
        $idopcion = ($request->getParameter("node") != "" && $request->getParameter("node") != "root") ? $request->getParameter("node") : "0";
        $user = $this->getUser();
        
        /*Accesos del usuario*/
        $permisosRutinas = $user->getControlAcceso(self::RUTINA_GENERALES);
        //print_r($permisosRutinas);
        
        $tree = array("text" => "Opciones","leaf" => true,"id" => "1");
        
        if($idopcion==0)
        {
            if(in_array("Dian Servicios", $permisosRutinas) )
                $childrens[] = array("text" => "Dian Servicios","leaf" => true,"id" => "1");
            if(in_array("No. Radicacion Muisca", $permisosRutinas) )
                $childrens[] = array("text" => "No. Radicacion Muisca","leaf" => true,"id" => "2");
            if(in_array("Bodegas", $permisosRutinas) )
                $childrens[] = array("text" => "Bodegas","leaf" => true,"id" => "3");
            if(in_array("Maestra de clasificacion", $permisosRutinas) )
                $childrens[] = array("text" => "Maestra de clasificacion","leaf" => true,"id" => "4");
            if(in_array("Maestra de Conceptos", $permisosRutinas) )
                $childrens[] = array("text" => "Maestra de Conceptos","leaf" => true,"id" => "5");
            if(in_array("Parametros Usuarios", $permisosRutinas) )
                $childrens[] = array("text" => "Parametros Usuarios","leaf" => true,"id" => "6");
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
    
    
    
    function executeDatosClasificacion($request) {
        $tipo = $request->getParameter("tipo");
        $idpadre = ($request->getParameter("node") != "" && $request->getParameter("node") != "root") ? $request->getParameter("node") : "0";
        
        $nivel=0;
        $tree = array("text" => "Opciones","leaf" => true,"id" => "-1",$nivel=>"0");
        
        $items= MaestraClasificacionTable::getChildrens($idpadre,$nivel);
        
        if ($tipo) {
            foreach ($items as $item) {
                if ($item["tipo"] == $tipo) {
                    $tree["children"] = $item;
                }
            }
        } else {
            $tree["children"] = $items;
        }
        
        $this->responseArray = $tree;
        $this->setTemplate("responseTemplate");        
    }
    
    function executeAgregarItemClasificacion($request) {

        $idclasificacion = $request->getParameter("idclasificacion");
        $nombre = $request->getParameter("nombre");
        $tipo = $request->getParameter("tipo");
        $clasificacion= new MaestraClasificacion();
        $clasificacion->setCaNombre(utf8_decode($nombre));
        $clasificacion->setCaTipo($tipo);
        $clasificacion->setCaIdpadre($idclasificacion);
        $clasificacion->setCaEstado('A');
        $clasificacion->save();
        $this->responseArray = array("errorInfo" => $errorInfo, "idclasificacion" => $clasificacion->getCaIdclasificacion(), "tipo" => $clasificacion->getCaTipo(), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    
    function executeAnularItemClasificacion($request) {

        $idclasificacion = $request->getParameter("idclasificacion");
        $clasificacion = Doctrine::getTable("MaestraClasificacion")->find( $idclasificacion );
        $clasificacion->setCaEstado('I');
        $clasificacion->save();
        
        $this->responseArray = array("errorInfo" => $errorInfo,  "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    
    function executeDatosClasificacionCompletos($request) {

        
        
        $idpadre =  "1";
        $tipo = $request->getParameter("tipo");
        //$tree = array("text" => "Opciones","leaf" => true,"id" => "-1");        
        $tree[0] = array("text" => "Proveedores","leaf" => true,"id" => "-1","nivel"=>"0");
        $items=$this->getChildrens($idpadre);
        $tree[0]["children"] = $items;
        
        //$this->responseArray = $tree;
        
        $html="<table>";
        foreach($tree as $n0)
        {            
            //print_r($n1);
            $html.="<tr><td>".utf8_decode($n0["text"])."</td></tr>";
            foreach($n0["children"] as $n1)
            {
                $html.="<tr><td>".$n1["idclasificacion"]."</td><td>".utf8_decode($n1["text"])."</td></tr>";
                
                foreach($n1["children"] as $n2)
                {
                    $html.="<tr><td>".$n2["idclasificacion"]."</td><td>&nbsp;</td><td>".utf8_decode($n2["text"])."</td></tr>";
                    foreach($n2["children"] as $n3)
                    {
                        $html.="<tr><td>".$n3["idclasificacion"]."</td><td>&nbsp;</td><td>&nbsp;</td><td>".utf8_decode($n3["text"])."</td></tr>";
                        foreach($n3["children"] as $n4)
                        {
                            $html.="<tr><td>".$n4["idclasificacion"]."</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>".utf8_decode($n4["text"])."</td></tr>";
                            foreach($n4["children"] as $n5)
                            {
                                $html.="<tr><td>..".$n5["idclasificacion"].";</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>".utf8_decode($n5["text"])."</td></tr>";
                            }
                        }
                    }
                }
            }
            
        }
        $html.="</table>";
        echo $html;
    //echo "<pre>";print_r($tree);echo "</echopre>";
        
        exit;
        //$this->setTemplate("responseTemplate");        
    }
    
    function executeDatosDetalleConceptos() {
        //$empresa = $request->getParameter("idempresa");
        $q = Doctrine::getTable("InoConcepto")
                ->createQuery("c")
                ->select("c.*, mc.ca_concepto_esp")
                ->leftJoin("c.InoMaestraConceptos mc")
                ->addOrderBy("c.ca_concepto")
                ->addWhere("c.ca_fcheliminado IS NULL")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
    
        $debug = $q->getSqlQuery();

        $conceptos = $q->execute();
        foreach ($conceptos as $k => $c) {
            $conceptos[$k]["c_ca_concepto"] = utf8_encode($conceptos[$k]["c_ca_concepto"]);
            $conceptos[$k]["c_ca_incoterms"] = utf8_encode($conceptos[$k]["c_ca_incoterms"]);
            $conceptos[$k]["mc_ca_concepto_esp"] = utf8_encode($conceptos[$k]["mc_ca_concepto_esp"]);
        }
        $this->responseArray = array("success" => true, "root" => $conceptos, "total" => count($conceptos), "debug" => $debug);
        $this->setTemplate("responseTemplate");
    }
    
    function executeGuardarDetalleConceptos($request) {

        $datos = json_decode($request->getParameter("datos"));

        $conn = Doctrine::getTable("InoConcepto")->getConnection();
        $conn->beginTransaction();

        try {
            $ids = array();
            foreach ($datos as $dato) {
                $concepto = Doctrine::getTable("InoConcepto")->find($dato->ca_idconcepto);

                if (!$concepto) {
                    $concepto = new InoConcepto();
                }

                $concepto->setCaConcepto($dato->ca_concepto);
                $concepto->setCaTipo($dato->ca_tipo);
                $concepto->setCaIncoterms(str_replace(",", "|", $dato->ca_incoterms));
                $concepto->setCaFlete($dato->ca_flete);
                $concepto->setCaRecargolocal($dato->ca_recargolocal);
                $concepto->setCaRecargoorigen($dato->ca_recargoorigen);
                $concepto->setCaRecargootmdta($dato->ca_recargootmdta);
                $concepto->setCaCosto($dato->ca_costo);
                $concepto->setCaAplicaciones($dato->ca_aplicaciones);
                $concepto->setCaIdpadre($dato->ca_idpadre);
                $concepto->save($conn);

                $ids[] = $dato->id;
                $idconceptos[] = $concepto->getCaIdconcepto();
            }
            $conn->commit();
            $this->responseArray = array("success" => true, "ids" => $ids, "idconceptos" => $idconceptos);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
    
    function executeDatosMaestraConceptos($request) {
        $idconcepto = $request->getParameter("idconcepto");
        $idempresa = utf8_decode($request->getParameter("idempresa"));
        $impoexpo = utf8_decode($request->getParameter("impoexpo"));
        $idtransporte = utf8_decode($request->getParameter("idtransporte"));
        $compraventa = $request->getParameter("compraventa");        

        if ($request->getParameter("idcomprobante") != "" && $request->getParameter("idcomprobante") > 0) {
            $idcomprobante = $request->getParameter("idcomprobante");
            $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
            if ($comprobante) {
                $idtransporte = $comprobante->getInoHouse()->getInoMaster()->getCaTransporte()?$comprobante->getInoHouse()->getInoMaster()->getCaTransporte():$comprobante->getInoCentroCosto()->getCaTransporte();
                $impoexpo = $comprobante->getInoHouse()->getInoMaster()->getCaImpoexpo()?$comprobante->getInoHouse()->getInoMaster()->getCaImpoexpo():$comprobante->getInoCentroCosto()->getCaImpoexpo();
                $idempresa = $comprobante->getInoTipoComprobante()->getCaIdempresa();
            }
        }

        $q = Doctrine::getTable("InoMaestraConceptos")
                ->createQuery("mc")
                ->select("mc.*, "
                        . "(SELECT ec.ca_activo FROM InoEstadosConceptosSap ec WHERE mc.ca_idconcepto = ec.ca_idconcepto and ec.ca_idempresa = 2) as estado_coltrans,"
                        . "(SELECT ec1.ca_activo FROM InoEstadosConceptosSap ec1 WHERE mc.ca_idconcepto = ec1.ca_idconcepto and ec1.ca_idempresa = 8) as estado_colotm,"
                        . "(SELECT ec2.ca_activo FROM InoEstadosConceptosSap ec2 WHERE mc.ca_idconcepto = ec2.ca_idconcepto and ec2.ca_idempresa = 11) as estado_coldepositos,"
                        . "(SELECT ec3.ca_activo FROM InoEstadosConceptosSap ec3 WHERE mc.ca_idconcepto = ec3.ca_idconcepto and ec3.ca_idempresa = 12) as estado_colbodnal,"
                        . "(SELECT ec4.ca_activo FROM InoEstadosConceptosSap ec4 WHERE mc.ca_idconcepto = ec4.ca_idconcepto and ec4.ca_idempresa = 1) as estado_colmas"
                        )                                
                ->addOrderBy("mc.ca_concepto_esp")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

        if ($compraventa) {
            $q->addWhere("" . $compraventa . " = ?", true);
        }

        if ($idconcepto) {
            $q->addWhere("mc.ca_idconcepto = ?", $idconcepto);
        }

        if ($idempresa) {
            switch ($idempresa) {
                case 2: // Coltrans                    
                    $q->addWhere("mc.ca_importacion = ? OR mc.ca_exportacion = ? OR mc.ca_aereo = ? OR mc.ca_maritimo = ? OR mc.ca_contenedor = ? OR mc.ca_terrestre_nacional = ? OR mc.ca_admon = ?", array(true, true, true, true, true, true, true));                    
                    break;
                case 8: // Colotm
                    $q->addWhere("mc.ca_otm = ?", true);
                    //$q->addWhere("estado_colotm = TRUE");
                    break;
                case 11: // Coldepositos
                    $q->addWhere("mc.ca_depositos = ?", true);                    
                    break; 
                case 12: // Coldepositos
                    $q->addWhere("mc.ca_bodeganal = ?", true);                    
                    break; 
            }
            $q->addWhere("(SELECT iec.ca_activo FROM InoEstadosConceptosSap iec WHERE mc.ca_idconcepto = iec.ca_idconcepto and iec.ca_idempresa = $idempresa) = TRUE");
        }

        $empresas = array(2, 8);

        if (in_array($idempresa, $empresas)) {
            if ($idtransporte) {
                switch ($idtransporte) {
                    case Constantes::MARITIMO:
                        $q->addWhere("mc.ca_maritimo = ?", true);
                        break;
                    case Constantes::AEREO:
                        $q->addWhere("mc.ca_aereo = ?", true);
                        break;
                    case Constantes::TERRESTRE:
                        if($impoexpo && $impoexpo != Constantes::INTERNO && $impoexpo != Constantes::OTMDTA) // Sólo aplica para Exportación Terrestre
                            $q->addWhere("mc.ca_terrestre_internacional = ?", true);
                        break;
                }
            }

            if ($impoexpo) {
                switch ($impoexpo) {
                    case Constantes::IMPO:
                        $q->addWhere("mc.ca_importacion = ?", true);
                        break;
                    case Constantes::EXPO:
                        $q->addWhere("mc.ca_exportacion = ?", true);
                        break;
                    case Constantes::TRIANGULACION:
                        $q->addWhere("mc.ca_importacion = ?", true);
                        break;
                    case Constantes::OTMDTA:
                        $q->addWhere("mc.ca_otm = ?", true);
                        break;
                    case Constantes::INTERNO:
                        $q->addWhere("mc.ca_terrestre_nacional = ?", true);
                        break;
                }
            }
        }
        
        if($impoexpo && $impoexpo == "Admon"){
            $q->addWhere("mc.ca_admon = ?", true);
        }

        $debug = $q->getSqlQuery();
        $conceptos = $q->execute();

        foreach ($conceptos as $k => $c) {
            $conceptos[$k]["mc_ca_concepto_esp"] = utf8_encode($conceptos[$k]["mc_ca_concepto_esp"]);
            $conceptos[$k]["mc_ca_concepto_eng"] = utf8_encode($conceptos[$k]["mc_ca_concepto_eng"]);
        }
        $this->responseArray = array("success" => true, "root" => $conceptos, "total" => count($conceptos), "debug" => $debug);
        $this->setTemplate("responseTemplate");
    }
    
    function executeGuardarMaestraConceptos($request) {

        $datos = json_decode($request->getParameter("datos"));
        $datosMod = json_decode(utf8_encode($request->getParameter("datosMod")), 1);
        $idconceptos = array();

        $conn = Doctrine::getTable("InoMaestraConceptos")->getConnection();
        $conn->beginTransaction();

        try {
            $ids = array();
            foreach ($datos as $dato) {
                $concepto = Doctrine::getTable("InoMaestraConceptos")->find($dato->ca_idconcepto);

                if($dato->ca_concepto_esp != null && $dato->ca_concepto_esp != ""){
                    if (!$concepto) {
                        $concepto = new InoMaestraConceptos();
                        $nuevo = true;                    
                    }
                    $concepto->setCaConceptoEsp(utf8_decode($dato->ca_concepto_esp));
                    $concepto->setCaConceptoEng(utf8_decode($dato->ca_concepto_eng));
                    $concepto->setCaCompra($dato->ca_compra);
                    $concepto->setCaVenta($dato->ca_venta);
                    $concepto->setCaImportacion($dato->ca_importacion);
                    $concepto->setCaExportacion($dato->ca_exportacion);
                    $concepto->setCaTriangulacion($dato->ca_triangulacion);
                    $concepto->setCaAereo($dato->ca_aereo);
                    $concepto->setCaMaritimo($dato->ca_maritimo);
                    $concepto->setCaTerrestreInternacional($dato->ca_terrestre_internacional);
                    $concepto->setCaOtm($dato->ca_otm);
                    $concepto->setCaContenedor($dato->ca_contenedor);
                    $concepto->setCaTerrestreNacional($dato->ca_terrestre_nacional);
                    $concepto->setCaDepositos($dato->ca_depositos);
                    $concepto->setCaOrigen($dato->ca_origen);   
                    $concepto->setCaGeneral($dato->ca_general);
                    $concepto->setCaDestino($dato->ca_destino);
                    $concepto->setCaContiguo($dato->ca_contiguo);
                    $concepto->setCaAdmon($dato->ca_admon);
                    $concepto->setCaBodeganal($dato->ca_bodeganal);
                    $concepto->save($conn);

                    if($dato->ca_compra === false AND $dato->ca_venta===false){
                        $estados = Doctrine::getTable("InoEstadosConceptosSap")->findBy("ca_idconcepto", $concepto->getCaIdconcepto());

                        foreach($estados as $estado){
                            $estado->setCaActivo(false);
                            $estado->save($conn);
                        }
                    }                

                    $ids[] = $dato->id;
                    $idconceptos[] = $concepto->getCaIdconcepto();                
                }
            }
            
            if(count($datosMod)>0){
                if(!$nuevo){
                    $cambios = "El (los) siguiente (s) concepto(s) ha(n) tenido cambios:<br/>";
                    for ($i=0; $i<count($datosMod); $i++){
                        $concepto = Doctrine::getTable("InoMaestraConceptos")->find($datosMod[$i]["ca_idconcepto"]);                                
                        $valor = $datosMod[$i]["value"]?"TRUE":"FALSE";
                        $cambios.= $concepto->getCaIdconcepto()." - ".$concepto->getCaConceptoEsp()." Campo =>".$datosMod[$i]["name"]." Valor =>".$valor."<br/>";
                    }

                    $email = new Email();
                    $email->setCaUsuenvio("Administrador");
                    $email->setCaTipo("Conceptos");
                    $email->setCaFrom("no-reply@coltrans.com.co");                
                    $email->setCaFromname("Colsys Notificaciones");
                    $email->addTo("sporjuela@coltrans.com.co");
                    $email->addCc("soporte-sistemas@coltrans.com.co");
                    $email->setCaSubject("MODIFICACION CONCEPTOS COLSYS");
                    $email->setCaBodyhtml($cambios);            
                    $email->save($conn);
                }
            }
            
            $conn->commit();
            $this->responseArray = array("success" => true, "ids" => $ids, "idconceptos" => $idconceptos/*, "datosMod"=>$datosMod*/);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }    
}
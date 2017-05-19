<?php

/**
 * inoReportes actions.
 *
 * @package    symfony
 * @subpackage inoReportes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inoReportesActions extends sfActions {

    const RUTINA_COMISIONES = 143;
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
        $this->empresa=sfConfig::get('app_branding_name');
        
    }

    /**
     *  
     *
     * @param sfRequest $request A request object
     */
    public function executeCuadroIno(sfWebRequest $request) {        
        
    }

    /**
     *  
     *
     * @param sfRequest $request A request object
     */
    public function executeCuadroInoResult(sfWebRequest $request) {
        
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
            
        $empresa=sfConfig::get('app_branding_name');

        $aa = $request->getParameter("aa");
        $q = Doctrine::getTable("InoMaster")
                ->createQuery("m")
                ->innerJoin("m.InoHouse h")
                ->innerJoin("m.Origen o")
                ->innerJoin("m.Destino d")
                ->innerJoin("m.IdsProveedor p")
                ->leftJoin("h.Reporte r")
                ->innerJoin("p.Ids i")
                ->leftJoin("m.IdsAgente a")
                ->leftJoin("a.Ids ia")
                ->leftJoin("m.InoViCosto cost")
                ->leftJoin("m.InoViIngreso ing")
                ->leftJoin("m.InoViDeduccion ded")
                ->leftJoin("m.InoViUtilidad uti")
                ->leftJoin("m.InoViUnidadesMaster uni")
                ->leftJoin("m.InoViTeus te")
                ->select("m.ca_idmaster, m.ca_referencia, m.ca_modalidad, uni.ca_numhijas, uni.ca_numpiezas, uni.ca_peso, uni.ca_volumen, 
                            o.ca_ciudad, d.ca_ciudad, h.ca_idhouse, r.ca_incoterms, p.ca_idproveedor, i.ca_nombre,a.ca_idagente,ia.ca_nombre, te.ca_valor,
                            cost.ca_valor, cost.ca_venta, ing.ca_valor, ded.ca_valor, uti.ca_valor, m.ca_fchcerrado, m.ca_fchliquidado, m.ca_observaciones");
                
        $impoexpo = $request->getParameter("impoexpo");
        $transporte = $request->getParameter("transporte");
        $idlinea = $request->getParameter("idlinea");
        $idtrafico = $request->getParameter("idtrafico");
        $modalidad = $request->getParameter("modalidad");
        $idagente = $request->getParameter("idagente");
        $origen = $request->getParameter("origen");
        $destino = $request->getParameter("destino");
        $login = $request->getParameter("login");
        $idsucursal = $request->getParameter("idsucursal");
        $sucursal = $request->getParameter("sucursal");

        $aa = $request->getParameter("aa");
        $estado = $request->getParameter("estado");
        
        $nmm=$request->getParameter("nmes");
        
        foreach($nmm as $m)
        {
            if($m!="")
                $mm[]=str_pad($m, 2, "0", STR_PAD_LEFT);
        }

        $q->addWhere("m.ca_fchanulado IS NULL ");


        if ($impoexpo) {
            $q->addWhere("m.ca_impoexpo = ? ", $impoexpo);
        }

        if ($transporte) {
            $q->addWhere("m.ca_transporte = ? ", $transporte);
        }

        if ($modalidad) {
            $q->addWhere("m.ca_modalidad = ? ", $modalidad);
        }

        if ($origen) {
            $q->addWhere("o.ca_ciudad = ? ", $origen);
        }

        if ($destino) {
            $q->addWhere("d.ca_ciudad = ? ", $destino);
        }

        if ($idtrafico) {
            if ($impoexpo == Constantes::EXPO) {
                $q->addWhere("m.ca_destino = ? ", $idtrafico);
            } else {
                $q->addWhere("m.ca_origen = ? ", $idtrafico);
            }
        }

        if ($idlinea) {
            $q->addWhere("m.ca_idlinea = ? ", $idlinea);
        }

        if ($idagente) {
            $q->addWhere("m.ca_idagente = ? ", $idagente);
        }
        
        if (count($mm)>0) {
            if($empresa!='TPLogistics'){
                $q->andWhereIn("SUBSTR(m.ca_referencia,8,2)",$mm);
            }else{
                if($aa<='2012' || ($aa=='2013' && (in_array('1', $mm) || in_array('2', $mm)))){
                    $q->andWhereIn("SUBSTR(m.ca_referencia,8,2)",$mm);
                }else{
                    $q->andWhereIn("SUBSTR(m.ca_referencia,7,2)",$mm);
                }
            }
        }
        
        if ($sucursal) {
            $q->innerJoin("h.Vendedor v");
            $q->innerJoin("v.Sucursal su");            
            $q->addWhere("su.ca_nombre = ? ", $sucursal);
        }
        
        if ($login) {
            $q->addWhere("h.ca_vendedor = ? ", $login);
        }

        if ($estado) {
            if($estado=="Abierto"){
                $q->addWhere("m.ca_fchcerrado IS NULL");
            }else{
                $q->addWhere("m.ca_fchcerrado IS NOT NULL");
                
            }
        }
        
        

        if ($aa) {
            if($empresa!='TPLogistics'){
                $q->addWhere("substr(m.ca_referencia,16,2) = ?", $aa % 100);
            }else{
                if($aa<='2012' || ($aa=='2013' && (in_array('1', $mm) || in_array('2', $mm)))){
                    $q->addWhere("substr(m.ca_referencia,15,1) = ?", $aa % 10);
                }else{
                    $q->addWhere("SUBSTR(m.ca_referencia,10,2) = ? ", $aa%100);
                }
            }
        }
        //echo $q->getSqlQuery();
        $this->refs = $q->setHydrationMode(Doctrine::HYDRATE_ARRAY)->execute();
    }

    public function executeCuadroInoComplemento(sfWebRequest $request) {        
        
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeCuadroInoComplementoResult(sfWebRequest $request) {

        $aa = $request->getParameter("aa");
        $q = Doctrine::getTable("InoMaster")
                ->createQuery("m")
                ->innerJoin("m.InoHouse h")
                ->innerJoin("m.Origen o")
                ->innerJoin("m.Destino d")
                ->innerJoin("m.IdsProveedor p")
                ->leftJoin("h.Reporte r")
                ->innerJoin("p.Ids i")
                ->leftJoin("m.IdsAgente a")
                ->leftJoin("a.Ids ia")
                ->leftJoin("m.InoViCosto cost")
                ->leftJoin("m.InoViIngreso ing")
                ->leftJoin("m.InoViDeduccion ded")
                ->leftJoin("m.InoViUtilidad uti")
                ->leftJoin("m.InoViUnidadesMaster uni")
                ->leftJoin("m.InoViTeus te")
                ->select("m.ca_idmaster, m.ca_referencia, uni.ca_numhijas, uni.ca_numpiezas, uni.ca_peso, uni.ca_volumen, 
                            o.ca_ciudad, d.ca_ciudad, h.ca_idhouse, r.ca_incoterms, p.ca_idproveedor, i.ca_nombre,a.ca_idagente,ia.ca_nombre, te.ca_valor,
                            cost.ca_valor, cost.ca_venta, ing.ca_valor, ded.ca_valor, uti.ca_valor, m.ca_fchcerrado, m.ca_fchliquidado, m.ca_observaciones")
                ->addWhere("SUBSTR(m.ca_referencia,10,2) = ? ", $aa%100);

        $impoexpo = $request->getParameter("impoexpo");
        $transporte = $request->getParameter("transporte");
        $idlinea = $request->getParameter("idlinea");
        $idtrafico = $request->getParameter("idtrafico");
        $modalidad = $request->getParameter("modalidad");
        $idagente = $request->getParameter("idagente");
        $origen = $request->getParameter("origen");
        $destino = $request->getParameter("destino");
        $login = $request->getParameter("login");

        $nmm=$request->getParameter("nmes");
        
        foreach($nmm as $m)
        {
            if($m!="")
                $mm[]=str_pad($m, 2, "0", STR_PAD_LEFT);
        }

        $q->addWhere("m.ca_fchanulado IS NULL ");


        if ($impoexpo) {
            $q->addWhere("m.ca_impoexpo = ? ", $impoexpo);
        }

        if ($transporte) {
            $q->addWhere("m.ca_transporte = ? ", $transporte);
        }

        if ($modalidad) {
            $q->addWhere("m.ca_modalidad = ? ", $modalidad);
        }

        if ($origen) {
            $q->addWhere("o.ca_ciudad = ? ", $origen);
        }

        if ($destino) {
            $q->addWhere("d.ca_ciudad = ? ", $destino);
        }

        if ($idtrafico) {
            if ($impoexpo == Constantes::EXPO) {
                $q->addWhere("m.ca_destino = ? ", $idtrafico);
            } else {
                $q->addWhere("m.ca_origen = ? ", $idtrafico);
            }
        }

        if ($idlinea) {
            $q->addWhere("m.ca_idlinea = ? ", $idlinea);
        }

        if ($idagente) {
            $q->addWhere("m.ca_idagente = ? ", $idagente);
        }

        if (count($mm)>0) {
            $q->andWhereIn("SUBSTR(m.ca_referencia,7,2)",$mm);
        }
        
        if ($login) {
            $q->addWhere("h.ca_vendedor = ? ", $login);
        }

        if ($aa) {
            $q->addWhere("SUBSTR(m.ca_referencia,15,1) = ? ", $aa % 10);
        }
        //echo $q->getSqlQuery();
        $this->refs = $q->setHydrationMode(Doctrine::HYDRATE_ARRAY)->execute();
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeListadoComprobantes(sfWebRequest $request) {

        Doctrine_Manager::getInstance()->setCurrentConnection('replica');

        if ($request->isMethod("post")) {
            $tipo = $request->getParameter("tipo");

            if ($tipo == "F") {

                $q = Doctrine::getTable("InoComprobante")
                        ->createQuery("c")
                        ->innerJoin("c.Ids id")
                        ->innerJoin("c.InoTipoComprobante t")
                        ->leftJoin("c.InoHouse h")
                        ->leftJoin("h.InoMaster m")
                        ->select("c.ca_consecutivo, c.ca_valor, t.ca_tipo, t.ca_comprobante, c.ca_tcambio, c.ca_idmoneda, c.ca_fchcomprobante, id.ca_nombre, id.ca_id, h.ca_doctransporte, m.ca_idmaster, m.ca_referencia, m.ca_impoexpo, m.ca_transporte, m.ca_modalidad, m.ca_observaciones");

                $q->addWhere("m.ca_fchanulado IS NULL ");
                if ($request->getParameter("fecIni")) {
                    $q->addWhere("c.ca_fchcomprobante >=? ", $request->getParameter("fecIni"));
                }

                if ($request->getParameter("fecFin")) {
                    $q->addWhere("c.ca_fchcomprobante <=? ", $request->getParameter("fecFin"));
                }

                if ($request->getParameter("emitido")) {
                    $q->addWhere("UPPER(id.ca_nombre) like ? ", "%" . strtoupper($request->getParameter("emitido")) . "%");
                }

                if ($request->getParameter("nofactura")) {
                    $q->addWhere("UPPER(c.ca_consecutivo) like ? ", "%" . strtoupper($request->getParameter("nofactura")) . "%");
                }


                $orden = $request->getParameter("orden");
                switch ($orden) {
                    case "referencia":
                        $q->addOrderBy("m.ca_referencia ASC");
                        break;
                    case "comprobante":
                        $q->addOrderBy("c.ca_consecutivo ASC");
                        break;
                    case "fchcomprobante":
                        $q->addOrderBy("ca_fchcomprobante ASC");
                        break;
                    case "nombre":
                        $q->addOrderBy("id.ca_nombre ASC");
                        break;
                    case "doctransporte":
                        $q->addOrderBy("h.ca_doctransporte ASC");
                        break;
                }

                $this->comps = $q->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();
                $this->setTemplate("listadoComprobantesResult");
            }


            if ($tipo == "P") {

                $q = Doctrine::getTable("InoCosto")
                        ->createQuery("c")
                        ->innerJoin("c.Ids id")
                        ->leftJoin("c.InoMaster m");
                //->select("c.ca_consecutivo, id.ca_nombre, id.ca_id, h.ca_doctransporte, m.ca_referencia");

                $q->addWhere("m.ca_fchanulado IS NULL ");
                if ($request->getParameter("fecIni")) {
                    $q->addWhere("c.ca_fchfactura >=? ", $request->getParameter("fecIni"));
                }

                if ($request->getParameter("fecFin")) {
                    $q->addWhere("c.ca_fchfactura <=? ", $request->getParameter("fecFin"));
                }

                if ($request->getParameter("emitido")) {
                    $q->addWhere("UPPER(id.ca_nombre) like ? ", "%" . strtoupper($request->getParameter("emitido")) . "%");
                }
                if ($request->getParameter("nofactura")) {
                    $q->addWhere("UPPER(c.ca_factura) like ? ", "%" . strtoupper($request->getParameter("nofactura")) . "%");
                }

                $orden = $request->getParameter("orden");
                switch ($orden) {
                    case "referencia":
                        $q->addOrderBy("m.ca_referencia ASC");
                        break;
                    case "comprobante":
                        $q->addOrderBy("c.ca_factura ASC");
                        break;
                    case "fchcomprobante":
                        $q->addOrderBy("c.ca_fchfactura ASC");
                        break;
                    case "nombre":
                        $q->addOrderBy("id.ca_nombre ASC");
                        break;
                    case "doctransporte":
                        $q->addOrderBy("m.ca_master ASC");
                        break;
                }

                $this->comps = $q->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();
                $this->setTemplate("listadoComprobantesProvResult");
            }
            $this->monedaLocal = $this->getUser()->getIdmoneda();
        }
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeGeneradorInformes(sfWebRequest $request) {

        Doctrine_Manager::getInstance()->setCurrentConnection('replica');            
            
        $aa = $request->getParameter("aa");
        $q = Doctrine::getTable("InoMaster")
                ->createQuery("m")
                ->innerJoin("m.Origen o")
                ->innerJoin("m.Destino d")
                ->innerJoin("m.IdsProveedor p")
                ->innerJoin("p.Ids i")
                ->leftJoin("m.InoViCosto cost")
                ->leftJoin("m.InoViIngreso ing")
                ->leftJoin("m.InoViDeduccion ded")
                ->leftJoin("m.InoViUtilidad uti")
                ->leftJoin("m.InoViUnidadesMaster uni")
                ->select("m.ca_idmaster, m.ca_referencia, uni.ca_numhijas, uni.ca_numpiezas, uni.ca_peso, uni.ca_volumen, 
                            o.ca_ciudad, d.ca_ciudad, p.ca_idproveedor, i.ca_nombre, 
                            cost.ca_valor, cost.ca_venta, ing.ca_valor, ded.ca_valor, uti.ca_valor, m.ca_fchcerrado, m.ca_fchliquidado, m.ca_observaciones")
                ->addWhere("substr(m.ca_referencia,16,2) = ?", $aa % 100);

        $impoexpo = $request->getParameter("impoexpo");
        $transporte = $request->getParameter("transporte");
        $idlinea = $request->getParameter("idlinea");
        $idtrafico = $request->getParameter("idtrafico");
        $modalidad = $request->getParameter("modalidad");
        $idagente = $request->getParameter("idagente");
        $aa = $request->getParameter("aa");
        $mm = $request->getParameter("mm");

        $q->addWhere("m.ca_fchanulado IS NULL ");

        if ($impoexpo) {
            $q->addWhere("m.ca_impoexpo = ? ", $impoexpo);
        }

        if ($transporte) {
            $q->addWhere("m.ca_transporte = ? ", $transporte);
        }

        if ($modalidad) {
            $q->addWhere("m.ca_modalidad = ? ", $modalidad);
        }

        if ($idtrafico) {
            if ($impoexpo == Constantes::EXPO) {
                $q->addWhere("m.ca_destino = ? ", $idtrafico);
            } else {
                $q->addWhere("m.ca_origen = ? ", $idtrafico);
            }
        }

        if ($idlinea) {
            $q->addWhere("m.ca_idlinea = ? ", $idlinea);
        }

        if ($idagente) {
            $q->addWhere("m.ca_idagente = ? ", $idagente);
        }

        if ($mm) {
            $q->addWhere("SUBSTR(m.ca_referencia,8,2) = ? ", str_pad($mm, 2, "0", STR_PAD_LEFT));
        }

        if ($aa) {
            $q->addWhere("SUBSTR(m.ca_referencia,16,2) = ? ", $aa % 100);
        }
        $this->refs = $q->setHydrationMode(Doctrine::HYDRATE_ARRAY)->execute();
    }
    
    
    
    public function executeReporteComisiones2(sfWebRequest $request) {

        Doctrine_Manager::getInstance()->setCurrentConnection('replica');            

        $this->permiso = $this->getUser()->getNivelAcceso( inoReportesActions::RUTINA_COMISIONES );
        $empresa=sfConfig::get('app_branding_name');
        
        $this->buscar=$request->getParameter("buscar");
        if($request->getParameter("buscar")!="")
        {
            $q = Doctrine::getTable("InoMaster")
                ->createQuery("m")                                
                ->innerJoin("m.InoHouse h")
                ->innerJoin("h.Cliente cl")
                ->innerJoin("m.Origen o")
                ->innerJoin("m.Destino d")
                ->innerJoin("m.IdsProveedor p")
                ->innerJoin("p.Ids i")
                ->leftJoin("m.IdsAgente a")
                ->leftJoin("a.Ids ia")                
                ->leftJoin("m.InoViCosto cost")
                ->leftJoin("m.InoViIngreso ing")
                ->leftJoin("m.InoViDeduccion ded")
                ->leftJoin("m.InoViUtilidad uti")
                ->leftJoin("m.InoViUnidadesMaster uni")
                ->leftJoin("m.InoViTeus te")
                ->select("(SELECT mo.ca_idmodo FROM Modo mo where mo.ca_modulo = 'INO' AND m.ca_impoexpo=mo.ca_impoexpo AND m.ca_transporte=mo.ca_transporte ) tipo,cl.ca_compania,m.ca_modalidad,
                    h.ca_vendedor,h.ca_idcliente,h.ca_doctransporte,h.ca_numpiezas,h.ca_peso,h.ca_volumen,m.ca_idmaster, m.ca_referencia, uni.ca_numhijas, uni.ca_numpiezas, uni.ca_peso, uni.ca_volumen, 
                            o.ca_ciudad, d.ca_ciudad, p.ca_idproveedor, i.ca_nombre,a.ca_idagente, ia.ca_nombre,te.ca_valor, 
                            cost.ca_valor, cost.ca_venta, ing.ca_valor, ded.ca_valor, uti.ca_valor, m.ca_fchcerrado, m.ca_fchliquidado, m.ca_observaciones,
                            ( COALESCE(ing.ca_valor,0) + COALESCE(uti.ca_valor,0) - COALESCE(cost.ca_valor,0) - COALESCE(ded.ca_valor,0) ) as ino,                            
                            m.ca_usucerrado,m.ca_fchcerrado
                            ");//->where("m.ca_impoexpo='INTERNO'");

            $impoexpo = $request->getParameter("impoexpo");
            $transporte = $request->getParameter("transporte");
            $idlinea = $request->getParameter("idlinea");
            $idtrafico = $request->getParameter("idtrafico");
            $modalidad = $request->getParameter("modalidad");
            $idagente = $request->getParameter("idagente");
            $aa = $request->getParameter("anio");
            
            $mm = $request->getParameter("mes");
            $this->casos = $request->getParameter("casos");
            $idcomercial = $request->getParameter("idcomercial");
            

            $q->addWhere("m.ca_fchanulado IS NULL ");

            if ($impoexpo) {
                $q->addWhere("m.ca_impoexpo = ? ", $impoexpo);
            }

            if ($transporte) {
                $q->addWhere("m.ca_transporte = ? ", $transporte);
            }

            if ($modalidad) {
                $q->addWhere("m.ca_modalidad = ? ", $modalidad);
            }

            if ($idtrafico) {
                if ($impoexpo == Constantes::EXPO) {
                    $q->addWhere("m.ca_destino = ? ", $idtrafico);
                } else {
                    $q->addWhere("m.ca_origen = ? ", $idtrafico);
                }
            }

            if ($idlinea) {
                $q->addWhere("m.ca_idlinea = ? ", $idlinea);
            }

            if ($idagente) {
                $q->addWhere("m.ca_idagente = ? ", $idagente);
            }

            if ($aa!="") {
                if($empresa!='TPLogistics')
                    $q->addWhere("SUBSTR(m.ca_referencia,16,2) = ? ", $aa%100);
                else
                    $q->addWhere("SUBSTR(m.ca_referencia,10,2) = ? ", $aa%100);
            }
            if ($mm!="") {
                if($empresa!='TPLogistics')
                    $q->addWhere("SUBSTR(m.ca_referencia,8,2) = ? ", str_pad($mm, 2, "0", STR_PAD_LEFT));
                else
                    $q->addWhere("SUBSTR(m.ca_referencia,7,2) = ? ", str_pad($mm, 2, "0", STR_PAD_LEFT));
            }
            
            if ($idcomercial) {
                $q->addWhere ("h.ca_vendedor =?",$idcomercial);
            }
            
            if ($this->casos!="") {
                if($this->casos==1)
                    $q->addWhere("m.ca_fchcerrado is null");
                else if($this->casos==0)
                    $q->addWhere("m.ca_fchcerrado is not null");
            }
            if($this->getUser()->getUserId()=="maquinche11")
            {
                echo "   ".$impoexpo."<br>"; //= $request->getParameter("impoexpo");
                echo "   ".$transporte."<br>"; // = $request->getParameter("transporte");
                echo "   ".$idcomercial."<br>"; // = $request->getParameter("transporte");                
                echo "   ".$aa%100;
                echo "   ".str_pad($mm, 2, "0", STR_PAD_LEFT);
                echo $q->getSqlQuery();
            }
            $this->refs = $q->setHydrationMode(Doctrine::HYDRATE_ARRAY)->execute();
            //echo "<pre>";print_r($this->refs);echo "<pre>";
            //exit;
            $this->datosIno=array();
            $this->totales=array();
            
            $this->tipoTotales=array("vendedor","cliente","agente","linea","Origen");
            foreach($this->refs as $r)
            {
                //por vendedor                
                $nvendedor=$r["InoHouse"][0]["ca_vendedor"];
                $this->datosIno[$nvendedor][]=$r;
                $this->totales["vendedor"][$nvendedor]["InoViIngreso"]["valor"]     +=$r["InoViIngreso"]["ca_valor"];
                $this->totales["vendedor"][$nvendedor]["InoViCosto"]["valor"]       +=$r["InoViCosto"]["ca_valor"];
                $this->totales["vendedor"][$nvendedor]["InoViDeduccion"]["valor"]   +=$r["InoViDeduccion"]["ca_valor"];
                $this->totales["vendedor"][$nvendedor]["InoViUtilidad"]["valor"]    +=$r["InoViUtilidad"]["ca_valor"];
                $this->totales["vendedor"][$nvendedor]["InoViTeus"]["valor"]        +=$r["InoViTeus"]["ca_valor"];
                $this->totales["vendedor"][$nvendedor]["ino"]["valor"]              +=$r["ino"];
                $this->totales["vendedor"][$nvendedor]["volumen"]["valor"]          +=$r["InoHouse"][0]["ca_volumen"];
                $this->totales["vendedor"][$nvendedor]["peso"]["valor"]             +=$r["InoHouse"][0]["ca_peso"];
                $this->totales["vendedor"][$nvendedor]["piezas"]["valor"]           +=$r["InoHouse"][0]["ca_numpiezas"];
                $this->totales["vendedor"][$nvendedor]["nref"]["valor"]++;
                
                //por cliente
                $nCompania=$r["InoHouse"][0]["Cliente"]["ca_compania"];
                $this->totales["cliente"][$nCompania]["InoViIngreso"]["valor"]     +=$r["InoViIngreso"]["ca_valor"];
                $this->totales["cliente"][$nCompania]["InoViCosto"]["valor"]       +=$r["InoViCosto"]["ca_valor"];
                $this->totales["cliente"][$nCompania]["InoViDeduccion"]["valor"]   +=$r["InoViDeduccion"]["ca_valor"];
                $this->totales["cliente"][$nCompania]["InoViUtilidad"]["valor"]    +=$r["InoViUtilidad"]["ca_valor"];
                $this->totales["cliente"][$nCompania]["InoViTeus"]["valor"]        +=$r["InoViTeus"]["ca_valor"];
                $this->totales["cliente"][$nCompania]["ino"]["valor"]              +=$r["ino"];
                $this->totales["cliente"][$nCompania]["volumen"]["valor"]          +=$r["InoHouse"][0]["ca_volumen"];
                $this->totales["cliente"][$nCompania]["peso"]["valor"]             +=$r["InoHouse"][0]["ca_peso"];
                $this->totales["cliente"][$nCompania]["piezas"]["valor"]           +=$r["InoHouse"][0]["ca_numpiezas"];
                $this->totales["cliente"][$nCompania]["nref"]["valor"]++;
                
                //por agente
                $nAgente=$r["IdsAgente"]["Ids"]["ca_nombre"];
                $this->totales["agente"][$nAgente]["InoViIngreso"]["valor"]   +=$r["InoViIngreso"]["ca_valor"];
                $this->totales["agente"][$nAgente]["InoViCosto"]["valor"]     +=$r["InoViCosto"]["ca_valor"];
                $this->totales["agente"][$nAgente]["InoViDeduccion"]["valor"] +=$r["InoViDeduccion"]["ca_valor"];
                $this->totales["agente"][$nAgente]["InoViUtilidad"]["valor"]  +=$r["InoViUtilidad"]["ca_valor"];
                $this->totales["agente"][$nAgente]["InoViTeus"]["valor"]      +=$r["InoViTeus"]["ca_valor"];
                $this->totales["agente"][$nAgente]["ino"]["valor"]            +=$r["ino"];
                $this->totales["agente"][$nAgente]["volumen"]["valor"]        +=$r["InoHouse"][0]["ca_volumen"];
                $this->totales["agente"][$nAgente]["peso"]["valor"]           +=$r["InoHouse"][0]["ca_peso"];
                $this->totales["agente"][$nAgente]["piezas"]["valor"]         +=$r["InoHouse"][0]["ca_numpiezas"];
                $this->totales["agente"][$nAgente]["nref"]["valor"]++;
                
                //por linea
                $nProveedor=$r["IdsProveedor"]["Ids"]["ca_nombre"];
                $this->totales["linea"][$nProveedor]["InoViIngreso"]["valor"]    +=$r["InoViIngreso"]["ca_valor"];
                $this->totales["linea"][$nProveedor]["InoViCosto"]["valor"]      +=$r["InoViCosto"]["ca_valor"];
                $this->totales["linea"][$nProveedor]["InoViDeduccion"]["valor"]  +=$r["InoViDeduccion"]["ca_valor"];
                $this->totales["linea"][$nProveedor]["InoViUtilidad"]["valor"]   +=$r["InoViUtilidad"]["ca_valor"];
                $this->totales["linea"][$nProveedor]["InoViTeus"]["valor"]       +=$r["InoViTeus"]["ca_valor"];
                $this->totales["linea"][$nProveedor]["ino"]["valor"]             +=$r["ino"];
                $this->totales["linea"][$nProveedor]["volumen"]["valor"]         +=$r["InoHouse"][0]["ca_volumen"];
                $this->totales["linea"][$nProveedor]["peso"]["valor"]            +=$r["InoHouse"][0]["ca_peso"];
                $this->totales["linea"][$nProveedor]["piezas"]["valor"]          +=$r["InoHouse"][0]["ca_numpiezas"];
                $this->totales["linea"][$nProveedor]["nref"]["valor"]++;
                
                //por origen
                $nOrigen=$r["Origen"]["ca_ciudad"];
                $this->totales["Origen"][$nOrigen]["InoViIngreso"]["valor"]   +=$r["InoViIngreso"]["ca_valor"];
                $this->totales["Origen"][$nOrigen]["InoViCosto"]["valor"]     +=$r["InoViCosto"]["ca_valor"];
                $this->totales["Origen"][$nOrigen]["InoViDeduccion"]["valor"] +=$r["InoViDeduccion"]["ca_valor"];
                $this->totales["Origen"][$nOrigen]["InoViUtilidad"]["valor"]  +=$r["InoViUtilidad"]["ca_valor"];
                $this->totales["Origen"][$nOrigen]["InoViTeus"]["valor"]      +=$r["InoViTeus"]["ca_valor"];
                $this->totales["Origen"][$nOrigen]["ino"]["valor"]            +=$r["ino"];
                $this->totales["Origen"][$nOrigen]["volumen"]["valor"]        +=$r["InoHouse"][0]["ca_volumen"];
                $this->totales["Origen"][$nOrigen]["peso"]["valor"]           +=$r["InoHouse"][0]["ca_peso"];
                $this->totales["Origen"][$nOrigen]["piezas"]["valor"]         +=$r["InoHouse"][0]["ca_numpiezas"];
                $this->totales["Origen"][$nOrigen]["nref"]["valor"]++;

                //totales                
                $this->totales["totales"]["InoViIngreso"]+=$r["InoViIngreso"]["ca_valor"];
                $this->totales["totales"]["InoViCosto"]+=$r["InoViCosto"]["ca_valor"];
                $this->totales["totales"]["InoViDeduccion"]+=$r["InoViDeduccion"]["ca_valor"];
                $this->totales["totales"]["InoViUtilidad"]+=$r["InoViUtilidad"]["ca_valor"];
                $this->totales["totales"]["InoViTeus"]+=$r["InoViTeus"]["ca_valor"];
                $this->totales["totales"]["ino"]+=$r["ino"];
                $this->totales["totales"]["volumen"]+=$r["InoHouse"][0]["ca_volumen"];
                $this->totales["totales"]["peso"]+=$r["InoHouse"][0]["ca_peso"];
                $this->totales["totales"]["piezas"]+=$r["InoHouse"][0]["ca_numpiezas"];
                $this->totales["totales"]["nref"]++;
            }
            
            foreach ($this->tipoTotales as $opcion)
            {            
                foreach($this->totales[$opcion] as $key=>$r)
                {
                    $this->totales[$opcion][$key]["InoViIngreso"]["%"]     =($r["InoViIngreso"]["valor"]*100)/$this->totales["totales"]["InoViIngreso"];
                    $this->totales[$opcion][$key]["InoViCosto"]["%"]       =($r["InoViCosto"]["valor"]*100)/$this->totales["totales"]["InoViCosto"];
                    $this->totales[$opcion][$key]["InoViDeduccion"]["%"]   =($r["InoViDeduccion"]["valor"]*100)/$this->totales["totales"]["InoViDeduccion"];
                    $this->totales[$opcion][$key]["InoViUtilidad"]["%"]    =($r["InoViUtilidad"]["valor"]*100)/$this->totales["totales"]["InoViUtilidad"];
                    $this->totales[$opcion][$key]["InoViTeus"]["%"]        =($r["InoViTeus"]["valor"]*100)/$this->totales["totales"]["InoViTeus"];
                    $this->totales[$opcion][$key]["ino"]["%"]              =($r["ino"]["valor"]*100)/$this->totales["totales"]["ino"];
                    $this->totales[$opcion][$key]["volumen"]["%"]          =($r["volumen"]["valor"]*100)/$this->totales["totales"]["volumen"];
                    $this->totales[$opcion][$key]["peso"]["%"]             =($r["peso"]["valor"]*100)/$this->totales["totales"]["peso"];
                    $this->totales[$opcion][$key]["piezas"]["%"]           =($r["piezas"]["valor"]*100)/$this->totales["totales"]["piezas"];
                    $this->totales[$opcion][$key]["nref"]["%"]              =($r["nref"]["valor"]*100)/$this->totales["totales"]["nref"];
                }
            }
            
            
            /*echo "<pre>";
            //print_r( $this->refs[0]);
            //print_r( $this->datos);  
            //print_r($this->totales);
            echo "</pre>";*/
        }
        
        
    }
    
    
    public function executeReporteComisiones(sfWebRequest $request) {

        
        //$this->permiso = $this->getUser()->getNivelAcceso( inoReportesActions::RUTINA_COMISIONES );
        //$con = Doctrine_Manager::getInstance()->connection();
        $this->empresa=sfConfig::get('app_branding_name');
        if($this->empresa!=Constantes::TPLOGISTICS)
            $this->permiso = $this->getUser()->getNivelAcceso( inoReportesActions::RUTINA_COMISIONES );
        else
            $this->permiso=2;
        
        $this->buscar=$request->getParameter("buscar");
        
        if($request->getParameter("buscar")!="")
        {
            
            $sucursal = ($request->getParameter("sucursal"));
            
            
            if ($sucursal) {
                $innerjoin=" inner join control.tb_usuarios u on h.ca_vendedor=u.ca_login
                         inner join control.tb_sucursales s on s.ca_idsucursal=u.ca_idsucursal";
            }


            $sql="Select (SELECT mo.ca_idmodo FROM tb_modos mo where mo.ca_modulo = 'INO' AND m.ca_impoexpo=mo.ca_impoexpo AND m.ca_transporte=mo.ca_transporte ) tipo,
cl.ca_compania,m.ca_modalidad,h.ca_idhouse,h.ca_vendedor,h.ca_idcliente,h.ca_doctransporte,h.ca_numpiezas,
h.ca_peso, h.ca_volumen,m.ca_idmaster, m.ca_referencia, uni.ca_numhijas, uni.ca_numpiezas, uni.ca_peso,
uni.ca_volumen, o.ca_ciudad o_ciudad, d.ca_ciudad d_ciudad, p.ca_idproveedor, i.ca_nombre p_nombre,
a.ca_idagente, ia.ca_nombre a_nombre,te.ca_valor te_valor, cost.ca_valor cost_valor, cost.ca_venta cost_venta,
ing.ca_valor ing_valor, ded.ca_valor ded_valor, uti.ca_valor uti_valor, m.ca_fchcerrado, m.ca_fchliquidado,
m.ca_observaciones, ( COALESCE(ing.ca_valor,0) + COALESCE(uti.ca_valor,0) - COALESCE(cost.ca_valor,0) - COALESCE(ded.ca_valor,0) ) as ino ,
array_to_string(ARRAY( SELECT ca_consecutivo FROM ino.vi_comprobantes WHERE ca_usuanulado is null and ca_idmaster=m.ca_idmaster AND ca_idhouse=h.ca_idhouse AND ca_idtipo IN(12)),',' ) as rccaja ,
array_to_string(ARRAY( SELECT ca_consecutivo FROM ino.vi_comprobantes WHERE ca_usuanulado is null and ca_idmaster=m.ca_idmaster AND ca_idhouse=h.ca_idhouse AND ca_tipo ='F'),',' ) as facturas ,
array_to_string(ARRAY( SELECT ca_consecutivo FROM ino.vi_comprobantes WHERE ca_usuanulado is null and ca_idmaster=m.ca_idmaster AND ca_idhouse=h.ca_idhouse AND ca_tipo ='C'),',' ) as notacredito ,
array_to_string(ARRAY( (SELECT (com.ca_consecutivo||'|'||det.ca_cr||'|'||com.ca_idcomprobante) FROM ino.tb_comprobantes com,ino.tb_detalles det WHERE com.ca_usuanulado is null and com.ca_idcomprobante=det.ca_idcomprobante and det.ca_idmaster=m.ca_idmaster AND det.ca_idhouse=h.ca_idhouse AND com.ca_idtipo IN(11) and det.ca_cr !=0 )),',' ) comision ,
( SELECT fun_getcomision(h.ca_idcliente::numeric, m.ca_referencia::text, 'Colmas'::text) AS fun_getcomision) AS ca_porcentaje,
m.ca_fchcerrado,m.ca_usucerrado,cl.ca_fchcircular,cl.ca_stdcircular

FROM ino.tb_master m
INNER JOIN ino.tb_house h ON m.ca_idmaster = h.ca_idmaster
INNER JOIN vi_clientes cl ON h.ca_idcliente = cl.ca_idcliente
INNER JOIN tb_ciudades o ON m.ca_origen = o.ca_idciudad
INNER JOIN tb_ciudades d ON m.ca_destino = d.ca_idciudad
INNER JOIN ids.tb_proveedores p ON m.ca_idlinea = p.ca_idproveedor
INNER JOIN ids.tb_ids i ON p.ca_idproveedor = i.ca_id
LEFT JOIN ids.tb_agentes a ON m.ca_idagente = a.ca_idagente
LEFT JOIN ids.tb_ids ia ON a.ca_idagente = ia.ca_id
LEFT JOIN ino.vi_costos cost ON m.ca_idmaster = cost.ca_idmaster
LEFT JOIN ino.vi_ingresos ing ON m.ca_idmaster = ing.ca_idmaster
LEFT JOIN ino.vi_deducciones ded ON m.ca_idmaster = ded.ca_idmaster
LEFT JOIN ino.vi_utilidades uti ON m.ca_idmaster = uti.ca_idmaster
LEFT JOIN ino.vi_unidades_master uni ON m.ca_idmaster = uni.ca_idmaster
LEFT JOIN ino.vi_teus te ON m.ca_idmaster = te.ca_idmaster
                    {$innerjoin}
                    where m.ca_fchanulado IS NULL ";
                    //where m.ca_fchanulado IS NULL and  m.ca_fchcerrado is not null and m.ca_usucerrado is not null";
            if($this->permiso<2)
            {
                $sql.=" and h.ca_vendedor='{$this->getUser()->getUserId()}'";
                //$this->observaciones
             //   $q->addWhere ("h.ca_vendedor=?",$this->user->getUserId());
            }

            
            $impoexpo = $request->getParameter("impoexpo");
            $transporte = $request->getParameter("transporte");
            $idlinea = $request->getParameter("idlinea");
            $idtrafico = $request->getParameter("idtrafico");
            $modalidad = $request->getParameter("modalidad");
            $idagente = $request->getParameter("idagente");
            
            
            $idcomercial = $request->getParameter("idcomercial");
            
            
            $aa = $request->getParameter("anio");
            
            $mm = $request->getParameter("mes");
            $this->casos = $request->getParameter("casos");

            if ($impoexpo) {
                $sql.=" and m.ca_impoexpo ='{$impoexpo}'";                
            }

            if ($transporte) {
                $sql.=" and m.ca_transporte ='{$transporte}'";                
            }

            if ($modalidad) {
                $sql.=" and m.ca_modalidad ='{$modalidad}'";                
            }

            if ($idtrafico) {
                if ($impoexpo == Constantes::EXPO) {
                    $sql.=" and m.ca_destino ='{$idtrafico}'";                    
                } else {
                    $sql.=" and m.ca_origen ='{$idtrafico}'";                    
                }
            }
            if ($idcomercial) {
                $sql.=" and h.ca_vendedor ='{$idcomercial}'";
            }
            
            if ($sucursal) {
                $sql.=" and s.ca_nombre ='".($sucursal)."'";
            }

            if ($idlinea) {
                $sql.=" and m.ca_idlinea ='{$idlinea}'";                
            }

            if ($idagente) {
                $sql.=" and m.ca_idagente ='{$idagente}'";                
            }

            /*if ($aa!="") {
                if($empresa!='TPLogistics')
                {
                    $sql.=" and SUBSTR(m.ca_referencia,16,2) ='".($aa%100)."'";                    
                }
                else
                {
                    $sql.=" and SUBSTR(m.ca_referencia,10,2) ='".($aa%100)."'";                    
                }
            }*/
            if ($aa!="") {
                /*if($this->empresa!='TPLogistics')
                {
                    $sql.=" and SUBSTR(m.ca_referencia,16,2) ='".($aa%100)."'";                    
                }
                else
                {
                    $sql.=" and SUBSTR(m.ca_referencia,10,2) ='".($aa%100)."'";                    
                }*/ 
                if($this->empresa=='TPLogistics'){
                    $sql.=" and SUBSTR(m.ca_referencia,10,2) ='".($aa%100)."'";                    
                }else{
                    $sql.=" and SUBSTR(m.ca_referencia,16,2) ='".($aa%100)."'";                    
                }
            }
            //echo $this->empresa;
            
            if ($mm!="") {
                if($empresa!='TPLogistics')
                {
                    $sql.=" and SUBSTR(m.ca_referencia,8,2) ='".str_pad($mm, 2, "0", STR_PAD_LEFT)."'";
                }
                else
                {
                    $sql.=" and SUBSTR(m.ca_referencia,7,2) ='".str_pad($mm, 2, "0", STR_PAD_LEFT)."'";
                }
            }

            if ($this->casos!="") {
                if($this->casos==1)
                {
                    $sql.=" and m.ca_fchcerrado is null";
                }
                else if($this->casos==0)
                {
                    $sql.=" and m.ca_fchcerrado is not null and m.ca_usucerrado is not null";
                }
                else if($this->casos==2)
                {
                    $sql.=" and (SELECT count(ca_consecutivo) FROM ino.vi_comprobantes WHERE ca_idmaster=m.ca_idmaster AND ca_idhouse=h.ca_idhouse AND ca_idtipo IN(12))>0 and m.ca_fchcerrado is not null and m.ca_usucerrado is not null ";
                }
                else if($this->casos==3)
                {
                    $sql.=" and (SELECT count(ca_consecutivo) FROM ino.vi_comprobantes WHERE ca_idmaster=m.ca_idmaster AND ca_idhouse=h.ca_idhouse AND ca_idtipo IN(12))!=0 and m.ca_fchcerrado is not null and m.ca_usucerrado is not null ";
                    //$sql.=" and ca_stdcircular!='Vencido'";
                }
            }

           

            if($this->getUser()->getUserId()=="maquinche")
            {
                //echo "<pre>";print_r($this->refs);echo "</pre>";
                //echo $sql;
                //exit;
            }
            
            /*$databaseConf = sfYaml::load(sfConfig::get('sf_config_dir') . '/databases_replica.yml');
            $dsn = explode(";", $databaseConf ['prod']['doctrine']['param']['dsn']);        
            $dsn0= explode("=", $dsn[0]);
            $dsn1= explode("=", $dsn[1]);
            $userName = $databaseConf ['prod']['doctrine']['param']['username'];
            $userPass = $databaseConf ['prod']['doctrine']['param']['password'];
            $database = $dsn0[1];
            $host = $dsn1[1];
            */
            Doctrine_Manager::getInstance()->setCurrentConnection('replica');            
            $con = Doctrine_Manager::getInstance()->connection();
            //$con = Doctrine_Manager::connection(new PDO("pgsql:dbname={$database};host={$host}", $userName, $userPass));
//            echo $sql;//          
//              exit;
          //  $sql = "select * from tb_bodegas";
            $st = $con->execute($sql);
            //echo $sql;
            $this->refs = $st->fetchAll();
          
            //echo "<pre>";print_r($this->refs);echo "<pre>";
            //exit;
            $this->datosIno=array();
            $this->totales=array();
            
             //echo "<pre>";print_r($this->refs);echo "</pre>";
            $this->tipoTotales=array("vendedor","cliente","agente","linea","Origen");
            foreach($this->refs as $key=>$r)
            {
                try{
                //$this->refs[$key]["ca_compania"]=
                    $com_cob=0;
                    $com_comp="";

                    $com=  explode(",", $r["comision"]);
                    //print_r($com);echo "<br>";
                    foreach($com as $c)
                    {
                        $com1=  explode("|", $c);
                        $com_cob+=(isset($com1[1])?$com1[1]:0);
                        $com_comp.=(isset($com1[0])?$com1[0]."-":"");
                        $r["comision_idcomprobante"]=(isset($com1[2])?$com1[2]:"");
                    }


                    $r["comision_cobrada"]=($com_cob!="")?$com_cob:0;
                    $r["comision_ino"]=($r["ino"]*($r["ca_porcentaje"]/100))-$r["comision_cobrada"];
                    $r["comision_comprobante"]=$com_comp;

                    //echo "<pre>";print_r($r);echo "<pre>";

                    //if(  (intval($r["comision_cobrada"])!=  intval($r["comision_ino"])) || $r["ca_porcentaje"]<=0 )
                    //    $this->datosIno[$r["ca_vendedor"]][]=$r;


                    //if($r["ca_porcentaje"]<=0)
                    //    continue;
                    /*$com=  explode("|", $r["comision"]);                
                    $r["comision_cobrada"]=(isset($com[1])?$com[1]:"0");
                    $r["comision_ino"]=($r["ino"]*($r["ca_porcentaje"]/100))-$r["comision_cobrada"];
                    $r["comision_comprobante"]=(isset($com[0])?$com[0]:"");
                    $r["comision_idcomprobante"]=(isset($com[2])?$com[2]:"");
                    //echo "<pre>";print_r($r);echo "<pre>";
                    */
                    //if(intval($r["comision_cobrada"])!=  intval($r["comision_ino"]))
                    //    $this->datosIno[$r["ca_vendedor"]][]=$r;


                    //por vendedor                
                    $nvendedor=$r["ca_vendedor"];
                    $this->datosIno[$nvendedor][]=$r;
                    $this->totales["vendedor"][$nvendedor]["InoViIngreso"]["valor"]     +=$r["ing_valor"];
                    $this->totales["vendedor"][$nvendedor]["InoViCosto"]["valor"]       +=$r["cost_valor"];
                    $this->totales["vendedor"][$nvendedor]["InoViDeduccion"]["valor"]   +=$r["ded_valor"];
                    $this->totales["vendedor"][$nvendedor]["InoViUtilidad"]["valor"]    +=$r["uti_valor"];
                    $this->totales["vendedor"][$nvendedor]["InoViTeus"]["valor"]        +=$r["te_valor"];
                    $this->totales["vendedor"][$nvendedor]["ino"]["valor"]              +=$r["ino"];
                    $this->totales["vendedor"][$nvendedor]["volumen"]["valor"]          +=$r["ca_volumen"];
                    $this->totales["vendedor"][$nvendedor]["peso"]["valor"]             +=$r["ca_peso"];
                    $this->totales["vendedor"][$nvendedor]["piezas"]["valor"]           +=$r["ca_numpiezas"];
                    $this->totales["vendedor"][$nvendedor]["nref"]["valor"]++;

                    //por cliente
                    $nCompania=$r["ca_compania"];
                    $this->totales["cliente"][$nCompania]["InoViIngreso"]["valor"]     +=$r["ing_valor"];
                    $this->totales["cliente"][$nCompania]["InoViCosto"]["valor"]       +=$r["cost_valor"];
                    $this->totales["cliente"][$nCompania]["InoViDeduccion"]["valor"]   +=$r["ded_valor"];
                    $this->totales["cliente"][$nCompania]["InoViUtilidad"]["valor"]    +=$r["uti_valor"];
                    $this->totales["cliente"][$nCompania]["InoViTeus"]["valor"]        +=$r["te_valor"];
                    $this->totales["cliente"][$nCompania]["ino"]["valor"]              +=$r["ino"];
                    $this->totales["cliente"][$nCompania]["volumen"]["valor"]          +=$r["ca_volumen"];
                    $this->totales["cliente"][$nCompania]["peso"]["valor"]             +=$r["ca_peso"];
                    $this->totales["cliente"][$nCompania]["piezas"]["valor"]           +=$r["ca_numpiezas"];
                    $this->totales["cliente"][$nCompania]["nref"]["valor"]++;

                    //por agente
                    $nAgente=$r["a_nombre"];
                    $this->totales["agente"][$nAgente]["InoViIngreso"]["valor"]   +=$r["ing_valor"];
                    $this->totales["agente"][$nAgente]["InoViCosto"]["valor"]     +=$r["cost_valor"];
                    $this->totales["agente"][$nAgente]["InoViDeduccion"]["valor"] +=$r["ded_valor"];
                    $this->totales["agente"][$nAgente]["InoViUtilidad"]["valor"]  +=$r["uti_valor"];
                    $this->totales["agente"][$nAgente]["InoViTeus"]["valor"]      +=$r["te_valor"];
                    $this->totales["agente"][$nAgente]["ino"]["valor"]            +=$r["ino"];
                    $this->totales["agente"][$nAgente]["volumen"]["valor"]        +=$r["ca_volumen"];
                    $this->totales["agente"][$nAgente]["peso"]["valor"]           +=$r["ca_peso"];
                    $this->totales["agente"][$nAgente]["piezas"]["valor"]         +=$r["ca_numpiezas"];
                    $this->totales["agente"][$nAgente]["nref"]["valor"]++;

                    //por linea
                    $nProveedor=$r["p_nombre"];
                    $this->totales["linea"][$nProveedor]["InoViIngreso"]["valor"]    +=$r["ing_valor"];
                    $this->totales["linea"][$nProveedor]["InoViCosto"]["valor"]      +=$r["cost_valor"];
                    $this->totales["linea"][$nProveedor]["InoViDeduccion"]["valor"]  +=$r["ded_valor"];
                    $this->totales["linea"][$nProveedor]["InoViUtilidad"]["valor"]   +=$r["uti_valor"];
                    $this->totales["linea"][$nProveedor]["InoViTeus"]["valor"]       +=$r["te_valor"];
                    $this->totales["linea"][$nProveedor]["ino"]["valor"]             +=$r["ino"];
                    $this->totales["linea"][$nProveedor]["volumen"]["valor"]         +=$r["ca_volumen"];
                    $this->totales["linea"][$nProveedor]["peso"]["valor"]            +=$r["ca_peso"];
                    $this->totales["linea"][$nProveedor]["piezas"]["valor"]          +=$r["ca_numpiezas"];
                    $this->totales["linea"][$nProveedor]["nref"]["valor"]++;

                    //por origen
                    $nOrigen=$r["o_ciudad"];
                    $this->totales["Origen"][$nOrigen]["InoViIngreso"]["valor"]   +=$r["ing_valor"];
                    $this->totales["Origen"][$nOrigen]["InoViCosto"]["valor"]     +=$r["cost_valor"];
                    $this->totales["Origen"][$nOrigen]["InoViDeduccion"]["valor"] +=$r["ded_valor"];
                    $this->totales["Origen"][$nOrigen]["InoViUtilidad"]["valor"]  +=$r["uti_valor"];
                    $this->totales["Origen"][$nOrigen]["InoViTeus"]["valor"]      +=$r["te_valor"];
                    $this->totales["Origen"][$nOrigen]["ino"]["valor"]            +=$r["ino"];
                    $this->totales["Origen"][$nOrigen]["volumen"]["valor"]        +=$r["ca_volumen"];
                    $this->totales["Origen"][$nOrigen]["peso"]["valor"]           +=$r["ca_peso"];
                    $this->totales["Origen"][$nOrigen]["piezas"]["valor"]         +=$r["ca_numpiezas"];
                    $this->totales["Origen"][$nOrigen]["nref"]["valor"]++;

                    //totales                
                    $this->totales["totales"]["InoViIngreso"]   +=$r["ing_valor"];
                    $this->totales["totales"]["InoViCosto"]     +=$r["cost_valor"];
                    $this->totales["totales"]["InoViDeduccion"] +=$r["ded_valor"];
                    $this->totales["totales"]["InoViUtilidad"]  +=$r["uti_valor"];
                    $this->totales["totales"]["InoViTeus"]      +=$r["te_valor"];
                    $this->totales["totales"]["ino"]            +=$r["ino"];
                    $this->totales["totales"]["volumen"]        +=$r["ca_volumen"];
                    $this->totales["totales"]["peso"]           +=$r["ca_peso"];
                    $this->totales["totales"]["piezas"]         +=$r["ca_numpiezas"];
                    $this->totales["totales"]["nref"]++;
                }
                catch(Exception $e)
                {
                    echo $e->getMessage();
                    print_r($r);
                    exit;
                }
                    
            }
            
            foreach ($this->tipoTotales as $opcion)
            {
                foreach($this->totales[$opcion] as $key=>$r)
                {
                    $this->totales[$opcion][$key]["InoViIngreso"]["%"]     =($r["InoViIngreso"]["valor"]*100)/$this->totales["totales"]["InoViIngreso"];
                    $this->totales[$opcion][$key]["InoViCosto"]["%"]       =($r["InoViCosto"]["valor"]*100)/$this->totales["totales"]["InoViCosto"];
                    $this->totales[$opcion][$key]["InoViDeduccion"]["%"]   =($r["InoViDeduccion"]["valor"]*100)/$this->totales["totales"]["InoViDeduccion"];
                    $this->totales[$opcion][$key]["InoViUtilidad"]["%"]    =$this->totales["totales"]["InoViUtilidad"]>0?($r["InoViUtilidad"]["valor"]*100)/$this->totales["totales"]["InoViUtilidad"]:0;
                    $this->totales[$opcion][$key]["InoViTeus"]["%"]        =$this->totales["totales"]["InoViUtilidad"]>0?($r["InoViTeus"]["valor"]*100)/$this->totales["totales"]["InoViTeus"]:0;
                    $this->totales[$opcion][$key]["ino"]["%"]              =($r["ino"]["valor"]*100)/$this->totales["totales"]["ino"];
                    $this->totales[$opcion][$key]["volumen"]["%"]          =($r["volumen"]["valor"]*100)/$this->totales["totales"]["volumen"];
                    $this->totales[$opcion][$key]["peso"]["%"]             =($r["peso"]["valor"]*100)/$this->totales["totales"]["peso"];
                    $this->totales[$opcion][$key]["piezas"]["%"]           =($r["piezas"]["valor"]*100)/$this->totales["totales"]["piezas"];
                    $this->totales[$opcion][$key]["nref"]["%"]              =($r["nref"]["valor"]*100)/$this->totales["totales"]["nref"];
                }
            }
            
            //echo "<pre>";print_r($this->datosIno);echo "</pre>";
            //echo "<pre>";
            //print_r( $this->refs[0]);
            //print_r( $this->datosIno);  
            //print_r($this->totales);
            //echo "</pre>";
        }
        
        
    }
    
/*        select m.ca_idmaster,m.ca_referencia,h.ca_doctransporte,ia.ca_reccaja
from ino.tb_master m
inner join ino.tb_house h on m.ca_idmaster=h.ca_idmaster
left join tb_brk_ingresos ia on  h.ca_doctransporte=ia.ca_referencia

where ca_impoexpo='INTERNO' and ia.ca_reccaja!=''
 * 
 */
    public function executeLiquidarComisiones(sfWebRequest $request) {

        $this->permiso = $this->getUser()->getNivelAcceso( inoReportesActions::RUTINA_COMISIONES );
        if($this->permiso==-1)
            $this->forward404();
        
        /*$databaseConf = sfYaml::load(sfConfig::get('sf_config_dir') . '/databases_replica.yml');
        $dsn = explode(";", $databaseConf ['prod']['doctrine']['param']['dsn']);        
        $dsn0= explode("=", $dsn[0]);
        $dsn1= explode("=", $dsn[1]);
        $userName = $databaseConf ['prod']['doctrine']['param']['username'];
        $userPass = $databaseConf ['prod']['doctrine']['param']['password'];
        $database = $dsn0[1];
        $host = $dsn1[1];
        $con = Doctrine_Manager::connection(new PDO("pgsql:dbname={$database};host={$host}", $userName, $userPass));
         * 
         */
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');            
        $con = Doctrine_Manager::getInstance()->connection();
        //$con = Doctrine_Manager::getInstance()->connection();
        $empresa=sfConfig::get('app_branding_name');
        $this->buscar=$request->getParameter("buscar");
        $this->user=$this->getUser();
        
        if($request->getParameter("buscar")!="")
        {
            $sucursal = $request->getParameter("sucursal");
            
            if ($sucursal) {
                $innerjoin=" inner join control.tb_usuarios u on h.ca_vendedor=u.ca_login
                         inner join control.tb_sucursales s on s.ca_idsucursal=u.ca_idsucursal";
            }
            
                $sql="Select (SELECT mo.ca_idmodo FROM tb_modos mo where mo.ca_modulo = 'INO' AND m.ca_impoexpo=mo.ca_impoexpo AND m.ca_transporte=mo.ca_transporte ) tipo,
cl.ca_compania,m.ca_modalidad,h.ca_idhouse,h.ca_vendedor,h.ca_idcliente,h.ca_doctransporte,h.ca_numpiezas,
h.ca_peso, h.ca_volumen,m.ca_idmaster, m.ca_referencia, uni.ca_numhijas, uni.ca_numpiezas, uni.ca_peso,
uni.ca_volumen, o.ca_ciudad o_ciudad, d.ca_ciudad d_ciudad, p.ca_idproveedor, i.ca_nombre p_nombre,
a.ca_idagente, ia.ca_nombre a_nombre,te.ca_valor te_valor, cost.ca_valor cost_valor, cost.ca_venta cost_venta,
ing.ca_valor ing_valor, ded.ca_valor ded_valor, uti.ca_valor uti_valor, m.ca_fchcerrado, m.ca_fchliquidado,
m.ca_observaciones, ( COALESCE(ing.ca_valor,0) + COALESCE(uti.ca_valor,0) - COALESCE(cost.ca_valor,0) - COALESCE(ded.ca_valor,0) ) as ino ,
array_to_string(ARRAY( SELECT ca_consecutivo FROM ino.vi_comprobantes WHERE ca_usuanulado is null and ca_idmaster=m.ca_idmaster AND ca_idhouse=h.ca_idhouse AND ca_idtipo IN(12)),',' ) as rccaja ,
array_to_string(ARRAY( SELECT ca_consecutivo FROM ino.vi_comprobantes WHERE ca_usuanulado is null and ca_idmaster=m.ca_idmaster AND ca_idhouse=h.ca_idhouse AND ca_idtipo NOT IN(11,12)),',' ) as facturas ,
array_to_string(ARRAY( (SELECT (com.ca_consecutivo||'|'||det.ca_cr) FROM ino.tb_comprobantes com,ino.tb_detalles det WHERE com.ca_usuanulado is null and com.ca_idcomprobante=det.ca_idcomprobante and det.ca_idmaster=m.ca_idmaster AND det.ca_idhouse=h.ca_idhouse AND com.ca_idtipo IN(11) and det.ca_cr !=0 )),',' ) comision ,
( SELECT fun_getcomision(h.ca_idcliente::numeric, m.ca_referencia::text, 'Colmas'::text) AS fun_getcomision) AS ca_porcentaje,
m.ca_fchcerrado,m.ca_usucerrado,cl.ca_fchcircular,cl.ca_stdcircular

FROM ino.tb_master m
INNER JOIN ino.tb_house h ON m.ca_idmaster = h.ca_idmaster
INNER JOIN vi_clientes cl ON h.ca_idcliente = cl.ca_idcliente
INNER JOIN tb_ciudades o ON m.ca_origen = o.ca_idciudad
INNER JOIN tb_ciudades d ON m.ca_destino = d.ca_idciudad
INNER JOIN ids.tb_proveedores p ON m.ca_idlinea = p.ca_idproveedor
INNER JOIN ids.tb_ids i ON p.ca_idproveedor = i.ca_id
LEFT JOIN ids.tb_agentes a ON m.ca_idagente = a.ca_idagente
LEFT JOIN ids.tb_ids ia ON a.ca_idagente = ia.ca_id
LEFT JOIN ino.vi_costos cost ON m.ca_idmaster = cost.ca_idmaster
LEFT JOIN ino.vi_ingresos ing ON m.ca_idmaster = ing.ca_idmaster
LEFT JOIN ino.vi_deducciones ded ON m.ca_idmaster = ded.ca_idmaster
LEFT JOIN ino.vi_utilidades uti ON m.ca_idmaster = uti.ca_idmaster
LEFT JOIN ino.vi_unidades_master uni ON m.ca_idmaster = uni.ca_idmaster
LEFT JOIN ino.vi_teus te ON m.ca_idmaster = te.ca_idmaster
                    {$innerjoin}
                    where m.ca_fchanulado IS NULL ";
                    //where m.ca_fchanulado IS NULL and  m.ca_fchcerrado is not null and m.ca_usucerrado is not null";
            if($this->permiso<2)
            {
                $sql.=" and h.ca_vendedor='{$this->user->getUserId()}'";
                //$this->observaciones
             //   $q->addWhere ("h.ca_vendedor=?",$this->user->getUserId());
            }

            $impoexpo = $request->getParameter("impoexpo");
            $transporte = $request->getParameter("transporte");
            $idlinea = $request->getParameter("idlinea");
            $idtrafico = $request->getParameter("idtrafico");
            $modalidad = $request->getParameter("modalidad");
            $idagente = $request->getParameter("idagente");
            $idcomercial = $request->getParameter("idcomercial");
            $aa = $request->getParameter("anio");
            
            $mm = $request->getParameter("mes");
            $this->casos = $request->getParameter("casos");

            if ($impoexpo) {
                $sql.=" and m.ca_impoexpo ='{$impoexpo}'";                
            }

            if ($transporte) {
                $sql.=" and m.ca_transporte ='{$transporte}'";                
            }

            if ($modalidad) {
                $sql.=" and m.ca_modalidad ='{$modalidad}'";                
            }

            if ($idtrafico) {
                if ($impoexpo == Constantes::EXPO) {
                    $sql.=" and m.ca_destino ='{$idtrafico}'";                    
                } else {
                    $sql.=" and m.ca_origen ='{$idtrafico}'";                    
                }
            }
            if ($idcomercial) {
                $sql.=" and h.ca_vendedor ='{$idcomercial}'";
            }
            
            if ($sucursal) {
                $sql.=" and s.ca_nombre ='{$sucursal}'";
            }

            if ($idlinea) {
                $sql.=" and m.ca_idlinea ='{$idlinea}'";                
            }

            if ($idagente) {
                $sql.=" and m.ca_idagente ='{$idagente}'";                
            }

            /*if ($aa!="") {
                if($empresa!='TPLogistics')
                {
                    $sql.=" and SUBSTR(m.ca_referencia,16,2) ='".($aa%100)."'";                    
                }
                else
                {
                    $sql.=" and SUBSTR(m.ca_referencia,10,2) ='".($aa%100)."'";                    
                }
            }*/
            if ($mm!="") {
                if($empresa!='TPLogistics')
                {
                    $sql.=" and SUBSTR(m.ca_referencia,8,2) ='".str_pad($mm, 2, "0", STR_PAD_LEFT)."'";
                }
                else
                {
                    $sql.=" and SUBSTR(m.ca_referencia,7,2) ='".str_pad($mm, 2, "0", STR_PAD_LEFT)."'";
                }
            }

            if ($this->casos!="") {
                if($this->casos==1)
                {
                    $sql.=" and m.ca_fchcerrado is null";
                }
                else if($this->casos==0)
                {
                    $sql.=" and m.ca_fchcerrado is not null and m.ca_usucerrado is not null";
                }
                else if($this->casos==2)
                {
                    $sql.=" and (SELECT count(ca_consecutivo) FROM ino.vi_comprobantes WHERE ca_idmaster=m.ca_idmaster AND ca_idhouse=h.ca_idhouse AND ca_idtipo IN(12))>0 and m.ca_fchcerrado is not null and m.ca_usucerrado is not null ";
                }
                else if($this->casos==3)
                {
                    $sql.=" and (SELECT count(ca_consecutivo) FROM ino.vi_comprobantes WHERE ca_idmaster=m.ca_idmaster AND ca_idhouse=h.ca_idhouse AND ca_idtipo IN(12))!=0 and m.ca_fchcerrado is not null and m.ca_usucerrado is not null ";
                    //$sql.=" and ca_stdcircular!='Vencido'";
                }
            }
            if($this->getUser()->getUserId()=="maquinche11")
            {
                /*echo "   ".$impoexpo."<br>"; //= $request->getParameter("impoexpo");
                echo "   ".$transporte."<br>"; // = $request->getParameter("transporte");
                echo "   ".$aa%100;
                echo "   ".str_pad($mm, 2, "0", STR_PAD_LEFT);*/
                //echo $q->getSqlQuery(); 

                echo $sql;
            }
            
           
            
            $st = $con->execute($sql);
            $this->refs = $st->fetchAll();
            $this->datosIno=array();
            
            if($this->getUser()->getUserId()=="maquinche11")
            {
                echo "<pre>";print_r($this->refs);echo "</pre>";
            }
            foreach($this->refs as $key=>$r)
            {
                //if($r["ca_porcentaje"]<=0)
                //    continue;

                $com_cob=0;
                $com_comp="";
                
                $com=  explode(",", $r["comision"]);
                //print_r($com);echo "<br>";
                foreach($com as $c)
                {
                    $com1=  explode("|", $c);
                    $com_cob+=(isset($com1[1])?$com1[1]:0);
                    $com_comp.=(isset($com1[0])?$com1[0]."-":"");
                }
                
                
                $r["comision_cobrada"]=($com_cob!="")?$com_cob:0;
                $r["comision_ino"]=($r["ino"]*($r["ca_porcentaje"]/100))-$r["comision_cobrada"];
                $r["comision_comprobante"]=$com_comp;
                //echo "<pre>";print_r($r);echo "<pre>";
                
                if(  (intval($r["comision_cobrada"])!=  intval($r["comision_ino"])) || $r["ca_porcentaje"]<=0 )
                    $this->datosIno[$r["ca_vendedor"]][]=$r;
            }
        }
        
        $sql="Select * from ino.tb_comprobantes where ca_idtipo=11 and ca_usuanulado is null  ";
        if($this->permiso<2)
            $sql.=" and ca_usucreado='".$this->getUser()->getUserId()."'";
         
        $sql.=" order by ca_consecutivo::integer desc";
        //echo $sql;
        $st = $con->execute($sql);
        $this->comVendedores = $st->fetchAll();
        //echo "sdfsdfsd";
        
        if($this->getUser()->getUserId()=="maquinche11")
            {
                echo "<pre>";print_r($this->datosIno);echo "<pre>";
            }
        
    }
    

    public function executeComisionarCasos(sfWebRequest $request) {        
        $house=new InoHouse();        
        $arrIdhouse=$request->getParameter("idhouse");
        $tipoComprobante = Doctrine::getTable("InoTipoComprobante")->find(InoComprobante::IDTIPO_V_INO);
        $consecutivo=  intval($tipoComprobante->getCaNumeracionActual())+1;
        $tipoComprobante->setCaNumeracionActual($consecutivo);
        $conn = $tipoComprobante->getTable()->getConnection();
        $conn->beginTransaction();        
        $tipoComprobante->save($conn);
        try {
            $comprobante = new InoComprobante();
            $comprobante->setCaIdtipo( InoComprobante::IDTIPO_V_INO );
            $comprobante->setCaConsecutivo($consecutivo);
            $comprobante->setCaFchcomprobante(date("Y-m-d"));
            $idempresa=sfConfig::get('app_branding_idempresa');
            $comprobante->setCaId($idempresa);
            $comprobante->setCaIdhouse();

            //$comprobante->setCaValor( "0" );
            $comprobante->setCaIdmoneda("COP");
            $comprobante->setCaTcambio("1");
            $comprobante->setCaObservaciones("Generado Automaticamente - ".date("Y-m-d"));
            $comprobante->save($conn);
            $totalComision=0;
            foreach($arrIdhouse as $idhouse)
            {
                $house = Doctrine::getTable("InoHouse")->find( $idhouse );
                $comision=$house->calculateFee();
                $totalComision+=$comision;
                $inoDetalle = new InoDetalle();                    //$inoDetalle->setCaIddeduccion( $params["iddeduccion"] );
                $inoDetalle->setCaIdcomprobante( $comprobante->getCaIdcomprobante() );
                $inoDetalle->setCaCr( $comision );
                $inoDetalle->setCaIdconcepto( 738 );
                $inoDetalle->setCaIdhouse( $house->getCaIdhouse() );
                $inoDetalle->setCaIdmaster( $house->getCaIdmaster() );
                $inoDetalle->setCaId( $comprobante->getCaId() );
                $inoDetalle->setCaObservaciones("Generado Automaticamente - ".date("Y-m-d"));                
                $inoDetalle->setCaValor2( $house->getIno() );
                $inoDetalle->save( $conn );
            }
            $comprobante->setCaValor( $totalComision );            
            $comprobante->save($conn);
            $conn->commit();
            //$this->comprobante=$comprobante;
        }
        catch (Exception $e)
        {
            $conn->rollBack();
            echo $e->getMessage();
            exit;
        }
        
         $this->redirect( "inoReportes/verPdf?idcomprobante=".$comprobante->getCaIdcomprobante());
        
    }
    
    public function executeHtmlCOMISIONES(sfWebRequest $request) {    

        Doctrine_Manager::getInstance()->setCurrentConnection('replica');            
        $idcomprobante=$request->getParameter("idcomprobante");
        $this->comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
        
        $this->usuario = Doctrine::getTable("Usuario")->find($this->comprobante->getCaUsucreado());
        
        $this->setLayout("none");
    }
    
    public function executeVerPdf(sfWebRequest $request) {
        $idcomprobante=$request->getParameter("idcomprobante");
        $this->url="/inoReportes/pdfComprobante/idcomprobante/".$idcomprobante;        
    }
    
    public function executePdfComprobante(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');            

        $idcomprobante=$request->getParameter("idcomprobante");
        $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
        $tipoComprobante=$comprobante->getInoTipoComprobante();
        
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "LETTER", true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Coltrans');

        $pdf->SetMargins(1, 1, 2,true);

        $pdf->setPrintHeader(false);

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->SetFont('helvetica', '', 10);

        $pdf->AddPage('', '',true);

        $pdf->setCellPaddings(1, 1, 1, 1);
        $pdf->setCellMargins(1, 1, 1, 1);
        $pdf->SetFillColor(255, 255, 127);
        $this->getRequest()->setParameter('idcomprobante',$idcomprobante);
        $html=sfContext::getInstance()->getController()->getPresentationFor( 'inoReportes', 'html'.$tipoComprobante->getCaTitulo());
        $html=utf8_encode($html);
        $html=  str_replace("#E1E1E1", "", $html);
        
        $pdf->writeHTML($html, true, false, true, false, '');
        
        $pdf->lastPage();

        $pdf->Output('rcomision'.$comprobante->getCaConsecutivo().'.pdf', 'I');

       exit;
    }
    
    public function executeEstadisticasOtm(sfWebRequest $request) {
        
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');            

        $this->origen = $request->getParameter("origen");
        $this->idorigen = $request->getParameter("idorigen");
        $this->destino = $request->getParameter("destino");
        $this->iddestino = $request->getParameter("iddestino");
        $this->idmodalidad = $request->getParameter("idmodalidad");
        $this->sucursal = $request->getParameter("sucursal");
        $this->idsucursal = $request->getParameter("idsucursal");
        $this->linea = $request->getParameter("linea");
        $this->idlinea = $request->getParameter("idlinea");
        $this->vendedor = $request->getParameter("vendedor");
        $this->login = $request->getParameter("login");
        $this->idcliente = $request->getParameter("idcliente");
        $this->idimportador = $request->getParameter("idimportador");
        
        $this->opcion = $request->getParameter("opcion");
        
        $this->fechainicial = $request->getParameter("fechaInicial");
        $this->fechafinal = $request->getParameter("fechaFinal");
        
        $this->nano = $request->getParameter("nano");
        $this->nmes = $request->getParameter("nmes");
        
        $this->nempresa = $request->getParameter("nempresa");
        $this->ntipo = $request->getParameter("ntipo");
        
        if($this->opcion){
            if ($this->nano) {
                foreach ($this->nano as $n) {
                    if ($n != "")
                        $aa[] = str_pad($n, 2, "0", STR_PAD_LEFT);
                }
            }
            if ($aa) {
                if (count($aa) > 0) {
                    $ano = "";
                    for ($i = 0; $i < count($aa); $i++) {
                        $ano.= "'" . $aa[$i] . "',";
                    }
                    if($this->ntipo==1) //ESTADISTICAS
                        $addWhere.= " AND '20'||SUBSTR(i.ca_referencia,16,2) IN (" . substr($ano, 0, -1) . ")";
                    else if($this->ntipo==2) // ASEGURADORA
                        $addWhere.= " AND date_part('year', ro.ca_fcharribo) IN (" . substr($ano, 0, -1) . ")";
                    else if($this->ntipo==3) // MINISTERIO
                        $addWhere.= " AND '20'||SUBSTR(ro.ca_consecutivo,6,2) IN (" . substr($ano, 0, -1) . ")";
                }
            }
            if ($this->nmes) {
                foreach ($this->nmes as $m) {
                    if ($m != "")
                        $mm[] = str_pad($m, 2, "0", STR_PAD_LEFT);
                }
            }
            if ($mm) {
                if (count($mm) > 0) {
                    $mes = "";
                    for ($i = 0; $i < count($mm); $i++) {
                        $mes.= "'" . $mm[$i] . "',";
                    }
                    if (strpos($mes, 'Todos los meses') != true){
                        if($this->ntipo==1) //ESTADISTICAS
                            $addWhere.= " and SUBSTR(i.ca_referencia,8,2) IN (" . substr($mes, 0, -1) . ")";
                        else if($this->ntipo==2) // ASEGURADORA
                            $addWhere.= " AND date_part('month', ro.ca_fcharribo) IN (" . substr($mes, 0, -1) . ")";
                        else if($this->ntipo==3) // MINISTERIO
                            $addWhere.= " AND SUBSTR(ro.ca_consecutivo,4,2) IN (" . substr($mes, 0, -1) . ")";
                    }
                }
            }
            $anosStr = "'".implode("','", $aa)."'";
            $mesesStr = "'".implode("','", $mm)."''";
            
            if ($this->idorigen) {
                $addWhere.= "AND i.ca_origen = '".$this->idorigen."'";
            }

            if ($this->iddestino) {
                $addWhere.= "AND i.ca_destino = '".$this->iddestino."'";
            }

            if ($this->idmodalidad) {
                if($this->idmodalidad=="FCL")
                    $addWhere.= "AND i.ca_modalidad IN ('FCL','DIRECTO')";
                else
                    $addWhere.= "AND i.ca_modalidad = '".$this->idmodalidad."'";
            }

            if ($this->idsucursal){
                if($this->idsucursal != "999")
                    $addWhere.= "AND s.ca_nombre like '%" . $this->sucursal . "%'";
            }

            if ($this->idcliente){
                if($this->ntipo == 1){
                    $addWhere.= "AND h.ca_idcliente =".$this->idcliente;
                }else{
                    $tercero = Doctrine::getTable("Tercero")->find($this->idcliente);
                    $addWhere.= " AND ter.ca_nombre like '%" . $tercero->getCaNombre()."%'";
                }
            }
            
            if ($this->idimportador){
                $tercero = Doctrine::getTable("Tercero")->find($this->idimportador);
                $addWhere.= " AND imp.ca_nombre like '%" . $tercero->getCaNombre()."%'";
            }
            
            if ($this->login){
                $addWhere.= " AND u.ca_nombre like '%" . $this->vendedor."%'";
            }
            
            if ($this->idlinea){
                $addWhere.= " AND i.ca_idlinea = " . $this->idlinea;
            }
            
            if($this->ntipo == 1 || $this->ntipo == 2){ // ESTADISTICAS Y ASEGURADORA
            
                //$select = $this->nempresa==2?",ter.ca_nombre as importador,bdg.ca_nombre as ca_bodega":"";
                $select = $this->ntipo==1?"'20'||SUBSTR(i.ca_referencia,16,2)  as ANO,SUBSTR(i.ca_referencia,8,2)  as MES,":"date_part('year', ro.ca_fcharribo) as ANO,date_part('month', ro.ca_fcharribo) as MES,";
                $from = $this->nempresa==1?"ino.tb_house h":"tb_reportes r";
                $inner1 = $this->nempresa==2?"
                            LEFT JOIN (SELECT max(ca_idreporte) as ca_idreporte, ca_consecutivo FROM tb_repotm GROUP BY ca_consecutivo) rp on r.ca_idreporte=rp.ca_idreporte 
                            LEFT JOIN tb_repotm ro ON ro.ca_idreporte = r.ca_idreporte
                            LEFT JOIN ino.tb_house h ON h.ca_idreporte = rp.ca_idreporte":"";
                $inner2 = $this->nempresa==1?"
                            LEFT JOIN tb_repotm ro ON h.ca_idreporte = ro.ca_idreporte
                            LEFT JOIN tb_reportes r ON r.ca_idreporte = ro.ca_idreporte":"";            
                $where = $this->nempresa==1?"i.ca_fchanulado IS NULL AND i.ca_impoexpo = 'OTM-DTA'":"r.ca_tiporep = 4 and r.ca_login='consolcargo'";
                $orderBy = $this->ntipo==1?"ano, mes, referencia":"ca_fcharribo, i.ca_referencia, dtm";
                $sql ="
                    SELECT 
                        ro.ca_fcharribo, 
                        $select
                        i.ca_idmaster as ca_idmaster,
                        i.ca_referencia as referencia,
                        r.ca_idreporte as idreporte,
                        r.ca_consecutivo as no_reporte, 
                        (CASE WHEN i.ca_modalidad = 'DIRECTO' THEN 'FCL' ELSE I.ca_modalidad END) as modalidad,
                        h.ca_doctransporte as doctransporte, 
                        t.ca_ciudad AS origen, 
                        t2.ca_ciudad AS destino, 
                        i3.ca_nombre AS transportador, 
                        i8.ca_numhijas AS numhijas, 
                        h.ca_numpiezas as numpiezas , 
                        round(h.ca_peso) as peso, 
                        h.ca_volumen as volumen, 
                        (CASE WHEN i.ca_modalidad = 'LCL' THEN round((h.ca_peso/25000),3) END) as contenedorlcl,
                        ro.ca_contenedor as contenedor,
                        ro.ca_valorfob as valorfob, 
                        ro.ca_consecutivo as dtm,
                        u.ca_nombre as ca_vendedor,
                        s.ca_nombre as ca_sucursal,
                        i.ca_motonave as ca_vehiculo,
                        bdg.ca_nombre as ca_bodega,
                        h.ca_idcliente, 
                        ids.ca_nombre as ca_compania, 
                        imp.ca_nombre as ca_importador
                    FROM ino.tb_house h                        
                        LEFT JOIN ino.tb_master i ON i.ca_idmaster = h.ca_idmaster
                        LEFT JOIN tb_ciudades t ON i.ca_origen = t.ca_idciudad 
                        LEFT JOIN tb_ciudades t2 ON i.ca_destino = t2.ca_idciudad 
                        LEFT JOIN ids.tb_proveedores i2 ON i.ca_idlinea = i2.ca_idproveedor 
                        LEFT JOIN ids.tb_ids i3 ON i2.ca_idproveedor = i3.ca_id
                        LEFT JOIN tb_repotm ro ON h.ca_idreporte = ro.ca_idreporte
                        LEFT JOIN tb_reportes r ON r.ca_idreporte = ro.ca_idreporte
                        LEFT JOIN tb_terceros ter on ro.ca_idcliente = ter.ca_idtercero
                        LEFT JOIN tb_terceros imp on ro.ca_idimportador = imp.ca_idtercero
                        LEFT JOIN ids.tb_ids ids ON h.ca_idcliente = ids.ca_id
                        LEFT JOIN tb_clientes cl ON ids.ca_id = cl.ca_idcliente
                        LEFT JOIN control.tb_usuarios u ON cl.ca_vendedor = u.ca_login
                        LEFT JOIN control.tb_sucursales s ON s.ca_idsucursal = u.ca_idsucursal                       	
                        LEFT JOIN ino.vi_costos i4 ON i.ca_idmaster = i4.ca_idmaster 
                        LEFT JOIN ino.vi_ingresos i5 ON i.ca_idmaster = i5.ca_idmaster 
                        LEFT JOIN ino.vi_deducciones i6 ON i.ca_idmaster = i6.ca_idmaster 
                        LEFT JOIN ino.vi_utilidades i7 ON i.ca_idmaster = i7.ca_idmaster 
                        LEFT JOIN ino.vi_unidades_master i8 ON i.ca_idmaster = i8.ca_idmaster 
                        LEFT JOIN ino.vi_teus i9 ON i.ca_idmaster = i9.ca_idmaster
                        LEFT JOIN tb_bodegas bdg ON bdg.ca_idbodega = r.ca_idbodega                        
                    WHERE   $where $addWhere  
                    ORDER BY $orderBy";
            } else if($this->ntipo == 3 ){ // INFORME MINISTERIO
            
            $from = $this->nempresa==1?"ino.tb_house h":"tb_reportes r";
                $inner1 = $this->nempresa==2?"
                            LEFT JOIN (SELECT max(ca_idreporte) as ca_idreporte, ca_consecutivo FROM tb_repotm GROUP BY ca_consecutivo) rp on r.ca_idreporte=rp.ca_idreporte 
                            LEFT JOIN tb_repotm ro ON ro.ca_idreporte = r.ca_idreporte
                            LEFT JOIN ino.tb_house h ON h.ca_idreporte = rp.ca_idreporte":"";
                $inner2 = $this->nempresa==1?"
                            LEFT JOIN tb_repotm ro ON h.ca_idreporte = ro.ca_idreporte
                            LEFT JOIN tb_reportes r ON r.ca_idreporte = ro.ca_idreporte":"";            
                $where = $this->nempresa==1?"i.ca_fchanulado IS NULL AND i.ca_impoexpo = 'OTM-DTA'":"r.ca_tiporep = 4 and r.ca_login='consolcargo'";
                $sql ="
                    SELECT DISTINCT
                        (r.ca_consecutivo) as no_reporte,
                        SUBSTR(ro.ca_consecutivo,1,2),
                        '20'||SUBSTR(ro.ca_consecutivo,6,2)  as ANO,
                        SUBSTR(ro.ca_consecutivo,4,2) as MES,                                                
                        SUBSTR(ro.ca_consecutivo,9,4),
                        ro.ca_consecutivo as dtm,
                        m.ca_referencia as referencia, 
                        h.ca_idreporte as idreporte,
                        (CASE WHEN m.ca_modalidad = 'DIRECTO' THEN 'FCL' ELSE m.ca_modalidad END) as modalidad,
                        COALESCE(imp.ca_nombre,clir.ca_nombre) as ca_importador,
                        h.ca_doctransporte as doctransporte,
                        t.ca_ciudad AS origen, 
                        t2.ca_ciudad AS destino,
                        i3.ca_nombre AS transportador,
                        h.ca_numpiezas as numpiezas, 
                        h.ca_peso as peso, 
                        h.ca_volumen as volumen,
                        ro.ca_valorfob as valorfob,
                        r.ca_fchanulado as fecharepanulado,
                        m.ca_fchanulado as fecharefanulado
                    FROM tb_reportes r
                        INNER JOIN tb_repotm ro on (SELECT ca_idreporte 
                                                    FROM tb_reportes 
                                                    WHERE ca_consecutivo = (SELECT rp.ca_consecutivo 
                                                                            FROM tb_reportes rp 
                                                                            WHERE rp.ca_idreporte = r.ca_idreporte limit 1 ) and ca_tiporep = 4  
                                                                            ORDER BY ca_idreporte DESC 
                                                                            LIMIT 1 ) = ro.ca_idreporte
                        INNER JOIN ino.tb_house h on r.ca_idreporte = h.ca_idreporte
                        LEFT JOIN ino.tb_master m ON m.ca_idmaster = h.ca_idmaster
                        LEFT JOIN tb_terceros clir on ro.ca_idcliente = clir.ca_idtercero
                        LEFT JOIN tb_terceros imp on ro.ca_idimportador = imp.ca_idtercero
                        LEFT JOIN ids.tb_proveedores i2 ON m.ca_idlinea = i2.ca_idproveedor
                        LEFT JOIN ids.tb_ids i3 ON i2.ca_idproveedor = i3.ca_id
                        LEFT JOIN tb_ciudades t ON m.ca_origen = t.ca_idciudad
                        LEFT JOIN tb_ciudades t2 ON m.ca_destino = t2.ca_idciudad
                    WHERE ro.ca_consecutivo IS NOT NULL and ca_tiporep = 4 $addWhere
                    ORDER BY 2,3,4,5";
            }
            $con = Doctrine_Manager::getInstance()->connection();            
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();
        }    
            //echo "<pre>";print_r($this->resul);echo "</pre>";
    }
    
    public function executeReporteadorExt4(sfWebRequest $request) {
        
        /*$databaseConf = sfYaml::load(sfConfig::get('sf_config_dir') . '/databases_replica.yml');
        $dsn = explode(";", $databaseConf ['prod']['doctrine']['param']['dsn']);        
        $dsn0= explode("=", $dsn[0]);
        $dsn1= explode("=", $dsn[1]);
        $userName = $databaseConf ['prod']['doctrine']['param']['username'];
        $userPass = $databaseConf ['prod']['doctrine']['param']['password'];
        $database = $dsn0[1];
        $host = $dsn1[1];
        $con = Doctrine_Manager::connection(new PDO("pgsql:dbname={$database};host={$host}", $userName, $userPass));
         * 
         */
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');            
        $con = Doctrine_Manager::getInstance()->connection();
        
        
        $this->years = array();
        for ($i = 0; $i < 5; $i++) {
            $this->years[] = array("year" => date('Y') - $i);
        }
        $this->meses = array();
        //$this->meses[]=array("id" => "%","valor" => "Todos los Meses");
        for ($i = 1; $i <= 12; $i++) {
            $this->meses[] = array("id" => str_pad($i, 2, "0", STR_PAD_LEFT), "valor" => Utils::mesLargo($i));
        }

        //select distinct ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal
        $this->sucursales = array();

        $sucursales = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->select("s.ca_nombre")
                ->distinct()
                //->select("s.ca_idsucursal,s.ca_nombre")
                ->addOrderBy("s.ca_nombre")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();

        foreach ($sucursales as $sucursal) {
            $this->sucursales[] = array("id" => utf8_encode($sucursal["s_ca_nombre"]), "valor" => utf8_encode($sucursal["s_ca_nombre"]));
        }

        $traficos = Doctrine::getTable('Trafico')->createQuery('t')
                ->where('t.ca_idtrafico != ?', '99-999')
                ->addOrderBy('t.ca_nombre ASC')
                ->execute();

        $this->traficos = array();
        foreach ($traficos as $trafico) {
            $this->traficos[] = array("nombre" => utf8_encode($trafico->getCaNombre()),
                "idtrafico" => $trafico->getCaIdtrafico()
            );
        }

        $ciudades = Doctrine::getTable('Ciudad')->createQuery('c')
                ->where('c.ca_idtrafico = ?', 'CO-057')
                ->addOrderBy('c.ca_ciudad ASC')
                ->execute();

        $this->ciudadDestino = array();
        foreach ($ciudades as $c) {
            $this->ciudadDestino[] = array("valor" => utf8_encode($c->getCaCiudad()),
                "id" => $c->getCaIdciudad()
            );
        }

        $this->criterios = array(
            array("id"=>"ca_ano","valor"=>  utf8_encode("Año")),
            array("id"=>"ca_mes","valor"=>"Mes"),
            array("id"=>"ca_sucursal","valor"=>"Sucursal"),
            array("id"=>"ca_traorigen","valor"=>utf8_encode("Tráfico")),
            array("id"=>"ca_vendedor","valor"=>"Vendedor"),
            array("id"=>"ca_compania","valor"=>"Clientes"),
            //array("id"=>"ca_estado","valor"=>"Estado"),
            array("id"=>"ca_ciudestino","valor"=>"Puerto/Destino"),
            array("id"=>"ca_nomlinea","valor"=>"Transportador")
        );
        
        
        $this->year=( ( $request->getParameter("year")!="" )?$request->getParameter("year"):date("Y"));
        $this->mes=( ( $request->getParameter("mes")!="" )?$request->getParameter("mes"):str_pad(date("m"), 2, "0", STR_PAD_LEFT));
        $this->destino=( ( $request->getParameter("destino")!="" )?$request->getParameter("destino"):"");
        $this->criterio=( ( $request->getParameter("criterio")!="" )?$request->getParameter("criterio"):"");
        $this->sucursal=( ( $request->getParameter("sucursal")!="" )?$request->getParameter("sucursal"):"");
        $this->vendedor=( ( $request->getParameter("vendedor")!="" )?$request->getParameter("vendedor"):"");
        
        $this->impoexpo=( ( $request->getParameter("impoexpo")!="" )?$request->getParameter("impoexpo"):"");
        $this->transporte=( ( $request->getParameter("transporte")!="" )?$request->getParameter("transporte"):"");
        $this->modalidad=( ( $request->getParameter("modalidad")!="" )?$request->getParameter("modalidad"):"");
        $this->idcliente=( ( $request->getParameter("idcliente")!="" )?$request->getParameter("idcliente"):"");
        $this->idlinea=( ( $request->getParameter("idlinea")!="" )?$request->getParameter("idlinea"):"");
        
        if ($request->isMethod('post')){
            
            $empresa=sfConfig::get('app_branding_name');
            
            $sql=$where="";
            $sql="Select ".$this->criterio.",
                        COUNT(DISTINCT ca_referencia) as ca_referencias, 
                        COUNT(ca_numhijas) as ca_hbls, 
                        SUM(ca_ingresos) as ca_facturacion, 
                        SUM(ca_utilidad) as ca_utilidad, 
                        SUM(ca_volumen) as ca_cbm, 
                        SUM(ca_teus) as ca_teus
                        from ino.vi_repgenerador m";
            
            $q = Doctrine::getTable("InoViRepgenerador")
                    ->createQuery("m")
                    ->select($this->criterio.",ca_referencia,
                        COUNT(DISTINCT ca_referencia) as ca_referencias, 
                        COUNT(ca_numhijas) as ca_hbls, 
                        SUM(ca_ingresos) as ca_facturacion, 
                        SUM(ca_utilidad) as ca_utilidad, 
                        SUM(ca_volumen) as ca_cbm, 
                        SUM(ca_teus) as ca_teus");
            
            $q->orderBy($this->criterio);
            $cri_tmp= explode(",",$this->criterio);
            foreach($cri_tmp as $c)
                $q->addGroupBy($c);
            
            //$q->addOrderBy("ca_referencia");
            //$q->addGroupBy("ca_referencia");
            
             
            $q->addWhere("m.ca_fchanulado IS NULL ");
            $where=" Where m.ca_fchanulado IS NULL";
            /*
            if ($origen) {
                $q->addWhere("o.ca_ciudad = ? ", $origen);
            }*/

            if ($this->impoexpo) {
                $q->addWhere("m.ca_impoexpo = ? ", $this->impoexpo);
                $where.=" and m.ca_impoexpo ='".$this->impoexpo."'";
                echo "1597-".$this->impoexpo."<br>";
            }

            if ($this->transporte) {
                $q->addWhere("m.ca_transporte = ? ", $this->transporte);
                $where.=" and m.ca_transporte ='".$this->transporte."'";
                echo "1602-".$this->transporte."<br>";
            }

            if ($this->modalidad) {
                $q->addWhere("m.ca_modalidad = ? ", $this->modalidad);
                $where.=" and m.ca_modalidad ='".$this->modalidad."'";
                echo "1607-".$this->modalidad."<br>";
            }

            if ($this->idlinea) {
                $q->addWhere("m.ca_idlinea = ? ", $this->idlinea);
                $where.=" and m.ca_idlinea =".$this->idlinea;
                echo "1612-".$this->idlinea."<br>";
            }

            if ($this->idcliente) {
                $q->addWhere("m.ca_idcliente = ? ", $this->idcliente);
                $where.=" and m.ca_idcliente =".$this->idcliente;
                echo "1617-".$this->idcliente."<br>";
            }

            if ($this->mes) {
                $q->andWhereIn("ca_mes", $this->mes);
                $where.=" and ca_mes in ('". str_replace(",", "','", $this->mes)."')";
                echo "1622-". $this->mes."<br>";
            }

            if ($this->destino) {
                $q->andWhereIn("m.ca_destino",   $this->destino);
                $where.=" and m.ca_destino in ('". str_replace(",", "','", $this->destino)."')";
                echo "1625-".$this->destino."<br>";
                //$q->addWhere("d.ca_ciudad IN (?) ", $this->destino);
            }

            if($this->sucursal )
            {
                //$q->innerJoin("v.Sucursal s WITH s.ca_nombre='$this->sucursal'");
                $q->addWhere("m.ca_sucursal = ? ", $this->sucursal);
                $where.=" and m.ca_sucursal ='".$this->sucursal."'";
                echo "1635-".$this->sucursal."<br>";
            }

/*            if ($idtrafico) {
                if ($impoexpo == Constantes::EXPO) {
                    $q->addWhere("m.ca_destino = ? ", $idtrafico);
                } else {
                    $q->addWhere("m.ca_origen = ? ", $idtrafico);
                }
            }
 * 
 */
            /*if (count($mm)>0) {
                if($empresa!='TPLogistics'){
                    
                    $q->andWhereIn("SUBSTR(m.ca_referencia,8,2)",$mm);
                }else{
                    if($aa<='2012' || ($aa=='2013' && (in_array('1', $mm) || in_array('2', $mm)))){
                        $q->andWhereIn("SUBSTR(m.ca_referencia,8,2)",$mm);
                    }else{
                        $q->andWhereIn("SUBSTR(m.ca_referencia,7,2)",$mm);
                    }
                }
                echo "1659-".implode(",",$mm)."<br>";
            }*/

            
            if ($this->vendedor) {
                $q->andWhereIn("m.ca_vendedor",  $this->vendedor);
                $where.=" and m.ca_vendedor in ('". str_replace(",", "','", $this->vendedor)."')";
                echo "1665-".$this->vendedor ."<br>";
            }

            if ($this->year) {
                if($empresa!='TPLogistics'){
                    $q->addWhere("ca_ano = ?", $this->year % 100);
                    $where.=" and ca_ano ='".($this->year % 100)."'";
                }else{
                    if($aa<='2012' || ($aa=='2013' && (in_array('1', $mm) || in_array('2', $mm)))){
                        $q->addWhere("substr(m.ca_referencia,15,1) = ?", $this->year % 10);
                    }else{
                        $q->addWhere("SUBSTR(m.ca_referencia,10,2) = ? ", $this->year%100);
                    }
                }
                echo $aa%100 ."<br>";
            }
            //echo $q->getSqlQuery();
            
            $sql.=$where;
            $sql.=" group by ".$this->criterio;
            $sql.=" order by ".$this->criterio;
            
            //echo "$sql<br>";
            //$this->datos = $q->setHydrationMode(Doctrine::HYDRATE_ARRAY)->execute();
            //print_r($this->datos);
            //$con = Doctrine_Manager::getInstance()->connection();            
            $st = $con->execute($sql);
            $this->datos = $st->fetchAll();
        }
    }
    
    
    
    public function executeDatosReporteador(sfWebRequest $request) {
        

        Doctrine_Manager::getInstance()->setCurrentConnection('replica');            

        $this->year=( ( $request->getParameter("year")!="" )?$request->getParameter("year"):date("Y"));
        $this->mes=( ( $request->getParameter("mes")!="" )?$request->getParameter("mes"):str_pad(date("m"), 2, "0", STR_PAD_LEFT));
        $this->destino=( ( $request->getParameter("destino")!="" )?$request->getParameter("destino"):"");
        $this->criterio=( ( $request->getParameter("criterio")!="" )?$request->getParameter("criterio"):"");
        $this->sucursal=( ( $request->getParameter("sucursal")!="" )?$request->getParameter("sucursal"):"");
        $this->vendedor=( ( $request->getParameter("vendedor")!="" )?$request->getParameter("vendedor"):"");
        
        $this->impoexpo=( ( $request->getParameter("impoexpo")!="" )?$request->getParameter("impoexpo"):"");
        $this->transporte=( ( $request->getParameter("transporte")!="" )?$request->getParameter("transporte"):"");
        $this->modalidad=( ( $request->getParameter("modalidad")!="" )?$request->getParameter("modalidad"):"");
        $this->idcliente=( ( $request->getParameter("idcliente")!="" )?$request->getParameter("idcliente"):"");
        $this->idlinea=( ( $request->getParameter("idlinea")!="" )?$request->getParameter("idlinea"):"");
        
        
            
        $empresa=sfConfig::get('app_branding_name');

        $sql=$where="";
        $sql="Select ".$this->criterio.",
                    COUNT(DISTINCT ca_referencia) as ca_referencias, 
                    COUNT(ca_numhijas) as ca_hbls, 
                    SUM(ca_ingresos) as ca_facturacion, 
                    SUM(ca_utilidad) as ca_utilidad, 
                    SUM(ca_volumen) as ca_cbm, 
                    SUM(ca_teus) as ca_teus
                    from ino.vi_repgenerador m";

        $cri_tmp= explode(",",$this->criterio);

        $where=" Where m.ca_fchanulado IS NULL";
        /*
        if ($origen) {
            $q->addWhere("o.ca_ciudad = ? ", $origen);
        }*/

        if ($this->impoexpo && $empresa!='TPLogistics') {
            $where.=" and m.ca_impoexpo ='".$this->impoexpo."'";                
        }

        if ($this->transporte && $empresa!='TPLogistics') {
            $where.=" and m.ca_transporte ='".$this->transporte."'";
        }

        if ($this->modalidad) {
            $where.=" and m.ca_modalidad ='".$this->modalidad."'";
        }

        if ($this->idlinea) {
            $where.=" and m.ca_idlinea =".$this->idlinea;
        }

        if ($this->idcliente) {                
            $where.=" and m.ca_idcliente =".$this->idcliente;
        }

        if ($this->mes) {                
            $where.=" and ca_mes in ('". str_replace(",", "','", $this->mes)."')";                
        }

        if ($this->destino) {
            $where.=" and m.ca_destino in ('". str_replace(",", "','", $this->destino)."')";
            //$q->addWhere("d.ca_ciudad IN (?) ", $this->destino);
        }

        if($this->sucursal )
        {
            $where.=" and m.ca_sucursal ='".utf8_decode($this->sucursal)."'";
        }

/*            if ($idtrafico) {
            if ($impoexpo == Constantes::EXPO) {
                $q->addWhere("m.ca_destino = ? ", $idtrafico);
            } else {
                $q->addWhere("m.ca_origen = ? ", $idtrafico);
            }
        }
* 
*/
        /*if (count($mm)>0) {
            if($empresa!='TPLogistics'){

                $q->andWhereIn("SUBSTR(m.ca_referencia,8,2)",$mm);
            }else{
                if($aa<='2012' || ($aa=='2013' && (in_array('1', $mm) || in_array('2', $mm)))){
                    $q->andWhereIn("SUBSTR(m.ca_referencia,8,2)",$mm);
                }else{
                    $q->andWhereIn("SUBSTR(m.ca_referencia,7,2)",$mm);
                }
            }
            echo "1659-".implode(",",$mm)."<br>";
        }*/


        if ($this->vendedor) {
            $where.=" and m.ca_vendedor in ('". str_replace(",", "','", $this->vendedor)."')";
        }

        if ($this->year) {
            if($empresa!='TPLogistics'){
                $where.=" and ca_ano ='".($this->year % 100)."'";
            }else{
                /*if($aa<='2012' || ($aa=='2013' && (in_array('1', $mm) || in_array('2', $mm)))){
                    $where.="substr(m.ca_referencia,15,1) = '". ($this->year % 10)."'";
                }else{*/
                
                    $where.=" and ca_ano::integer in (".($this->year).")";
                //}
            }
        }

        $sql.=$where;
        $sql.=" group by ".$this->criterio;
        $sql.=" order by ".$this->criterio;

        //echo "$sql<br>";
        $con = Doctrine_Manager::getInstance()->connection();            
        $st = $con->execute($sql);
        $this->datos = $st->fetchAll();
        
        if(count($this->datos)>0)
        {
            $keys=array_keys($this->datos[0]);       
            foreach($this->datos as $k=>$d)
            {
                foreach($keys as $i)
                {
                    if(!is_nan($this->datos[$k][$i]))
                        $this->datos[$k][$i]=  utf8_encode ($this->datos[$k][$i]);
                }
            }
        }
        
        $this->responseArray = array("success" => true, "root" => $this->datos, "total" => count($this->datos),"debug"=>$sql);
        $this->setTemplate("responseTemplate");
        
    }

    public function executeReporteadorXls(sfWebRequest $request) {
        
        
        $datos=json_decode(utf8_encode($request->getParameter("datos")),true);        
        $style_titulo["alignment"]["horizontal"]=PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
        $style_titulo["fill"]["type"]=PHPExcel_Style_Fill::FILL_SOLID;
        $style_titulo["fill"]["color"]=array("rgb"=>"157FCC");
        $style_titulo["font"]["name"]='Verdana';
        $style_titulo["font"]["bold"]=true;
        $style_titulo["font"]["color"]=array("rgb"=>"FFFFFF");
        $style_titulo["font"]["size"]=14;
        
        $style_titulo1["fill"]["type"]=PHPExcel_Style_Fill::FILL_SOLID;
        $style_titulo1["fill"]["color"]=array("rgb"=>"B8B8B8");
        $style_titulo1["font"]["name"]='Verdana';
        $style_titulo1["font"]["bold"]=true;
        $style_titulo1["font"]["color"]=array("rgb"=>"FFFFFF");
        
        $style_titulo2["fill"]["type"]=PHPExcel_Style_Fill::FILL_SOLID;
        $style_titulo2["fill"]["color"]=array("rgb"=>"C1DDF1");
        $style_titulo2["font"]["name"]='Verdana';
        $style_titulo2["font"]["bold"]=true;
        $style_titulo2["font"]["color"]=array("rgb"=>"FFFFFF");
        
        
        $style_totales["fill"]["type"]=PHPExcel_Style_Fill::FILL_SOLID;
        $style_totales["fill"]["color"]=array("rgb"=>"157FCC");
        $style_totales["font"]["name"]='Verdana';
        $style_totales["font"]["bold"]=true;
        $style_totales["font"]["color"]=array("rgb"=>"FFFFFF");
        

        
        $this->celdas1=array();
        $grupos=$datos["group"];
        $grupos_tmp=array();        
        foreach($datos["data"] as $k=>$d)
        {
            $celda_tmp=array();
            if($k==0)
            {
                $keys=array_keys($d);
                $nkeys=count($keys)-count($grupos);
                $this->celdas1[]=array("data"=>array(array("value"=>"Generador de informes","colspan"=>$nkeys)),"style"=>$style_titulo);
                
                
                /*TITULOS*/
                $celda_tmp=array();
                foreach($keys as $k1)
                {
                    if(!in_array($k1, $grupos))
                        $celda_tmp[]["value"]=$k1;
                }
                $this->celdas1[]=array("data"=>$celda_tmp,"style"=>$style_titulo2);
                /*TITULOS*/
            }
            /*TOTALES*/
            foreach($grupos as $g)
            {
                
                if($grupos_tmp[$g]!=$d[$g])
                {
                    if($k!=0)
                    {
                        $celda_tmp=array();                    
                        foreach($keys as $k1)
                        {
                            if(!in_array($k1, $grupos))
                            {
                                $celda_tmp[]["value"]=$grupos_tmp["fields"][$k1]["value"];
                                if(is_numeric($d[$k1]))
                                    $grupos_tmp["fields"][$k1]["value"]=0;
                            }
                        }
                        $this->celdas1[]=array("data"=>$celda_tmp,"style"=>$style_titulo2);
                    }
                    $this->celdas1[]=array("data"=>array(array("value"=>$g.":".$d[$g],"colspan"=>$nkeys)),"style"=>$style_titulo1);
                    
                }
            }
            /*TOTALES*/
            
            
            /*datos*/
            $celda_tmp=array();
            foreach($keys as $k1)
            {
                if(!in_array($k1, $grupos))
                {
                    $celda_tmp[]["value"]=$d[$k1];
                }
                if(is_numeric($d[$k1]))
                {
                    $grupos_tmp["fields"][$k1]["value"]+=$d[$k1];
                    $grupos_tmp["fields"][$k1]["total"]+=$d[$k1];
                }

            }
            $this->celdas1[]=array("data"=>$celda_tmp);            
            /*datos*/

            foreach($grupos as $g)
            {
                $grupos_tmp[$g]=$d[$g];
            }
        }
        
        
        /*TOTALES*/
        $celda_tmp=array();
        foreach($keys as $k1)
        {
            if(!in_array($k1, $grupos))
            {
                $celda_tmp[]["value"]=$grupos_tmp["fields"][$k1]["value"];
                $grupos_tmp["fields"][$k1]["value"]=0;
            }
        }
        $this->celdas1[]=array("data"=>$celda_tmp,"style"=>$style_titulo2);
        $celda_tmp=array();
        foreach($keys as $k1)
        {
            if(!in_array($k1, $grupos))
                $celda_tmp[]["value"]=$grupos_tmp["fields"][$k1]["total"];            
        }
        $this->celdas1[]=array("data"=>$celda_tmp,"style"=>$style_totales);
        /*TOTALES*/

        $this->setTemplate("xls");
        
        
        
        //$celdas[]=array("data"=>array(array("value"=>"Titulo","colspan"=>3)),"style"=>$style_titulo);
        
       // exit;
    }
    
    /*public function executeXls(sfWebRequest $request) {
     
        
    }*/
    
}

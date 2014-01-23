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

        $aa = $request->getParameter("aa");
        $q = Doctrine::getTable("InoMaster")
                ->createQuery("m")
                ->innerJoin("m.InoHouse h")
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
                ->select("m.ca_idmaster, m.ca_referencia, uni.ca_numhijas, uni.ca_numpiezas, uni.ca_peso, uni.ca_volumen, 
                            o.ca_ciudad, d.ca_ciudad, p.ca_idproveedor, i.ca_nombre,a.ca_idagente,ia.ca_nombre, te.ca_valor,
                            cost.ca_valor, cost.ca_venta, ing.ca_valor, ded.ca_valor, uti.ca_valor, m.ca_fchcerrado, m.ca_fchliquidado, m.ca_observaciones")
                ->addWhere("substr(m.ca_referencia,16,2) = ?", $aa % 100);

        $impoexpo = $request->getParameter("impoexpo");
        $transporte = $request->getParameter("transporte");
        $idlinea = $request->getParameter("idlinea");
        $idtrafico = $request->getParameter("idtrafico");
        $modalidad = $request->getParameter("modalidad");
        $idagente = $request->getParameter("idagente");
        $origen = $request->getParameter("origen");
        $destino = $request->getParameter("destino");
        $login = $request->getParameter("login");

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
            $q->andWhereIn("SUBSTR(m.ca_referencia,8,2)",$mm);
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

        /*if ($aa) {
            $q->addWhere("SUBSTR(m.ca_referencia,15,1) = ? ", $aa % 10);
        }*/
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
                            o.ca_ciudad, d.ca_ciudad, p.ca_idproveedor, i.ca_nombre,a.ca_idagente,ia.ca_nombre, te.ca_valor,
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

        $aa = $request->getParameter("aa");
        
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

        /*if ($aa) {
            $q->addWhere("SUBSTR(m.ca_referencia,15,1) = ? ", $aa % 10);
        }*/
        //echo $q->getSqlQuery();
        $this->refs = $q->setHydrationMode(Doctrine::HYDRATE_ARRAY)->execute();
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeListadoComprobantes(sfWebRequest $request) {


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
            $casos = $request->getParameter("casos");
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
            
            if ($casos!="") {
                if($casos==1)
                    $q->addWhere("m.ca_fchcerrado is null");
                else if($casos==0)
                    $q->addWhere("m.ca_fchcerrado is not null");
            }
            if($this->getUser()->getUserId()=="maquinche")
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
        $con = Doctrine_Manager::getInstance()->connection();
        $empresa=sfConfig::get('app_branding_name');
        if($empresa!=Constantes::TPLOGISTICS)
            $this->permiso = $this->getUser()->getNivelAcceso( inoReportesActions::RUTINA_COMISIONES );
        else
            $this->permiso=2;
        
        $this->buscar=$request->getParameter("buscar");
        
        if($request->getParameter("buscar")!="")
        {
            $sucursal = $request->getParameter("sucursal");
            
            if ($sucursal) {
                $innerjoin=" inner join control.tb_usuarios u on h.ca_vendedor=u.ca_login
                         inner join control.tb_sucursales s on s.ca_idsucursal=u.ca_idsucursal";
            }
            
                $sql="Select 
                        (SELECT mo.ca_idmodo FROM tb_modos mo where mo.ca_modulo = 'INO' AND m.ca_impoexpo=mo.ca_impoexpo AND m.ca_transporte=mo.ca_transporte ) tipo,
                        cl.ca_compania,m.ca_modalidad,h.ca_idhouse,h.ca_vendedor,h.ca_idcliente,h.ca_doctransporte,h.ca_numpiezas,h.ca_peso,
                        h.ca_volumen,m.ca_idmaster, m.ca_referencia, uni.ca_numhijas, uni.ca_numpiezas, uni.ca_peso, uni.ca_volumen, 
                        o.ca_ciudad o_ciudad, d.ca_ciudad d_ciudad, p.ca_idproveedor, i.ca_nombre p_nombre,a.ca_idagente, ia.ca_nombre a_nombre,te.ca_valor te_valor, 
                        cost.ca_valor cost_valor, cost.ca_venta cost_venta, ing.ca_valor ing_valor, ded.ca_valor ded_valor, uti.ca_valor uti_valor, 
                        m.ca_fchcerrado, m.ca_fchliquidado, m.ca_observaciones,
                        ( COALESCE(ing.ca_valor,0) + COALESCE(uti.ca_valor,0) - COALESCE(cost.ca_valor,0) - COALESCE(ded.ca_valor,0) ) as ino
                        ,rc.ca_consecutivo as rcaja, rc.ca_valor rcvalor
                        ,array_to_string(ARRAY( SELECT ca_consecutivo FROM ino.vi_comprobantes  WHERE ca_idmaster=m.ca_idmaster AND ca_idhouse=h.ca_idhouse AND ca_idtipo NOT IN(11,12)),',' ) as facturas
                       ,(SELECT (com.ca_consecutivo||'|'||det.ca_cr) FROM ino.tb_comprobantes com,ino.tb_detalles det WHERE com.ca_idcomprobante=det.ca_idcomprobante and det.ca_idmaster=m.ca_idmaster AND det.ca_idhouse=h.ca_idhouse AND com.ca_idtipo IN(11) and det.ca_cr >0 limit 1) comision
                       ,( SELECT fun_getcomision(h.ca_idcliente::numeric, m.ca_referencia::text, '".$empresa."'::text) AS fun_getcomision) AS ca_porcentaje,
                       m.ca_fchcerrado,m.ca_usucerrado,cl.ca_fchcircular
                       
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
                    left JOIN ino.vi_comprobantes rc ON m.ca_idmaster = rc.ca_idmaster and h.ca_idhouse = rc.ca_idhouse and rc.ca_idtipo=12
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
            $casos = $request->getParameter("casos");

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

            if ($aa!="") {
                if($empresa!='TPLogistics')
                {
                    $sql.=" and SUBSTR(m.ca_referencia,16,2) ='".($aa%100)."'";                    
                }
                else
                {
                    $sql.=" and SUBSTR(m.ca_referencia,10,2) ='".($aa%100)."'";                    
                }
            }
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

            if ($casos!="") {
                if($casos==1)
                {
                    $sql.=" and m.ca_fchcerrado is null";
                }
                else if($casos==0)
                {
                    $sql.=" and m.ca_fchcerrado is not null and m.ca_usucerrado is not null";
                }
                else if($casos==2)
                {
                    $sql.=" and rc.ca_consecutivo is not null and m.ca_fchcerrado is not null and m.ca_usucerrado is not null";
                }
            }
            if($this->getUser()->getUserId()=="maquinche11")
            {
                echo "   ".$impoexpo."<br>"; //= $request->getParameter("impoexpo");
                echo "   ".$transporte."<br>"; // = $request->getParameter("transporte");
                echo "   ".$aa%100;
                echo "   ".str_pad($mm, 2, "0", STR_PAD_LEFT);
                //echo $q->getSqlQuery(); 

                echo $sql;
            }
            
            $st = $con->execute($sql);
            $this->refs = $st->fetchAll();
          
            //echo "<pre>";print_r($this->refs);echo "<pre>";
            //exit;
            $this->datosIno=array();
            $this->totales=array();
            
            $this->tipoTotales=array("vendedor","cliente","agente","linea","Origen");
            foreach($this->refs as $key=>$r)
            {
                
                //if($r["ca_porcentaje"]<=0)
                //    continue;
                $com=  explode("|", $r["comision"]);                
                $r["comision_cobrada"]=(isset($com[1])?$com[1]:"0");
                $r["comision_ino"]=($r["ino"]*($r["ca_porcentaje"]/100))-$r["comision_cobrada"];
                $r["comision_comprobante"]=(isset($com[0])?$com[0]:"");
                //echo "<pre>";print_r($r);echo "<pre>";
                
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
        
        
        $con = Doctrine_Manager::getInstance()->connection();
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
            
                $sql="Select 
                        (SELECT mo.ca_idmodo FROM tb_modos mo where mo.ca_modulo = 'INO' AND m.ca_impoexpo=mo.ca_impoexpo AND m.ca_transporte=mo.ca_transporte ) tipo,
                        cl.ca_compania,m.ca_modalidad,h.ca_idhouse,h.ca_vendedor,h.ca_idcliente,h.ca_doctransporte,h.ca_numpiezas,h.ca_peso,
                        h.ca_volumen,m.ca_idmaster, m.ca_referencia, uni.ca_numhijas, uni.ca_numpiezas, uni.ca_peso, uni.ca_volumen, 
                        o.ca_ciudad o_ciudad, d.ca_ciudad d_ciudad, p.ca_idproveedor, i.ca_nombre p_nombre,a.ca_idagente, ia.ca_nombre a_nombre,te.ca_valor te_valor, 
                        cost.ca_valor cost_valor, cost.ca_venta cost_venta, ing.ca_valor ing_valor, ded.ca_valor ded_valor, uti.ca_valor uti_valor, 
                        m.ca_fchcerrado, m.ca_fchliquidado, m.ca_observaciones,
                        ( COALESCE(ing.ca_valor,0) + COALESCE(uti.ca_valor,0) - COALESCE(cost.ca_valor,0) - COALESCE(ded.ca_valor,0) ) as ino
                        ,rc.ca_consecutivo as rcaja, rc.ca_valor rcvalor
                        ,array_to_string(ARRAY( SELECT ca_consecutivo FROM ino.vi_comprobantes  WHERE ca_idmaster=m.ca_idmaster AND ca_idhouse=h.ca_idhouse AND ca_idtipo NOT IN(11,12)),',' ) as facturas
                       ,(SELECT (com.ca_consecutivo||'|'||det.ca_cr) FROM ino.tb_comprobantes com,ino.tb_detalles det WHERE com.ca_idcomprobante=det.ca_idcomprobante and det.ca_idmaster=m.ca_idmaster AND det.ca_idhouse=h.ca_idhouse AND com.ca_idtipo IN(11) and det.ca_cr >0 limit 1) comision
                       ,( SELECT fun_getcomision(h.ca_idcliente::numeric, m.ca_referencia::text, 'Coltrans'::text) AS fun_getcomision) AS ca_porcentaje,
                       m.ca_fchcerrado,m.ca_usucerrado,cl.ca_fchcircular
                       
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
                    left JOIN ino.vi_comprobantes rc ON m.ca_idmaster = rc.ca_idmaster and h.ca_idhouse = rc.ca_idhouse and rc.ca_idtipo=12
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
            $casos = $request->getParameter("casos");

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

            if ($aa!="") {
                if($empresa!='TPLogistics')
                {
                    $sql.=" and SUBSTR(m.ca_referencia,16,2) ='".($aa%100)."'";                    
                }
                else
                {
                    $sql.=" and SUBSTR(m.ca_referencia,10,2) ='".($aa%100)."'";                    
                }
            }
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

            if ($casos!="") {
                if($casos==1)
                {
                    $sql.=" and m.ca_fchcerrado is null";
                }
                else if($casos==0)
                {
                    $sql.=" and m.ca_fchcerrado is not null and m.ca_usucerrado is not null";
                }
                else if($casos==2)
                {
                    $sql.=" and rc.ca_consecutivo is not null and m.ca_fchcerrado is not null and m.ca_usucerrado is not null";
                }
            }
            if($this->getUser()->getUserId()=="maquinche11")
            {
                echo "   ".$impoexpo."<br>"; //= $request->getParameter("impoexpo");
                echo "   ".$transporte."<br>"; // = $request->getParameter("transporte");
                echo "   ".$aa%100;
                echo "   ".str_pad($mm, 2, "0", STR_PAD_LEFT);
                //echo $q->getSqlQuery(); 

                echo $sql;
            }
            
            $st = $con->execute($sql);
            $this->refs = $st->fetchAll();
            $this->datosIno=array();
            
            foreach($this->refs as $key=>$r)
            {
                if($r["ca_porcentaje"]<=0)
                    continue;
                $com=  explode("|", $r["comision"]);                
                $r["comision_cobrada"]=(isset($com[1])?$com[1]:"0");
                $r["comision_ino"]=($r["ino"]*($r["ca_porcentaje"]/100))-$r["comision_cobrada"];
                $r["comision_comprobante"]=(isset($com[0])?$com[0]:"");
                //echo "<pre>";print_r($r);echo "<pre>";
                
                if(intval($r["comision_cobrada"])!=  intval($r["comision_ino"]))
                    $this->datosIno[$r["ca_vendedor"]][]=$r;
            }
        }
        
        $sql="Select * from ino.tb_comprobantes where ca_idtipo=11 and ca_usuanulado is null  ";
        if($this->permiso<2)
            $sql.=" and ca_usucreado='".$this->getUser()->getUserId()."'";
         
        $sql.=" order by ca_consecutivo desc";
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
                $inoDetalle = new InoDetalle();
                    //$inoDetalle->setCaIddeduccion( $params["iddeduccion"] );
                $inoDetalle->setCaIdcomprobante( $comprobante->getCaIdcomprobante() );
                $inoDetalle->setCaCr( $comision );
                $inoDetalle->setCaIdconcepto( 738 );
                $inoDetalle->setCaIdhouse( $house->getCaIdhouse() );
                $inoDetalle->setCaIdmaster( $house->getCaIdmaster() );
                $inoDetalle->setCaId( $comprobante->getCaId() );
                $inoDetalle->setCaObservaciones("Generado Automaticamente - ".date("Y-m-d"));
                $inoDetalle->save( $conn );
            }
            $comprobante->setCaValor( $totalComision );
            $comprobante->save($conn);

            $conn->commit();
            //$this->comprobante=$comprobante;
            $this->redirect( "inoReportes/verPdf?idcomprobante=".$comprobante->getCaIdcomprobante());
        }
        catch (Exception $e)
        {
            $conn->rollBack();
            echo $e->getMessage();
            exit;
        }
    }
    
    public function executeHtmlCOMISIONES(sfWebRequest $request) {    

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

        $pdf->Output('example.pdf', 'I');

       exit;
    }


}

<?php

/**
 * widgets actions.
 *
 * @package    colsys
 * @subpackage widgets
 * @author     Your name here
 * @executeDatosConceptosSiigoversion    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class widgets5Actions extends sfActions {

    public function executeDatosAplicacionJSON($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $transporte = $this->getRequestParameter("transporte");

        $this->data = array();

        $aplicaciones = ParametroTable::retrieveByCaso("CU064", null, $transporte);

        foreach ($aplicaciones as $aplicacion) {
            $this->data[] = array("aplicacion" => utf8_encode($aplicacion->getCaValor()));
        }

        $this->responseArray = array("root" => $this->data, "total" => count($this->data), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeListaBodegasJSON($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $criterio = strtoupper($this->getRequestParameter("query"));
        $idbodega = $this->getRequestParameter("idbodega");

        if ($this->modo == Constantes::TERRESTRE) {
            $modo = constantes::MARITIMO;
        } else {
            $modo = $this->modo;
        }

        $q = Doctrine::getTable("Bodega")
                ->createQuery("b")
                ->select("b.*")
                ->addOrderBy("b.ca_tipo ASC")
                ->addOrderBy("b.ca_nombre ASC")
                ->distinct()
                ->where("b.ca_transporte like ? and b.ca_nombre<>'-'", "%" . $modo . "%")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        if ($criterio != "") {
            $q->addWhere("UPPER(ca_nombre) like ?", "%$criterio%");
        }
        if($idbodega){
            $q->addWhere("ca_idbodega = ?", $idbodega);
        }
        $debug = $q->getSqlQuery();
        $this->data = $q->execute();

        $bodegas = array();
        foreach ($this->data as $key => $val) {
            $bodegas[] = array(
                "idbodega" => $val["b_ca_idbodega"],
                "tipo" => utf8_encode($val["b_ca_tipo"]),
                //"transporte" => $modo/* utf8_encode($val["b_ca_transporte"]) */,
                "nombre" => utf8_encode($val["b_ca_nombre"]),
                "identificacion" => utf8_encode($val["b_ca_identificacion"]),
                "direccion" => utf8_encode($val["b_ca_direccion"])
            );
            //$arrTransporte = explode("|", $this->data[$key]["b_ca_transporte"]);
            //$this->data[$key]["b_ca_nombre"] = utf8_encode($this->data[$key]["b_ca_nombre"]."-Nit:".$this->data[$key]["b_ca_identificacion"]." ".$this->data[$key]["b_ca_direccion"]) . "-" . $this->data[$key]["b_ca_tipo"];
            //$this->data[$key]["b_ca_transporte"] = $modo;
            //$this->data[$key]["b_ca_transporte"] = ($modo);
        }

        $this->responseArray = array("root" => $bodegas, "total" => count($bodegas), "success" => true, "debug"=>$debug);
        $this->setTemplate("responseTemplate");
    }

    /*
     * @param 
     * query     : dato ingresado para filtrar usuarios
     * @return: lista de Usuarios
     * @date:  2016-03-31
     */

    public function executeDatosComboUsuario() {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $criterio = $this->getRequestParameter("query");
        $ciudad = utf8_decode($this->getRequestParameter("ciudad"));
        $perfil = utf8_decode($this->getRequestParameter("perfil"));
        $idempresa = $this->getRequestParameter("idempresa");

        if ($criterio || $ciudad || $perfil || $idempresa) {

            $q = Doctrine::getTable("Usuario")
                    ->createQuery("u")
                    ->addWhere("u.ca_activo = true")
                    ->leftJoin("u.Sucursal s")
                    ->addOrderBy("u.ca_nombre");

            if ($criterio) {
                $q->addWhere('(LOWER(u.ca_login) LIKE ? OR LOWER(u.ca_nombre) LIKE ? 
                        OR LOWER(u.ca_nombre) LIKE ? OR LOWER(u.ca_nombres) LIKE ?
                        OR LOWER(u.ca_apellidos) LIKE ? OR LOWER(u.ca_email) LIKE ?
                        OR LOWER(u.ca_cargo) LIKE ? OR LOWER(u.ca_departamento) LIKE ?
                        OR LOWER(s.ca_nombre) LIKE ?)
                        
                     ', array("%" . strtolower($criterio) . "%", "%" . strtolower($criterio) . "%", "%" . strtolower($criterio) . "%", "%" . strtolower($criterio) . "%", "%" . strtolower($criterio) . "%",
                    "%" . strtolower($criterio) . "%", "%" . strtolower($criterio) . "%", "%" . strtolower($criterio) . "%", "%" . strtolower($criterio) . "%"));
            }

            if ($ciudad) {
                $q->addWhere("LOWER(s.ca_nombre) LIKE ?", "%" . strtolower($ciudad) . "%");
            }
            if ($perfil) {
                $q->innerJoin("u.UsuarioPerfil up")
                        ->addWhere("up.ca_perfil = ?", $perfil);
            }
            if ($idempresa) {
                $suc[2] = array(1, 2, 8, 11); // Grupo Coltrans, Colmas, Colotm y Coldepositos
                $q->andWhereIn("s.ca_idempresa", ($suc[$idempresa] ? $suc[$idempresa] : array($idempresa)));
            }
            $sql = $q->getSqlQuery();

            $usuarios = $q->execute();
            $data = array();
            foreach ($usuarios as $usuario) {
                $row = array();
                $row["login"] = utf8_encode($usuario->getCaLogin());
                $row["nombre"] = utf8_encode($usuario->getCaNombre());
                $row["cargo"] = utf8_encode($usuario->getCaCargo());
                $row["sucursal"] = utf8_encode($usuario->getSucursal()->getCaNombre());
                $row["email"] = utf8_encode($usuario->getCaEmail());
                $row["empresa"] = utf8_encode($usuario->getSucursal()->getEmpresa()->getCaNombre());
                $row["extension"] = utf8_encode($usuario->getCaExtension());
                $row["icon"] = $usuario->getImagenUrl("60x80");
                $data[] = $row;
            }
            $this->responseArray = array("total" => count($data), "root" => $data, "success" => true, "debug" => $sql);
        } else {
            $this->responseArray = array("total" => 0, "root" => array(), "success" => true, "debug" => $sql);
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor mauricio Quinche
     * @return un objeto JSON con la información de los house de la referencia
     *
     * @param sfRequest $request A request object
     * idmaster : id de la referencia         
     */
    public function executeDatosHouse($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $this->idmaster = $request->getParameter("idmaster");
        $this->idempresa = $request->getParameter("idempresa");

        $q = Doctrine::getTable("InoHouse")
                ->createQuery("h")
                ->select("h.ca_idhouse,h.ca_doctransporte,cl.ca_idcliente,cl.ca_compania,r.ca_mercancia_desc,m.ca_impoexpo,m.ca_transporte,
                        (SELECT COUNT(*) FROM inoComprobante c WHERE c.ca_idhouse=h.ca_idhouse) as ncomprobante,rvp.ca_orden_prov,r.ca_orden_clie")
                ->innerJoin("h.InoMaster m")
                ->innerJoin("h.Cliente cl")
                ->leftJoin("h.Reporte r")
                ->leftJoin("r.RepProveedores rvp") 
                ->where("h.ca_idmaster = ?", $this->idmaster)
//                ->andWhere("cl.ca_idcliente IN (SELECT ca_id FROM IdsEstadoSap e WHERE e.ca_id=cl.ca_idcliente AND e.ca_tipo='C' AND e.ca_activo=true AND ca_idempresa='{$this->idempresa}' ) ")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

        $sql = $q->getSqlQuery();
        $datos = $q->execute();
        $this->data = array();
        foreach ($datos as $d) {
            
            if ($d["m_ca_impoexpo"] == Constantes::IMPO && $d["m_ca_transporte"] == Constantes::AEREO)
                $mercancia_desc = utf8_encode($d["r_ca_mercancia_desc"]);
            else if ($d["m_ca_impoexpo"] == Constantes::IMPO && $d["m_ca_transporte"] == Constantes::MARITIMO)
                $mercancia_desc = utf8_encode($d["rvp_ca_orden_prov"]." ".$d["r_ca_orden_clie"]." ".$d["r_ca_mercancia_desc"]);
            else
                $mercancia_desc = "";
            
            $plazo="";
            if($this->idempresa!="")
            {
                $sucursal = Doctrine::getTable("IdsSucursal")
                    ->createQuery("s")
                    ->select("*")
                    ->where("ca_id =? AND ca_principal=true", array($d["cl_ca_idcliente"]))                    
                    ->andWhere("ca_id IN (SELECT ca_id FROM IdsEstadoSap e WHERE e.ca_id=s.ca_id AND e.ca_tipo='C' AND e.ca_activo=true AND ca_idempresa='{$this->idempresa}' ) ")
                    ->fetchOne();
                //print_r($d);
                $idsucursal="";
                if($sucursal)
                {
                    $idsucursal=$sucursal->getCaIdsucursal();
                    $ciudad=utf8_encode($sucursal->getCiudad()->getCaCiudad());
                }
                
                $credito = Doctrine_Query::create()
                    ->select("c.*")
                    ->from("IdsCredito c")                
                    ->where("ca_id = ? AND ca_idempresa=?", array($d["cl_ca_idcliente"],$this->idempresa) )
                    ->fetchOne();
                
                if($credito)                    
                    $plazo=$credito->getCaDias();
            }
            
            $this->data[] = array(
                "id" => $d["h_ca_idhouse"], "name" => utf8_encode($d["h_ca_doctransporte"] . "-" . utf8_encode($d["cl_ca_compania"])),
                "idcliente" => $d["cl_ca_idcliente"], "cliente" => utf8_encode($d["cl_ca_compania"]),
                "mercancia_desc" => utf8_encode(substr($mercancia_desc,0,65)),
                "ca_orden_prov"=>utf8_encode($d["r_ca_orden_prov"]),"ca_orden_clie"=>utf8_encode($d["r_ca_orden_prov"]),
                "idsucursal"=>$idsucursal,"ciudad"=>utf8_encode($ciudad),
                "txttrm"=>utf8_encode("Para embarques marítimos, la factura debe ser liquidada y pagada tomando la tasa de cambio más alta entre la tasa de cambio del día de pago más $30 pesos "
                        . "y la tasa de cambio mencionada en la factura; en caso de pagar la factura con la menor de las tasas, se generará una factura adicional por diferencia en "
                        . "tipo de cambio.  Para conocer la TRM del día de pago puede comunicarse con nuestro PBX seleccionando la opción 1"),
                "plazo"=>$plazo,
                "class" => ($d["r_"] > 0 ? "" : "row_pink")
            );
        }        
        //echo "<pre>";print_r($this->data);echo "</pre>";
        //exit;
        $this->responseArray = array("root" => $this->data, "total" => count($this->data), "success" => true, "debug" => $sql);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosAnticipo($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $this->idmaster = $request->getParameter("idmaster");
        $this->idcomprobante = $request->getParameter("idcomprobante");
        $this->idcliente = $request->getParameter("idcliente");

        /*$q = Doctrine::getTable("InoComprobante")
                ->createQuery("comp")
                ->select("*,
                        (SELECT COUNT(*) FROM inoComprobante c WHERE c.ca_datos->>'idanticipo'=comp.ca_idcomprobante) as ncomprobante")                
                ->innerJoin("comp.InoTipoComprobante tc WITH tc.ca_tipo='A' and tc.ca_aplicacion=1")                                
                ->where("comp.ca_idmaster = ?", $this->idmaster)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

        $sql = $q->getSqlQuery();
        $datos = $q->execute();
         * 
         */
        $sql="SELECT comp.ca_idcomprobante,comp.ca_consecutivo FROM ino.tb_comprobantes comp WHERE comp.ca_idmaster = ". $this->idmaster
                ." AND comp.ca_idcomprobante NOT IN 
                 (SELECT (c.ca_datos->>'idanticipo')::integer FROM ino.tb_comprobantes c
                 inner join ino.tb_house h ON h.ca_idhouse=c.ca_idhouse
			WHERE h.ca_idmaster = comp.ca_idmaster AND (c.ca_datos->>'idanticipo')::integer>0)";
        $sql="SELECT comp.ca_idcomprobante,comp.ca_consecutivo,comp.ca_valor,ca_tcambio FROM ino.tb_comprobantes comp WHERE comp.ca_idmaster = ". $this->idmaster."  
                 AND comp.ca_fchanulado IS null AND comp.ca_id='".$this->idcliente."' AND comp.ca_idcomprobante::text NOT IN 
                 (SELECT jsonb_array_elements_text(c.ca_datos->'idanticipo') FROM ino.tb_comprobantes c
                 inner join ino.tb_house h ON h.ca_idhouse=c.ca_idhouse
			WHERE h.ca_idmaster = comp.ca_idmaster AND c.ca_idcomprobante != ".$this->idcomprobante." )";
        
            $conn = Doctrine_Manager::getInstance()->getConnection('master');
            $st = $conn->execute($sql);
            $datos = $st->fetchAll();
        
        
        $this->data = array();
        foreach ($datos as $d) {            
            $this->data[] = array(
                "id" => $d["ca_idcomprobante"], "name" => $d["ca_consecutivo"]." (".$d["ca_valor"]." Trm:".$d["ca_tcambio"].")"
            );
        }
        //$txt="Anticipo ".$anticipo->getInoTipoComprobante()->getCaPrefijoSap()."-".$anticipo->getInoTipoComprobante()->getCaComprobante()." ". $anticipo->getCaConsecutivo()." :: ".number_format($anticipo->getCaValor(), 2, ",", ".")." (TRM : ".$anticipo->getCaTcambio().")";

        $this->responseArray = array("root" => $this->data, "total" => count($this->data), "success" => true, "debug" => $sql);
        $this->setTemplate("responseTemplate");
    }


    public function executeDatosTipoComprobante($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $user = $this->getUser();
        $this->tipoComprobante = $request->getParameter("tipo") ? explode(",", $request->getParameter("tipo")) : null;
        $aplicacion = $request->getParameter("app");
        $idmaster = $request->getParameter("idmaster");        
        $puerto = $request->getParameter("puerto");
        $origen = $request->getParameter("origen");

        if (count($this->tipoComprobante) < 1) {
            $this->tipoComprobante = array('F', 'C');
        }
        $impoexpo="";
        if($idmaster>0)
        {
            $master = Doctrine::getTable("InoMaster")->find($idmaster);
            $datos = json_decode($master->getCaDatos());
            $idempresa=$datos->idempresa;
            $transporte=$master->getCaTransporte();
        }
        if($idempresa=="" && $origen!="consulta")
            $idempresa = ($request->getParameter("idempresa") != "") ? $request->getParameter("idempresa") : $user->getIdempresa();

        $q = Doctrine::getTable("InoTipoComprobante")
                ->createQuery("t")
                ->select("t.ca_idtipo, t.ca_tipo, t.ca_comprobante, t.ca_titulo, t.ca_idempresa,t.ca_idsucursal,s.ca_direccion,s.ca_telefono,s.ca_datos")
                //->innerJoin("t.Sucursal s")
                //->innerJoin("s.Ids i")
                //->innerJoin("s.Empresa e")                
                ->whereIn("t.ca_tipo", $this->tipoComprobante)
                ->addwhere("ca_idempresa=? and t.ca_activo=?", array($idempresa, true))
                ->addOrderBy("t.ca_tipo, t.ca_comprobante");

        if ($aplicacion) {
            $q->addWhere("t.ca_aplicacion = ?", $aplicacion);
        }

        $tipos = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->execute();
        
        $this->data = array();
        //echo $impoexpo;
        if($transporte==Constantes::MARITIMO)
        {
            $sql="SELECT  * FROM control.tb_sucursales s
                 
		WHERE s.ca_idempresa = ".$idempresa." and s.ca_datos->>'idciudad' ='{$puerto}' ";
        
            $conn = Doctrine_Manager::getInstance()->getConnection('master');
            $st = $conn->execute($sql);
            $datosSucursal = $st->fetchAll();
            if(count($datosSucursal)>0)
            {
                $datos=json_decode($datosSucursal[0]["ca_datos"]);
                $detalle=$datos->contacto." ".utf8_encode($datosSucursal[0]["ca_direccion"])." ".utf8_encode($datosSucursal[0]["ca_telefono"]);
            }
            else
            {
                $detalle="";
            }
            
            /*$datos=json_decode($tipo["s_ca_datos"]);
            ,"contacto"=>$contacto,"direccion"=> utf8_encode($tipo["s_ca_direccion"]),
                "telefono"=>utf8_encode($tipo["s_ca_telefono"])
             * 
             */
            //echo "<pre>";print_r($datosSucursal);echo "</pre>";
            
        }
        
        foreach ($tipos as $tipo) {            
            $contacto=$datos->contacto;
            $tipoStr = "";
            $tipoStr .= $tipo["t_ca_tipo"] . "-" . str_pad($tipo["t_ca_comprobante"], 2, "0", STR_PAD_LEFT) . " " . $tipo["t_ca_titulo"];
            $this->data[] = array(
                "id" => $tipo["t_ca_idtipo"], "name" => utf8_encode($tipoStr),"tipo" => $tipo["t_ca_tipo"], "idempresa" => $tipo["t_ca_idempresa"],  
                "idsucursal" => $tipo["t_ca_idsucursal"],"detalle"=>$detalle
                );
        }
        $this->responseArray = array("root" => $this->data, "total" => count($this->data), "success" => true, "debug" => $q->getSqlQuery());
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor JFNARIÑO
     * @return un objeto JSON con las ciudades de cada país registrados en el sistema
     * @param sfRequest $request A request 
     *        query : texto digitado para filtrar ciudades
     *              
     * @date:  2016-03-28
     */
    public function executeDatosCiudades(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $data = array();
        $query = $request->getParameter("query");

        $q = Doctrine::getTable('Ciudad')->createQuery('c')
                ->innerJoin('c.Trafico t')
                ->addOrderBy('c.ca_ciudad ASC')
                ->addOrderBy('t.ca_nombre ASC')
                ->addWhere("UPPER(c.ca_ciudad) like ?  or  UPPER(t.ca_nombre) like ? ", array("%" . strtoupper($query) . "%", "%" . strtoupper($query) . "%"));
        $ciudades = $q->execute();

        $con = 0;
        $name = "";
        foreach ($ciudades as $ciudad) {

            if (trim(utf8_encode($ciudad->getCaCiudad())) == trim($name))
                $con++;
            else
                $con = 0;
            $name = trim(utf8_encode($ciudad->getCaCiudad()));
            $data[] = array("idciudad" => $ciudad->getCaIdciudad(),
                "ciudad" => utf8_encode($ciudad->getCaCiudad()) . (($con) ? "(" . ($con + 1) . ")" : ""),
                "idtrafico" => $ciudad->getCaIdtrafico(),
                "trafico" => utf8_encode($ciudad->getTrafico()->getCaNombre()),
                "ciudad_trafico" => utf8_encode($ciudad->getTrafico()->getCaNombre() . " " . $ciudad->getCaCiudad())
            );
        }


        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor JFNARIÑO
     * @return un objeto JSON con los datos de lineas filtradas por transporte, tipo y texto digitado
     * @param sfRequest $request A request 
     *               transporte : tipo de transporte (areo. maritimo, terrestre)
     *         impoexpo : tipo impoexpo (importación, exportación, entre otros)
     *              query : texto digitado para filtrar lineas
     *              tipo: tipo de proveedor (Ej. ADU para aduanas)
     * 
     *              
     * @date:  2016-03-28
     */
    public function executeDatosLineas($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $transporte = utf8_decode($request->getParameter("transporte"));
        $query = utf8_decode($request->getParameter("query"));
        $tipo = utf8_decode($request->getParameter("tipo"));


        if ($transporte == Constantes::OTMDTA) { //FIX-ME [Actualizar los registros de la tabla para que coincidan y arreglar las cotizaciones]
            $transporte = Constantes::TERRESTRE;
            $modalidad = Constantes::OTMDTA;
        }


        $q = Doctrine_Query::create()
                ->select("p.ca_idproveedor, p.ca_sigla, id.ca_nombre, p.ca_transporte ")
                ->from("IdsProveedor p")
                ->innerJoin("p.Ids id")
                ->addOrderBy("id.ca_nombre");
        if ($tipo) {
            $q->addWhere(" p.ca_tipo = ?", $tipo);
        } else {
            $q->addWhere("p.ca_tipo = ? OR p.ca_tipo = ? OR p.ca_tipo = ?", array("TRI", "TRN", "OPE"));
        }
        if ($transporte && !$tipo) {
            $q->addWhere("p.ca_transporte = ?", $transporte);
        }

        if ($query) {
            $q->addWhere("id.ca_nombre like ?", $query . "%");
        }   

        if ($request->getParameter("noaprob") != "true") {
            
        }


        $q->fetchArray();

        $lineas = $q->execute();

        $this->lineas = array();
        foreach ($lineas as $linea) {
            $this->lineas[] = array("idlinea" => $linea['ca_idproveedor'],
                "linea" => utf8_encode(($linea['ca_sigla'] ? $linea['ca_sigla'] . " - " : "") . $linea['Ids']['ca_nombre']),
                "transporte" => utf8_encode($linea['ca_transporte']),
                "activo_impo" => $linea['ca_activo_impo'],
                "activo_expo" => $linea['ca_activo_expo']
            );
        }

        $this->responseArray = array("root" => $this->lineas, "total" => count($this->lineas), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor JFNARIÑO
     * @return un objeto JSON con los agentes filtrados dependiendo el impoexpo,
     * filtra por origen o destino
     * @param sfRequest $request A request 
     *        origen : lugar de origen
     *        destino: lugar de destino
     *       listartodos: boolean para evitar los filtros y retornar todos los agentes
     *       impoexpo: tipo impoexpo (importación, exportación, entre otros)
     * @date:  2016-03-28
     */
    public function executeDatosAgentes(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $origen = $request->getParameter("origen");
        $destino = $request->getParameter("destino");
        $impoexpo = utf8_decode($request->getParameter("impoExpo"));
        $listarTodos = $request->getParameter("listarTodos");

        $q = Doctrine_Query::create()
                ->select("a.*, i.ca_nombre, t.ca_idtrafico, t.ca_nombre,c.ca_ciudad,s.ca_direccion")
                ->from("IdsAgente a")
                ->innerJoin("a.Ids i")
                ->innerJoin("i.IdsSucursal s")
                ->innerJoin("s.Ciudad c")
                ->innerJoin("c.Trafico t")
                ->where("s.ca_principal = ?", true)
                ->addWhere("a.ca_activo = ?", true);
        if ($listarTodos != "true") {
            if ($impoexpo == "Exportación") {
                $ciudadDestino = Doctrine::getTable('Ciudad')->createQuery('c')
                        ->addWhere("c.ca_idciudad = ?", $destino)
                        ->fetchOne();
                if ($ciudadDestino) {
                    $q = $q->addWhere("t.ca_idtrafico = ?", $ciudadDestino->getCaIdtrafico());
                }
            } else {
                $ciudadOrigen = Doctrine::getTable('Ciudad')->createQuery('c')
                        ->addWhere("c.ca_idciudad = ?", $origen)
                        ->fetchOne();
                if ($ciudadOrigen) {
                    $q = $q->addWhere("t.ca_idtrafico = ?", $ciudadOrigen->getCaIdtrafico());
                }
            }
        }

        $q = $q->addOrderBy("i.ca_nombre")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

        $agentes = $q->execute();
        $data = array();
        foreach ($agentes as $agente) {
            $data[] = array("idagente" => $agente["a_ca_idagente"],
                "nombre" => utf8_encode($agente["i_ca_nombre"]),
                "pais" => utf8_encode($agente["t_ca_nombre"]),
                "idtrafico" => $agente["t_ca_idtrafico"],
                "ciudad" => utf8_encode($agente["c_ca_ciudad"]),
                "direccion" => utf8_encode($agente["s_ca_direccion"]),
                "tipo" => utf8_encode($agente["a_ca_tipo"]),
                "tplogistics" => utf8_encode($agente["a_ca_tplogistics"])
            );
        }
        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor JFNARIÑO
     * @return un objeto JSON con los parametros de un caso de uso específico

     * @param sfRequest $request A request 
     *        caso_uso: identificador de caso de uso.
     *       
     * @date:  2016-03-28
     */
    public function executeDatosParametros(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $data = array();

        $casos = explode(",", $request->getParameter("caso_uso"));

        foreach ($casos as $caso) {
            $datos = ParametroTable::retrieveByCaso($caso);
            foreach ($datos as $dato) {
                $data[] = array("id" => utf8_encode($dato->getCaIdentificacion()), "name" => utf8_encode($dato->getCaValor()), "caso_uso" => $dato->getCaCasouso(), "valor2" => utf8_encode($dato->getCaValor2()));
            }
        }
        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor JFNARIÑO
     * @return un objeto JSON con los datos de Incoterms  (correspondientes al caso de uso 062)    
     * @date:  2016-03-28
     */
    public function executeDatosIncoterms(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $incoterms = ParametroTable::retrieveByCaso("CU062");

        $data = array();
        foreach ($incoterms as $incoterm) {
            $data[] = array("valor" => utf8_encode($incoterm->getCaValor()));
        }
        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor Mauricio Quinche
     * @return un objeto JSON con la información de las sucursales de los clientes
     *
     * @param sfRequest $request A request object
     * idempresa : id de la empresa tb_empresas
     *  * query : Nombre de la empresa
     */
    public function executeDatosClienteSucursal($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $query = $request->getParameter("query");
        $idempresa = $request->getParameter("idempresa");


        $q = Doctrine_Query::create()
                ->select("c.ca_ciudad,s.ca_direccion,s.ca_idsucursal,s.ca_id,ids.ca_nombre")
                ->from("IdsSucursal s")
                ->innerJoin("s.Ciudad c")
                ->innerJoin("s.Ids ids")
                ->innerJoin("ids.IdsCliente cl")
                //->innerJoin("cl.IdsEstadoSap e ON e.ca_tipo=? AND e.ca_activo=?",array('C',true))
                ->where("UPPER(ids.ca_nombre) like ? and s.ca_usueliminado is null", "%" . strtoupper($query) . "%")
                ->andWhere("ids.ca_id IN (SELECT ca_id FROM IdsEstadoSap e WHERE e.ca_id=ids.ca_id AND e.ca_tipo='C' AND e.ca_activo=true AND ca_idempresa='{$idempresa}' ) ")
                ->addOrderBy("c.ca_ciudad")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $sql = $q->getSqlQuery();

        $sucursales = $q->execute();
        $sucursal = array();
        //print_r($sucursales);        
        foreach ($sucursales as $suc) {

            $idempresa = ($idempresa == "") ? $suc["tcomp_ca_idempresa"] : $idempresa;
            
            
            $credito = Doctrine_Query::create()
                ->select("c.*")
                ->from("IdsCredito c")                
                ->where("ca_id = ? AND ca_idempresa=?", array($suc["s_ca_id"],$idempresa) )
                ->fetchOne();
            $plazo="";
            if($credito)                    
                $plazo=$credito->getCaDias();
            
            
                        
            $sucursal[] = array(
                "idsucursal" => $suc["s_ca_idsucursal"],
                "ciudad" => utf8_encode($suc["c_ca_ciudad"]),
                "direccion" => utf8_encode($suc["s_ca_direccion"]),
                "idcliente" => $suc["s_ca_id"],
                "compania" => utf8_encode($suc["ids_ca_nombre"] . "-" . $suc["c_ca_ciudad"]),
                "plazo"=>$plazo
            );
        }
        $this->responseArray = array("root" => $sucursal, "total" => count($sucursal), "success" => true, "debug"=>$sql);
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor Mauricio Quinche
     * @return un objeto JSON con la información de las sucursales de los clientes
     *
     * @param sfRequest $request A request object

     */
    public function executeDatosMonedas($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');

        $this->data = array();

        $monedas = Doctrine::getTable("Moneda")
                ->createQuery("m")
                ->addOrderBy("m.ca_sugerido desc")
                ->addOrderBy("m.ca_idmoneda")
                ->execute();

        foreach ($monedas as $moneda) {
            $data[] = array("id" => $moneda->getCaIdmoneda(), "name" => utf8_encode($moneda->getCaNombre()), "sugerido" => $moneda->getCaSugerido());
        }
        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor Mauricio Quinche
     * @return un objeto JSON con los conceptos que aplican para el tipo de comprobante
     *
     * @param sfRequest $request A request object

     */
    public function executeDatosConceptosSiigo(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');

        $idconcepto = $request->getParameter("idconcepto");
        $idccosto = $request->getParameter("idccosto");
        $idsucursal = $request->getParameter("idsucursal");
        $idcc = $request->getParameter("idcc");

        if ($idcc == "") {
            if ($idsucursal == "") {

                if ($request->getParameter("transporte") != "" && $request->getParameter("impoexpo") != "") {
                    $transporte = utf8_decode($request->getParameter("transporte"));
                    $impoexpo = utf8_decode($request->getParameter("impoexpo"));
                } else {
                    $modo = Doctrine::getTable("Modo")->find($request->getParameter("modo"));
                    $transporte = $modo->getCaTransporte();
                    $impoexpo = $modo->getCaImpoexpo();
                }


                $query = $request->getParameter("query");

                $idcomprobante = $request->getParameter("idcomprobante");
                $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
                if ($comprobante) {
                    $idsucursal = $comprobante->getInoTipoComprobante()->getCaIdsucursal();
                    $transporte = $comprobante->getInoHouse()->getInoMaster()->getCaTransporte();
                    $impoexpo = $comprobante->getInoHouse()->getInoMaster()->getCaImpoexpo();
                } else {
                    $idsucursal = ""; //$this->getUser()->getSucursal()
                }
            }
        }
//        $idempresa = $request->getParameter("idempresa");
        //$ccosto = Doctrine::getTable("InoCentroCosto")->find($idccosto);

        $q = Doctrine::getTable("InoCentroCosto")
                ->createQuery("c");
        //->where("c.ca_idsucursal = ?", $idsucursal);

        if ($idcc != "")
            $q->addWhere("c.ca_idccosto = ?", $idcc);

        if ($idsucursal != "")
            $q->addWhere("c.ca_idsucursal = ?", $idsucursal);

        if ($impoexpo != "")
            $q->addWhere("c.ca_impoexpo = ?", $impoexpo);
        if ($impoexpo != "")
            $q->addWhere("c.ca_transporte = ?", $transporte);
        $ccosto = $q->fetchOne();


        //echo $q->getSqlQuery();
        //echo $idcomprobante;exit;
        if ($ccosto) {
            $q = Doctrine::getTable("InoConSiigo")
                    ->createQuery("s")
                    ->select("*")
                    ->where("SUBSTR(ca_cod::TEXT,1,2)=? and ca_idempresa=?  ", array($ccosto->getCaCentro() . $ccosto->getCaSubcentro(), $ccosto->getCaIdempresa()))
                    ->addOrderBy("s.ca_idconceptosiigo");
            if ($query != "") {
                $q->addWhere("UPPER(ca_descripcion) like ? or SUBSTR(ca_cod::TEXT,1) like ? ", array('%' . strtoupper($query) . '%', '%' . strtoupper($query) . '%'));
            }
            $debug = $q->getSqlQuery();
            $conceptosSiigo = $q->execute();
        }
//        echo $debug;
        //echo $ccosto->getCaCentro() ."::". $ccosto->getCaSubcentro() ."::". $ccosto->getCaIdempresa();
//        exit;

        $data = $seleccionados = array();
        foreach ($conceptosSiigo as $s) {
            $data[] = array("id" => $s->getCaCod(), "name" => $s->getCaCod() . "-" . utf8_encode($s->getCaDescripcion()));
        }


        if ($idconcepto != "") {
            $conceptosHomo = Doctrine::getTable("InoConHomologacion")
                    ->createQuery("ch")
                    ->select("ca_idconceptosiigo")
                    ->where("ca_idconcepto = ?  and ca_idccosto = ? ", array($idconcepto, $idccosto))
                    ->execute();
//        print_r($conceptosHomo);
            foreach ($conceptosHomo as $s) {
                $seleccionados[] = $s->getCaIdconceptosiigo();
            }
        }
        //print_r($seleccionados);
        //exit;

        $this->responseArray = array("root" => $data, "seleccionados" => $seleccionados, "success" => true, "debug" => $debug);
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor Mauricio Quinche
     * @return un objeto JSON con los transportes que maneja colsys    
     * @param sfRequest $request A request object
     * @date:  2016-03-22

     */
    public function executeDatosTransporte(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $data = array();
        $data[] = array("valor" => utf8_encode(Constantes::AEREO));
        $data[] = array("valor" => utf8_encode(Constantes::MARITIMO));
        $data[] = array("valor" => utf8_encode(Constantes::TERRESTRE));
        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor JFNARIÑO
     * @return un objeto JSON con los datos del reporte correspondiente al id  
     * @param sfRequest $request A request 
     *               idreporte : entero con el id del reporte
     *              
     * @date:  2016-03-28
     */
    public function executeDatosReporteCarga(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');

        $data = array();
        $reporte = Doctrine::getTable("Reporte")->find($request->getParameter("idreporte"));

        $prov = $reporte->getProveedores();
        if (count($prov) > 0) {
            $data["idproveedor"] = $prov[0]->getCaIdtercero();
            $data["proveedor"] = utf8_encode($prov[0]->getCaNombre());
        }

        $data["origen"] = $reporte->getDocTransporte();

        $data["impoexpo"] = utf8_encode($reporte->getCaImpoexpo());
        $data["transporte"] = utf8_encode($reporte->getCaTransporte());
        $data["modalidad"] = utf8_encode($reporte->getCaModalidad());
        $data["origen"] = $reporte->getCaOrigen();
        $data["destino"] = $reporte->getCaDestino();
        $data["idlinea"] = $reporte->getCaIdlinea();
        $data["linea"] = utf8_encode($reporte->getIdsProveedor()->getIds()->getCaNombre());

        $data["idagente"] = $reporte->getCaIdagente();
        $data["ca_fchsalida"] = $reporte->getEts();
        $data["ca_fchllegada"] = $reporte->getEta();
        $data["ca_master"] = utf8_encode($reporte->getCaDocmaster());

        

        if($reporte->getCaImpoexpo()==Constantes::EXPO)
        {
            $repExpo= $reporte->getRepExpo();
            
            $peso = explode("|", $repExpo->getCaPeso());
            $data["ca_peso"] = $peso[0];
            
            $piezas = explode("|", $repExpo->getCaPiezas());
            $data["ca_piezas"] = $piezas[0];
            
            $volumen = explode("|", $repExpo->getCaVolumen());
            $data["ca_volumen"] = $volumen[0];
            
            $caso = "CU011";
            $datomod = ParametroTable::retrieveByCaso($caso, null, null, $repExpo->getCaTipoexpo());

            $data["id_modalidad"] = $repExpo->getCaTipoexpo();
            if ($repExpo->getCaTipoexpo()) {
                $data["ca_modalidad"] = utf8_encode($datomod[0]->getCaValor());
            }
            $data["ca_descripcion"] = utf8_encode($reporte->getCaMercanciaDesc());
            /*$data["ca_idlinea"]=$repExpo->getCaIdsia();
            $proveedor = Doctrine::getTable("IdsProveedor")->find(utf8_encode($repExpo->getCaIdsia()));
            $data["ca_linea"]=utf8_encode($proveedor->getIds()->getCaNombre());*/
        }
        else 
        {
            $repstatus = $reporte->getUltimoStatus();
            if ($repstatus) {
                if ($repstatus->getCaPeso()) {
                    $peso = explode("|", $repstatus->getCaPeso());
                    $data["ca_peso"] = $peso[0];
                }
                if ($repstatus->getCaPiezas()) {
                    $piezas = explode("|", $repstatus->getCaPiezas());
                    $data["ca_piezas"] = $piezas[0];
                }
                if ($repstatus->getCaVolumen()) {
                    $volumen = explode("|", $repstatus->getCaVolumen());
                    $data["ca_volumen"] = $volumen[0];
                }
                $data["ca_docmaster"] = utf8_encode($repstatus->getCaDocmaster());
            }
        }
        //echo "<pre>";print_r($data);echo "</pre>";

        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosImpoexpo(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $data = array();
        $data[] = array("valor" => utf8_encode(Constantes::IMPO));
        $data[] = array("valor" => utf8_encode(Constantes::TRIANGULACION));
        $data[] = array("valor" => utf8_encode(Constantes::EXPO));
        $data[] = array("valor" => utf8_encode(Constantes::OTMDTA));
        $data[] = array("valor" => utf8_encode(Constantes::INTERNO));
        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosConceptos(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');


        $impoexpo = utf8_decode($request->getParameter("impoexpo"));
        $transporte = utf8_decode($request->getParameter("transporte"));
        $idreporte = utf8_decode($request->getParameter("idreporte"));
        
        if($idreporte>0)
        {
            $rep = Doctrine::getTable("Reporte")->find($idreporte);
            $impoexpo = $rep->getCaImpoexpo();
            $transporte = $rep->getCaTransporte();
            
        }
        
        
        $costo = $request->getParameter("costo");

        $queryCosto = Doctrine::getTable("InoConcepto")
                ->createQuery("c")
                ->innerJoin("c.InoConceptoModalidad cm")
                ->innerJoin("cm.Modalidad m")
                ->addWhere("c.ca_costo = ? ", ($costo == "true"))
                ->addWhere("m.ca_impoexpo = ? ", $impoexpo)
                ->addWhere("m.ca_transporte = ? ", $transporte)
                ->addWhere("c.ca_fcheliminado is  null and m.ca_fcheliminado is  null ")
                ->addOrderBy("c.ca_concepto")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);


        /* if( $this->referencia ){
          if($this->referencia->getCaModalidad()=="DIRECTO" && $this->referencia->getCaTransporte()==Constantes::TERRESTRE)
          {
          $queryCosto->addWhere("m.ca_modalidad = ? ", "FCL");
          }
          else
          $queryCosto->addWhere("m.ca_modalidad = ? ", $this->referencia->getCaModalidad());
          } */
        //echo $impoexpo."-".$transporte."-".($costo=="true");
        //echo $queryCosto->getSqlQuery();
        $dataConcepto = $queryCosto->execute();
        //echo "<pre>";print_r($dataConcepto);echo "</pre>";
        //exit;

        foreach ($dataConcepto as $d) {
            $data[] = array("id" => $d["c_ca_idconcepto"], "name" => utf8_encode($d["c_ca_concepto"])); //$data->getCaIdconcepto()."-".$data->getCaConcepto();
        }

        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /*
     * Datos de las modalidades según sea el medio de transporte
     */

    /**
     * @autor JFNARIÑO
     * @return un objeto JSON con los datos de modalidades filtradas por impoexpo y/o transporte
     * @param sfRequest $request A request 
     *               transporte : tipo de transporte (areo. maritimo, terrestre)
     *         impoexpo : tipo impoexpo (importación, exportación, entre otros)
     *              
     * @date:  2016-03-28
     */
    public function executeDatosModalidades() {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $transport_parameter = utf8_decode($this->getRequestParameter("transporte"));
        $impoexpo_parameter = utf8_decode($this->getRequestParameter("impoexpo"));

        $q = Doctrine::getTable("Modalidad")
                ->createQuery("m");

        if ($impoexpo_parameter) {
            $q->where(" m.ca_impoexpo = ? ", $impoexpo_parameter);
        }

        if ($transport_parameter) {
            $q->addWhere("m.ca_transporte = ? ", $transport_parameter);
        }

        $q->addOrderBy("m.ca_impoexpo ASC");
        $q->addOrderBy("m.ca_transporte ASC");
        $q->addOrderBy("m.ca_modalidad ASC");

        $transportes = $q->execute();

        $modalidades = array();

        foreach ($transportes as $transporte) {
            $row = array("idmodalidad" => utf8_encode($transporte->getCaIdmodalidad()),
                "impoexpo" => utf8_encode($transporte->getCaImpoexpo()),
                "transporte" => utf8_encode($transporte->getCaTransporte()),
                "modalidad" => utf8_encode($transporte->getCaModalidad()));
            $modalidades[] = $row;
        }


        $this->responseArray = array("root" => $modalidades, "total" => count($modalidades), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor ?
     * @return un objeto JSON con información de clientes filtrados por digitación y tipo opcional
     * @param sfRequest $request A request 
     *        query : texto digitado para filtrar ciudades
     *       tipo : tipo de cliente
     *     
     *              
     * @date:  2016-03-28
     */
    public function executeListaClientesJSON() {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $criterio = utf8_decode($this->getRequestParameter("query"));
        $tipo = $this->getRequestParameter("tipo");
        if ($criterio) {
            $q = Doctrine_Query::create()
                    ->select(" cl.ca_idcliente, cl.ca_compania,cl.ca_tipo,
                                      cl.ca_preferencias, cl.ca_confirmar, cl.ca_vendedor, cl.ca_coordinador,
                                      v.ca_nombre, cl.ca_listaclinton, cl.ca_fchcircular
                                      ,cl.ca_status, cl.ca_vendedor, lc.ca_cupo, lc.ca_diascredito
                                     ")
                    ->from("Cliente cl")
                    ->leftJoin("cl.LibCliente lc")
                    ->leftJoin("cl.Usuario v")
                    ->where("UPPER(cl.ca_compania) like ?", "%" . strtoupper($criterio) . "%")
                    ->addOrderBy("cl.ca_compania ASC")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->limit(40);
            if ($tipo != "")
                $q->addWhere("cl.ca_tipo like ?", "%" . $tipo . "%");
            $rows = $q->execute();



            $clientes = array();

            foreach ($rows as $row) {
                $result = array();
                $result["ca_idcliente"] = utf8_encode($row["cl_ca_idcliente"]);
                $result["ca_compania"] = utf8_encode($row["cl_ca_compania"]);
                $result["ca_preferencias"] = utf8_encode($row["cl_ca_preferencias"]);
                $result["ca_nombre"] = utf8_encode($row["v_ca_nombre"]);
                $result["ca_listaclinton"] = utf8_encode($row["cl_ca_listaclinton"]);
                $result["ca_fchcircular"] = strtotime($row["cl_ca_fchcircular"]);
                $result["ca_confirmar"] = $row["cl_ca_confirmar"];
                $result["ca_status"] = $row["cl_ca_status"];
                $result["ca_vendedor"] = $row["cl_ca_vendedor"];
                $result["ca_coordinador"] = $row["cl_ca_coordinador"];
                $result["ca_diascredito"] = $row["lc_ca_diascredito"];
                $result["ca_cupo"] = $row["lc_ca_cupo"];
                $clientes[] = $result;
            }
            $this->responseArray = array("totalCount" => count($clientes), "clientes" => $clientes);
        } else {
            $this->responseArray = array("totalCount" => 0, "clientes" => array());
        }
        $this->setTemplate("responseTemplate");
    }

    /*
     * @autor : Nataly
     * @return: arreglo de Empresas activas
     * @date:  2016-03-31
     */

    public function executeDatosEmpresas($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $q = Doctrine::getTable("Empresa")
                ->createQuery("e")
                ->select("*")
                ->orderBy("ca_idempresa ASC")
                ->where("ca_activo=TRUE and ca_idsap IS NOT NULL");
        
        
        if($request->getParameter("idempresa"))
            $q->addWhere ($request->getParameter("idempresa"));
        
        $debug = $q->getSqlQuery();
        
        $datos = $q->execute();
        $a = array();
        foreach ($datos as $k => $d) {
            $a[] = array(
                "id" => $d["ca_idempresa"],
                "name" => utf8_encode($d["ca_nombre"])
            );
        }
        $this->responseArray = array("root" => $a, "total" => count($datos), "debug" => $debug, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor JFNARIÑO
     * @return un objeto JSON con las ciudades de cada documento registrados en el sistema
     * @param sfRequest $request A request 
     *        idsserie : codigo de la sserie
     *        idimpoexpo: (Importacion - Exportacion)
     *        idtransporte: Transporte de la carga     
     * @date:  2016-03-28
     */
    public function executeDatosDocumentos($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');

        $this->idsserie = $request->getParameter("idsserie");
        $idimpoexpo = utf8_decode($request->getParameter("idimpoexpo"));
        $idtransporte = utf8_decode($request->getParameter("idtransporte"));

        if (!$this->idsserie && $idimpoexpo && $idtransporte) {
            /*Cuando es exportación aéreo no tiene una serie asociada y no trae los tipos documentales en el INO ALR Jul/02/2019*/
            $idtransporte = $idimpoexpo==Constantes::EXPO?constantes::MARITIMO: $idtransporte;
            $idimpoexpo = $idimpoexpo==Constantes::TRIANGULACION?constantes::IMPO: $idimpoexpo;
            $modo = Doctrine::getTable("Modo")
                    ->createQuery("d")
                    ->where("d.ca_impoexpo = ? and d.ca_transporte = ?", array($idimpoexpo, $idtransporte))
                    ->fetchOne();
            if ($modo) {
                $serie = Doctrine::getTable("Series")
                        ->createQuery("d")
                        ->where("d.ca_idmodo = ? ", $modo->getCaIdmodo())
                        ->fetchOne();
                if ($serie) {
                    $this->idsserie = $serie->getCaIdsserie();
                }
            }
        }


        if ($this->idsserie) {
            $q = Doctrine::getTable("TipoDocumental")
                    ->createQuery("t")
                    ->select("*")
                    ->where("ca_idsserie = ? AND ca_fcheliminado is null ", $this->idsserie)
                    ->setHydrationMode(Doctrine::HYDRATE_ARRAY);

            $tipoDocs = $q->execute();
            $this->tipoDocs = array();
            foreach ($tipoDocs as $t) {
                $this->tipoDocs[] = array("id" => $t["ca_iddocumental"], "name" => utf8_encode($t["ca_documento"]));
            }
        }

        $this->responseArray = array("root" => $this->tipoDocs, "total" => count($this->tipoDocs), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    
    public function executeDatosTiposDoc(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $tipos_docs_rs = Doctrine::getTable("IdsTipoDocumento")
                ->createQuery("t")
                ->select("*")
                ->orderBy("ca_tipo ASC")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
        
        $tipos_docs = array();
        foreach ($tipos_docs_rs as $tipo_doc) {
            $row = array('idtipo' => $tipo_doc["t_ca_idtipo"], "tipo" => utf8_encode($tipo_doc["t_ca_tipo"]));
            $tipos_docs[] = $row;
        }

        $this->responseArray = array("root" => $tipos_docs, "total" => count($tipos_docs), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    
    
    public function executeListaReportesJSON() {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $criterio = $this->getRequestParameter("query");
 
        if ($criterio) {

            $transporte = utf8_decode($this->getRequestParameter("transporte"));
            $impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
            $openedOnly = $this->getRequestParameter("openedOnly");
            $origen = utf8_decode($this->getRequestParameter("origen"));
            $traorigen = Doctrine::getTable("Ciudad")->find($origen);
            if ($traorigen) {
                $traficoorigen = $traorigen->getCaIdtrafico();
                $ciudadesportrafico = Doctrine::getTable("Ciudad")
                        ->createQuery("c")
                        ->addWhere("c.ca_idtrafico = ?", $traficoorigen)
                        ->execute();
                $arrayciudades = array();
                foreach ($ciudadesportrafico as $ciudad) {
                    $arrayciudades[] = "'" . utf8_encode($ciudad->getCaIdciudad()) . "'";
                }
                $ciudades = implode(",", $arrayciudades);
            }
            $destino = utf8_decode($this->getRequestParameter("destino"));

            $q = Doctrine::getTable("Reporte")
                    ->createQuery("r")
                    ->select("r.ca_idreporte, b.ca_nombre, r.ca_idbodega, r.ca_consecutivo,r.ca_version ,r.ca_origen,r.ca_destino,o.ca_ciudad, d.ca_ciudad, o.ca_idciudad, d.ca_idciudad,o.ca_idtrafico, d.ca_idtrafico, r.ca_mercancia_desc,
                                    r.ca_idlinea, r.ca_impoexpo, r.ca_transporte, r.ca_modalidad, con.ca_idcontacto, con.ca_nombres, con.ca_papellido, con.ca_sapellido, con.ca_cargo
                                    ,cl.ca_idcliente, cl.ca_compania, cl.ca_preferencias, cl.ca_confirmar, cl.ca_coordinador, usu.ca_login, usu.ca_nombre, r.ca_orden_clie, r.ca_continuacion")
                    ->leftJoin("r.Bodega b")
                    ->leftJoin("r.Origen o")
                    ->leftJoin("r.Destino d")
                    ->leftJoin("r.Contacto con")
                    ->leftJoin("con.Cliente cl")
                    ->leftJoin("cl.LibCliente libcli")
                    ->leftJoin("r.Usuario usu")
                    ->addWhere("r.ca_consecutivo LIKE ?", $criterio . "%")
                    ->addWhere("r.ca_usuanulado IS NULL");
            if ($transporte != "") {
                $q->addWhere("r.ca_transporte = ?", $transporte);
            }

            if ($impoexpo != "") {
                if ($impoexpo == Constantes::IMPO) {
                    $q->addWhere("(r.ca_impoexpo = ? OR r.ca_impoexpo = ?)", array($impoexpo, Constantes::TRIANGULACION));
                } else {
                    $q->addWhere("r.ca_impoexpo = ?", $impoexpo);
                }
            }
            if ($openedOnly) {
                $q->addWhere("r.ca_idetapa != ?", "99999");
            }

            if ($transporte != Constantes::OTMDTA && ($transporte != Constantes::AEREO && $impoexpo!= Constantes::IMPO) ) {
                if ($origen != "") {
                    $q->addWhere("r.ca_origen in ($ciudades) ");
                }
                if ($destino != "") {
                    $q->addWhere("r.ca_destino = ? ", $destino);
                }
            }

            $q->addOrderBy("to_number(SUBSTR(r.ca_consecutivo , 1 , (POSITION('-' in r.ca_consecutivo)-1) ),'999999')  desc");
            $q->addOrderBy("r.ca_version  desc");

            $debug = $q->getSqlQuery();    
            $reportes = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->limit(50)->execute();
//	    echo $impoexpo." ".$transporte." ".$criterio;
//            echo $q->getSqlQuery();
//echo count($reportes);

            foreach ($reportes as $key => $val) {
                if ($transporte != "OTM-DTA") {
                    $reportes[$key]["d_ca_ciudad"] = utf8_encode($reportes[$key]["r_ca_destino"]);
                    $reportes[$key]["o_ca_ciudad"] = utf8_encode($reportes[$key]["r_ca_origen"]);
                } else {
                    $reportes[$key]["d_ca_ciudad"] = utf8_encode($reportes[$key]["d_ca_ciudad"]);
                    $reportes[$key]["o_ca_ciudad"] = utf8_encode($reportes[$key]["o_ca_ciudad"]);
                }
                $reportes[$key]["r_ca_idbodega"] = utf8_encode($reportes[$key]["r_ca_idbodega"]);
                $reportes[$key]["b_ca_nombrebodega"] = utf8_encode($reportes[$key]["b_ca_nombre"]);
                $reportes[$key]["b_ca_nombre"] = utf8_encode($reportes[$key]["b_ca_nombre"]);
                $reportes[$key]["o_ca_ciudad"] = utf8_encode($reportes[$key]["o_ca_ciudad"]);
                $reportes[$key]["d_ca_ciudad"] = utf8_encode($reportes[$key]["d_ca_ciudad"]);
                $reportes[$key]["r_ca_mercancia_desc"] = utf8_encode($reportes[$key]["r_ca_mercancia_desc"]);
                $reportes[$key]["r_ca_impoexpo"] = utf8_encode($reportes[$key]["r_ca_impoexpo"]);
                $reportes[$key]["r_ca_transporte"] = utf8_encode($reportes[$key]["r_ca_transporte"]);
                $reportes[$key]["cl_ca_compania"] = utf8_encode($reportes[$key]["cl_ca_compania"]);
                $reportes[$key]["con_ca_idcontacto"] = utf8_encode($reportes[$key]["con_ca_idcontacto"]);
                $reportes[$key]["con_ca_nombres"] = utf8_encode($reportes[$key]["con_ca_nombres"]);
                $reportes[$key]["con_ca_papellido"] = utf8_encode($reportes[$key]["con_ca_papellido"]);
                $reportes[$key]["con_ca_sapellido"] = utf8_encode($reportes[$key]["con_ca_sapellido"]);
                $reportes[$key]["con_ca_cargo"] = utf8_encode($reportes[$key]["con_ca_cargo"]);
                $reportes[$key]["cl_ca_preferencias"] = utf8_encode($reportes[$key]["cl_ca_preferencias"]);
                $reportes[$key]["usu_ca_nombre"] = isset($reportes[$key]["usu_ca_nombre"]) ? utf8_encode($reportes[$key]["usu_ca_nombre"]) : "";

                $reportes[$key]["r_ca_modalidad"] = utf8_encode($reportes[$key]["r_ca_modalidad"]);
                $reportes[$key]["r_ca_orden_clie"] = utf8_encode($reportes[$key]["r_ca_orden_clie"]);

                $reportes[$key]["r_ca_idlinea"] = utf8_encode($reportes[$key]["r_ca_idlinea"]);


                if ($reportes[$key]["r_ca_idlinea"] != "") {
                    $q = Doctrine_Query::create()
                            ->select("p.ca_idproveedor, p.ca_sigla, id.ca_nombre, p.ca_transporte ")
                            ->from("IdsProveedor p")
                            ->innerJoin("p.Ids id")
                            ->addOrderBy("id.ca_nombre");
                    $q->addWhere("p.ca_idproveedor=?", $reportes[$key]["r_ca_idlinea"]);
                    $lineas = $q->execute();
                    if (count($lineas) > 0) {
                        $reportes[$key]["p_ca_linea"] = utf8_encode(($lineas[0]['ca_sigla'] ? $lineas[0]['ca_sigla'] . " - " : "") . utf8_encode($lineas[0]['Ids']['ca_nombre']));
                    }
                }

                $reporte = Doctrine::getTable("Reporte")->find($val["r_ca_idreporte"]);
                if ($reporte) {
                    $provId = $reporte->getProveedores();
                    //print_r($provId);
                    if ($provId) {
                        $reportes[$key]["ca_tercero"] = utf8_encode($provId[0]->getCaNombre());
                        $reportes[$key]["ca_idtercero"] = $provId[0]->getCaIdtercero();
                    }
                    $reportes[$key]["cl_ca_confirmar"] = utf8_encode($reportes[$key]["cl_ca_confirmar"]);

                    //$reporte = Doctrine::getTable("Reporte")->find( $val["r_ca_idreporte"]);
                    $repstatus = $reporte->getUltimoStatus();

                    if ($repstatus) {
                        $reportes[$key]["ca_peso"] = $repstatus->getCaPeso();
                        $reportes[$key]["ca_piezas"] = $repstatus->getCaPiezas();
                        $reportes[$key]["ca_volumen"] = $repstatus->getCaVolumen();
                        $reportes[$key]["ca_doctransporte"] = $repstatus->getCaDoctransporte();
                    }
                }

                
                
                if($reporte->getCaContinuacion()=="OTM" and $reporte->getCaIdconsignatario()>4)
                {                    
                    $consig=$reporte->getConsignatario();
                    //echo $consig->getCaIdentificacion();
                    //$bodega = Doctrine::getTable("Bodega")->findBy("ca_identificacion",$consig->getCaIdentificacion());
                    
                    $bodega = Doctrine::getTable("Bodega")
                    ->createQuery("b")
                    ->select("b.*")                    
                    ->where("b.ca_transporte = 'Marítimo' and b.ca_tipo = 'Operador Multimodal' and b.ca_identificacion=?", $consig->getCaIdentificacion())
                    ->fetchOne();

                    if($bodega)
                    {
                        $reportes[$key]["r_ca_idbodega"] = utf8_encode($bodega->getCaIdbodega());
                        $reportes[$key]["b_ca_nombre"] = utf8_encode($bodega->getcaNombre());
                    }
                }
            }

            $this->responseArray = array("root" => $reportes, "total" => count($reportes), "success" => true, "tra" => $ciudades, "debug"=>$debug);
        } else {
            $this->responseArray = array("root" => array(), "total" => 0, "success" => true);
        }
//echo "<pre>";print_r($reportes);echo "</pre>";
        $this->setTemplate("responseTemplate");
    }

    /*
     * @param
     * query     : dato ingresado para filtrar referencias
     * @return      : arreglo de Referencias segun el filtro ingresado
     * @date:  2016-03-31
     */

    public function executeListaReferencias($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $numRef = $request->getParameter("query");

        $q = Doctrine::getTable("InoMaestraAdu")
                ->createQuery("m")
                ->select("m.*,o.*,d.*,cl.*")
                ->leftJoin("m.Origen o")
                ->leftJoin("m.Destino d")
                ->leftJoin("m.Cliente cl")
                ->addWhere("m.ca_referencia LIKE ?", "%" . $numRef . "%");
        $debug = $q->getSqlQuery();
        $referencias = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->limit(50)->execute();
        foreach ($referencias as $ref) {

            $sucursal[] = array(
                "ca_referencia" => $ref["m_ca_referencia"],
                "ca_fchreferencia" => $ref["m_ca_fchreferencia"],
                "ca_origen" => $ref["m_ca_origen"],
                "ca_idcliente" => $ref["m_ca_idcliente"],
                "ca_compania" => utf8_encode($ref["cl_ca_compania"]),
                "ca_piezas" => $ref["m_ca_piezas"],
                "ca_peso" => $ref["m_ca_peso"],
                "ca_volumen" => $ref["m_ca_volumen"],
                "ca_pedido" => utf8_encode($ref["m_ca_pedido"]),
                "ca_vendedor" => $ref["m_ca_vendedor"],
                "origen" => utf8_encode($ref["o_ca_ciudad"]),
                "destino" => utf8_encode($ref["d_ca_ciudad"])
            );
        }

        $this->responseArray = array("root" => $sucursal, "totalCount" => count($referencias), "success" => true, "debug" => $debug);
        $this->setTemplate("responseTemplate");
    }

    public function executeListaTercerosJSON() {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $criterio = utf8_decode($this->getRequestParameter("query"));
        $tipo = $this->getRequestParameter("tipo");
        $idtercero = $this->getRequestParameter("idtercero");

        $idreporte = $this->getRequestParameter("idreporte");

        $terceros = array();
        $notIn = array();
        $rows = array();
        if ($idreporte) {
            $reporte = Doctrine::getTable("Reporte")->find($idreporte);
            $proveedores = array();
            if ($reporte->getCaImpoexpo() == Constantes::EXPO) {
                if ($reporte->getCaIdconsignatario()) {
                    $proveedores = array($reporte->getCaIdconsignatario());
                }
            } else {
                $proveedores = $reporte->getProveedores();
            }

            foreach ($proveedores as $prov) {
                $terceros[] = array("t_ca_idtercero" => $prov->getCaIdtercero(), "t_ca_nombre" => $prov->getCaNombre(), "c_ca_ciudad" => $prov->getCiudad()->getCaCiudad(), "p_ca_nombre" => $prov->getCiudad()->getTrafico()->getCaNombre(), "t_ca_direccion" => $prov->getCaDireccion(), "t_ca_contacto" => $prov->getCaContacto(), "idreporte" => true);
                $notIn[] = $prov->getCaIdtercero();
            }
        }

        

        $q = Doctrine_Query::create()
                ->select("t.ca_idtercero, t.ca_nombre, c.ca_ciudad, p.ca_nombre,t.ca_direccion,t.ca_contacto")
                ->from("Tercero t")
                ->innerJoin("t.Ciudad c")
                ->innerJoin("c.Trafico p")
                ->addWhere("t.ca_tipo = ?", $tipo)
                ->addOrderBy("t.ca_nombre ASC")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->distinct()
                ->limit(40);
        if ($idreporte && $notIn) {
            $q->addWhere("t.ca_idtercero not in (" . implode(",", $notIn) . ")");
        }
        if ($idtercero>0) {
            $q->addWhere("t.ca_idtercero =?", $idtercero);
        }else{
            $q->addWhere("UPPER(t.ca_nombre) like ?", "%" . strtoupper($criterio) . "%");
        }
        //echo $q->getSqlQuery();

        $rows = $q->execute();

        if ($tipo == "Master") {
            $terceros[] = array("t_ca_idtercero" => "1", "t_ca_nombre" => "Cliente/Consignatario", "c_ca_ciudad" => "", "p_ca_nombre" => "", "t_ca_direccion" => "", "t_ca_contacto" => "");
            $terceros[] = array("t_ca_idtercero" => "2", "t_ca_nombre" => "Coltrans/Consignatario", "c_ca_ciudad" => "", "p_ca_nombre" => "", "t_ca_direccion" => "", "t_ca_contacto" => "");
            $terceros[] = array("t_ca_idtercero" => "4", "t_ca_nombre" => "Coltrans/Agente", "c_ca_ciudad" => "", "p_ca_nombre" => "", "t_ca_direccion" => "", "t_ca_contacto" => "");
        } else if ($tipo == "Consignatario") {
            $terceros[] = array("t_ca_idtercero" => "1", "t_ca_nombre" => "Cliente/Consignatario", "c_ca_ciudad" => "", "p_ca_nombre" => "", "t_ca_direccion" => "", "t_ca_contacto" => "");
            $terceros[] = array("t_ca_idtercero" => "2", "t_ca_nombre" => "Coltrans/Consignatario", "c_ca_ciudad" => "", "p_ca_nombre" => "", "t_ca_direccion" => "", "t_ca_contacto" => "");
        }

        $con = 0;
        $rows = array_merge($terceros, $rows);
        $terceros = array();
        $name = null;
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                $row["c_ca_ciudad"] = (trim($row["c_ca_ciudad"]) != "Todas las Ciudades" && $row["c_ca_ciudad"] != "") ? utf8_encode($row["c_ca_ciudad"]) : " ";
                $row["p_ca_nombre"] = (trim($row["p_ca_nombre"]) == "Todos los Tráficos del Mundo" || $row["p_ca_nombre"] == "") ? "" : utf8_encode($row["p_ca_nombre"]);
                $row["t_ca_contacto"] = utf8_encode($row["t_ca_contacto"]);
                $row["t_ca_direccion"] = utf8_encode($row["t_ca_direccion"]);
                if (trim(utf8_encode($row["t_ca_nombre"])) == trim($name))
                    $con++;
                else
                    $con = 0;
                $name = trim(utf8_encode($row["t_ca_nombre"]));
                $row["t_ca_nombre"] = utf8_encode($row["t_ca_nombre"]) . (($con) ? "(" . ($con + 1) . ")" : "");
                $terceros[] = $row;
            }
        }
        $this->responseArray = array("totalCount" => count($terceros), "terceros" => $terceros);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosDeduccion(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $data = array();

        $master = Doctrine::getTable("InoMaster")->find($request->getParameter("idmaster"));

        $transporte = utf8_decode($request->getParameter("idtransporte"));
        $idimpoexpo = utf8_decode($request->getParameter("idimpoexpo"));
        $q = Doctrine_Query::create()
                ->select("c.ca_iddeduccion as ca_idconcepto, c.ca_deduccion as ca_concepto, c.ca_impoexpo, c.ca_transporte, c.ca_modalidad")
                ->from("Deduccion c")
                ->addWhere("c.ca_habilitado = ?", true)
                ->addWhere("c.ca_impoexpo = ?", $idimpoexpo)
                ->addWhere("c.ca_transporte = ?", $transporte)
                ->addWhere("c.ca_modalidad = ?", $master->getCaModalidad())
                ->addOrderBy("ca_concepto");
        $q->fetchArray();
        $debug = $q->getSqlQuery();
        $conceptos = $q->execute();
        foreach ($conceptos as $concepto) {
            $data[] = array("idconcepto" => $concepto['ca_idconcepto'],
                "concepto" => utf8_encode($concepto['ca_concepto'])
            );
        }
        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true, "modalidad" => $master->getCaModalidad(), "debug"=>$debug);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosTipocomprobanteC(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $tipos = Doctrine::getTable("InoTipoComprobante")
                ->createQuery("t")
                //->addWhere("t.ca_idempresa = ?", $this->getUser()->getIdempresa())
                ->execute();
        $data = array();
        foreach ($tipos as $tipo) {
            $aplicacion = $tipo->getCaAplicacion()===1?"Sap":"Siigo";
            $empresa = $tipo->getEmpresa()->getCaNombre();
            $data[] = array(
                "id" => $tipo->getCaIdtipo(),
                "comprobante" => utf8_encode($tipo->getCaTipo() . $tipo->getCaComprobante()), 
                //"titulo"=>utf8_encode($tipo->getCaTipo() . $tipo->getCaComprobante()." ".$tipo->getCaTitulo()."-".$aplicacion."-".$empresa),
                "titulo"=>utf8_encode($tipo->getCaTipo() . $tipo->getCaComprobante()." ".$tipo->getCaTitulo()),
                "empresa"=> utf8_encode($empresa),
                "aplicacion"=>$aplicacion,
                "activo"=>$tipo->getCaActivo()?true:false);
        }
        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosCuentasSiigo(sfWebRequest $request) {

        $idempresa = $request->getParameter("idempresa");


        $q = Doctrine::getTable("SiigoCuenta")
                ->createQuery("c")
                //->addWhere("c.detallaccostos = 'S'")
                ->addOrderBy("c.codigocuenta")
                ->setHydrationMode(Doctrine::HYDRATE_ARRAY);

        if ($idempresa != "")
            $q->addWhere("ca_idempresa = ? ", $idempresa);
        else
            $q->addWhere("ca_idempresa = ? ", $this->getUser()->getIdempresa());



        $data = $q->execute();


        //$data = array();

        foreach ($data as $k => $d) {
            $data[$k]["nombrecuenta"] = utf8_encode($d["codigocuenta"] . "-" . $d["nombrecuenta"]);
        }

        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);

        $this->setTemplate("responseTemplate");
    }

    public function executeDatosFacturas(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $tipo = $request->getParameter("tipo");
        if ($request->getParameter("query") != "") {
            $q = '%' . $request->getParameter("query") . '%';

            $data = array();
            if ($tipo) {
                $sql = "select (t.ca_tipo||t.ca_comprobante||'-'||c.ca_consecutivo) ca_consecutivo, c.ca_idcomprobante id_comprobante, i.ca_idalterno id_alterno , c.ca_valor2 , c.ca_valor
                        from  ino.tb_comprobantes c
                        inner join ino.tb_tipos_comprobante t ON (c.ca_idtipo = t.ca_idtipo)
                        inner join ids.tb_ids i ON (i.ca_id = c.ca_id)
                        where (t.ca_tipo||t.ca_comprobante||'-'||c.ca_consecutivo) like '$q' and t.ca_activo = true and t.ca_tipo = '$tipo'";

                $con = Doctrine_Manager::getInstance()->connection();
                $st = $con->execute($sql);
                $facturas = $st->fetchAll();

                foreach ($facturas as $factura) {
                    $valor = "";
                    if ($factura["ca_valor2"] == "") {
                        $valor = $factura["ca_valor"];
                    } else {
                        $valor = $factura["ca_valor2"];
                    }
                    $alterno = utf8_encode($factura["id_alterno"]);

                    //print_r("%".$alterno."%");
                    $cliente = Doctrine::getTable("Ids")
                            ->createQuery("i")
                            ->addWhere("i.ca_idalterno = '$alterno'")
                            ->fetchOne();
                    $nombre = "";
                    $id = "";
                    $cuentaformapago = "";
                    if ($cliente) {
                        $nombre = utf8_encode($cliente->getCaNombre());
                        $id = $cliente->getCaId();
                        $cuentaformapago = $cliente->getIdsCliente()->getCuentaFormaPago(2);
                    }
                    $comprobante = Doctrine::getTable("InoComprobante")->find($factura["id_comprobante"]);
                    $referencia = "";
                    if ($comprobante) {
                        $referencia = $comprobante->getInoHouse()->getInoMaster()->getCaReferencia();
                    }

                    $data[] = array("consecutivo" => utf8_encode($factura["ca_consecutivo"]),
                        "id" => $id,
                        "nombre" => $nombre,
                        "cuentaformapago" => $cuentaformapago,
                        "referencia" => $referencia,
                        "idcomprobante" => $factura["id_comprobante"],
                        "valor" => utf8_encode($valor));
                }
            }
        }
        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosCentrocostos(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $data = array();

        $idempresa = $request->getParameter("idempresa");
        
            if ($request->getParameter("listartodos") == true) {
            $q = Doctrine::getTable("InoCentroCosto")
                    ->createQuery("c");                    
        } else if ($request->getParameter("listartodos") == false) {
            $q = Doctrine::getTable("InoCentroCosto")
                        ->createQuery("c")
                    ->addWhere("c.ca_idempresa = ?", ( ($idempresa == "") ? $this->getUser()->getSucursal() : $idempresa));                    
            }

        $q->addWhere("ca_idccosto > 99");
        $q->orderBy("ca_nombre");
        $ccostos = $q->execute();

        foreach ($ccostos as $costo) {
            $data[] = array("id" => utf8_encode($costo->getCaIdccosto()),
                "nombre" => utf8_encode($costo->getCaNombre()),
                "centro" => utf8_encode($costo->getCaCentro()),
                "subcentro" => utf8_encode($costo->getCaSubcentro()),
                "sucursal" => utf8_encode($costo->getCaIdsucursal()),
                "impoexpo" => utf8_encode($costo->getCaImpoexpo()),
                "transporte" => utf8_encode($costo->getCaTransporte()));
        }
        
        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosIds($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $query = $request->getParameter("query");
        $ids = Doctrine::getTable("Ids")
                ->createQuery("i")
                ->addWhere("UPPER(i.ca_nombre) like ? or i.ca_idalterno like ?", array("%" . strtoupper($query) . "%", "%" . ($query) . "%"))
                ->execute();
        $data = array();
        foreach ($ids as $id) {
            $data[] = array("id" => $id->getCaId(),
                "idalterno" => $id->getCaIdalterno(),
                "cuentaformapago" => $id->getIdsCliente()->getCuentaFormaPago(2),
                "nombre" => utf8_encode($id->getCaNombre()));
        }

        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosTipoIds(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $con = Doctrine_Manager::getInstance()->connection();
        $aplicacion = $this->getRequestParameter("aplicacion");
        
        $q = Doctrine_Query::create()
                ->select("t.ca_tipo, t.ca_nombre")
                ->from("IdsTipo t")
                ->addOrderBy("t.ca_nombre ASC")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->limit(40);
        if ($aplicacion) {
            $q->addWhere("t.ca_aplicacion = ?", $aplicacion);
        }
        $rows = $q->execute();
        $tipos = array();

        foreach ($rows as $row) {
            $row1=array();
            $row1["tipo"] = $row["t_ca_tipo"];
            $row1["nombre"] = utf8_encode($row["t_ca_nombre"]);
            $row1["aplicacion"] = $row["t_ca_aplicacion"];
            $tipos[] = $row1;
        }
        $this->responseArray = array("totalCount" => count($tipos), "root" => $tipos);
        $this->setTemplate("responseTemplate");
        
    }

    public function executeDatosIdsCostos(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $query = $request->getParameter("query");
        if ($query && $query != "") {
            $query = strtoupper("%" . $query . "%");
            $ids = Doctrine::getTable("Ids")
                    ->createQuery("i")
                    ->addWhere("UPPER(i.ca_nombre)  like ?", $query)
                    ->execute();
            $data = array();
            foreach ($ids as $id) {
                $data[] = array("idalterno" => $id->getCaIdalterno(), "nombre" => utf8_encode($id->getCaNombre()), "id" => $id->getCaId());
            }
        }
        $this->responseArray = array("root" => $data, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosSucursalesEmpresa(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $empresa = $request->getParameter("empresa");
        $sucursales = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->addWhere("ca_idempresa = $empresa and ca_idsucursal not like '999'")
                ->execute();
        $data = array();
        foreach ($sucursales as $sucursal) {
            $data[] = array("id" => $sucursal->getCaIdsucursal(),
                "sucursal" => utf8_encode($sucursal->getCaNombre()),
                "idempresa" => $sucursal->getEmpresa()->getCaIdempresa(),
                "empresa" => utf8_encode($sucursal->getEmpresa()->getCaNombre()));
        }
        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosCiudadesCol(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $ciudades = Doctrine::getTable("Ciudad")
                ->createQuery("c")
                ->addWhere("ca_idtrafico = 'CO-057'")
                ->execute();
        $data = array();
        foreach ($ciudades as $ciudad) {
            $data[] = array("id" => $ciudad->getCaIdciudad(),
                "name" => utf8_encode($ciudad->getCaCiudad()));
        }
        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosCiudadesTrafico(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $trafico = $request->getParameter("trafico");

        $q = Doctrine::getTable("Ciudad")
                ->createQuery("c");
        if ($trafico) {
            $q->addWhere("c.ca_idtrafico = '$trafico' ");
        }
        $ciudades = $q->execute();
        $data = array();
        foreach ($ciudades as $ciudad) {
            $data[] = array("id" => $ciudad->getCaIdciudad(),
                "name" => utf8_encode($ciudad->getCaCiudad()));
        }
        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosTraficos(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $traficos = Doctrine::getTable("Trafico")
                ->createQuery("t")
                ->execute();
        $data = array();
        foreach ($traficos as $trafico) {
            $data[] = array("id" => utf8_encode($trafico->getCaIdtrafico()), "name" => utf8_encode($trafico->getCaNombre()));
        }
        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

        public function executeDatosGraficasIndicadores(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        //$cliente = $this->getUser()->getClienteActivo();
        $cliente = json_decode($request->getParameter("cliente"));

        $idscliente = Doctrine::getTable("Ids")
                ->createQuery("i")
                ->addWhere("i.ca_id = ?", $cliente)
                ->fetchOne();

        $clienteEmbarque = $idscliente->getIdsCliente()->getProperty("idgProveedor");

        if ($idscliente) {

            //$grupo = $idscliente->getCaIdgrupo();
            //if ($grupo != "") {
                $miembrosgrupo = Doctrine::getTable("IdsCliente")
                        ->createQuery("i")
                        ->addWhere("i.ca_idgrupo = ?", $idscliente->getCaId())
                        ->execute();
                $clientes = array();
                foreach ($miembrosgrupo as $miembrogrupo) {
                    $clientes[] = $miembrogrupo->getCaIdcliente();
                }
            //}
            //$clientes[] = $cliente;

            for ($i = 0; $i < count($clientes); $i++) {
                $clientes[$i] = $clientes[$i];
            }
            $listaclientes = implode(",", $clientes);

            //echo $listaclientes;

            $filtros = json_decode($request->getParameter("filtro"));
            $transporte = $filtros->transporte;

            $filtros = json_decode($request->getParameter("filtro"));
            $transporte = utf8_decode($filtros->transporte);
            $origen = utf8_decode($filtros->origen);
            $ciudadorigen = utf8_decode($filtros->ciudadorigenopc);
            $ciudaddestino = utf8_decode($filtros->destinopc);

            $nombreorigen = Doctrine::getTable("Ciudad")->find($ciudadorigen);
            $nombredest = Doctrine::getTable("Ciudad")->find($ciudaddestino);

            //////////////////////////////////COORDINACION DE EMBARQUE /////////////////////////////////////////////////////

            $sql = "
                SELECT i.*, t.ca_nombre as proveedor, r.ca_carga_disponible as carga_disponible 
                FROM vi_indicadores i 
                LEFT JOIN tb_repproveedores r ON (i.ca_idreporte = r.ca_idreporte)
                    LEFT JOIN tb_terceros t ON (t.ca_idtercero = r.ca_idproveedor) 
                WHERE i.ca_transporte = '$transporte' AND i.ca_idcliente IN ($listaclientes)";

            if ($filtros->fecha_inicio && $filtros->fecha_fin) {
                $sql .= " AND i.ca_fchllegada_cd BETWEEN '$filtros->fecha_inicio' AND '$filtros->fecha_fin' ";
            }

            if ($nombreorigen) {
                $nombreorigen = $nombreorigen->getCaCiudad();
                $sql .= " and i.ca_ciuorigen= '$nombreorigen'";
            }
            if ($nombredest) {
                $nombredest = $nombredest->getCaCiudad();
                $sql .= " and i.ca_ciudestino= '$nombredest'";
            }
            if ($origen != "")
                $sql .= " and i.ca_idtrafico = '$origen'";

            $sql .=" ORDER BY i.ca_fchllegada_cd";

            //echo $sql;
            
            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);

            $indicadores = $st->fetchAll();

            $proovedores = array();
            $serieMes2 = array();
            $serieTraf = array();
            $datag1 = array();
            $data3 = array();
            $data5 = array();
            $datag2 = array();
            $cumplimientos = 0;
            $a = "";
            $datazarpe = array();
            $conteocoordembarque = array();
            $datagtr = array();
            $model = array();
            $datallegada = array();
            $datacoord = array();
            $datafacturacion = array();
            $datavaciado = array();
            $datosempresas = array();
            $serieEmpresas = array();
            /////////////////////////
            $gridvaciado = array();
            $gridfacturacion = array();
            $gridllegada = array();
            $gridzarpe = array();
            $gridtransito = array();
            $gridvolumen = array();
            $gridindicadores = array();
            $gridpie = array();
            $gridembarque = array();
            $gridemba = array();
            $pes = "-";

            foreach ($indicadores as $indicador) {
                $proovedor = utf8_encode($indicador["proveedor"]);
                if (!in_array($proovedor, $proovedores))
                    $proovedores[] = $proovedor;

                $mes = Utils::getMonth(substr($indicador["ca_fchllegada_cd"], 5, 2));
                $trafico = utf8_encode($indicador["ca_traorigen"]);
                $empresa = utf8_encode($indicador["ca_nombre"]);
                if (!in_array($mes, $serieMes2))
                    $serieMes2[] = $mes;

                if (!in_array($trafico, $serieTraf))
                    $serieTraf[] = $trafico;

                if (!in_array($empresa, $serieEmpresas))
                    $serieEmpresas[] = $empresa;

                $peso = explode("|", $indicador["ca_peso"]);
                $volumen = explode("|", $indicador["ca_volumen"]);
                $piezas = explode("|", $indicador["ca_piezas"]);
                $sqltt = "";

                //verificar
                if ($origen != "") {
                    $sqltt = "select ca_tiempotransito conteo, ca_coord_embarque coordembarque from tb_entrega_antecedentes where ca_idtrafico = '$origen'";
                } else {
                    $sqltt = "select ca_tiempotransito conteo, ca_coord_embarque coordembarque from tb_entrega_antecedentes where 1=1 ";
                }
                if ($transporte != "" && $transporte)
                    $sqltt .= " and ca_transporte = '$transporte'";

                if ($ciudadorigen != "" && $ciudadorigen) {
                    $sqltt .= " and ca_idciudad = '$ciudadorigen'";
                } else {
                    $or = $indicador['ca_idorigen'];
                    $sqltt .= " and ca_idciudad= '$or'";
                }
                if ($ciudaddestino != "" && $ciudaddestino) {
                    $sqltt .= " and ca_iddestino= '$ciudaddestino'";
                } else {
                    $des = $indicador['ca_iddestino'];
                    $sqltt .= " and ca_iddestino= '$des'";
                }

                $datagtr[$mes][$trafico] += 1;
                $datagtr[$mes][$trafico]["cumple"] = 0;

                $st = $con->execute($sqltt);
                $conteocumplimiento = $st->fetch();

                $idtrafico = $indicador["ca_idtrafico"];
                $idorigen = $indicador["ca_idorigen"];
                $iddestino = $indicador["ca_iddestino"];


                /** PRUEBA NO 5609348560* */
                $fllegadacd = $indicador["ca_fchllegada_cd"];

                $sql1 = Doctrine::getTable("Idgclientes")
                        ->createQuery("i")
                        ->addWhere("i.ca_traorigen = ?", $idtrafico)
                        ->addWhere("i.ca_ciudestino = ?", '999-9999')
                        ->addWhere("i.ca_tradestino = ?", '999-9999')
                        ->addWhere("i.ca_periodo_inicial  < ?", $fllegadacd)
                        ->addWhere("i.ca_periodo_final > ?", $fllegadacd)
                        ->fetchOne();


                if ($sql1) {
                    $jsonsql1 = json_decode($sql1->getCaIndicador());
                    $d = $jsonsql1->coordinacion;
                    $r = "";
                } else {
                    $d = "SIN META";
                }


                $sql2 = Doctrine::getTable("IdgClientes")
                        ->createQuery("i")
                        ->addWhere("(i.ca_traorigen like '$idtrafico' AND i.ca_ciuorigen like '$idorigen' AND i.ca_ciudestino like '$iddestino' AND i.ca_transportista like ' ' ) OR (i.ca_traorigen = '$idtrafico' AND i.ca_ciuorigen = '$idorigen' AND i.ca_ciudestino = '999-9999' AND i.ca_transportista like ' ') OR (i.ca_traorigen = '$idtrafico' AND i.ca_ciuorigen = '999-9999' AND i.ca_ciudestino = '$iddestino' AND i.ca_transportista like ' ') AND i.ca_periodo_inicial < '$fllegadacd' AND i.ca_periodo_final > '$fllegadacd'")
                        ->fetchOne();

                if ($sql2) {

                    $jsonsql2 = json_decode($sql2->getCaIndicador());
                    $d = $jsonsql2->coordinacion;

                    $r = "segunda opcion";
                }

                $datacoord[$proovedor]['name'] = $proovedor;

                $datacoord[$proovedor]['negocios'] += 1;
                $gridemba[$proovedor]["proovedor"] = $proovedor;
                $cumpleco = 0;

                if ($indicador["carga_disponible"] != "") {
                    $dias = (strtotime($indicador["carga_disponible"]) - strtotime($indicador["ca_fchllegada_cd"])) / 86400;
                    $dias = abs($dias);
                    $dias = floor($dias);

                    if ($d != "SIN META") {
                        if ($dias <= $d) {

                            $datacoord[$proovedor]["cumple"] += 1;

                            $gridemba[$proovedor]["cumple"] += 1;
                            $cumpleco = 1;
                        } else {
                            $gridemba[$proovedor]["nocumple"] += 1;
                        }
                    } else {
                        $gridemba[$proovedor]["nocumple"] += 1;
                    }
                } else {
                    $gridemba[$proovedor]["nocumple"] += 1;
                    $dias = 120;
                }

                $reporteneg = Doctrine::getTable("Reporte")->find($indicador["ca_idreporte"]);

                if ($reporteneg) {
                    $obscord = $reporteneg->getProperty("idg1");
                }

                $griddatoscumplimiento[] = array(
                    "obscord" => utf8_encode($obscord),
                    "anio" => utf8_encode($indicador["ca_ano"]),
                    "mes" => utf8_encode($mes),
                    "reporte" => utf8_encode($indicador["ca_idreporte"]),
                    "consecutivo" => utf8_encode($indicador["ca_consecutivo"]),
                    "orden" => utf8_encode($indicador["ca_orden_clie"]),
                    "doctransporte" => utf8_encode($indicador["ca_doctransporte"]),
                    "traorigen" => utf8_encode($indicador["ca_traorigen"]),
                    "destino" => utf8_encode($indicador["ca_ciudestino"]),
                    "proveedor" => $proovedor,
                    "modalidad" => utf8_encode($indicador["modalidad"]),
                    "ciu" => utf8_encode($indicador["ca_ciuorigen"]),
                    "piezas" => utf8_encode($piezas[0]),
                    "peso" => utf8_encode($peso[0]),
                    "volumen" => floatval($volumen[0]),
                    "fch_salida" => utf8_encode($indicador["ca_fchsalida_cd"]),
                    "fch_llegada" => utf8_encode($indicador["ca_fchllegada_cd"]),
                    "fch_zarpe" => utf8_encode($indicador["ca_fchsalida_ccr"]),
                    "fch_eta" => utf8_encode($indicador["ca_fchllegada_eta"]),
                    "fch_factura" => utf8_encode($indicador["ca_fchfactura"]),
                    "fch_vaciado" => utf8_encode($indicador["ca_fchvaciado"]),
                    "fch_disponible" => utf8_encode($indicador["carga_disponible"]),
                    "cumplett" => $cumplett,
                    "cumplezarpe" => utf8_encode($indicador["cump_zarpe"]),
                    "cumplellegada" => utf8_encode($indicador["cump_llegada"]),
                    "cumplefacturacion" => utf8_encode($cf),
                    "cumplevaciado" => utf8_encode($cumplevaciado),
                    "cumplecoor" => utf8_encode($cumpleco),
                    "metacoord" => utf8_encode($d),
                    "idgcoorembarque" => utf8_encode($dias),
                    "empresa" => utf8_encode($indicador["ca_nombre"])
                );
            }


            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            if ($transporte == "Marítimo") {
                $join = "
                    LEFT JOIN (
                        SELECT rp_1.ca_consecutivo, id_1.ca_id AS ca_idlinea, id_1.ca_nombre::text AS ca_linea
                        FROM tb_reportes rp_1
                          JOIN tb_inoclientes_sea ic ON rp_1.ca_idreporte = ic.ca_idreporte
                          JOIN tb_inomaestra_sea im ON im.ca_referencia::text = ic.ca_referencia::text
                          JOIN ids.tb_ids id_1 ON id_1.ca_id = im.ca_idlinea) sea ON sea.ca_consecutivo = i.ca_consecutivo";
            } else {
                $join = "
                    LEFT JOIN (
                        SELECT rp_1.ca_consecutivo, max(id_1.ca_nombre::text) AS ca_linea, max(id_1.ca_id )AS ca_idlinea
                        FROM tb_reportes rp_1
                            JOIN tb_inoclientes_air ic ON rp_1.ca_consecutivo::text = ic.ca_idreporte::text
                            JOIN tb_inomaestra_air im ON im.ca_referencia::text = ic.ca_referencia::text
                            JOIN ids.tb_ids id_1 ON id_1.ca_id = im.ca_idlinea
                        GROUP BY rp_1.ca_consecutivo) air ON air.ca_consecutivo = i.ca_consecutivo";
            }
            //$sql = "select i.*, r.ca_proveedores, ca_idlinea, ca_linea from vi_indicadores i LEFT JOIN vi_repproveedores r ON (i.ca_idreporte = r.ca_idreporte) $join WHERE i.ca_transporte = '$transporte' AND i.ca_idcliente IN ($listaclientes)";
            
            $sql = "
                SELECT i.*, r.ca_proveedores, r.ca_incoterms, sq.ca_fchsalida AS ca_fchsalida_ccr, CASE WHEN ca_idlinea is not null THEN ca_idlinea ELSE nvaidlinea END AS ca_idlinea, CASE WHEN ca_linea is not null THEN ca_linea ELSE nvalinea END AS ca_linea
                FROM vi_indicadores i 
                    LEFT JOIN vi_repproveedores r ON (i.ca_idreporte = r.ca_idreporte) 
                    $join
                    LEFT JOIN (
                        SELECT rp_1.ca_consecutivo, id_1.ca_id AS nvaidlinea, id_1.ca_nombre::text AS nvalinea
                        FROM tb_reportes rp_1 
                                JOIN ino.tb_house h ON rp_1.ca_idreporte = h.ca_idreporte 
                                JOIN ino.tb_master m ON m.ca_idmaster::text = h.ca_idmaster::text 
                                JOIN ids.tb_ids id_1 ON id_1.ca_id = m.ca_idlinea) nvoino ON nvoino.ca_consecutivo = i.ca_consecutivo
                    LEFT JOIN (
                        SELECT sta.ca_fchsalida, sf.ca_consecutivo
                        FROM tb_repstatus sta
                            RIGHT JOIN ( 
                                SELECT p.ca_consecutivo, max(sta_1.ca_idstatus) AS ca_idstatus
                                FROM tb_repstatus sta_1
                                        JOIN tb_reportes p ON p.ca_idreporte = sta_1.ca_idreporte
                                WHERE sta_1.ca_idetapa = ANY (ARRAY['IMCCR'::bpchar, 'IACCR'::bpchar])
                                GROUP BY p.ca_consecutivo) sf ON sta.ca_idstatus = sf.ca_idstatus) sq ON sq.ca_consecutivo::text = i.ca_consecutivo::text                    
            WHERE i.ca_transporte = '$transporte' AND i.ca_idcliente IN ($listaclientes)";
            
            //echo $sql;
            if ($filtros->fecha_inicio && $filtros->fecha_fin) {
                $sql .= " AND i.ca_fchllegada_cd BETWEEN '$filtros->fecha_inicio' AND '$filtros->fecha_fin' ";
            }
            
            if ($nombreorigen) {
                $nombreorigen = $nombreorigen->getCaCiudad();
                $sql .= " and i.ca_ciuorigen= '$nombreorigen'";
            }
            if ($nombredest) {
                $nombredest = $nombredest->getCaCiudad();
                $sql .= " and i.ca_ciudestino= '$nombredest'";
            }
            if ($origen != "")
                $sql .= " and i.ca_idtrafico = '$origen'";

            $sql .=" ORDER BY i.ca_fchllegada_cd";
            //print_r($sql);

            $con = Doctrine_Manager::getInstance()->connection();

            $st = $con->execute($sql);
            $indicadores = $st->fetchAll();

            $serieMes2 = array();
            $serieTraf = array();
            $datag1 = array();
            $datag1fcl = array();
            $data8 = array();
            $data3 = array();
            $data5 = array();
            $datag2 = array();
            $cumplimientos = 0;
            $a = "";
            $datazarpe = array();
            $conteocoordembarque = array();
            $datagtr = array();
            $model = array();
            $datallegada = array();
            $datafacturacion = array();
            $datavaciado = array();
            $datosempresas = array();
            $serieEmpresas = array();
            /////////////////////////
            $gridvaciado = array();
            $gridfacturacion = array();
            $gridllegada = array();
            $gridzarpe = array();
            $gridtransito = array();
            $gridvolumen = array();
            $gridindicadores = array();
            $gridpie = array();
            $gridembarque = array();
            $gridvolumenFCL = array();
            $pes = "-";
            
            //echo count($indicadores);
            //echo "<pre>";print_r($indicadores);echo "</pre>";
            //exit();
            foreach ($indicadores as $indicador) {

                $proovedor = utf8_encode($indicador["ca_proveedores"]);
                /* if (!in_array($proovedor, $proovedores))
                  $proovedores[] = $proovedor; */

                $mes = Utils::getMonth(substr($indicador["ca_fchllegada_cd"], 5, 2));
                $trafico = utf8_encode($indicador["ca_traorigen"]);
                $empresa = utf8_encode($indicador["ca_nombre"]);
                if (!in_array($mes, $serieMes2))
                    $serieMes2[] = $mes;

                if (!in_array($trafico, $serieTraf))
                    $serieTraf[] = $trafico;

                if (!in_array($empresa, $serieEmpresas))
                    $serieEmpresas[] = $empresa;

                $peso = explode("|", $indicador["ca_peso"]);
                $volumen = explode("|", $indicador["ca_volumen"]);
                $datosempresas[$empresa]["negociospie"] += 1;
                $datosempresas[$empresa]["namepie"] = $empresa;

                $gridpie[$mes]["mes"] = $mes;
                $gridpie[$mes]["peso"] += $peso[0];

                /* if ($mes == "Dic"){
                  $pes .= "" . $peso[0] . " + ";
                  } */

                $piezas = explode("|", $indicador["ca_piezas"]);

                if ($indicador["modalidad"] == "LCL") {
                    $gridvolumen[$mes]["mes"] = $mes;
                    $gridvolumen[$mes]["volumen"] += floatval($volumen[0]);
                    $datag1[$mes][$trafico] += floatval($volumen[0]);
                }
                if ($indicador["modalidad"] == "FCL") {
                    $gridvolumenFCL[$mes]["mes"] = $mes;
                    $gridvolumenFCL[$mes]["volumen"] += $indicador["ca_teus"];
                    $datag1fcl[$mes][$trafico] += $indicador["ca_teus"];
                }

                $sqltt = "";
                if ($origen != "") {
                    $sqltt = "select ca_tiempotransito conteo, ca_coord_embarque coordembarque from tb_entrega_antecedentes where ca_idtrafico = '$origen'";
                } else {
                    $sqltt = "select ca_tiempotransito conteo, ca_coord_embarque coordembarque from tb_entrega_antecedentes where 1=1 ";
                }
                if ($transporte != "" && $transporte)
                    $sqltt .= " and ca_transporte = '$transporte'";

                if ($ciudadorigen != "" && $ciudadorigen) {
                    $sqltt .= " and ca_idciudad = '$ciudadorigen'";
                } else {
                    $or = $indicador['ca_idorigen'];
                    $sqltt .= " and ca_idciudad= '$or'";
                }
                if ($ciudaddestino != "" && $ciudaddestino) {
                    $sqltt .= " and ca_iddestino= '$ciudaddestino'";
                } else {
                    $des = $indicador['ca_iddestino'];
                    $sqltt .= " and ca_iddestino= '$des'";
                }
                $datagtr[$mes][$trafico] += 1;
                $datagtr[$mes][$trafico]["cumple"] = 0;

                $st = $con->execute($sqltt);
                $conteocumplimiento = $st->fetch();

                $t = 0;
                $idtrafico = $indicador["ca_idtrafico"];
                $idorigen = $indicador["ca_idorigen"];
                $iddestino = $indicador["ca_iddestino"];


                $sql1 = "SELECT ca_idtrafico, ca_idciudad, ca_iddestino,  ca_tiempotransito conteo, ca_coord_embarque coordembarque "
                        . "FROM tb_entrega_antecedentes "
                        . "WHERE ca_idtrafico = '$idtrafico' AND ca_idciudad = '999-9999' AND ca_iddestino = '999-9999'";

                $st = $con->execute($sql1);
                $sqlCE = $st->fetchAll();



                if (count($sqlCE) > 0) {
                    $t = $sqlCE[0]["conteo"];
                    $r = "";
                } else {
                    $t = 0;
                }

                $sql2 = "SELECT ca_idtrafico, ca_idciudad, ca_iddestino,  ca_tiempotransito conteo, ca_coord_embarque coordembarque "
                        . "FROM tb_entrega_antecedentes "
                        . "WHERE (ca_idtrafico = '$idtrafico' AND ca_idciudad = '$idorigen' AND ca_iddestino = '$iddestino' ) OR"
                        . "(ca_idtrafico = '$idtrafico' AND ca_idciudad = '$idorigen' AND ca_iddestino = '999-9999') OR"
                        . "(ca_idtrafico = '$idtrafico' AND ca_idciudad = '999-9999' AND ca_iddestino = '$iddestino')";

                $st = $con->execute($sql2);
                $sqlCE2 = $st->fetchAll();

                if (count($sqlCE2) > 0) {
                    $t = $sqlCE2[0]["conteo"];
                    $r = "segunda opcion";
                }



                /* $idcliente = $indicador["ca_idcliente"];
                  $idgTT = Doctrine::getTable("IdgClientes")
                  ->createQuery("i")
                  ->addWhere("i.ca_transporte like ?", $transporte)
                  ->addWhere("i.ca_traorigen like ?", $idtrafico)
                  ->addWhere("i.ca_ciudestino like ?", $iddestino)
                  ->addWhere("i.ca_transportista like ?", $indicador["idlinea"])
                  ->addWhere("i.ca_idcliente like ?", $idcliente)
                  ->addWhere("i.ca_periodo_inicial < ?", $indicador["ca_fchllegada_cd"])
                  ->addWhere("i.ca_periodo_final > ?", $indicador["ca_fchllegada_cd"])
                  ->fetchOne();
                  if ($idgTT){
                  $jsonTT = json_decode($idgTT->getCaIndicador());
                  $metaTT = $jsonTT->tiempotransito;
                  }
                  else{
                  $idgTT = Doctrine::getTable("IdgClientes")
                  ->createQuery("i")
                  ->addWhere("i.ca_transporte like ?", $transporte)
                  ->addWhere("i.ca_traorigen like ?", $idtrafico)
                  ->addWhere("i.ca_ciudestino like ?", $iddestino)
                  ->addWhere("i.ca_transportista like ?", $indicador["idlinea"])
                  ->addWhere("i.ca_periodo_inicial < ?", $indicador["ca_fchllegada_cd"])
                  ->addWhere("i.ca_periodo_final > ?", $indicador["ca_fchllegada_cd"])
                  ->fetchOne();
                  if ($idgTT){
                  $jsonTT = json_decode($idgTT->getCaIndicador());
                  $metaTT = $jsonTT->tiempotransito;
                  }
                  else{
                  $metaTT  = "SIN META";
                  }
                  } */

                $idcliente = $indicador["ca_idcliente"];
                $q = Doctrine::getTable("IdgClientes")
                        ->createQuery("i")
                        ->addWhere("i.ca_transporte like ?", $transporte)
                        ->addWhere("i.ca_traorigen like ?", $idtrafico)
                        //->addWhere("i.ca_ciuorigen like ?", $idorigen)
                        ->addWhere("i.ca_ciudestino like ?", $iddestino)
                        //->addWhere("i.ca_transportista like ?", $indicador["idlinea"])
                        ->addWhere("i.ca_idcliente like ?", $idcliente)
                        ->addWhere("i.ca_periodo_inicial < ?", $indicador["ca_fchllegada_cd"])
                        ->addWhere("i.ca_periodo_final > ?", $indicador["ca_fchllegada_cd"]);

                //echo $q->getSqlQuery();
                $idgTT = $q->fetchOne();

                //->fetchOne();
                if ($idgTT) {
                    $jsonTT = json_decode($idgTT->getCaIndicador());
                    $metaTT = $jsonTT->tiempotransito;
                } else {
                    $q1 = Doctrine::getTable("IdgClientes")
                            ->createQuery("i")
                            ->addWhere("i.ca_transporte like ?", $transporte)
                            ->addWhere("i.ca_traorigen like ?", $idtrafico)
//                        ->addWhere("i.ca_ciuorigen like ?", $idorigen)
                            ->addWhere("i.ca_ciudestino like ?", $iddestino)
                            ->addWhere("i.ca_transportista like ?", $indicador["idlinea"])
                            ->addWhere("i.ca_periodo_inicial < ?", $indicador["ca_fchllegada_cd"])
                            ->addWhere("i.ca_periodo_final > ?", $indicador["ca_fchllegada_cd"]);

                    //echo $q1->getSqlQuery();
                    $idgTT = $q1->fetchOne();
                    //->fetchOne();
                    if ($idgTT) {
                        $jsonTT = json_decode($idgTT->getCaIndicador());
                        $metaTT = $jsonTT->tiempotransito;
                    } else {
                        $q2 = Doctrine::getTable("IdgClientes")
                                ->createQuery("i")
                                ->addWhere("i.ca_transporte like ?", $transporte)
                                ->addWhere("i.ca_traorigen like ?", $idtrafico)
//                        ->addWhere("i.ca_ciuorigen like ?", $idorigen)
                                ->addWhere("i.ca_ciudestino like ?", $iddestino)
                                //->addWhere("i.ca_transportista like ?", $indicador["idlinea"])
                                ->addWhere("i.ca_periodo_inicial < ?", $indicador["ca_fchllegada_cd"])
                                ->addWhere("i.ca_periodo_final > ?", $indicador["ca_fchllegada_cd"]);

                        //echo $q1->getSqlQuery();
                        $idgTT = $q2->fetchOne();
                        if ($idgTT) {
                            $jsonTT = json_decode($idgTT->getCaIndicador());
                            $metaTT = $jsonTT->tiempotransito;
                        } else {
                            $metaTT = "SIN META";
                        }
                    }
                }

                if (!$datagtr[$mes]["porcentaje"]) {
                    $datagtr[$mes]["porcentaje"] = 0;
                }
                $gridtransito[$mes]["mes"] = $mes;

                if ($indicador["ca_fchllegada_cd"] != "" && $indicador["ca_fchsalida_eta"] != "") {
                    $indicador["t_transito"] = (strtotime($indicador["ca_fchllegada_cd"]) - strtotime($indicador["ca_fchsalida_eta"])) / 86400;
                } else {
                    $indicador["t_transito"] = 0;
                }

//echo 'meta'.$metaTT.'indicadorTT'.$indicador["t_transito"]."---";
                if ($metaTT != "SIN META") {
                    if ($indicador["t_transito"] <= $metaTT) {
                        $cumplett = 1;
                        $datagtr[$mes]["cumplel"] += 1;
                        $gridtransito[$mes]["cumple"] += 1;
                    } else {
                        $gridtransito[$mes]["nocumple"] += 1;
                        $cumplett = 0;
                    }
                } else {
                    $gridtransito[$mes]["nocumple"] += 1;
                    $cumplett = 0;
                }
//echo "cumplett".$cumplett;

                $datagtr[$mes]["totall"] += 1;

                $datazarpe[$mes]["negocios"] += 1;
                $datazarpe[$mes]["name"] = $mes;
                $gridzarpe[$mes]["mes"] = $mes;


                /**//**//**//**//**//**//**//**//**//**/
                $restazarpe = (strtotime($indicador["ca_fchsalida_eta"]) - strtotime($indicador["ca_fchsalida_ccr"])) / 86400;

                if ($restazarpe > 1) {
                    $indicador["cump_zarpe"] = 0;
                } else {
                    $indicador["cump_zarpe"] = 1;
                }

                //$indicador["cump_zarpe"] = $indicador["ca_fchsalida_eta"]." - ".$indicador["ca_fchsalida_cd"];

                if ($indicador["cump_zarpe"] == 1) {
                    $datazarpe[$mes]["cumplimientozarpe"] += 1;
                    $gridzarpe[$mes]["cumple"] += 1;
                } else {
                    $gridzarpe[$mes]["nocumple"] += 1;
                }
                $datazarpe[$mes]["porcentaje"] = round(($datazarpe[$mes]["cumplimientozarpe"] * 100) / $datazarpe[$mes]["negocios"]);

                $datallegada[$mes]["negocios"] += 1;
                $datallegada[$mes]["name"] = $mes;

                $gridllegada[$mes]["mes"] = $mes;

                $restallegada = (strtotime($indicador["ca_fchllegada_cd"]) - strtotime($indicador["ca_fchllegada_eta"])) / 86400;

                if ($restallegada > 1) {
                    $indicador["cump_llegada"] = 0;
                } else {
                    $indicador["cump_llegada"] = 1;
                }
                if ($indicador["cump_llegada"] == 1) {
                    $datallegada[$mes]["cumplimientollegada"] += 1;
                    $gridllegada[$mes]["cumple"] += 1;
                } else {
                    $gridllegada[$mes]["nocumple"] += 1;
                }
                $datallegada[$mes]["porcentaje"] = round(($datallegada[$mes]["cumplimientollegada"] * 100) / $datallegada[$mes]["negocios"]);

                $datafacturacion[$mes]["negocios"] += 1;
                $datafacturacion[$mes]["name"] = $mes;

                $gridfacturacion[$mes]["mes"] = $mes;

                $anio = explode("-", $filtros->fecha_inicio);
                $anio = $anio[0];
                $festivos = TimeUtils::getFestivos($anio);
                if ($indicador["ca_fchllegada_cd"] == $indicador["ca_fchfactura"]) {
                    $diffFchAsn = 0;
                } else {
                    $diffFchAsn = TimeUtils::workDiff($festivos, $indicador["ca_fchllegada_cd"], $indicador["ca_fchfactura"]);
                }

                //Notas: Para a?reo son 2 d?as despu?s que llega la carga.(Facturacion)
                if ($transporte == Constantes::AEREO) {
                    $meta = 2;
                } else {
                    $idcliente = $indicador["ca_idcliente"];
                    $idgclienteFact = Doctrine::getTable("IdgClientes")
                            ->createQuery("i")
                            ->addWhere("i.ca_transporte like ?", $transporte)
                            ->addWhere("i.ca_traorigen like ?", $idtrafico)
                            ->addWhere("i.ca_idcliente like ?", $idcliente)
                            ->addWhere("i.ca_periodo_inicial < ?", $indicador["ca_fchllegada_cd"])
                            ->addWhere("i.ca_periodo_final > ?", $indicador["ca_fchllegada_cd"])
                            ->fetchOne();
                    if ($idgclienteFact) {
                        $jsonf = json_decode($idgclienteFact->getCaIndicador());
                        $meta = $jsonf->idgfacturacion;
                    } else {
                        $meta = 0; // Maximo el mismo día que llega la carga
                    }
                }

                if ($diffFchAsn <= $meta) {
                    $cf = 1;
                    $datafacturacion[$mes]["cumplimientollegada"] += 1;
                    $gridfacturacion[$mes]["cumple"] += 1;
                } else {
                    $cf = 0;
                    $gridfacturacion[$mes]["nocumple"] += 1;
                }
                $datafacturacion[$mes]["porcentaje"] = round(($datafacturacion[$mes]["cumplimientollegada"] * 100) / $datafacturacion[$mes]["negocios"]);

                $metav = 0;
                if ($indicador["modalidad"] == "LCL" || $indicador["mod"] == "COLOADING") {

                    if ($indicador["mod"] == "COLOADING") {
                        $metav = 3;
                    } else {
                        $caso = "CU268";
                        $muelle = ParametroTable::retrieveByCaso($caso, null, null, $indicador["idmuelle"]);
                        if ($muelle) {
                            $nombremuelle = $muelle[0]["ca_valor"];
                        }
                        $idgclienteVac = Doctrine::getTable("IdgClientes")
                                ->createQuery("i")
                                ->addWhere("i.ca_transporte like ?", $transporte)
                                ->addWhere("i.ca_ciudestino like ?", $iddestino)
                                ->addWhere("i.ca_periodo_inicial < ?", $indicador["ca_fchllegada_cd"])
                                ->addWhere("i.ca_periodo_final > ?", $indicador["ca_fchllegada_cd"])
                                ->addWhere("i.ca_muelle like ?", $indicador["idmuelle"])
                                ->fetchOne();
                        if ($idgclienteVac) {
                            $jsonv = json_decode($idgclienteVac->getCaIndicador());
                            $metav = $jsonv->idgvaciado;
                        } else {
                            $metav = 2;
                        }
                    }

                    $datavaciado[$mes]["negocios"] += 1;
                    $datavaciado[$mes]["name"] = $mes;
                    $gridvaciado[$mes]["mes"] = $mes;

                    if ($indicador["ca_fchvaciado"] == "" || $indicador["ca_fchllegada_cd"] == "") {
                        $restavaciado = 0;
                    } else {
                        $restavaciado = (strtotime($indicador["ca_fchvaciado"]) - strtotime($indicador["ca_fchllegada_cd"])) / 86400;
                    }

                    if ($restavaciado <= $metav) {
                        $indicador["cump_vaciado"] = 1;
                    } else {
                        $indicador["cump_vaciado"] = 0;
                    }

                    if ($indicador["cump_vaciado"] == 1) {
                        $datavaciado[$mes]["cumplimientollegada"] += 1;
                        $gridvaciado[$mes]["cumple"] += 1;
                    } else {
                        $gridvaciado[$mes]["nocumple"] += 1;
                    }
                    $datavaciado[$mes]["porcentaje"] = round(($datavaciado[$mes]["cumplimientollegada"] * 100) / $datavaciado[$mes]["negocios"]);
                }

                $cumplevaciado = "0";
                if ($indicador["modalidad"] == "LCL" && $indicador["cump_vaciado"] != "")
                    $cumplevaciado = "1";


                $reporteneg = Doctrine::getTable("Reporte")->find($indicador["ca_idreporte"]);

                if ($reporteneg) {
                    $obstt = $reporteneg->getProperty("idg2");
                    $obszarpe = $reporteneg->getProperty("idg3");
                    $obsllegada = $reporteneg->getProperty("idg4");
                    $obsfactura = $reporteneg->getProperty("idg5");
                    $obsdesconsolidacion = $reporteneg->getProperty("idg6");
                }

                $gridindicadores[] = array(
                    "obstt" => utf8_encode($obstt),
                    "obszarpe" => utf8_encode($obszarpe),
                    "obsllegada" => utf8_encode($obsllegada),
                    "obsfactura" => utf8_encode($obsfactura),
                    "obsdesconsolidacion" => utf8_encode($obsdesconsolidacion),
                    "anio" => utf8_encode($indicador["ca_ano"]),
                    "mes" => utf8_encode($mes),
                    "reporte" => utf8_encode($indicador["ca_idreporte"]),
                    "consecutivo" => utf8_encode($indicador["ca_consecutivo"]),
                    "orden" => utf8_encode($indicador["ca_orden_clie"]),
                    "doctransporte" => utf8_encode($indicador["ca_doctransporte"]),
                    "traorigen" => utf8_encode($indicador["ca_traorigen"]),
                    "ciuorigen" => utf8_encode($indicador["ca_ciuorigen"]),
                    "destino" => utf8_encode($indicador["ca_ciudestino"]),
                    "line" => utf8_encode($indicador["ca_linea"]),
                    "cido" => utf8_encode($indicador["ca_ciuorigen"]),
                    "modalidad" => utf8_encode($indicador["modalidad"]),
                    "piezas" => utf8_encode($piezas[0]),
                    "peso" => utf8_encode($peso[0]),
                    "muelle" => utf8_encode($nombremuelle),
                    "volumen" => floatval($volumen[0]),
                    "teus" => utf8_encode($indicador["ca_teus"]),
                    "proveedor" => $proovedor,
                    "incoterms" => utf8_encode($indicador["ca_incoterms"]),
                    "factura" => utf8_encode($indicador["ca_factura"]),
                    "fch_salida" => utf8_encode($indicador["ca_fchsalida_cd"]),
                    "fch_llegada" => utf8_encode($indicador["ca_fchllegada_cd"]),
                    "fch_zarpe" => utf8_encode($indicador["ca_fchsalida_ccr"]),
                    "fch_eta" => utf8_encode($indicador["ca_fchllegada_eta"]),
                    "fch_factura" => utf8_encode($indicador["ca_fchfactura"]),
                    "fch_vaciado" => utf8_encode($indicador["ca_fchvaciado"]),
                    "fch_disponible" => utf8_encode($indicador["carga_disponible"]),
                    "cumplett" => $cumplett,
                    "cumplezarpe" => utf8_encode($indicador["cump_zarpe"]),
                    "cumplellegada" => utf8_encode($indicador["cump_llegada"]),
                    "cumplefacturacion" => utf8_encode($cf),
                    "cumplevaciado" => utf8_encode($indicador["cump_vaciado"]),
                    "cumplecoor" => utf8_encode($cumpleco),
                    "metazarpe" => utf8_encode("1"),
                    "metallegada" => utf8_encode("1"),
                    "metavaciado" => utf8_encode($metav),
                    "metafacturacion" => utf8_encode($meta),
                    "metatransito" => utf8_encode($metaTT),
                    "idgzarpe" => utf8_encode($restazarpe),
                    "idgllegada" => utf8_encode((strtotime($indicador["ca_fchllegada_cd"]) - strtotime($indicador["ca_fchllegada_eta"])) / 86400),
                    "idgvaciado" => utf8_encode($restavaciado),
                    "idgtiempotransito" => utf8_encode($indicador["t_transito"]),
                    "idgfacturacion" => utf8_encode($diffFchAsn),
                    "empresa" => utf8_encode($indicador["ca_compania"]),
                    "restazarpe" => $restazarpe
                );
            }

            foreach ($serieTraf as $traf) {
                $model["name"] = $traf;
            }

            foreach ($datag1 as $mes => $gridTrafico) {
                foreach ($serieTraf as $trafico) {


                    if ($gridTrafico[$trafico]) {
                        $data5[$mes]["name"] = $mes;
                        $data5[$mes][$trafico] = $gridTrafico[$trafico];
                    } else {
                        $data5[$mes]["name"] = $mes;
                        $data5[$mes][$trafico] = null;
                    }
                }
            }

            foreach ($datag1fcl as $mes => $gridTrafico) {
                foreach ($serieTraf as $trafico) {
                    if ($gridTrafico[$trafico]) {
                        $data8[$mes]["name"] = $mes;
                        $data8[$mes][$trafico] = $gridTrafico[$trafico];
                    } else {
                        $data8[$mes]["name"] = $mes;
                        $data8[$mes][$trafico] = null;
                    }
                }
            }

            foreach ($gridemba as $mes => $emb) {
                $gridembarque[] = $emb;
            }
            foreach ($data5 as $mes => $gridSerie) {
                $data4[] = $gridSerie;
            }
            foreach ($data8 as $mes => $gridSerie) {
                $datosFCL[] = $gridSerie;
            }

            $datat = array();
            $modelgrafica2 = array();
            foreach ($serieTraf as $trafico) {
                $modelgrafica2[] = array("name" => $trafico, "type" => "integer");
            }
            $modelgrafica2[] = array("name" => "name", "type" => "string");
            $modelgrafica2[] = array("name" => "porcentaje", "type" => "integer");

            foreach ($datagtr as $mes => $gridTrafico) {
                foreach ($serieTraf as $trafico) {

                    if ($gridTrafico[$trafico]) {
                        $datat[$mes]["name"] = $mes;
                        $datat[$mes][$trafico] = $gridTrafico[$trafico];
                        $datat[$mes]["porc"] += $gridTrafico[$trafico];
                    } else {
                        $datat[$mes]["name"] = $mes;
                        $datat[$mes][$trafico] = null;
                    }
                }

                $datat[$mes]["porcentaje"] = round((($datagtr[$mes]["cumplel"] * 100) / $datagtr[$mes]["totall"]), 2);
            }
            $datostransito = array();
            foreach ($datat as $traf => $negocios) {
                $datostransito[] = $negocios;
            }
            $coorembarque = array();
            foreach ($datacoord as $traf => $em) {
                $em['porcentaje'] = round(($em["cumple"] * 100 ) / $em["negocios"], 1);
                $coorembarque[] = $em;
            }

            $zarpe = array();
            foreach ($datazarpe as $traf => $zar) {
                $zarpe[] = $zar;
            }
            $llegada = array();
            foreach ($datallegada as $traf => $lleg) {
                $llegada[] = $lleg;
            }
            $facturacion = array();
            foreach ($datafacturacion as $traf => $fact) {
                $facturacion[] = $fact;
            }
            $vaciado = array();
            foreach ($datavaciado as $traf => $vac) {
                $vaciado[] = $vac;
            }
            $empresas = array();
            foreach ($datosempresas as $emp => $neg) {
                $empresas[] = $neg;
            }
            $datosvaciado = array();
            foreach ($gridvaciado as $va => $datos) {
                $datosvaciado[] = $datos;
            }
            $datosfacturacion = array();
            foreach ($gridfacturacion as $fa => $datosf) {
                $datosfacturacion[] = $datosf;
            }
            $datosllegada = array();
            foreach ($gridllegada as $lle => $datosll) {
                $datosllegada[] = $datosll;
            }
            $datoszarpe = array();
            foreach ($gridzarpe as $za => $datosza) {
                $datoszarpe[] = $datosza;
            }
            $datostransit = array();
            foreach ($gridtransito as $tr => $datostr) {
                $datostransit[] = $datostr;
            }
            $datosvolumen = array();
            foreach ($gridvolumen as $vl => $datosvl) {
                $datosvolumen[] = $datosvl;
            }

            $datosvolumenFCL = array();
            foreach ($gridvolumenFCL as $vl => $datosvl) {
                $datosvolumenFCL[] = $datosvl;
            }

            $datospie = array();
            foreach ($gridpie as $dp => $datosp) {
                $datospie[] = $datosp;
            }
        }

        $this->responseArray = array(
            "success" => true,
            "root" => $data4,
            "datosFCL" => $datosFCL,
            "y" => $serieTraf,
            "modelgrafica2" => $modelgrafica2,
            "grafica2" => $datostransito,
            "zarpe" => $zarpe,
            "llegada" => $llegada,
            "facturacion" => $facturacion,
            "vaciado" => $vaciado,
            "datospie" => $datospie,
            "model" => $model,
            "gridvaciado" => $datosvaciado,
            "gridfacturacion" => $datosfacturacion,
            "gridllegada" => $datosllegada,
            "gridzarpe" => $datoszarpe,
            "gridtransito" => $datostransit,
            "gridvolumen" => $datosvolumen,
            "gridvolumenFCL" => $datosvolumenFCL,
            "datosgrid" => $gridindicadores,
            "griddatoscumplimiento" => $griddatoscumplimiento,
            "gridpie" => $datospie,
            "proveedores" => $proovedores,
            "coordembarque" => $coorembarque,
            "gridembarque" => $gridembarque,
            "clienteEmbarque" => $clienteEmbarque
        );
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosConceptosContenedores(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $transporte = utf8_decode($request->getParameter("idtransporte"));
        $modalidad = $request->getParameter("modalidad");
        $tipo = $request->getParameter("tipo");
        
        if($request->getParameter("idreporte")>0)
        {
            $idreporte = $request->getParameter("idreporte");
            $reporte = Doctrine::getTable("Reporte")->find($idreporte);
            if($reporte)
                $modalidad=$reporte->getCaModalidad();
        }
        //617730
        //echo $transporte."<br>".$modalidad;
        $q = Doctrine_Query::create()
                ->select("c.ca_idconcepto, c.ca_concepto, c.ca_transporte, c.ca_modalidad, c.ca_liminferior")
                ->from("Concepto c")
                ->addWhere("c.ca_transporte=?", $transporte)
                ->addOrderBy("c.ca_liminferior")
                ->addOrderBy("c.ca_concepto");

        if($tipo === "ino" && $transporte == Constantes::MARITIMO){
            if($modalidad==Constantes::LCL)
                $q->addWhere("c.ca_modalidad=?", Constantes::FCL);
            else if($modalidad== Constantes::COLOADING)
                    $q->addWhere("c.ca_idconcepto=?", 209 ); // TM/3
            else
                $q->addWhere("c.ca_modalidad=?", $modalidad);            
            
        }else if ($tipo === "ino" && $transporte == Constantes::TERRESTRE){
            if($modalidad=="DIRECTO")
                $q->addWhere("c.ca_modalidad=?", Constantes::FCL);
            else
                $q->addWhere("c.ca_modalidad=?", $modalidad);
        }else
            $q->addWhere("c.ca_modalidad=?", $modalidad);
        
        $q->fetchArray();

        $debug = $q->getSqlQuery();
        $conceptos = $q->execute();

        $data = array();
        foreach ($conceptos as $concepto) {
            $data[] = array("idconcepto" => $concepto['ca_idconcepto'],
                "concepto" => utf8_encode($concepto['ca_concepto']),
                "transporte" => utf8_encode($concepto['ca_transporte']),
                "modalidad" => utf8_encode($concepto['ca_modalidad'])
            );
        }
        $this->responseArray = array("success" => true, "root" => $data, "debug"=>$debug);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosContactos(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idcliente = $request->getParameter("idcliente");

        $cliente = Doctrine::getTable("Cliente")->find($idcliente);
        $contactos = $cliente->getContacto();

        $data = array();
        foreach ($contactos as $contacto) {
            $data[] = array("id" => $contacto->getCaIdcontacto(),
                "name" => utf8_encode(strtoupper($contacto->getNombre())));
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executePaisesGraficasIndicadores(sfWebRequest $request) {
        
        $cliente = json_decode($request->getParameter("cliente"));

        $idscliente = Doctrine::getTable("Ids")
                ->createQuery("i")
                ->addWhere("i.ca_id = ?", $cliente)
                ->fetchOne();

        if ($idscliente) {
            $grupo = $idscliente->getCaIdgrupo();
            if ($grupo != "") {
                $miembrosgrupo = Doctrine::getTable("Ids")
                        ->createQuery("i")
                        ->addWhere("i.ca_idgrupo = ?", $grupo)
                        ->execute();
                $clientes = array();
                foreach ($miembrosgrupo as $miembrogrupo) {
                    $clientes[] = $miembrogrupo->getCaIdalterno();
                }
            }
            $clientes[] = $cliente;


            for ($i = 0; $i < count($clientes); $i++) {
                $clientes[$i] = "'" . $clientes[$i] . "'";
            }
            $listaclientes = implode(",", $clientes);

            $filtros = json_decode($request->getParameter("filtro"));
            $transporte = $filtros->transporte;

            $filtros = json_decode($request->getParameter("filtro"));
            $transporte = utf8_decode($filtros->transporte);
            $origen = utf8_decode($filtros->origen);
            $ciudadorigen = utf8_decode($filtros->ciudadorigenopc);
            $ciudaddestino = utf8_decode($filtros->destinopc);

            $nombreorigen = Doctrine::getTable("Ciudad")->find($ciudadorigen);
            $nombredest = Doctrine::getTable("Ciudad")->find($ciudaddestino);

            $sql = "select ca_traorigen from vi_indicadores WHERE ca_transporte = '$transporte' AND ca_idcliente IN ($listaclientes)";
            if ($filtros->fecha_inicio && $filtros->fecha_fin) {
                $sql .= " AND ca_fchllegada_cd BETWEEN '$filtros->fecha_inicio' AND '$filtros->fecha_fin' ";
            }

            if ($nombreorigen) {
                $nombreorigen = $nombreorigen->getCaCiudad();
                $sql .= " and ca_ciuorigen= '$nombreorigen'";
            }
            if ($nombredest) {
                $nombredest = $nombredest->getCaCiudad();
                $sql .= " and ca_ciudestino= '$nombredest'";
            }
            if ($origen != "")
                $sql .= " and ca_idtrafico = '$origen'";

            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $indicadores = $st->fetchAll();

            $data = array();
            foreach ($indicadores as $indicador) {
                $trafico = utf8_encode($indicador["ca_traorigen"]);
                if (!in_array($trafico, $data))
                    $data[] = $trafico;
            }
            $this->responseArray = array("paises" => $data, "success" => true);
        }else {
            $this->responseArray = array("success" => false, "errorInfo" => "No existe");
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosParametrizacionIdgClientes(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idgs = Doctrine::getTable("Idgclientes")
                ->createQuery("i")
                //->addWhere("t.ca_aplicacion = ? ", "Proveedores")
                //->addOrderBy("t.ca_nombre")
                ->execute();
        $data = array();
        foreach ($idgs as $idg) {
            $nombrecliente = "";
            $nombretransportista = "";
            $nombretraficoorigen = "";
            $nombreciudaddestino = "";
            $nombremuelle = "";
            $nombretraficodestino = "";
            $nombreciudadorigen = "";
            $categoria = "";
            $idcategoria = "";

            $indicadores = json_decode($idg->getCaIndicador());
            if ($idg->getCaIdcliente() != " ") {
                $cliente = Doctrine::getTable("Ids")->find($idg->getCaIdcliente());
                if ($cliente) {
                    $nombrecliente = $cliente->getCaNombre();
                }
            }
            if ($idg->getCaTransportista() != " ") {
                $transportista = Doctrine::getTable("IdsProveedor")->find($idg->getCaTransportista());
                if ($transportista) {
                    $nombretransportista = $transportista->getIds()->getCaNombre();
                }
            }
            if ($idg->getCaTradestino() != " ") {
                $traficodestino = Doctrine::getTable("Trafico")->find($idg->getCaTradestino());
                if ($traficodestino) {
                    $nombretraficodestino = $traficodestino->getCaNombre();
                }
            }
            if ($idg->getCaTraorigen() != " ") {
                $traficoorigen = Doctrine::getTable("Trafico")->find($idg->getCaTraorigen());
                if ($traficoorigen) {
                    $nombretraficoorigen = $traficoorigen->getCaNombre();
                }
            }
            if ($idg->getCaCiudestino() != " ") {
                $ciudaddestino = Doctrine::getTable("Ciudad")->find($idg->getCaCiudestino());
                if ($ciudaddestino) {
                    $nombreciudaddestino = $ciudaddestino->getCaCiudad();
                }
            }
            if ($idg->getCaCiuorigen() != " ") {
                $ciudadorigen = Doctrine::getTable("Ciudad")->find($idg->getCaCiuorigen());
                if ($ciudadorigen) {
                    $nombreciudadorigen = $ciudadorigen->getCaCiudad();
                }
            }
            if ($idg->getCaMuelle() != " ") {
                $caso = "CU268";
                $muelle = ParametroTable::retrieveByCaso($caso, null, null, $idg->getCaMuelle());
                if ($muelle) {
                    $nombremuelle = $muelle[0]["ca_valor"];
                    $idmuelle = $muelle[0]["ca_identificacion"];
                }
            }

            $days = 0;

            if ($indicadores->idgvaciado && $indicadores->idgvaciado != "") {
                $categoria = "Vaciado";
                $idcategoria = 1;
                $days = $indicadores->idgvaciado;
            }
            if ($indicadores->idgfacturacion && $indicadores->idgfacturacion != "") {
                $categoria = "Facturacion";
                $idcategoria = 2;
                $days = $indicadores->idgfacturacion;
            }
            if ($indicadores->tiempotransito && $indicadores->tiempotransito != "") {
                $categoria = "Tiempo de Transito";
                $idcategoria = 3;
                $days = $indicadores->tiempotransito;
            }
            if ($indicadores->coordinacion && $indicadores->coordinacion != "") {
                $categoria = "Coord. de Embarque";
                $idcategoria = 4;
                $days = $indicadores->coordinacion;
            }

            $data[] = array(
                "consecutivo" => utf8_encode($idg->getCaConsecutivo()),
                "transporte" => utf8_encode($idg->getCaTransporte()),
                "origen" => utf8_encode($nombretraficoorigen),
                "destino" => utf8_encode($nombreciudaddestino),
                "ciudadorigen" => utf8_encode($nombreciudadorigen),
                "traficodestino" => utf8_encode($nombretraficodestino),
                "transportista" => utf8_encode($nombretransportista),
                "cliente" => utf8_encode($nombrecliente),
                "periodo_inicial" => utf8_encode($idg->getCaPeriodoInicial()),
                "periodo_final" => utf8_encode($idg->getCaPeriodoFinal()),
                "vaciado" => utf8_encode($indicadores->idgvaciado),
                "facturacion" => utf8_encode($indicadores->idgfacturacion),
                "tiempotransito" => utf8_encode($indicadores->tiempotransito),
                "coordinacion" => utf8_encode($indicadores->coordinacion),
                "muelle" => utf8_encode($nombremuelle),
                "idmuelle" => utf8_encode($idmuelle),
                "categoria" => utf8_encode($categoria),
                "idcategoria" => utf8_encode($idcategoria),
                "idciudestino" => utf8_encode($idg->getCaCiudestino()),
                "dias" => utf8_encode($days)
            );
        }
        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarIdgCliente(sfWebRequest $request) {
        
        $tipo = $request->getParameter("tipo");
        $transporte = ($request->getParameter("transporte") && $request->getParameter("transporte") != "") ? utf8_decode($request->getParameter("transporte")) : " ";
        $origen = ($request->getParameter("origen") && $request->getParameter("origen") != "") ? utf8_decode($request->getParameter("origen")) : " ";
        $destino = ($request->getParameter("destino") && $request->getParameter("destino") != "") ? utf8_decode($request->getParameter("destino")) : " ";
        $transportista = ($request->getParameter("transportista") && $request->getParameter("transportista") != "") ? utf8_decode($request->getParameter("transportista")) : " ";
        $idcliente = ($request->getParameter("cliente") && $request->getParameter("cliente") != "") ? utf8_decode($request->getParameter("cliente")) : " ";
        $periodo_inicial = ($request->getParameter("f_inicio") && $request->getParameter("f_inicio") != "") ? utf8_decode($request->getParameter("f_inicio")) : " ";
        $periodo_final = ($request->getParameter("f_fin") && $request->getParameter("f_fin") != "") ? utf8_decode($request->getParameter("f_fin")) : " ";
        $muelle = ($request->getParameter("muelle") && $request->getParameter("muelle") != "") ? utf8_decode($request->getParameter("muelle")) : " ";
        $ciudadorigen = ($request->getParameter("ciudadorigen") && $request->getParameter("ciudadorigen") != "") ? utf8_decode($request->getParameter("ciudadorigen")) : " ";
        $traficodestino = " ";
        if ($destino != " ") {
            $trafico = Doctrine::getTable("Ciudad")->find($destino);
            $traficodestino = $trafico->getCaIdtrafico();
        }
        if ($tipo == "vaciado") {
            $dias = $request->getParameter("dias");
            $idgClientes = Doctrine::getTable("IdgClientes")
                    ->createQuery("i")
                    ->addWhere("i.ca_transporte like ? ", $transporte)
                    ->addWhere("i.ca_traorigen like ? ", $origen)
                    ->addWhere("i.ca_ciudestino like ? ", $destino)
                    ->addWhere("i.ca_transportista like ? ", $transportista)
                    ->addWhere("i.ca_idcliente like ? ", $idcliente)
                    ->addWhere("i.ca_muelle like ?", $muelle)
                    ->addWhere("i.ca_tradestino like ? ", $traficodestino)
                    ->addWhere("i.ca_ciuorigen like ? ", $ciudadorigen)
                    ->execute();
            if (count($idgClientes) > 0) {
                $todaslasfechas = array();
                foreach ($idgClientes as $idgCliente) {
                    $finicIDG = strtotime($idgCliente->getCaPeriodoInicial());
                    $ffinIDG = strtotime($idgCliente->getCaPeriodoFinal());

                    $todaslasfechas[] = date('Y-m-d', $finicIDG);
                    while ($finicIDG < $ffinIDG) {
                        $finicIDG += 86400; // add 24 hours
                        $todaslasfechas[] = date('Y-m-d', $finicIDG);
                    }
                }
                $finiForm = $periodo_inicial;
                $ffinForm = $periodo_final;

                for ($i = 0; $i < count($todaslasfechas); $i++) {
                    if (( $finiForm == $todaslasfechas[$i]) || ( $ffinForm == $todaslasfechas[$i])) {
                        $error = 1;
                    }
                }

                if ($error == 1) {
                    $this->responseArray = array("success" => false, "messagge" => "Ya existe un campo similar en este periodo");
                } else {
                    $idgCliente = new Idgclientes();
                    $idgCliente->setCaTransporte($transporte);
                    $idgCliente->setCaTraorigen($origen);
                    $idgCliente->setCaCiudestino($destino);
                    $idgCliente->setCaTransportista($transportista);
                    $idgCliente->setCaIdcliente($idcliente);
                    $idgCliente->setCaPeriodoInicial($periodo_inicial);
                    $idgCliente->setCaPeriodoFinal($periodo_final);
                    $idgCliente->setCaMuelle($muelle);
                    $idgCliente->setCaTradestino($traficodestino);
                    $idgCliente->setCaCiuorigen($ciudadorigen);
                    $json = array('idgvaciado' => $dias);
                    $json = json_encode($json);
                    $idgCliente->setCaIndicador($json);
                    $idgCliente->save();
                    $this->responseArray = array("success" => true);
                }
            } else {
                $idgCliente = new Idgclientes();
                $idgCliente->setCaTransporte($transporte);
                $idgCliente->setCaTraorigen($origen);
                $idgCliente->setCaCiudestino($destino);
                $idgCliente->setCaTransportista($transportista);
                $idgCliente->setCaIdcliente($idcliente);
                $idgCliente->setCaPeriodoInicial($periodo_inicial);
                $idgCliente->setCaPeriodoFinal($periodo_final);
                $idgCliente->setCaMuelle($muelle);
                $idgCliente->setCaTradestino($traficodestino);
                $idgCliente->setCaCiuorigen($ciudadorigen);
                $json = array('idgvaciado' => $dias);
                $json = json_encode($json);
                $idgCliente->setCaIndicador($json);
                $idgCliente->save();
                $this->responseArray = array("success" => true);
            }
        }
        if ($tipo == "facturacion") {
            $dias = $request->getParameter("dias");
            $idgClientes = Doctrine::getTable("IdgClientes")
                    ->createQuery("i")
                    ->addWhere("i.ca_transporte like ? ", $transporte)
                    ->addWhere("i.ca_traorigen like ? ", $origen)
                    ->addWhere("i.ca_ciudestino like ? ", $destino)
                    ->addWhere("i.ca_transportista like ? ", $transportista)
                    ->addWhere("i.ca_idcliente like ? ", $idcliente)
                    ->addWhere("i.ca_muelle like ?", $muelle)
                    ->addWhere("i.ca_tradestino like ? ", $traficodestino)
                    ->addWhere("i.ca_ciuorigen like ? ", $ciudadorigen)
                    ->execute();
            if (count($idgClientes) > 0) {
                $todaslasfechas = array();
                foreach ($idgClientes as $idgCliente) {
                    $finicIDG = strtotime($idgCliente->getCaPeriodoInicial());
                    $ffinIDG = strtotime($idgCliente->getCaPeriodoFinal());

                    $todaslasfechas[] = date('Y-m-d', $finicIDG);
                    while ($finicIDG < $ffinIDG) {
                        $finicIDG += 86400; // add 24 hours
                        $todaslasfechas[] = date('Y-m-d', $finicIDG);
                    }
                }
                $finiForm = $periodo_inicial;
                $ffinForm = $periodo_final;

                for ($i = 0; $i < count($todaslasfechas); $i++) {
                    if (( $finiForm == $todaslasfechas[$i]) || ( $ffinForm == $todaslasfechas[$i])) {
                        $error = 1;
                    }
                }

                if ($error == 1) {
                    $this->responseArray = array("success" => false, "messagge" => "Ya existe un campo similar en este periodo");
                } else {
                    $idgCliente = new Idgclientes();
                    $idgCliente->setCaTransporte($transporte);
                    $idgCliente->setCaTraorigen($origen);
                    $idgCliente->setCaCiudestino($destino);
                    $idgCliente->setCaTransportista($transportista);
                    $idgCliente->setCaIdcliente($idcliente);
                    $idgCliente->setCaPeriodoInicial($periodo_inicial);
                    $idgCliente->setCaPeriodoFinal($periodo_final);
                    $idgCliente->setCaMuelle($muelle);
                    $idgCliente->setCaTradestino($traficodestino);
                    $idgCliente->setCaCiuorigen($ciudadorigen);
                    $json = array('idgfacturacion' => $dias);
                    $json = json_encode($json);
                    $idgCliente->setCaIndicador($json);
                    $idgCliente->save();
                    $this->responseArray = array("success" => true);
                }
            } else {
                $idgCliente = new Idgclientes();
                $idgCliente->setCaTransporte($transporte);
                $idgCliente->setCaTraorigen($origen);
                $idgCliente->setCaCiudestino($destino);
                $idgCliente->setCaTransportista($transportista);
                $idgCliente->setCaIdcliente($idcliente);
                $idgCliente->setCaPeriodoInicial($periodo_inicial);
                $idgCliente->setCaPeriodoFinal($periodo_final);
                $idgCliente->setCaMuelle($muelle);
                $idgCliente->setCaCiuorigen($ciudadorigen);
                $idgCliente->setCaTradestino($traficodestino);
                $json = array('idgfacturacion' => $dias);
                $json = json_encode($json);
                $idgCliente->setCaIndicador($json);
                $idgCliente->save();
                $this->responseArray = array("success" => true);
            }
        }
        if ($tipo == "tiempotransito") {
            $dias = $request->getParameter("dias");
            $idgClientes = Doctrine::getTable("IdgClientes")
                    ->createQuery("i")
                    ->addWhere("i.ca_transporte like ? ", $transporte)
                    ->addWhere("i.ca_traorigen like ? ", $origen)
                    ->addWhere("i.ca_ciudestino like ? ", $destino)
                    ->addWhere("i.ca_transportista like ? ", $transportista)
                    ->addWhere("i.ca_idcliente like ? ", $idcliente)
                    ->addWhere("i.ca_muelle like ?", $muelle)
                    ->addWhere("i.ca_tradestino like ? ", $traficodestino)
                    ->addWhere("i.ca_ciuorigen like ? ", $ciudadorigen)
                    ->execute();
            if (count($idgClientes) > 0) {
                $todaslasfechas = array();
                foreach ($idgClientes as $idgCliente) {
                    $finicIDG = strtotime($idgCliente->getCaPeriodoInicial());
                    $ffinIDG = strtotime($idgCliente->getCaPeriodoFinal());

                    $todaslasfechas[] = date('Y-m-d', $finicIDG);
                    while ($finicIDG < $ffinIDG) {
                        $finicIDG += 86400; // add 24 hours
                        $todaslasfechas[] = date('Y-m-d', $finicIDG);
                    }
                }
                $finiForm = $periodo_inicial;
                $ffinForm = $periodo_final;

                for ($i = 0; $i < count($todaslasfechas); $i++) {
                    if (( $finiForm == $todaslasfechas[$i]) || ( $ffinForm == $todaslasfechas[$i])) {
                        $error = 1;
                    }
                }

                if ($error == 1) {
                    $this->responseArray = array("success" => false, "messagge" => "Ya existe un campo similar en este periodo");
                } else {
                    $idgCliente = new Idgclientes();
                    $idgCliente->setCaTransporte($transporte);
                    $idgCliente->setCatraorigen($origen);
                    $idgCliente->setCaCiudestino($destino);
                    $idgCliente->setCaTransportista($transportista);
                    $idgCliente->setCaIdcliente($idcliente);
                    $idgCliente->setCaPeriodoInicial($periodo_inicial);
                    $idgCliente->setCaPeriodoFinal($periodo_final);
                    $idgCliente->setCaMuelle($muelle);
                    $idgCliente->setCaTradestino($traficodestino);
                    $idgCliente->setCaCiuorigen($ciudadorigen);
                    $json = array('tiempotransito' => $dias);
                    $json = json_encode($json);
                    $idgCliente->setCaIndicador($json);
                    $idgCliente->save();
                    $this->responseArray = array("success" => true);
                }
            } else {
                $idgCliente = new Idgclientes();
                $idgCliente->setCaTransporte($transporte);
                $idgCliente->setCaTraorigen($origen);
                $idgCliente->setCaCiudestino($destino);
                $idgCliente->setCaTransportista($transportista);
                $idgCliente->setCaIdcliente($idcliente);
                $idgCliente->setCaPeriodoInicial($periodo_inicial);
                $idgCliente->setCaPeriodoFinal($periodo_final);
                $idgCliente->setCaMuelle($muelle);
                $json = array('tiempotransito' => $dias);
                $json = json_encode($json);
                $idgCliente->setCaIndicador($json);
                $idgCliente->setCaCiuorigen($ciudadorigen);
                $idgCliente->setCaTradestino($traficodestino);
                $idgCliente->save();
                $this->responseArray = array("success" => true);
            }
        }
        if ($tipo == "coordinacion") {
            $dias = $request->getParameter("dias");
            $idgClientes = Doctrine::getTable("IdgClientes")
                    ->createQuery("i")
                    ->addWhere("i.ca_transporte like ? ", $transporte)
                    ->addWhere("i.ca_traorigen like ? ", $origen)
                    ->addWhere("i.ca_ciudestino like ? ", $destino)
                    ->addWhere("i.ca_transportista like ? ", $transportista)
                    ->addWhere("i.ca_idcliente like ? ", $idcliente)
                    ->addWhere("i.ca_muelle like ?", $muelle)
                    ->addWhere("i.ca_tradestino like ? ", $traficodestino)
                    ->addWhere("i.ca_ciuorigen like ? ", $ciudadorigen)
                    ->execute();

            // print_r(count($idgClientes));
            // exit;

            if (count($idgClientes) > 0) {
                $todaslasfechas = array();
                foreach ($idgClientes as $idgCliente) {
                    $finicIDG = strtotime($idgCliente->getCaPeriodoInicial());
                    $ffinIDG = strtotime($idgCliente->getCaPeriodoFinal());

                    $todaslasfechas[] = date('Y-m-d', $finicIDG);
                    while ($finicIDG < $ffinIDG) {
                        $finicIDG += 86400; // add 24 hours
                        $todaslasfechas[] = date('Y-m-d', $finicIDG);
                    }
                }
                $finiForm = $periodo_inicial;
                $ffinForm = $periodo_final;

                for ($i = 0; $i < count($todaslasfechas); $i++) {
                    if (( $finiForm == $todaslasfechas[$i]) || ( $ffinForm == $todaslasfechas[$i])) {
                        $error = 1;
                    }
                }

                if ($error == 1) {
                    $this->responseArray = array("success" => false, "messagge" => "Ya existe un campo similar en este periodo");
                } else {
                    $idgCliente = new Idgclientes();
                    $idgCliente->setCaTransporte($transporte);
                    $idgCliente->setCaTraorigen($origen);
                    $idgCliente->setCaCiudestino($destino);
                    $idgCliente->setCaTransportista($transportista);
                    $idgCliente->setCaIdcliente($idcliente);
                    $idgCliente->setCaPeriodoInicial($periodo_inicial);
                    $idgCliente->setCaPeriodoFinal($periodo_final);
                    $idgCliente->setCaMuelle($muelle);
                    $idgCliente->setCaTradestino($traficodestino);
                    $idgCliente->setCaCiuorigen($ciudadorigen);
                    $json = array('coordinacion' => $dias);
                    $json = json_encode($json);
                    $idgCliente->setCaIndicador($json);
                    $idgCliente->save();
                    $this->responseArray = array("success" => true);
                }
            } else {
                $idgCliente = new Idgclientes();
                $idgCliente->setCaTransporte($transporte);
                $idgCliente->setCaTraorigen($origen);
                $idgCliente->setCaCiudestino($destino);
                $idgCliente->setCaTransportista($transportista);
                $idgCliente->setCaIdcliente($idcliente);
                $idgCliente->setCaPeriodoInicial($periodo_inicial);
                $idgCliente->setCaPeriodoFinal($periodo_final);
                $idgCliente->setCaMuelle($muelle);
                $idgCliente->setCaTradestino($traficodestino);
                $idgCliente->setCaCiuorigen($ciudadorigen);
                $json = array('coordinacion' => $dias);
                $json = json_encode($json);
                $idgCliente->setCaIndicador($json);
                $idgCliente->save();
                $this->responseArray = array("success" => true);
            }
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarParametroIdgClientes(sfWebRequest $request) {
        $consecutivo = $request->getParameter("consecutivo");
        $idgCliente = Doctrine::getTable("IdgClientes")->find($consecutivo);
        if ($idgCliente) {
            $idgCliente->delete();
            $this->responseArray = array("success" => true);
        } else {
            $this->responseArray = array("success" => false, "responseInfo" => "Error al eliminar");
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarObservacionesIdg(sfWebRequest $request) {
        $idreporte = $request->getParameter("idreporte");
        $reporte = Doctrine::getTable("Reporte")->find($idreporte);
        if ($reporte) {
            $tipoidg = "idg" . $request->getParameter("tipoidg");
            $reporte->setProperty($tipoidg, utf8_decode($this->getRequestParameter("observ")));
            $reporte->save();
            $this->responseArray = array("success" => true);
        } else {
            $this->responseArray = array("success" => false, "errorInfo" => "Imposible almacenar");
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosComboListaReferencias(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');

        $criterio = $this->getRequestParameter("query");
        $impoexpo = utf8_decode($request->getParameter("impoexpo"));
        $transporte = utf8_decode($request->getParameter("transporte"));

        try{
            $q = Doctrine::getTable("InoMaster")
                    ->createQuery("m")
                    ->leftJoin("m.Origen o")
                    ->leftJoin("m.Destino d")
                    ->addWhere("m.ca_referencia LIKE ? AND m.ca_usuanulado IS NULL AND m.ca_usuliquidado IS NULL AND m.ca_usucerrado IS NULL", $criterio . "%")
                    ->orderBy("m.ca_idmaster DESC")
                    ->limit(50)
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

            if ($transporte) {
                $q->addWhere("m.ca_transporte = ?", $transporte);
            }

            if ($impoexpo) {
                $q->addWhere("m.ca_impoexpo = ?", $impoexpo);
            }

            $debug = $q->getSqlQuery();
            $refs = $q->execute();

            foreach ($refs as $k => $c) {
                $refs[$k]["m_ca_impoexpo"] = utf8_encode($refs[$k]["m_ca_impoexpo"]);
                $refs[$k]["m_ca_transporte"] = utf8_encode($refs[$k]["m_ca_transporte"]);
                $refs[$k]["o_ca_ciudad"] = utf8_encode($refs[$k]["o_ca_ciudad"]);
                $refs[$k]["o_ca_puerto"] = utf8_encode($refs[$k]["o_ca_puerto"]);
                $refs[$k]["d_ca_ciudad"] = utf8_encode($refs[$k]["d_ca_ciudad"]);
                $refs[$k]["d_ca_puerto"] = utf8_encode($refs[$k]["d_ca_puerto"]);
                $refs[$k]["m_ca_master"] = utf8_encode($refs[$k]["m_ca_master"]);
                $refs[$k]["m_ca_observaciones"] = utf8_encode($refs[$k]["m_ca_observaciones"]);
                $refs[$k]["m_ca_motonave"] = utf8_encode($refs[$k]["m_ca_motonave"]);
                $refs[$k]["m_ca_motivoanulado"] = utf8_encode($refs[$k]["m_ca_motivoanulado"]);
                $refs[$k]["m_ca_datos"] = utf8_encode($refs[$k]["m_ca_datos"]);
            }

            //echo "<pre>";print_r($refs);echo "</pre>";
            $this->responseArray = array("success" => true, "root" => $refs, "total" => count($refs), "debug" => $debug);
        } catch(Exception $e) {
            $this->responseArray = array("root" => array(), "total" => 0, "success" => false, "errorInfo"=>$e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosComerciales(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $comerciales = UsuarioTable::getComerciales();
        $data = array();
        foreach ($comerciales as $comercial) {
            $data[] = array("login" => $comercial->getCaLogin(),
                "nombre" => utf8_encode($comercial->getCaNombre())
            );
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosUsuarios(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $con = Doctrine_Manager::getInstance()->connection();
        $perfil = $request->getParameter("perfil");

        $sql = "select distinct ca_login from control.tb_usuarios_perfil where ca_perfil like '%$perfil%' order by 1";
        $st = $con->execute($sql);
        $perfiles = array_column($st->fetchAll(), 'ca_login');
        $q = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->select("u.*")
                ->addWhere("u.ca_activo = true")
                ->addOrderBy("u.ca_nombre");
        
        if ($perfil) {
            $q->whereIn("u.ca_login", $perfiles);
        }
        $usuarios = $q->execute();
        $data = array();
        foreach ($usuarios as $usuario) {
            $data[] = array("login" => $usuario->getCaLogin(),
                "nombre" => utf8_encode($usuario->getCaNombre())
            );
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosIdsSucursales(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idCliente = $request->getParameter("empresa");

        $sucursales = Doctrine::getTable("IdsSucursal")
                ->createQuery("i")
                ->addWhere("i.ca_id = ? and i.ca_usueliminado is null", $idCliente)
                ->execute();

        $data = array();
        foreach ($sucursales as $sucursal) {
            $descripcion = ($sucursal->getCaNombre()) ? $sucursal->getCaNombre() : $sucursal->getCaDireccion();
            $data[] = array("idsucursal" => $sucursal->getCaIdsucursal(),
                "sucursal" => utf8_encode($descripcion),
                "ciudad" => utf8_encode($sucursal->getCiudad()->getCaCiudad()),
            );
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosCoordinadoresAduana(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $usuarios = UsuarioTable::getCoordinadoresAduana();
        $data = array();

        $data[] = array("login" => '',
            "nombre" => utf8_encode("Ninguno Asignado")
        );
        foreach ($usuarios as $usuario) {
            $data[] = array("login" => $usuario->getCaLogin(),
                "nombre" => utf8_encode($usuario->getCaNombre())
            );
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosCombos(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $tipoCombo = $request->getParameter("tipoCombo");

        $caso = "CU264";
        $direcciones = ParametroTable::retrieveByCaso($caso, null, null, $tipoCombo);

        $data = array();
        $jsonArray = json_decode(utf8_encode(html_entity_decode($direcciones[0]->getCaValor2())), true);

        foreach ($jsonArray as $json) {
            if ($tipoCombo != 8) {
                $data[] = array("id" => $json["id"],
                    "nombre" => $json["name"]
                );
            } else {
                $data[] = array("id" => $json["id"],
                    "nombre" => $json["name"],
                    "localidad" => $json["localidad"]
                );
            }
        }
        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosAgentesAduana($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select * from ids.tb_proveedores p inner join ids.tb_ids i on (i.ca_id = p.ca_idproveedor) where p.ca_tipo = 'ADU' and  lower(i.ca_nombre) like '%" . strtolower($request->getParameter("q")) . "%'";

        $rs = $con->execute($sql);
        $data = array();
        $agentes_rs = $rs->fetchAll();

        foreach ($agentes_rs as $agente) {
            $data[] = array("idagencia" => $agente["ca_idproveedor"], "idalterno"=> utf8_encode($agente["ca_idalterno"]),
                "nombre" => utf8_encode($agente["ca_nombre"])
            );
        }

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));        
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosCargos(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $caso = $request->getParameter("externos") ? "CU265" : "CU266";
        $datomod = ParametroTable::retrieveByCaso($caso, null, null, null);
        $data = array();
        foreach ($datomod as $dato) {
            $data[] = array("id" => $dato["ca_identificacion"],
                "name" => utf8_encode($dato["ca_valor"]),
                "mostrar" => utf8_encode($dato["ca_valor2"]));
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosCodigos(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $caso = "CU271";
        $datomod = ParametroTable::retrieveByCaso($caso, null, null, null);
        $data = array();
        foreach ($datomod as $dato) {
            $data[] = array("id" => $dato["ca_identificacion"],
                "codigo" => utf8_encode($dato["ca_valor"]),
                "mostrar" => utf8_encode($dato["ca_valor2"]));
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosTipoSeguimiento(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $caso = "CU262";
        $datomod = ParametroTable::retrieveByCaso($caso, null, null, null);
        $data = array();
        foreach ($datomod as $dato) {
            $data[] = array("id" => $dato["ca_identificacion"],
                "name" => utf8_encode($dato["ca_valor"]));
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeSeguimientoAntecesor(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idCliente = $request->getParameter("idcliente");

        $seguimientos = Doctrine::getTable("IdsEventos")
                ->createQuery("i")
                ->addWhere('i.ca_idcliente = ?', $idCliente)
                ->addWhere('i.ca_idantecedente = 0')
                ->execute();

        $data = array();
        $data[] = array("id" => 0,
            "name" => utf8_encode("Ninguno - Seguimiento nuevo"));
        foreach ($seguimientos as $seguimiento) {
            $data[] = array("id" => $seguimiento["ca_idevento"],
                "name" => utf8_encode($seguimiento["ca_asunto"]));
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosTipoIdentificacion(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $q = Doctrine::getTable("IdsTipoIdentificacion")
                ->createQuery("i")
                ->where("i.ca_nombre <> ?", "Consecutivo Colsys");
        if ($request->getParameter("idtrafico")) {
            $q->addWhere('ca_idtrafico = ?', $request->getParameter("idtrafico"));
        }
        $identificaciones = $q->execute();

        $data = array();
        foreach ($identificaciones as $identificacion) {
            $data[] = array("id" => $identificacion["ca_tipoidentificacion"],
                "name" => utf8_encode($identificacion["ca_nombre"]),
                "idtrafico" => utf8_encode($identificacion["ca_idtrafico"]),
                "trafico" => utf8_encode($identificacion->getTrafico()->getCaNombre()));
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosSectorEconomico(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select cv.* from control.tb_config_values cv inner join control.tb_config cf on cf.ca_idconfig = cv.ca_idconfig where ca_param = 'CU257'";
        $rs = $con->execute($sql);
        $sectoresfinancieros_rs = $rs->fetchAll();
        $sectorfinanciero = array();
        foreach ($sectoresfinancieros_rs as $sector) {
            $sectorfinanciero[] = array("sector" => utf8_encode($sector["ca_value"]),
                "id" => utf8_encode($sector["ca_ident"]));
        }

        $this->responseArray = array("success" => true, "root" => $sectorfinanciero);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosRegimen(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select cv.* from control.tb_config_values cv inner join control.tb_config cf on cf.ca_idconfig = cv.ca_idconfig where ca_param = 'CU259' order by ca_ident";
        $rs = $con->execute($sql);
        $regimenes = $rs->fetchAll();
        $regimenes_arr = array();
        foreach ($regimenes as $regimen) {
            $regimenes_arr[] = array("regimen" => utf8_encode($regimen["ca_value"]),
                "id" => utf8_encode($regimen["ca_ident"]));
        }

        $this->responseArray = array("success" => true, "root" => $regimenes_arr);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosTipoPersona(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select cv.* from control.tb_config_values cv inner join control.tb_config cf on cf.ca_idconfig = cv.ca_idconfig where ca_param = 'CU227' order by ca_ident";
        $rs = $con->execute($sql);
        $tipopersona_rs = $rs->fetchAll();
        $tipopersona = array();
        foreach ($tipopersona_rs as $persona) {
            $tipopersona[] = array("tipo" => utf8_encode($persona["ca_value"]),
                "id" => utf8_encode($persona["ca_ident"]));
        }

        $this->responseArray = array("success" => true, "root" => $tipopersona);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosCombosRadicacion(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $tipoCombo = $request->getParameter("tipoCombo");

        $caso = "CU073";
        $items = ParametroTable::retrieveByCaso($caso, null, null, $tipoCombo);

        $data = array();
        foreach ($items as $item) {
            $data[] = array("nombre" => utf8_encode($item->getCaValor()),
                "valor" => utf8_encode($item->getCaValor2())
            );
        }
        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor JFNARIÑO
     * @return un objeto JSON con los datos de modalidades filtradas por impoexpo y/o transporte
     * @param sfRequest $request A request 
     *               transporte : tipo de transporte (areo. maritimo, terrestre)
     *         impoexpo : tipo impoexpo (importación, exportación, entre otros)
     *              
     * @date:  2016-03-28
     */
    public function executeDatosMuelles() {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $transport_parameter = utf8_decode($this->getRequestParameter("transporte"));
        $impoexpo_parameter = utf8_decode($this->getRequestParameter("impoexpo"));

        $q = Doctrine::getTable("Modalidad")
                ->createQuery("m");

        if ($impoexpo_parameter) {
            $q->where(" m.ca_impoexpo = ? ", $impoexpo_parameter);
        }

        if ($transport_parameter) {
            $q->addWhere("m.ca_transporte = ? ", $transport_parameter);
        }

        $q->addOrderBy("m.ca_impoexpo ASC");
        $q->addOrderBy("m.ca_transporte ASC");
        $q->addOrderBy("m.ca_modalidad ASC");

        $transportes = $q->execute();

        $modalidades = array();

        foreach ($transportes as $transporte) {
            $row = array("idmodalidad" => utf8_encode($transporte->getCaIdmodalidad()),
                "impoexpo" => utf8_encode($transporte->getCaImpoexpo()),
                "transporte" => utf8_encode($transporte->getCaTransporte()),
                "modalidad" => utf8_encode($transporte->getCaModalidad()));
            $modalidades[] = $row;
        }


        $this->responseArray = array("root" => $modalidades, "total" => count($modalidades), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosProveedorSucursal($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $query = $request->getParameter("query");
        $idempresa = $request->getParameter("idempresa");

        $q = Doctrine_Query::create()
                ->select("c.ca_ciudad,s.ca_direccion,s.ca_idsucursal,s.ca_id,ids.ca_nombre,cl.ca_propiedades, ids.ca_idalterno")
                ->from("IdsSucursal s")
                ->innerJoin("s.Ciudad c")
                ->innerJoin("s.Ids ids")
                ->leftJoin("ids.IdsProveedor p")
                ->leftJoin("ids.IdsAgente a")
                ->where("UPPER(ids.ca_nombre) like ?", "%" . strtoupper($query) . "%")
                ->addWhere("s.ca_usueliminado IS NULL")
                ->addWhere("p.ca_activo_impo = ? OR p.ca_activo_expo = ? OR a.ca_activo = ?",array(true,true,true))                
                ->andWhere("ids.ca_id IN (SELECT ca_id FROM IdsEstadoSap e WHERE e.ca_id=ids.ca_id AND e.ca_tipo IN ('A','P') AND e.ca_activo=true AND ca_idempresa='{$idempresa}' )")
                ->addOrderBy("ids.ca_nombre, c.ca_ciudad")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $debug = $q->getSqlQuery();
        $sucursales = $q->execute();
        $sucursal = array();
        //print_r($sucursales);
        foreach ($sucursales as $suc) {
            $sucursal[] = array(
                "idsucursal" => $suc["s_ca_idsucursal"],
                "ciudad" => utf8_encode($suc["c_ca_ciudad"]),
                "direccion" => utf8_encode($suc["s_ca_direccion"]),
                "id" => $suc["s_ca_id"]."-". $suc["s_ca_idsucursal"],
                "idalterno" => $suc["ids_ca_idalterno"],
                "compania" => utf8_encode($suc["ids_ca_nombre"]) /* ,
                      "cuentapago"=>$cuenta_forma_pago */
            );
        }
        $this->responseArray = array("root" => $sucursal, "total" => count($sucursal), "success" => true, "debug" => $debug);
        $this->setTemplate("responseTemplate");
    }
    
    /**
     * @autor alramirez
     * @return un objeto JSON con los items de exclusiones Idg

     * @param sfRequest $request A request 
     *        caso_uso: identificador de caso de uso.
     *       
     * @date:  2018-02-08
     */
    public function executeDatosExclusionesIdg(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        
        $impoexpo = utf8_decode(utf8_decode($request->getParameter("impoexpo")));
        $transporte = utf8_decode(utf8_decode($request->getParameter("transporte")));
        
        $id = $request->getParameter("id");
        $caso = "CU275";
        if(!$id){
        $datos = ParametroTable::retrieveByCaso($caso);
        
        $data = array();
        $data2 = array();
        $data3 = array();
        
        foreach($datos as $d){            
            $dato = $d->getCaValor2();            
            $data2[$d->getCaIdentificacion()][$d->getCaValor()] = $dato;
        }
        
        foreach($data2 as $key => $gridVal){            
            foreach($gridVal as $observacion => $val){
                $manage = (array) json_decode(utf8_decode($val));
                
                $data3[] = $manage;
                if(in_array($impoexpo, $manage["impoexpo"]) && in_array($transporte, $manage["transporte"])){
                    $data[] = array("id"=>$key, "name"=>  utf8_encode($observacion));
                }
            }
        }
        }else{
            $dato = ParametroTable::retrieveByCaso($caso,null,null,$id)->getFirst();
            $data[] = array("id"=>$dato->getCaIdentificacion(), "name"=>  utf8_encode($dato->getCaValor()));
        }
        
        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    /**
     * @autor alramirez
     * @return un objeto JSON con las etapas de los status

     * @param sfRequest $request A request 
     *        caso_uso: identificador de caso de uso.
     *       
     * @date:  2018-02-08
     */
    public function executeDatosTrackingEtapa(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        
        $transporte = $request->getParameter("transporte");
        $impoexpo = $request->getParameter("impoexpo");        
        $departamento = $request->getParameter("departamento");
        $tipo = $request->getParameter("tipo");
        
        $q = Doctrine::getTable("TrackingEtapa")
                      ->createQuery("t")                                            
                      ->where("t.ca_usueliminado IS NULL")
                      ->orderBy("ca_orden");                      
        
        if($transporte)
            $q->andWhere("t.ca_transporte = ?", $transporte);
        if($impoexpo)
            $q->addWhere("t.ca_impoexpo = ?", $impoexpo);
        if($departamento)
            $q->addWhere("t.ca_departamento = ?", $departamento);            
        
        $etapas = $q->execute();
                
        $data=array();
        foreach($etapas as $e){
            $data[]=array("id"=>$e->getCaIdetapa(),"nombre"=>utf8_encode($e->getCaEtapa()),"impoexpo"=>utf8_encode($e->getCaImpoexpo()),"departamento"=>utf8_encode($e->getCaDepartamento()),"transporte"=>utf8_encode($e->getCaTransporte()), "mensaje_default"=>utf8_encode($e->getCaMessageDefault()), "mensaje"=>utf8_encode($e->getCaMessage()));
        }
        
        if($tipo === "Status"){
            $data[]=array("id"=>"00000","nombre"=>utf8_encode("Orden Anulada"));
            $data[]=array("id"=>"88888","nombre"=>utf8_encode("Status"));
            $data[]=array("id"=>"99999","nombre"=>utf8_encode("Cierre"));
        }
        
        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosCriterios(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idproveedor = $request->getParameter("idproveedor");
        $tipo = $request->getParameter("tipo");
        $impoexpo = $request->getParameter("impoexpo");
        $transporte = $request->getParameter("transporte");
        
        if ($idproveedor) {
            $prov = Doctrine::getTable("IdsProveedor")->find($idproveedor);
            $tipo = $prov->getCaTipo();
            $impoexpo = array();
            if ($prov->getCaActivoImpo()) 
                $impoexpo[] = Constantes::IMPO;
            if ($prov->getCaActivoExpo()) 
                $impoexpo[] = Constantes::EXPO;
            $transporte = explode("|", $prov->getCaTransporte());
        }
        $criterios = Doctrine::getTable("IdsCriterio")
                ->createQuery("c")
                ->select("c.ca_idcriterio, c.ca_criterio")
                ->addWhere("c.ca_activo = true")
                ->addWhere("c.ca_tipo = ?", $tipo)
                ->whereIn("c.ca_impoexpo", $impoexpo)
                ->whereIn("c.ca_transporte", $transporte)
                ->addOrderBy("c.ca_criterio")
                ->execute();
        $data = array();
        foreach ($criterios as $criterio) {
            $data[] = array("idcriterio" => $criterio->getCaIdcriterio(),
                "criterio" => utf8_encode($criterio->getCaCriterio())
            );
        }
        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosComboReferenciasAduana(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');

        $criterio = $this->getRequestParameter("query");
        $impoexpo = utf8_decode($request->getParameter("impoexpo"));
        $transporte = utf8_decode($request->getParameter("transporte"));

        try{
            $q = Doctrine::getTable("InoMaestraAdu")
                    ->createQuery("m")
                    ->leftJoin("m.Origen o")
                    ->leftJoin("m.Destino d")
                    ->addWhere("m.ca_referencia LIKE ?", $criterio . "%")
                    ->orderBy("m.ca_referencia DESC")
                    ->limit(50)
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

            if ($transporte) {
                $q->addWhere("m.ca_transporte = ?", $transporte);
            }

            if ($impoexpo) {
                $prefijo = "";
                switch($impoexpo){
                    case 'impo';
                        $prefijo = '2';
                        break;
                    case 'expo';
                        $prefijo = '3';
                        break;
                }
                $q->addWhere("m.ca_referencia like ?", $prefijo."%");
            }

            $debug = $q->getSqlQuery();
            $refs = $q->execute();

            foreach ($refs as $k => $c) {
                $datos = json_decode(utf8_encode($refs[$k]["m_ca_datos"]));
                $refs[$k]["m_ca_idmaster"] = utf8_encode($refs[$k]["m_ca_referencia"]);
                $refs[$k]["m_ca_impoexpo"] = utf8_encode($refs[$k]["m_ca_impoexpo"]);
                $refs[$k]["m_ca_mercancia"] = utf8_encode($refs[$k]["m_ca_mercancia"]);
                $refs[$k]["m_ca_proveedor"] = utf8_encode($refs[$k]["m_ca_proveedor"]);
                $refs[$k]["m_ca_nombrecontacto"] = utf8_encode($refs[$k]["m_ca_nombrecontacto"]);
                $refs[$k]["m_ca_transporte"] = utf8_encode($refs[$k]["m_ca_transporte"]);
                $refs[$k]["o_ca_ciudad"] = utf8_encode($refs[$k]["o_ca_ciudad"]);
                $refs[$k]["o_ca_puerto"] = utf8_encode($refs[$k]["o_ca_puerto"]);
                $refs[$k]["d_ca_ciudad"] = utf8_encode($refs[$k]["d_ca_ciudad"]);
                $refs[$k]["d_ca_puerto"] = utf8_encode($refs[$k]["d_ca_puerto"]);                
                $refs[$k]["m_ca_observaciones"] = utf8_encode($refs[$k]["m_ca_observaciones"]);                
                $refs[$k]["id_modalidad"] = $datos->modalidad;   
                $refs[$k]["m_ca_datos"] = json_encode(utf8_encode($refs[$k]["m_ca_datos"]));
                
                $caso = "CU011";
                $datomod = ParametroTable::retrieveByCaso($caso, null, null, $datos->modalidad);

                $data["id_modalidad"] = $datos->modalidad;
                if ($datos->modalidad) {
                    $refs[$k]["ca_modalidad"] = utf8_encode($datomod[0]->getCaValor());
                } 
                $refs[$k]["idagencia"] = utf8_encode($datos->agencia);
                if (is_numeric($datos->agencia)) {
                    $agencia = Doctrine::getTable("Ids")->find($datos->agencia);
                    if($agencia)
                        $refs[$k]["agencia"] = utf8_encode($agencia->getCaNombre());
                }
                $refs[$k]["aplicaidg"] = utf8_encode($datos->idg);
                $refs[$k]["idreporte"] = utf8_encode($datos->idreporte);
                $refs[$k]["consecutivo"] = utf8_encode($datos->consecutivo);
                
            }

//            echo "<pre>";print_r($refs);echo "</pre>";
            $this->responseArray = array("success" => true, "root" => $refs, "total" => count($refs), "debug" => $debug);
        } catch(Exception $e) {
            $this->responseArray = array("root" => array(), "total" => 0, "success" => false, "errorInfo"=>$e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosTipoDocumentos(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $q = Doctrine::getTable("IdsTipoDocumento")
                ->createQuery("td");
                
        $tiposDocumento = $q->execute();

        $data = array();
        foreach ($tiposDocumento as $tipoDocumento) {
            $data[] = array("idtipo" => $tipoDocumento["ca_idtipo"],
                "tipo" => utf8_encode($tipoDocumento["ca_tipo"]));
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }
}
?>

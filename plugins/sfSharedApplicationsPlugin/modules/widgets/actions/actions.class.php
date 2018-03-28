<?php

/**
 * widgets actions.
 *
 * @package    colsys
 * @subpackage widgets
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class widgetsActions extends sfActions {

    /**
     * Retorna un objeto JSON con la información de todos los paises
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosPaises($request) {
        $query = utf8_decode($this->getRequestParameter("query"));

        $traficos_rs = Doctrine::getTable("Trafico")
                ->createQuery("c")
                ->where("c.ca_idtrafico != ? ", '99-999')
                ->addWhere("LOWER(c.ca_nombre) like ? ", strtolower($query) . "%")
                ->addOrderBy("c.ca_nombre")
                ->execute();

        $traficos = array();

        foreach ($traficos_rs as $trafico) {
            $row = array("idtrafico" => $trafico->getCaIdTrafico(), "trafico" => utf8_encode($trafico->getCaNombre()));
            $traficos[] = $row;
        }

        $this->responseArray = array("root" => $traficos, "total" => count($traficos), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Retorna un objeto JSON con la información de todas las ciudades
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosCiudades($request) {
        $idpais = utf8_decode($this->getRequestParameter("idpais"));
        $query = utf8_decode($this->getRequestParameter("query"));

        if (!$query) {
            $query = "%";
        }

        $ciudades_rs = Doctrine::getTable("Ciudad")
                ->createQuery("c")
                ->where("c.ca_idtrafico = ? ", $idpais)
                ->addWhere("LOWER(c.ca_ciudad) like ? ", strtolower($query) . "%")
                ->addOrderBy("c.ca_ciudad")
                ->execute();

        $ciudades = array();
        foreach ($ciudades_rs as $ciudad) {
            $row = array('idciudad' => $ciudad->getCaIdciudad(), "ciudad" => utf8_encode($ciudad->getCaCiudad()));
            $ciudades[] = $row;
        }

        $this->responseArray = array("root" => $ciudades, "total" => count($ciudades), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Retorna un objeto JSON con la información de todas las ciudades
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosCiudadesPaises($request) {
        $ciudades_rs = Doctrine::getTable("Ciudad")
                ->createQuery("c")
                ->select("c.ca_idciudad, c.ca_ciudad, c.ca_idtrafico ")
                ->addOrderBy("c.ca_idtrafico")
                ->addOrderBy("c.ca_ciudad")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();

        $ciudades = array();
        foreach ($ciudades_rs as $ciudad) {
            $row = array('idciudad' => $ciudad["c_ca_idciudad"], "ciudad" => utf8_encode($ciudad["c_ca_ciudad"]));
            $ciudades[$ciudad["c_ca_idtrafico"]][] = $row;
        }

        $this->responseArray = array("root" => $ciudades, "total" => count($ciudades), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Retorna un objeto JSON con la información de todas las lineas
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosLineas($request) {
        $idlinea = utf8_decode($request->getParameter("idlinea"));
        $transporte = utf8_decode($request->getParameter("transporte"));
        $query = utf8_decode($request->getParameter("query"));

        if ($transporte == Constantes::OTMDTA) { //FIX-ME [Actualizar los registros de la tabla para que coincidan y arreglar las cotizaciones]
            $transporte = Constantes::TERRESTRE;
            $modalidad = Constantes::OTMDTA;
        }


        $q = Doctrine_Query::create()
                ->select("p.ca_idproveedor, p.ca_sigla, id.ca_nombre, p.ca_transporte ")
                ->from("IdsProveedor p")
                ->innerJoin("p.Ids id")
                ->addOrderBy("id.ca_nombre");
        $q->addWhere("p.ca_tipo = ? OR p.ca_tipo = ?", array("TRI", "TRN"));
        if ($transporte) {
            $q->addWhere("p.ca_transporte = ?", $transporte);
        }

        if ($query) {
            $q->addWhere("id.ca_nombre like ?", $query . "%");
        }
        //$q->addWhere("p.ca_activo = ?", true );

        if ($request->getParameter("noaprob") != "true") {
            //$q->addWhere("p.ca_fchaprobado IS NOT NULL" ); //Ver Ticket # 3577
        }

        $q->fetchArray();

        $lineas = $q->execute();

        $this->lineas = array();
        foreach ($lineas as $linea) {
            $this->lineas[] = array("idlinea" => $linea['ca_idproveedor'],
                "linea" => utf8_encode(($linea['ca_sigla'] ? $linea['ca_sigla'] . " - " : "") . $linea['Ids']['ca_nombre']),
                "transporte" => utf8_encode($linea['ca_transporte']),
            );
        }

        $this->responseArray = array("root" => $this->lineas, "total" => count($this->lineas), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /*
     * Datos de las modalidades según sea el medio de transporte
     */

    public function executeDatosModalidades() {
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

        $this->modalidades = array();

        foreach ($transportes as $transporte) {
            $row = array("idmodalidad" => utf8_encode($transporte->getCaIdmodalidad()),
                "impoexpo" => utf8_encode($transporte->getCaImpoexpo()),
                "transporte" => utf8_encode($transporte->getCaTransporte()),
                "modalidad" => utf8_encode($transporte->getCaModalidad()));
            $this->modalidades[] = $row;
        }

        
        $this->responseArray = array("root" => $this->modalidades, "total" => count($this->modalidades), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /*
     * 
     */

    public function executeDatosComboClientes() {
        $criterio = $this->getRequestParameter("query");


        $rows = Doctrine_Query::create()
                ->select("cl.ca_idcliente, cl.ca_compania,
                                  cl.ca_preferencias, cl.ca_confirmar
                                  ,cl.ca_status
                                 ")
                ->from("Cliente cl")
                ->where("UPPER(cl.ca_compania) like ?", "%" . strtoupper($criterio) . "%")
                ->addOrderBy("cl.ca_compania ASC")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->limit(40)
                ->execute();

        $clientes = array();

        foreach ($rows as $row) {
            $clientes[] = array('ca_idcliente' => $row["cl_ca_idcliente"],
                'ca_compania' => utf8_encode($row["cl_ca_compania"]),
                'ca_preferencias' => utf8_encode($row["cl_ca_preferencias"]),
                'ca_confirmar' => utf8_encode($row["cl_ca_confirmar"]),
                'ca_status' => utf8_encode($row["cl_ca_status"]),
            );
        }

        $this->responseArray = array("totalCount" => count($clientes), "clientes" => $clientes);
        $this->setTemplate("responseTemplate");
    }

    /*
     * 
     */

    public function executeDatosComboReportes($request) {
        $criterio = $request->getParameter("query");


        if ($this->getRequestParameter("transporte") == Constantes::AEREO || utf8_decode($this->getRequestParameter("transporte")) == Constantes::AEREO) {
            $transporte = constantes::AEREO;
        }

        if ($this->getRequestParameter("transporte") == Constantes::MARITIMO || utf8_decode($this->getRequestParameter("transporte")) == Constantes::MARITIMO) {
            $wheretmp=" AND ca_tiporep IN (1,2,3)";
            $transporte = constantes::MARITIMO;
        }
        if ($this->getRequestParameter("transporte") == Constantes::TERRESTRE || utf8_decode($this->getRequestParameter("transporte")) == Constantes::TERRESTRE) {
            $transporte = constantes::TERRESTRE;
        }


        if ($this->getRequestParameter("impoexpo") == Constantes::IMPO || utf8_decode($this->getRequestParameter("impoexpo")) == Constantes::IMPO) {
            $impoexpo = constantes::IMPO;
        }

        if ($this->getRequestParameter("impoexpo") == Constantes::EXPO || utf8_decode($this->getRequestParameter("impoexpo")) == Constantes::EXPO) {
            $impoexpo = constantes::EXPO;
        }

        if ($this->getRequestParameter("impoexpo") == Constantes::TRIANGULACION || utf8_decode($this->getRequestParameter("impoexpo")) == Constantes::TRIANGULACION) {
            $impoexpo = constantes::TRIANGULACION;
        }
        if ($this->getRequestParameter("impoexpo") == Constantes::OTMDTA || utf8_decode($this->getRequestParameter("impoexpo")) == Constantes::OTMDTA) {
            $impoexpo = constantes::OTMDTA;
        }

        $q = Doctrine_Query::create()
                ->select("r.ca_consecutivo, r.ca_idreporte, r.ca_version, r.ca_transporte")
                ->from("Reporte r")
                ->where("UPPER(r.ca_consecutivo) LIKE ?", strtoupper($criterio) . "%")
                ->addWhere("r.ca_usuanulado IS NULL $wheretmp")
                ->addWhere("r.ca_version = (SELECT MAX(r2.ca_version) FROM Reporte r2 WHERE r2.ca_consecutivo = r.ca_consecutivo AND ca_usuanulado IS NULL $wheretmp ) ")
                ->addOrderBy("r.ca_fchcreado DESC")
                ->limit(20);

        if ($request->getParameter("extended")) {
            $q->addSelect("r.ca_login, r.ca_orden_clie");
        }

        if ($transporte) {
            if($transporte==Constantes::MARITIMO)
            {
                $q->addWhere("r.ca_transporte = ? OR r.ca_transporte = ? ", array(Constantes::MARITIMO,Constantes::TERRESTRE));
            }
            else
                $q->addWhere("r.ca_transporte = ?", $transporte);
        }

        if ($impoexpo) {
            if ($impoexpo == Constantes::IMPO) {
                $q->addWhere("r.ca_impoexpo = ? OR r.ca_impoexpo = ?", array($impoexpo, Constantes::TRIANGULACION));
            } else {
                $q->addWhere("r.ca_impoexpo = ?", array($impoexpo));
            }
        }

        if ($request->getParameter("origen")) {
            $q->addWhere("r.ca_origen = ?", $request->getParameter("origen"));
        }

        if ($request->getParameter("destino")) {
            $q->addWhere("r.ca_destino = ?", $request->getParameter("destino"));
        }

        
        if ($request->getParameter("estado") == "activo" && $this->getUser()->getUserId()!="maquinche") {
            $q->addWhere("r.ca_idetapa != ?", "99999");
        }        

        if ($request->getParameter("idcliente")) {
            $q->leftJoin("r.Contacto cc");
            $q->leftJoin("cc.Cliente cl");
            $q->addSelect("cl.ca_idcliente, cc.ca_idcontacto, cl.ca_compania");
            $q->addWhere("cl.ca_idcliente = ?", $request->getParameter("idcliente"));
        }
        
        $reportes = $q->fetchArray();

        $this->reportes = array();

        foreach ($reportes as $reporte) {

            $reporte["ca_transporte"] = utf8_encode($reporte["ca_transporte"]);    
            $reporte["ca_compania"] = utf8_encode($reporte["Contacto"]["Cliente"]["ca_compania"]);
            $row = $reporte;

            if ($request->getParameter("extended")) {
                $q = Doctrine::getTable("RepStatus")
                        ->createQuery("s")
                        ->select("s.ca_piezas, s.ca_peso, s.ca_volumen, s.ca_doctransporte, s.ca_idnave")
                        ->where("s.ca_idreporte = ?", $reporte['ca_idreporte'])
                        ->addOrderBy("s.ca_fchenvio DESC")
                        ->limit(1);
                $row2 = $q->fetchOne(null, Doctrine::HYDRATE_ARRAY);
                if ($row2) {
                    $row2["ca_piezas"] = substr($row2["ca_piezas"], 0, strpos($row2["ca_piezas"], "|"));
                    $row2["ca_peso"] = substr($row2["ca_peso"], 0, strpos($row2["ca_peso"], "|"));
                    $row2["ca_volumen"] = substr($row2["ca_volumen"], 0, strpos($row2["ca_volumen"], "|"));
                    $row = array_merge($row, $row2);
                }
            }

            $this->reportes[] = $row;
        }


        $this->responseArray = array("totalCount" => count($this->reportes), "reportes" => $this->reportes,"debug"=>$q->getSqlQuery());
        $this->setTemplate("responseTemplate");

        $this->setLayout("none");
    }

    /*
     *
     */

    public function executeDatosComboReferencias() {
        $criterio = $this->getRequestParameter("query");

        $referencias = Doctrine_Query::create()
                ->select("m.ca_idmaster, m.ca_referencia")
                ->from("InoMaster m")
                //->addOrderBy("m.ca_idmaster DESC")
                ->addOrderBy("m.ca_referencia ASC")
                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                ->limit(40)
                ->execute();

        $this->responseArray = array("totalCount" => count($referencias), "root" => $referencias, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /*
     *
     */

    public function executeDatosComboUsuario() {
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
                /*$q->addWhere("LOWER(u.ca_login) LIKE ?", "%" . strtolower($criterio) . "%");
                $q->orWhere("LOWER(u.ca_nombre) LIKE ?", "%" . strtolower($criterio) . "%");
                $q->orWhere("LOWER(u.ca_nombres) LIKE ?", "%" . strtolower($criterio) . "%");
                $q->orWhere("LOWER(u.ca_apellidos) LIKE ?", "%" . strtolower($criterio) . "%");
                $q->orWhere("LOWER(u.ca_email) LIKE ?", "%" . strtolower($criterio) . "%");
                $q->orWhere("LOWER(u.ca_cargo) LIKE ?", "%" . strtolower($criterio) . "%");
                $q->orWhere("LOWER(u.ca_departamento) LIKE ?", "%" . strtolower($criterio) . "%");*/
                $q->addWhere('(LOWER(u.ca_login) LIKE ? OR LOWER(u.ca_nombre) LIKE ? 
                        OR LOWER(u.ca_nombre) LIKE ? OR LOWER(u.ca_nombres) LIKE ?
                        OR LOWER(u.ca_apellidos) LIKE ? OR LOWER(u.ca_email) LIKE ?
                        OR LOWER(u.ca_cargo) LIKE ? OR LOWER(u.ca_departamento) LIKE ?
                        OR LOWER(s.ca_nombre) LIKE ?)
                        
                     ', array("%" . strtolower($criterio) . "%", "%" . strtolower($criterio) . "%", "%" . strtolower($criterio) . "%", "%" . strtolower($criterio) . "%", "%" . strtolower($criterio) . "%",
                              "%" . strtolower($criterio) . "%", "%" . strtolower($criterio) . "%", "%" . strtolower($criterio) . "%", "%" . strtolower($criterio) . "%"));
            }
            
            if($ciudad){
                $q->addWhere("LOWER(s.ca_nombre) LIKE ?", "%" . strtolower($ciudad) . "%");
            }
            
            if($perfil){
                //echo $perfil;
                $q->innerJoin("u.UsuarioPerfil up")
                ->addWhere("up.ca_perfil = ?", $perfil);
            }
            /*if($idempresa)
            {
                $suc[2] = array(1,2,8); // Grupo Coltrans, Colmas y Colotm
                //echo $ciudad;
                $q->innerJoin("u.Sucursal s");                
                $q->andWhereIn("s.ca_idempresa", ($suc[$idempresa]?$suc[$idempresa]:array($idempresa)));
            }*/
            if($idempresa){
                $suc[2] = array(1,2,8,11); // Grupo Coltrans, Colmas, Colotm y Coldepositos
                $suc[1] = array(1,2,8,11); // Grupo Coltrans, Colmas, Colotm y Coldepositos
                $q->andWhereIn("s.ca_idempresa", ($suc[$idempresa]?$suc[$idempresa]:array($idempresa)));
            }
            $sql=$q->getSqlQuery();
            
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
            $this->responseArray = array("total" => count($data), "root" => $data, "success" => true,"debug"=>$sql);
        } else {
            $this->responseArray = array("total" => 0, "root" => array(), "success" => true,"debug"=>$sql);
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeListaContactosClientesJSON() {
        $criterio = utf8_decode($this->getRequestParameter("query"));
        $tipo = $this->getRequestParameter("tipo");
        if ($criterio) {
            $q = Doctrine_Query::create()
                    ->select("c.ca_idcontacto, cl.ca_idcliente, cl.ca_compania, c.ca_nombres,
                                      c.ca_papellido, c.ca_sapellido, c.ca_cargo,c.ca_fijo,c.ca_email,
                                      cl.ca_preferencias, cl.ca_confirmar, cl.ca_vendedor, cl.ca_coordinador,
                                      v.ca_nombre, cl.ca_listaclinton, cl.ca_fchcircular,cl.ca_preferencias
                                      ,cl.ca_status, cl.ca_vendedor,cl.ca_propiedades")
                    ->from("Contacto c")
                    ->innerJoin("c.Cliente cl")
                    ->leftJoin("cl.Usuario v")
                    ->where("UPPER(cl.ca_compania) like ? and c.ca_cargo!='Extrabajador'", "%" . strtoupper($criterio) . "%")
                    ->addOrderBy("cl.ca_compania ASC")
                    ->addOrderBy("c.ca_nombres ASC")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->limit(40);
            if($tipo)
            {
                $q->addWhere("ca_tipo=?",$tipo);
            }
            $rows=$q->execute();
            foreach ($rows as $row) {
                $credito = Doctrine::getTable("IdsCredito")
                        ->createQuery("c")
                        ->addWhere("c.ca_id = ? and c.ca_idempresa = ?  ", array($row["cl_ca_idcliente"], 2)) // Créditos para Coltrans
                        ->fetchOne();
                $cupo = 0;
                $dias = 0;
                if ($credito) {
                    $cupo = $credito->getCaCupo();
                    $dias = $credito->getCaDias();
                }
                $result = array();
                $result["ca_idcontacto"] = $row["c_ca_idcontacto"];
                $result["ca_fijo"] = $row["c_ca_fijo"];
                $result["ca_email"] = utf8_encode($row["c_ca_email"]);
                $result["ca_compania"] = utf8_encode($row["cl_ca_compania"]);
                $result["ca_nombres"] = utf8_encode($row["c_ca_nombres"]);
                $result["ca_papellido"] = utf8_encode($row["c_ca_papellido"]);
                $result["ca_sapellido"] = utf8_encode($row["c_ca_sapellido"]);
                $result["ca_preferencias"] = utf8_encode($row["cl_ca_preferencias"]);
                $result["ca_nombre"] = utf8_encode($row["v_ca_nombre"]);
                $result["ca_cargo"] = utf8_encode($row["c_ca_cargo"]);
                $result["ca_listaclinton"] = utf8_encode($row["cl_ca_listaclinton"]);
                $result["ca_fchcircular"] = strtotime($row["cl_ca_fchcircular"]);
                $result["ca_confirmar"] = utf8_encode($row["cl_ca_confirmar"]);
                $result["ca_idcontacto"] = $row["c_ca_idcontacto"];
                $result["ca_status"] = $row["cl_ca_status"];
                $result["ca_vendedor"] = $row["cl_ca_vendedor"];
                $result["ca_coordinador"] = $row["cl_ca_coordinador"];
                $result["ca_diascredito"] = $dias;
                $result["ca_cupo"] = $cupo;
                $result["ca_propiedades"] = utf8_encode($row["cl_ca_propiedades"]);
                if(trim($row["cl_ca_propiedades"])!="")
                {
                    if(strpos($row["cl_ca_propiedades"], "cuentaglobal=true") !== false || strpos($row["cl_ca_propiedades"], "cuentaglobal=1") !== false)
                    {
                        $result["cg"] = "si";
                    }
                }
                $clientes[] = $result;
            }
        }
        //echo "<pre>";print_r($clientes);echo "</pre>";
        $this->responseArray = array("totalCount" => count($clientes), "clientes" => $clientes);
        $this->setTemplate("responseTemplate");
    }

    public function executeListaClientesJSON() {
        $criterio = utf8_decode($this->getRequestParameter("query"));
        $tipo = $this->getRequestParameter("tipo");
        if ($criterio) {
            $q = Doctrine_Query::create()
                    ->select(" cl.ca_idcliente, cl.ca_compania,cl.ca_tipo,
                                      cl.ca_preferencias, cl.ca_confirmar, cl.ca_vendedor, cl.ca_coordinador,
                                      v.ca_nombre, cl.ca_listaclinton, cl.ca_fchcircular
                                      ,cl.ca_status, cl.ca_vendedor, lc.ca_cupo, lc.ca_diascredito,ca_idalterno,ca_digito
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
                $result["nit"] = ($row["cl_ca_idalterno"]."-".$row["cl_ca_digito"]);
                $clientes[] = $result;
            }
            $this->responseArray = array("totalCount" => count($clientes), "clientes" => $clientes);
        } else {
            $this->responseArray = array("totalCount" => 0, "clientes" => array());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeListaIdsJSON() {
        $criterio = $this->getRequestParameter("query");

        $rows = Doctrine_Query::create()
                ->select("i.ca_id, i.ca_nombre")
                ->from("Ids i")
                ->where("UPPER(i.ca_nombre) like ?", "%" . strtoupper($criterio) . "%")
                ->addOrderBy("i.ca_nombre ASC")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->limit(40)
                ->execute();



        $ids = array();
        
        foreach ($rows as $row) {
            $row1=array();
            $row1["ca_id"] = $row["i_ca_id"];            
            $row1["ca_nombre"] = utf8_encode($row["i_ca_nombre"]);
            $ids[] = $row1;
        }        
        $this->responseArray = array("totalCount" => count($ids), "root" => $ids/*,"server"=>$_SERVER*/);
        $this->setTemplate("responseTemplate");
    }

    public function executeListaAgentesJSON() {
        $criterio = $this->getRequestParameter("query");

        $rows = Doctrine_Query::create()
                ->select("i.ca_id, i.ca_nombre")
                ->from("Ids i")
                ->where("UPPER(i.ca_nombre) like ?", "%" . strtoupper($criterio) . "%")
                ->addOrderBy("i.ca_nombre ASC")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->limit(40)
                ->execute();
        $ids = array();

        foreach ($rows as $row) {
            $row1=array();
            $row1["ca_id"] = $row["i_ca_id"];
            $row1["ca_nombre"] = utf8_encode($row["i_ca_nombre"]);
            $row1["ca_trafico"] = utf8_encode($row["i_ca_trafico"]);
            $ids[] = $row1;
        }
        $this->responseArray = array("totalCount" => count($ids), "root" => $ids);
        $this->setTemplate("responseTemplate");
    }

    public function executeListaTercerosJSON() {
        $criterio = utf8_decode($this->getRequestParameter("query"));
        $tipo = $this->getRequestParameter("tipo");

        $idreporte = $this->getRequestParameter("idreporte");

        $terceros = array();
        $notIn = array();
        $rows = array();
        if ($idreporte) {
            $reporte = Doctrine::getTable("Reporte")->find($idreporte);
            $proveedores = array();
            if( $reporte->getCaImpoexpo()==Constantes::EXPO ){
                if( $reporte->getCaIdconsignatario() ){
                    $proveedores = array( $reporte->getCaIdconsignatario() );
                }
            }else{
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
                ->where("UPPER(t.ca_nombre) like ?", "%" . strtoupper($criterio) . "%")
                ->addWhere("t.ca_tipo = ?", $tipo)
                ->addOrderBy("t.ca_nombre ASC")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->distinct()
                ->limit(40);
        if ($idreporte && $notIn) {
            $q->addWhere("t.ca_idtercero not in (" . implode(",", $notIn) . ")");
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
                    $con=0;
                $name = trim(utf8_encode($row["t_ca_nombre"]));
                $row["t_ca_nombre"] = utf8_encode($row["t_ca_nombre"]) . (($con) ? "(" . ($con + 1) . ")" : "");
                $terceros[] = $row;
            }
        }
        $this->responseArray = array("totalCount" => count($terceros), "terceros" => $terceros);
        $this->setTemplate("responseTemplate");
    }

    /*
     * Permite guardar un tercero
     * @author: Andres Botero y Mauricio Quinche
     */

    public function executeGuardarTercero() {
        $this->tipo = $this->getRequestParameter("tipo");
        $this->forward404unless($this->tipo);

        $idcomponent = $this->getRequestParameter("idcomponent");

        if ($this->getRequestParameter("nombre")) {
            $idtercero = $this->getRequestParameter("idtercero");
            if (!$idtercero) {
                $tercero = new Tercero();
            } else {
                $tercero = Doctrine::getTable("Tercero")->find($idtercero);
            }
            $tercero->setCaNombre(utf8_decode(strtoupper($this->getRequestParameter("nombre"))));
            $tercero->setCaDireccion(utf8_decode(strtoupper($this->getRequestParameter("direccion"))));
            $tercero->setCaTelefonos($this->getRequestParameter("telefono"));
            $tercero->setCaFax($this->getRequestParameter("fax"));
            $tercero->setCaEmail($this->getRequestParameter("email"));
            $tercero->setCaContacto(utf8_decode(strtoupper($this->getRequestParameter("contacto"))));
            $tercero->setCaIdciudad(($this->getRequestParameter("idciudad") != "") ? $this->getRequestParameter("idciudad") : "999-9999" );
            $tercero->setCaIdentificacion(strtoupper($this->getRequestParameter("identificacion")));
            $tercero->setCaVendedor(strtoupper($this->getRequestParameter("vendedor")));
            $tercero->setCaTipo($this->tipo);
            $tercero->setCaTipopersona($this->getRequestParameter("tipopersona"));
            $tercero->setProperty("nombre1",$this->getRequestParameter("nombre1"));
            $tercero->setProperty("nombre2",$this->getRequestParameter("nombre2"));
            $tercero->setProperty("apellido1",$this->getRequestParameter("apellido1"));
            $tercero->setProperty("apellido2",$this->getRequestParameter("apellido2"));
            $tercero->save();
        }

        $this->responseArray = array("success" => true, "nombre" => $this->getRequestParameter("nombre"), "idtercero" => $tercero->getCaIdtercero(), "tipo" => $this->tipo, "idcomponent" => $idcomponent);
        $this->setTemplate("responseTemplate");
    }

    /*
     * Carga los datos de un tercero en un objeto JSON
     * @author: Andres Botero
     */

    public function executeDatosTercero() {
        $idtercero = intval($this->getRequestParameter("idtercero"));
        $tercero = Doctrine::getTable("Tercero")->find( $idtercero );
        $this->forward404Unless($tercero);
        //echo "::".$tercero->getCaTipopersona()."::<br>";
        $this->responseArray = array("success" => true,
            "nombre" => utf8_encode($tercero->getCaNombre()),
            "idtercero" => $tercero->getCaIdtercero(),
            "direccion" => utf8_encode($tercero->getCaDireccion()),
            "telefonos" => $tercero->getCaTelefonos(),
            "fax" => $tercero->getCaFax(),
            "email" => $tercero->getCaEmail(),
            "contacto" => utf8_encode($tercero->getCaContacto()),
            "identificacion" => $tercero->getCaIdentificacion(),
            //"ciudad"=>$tercero->getCaCiudad(),
            "idciudad" => $tercero->getCaIdciudad(),
            "ciudad" => utf8_encode($tercero->getCiudad()->getCaCiudad()),
            "idtrafico" => $tercero->getCiudad()->getCaIdtrafico(),
            "trafico" => utf8_encode($tercero->getCiudad()->getTrafico()->getCaNombre()),
            "tipopersona" => $tercero->getCaTipopersona(),
            "nombre1" => utf8_encode($tercero->getProperty("nombre1")),
            "nombre2" => utf8_encode($tercero->getProperty("nombre2")),
            "apellido1" => utf8_encode($tercero->getProperty("apellido1")),
            "apellido2" => utf8_encode($tercero->getProperty("apellido2"))
        );
        $this->setTemplate("responseTemplate");
    }

    /*
     *
     */

    public function executeListaCotizacionesJSON() {
        $criterio = $this->getRequestParameter("query");
        $transporte = $this->getRequestParameter("transporte");
        $impoexpo = $this->getRequestParameter("impoexpo");

        $q = Doctrine::getTable("Cotizacion")
                ->createQuery("c")
                ->select("c.ca_idcotizacion, c.ca_consecutivo, c.ca_version, p.ca_idproducto, o.ca_ciudad, d.ca_ciudad, o.ca_idciudad, d.ca_idciudad,o.ca_idtrafico, d.ca_idtrafico, p.ca_producto
                                , p.ca_impoexpo, p.ca_transporte, p.ca_modalidad, p.ca_incoterms, con.ca_idcontacto, con.ca_nombres, con.ca_papellido, con.ca_sapellido, con.ca_cargo
                                ,cl.ca_idcliente, cl.ca_compania, cl.ca_preferencias, cl.ca_confirmar, cl.ca_coordinador, c.ca_usuario, p.ca_idlinea,usu.ca_nombre,libcli.ca_cupo, libcli.ca_diascredito,
                                s.ca_idmoneda,s.ca_prima_tip,s.ca_prima_vlr,s.ca_prima_min,s.ca_obtencion,s.ca_idmonedaobtencion")
                ->leftJoin("c.CotProducto p")
                ->leftJoin("p.Origen o")
                ->leftJoin("p.Destino d")
                ->leftJoin("c.CotSeguro s")
                ->leftJoin("c.Contacto con")
                ->leftJoin("con.Cliente cl")
                ->leftJoin("cl.LibCliente libcli")
                ->leftJoin("c.Usuario usu")
                ->addWhere("c.ca_consecutivo LIKE ?", $criterio . "%");
        if ($transporte != "") {
            $q->addWhere("p.ca_transporte = ?", utf8_decode($transporte));
        }

        if ($impoexpo != "") {
            if (utf8_decode($impoexpo) == constantes::TRIANGULACION)
                $q->addWhere("p.ca_impoexpo = ? or p.ca_impoexpo = ? ", array(utf8_decode($impoexpo), constantes::IMPO));
            else
                $q->addWhere("p.ca_impoexpo = ?", utf8_decode($impoexpo));
        }

        $cotizaciones = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->execute();

        foreach ($cotizaciones as $key => $val) {
            $cotizaciones[$key]["o_ca_ciudad"] = utf8_encode($cotizaciones[$key]["o_ca_ciudad"]);
            $cotizaciones[$key]["d_ca_ciudad"] = utf8_encode($cotizaciones[$key]["d_ca_ciudad"]);
            $cotizaciones[$key]["p_ca_producto"] = utf8_encode($cotizaciones[$key]["p_ca_producto"]);
            $cotizaciones[$key]["p_ca_impoexpo"] = utf8_encode($cotizaciones[$key]["p_ca_impoexpo"]);
            $cotizaciones[$key]["p_ca_transporte"] = utf8_encode($cotizaciones[$key]["p_ca_transporte"]);
            $cotizaciones[$key]["cl_ca_compania"] = utf8_encode($cotizaciones[$key]["cl_ca_compania"]);
            $cotizaciones[$key]["con_ca_idcontacto"] = utf8_encode($cotizaciones[$key]["con_ca_idcontacto"]);
            $cotizaciones[$key]["con_ca_nombres"] = utf8_encode($cotizaciones[$key]["con_ca_nombres"]);
            $cotizaciones[$key]["con_ca_papellido"] = utf8_encode($cotizaciones[$key]["con_ca_papellido"]);
            $cotizaciones[$key]["con_ca_sapellido"] = utf8_encode($cotizaciones[$key]["con_ca_sapellido"]);
            $cotizaciones[$key]["con_ca_cargo"] = utf8_encode($cotizaciones[$key]["con_ca_cargo"]);
            $cotizaciones[$key]["cl_ca_preferencias"] = utf8_encode($cotizaciones[$key]["cl_ca_preferencias"]);
            $cotizaciones[$key]["usu_ca_nombre"] = utf8_encode($cotizaciones[$key]["usu_ca_nombre"]);

            $cotizaciones[$key]["p_ca_modalidad"] = utf8_encode($cotizaciones[$key]["p_ca_modalidad"]);

            $cotizaciones[$key]["p_ca_idlinea"] = utf8_encode($cotizaciones[$key]["p_ca_idlinea"]);
            $cotizaciones[$key]["p_ca_linea"] = "";

            $cotizaciones[$key]["libcli_ca_cupo"] = utf8_encode($cotizaciones[$key]["libcli_ca_cupo"]);

            if ($cotizaciones[$key]["p_ca_idlinea"] != "") {
                $q = Doctrine_Query::create()
                        ->select("p.ca_idproveedor, p.ca_sigla, id.ca_nombre, p.ca_transporte ")
                        ->from("IdsProveedor p")
                        ->innerJoin("p.Ids id")
                        ->addOrderBy("id.ca_nombre");
                $q->addWhere("p.ca_idproveedor=?", $cotizaciones[$key]["p_ca_idlinea"]);
                $lineas = $q->execute();
                if (count($lineas) > 0) {
                    $cotizaciones[$key]["p_ca_linea"] = utf8_encode(($lineas[0]['ca_sigla'] ? $lineas[0]['ca_sigla'] . " - " : "") . utf8_encode($lineas[0]['Ids']['ca_nombre']));
                }
            }

            $cotizaciones[$key]["cl_ca_confirmar"] = utf8_encode($cotizaciones[$key]["cl_ca_confirmar"]);

            $idmodalidad = Doctrine::getTable("Modalidad")
                    ->createQuery("m")
                    ->select("m.ca_idmodalidad")
                    ->addWhere("m.ca_modalidad = ?", $cotizaciones[$key]["p_ca_modalidad"])
                    ->addWhere("m.ca_transporte = ?", utf8_decode($cotizaciones[$key]["p_ca_transporte"]))
                    ->addWhere("m.ca_impoexpo = ?", utf8_decode($cotizaciones[$key]["p_ca_impoexpo"]))
                    ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                    ->execute();
            $cotizaciones[$key]["idmodalidad"] = $idmodalidad;
            $cfijos = Doctrine::getTable("Contacto")
                    ->createQuery("c")
                    ->select("c.ca_fijo,c.ca_email")
                    ->where("c.ca_idcliente=? and c.ca_fijo=true", array($cotizaciones[$key]["cl_ca_idcliente"]))
                    ->execute();
            $cotizaciones[$key]["cfijo"] = "";
            foreach ($cfijos as $cfijo) {
                if ($cfijo->getCaEmail() != "") {
                    if ($cotizaciones[$key]["cfijo"] != "")
                        $cotizaciones[$key]["cfijo"].=",";
                    $cotizaciones[$key]["cfijo"].=$cfijo->getCaEmail();
                }
            }
        }
        //print_r($cotizaciones);
        $this->responseArray = array("root" => $cotizaciones, "total" => count($cotizaciones), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeListaHblsJSON() {
        $criterio = $this->getRequestParameter("query");

        $q = Doctrine::getTable("InoMaestraSea")
                        ->createQuery("m")
                        ->select("m.*,ic.*")
                        ->innerJoin('m.InoClientesSea ic')                        
                        ->addWhere("m.ca_referencia like ?", array($criterio."%",$criterio."%"))
                        ->limit(20);
                        //->limit(40);
//->setHydrationMode(Doctrine::HYDRATE_SCALAR)
        $datos = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->execute();

        //print_r($datos);
/*        foreach ($datos as $key => $val) {
            
        }*/
        //print_r($cotizaciones);
        $this->responseArray = array("root" => $datos, "total" => count($datos), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /*
     * Datos de los conceptos según sea el medio de transporte y la modalidad
     */

    public function executeDatosConceptos() {
        $transport_parameter = utf8_decode($this->getRequestParameter("transporte"));
        $modalidad_parameter = utf8_decode($this->getRequestParameter("modalidad"));

        $q = Doctrine::getTable("Concepto")
                ->createQuery("c")
                ->select("c.ca_idconcepto,c.ca_concepto")                
                ->addOrderBy("c.ca_concepto")
                ->setHydrationMode(Doctrine::HYDRATE_ARRAY);
        
        //->where("c.ca_transporte = ? AND c.ca_modalidad = ? ", array($transport_parameter, $modalidad_parameter))
        if($transport_parameter!="")
        {
            $q->addWhere("c.ca_transporte", $transport_parameter);
        }
        if($modalidad_parameter!="")
        {
            $q->addWhere("c.ca_transporte", $modalidad_parameter);
        }
        $results=$q->execute();

        $this->conceptos = array();

        foreach ($results as $result) {
            $row = array('idconcepto' => $result["ca_idconcepto"], 'concepto' => utf8_encode($result["ca_concepto"]));
            $this->conceptos[] = $row;
        }
        $this->responseArray = array("root" => $this->conceptos, "total" => count($this->conceptos), "success" => true);

        $this->setTemplate("responseTemplate");
    }

    /*
     * Buscar una referencia de Aduana para el módulo de Falabella
     */

    public function executeDatosComboReferenciaAduana() {
        $criterio = $this->getRequestParameter("query");

        $referencias = Doctrine_Query::create()
                ->select("m.ca_referencia")
                ->from("InoMaestraAdu m")
                ->addWhere("m.ca_referencia like ?", $criterio . "%")
                ->addOrderBy("m.ca_referencia ASC")
                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                ->limit(40)
                ->execute();

        $this->responseArray = array("totalCount" => count($referencias), "root" => $referencias, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /*
     * Buscar una referencia de Aduana para el módulo de Falabella
     */

    public function executeListaReportesJSON() {
        $criterio = $this->getRequestParameter("query");

        if ($criterio) {

            $transporte = utf8_decode($this->getRequestParameter("transporte"));
            $impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
            $openedOnly = $this->getRequestParameter("openedOnly");
            
            $q = Doctrine::getTable("Reporte")
                    ->createQuery("r")
                    ->select("r.ca_idreporte, r.ca_consecutivo,r.ca_version ,o.ca_ciudad, d.ca_ciudad, o.ca_idciudad, d.ca_idciudad,o.ca_idtrafico, d.ca_idtrafico, r.ca_mercancia_desc,
                                    r.ca_idlinea, r.ca_impoexpo, r.ca_transporte, r.ca_modalidad, r.ca_incoterms, con.ca_idcontacto, con.ca_nombres, con.ca_papellido, con.ca_sapellido, con.ca_cargo
                                    ,cl.ca_idcliente, cl.ca_compania, cl.ca_preferencias, cl.ca_confirmar, cl.ca_coordinador, usu.ca_login, usu.ca_nombre, r.ca_orden_clie")
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
                if( $impoexpo==Constantes::IMPO ){
                    $q->addWhere("(r.ca_impoexpo = ? OR r.ca_impoexpo = ?)", array($impoexpo, Constantes::TRIANGULACION));
                }else{
                    $q->addWhere("r.ca_impoexpo = ?", $impoexpo);
                }
            }
            if( $openedOnly ){
                $q->addWhere("r.ca_idetapa != ?", "99999");
            }            

            $q->addOrderBy("to_number(SUBSTR(r.ca_consecutivo , 1 , (POSITION('-' in r.ca_consecutivo)-1) ),'999999')  desc");
            $q->addOrderBy("r.ca_version  desc");
            //$q->orderBy("r.ca_fchcreado desc");


            $reportes = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->limit(50)->execute();

            foreach ($reportes as $key => $val) {
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

                $reportes[$key]["cl_ca_confirmar"] = utf8_encode($reportes[$key]["cl_ca_confirmar"]);
            }
            $this->responseArray = array("root" => $reportes, "total" => count($reportes), "success" => true);
        } else {
            $this->responseArray = array("root" => array(), "total" => 0, "success" => true);
        }
        //print_r($reportes);        
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosSucAgente($request) {
        $idagente = $request->getParameter("idagente");

        $sucursales = Doctrine_Query::create()
                ->select("c.ca_ciudad,s.ca_direccion,s.ca_idsucursal,s.ca_id")
                ->from("IdsSucursal s")
                ->innerJoin("s.Ciudad c")
                ->where("s.ca_id=?", $idagente)
                ->addWhere("s.ca_fcheliminado IS NULL")
                ->addOrderBy("c.ca_ciudad")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
        $sucursal = array();

        foreach ($sucursales as $suc) {
            $sucursal[] = array(
                "idsucursal" => $suc["s_ca_idsucursal"],
                "ciudad" => utf8_encode($suc["c_ca_ciudad"]),
                "direccion" => utf8_encode($suc["s_ca_direccion"])
            );
        }
        $this->responseArray = array("root" => $sucursal, "total" => count($sucursal), "success" => true);
        $this->setTemplate("responseTemplate");
    }

     public function executeListaReferencias($request) {
        
         $numRef = $request->getParameter("query");
         
         $q = Doctrine::getTable("InoMaestraAdu")
                    ->createQuery("m")
                    ->select("m.ca_referencia,m.ca_idcliente,m.ca_piezas,m.ca_peso,m.ca_mercancia,m.ca_vendedor,"
                            . "o.ca_ciudad,o.ca_idciudad,d.ca_ciudad,d.ca_idciudad,cl.ca_compania")
                    ->leftJoin("m.Origen o")
                    ->leftJoin("m.Destino d")                    
                    ->leftJoin("m.Cliente cl")                    
                    ->addWhere("m.ca_referencia LIKE ? AND m.ca_fchcreado>?", array($numRef . "%",Utils::addDate(date("Y-m-d"),0,0,-1)))
                    ->orderBy("m.ca_fchcreado DESC")
                    ->limit(30);
         
         $referencias = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->limit(50)->execute();

       foreach ($referencias as $k=>$ref) {
            
                //$referencias[$k]["m_ca_referencia"]=$ref["m_ca_referencia"];
                //$referencias[$k]["m_ca_idcliente"]=$ref["m_ca_idcliente"];
                //$referencias[$k]["m_ca_piezas"]=$ref["m_ca_piezas"];
                //$referencias[$k]["m_ca_peso"]=$ref["m_ca_peso"];
                //$referencias[$k]["m_ca_volumen"]=$ref["m_ca_volumen"];
                $referencias[$k]["m_ca_mercancia"]=  utf8_encode($ref["m_ca_mercancia"]);
                //$referencias[$k]["m_ca_vendedor"]=$ref["m_ca_vendedor"];
                $referencias[$k]["o_ca_ciudad"]=utf8_encode($ref["o_ca_ciudad"]);
                //$referencias[$k]["o.ca_idciudad"]=$ref["o.ca_idciudad"];
                $referencias[$k]["d_ca_ciudad"]=utf8_encode($ref["d_ca_ciudad"]);
                //$referencias[$k]["d_ca_idciudad"]=$ref["d_ca_idciudad"];
                $referencias[$k]["cl_ca_compania"]=utf8_encode($ref["cl_ca_compania"]);
        }

         //echo "<pre>";print_r($referencias);echo "</pre>";
        $this->responseArray = array("root" => $referencias, "total" => count($referencias), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosDocumentos($request ){
        
        $this->idsserie=$request->getParameter("idsserie");
        //$this->idsserie = ($this->getRequestParameter("serie")!="")?$this->getRequestParameter("serie"):"0";
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
    
    
    public function executeDatosCostos(sfWebRequest $request) {
        $this->data = array();
        
        $idccosto=$request->getParameter("idccosto");
        $ccosto = Doctrine::getTable("InoCentroCosto")->find($idccosto);        
        $this->forward404unless($ccosto);
        $this->impoexpo =  $ccosto->getCaImpoexpo();
        $this->transporte = $ccosto->getCaTransporte();

        $q = Doctrine::getTable("InoConcepto")
                        ->createQuery("c")
                        ->innerJoin("c.InoConceptoModalidad cm")
                        ->innerJoin("cm.Modalidad m")
                        //->addWhere("c.ca_costo = ? ", true)
                        ->addOrderBy("c.ca_concepto");
        
        if($this->impoexpo!="")
            $q->addWhere("m.ca_impoexpo = ? ", $this->impoexpo);
        
        if($this->transporte!="")
            $q->addWhere("m.ca_transporte = ? ", $this->transporte);
        
        if($this->modalidad!="")
            $q->addWhere("m.ca_modalidad = ? ", $this->modalidad);

        

        $q->fetchArray();

        $conceptos = $q->execute();

        $this->data = array();
        //print_r($conceptos[0]);
        foreach ($conceptos as $concepto) {
            $this->data[] = array("idconcepto" => $concepto['ca_idconcepto'],
                "concepto" => $concepto['ca_concepto'],
                "transporte" => utf8_encode($concepto['ca_transporte']),
                "modalidad" => utf8_encode($concepto['ca_modalidad'])
            );
        }
        
        
        $this->responseArray = array("root" => $this->data, "total" => count($this->data), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    
        /**
     * Retorna un objeto JSON con la información de todas las bodegas
     *
     * @param sfRequest $request A request object
         * query : texto digitado para filtrar bodegas
         * modo :  hace referencia al transporte
     */
    
    
    public function executeListaBodegas(){
        
        $criterio = utf8_decode($this->getRequestParameter("query"));
        $modo = utf8_decode($this->getRequestParameter("modo"));
        
        if($modo==Constantes::TERRESTRE)
        {
            $modo=  Constantes::MARITIMO;
        }
        if($criterio){
            $q = Doctrine::getTable("Bodega")
                            ->createQuery("b")
                            ->select("*")
                            ->addOrderBy( "b.ca_nombre" )
                            ->where("b.ca_transporte like ? and b.ca_nombre<>'-'  and ca_tipo!='Operador Multimodal'", "%" . $modo . "%")
                            ->addWhere("UPPER(b.ca_nombre) like ?", "%" . strtoupper($criterio) . "%")
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $debug=$q->getSqlQuery();        
        $bodegas=$q->execute();      
        foreach($bodegas as $k=>$c)
        {
            $bodegas[$k]["b_ca_nombre"]=utf8_encode($bodegas[$k]["b_ca_nombre"].
                    " -Nit: ".$bodegas[$k]["b_ca_identificacion"].
                    " "      .$bodegas[$k]["b_ca_direccion"]." - ".$bodegas[$k]["b_ca_tipo"]);
            $bodegas[$k]["b_ca_tipo"]=utf8_encode($bodegas[$k]["b_ca_tipo"]);
            $bodegas[$k]["b_ca_transporte"]=utf8_encode($bodegas[$k]["b_ca_transporte"]);
            $bodegas[$k]["b_ca_direccion"]=utf8_encode($bodegas[$k]["b_ca_direccion"]);
        }
        $this->responseArray = array("success" => true, "root" => $bodegas, "totalC" => count($bodegas),"debug"=>$debug);
        }
        $this->setTemplate("responseTemplate");
    }
    
    /**
     * Retorna un objeto JSON con la información de los tickets asociados a un departamento
     *
     * @param sfRequest $request A request object
         * query : texto digitado para filtrar tickets
         * iddepartament :  hace referencia al Departamento en Helpdesk
         * idgroup :  hace referencia al área de HelpDesk
     */
    
    public function executeListaTicketsJSON() {
        $criterio = $this->getRequestParameter("query");
        $iddepartament = $this->getRequestParameter("iddepartament");
        $idgroup = $this->getRequestParameter("idgroup");
        $tipo = $this->getRequestParameter("tipo");

        $q = Doctrine_Query::create()
                ->select("h.ca_idticket, h.ca_title, h.ca_text, h.ca_idgroup")
                ->from('HdeskTicket h')
                ->innerJoin("h.HdeskGroup g");

        if($tipo==="rn"){
            $q->addSelect("MAX(e.ca_idemail) as idemail");
            $q->leftJoin("h.Email e");
            $q->addWhere("e.ca_tipo = 'Notificación'");       
        }
        
        if($tipo==="ino"){            
            $idmaster = $this->getRequestParameter("idmaster");
            $master = Doctrine::getTable("InoMaster")->find($idmaster);
            
            $q->leftJoin("h.HdeskAuditDocuments a");
            $q->addWhere("a.ca_numero_doc = ?", $master->getCaReferencia());
        }
        
        if ($iddepartament) {
            $q->addWhere("g.ca_iddepartament = ? ", $iddepartament);
}

        if ($idgroup) {
            $q->addWhere("h.ca_idgroup = ? ", $idgroup);
        }

        if ($criterio) {            
            $q->addWhere("(h.ca_idticket = ? or h.ca_title like ?  or h.ca_text like ?) ", array($criterio ,"%" . strtolower($criterio) . "%", "%" . strtolower($criterio) . "%"));
        }
        
        $q->addOrderBy("h.ca_idgroup ASC");        
        $q->addOrderBy("h.ca_idticket DESC");        
        $q->groupBy("h.ca_idticket, h.ca_title, h.ca_text, h.ca_idgroup");        
        $q->distinct();                
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);        
        
        $debug = utf8_encode($q->getSqlQuery());        
        $tickets = $q->execute();

        foreach ($tickets as $key => $val) {            
            $tickets[$key]["h_ca_title"] = utf8_encode(str_replace('"', "'", $tickets[$key]["h_ca_title"]));
            $tickets[$key]["h_ca_text"] = utf8_encode(str_replace("</style", "</style2", str_replace("<style", "<style2", str_replace('"', "'", $tickets[$key]["h_ca_text"]))));            
        }
        
        $this->responseArray = array("success" => true, "total" => count($tickets), "root" => $tickets, "debug"=>$debug);
        $this->setTemplate("responseTemplate");
    }
}
?>
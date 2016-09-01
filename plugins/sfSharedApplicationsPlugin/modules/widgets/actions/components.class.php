<?php

/**
 * widgets actions.
 *
 * @package    colsys
 * @subpackage widgets
 * @author     Andres Botero
 * @version    SVN: $Id: components.class.php 9301 2008-05-27 01:08:46Z abotero $
 */
class widgetsComponents extends sfComponents {

    /**
     * Muestra un select con las modalidades
     */
    public function executeComerciales() {
        if (!isset($this->label)) {
            $this->label = "";
        }
        if (!isset($this->id)) {
            $this->id = "";
        }
        if (!isset($this->allowBlank)) {
            $this->allowBlank = "true";
        }

        if (!isset($this->nivel)) {
            $this->nivel = 0;
        }

        $comerciales = UsuarioTable::getComerciales();
        $this->comercialesJson = array();
        foreach ($comerciales as $comercial) {
            $this->comercialesJson[] = array("login" => $comercial->getCaLogin(),
                "nombre" => utf8_encode($comercial->getCaNombre())
            );
        }

        $this->user = $this->getUser();

        $this->nombre = "";
        if (isset($this->value)) {
            $vendedor = Doctrine::getTable("Usuario")->find($this->value);
            if ($vendedor) {
                $this->nombre = $vendedor->getCaNombre();
            }
        } else {
            $this->value = "";
        }
    }

    public function executeMonedas() {

        $this->monedas = Doctrine::getTable("Moneda")
                ->createQuery("m")
                ->addOrderBy("m.ca_sugerido desc")
                ->addOrderBy("m.ca_idmoneda")
                ->execute();
    }

    public function executeWidgetIncoterms() {
        $incoterms = ParametroTable::retrieveByCaso("CU062");
        $this->incoterms = array();
        foreach ($incoterms as $incoterm) {
            $this->incoterms[] = array("valor" => $incoterm->getCaValor());
        }
    }

    public function executeWidgetMultiIncoterms() {
        $incoterms = ParametroTable::retrieveByCaso("CU062");
        //$this->incoterms = array();
        $this->incoterms = "[";
        $incotmp = "";
        foreach ($incoterms as $incoterm) {
            $incotmp.=($incotmp != "") ? "," : "";
            $incotmp.="['" . $incoterm->getCaValor() . "']";
        }
        $this->incoterms.=$incotmp . "]";
    }
    
    public function executeWidgetMultiDatos() {
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/SuperBoxSelect", 'last');
        //$incoterms = ParametroTable::retrieveByCaso("CU062");
        //$this->incoterms = array();
        /*$this->incoterms = "[";
        $incotmp = "";
        foreach ($incoterms as $incoterm) {
            $incotmp.=($incotmp != "") ? "," : "";
            $incotmp.="['" . $incoterm->getCaValor() . "']";
        }
        $this->incoterms.=$incotmp . "]";
         * 
         */
        $this->datos=array();
//        $this->datos[] = array("id" => "1", "valor" => "uno");
//        $this->datos[] = array("id" => "2", "valor" => "dos");
//        $this->datos[] = array("id" => "3", "valor" =>"tres" );
        //print_r($this->datos);
    }

    public function executeTransportes() {
        $this->transportes = ParametroTable::retrieveByCaso("CU063");
        if (!isset($this->allowBlank)) {
            $this->allowBlank = "true";
        }
    }

    /*
     * Muestra un campo que permite autocompletar el numero de reporte.
     */

    public function executeConcepto() {
        if (!isset($this->id)) {
            $this->id = "";
        }

        if (!isset($this->transporte)) {
            $this->transporte = Constantes::MARITIMO;
        }
        if (!isset($this->modalidad)) {
            $this->modalidad = null;
        }
    }

    /*
     * Sin probar con doctrine 
     */

    /**
     * Muestra un select con todos los paises
     */
    public function executePaises() {
        $traficos_rs = Doctrine::getTable("Trafico")
                ->createQuery("t")
                ->where("t.ca_idtrafico != '99-999' ")
                ->addOrderBy("t.ca_nombre ASC")
                ->execute();


        $this->traficos = array();

        foreach ($traficos_rs as $trafico) {
            $row = array("idtrafico" => $trafico->getCaIdtrafico(), "trafico" => utf8_encode($trafico->getCaNombre()));
            $this->traficos[] = $row;
        }
        if (!isset($this->label)) {
            $this->label = "";
        }
        if (!isset($this->id)) {
            $this->id = "";
        }
        if (!isset($this->allowBlank)) {
            $this->allowBlank = "true";
        }
    }

    /**
     * Muestra un select con todas las ciudades y las encadena con los paises
     */
    public function executeCiudades() {
        if (!isset($this->label)) {
            $this->label = "";
        }
        if (!isset($this->id)) {
            $this->id = "";
        }

        if (!isset($this->allowBlank)) {
            $this->allowBlank = "true";
        }
    }

    /**
     * Muestra un select con todas las ciudades y las encadena con los paises
     */
    public function executeContinuaciones() {
        
    }

    /**
     * Muestra un select con todas las ciudades y las encadena con los paises
     */
    public function executeImpoexpo() {
        if (!isset($this->allowBlank)) {
            $this->allowBlank = "true";
        }
    }

    /**
     * Muestra un select con las empresas Coltrans, Colmas
     */
    public function executeEmpresa() {
        
    }

    /**
     * Muestra un select vacio cuyos datos son alimentados manualmente
     */
    public function executeEmptyCombo() {
        if (!isset($this->label)) {
            $this->label = "";
        }
        if (!isset($this->id)) {
            $this->id = "";
        }
        if (!isset($this->allowBlank)) {
            $this->allowBlank = "true";
        }
    }

    /**
     * Muestra un select con los valores de las aplicaciones
     */
    public function executeAplicaciones() {
        if (!isset($this->label)) {
            $this->label = "";
        }
        if (!isset($this->id)) {
            $this->id = "";
        }
        if (!isset($this->allowBlank)) {
            $this->allowBlank = "true";
        }
        $this->aplicaciones = ParametroTable::retrieveByCaso("CU064", null, $this->transporte);
    }

    /**
     * Muestra un select con las lineas de transporte
     */
    public function executeLineas() {
        if (!isset($this->label)) {
            $this->label = "";
        }
        if (!isset($this->id)) {
            $this->id = "";
        }
        if (!isset($this->allowBlank)) {
            $this->allowBlank = "true";
        }

        if (!isset($this->noaprob)) {
            $this->noaprob = false;
        }
    }

    /**
     * Muestra un select con las modalidades
     */
    public function executeModalidades() {
        if (!isset($this->label)) {
            $this->label = "";
        }
        if (!isset($this->id)) {
            $this->id = "";
        }
        if (!isset($this->allowBlank)) {
            $this->allowBlank = "true";
        }
    }

    /*
     * Muestra un campo que permite autocompletar el nombre del cliente usando JSON y el id lo guarda
      en el atributo id.
     */

    public function executeComboClientes() {
        if ($this->idcliente) {
            $this->cliente = ClientePeer::retrieveByPk($this->cliente);
        }
    }

    /*
     * Muestra un campo que permite autocompletar el numero de reporte.
     */

    public function executeComboReportes() {
        
    }

    /*
     * Muestra un campo que permite autocompletar el tercero (Cliente, proveedor, consignatario, etc.).
     */

    public function executeComboTercero() {
        if ($this->value) {
            $this->tercero = Doctrine::getTable("Tercero")->find($this->value);
        } else {
            $this->tercero = new Tercero();
        }
    }

    /*
     * Muestra una seleccion de las cotizaciones a partir del numero
     */

    public function executeComboCotizaciones() {
        /* $response = sfContext::getInstance()->getResponse();
          $response->addJavascript('components/comboCotizaciones'); */
        $this->selected = "";
    }

    /*
     *
     */

    public function executeWidgetImpoexpo() {
        $this->data = array();
        $this->data[] = array("valor" => utf8_encode(Constantes::IMPO));
        $this->data[] = array("valor" => utf8_encode(Constantes::TRIANGULACION));
        $this->data[] = array("valor" => utf8_encode(Constantes::EXPO));
        $this->data[] = array("valor"=>utf8_encode(Constantes::OTMDTA ));
        $this->data[] = array("valor"=>utf8_encode(Constantes::INTERNO ));
    }

    public function executeWidgetTransporte() {
        $this->data = array();
        $this->data[] = array("valor" => utf8_encode(Constantes::AEREO));
        $this->data[] = array("valor" => utf8_encode(Constantes::MARITIMO));
        $this->data[] = array("valor" => utf8_encode(Constantes::TERRESTRE));
    }

    public function executeWidgetSucursales() {
        $this->data = array();
        $user = $this->getUser();
        //$user->getIdempresa();
        $suc=($user->getIdempresa()=="8")?"2":$user->getIdempresa();
        
        $sucursales = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->select("s.ca_idsucursal,s.ca_nombre")
                ->addOrderBy("s.ca_nombre")
                ->addWhere("s.ca_idempresa=?", $user->getIdempresa())
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();

        foreach ($sucursales as $sucursal) {
            $this->data[] = array("id" => $sucursal["s_ca_idsucursal"], "valor" => utf8_encode($sucursal["s_ca_nombre"]));
        }
    }

    public function executeWidgetDeptos() {
        $this->data = array();
        $user = $this->getUser();
        //$user->getIdempresa();
        $rows = Doctrine::getTable("Departamento")
                ->createQuery("d")
                ->select("d.ca_iddepartamento,d.ca_nombre")
                ->addOrderBy("d.ca_nombre")
                ->addWhere("d.ca_idempresa=?", $user->getIdempresa())
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();

        foreach ($rows as $r) {
            $this->data[] = array("id" => $r["d_ca_iddepartamento"], "valor" => utf8_encode($r["d_ca_nombre"]));
        }
    }

    public function executeWidgetMuelles() {
        //echo $this->ciudad;
        $this->data = array();

        if ($this->ciudad == "CTG-0005") {
            $this->data[] = array("id" => "2257", "valor" => "Muelles El Bosque S.A.");
            $this->data[] = array("id" => "2261", "valor" => "Soc.Portuaria Reg.Decartagenas.Adeposito");
            $this->data[] = array("id" => "2259", "valor" => "Contecar Tnal C/Nedor.C/Genas.A.Deposito");
            $this->data[] = array("id" => "3802", "valor" => "SOCIEDAD PORTUARIA  PUERTO BAHIA SA");
        } else if ($this->ciudad == "BUN-0002") {
            $this->data[] = array("id" => "2366", "valor" => "Soc.Port.Regional B/Tura S.A.");
            $this->data[] = array("id" => "2918", "valor" => "SOCIEDAD PORTUARIA TERMINAL DE CONTENEDORES DE BUENAVENTURA S.A. T.C.BUENA S.A.");
        } else if ($this->ciudad == "BAQ-0005") {
            $this->data[] = array("id" => "2031", "valor" => "Puerto de Barranquilla");
            $this->data[] = array("id" => "2424", "valor" => "Palermo Sociedad Portuaria S.A");
             $this->data[] = array("id" => "3625", "valor" => "BARRANQUILLA INTERNATIONAL TERMINAL COMP");
        } else if ($this->ciudad == "STA-0005") {
            $this->data[] = array("id" => "2435", "valor" => "SOCIEDAD PORTUARIA REGIONAL DE SANTA MARTA S.A");
        } else {
            $this->data[] = array("id" => "2257", "valor" => "Muelles El Bosque S.A.");
            $this->data[] = array("id" => "2261", "valor" => "Soc.Portuaria Reg.Decartagenas.Adeposito");
            $this->data[] = array("id" => "2259", "valor" => "Contecar Tnal C/Nedor.C/Genas.A.Deposito");
            $this->data[] = array("id" => "2366", "valor" => "Soc.Port.Regional B/Tura S.A.");
            $this->data[] = array("id" => "2918", "valor" => "SOCIEDAD PORTUARIA TERMINAL DE CONTENEDORES DE BUENAVENTURA S.A. T.C.BUENA S.A.");
            $this->data[] = array("id" => "2031", "valor" => "Soc.Port.Regionalde B/Quillas.A.Deposito");
            $this->data[] = array("id" => "2435", "valor" => "SOCIEDAD PORTUARIA REGIONAL DE SANTA MARTA S.A");
            $this->data[] = array("id" => "3802", "valor" => "SOCIEDAD PORTUARIA  PUERTO BAHIA SA");
        }
    }

    public function executeWidgetModalidad() {
        $this->data = array();

        $modalidades = Doctrine::getTable("Modalidad")
                ->createQuery("m")
                ->orderBy("m.ca_impoexpo")
                ->orderBy("m.ca_transporte")
                ->orderBy("m.ca_modalidad")
                ->where("ca_fcheliminado is null")
                ->execute();

        $this->data = array();
        foreach ($modalidades as $modalidad) {
            $this->data[] = array("idmodalidad" => $modalidad->getCaIdmodalidad(),
                "impoexpo" => utf8_encode($modalidad->getCaImpoexpo()),
                "transporte" => utf8_encode($modalidad->getCaTransporte()),
                "modalidad" => utf8_encode($modalidad->getCaModalidad())
            );
        }
//		echo "<pre>";print_r($this->data);echo "</pre>";
    }
    
    public function executeWidgetMes() {
        $this->data = array();
        $this->data[]=array("mes"=>"Enero","nmes"=>"01");
        $this->data[]=array("mes"=>"Febrero","nmes"=>"02");
        $this->data[]=array("mes"=>"Marzo","nmes"=>"03");
        $this->data[]=array("mes"=>"Abril","nmes"=>"04");
        $this->data[]=array("mes"=>"Mayo","nmes"=>"05");
        $this->data[]=array("mes"=>"Junio","nmes"=>"06");
        $this->data[]=array("mes"=>"Julio","nmes"=>"07");
        $this->data[]=array("mes"=>"Agosto","nmes"=>"08");
        $this->data[]=array("mes"=>"Septiembre","nmes"=>"09");
        $this->data[]=array("mes"=>"Octubre","nmes"=>"10");
        $this->data[]=array("mes"=>"Noviembre","nmes"=>"11");
        $this->data[]=array("mes"=>"Diciembre","nmes"=>"12");
        
//		echo "<pre>";print_r($this->data);echo "</pre>";
    }

    public function executeWidgetMoneda() {
        $this->data = array();

        $monedas = Doctrine::getTable("Moneda")
                ->createQuery("m")
                ->addOrderBy("m.ca_sugerido desc")
                ->addOrderBy("m.ca_idmoneda")
                ->execute();

//        echo count($monedas);
        foreach ($monedas as $moneda) {
            $this->data[] = array("valor" => $moneda->getCaIdmoneda(), "sugerido" => $moneda->getCaSugerido(), "nombre" => utf8_encode($moneda->getCaNombre()));
        }
    }

    public function executeWidgetLinea() {
        $this->data = array();

        $q = Doctrine_Query::create()
                ->select("p.ca_idproveedor, p.ca_sigla, p.ca_tipo, id.ca_nombre, p.ca_transporte, p.ca_activo_impo, p.ca_activo_expo ")
                ->from("IdsProveedor p")
                ->innerJoin("p.Ids id")
                ->addOrderBy("id.ca_nombre");
        
        $q->addWhere("p.ca_tipo = ? OR p.ca_tipo = ? OR p.ca_tipo = ?", array("TRI", "TRN", "OPE"));
        $q->fetchArray();
        //echo $q->getSqlQuery();
        $lineas = $q->execute();

        $this->data = array();
        foreach ($lineas as $linea) {
            /* Ticket 35172 Incluir Operadores portuarios en proveedores terrestres.*/
            if($linea['ca_tipo'] == "OPE")
                $linea['ca_transporte'] = "Terrestre";
            
            $this->data[] = array("idlinea" => $linea['ca_idproveedor'],
                "linea" => utf8_encode(($linea['ca_sigla'] ? $linea['ca_sigla'] . " - " : "") . $linea['Ids']['ca_nombre']),
                "transporte" => utf8_encode($linea['ca_transporte']),
                "activo_impo" => $linea['ca_activo_impo'],
                "activo_expo" => $linea['ca_activo_expo']
            );
        }
        //echo "<pre>";print_r($this->data);echo "</pre>";
        
    }

    public function executeWidgetPais() {
        //echo $this->excluidos;
        $traficos = Doctrine::getTable('Trafico')->createQuery('t')
                ->where('t.ca_idtrafico != ?', '99-999')
                ->addOrderBy('t.ca_nombre ASC')
                ->execute();

        $this->data = array();
        foreach ($traficos as $trafico) {
            $this->data[] = array("nombre" => utf8_encode($trafico->getCaNombre()),
                "idtrafico" => $trafico->getCaIdtrafico()
            );
        }
    }

    public function executeWidgetCiudad() {
        $this->data = array();

        $ciudades = Doctrine::getTable('Ciudad')->createQuery('c')
                ->innerJoin('c.Trafico t')
                ->addOrderBy('c.ca_ciudad ASC')
                ->addOrderBy('t.ca_nombre ASC')
                ->execute();
        $this->data = array();
        $con = 0;
        $name = "";
        foreach ($ciudades as $ciudad) {

            if (trim(utf8_encode($ciudad->getCaCiudad())) == trim($name))
                $con++;
            else
                $con = 0;
            $name = trim(utf8_encode($ciudad->getCaCiudad()));
            $this->data[] = array("idciudad" => $ciudad->getCaIdciudad(),
                "ciudad" => utf8_encode($ciudad->getCaCiudad()) . (($con) ? "(" . ($con + 1) . ")" : ""),
                "idtrafico" => $ciudad->getCaIdtrafico(),
                "trafico" => utf8_encode($ciudad->getTrafico()->getCaNombre()),
                "ciudad_trafico" => utf8_encode($ciudad->getTrafico()->getCaNombre() . " " . $ciudad->getCaCiudad())
            );
        }

        $this->trafico = $trafico = $this->getUser()->getIdtrafico();
    }

    public function executeUsuarios() {
        //echo $this->getRequestParameter("perfil");

        $this->usuarios = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->innerJoin("u.UsuarioPerfil up")
                ->where("u.ca_activo=? AND up.ca_perfil=? ", array('TRUE', $this->perfil))
                ->addOrderBy("u.ca_idsucursal")
                ->addOrderBy("u.ca_nombre")
                ->execute();
    }

    public function executeWidgetAgente() {

        $agentes = Doctrine_Query::create()
                ->select("a.*, i.ca_nombre, t.ca_idtrafico, t.ca_nombre,c.ca_ciudad,s.ca_direccion")
                ->from("IdsAgente a")
                ->innerJoin("a.Ids i")
                ->innerJoin("i.IdsSucursal s")
                ->innerJoin("s.Ciudad c")
                ->innerJoin("c.Trafico t")
                ->where("s.ca_principal = ?", true)
                ->addWhere("a.ca_activo = ?", true)
                ->addOrderBy("i.ca_nombre")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
        $this->agentes = array();
        foreach ($agentes as $agente) {
            $ag = array("idagente" => $agente["a_ca_idagente"],
                "nombre" => utf8_encode($agente["i_ca_nombre"]),
                "pais" => utf8_encode($agente["t_ca_nombre"]),
                "idtrafico" => $agente["t_ca_idtrafico"],
                "ciudad" => utf8_encode($agente["c_ca_ciudad"]),
                "direccion" => utf8_encode($agente["s_ca_direccion"]),
                "tipo" => utf8_encode($agente["a_ca_tipo"]),
                "tplogistics" => utf8_encode($agente["a_ca_tplogistics"]),
                "consolcargo" => utf8_encode($agente["a_ca_consolcargo"])
            );

            $this->agentes[] = $ag;
            if ($agente["t_ca_idtrafico"] == "CN-086") {

                $ag["pais"] = "Hong Kong";
                $ag["idtrafico"] = "HK-852";
                $this->agentes[] = $ag;
            }

            if ($agente["t_ca_idtrafico"] == "HK-852") {
                $ag["pais"] = "China";
                $ag["idtrafico"] = "CN-086";
                $this->agentes[] = $ag;
            }
        }
    }

    public function executeWidgetSucursalAgente() {
        
    }

    public function executeWidgetComerciales() {
        $comerciales = UsuarioTable::getComerciales();
        $this->comercialesJson = array();
        foreach ($comerciales as $comercial) {
            $this->comercialesJson[] = array("login" => $comercial->getCaLogin(),
                "nombre" => utf8_encode($comercial->getCaNombre())
            );
        }
    }

    public function executeWidgetCoordinadoresAduana() {
        $usuarios = UsuarioTable::getCoordinadoresAduana();
        $this->usuarios = array();

        $this->usuarios[] = array("login" => '',
            "nombre" => utf8_encode("Ninguno Asignado")
        );
        foreach ($usuarios as $usuario) {
            $this->usuarios[] = array("login" => $usuario->getCaLogin(),
                "nombre" => utf8_encode($usuario->getCaNombre())
            );
        }
    }

    public function executeWidgetContinuacion() {
        $this->data = array();

        $this->data[] = array("impoexpo" => utf8_encode(Constantes::IMPO),
            "transporte" => utf8_encode(Constantes::AEREO),
            "modalidad" => "CABOTAJE");
        $this->data[] = array("impoexpo" => utf8_encode(Constantes::IMPO),
            "transporte" => utf8_encode(Constantes::MARITIMO),
            "modalidad" => "OTM");
        $this->data[] = array("impoexpo" => utf8_encode(Constantes::IMPO),
            "transporte" => utf8_encode(Constantes::MARITIMO),
            "modalidad" => "DTA");
        $this->data[] = array("impoexpo" => utf8_encode(Constantes::IMPO),
            "transporte" => utf8_encode(Constantes::AEREO),
            "modalidad" => "DTA");
        $this->data[] = array("impoexpo" => utf8_encode(Constantes::IMPO),
            "transporte" => utf8_encode(Constantes::MARITIMO),
            "modalidad" => "TRASLADO");
        $this->data[] = array("impoexpo" => utf8_encode(Constantes::IMPO),
            "transporte" => utf8_encode(Constantes::MARITIMO),
            "modalidad" => "TRANSBORDO");
        $this->data[] = array("impoexpo" => utf8_encode(Constantes::EXPO),
            "transporte" => utf8_encode(Constantes::AEREO),
            "modalidad" => "DTA");
    }

    public function executeWidgetContactoCliente() {
        $this->data = array();

        /* $this->data[] = array( "valor"=>utf8_encode(Constantes::AEREO ));
          $this->data[] = array( "valor"=>utf8_encode(Constantes::MARITIMO ));
          $this->data[] = array( "valor"=>utf8_encode(Constantes::TERRESTRE )); */
    }

    public function executeWidgetCliente() {
        $this->data = array();
    }

    public function executeWidgetIds() {
        
    }

    public function executeWidgetTercero() {
        
    }

    public function executeWidgetUsuario() {
        
    }

    public function executeWidgetTerceroWindow() {
        
    }

    public function executeWidgetConsignar() {
        $this->data = Doctrine::getTable("Bodega")
                ->createQuery("b")
                ->select("b.*")
                ->addOrderBy("b.ca_tipo ASC")
                ->addOrderBy("b.ca_nombre ASC")
                ->where("b.ca_tipo = ? OR b.ca_tipo = ?", array('Coordinador Logístico', 'Operador Multimodal'))
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();

        foreach ($this->data as $key => $val) {
            $this->data[$key]["b_ca_tipo"] = utf8_encode($this->data[$key]["b_ca_tipo"]);
            $this->data[$key]["b_ca_transporte"] = utf8_encode($this->data[$key]["b_ca_transporte"]);
            $this->data[$key]["b_ca_nombre"] = utf8_encode($this->data[$key]["b_ca_nombre"]);
        }
    }

    public function executeWidgetTipoBodega() {
        $this->data = Doctrine::getTable("Bodega")
                ->createQuery("b")
                ->select("b.ca_tipo, b.ca_transporte")
                ->addOrderBy("b.ca_tipo ASC")
                ->where("b.ca_tipo != ? AND b.ca_tipo != ?", array('Coordinador Logístico', 'Operador Multimodal'))
                ->distinct()
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();

        foreach ($this->data as $key => $val) {
            $this->data[$key]["b_ca_tipo"] = utf8_encode($this->data[$key]["b_ca_tipo"]);
            $this->data[$key]["b_ca_transporte"] = utf8_encode($this->data[$key]["b_ca_transporte"]);
        }
    }

    
     /**
     * @autor Natalie Puentes
     * @return     
     * @param sfRequest $request A request object               
         * modo :  hace referencia al transporte      
     */
    public function executeWidgetBodega() {
        if ($this->modo == Constantes::TERRESTRE) {
            $modo = constantes::MARITIMO;
        } else {
            $modo = $this->modo;
        }    
    }

    public function executeWidgetOTM() {
        if ($this->modo == Constantes::TERRESTRE) {
            $modo = constantes::MARITIMO;
        } else {
            $modo = $this->modo;
        }

        $this->data = Doctrine::getTable("Bodega")
                ->createQuery("b")
                ->select("b.*")
                ->addOrderBy("b.ca_tipo ASC")
                ->addOrderBy("b.ca_nombre ASC")
                ->distinct()
                ->where("b.ca_nombre<>'-' and ca_tipo='Operador Multimodal'")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();

        foreach ($this->data as $key => $val) {
            $arrTransporte = explode("|", $this->data[$key]["b_ca_transporte"]);
            $this->data[$key]["b_ca_tipo"] = utf8_encode($this->data[$key]["b_ca_tipo"]);
            $this->data[$key]["b_ca_nombre"] = utf8_encode($this->data[$key]["b_ca_nombre"]."-Nit:".$this->data[$key]["b_ca_identificacion"]." ".$this->data[$key]["b_ca_direccion"]) . "-" . $this->data[$key]["b_ca_tipo"];
            $this->data[$key]["b_ca_transporte"] = utf8_encode(Constantes::MARITIMO);
        }
    }

    public function executeWidgetCotizacion() {
        
    }

    public function executeWidgetParametros() {
        $this->data = array();
        
        $casos = explode(",", $this->caso_uso);
        
        foreach ($casos as $caso) {
            $datos = ParametroTable::retrieveByCaso($caso);
            foreach ($datos as $dato) {
                $this->data[] = array("id" => utf8_encode($dato->getCaIdentificacion()), "name" => utf8_encode($dato->getCaValor()), "caso_uso" => $dato->getCaCasouso());
            }
        }        
    }

    public function executeWidgetReporte() {
        
    }

    public function executeWidgetHbls() {
        
    }

    public function executeWidgetTicket() {
        
    }

    public function executeWidgetUploadImages() {

        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("swfupload/swfupload", 'last');
        $response->addJavaScript("swfupload/js/handlers", 'last');
    }

    public function executeWidgetTipoIdentificacion() {
        $this->tipos = Doctrine::getTable("IdsTipoIdentificacion")
                ->createQuery("t")
                ->leftJoin("t.Trafico tt")
                ->addOrderBy("t.ca_tipoidentificacion")
                ->execute();
    }

    public function executeWidgetConcepto() {
        $this->data = array();

        $q = Doctrine_Query::create()
                ->select("c.ca_idconcepto, c.ca_concepto, c.ca_transporte, c.ca_modalidad, c.ca_liminferior")
                ->from("Concepto c")
                ->addOrderBy("c.ca_liminferior");

        $q->fetchArray();

        $conceptos = $q->execute();

        $this->data = array();
        foreach ($conceptos as $concepto) {
            $this->data[] = array("idconcepto" => $concepto['ca_idconcepto'],
                "concepto" => $concepto['ca_concepto'],
                "transporte" => utf8_encode($concepto['ca_transporte']),
                "modalidad" => utf8_encode($concepto['ca_modalidad'])
            );
        }
    }
    
    public function executeWidgetCostos() {
        $this->data = array();

        $q = Doctrine::getTable("InoConcepto")
                        ->createQuery("c")
                        ->innerJoin("c.InoConceptoModalidad cm")
                        ->innerJoin("cm.Modalidad m") 
                        ->addWhere("c.ca_costo = ? ", true)
                        ->addWhere("m.ca_impoexpo = ? ", $this->impoexpo)
                        ->addWhere("m.ca_transporte = ? ", $this->transporte)
                        ->addWhere("m.ca_modalidad = ? ", $this->modalidad)
                        ->addOrderBy("c.ca_concepto");
        //echo $this->impoexpo."--".$this->transporte."<br>";
        //echo $q->getSqlQuery();

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
    }
    
    public function executeWidgetDeduccion() {
        $this->data = array();

        $q = Doctrine_Query::create()
                ->select("c.ca_iddeduccion as ca_idconcepto, c.ca_deduccion as ca_concepto, c.ca_impoexpo, c.ca_transporte, c.ca_modalidad")
                ->from("Deduccion c")
                ->addWhere("c.ca_habilitado = ?", true)
                ->addOrderBy("ca_concepto");

        $q->fetchArray();

        $conceptos = $q->execute();

        $this->data = array();
        foreach ($conceptos as $concepto) {
            
            
            $this->data[] = array("idconcepto" => $concepto['ca_idconcepto'],
                "concepto" => utf8_encode($concepto['ca_concepto']),
                "impoexpo" => utf8_encode($concepto['ca_impoexpo']),
                "transporte" => utf8_encode($concepto['ca_transporte']),
                "modalidad" => utf8_encode($concepto['ca_modalidad'])
            );
        }
    }
    
    public function executeWidgetEquipo( ){

    }
    
    public function executeWidgetCuentaContable( ){
        $cuentas = Doctrine::getTable("InoCuenta")
                        ->createQuery("c")
                        ->select("c.ca_idcuenta, c.ca_cuenta, c.ca_descripcion")
                        ->addOrderBy("c.ca_cuenta")
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();

        $last = null;
        $lastKey = null;
        foreach( $cuentas as $key=>$val ){
            //Evita que se cree movimiento en una cuenta que posee subcuentas
            if( $last && strpos($cuentas[$key]["ca_cuenta"], $last)!==false  ){ 
                unset( $cuentas[$lastKey] );
            }
            $cuentas[$key]["ca_cuenta"] = utf8_encode($cuentas[$key]["ca_cuenta"]);
            $cuentas[$key]["ca_descripcion"] = utf8_encode($cuentas[$key]["ca_descripcion"]);
            
            $lastKey = $key;
            $last = $cuentas[$key]["ca_cuenta"];
        }

        //Es necesario que la llave sea consecutivo o la funcion json_encode devolvera un valor incorrecto
        $this->cuentas = array();
        foreach( $cuentas as $cuenta ){
            $this->cuentas[] = $cuenta;
        }
    }
    
     public function executeWidgetTrackingEtapa( ){
         $etapas = Doctrine::getTable("TrackingEtapa")
                      ->createQuery("t")                      
                      ->addWhere("t.ca_departamento = ?", constantes::OTMDTA1)                      
                      ->orderBy("ca_orden")
                      ->execute();
        $this->data=array();
        foreach($etapas as $e)
        {
            $this->data[]=array("id"=>$e->getCaIdetapa(),"nombre"=>utf8_encode($e->getCaEtapa()),"impoexpo"=>utf8_encode($e->getCaImpoexpo()),"departamento"=>utf8_encode($e->getCaDepartamento()),"transporte"=>utf8_encode($e->getCaTransporte()));
        }
    }
    
    public function executeMultiWidget( ){
        
    }    
    
    public function executeWidgetReferencia( ){
        
    }    
    
    public function executeWgDocumentos( ){
        
        //$this->idsserie = ($this->getRequestParameter("serie")!="")?$this->getRequestParameter("serie"):"0";
        /*
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
            $this->tipoDocs[]=array("id"=>$t["ca_iddocumental"],"name"=>$t["ca_documento"]);                    
        }
        //print_r($this->tipoDocs);
         * 
         */
    }  
    
    public function executeWgCliente( ){
        
    }
    
    public function executeWgLinea( ){
        
    }

    public function executeWgModalidad( ){
        
    }
    
    public function executeWgTransporte( ){
        
        $this->data = array();
        $this->data[] = array("valor" => utf8_encode(Constantes::AEREO));
        $this->data[] = array("valor" => utf8_encode(Constantes::MARITIMO));
        $this->data[] = array("valor" => utf8_encode(Constantes::TERRESTRE));
    }

    public function executeWgImpoexpo( ){
        $this->data = array();
        $this->data[] = array("valor" => utf8_encode(Constantes::IMPO));
        $this->data[] = array("valor" => utf8_encode(Constantes::TRIANGULACION));
        $this->data[] = array("valor" => utf8_encode(Constantes::EXPO));
        $this->data[] = array("valor"=>utf8_encode(Constantes::OTMDTA ));
        $this->data[] = array("valor"=>utf8_encode(Constantes::INTERNO ));
    }
    
     public function executeWgCcostos( ){
         
        $centros = Doctrine::getTable("InoCentroCosto")
                              ->createQuery("c")
                              ->select("c.*")
                              ->where("c.ca_subcentro IS NULL")
                              ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                              ->execute();
        $centrosArray = array();
        foreach( $centros as $centro ){
            $centrosArray[ $centro["c_ca_centro"] ] = $centro["c_ca_nombre"];
        }


        $this->data = array();


        //TODO Crear widgets independientas para estos dos items
        $centros = Doctrine::getTable("InoCentroCosto")
                             ->createQuery("c")
                             ->where("c.ca_subcentro IS NOT NULL")
                             ->orderBy("c.ca_centro ASC")
                             ->addOrderBy("c.ca_subcentro ASC")
                             ->execute();

        foreach( $centros as $centro ){
            $centroStr = utf8_encode(str_pad($centro->getCaCentro(), 2, "0", STR_PAD_LEFT) ."-".str_pad($centro->getCaSubcentro(), 2, "0", STR_PAD_LEFT)." ".$centrosArray[$centro->getCaCentro()]." » ".$centro->getCaNombre());
            $this->data[] = array("id"=>$centro->getCaIdccosto(),
                                    "name"=> $centroStr
            );
        }
    }

    public function executeWgConceptos( ){
        
    }
    
    
}

?>

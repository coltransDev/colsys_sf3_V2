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
        $this->incoterms="[";
        $incotmp="";
        foreach ($incoterms as $incoterm) {
            $incotmp.=($incotmp!="")?",":"";
            $incotmp.="['". $incoterm->getCaValor()."']";
        }
        $this->incoterms.=$incotmp."]";
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
        //$this->data[] = array( "valor"=>utf8_encode(Constantes::OTMDTA ));
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
        $sucursales = Doctrine::getTable("Sucursal")
                        ->createQuery("s")
                        ->select("s.ca_idsucursal,s.ca_nombre")
                        ->addOrderBy("s.ca_nombre")
                        ->addWhere("s.ca_idempresa=?",$user->getIdempresa())
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();

        foreach ($sucursales as $sucursal) {
            $this->data[] = array("id"=>$sucursal["s_ca_idsucursal"],"valor" => utf8_encode($sucursal["s_ca_nombre"]));
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
                        ->addWhere("d.ca_idempresa=?",$user->getIdempresa())
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();

        foreach ($rows as $r) {
            $this->data[] = array("id"=>$r["d_ca_iddepartamento"],"valor" => utf8_encode($r["d_ca_nombre"]));
        }
    }
    
    public function executeWidgetMuelles() {
    //echo $this->ciudad;
        $this->data = array();
     
        if($this->ciudad=="CTG-0005")
        {
            $this->data[] = array("id"=>"2257","valor" =>"Muelles El Bosque S.A." );
            $this->data[] = array("id"=>"2261","valor" =>"Soc.Portuaria Reg.Decartagenas.Adeposito" );
            $this->data[] = array("id"=>"2259","valor" =>"Contecar Tnal C/Nedor.C/Genas.A.Deposito" );
        }
        else if($this->ciudad=="BUN-0002")
        {
            $this->data[] = array("id"=>"2366","valor" =>"Soc.Port.Regional B/Tura S.A." );
            $this->data[] = array("id"=>"2918","valor" =>"SOCIEDAD PORTUARIA TERMINAL DE CONTENEDORES DE BUENAVENTURA S.A. T.C.BUENA S.A." );
        }
        else if($this->ciudad=="BAQ-0005")
        {
            $this->data[] = array("id"=>"2031","valor" =>"Soc.Port.Regionalde B/Quillas.A.Deposito" );
        }
        else if($this->ciudad=="STA-0005")
        {
            $this->data[] = array("id"=>"2435","valor" =>"SOCIEDAD PORTUARIA REGIONAL DE SANTA MARTA S.A" );
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
                        ->select("p.ca_idproveedor, p.ca_sigla, id.ca_nombre, p.ca_transporte, p.ca_activo_impo, p.ca_activo_expo ")
                        ->from("IdsProveedor p")
                        ->innerJoin("p.Ids id")
                        ->addOrderBy("id.ca_nombre");
        $q->addWhere("p.ca_tipo = ? OR p.ca_tipo = ?", array("TRI", "TRN"));

        //$q->addWhere("p.ca_activo = ?", true );

        $q->fetchArray();

        $lineas = $q->execute();

        $this->data = array();
        foreach ($lineas as $linea) {
            $this->data[] = array("idlinea" => $linea['ca_idproveedor'],
                "linea" => utf8_encode(($linea['ca_sigla'] ? $linea['ca_sigla'] . " - " : "") . $linea['Ids']['ca_nombre']),
                "transporte" => utf8_encode($linea['ca_transporte']),
                "activo_impo" => $linea['ca_activo_impo'],
                "activo_expo" => $linea['ca_activo_expo']
            );
        }
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
                $con=0;
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
                "tplogistics" => utf8_encode($agente["a_ca_tplogistics"])
            );

            $this->agentes[] = $ag;
            if ( $agente["t_ca_idtrafico"] == "CN-086") {

                $ag["pais"] = "Hong Kong";
                $ag["idtrafico"] = "HK-852";
                $this->agentes[] = $ag;
                
            }

            if ( $agente["t_ca_idtrafico"] == "HK-852") {
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

    public function executeWidgetBodega() {

//        $casos=$this->transporte;

        if ($this->modo == Constantes::TERRESTRE){
            $modo = constantes::MARITIMO;
        }else{
            $modo=$this->modo;
        }

        $this->data = Doctrine::getTable("Bodega")
                        ->createQuery("b")
                        ->select("b.*")
                        ->addOrderBy("b.ca_tipo ASC")
                        ->addOrderBy("b.ca_nombre ASC")
                        ->distinct()
                        ->where("b.ca_transporte like ? and b.ca_nombre<>'-'", "%" . $modo . "%")
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();

        
        foreach ($this->data as $key => $val) {
            $arrTransporte = explode("|", $this->data[$key]["b_ca_transporte"]);


            $this->data[$key]["b_ca_tipo"] = utf8_encode($this->data[$key]["b_ca_tipo"]);
            $this->data[$key]["b_ca_nombre"] = utf8_encode($this->data[$key]["b_ca_nombre"]) . "-" . $this->data[$key]["b_ca_tipo"];
            $this->data[$key]["b_ca_transporte"] = $modo;

            
            
        }
    }

    public function executeWidgetCotizacion() {

    }

    public function executeWidgetParametros() {
        $this->data = array();
        //echo $this->getRequestParameter("caso_uso");
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
		$response->addJavaScript("swfupload/swfupload",'last');
        $response->addJavaScript("swfupload/js/handlers",'last');
        
        
    }
    
    public function executeWidgetTipoIdentificacion() {
        $this->tipos = Doctrine::getTable("IdsTipoIdentificacion")
                                ->createQuery("t")
                                ->leftJoin("t.Trafico tt")
                                ->addOrderBy("t.ca_tipoidentificacion")
                                ->execute();
    }
    

}

?>

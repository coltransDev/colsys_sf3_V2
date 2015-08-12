<?php

/**
 * formulario actions.
 *
 * @package    colmob
 * @subpackage formulario
 * @author     Gabriel Martinez Rojas
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class formularioActions extends sfActions {

    const RUTINA = 144;

    /**
     * Realiza un duplicado del objeto con todas sus relaciones.
     * @param sfWebRequest $request
     */
    public function executeCloneForm(sfWebRequest $request) {
        $id = $request->getParameter('ca_id');
        $idDecode = base64_decode($id);
        $idFormulario = intval($idDecode);

        $form = Doctrine_Core::getTable('formulario')->find($idFormulario);

        //$form->getTbBloques();
        $new_formulario = $form->copy();
        $new_formulario->setCaTitulo($new_formulario->getCaTitulo() . "-COPIA");
        $new_formulario->save();

        $bloques = $form->getTbBloques();
        foreach ($bloques as $bloque) {
            $new_bloque = $bloque->copy();
            $new_bloque->setCaIdformulario($new_formulario->getCaId());
            $new_bloque->save();

            $preguntas = $bloque->getTbPreguntas();
            foreach ($preguntas as $pregunta) {
                $new_pregunta = $pregunta->copy();
                $new_pregunta->setCaIdbloque($new_bloque->getCaId());
                $new_pregunta->save();

                $opciones = $pregunta->getTbOpciones();
                foreach ($opciones as $opcion) {
                    $new_opcion = $opcion->copy();
                    $new_opcion->setCaIdpregunta($new_pregunta->getCaId());
                    $new_opcion->save();
                }
            }
        }

        $formulario = new Formulario();
        $this->filtroFormulario = new FormularioFormFilter();
        $this->pager = new sfDoctrinePager('formulario', 30);
        $this->pager->setQuery($formulario->getQueryFormulario());
        $this->pager->setPage($request->getParameter('pagina', 1));
        $this->pager->init();
        $this->setTemplate('index');
        $this->setLayout('layout_home');
    }

    /**
     * Listado de formularios
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request) {

        $id = $request->getParameter('id');
        $this->user = $this->getUser();
        $this->nivel = $this->user->getNivelAcceso(formularioActions::RUTINA);

        $this->id = $id;
        
        $formulario = new Formulario();
        $this->filtroFormulario = new FormularioFormFilter();
        $this->pager = new sfDoctrinePager('formulario', 30);
        if ($id) {
            $this->pager->setQuery($formulario->getQueryFormularioBySede($id));
        } else {
            $this->pager->setQuery($formulario->getQueryFormulario());
        }
        $this->pager->setPage($request->getParameter('pagina', 1));
        $this->pager->init();
        $this->setLayout('layout_home');
    }

    /**
     * Filtra el listado de formularios
     * @param sfWebRequest $request
     */
    public function executeFiltrar(sfWebRequest $request) {
        $this->filtroFormulario = new FormularioFormFilter();
        $this->filtroFormulario->bind($request->getParameter(
                        $this->filtroFormulario->getName()));
        $this->pager = new sfDoctrinePager(
                'formulario', 500);
        $this->pager->setQuery($this->filtroFormulario->getQuery());
        $this->pager->setPage(
                $request->getParameter('pagina', 1));
        $this->pager->init();
        $this->setTemplate('index');
        $this->setLayout('layout_home');
    }

    /**
     * Espejo del metodo vista previa con el fin de usar este metodo para las urls que se le envian a los clientes.
     * @param sfWebRequest $request 
     */
    public function executeServicios(sfWebRequest $request) {

        $id = $request->getParameter('id');
        $idFormularioEncode = $id;
        $idDecode = base64_decode($id);
        $idFormulario = intval($idDecode);
        $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);
        $contacto = $request->getParameter('co');
        $idContacto = $contacto;
        $contactoDecode = base64_decode($idContacto);
        $num_contacto = intval($contactoDecode);

        function getExisteControl($num_contacto, $idFormulario) {
            $q = Doctrine_Query::create()
                    ->from('controlEncuesta')
                    ->where('ca_id_contestador = ?', $num_contacto)
                    ->andWhere('ca_idformulario = ?', $idFormulario);
            return $q->fetchOne();
        }
        
        $fchCierre = $this->formulario->getCaCierre();
        $hoy = date('Y-m-d');
        
        if ($hoy >= $fchCierre) {
            $this->setTemplate('cerrado');
            $detect = new Mobile_Detect();
            $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
            $this->device = $dispositivo;
            if ($dispositivo == 'mobile') {
                $this->setLayout('mobile/formulario');
            } elseif ($dispositivo == 'tablet') {
                $this->setLayout('mobile/formulario');
            } else {
                $this->setLayout('formulario');
            }
            if ($bloque) {
                $this->setTemplate('selServicios');
            }
        } else {

            $existe_contacto = getExisteControl($num_contacto, $idFormulario);

            if ($existe_contacto) {

                $this->setTemplate('guardado');
                $detect = new Mobile_Detect();
                $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
                $this->device = $dispositivo;
                if ($dispositivo == 'mobile') {
                    $this->setLayout('mobile/formulario');
                } elseif ($dispositivo == 'tablet') {
                    $this->setLayout('mobile/formulario');
                } else {
                    $this->setLayout('formulario');
                }
                if ($bloque) {
                    $this->setTemplate('selServicios');
                }
            } else {
                $bloque = $this->formulario->getBloqueServicio($idFormulario);
                $this->bloque = $bloque;
                $this->idContacto = $idContacto;
                $this->idFormulario = $idFormularioEncode;
                $detect = new Mobile_Detect();
                $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
                $this->device = $dispositivo;
                if ($dispositivo == 'mobile') {
                    $this->setLayout('mobile/formulario');
                } elseif ($dispositivo == 'tablet') {
                    $this->setLayout('mobile/formulario');
                } else {
                    $this->setLayout('formulario');
                }
                if ($bloque) {
                    $this->setTemplate('selServicios');
                }
            }
        }
    }
    
    /**
     * Reporte Global de las encuestas enviadas y contestadas con gráficas
     * @param sfWebRequest $request 
     */
    public function executeReporteDetalladoExt4(sfWebRequest $request) {
        
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("highcharts/js/highcharts", 'last');
        $response->addJavaScript("highcharts/js/modules/exporting", 'last');
        
        $idFormulario = intval(base64_decode($request->getParameter('id')));
        $this->forward404Unless($idFormulario);
        $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);

        $servicio = $request->getParameter("servicio");        
        $this->servicio = Doctrine::getTable("ColsysConfigValue")
                ->createQuery('cf')
                ->select('cf.ca_ident')
                ->where("cf.ca_idconfig = 211")
                ->addWhere("cf.ca_value = ?", $servicio)
                ->fetchOne();

        $options = array();
        $options["idsucursal"] = $request->getParameter("idsucursal");;
        $options["sucursal"] = $request->getParameter("sucursal");
        $options["login"] = $request->getParameter("login");
        $options["comercial"] = $request->getParameter("vendedor");
        $options["idcliente"] = $request->getParameter("idcliente");
        $options["cliente"] = $request->getParameter("Cliente");
        $options["idservicio"] = $servicio ? $this->servicio->getCaIdent() : null;
        $options["idpregunta"] = $request->getParameter("pregunta");

        if ($options["idpregunta"]) {
            $this->pregunta = Doctrine::getTable("Pregunta")->findBy("ca_id", $options["idpregunta"]);
            $primero = strip_tags($this->pregunta[0]->getCaTexto());
            $texto = html_entity_decode($primero, ENT_COMPAT, 'ISO-8859-1');
        }
        
        $options["pregunta"] = $texto;
        $this->options = $options;

        $encEnv = $this->formulario->getNumEncuestasEnviadas($options);                
        $encAvg = $this->formulario->getListaEncuestasDiligenciadas($options, true);

        $clientes = array();
        $sucursales = array();
        $encuestas = array();
        
        foreach ($encEnv as $enc) {

            if (!in_array(utf8_encode($enc["s_ca_idsucursal"]), $encuestas)) {
                $encuestas[utf8_encode($enc["s_ca_nombre"])]["idsucursal"] = $enc["s_ca_idsucursal"];
            }
            $encuestas[utf8_encode($enc["s_ca_nombre"])]["totEnv"] ++;

            if (!in_array($enc["i_ca_nombre"], $clientes)) {
                $clientes[] = $enc["i_ca_nombre"];
                $encuestas[utf8_encode($enc["s_ca_nombre"])]["cliEnv"] ++;
            }

            if (!in_array(utf8_encode($enc["s_ca_nombre"]), $sucursales)) {
                $sucursales[] = utf8_encode($enc["s_ca_nombre"]);
            }
        }

        $clientes1 = array();
        $this->sucRes = array();
        $this->encuestas3 = array();
        $this->encuestas4 = array();
        $this->encuestas5 = array();
        
        foreach ($encAvg as $enc) {
            if (!in_array(utf8_encode($enc["s_ca_nombre"]), $this->sucRes)) {
                $this->sucRes[] = utf8_encode($enc["s_ca_nombre"]);
            }

            $encuestas1[utf8_encode($enc["s_ca_nombre"])]["idsucursal"] = $enc["s_ca_idsucursal"];
            $encuestas[utf8_encode($enc["s_ca_nombre"])]["idservicio"] = $enc["cf_ca_ident"];
            $encuestas[utf8_encode($enc["s_ca_nombre"])]["idpregunta"] = $enc["p_ca_id"];
            $encuestas2[utf8_encode($enc["cf_ca_value"])]["idservicio"] = $enc["cf_ca_ident"];

            if (!in_array($enc["i_ca_nombre"], $clientes1)) {
                $clientes1[] = $enc["i_ca_nombre"];
                $encuestas[utf8_encode($enc["s_ca_nombre"])]["totRes"] ++;
            }

            $encuestas1[utf8_encode($enc["s_ca_nombre"])]["suma"]+=$enc["re_ca_resultado"];
            $encuestas1[utf8_encode($enc["s_ca_nombre"])]["casos"] ++;

            $encuestas2[utf8_encode($enc["cf_ca_value"])]["suma"]+=$enc["re_ca_resultado"];
            $encuestas2[utf8_encode($enc["cf_ca_value"])]["casos"] ++;

            if (utf8_encode($enc["s_ca_nombre"])) {
                $this->encuestas3[utf8_encode($enc["cf_ca_value"])][utf8_encode($enc["s_ca_nombre"])]["suma"]+=$enc["re_ca_resultado"];
                $this->encuestas3[utf8_encode($enc["cf_ca_value"])][utf8_encode($enc["s_ca_nombre"])]["casos"] ++;
                $this->encuestas5[utf8_encode($enc["cf_ca_value"])][utf8_encode($enc["s_ca_nombre"])][$enc["i_ca_nombre"]] = 1;
                $this->encuestas4[html_entity_decode($enc["p_ca_texto"], ENT_COMPAT, 'ISO-8859-1')][utf8_encode($enc["cf_ca_value"])][utf8_encode($enc["s_ca_nombre"])]["suma"]+=$enc["re_ca_resultado"];
                $this->encuestas4[html_entity_decode($enc["p_ca_texto"], ENT_COMPAT, 'ISO-8859-1')][utf8_encode($enc["cf_ca_value"])][utf8_encode($enc["s_ca_nombre"])]["casos"] ++;
            } else {
                $this->encuestas3[utf8_encode($enc["cf_ca_value"])]["Sin asignar"]["suma"]+=$enc["re_ca_resultado"];
                $this->encuestas3[utf8_encode($enc["cf_ca_value"])]["Sin asignar"]["casos"] ++;
                $this->encuestas5[utf8_encode($enc["cf_ca_value"])]["Sin asignar"][$enc["i_ca_nombre"]] = 1;
                $this->encuestas4[html_entity_decode($enc["p_ca_texto"], ENT_COMPAT, 'ISO-8859-1')][utf8_encode($enc["cf_ca_value"])]["Sin asignar"]["suma"]+=$enc["re_ca_resultado"];
                $this->encuestas4[html_entity_decode($enc["p_ca_texto"], ENT_COMPAT, 'ISO-8859-1')][utf8_encode($enc["cf_ca_value"])]["Sin asignar"]["casos"] ++;
            }
        }
        
        $this->grid1 = array();
        ksort($encuestas);
        foreach ($encuestas as $sucursal => $gridSucursal) {
            $this->grid1[] = array(
                "title" => utf8_encode($this->formulario->getCaTitulo()),
                "idform" => utf8_encode($this->formulario->getCaId()),
                "idpregunta" => $gridSucursal["idservicio"],
                "idservicio" => $gridSucursal["idpregunta"],
                "idsucursal" => $gridSucursal["idsucursal"],
                "sucursal" => $sucursal==null?"Sin asignar":$sucursal,
                "totEnv" => $gridSucursal["totEnv"],
                "cliEnv" => $gridSucursal["cliEnv"],
                "totRes" => $gridSucursal["totRes"]
            );
        }
        
        $this->grid2 = array();
        ksort($encuestas1);
        foreach ($encuestas1 as $sucursal => $gridSucursal) {
            $this->grid2[] = array(
                "title" => utf8_encode($this->formulario->getCaTitulo()),
                "idform" => utf8_encode($this->formulario->getCaId()),
                "idsucursal" => $gridSucursal["idsucursal"],
                "sucursal" => $sucursal==null?"Sin asignar":$sucursal,
                "promedio" => round(($gridSucursal["suma"] / $gridSucursal["casos"]), 2),
                "suma" => $gridSucursal["suma"],
                "casos" => $gridSucursal["casos"]
            );
        }
        
        $this->grid3 = array();
        ksort($encuestas2);
        foreach ($encuestas2 as $servicio => $gridServicio) {
            $this->grid3[] = array(
                "title" => utf8_encode($this->formulario->getCaTitulo()),
                "idform" => utf8_encode($this->formulario->getCaId()),
                "idservicio" => $gridServicio["idservicio"],
                "servicio" => $servicio==null?"Sin asignar":$servicio,
                "promedio" => round(($gridServicio["suma"] / $gridServicio["casos"]), 2),
                "suma" => $gridServicio["suma"],
                "casos" => $gridServicio["casos"]
            );
        }
        
        ksort($this->encuestas3);
        ksort($this->encuestas4);
        asort($this->sucRes);

        $detect = new Mobile_Detect();
        $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
        $this->device = $dispositivo;
    }

    /**
     * Carga el listado de contactos que diligenciaron la encuesta
     * @param sfWebRequest $request
     */
    public function executeContactosExt4(sfWebRequest $request) {
        
        $idFormulario = $request->getParameter('ca_id');
        $this->forward404Unless($idFormulario);
        $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);
        $this->sucursal = $request->getParameter('sid');
        $this->pregunta = $request->getParameter('pid');
        $this->p_servicio = $request->getParameter('seid');
        $this->servicio = null;
        if ($this->p_servicio != '0') {
            $this->servicio = Doctrine_Core::getTable('opcion')->find(intval($this->p_servicio));
        }
        if ($this->pregunta == '0') {
            $this->lPregunta = "Todas";
        } else {
            $pregunta = Doctrine_Core::getTable('pregunta')->find(intval($this->pregunta));
            $this->lPregunta = $pregunta->getCaTexto();
        }

        $this->pregunta = $request->getParameter('pid');
        $this->servicio = $request->getParameter('seid');
        
        $idsucursal = $request->getParameter('idsucursal');

        $options["login"] = $request->getParameter('login');
        $options["idcliente"] = $request->getParameter('idcliente');
        $options["idservicio"] = $request->getParameter('seid');
        $options["idpregunta"] = $request->getParameter('pid');
        $options["sucursal"] = $idsucursal == "NA" ? "Todas Las sucursales" : ($idsucursal == null ? "Sin asignar" : "");

        if ($idsucursal && $idsucursal != "NA") {
            $sucursal = Doctrine::getTable("Sucursal")->find($idsucursal);
            $options["sucursal"] = $sucursal->getCaNombre();
        }
        
        $contactos = $this->formulario->getListaEncuestasDiligenciadas($options, true);
        
        foreach($contactos as $contacto){
            $cliente[$contacto["i_ca_nombre"]]["suma"]+= $contacto["re_ca_resultado"];
            $cliente[$contacto["i_ca_nombre"]]["casos"]++;
        }
        
        $listaContactos = array();
        $this->contactos = array();        
        foreach ($contactos as $contacto) {
            
            $seguimientos = Doctrine::getTable("EveCliente")
                    ->createQuery("e")
                    ->where("e.ca_asunto = ? ", $this->formulario->getCaTitulo())
                    ->addWhere("e.ca_idcliente = ?", $contacto["i_ca_id"])
                    ->orderBy("e.ca_fchevento ASC")
                    ->execute();
            
            if (!in_array(utf8_encode($contacto["cc_ca_nombres"])." ".utf8_encode($contacto["cc_ca_papellido"]), $listaContactos)) {
                $listaContactos[] = utf8_encode($contacto["cc_ca_nombres"])." ".utf8_encode($contacto["cc_ca_papellido"]);                
                $this->contactos[] = array(                    
                    "title" => utf8_encode($this->formulario->getCaTitulo()), 
                    "idform" => $this->formulario->getCaId(),
                    "idcliente" => $contacto["i_ca_id"],
                    "idencuesta" => $contacto["ce_ca_id"],
                    "compania" => utf8_encode($contacto["i_ca_nombre"]), 
                    "nombre" => utf8_encode($contacto["cc_ca_nombres"])." ".utf8_encode($contacto["cc_ca_papellido"]),
                    "sucursal"=> utf8_encode($contacto["s_ca_nombre"]), 
                    "comercial" =>  utf8_encode($contacto["u_ca_nombre"]),
                    "promedio" => round(($cliente[$contacto["i_ca_nombre"]]["suma"]/$cliente[$contacto["i_ca_nombre"]]["casos"]),2),
                    "seguimiento" => count($seguimientos)>0?true:false);                
            }
        }
        
        $detect = new Mobile_Detect();
        $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
        $this->device = $dispositivo;
    }
    
    public function executeContactosDetalladoExt4(sfWebRequest $request) {
        
        $idFormulario = $request->getParameter('ca_id');
        $this->forward404Unless($idFormulario);
        $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);

        $this->pregunta = $request->getParameter('pid');
        $this->servicio = $request->getParameter('seid');
        
        $idsucursal = $request->getParameter('idsucursal');

        $options["login"] = $request->getParameter('login');
        $options["idcliente"] = $request->getParameter('idcliente');
        $options["idservicio"] = $request->getParameter('seid');
        $options["idpregunta"] = $request->getParameter('pid');
        $options["sucursal"] = $idsucursal == "NA" ? "Todas Las sucursales" : ($idsucursal == null ? "Sin asignar" : "");

        if ($idsucursal && $idsucursal != "NA") {
            $sucursal = Doctrine::getTable("Sucursal")->find($idsucursal);
            $options["sucursal"] = $sucursal->getCaNombre();
        }
        
        $contactos = $this->formulario->getListaEncuestasDiligenciadas($options, true);
        
        foreach($contactos as $contacto){
            $cliente[$contacto["i_ca_nombre"]]["suma"]+= $contacto["re_ca_resultado"];
            $cliente[$contacto["i_ca_nombre"]]["casos"]++;
        }
        
        $listaContactos = array();
        $this->contactos = array();        
        foreach ($contactos as $contacto) {
            
            $seguimientos = Doctrine::getTable("EveCliente")
                    ->createQuery("e")
                    ->where("e.ca_asunto = ? ", $this->formulario->getCaTitulo())
                    ->addWhere("e.ca_idcliente = ?", $contacto["i_ca_id"])
                    ->orderBy("e.ca_fchevento ASC")
                    ->execute();
            
            $this->contactos[] = array(                    
                "title" => utf8_encode($this->formulario->getCaTitulo()), 
                "idform" => $this->formulario->getCaId(),
                "idcliente" => $contacto["i_ca_id"],
                "idencuesta" => $contacto["ce_ca_id"],
                "compania" => utf8_encode($contacto["i_ca_nombre"]), 
                "nombre" => utf8_encode($contacto["cc_ca_nombres"])." ".utf8_encode($contacto["cc_ca_papellido"]),
                "sucursal"=> utf8_encode($contacto["s_ca_nombre"]), 
                "comercial" =>  utf8_encode($contacto["u_ca_nombre"]),
                "pregunta"=>utf8_encode($contacto["p_ca_texto"]),
                "resultado"=>$contacto["re_ca_resultado"],
                "servicio"=>utf8_encode($contacto["cf_ca_value"]),
                "seguimiento" => count($seguimientos)>0?true:false);                

        }
        
        $detect = new Mobile_Detect();
        $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
        $this->device = $dispositivo;
    }
    
    /**
     * Listado que muestra las empresas a las cuáles se envió la encuesta
     * @param sfWebRequest $request
     */
    public function executeListaEmpresasEnviadasExt4(sfWebRequest $request) {
        
        $idFormulario = $request->getParameter('ca_id');
        $this->forward404Unless($idFormulario);
        $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);
        
        $idsucursal = $request->getParameter('idsucursal');
        
        $options = array();
        $options["sucursal"] = $idsucursal == "NA" ? "Todas Las sucursales" : ($idsucursal == null ? "Sin asignar" : "");
        $options["login"] = $request->getParameter('login');
        $options["idcliente"] = $request->getParameter('idcliente');

        if ($idsucursal && $idsucursal != "NA") {
            $sucursal = Doctrine::getTable("Sucursal")->find($idsucursal);
            $options["sucursal"] = $sucursal->getCaNombre();
        }

        $empresas = $this->formulario->getNumEncuestasEnviadas($options);
        
        $this->empresas = array();        
        foreach ($empresas as $empresa) {
            $this->empresas[] = array("title"=> $this->formulario->getCaTitulo(), 
                "idform" => $this->formulario->getCaId(),
                "idemail" => $empresa["e_ca_idemail"],
                "compania" => utf8_encode($empresa["i_ca_nombre"]) , 
                "sucursal"=> $idsucursal==null?"Sin asignar":utf8_encode($empresa["s_ca_nombre"]), 
                "comercial" =>  utf8_encode($empresa["u_ca_nombre"]),
                "fchenvio"=> $empresa["e_ca_fchenvio"]);
        }
        
        $detect = new Mobile_Detect();
        $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
        $this->device = $dispositivo;       
    }

    /**
     * Carga la encuesta de servicio, luego de recibir como parÃ¡metro el listado de servicios previamente seleccionados por el usuario.
     * @param sfWebRequest $request
     */
    public function executeContactos(sfWebRequest $request) {
        
        $this->user = $this->getUser();
        $this->nivel = $this->user->getNivelAcceso(formularioActions::RUTINA);
        
        $id = $request->getParameter('ca_id');
        $idDecode = base64_decode($id);
        $this->idFormulario = intval($idDecode);
        
        $detect = new Mobile_Detect();
        $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
        $this->device = $dispositivo;
        $this->setLayout('layout_home');
    }

    /**
     * Carga la encuesta de servicio, luego de recibir como parÃ¡metro el listado de servicios previamente seleccionados por el usuario.
     * @param sfWebRequest $request
     */
    public function executeEncuesta(sfWebRequest $request) {
        $this->email = 'gmartinez@coltrans.com.co';
        $this->empresa = 2;
        $id = $request->getParameter('id');
        $idDecode = base64_decode($id);
        $idFormulario = intval($idDecode);

        $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);
        $this->contacto = $request->getParameter('co');

        $detect = new Mobile_Detect();
        $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
        $this->device = $dispositivo;
        if ($dispositivo == 'mobile') {
            $this->setLayout('mobile/formulario');
        } elseif ($dispositivo == 'tablet') {
            $this->setLayout('mobile/formulario');
        } else {
            $this->setLayout('formulario');
        }

        $servicios = array();
        $i = -1;
        $servicios[0] = "";
        foreach ($request->getPostParameters() as $param => $val) {
            ++$i;
            $parampreg = explode('_', $param);
            $idpregunta = $parampreg[1];
            $servicios[$i] = $val;
        }
        $this->servicios = $servicios;
    }

    /**
     * Muestra el detalle de un formulario
     * @param sfWebRequest $request
     */
    public function executeShow(sfWebRequest $request) {
        $this->user = $this->getUser();
        $this->nivel = $this->user->getNivelAcceso(formularioActions::RUTINA);
        $this->formulario = Doctrine_Core::getTable('formulario')->find(array($request->getParameter('ca_id')));
        $this->forward404Unless($this->formulario);
        $this->setLayout('layout_home');
    }

    /**
     * Permite crear un nuevo formulario.
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new formularioForm();
        $this->setLayout('layout_home');
    }

    /**
     * Vista que se carga en caso de fallos al intentar crear un formulario. 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new formularioForm();
        $this->processForm($request, $this->form);
        $this->setTemplate('new');
        $this->setLayout('layout_home');
    }

    /**
     * Permite editar un formulario
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($formulario = Doctrine_Core::getTable('formulario')->find(array($request->getParameter('ca_id'))), sprintf('El Objeto (%s) tipo formulario no existe.', $request->getParameter('ca_id')));
        $this->form = new formularioForm($formulario);
        $this->setLayout('layout_home');
    }

    /**
     * Permite actualizar la informaciÃ³n de un formulario
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($formulario = Doctrine_Core::getTable('formulario')->find(array($request->getParameter('ca_id'))), sprintf('El Objeto (%s) tipo formulario no existe.', $request->getParameter('ca_id')));
        $this->form = new formularioForm($formulario);
        $this->processForm($request, $this->form);
        $this->setTemplate('edit');
        $this->setLayout('layout_home');
    }

    /**
     * Permite eliminar un formulario
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();
        $this->forward404Unless($formulario = Doctrine_Core::getTable('formulario')->find(array($request->getParameter('ca_id'))), sprintf('El Objeto (%s) tipo formulario no existe.', $request->getParameter('ca_id')));
        $formulario->delete();
        $this->getUser()->setFlash('notice', 'Formulario Eliminado!!!.');
        $this->redirect('formulario/index');
        $this->setLayout('layout_home');
    }

    public function executeEnvioEmailsPrueba() {
        $clientes = array();
        
        $clientes["BANCO DE BOGOTA S.A."]["ca_idcontacto"] = 11124;
        $clientes["BANCO DE BOGOTA S.A."]["ca_email"] = "alramirez@coltrans.com.co";
        
        $clientes["A2 INGENIERIA LTDA."]["ca_idcontacto"] = 14835;
        $clientes["A2 INGENIERIA LTDA."]["ca_email"] = "mmgonzalez@coltrans.com.co";
        
        $clientes["ACERSHOES LTDA."]["ca_idcontacto"] = 9143;
        $clientes["ACERSHOES LTDA."]["ca_email"] = "cazambrano@coltrans.com.co";
        
        $clientes["AGAVAL S.A"]["ca_idcontacto"] = 15571;
        $clientes["AGAVAL S.A"]["ca_email"] = "mpulido@coltrans.com.co";
        
        $clientes["AFA MEDICAL WORLD SAS"]["ca_idcontacto"] = 14386;
        $clientes["AFA MEDICAL WORLD SAS"]["ca_email"] = "icastiblanco@coltrans.com.co";
        
        $clientes["AMAREY NOVAMEDICAL S A"]["ca_idcontacto"] = 1029;
        $clientes["AMAREY NOVAMEDICAL S A"]["ca_email"] = "pizquierdo@coltrans.com.co";
        
        $clientes["ALLERS S.A."]["ca_idcontacto"] = 11784;
        $clientes["ALLERS S.A."]["ca_email"] = "tdiaz@coltrans.com.co";
        
        $clientes["ASCENSORES ANDINO SAS "]["ca_idcontacto"] = 13774;
        $clientes["ASCENSORES ANDINO SAS "]["ca_email"] = "oviasus@coltrans.com.co";
        
        $clientes["ALPINA PRODUCTOS ALIMENTICIOS S A"]["ca_idcontacto"] = 15056;
        $clientes["ALPINA PRODUCTOS ALIMENTICIOS S A"]["ca_email"] = "yydiaz@coltrans.com.co";
        
        $clientes["AVE COLOMBIANA S.A.S"]["ca_idcontacto"] = 649;
        $clientes["AVE COLOMBIANA S.A.S"]["ca_email"] = "acmoreno@coltrans.com.co";
        
        $clientes["BRILLADORA EL DIAMANTE S.A"]["ca_idcontacto"] = 15529;
        $clientes["BRILLADORA EL DIAMANTE S.A"]["ca_email"] = "apsanchez@coltrans.com.co";
        
        $empresa = "COLTRANS S.A.S";
        $idformulario = 11;
        $emails_Control = "";
        $asunto = "Dos minutos de su tiempo nos ayuda a prestarle un mejor servicio";
        $emailFrom = "no-response@coltrans.com.co";
        foreach ($clientes as $key=> $cli) {            
            try {
                $contacto = $cli["ca_idcontacto"];
                $html = $this->getPartial('formulario/emailHtml', array('contacto' => $contacto, 'idformulario'=>$idformulario));
                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaFrom($emailFrom);
                $email->setCaFromname($empresa);
                $email->setCaSubject($asunto);
                $email->setCaAddress($cli["ca_email"]);                
                $email->setCaBodyhtml($html);
                $email->setCaBody($contacto);
                $email->setCaTipo("Encuesta");
                $email->setCaIdcaso($idformulario);
                $email->save();
                $emails_Control.=$key . "->" . $cli["ca_email"] . "<br>";
            } catch (Exception $e) {
                $emails_Control.="No se pudo enviar " . $cli["ca_email"] . ": porque : " . $e->getMessage() . "<br>";
            }
            $this->html = $html;
            echo $cli["ca_email"] . "<br>";
        }

        $email = new Email();
        $email->setCaUsuenvio("Administrador");
        $email->setCaFrom($emailFrom);
        $email->setCaFromname($empresa);
        $email->setCaSubject("Pruebas:Emails enviados - Encuesta Formulario->".$idformulario);
        $email->setCaAddress("alramirez@coltrans.com.co");
        $email->setCaBodyhtml($html . "Emails enviados:<br>" . $emails_Control);
        $email->setCaTipo("Encuesta");
        $email->setCaIdcaso($idformulario);
        $email->save();
        echo "enviados";        
       
        $this->setTemplate('envioEmailsPrueba');
    }    

    public function executeEnvioEmailsColmas() {

        $filecontrol = $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "formulario" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "control.txt";

        if (file_exists($filecontrol)) {
            $inicio = file_get_contents($filecontrol);
        }
        if (!$inicio)
            $inicio = 0;

        $con = Doctrine_Manager::getInstance()->connection();

        $nreg = 120;
        $conteo = 0;
        $emails_Control = "";
        $empresa = "AGENCIA DE ADUANAS COLMAS LTDA Nivel 1";
        $idformulario = 10;
        $asunto = "Dos minutos de su tiempo nos ayuda a prestarle un mejor servicio";
        $emailFrom = "no-response@colmas.com.co";

        /*$sql = "
            SELECT c.ca_idcliente,c.ca_compania, con.ca_email,ca_coltrans_std,ca_colmas_std,con.ca_idcontacto
            FROM vi_clientes c
                INNER join tb_concliente con on c.ca_idcliente=con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
            WHERE (c.ca_colmas_std = 'Activo') and c.ca_vendedor IS NOT NULL
            ORDER BY by 2,3 limit $nreg offset $inicio";*/
        
        //Consulta para Reenvio
        $sql = "
            SELECT c.ca_idcliente,c.ca_compania, con.ca_email, ca_coltrans_std, ca_colmas_std, con.ca_idcontacto
            FROM vi_clientes c
                    RIGHT JOIN tb_concliente con ON c.ca_idcliente = con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
            WHERE NOT EXISTS 
                (SELECT * FROM encuestas.tb_control_encuesta cf WHERE con.ca_idcontacto = cf.ca_id_contestador and cf.ca_idformulario = $idformulario) 
                and c.ca_colmas_std = 'Activo' and c.ca_vendedor IS NOT NULL
            ORDER BY 2,3 limit $nreg offset $inicio";
        
         /* Envío a contacto específico
        $idcontacto = '9667';
        $sql = "
            SELECT c.ca_idcliente,c.ca_compania, con.ca_email,ca_coltrans_std,ca_colmas_std,con.ca_idcontacto
            FROM vi_clientes c
                INNER JOIN tb_concliente con on c.ca_idcliente=con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
            WHERE (c.ca_colmas_std = 'Activo' ) and con.ca_idcontacto = '$idcontacto'
            ORDER BY 2,3 limit $nreg offset $inicio";* 
        */

        $st = $con->execute($sql);
        $clientes = $st->fetchAll();
        
        foreach ($clientes as $cliente) {
            $conteo++;
            if ($cliente["ca_colmas_std"] != "Activo")
                continue;
            try {
                $contacto = $cliente["ca_idcontacto"];
                $html = $this->getPartial('formulario/emailHtmlColmas', array('contacto' => $contacto, 'idformulario'=>$idformulario));
                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaFrom($emailFrom);
                $email->setCaFromname($empresa);
                $email->setCaSubject($asunto);
                $email->setCaAddress($cliente["ca_email"]);
                //$email->setCaAddress('alramirez@coltrans.com.co');
                $email->setCaBody($contacto);
                $email->setCaBodyhtml($html);
                $email->setCaBody($contacto);
                $email->setCaTipo("Encuesta");
                $email->setCaIdcaso($idformulario);
                $email->save();
                $email->send();
                $emails_Control.=$cliente["ca_compania"] . "->" . $cliente["ca_email"] . "<br>";
            } catch (Exception $e) {
                $emails_Control.="No se pudo enviar " . $cliente["ca_email"] . ": porque : " . $e->getMessage() . "<br>";
                print_r($e);
            }
            $this->html = $html;
            echo $cliente["ca_email"] . "<br/>";
        }

        file_put_contents($filecontrol, $inicio + $conteo);
        $emailsControl.= "inicio=>" . $inicio . " nreg=>" . $nreg . " control.txt=>" . file_get_contents($filecontrol) . "<br/>";

        $email = new Email();
        $email->setCaUsuenvio("Administrador");
        $email->setCaFrom($emailFrom);
        $email->setCaFromname($empresa);
        $email->setCaSubject("Emails enviados - Encuesta Formulario->".$idformulario);
        $email->setCaAddress("alramirez@coltrans.com.co");
        $email->setCaBodyhtml("Emails enviados:<br>" . $emails_Control);
        $email->setCaTipo("Encuesta");
        $email->setCaIdcaso($idformulario);
        $email->save();
        echo "enviados";
        echo $html;
        exit;
        
        $this->setTemplate('envioEmailsPrueba');
    }

    public function executeEnvioEmailsColtrans() {

        $filecontrol = $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "formulario" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "control.txt";

        if (file_exists($filecontrol)) {
            $inicio = file_get_contents($filecontrol);
        }
        if (!$inicio)
            $inicio = 0;
        $con = Doctrine_Manager::getInstance()->connection();

        $nreg = 120;

        /*$sql = "
            SELECT c.ca_idcliente,c.ca_compania, con.ca_email,ca_coltrans_std,ca_colmas_std,con.ca_idcontacto
            FROM vi_clientes c
                INNER JOIN tb_concliente con on c.ca_idcliente=con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
            WHERE (c.ca_coltrans_std = 'Activo') and c.ca_vendedor IS NOT NULL
            ORDER BY 2,3 limit $nreg offset $inicio";*/
        
        //Consulta para Reenvio
        $sql = "
            SELECT c.ca_idcliente,c.ca_compania, con.ca_email,ca_coltrans_std,ca_colmas_std,con.ca_idcontacto, cf.ca_id
            FROM vi_clientes c
                INNER JOIN tb_concliente con on c.ca_idcliente=con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
                FULL JOIN encuestas.tb_control_encuesta cf on con.ca_idcontacto=cf.ca_id_contestador   
            WHERE (c.ca_coltrans_std = 'Activo') and c.ca_vendedor IS NOT NULL and (cf.ca_id IS NULL) 
            ORDER BY 2,3 limit $nreg offset $inicio";

        $st = $con->execute($sql);
        $clientes = $st->fetchAll();
        
        $conteo = 0;
        $emails_Control = "";
        $empresa = "COLTRANS S.A.S";
        $idformulario = 11;
        $asunto = "Dos minutos de su tiempo nos ayuda a prestarle un mejor servicio";
        $emailFrom = "no-response@coltrans.com.co";        

        foreach ($clientes as $cliente) {
            $conteo++;
            if ($cliente["ca_coltrans_std"] != "Activo")
                continue;
            try {
                $contacto = $cliente["ca_idcontacto"];
                $html = $this->getPartial('formulario/emailHtmlColtrans', array('contacto' => $contacto, 'idformulario'=>$idformulario));
                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaFrom($emailFrom);
                $email->setCaFromname($empresa);
                $email->setCaSubject($asunto);
                $email->setCaAddress($cliente["ca_email"]);
                //$email->setCaAddress('alramirez@coltrans.com.co');
                $email->setCaBody($contacto);
                $email->setCaBodyhtml($html);
                $email->setCaTipo("Encuesta");
                $email->setCaIdcaso(11);
                $email->save();
                $email->send();
                $emails_Control.=$cliente["ca_compania"] . "->" . $cliente["ca_email"] . "<br>";
            } catch (Exception $e) {
                $emails_Control.="No se pudo enviar " . $cliente["ca_email"] . ": porque : " . $e->getMessage() . "<br>";
            }
            $this->html = $html;
            echo $cliente["ca_email"] . "<br>";
        }

        file_put_contents($filecontrol, $inicio + $conteo);

        $emailsControl.= "inicio=>" . $inicio . " nreg=>" . $nreg . " control.txt=>" . file_get_contents($filecontrol) . "<br/>";

        $email = new Email();
        $email->setCaUsuenvio("Administrador");
        $email->setCaFrom($emailFrom);
        $email->setCaFromname($empresa);
        $email->setCaSubject("Emails enviados - Encuesta Formulario->".$idformulario);
        $email->setCaAddress("alramirez@coltrans.com.co");                
        $email->setCaBodyhtml("Emails enviados:<br>" . $emails_Control);
        $email->setCaTipo("Encuesta");
        $email->setCaIdcaso($idformulario);        
        $email->save();
        echo "enviados";
        echo $html;
        exit;
        
        
        $this->setTemplate('envioEmailsPrueba');
    }

    /**
     * Metodo personalizado para procesar formularios creados en la herramienta
     * Registra las respuestas dadas al formulario en la base de datos
     * @param sfWebRequest $request
     */
    public function executeProceso(sfWebRequest $request) {

        function getServicio($servicio) {
            $cadena = trim($servicio);
            switch ($cadena) {
                case 1:
                    return "Importaciones aéreo";
                    break;
                case 2:
                    return "Importaciones marítimo";
                    break;
                case 3:
                    return "Exportaciones aéreo";
                    break;
                case 4:
                    return "Exportaciones marítimo";
                case 5:
                    return "Proceso de Nacionalización en embarques aéreos";
                case 6:
                    return "Proceso de Nacionalización en embarques marítimos";
                case 7:
                    return "Proceso de Nacionalización en embarques con OTM / DTA";
                    break;
                default:
                    return 99;
            }
        }

        $id = $request->getParameter('id');
        $idDecode = base64_decode($id);
        $idFormulario = intval($idDecode);

        $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);

        $contacto = $request->getParameter('co');
        $idContact = base64_decode($contacto);
        $idContacto = intval($idContact);
        $idEmpresa = 1;
        
        $conn = Doctrine::getTable("controlEncuesta")->getConnection();
        $conn->beginTransaction();

        try {

            $control = new ControlEncuesta;
            $control->setCaId(null);
            $control->setCaIdformulario($idFormulario);
            $control->setCaIdempresa($idEmpresa);
            $control->setCaTipoContestador(1);
            $control->setCaIdContestador($idContacto);
            $control->save($conn);

            $idcontrol = $control->getCaId();

            foreach ($request->getPostParameters() as $param => $val) {
                $parampreg = explode('.', $param);
                if (count($parampreg) > 1) {
                    $idpregunta = $parampreg[1];
                    $temp = $parampreg[2];
                } else {
                    $idpregunta = substr($param, 3, 2);
                    $temp = substr($param, 10, 1);
                }
                $servicio = $temp;
                
                $pregunta = Doctrine::getTable("Pregunta")->find($idpregunta);
                
                if($servicio == 0){
                    if(isset($pregunta) && $pregunta->getCaAyuda()== "Todos los Servicios")
                        $servicio = 8; // Servicio Quejas y Reclamos
                }
                
                //guardar los datos
                $resultado = new ResultadoEncuesta();
                $resultado->setCaId(null);
                $resultado->setCaIdpregunta($idpregunta);
                $resultado->setCaResultado($val);
                $resultado->setCaIdcontrolencuesta($idcontrol);
                $resultado->setCaServicio(intval($servicio));
                $resultado->save($conn);
            }
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollBack();
            throw $e;
        }
        $this->control = $idcontrol;
        
        $this->setTemplate('exito');
        $detect = new Mobile_Detect();
        $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
        $this->device = $dispositivo;
        if ($dispositivo == 'mobile') {
            $this->setLayout('mobile/formulario');
        } elseif ($dispositivo == 'tablet') {
            $this->setLayout('mobile/formulario');
        } else {
            $this->setLayout('formulario');
        }
    }

    /**
     * Realiza la vista previa de un formulario
     * @param sfWebRequest $request
     */
    public function executeVistaPreviaEmail(sfWebRequest $request) {
        $id = $request->getParameter('ca_id');

        $idDecode = base64_decode($id);
        $idFormulario = intval($idDecode);

        $idContacto = $request->getParameter('co');
        $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);
        $this->contacto = $idContacto;
    }

    /**
     * Realiza la vista previa de un formulario
     * @param sfWebRequest $request
     */
    public function executeVistaPrevia(sfWebRequest $request) {
        $this->email = 'gmartinez@coltrans.com.co';
        $this->servicio = 'aduana';
        $this->empresa = 2;

        $id = $request->getParameter('ca_id');
        $idFormularioEncode = $idFormulario;
        $idDecode = base64_decode($id);
        $idFormulario = intval($idDecode);

        $idContacto = $request->getParameter('co');
        $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);
        $this->contacto = $idContacto;


        $bloque = $this->formulario->getBloqueServicio($idFormulario);        
        $this->bloque = $bloque;
        if ($bloque) {
            $this->setTemplate('selServicios');
        }

        $detect = new Mobile_Detect();
        $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
        $this->device = $dispositivo;
        if ($dispositivo == 'mobile') {
            $this->setLayout('mobile/formulario');
        } elseif ($dispositivo == 'tablet') {
            $this->setLayout('mobile/formulario');
        } else {
            $this->setLayout('formulario');
        }
        if ($bloque) {
            $this->setTemplate('selServicios');
        }
    }

    /**
     * Procesa un formulario de symfony
     * @param sfWebRequest $request
     * @param sfForm $form
     */
    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $formulario = $form->save();
            $this->getUser()->setFlash('notice', 'Datos del Formulario Guardado.');
            $this->redirect('formulario/edit?ca_id=' . $formulario->getCaId());
        } else {
            $this->getUser()->setFlash('error', 'No se pueden guardar los datos del Formulario.');
        }
    }

    /**
     * @deprecated???
     * vista de formulario con el bloque de servicios
     * @param sfWebRequest $request
     */
    public function executePreguntas(sfWebRequest $request) {
        $this->formulario = Doctrine_Core::getTable('formulario')->getFormulario(1);
//$idFormulario = $request->getParameter('ca_id');
//$this->formulario = Doctrine_Core::getTable('formulario')->getFormulario($idFormulario);
        $this->setLayout('formulario');
        $tipo_bloque = 0;
        $this->tipo_bloque = $tipo_bloque;
    }

    /*
     * Permite copiar un formulario
     * @deprecated
     * aun no funciona
     */

    public function executeCopy(sfWebRequest $request) {
        $idFormulario = $request->getParameter('ca_id');
        $this->formulario = Doctrine_Core::getTable('formulario')->find(array($request->getParameter('ca_id')));
        $this->forward404Unless($this->formulario);
    }

    /**
     * Realiza la vista previa de un formulario
     * @param sfWebRequest $request
     * Test con ajax
     * @deprecated??
     */
    public function executeRefrescarFormulario(sfWebRequest $request) {
        $idForm = $request->getParameter('id'); //no llega
        $idForm2 = 1;
        $servicios = $request->getParameter('servicios'); //no llega
        $this->servicios = $pieces = explode(",", $servicios);
        $this->cantidad = sizeof($servicios);
        $this->formulario = Doctrine_Core::getTable('formulario')->find($idForm); //el formulario ya esta
        $this->setLayout('formulario');
        $html = $this->getPartial('formulario/test'); //para mandarle el $formulario deberia tener el parametro
        sfConfig::set('sf_web_debug', false);
        $cant = 2;
        $this->responseArray = array("success" => true, "formulario" => $this->formulario, "html" => $html, "cantidad" => $cantidad, "idFormulario" => $idForm);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Metodo personalizado para mostrar los datos del formulario guardado
     * @param sfWebRequest $request
     * @deprecated
     * aun no se esta utilizando.
     */
    public function executeResultadoExt4(sfWebRequest $request) {
    
        $id = $request->getParameter('ca_id');
        $this->formulario = Doctrine_Core::getTable('formulario')->find($id);
        
        $options["idencuesta"] = $request->getParameter("idencuesta");
        
        $this->encuestas = $this->formulario->getListaEncuestasDiligenciadas($options, false);
        
        $this->consolidado = array();        
        $i=1;
        foreach ($this->encuestas as $encuesta) {
                $this->consolidado[] = array(
                    "idform" => $this->formulario->getCaId(),
                    "servicio"=> utf8_encode($encuesta["cf_ca_value"]), 
                    "pregunta"=>$encuesta["p_ca_texto"],
                    "resultado"=>utf8_encode($encuesta["re_ca_resultado"]));
        }

        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "
            select cf.ca_id,i.ca_nombre as empresa, con.ca_nombres, con.ca_papellido, con.ca_sapellido, con.ca_email, cl.ca_vendedor, csuc.ca_nombre as ca_sucursal, pe.ca_texto as ca_pregunta, re.ca_id, re.ca_resultado, cfv.ca_value as ca_servicio, cf.ca_fchcreado
            from ids.tb_ids i
            inner join tb_clientes cl on cl.ca_idcliente=i.ca_id
            inner join tb_concliente con on con.ca_idcliente=cl.ca_idcliente
            right join encuestas.tb_control_encuesta cf on ca_idcontacto=ca_id_contestador            
            left join control.tb_usuarios cu on cl.ca_vendedor=cu.ca_login
            right join control.tb_sucursales csuc on cu.ca_idsucursal=csuc.ca_idsucursal
            right join encuestas.tb_resultado_encuesta re on cf.ca_id= re.ca_idcontrolencuesta 
            left join encuestas.tb_pregunta pe on re.ca_idpregunta = pe.ca_id
            inner join control.tb_config_values cfv on cfv.ca_idconfig=211 and re.ca_servicio=cfv.ca_ident
            where cf.ca_id=" . $id . " and re.ca_resultado != ''   
            order by ca_pregunta    
            ";
        $st = $con->execute($sql);
        $this->respuestas = $st->fetchAll();
    }

    /**
     * Metodo personalizado para procesar el formulario inicial que incluye el bloque de servicios
     * @param sfWebRequest $request
     * @deprecated??
     */
    public function executeProcesoservicio(sfWebRequest $request) {

        $this->messageBeta = print_r($request->getParameterHolder());
        $arreglo = $request->getPostParameters();
        $this->tamano = sizeof($arreglo);
        $this->message = $request->getParameter("1") . " " . $request->getParameter("grupo_3");
        $this->setTemplate('exito');
        $this->setLayout('layout_home');
    }
    
    public function executeVerSeguimientos(sfWebRequest $request){
        
        $idcliente = $request->getParameter("idcliente");
        
        $this->seguimientos = Doctrine::getTable("EveCliente")
                ->createQuery("s")
                ->addWhere("s.ca_idcliente = ? ", $idcliente)
                ->addWhere("s.ca_asunto like '%Encuesta satisfacción del Cliente%'")
                ->addOrderBy("s.ca_fchevento ASC")
                ->execute();
        
        
    }
    
    public function executeGuardarSeguimiento(sfWebRequest $request){
        
        $this->user = $this->getUser();
        
        $idcliente = $request->getParameter("idcliente");
        $idform = $request->getParameter("idform");
        $idencuesta = $request->getParameter("idencuesta");
        
        $formulario = Doctrine_Core::getTable('formulario')->find($idform);
        
        $con = Doctrine_Manager::getInstance()->connection();
        $con->beginTransaction();
        
        $seguimiento = new EveCliente();        
        $seguimiento->setCaFchevento(date('Y-m-d H:i:s'));
        $seguimiento->setCaIdcliente($request->getParameter("idcliente"));
        $seguimiento->setCaTipo(utf8_decode($request->getParameter("tipo")));
        $seguimiento->setCaAsunto($formulario->getCaTitulo());
        $seguimiento->setCaDetalle(utf8_decode($request->getParameter("detalle")));
        $seguimiento->setCaCompromisos(utf8_decode($request->getParameter("compromiso")));
        $seguimiento->setCaFchcompromiso($request->getParameter("fchcompromiso"));
        $seguimiento->setCaIdantecedente(0);
        $seguimiento->setCaUsuario($this->user->getUserId());
        $seguimiento->save($con);
        
        if($request->getParameter("fchcompromiso")){
            
                $cliente = Doctrine_Core::getTable('IdsCliente')->find($idcliente);
                
                $tarea = new NotTarea();
                $tarea->setCaUrl('/formulario/resultadoExt4/ca_id/'.$formulario->getCaId().'/idcliente/'.$idcliente.'/idencuesta/'.$idencuesta);
                $tarea->setCaIdlistatarea(9);
                $tarea->setCaFchcreado(date("Y-m-d H:i:s"));
                $tarea->setCaFchvisible(date("Y-m-d H:i:s"));
                $tarea->setCaFchvencimiento(date("Y-m-d H:i:s"));
                $tarea->setCaUsucreado($this->getUser()->getUserId());
                $tarea->setCaTitulo("Seguimiento programado Cliente: ".$cliente->getIds()->getCaNombre());
                $tarea->setCaTexto("En el seguimiento a ".$formulario->getCaTitulo()." se programó este seguimiento.");
                $tarea->save($con);
                               
                $cliente->setProperty("idtarea",$tarea->getCaIdtarea());
                $cliente->save($con);
                
                $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());   
                $loginAsignaciones[] = $usuario->getCaLogin();
                
                $tarea->setAsignaciones($loginAsignaciones);
        }
        $con->commit();
        
        $texto = sfContext::getInstance()->getController()->getPresentationFor('formulario', 'verSeguimientos');
        
        $this->responseArray = array("success" => true, "idactivo" => $idcliente, "info" => utf8_encode($texto));
        $this->setTemplate("responseTemplate");        
    }
}

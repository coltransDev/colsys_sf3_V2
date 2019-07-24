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
        $options["idsucursal"] = $request->getParameter("idsucursal");
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
        $idtipo = $this->formulario->getCaIdtipo();
        
        $metodo = "getNumEncuestasEnviadas$idtipo";        
        eval("\$metEncEnv = \"$metodo\";");
        
        $metodo = "getListaEncuestasDiligenciadas$idtipo";        
        eval("\$metEncAvg = \"$metodo\";");
        
        $encEnv = $this->formulario->$metEncEnv($options);                
        $encAvg = $this->formulario->$metEncAvg($options, true);

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
        //echo "<pre>";print_r($encuestas);echo "</pre>";
        foreach ($encuestas as $sucursal => $gridSucursal) {
            $this->grid1[] = array(
                "title" => utf8_encode($this->formulario->getCaTitulo()),
                "idform" => utf8_encode($this->formulario->getCaId()),
                "idpregunta" => $gridSucursal["idservicio"],
                "idservicio" => $gridSucursal["idpregunta"],
                "idsucursal" => $gridSucursal["idsucursal"],
                "sucursal" => $sucursal == null ? "Sin asignar" : $sucursal,
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
                "sucursal" => $sucursal == null ? "Sin asignar" : $sucursal,
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
                "servicio" => $servicio == null ? "Sin asignar" : $servicio,
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
        
        $idtipo = $this->formulario->getCaIdtipo();
        $metodo = "getListaEncuestasDiligenciadas$idtipo";        
        eval("\$metEncAvg = \"$metodo\";");

        $contactos = $this->formulario->$metEncAvg($options, true);

        foreach ($contactos as $contacto) {
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
            
            switch ($idtipo){
                case 1:
                    if (!in_array(utf8_encode($contacto["cc_ca_nombres"]) . " " . utf8_encode($contacto["cc_ca_papellido"]), $listaContactos)) {
                        $listaContactos[] = utf8_encode($contacto["cc_ca_nombres"]) . " " . utf8_encode($contacto["cc_ca_papellido"]);
                        $this->contactos[] = array(
                            "title" => utf8_encode($this->formulario->getCaTitulo()),
                            "idform" => $this->formulario->getCaId(),
                            "idcliente" => $contacto["i_ca_id"],
                            "idencuesta" => $contacto["ce_ca_id"],
                            "compania" => utf8_encode($contacto["i_ca_nombre"]),
                            "nombre" => utf8_encode($contacto["cc_ca_nombres"]) . " " . utf8_encode($contacto["cc_ca_papellido"]),
                            "sucursal" => utf8_encode($contacto["s_ca_nombre"]),
                            "comercial" => utf8_encode($contacto["u_ca_nombre"]),
                            "promedio" => round(($cliente[$contacto["i_ca_nombre"]]["suma"] / $cliente[$contacto["i_ca_nombre"]]["casos"]), 2),
                            "seguimiento" => count($seguimientos) > 0 ? true : false);
                    }
                    break;
                case 2:
                    if (!in_array(utf8_encode($contacto["i_ca_nombre"]), $listaContactos)) {
                        $listaContactos[] = utf8_encode($contacto["i_ca_nombre"]);
                        $this->contactos[] = array(
                            "title" => utf8_encode($this->formulario->getCaTitulo()),
                            "idform" => $this->formulario->getCaId(),
                            "idcliente" => $contacto["i_ca_id"],
                            "idencuesta" => $contacto["ce_ca_id"],
                            "compania" => utf8_encode($contacto["i_ca_nombre"]),
                            "nombre" => utf8_encode($contacto["cc_ca_nombres"]) . " " . utf8_encode($contacto["cc_ca_papellido"]),
                            "sucursal" => utf8_encode($contacto["s_ca_nombre"]),
                            "comercial" => utf8_encode($contacto["u_ca_nombre"]),
                            "promedio" => round(($cliente[$contacto["i_ca_nombre"]]["suma"] / $cliente[$contacto["i_ca_nombre"]]["casos"]), 2),
                            "seguimiento" => count($seguimientos) > 0 ? true : false);
                    }
                    break;
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

        foreach ($contactos as $contacto) {
            $cliente[$contacto["i_ca_nombre"]]["suma"]+= $contacto["re_ca_resultado"];
            $cliente[$contacto["i_ca_nombre"]]["casos"] ++;
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
                "nombre" => utf8_encode($contacto["cc_ca_nombres"]) . " " . utf8_encode($contacto["cc_ca_papellido"]),
                "sucursal" => utf8_encode($contacto["s_ca_nombre"]),
                "comercial" => utf8_encode($contacto["u_ca_nombre"]),
                "pregunta" => utf8_encode($contacto["p_ca_texto"]),
                "resultado" => $contacto["re_ca_resultado"],
                "servicio" => utf8_encode($contacto["cf_ca_value"]),
                "seguimiento" => count($seguimientos) > 0 ? true : false);
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

//        $empresas = $this->formulario->getNumEncuestasEnviadas($options);
        $empresas = $this->formulario->getNumEncuestasEnviadas2($options);
        $prefijo = "rs_";
//        echo "<pre>";print_r($empresas);echo "</pre>";
        $this->empresas = array();
        foreach ($empresas as $empresa) {
            $this->empresas[] = array(
                "title" => utf8_encode($this->formulario->getCaTitulo()),
                "idform" => $this->formulario->getCaId(),
                "idemail" => $empresa[$prefijo."ca_idemail"],
                "compania" => utf8_encode($empresa["i_ca_nombre"]),
                "sucursal" => $idsucursal == null ? "Sin asignar" : utf8_encode($empresa["s_ca_nombre"]),
                "comercial" => utf8_encode($empresa["u_ca_nombre"]),
                "fchenvio" => $empresa[$prefijo."ca_fchenvio"]);
        }
//        echo "<pre>";print_r($this->empresas);echo "</pre>";
        $detect = new Mobile_Detect();
        $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
        $this->device = $dispositivo;
    }

    /**
     * Carga la encuesta de servicio, luego de recibir como parÃ¡metro el listado de servicios previamente seleccionados por el usuario.
     * @param sfWebRequest $request
     */
    public function executeEstadistica(sfWebRequest $request) {

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

        
//        $clientes['TGL COLOMBIA LTDA.']['ca_idcontacto'] = 11124;
//        $clientes['TGL COLOMBIA LTDA.']['ca_email'] = 'alramirez@coltrans.com.co';

        $clientes['TGL COLOMBIA LTDA.']['ca_idcontacto'] = 31776;
        $clientes['TGL COLOMBIA LTDA.']['ca_email'] = 'gorbegozo@coltrans.com.co';
        
        $clientes['KNIGHT S.A.S.']['ca_idcontacto'] = 27969;
        $clientes['KNIGHT S.A.S.']['ca_email'] = 'pdominguez@coltrans.com.co';
        
        $clientes['INNOVACION NATURAL DE COLOMBIA S.A.']['ca_idcontacto'] = 13446;
        $clientes['INNOVACION NATURAL DE COLOMBIA S.A.']['ca_email'] = 'mcohen@coltrans.com.co';
        
        $clientes['CUBIERTAS S.A.S']['ca_idcontacto'] = 21098;
        $clientes['CUBIERTAS S.A.S']['ca_email'] = 'thansmeier@coltrans.com.co';
        
        $clientes['TECSIL S.A.']['ca_idcontacto'] = 13554;
        $clientes['TECSIL S.A.']['ca_email'] = 'amartinez@coltrans.com.co';
        
        $clientes['DISTRIBUCIONES Y REPRESENTACIONES ELECTRICAS S.A.S.  DISREL S.A.S.']['ca_idcontacto'] = 13557;
        $clientes['DISTRIBUCIONES Y REPRESENTACIONES ELECTRICAS S.A.S.  DISREL S.A.S.']['ca_email'] = 'yalile.garcia@colmas.com.co';
        
        $clientes['GEN PRODUCTS COMPANY SAS']['ca_idcontacto'] = 13604;
        $clientes['GEN PRODUCTS COMPANY SAS']['ca_email'] = 'apsanchez@coltrans.com.co';
        
        $clientes['GEA ANDINA S.A.S.']['ca_idcontacto'] = 13639;
        $clientes['GEA ANDINA S.A.S.']['ca_email'] = 'jmarulanda@coltrans.com.co';
        
        $clientes['C Y C EQUIPOS S.A.S']['ca_idcontacto'] = 23429;
        $clientes['C Y C EQUIPOS S.A.S']['ca_email'] = 'angelica.rolon@colmas.com.co';
        
        $clientes['QUIMTIA S.A.S.']['ca_idcontacto'] = 13695;
        $clientes['QUIMTIA S.A.S.']['ca_email'] = 'dcgonzalez@coltrans.com.co';
        
        $clientes['BIOTER DIAGNOSTICA SAS']['ca_idcontacto'] = 29212;
        $clientes['BIOTER DIAGNOSTICA SAS']['ca_email'] = 'gbedoya@coltrans.com.co';
        
        $clientes['ESTRATO 9  S.A.S ']['ca_idcontacto'] = 19510;
        $clientes['ESTRATO 9  S.A.S ']['ca_email'] = 'pbravo@coltrans.com.co';
        
        $clientes['SWEETSOL SUCURSAL COLOMBIA']['ca_idcontacto'] = 18477;
        $clientes['SWEETSOL SUCURSAL COLOMBIA']['ca_email'] = 'gmpineda@coltrans.com.co';
        
        $clientes['UFINET COLOMBIA S.A.']['ca_idcontacto'] = 23703;
        $clientes['UFINET COLOMBIA S.A.']['ca_email'] = 'sdelgado@coltrans.com.co';
        
        $clientes['GRUPO INVERSIONISTA GUAYAQUIL ASOCIADOS SAS']['ca_idcontacto'] = 32223;
        $clientes['GRUPO INVERSIONISTA GUAYAQUIL ASOCIADOS SAS']['ca_email'] = 'bdelatorre@coltrans.com.co';
        
        $clientes['IMPORTACIONES Y EXPORTACIONES CARDENAS GAVILANES LTDA. / I-EXPORT CARGA LTDA.']['ca_idcontacto'] = 14154;
        $clientes['IMPORTACIONES Y EXPORTACIONES CARDENAS GAVILANES LTDA. / I-EXPORT CARGA LTDA.']['ca_email'] = 'leramirez@coltrans.com.co';
        
        $clientes['COMERCIALIZADORA  INTERNACIONAL DE COLOMBIA CIDECOLOMBIA  COM S.A.S']['ca_idcontacto'] = 14207;
        $clientes['COMERCIALIZADORA  INTERNACIONAL DE COLOMBIA CIDECOLOMBIA  COM S.A.S']['ca_email'] = 'apaternina@coltrans.com.co';
        
        $clientes['M&M EQUIPOS MEDICOS S.A.S.']['ca_idcontacto'] = 14214;
        $clientes['M&M EQUIPOS MEDICOS S.A.S.']['ca_email'] = 'acmoreno@coltrans.com.co';
        
        $clientes['DYSTAR COLOMBIA S.A.S']['ca_idcontacto'] = 19249;
        $clientes['DYSTAR COLOMBIA S.A.S']['ca_email'] = 'jacastano@coltrans.com.co';
        
        $clientes['INTEGRAL MILLENIUM S.A.S']['ca_idcontacto'] = 14263;
        $clientes['INTEGRAL MILLENIUM S.A.S']['ca_email'] = 'galvarez@coltrans.com.co';
        
        $clientes['COLLAZOS LOPEZ MAURICIO / FIJACIONES Y ACCESORIOS']['ca_idcontacto'] = 14314;
        $clientes['COLLAZOS LOPEZ MAURICIO / FIJACIONES Y ACCESORIOS']['ca_email'] = 'mramos@coltrans.com.co';
        
        $clientes['LEASE PROJECT S.A.S.']['ca_idcontacto'] = 14316;
        $clientes['LEASE PROJECT S.A.S.']['ca_email'] = 'oviasus@coltrans.com.co';
        
        $clientes['TODO CAMPEROS LIMITADA ']['ca_idcontacto'] = 14321;
        $clientes['TODO CAMPEROS LIMITADA ']['ca_email'] = 'secretaria@colmas.com.co';
        
        $clientes['SERVEX COLOMBIA SAS']['ca_idcontacto'] = 14328;
        $clientes['SERVEX COLOMBIA SAS']['ca_email'] = 'olga.mosquera@colmas.com.co';
        
        $clientes['COMPA?IA INTERNACIONAL DE ALIMENTOS SAS / CINAL SAS']['ca_idcontacto'] = 14330;
        $clientes['COMPA?IA INTERNACIONAL DE ALIMENTOS SAS / CINAL SAS']['ca_email'] = 'cazambrano@coltrans.com.co';
        
        $clientes['REHAU S.A.S']['ca_idcontacto'] = 15709;
        $clientes['REHAU S.A.S']['ca_email'] = 'claudia.mejia@colmas.com.co';
        
        $clientes['CRUZ Y GANDINI SAS']['ca_idcontacto'] = 14442;
        $clientes['CRUZ Y GANDINI SAS']['ca_email'] = 'seguros@coltrans.com.co';
        
        $clientes['ICONO PET LTDA']['ca_idcontacto'] = 14466;
        $clientes['ICONO PET LTDA']['ca_email'] = 'vsalazar@coltrans.com.co';
        
        $clientes['PET SPA PRODUCTS SAS']['ca_idcontacto'] = 24103;
        $clientes['PET SPA PRODUCTS SAS']['ca_email'] = 'ipavajeau@coltrans.com.co';
        
        $clientes['CARIBBEAN ECO SOAPS UIBS S.A.S.']['ca_idcontacto'] = 14470;
        $clientes['CARIBBEAN ECO SOAPS UIBS S.A.S.']['ca_email'] = 'amorales@coltrans.com.co';
        
        $clientes['INTERNATIONAL TRADE AGENCY S.A.S. SIGLA INTRA S.A.S']['ca_idcontacto'] = 14486;
        $clientes['INTERNATIONAL TRADE AGENCY S.A.S. SIGLA INTRA S.A.S']['ca_email'] = 'smgomez@coltrans.com.co';

        $idformulario = 20;

        $formulario = Doctrine::getTable("Formulario")->find($idformulario);
        $empresa = $formulario->getEmpresa();

        $emails_Control = "";
        $asunto = "Dos minutos de su tiempo nos ayuda a prestarle un mejor servicio";

        foreach ($clientes as $key => $cli) {
            try {
                $contacto = $cli["ca_idcontacto"];
                $html = $this->getPartial('formulario/emailHtmlColmas', array('contacto' => $contacto, 'idformulario' => $idformulario, "empresa" => $empresa));
                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaFrom($formulario->getCaNombreFormato());
                $email->setCaFromname(strtoupper($empresa->getCaNombre()));
                $email->setCaSubject($asunto);
                $email->setCaAddress($cli["ca_email"]);
                $email->setCaBodyhtml($html);
                $email->setCaBody($contacto);
                $email->setCaTipo("Encuesta");
                $email->setCaIdcaso($idformulario);
                $email->save();
                //$email->send();
                $emails_Control.=$key . "->" . $cli["ca_email"] . "<br>";
            } catch (Exception $e) {
                $emails_Control.="No se pudo enviar " . $cli["ca_email"] . ": porque : " . $e->getMessage() . "<br>";
            }
            $this->html = $html;
            echo $cli["ca_email"] . "<br>";
        }

        /* $email = new Email();
          $email->setCaUsuenvio("Administrador");
          $email->setCaFrom($formulario->getCaNombreFormato());
          $email->setCaFromname(strtoupper($empresa->getCaNombre()));
          $email->setCaSubject("Pruebas:Emails enviados - Encuesta Formulario->".$idformulario);
          $email->setCaAddress("svillamizar@coltrans.com.co");
          $email->setCaBodyhtml($html . "Emails enviados:<br>" . $emails_Control);
          $email->setCaTipo("Encuesta");
          $email->setCaIdcaso($idformulario);
          $email->save(); */
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
        $idformulario = 20;        
        
//        $sql = "
//            SELECT DISTINCT con.ca_email, max(con.ca_idcontacto) as ca_idcontacto, c.ca_idcliente
//            FROM vi_clientes_reduc c
//                INNER JOIN tb_concliente con ON c.ca_idcliente = con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%' and con.ca_propiedades IS NULL
//                INNER JOIN vi_clientes_std std ON c.ca_idcliente = std.ca_idcliente
//            WHERE (std.ca_colmas_std = 'Activo') AND (c.ca_tipo  is NULL OR c.ca_tipo LIKE '%Proveedor%') AND c.ca_vendedor IS NOT NULL and ca_vendedor not in ('Administrador','Comercial','comercial-baq','comercial-med','comercial-clo')
//            GROUP BY con.ca_email, c.ca_idcliente
//            ORDER BY ca_idcliente, ca_idcontacto
//            LIMIT $nreg OFFSET $inicio";
        
         //Consulta para Reenvio Coltrans
        $sql = "
            SELECT DISTINCT con.ca_email, max(con.ca_idcontacto) as ca_idcontacto, c.ca_idcliente
            FROM vi_clientes_reduc c
                INNER JOIN vi_clientes_std std ON c.ca_idcliente = std.ca_idcliente
                RIGHT JOIN tb_concliente con ON c.ca_idcliente = con.ca_idcliente AND ca_fijo=true AND con.ca_email like '%@%'
                    WHERE NOT EXISTS 
			(
                            SELECT * 
                            FROM encuestas.tb_control_encuesta cf 
                            WHERE con.ca_idcontacto = cf.ca_id_contestador and cf.ca_idformulario = $idformulario
			) 
	                AND std.ca_colmas_std = 'Activo' AND (c.ca_tipo  is NULL OR c.ca_tipo LIKE '%Proveedor%') AND c.ca_vendedor IS NOT NULL and ca_vendedor not in ('Administrador','Comercial','comercial-baq','comercial-med','comercial-clo')
            GROUP BY con.ca_email, c.ca_idcliente
            ORDER BY ca_idcliente, ca_idcontacto
            LIMIT $nreg OFFSET $inicio";
        
         $formulario = Doctrine::getTable("Formulario")->find($idformulario);
        $empresa = $formulario->getEmpresa();
        $asunto = "Encuesta de servicio, dos minutos de su tiempo nos ayuda a prestarle un mejor servicio";
        $data["email"] = array();     

        $st = $con->execute($sql);
        $clientes = $st->fetchAll();
        
        foreach ($clientes as $cliente) {
            $conteo++;
            if(!in_array($cliente["ca_email"], $data["email"])){
                try {
                    $contacto = $cliente["ca_idcontacto"];
                    $html = $this->getPartial('formulario/emailHtmlColmas', array('contacto' => $contacto, 'idformulario' => $idformulario, "empresa" => $empresa));
                    $email = new Email();
                    $email->setCaUsuenvio("Administrador");
                    $email->setCaFrom($formulario->getCaNombreFormato());
                    $email->setCaFromname(strtoupper($empresa->getCaNombre()));
                    $email->setCaSubject($asunto);
                    $email->setCaAddress($cliente["ca_email"]);
                    //$email->setCaAddress('alramirez@coltrans.com.co');
                    $email->setCaBody($contacto);
                    $email->setCaBodyhtml($html);
                    $email->setCaTipo("Encuesta");
                    $email->setCaIdcaso($idformulario);
                    $email->save();
                    $email->send();
                    $emails_Control.=$cliente["ca_idcliente"] . "->" . $cliente["ca_email"] . "<br>";
                } catch (Exception $e) {
                    $emails_Control.="No se pudo enviar " . $cliente["ca_email"] . ": porque : " . $e->getMessage() . "<br>";
                    print_r($e);
                }
            }
            $this->html = $html;
            echo $cliente["ca_email"] . "<br/>";
        }
        
        file_put_contents($filecontrol, $inicio + $conteo);
        $emailsControl.= "inicio=>" . $inicio . " nreg=>" . $nreg . " control.txt=>" . file_get_contents($filecontrol) . "<br/>";

        $email = new Email();
        $email->setCaUsuenvio("Administrador");
        $email->setCaFrom($formulario->getCaNombreFormato());
        $email->setCaFromname(strtoupper($empresa->getCaNombre()));
        $email->setCaSubject("Emails enviados - Encuesta Formulario->" . $idformulario);
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
        $conteo = 0;
        $emails_Control = "";
        $idformulario = 19;

//        $sql = "
//            SELECT DISTINCT con.ca_email, max(con.ca_idcontacto) as ca_idcontacto, c.ca_idcliente
//            FROM vi_clientes_reduc c
//                INNER JOIN tb_concliente con ON c.ca_idcliente = con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%' and con.ca_propiedades IS NULL
//                INNER JOIN vi_clientes_std std ON c.ca_idcliente = std.ca_idcliente
//            WHERE (std.ca_coltrans_std = 'Activo') AND (c.ca_tipo  is NULL OR c.ca_tipo LIKE '%Proveedor%') AND c.ca_vendedor IS NOT NULL and ca_vendedor not in ('Administrador','Comercial','comercial-baq','comercial-med','comercial-clo')
//            GROUP BY con.ca_email, c.ca_idcliente
//            ORDER BY ca_idcliente, ca_idcontacto
//            LIMIT $nreg OFFSET $inicio";

        //Consulta para Reenvio Coltrans
        $sql = "
            SELECT DISTINCT con.ca_email, max(con.ca_idcontacto) as ca_idcontacto, c.ca_idcliente
            FROM vi_clientes_reduc c
                INNER JOIN vi_clientes_std std ON c.ca_idcliente = std.ca_idcliente
                RIGHT JOIN tb_concliente con ON c.ca_idcliente = con.ca_idcliente AND ca_fijo=true AND con.ca_email like '%@%'
                    WHERE NOT EXISTS 
			(
                            SELECT * 
                            FROM encuestas.tb_control_encuesta cf 
                            WHERE con.ca_idcontacto = cf.ca_id_contestador and cf.ca_idformulario = $idformulario
			) 
	                AND std.ca_coltrans_std = 'Activo' AND (c.ca_tipo  is NULL OR c.ca_tipo LIKE '%Proveedor%') AND c.ca_vendedor IS NOT NULL and ca_vendedor not in ('Administrador','Comercial','comercial-baq','comercial-med','comercial-clo')
            GROUP BY con.ca_email, c.ca_idcliente
            ORDER BY ca_idcliente, ca_idcontacto
            LIMIT $nreg OFFSET $inicio";
        

//          $sql = "SELECT c.ca_idcliente,c.ca_compania, con.ca_email,ca_coltrans_std,ca_colmas_std,con.ca_idcontacto
//          FROM vi_clientes c
//          INNER JOIN tb_concliente con on c.ca_idcliente=con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
//          WHERE c.ca_idcliente = 5622
//          ORDER BY 2,3"; */

        $st = $con->execute($sql);
        $clientes = $st->fetchAll();
        
//        $clientes["BANCO DE BOGOTA S.A."]["ca_idcontacto"] = 11124;
//        $clientes["BANCO DE BOGOTA S.A."]["ca_email"] = "alramirez@coltrans.com.co";
//        $clientes["BANCO DE BOGOTA S.A."]["ca_coltrans_std"] = "Activo";

        $formulario = Doctrine::getTable("Formulario")->find($idformulario);
        $empresa = $formulario->getEmpresa();
        $asunto = "Encuesta de servicio, dos minutos de su tiempo nos ayuda a prestarle un mejor servicio";
        $data["email"] = array();
        
        foreach ($clientes as $cliente) {
            $conteo++;
            
            if(!in_array($cliente["ca_email"], $data["email"])){
                try {
                    $data["email"][] = $cliente["ca_email"];
                    $contacto = $cliente["ca_idcontacto"];
                        
                    $html = $this->getPartial('formulario/emailHtmlColtrans', array('contacto' => $contacto, 'idformulario' => $idformulario, "empresa" => $empresa));
                    
                    $email = new Email();
                    $email->setCaUsuenvio("Administrador");
                    $email->setCaFrom($formulario->getCaNombreFormato());
                    $email->setCaFromname(strtoupper($empresa->getCaNombre()));
                    $email->setCaSubject($asunto);
                    $email->setCaAddress($cliente["ca_email"]);
                    //$email->setCaAddress('alramirez@coltrans.com.co');
                    $email->setCaBody($contacto);
                    $email->setCaBodyhtml($html);
                    $email->setCaTipo("Encuesta");
                    $email->setCaIdcaso($idformulario);
                    $email->save();
                    $email->send();
                    $emails_Control.=$cliente["ca_compania"] . "->" . $cliente["ca_email"] . "<br>";
                } catch (Exception $e) {
                    $emails_Control.="No se pudo enviar " . $cliente["ca_email"] . ": porque : " . $e->getMessage() . "<br>";
                }
            }
            $this->html = $html;
            echo $cliente["ca_email"] . "<br>";
        }

        file_put_contents($filecontrol, $inicio + $conteo);

        $emailsControl.= "inicio=>" . $inicio . " nreg=>" . $nreg . " control.txt=>" . file_get_contents($filecontrol) . "<br/>";

        $email = new Email();
        $email->setCaUsuenvio("Administrador");
        $email->setCaFrom($formulario->getCaNombreFormato());
        $email->setCaFromname(strtoupper($empresa->getCaNombre()));
        $email->setCaSubject("Emails enviados - Encuesta Formulario->" . $idformulario);
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
                case 2:
                    return "Importaciones marítimo";                    
                case 3:
                    return "Exportaciones aéreo";                    
                case 4:
                    return "Exportaciones marítimo";                    
                case 5:
                    return "Proceso de Nacionalización en embarques aéreos";                    
                case 6:
                    return "Proceso de Nacionalización en embarques marítimos";                    
                case 7:
                    return "Proceso de Nacionalización en embarques con OTM / DTA";                    
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
                $parampreg = explode('_', $param);
                //$param."=>".print_r($parampreg)."===>";
                if (count($parampreg) > 1) {
                    $idpregunta = $parampreg[1];
                    $temp = $parampreg[2];
                        //echo "opcion1 - idpregunta=>".$idpregunta."<=:::servicio=>".intval($temp)."<br/>";
                } else {
                        $idpregunta = substr($param, 3, (strpos($param, "grupo")-3));
                        $temp = substr($param, (strpos($param, "grupo")+5), 2);

                        if(strpos($param, "sencillo")!== false){
                            $idpregunta = substr($param, 3, (strpos($param, "sencillo")-3));
                        $temp = 0;
                    }
                        //echo "opcion2 - idpregunta=>".$idpregunta."<=:::servicio=>".intval($temp)."<br/>";
                }

                $servicio = intval($temp);

                    if($servicio == 0){
                    $pregunta = Doctrine::getTable("Pregunta")->find($idpregunta);
                        if(isset($pregunta) && $pregunta->getProperty("quejas"))
                        $servicio = 8; // Servicio Quejas y Reclamos
                }
                    //echo "idpregunta=>".$idpregunta."<=:::servicio=>".$servicio."<br/>";
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
        
        $idtipo = $this->formulario->getCaIdtipo();        
        $metodo = "getListaEncuestasDiligenciadas$idtipo";        
        eval("\$metEncAvg = \"$metodo\";");
        
        $this->encuestas = $this->formulario->$metEncAvg($options, false);
        $this->cierre = $request->getParameter('cierre');

        $this->consolidado = array();
        $i = 1;
        foreach ($this->encuestas as $encuesta) {
            $this->consolidado[] = array(
                "idform" => $this->formulario->getCaId(),
                "servicio" => utf8_encode($encuesta["cf_ca_value"]),
                "pregunta" => '<p>'.utf8_encode($encuesta["p_ca_texto"]).'</p>',
                "resultado" => utf8_encode($encuesta["re_ca_resultado"]));
        }
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

    public function executeVerSeguimientos(sfWebRequest $request) {

        $idcliente = $request->getParameter("idcliente");

        $this->seguimientos = Doctrine::getTable("EveCliente")
                ->createQuery("s")
                ->addWhere("s.ca_idcliente = ? ", $idcliente)
                ->addWhere("s.ca_asunto like '%Encuesta satisfacción del Cliente%'")
                ->addOrderBy("s.ca_fchevento ASC")
                ->execute();
    }

    public function executeGuardarSeguimiento(sfWebRequest $request) {

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

        if ($request->getParameter("fchcompromiso")) {

            $cliente = Doctrine_Core::getTable('IdsCliente')->find($idcliente);

            $tarea = new NotTarea();
            $tarea->setCaUrl('/formulario/resultadoExt4/ca_id/' . $formulario->getCaId() . '/idcliente/' . $idcliente . '/idencuesta/' . $idencuesta);
            $tarea->setCaIdlistatarea(9);
            $tarea->setCaFchcreado(date("Y-m-d H:i:s"));
            $tarea->setCaFchvisible($request->getParameter("fchcompromiso") . " 00:00:00");
            $tarea->setCaFchvencimiento($request->getParameter("fchcompromiso") . " 23:59:59");
            $tarea->setCaUsucreado($this->getUser()->getUserId());
            $tarea->setCaTitulo("Seguimiento programado Cliente: " . $cliente->getIds()->getCaNombre());
            $tarea->setCaTexto("En el seguimiento a " . $formulario->getCaTitulo() . " se programó este seguimiento.");
            $tarea->save($con);

            $cliente->setProperty("idtarea", $tarea->getCaIdtarea());
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

    public function executeIndexExt5(sfWebRequest $request) {
        
        $id = $request->getParameter("id");
        $idDecode = base64_decode($id);
        $idformulario = intval($idDecode);
        
        $idcontacto = $request->getParameter("co");
        $this->tipo = $request->getParameter("tipo");
        $this->idstatus = $request->getParameter("idstatus");
        $this->idcliente = $request->getParameter("cl");
        $idDecco = base64_decode($idcontacto);
        $idcontacto = intval($idDecco);
        $formulario = Doctrine::getTable("Formulario")->find($idformulario);
        
        $this->formulario = $formulario;
        
        $fchCierre = $formulario->getCaCierre();
        $hoy = date('Y-m-d');

//        if($this->tipo == 2){
//            $status = Doctrine::getTable("RepStatus")->find($this->idstatus);
//            $email = $status->getEmail();
//            $compania = $status->getReporte()->getContacto()->getCliente();
//            $contactos = $email->getEmailsCliente($compania->getCaIdcliente());
//        };

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
        } else {
            $existe_contacto = Doctrine::getTable("controlEncuesta")->findByDql("ca_id_contestador = ? AND ca_idformulario = ?", array($idcontacto, $idformulario));
            
            if (count($existe_contacto)>0) {
                
                $this->setTemplate('guardado');
                $detect = new Mobile_Detect();
                $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
                $this->device = $dispositivo;
                if ($dispositivo == 'mobile') {                    
                    $this->setLayout('mobile/encuestaExt5');
                } elseif ($dispositivo == 'tablet') {
                    $this->setLayout('mobile/formulario');
                } else {
                    $this->setLayout('formulario');
                }
            } else {
                $this->idcontacto = $idcontacto;
                $this->idformulario = $idformulario;
                $detect = new Mobile_Detect();
                $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
                $this->device = $dispositivo;
                if ($dispositivo == 'mobile') {
                     $this->setTemplate('indexMobExt5');
                     $this->setLayout('mobile/encuestaExt5');
                } elseif ($dispositivo == 'tablet') {
                     $this->setLayout('mobile/encuestaExt5');
                     $this->setTemplate('indexMobExt5');                    
                }
            }
        }
    }
    
    public function executeDatosPreguntas(sfWebRequest $request){
        
        $idformulario = $request->getParameter("idformulario");
        
//        try{
            $formulario = Doctrine::getTable("formulario")->find($idformulario);
            $bloques = Doctrine::getTable("Bloque")->findBy("ca_idformulario",$idformulario);
            $row = $data = $servicios = array();
            
            if($bloques){
                foreach($bloques as $bloque){
                    $preguntas = Doctrine::getTable("Pregunta")
                            ->createQuery("p")
                            ->where("ca_idbloque = ?", $bloque->getCaId())
                            ->addWhere("ca_activo = ?", TRUE)
                            ->orderBy("ca_orden ASC")
                            ->execute();
                    
                    //if(count($servicios)==0){                        
                        if($preguntas){
                            foreach($preguntas as $pregunta){
//                                echo $pregunta->getCaId()."-".$pregunta->getCaTipo()."-".$pregunta->getProperty("idpadre")."<br/>";                            
                                if($pregunta->getCaTipo()==5){
                                    $opciones = Doctrine::getTable("Opcion")->findBy("ca_idpregunta",$pregunta->getCaId());
                                    
                                    foreach($opciones as $opcion){
                                        $datos = json_decode($opcion->getCaDatos());                                        
                                        if(!in_array($opcion->getCaTexto(), $servicios))
                                            $servicios[$datos->idtipo] = $opcion->getCaTexto();
                                    }
                                }
                                if($pregunta->getProperty("idpadre")){
                                    $idpadre[$pregunta->getProperty("idpadre")] = $pregunta->getCaId();
                                }else{
                                    $idpadre[$pregunta->getProperty("idpadre")] = null;
                                }
                            }
                        }
                    //}
//                    echo "<pre>";print_r($servicios);echo "</pre>";                    
//                    echo "<pre>";print_r($idpadre);echo "</pre>";
                }

                foreach($bloques as $bloque){                    
                    $preguntas = Doctrine::getTable("Pregunta")
                            ->createQuery("p")
                            ->where("ca_idbloque = ?", $bloque->getCaId())
                            ->addWhere("ca_activo = ?", TRUE)
                            ->orderBy("ca_orden ASC")
                            ->execute();

                    foreach($preguntas as $pregunta){
                        if($pregunta->getCaTipo()!=5){
                            $row["idservicio"] = $pregunta->getCaIdbloque();
                            $row["idpregunta"] = $pregunta->getCaId();
                            //$row["idformulario"] = $pregunta->getBloque()->getFormulario()->getCaId();
                            //$row["titulo"] = utf8_encode($pregunta->getBloque()->getFormulario()->getCaTitulo());
                            $row["pregunta"] = utf8_encode($pregunta->getCaTexto());
                            $row["error"] = utf8_encode($pregunta->getCaError());
                            $row["ayuda"] = utf8_encode($pregunta->getCaAyuda());
                            $row["obligatoria"] = $pregunta->getCaObligatoria();
                            $row["tipo"] = $pregunta->getCaTipo();
                            $row["orden"] = $pregunta->getCaOrden();
                            $row["comentarios"] = utf8_encode($pregunta->getCaComentarios());
                            $row["oculto"] = $pregunta->getProperty("oculto")?$pregunta->getProperty("oculto"):false;
                            $row["idhijo"] = $idpadre[$pregunta->getCaId()];

                            $row["servicios"] = [];
                            foreach($servicios as $key =>$val){
                                $row["servicios"][$key] = utf8_encode($servicios[$key]);
                            }

                            $opcionesp = $pregunta->getOpcionesOrdenadas($pregunta->getCaId());                           
                            
                            $row["opciones"] = [];
                            switch($pregunta->getCaTipo()){
                                case 8:
                                    foreach($opcionesp as $opcion){
                                        $row["opciones"][utf8_encode($opcion->getCaTexto())] = $opcion->getCaTitle(); 
                                    }
                                    break;
                                case 6:
                                    foreach($opcionesp as $opcion){
                                        $r["inputValue"] = utf8_encode($opcion->getCaTexto()); 
                                        $r["boxLabel"] = utf8_encode($opcion->getCaTitle()); 
                                        $row["opciones"][] = $r;
                                    }
                                    break;
                                case 9:
                                    $i=1;
                                    foreach($opcionesp as $opcion){                                        
                                        $r["inputValue"] = utf8_encode($opcion->getCaTexto()); 
                                        $r["boxLabel"] = utf8_encode($opcion->getCaTitle());
                                        $r["id"] = "Item".utf8_encode($opcion->getCaTexto())."-".$pregunta->getCaId();
                                        $row["opciones"][] = $r;
                                        $i++;
                                    }       
                                    break;
                            }       
                            $data[] = $row;
                        }
                    }
                }
            }
            
            $idempresa = $formulario->getCaEmpresa();
            $empresa = Doctrine::getTable("Empresa")->findOneBy('ca_idempresa', $idempresa);
            
            $logo = $empresa->getLogoEncuesta();
//            $logo = $empresa->getLogoHtml();

//            echo "#Servicios:".count($servicios)."<br>";
//            echo "#Preguntas:".count($preguntas)."<br>";        
//            echo "Servicios:<br/>";
//            echo "<pre>";print_r($calificar);echo "</pre>";
//            echo "Data:<br/>";
//            echo "<pre>";print_r($data);echo "</pre>";
//            exit();
            $this->responseArray = array("success" => true, "id" => $idformulario, "data"=>$data, "titulo"=> utf8_encode($formulario->getCaTitulo()), "encabezado"=> utf8_encode($formulario->getCaIntroduccion()), "servicio"=> utf8_encode($formulario->getCaAlias()), "logo"=>$logo);
//        } catch (Exception $e){
//            $this->responseArray = array( "success" => false, "error" => utf8_encode($e->getMessage()));
//        }
        $this->setTemplate("responseTemplate");
    }
    
    public function executeGuardarDatosEncuesta(sfWebRequest $request){
        
        $user = $this->getUser();
        
        $idformulario = $request->getParameter("idformulario");
        $idcontacto = $request->getParameter("idcontacto");        
        $datos = json_decode($request->getParameter("datos"));
        $tipo = $request->getParameter("tipo");

        $formulario = Doctrine::getTable("Formulario")->find($idformulario);

        $conn = Doctrine::getTable("controlEncuesta")->getConnection();
        $conn->beginTransaction();

        try {
            if(!$user->getUserId()){
                if($tipo == 1){ // Encuesta Anual

                    $existe_contacto = Doctrine::getTable("controlEncuesta")->findByDql("ca_id_contestador = ? AND ca_idformulario = ?", array($idcontacto, $idformulario));

                    if(count($existe_contacto)==0){
                        $control = new ControlEncuesta;
                        $control->setCaId(null);
                        $control->setCaIdformulario($idformulario);
                        $control->setCaIdempresa($formulario->getCaEmpresa());
                                        $control->setCaTipoContestador($tipo);
                        $control->setCaIdContestador($idcontacto);
                        $control->save($conn);

                        foreach($datos as $key => $val){

                            $idpregunta = $val->id;
                            $idservicio = $val->idservicio;
                            $valor = $val->valor;

                            $pregunta = Doctrine::getTable("Pregunta")->find($idpregunta);

                            if(!is_int($valor) || $pregunta->getProperty("quejas"))                    
                                $idservicio = 8;

                            if($valor){
                                $resultado = new ResultadoEncuesta();
                                $resultado->setCaIdpregunta($idpregunta);
                                $resultado->setCaResultado($valor);
                                $resultado->setCaIdcontrolencuesta($control->getCaId());
                                $resultado->setCaServicio($idservicio);
                                $resultado->save($conn);
                            }

                            $comentario = $request->getParameter("comentarios-".$idpregunta);
                            if(isset($pregunta) && $pregunta->getProperty("quejas"))
                                $idservicio = 8; // Servicio Quejas y Reclamos
                            else
                                $idservicio = 0;

                            if($comentario){
                                $resultado = new ResultadoEncuesta();
                                $resultado->setCaIdpregunta($idpregunta);
                                $resultado->setCaResultado(utf8_decode($comentario));
                                $resultado->setCaIdcontrolencuesta($control->getCaId());
                                $resultado->setCaServicio($idservicio);
                                $resultado->save($conn);                    
                            }
                        }
                        $conn->commit();
                        $this->responseArray = array("success" => true, "id" => $idformulario, "idcontrol"=>$control->getCaId());
                    }else{
                        $this->responseArray = array("success" => false, "id" => $idformulario, "errorInfo"=>"Esta encuesta ya ha sido diligenciada.");
                    }       
                }else if($tipo == 2){ // Encuesta de servicio
                    $idstatus = base64_decode($request->getParameter("idstatus"));                    
                    $idclienteparam = base64_decode($request->getParameter("idcliente"));                    

                    $existe_status = Doctrine::getTable("controlEncuesta")->findByDql("ca_id_contestador = ? AND ca_idformulario = ?", array($idstatus, $idformulario));

                    if(count($existe_status)==0){
                        $status = Doctrine::getTable("RepStatus")->find($idstatus);
                        $compania = $status->getReporte()->getContacto()->getCliente();
                        $idcliente = $compania->getCaIdcliente();

                        if($idcliente == $idclienteparam){                        
                            if($status){                                    
                                $datosControl = array();                        
                                $datosControl["idcliente"] = $idcliente;

                                $control = new ControlEncuesta();                       
                                $control->setCaIdformulario($idformulario);
                                $control->setCaIdempresa($formulario->getCaEmpresa());
                                $control->setCaTipoContestador($tipo);
                                $control->setCaIdContestador($idstatus);
                                $control->setCaDatos(json_encode($datosControl));
                                $control->save($conn);

                                foreach($datos as $key => $val){

                                    $idpregunta = $val->id;
                                    $idservicio = $val->idservicio;
                                    $valor = intval($val->valor);                                    

                                    $pregunta = Doctrine::getTable("Pregunta")->find($idpregunta);

                                    if(!is_int($valor) || $pregunta->getProperty("quejas"))                    
                                        $idservicio = 8;
                                    
                                    if($valor){
                                        $resultado = new ResultadoEncuesta();
                                        $resultado->setCaIdpregunta($idpregunta);
                                        $resultado->setCaResultado($valor);
                                        $resultado->setCaIdcontrolencuesta($control->getCaId());
                                        $resultado->setCaServicio($idservicio);
                                        $resultado->save($conn);
                                    }

                                    $comentario = $request->getParameter("comentarios-".$idpregunta);
                                    if($pregunta){
                                        if($pregunta->getProperty("quejas"))
                                            $idservicio = 8; // Servicio Quejas y Reclamos
                                        else
                                            $idservicio = 0;
                                    }

                                    if($comentario){
                                        $resultado = new ResultadoEncuesta();
                                        $resultado->setCaIdpregunta($idpregunta);
                                        $resultado->setCaResultado(utf8_decode($comentario));
                                        $resultado->setCaIdcontrolencuesta($control->getCaId());
                                        $resultado->setCaServicio($idservicio);
                                        $resultado->save($conn);                    
                                    }
                                }
                                
                                $asunto = "Encuesta de Servicio :".$compania." Status: ".$status->getEmail()->getCaSubject(); 
                                $address = $status->getEmail()->getCaFrom();
                                $vendedor = $compania->getUsuario()->getCaEmail()?$compania->getUsuario()->getCaEmail():"seguros@coltrans.com.co";

                                $request->setParameter("idcontrol", $control->getCaId());
                                $html = sfContext::getInstance()->getController()->getPresentationFor('formulario', 'emailEncuestaServicio');

                                $email = new Email();
                                $email->setCaUsuenvio("Administrador");
                                $email->setCaTipo("Encuesta de opinión");
                                $email->setCaIdcaso($idstatus);
                                $email->setCaFrom($formulario->getCaNombreFormato());
                                $email->setCaFromname(strtoupper($formulario->getEmpresa()->getCaNombre()));
                                $email->setCaSubject($asunto);
                                $email->setCaAddress($address);
                                $email->setCaCc($vendedor);
                                $email->setCaBodyhtml($html);
                                $email->setCaBody($idcontacto);                                                
                                $email->save($conn);

                                $conn->commit();
                                $this->responseArray = array("success" => true, "id" => $idformulario, "idcontrol"=>$control->getCaId());
                            }else{
                                $this->responseArray = array("success" => false, "id" => $idformulario, "errorInfo"=>"No hay un status valido");
                            }
                        }else{
                            $this->responseArray = array("success" => false, "id" => $idformulario, "errorInfo"=>"El status no pertenece al cliente seleccionado.");
                        }
                    }else{
                        $this->responseArray = array("success" => false, "id" => $idformulario, "errorInfo"=>utf8_encode("Ya tenemos una encuesta registrada sobre este status. Favor remitirse a su Representante Comercial para verificar el seguimiento a su caso.!"));
                    }
                }else{
                    $this->responseArray = array("success" => false, "id" => $idformulario, "errorInfo"=>utf8_encode("Tipo de encuenta inválida!"));
                }
            }else
                $this->responseArray = array( "success" => false, "errorInfo" => utf8_encode("Los usuarios internos NO DEBEN responder la encuesta")); 
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array( "success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        } 
        
        $this->setTemplate("responseTemplate");        
    }
    
    public function executeEmailEncuestaServicio(sfWebRequest $request) {
        
        $idcontrol = $this->getRequestParameter("idcontrol");
        $this->forward404Unless($idcontrol);
        
        $controlEnc = Doctrine::getTable("ControlEncuesta")->find($idcontrol);
        $datos = json_decode($controlEnc->getCaDatos());
        $respuestas = array();
        
        $idcliente = $datos->idcliente;
        $this->cliente = Doctrine::getTable("Cliente")->find($idcliente);
        $this->status = Doctrine::getTable("Repstatus")->find($controlEnc->getCaIdContestador());
        
        $resultados = Doctrine::getTable("ResultadoEncuesta")
                ->createQuery("re")
                ->where("re.ca_idcontrolencuesta = ?", $idcontrol)
                ->orderBy("ca_id ASC")
                ->execute();
        
        foreach($resultados as $resultado){
            $pregunta = Doctrine::getTable("Pregunta")->find($resultado->getCaIdpregunta());
            $opcion = Doctrine::getTable("Opcion")->findByDql("ca_idpregunta = ? AND ca_texto = ?",array($pregunta->getCaId(), $resultado->getCaResultado()))->getFirst();
            
            $respuestas[$resultado->getCaIdpregunta()]["pregunta"] = $pregunta->getCaTexto();
            
            if($resultado->getCaServicio()!= 0)
                $respuestas[$resultado->getCaIdpregunta()]["valor"] = $opcion->getCaTitle();
            else
                $respuestas[$resultado->getCaIdpregunta()]["comentarios"] = $resultado->getCaResultado();
        }
       
        $this->result = $respuestas;
        
        $this->setLayout("none");
    }
}
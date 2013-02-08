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
        //$formularios = Doctrine_Core::getTable('formulario')->createQuery('a');
        $formulario = new Formulario();
        $this->filtroFormulario = new FormularioFormFilter();
        $this->pager = new sfDoctrinePager('formulario', 30);
        $this->pager->setQuery($formulario->getQueryFormulario());
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

        $contacto = $request->getParameter('co');
        $idContacto = $contacto;
        $contactoDecode = base64_decode($idContacto);

        //$num_contacto = intval($contactoDecode);


        function getExisteControl($num_contacto) {
            $q = Doctrine_Query::create()
                    ->from('controlEncuesta')
                    ->where('ca_id_contestador = ?', $num_contacto)
                    ->andWhere('ca_idformulario = ?', 1);
            return $q->fetchOne();
        }

        $existe_contacto = getExisteControl($contactoDecode);

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
            $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);
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

    /**
     * Carga el consolidado de las encuestas.
     * @param sfWebRequest $request
     */

    /**
     * Carga el consolidado de las encuestas.
     * @param sfWebRequest $request
     */
    public function executeConsolidado(sfWebRequest $request) {
        $id = $request->getParameter('ca_id');
        $idDecode = base64_decode($id);
        $idControl = intval($idDecode);

        $empresa = $request->getParameter('e');
        $empresaDecode = base64_decode($empresa);
        $empresa_value = intval($empresaDecode);

        $this->formulario = Doctrine_Core::getTable('formulario')->find($idControl);
        $this->control = new ControlEncuesta();

        //calcula el numero de formularios diligenciados
        $this->encuestas_diligenciadas = $this->control->contarEncuestas($idControl);

        //calcula el numero de formularios enviados via mail.
        $con = Doctrine_Manager::getInstance()->connection();
        $sql1 = "
           SELECT count (*) as enviados
           FROM public.tb_emails
           WHERE ca_tipo = 'Encuesta'
           AND ca_usuenvio = 'Administrador'
           AND ca_address != 'gmartinez@coltrans.com.co'
           AND ca_idcaso = " . $idControl;
        $temp1 = $con->execute($sql1);
        $this->encuestas_enviadas = $temp1->fetchAll();

        //calcula el numero de formularios  unicos enviados via mail.
        $con2 = Doctrine_Manager::getInstance()->connection();
        $sql2 = "
        SELECT count(distinct ca_address) as unicas
        FROM public.tb_emails
        WHERE ca_tipo = 'Encuesta'
        AND ca_usuenvio = 'Administrador'
        AND ca_address != 'gmartinez@coltrans.com.co'
        AND ca_idcaso = " . $idControl . ";";
        $temp2 = $con2->execute($sql2);
        $this->encuestas_unicas_enviadas = $temp2->fetchAll();

        //calcula el consolidado.
        $con3 = Doctrine_Manager::getInstance()->connection();
        $sql3 = "
            select cf.ca_id, i.ca_nombre as ca_compania, con.ca_email,con.ca_idcontacto, con.ca_nombres, con.ca_papellido, con.ca_sapellido, cl.ca_vendedor, cu.ca_nombre as ca_nombreVendedor, csuc.ca_nombre as ca_ciudad, cf.ca_fchcreado, p.ca_texto, re.ca_resultado, cfv.ca_value as ca_servicio
            from ids.tb_ids i
            inner join tb_clientes cl on cl.ca_idcliente=i.ca_id
            inner join tb_concliente con on con.ca_idcliente=cl.ca_idcliente
            right join encuestas.tb_control_encuesta cf on ca_idcontacto=ca_id_contestador            
            left join control.tb_usuarios cu on cl.ca_vendedor=cu.ca_login
            left join control.tb_sucursales csuc on cu.ca_idsucursal=csuc.ca_idsucursal
            inner join encuestas.tb_resultado_encuesta re on cf.ca_id=re.ca_idcontrolencuesta
            inner join encuestas.tb_pregunta p on re.ca_idpregunta = p.ca_id
            inner join control.tb_config_values cfv on cfv.ca_idconfig=211 and re.ca_servicio=cfv.ca_ident
            where (cf.ca_idformulario = " . $idControl . " and (cf.ca_tipo_contestador=1))
            order by csuc.ca_nombre, cf.ca_id                    
        ";
        $temp3 = $con3->execute($sql3);
        $this->c_encuestas = $temp3->fetchAll();

        $detect = new Mobile_Detect();
        $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
        $this->device = $dispositivo;
        $this->setLayout('layout_home');
    }

    /**
     * Carga la encuesta de servicio, luego de recibir como parÃ¡metro el listado de servicios previamente seleccionados por el usuario.
     * @param sfWebRequest $request
     */
    public function executeEstadistica(sfWebRequest $request) {
        $id = $request->getParameter('ca_id');
        $idDecode = base64_decode($id);
        $idFormulario = intval($idDecode);

        $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);
        //$this->contacto = $request->getParameter('co');
        //retorna el listado de contactos que diligenciaron la encuesta.

        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "
            select cf.ca_id,cf.ca_id_contestador,i.ca_nombre, con.ca_email,con.ca_idcontacto, con.ca_nombres, con.ca_papellido, con.ca_sapellido, cl.ca_vendedor, cu.ca_nombre as representante, csuc.ca_nombre as sucursal, cf.ca_fchcreado
            from ids.tb_ids i
            inner join tb_clientes cl on cl.ca_idcliente=i.ca_id
            inner join tb_concliente con on con.ca_idcliente=cl.ca_idcliente
            right join encuestas.tb_control_encuesta cf on ca_idcontacto=ca_id_contestador            
            left join control.tb_usuarios cu on cl.ca_vendedor=cu.ca_login
            left join control.tb_sucursales csuc on cu.ca_idsucursal=csuc.ca_idsucursal
            where (cf.ca_idformulario = " . $idFormulario . ") and (cf.ca_tipo_contestador=1)
            order by sucursal    
            ";
        $st = $con->execute($sql);
        $this->contactos = $st->fetchAll();

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
        // $this->servicio = 'aduana';
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
        $filecontrol = $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "formulario" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "control.txt";

        if (file_exists($filecontrol)) {
            $inicio = file_get_contents($filecontrol);
        }
        if (!$inicio)
            $inicio = 0;
        $con = Doctrine_Manager::getInstance()->connection();

        $nreg = 10;

        $sql = "
            select c.ca_idcliente,c.ca_compania, con.ca_email,ca_coltrans_std,ca_colmas_std,con.ca_idcontacto
            from vi_clientes c
            inner join tb_concliente con on c.ca_idcliente=con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
            where (c.ca_coltrans_std = 'Activo'  or c.ca_colmas_std = 'Activo' )
            order by 2,3 limit $nreg offset $inicio";

        $st = $con->execute($sql);
        $clientes = $st->fetchAll();
        //plantilla evalucion servicio
        $conteo = 0;
        $emails_Control = "";
        $asunto = "Dos minutos de su tiempo nos ayuda a prestarle un mejor servicio";
        $emailFrom = "gmartinez@coltrans.com.co";
        foreach ($clientes as $cliente) {
            $conteo++;
            if ($cliente["ca_coltrans_std"] != "Activo")
                continue;
            try {
                $contacto = $cliente["ca_idcontacto"];
                $html = $this->getPartial('formulario/emailHtml', array('contacto' => $contacto));
                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaFrom("no-reply@coltrans.com.co");
                $email->setCaFromname("COLTRANS S.A.S");
                $email->setCaSubject($asunto);
                //$email->setCaAddress($cliente["ca_email"]);
                $email->setCaAddress("gmartinez@coltrans.com.co");
                $email->setCaBodyhtml($html);
                $email->setCaTipo("Encuesta");
                $email->save();
                $emails_Control.=$cliente["ca_compania"] . "->" . $cliente["ca_email"] . "<br>";
            } catch (Exception $e) {
                $emails_Control.="No se pudo enviar " . $cliente["ca_email"] . ": porque : " . $e->getMessage() . "<br>";
            }
            $this->html = $html;
            echo $cliente["ca_email"] . "<br>";
        }

        file_put_contents($filecontrol, $inicio + $conteo);
        $email = new Email();
        $email->setCaUsuenvio("gmartinez");
        $email->setCaFrom($emailFrom);
        $email->setCaFromname("COLTRANS LTDA");
        $email->setCaSubject($asunto . ". Emails enviados");
        $email->setCaAddress("gmartinez@coltrans.com.co");
        //$email->setCaCc("gmartinez@coltrans.com.co");
        $email->setCaBodyhtml($html . "Emails enviados:<br>" . $emails_Control);
        $email->setCaTipo("Encuesta");
        $email->send();
        $email->save();
        echo "enviados";
        exit;
        //echo $html;
        //}
        $this->setTemplate('envioEmailsPrueba');
    }

    /**
     * Metodo para enviar la encuesta
     * @param type $idCaso Es el id del formulario que se esta enviando
     */
    public function executeEnvioEmailsColtrans() {

        $filecontrol = $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "formulario" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "control.txt";

        if (file_exists($filecontrol)) {
            $inicio = file_get_contents($filecontrol);
        }
        if (!$inicio)
            $inicio = 0;
        $con = Doctrine_Manager::getInstance()->connection();

        $nreg = 10;

        $sql = "
            select c.ca_idcliente,c.ca_compania, con.ca_email,ca_coltrans_std,ca_colmas_std,con.ca_idcontacto
            from vi_clientes c
            inner join tb_concliente con on c.ca_idcliente=con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
            where (c.ca_coltrans_std = 'Activo'  or c.ca_colmas_std = 'Activo' )
            order by 2,3 limit $nreg offset $inicio";

        $st = $con->execute($sql);
        $clientes = $st->fetchAll();
        //plantilla evalucion servicio
        $conteo = 0;
        $emails_Control = "";
        $asunto = "Dos minutos de su tiempo nos ayuda a prestarle un mejor servicio";
        $emailFrom = "gmartinez@coltrans.com.co";
        foreach ($clientes as $cliente) {
            $conteo++;
            if ($cliente["ca_coltrans_std"] != "Activo")
                continue;
            try {
                $contacto = $cliente["ca_idcontacto"];
                $html = $this->getPartial('formulario/emailHtmlColtrans', array('contacto' => $contacto));
                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaFrom("no-reply@coltrans.com.co");
                $email->setCaFromname("COLMAS LTDA.");
                $email->setCaSubject($asunto);
                //$email->setCaAddress($cliente["ca_email"]);
                $email->setCaAddress("gmartinez@coltrans.com.co");
                $email->setCaBodyhtml($html);
                $email->setCaTipo("Encuesta");
                $email->setCaIdcaso($idCaso);
                $email->save();
                $emails_Control.=$cliente["ca_compania"] . "->" . $cliente["ca_email"] . "<br>";
            } catch (Exception $e) {
                $emails_Control.="No se pudo enviar " . $cliente["ca_email"] . ": porque : " . $e->getMessage() . "<br>";
            }
            $this->html = $html;
            echo $cliente["ca_email"] . "<br>";
        }

        file_put_contents($filecontrol, $inicio + $conteo);
        $email = new Email();
        $email->setCaUsuenvio("gmartinez");
        $email->setCaFrom($emailFrom);
        $email->setCaFromname("COLTRANS LTDA");
        $email->setCaSubject($asunto . ". Emails enviados");
        $email->setCaAddress("gmartinez@coltrans.com.co");
        //$email->setCaCc("gmartinez@coltrans.com.co");
        $email->setCaBodyhtml($html . "Emails enviados:<br>" . $emails_Control);
        $email->setCaTipo("Encuesta");
        $email->send();
        $email->save();
        echo "enviados";
        exit;
        //echo $html;
        //}
        $this->setTemplate('envioEmailsPrueba');
    }

    /**
     * Metodo para enviar la encuesta
     * @param type $idCaso Es el id del formulario que se esta enviando
     */
    public function executeEnvioEmailsColmas() {

        $filecontrol = $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "formulario" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "control.txt";

        if (file_exists($filecontrol)) {
            $inicio = file_get_contents($filecontrol);
        }
        if (!$inicio)
            $inicio = 0;
        $con = Doctrine_Manager::getInstance()->connection();

        $nreg = 6;

        $sql = "
            select c.ca_idcliente,c.ca_compania, con.ca_email,ca_coltrans_std,ca_colmas_std,con.ca_idcontacto
            from vi_clientes c
            inner join tb_concliente con on c.ca_idcliente=con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
            where (c.ca_coltrans_std = 'Activo'  or c.ca_colmas_std = 'Activo' )
            order by 2,3 limit $nreg offset $inicio";

        $st = $con->execute($sql);
        $clientes = $st->fetchAll();
        //plantilla evalucion servicio
        $conteo = 0;
        $emails_Control = "";
        $asunto = "Dos minutos de su tiempo nos ayuda a prestarle un mejor servicio";
        $emailFrom = "gmartinez@coltrans.com.co";
        //para destinatarios de prueba
        $emailCa = array("gmartinez@coltrans.com.co", "cazambrano@coltrans.com.co", "mpulido@coltrans.com.co", "pizquierdo@coltrans.com.co", "falopez@coltrans.com.co", "gmartinez@coltrans.co");
        foreach ($clientes as $cliente) {
            $conteo++;
            if ($cliente["ca_colmas_std"] != "Activo")
                continue;
            try {
                $contacto = $cliente["ca_idcontacto"];
                $html = $this->getPartial('formulario/emailHtmlColmas', array('contacto' => $contacto));
                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaFrom("no-reply@coltrans.com.co");
                $email->setCaFromname("COLMAS LTDA.");
                $email->setCaSubject($asunto);
                //$email->setCaAddress($cliente["ca_email"]);
                //$email->setCaAddress("gmartinez@coltrans.com.co");
                // $email->setCaAddress($emailCa[$conteo-1],$emailCa[0]);
                $email->setCaAddress($emailCa[0]);
                $email->setCaBodyhtml($html);
                $email->setCaTipo("Encuesta");
                $email->setCaIdcaso(0);
                $email->save();
                $emails_Control.=$cliente["ca_compania"] . "->" . $cliente["ca_email"] . "<br>";
            } catch (Exception $e) {
                $emails_Control.="No se pudo enviar " . $cliente["ca_email"] . ": porque : " . $e->getMessage() . "<br>";
            }
            $this->html = $html;
            echo $cliente["ca_email"] . "<br>";
        }

        file_put_contents($filecontrol, $inicio + $conteo);
        $email = new Email();
        $email->setCaUsuenvio("gmartinez");
        $email->setCaFrom($emailFrom);
        $email->setCaFromname("COLMAS LTDA");
        $email->setCaSubject($asunto . ". Emails enviados");
        $email->setCaAddress("gmartinez@coltrans.com.co");
        //$email->setCaCc("gmartinez@coltrans.com.co");
        $email->setCaBodyhtml($html . "Emails enviados:<br>" . $emails_Control);
        $email->setCaTipo("Encuesta");
        $email->send();
        $email->save();
        echo "enviados";
        exit;
        //echo $html;
        //}
        $this->setTemplate('envioEmailsPrueba');
    }

    public function executeTest(sfWebRequest $request) {
        $this->setLayout('testmail');
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

        //$this->parametros = ParametroTable::retrieveByCaso("CU116", null, null, null);
        //$parametros = $this->parametros;
        $id = $request->getParameter('id');
        $idDecode = base64_decode($id);
        $idFormulario = intval($idDecode);

        $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);
        
        $contacto = $request->getParameter('co');
        $idContact = base64_decode($contacto);
        $idContacto = intval($idContact);
        /* if(!$idContacto){
          } */
        $idEmpresa = 2;
        //$idContactoCliente = 2;  // debo recibirlo en la ruta
        //guardando el resumen del resultado
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
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollBack();
            throw $e;
        }
        $conn2 = Doctrine::getTable("resultadoEncuesta")->getConnection();
        $conn2->beginTransaction();

        try {
            foreach ($request->getPostParameters() as $param => $val) {
                //procesar los datos
                $parampreg = explode('_', $param);
                $idpregunta = $parampreg[1];
                $temp = $parampreg[2];
                $temp2 = explode('-', $temp);
                $servicio = $temp2[1];
                $this->$idpregunta = $parampreg[1];
                //guardar los datos
                $resultado = new ResultadoEncuesta();
                $resultado->setCaId(null);
                $resultado->setCaIdpregunta($idpregunta);
                $resultado->setCaResultado($val);
                $resultado->setCaIdcontrolencuesta($idcontrol);
                $resultado->setCaServicio(intval($servicio));
                $resultado->save($conn);
            }
            $conn2->commit();
        } catch (Exception $e) {
            $conn2->rollBack();
            throw $e;
        }
        $this->control = $idcontrol;
        /*
          print_r($request->getPostParameters());
         */

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
//$formulario = $this->formulario;
//$formulario2 = Doctrine_Core::getTable('formulario')->getFormulario(2);
//$mensaje = sfContext::getInstance()->getController()->getPresentationFor( 'formulario', 'vistaPrevia2');
//$this->message = $mensaje ;
//$results = $this->renderPartial('foo/bar');
//$html="<p>texto de ejemplo </p>";
//$html= $this->getPartial('formulario/vistaPreviaFormulario2',array('formulario' => $this->formulario));
//$this->mensaje = sfContext::getInstance()->getController()->getPresentationFor( 'formulario', 'test');
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
     * Vista previa en ajax
     * @deprecated
     * aÃºn no funciona... es una prueba
     * @param sfWebRequest $request
     */
    public function executeVistaPreviaAjax(sfWebRequest $request) {
        $idFormulario = $request->getParameter('ca_id');
        $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);
//$mensaje = sfContext::getInstance()->getController()->getPresentationFor( 'formulario', 'vistaPrevia2');
// $this->message = $mensaje ;
        $this->setLayout('formulario');
        sfConfig::set('sf_web_debug', false);
    }

    /**
     * Realiza la vista previa de un formulario
     * @param sfWebRequest $request
     * @deprecated
     */
    public function executeVistaPrevia2(sfWebRequest $request) {
        $idFormulario = $request->getParameter('ca_id');
        $this->servicios = 'Aereo, Maritimo, Exportaciones Aereo, Exportaciones Maritimo, Aduana';
        $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);
//$mensaje = sfContext::getInstance()->getController()->getPresentationFor( 'formulario', 'vistaPrevia2');
// $this->message = $mensaje ;
        $this->setLayout('formulario');
        sfConfig::set('sf_web_debug', false);
    }

    /**
     * Permite previsualizar de manera exclusiva el formulario de evaluaciÃ³n de clientes.
     * @deprecated
     * @param sfWebRequest $request
     */
    public function executeEvalServicioClientes(sfWebRequest $request) {
        $this->formulario = Doctrine_Core::getTable('formulario')->getFormulario(1);
        //$this->bloques = Doctrine_Core::getTable('bloque')->getBloquesOrdenados(1);
        $this->setLayout('formulario');
        $this->setTemplate('vistaPrevia');
    }

    /**
     * Metodo personalizado para mostrar los datos del formulario guardado
     * @param sfWebRequest $request
     * @deprecated
     * aun no se esta utilizando.
     */
    public function executeResultado(sfWebRequest $request) {
        //$this->parametros = ParametroTable::retrieveByCaso("CU116", null, null, null);
        //$parametros = $this->parametros;

        $id = $request->getParameter('ca_id');
        $this->id = $id;
        $idDecode = base64_decode($id);
        $idControl = intval($idDecode);

        $this->control = Doctrine_Core::getTable('controlEncuesta')->find($idControl);
        $this->resultado = Doctrine_Core::getTable('controlEncuesta')->find($idControl);

        $this->formulario = new Formulario();
        $this->pregunta = new Pregunta();
        // $this->setTemplate('resultado');
        $this->setLayout('layout_home');

        $this->control = new ControlEncuesta();
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

}

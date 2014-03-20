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
        
        $this->id=$id;
        //$formularios = Doctrine_Core::getTable('formulario')->createQuery('a');
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
        
        if($hoy>=$fchCierre){
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
        }else{

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
     * Carga el reporte detallado de las encuestas.
     * @param sfWebRequest $request
     */
    public function executeReporteDetallado(sfWebRequest $request) {

        //se recibe el id del formulario para cambiarlo de base y poder construir 
        //el objeto mas adelante
        $idFormulario = intval(base64_decode($request->getParameter('id')));
        $this->forward404Unless($idFormulario);
        //parametros del formulario
        $sucursal = $request->getParameter('sucursal');
        $pregunta = $request->getParameter('pregunta');
        $servicio = $request->getParameter('servicio');
        //valores necesarios para mostrar los valores
        $this->p_sucursal = $sucursal;
        $this->p_pregunta = $pregunta;
        $this->p_servicio = $servicio;
        $this->servicio = null;

        /* objetos */
        $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);
        
        $vigenciaIni = $this->formulario->getCaVigenciaInicial();
        $vigenciaEnd = $this->formulario->getcaVigenciaFinal();
        
        $this->resultado = new ResultadoEncuesta();
        $this->control = new ControlEncuesta();
        //calcula el numero de formularios diligenciados
        $this->encuestas_diligenciadas = $this->control->contarEncuestas($idFormulario);
        /* objetos */

        if ($pregunta != '0') {
            $this->pregunta = Doctrine_Core::getTable('pregunta')->find($pregunta);
        } else {
            $this->pregunta = '0';
        }
        if ($servicio != '0') {
            $this->servicio = Doctrine_Core::getTable('opcion')->find($servicio);
        }

        //Listado de contactos que respondieron la encuesta
        $this->contactos = $this->formulario->getListaContactosRespuesta($sucursal);

        $con = Doctrine_Manager::getInstance()->connection();

        $this->encuestas_enviadas = $this->formulario->getNumEncuestasEnviadas($idFormulario,$vigenciaIni,$vigenciaEnd);
        $this->lista_encuestas_enviadas = $this->formulario->getListaEncuestasEnviadasPorSucursal($idFormulario,$vigenciaIni,$vigenciaEnd);
        $this->lista_empresas_enviadas = $this->formulario->getListaEmpresasEnviadasPorSucursal($idFormulario,null);

       //calcula el numero de contactos  únicos enviados via mail.
        $con2 = Doctrine_Manager::getInstance()->connection();
        $sql2 = "
        SELECT count(distinct ca_address) as unicas
        FROM public.tb_emails
        WHERE ca_tipo = 'Encuesta'
        AND ca_usuenvio = 'Administrador'
        AND ca_address != 'gmartinez@coltrans.com.co'
        AND ca_idcaso = " . $idFormulario . ";";
        $temp2 = $con2->execute($sql2);
        $this->encuestas_unicas_enviadas = $temp2->fetchAll();

        //calcula el consolidado.
        $this->c_encuestas = $this->formulario->getComentarios('NA', '0', '0', null);

        $detect = new Mobile_Detect();
        $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
        $this->device = $dispositivo;
        $this->setLayout('layout_home');
    }

    /**
     * Carga el consolidado de las encuestas.
     * @param sfWebRequest $request
     */
    public function executeConsolidado(sfWebRequest $request) {
        $id = $request->getParameter('ca_id');
        $idDecode = base64_decode($id);
        $idControl = intval($idDecode);
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


        $this->formulario = Doctrine_Core::getTable('formulario')->find($idControl);
        $this->sucursal = $this->formulario->decodeSucursal($this->sucursal);
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
        $this->c_encuestas = $this->formulario->getConsolidado($this->sucursal, $this->pregunta, $this->p_servicio, $this->servicio);


        $detect = new Mobile_Detect();
        $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
        $this->device = $dispositivo;
        $this->setLayout('layout_home');
    }

    /**
     * Carga la encuesta de servicio, luego de recibir como parÃ¡metro el listado de servicios previamente seleccionados por el usuario.
     * @param sfWebRequest $request
     */
    public function executeContactos(sfWebRequest $request) {
        $id = $request->getParameter('ca_id');
        $idDecode = base64_decode($id);
        $idFormulario = intval($idDecode);
        $this->sucursal = $request->getParameter('sid');
        $this->pregunta = $request->getParameter('pid');
        $this->servicio = $request->getParameter('seid');
        if ($this->servicio != '0') {
            $opcion = Doctrine_Core::getTable('opcion')->find(intval($this->servicio));
            $this->servicio = $opcion;
        }
        //if()

        $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);
        $this->sucursal = $this->formulario->decodeSucursal($this->sucursal);
        $this->contactos = $this->formulario->getListaContactosRespuesta($this->sucursal);

        $detect = new Mobile_Detect();
        $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
        $this->device = $dispositivo;
        $this->setLayout('layout_home');
    }
    
    public function executeListaEmpresasEnviadas(sfWebRequest $request) {
        $id = $request->getParameter('ca_id');
        $idDecode = base64_decode($id);
        $idFormulario = intval($idDecode);
        $this->sucursal = $request->getParameter('sid');
        
        
        $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);
        $this->sucursal = $this->formulario->decodeSucursal($this->sucursal);
        $this->empresas = $this->formulario->getListaEmpresasEnviadasPorSucursal($idFormulario, $this->sucursal);
        
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
        $this->user = $this->getUser();
        $id = $request->getParameter('ca_id');
        $idDecode = base64_decode($id);
        $idFormulario = intval($idDecode);

        //listado de preguntas
        $sq1 = "
            select p.ca_id,p.ca_texto 
            from encuestas.tb_pregunta p
            left join encuestas.tb_bloque b on  p.ca_idbloque = b.ca_id
            left join encuestas.tb_formulario f on  b.ca_idformulario=f.ca_id
            where f.ca_id = " . $idFormulario . "and p.ca_activo = '1' and b.ca_tipo != '1'
            order by p.ca_texto;    
        ";
        $con = Doctrine_Manager::getInstance()->connection();
        $temp1 = $con->execute($sq1);
        $this->preguntas = $temp1->fetchAll();

        $this->formulario = Doctrine_Core::getTable('formulario')->find($idFormulario);
        $idEmpresa = $this->formulario->getCaEmpresa();
        if ($idEmpresa == 2) {
            $this->nivel = $this->user->getNivelAcceso(formularioActions::RUTINA);
        } else if ($idEmpresa == 1) {
            $this->nivel = $this->user->getNivelAcceso(formularioActions::RUTINA);
        } else {
            $this->nivel = $this->user->getNivelAcceso(formularioActions::RUTINA);
        }
        $this->sucursales = $this->formulario->getListaSucursales();

        //listado de  servicios
        $sq3 = "
            select o.ca_id,o.ca_texto 
            from encuestas.tb_opcion o
            left join encuestas.tb_pregunta p on  o.ca_idpregunta = p.ca_id 
            left join encuestas.tb_bloque b on  p.ca_idbloque = b.ca_id
            left join encuestas.tb_formulario f on  b.ca_idformulario=f.ca_id
            where f.ca_id = " . $idFormulario . "and p.ca_activo = '1' and b.ca_tipo != '0'
            order by p.ca_texto;    
        ";
        $con3 = Doctrine_Manager::getInstance()->connection();
        $temp3 = $con3->execute($sq3);
        $this->servicios = $temp3->fetchAll();

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
                $email->setCaFrom("no-response@coltrans.com.co");
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
        $email->setCaBodyhtml($html . "Emails enviados:<br>" . $emails_Control);
        $email->setCaTipo("Encuesta");
        //$email->send();
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

        $nreg = 15;

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
        $emailFrom = "alramirez@coltrans.com.co";
        $emailCa = array("alramirez@coltrans.com.co", 
                        "alramirez@coltrans.com.co");
        
        foreach ($clientes as $cliente) {
            $conteo++;
            if ($cliente["ca_coltrans_std"] != "Activo")
                continue;
            try {
                $contacto = $cliente["ca_idcontacto"];
                $html = $this->getPartial('formulario/emailHtmlColtrans', array('contacto' => $contacto));
                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaFrom("no-response@coltrans.com.co");
                $email->setCaFromname("COLTRANS S.A.S.");
                $email->setCaSubject($asunto);
                $email->setCaAddress($cliente["ca_email"]);
                //$email->setCaAddress($emailCa[$conteo-1]);
                $email->setCaBodyhtml($html);
                $email->setCaBody($contacto);
                $email->setCaTipo("Encuesta");
                $email->setCaIdcaso(8);
                $email->save();
                $emails_Control.=$cliente["ca_compania"] . "->" . $cliente["ca_email"] . "<br>";
            } catch (Exception $e) {
                $emails_Control.="No se pudo enviar " . $cliente["ca_email"] . ": porque : " . $e->getMessage() . "<br>";
            }
            $this->html = $html;
            echo $cliente["ca_email"] . "<br>";
        }

        file_put_contents($filecontrol, $inicio + $conteo);
        
        $emailsControl.= "inicio=>".$inicio." nreg=>".$nreg." control.txt=>".file_get_contents($filecontrol)."<br/>";
        
        $email = new Email();
        $email->setCaUsuenvio("alramirez");
        $email->setCaFrom($emailFrom);
        $email->setCaFromname("COLTRANS LTDA");
        $email->setCaSubject("Emails enviados");
        $email->setCaAddress("alramirez@coltrans.com.co");
        $email->setCaCc("alramirez@coltrans.com.co");
        //$email->setCaCc("gmartinez@coltrans.com.co");
        $email->setCaBodyhtml("Emails enviados:<br>" . $emails_Control);
        $email->setCaTipo("Encuesta");
        //$email->send();
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
    public function executeEnvioEmailsContactoColmas() {
        $idcontacto='9667';        
        $filecontrol = $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "formulario" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "control.txt";

        if (file_exists($filecontrol)) {
            $inicio = file_get_contents($filecontrol);
        }
        if (!$inicio)
            $inicio = 0;
        $con = Doctrine_Manager::getInstance()->connection();

        $nreg = 1;

        $sql = "
            select c.ca_idcliente,c.ca_compania, con.ca_email,ca_coltrans_std,ca_colmas_std,con.ca_idcontacto
            from vi_clientes c
            inner join tb_concliente con on c.ca_idcliente=con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
            where (c.ca_coltrans_std = 'Activo'  or c.ca_colmas_std = 'Activo' ) and con.ca_idcontacto = '$idcontacto'
            order by 2,3 limit $nreg offset $inicio";

        $st = $con->execute($sql);
        $clientes = $st->fetchAll();
        //plantilla evalucion servicio
        $conteo = 0;
        $emails_Control = "";
        $asunto = "Dos minutos de su tiempo nos ayuda a prestarle un mejor servicio";
        $emailFrom = "gmartinez@coltrans.com.co";
        //para destinatarios de prueba
        //$emailCa = array("gmartinez@coltrans.com.co", "cazambrano@coltrans.com.co", "mpulido@coltrans.com.co", "pizquierdo@coltrans.com.co", "falopez@coltrans.com.co", "gmartinez@coltrans.co");
        foreach ($clientes as $cliente) {
            $conteo++;
            if ($cliente["ca_colmas_std"] != "Activo")
                continue;
            try {
                $contacto = $cliente["ca_idcontacto"];
                $html = $this->getPartial('formulario/emailHtmlColmas', array('contacto' => $contacto));
                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaFrom("no-response@colmas.com.co");
                $email->setCaFromname("COLMAS LTDA.");
                $email->setCaSubject($asunto);
                $email->setCaAddress($cliente["ca_email"]);
                //$email->setCaAddress('gmartinez@coltrans.com.co');
                //$email->setCaAddress($emailCa[$conteo-1]);
                $email->setCaBodyhtml($html);
                $email->setCaTipo("Encuesta");
                $email->setCaIdcaso(5);
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
        //$email->send();
        $email->save();
        
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
        $emailFrom = "alramirez@coltrans.com.co";
        //para destinatarios de prueba
        //$emailCa = array("alramirez@coltrans.com.co","alramirez@coltrans.com.co");

        foreach ($clientes as $cliente) {
            $conteo++;
            if ($cliente["ca_colmas_std"] != "Activo")
                continue;
            try {
                $contacto = $cliente["ca_idcontacto"];
                $html = $this->getPartial('formulario/emailHtmlColmas', array('contacto' => $contacto));
                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaFrom("no-response@colmas.com.co");
                $email->setCaFromname("COLMAS LTDA.");
                $email->setCaSubject($asunto);
                $email->setCaAddress($cliente["ca_email"]);
                $email->setCaBodyhtml($html);
                $email->setCaTipo("Encuesta");
                $email->setCaIdcaso(9);
                $email->save();
                $emails_Control.=$cliente["ca_compania"] . "->" . $cliente["ca_email"] . "<br>";
            } catch (Exception $e) {
                $emails_Control.="No se pudo enviar " . $cliente["ca_email"] . ": porque : " . $e->getMessage() . "<br>";
                print_r($e);
            }
            $this->html = $html;
            echo $cliente["ca_email"] . "<br>";
        }

        
        file_put_contents($filecontrol, $inicio + $conteo);
        
        $emailsControl.= "inicio=>".$inicio." nreg=>".$nreg." control.txt=>".file_get_contents($filecontrol)."<br/>";
        
        $email = new Email();
        $email->setCaUsuenvio("alramirez");
        $email->setCaFrom($emailFrom);
        $email->setCaFromname("COLMAS LTDA");
        $email->setCaSubject("Emails enviados");
        $email->setCaAddress("alramirez@coltrans.com.co");
        $email->setCaBodyhtml("Emails enviados:<br>" . $emails_Control);
        $email->setCaTipo("Encuesta");
        $email->setCaIdcaso(9);
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
    public function executeReenvioEmailsColmas() {

        $filecontrol = $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "formulario" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "control.txt";

        if (file_exists($filecontrol)) {
            $inicio = file_get_contents($filecontrol);
        }
        if (!$inicio)
            $inicio = 0;
        $con = Doctrine_Manager::getInstance()->connection();

        $nreg = 15;

        $sql = "
        select c.ca_idcliente,c.ca_compania, con.ca_email,ca_coltrans_std,ca_colmas_std,con.ca_idcontacto, cf.ca_id
        from vi_clientes c
        inner join tb_concliente con on c.ca_idcliente=con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
        full join encuestas.tb_control_encuesta cf on con.ca_idcontacto=cf.ca_id_contestador   
        where (c.ca_coltrans_std = 'Activo'  or c.ca_colmas_std = 'Activo' ) and (cf.ca_id is Null) 
        order by 2,3 limit $nreg offset $inicio";

        $st = $con->execute($sql);
        $clientes = $st->fetchAll();
        //plantilla evalucion servicio
        $conteo = 0;
        $emails_Control = "";
        $asunto = "Dos minutos de su tiempo nos ayuda a prestarle un mejor servicio";
        $emailFrom = "alramirez@coltrans.com.co";
        //para destinatarios de prueba
        //$emailCa = array("alramirez@coltrans.com.co","alramirez@coltrans.com.co");

        foreach ($clientes as $cliente) {
            $conteo++;
            if ($cliente["ca_colmas_std"] != "Activo")
                continue;
            try {
                $contacto = $cliente["ca_idcontacto"];
                $html = $this->getPartial('formulario/emailHtmlColmas', array('contacto' => $contacto));
                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaFrom("no-response@colmas.com.co");
                $email->setCaFromname("COLMAS LTDA.");
                $email->setCaSubject($asunto);
                $email->setCaAddress($cliente["ca_email"]);
                $email->setCaBodyhtml($html);
                $email->setCaTipo("Encuesta");
                $email->setCaIdcaso(9);
                $email->save();
                $emails_Control.=$cliente["ca_compania"] . "->" . $cliente["ca_email"] . "<br>";
            } catch (Exception $e) {
                $emails_Control.="No se pudo enviar " . $cliente["ca_email"] . ": porque : " . $e->getMessage() . "<br>";
                print_r($e);
            }
            $this->html = $html;
            echo $cliente["ca_email"] . "<br>";
        }

        
        file_put_contents($filecontrol, $inicio + $conteo);
        
        $emailsControl.= "inicio=>".$inicio." nreg=>".$nreg." control.txt=>".file_get_contents($filecontrol)."<br/>";
        
        $email = new Email();
        $email->setCaUsuenvio("alramirez");
        $email->setCaFrom($emailFrom);
        $email->setCaFromname("COLMAS LTDA");
        $email->setCaSubject("Emails enviados");
        $email->setCaAddress("alramirez@coltrans.com.co");
        $email->setCaBodyhtml("Emails enviados:<br>" . $emails_Control);
        $email->setCaTipo("Encuesta");
        $email->setCaIdcaso(9);
        $email->save();
        echo "enviados";
        exit;
        //echo $html;
        //}
        $this->setTemplate('envioEmailsPrueba');
    }
    
    public function executeReenvioEmailsColtrans() {

        $filecontrol = $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "formulario" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "control.txt";

        if (file_exists($filecontrol)) {
            $inicio = file_get_contents($filecontrol);
        }
        if (!$inicio)
            $inicio = 0;
        $con = Doctrine_Manager::getInstance()->connection();

        $nreg = 15;

        $sql = "
        select c.ca_idcliente,c.ca_compania, con.ca_email,ca_coltrans_std,ca_colmas_std,con.ca_idcontacto, cf.ca_id
        from vi_clientes c
        inner join tb_concliente con on c.ca_idcliente=con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
        full join encuestas.tb_control_encuesta cf on con.ca_idcontacto=cf.ca_id_contestador   
        where (c.ca_coltrans_std = 'Activo'  or c.ca_colmas_std = 'Activo' ) and (cf.ca_id is Null) and con.ca_email != 'lorenaz@yupi.com.co'
        order by 2,3 limit $nreg offset $inicio";

        $st = $con->execute($sql);
        $clientes = $st->fetchAll();
        //plantilla evalucion servicio
        $conteo = 0;
        $emails_Control = "";
        $asunto = "Dos minutos de su tiempo nos ayuda a prestarle un mejor servicio";
        $emailFrom = "alramirez@coltrans.com.co";
        $emailCa = array("alramirez@coltrans.com.co","alramirez@coltrans.com.co");
        
        foreach ($clientes as $cliente) {
            $conteo++;
            if ($cliente["ca_coltrans_std"] != "Activo")
                continue;
            try {
                $contacto = $cliente["ca_idcontacto"];
                $html = $this->getPartial('formulario/emailHtmlColtrans', array('contacto' => $contacto));
                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaFrom("no-response@coltrans.com.co");
                $email->setCaFromname("COLTRANS S.A.S.");
                $email->setCaSubject($asunto);
                $email->setCaAddress($cliente["ca_email"]);
                $email->setCaBodyhtml($html);
                $email->setCaBody($contacto);
                $email->setCaTipo("Encuesta");
                $email->setCaIdcaso(8);
                $email->save();
                $emails_Control.=$cliente["ca_compania"] . "->" . $cliente["ca_email"] . "<br>";
            } catch (Exception $e) {
                $emails_Control.="No se pudo enviar " . $cliente["ca_email"] . ": porque : " . $e->getMessage() . "<br>";
            }
            $this->html = $html;
            echo $cliente["ca_email"] . "<br>";
        }

        file_put_contents($filecontrol, $inicio + $conteo);
        
        $emailsControl.= "inicio=>".$inicio." nreg=>".$nreg." control.txt=>".file_get_contents($filecontrol)."<br/>";
        
        $email = new Email();
        $email->setCaUsuenvio("alramirez");
        $email->setCaFrom($emailFrom);
        $email->setCaFromname("COLTRANS LTDA");
        $email->setCaSubject("Emails enviados");
        $email->setCaAddress("alramirez@coltrans.com.co");
        $email->setCaCc("alramirez@coltrans.com.co");        
        $email->setCaBodyhtml("Emails enviados:<br>" . $emails_Control);
        $email->setCaTipo("Encuesta");        
        $email->save();
        echo "enviados";
        exit;        
        
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
        $idEmpresa = 1;
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
            
            foreach ($request->getPostParameters() as $param => $val) {
                //procesar los datos
            
                $parampreg = explode('_', $param);
                if(count($parampreg)>1){
                    $idpregunta = $parampreg[1];
                    $temp = $parampreg[2];
                }else{
                    $idpregunta = substr($param,3,2);
                    $temp = substr($param,10,1);
                }
                $servicio = $temp;
                
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

}

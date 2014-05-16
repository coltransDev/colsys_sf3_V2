<?php

/**
 * traficos actions.
 *
 * @package    colsys
 * @subpackage traficos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class traficosActions extends sfActions {

   const RUTINA_MARITIMO = "78";
   const RUTINA_AEREO = "79";
   const RUTINA_EXPO = "80";
   const RUTINA_OTM = "113";

   /*    * *********************************************************************************
    * Pagina inicial y consulta de reportes
    * ********************************************************************************** */

   /**
    * Muestra un formulario para seleccionar un rango de fechas y el cliente
    * @author: Andres Botero
    */
   public function executeIndex() {
      $this->modo = $this->getRequestParameter("modo");
      if (!$this->modo) {
         $this->forward("traficos", "seleccionModo");
      }

      if ($this->modo == "maritimo") {
         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_MARITIMO);

         $this->impoexpo = Constantes::IMPO;
         $this->transporte = Constantes::MARITIMO;
      }
      if ($this->modo == "aereo") {
         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_AEREO);
         $this->impoexpo = Constantes::IMPO;
         $this->transporte = Constantes::AEREO;
      }
      if ($this->modo == "expo") {
         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_EXPO);
         $this->impoexpo = Constantes::EXPO;
         $this->transporte = null;
      }
      if ($this->modo == "otm") {
         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_OTM);
         $this->impoexpo = Constantes::OTMDTA;
         $this->transporte = constantes::TERRESTRE;
      }
      if ($this->nivel == -1) {
         $this->forward404();
      }
   }

   /**
    * Permite seleccionar el modo de operacion del programa
    * @author: Andres Botero
    */
   public function executeSeleccionModo() {
      $this->nivelMaritimo = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_MARITIMO);
      $this->nivelAereo = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_AEREO);
      $this->nivelExpo = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_EXPO);
      $this->nivelOTM = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_OTM);
   }

   /*
    * permite ver el estado de cada  carga asi como las notificaciones avisos, status etc
    * @author: Andres Botero
    */

   public function executeListaStatus($request) {
      $response = sfContext::getInstance()->getResponse();
      $response->addJavaScript("swfupload/swfupload", 'last');
      $response->addJavaScript("swfupload/js/handlers", 'last');

      $this->idCliente = $this->getRequestParameter("idcliente");

      $this->modo = $this->getRequestParameter("modo");

      $consecutivo = $this->getRequestParameter("reporte");
      if ($this->getRequestParameter("reporte")) {
         if ($this->modo == "maritimo") {
            //echo $modo;
            $tiporep = " AND r.ca_tiporep IN (1,2,3) ";
            //print_r($tiporep);
         }
         $reporte = ReporteTable::retrieveByConsecutivo($consecutivo, $tiporep);
         $this->forward404Unless($reporte);

         if ($this->modo == "otm") {
            //$this->redirect( "traficos/listaStatus?modo=otm&reporte=".$reporte->getCaConsecutivo() );
         } else if ($reporte->getCaImpoexpo() == Constantes::IMPO && ($reporte->getCaTransporte() == Constantes::MARITIMO || $reporte->getCaTransporte() == Constantes::TERRESTRE) && $this->modo != "maritimo") {
            $this->redirect("traficos/listaStatus?modo=maritimo&reporte=" . $reporte->getCaConsecutivo());
         }

         if ($reporte->getCaImpoexpo() == Constantes::IMPO && $reporte->getCaTransporte() == Constantes::AEREO && $this->modo != "aereo") {
            $this->redirect("traficos/listaStatus?modo=aereo&reporte=" . $reporte->getCaConsecutivo());
         }
      }

      if ($this->modo == "maritimo") {

         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_MARITIMO);
      }
      if ($this->modo == "aereo") {

         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_AEREO);
      }
      if ($this->modo == "expo") {

         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_EXPO);
      }
      if ($this->modo == "otm") {

         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_OTM);
      }
      if ($this->nivel == -1) {
         $this->forward404();
      }

      if ($this->getRequestParameter("reporte")) {
         if (!$consecutivo) {
            $this->redirect("traficos/index?modo=" . $this->modo);
         }

         if ($this->modo == "otm") {
            $this->modo = "otm";
         } else if ($reporte->getCaImpoexpo() == Constantes::EXPO) {
            $this->modo = "expo";
         } else if ($reporte->getCaTransporte() == Constantes::MARITIMO) {
            $this->modo = "maritimo";
         } else if ($reporte->getCaTransporte() == Constantes::AEREO) {
            $this->modo = "aereo";
         }

         $this->cliente = $reporte->getCliente();
         $this->idreporte = $reporte->getCaIdreporte();
         $this->getRequest()->setParameter("idcliente", $this->cliente->getCaIdcliente()); // Para el submenu
      } else {
         if (!$this->idCliente) {
            $this->redirect("traficos/index?modo=" . $this->modo);
         }
         $this->cliente = Doctrine::getTable("Cliente")->find($this->idCliente);
         $this->forward404unless($this->cliente);
         $this->idreporte = null;
         $reporte = null;
      }

      $this->forward404unless($this->modo);

      switch ($this->modo) {
         case "aereo":
            $this->reportes = ReporteTable::getReportesActivos($this->cliente->getCaIdcliente(), Constantes::IMPO, Constantes::AEREO);
            break;
         case "maritimo":
            $this->reportes = ReporteTable::getReportesActivos($this->cliente->getCaIdcliente(), Constantes::IMPO, Constantes::MARITIMO);
            break;
         case "expo":
            $this->reportes = ReporteTable::getReportesActivos($this->cliente->getCaIdcliente(), Constantes::EXPO);
            break;
         case "otm":
            $this->reportes = ReporteTable::getReportesActivos($this->cliente->getCaIdcliente());
            break;
      }
      /*
       * En caso que no se encuentre entre los activos
       */
      if ($reporte) {
         $flag = false;
         foreach ($this->reportes as $rep) {
            if ($reporte->getCaIdreporte() == $rep->getCaIdreporte()) {
               $flag = true;
               break;
            }
         }
         if (!$flag) {
            $this->reportes[] = $reporte;
         }
      }
      //$this->getUser()->clearFiles();	
   }

   /*
    * Muestra la información de los reporte
    */

   public function executeInfoReporte($request) {

      $this->modo = $this->getRequestParameter("modo");
      if ($this->modo == "maritimo") {
         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_MARITIMO);
      }
      if ($this->modo == "aereo") {
         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_AEREO);
      }
      if ($this->modo == "expo") {
         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_EXPO);
      }
      if ($this->modo == "otm") {
         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_OTM);
      }
      if ($this->nivel == -1) {
         $this->forward404();
      }

      $this->forward404Unless($this->getRequestParameter("idreporte"));
      $this->reporte = Doctrine::getTable("Reporte")->find($this->getRequestParameter("idreporte"));
      $this->forward404Unless($this->reporte);
   }

   /*
    * Muestra un resumen de los status enviados al cliente
    */

   public function executeHistorialStatus($request) {
      $this->forward404Unless($this->getRequestParameter("idreporte"));
      $this->reporte = Doctrine::getTable("Reporte")->find($this->getRequestParameter("idreporte"));
      $this->forward404Unless($this->reporte);
   }

   /*    * *********************************************************************************
    * Creación de status
    * ********************************************************************************** */

   /*
    * Muestra un formario para agregar un nuevo status u aviso a un reporte
    * @author: Andres Botero
    */

   public function executeNuevoStatus($request) {
      //exit("EN Mantenimiento");      
      $this->modo = $request->getParameter("modo");
      $this->forward404unless($this->modo);      
      if ($this->modo == "maritimo") {
         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_MARITIMO);
      }
      if ($this->modo == "aereo") {
         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_AEREO);
      }
      if ($this->modo == "expo") {
         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_EXPO);
      }
      if ($this->modo == "otm") {
         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_OTM);
      }
      if ($this->nivel < 1) {
         $this->forward404();
      }

      $idreporte = $this->getRequestParameter("idreporte");
      $this->forward404Unless($idreporte);
      $reporte = Doctrine::getTable("Reporte")->find($idreporte);
      $this->forward404Unless($reporte);

      $this->modo = $this->getRequestParameter("modo");
      $this->forward404unless($this->modo);

      $this->tipo = $this->getRequestParameter("tipo");

      $this->user = $this->getUser();

      $this->getRequest()->setParameter("reporte", $reporte->getCaConsecutivo());

      if ($this->getRequestParameter("destinatarios")) {
         $this->destinatarios = $this->getRequestParameter("destinatarios");
      }

      /*
       * Configuracion de la forma
       */
      $this->form = new NuevoStatusForm();
      if ($reporte->getCaConfirmarClie()) {
         $this->form->setDestinatarios(explode(",", $reporte->getCaConfirmarClie()));
      }
      $cliente = $reporte->getCliente();
      $fijos = $reporte->getContacto('1');
      
      $contactos_reporte = $reporte->getContacto('3');
      $operativos_reporte = $reporte->getContacto('5');
      $this->form->setIdsucursal($this->getUser()->getIdsucursal());
      $this->form->setContactos($contactos_reporte);
      $this->form->setOperativos($operativos_reporte);
      $this->form->setDestinatariosFijos($fijos);
      //Etapas

      $q = Doctrine::getTable("TrackingEtapa")->createQuery("t");
      if ($this->modo == "otm") {
//            $q->addWhere("t.ca_impoexpo = ? OR t.ca_impoexpo IS NULL", Constantes::OTMDTA);
         $q->addWhere("t.ca_departamento = ? OR t.ca_impoexpo IS NULL", Constantes::OTMDTA1);
      } else if ($reporte->getCaImpoexpo() == Constantes::TRIANGULACION) {
         $q->addWhere("t.ca_impoexpo = ? OR t.ca_impoexpo IS NULL", Constantes::IMPO);
      } else {
         $q->addWhere("t.ca_impoexpo = ? OR t.ca_impoexpo IS NULL", $reporte->getCaImpoexpo());
      }

      if (($reporte->getCaImpoexpo() == Constantes::IMPO || $reporte->getCaImpoexpo() == Constantes::TRIANGULACION) && $this->modo != "otm") {
         if ($reporte->getCaTransporte() == Constantes::TERRESTRE) {
            $reporte->setCaTransporte(Constantes::MARITIMO);
         }
         $q->addWhere("t.ca_transporte = ? OR t.ca_transporte IS NULL", $reporte->getCaTransporte());
      } else if ($reporte->getCaImpoexpo() == Constantes::EXPO) {
         $q->addWhere("t.ca_transporte = ? OR t.ca_transporte IS NULL", $reporte->getCaTransporte());
      }

      if ($this->modo != "otm")
         $q->addWhere("t.ca_departamento = ? OR t.ca_departamento IS NULL", "Tráficos");
      $q->addWhere("t.ca_usueliminado is NULL");
      $q->addOrderBy("t.ca_orden");
      $this->form->setQueryIdEtapa($q);
      $this->etapas = $q->execute();

      $u = Doctrine::getTable("Usuario")->createQuery("u");
      $u->where("ca_idsucursal = ? and ca_activo=true", $this->getUser()->getSucursal());
      $u->orderBy("ca_nombre");
      $this->form->setQueryUsuario($u);
      //$this->usuarios = $q->execute();
      // Tipos de piezas			
      $this->form->setQueryPiezas(ParametroTable::retrieveQueryByCaso("CU047"));
      $this->form->setQueryPeso(ParametroTable::retrieveQueryByCaso("CU049"));
      $this->form->setQueryJornadas(ParametroTable::retrieveQueryByCaso("CU224"));

      if ($reporte->getCaTransporte() == Constantes::AEREO) {
         $this->form->setQueryVolumen(ParametroTable::retrieveQueryByCaso("CU058"));         
      } else {
         $this->form->setQueryVolumen(ParametroTable::retrieveQueryByCaso("CU050"));
      }
      
      $muelles = Doctrine_Query::create()
        ->select('*')
        ->from('InoDianDepositos id')
        ->where("id.ca_codigo IN (SELECT p.ca_identificacion FROM Parametro p where ca_casouso = 'CU230' and ca_valor = '". $reporte->getCaDestino()."')");
      
      $this->form->setQueryMuelles($muelles);  
      
      $q = Doctrine_Query::create()->from("Concepto c")->where("c.ca_modalidad = ? ", "FCL");
      
      $this->form->setQueryConceptos($q);

      //Busca los parametros definidos en CU059 
      //Campos personalizados por cliente			
      $parametros = ParametroTable::retrieveByCaso("CU059", null, null, $reporte->getCliente()->getCaIdgrupo());

      $this->form->setWidgetsClientes($parametros);

      $this->form->configure();
      /*
       * Fin de la configuración
       */

      $bindValues = array();

      if ($request->isMethod('post')) {
         $destinatarios = $this->form->getDestinatarios();
         for ($i = 0; $i < count($destinatarios); $i++) {
            if ($request->getParameter("destinatarios_" . $i)) {
               $bindValues["destinatarios_" . $i] = trim($request->getParameter("destinatarios_" . $i));
            }
         }

         $destinatariosFijos = $this->form->getDestinatariosFijos();
         for ($i = 0; $i < count($destinatariosFijos); $i++) {
            if ($request->getParameter("destinatariosfijos_" . $i)) {
               $bindValues["destinatariosfijos_" . $i] = trim($request->getParameter("destinatariosfijos_" . $i));
            }
         }

         for ($i = 0; $i < NuevoStatusForm::NUM_CC; $i++) {
            $bindValues["cc_" . $i] = trim($request->getParameter("cc_" . $i));
         }
         
         for ($i = 0; $i < NuevoStatusForm::NUM_CC; $i++) {
            $bindValues["cci_" . $i] = trim($request->getParameter("cci_" . $i));
         }

         if ($request->getParameter("empresa_remitente") > 0) {
            switch ($request->getParameter("empresa_remitente")) {
               case "1":
                  $bindValues["remitente"] = "syepes@coltrans.com.co";
                  break;
               case "2":
                  $bindValues["remitente"] = "syepes@colsolcargo.com";
                  break;
               case "3":
                  $bindValues["remitente"] = "syepes@colotm.com.co";
                  break;
            }
         } else {
            $bindValues["remitente"] = $request->getParameter("remitente");
         }

         $bindValues["impoexpo"] = $request->getParameter("impoexpo");
         $bindValues["transporte"] = $request->getParameter("transporte");

         $bindValues["idetapa"] = $request->getParameter("idetapa");
         $bindValues["fchsalida"] = $request->getParameter("fchsalida");
         $bindValues["horasalida"] = $request->getParameter("horasalida");
         $bindValues["fchllegada"] = $request->getParameter("fchllegada");
         $bindValues["jornada"] = $request->getParameter("jornada");
         $bindValues["fchcontinuacion"] = $request->getParameter("fchcontinuacion");
         $bindValues["piezas"] = $request->getParameter("piezas");
         $bindValues["un_piezas"] = $request->getParameter("un_piezas");
         $bindValues["peso"] = $request->getParameter("peso");
         $bindValues["un_peso"] = $request->getParameter("un_peso");
         $bindValues["volumen"] = $request->getParameter("volumen");
         $bindValues["un_volumen"] = $request->getParameter("un_volumen");
         $bindValues["doctransporte"] = $request->getParameter("doctransporte");
         $bindValues["idnave"] = $request->getParameter("idnave");

         $bindValues["asunto"] = $request->getParameter("asunto");
         $bindValues["introduccion"] = $request->getParameter("introduccion");
         $bindValues["mensaje"] = $request->getParameter("mensaje");
         $bindValues["mensaje_dirty"] = $request->getParameter("mensaje_dirty");
         $bindValues["notas"] = $request->getParameter("notas");

         $bindValues["mensaje_mask"] = $request->getParameter("mensaje_mask");

         $bindValues["datosbl"] = $request->getParameter("datosbl");
         $bindValues["inspeccion_fisica"] = $request->getParameter("inspeccion_fisica");


         $bindValues["fchrecibo"] = $request->getParameter("fchrecibo");
         $bindValues["horarecibo"] = $request->getParameter("horarecibo");

         $bindValues["observaciones_idg"] = $request->getParameter("observaciones_idg");

         for ($i = 0; $i < NuevoStatusForm::NUM_EQUIPOS; $i++) {
            $bindValues["equipos_tipo_" . $i] = $request->getParameter("equipos_tipo_" . $i);
            $bindValues["equipos_serial_" . $i] = $request->getParameter("equipos_serial_" . $i);
            $bindValues["equipos_cant_" . $i] = $request->getParameter("equipos_cant_" . $i);
         }

         $widgets = $this->form->getWidgetsClientes();

         foreach ($widgets as $name => $val) {
            $bindValues[$name] = $request->getParameter($name);
         }

         $bindValues["prog_seguimiento"] = $request->getParameter("prog_seguimiento");
         if ($request->getParameter("prog_seguimiento")) {
            $bindValues["fchseguimiento"] = $request->getParameter("fchseguimiento");
            $bindValues["txtseguimiento"] = $request->getParameter("txtseguimiento");
         }

         $bindValues["rep_incompleto"] = $request->getParameter("rep_incompleto");
         if ($request->getParameter("rep_incompleto")) {
            for ($i = 0; $i < count($contactos_reporte); $i++) {
               if ($request->getParameter("contactos_" . $i)) {
                  $bindValues["contactos_" . $i] = trim($request->getParameter("contactos_" . $i));
               }
            }
         }
         //$bindValues["txtincompleto"] = $request->getParameter("txtincompleto");

         $bindValues["rep_operativo"] = $request->getParameter("rep_operativo");
         if ($request->getParameter("rep_operativo")) {
            for ($i = 0; $i < count($operativos_reporte); $i++) {
               if ($request->getParameter("operativo_" . $i)) {
                  $bindValues["operativo_" . $i] = trim($request->getParameter("operativo_" . $i));
               }
            }
         }

         $this->form->bind($bindValues);
         if ($this->form->isValid()) {
            $this->executeGuardarStatus($request);
         }

         $contactos = $this->form->getContactos();
         /* for( $i=0; $i< count($contactos) ; $i++ ){

           } */
      } else {
         $conceptos = $reporte->getRepTarifa();
         $gastos = $reporte->getRecargos();
         $this->reporte_incompleto = "";
         if (count($conceptos) == 0) {
            $this->reporte_incompleto.="Faltan tarifas<br>";
         }
         if (count($gastos) == 0) {
            $this->reporte_incompleto.="Faltan recargos<br>";
         }
      }

      $this->ultStatus = $reporte->getUltimoStatus();

      $this->reporte = $reporte;

      /*
        Archivos del reporte
       */

      //Para recuperar los archivos seleccionados
      $attachments = $this->getRequestParameter("attachments");
      $this->att = array();
      if ($attachments) {
         foreach ($attachments as $key => $attachment) {
            $this->att[] = $attachment;
         }
      }

      //$att[]=$reporte->getDirectorioBase().base64_decode( $attachment );
      //Busca los archivos del reporte
      $this->files = $this->reporte->getFiles();

      $this->usuario = Doctrine::getTable("Usuario")->find($this->getuser()->getUserId());

      $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "traficos" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "textos.yml";
      $this->textos = sfYaml::load($config);
      
      $this->dep=$this->getUser()->getIddepartamento();
      
   }

   /*
    * Guarda el mensaje y actualiza el estatus
    * @author: Andres Botero
    */

   private function executeGuardarStatus($request) {
      $conn = Doctrine::getTable("Reporte")->getConnection();
      $conn->beginTransaction();

      try {
         $idreporte = $this->getRequestParameter("idreporte");
         $this->forward404Unless($idreporte);
         $reporte = Doctrine::getTable("Reporte")->find($idreporte);
         $this->forward404Unless($reporte);

         $this->modo = $this->getRequestParameter("modo");
         $this->forward404unless($this->modo);

         $user = $this->getUser();

         $status = new RepStatus();
         $status->setCaIdreporte($reporte->getCaIdreporte());
         $status->setCaFchstatus(date("Y-m-d H:i:s"));
         $status->setCaIntroduccion(Utils::replace($request->getParameter("introduccion")));


         if ($request->getParameter("notas")) {
            $status->setCaComentarios($request->getParameter("notas"));
         }
         $status->setCaIdetapa($request->getParameter("idetapa"));

         if ($request->getParameter("fchrecibo")) {
            $horaRecibo = $request->getParameter("horarecibo");
            if (!$horaRecibo['minute']) {
               $horaRecibo['minute'] = '00';
            }

            $horaRecibo['hour'] = str_pad($horaRecibo['hour'], 2, "0", STR_PAD_LEFT);
            $horaRecibo['minute'] = str_pad($horaRecibo['minute'], 2, "0", STR_PAD_LEFT);
            $horaRecibo = implode(":", $horaRecibo);
            $status->setCaFchrecibo(Utils::parseDate($request->getParameter("fchrecibo"), "Y-m-d") . " " . $horaRecibo);
         }

         if ($request->getParameter("observaciones_idg")) {
            $status->setCaObservacionesIdg($request->getParameter("observaciones_idg"));
         }

         $status->setCaFchenvio(date("Y-m-d H:i:s"));
         $status->setCaUsuenvio($user->getUserId());

         $piezas = $request->getParameter("piezas") . "|" . $request->getParameter("un_piezas");
         $peso = $request->getParameter("peso") . "|" . $request->getParameter("un_peso");
         $volumen = $request->getParameter("volumen") . "|" . $request->getParameter("un_volumen");

         if ($request->getParameter("piezas")) {
            $status->setCaPiezas($piezas);
         }

         if ($request->getParameter("peso")) {
            $status->setCaPeso($peso);
         }
         if ($request->getParameter("volumen")) {
            $status->setCaVolumen($volumen);
         }

         if ($request->getParameter("doctransporte")) {
            $status->setCaDoctransporte($request->getParameter("doctransporte"));
         }

         if ($request->getParameter("docmaster")) {
            $status->setCaDocmaster($request->getParameter("docmaster"));
         }

         if ($request->getParameter("idnave")) {
            $status->setCaIdnave($request->getParameter("idnave"));
         }

         if ($request->getParameter("fchsalida")) {
            $status->setCaFchsalida(Utils::parseDate($request->getParameter("fchsalida")));
         }
         if ($request->getParameter("fchllegada")) {
            $status->setCaFchllegada(Utils::parseDate($request->getParameter("fchllegada")));
         }
         if ($request->getParameter("jornada")) {
            $status->setProperty("jornada", $request->getParameter("jornada"));
         }
         if ($request->getParameter("idmuelle")) {
            $status->setProperty("muelle", $request->getParameter("idmuelle"));
         }
         if ($request->getParameter("fch_cargadisponible")) {
            $status->setProperty("cargaDisponible", $request->getParameter("fch_cargadisponible"));
         }
         

         $horaRecibo = $request->getParameter("horasalida");
         if ($horaRecibo['hour']) {
            $horasalida = $request->getParameter("horasalida");
            if (!$horasalida['minute']) {
               $horasalida['minute'] = '00';
            }
            $horasalida = implode(":", $horasalida);
            $horasalida = $horasalida . ":00";
            $status->setCaHorasalida($horasalida);
         }

         if ($request->getParameter("horallegada")) {
            $status->setCaHorallegada($request->getParameter("horallegada"));
         }

         if (trim($request->getParameter("fchcontinuacion")) && $reporte->getCaContinuacion() != "N/A") {
            $status->setCaFchcontinuacion(Utils::parseDate(trim($request->getParameter("fchcontinuacion"))));
         }

         //Para OTM
         if ($reporte->getCaTiporep() == 4) {
            $status->setProperty("manifiesto", $request->getParameter("manifiesto"));
            $repotm = $reporte->getRepOtm();


            $status->setProperty("valor_fob", $request->getParameter("valor_fob"));

            if ($repotm) {
                if($request->getParameter("manifiesto"))
                    $repotm->setCaManifiesto($request->getParameter("manifiesto"));
               if (is_numeric($request->getParameter("valor_fob")))
                  $repotm->setCaValorfob($request->getParameter("valor_fob"));

               $repotm->save($conn);
            }
         }

         //borra los equipos viejos
         $repequipos = $reporte->getRepEquipos();
         foreach ($repequipos as $equipo) {
            $equipo->delete($conn);
         }

         for ($i = 0; $i < NuevoStatusForm::NUM_EQUIPOS; $i++) {

            if ($request->getParameter("equipos_tipo_" . $i) && $request->getParameter("equipos_cant_" . $i)) {
               $repequipo = new RepEquipo();
               $repequipo->setCaIdreporte($reporte->getCaIdreporte());
               $repequipo->setCaIdconcepto($request->getParameter("equipos_tipo_" . $i));
               $repequipo->setCaCantidad($request->getParameter("equipos_cant_" . $i));
               if ($reporte->getCaImpoexpo() == Constantes::EXPO or $reporte->getCaImpoexpo() == Constantes::IMPO) {
                  $repequipo->setCaIdequipo($request->getParameter("equipos_serial_" . $i));
               }
               $repequipo->save($conn);
            }
         }


         $parametros = ParametroTable::retrieveByCaso("CU059", null, null, $reporte->getCliente()->getCaIdgrupo());


         foreach ($parametros as $parametro) {
            $valor = explode(":", $parametro->getCaValor());
            $name = $valor[0];
            $type = $valor[1];
            if ($request->getParameter($name)) {

               $reporte->setProperty($name, $request->getParameter($name));
            }
         }
         $reporte->stopBlaming();
         $reporte->save($conn);

         if ($reporte->getCaImpoexpo() == Constantes::EXPO && $reporte->getCaTiporep() != "3") {
            $repExpo = $reporte->getRepexpo();
            $repExpo->setCaIdreporte($reporte->getCaIdreporte());
            if ($request->getParameter("datosbl")) {
               $repExpo->setCaDatosbl($request->getParameter("datosbl"));
            }

            if ($request->getParameter("inspeccion_fisica")) {
               $repExpo->setCaInspeccionFisica(true);
            } else {
               $repExpo->setCaInspeccionFisica(false);
            }

            $repExpo->save($conn);
         }

         $address = $addressRnincompleto = $loginOperativos = array();

         foreach ($_POST as $key => $val) {
            if (substr($key, 0, 14) == "destinatarios_") {
               if ($request->getParameter($key)) {
                  $address[] = trim($request->getParameter($key));
               }
            }

            if (substr($key, 0, 19) == "destinatariosfijos_") {
               if ($request->getParameter($key)) {
                  $address[] = trim($request->getParameter($key));
               }
            }

            if (substr($key, 0, 10) == "contactos_") {
               if ($request->getParameter($key)) {
                  $addressRnincompleto[] = trim($request->getParameter($key));
               }
            }
            
            if (substr($key, 0, 11) == "operativos_") {
               if ($request->getParameter($key)) {
                  $loginOperativos[] = trim($request->getParameter($key));
               }
            }
         }
         
         // $status->setStatus($request->getParameter("mensaje"));
         $mensaje = $request->getParameter("mensaje");
         
         foreach ($loginOperativos as $loginOperativo){
             $user = Doctrine::getTable("Usuario")->find($loginOperativo);
             $mensaje.= "\n".$user->getCaNombre()." Tel.: ".$user->getSucursal()->getCaTelefono()." Ext.: ".$user->getCaExtension()." correo: ".$user->getCaEmail();
         }
         
         $status->setStatus($mensaje);

         $status->save($conn);

         /*
          * Actualuzación de la ETA en Referencia Ma?itima
          */
         if ( $status->getCaIdetapa() == "88888")  { // Si la etapa es Status (8888), entonces revisa si hay cambio de ETA y la actualiza en la referencia
             $numref = $reporte->getNumReferencia();
             if ($numref) {
                 $master = Doctrine::getTable("InoMaestraSea")->find($numref);
                 $this->forward404Unless($master);
                 if ($status->getCaFchllegada() && $master->getCaFcharribo() != $status->getCaFchllegada()){
                     $fchllegada = $status->getCaFchllegada();
                     $master->setCaFcharribo($fchllegada);
                     $master->save();
                 }
             }
         }
         
         $cc = array();
         for ($i = 0; $i < NuevoStatusForm::NUM_CC; $i++) {
            if ($request->getParameter("cc_" . $i)) {
               $cc[] = trim($request->getParameter("cc_" . $i));
            }
         }

         $copiasAut = ParametroTable::retrieveByCaso("CU104");

         foreach ($copiasAut as $c) {
            if ($c->getCaValor()) {
               $cc[] = trim($c->getCaValor());
            }
         }

         $user = $this->getUser();
         $attachments = $this->getRequestParameter("attachments");
         $att = array();
         if ($attachments) {
            foreach ($attachments as $attachment) {
               $att[] = $reporte->getDirectorioBase() . base64_decode($attachment);
            }
         }
//---////
         $options["from"] = $request->getParameter("remitente");

         $options["subject"] = $request->getParameter("asunto");

         //$address = array();
         $status->send($address, $cc, $att, $options, $conn);


         if ($request->getParameter("prog_seguimiento")) {

            $titulo = "Seguimiento RN" . $reporte->getCaConsecutivo() . " [" . $reporte->getCaModalidad() . " " . $reporte->getOrigen()->getCaCiudad() . "->" . $reporte->getDestino()->getCaCiudad() . "]";
            $texto = "";

            $tarea = new NotTarea();
            $tarea->setCaUrl("/traficos/listaStatus/modo/" . $this->modo . "/reporte/" . $reporte->getCaConsecutivo());
            $tarea->setCaIdlistatarea(3);
            $tarea->setCaFchvencimiento($request->getParameter("fchseguimiento") . " 23:59:59");
            $tarea->setCaFchvisible($request->getParameter("fchseguimiento") . " 00:00:00");
            $tarea->setCaTitulo($titulo);
            $tarea->setCaTexto($request->getParameter("txtseguimiento"));
            if ($request->getParameter("remitente")) {
               $tarea->setCaNotificar($request->getParameter("remitente"));
            }
            $tarea->save($conn);
            $loginsAsignaciones = array_merge(array($this->getUser()->getUserId()), $request->getParameter("emailusuario"));
            $tarea->setAsignaciones($loginsAsignaciones, $conn);

            /* $reporte->setCaIdseguimiento( $tarea->getCaIdtarea() );
              $reporte->stopBlaming();
              $reporte->save(); */

            $asignacion = Doctrine::getTable("RepAsignacion")->find(array($reporte->getCaIdreporte(), $tarea->getCaIdtarea()));
            if (!$asignacion) {
               $asignacion = new RepAsignacion();
            }
            $asignacion->setCaIdreporte($reporte->getCaIdreporte());
            $asignacion->setCaIdtarea($tarea->getCaIdtarea());
            $asignacion->save($conn);
         } else {
            //Se lee de la base de datos ya que la etapa es actualizada por los triggers
            /* //cambios para PH 2013-12-06
            $reporte = Doctrine::getTable("Reporte")->find($reporte->getCaIdreporte());
            if ($reporte->getCaIdetapa() == "IMETA" || $reporte->getCaIdetapa() == "99999") {//Quita todas las tareas
               $tareas = $reporte->getTareas(Reporte::IDLISTASEG);
               foreach ($tareas as $tarea) {
                  $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
                  $tarea->setCaUsuterminada($this->getUser()->getUserId());
                  $tarea->setCaObservaciones( $tarea->getCaObservaciones()." terminada:GuardarStatus" );
                  $tarea->save($conn);
               }
            }*/
         }
         //Tarea de envio de antecedentes
         //$valido=Utils::compararFechas(date("Y-m-d") , "2011-02-28");
         if (( $reporte->getCaIdetapa() == "IMETA" || $reporte->getCaIdetapa() == "IMCMT")) { //En cualquiera de estas dos etapas se crea la tarea según los usuarios.
            if ($reporte->getCaIdtareaAntecedente()) {
               $tarea = Doctrine::getTable("NotTarea")->find($reporte->getCaIdtareaAntecedente());
               if (!$tarea) {
                  $tarea = new NotTarea();
                  $tarea->setCaIdlistatarea(8);
               }
               //$this->forward404Unless($tarea );
            } else {
               $tarea = new NotTarea();
               $tarea->setCaIdlistatarea(8);
            }

            $titulo = "Antecedentes RN" . $reporte->getCaConsecutivo() . " [" . $reporte->getCaModalidad() . " " . $reporte->getOrigen()->getCaCiudad() . "->" . $reporte->getDestino()->getCaCiudad() . "]";
            $texto = "";

            $numdias = 2;
            $parametros = ParametroTable::retrieveByCaso("CU086", $reporte->getOrigen()->getCaIdtrafico());
            if (count($parametros) > 0) {
               $numdias = $parametros[0]->getCaValor2();
            }
            $tarea->setCaUrl("/antecedentes/buscarReferencia/reporte/" . $reporte->getCaConsecutivo());
            $tarea->setCaFchvisible(date("Y-m-d H:i:s"));

            $fechaEta = Utils::addDays($request->getParameter("fchsalida"), $numdias);

            $tarea->setCaFchvencimiento(date("Y-m-d H:i:s", strtotime(date($fechaEta . " " . date("H:i:s")))));

            $tarea->setCaTitulo($titulo);
            $texto = "Debe entregar los antecedentes dentro de los proximos $numdias dias"; //[TODO] Colocar un texto mas descriptivo
            $tarea->setCaTexto($texto);
            if ($request->getParameter("remitente")) {
               $tarea->setCaNotificar($request->getParameter("remitente"));
            }
            $tarea->save($conn);

            $loginsAsignaciones = array($this->getUser()->getUserId());
            $tarea->setAsignaciones($loginsAsignaciones, $conn);

            $reporte->setCaIdtareaAntecedente($tarea->getCaIdtarea());
            $reporte->stopBlaming();
            $reporte->save($conn);
         }


         /*
          * NOTIFICACION DE RN INCOMPLETO
          */


         if ($request->getParameter("rep_incompleto") && count($addressRnincompleto) > 0) {
            $email = new Email();
            $email->setCaUsuenvio($user->getUserId());
            $email->setCaTipo("RNIncompleto"); //Envío de Avisos
            $email->setCaIdcaso(null);


            $from = $request->getParameter("remitente");
            if ($from) {
               $email->setCaFrom($from);
            } else {
               $email->setCaFrom($user->getEmail());
            }

            $email->setCaFromname($user->getNombre());

            $email->setCaReplyto($user->getEmail());

            foreach ($addressRnincompleto as $recip) {
               $recip = str_replace(" ", "", $recip);
               if ($recip) {
                  $email->addTo($recip);
               }
            }

            $recips = explode(",", $request->getParameter("cci"));
            foreach ($recips as $recip) {
               $recip = str_replace(" ", "", $recip);
               if ($recip) {
                  $email->addCc($recip);
               }
            }

            $email->addCc($this->getUser()->getEmail());

            $subjectRN = "Reporte Incompleto RN" . $reporte->getCaConsecutivo() . " [" . $reporte->getCaModalidad() . " " . $reporte->getOrigen()->getCaCiudad() . "->" . $reporte->getDestino()->getCaCiudad() . "]";
            $email->setCaSubject($subjectRN);
            $email->setCaBody("Reporte Incompleto");

            $conceptos = $reporte->getRepTarifa();
            $gastos = $reporte->getRecargos();

            $html = "<div>
                        <table class='tableList alignLeft'>                        
                        <tr><td colspan=2 >El reporte de negocios No: " . $reporte->getCaConsecutivo() . " presento datos incompletos al momento de enviar el status </td></tr>
                        <tr><td colspan=2 >Por favor verifique : " . ((count($conceptos) == 0) ? "<br>1) Tarifas" : "") . ((count($gastos) == 0) ? "<br> 2) Recargos" : "") . "  </td></tr>
                        <tr><th>Cliente</th><td>" . ($reporte->getCliente()->getCaCompania()) . "</td></tr>
                        <tr><th>Transporte</th><td>" . ($reporte->getCaTransporte()) . "</td></tr>
                        <tr><th>Trayecto</th><td>" . ($reporte->getOrigen()->getCaCiudad()) . "-" . ($reporte->getDestino()->getCaCiudad()) . "</td></tr>
                        <tr><th>Proveedor</th><td>" . $reporte->getProveedoresStr() . "</td></tr>
                        <tr><td colspan='2'>" . $request->getParameter("txtincompleto") . "</td></tr>
                        </table></div>";

            $this->getRequest()->setParameter('tipo', "INSTRUCCIONES");
            $this->getRequest()->setParameter('mensaje', "");
            $this->getRequest()->setParameter('html', $html);
            $request->setParameter("format", "email");

            $mensaje = sfContext::getInstance()->getController()->getPresentationFor('reportesNeg', 'emailReporte');
            $email->setCaBodyhtml($mensaje);
            $email->save($conn);
         }

         $conn->commit();
      } catch (Exception $e) {
         $conn->rollBack();
         throw $e;
      }

      $this->redirect("traficos/listaStatus?modo=" . $this->modo . "&reporte=" . $reporte->getCaConsecutivo());
   }

   /*
    * Muestra un resumen de los status enviados al cliente
    */

   public function executeVerHistorialStatus($request) {
      $this->forward404Unless($this->getRequestParameter("idreporte"));
      $this->reporte = Doctrine::getTable("Reporte")->find($this->getRequestParameter("idreporte"));
      $this->forward404Unless($this->reporte);
   }
   
   public function executeUploadFile($request) {
      $this->forward404Unless($this->getRequestParameter("idreporte"));
      $this->reporte = Doctrine::getTable("Reporte")->find($this->getRequestParameter("idreporte"));
      $this->forward404Unless($this->reporte);
      $this->setLayout("email");
   }
   

   /*
    * Muestra un resumen de los status enviados al cliente
    */

   public function executeCerrarCaso($request) {
      $this->forward404Unless($this->getRequestParameter("idreporte"));
      $reporte = Doctrine::getTable("Reporte")->find($this->getRequestParameter("idreporte"));
      $this->forward404Unless($reporte);

      $this->modo = $this->getRequestParameter("modo");
      $this->forward404unless($this->modo);
      $reporte->setCaFchultstatus(date("Y-m-d H:i:s", time() - 86400 * 21));
      $reporte->setCaIdetapa("99999");
      $reporte->save();

      /*$tareas = $reporte->getTareas(Reporte::IDLISTASEG);
      foreach ($tareas as $tarea) {
         $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
         $tarea->setCaUsuterminada($this->getUser()->getUserId());
         $tarea->setCaObservaciones( $tarea->getCaObservaciones()." terminada:CerrarCaso" );
         $tarea->save();
      }*/
      $this->redirect("traficos/listaStatus?modo=" . $this->modo . "&reporte=" . $reporte->getCaConsecutivo());
   }

   /*    * *********************************************************************************
    * Generación de cuadro en excel y correo electronico
    * ********************************************************************************** */

   /*
    * Genera un cuadro de excel con la informacion de los reportes, tal como la ve el usuario
    * en verEstatusCarga
    * @author: Andres Botero
    */

   public function executeInformeTraficos() {

      $formato = $this->getRequestParameter("formato");
      switch ($formato) {
         /* case 2:
           $this->forward("traficos", "informeTraficosFormato2");
           break; */
         default:
            $this->forward("traficos", "informeTraficosFormato1");
            break;
      }
   }

   public function executeInformeTraficosFormato1() {

      $this->idCliente = $this->getRequestParameter("idcliente");

      $this->modo = $this->getRequestParameter("modo");
      $this->cliente = Doctrine::getTable("Cliente")->find($this->idCliente);

      $this->forward404Unless($this->cliente);
      $this->forward404unless($this->modo);

      switch ($this->modo) {
         case "aereo":
            $this->reportes = ReporteTable::getReportesActivos($this->cliente->getCaIdcliente(), Constantes::IMPO, Constantes::AEREO);
            break;
         case "maritimo":
            $this->reportes = ReporteTable::getReportesActivos($this->cliente->getCaIdcliente(), Constantes::IMPO, Constantes::MARITIMO);
            break;
         case "expo":
            $this->reportes = ReporteTable::getReportesActivos($this->cliente->getCaIdcliente(), Constantes::EXPO);
            break;
         case "otm":
            $this->reportes = ReporteTable::getReportesActivos($this->cliente->getCaIdcliente());
            break;
      }

      $this->parametros = ParametroTable::retrieveByCaso("CU059", null, null, $this->cliente->getCaIdgrupo());

      $this->filename = $this->getRequestParameter("filename");

      $this->setLayout("excel");
   }

   /*
    * Permite al usuario determinar que archivos se van a enviar por correo
    * @author: Andres Botero
    */

   public function executeCorreoTraficos() {


      $idCliente = $this->getRequestParameter("idcliente");
      $this->idCliente = $idCliente;
      $this->modo = $this->getRequestParameter("modo");

      $this->consecutivo = $this->getRequestParameter("reporte");
      $this->forward404unless($this->modo);
      $this->forward404unless($this->idCliente);


      $this->cliente = Doctrine::getTable("Cliente")->find($this->idCliente);

      switch ($this->modo) {
         case "aereo":
            $this->reportes = ReporteTable::getReportesActivos($this->cliente->getCaIdcliente(), Constantes::IMPO, Constantes::AEREO);
            break;
         case "maritimo":
            $this->reportes = ReporteTable::getReportesActivos($this->cliente->getCaIdcliente(), Constantes::IMPO, Constantes::MARITIMO);
            break;
         case "expo":
            $this->reportes = ReporteTable::getReportesActivos($this->cliente->getCaIdcliente(), Constantes::EXPO);
            break;
         case "otm":
            $this->reportes = ReporteTable::getReportesActivos($this->cliente->getCaIdcliente());
            break;
      }


      $this->user = $this->getUser();

      $this->usuario = Doctrine::getTable("Usuario")->find($this->user->getUserId());

      $this->emails = Doctrine::getTable("Email")
              ->createQuery("e")
              ->where("e.ca_tipo = ? AND e.ca_subject LIKE ?", array("Envío de cuadro", "%" . $this->cliente->getCaCompania() . "%"))
              ->addOrderBy("e.ca_fchenvio DESC")
              ->limit(20)
              ->execute();
   }

   /*
    * Permite enviar un correo con la informacion de traficos, añade el cuadro de excel generado
    * por executeInformeTraficos()
    * @author: Andres Botero
    */

   public function executeEnviarCorreoTraficos() {

      $idCliente = $this->getRequestParameter("idcliente");
      $this->idCliente = $idCliente;
      $this->modo = $this->getRequestParameter("modo");

      $this->consecutivo = $this->getRequestParameter("reporte");

      $cliente = Doctrine::getTable("Cliente")->find($idCliente);
      //$adjuntar_excel = $this->getRequestParameter("adjuntar_excel");

      $this->forward404unless($this->modo);
      $this->forward404unless($this->idCliente);


      $user = $this->getUser();
      //Guarda el correo y lo envia
      $email = new Email();

      $email->setCaUsuenvio($user->getUserId());
      $email->setCaTipo("Envío de cuadro"); //Envío de Avisos
      $email->setCaIdcaso(null);

      $from = $this->getRequestParameter("from");
      if ($from) {
         $email->setCaFrom($from);
      } else {
         $email->setCaFrom($user->getEmail());
      }
      $email->setCaFromname($user->getNombre());


      if ($this->getRequestParameter("readreceipt")) {
         $email->setCaReadreceipt(true);
      } else {
         $email->setCaReadreceipt(false);
      }

      $email->setCaReplyto($user->getEmail());

      $recips = explode(",", $this->getRequestParameter("destinatario"));

      foreach ($recips as $recip) {
         $recip = str_replace(" ", "", $recip);
         if ($recip) {
            $email->addTo($recip);
         }
      }

      $recips = explode(",", $this->getRequestParameter("cc"));
      foreach ($recips as $recip) {
         $recip = str_replace(" ", "", $recip);
         if ($recip) {
            $email->addCc($recip);
         }
      }

      if ($from) {
         $email->addCc($from);
      } else {
         $email->addCc($this->getUser()->getEmail());
      }

      $email->setCaSubject($this->getRequestParameter("asunto"));
      $email->setCaBody($this->getRequestParameter("mensaje"));
      $email->setCaBodyhtml(Utils::replace($this->getRequestParameter("mensaje")));
      $email->save();

      //if( $adjuntar_excel ){
      $this->getRequest()->setParameter("save", "true");
      $directory = $email->getDirectorio();


      if (!is_dir($directory)) {
         @mkdir($directory, 0777, true);
      }
      $fileName = "status" . str_replace(".", "", str_replace(" ", "_", $cliente->getCaCompania())) . ".xls";
      $fileName = str_replace("&", "AND", $fileName);

      //Genera el archivo de excel
      $this->getRequest()->setParameter('filename', $email->getDirectorio() . $fileName);
      sfContext::getInstance()->getController()->getPresentationFor('traficos', 'informeTraficosFormato1');
      $email->AddAttachment($email->getDirectorioBase() . $fileName);
      //}

      $attachments = $this->getRequestParameter("attachments");
      if ($attachments) {
         foreach ($attachments as $attachment) {
            $params = explode("_", $attachment);
            $idreporte = $params[0];
            $reporte = Doctrine::getTable("Reporte")->find($idreporte);
            $this->forward404Unless($reporte);

            $file = base64_decode($params[1]);
            $directory = $reporte->getDirectorioBase();

            $name = $directory . DIRECTORY_SEPARATOR . $file;
            $email->AddAttachment($name);
         }
      }
      $email->save();
      //$email->send();
   }

   /*    * *********************************************************************************
    * Plantillas para el correo de traficos 
    * ********************************************************************************** */

   /*
    * Plantillas para el correo de traficos 
    * @author: Andres Botero
    */

   public function executeVerStatus() {

      $this->status = Doctrine::getTable("RepStatus")->find($this->getRequestParameter("idstatus"));
      $this->forward404Unless($this->status);
      $this->reporte = $this->status->getReporte();

      $this->repotm = $this->reporte->getRepOtm();
      $this->firmaotm = false;
      $this->company = "";
      if ($this->repotm) {
         if ($this->getUser()->getSucursal() == "OBO" || $this->getUser()->getSucursal() == "OMD") {
            $this->firmaotm = true;
            $this->company = ($this->repotm->getCaLiberacion() != "") ? $this->repotm->getCaLiberacion() : (($this->reporte->getCaTiporep() != "4") ? "coltrans.com.co" : "consolcargo.com");
         }
      } else {
         if ($this->getUser()->getSucursal() == "OBO" || $this->getUser()->getSucursal() == "OMD")
            $this->company = "coltrans.com.co";
      }

      $this->setTemplate("emailDefaultStatus");

      $etapa = $this->status->getTrackingEtapa();

      if ($etapa) {
         if ($etapa->getCaTemplate()) {
            $this->setTemplate($etapa->getCaTemplate());
         }
      }

      $this->etapa = $etapa;

      $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "traficos" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "textos.yml";
      $this->textos = sfYaml::load($config);


      $this->user = Doctrine::getTable("Usuario")->find($this->status->getCaUsuenvio());

      $this->setLayout("email");
   }

   /*    * *********************************************************************************
    * Funciones para manejar los archivos del reporte 
    * ********************************************************************************** */

   /*
    * Ejecuta la accion de cargar el archivo en el iframe, en la forma CargarArchivoForm
    * author: Andres Botero
    */

   public function executeCargarArchivo($request) {

      //toma el valor del id del reporte, la referencia u otro objeto que se desee guardar
      // y determina el directorio

      $idreporte = $this->getRequestParameter("idreporte");
      if ($idreporte) {

         $reporte = Doctrine::getTable("Reporte")->find($idreporte);
         $this->forward404Unless($reporte);

         $directory = $reporte->getDirectorio();


         $this->idreporte = $idreporte;

         if (!is_dir($directory)) {
            mkdir($directory, 0777);
         }
         $namefile=$_FILES['file']['name'];
         //$namefile=$namefile.replace('/+/g', ' ');
         //$string = str_replace("%C2%91", "%27", $string);
         $destPath = $directory . DIRECTORY_SEPARATOR . urlencode($namefile);
         $destPath = str_replace("+", " ", $destPath);
         //mueve el archivo
         move_uploaded_file($_FILES['file']['tmp_name'], $destPath);

         $this->setLayout("none");
      }
   }

   /*
    * Ejecuta la accion de cargar el archivo en el iframe, en la forma CargarArchivoForm
    * author: Andres Botero
    */

   public function executeListaArchivosReporte($request) {
      $idreporte = $request->getParameter("idreporte");
      $this->forward404Unless($idreporte);
      $this->reporte = Doctrine::getTable("Reporte")->find($idreporte);
      $this->forward404Unless($this->reporte);

      $this->modo = $request->getParameter("modo");
      $this->forward404unless($this->modo);
      if ($this->modo == "maritimo") {
         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_MARITIMO);
      }
      if ($this->modo == "aereo") {
         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_AEREO);
      }
      if ($this->modo == "expo") {
         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_EXPO);
      }
      if ($this->modo == "otm") {
         $this->nivel = $this->getUser()->getNivelAcceso(traficosActions::RUTINA_OTM);
      }
      if ($this->nivel == -1) {
         $this->forward404();
      }
   }

   /*
    * Permite eliminar un archivo de acuerdo al indice
    * author: Andres Botero
    */

   public function executeEliminarArchivosReporte() {

      $idreporte = $this->getRequestParameter("idreporte");
      $this->forward404Unless($idreporte);
      $reporte = Doctrine::getTable("Reporte")->find($idreporte);
      $this->forward404Unless($reporte);
      $file = base64_decode($this->getRequestParameter("file"));

      $directory = $reporte->getDirectorio();

      $name = $directory . DIRECTORY_SEPARATOR . $file;
      unlink($name);
      return sfView::NONE;
   }

   /*
    * Permite ver el contenido de un archivo
    * author: Andres Botero
    */

   public function executeFileViewer() {
      $idreporte = $this->getRequestParameter("idreporte");
      $this->forward404Unless($idreporte);
      $reporte = Doctrine::getTable("Reporte")->find($idreporte);
      $this->forward404Unless($reporte);
      $file = base64_decode($this->getRequestParameter("file"));

      $directory = $reporte->getDirectorio();
      $this->name = $directory . DIRECTORY_SEPARATOR . $file;
      $this->setLayout("none");

      if (!file_exists($this->name) && !file_exists($this->name . ".gz")) {
         $this->forward404("No se encuentra el archivo especificado");
      }

      if (file_exists($this->name . ".gz")) {
         $this->name.=".gz";
      }
   }

   /*    * *********************************************************************************
    * Formulario de seguimientos
    * ********************************************************************************** */

   /*
    * Permite modificar un seguimiento
    * author: Andres Botero
    */

   public function executeFormSeguimiento($request) {
      $this->form = new SeguimientoForm();
      $reporte = $this->getRequestParameter("reporte");
      $this->forward404Unless($reporte);
      $reporte = ReporteTable::retrieveByConsecutivo($reporte);
      $this->forward404Unless($reporte);

      $this->modo = $this->getRequestParameter("modo");
      if (!$this->modo) {
         $this->forward("traficos", "seleccionModo");
      }

      if ($this->getRequestParameter("idtarea")) {
         $tarea = Doctrine::getTable("NotTarea")->find($this->getRequestParameter("idtarea"));
         $this->forward404Unless($tarea);
      } else {
         $tarea = new NotTarea();
      }

      if ($request->isMethod('post')) {
         //En caso que ya se haya creado una notificación se crea una nueva
         //tarea de lo contrario no se notifica
         $notificacion = $tarea->getNotificacion();
         if ($this->getRequestParameter("idtarea") && count($notificacion) > 0) {
            $tarea = new NotTarea();
         }
         $bindValues = array();
         $bindValues["fchseguimiento"] = $request->getParameter("fchseguimiento");
         $bindValues["txtseguimiento"] = $request->getParameter("txtseguimiento");

         $this->form->bind($bindValues);
         if ($this->form->isValid()) {
            $titulo = "Seguimiento RN" . $reporte->getCaConsecutivo() . " [" . $reporte->getCaModalidad() . " " . $reporte->getOrigen()->getCaCiudad() . "->" . $reporte->getDestino()->getCaCiudad() . "]";
            $texto = "";


            $tarea->setCaUrl("/traficos/listaStatus/modo/maritimo/reporte/" . $reporte->getCaConsecutivo());
            $tarea->setCaIdlistatarea(3);
            $tarea->setCaFchvencimiento($request->getParameter("fchseguimiento") . " 23:59:59");
            $tarea->setCaFchvisible($request->getParameter("fchseguimiento") . " 00:00:00");
            $tarea->setCaTitulo($titulo);
            $tarea->setCaTexto($request->getParameter("txtseguimiento"));
            $tarea->setCaNotificar($this->getUser()->getEmail());
            $tarea->save();
            $loginsAsignaciones = array($this->getUser()->getUserId());
            $tarea->setAsignaciones($loginsAsignaciones);

            $asignacion = Doctrine::getTable("RepAsignacion")->find(array($reporte->getCaIdreporte(), $tarea->getCaIdtarea()));
            if (!$asignacion) {
               $asignacion = new RepAsignacion();
            }
            $asignacion->setCaIdreporte($reporte->getCaIdreporte());
            $asignacion->setCaIdtarea($tarea->getCaIdtarea());
            $asignacion->save();

            $this->redirect("traficos/listaStatus?modo=" . $this->modo . "&reporte=" . $reporte->getCaConsecutivo());
         }
      }

      if ($this->getRequestParameter("idtarea")) {
         $this->emails = Doctrine::getTable("Email")
                 ->createQuery("e")
                 ->innerJoin("e.Notificacion n")
                 ->addWhere("n.ca_idtarea = ? ", $this->getRequestParameter("idtarea"))
                 ->execute();
      } else {
         $this->emails = array();
      }

      $this->reporte = $reporte;
      $this->tarea = $tarea;
   }

   /*
    * Permite modificar un seguimiento
    * author: Andres Botero
    */

   public function executeTerminarSeguimiento($request) {
      $this->form = new SeguimientoForm();
      $reporte = $request->getParameter("reporte");
      $this->forward404Unless($reporte);
      $reporte = ReporteTable::retrieveByConsecutivo($reporte);
      $this->forward404Unless($reporte);

      $tarea = Doctrine::getTable("NotTarea")->find($request->getParameter("idtarea"));
      $this->forward404Unless($tarea);


      $asignacion = Doctrine::getTable("RepAsignacion")
              ->createQuery("a")
              ->innerJoin("a.Reporte r")
              ->addWhere("a.ca_idtarea = ? ", $tarea->getCaIdtarea())
              ->addWhere("r.ca_consecutivo = ? ", $reporte->getCaConsecutivo())
              ->fetchOne();

      $this->forward404Unless($asignacion);

      $this->modo = $this->getRequestParameter("modo");
      if (!$this->modo) {
         $this->forward("traficos", "seleccionModo");
      }



      $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
      $tarea->setCaUsuterminada($this->getUser()->getUserId());
      $tarea->setCaObservaciones( $tarea->getCaObservaciones()." terminada:TerminarSeguimiento" );
      $tarea->save();
      if ($request->isXmlHttpRequest()) {
         $this->responseArray = array("success" => true);
         $this->setTemplate("responseTemplate");
      } else {
         $this->redirect("traficos/listaStatus?modo=" . $this->modo . "&reporte=" . $reporte->getCaConsecutivo());
      }
   }

   public function executeFormParametros($request) {

      $idreporte = $this->getRequestParameter("idreporte");
      $reporte = Doctrine::getTable("Reporte")->find($idreporte);

      $this->modo = $this->getRequestParameter("modo");
      $modo = $this->modo;



      $this->getRequest()->setParameter("reporte", $reporte->getCaConsecutivo());

      $this->form = new NuevoParametroForm();

      //Busca los parametros definidos en CU059 
      //Campos personalizados por cliente			
      $parametros = ParametroTable::retrieveByCaso("CU103", null, null, $reporte->getCliente()->getCaIdgrupo());
      $this->form->setWidgetsClientes($parametros);
      $this->form->configure();

      if ($request->isMethod('post')) {
         $bindValues = array();
         $widgets = $this->form->getWidgetsClientes();

         foreach ($widgets as $name => $val) {
            $bindValues[$name] = $request->getParameter($name);
         }

         $this->form->bind($bindValues);
         if ($this->form->isValid()) {
            $parametros = ParametroTable::retrieveByCaso("CU103", null, null, $reporte->getCliente()->getCaIdgrupo());


            foreach ($parametros as $parametro) {
               $valor = explode(":", $parametro->getCaValor());
               $name = $valor[0];
               $type = $valor[1];

               if ($request->getParameter($name)) {
                  $reporte->setProperty($name, $request->getParameter($name));
               }
            }

            $reporte->save();
            $this->redirect("traficos/listaStatus?modo=" . $modo . "&reporte=" . $reporte->getCaConsecutivo());
         }
      }
      $this->reporte = $reporte;
   }

}

?>

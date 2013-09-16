<?php

/**
 * confirmaciones actions.
 *
 * @package    colsys
 * @subpackage confirmaciones
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class confirmacionesActions extends sfActions {

   /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
   public function executeIndex(sfWebRequest $request) {
      $this->modo = $request->getParameter("modo");
   }

   /**
    * Resultados de la busqueda
    *
    * @param sfRequest $request A request object
    */
   public function executeBusqueda(sfWebRequest $request) {
      $criterio = $request->getParameter("criterio");
      $this->modo = $request->getParameter("modo");
      $cadena = $request->getParameter("cadena");

      if (!$cadena) {
         $this->redirect("confirmaciones/index?modo=" . $this->modo);
      }

      $q = Doctrine::getTable("InoMaestraSea")
              ->createQuery("m")
              ->select("m.*")
              ->innerJoin("m.InoClientesSea c")
              ->addOrderBy("m.ca_fchreferencia DESC")
              ->distinct()
              ->limit(200);


      switch ($criterio) {
         case "referencia":
            $cadena = str_replace("-", ".", $cadena);
            $q->addWhere("m.ca_referencia like ? ", "%" . $cadena . "%");
            break;
         case "reporte":

            $q->innerJoin("c.Reporte r");
            $q->addWhere("r.ca_consecutivo like ? ", "%" . $cadena . "%");
            break;
         case "blmaster":
            $q->addWhere("m.ca_mbls like ? ", "%" . $cadena . "%");
            break;
         case "motonave":
            $q->addWhere("m.ca_motonave like ? OR m.ca_mnllegada like ? ", array("%" . $cadena . "%", "%" . $cadena . "%"));
            break;
         case "hbl":
            $q->addWhere("c.ca_hbls like ?", "%" . $cadena . "%");
            break;
         case "cliente":
            $q->innerJoin("c.Cliente cl");
            $q->addWhere("UPPER(cl.ca_compania) like ? ", strtoupper($cadena) . "%");
            break;
         case "idcliente":
            $q->innerJoin("c.Cliente cl");
            $q->addWhere("cl.ca_idcliente = ? ", $cadena);
            break;
         case "contenedor":
            $q->innerJoin("c.InoMaestraSea mm");
            $q->innerJoin("mm.InoEquiposSea e");
            $q->addWhere("e.ca_idequipo like ? ", "%" . $cadena . "%");
            break;
      }

      if ($this->modo == "otm") {
         $q->addWhere("c.ca_continuacion != ? ", 'N/A');
      }


      // Defining initial variables
      $currentPage = $this->getRequestParameter('page', 1);
      $resultsPerPage = 30;

      // Creating pager object
      $this->pager = new Doctrine_Pager(
                      $q,
                      $currentPage,
                      $resultsPerPage
      );

      $this->referencias = $this->pager->execute();
      if ($this->pager->getResultsInPage() == 1 && $this->pager->getPage() == 1) {
         $referencias = $this->referencias;
         $this->redirect("confirmaciones/consulta?referencia=" . str_replace(".", "-", $referencias[0]->getCaReferencia()) . "&modo=" . $this->modo);
         //$this->redirect("ids/verIds?modo=".$this->modo."&id=".$ids[0]->getCaId());
      }
      $this->criterio = $criterio;
      $this->cadena = str_replace(".", "-", $cadena);
   }

   /**
    * Muestra  el formulario
    *
    * @param sfRequest $request A request object
    */
   public function executeConsulta(sfWebRequest $request) {

      $referenciaParam = str_replace("-", ".", $request->getParameter("referencia"));
      $this->referencia = Doctrine::getTable("InoMaestraSea")->find($referenciaParam);
      $this->forward404Unless($this->referencia);

      $this->origen = $this->referencia->getOrigen();
      $this->destino = $this->referencia->getDestino();
      $this->linea = $this->referencia->getIdsProveedor();
      $this->modo = $request->getParameter("modo");

      $this->coordinadores = array();
      
      $parametros = ParametroTable::retrieveByCaso("CU046");
      foreach ($parametros as $parametro) {
         $valor = explode("|", $parametro->getCaValor());
         $this->coordinadores[$valor[0]] = $valor[1];
      }

      $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "confirmaciones" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "textos.yml";
      $this->textos = sfYaml::load($config);

       /*
       * Etapas 
       */

      if ($this->modo == "otm") {
         $departamento = "OTM/DTA";
      } else {
         $departamento = "Marítimo";
      }

      $this->etapas = Doctrine::getTable("TrackingEtapa")
              ->createQuery("t")
              ->where("t.ca_departamento = ?", $departamento)
              ->addOrderBy("t.ca_orden")
              ->execute();

      if ($this->modo != "otm") {

         /*
          * Confirmaciones de llegada de puerto
          */
         $this->confirmaciones = Doctrine::getTable("Email")
                 ->createQuery("e")
                 ->select("e.*")
                 ->where("e.ca_subject like ?", '%' . $this->referencia->getCaReferencia() . '%')
                 ->addWhere("e.ca_tipo = ? OR e.ca_tipo = ? OR e.ca_tipo = ?" , array('Not.Llegada', 'Not.Desconsolidación', 'Not.Planilla'))
                 ->addOrderBy("e.ca_fchenvio DESC")
                 ->execute();
      }

      $q = Doctrine::getTable("InoClientesSea")
              ->createQuery("c")
              ->select("c.*")
              ->innerJoin("c.Cliente cl")
              ->where("c.ca_referencia = ?", $this->referencia->getCaReferencia())
              ->addOrderBy("cl.ca_compania");
      if ($this->modo == "otm") {
         $q->addWhere("c.ca_continuacion != ?", 'N/A');
      }
//      echo $q->getSqlQuery();
      $this->inoClientes = $q->execute();
   }

   /**
    * Crea el status
    *
    * @param sfRequest $request A request object
    */
   public function executeCrearStatus(sfWebRequest $request) {
      $referencia = Doctrine::getTable("InoMaestraSea")->find($request->getParameter("referencia"));
      $this->forward404Unless($referencia);
      $user = sfContext::getInstance()->getUser();
      $ca_referencia = $referencia->getCaReferencia();
      $modo = $request->getParameter("modo");
      $tipo_msg = $request->getParameter("tipo_msg");
      $oids = $request->getParameter("oid");
      
      $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "confirmaciones" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "textos.yml";
      $text = sfYaml::load($config);

      $inoClientes = array();

      if (( $modo == "conf" && $tipo_msg == "Conf") || ($modo == "puerto" && $tipo_msg == "Puerto")) {
         if ($request->getParameter("fchconfirmacion")) {
            $referencia->setCaFchconfirmacion(Utils::parseDate($request->getParameter("fchconfirmacion")));
         }
         $referencia->setCaHoraconfirmacion($request->getParameter("horaconfirmacion"));
         $referencia->setCaRegistroadu($request->getParameter("registroadu"));
         if ($request->getParameter("fchregistroadu")) {
            $referencia->setCaFchregistroadu(Utils::parseDate($request->getParameter("fchregistroadu")));
         }
         $referencia->setCaRegistrocap($request->getParameter("registrocap"));
         $referencia->setCaBandera($request->getParameter("bandera"));
         $referencia->setCaMensaje($request->getParameter("email_body"));
         if ($request->getParameter("fchdesconsolidacion")) {
            $referencia->setCaFchdesconsolidacion(Utils::parseDate($request->getParameter("fchdesconsolidacion")));
         }
         $referencia->setCaMnllegada($request->getParameter("mnllegada"));
         $referencia->setCaFchconfirmado(date("Y-m-d H:i:s"));
         $referencia->setCaUsuconfirmado($this->getUser()->getUserId());
         if ($request->getParameter("idmuelle"))
            $referencia->setCaMuelle($request->getParameter("idmuelle"));
         else
            $referencia->setCaMuelle(null);
         if ($request->getParameter("fchsyga")) {
            $referencia->setCaFchfinmuisca(Utils::parseDate($request->getParameter("fchsyga")));
         }
         $referencia->save();
      } else if ($modo == "puerto" && $tipo_msg == "Desc") {
         if ($request->getParameter("ca_fchvaciado") || $request->getParameter("ca_horavaciado")) {
            if ($request->getParameter("fchdesconsolidacion")) {
               $referencia->setCaFchdesconsolidacion(Utils::parseDate($request->getParameter("fchdesconsolidacion")));
            }
            $referencia->setCaFchvaciado(Utils::parseDate($request->getParameter("ca_fchvaciado")));
            $referencia->setCaHoravaciado($request->getParameter("ca_horavaciado"));
            if ($request->getParameter("fchsyga")) {
               $referencia->setCaFchfinmuisca(Utils::parseDate($request->getParameter("fchsyga")));
            }
            $referencia->save();
         }
      } else if ($modo == "puerto" && $tipo_msg == "Planilla") {
            $email_body_planilla = "Se reportan los siguientes números de planilla así:<br>";
            $email_body_planilla.="<table border='1'><tr><th>Cliente</th><th>HBL</th><th>Planilla Envio</th></tr>";

            foreach ($oids as $oid) {
                
                
                $destinatarios_planilla = array();

                $idcliente = $this->getRequestParameter("idcliente_" . $oid);
                $hbls = $this->getRequestParameter("hbls_" . $oid);

                $inoCliente = Doctrine::getTable("InoClientesSea")->find(array($referencia->getCaReferencia(), $idcliente, $hbls));
                
                $cliente = $inoCliente->getCliente();
                $reporte = $inoCliente->getReporte();

                $fijos = Doctrine::getTable("Contacto")
                        ->createQuery("c")
                        ->addWhere("c.ca_idcliente = ?", $cliente->getCaIdcliente() )
                        ->addWhere("ca_fijo = ?", true)
                        ->addWhere("ca_cargo != ?", 'Extrabajador')
                        ->execute();
                
                foreach($fijos as $fijo){
                    $destinatarios_planilla[]= $fijo->getCaEmail();
                }

                $inoCliente->setCaPlanilla($this->getRequestParameter("idplanilla_" . $oid));
                $inoCliente->save();
                
                if(trim($inoCliente->getCaContinuacion())!="N/A"  ){
                    continue;
                }

                if( !$inoCliente->getCliente()->getProperty("cuentaglobal") ){
                    
                    $ultimostatus = $reporte->getUltimoStatus();

                    $status = new RepStatus();

                    $status->setCaIdreporte($reporte->getCaIdreporte());
                    $status->setCaFchstatus(date("Y-m-d H:i:s"));

                    $status->setCaComentarios($this->getRequestParameter("notas"));
                    $status->setCaFchenvio(date("Y-m-d H:i:s"));
                    $status->setCaUsuenvio($this->getUser()->getUserId());

                    if( $request->getParameter("fchrecibido_".$oid) ){
                        $horaRecibo =  $request->getParameter("horarecibido_".$oid);
                        $status->setCaFchrecibo( Utils::parseDate($request->getParameter("fchrecibido_".$oid), "Y-m-d")." ".$horaRecibo );
                    }

                    if ($ultimostatus) {
                       $status->setCaPiezas($ultimostatus->getCaPiezas());
                       $status->setCaPeso($ultimostatus->getCaPeso());
                       $status->setCaVolumen($ultimostatus->getCaVolumen());
                       $status->setCaIdnave($ultimostatus->getCaIdnave());
                       $status->setCaFchsalida($ultimostatus->getCaFchsalida());
                       $status->setCaFchllegada($ultimostatus->getCaFchllegada());
                       $status->setCaFchcontinuacion($ultimostatus->getCaFchcontinuacion());
                       $status->setCaDoctransporte($ultimostatus->getCaDoctransporte());
                    }

                    if (substr($referencia->getCaReferencia(), 0, 1) == "7") {
                       $status->setCaPiezas($inoCliente->getCaNumpiezas());
                       $status->setCaPeso($inoCliente->getCaPeso());
                       $status->setCaVolumen($inoCliente->getCaVolumen());
                       $status->setCaFchsalida($referencia->getCaFchembarque());
                       $status->setCaFchllegada($referencia->getCaFcharribo());
                       $status->setCaIdnave($referencia->getCaMotonave());
                       $status->setCaDoctransporte($inoCliente->getCaHbls());
                    }
                    $status->setCaIdetapa("88888");

                    if ($referencia->getCaMnllegada()) {
                       $status->setCaIdnave($referencia->getCaMnllegada());
                    } else {
                       $status->setCaIdnave($referencia->getCaMotonave());
                    }
                    if ($request->getParameter("mod_fcharribo")) {
                       $referencia->setCaFcharribo($request->getParameter("fcharribo"));
                       $referencia->save();
                       $status->setCaFchllegada($request->getParameter("fcharribo"));
                    }

                    $status->setCaIntroduccion("Estimado cliente, <br/>");
                    $mensaje = $text['mensajePlanilla'];
                    $mensaje.= "<br />Planilla No: <b>".$inoCliente->getCaPlanilla()."</b>";

                    $status->setStatus($mensaje);
                    $status->save();
                    
                    if(!$inoCliente->getCliente()->getProperty("consolidar_comunicaciones"))
                        $status->send($destinatarios_planilla, array(), array(), null);
                }
                $email_body_planilla.= "<tr><td>".$cliente->getCaCompania()."</td><td>".$hbls."</td><td>Planilla # ".$inoCliente->getCaPlanilla()."</td></tr>";
            }
            $email_body_planilla.= "</table>";
      }
      /*
       * attachments 
       */
      if (is_uploaded_file($_FILES['attachment']['tmp_name'])) {
         $attachment = $_FILES['attachment'];
      } else {
         $attachment = null;
      }

      if ($modo == "puerto") {
         $sql = "SELECT distinct(ca_email) ca_email FROM control.tb_usuarios WHERE ca_login in (SELECT DISTINCT ca_usucreado as ca_usuario FROM tb_inoclientes_sea where ca_referencia = '" . $ca_referencia . "' 
                    UNION SELECT DISTINCT ca_usuactualizado as ca_usuario FROM tb_inoclientes_sea WHERE ca_referencia = '" . $ca_referencia . "'
                    UNION SELECT DISTINCT ca_usumuisca as ca_usuario FROM tb_inomaestra_sea WHERE ca_referencia = '" . $ca_referencia . "' 
                    UNION SELECT DISTINCT ca_usucreado as ca_usuario FROM tb_dianclientes WHERE ca_referencia = '" . $ca_referencia . "'
                    UNION SELECT DISTINCT ca_usuactualizado as ca_usuario FROM tb_dianclientes WHERE ca_referencia = '" . $ca_referencia . "'
                    UNION SELECT DISTINCT ca_usucreado as ca_usuario FROM tb_inomaestra_sea WHERE ca_referencia = '" . $ca_referencia . "'
                    UNION (Select distinct(ca_login) from control.tb_usuarios where ca_idsucursal in (
                            select ca_idsucursal from control.tb_usuarios where ca_login in (
                                select ca_vendedor from vi_clientes_reduc where ca_idcliente in (
                                    select ca_idcliente from tb_inoclientes_sea where ca_referencia='" . $ca_referencia . "' ) and ca_propiedades like 'cuentaglobal=true%')) 
                                        and ca_departamento = 'Cuentas Globales'))";
         

         $con = Doctrine_Manager::getInstance()->connection();
         $st = $con->execute($sql);
         $this->resul = $st->fetchAll();
         $destinatarios = array();         
         foreach ($this->resul as $r) {
            $destinatarios[] = $r["ca_email"];
         }


         if (is_uploaded_file($_FILES['attachment']['tmp_name'])) {
            $attachment = $_FILES['attachment'];
         } else {
            $attachment = null;
         }
         $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;
         $subdirectory = "Referencias/" . $ca_referencia . "/";

         if (!file_exists($directory . $subdirectory)) {
            @mkdir($directory . $subdirectory);
         }
         if ($attachment) {
            $file = $directory . $subdirectory . $attachment['name'];
            copy($attachment['tmp_name'], $file);
            $attachments[] = $subdirectory . $attachment['name'];
         }
         
         switch ($tipo_msg){
             case ("Puerto"):
                 $tipo = "Llegada";
                 $intro = "<b>CONFIRMACION DE LLEGADA</b><br /><br />";
                 $intro.= $request->getParameter("intro_body");
                 $body = $request->getParameter("email_body");
                 break;
             case ("Planilla"):
                 $tipo = "Planilla";
                 $intro = "<b>INFORMACION DE PLANILLA</b><br /><br />";
                 $intro.= $request->getParameter("intro_body_planilla");
                 $body = $email_body_planilla;
                 break;
             case ("Desc"):
                 $tipo = "Desconsolidación";
                 $intro = "<b>INFORMACION DE DESCONSOLIDACION</b><br /><br />";
                 $intro.= $request->getParameter("intro_body_desc");
                 $body = $request->getParameter("email_body");
                 break;
         }
         
         $email = new Email();
         $email->setCaUsuenvio($user->getUserId());
         $email->setCaTipo("Not." . $tipo);
         $email->setCaIdcaso(null);
         $email->setCaFrom($user->getEmail());
         $email->setCaFromname($user->getNombre());
         $email->setCaReplyto($user->getEmail());
         
         foreach ($destinatarios as $recip) {
            $recip = str_replace(" ", "", $recip);
            if ($recip) {
               $email->addTo($recip);
            }
         }

         $email->addCC($user->getEmail());
         if ($tipo_msg != "Puerto")
            $email->addCC("parteaga@coltrans.com.co");

         $asunto = "Notificación de " .$tipo. " desde el Puerto de " . $referencia->getDestino()->getCaCiudad() . " Ref.: " . $referencia->getCaReferencia();

         $email->setCaSubject(substr($asunto, 0, 250));

         if ($attachments) {
            $email->setCaAttachment(implode("|", $attachments));
         }

         sfContext::getInstance()->getRequest()->setParameter("referencia", $referencia->getCaReferencia(9));
         sfContext::getInstance()->getRequest()->setParameter("tipo", $tipo_msg);
         sfContext::getInstance()->getRequest()->setParameter("intro_body", $intro);
         sfContext::getInstance()->getRequest()->setParameter("email_body", $body);

         if ($tipo_msg == "Desc") {
            sfContext::getInstance()->getRequest()->setParameter("fchsyga", $request->getParameter("fchsyga"));
         }
         $modo = $request->getParameter("modo");
         $email->setCaBodyhtml(sfContext::getInstance()->getController()->getPresentationFor('confirmaciones', 'emailConfirmacion'));
         $email->save();
         $this->modo = $modo;
         $this->ca_referencia = $ca_referencia;
      } else {
         foreach ($oids as $oid) {
            $options = array();
            if (is_uploaded_file($_FILES['attachment_' . $oid]['tmp_name'])) {
               $attachment2 = $_FILES['attachment_' . $oid];
            } else {
               $attachment2 = null;
            }

            $idcliente = $this->getRequestParameter("idcliente_" . $oid);
            $hbls = $this->getRequestParameter("hbls_" . $oid);

            $inoCliente = Doctrine::getTable("InoClientesSea")->find(array($referencia->getCaReferencia(), $idcliente, $hbls));

            $reporte = $inoCliente->getReporte();
            $directory = $reporte->getDirectorio();

            if (!file_exists($directory)) {
               @mkdir($directory);
            }

            $attachments = array();

            if ($attachment) {
               $file = $directory . DIRECTORY_SEPARATOR . $attachment['name'];
               copy($attachment['tmp_name'], $file);
               $attachments[] = $reporte->getDirectorioBase() . $attachment['name'];
            }

            if ($attachment2) {
               $file = $directory . DIRECTORY_SEPARATOR . $attachment2['name'];
               copy($attachment2['tmp_name'], $file);
               $attachments[] = $reporte->getDirectorioBase() . $attachment2['name'];
            }

            $files = $this->getRequestParameter("files_" . $oid);
            foreach ($files as $archivo) {
               $name = $archivo;
               $attachments[] = $name;
            }

            $ultimostatus = $reporte->getUltimoStatus();

            $status = new RepStatus();

            $status->setCaIdreporte($reporte->getCaIdreporte());
            $status->setCaFchstatus(date("Y-m-d H:i:s"));

            $status->setCaComentarios($this->getRequestParameter("notas"));
            $status->setCaFchenvio(date("Y-m-d H:i:s"));
            $status->setCaUsuenvio($this->getUser()->getUserId());
            
            if( $request->getParameter("fchrecibido_".$oid) ){
                $horaRecibo =  $request->getParameter("horarecibido_".$oid);
                $status->setCaFchrecibo( Utils::parseDate($request->getParameter("fchrecibido_".$oid), "Y-m-d")." ".$horaRecibo );
            }

            if ($ultimostatus) {
               $status->setCaPiezas($ultimostatus->getCaPiezas());
               $status->setCaPeso($ultimostatus->getCaPeso());
               $status->setCaVolumen($ultimostatus->getCaVolumen());
               $status->setCaIdnave($ultimostatus->getCaIdnave());
               $status->setCaFchsalida($ultimostatus->getCaFchsalida());
               $status->setCaFchllegada($ultimostatus->getCaFchllegada());
               $status->setCaFchcontinuacion($ultimostatus->getCaFchcontinuacion());
               $status->setCaDoctransporte($ultimostatus->getCaDoctransporte());
            }

            if (substr($referencia->getCaReferencia(), 0, 1) == "7") {
               $status->setCaPiezas($inoCliente->getCaNumpiezas());
               $status->setCaPeso($inoCliente->getCaPeso());
               $status->setCaVolumen($inoCliente->getCaVolumen());
               $status->setCaFchsalida($referencia->getCaFchembarque());
               $status->setCaFchllegada($referencia->getCaFcharribo());
               $status->setCaIdnave($referencia->getCaMotonave());
               $status->setCaDoctransporte($inoCliente->getCaHbls());
            }

            switch ($modo) {
               case "conf":
               case "puerto":
                  switch ($tipo_msg) {
                     case "Conf":
                        $status->setCaIdetapa("IMCPD");
                        $status->setCaFchllegada($referencia->getCaFchconfirmacion());
                        break;
                     case "Desc":
                        $status->setCaIdetapa("IMDES");
                        //$options["subject"]="Notificación de Desconsolidación";
                        break;
                     default:
                        $status->setCaIdetapa("88888");
                        break;
                  }

                  if ($referencia->getCaMnllegada()) {
                     $status->setCaIdnave($referencia->getCaMnllegada());
                  } else {
                     $status->setCaIdnave($referencia->getCaMotonave());
                  }
                  if ($request->getParameter("mod_fcharribo")) {
                     $referencia->setCaFcharribo($request->getParameter("fcharribo"));
                     $referencia->save();
                     $status->setCaFchllegada($request->getParameter("fcharribo"));
                  }
                  break;
               case "otm":
                  $etapa = $this->getRequestParameter("tipo_" . $oid);

                  if ($etapa == "IMCOL" || $this->getRequestParameter("modfchllegada_" . $oid)) {
                     $status->setCaFchcontinuacion(Utils::parseDate($this->getRequestParameter("fchllegada_" . $oid)));
                  }
                  if ($etapa == "IMCOL") {
                     $idbodega = $this->getRequestParameter("bodega_" . $oid);
                     $status->setProperty("idbodega", $idbodega);
                  }
                  if ($etapa == "99999") {
                     $fchplanilla = $this->getRequestParameter("fchplanilla_" . $oid);
                     $status->setProperty("fchplanilla", Utils::parseDate($fchplanilla));
                  }
                  $status->setCaIdetapa($etapa);
                  break;
               default:
                  $status->setCaIdetapa("88888");
                  break;
            }

            if ($tipo_msg == "Conf" || $tipo_msg == "Puerto") {
               $status->setCaIntroduccion($this->getRequestParameter("intro_body"));
               $status->setStatus($this->getRequestParameter("mensaje_" . $oid));
            } else if ($tipo_msg == "Cont") {
               $options["subject"]="División de Contenedores";
               $status->setCaIntroduccion($this->getRequestParameter("status_intro_cont"));
               $mensaje = $this->getRequestParameter("status_body_cont") . "\n";
               if ($this->getRequestParameter("mensaje_" . $oid)) {
                  $mensaje .= "\n" . $this->getRequestParameter("mensaje_" . $oid);
               }
               $status->setStatus($mensaje);
            } else {
               $status->setCaIntroduccion($this->getRequestParameter("status_body_intro"));
               $mensaje = $this->getRequestParameter("status_body");
               if($tipo_msg=="not_planilla")
               $mensaje.= "<br />Planilla No: <b>".$inoCliente->getCaPlanilla()."</b>";
               if ($this->getRequestParameter("mensaje_" . $oid)) {
                  $mensaje .= "\n" . $this->getRequestParameter("mensaje_" . $oid);
               }
               $status->setStatus($mensaje);
            }

            $destinatarios = array();

            $checkbox = $request->getParameter("em_" . $oid);
            if ($checkbox) {
               foreach ($checkbox as $check) {
                  $destinatarios[] = $request->getParameter("ar_" . $oid . "_" . $check);
               }
            }

            $status->save();
            //if()
            //$options["subject"]="Notificacion de Desconsolidacion";
            $status->send($destinatarios, array(), $attachments, $options);

            $this->status = $status;
            $this->modo = $modo;
            $this->referencia = $referencia;
         }
      }
   }

   public function executeEmailConfirmacion($request) {
      $this->referencia = Doctrine::getTable("InoMaestraSea")->find($request->getParameter("referencia"));
      $this->forward404Unless($this->referencia);
      $this->usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());

      $this->tipo = $request->getParameter("tipo");
      $this->intro_body = $request->getParameter("intro_body");
      $this->email_body = $request->getParameter("email_body");
      $this->fchsyga = $request->getParameter("fchsyga");
      //echo $this->usuario->getCaLogin();
      $this->setLayout("email");
   }

}

?>

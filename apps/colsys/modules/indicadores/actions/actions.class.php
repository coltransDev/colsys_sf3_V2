<?php

/**
 * indicadores actions.
 *
 * @package    symfony
 * @subpackage indicadores
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class indicadoresActions extends sfActions{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)  {
    $this->forward('default', 'module');
  }
  
  public function executeIndexExt5()  {
      
        $con = Doctrine_Manager::getInstance()->connection();
        
        $this->annos = array();
        for ($i = (date("Y")); $i >= (date("Y") - 1); $i--) {
            $this->annos[] = array("id"=> intval($i), "name"=>$i);
        }

        $this->meses = array();
        $this->meses[] = array("id" => "01", "name" => "Enero");
        $this->meses[] = array("id" => "02", "name" => "Febrero");
        $this->meses[] = array("id" => "03", "name" => "Marzo");
        $this->meses[] = array("id" => "04", "name" => "Abril");
        $this->meses[] = array("id" => "05", "name" => "Mayo");
        $this->meses[] = array("id" => "06", "name" => "Junio");
        $this->meses[] = array("id" => "07", "name" => "Julio");
        $this->meses[] = array("id" => "08", "name" => "Agosto");
        $this->meses[] = array("id" => "09", "name" => "Septiembre");
        $this->meses[] = array("id" => "10", "name" => "Octubre");
        $this->meses[] = array("id" => "11", "name" => "Noviembre");
        $this->meses[] = array("id" => "12", "name" => "Diciembre");
        
        $sql = "select DISTINCT ca_nombre as ca_sucursal from control.tb_sucursales where ca_idempresa = 2 and ca_idsucursal != '999' order by ca_sucursal";
        $rs = $con->execute($sql);
        $sucursales_rs = $rs->fetchAll();
        $this->sucursales = array();
        foreach ($sucursales_rs as $sucursal) {
            $this->sucursales[] = array("id"=>utf8_encode($sucursal["ca_sucursal"]), "name"=>utf8_encode($sucursal["ca_sucursal"]));
        }
        
        $traficos_rs = Doctrine::getTable("Trafico")
           ->createQuery("t")
           ->addWhere("t.ca_idtrafico != '99-999'")
           ->addOrderBy("t.ca_nombre")
           ->execute();
        
        $this->traficos = array();
        foreach ($traficos_rs as $trafico) {
             $this->traficos[] = array("idpais" => $trafico->getCaIdtrafico(), "name" => utf8_encode($trafico->getCaNombre()));
        }
    }
    
    public function executeDatosTreeIndicadores(sfWebRequest $request){        

       $indicadores = Doctrine::getTable("Idg")
                ->createQuery("i")
                ->innerJoin("i.IdgProcesos p")
//                ->where("i.ca_activo = true")
                ->orderBy("p.ca_nombre ASC, i.ca_nombre ASC")
                ->execute();
        
       $lastProc = true;
       
        foreach($indicadores as $indicador){
            
            if ($lastProc) {                
                $proceso = utf8_encode($indicador->getIdgProcesos()->getCaNombre());                
                $idproceso = $indicador->getCaIdproceso();
                $lastProc = false;                                
            }
            
            if ($proceso != utf8_encode($indicador->getIdgProcesos()->getCaNombre())) {                  
                $data[] = array("text" => $proceso, "idproceso"=>$idproceso,"expanded" => false, "checked"=>false, "children" => $childrens);
                $proceso = utf8_encode($indicador->getIdgProcesos()->getCaNombre());
                $idproceso = $indicador->getCaIdproceso();                
                $childrens = array();                
            }
            
            $cls = $indicador->getCaActivo()==false?'x-hidden-node':"";
            
            $childrens[] = array(
                "text" => utf8_encode($indicador->getCaNombre()),
                "title" => $indicador->getTitle([]),                                
                "leaf" => true,
                "checked" => false,
                "id" => $indicador->getCaIdg(), 
                "cls" => $cls,
                "iconCls" => 'x-fa fa-home',
                "idg" => $indicador->getCaIdg(),
                "datos" => json_decode(utf8_encode($indicador->getCaDatos()),1)
            );            
        }
                
        $this->responseArray = array("text" => "Riesgos", "expanded" => true, "children" => $data);        
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosIdg(sfWebRequest $request){
        
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        
        $tipo = $request->getParameter("tipo");
        $anos = $request->getParameter("ano");
        $meses = $request->getParameter("mes");
        
        $sucursales = utf8_decode($request->getParameter("sucursal"));
        $origenes = $request->getParameter("origen");
        $cliente = $request->getParameter("cliente");
        $usuario = $request->getParameter("usuario");
        $indice = $request->getParameter("indice");
        
        $idg = $request->getParameter("idg");        
        $data = $datosGrafica = $opts = $exclusiones = array();        
        
        $arrayAno = explode(",", $anos);
        $arrayMes = explode(",", $meses);
        $arraySucursal = explode(",", $sucursales);
        $arrayOrigen = explode(",", $origenes);        
        
        $indicador = Doctrine::getTable("Idg")->find($idg);
        $proceso = $indicador->getIdgProcesos();
        $datos = json_decode(utf8_encode($indicador->getCaDatos()),1);
        
        $options["idg"] = $idg;
        $options["sigla"] = $indicador->getCaSigla();
        $options["impoexpo"] = $indicador->getCaImpoexpo();
        $options["transporte"] = $indicador->getCaTransporte();
                
        switch($idg){
            case 7: //Oportunidad en confirmaci�n de llegada de la carga al cliente            
                $q = Doctrine::getTable("InoViIndicadores")                
                    ->createQuery("v")
                    ->select("*")                
                    ->andWhereIn("ca_ano", $arrayAno)
                    ->andWhereIn("ca_mes", $arrayMes)
                    ->andWhere("ca_idindicador = ?", intval($idg))
                    ->andWhere("ca_idetapa = ?", 'IMCPD')
                    ->orderBy("ca_mes ASC")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                break;
            case 35: //Oportunidad en el env�o de las comunicaciones mar�timas
                $q = Doctrine::getTable("InoViIndicadores")                
                    ->createQuery("v")
                    ->select("*")                
                    ->andWhereIn("ca_ano", $arrayAno)
                    ->andWhereIn("ca_mes", $arrayMes)
                    ->andWhere("ca_idindicador = ?", intval($idg))
                    ->andWhere("ca_idetapa IN (?,?,?)", array('88888','IMPLA','IMDES'))
                    ->orderBy("ca_mes ASC")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);                
                break;
            case 12://Oportunidad en la Facturaci�n Mar�tima
            case 13://Oportunidad en la Facturaci�n A�rea
                $q = Doctrine::getTable("InoViIndicadoresFact")                
                    ->createQuery("v")
                    ->select("*")                
                    ->andWhereIn("ca_ano", $arrayAno)
                    ->andWhereIn("ca_mes", $arrayMes)
                    ->orderBy("ca_mes")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                
                if($indicador->getCaTransporte() == Constantes::MARITIMO){
                    $q->andWhere("ca_exclusion IS DISTINCT FROM 'Contenedores'");
                    $q->andWhere("ca_exclusion IS DISTINCT FROM 'OTM/DTA'");
                }
                
                $exclusiones = array(
                    "Facturaci�n al Agente", 
                    "Facturacion al Agente", 
                    "Reemplazo Factura", 
                    "Cierre contable clientes", 
                    "Referencia Particulares", 
                    "Acuerdos Comerciales", 
                    "Costos de origen no informados a tiempo",
                    "Contenedores",
                    "OTM/DTA",
                    "Cierre contable de Clientes",
                    "Transici�n SAP",
                    "Falla en sistema de facturaci�n",
                    "Requisitos Cliente",
                    "Cliente no creado en sistema contable"
                );
                $filtroUsuario = "ca_usuenvio";
                break;                
        }
        
        if($indicador->getCaImpoexpo()){
            $q->addWhere("ca_impoexpo = ?", $indicador->getCaImpoexpo());
        }
        
        if($indicador->getCaTransporte()){
            $q->addWhere("ca_transporte = ?", $indicador->getCaTransporte());
        }
        
        if($arraySucursal[0] != null){
            $opts["sucursal"] = utf8_encode($sucursales);
            $q->andWhereIn("ca_sucursal", $arraySucursal);
        }
        
        if($arrayOrigen[0] != null){
            $opts["origen"] = $origenes;
            $q->andWhereIn("ca_idtraorigen", $arrayOrigen);
        }
        
        if($cliente){
            $opts["cliente"] = cliente;
            $q->addWhere("ca_idcliente_fac = '".$cliente."'");
        }
        
        if($usuario){
            $opts["usuario"] = $usuario;
            $q->addWhere("ca_usuenvio = ?", $usuario);
        }
        
//        $q->limit(10);
        
        $debug = $q->getSqlQuery();        
//        echo $debug;
//        exit();
        $registros = $q->execute();
        $contador = 0;

        if(count($registros)>0){            
            foreach($registros as $d){
                
                $color = "";
                
                $us = $d["v_ca_usuario"]?$d["v_ca_usuario"]:"Administrador";
                $userreg = Doctrine::getTable("Usuario")->find($us);                
                $options["idsucursal"] =  $userreg->getCaIdsucursal();
                
                $ano = $d["v_ca_ano"];
                $mes = $d["v_ca_mes"];
                $compania = utf8_encode($d["v_ca_compania"]);
                $observaciones = $d["v_ca_observaciones"];
                
                switch($idg){
                    case 7://Oportunidad en confirmaci�n de llegada de la carga al cliente (Mar�timo)
//                        $options["fchini"] = $d["v_ca_fchconfirmacion"];
//                        $options["fchend"] = $d["v_ca"];                         
                        $options["fecha"] = Utils::parseDate($d["v_ca_fchconfirmacion"], 'Y-m-d');
//                        $diff = $indicador->getDifference($options);
//                        $idgval = $diff["val"];
//                        $idgest = $diff["estado"];
//                        $dataGrafica[] = array($d["v_ca_usuenvio_lleg"] => array($mes => $idgval));
//                        break;
                        $compania = utf8_encode($d["v_ca_compania"]);                                               
                        $idgval = $d["v_ca_idgval"];  
                        $idgest = $d["v_ca_idgest"];                        

                        $dataGrafica[] = array($d["v_ca_usuenvio"] => array($mes => $idgval));
                        break;
                    case 35://Oportunidad en el env�o de las comunicaciones mar�timas
                        //$ano = $d["v_ca_ano_seg"];
                        //$mes = $d["v_ca_mes_seg"];
                        //$options["fchini"] = $d["v_ca_fchrecibo_seg"];
                        //$options["fchend"] = $d["v_ca_fchenvio_seg"];   
                        $options["fecha"] = Utils::parseDate($d["v_ca_fchenvio"], 'Y-m-d');
                        //$diff = $indicador->getDifference($options);
                        $idgval = $d["v_ca_idgval"];  
                        $idgest = $d["v_ca_idgest"];    
                        $dataGrafica[] = array($d["v_ca_usuenvio_seg"] => array($mes => TimeUtils::hourTosec($idgval)));
                        break;
                    case 12://Oportunidad en la Facturaci�n Mar�tima
                    case 13://Oportunidad en la Facturaci�n A�rea
                        $compania = utf8_encode($d["v_ca_compania_fact"]);                       
                        $options["fecha"] = Utils::parseDate($d["v_ca_fchfactura"], 'Y-m-d');
                        $idgval = $d["v_ca_idgval"];  
                        $idgest = $d["v_ca_idgest"];                        

                        if ($d["v_ca_transporte"] == 'Mar�timo') {
//                            $dataGrafica[] = array($d["v_ca_usuenvio"] => array(substr($d["v_ca_fchllegada"], 5, 2) => $idgval));
                            $dataGrafica[] = array($d["v_ca_usuenvio"] => array($mes => $idgval));
                        } elseif ($d["v_ca_transporte"] == 'A�reo') {
                            $dataGrafica[] = array($d["v_ca_usuenvio"] => array($mes => $idgval));
                        }
                        break;
                }
                
                if (in_array(trim($d["v_ca_exclusion"]), $exclusiones)) {
                    $array_avg[] = 0;   
                }else{
                    if($datos["tipodiff"]=="d"){
                        $array_avg[] = $idgval?$idgval:48; 
                    }else{
                        list($hor, $min, $seg) = sscanf($idgval, "%d:%d:%d");
                        $array_avg[] = mktime($hor, $min, $sec, 0, 0, 0);
                    }
                }
                
                if (in_array(trim($d["v_ca_exclusion"]), $exclusiones)) {
                    $idgval = null;
                    $color = "purple";
                    $array_null[] = $idgval;
                } else if ($idgest == 0) {
                    $color = "pink";
                    $array_pnc[] = $idgval;                    
                    $pnc[$mes][] = $idgval;
                } else{
                    $avg[$mes][] = $idgval;
                }

                $row = array();
                $row["ca_consecutivo"] = $d["v_ca_consecutivo"];
                $row["ca_version"] = $d["v_ca_version"];
                $row["ca_ano"] = $ano;
                $row["ca_mes"] = $mes;
                $row["ca_idreporte"] = $d["v_ca_idreporte"];
                $row["ca_sucursal"] = utf8_encode($d["v_ca_sucursal"]);
                $row["ca_traorigen"] = utf8_encode($d["v_ca_traorigen"]);
                $row["ca_ciudestino"] = utf8_encode($d["v_ca_ciudestino"]);
                $row["ca_transporte"] = utf8_encode($d["v_ca_transporte"]);
                $row["ca_modalidad"] = utf8_encode($d["v_ca_modalidad"]);
                $row["ca_idcliente"] = $d["v_ca_idcliente_fac"];
                $row["ca_doctransporte"] = $d["v_ca_doctransporte"];
                $row["ca_compania"] = $compania;
                $row["ca_idmaster"] = $d["v_ca_idmaster"];
                $row["ca_referencia"] = $d["v_ca_referencia"];
                $row["ca_continuacion"] = $d["v_ca_continuacion"];
                $row["ca_fchllegada"] = $d["v_ca_fchllegada"];
                $row["ca_fchconfirmacion"] = $d["v_ca_fchconfirmacion"];
                $row["ca_fchfactura"] = $d["v_ca_fchfactura"];
                $row["ca_fchrecibo"] = $d["v_ca_fchrecibo"];
                $row["ca_fchenvio"] = $d["v_ca_fchenvio"];
                $row["ca_usuenvio"] = $d["v_ca_usuenvio"];
//                $row["ca_fchconf_lleg"] = $d["v_ca_fchconf_lleg"];
//                $row["ca_usuenvio_lleg"] = $d["v_ca_usuenvio_lleg"];
//                $row["ca_obs_lleg"] = $d["v_ca_obs_lleg"];
                
//                $row["ca_fchrecibo_seg"] = $d["v_ca_fchrecibo_seg"];
//                $row["ca_fchenvio_seg"] = $d["v_ca_fchenvio_seg"];
//                $row["ca_usuenvio_seg"] = $d["v_ca_usuenvio_seg"];
//                $row["ca_observaciones_seg"] = utf8_encode($d["v_ca_observaciones_seg"]);
                $row["ca_exclusion"] = $d["v_ca_observaciones"]?(utf8_encode($d["v_ca_exclusion"])?utf8_encode($d["v_ca_exclusion"]).'. '.$d["v_ca_observaciones"]:$d["v_ca_observaciones"]):utf8_encode($d["v_ca_exclusion"]);
                $row["ca_idetapa"] = utf8_encode($d["v_ca_idetapa"]);
                $row["ca_etapa"] = utf8_encode($d["v_ca_etapa"]);
                $row["ca_idgval"] = $idgval;
                $row["ca_color"] = $color;                
                $data[] = $row; 
                $contador++;
            }
//            echo "<pre>";print_r($options);echo "</pre>";
//            exit();
            $infoIdg = IdgTable::getNuevoIndicador($options);            
            
            /*Resumen de datos*/
            if ($datos["tipodiff"] == "d") {
                $promedio_general = TimeUtils::array_avg($array_avg);
            } else if ($array_avg < "24:00:00") {
                $promedio_general = date($datos["tipodiff"], TimeUtils::array_avg($array_avg));
            } else {
                list($dia, $hor, $min, $seg) = sscanf(date("d, H:i:s", TimeUtils::array_avg($array_avg)), "%d, %d:%d:%d");
                if ($dia == 30) {
                    $promedio_general = date("H:i:s", TimeUtils::array_avg($array_avg));
                } else {
                    $tmp = $dia * 24 + $hor;
                    $dia = floor($tmp / 9);
                    $min+= ($tmp % 9) * 60;
                    $time_aju = mktime(0, $min, $seg, 1, $dia, 2000);
                    $promedio_general = date("d, H:i:s", $time_aju);
                }
            }

            $summary = array();
            $summary["pnc_count"] = count($array_pnc);        
            $summary["pnc_perc"] = count($array_avg)>0?Utils::formatNumber(round(count($array_pnc) / count($array_avg) * 100, 2), 2):0;
            $summary["avg_count"] = count($array_avg)-count($array_null);
            $summary["avg_perc"] = $promedio_general;
            $summary["exc_count"] = count($array_null);
            $summary["exc_perc"] = Utils::formatNumber(round(count($array_null) / $contador * 100, 2), 2); 
            $summary["lim_sup"] = $datos["tipodiff"] == "d" ? $infoIdg->getCaLim1(): TimeUtils::secToHour(floor($infoIdg->getCaLim1()*60*60));
            $summary["sucursal"] = utf8_encode($sucursales);
            
            /*Datos para graficar*/
            if ($dataGrafica) {
                $dataJson = array();
                $datosGr = $serieX = $usuarios = $fields = $dataIdg = array();

                foreach ($dataGrafica as $key => $gridUsuario) {
                    foreach ($gridUsuario as $usuario => $gridMes) {                        
                        foreach ($gridMes as $mes => $valor) {
                            if (!in_array($mes, $serieX))
                                $serieX[] = $mes;
                            if (!in_array($usuario, $usuarios))
                                $usuarios[] = $usuario;

                            $datosGr[$mes][$usuario]["valor"] += $valor;
                            $datosGr[$mes][$usuario]["total"] ++;
                            $datosProm[$usuario]["valor"] += $valor;
                            $datosProm[$usuario]["total"] ++;
                        }
                    }
                }

                sort($serieX);

                $fieldsGr[] = array("name"=>"mes");

                foreach($datosGr as $mes => $gridMes){                
                    foreach($usuarios as $key => $user){
                        if($datos["tipodiff"]=="d"){                        
                            $datosIdg[$mes][$user] = $gridMes[$user]["valor"]?round($gridMes[$user]["valor"]/$gridMes[$user]["total"],2):0;
                        }else{
                            $promedio_segundos =  $gridMes[$user]["valor"]?round($gridMes[$user]["valor"]/$gridMes[$user]["total"],0):0;
                            $hora = TimeUtils::secToHour($promedio_segundos);
                            $time = new DateTime('1/10/2007 '.$hora);
                            $datosIdg[$mes][$user] = $time->getTimestamp()*1000;
                        }
                        $fieldsGr[] = array("name"=>$user, "type"=>"string");
                    }
                }

                foreach($datosIdg as $mes => $gridUsuario){
                    $gridUsuario["mes"] = $mes;
                    $gridUsuario["porcentaje"] = count($avg[$mes])==0?0:100-Utils::formatNumber(round(count($pnc[$mes]) / (count($avg[$mes])?count($avg[$mes]):1) * 100, 2), 2);
                    $dataIdg[] = $gridUsuario;
                }

                /*# Casos por usuario*/

                foreach($datosProm as $usuario => $gridItems){                
                    $datosUsuario[] = array("usuario"=>$usuario, "data"=>$gridItems["total"]);                    
                }
                $info["tipodiff"] = $datos["tipodiff"];
                $info["title"] = str_replace("<br/>","\n",$indicador->getTitle($opts));
                $info["subtitle"] = $indicador->getSubTitle($ano, $meses);

                $datosGrafica = array("fieldsGr"=>$fieldsGr,"datosIdg"=>$dataIdg, "datosUsuario"=>$datosUsuario, "usuarios"=>$usuarios, "infoGrafica"=>$info);
                $summary["datosGrafica"] = $datosGrafica;

            }
            

            $this->getRequest()->setParameter('ano',$anos);
            $this->getRequest()->setParameter('mes',$meses);
            $this->getRequest()->setParameter('idg',$idg);
            $this->getRequest()->setParameter('sucursal',$sucursales);
            $this->getRequest()->setParameter('origen',$origenes);
            $this->getRequest()->setParameter('cliente',$cliente);
            $this->getRequest()->setParameter('usuario',$opts["usuario"]);
            $this->html = sfContext::getInstance()->getController()->getPresentationFor( 'indicadores', 'verHtmlResumen');

            session_start();
            $pdf = array("registros"=>$data, "summary"=>$summary, "html"=>$this->html, "datos"=>$datos);                
            if($_SESSION[$indice])
                unset($_SESSION[$indice]);
            $_SESSION[$indice] = $pdf;


            $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "debug"=> utf8_encode($debug), "summaryRoot"=>$summary);
            $this->setTemplate("responseTemplate");
            
        }else{
            $this->responseArray = array("success" => false, "errorInfo" => "La consulta no tiene resultados!", "debug"=>$debug);
            $this->setTemplate("responseTemplate");
        }
    }
    
    public function executeVerHtmlResumen(sfWebRequest $request){
        
        $this->idg = $request->getParameter("idg");            
        $this->ano = $request->getParameter("ano");
        $this->mes = $request->getParameter("mes");
        $this->sucursal = $request->getParameter("sucursal");
        $this->origen = $request->getParameter("origen");
        $this->cliente = $request->getParameter("cliente");
        $this->usuario = $request->getParameter("usuario");
        $this->setLayout("none");
    }

    public function executeGenerarPdf(sfWebRequest $request){
        
        $user = $this->getUser();
        $ano = $request->getParameter("ano");
        $mes = $request->getParameter("mes");
        $indice = $request->getParameter("indice");
        $filenameTemp = "Archivo temporal Indicador ".$indice.'.pdf';        
        
        session_start();        
        $pdf = $_SESSION[$indice];
        
        $registros = $pdf["registros"];
        $summary = $pdf["summary"];
        $html = $pdf["html"];
        $datos = $pdf["datos"];
        
        $headers = $datos["headers"];    
        $keysdata = array();
        
        $arreglo = ["pnc_count","pnc_perc","avg_count","avg_perc", "exc_count","exc_perc", "lim_sup","sucursal"];
        foreach($arreglo as $key => $val){
            $html = str_replace("{".$val."}", $summary[$val], $html);
        }
        
        $datos = array();
        $datos["sucursal"] = $summary["sucursal"];
        $datos["origen"] = $request->getParameter("origen");
        $datos["cliente"] = $request->getParameter("cliente");
        $datos["usuario"] = $request->getParameter("usuario");
        $indicador = Doctrine::getTable("Idg")->find($request->getParameter("idg"));        
        
        $titulo = str_replace("<br/>","\n",$indicador->getTitle($datos))."\n".$indicador->getSubTitle($ano,$mes);        
        
        ob_start();
        ini_set('display_errors', 'on');
        $pdf = new TCPDF("L", PDF_UNIT, "LEGAL", true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($user->getUserId());
        $pdf->SetTitle('INFORME INDICADORES DE GESTION');
        $pdf->SetSubject('INFORME INDICADORES DE GESTION');
        $pdf->SetKeywords('informe, indicadores, pdf');
        
        $logo = 'logo_coltrans.jpg';
        // set default header data
        $pdf->SetHeaderData($logo, 60, '', 'www.coltrans.com.co');
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // ------------------TITULO---------------------------------------
        // set font
        $pdf->SetFont('helvetica', 'B', 20);
        // add a page
        $pdf->AddPage();
        $pdf->Write(0, $titulo, '', 0, 'C', true, 0, false, false, 0);

        // ------------------CONTENIDO---------------------------------------
        // set font
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetFillColor(192, 192, 192);        
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('', 'B');
        
        //$w = array(18, 7, 8, 7, 20, 20, 20, 18, 10, 50, 26, 10, 20, 20, 32, 18,30,8);
            
        foreach($headers as $key => $val){            
            $keysdata[] = $val["dataIndex"];
            $w[] = $val["wpdf"];
            $pdf->Cell($w[$key], 7, $val["header"], 1, 0, 'C', 1);
        }
        $pdf->Ln();        
        $pdf->SetFont('');
         
//        echo "<pre>";print_r($registros);echo "</pre>";
         
        foreach($registros as $key => $val){
            switch($val["ca_color"]){
                case "pink":
                    $pdf->SetFillColor(255, 192, 203);
                    break;
                case "purple":
                    $pdf->SetFillColor(128, 0, 128);
                    break;
                default :
                    $pdf->SetFillColor(255, 255, 255);
                    break;
            }            
            
            $i=0;
            foreach($val as $dataIndex => $valor){                
                if(in_array($dataIndex, $keysdata)){                    
//                    echo $val[$dataIndex]."<br>";
                    $pdf->Cell($w[$i], 6, $val[$dataIndex], 'LR', 0, 'L', 1);
                    $i++;
                }
            }
            $pdf->Ln();;
            
        }
        $pdf->Cell(array_sum($w), 0, '', 'T');
        $pdf->Ln();;
        $pdf->writeHTML(utf8_encode($html), true, false, true, false, '');
        
        $pdf->Output('Informe de Indicadores.pdf', 'I');

        // Save a temp file in directory TMP of digital File
        $directorio = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR .'tmp';                
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }
        $pdf->Output( $directorio.DIRECTORY_SEPARATOR. $filenameTemp, 'F');
        ob_end_flush();        
        exit;

        // -----------------------------------------------------------------------------
        $this->setTemplate("responseTemplate");
        
    }
    
    public function executeGuardarRepositorio(sfWebRequest $request){
        
        $ano = $request->getParameter("ano");
        $mes = $request->getParameter("mes");
        
        $conn = Doctrine::getTable("IdgArchivo")->getConnection();
        $conn->beginTransaction();
        
        try{
            $indicador = Doctrine::getTable("Idg")->find($request->getParameter("idg"));
            $proceso = $indicador->getIdgProcesos();  
            $indice = $request->getParameter("indice");
            $filenameTemp = "Archivo temporal Indicador ".$indice.'.pdf';

            $folder = $proceso->getDirectorioBase().DIRECTORY_SEPARATOR."idg".DIRECTORY_SEPARATOR.$indicador->getCaIdg();
            $directorio = $proceso->getDirectorio().DIRECTORY_SEPARATOR."idg".DIRECTORY_SEPARATOR.$indicador->getCaIdg();

            if (!is_dir($directorio)) {
                mkdir($directorio, 0777, true);
            }else{
                chmod($directorio, 0777);
            }

            $filename = $request->getParameter("idsucursal")."-".utf8_decode($request->getParameter("filename"));

            $archivo = new IdgArchivo();
            $archivo->setCaIdg($request->getParameter("idg"));
            $archivo->setCaAno($ano);
            $archivo->setCaPeriodo($indicador->getIdgPeriodo($mes));
            $archivo->setCaIdsucursal($request->getParameter("idsucursal"));
            $archivo->setCaNombre($filename);
            $archivo->setCaPath($folder . DIRECTORY_SEPARATOR . $filename.".pdf");
            $archivo->setCaObservaciones(utf8_decode($request->getParameter("observaciones")));
            $archivo->save($conn);

            
            $dirTemp = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR .'tmp';        
            rename($dirTemp.DIRECTORY_SEPARATOR.$filenameTemp,   $directorio . DIRECTORY_SEPARATOR .utf8_encode($filename).'.pdf');            
            
            $conn->commit();
            $this->responseArray = array("success" => true, "mensaje"=> utf8_encode("Informe guardado correctamente"), "filenameTemp"=>$filenameTemp);
        }catch(Exception $e){
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo"=> utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }
    
    public function executeBorrarReposTemp(sfWebRequest $request){
        
        $indice = $request->getParameter("indice");
        $filenameTemp = "Archivo temporal Indicador ".$indice.'.pdf';
        $dirTemp = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR .'tmp';
        
        unlink($dirTemp.DIRECTORY_SEPARATOR.$filenameTemp);
        $this->setTemplate("responseTemplate");
        
    }
    
    public function executeDatosVersiones(sfWebRequest $request){
    
        $idg = $request->getParameter("idg");  
        
        $indicador = Doctrine::getTable("Idg")->find($idg);
        $proceso = $indicador->getIdgProcesos();
        
        $ano = $request->getParameter("ano");
        $mes = $request->getParameter("mes");        
        $nIndicador = utf8_encode($indicador->getCaNombre());
        $nProceso = utf8_encode($proceso->getCaNombre());
        
        $data = array();        
        $data["filename"] =  $nIndicador." ".$mes." : ".$ano;
        
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
       
    }
    
    public function executeDatosArchivos(sfWebRequest $request){
        
        $idg = $request->getParameter("idg");  
        
        $indicador = Doctrine::getTable("Idg")->find($idg);
        $proceso = $indicador->getIdgProcesos();
        
        $conn = Doctrine::getTable("IdgArchivo")->getConnection();
        $conn->beginTransaction();
        
        try{
            $archivos = Doctrine::getTable("IdgArchivo")
                    ->createQuery("ia")
                    ->where("ia.ca_idg = ?", $idg)
                    ->addWhere("ca_fcheliminado IS NULL")
                    ->execute();        

            foreach($archivos as $archivo){                
                $row["idarchivo"] = $archivo->getCaIdarchivo();
                $row["ano"] = $archivo->getCaAno();
                $row["proceso"] = utf8_encode($proceso->getCaNombre());
                $row["periodo"] = $archivo->getCaPeriodo();
                $row["sucursal"] = utf8_encode($archivo->getSucursal()->getCaNombre());
                $row["nombre"] = utf8_encode($archivo->getCaNombre());
                $row["path"] = "/gestDocumental/verArchivo?idarchivo=".base64_encode($archivo->getCaPath());
                $row["observaciones"] = utf8_encode($archivo->getCaObservaciones());
                $row["fchcreado"] = $archivo->getCaFchcreado();
                $row["usucreado"] = $archivo->getCaUsucreado();
                $data[] = $row;
            }
            $this->responseArray = array("success" => true, "root" => $data, "total"=>count($data));
            
        }catch(Exception $e){
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo"=> utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosTreeGridArchivos(sfWebRequest $request){
        
        $idg = $request->getParameter("idg");
        $data = array();
        
        $indicador = Doctrine::getTable("Idg")->find($idg);
        $proceso = $indicador->getIdgProcesos();
        
        $conn = Doctrine::getTable("IdgArchivo")->getConnection();
        $conn->beginTransaction();
        
        try{
            $archivos = Doctrine::getTable("IdgArchivo")
                    ->createQuery("ia")
                    ->where("ia.ca_idg = ?", $idg)
                    ->addWhere("ca_fcheliminado IS NULL")
                    ->orderBy("ca_ano ASC, ca_idsucursal ASC, ca_fchcreado")
                    ->execute(); 
            $lastArc = true;
            
            if(count($archivos)>0){
                foreach($archivos as $archivo){    
                    if ($lastArc) {                
                        $ano = $archivo->getCaAno();                
                        $sucursal = utf8_encode($archivo->getSucursal()->getCaNombre());                    
                        $lastArc = false;                                
                    }

                    if ($ano != $archivo->getCaAno() && $sucursal != utf8_encode($archivo->getSucursal()->getCaNombre())) {                    
                        $allchildren[] = array("text"=>$ano, "expanded"=> true, "children"=>$dataSuc);  
                        $ano = $archivo->getCaAno();                                        
                        $sucursal = utf8_encode($archivo->getSucursal()->getCaNombre());
                        $childrens = array();
                        $dataSuc = array();
                    }

                    if($sucursal != utf8_encode($archivo->getSucursal()->getCaNombre())){
                        $dataSuc[] = array("text"=>$sucursal, "expanded"=> true, "children"=>$childrens[$sucursal]);
                        $sucursal = utf8_encode($archivo->getSucursal()->getCaNombre());
                    }

                    $childrens[$sucursal][] = array(
                        "text"=>'<a href="/gestDocumental/verArchivo?idarchivo='.base64_encode(utf8_encode($archivo->getCaPath())).'" target="_blank">'.utf8_encode($archivo->getCaNombre())."</a>", 
                        "observaciones"=>utf8_encode($archivo->getCaObservaciones()),
                        "periodo" => $archivo->getCaPeriodo(),
                        "fchcreado"=>utf8_encode($archivo->getCaFchcreado()),
                        "usucreado"=>utf8_encode($archivo->getCaUsucreado()),
                        "idarchivo"=>$archivo->getCaIdarchivo(),
                        "leaf"=>true
                    );
                }
                $dataSuc[] = array("text"=>$sucursal, "expanded"=> true, "children"=>$childrens[$sucursal]);
                $allchildren[] = array("text"=>$ano, "expanded"=> true, "children"=>$dataSuc);                
                $data = array("text"=> utf8_encode($proceso->getCaNombre()),"expanded" => true, "children" => $allchildren);
            }else{
                $childrensSuc[] = array(
                    "text" => "No hay datos",
                    "children" => array(
                        "text"=>"No hay datos",
                        "leaf"=>true
                    )
                );
                $dataSuc = array("text"=>date("Y"), "expanded"=> true, "children"=>$childrensSuc);
                $data = array("text"=> utf8_encode($proceso->getCaNombre()),"expanded" => true, "children" => $dataSuc);
            }
            
            $this->responseArray = array("children" => $data);
            
        }catch(Exception $e){
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo"=> utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
        
    }
    
    public function executeDatosTreeGridArchivosPorProceso(sfWebRequest $request){
        
        $data = array();
        $dataProceso = array();
        
        $conn = Doctrine::getTable("IdgArchivo")->getConnection();
        $conn->beginTransaction();
        
        try{
            
            $q = Doctrine::getTable("IdgProcesos")
                    ->createQuery("ip")
                    ->select("ip.ca_nombre, ip.ca_idproceso")
                    ->innerJoin("ip.Idg i")
                    ->where("i.ca_activo = ?", TRUE)
                    ->orderBy("ip.ca_nombre ASC")
                    ->distinct();
            
            $procesos = $q->execute();
                    
            foreach($procesos as $proceso){
            
                $indicadores = Doctrine::getTable("Idg")
                        ->createQuery("i")
                        ->where("ca_activo = ?", TRUE)
                        ->andWhere("ca_idproceso = ?", $proceso->getCaIdproceso())
                        ->execute();            

                foreach($indicadores as $idg){

                    $indicador = Doctrine::getTable("Idg")->find($idg->getCaIdg());
                    $proceso = $indicador->getIdgProcesos();

                    $archivos = Doctrine::getTable("IdgArchivo")
                            ->createQuery("ia")
                            ->where("ia.ca_idg = ?", $idg->getCaIdg())
                            ->addWhere("ca_fcheliminado IS NULL")
                            ->orderBy("ca_ano ASC, ca_idsucursal ASC, ca_fchcreado")
                            ->execute(); 
                    $lastArc = true;

                    if(count($archivos)>0){
                        foreach($archivos as $archivo){    
                            if ($lastArc) {                
                                $ano = $archivo->getCaAno();                
                                $sucursal = utf8_encode($archivo->getSucursal()->getCaNombre());                    
                                $lastArc = false;                                
                            }

                            if ($ano != $archivo->getCaAno() && $sucursal != utf8_encode($archivo->getSucursal()->getCaNombre())) {                    
                                $allchildren[] = array("text"=>$ano, "expanded"=> false, "children"=>$dataSuc);  
                                $ano = $archivo->getCaAno();                                        
                                $sucursal = utf8_encode($archivo->getSucursal()->getCaNombre());
                                $childrens = array();
                                $dataSuc = array();
                            }

                            if($sucursal != utf8_encode($archivo->getSucursal()->getCaNombre())){
                                $dataSuc[] = array("text"=>$sucursal, "expanded"=> false, "children"=>$childrens[$sucursal]);
                                $sucursal = utf8_encode($archivo->getSucursal()->getCaNombre());
                            }

                            $childrens[$sucursal][] = array(
                                "text"=>'<a href="/gestDocumental/verArchivo?idarchivo='.base64_encode(utf8_encode($archivo->getCaPath())).'" target="_blank">'.utf8_encode($archivo->getCaNombre())."</a>", 
                                "observaciones"=>utf8_encode($archivo->getCaObservaciones()),
                                "periodo" => $archivo->getCaPeriodo(),
                                "fchcreado"=>utf8_encode($archivo->getCaFchcreado()),
                                "usucreado"=>utf8_encode($archivo->getCaUsucreado()),
                                "idarchivo"=>$archivo->getCaIdarchivo(),
                                "leaf"=>true
                            );
                        }
                        $dataSuc[] = array("text"=>$sucursal, "expanded"=> false, "children"=>$childrens[$sucursal]);
                        $allchildren[] = array("text"=>$ano, "expanded"=> false, "children"=>$dataSuc);
                        $data[] = array("text"=> utf8_encode($indicador->getCaNombre()),"expanded" => false, "children" => $allchildren);                    
                    }else{
                        $childrensSuc[] = array(
                            "text" => "No hay datos",
                            "children" => array(
                                "text"=>"No hay datos",
                                "leaf"=>true
                            )
                        );
                        $dataSuc = array("text"=>date("Y"), "expanded"=> false, "children"=>$childrensSuc);
                        $data[] = array("text"=> utf8_encode($indicador->getCaNombre()),"expanded" => false, "children" => $dataSuc);
                    }
                    $childrensSuc = array();
                    $childrens = array();
                    $dataSuc = array();
                    $allchildren = array();
                }
                $dataProceso[] = array("text"=> utf8_encode($proceso->getCaNombre()),"expanded" => false, "children" => $data);
                $data = array();
            }
            $this->responseArray = array("children" => $dataProceso);
        }catch(Exception $e){
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo"=> utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
        
    }
    
    public function executeEliminarArchivo(sfWebRequest $request){
        
        $idarchivo = $request->getParameter("idarchivo");
        $archivo = Doctrine::getTable("IdgArchivo")->find($idarchivo);
        
        $conn = Doctrine::getTable("IdgArchivo")->getConnection();
        $conn->beginTransaction();
        
        try{
            $archivo->setCaFcheliminado(date("Y-m-d H:i:s"));
            $archivo->setCaUsueliminado($this->getUser()->getUserId());
            $archivo->save($conn);
            
            $conn->commit();            
            
            $this->responseArray = array("success" => true, "idarchivo"=> $idarchivo);
            
        }catch(Exception $e){
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo"=> utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }
}
<?php

/**
 * config actions.
 *
 * @package    symfony
 * @subpackage config
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class indicadoresAduActions extends sfActions {

    public function preExecute() {
        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        switch ($app) {
            case "colsys":
                $this->pref = "";
                $this->idcliente = '900204182';
                $this->top = 30;
                break;
            case "tracking":
                $this->pref = "/tracking";
                $this->top = 75;
                $this->idcliente = $this->getUser()->getClienteActivo();
               
                break;
        }

        if ($this->idcliente == "900204182") {
            $this->plantilla = true;
        } else
            $this->plantilla = false;
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndexExt5(sfWebRequest $request) {

        if ($this->plantilla) {

            $q = Doctrine::getTable("AduDetPlantilla")
                    ->createQuery("s")
                    ->select("s.*")
                    ->innerjoin("s.AduCabPlantilla c")
                    ->Where("c.ca_idcliente=900204182")
                    ->addWhere("c.ca_id_cab_plantilla=s.ca_id_cab_plantilla")
                    ->orderBy("s.ca_orden ASC")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
            $debug = $q->getSqlQuery();
            $datos = $q->execute();
            $campos = $datos;

            $this->fields = array();
            foreach ($campos as $ca) {
                $this->fields [] = array("name" => utf8_encode($ca['s_ca_nombre']), "text" => utf8_encode($ca['s_ca_nombre']), "id" => utf8_encode($ca["s_ca_nombrejson"]),
                    "tipo" => utf8_encode($ca["s_ca_tipo"]), "dataIndex" => utf8_encode($ca['s_ca_nombrejson'])
                );
            }
            /*            $q = Doctrine::getTable("AduDetPlantilla")
              ->createQuery("s")
              ->select("s.*")
              ->innerjoin("s.AduCabPlantilla c")
              ->Where("c.ca_idcliente=?",array($this->idcliente))
              ->addWhere("c.ca_id_cab_plantilla=s.ca_id_cab_plantilla AND ca_ubicacion=1")
              ->orderBy("s.ca_orden ASC")
              ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
              $debug=$q->getSqlQuery();
              $datos=$q->execute();
              $campos=  $datos;
              $this->fields = array();
              foreach($campos as $ca)
              {
              $this->fields [] =array( "name"=> utf8_encode($ca['s_ca_nombre']),"id"=> utf8_encode($ca["s_ca_nombrejson"]),
              "tipo"   => utf8_encode($ca["s_ca_tipo"])
              );
              }
             */
        }
    }

    function executeDatosIndex($request) {
        $idopcion = ($request->getParameter("node") != "" && $request->getParameter("node") != "root") ? $request->getParameter("node") : "0";
        $tree = array("text" => "Opciones", "leaf" => true, "id" => "1");
     //   print_r( $this->idcliente);
        if ($idopcion == 0) {
            $childrens[] = array("text" => "Cuadro Matriz", "leaf" => true, "id" => "1" );
            $childrens[] = array("text" => "Indicadores", "leaf" => true, "id" => "2");
            $childrens1[] = array("text" => "Generador", "leaf" => true, "id" => "3");
            //$childrens1[] = array("text" => "Costos","leaf" => true,"id" => "4");
            //$childrens1[] = array("text" => "T. nacionalizacion","leaf" => true,"id" => "4");
            //$childrens1[] = array("text" => "Frec. Inspeccion","leaf" => true,"id" => "5");
            $childrens[] = array("text" => "Estadisticas", "leaf" => false, "children" => $childrens1);

            $childrensAdmin[] = array("text" => "Fechas de cierre", "leaf" => true, "id" => "4");
            $childrensAdmin[] = array("text" => utf8_encode("Admin. Plantillas"), "leaf" => true, "id" => "5");
            $childrens[] = array("text" => utf8_encode("Administración"), "leaf" => false, "children" => $childrensAdmin);

            $children[] = array("text" => utf8_encode("Importación Marítima"), "leaf" => true, "id" => "10", "cliente"=>  $this->idcliente);
            $children[] = array("text" => utf8_encode("Importación Aérea"), "leaf" => true, "id" => "11","cliente"=>  $this->idcliente);
            //$children[] = array("text" => utf8_encode("Exportación Marítima"), "leaf" => true, "id" => "12","cliente"=>  $this->idcliente);
            //$children[] = array("text" => utf8_encode("Exportación Aérea"), "leaf" => true, "id" => "13","cliente"=>  $this->idcliente);
            $children[] = array("text" => utf8_encode("Otm"), "leaf" => true, "id" => "14","cliente"=>  $this->idcliente);            
            $children[] = array("text" => "Aduana", "leaf" => false, "id" => "9", "children" => $childrens);
            $children[] = array("text" => utf8_encode("Parametrización"), "leaf" => true, "id" => "15","cliente"=>  $this->idcliente);
        }




        $nivel1[] = array("text" => utf8_encode("Indicadores"), "leaf" => false, "children" => $children);




        $tree["children"] = $nivel1;

        $this->responseArray = $tree;
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarArchivoControl(sfWebRequest $request) {

        //$file=sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';


        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/Shared/String.php';
        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/Reader/Excel5.php';
        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/Shared/OLERead.php';


        //include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Autoloader.php';
        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel.php';
        include sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';

        if ($request->isMethod('post')) {
            $file = $_FILES["archivo"];
            //print_r($file);
            //exit;
            if ($file["tmp_name"]) {
                $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . "falaadu" . DIRECTORY_SEPARATOR;

                $fileName = $file['name'];
                $existe = true;
                $con = 0;

                while ($existe) {
                    $con++;
                    if (file_exists($directory . $fileName)) {
                        $info = pathinfo($directory . $fileName);
                        $fileName = basename($directory . $fileName, '.' . $info['extension']);
                        $fileName = $fileName . $con . "." . $info['extension'];
                    } else
                        $existe = false;
                }

                //echo $directory . $fileName;
                if (move_uploaded_file($file['tmp_name'], $directory . $fileName)) {

                    //$objReader = new PHPExcel_Reader_Excel5();
                    //$objPHPExcel = $objReader->load($directory . $fileName);
                    $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . "falaadu" . DIRECTORY_SEPARATOR;
                    //echo PHPEXCEL_ROOT;
                    $objPHPExcel = PHPExcel_IOFactory::load($directory . $fileName);
                    //exit;
                    $hojas = array();
                    foreach ($objPHPExcel->getSheetNames() as $s) {
                        $hojas[] = array("name" => $s);
                    }

                    $this->responseArray = array("id" => base64_encode($fileName), "fileName" => $fileName, "fecha" => $fecha, "hojas" => $hojas, "success" => true);
                } else {
                    $this->responseArray = array("error" => "No se pudo mover el archivo", "filename" => $fileName, "folder" => $folder, "success" => false);
                }
            } else {
                $fileName = $request->getParameter("fileName");
            }
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeProcesarArchivoControl(sfWebRequest $request) {

        $fileName = $request->getParameter("fileName");
        $hoja = $request->getParameter("hoja");
        $muelle = $request->getParameter("muelle");
        $fecha = $request->getParameter("fecha");
        $idcliente = "900204182"; //ARAUCO
        //include '/home/maquinche/Desarrollo/colsys_sf3/plugins/sfPhpEcxelPlugin/Classes/PHPExcel/IOFactory.php';
        include sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';

        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . "falaadu" . DIRECTORY_SEPARATOR;
        $objPHPExcel = PHPExcel_IOFactory::load($directory . $fileName);

        $ws = $objPHPExcel->getSheetByName($hoja);

        $array = $ws->toArray();

        $cab = new AduIndCabControl();
        $conn = $cab->getTable()->getConnection();
        $conn->beginTransaction();
        //try
        {
            //echo "<pre>";print_r($array);echo "</pre>";
            //exit;

            foreach ($array as $pos => $row) {
                $datos = array();
                if ($pos == 0) {
                    $cab = new AduIndCabControl();
                    $cab->setCaFile($fileName);
                    $cab->setCaHoja($hoja);
                    $cab->setCaMuelle($muelle);
                    $cab->setCaFecha($fecha);
                    $cab->setCaIdcliente($idcliente);
                    $cab->save($conn);

                    $q = Doctrine::getTable("AduDetPlantilla")
                            ->createQuery("d")
                            ->select("*")
                            ->innerJoin("d.AduCabPlantilla c")
                            ->where("c.ca_idcliente=?", "900204182")
                            ->orderBy("d.ca_orden");
                    //->execute();
                    //->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                    $debug = $q->getSqlQuery();
                    //echo $debug;
                    //exit;
                    $templates = $q->execute();
                    $columnas = $columnasDatos = array();
                    foreach ($templates as $t) {
                        if ($t->getCaUbicacion())
                            $columnas[$t->getCaNombrejson()] = $t->getCaOrden();
                        else {
                            $columnasDatos[$t->getCaNombre()] = array($t->getCaOrden(), $t->getCaNombrejson());
                        }
                    }
                }

                if ($pos < 3 || $row[$columnas["ca_referencia"]] == "") {
                    continue;
                }

                $det = new AduIndDetControl();
                foreach ($columnas as $k => $c) {

                    if (strpos($k, "fch") !== false) {
                        $row[$c] = Utils::transformDate1(trim($row[$c]));
                    }

                    $det->set($k, trim($row[$c]));
                }

                foreach ($columnasDatos as $k => $c) {
                    $datos[$c[1]] = $row[$c[0]];
                }
                $det->setCaDatos(json_encode($datos));

                $det->setCaIdIndCabControl($cab->getCaIdIndCabControl());
                $det->save($conn);
            }


            $conn->commit();
            $success = true;
        }
        /* catch(Exception $e)
          {
          $error=$e->getmessage();
          $success=false;
          } */
        //exit;

        $this->responseArray = array("id" => base64_encode($fileName), "fileName" => $fileName, "hojas" => $hoja, "success" => $success, "error" => $error);
        $this->setTemplate("responseTemplate");
    }

    public function executeConsultaCabControl(sfWebRequest $request) {


        $q = Doctrine::getTable("AduIndCabControl")
                ->createQuery("c")
                ->select("*")
                //->where("SUBSTR(ca_cod::TEXT,1,2)=? and ca_idempresa=?  ",array($ccosto->getCaCentro().$ccosto->getCaSubcentro() , $ccosto->getCaIdempresa()) )
                ->addOrderBy("c.ca_fchcreado desc")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

        $debug = $q->getSqlQuery();

        $datos = $q->execute();

        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos), "debug" => $debug);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosDetControl(sfWebRequest $request) {

        $parametros = "";

        if ($request->getParameter("parametros"))
            $parametros = json_decode($request->getParameter("parametros"));

        $q = Doctrine::getTable("AduIndDetControl")
                ->createQuery("s")
                ->select("*")
                ->innerjoin("s.AduIndCabControl c")
                ->Where("c.ca_idcliente=900204182")
                ->where("c.ca_id_ind_cab_control=s.ca_id_ind_cab_control")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

        if ($parametros != "") {
            foreach ($parametros->filtros as $f) {
                //echo "<pre>";print_r($filtro);echo "</pre>";
                //foreach($filtro as $f)
                {
                    //echo "<pre>";print_r($f);echo "</pre>";

                    if ($f->name != "" && $f->operador != "" && $f->valor != "")
                        $q->addWhere($f->name . $f->operador . "'" . $f->valor . "'");
                    //echo $f->id.$f->operador.$f->valor;
                }
            }
        }

        $debug = $q->getSqlQuery();
        $datos_consulta = $q->execute();
        $datos = array();
        foreach ($datos_consulta as $d) {
            $fileds1 = array(
                "ca_id_ind_Det_control" => $d["s_ca_id_ind_det_control"],
                "ca_origen" => utf8_encode($d["s_ca_origen"]),
                "ca_destino" => utf8_encode($d["s_ca_destino"]),
                "ca_hbl" => utf8_encode($d["s_ca_hbl"]),
                "ca_fcheta" => $d["s_ca_fcheta"],
                "ca_referencia" => utf8_encode($d["s_ca_referencia"]),
                "ca_tipodim" => utf8_encode($d["s_ca_tipodim"]),
                "ca_inspeccion" => utf8_encode($d["s_ca_inspeccion"]),
                "ca_terminal" => utf8_encode($d["s_ca_terminal"]),
                "ca_transportadora" => utf8_encode($d["s_ca_transportadora"]),
                "ca_tipocarga" => utf8_encode($d["s_ca_tipocarga"]),
                "ca_fchbl" => $d["s_ca_fchbl"],
                "ca_fchrecibo" => $d["s_ca_fchrecibo"],
                "ca_fchaprobacionrim" => $d["s_ca_fchaprobacionrim"],
                "ca_fchfletes" => $d["s_ca_fchfletes"],
                "ca_fchinspeccion" => $d["s_ca_fchinspeccion"],
                "ca_fchpago" => $d["s_ca_fchpago"],
                "ca_fchlevante" => $d["s_ca_fchlevante"],
                "ca_fchplanillas" => $d["s_ca_fchplanillas"],
                "ca_usucreado" => utf8_encode($d["s_ca_usucreado"]),
                "ca_fchcreado" => $d["s_ca_fchcreado"],
                "ca_usuactualizado" => utf8_encode($d["s_ca_usuactualizado"]),
                "ca_fchactualizado" => $d["s_ca_fchactualizado"],
            );
            $filedsJson = json_decode(utf8_encode($d["s_ca_datos"]), true);
            $datos[] = array_merge($fileds1, $filedsJson);
            //array("A"=>"msc leane")
        }
        /*

          $parametros="";
          if($request->getParameter("parametros"))
          $parametros = json_decode($request->getParameter("parametros"));
          $idcabcontrol = $request->getParameter("idcabcontrol");

          $q = Doctrine::getTable("AduIndDetControl")
          ->createQuery("c")
          ->select("c.*")
          ->innerJoin("c.AduIndCabControl f")
          ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
          if($idcabcontrol!='')
          {
          $q->addWhere("ca_id_ind_cab_control=? ",$idcabcontrol );
          $q->addOrderBy( "c.ca_id_ind_det_control desc " );
          }
          if($parametros!="")
          {
          foreach($parametros->filtros as $f)
          {
          //echo "<pre>";print_r($filtro);echo "</pre>";
          //foreach($filtro as $f)
          {
          //echo "<pre>";print_r($f);echo "</pre>";
          if($f->name!="" && $f->operador!="" && $f->valor!=""){
          $q->addWhere($f->name.$f->operador."'".$f->valor."'" );

          }
          //echo $f->id.$f->operador.$f->valor;
          }
          }
          }
          $debug=$q->getSqlQuery();
          //exit($debug);
          $datos= $q->execute();
          //echo count($datos);
          $festivos = TimeUtils::getFestivos(date("Y"));
          //print_r($festivos);
          //echo Utils::diffDays("2015-04-08","2015-03-23");
          //exit;
          foreach($datos as $k=>$c)
          {
          $this->tmp = ParametroTable::retrieveByCaso("CU247", null,null,$c["c_ca_lognet"]);
          $datos[$k]["c_ca_lognet"]=(!$this->tmp[0]->getCaValor2()?$this->tmp[0]->getCaValor():$this->tmp[0]->getCaValor2());

          $this->tmp = ParametroTable::retrieveByCaso("CU248", null,null,$c["c_ca_blimpresion"]);
          $datos[$k]["c_ca_blimpresion"]=(!$this->tmp[0]->getCaValor2()?$this->tmp[0]->getCaValor():$this->tmp[0]->getCaValor2());

          $this->tmp = ParametroTable::retrieveByCaso("CU249", null,null,$c["c_ca_transportador"]);
          $datos[$k]["c_ca_transportador"]=(!$this->tmp[0]->getCaValor2()?$this->tmp[0]->getCaValor():$this->tmp[0]->getCaValor2());

          $this->tmp = ParametroTable::retrieveByCaso("CU250", null,null,$c["c_ca_tipocarga"]);
          $datos[$k]["c_ca_tipocarga"]=(!$this->tmp[0]->getCaValor2()?$this->tmp[0]->getCaValor():$this->tmp[0]->getCaValor2());

          if($c["f_ca_fecha"]!="")
          {
          if($c["c_ca_fchrecepcion"]!="")
          $datos[$k]["demoradocs"]=floor(TimeUtils::dateDiff1($c["f_ca_fecha"],$c["c_ca_fchrecepcion"]));

          if($c["c_ca_fchdescripciones"]!="" || $c["c_ca_fchrecepcion"]!="")
          {
          $fechatmp="";
          switch(Utils::compararFechas($c["c_ca_fchdescripciones"], $c["c_ca_fchrecepcion"]))
          {
          case "0":
          case "1":
          $fechatmp=$c["c_ca_fchdescripciones"];
          break;
          case "-1":
          $fechatmp=$c["c_ca_fchrecepcion"];
          break;
          }
          $datos[$k]["atiempo"]= (Utils::compararFechas($fechatmp,$c["f_ca_fecha"])==1)?"No":"Si";
          }
          if($c["c_ca_fchlevante"]!="")
          {
          $datos[$k]["diasnaleta"]=TimeUtils::dateDiff1($c["f_ca_fecha"],$c["c_ca_fchlevante"]);

          if(Utils::compararFechas($c["c_ca_fchconsinv"],$fechatmp)==1)
          {
          $fechatmp=$c["c_ca_fchconsinv"];
          }
          $datos[$k]["diasnalhab"]=(TimeUtils::workDiff($festivos,$fechatmp,$c["c_ca_fchlevante"]));
          //$datos[$k]["diasnalhab"]++;
          }
          }
          }
          //echo "<pre>";print_r($datos);echo "</pre>";
          $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos),"debug"=>$debug);
          $this->setTemplate("responseTemplate");
         */
        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos), "totalc" => count($datos), "debug" => $debug);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosPie(sfWebRequest $request) {

        $datos = array();
        $tipo = $request->getParameter("tipo");
        $fecha1 = $request->getParameter("fecha1");
        $fecha2 = $request->getParameter("fecha2");

        $eta1 = $request->getParameter("eta1");
        $eta2 = $request->getParameter("eta2");

        $q = Doctrine::getTable("AduIndDetControl")
                ->createQuery("c")
                ->select("c.*,f.ca_fecha,f.ca_muelle")
                ->innerJoin("c.AduIndCabControl f")
                //->where("ca_fchlevante BETWEEN ? AND ?  ",  array($fecha1,$fecha2) )
                ->addOrderBy("c.ca_id_ind_det_control ")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

        if ($fecha1 != "" && $fecha2 != "") {
            $q->addWhere("c.ca_fchlevante BETWEEN ? AND ?  ", array($fecha1, $fecha2));
        }

        if ($eta1 != "" && $eta2 != "") {
            $q->addWhere("c.ca_fcheta BETWEEN ? AND ?  ", array($eta1, $eta2));
        }

        $debug = $q->getSqlQuery();
        $datos = $q->execute();
        $festivos = TimeUtils::getFestivos(date("Y"));
        $sum_diashab = 0;
        $prom_diashab = 0;
        $sum_diaseta = 0;
        $prom_diaseta = 0;
        $consolidadosnc = array();

        $festivos = TimeUtils::getFestivos(date("Y"));
        $tmpRef = array();
        $sumDias = array();
        $nsumDias = array();
        foreach ($datos as $k => $c) {

            $datos[$k]["dias1"] = (TimeUtils::workDiff($festivos, $c["c_ca_fcheta"], $c["c_ca_fchlevante"]));

            /* 	if($datos[$k]["dias1"]=="40")
              {
              print_r($datos[$k]);
              exit;
              } */
            if ($c["c_ca_inspeccion"] == "SI") {
                $ndias = 4;
            } else {
                $ndias = 3;
            }
            if ($datos[$k]["dias1"] > $ndias) {
                $indicadores["indicador1"][$c["c_ca_inspeccion"]]["nocumple"][$c["c_ca_referencia"]] = $c["c_ca_referencia"];

                $datos[$k]["indicador1"] = 0;
            } else {
                $indicadores["indicador1"][$c["c_ca_inspeccion"]]["cumple"][$c["c_ca_referencia"]] = $c["c_ca_referencia"];

                $datos[$k]["indicador1"] = 1;
            }

            $sumDias["Total"]+=$datos[$k]["dias1"];
            $nsumDias["Total"] ++;

            $sumDias[(($c["c_ca_inspeccion"] == "NO") ? "SIN ICA" : "CON ICA")]+=$datos[$k]["dias1"];
            $nsumDias[(($c["c_ca_inspeccion"] == "NO") ? "SIN ICA" : "CON ICA")] ++;

            //$indicadores["indicador4"][$c["c_ca_inspeccion"]][$c["c_ca_referencia"]]=$c["c_ca_referencia"];
            if (!in_array($c["c_ca_referencia"], $tmpRef)) {
//print_r($datos[$k]);
//exit;
                $indicadores["indicador4"]["tipo"][$c["c_ca_inspeccion"]][$datos[$k]["dias1"]] ++;
                $indicadores["indicador4"]["dias"][$datos[$k]["dias1"]][$c["c_ca_inspeccion"]] ++;
            }

            $fechasultimodoc = array($c["c_ca_fchbl"], $c["c_ca_fchrecibo"], $c["c_ca_fchaprobacionrim"], $c["c_ca_fchfletes"], $c["c_ca_fchinspeccion"]);
            $fechatmp = $fechasultimodoc[0];
            for ($cont = 1; $cont < $fechasultimododoc; $cont++) {
                $fechatmp = (Utils::compararFechas($fechatmp, $fechasultimododoc[$cont]) == 1) ? $fechatmp : $fechasultimododoc[$cont];
            }
            $datos[$k]["ultimodoc"] = $fechatmp;
            $datos[$k]["dias2"] = (TimeUtils::workDiff($festivos, $fechatmp, $c["c_ca_fcheta"]));
            $datos[$k]["dias3"] = (TimeUtils::workDiff($festivos, $c["c_ca_fchlevante"], $c["c_ca_fchplanillas"]));

            if ($datos[$k]["dias3"] > 1) {
                $indicadores["indicador3"][$c["c_ca_inspeccion"]]["nocumple"][$c["c_ca_referencia"]] = $c["c_ca_referencia"];
            } else
                $indicadores["indicador3"][$c["c_ca_inspeccion"]]["cumple"][$c["c_ca_referencia"]] = $c["c_ca_referencia"];

            //echo "<pre>";print_r($c);echo "</pre>";            
            $datosJson = json_decode($c["c_ca_datos"]);
            //$contenedores[$c["c_ca_referencia"]][$datosJson->N]=$datosJson->O;
            //$indicadores["contenedores"][$c["c_ca_terminal"]]+=$datosJson->O;//Q.CONT

            $indicadores["contenedores"][$c["c_ca_terminal"]]+=$datosJson->R; //Q.CONT
            $indicadores["contenedores1"][substr($c["c_ca_fcheta"], 0, 7)]+=$datosJson->R;
            if (!in_array($c["c_ca_referencia"], $tmpRef)) {
                /*    $indicadores["contenedores"][$c["c_ca_terminal"]]+=$datosJson->O;//Q.CONT

                  $indicadores["contenedores"][$c["c_ca_terminal"]]+=$datosJson->O;//Q.CONT
                  $indicadores["contenedores1"][substr($c["c_ca_fcheta"], 0, 7)]+=$datosJson->O;
                 * 
                 */
                //$c["c_ca_fcheta"]
                $tmpRef[] = $c["c_ca_referencia"];
            }


            $tiposdim[$c["c_ca_tipodim"]] = 1;

            $indicadores["total"]["contenedores"]+=$datosJson->R; //Q.CONT
            $indicadores["referencias"]["numeros"][$c["c_ca_referencia"]] = $c["c_ca_referencia"];
            $indicadores["referencias"]["muelles"][$c["c_ca_terminal"]][$c["c_ca_referencia"]] = $c["c_ca_referencia"];
            $indicadores["declaraciones"]["tipodim"][$c["c_ca_tipodim"]][$c["c_ca_referencia"]] = $c["c_ca_referencia"]; //TIPO DIM
            $indicadores["declaraciones"]["muelle"][$c["c_ca_terminal"]][$c["c_ca_tipodim"]][$c["c_ca_referencia"]] = $c["c_ca_referencia"]; //TIPO DIM

            $indicadores["declaracionesinsp"][$c["c_ca_inspeccion"]]["tipodim"][$c["c_ca_tipodim"]][$c["c_ca_referencia"]] = $c["c_ca_referencia"]; //TIPO DIM
            $indicadores["declaracionesinsp"][$c["c_ca_inspeccion"]]["muelle"][$c["c_ca_terminal"]][$c["c_ca_tipodim"]][$c["c_ca_referencia"]] = $c["c_ca_referencia"];
        }

        // CONTENEDORES
        foreach ($indicadores["referencias"]["muelles"] as $k => $r) {
            $indicadores["total"]["referencias"][$k] = count($r);
            $indicadores["total"]["referencias"]["t"]+=count($r);
        }

        $contenedores = $cont = $refs = null;
        foreach ($indicadores["contenedores"] as $k => $c) {
            $cont[$k] = $c;
        }
        $contenedores[] = array_merge(array("tipo" => "Contenedores"), $cont);

        foreach ($indicadores["referencias"]["muelles"] as $k => $c) {
            $do[$k] = count($c);
        }
        $contenedores[] = array_merge(array("tipo" => "do"), $do);

        foreach ($indicadores["contenedores"] as $k => $c) {
            $contenedoresgrid[] = array(
                "terminal" => $k,
                "contenedor" => $c,
                "por_contenedor" => round(($c * 100) / $indicadores["total"]["contenedores"]),
                "referencias" => $indicadores["total"]["referencias"][$k],
                "por_referencias" => round(($indicadores["total"]["referencias"][$k] * 100) / $indicadores["total"]["referencias"]["t"], 2)
            );
        }

        foreach ($indicadores["contenedores1"] as $k => $r) {
            $indicador5[] = array("indicador" => "$k", "total" => $r);
        }
        $tmp = null;
        foreach ($indicadores["contenedores1"] as $periodo => $r) {
            //foreach($r as $tipodim=>$d )
            {
                $tmp[$periodo] = $r;
            }
        }
        $indicador5grid[] = $tmp;

        //TIPO DIM
        foreach ($indicadores["declaraciones"]["tipodim"] as $k => $r) {
            $declaraciones[] = array("indicador" => $k, "total" => count($r));
        }

        $ktiposdim = array_keys($tiposdim);
        foreach ($indicadores["declaraciones"]["muelle"] as $muelle => $r) {
            $tmp = null;

            //foreach($r as $tipodim=>$d )
            foreach ($ktiposdim as $kt) {
                $tmp[$kt] = (isset($r[$kt]) ? count($r[$kt]) : 0);
                //$tmp[$kt]=count($d);
            }
            $declaracionesgrid[] = array_merge(array("TERMINAL" => $muelle), $tmp);
        }

        $tmp = null;
        $conta = 0;

        foreach ($indicadores["declaracionesinsp"] as $insp => $d) {
            $tipo = ($insp == "NO" ? "SIN ICA" : "CON ICA");

            foreach ($d["tipodim"] as $tipodim => $e) {
                $tmp[$tipodim] = count($e);
            }
            $declaracionesinsp[] = array_merge(array("tipo" => $tipo), $tmp);

            foreach ($d["muelle"] as $muelle => $e) {
                foreach ($e as $tipodim => $f) {
                    $tmp1[$tipodim] = count($f);
                }
                $declaracionesinspgrid[] = array_merge(array("TIPO" => $tipo, "TERMINAL" => $muelle), $tmp1);
                $tmp1 = null;
            }
        }
        $tmp = null;
        foreach ($indicadores["indicador1"] as $insp => $d) {
            $tipo = ($insp == "NO" ? "SIN ICA" : "CON ICA");

            //foreach($d["tipodim"] as $tipodim=>$e )
            {
                $tmp["Cumple"] = count($d["cumple"]);
                $tmp["No cumple"] = count($d["nocumple"]);
            }
            $indicador1[] = array_merge(array("tipo" => $tipo), $tmp);
            $indicador1grid[] = array_merge(array("TIPO" => $tipo), $tmp);
        }

        $tmp = null;
        foreach ($indicadores["indicador3"] as $insp => $d) {
            $tipo = ($insp == "NO" ? "SIN ICA" : "CON ICA");

            //foreach($d["tipodim"] as $tipodim=>$e )
            {
                $tmp["Cumple"] = count($d["cumple"]);
                $tmp["No cumple"] = count($d["nocumple"]);
            }
            $indicador3[] = array_merge(array("tipo" => $tipo), $tmp);
            $indicador3grid[] = array_merge(array("TIPO" => $tipo), $tmp);
        }


        ksort($indicadores["indicador4"]["dias"]);
        $dkey = array_keys($indicadores["indicador4"]["dias"]);

        foreach ($indicadores["indicador4"]["tipo"] as $insp => $d) {
            $tmp = null;
            $tipo = ($insp == "NO" ? "SIN ICA" : "CON ICA");

            foreach ($dkey as $dia) {
                $tmp["DIA " . $dia] = (isset($d[$dia]) ? $d[$dia] : 0);
            }
            /* foreach($d as $ndiastmp=>$e )
              {
              $tmp["DIA ".$ndiastmp]=$e;
              //$tmp["No cumple"]=count($d["nocumple"]);
              } */
            //$indicador4[$tipo]= $tmp;
            $indicador4[] = array_merge(array("tipo" => $tipo), $tmp);
            //$indicador4grid[]=array_merge(array("TIPO"=>$tipo),$tmp);
        }


        //foreach($indicadores["indicador4"]["dias"] as $ndiastmp=>$d)
        $inspeccion = array("SI", "NO");
        foreach ($dkey as $ndiastmp) {
            //echo "<pre>";print_r($indicadores["indicador4"]["dias"][$ndiastmp]);echo "</pre>";
            $d = isset($indicadores["indicador4"]["dias"][$ndiastmp]) ? $indicadores["indicador4"]["dias"][$ndiastmp] : array("SI" => 0, "NO" => 0);

            $tmp = null;
            $tmp["SIN ICA"] = (($d["NO"] != "") ? $d["NO"] : 0);
            $tmp["CON ICA"] = (($d["SI"] != "") ? $d["SI"] : 0);
            $indicador4grid[] = array_merge(array("DIA" => $ndiastmp), $tmp);
        }

//$nsumDias["total"][$c["c_ca_inspeccion"]]++;
        $htmlencabezado = '<table align="center">';
        $diasPromedio = array();
        $diasPromedioGrid = array();
        $ica = 0;
        $sinica = 0;
        foreach ($sumDias as $k => $d) {
            $htmlencabezado.= '<tr >'
                    . '     <th class="x-column-header x-column-header-inner">Promedio Dias ' . $k . '</th>'
                    . '     <td class="x-grid-cell x-grid-cell-inner">' . round($d / $nsumDias[$k], 2) . '</td>'
                    . '</tr>';
            if ($k == "SIN ICA") {
                $sinica = round($d / $nsumDias[$k], 2);
            }
            if ($k == "CON ICA") {
                $ica = round($d / $nsumDias[$k], 2);
            }
        }
//        $diasPromedio[] = array("ICA" => $ica, "SIN ICA" => $sinica);
        $diasPromedio[] = array("name" => "CON ICA", "dias" => $ica);
        $diasPromedio[] = array("name" => "SIN ICA", "dias" => $sinica);
        //$diasPromedio[] = array("CON ICA" => 0, "SIN ICA" => $sinica);
//	$diasPromedio =  "CON ICA" => array($ica), "SIN ICA" => array($sinica) ;
        //$diasPromedio[] = array("dias"=>"CON ICA",array( "CON ICA"=>"2"));
//        $diasPromedio[] = array("dias"=>"SIN ICA", "SIN ICA" => "4");
        // $diasPromedioGrid[] = array("TIPO" => "promedio", "ICA" => $ica);
        //$diasPromedioGrid[] = array("TIPO" => "Promedio", "ICA" => $ica);
        //  foreach ($dkey as $ndiastmp) {
        $tmp = null;
        $tmp["SIN ICA"] = $sinica;
        $tmp["CON ICA"] = $ica;
        $diasPromedioGrid[] = $tmp;
        //}

        $htmlencabezado.= '</table>';






        $this->responseArray = array("success" => true, "datos" => $datos,
            "contenedores" => $contenedores, "contenedoresgrid" => $contenedoresgrid,
            "declaraciones" => $declaraciones, "declaracionesgrid" => $declaracionesgrid,
            "declaracionesinsp" => $declaracionesinsp, "declaracionesinspgrid" => $declaracionesinspgrid,
            "indicador1" => $indicador1, "indicador1grid" => $indicador1grid,
            "indicador3" => $indicador3, "indicador3grid" => $indicador3grid,
            "indicador4" => $indicador4, "indicador4grid" => $indicador4grid,
            "indicador5" => $indicador5, "indicador5grid" => $indicador5grid,
            "indicador6" => $diasPromedio, "indicador6grid" => $diasPromedioGrid,
            "encabezados" => $htmlencabezado,
            "debug" => $debug);
        //$this->responseArray = array("success" => true, "indicador"=>$indicador, "muelles"=>$count_values, "consolidados"=>$consolidados,"containers"=>$containers,"nacionalizaciongrid"=>$nacionalizaciongrid);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosGrafica(sfWebRequest $request) {

        //$datos = $request->getParameter("datos");

        $datos = json_decode($request->getParameter("datos"));

        $this->responseArray = array("success" => true, "root" => $datos);
        $this->setTemplate("responseTemplate");
    }

    public function executeGenReporte(sfWebRequest $request) {


        $q = Doctrine::getTable("AduIndDetControl")
                ->createQuery("c")
                ->select("c.*,f.ca_fecha,f.ca_muelle")
                ->innerJoin("c.AduIndCabControl f")
                //->where("ca_fchlevante BETWEEN ? AND ?  ",  array($fecha1,$fecha2) )
                ->addOrderBy("c.ca_id_ind_det_control ")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);


        $this->responseArray = array("success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosFacturacion(sfWebRequest $request) {
        $tipo = $request->getParameter("tipo");
        $fecha1 = $request->getParameter("fecha1");
        $fecha2 = $request->getParameter("fecha2");

        $eta1 = $request->getParameter("eta1");
        $eta2 = $request->getParameter("eta2");


        $q = Doctrine::getTable("AduIndDetControl")
                ->createQuery("c")
                ->select("c.ca_referencia,ic.ca_idcosto, ic.ca_neta, ic.ca_venta,cos.ca_costo")
                ->innerJoin("c.AduIndCabControl f")
                ->innerJoin("c.InoCostosAdu ic")
                ->innerJoin("ic.Costo cos")
                ->addOrderBy("c.ca_referencia,ic.ca_idcosto ")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

        if ($fecha1 != "" && $fecha2 != "") {
            $q->addWhere("ca_fchlevante BETWEEN ? AND ?  ", array($fecha1, $fecha2));
        }

        if ($eta1 != "" && $eta2 != "") {
            $q->addWhere("f.ca_fecha BETWEEN ? AND ?  ", array($eta1, $eta2));
        }

        $debug = $q->getSqlQuery();
        $datos = $q->execute();
        //echo "<pre>";print_r($datos);echo "</pre>";
        $columnas = array();
        $columnas["zreferencia"] = array("name" => "Do", "dataindex" => "zreferencia", "summaryType" => 'count');
        foreach ($datos as $d) {
            $datosJson[$d["c_ca_referencia"]][$d["ic_ca_idcosto"]] = array("costo" => $d["ic_ca_idcosto"], "neta" => $d["ic_ca_neta"], "venta" => $d["ic_ca_venta"]);
            if (!isset($columnas[$d["ic_ca_idcosto"]])) {
                $columnas["z" . $d["ic_ca_idcosto"]] = array("name" => utf8_encode($d["cos_ca_costo"]), "dataindex" => "z" . $d["ic_ca_idcosto"], "summaryType" => 'sum');
            }
        }
        $columnas["zpropio"] = array("name" => "Propio", "dataindex" => "zpropio", "summaryType" => 'sum');
        $columnas["ztercero"] = array("name" => "Tercero", "dataindex" => "ztercero", "summaryType" => 'sum');
        //echo "<pre>";print_r($columnas);echo "</pre>";
        $datos = array();

        foreach ($datosJson as $r => $d) {
            $costo = null;
            $costo["zreferencia"] = $r;
            foreach ($d as $c) {
                if ($c["neta"] > 0) {
                    $costo["z" . $c["costo"]] = round(($c["neta"] != "") ? $c["neta"] : "0");
                    $costo["ztercero"]+=round($costo["z" . $c["costo"]]);
                } else {
                    $costo["z" . $c["costo"]] = round(($c["venta"] != "") ? $c["venta"] : "0");
                    $costo["zpropio"]+=round($costo["z" . $c["costo"]]);
                }
            }
            //echo "<pre>";print_r($costo);echo "</pre>";
            $datos[] = $costo;
        }

        //echo "<pre>";print_r($columnas);echo "</pre>";

        $this->responseArray = array("success" => true, "datos" => $datos, "columnas" => $columnas, "total" => count($datosJson), "debug" => $debug);
        //$this->responseArray = array("success" => true, "indicador"=>$indicador, "muelles"=>$count_values, "consolidados"=>$consolidados,"containers"=>$containers,"nacionalizaciongrid"=>$nacionalizaciongrid);
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarCabControl(sfWebRequest $request) {
        $id = $request->getParameter("id");
        $success = true;
        $errorInfo = "";
        try {
            Doctrine_Query::create()
                    ->delete()
                    ->from("AduIndCabControl c")
                    ->where("c.ca_id_ind_cab_control = ? ", array($id))
                    ->execute();
        } catch (Exception $e) {
            $success = false;
            $errorInfo = $e->getMessage();
        }
        $this->responseArray = array("success" => $success, "errorInfo" => $errorInfo);
        $this->setTemplate("responseTemplate");
    }

    //napuentes

    public function executeDatosGridFechaCierre(sfWebRequest $request) {

        $idcliente = $request->getParameter("idcliente");
        $q = Doctrine::getTable("AduFechaCierre")
                ->createQuery("s")
                ->select("s.ca_id_fecha_cierre,s.ca_fecha_cierre,s.ca_idcliente, c.ca_compania")
                ->innerjoin("s.Cliente c")
                ->addOrderBy("s.ca_fecha_cierre desc")
                //->limit($request->getParameter("limit"))
                ->limit(15)
                ->offset($request->getParameter("start"))
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        if ($idcliente) {
            $q->Where("s.ca_idcliente= ?", $idcliente);
        }
        $debug = $q->getSqlQuery();
        $datos = $q->execute();
        $c = Doctrine::getTable("AduFechaCierre")
                ->createQuery("s")
                ->select("count(*)")
                ->where("s.ca_idcliente= ?", $idcliente/* ,$request->getParameter("ca_idcliente") */)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $debug = $c->getSqlQuery();

        $totalc = $c->execute();

        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos), "totalC" => $totalc, "debug" => $debug);
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarGridFechas($request) {

        $datos = $request->getParameter("datos");
        $fechas = json_decode($datos);
        $ids = array();

        foreach ($fechas as $c) {
            $error = "";
            try {

                $fecha = Doctrine::getTable("AduFechaCierre")->find($c->ca_id_fecha_cierre);
                if (!$fecha) {
                    $fecha = new AduFechaCierre();
                    $fecha->setCaIdcliente($c->ca_idcliente);
                }

                if ($c->ca_fecha_cierre != null) {
                    $fecha->setCaFechaCierre($c->ca_fecha_cierre);
                } else {
                    $error = "Fecha";
                }
                $fechaInvalida = Doctrine::getTable("AduFechaCierre")->find($dato->s_ca_fecha_cierre);
                if ($fechaInvalida) {
                    $error = "FechaExiste";
                } else {
                    $fecha->save();
                    $ids[] = $c->id;
                    $this->responseArray = array("errorInfo" => '', "id" => implode(",", $ids), "success" => true);
                }
            } catch (Exception $e) {
                if ($error = "Fecha" or $error = "FechaExiste") {
                    $errorInfo.="Error: Fecha Invalida" . $e->getMessage();
                } else {
                    $errorInfo.="Error" . utf8_encode($c->item) . ": " . $error . " " . utf8_encode($e->getMessage()) . "<br>";
                }
            }
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarGridFechas(sfWebRequest $request) {

        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        $ids = array();
        $i = 0;

        foreach ($datos as $dato) {
            $i++;
            $AduFechaCierre = Doctrine::getTable("AduFechaCierre")->find($dato->s_ca_id_fecha_cierre);
            if ($AduFechaCierre) {
                $AduFechaCierre->delete();
            }
            $ids[] = $dato->id;
        }
        $this->responseArray = array("success" => true, "ids" => $ids, "count" => $i);
        $this->setTemplate("responseTemplate");
    }

    //metodos 

    public function executeDatosGridCabPlantilla($request) {


        $idcliente = $request->getParameter("idcliente");
        $q = Doctrine::getTable("AduCabPlantilla")
                ->createQuery("s")
                ->select("s.ca_id_cab_plantilla,s.ca_idcliente,s.ca_estado, c.ca_nombres")
                ->innerjoin("s.Cliente c")
                ->addOrderBy("s.ca_id_cab_plantilla asc")
                ->limit(5)
                ->offset($request->getParameter("start"))
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        if ($idcliente) {
            $q->Where("s.ca_idcliente= ?", $idcliente);
        }
        $debug = $q->getSqlQuery();

        $datos = $q->execute();

        $c = Doctrine::getTable("AduCabPlantilla")
                ->createQuery("s")
                ->select("count(*)")
                ->where("s.ca_idcliente= ?", $idcliente)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $debug = $c->getSqlQuery();

        $totalc = $c->execute();

        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos), "totalC" => $totalc, "debug" => $debug);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosGridDetPlantilla(sfWebRequest $request, $request) {
        $cab = $request->getParameter("id_cab_plantilla");

        $q = Doctrine::getTable("AduDetPlantilla")
                ->createQuery("s")
                ->select("*")
                ->innerjoin("s.AduCabPlantilla c")
                ->addOrderBy("s.ca_orden")
                //->limit(20)
                //->offset($request->getParameter("start"))
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        if ($cab) {
            $q->Where("s.ca_id_cab_plantilla= ?", $cab);
        }
        $debug = $q->getSqlQuery();

        $datos = $q->execute();

        $c = Doctrine::getTable("AduDetPlantilla")
                ->createQuery("s")
                ->select("count(*)")
                ->where("s.ca_id_cab_plantilla= ?", $cab)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $debug = $c->getSqlQuery();

        $totalc = $c->execute();

        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos), "totalC" => $totalc, "debug" => $debug, "idCab" => $cab);
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarCabPlantilla($request) {

        $datos = $request->getParameter("datos");
        $cabs = json_decode($datos);
        $ids = array();
        foreach ($cabs as $c) {
            try {
                $cab = Doctrine::getTable("AduCabPlantilla")->find($c->ca_id_cab_plantilla);
                if (!$cab) {
                    $cab = new AduCabPlantilla();
                    $cab->setCaIdcliente($c->ca_idcliente);
                }
                $cab->setCaEstado($c->ca_estado);
                $cab->save();
                $ids[] = $c->id;
                $this->responseArray = array("errorInfo" => '', "id" => implode(",", $ids), "success" => true);
            } catch (Exception $e) {
                $errorInfo.= $e->getMessage() . "<br>";
            }
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarDetPlantilla(sfWebRequest $request) {
        // $cab=$request->getParameter("id_cab_plantilla");
        $datos = $request->getParameter("datos");
        $dets = json_decode($datos);
        $ids = array();
        foreach ($dets as $c) {
            try {
                $det = Doctrine::getTable("AduDetPlantilla")->find($c->ca_id_det_plantilla);
                if (!$det) {
                    $det = new AduDetPlantilla();
                    $det->setCaIdCabPlantilla($c->ca_id_cab_plantilla);
                }
                $det->setCaNombre($c->ca_nombre);
                $det->setCaNombrejson($c->ca_nombrejson);
                $det->setCaOrden($c->ca_orden);
                $det->setCaTipo($c->ca_tipo);
                $det->setCaUbicacion($c->ca_ubicacion);
                $det->save();
                $ids[] = $c->id;
                $this->responseArray = array("errorInfo" => '', "id" => implode(",", $ids), "success" => true);
            } catch (Exception $e) {
                $errorInfo.= $e->getMessage() . "<br>";
            }
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarCabPlantilla(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        $ids = array();
        $i = 0;

        foreach ($datos as $dato) {
            $i++;
            $AduCabPlantilla = Doctrine::getTable("AduCabPlantilla")->find($dato->ca_id_cab_plantilla);
            if ($AduCabPlantilla) {
                $AduCabPlantilla->delete();
            }
            $ids[] = $dato->id;
        }
        $this->responseArray = array("success" => true, "ids" => $ids, "count" => $i);
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarDetPlantilla(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        $ids = array();
        $i = 0;

        foreach ($datos as $dato) {
            $i++;
            $AduDetPlantilla = Doctrine::getTable("AduDetPlantilla")->find($dato->ca_id_det_plantilla);
            if ($AduDetPlantilla) {
                $AduDetPlantilla->delete();
            }
            $ids[] = $dato->id;
        }
        $this->responseArray = array("success" => true, "ids" => $ids, "count" => $i);
        $this->setTemplate("responseTemplate");
    }

    //end napuentes

    public function executeDatosIndAdu(sfWebRequest $request){
        
       // $transporte = $request->getParameter("")
        
        $transporte = utf8_decode($request->getParameter("transporte"));
        
        
        $fecha1 = $request->getParameter("fecha1");
        $fecha2 = $request->getParameter("fecha2");

        $eta1 = $request->getParameter("eta1");
        $eta2 = $request->getParameter("eta2");
        
        
        $festivos = TimeUtils::getFestivos(date("Y"));
        
        $q = Doctrine::getTable("InoMaestraAdu")
                            ->createQuery("c")
                            ->select("*")
                            ->where("ca_transporte = ?  ", $transporte );
                            //->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        

        if($fecha1!="" && $fecha2!="")
        {
            $q->addWhere("ca_fchlevante BETWEEN ? AND ?  ",  array($fecha1,$fecha2) );
        }
        
        if($eta1!="" && $eta2!="")
        {
            $q->addWhere("ca_fcheta BETWEEN ? AND ?  ",  array($eta1,$eta2) );
        }

        if($this->idcliente!="" )
        {
            
            $q->addWhere("ca_idcliente = ?  ",  array($this->idcliente) );
            //$this->idcliente='900204182';
        }
        $debug = $q->getSqlQuery();
        $referencias=$q->execute();

        $indicadores = array();
        for($o=1;$o<7;$o++)
        {
            $indicadores["ind".$o]["CUMPLE"]=0;
            $indicadores["ind".$o]["DEMORA"]=0;
        }

        foreach($referencias as $k=>$d)
        {
            
            $datos[$k]["ca_referencia"]= $d->getCaReferencia(); 
            $datos[$k]["ca_fchreferencia"]= $d->getCaFchreferencia();
            $datos[$k]["ca_origen"]= $d->getCaOrigen();
            $datos[$k]["ca_destino"]= $d->getCaDestino();
            $datos[$k]["ca_idcliente"]= $d->getCaIdcliente();
            $datos[$k]["ca_cliente"]= utf8_encode($d->getCliente()->getCaCompania());
            $datos[$k]["ca_vendedor"]= $d->getCaVendedor();
            $datos[$k]["ca_coordinador"]= $d->getCaCoordinador();
            $datos[$k]["ca_proveedor"]=  utf8_encode($d->getCaProveedor());
            $datos[$k]["ca_pedido"]=  utf8_encode($d->getCaPedido());
            $datos[$k]["ca_piezas"]= $d->getCaPiezas();
            $datos[$k]["ca_peso"]= $d->getCaPeso();
            $datos[$k]["ca_mercancia"]=  utf8_encode($d->getCaMercancia());
            $datos[$k]["ca_deposito"]=  utf8_encode($d->getCaDeposito());
            $datos[$k]["ca_fcharribo"]= $d->getCaFcharribo();
            $datos[$k]["ca_modalidad"]= $d->getCaModalidad();
            /*$datos[$k]["ca_fchcreado"]= $d->getCa();
            $datos[$k]["ca_usucreado"]= $d->getCa();
            $datos[$k]["ca_fchactualizado"]= $d->getCa();
            $datos[$k]["ca_usuactualizado"]= $d->getCa();
            $datos[$k]["ca_fchliquidado"]= $d->getCa();
            $datos[$k]["ca_usuliquidado"]= $d->getCa();
            $datos[$k]["ca_fchcerrado"]= $d->getCa();
            $datos[$k]["ca_usucerrado"]= $d->getCa();*/
            $datos[$k]["ca_nombrecontacto"]=  utf8_encode($d->getCaNombrecontacto());
            $datos[$k]["ca_email"]= $d->getCaEmail();
            $datos[$k]["ca_analista"]= $d->getCaAnalista();
            $datos[$k]["ca_trackingcode"]= $d->getCaTrackingcode();
            $datos[$k]["ca_aplicaidg"]= $d->getCaAplicaidg();
            $datos[$k]["ca_fchlevante"]= $d->getCaFchlevante();
            $datos[$k]["ca_fchpago"]= $d->getCaFchpago();
            $datos[$k]["ca_fchsiga"]= $d->getCaFchsiga();
            $datos[$k]["ca_fchenttransportador"]= $d->getCaFchenttransportador();
            $datos[$k]["ca_fchdespcarga"]= $d->getCaFchdespcarga();
            $datos[$k]["ca_fcheta"]= $d->getCaFcheta();
            $datos[$k]["ca_fchentrcarpfacturacion"]= $d->getCaFchentrcarpfacturacion();
            $datos[$k]["ca_fchentrfacturacion"]= $d->getCaFchentrfacturacion();
            $datos[$k]["ca_fchfacturacion"]= $d->getCaFchfacturacion();
            $datos[$k]["ca_fchmayordoc"]= $d->getCaFchmayordoc();
            $datos[$k]["ca_nitems"]= $d->getCaNitems();
            $datos[$k]["ca_fchmensajeria"]= $d->getCaFchmensajeria();
            
            //Eta vs Documentos Completos
            //$datos[$k]["dia1"]= floor(TimeUtils::dateDiff($d->getCaFcheta(),$d->getCaFchmayordoc()));
            $datos[$k]["dia1"]= floor(TimeUtils::workDiff1($festivos,$d->getCaFcheta(),$d->getCaFchmayordoc()));
            //(TimeUtils::workDiff($festivos,$fechatmp,$c["c_ca_fchlevante"]));
            //$datos[$k]["dia2"]= floor(TimeUtils::dateDiff($d->getCaFchmayordoc(),$d->getCaFchlevante()));
            $datos[$k]["dia2"]= floor(TimeUtils::workDiff1($festivos,$d->getCaFchmayordoc(),$d->getCaFchlevante()));
            $datos[$k]["dia3"]= floor(TimeUtils::workDiff1($festivos,$d->getCaFchlevante(),$d->getCaFchdespcarga()) );
            $datos[$k]["dia4"]= floor(TimeUtils::workDiff1($festivos,$d->getCaFchdespcarga(),$d->getCaFchentrcarpfacturacion() ) );
            $datos[$k]["dia5"]= floor(TimeUtils::workDiff1($festivos,$d->getCaFchentrcarpfacturacion(),$d->getCaFchfacturacion() ));
            $datos[$k]["dia6"]= floor(TimeUtils::workDiff1($festivos,$d->getCaFchdespcarga(),$d->getCaFchentrcarpfacturacion() ));
            
            $datos[$k]["lim1"]= 0;
            $datos[$k]["lim2"]= 4;
            $datos[$k]["lim3"]= 1;
            $datos[$k]["lim4"]= 1;
            $datos[$k]["lim5"]= 2;
            $datos[$k]["lim6"]= 3;
            
            if($datos[$k]["dia1"]>= 1)
            {
                $datos[$k]["ind1"]="DEMORA";
                $indicadores["ind1"]["DEMORA"]++;
            }
            else
            {
                $datos[$k]["ind1"]="CUMPLE";
                $indicadores["ind1"]["CUMPLE"]++;                
            }
            
            if($datos[$k]["dia2"]>4)
            {
                $datos[$k]["ind2"]="DEMORA";
                $indicadores["ind2"]["DEMORA"]++;
            }
            else
            {
                $datos[$k]["ind2"]="CUMPLE";
                $indicadores["ind2"]["CUMPLE"]++;                
            }
            
            if($datos[$k]["dia3"]>1)
            {
                $datos[$k]["ind3"]="DEMORA";
                $indicadores["ind3"]["DEMORA"]++;
            }
            else
            {
                $datos[$k]["ind3"]="CUMPLE";
                $indicadores["ind3"]["CUMPLE"]++;                
            }

            if($datos[$k]["dia4"]>1)
            {
                $datos[$k]["ind4"]="DEMORA";
                $indicadores["ind4"]["DEMORA"]++;
            }
            else
            {
                $datos[$k]["ind4"]="CUMPLE";
                $indicadores["ind4"]["CUMPLE"]++;                
            }

            if($datos[$k]["dia5"]>2)
            {
                $datos[$k]["ind5"]="DEMORA";
                $indicadores["ind5"]["DEMORA"]++;
            }
            else
            {
                $datos[$k]["ind5"]="CUMPLE";
                $indicadores["ind5"]["CUMPLE"]++;                
            }

            if($datos[$k]["dia6"]>3)
            {
                $datos[$k]["ind6"]="DEMORA";
                $indicadores["ind6"]["DEMORA"]++;
            }
            else
            {
                $datos[$k]["ind6"]="CUMPLE";
                $indicadores["ind6"]["CUMPLE"]++;                
            }
        }

        foreach($indicadores as $k=>$i)
        {
            $arrtmp=array();            
            $t=0;
            $arrtmp["nref"]=count($datos);
            foreach($i as $l=>$e)
            {
                $t+=$e;
                //$indicadorgrid[$k][]=array($l=>$e);
                $arrtmp[$l]=$e;
                $indicador[$k][]=array("name"=>$l,"total"=>($e==0)?"0.000000001":$e);
            }
            $indicadorgrid[$k][]=$arrtmp;
        }
        
        foreach($indicador["descripciones"]["linea"] as $k =>$d)
        {
            $descripcionesgrid[]=array("terminal"=>$k,"total_carpeta"=>$d["total"],"total_demora"=>(is_null($d["nocumple"])?"0":$d["nocumple"]),"por_demora"=>round( ($d["nocumple"]*100)/$d["total"],2 ));
        }

        $this->responseArray = array("success" => true,"datos" => $datos,
            "ind1"=>$indicador["ind1"], "indgrid1"=>$indicadorgrid["ind1"],
            "ind2"=>$indicador["ind2"], "indgrid2"=>$indicadorgrid["ind2"],
            "ind3"=>$indicador["ind3"], "indgrid3"=>$indicadorgrid["ind3"],
            "ind4"=>$indicador["ind4"], "indgrid4"=>$indicadorgrid["ind4"],
            "ind5"=>$indicador["ind5"], "indgrid5"=>$indicadorgrid["ind5"],
            "ind6"=>$indicador["ind6"], "indgrid6"=>$indicadorgrid["ind6"],
            "debug"=>$debug,
            "total"=>count($referencias));
        $this->setTemplate("responseTemplate");
    }

    public function executePaisesGraficasIndicadoresOtm(sfWebRequest $request) {
        $cliente = json_decode($request->getParameter("cliente"));

        $idscliente = Doctrine::getTable("Ids")
                ->createQuery("i")
                ->addWhere("i.ca_id = ?", $cliente)
                ->fetchOne();
        
        if ($idscliente) {
            $grupo = $idscliente->getCaIdgrupo();
            if ($grupo != "") {
                $miembrosgrupo = Doctrine::getTable("Ids")
                        ->createQuery("i")
                        ->addWhere("i.ca_idgrupo = ?", $grupo)
                        ->execute();
                $clientes = array();
                foreach ($miembrosgrupo as $miembrogrupo) {
                    $clientes[] = $miembrogrupo->getCaIdalterno();
}
            }
            $clientes[] = $cliente;


            for ($i = 0; $i < count($clientes); $i++) {
                $clientes[$i] = "'" . $clientes[$i] . "'";
            }
            $listaclientes = implode(",", $clientes);

            $filtros = json_decode($request->getParameter("filtro"));
            $transporte = $filtros->transporte;

            $filtros = json_decode($request->getParameter("filtro"));
            $transporte = utf8_decode($filtros->transporte);
            $origen = utf8_decode($filtros->origen);
            $ciudadorigen = utf8_decode($filtros->ciudadorigenopc);
            $ciudaddestino = utf8_decode($filtros->destinopc);

            $nombreorigen = Doctrine::getTable("Ciudad")->find($ciudadorigen);
            $nombredest = Doctrine::getTable("Ciudad")->find($ciudaddestino);
            
            $sql = "select ca_ciuorigen from vi_indicadoresotm WHERE ca_transporte = '$transporte' AND ca_idcliente IN ($listaclientes)";
            /*$sql = "SELECT dest.ca_ano,
                        dest.ca_mes,
                        h.ca_idcliente, 
                        ids.ca_nombre as ca_compania,
                        r.ca_idreporte, 
                        r.ca_consecutivo,
                        i.ca_origen AS ca_idorigen, 
                        t.ca_ciudad AS ca_ciuorigen, 
                        i.ca_destino AS ca_iddestino,
                        t2.ca_ciudad AS ca_ciudestino, 
                        r.ca_transporte,
                        i.ca_idmaster as ca_idmaster,	
                        i.ca_referencia as referencia,
                        (CASE WHEN i.ca_modalidad = 'DIRECTO' THEN 'FCL' ELSE I.ca_modalidad END) as modalidad,
                        i3.ca_nombre AS transportador,
                        i.ca_idlinea as idlinea,
                        h.ca_doctransporte as doctransporte,	
                        i8.ca_numhijas AS numhijas, 
                        h.ca_numpiezas as numpiezas, 
                        round(h.ca_peso) as peso,
                        h.ca_volumen as volumen,
                        (CASE WHEN i.ca_modalidad = 'LCL' THEN round((h.ca_peso/25000),3) END) as contenedorlcl, 
                        ro.ca_contenedor as contenedor,
                        ro.ca_valorfob as valorfob,
                        ro.ca_consecutivo as dtm,
                        u.ca_nombre as ca_vendedor,
                        s.ca_nombre as ca_sucursal, 
                        i.ca_motonave as ca_vehiculo,
                        bdg.ca_nombre as ca_bodega,	
                        CASE WHEN imp.ca_nombre<>NULL THEN imp.ca_nombre ELSE ids.ca_nombre END AS ca_importador,
                        ro.ca_fechafinalizacion,
                        ro.ca_fchcargue,	
                        dest1.ca_fchcontinuacion as fchllegada_cd,
                        dest.ca_fchllegada_ultsta,
                        ro.ca_fchcierre
                FROM ino.tb_house h 
                        LEFT JOIN ino.tb_master i ON i.ca_idmaster = h.ca_idmaster 
                        LEFT JOIN tb_ciudades t ON i.ca_origen = t.ca_idciudad 
                        LEFT JOIN tb_ciudades t2 ON i.ca_destino = t2.ca_idciudad 
                        LEFT JOIN ids.tb_proveedores i2 ON i.ca_idlinea = i2.ca_idproveedor 
                        LEFT JOIN ids.tb_ids i3 ON i2.ca_idproveedor = i3.ca_id 
                        LEFT JOIN tb_repotm ro ON h.ca_idreporte = ro.ca_idreporte	 
                        LEFT JOIN tb_reportes r ON r.ca_idreporte = ro.ca_idreporte 
                        RIGHT JOIN ( 
                                SELECT tb_reportes.ca_consecutivo AS ca_consecutivo_f,
                                        tb_reportes.ca_fchreporte,
                                        max(tb_reportes.ca_version) AS ca_version,
                                        min(tb_reportes.ca_fchcreado) AS ca_fchcreado
                                FROM tb_reportes
                                        WHERE tb_reportes.ca_usuanulado IS NULL AND tb_reportes.ca_tiporep = 4
                                GROUP BY tb_reportes.ca_consecutivo, tb_reportes.ca_fchreporte
                                ORDER BY tb_reportes.ca_consecutivo) rx ON r.ca_consecutivo::text = rx.ca_consecutivo_f::text AND r.ca_version = rx.ca_version
                        RIGHT JOIN (
                                SELECT date_part('year'::text, rs.ca_fchcontinuacion) AS ca_ano,
                                    to_char(rs.ca_fchcontinuacion::timestamp with time zone, 'Mon'::text) AS ca_mes,
                                    rs.ca_idreporte,
                                    sf.ca_consecutivo,
                                    rs.ca_fchllegada AS ca_fchllegada_cd,
                                    rs.ca_fchcontinuacion AS ca_fchllegada_ultsta, 
                                    rs.ca_piezas,
                                    rs.ca_peso,
                                    rs.ca_volumen,
                                    rs.ca_doctransporte,
                                    rs.ca_fchsalida AS ca_fchsalida_cd
                                FROM tb_repstatus rs		
                                        RIGHT JOIN (
                                                SELECT rp_1.ca_consecutivo, max(rs_1.ca_idstatus) AS ca_idstatus
                                                FROM tb_repstatus rs_1
                                                        JOIN tb_reportes rp_1 ON rp_1.ca_idreporte = rs_1.ca_idreporte
                                                --WHERE rp_1.ca_consecutivo = rp.ca_consecutivo
                                                GROUP BY rp_1.ca_consecutivo
                                        ) sf ON rs.ca_idstatus = sf.ca_idstatus) dest ON r.ca_consecutivo::text = dest.ca_consecutivo::text
                        
                        LEFT JOIN tb_terceros ter on ro.ca_idcliente = ter.ca_idtercero 
                        LEFT JOIN tb_terceros imp on ro.ca_idimportador = imp.ca_idtercero 
                        LEFT JOIN ids.tb_ids ids ON h.ca_idcliente = ids.ca_id 
                        LEFT JOIN tb_clientes cl ON ids.ca_id = cl.ca_idcliente 
                        LEFT JOIN control.tb_usuarios u ON cl.ca_vendedor = u.ca_login 
                        LEFT JOIN control.tb_sucursales s ON s.ca_idsucursal = u.ca_idsucursal 
                        LEFT JOIN ino.vi_costos i4 ON i.ca_idmaster = i4.ca_idmaster 
                        LEFT JOIN ino.vi_ingresos i5 ON i.ca_idmaster = i5.ca_idmaster 
                        LEFT JOIN ino.vi_deducciones i6 ON i.ca_idmaster = i6.ca_idmaster 
                        LEFT JOIN ino.vi_utilidades i7 ON i.ca_idmaster = i7.ca_idmaster 
                        LEFT JOIN ino.vi_unidades_master i8 ON i.ca_idmaster = i8.ca_idmaster 
                        LEFT JOIN ino.vi_teus i9 ON i.ca_idmaster = i9.ca_idmaster 
                        LEFT JOIN tb_bodegas bdg ON bdg.ca_idbodega = r.ca_idbodega 
                WHERE i.ca_fchanulado IS NULL AND i.ca_impoexpo = 'OTM-DTA' AND '20'||SUBSTR(i.ca_referencia,16,2) IN ('2017') and h.ca_idcliente = 900164399 $where
                ORDER BY dest.ca_fchllegada_ultsta";*/
            
            //echo $sql;
            
            if ($filtros->fecha_inicio && $filtros->fecha_fin) {
                $sql .= " AND ca_fchllegada_ultsta BETWEEN '$filtros->fecha_inicio' AND '$filtros->fecha_fin' ";
            }

            if ($nombreorigen) {
                $nombreorigen = $nombreorigen->getCaCiudad();
                $sql .= " and ca_ciuorigen= '$nombreorigen'";
            }
            if ($nombredest) {
                $nombredest = $nombredest->getCaCiudad();
                $sql .= " and ca_ciudestino= '$nombredest'";
            }
            if ($origen != "")
                $sql .= " and ca_idtrafico = '$origen'";

            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $indicadores = $st->fetchAll();

            $data = array();
            foreach ($indicadores as $indicador) {
                $origen = utf8_encode($indicador["ca_ciuorigen"]);
                if (!in_array($origen, $data))
                    $data[] = $origen;
            }
            $this->responseArray = array("paises" => $data, "success" => true);
        }else{
            $this->responseArray = array("success" => false, "errorInfo"=>"No existe");
        }
        $this->setTemplate("responseTemplate");        
    }

    
    public function executeDatosGraficasIndicadoresOtm(sfWebRequest $request){
        
          //$cliente = $this->getUser()->getClienteActivo();
        $cliente = json_decode($request->getParameter("cliente"));

        $idscliente = Doctrine::getTable("Ids")
                ->createQuery("i")
                ->addWhere("i.ca_id = ?", $cliente)
                ->fetchOne();
        
        //$clienteEmbarque = $idscliente->getIdsCliente()->getProperty("idgProveedor");        
        
        if ($idscliente) {

            $grupo = $idscliente->getCaIdgrupo();
            if ($grupo != "") {
                $miembrosgrupo = Doctrine::getTable("IdsCliente")
                        ->createQuery("i")
                        ->addWhere("i.ca_idgrupo = ?", $grupo)
                        ->execute();
                $clientes = array();
                foreach ($miembrosgrupo as $miembrogrupo) {
                    $clientes[] = $miembrogrupo->getCaIdcliente();
                }
            }
            $clientes[] = $cliente;

            for ($i = 0; $i < count($clientes); $i++) {
                $clientes[$i] = $clientes[$i];
            }
            $listaclientes = implode(",", $clientes);

            //echo $listaclientes;
            
            $filtros = json_decode($request->getParameter("filtro"));
            $transporte = $filtros->transporte;

            $filtros = json_decode($request->getParameter("filtro"));
            $transporte = utf8_decode($filtros->transporte);
            $origen = utf8_decode($filtros->origen);
            $ciudadorigen = utf8_decode($filtros->ciudadorigenopc);
            $ciudaddestino = utf8_decode($filtros->destinopc);

            $nombreorigen = Doctrine::getTable("Ciudad")->find($ciudadorigen);
            $nombredest = Doctrine::getTable("Ciudad")->find($ciudaddestino);
            
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            
            $sql = "select i.* from vi_indicadoresotm i WHERE i.ca_transporte = '$transporte' AND i.ca_idcliente IN ($listaclientes)";             
            
            if ($filtros->fecha_inicio && $filtros->fecha_fin) {
                $sql .= " AND i.ca_fchllegada_ultsta BETWEEN '$filtros->fecha_inicio' AND '$filtros->fecha_fin' ";
            }

            if ($nombreorigen) {
                $nombreorigen = $nombreorigen->getCaCiudad();
                $sql .= " and i.ca_ciuorigen= '$nombreorigen'";
            }
            if ($nombredest) {
                $nombredest = $nombredest->getCaCiudad();
                $sql .= " and i.ca_ciudestino= '$nombredest'";
            }
            if ($origen != "")
                $sql .= " and i.ca_idtrafico = '$origen'";

            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $indicadores = $st->fetchAll();
            

            $serieMes2 = array();
            $serieTraf = array();
            $datag1 = array();
            $datag1fcl = array();
            $data8 = array();
            $data3 = array();
            $data5 = array();
            $datag2 = array();
            $cumplimientos = 0;
            $a = "";
            $datacargue = array();
            $conteocoordembarque = array();
            $datagtr = array();
            $model = array();
            $datallegada = array();
            $datafacturacion = array();
            $datavaciado = array();
            $datosempresas = array();
            $serieEmpresas = array();
            /////////////////////////
            $gridvaciado = array();
            $gridfacturacion = array();
            $gridllegada = array();
            $gridcargue = array();
            $gridtransito = array();
            $gridvolumen = array();
            $gridindicadores = array();
            $gridpie = array();
            $gridembarque = array();
            $gridvolumenFCL = array();
            $pes = "-";

            foreach ($indicadores as $indicador) {
                
                $mes = Utils::getMonth(substr($indicador["ca_fchllegada_ultsta"], 5, 2));
                $trafico = utf8_encode($indicador["ca_ciuorigen"]);
                //$empresa = utf8_encode($indicador["ca_nombre"]);
                if (!in_array($mes, $serieMes2))
                    $serieMes2[] = $mes;

                if (!in_array($trafico, $serieTraf))
                    $serieTraf[] = $trafico;

                if (!in_array($empresa, $serieEmpresas))
                    $serieEmpresas[] = $empresa;

                $peso = $indicador["ca_peso"];
                $volumen = $indicador["ca_volumen"];
                /*$datosempresas[$empresa]["negociospie"] += 1;
                $datosempresas[$empresa]["namepie"] = $empresa;*/

                $gridpie[$mes]["mes"] = $mes;
                $gridpie[$mes]["peso"] += $peso;

                /* if ($mes == "Dic"){
                  $pes .= "" . $peso[0] . " + ";
                  } */

                $piezas = $indicador["ca_piezas"];

                if ($indicador["modalidad"] == "LCL"){
                    $gridvolumen[$mes]["mes"] = $mes;
                    $gridvolumen[$mes]["volumen"] += floatval($indicador["contenedorlcl"]);
                    $datag1[$mes][$trafico] += floatval($indicador["contenedorlcl"]);
                }
                if ($indicador["modalidad"] == "FCL"){
                    $gridvolumenFCL[$mes]["mes"] = $mes;
                    $gridvolumenFCL[$mes]["volumen"] += $indicador["ca_volumen"];
                    $datag1fcl[$mes][$trafico] += $indicador["ca_volumen"];                    
                }

                /*$sqltt = "";
                if ($origen != "") {
                    $sqltt = "select ca_tiempotransito conteo, ca_coord_embarque coordembarque from tb_entrega_antecedentes where ca_idtrafico = '$origen'";
                } else {
                    $sqltt = "select ca_tiempotransito conteo, ca_coord_embarque coordembarque from tb_entrega_antecedentes where 1=1 ";
                }
                if ($transporte != "" && $transporte)
                    $sqltt .= " and ca_transporte = '$transporte'";

                if ($ciudadorigen != "" && $ciudadorigen) {
                    $sqltt .= " and ca_idciudad = '$ciudadorigen'";
                } else {
                    $or = $indicador['ca_idorigen'];
                    $sqltt .= " and ca_idciudad= '$or'";
                }
                if ($ciudaddestino != "" && $ciudaddestino) {
                    $sqltt .= " and ca_iddestino= '$ciudaddestino'";
                } else {
                    $des = $indicador['ca_iddestino'];
                    $sqltt .= " and ca_iddestino= '$des'";
                }
                $datagtr[$mes][$trafico] += 1;
                $datagtr[$mes][$trafico]["cumple"] = 0;

                $st = $con->execute($sqltt);
                $conteocumplimiento = $st->fetch();

                $t = 0;
                $idtrafico = $indicador["ca_idtrafico"];
                $idorigen = $indicador["ca_idorigen"];
                $iddestino = $indicador["ca_iddestino"];

                
                $sql1 = "SELECT ca_idtrafico, ca_idciudad, ca_iddestino,  ca_tiempotransito conteo, ca_coord_embarque coordembarque "
                        . "FROM tb_entrega_antecedentes "
                        . "WHERE ca_idtrafico = '$idtrafico' AND ca_idciudad = '999-9999' AND ca_iddestino = '999-9999'";

                $st = $con->execute($sql1);
                $sqlCE = $st->fetchAll();
                
                

                if (count($sqlCE) > 0) {
                    $t = $sqlCE[0]["conteo"];
                    $r = "";
                } else {
                    $t = 0;
                }

                $sql2 = "SELECT ca_idtrafico, ca_idciudad, ca_iddestino,  ca_tiempotransito conteo, ca_coord_embarque coordembarque "
                        . "FROM tb_entrega_antecedentes "
                        . "WHERE (ca_idtrafico = '$idtrafico' AND ca_idciudad = '$idorigen' AND ca_iddestino = '$iddestino' ) OR"
                        . "(ca_idtrafico = '$idtrafico' AND ca_idciudad = '$idorigen' AND ca_iddestino = '999-9999') OR"
                        . "(ca_idtrafico = '$idtrafico' AND ca_idciudad = '999-9999' AND ca_iddestino = '$iddestino')";

                $st = $con->execute($sql2);
                $sqlCE2 = $st->fetchAll();

                if (count($sqlCE2) > 0) {
                    $t = $sqlCE2[0]["conteo"];
                    $r = "segunda opcion";
                }*/
                
                
                
                /*$idcliente = $indicador["ca_idcliente"];
                $idgTT = Doctrine::getTable("IdgClientes")
                        ->createQuery("i")
                        ->addWhere("i.ca_transporte like ?", $transporte)
                        ->addWhere("i.ca_traorigen like ?", $idtrafico)
                        ->addWhere("i.ca_ciudestino like ?", $iddestino)
                        ->addWhere("i.ca_transportista like ?", $indicador["idlinea"])
                        ->addWhere("i.ca_idcliente like ?", $idcliente)
                        ->addWhere("i.ca_periodo_inicial < ?", $indicador["ca_fchllegada_cd"])
                        ->addWhere("i.ca_periodo_final > ?", $indicador["ca_fchllegada_cd"])
                        ->fetchOne();
                if ($idgTT){
                    $jsonTT = json_decode($idgTT->getCaIndicador());
                    $metaTT = $jsonTT->tiempotransito;
                }
                else{
                    $idgTT = Doctrine::getTable("IdgClientes")
                        ->createQuery("i")
                        ->addWhere("i.ca_transporte like ?", $transporte)
                        ->addWhere("i.ca_traorigen like ?", $idtrafico)
                        ->addWhere("i.ca_ciudestino like ?", $iddestino)
                        ->addWhere("i.ca_transportista like ?", $indicador["idlinea"])
                        ->addWhere("i.ca_periodo_inicial < ?", $indicador["ca_fchllegada_cd"])
                        ->addWhere("i.ca_periodo_final > ?", $indicador["ca_fchllegada_cd"])
                        ->fetchOne();
                    if ($idgTT){
                        $jsonTT = json_decode($idgTT->getCaIndicador());
                        $metaTT = $jsonTT->tiempotransito;
                    }
                    else{
                        $metaTT  = "SIN META";
                    }
                }*/
                /*
                $idcliente = $indicador["ca_idcliente"];
                $q = Doctrine::getTable("IdgClientes")
                        ->createQuery("i")
                        ->addWhere("i.ca_transporte like ?", $transporte)
                        ->addWhere("i.ca_traorigen like ?", $idtrafico)
                        //->addWhere("i.ca_ciuorigen like ?", $idorigen)
                        ->addWhere("i.ca_ciudestino like ?", $iddestino)
                        //->addWhere("i.ca_transportista like ?", $indicador["idlinea"])
                        ->addWhere("i.ca_idcliente like ?", $idcliente)
                        ->addWhere("i.ca_periodo_inicial < ?", $indicador["ca_fchllegada_cd"])
                        ->addWhere("i.ca_periodo_final > ?", $indicador["ca_fchllegada_cd"]);                
                
                //echo $q->getSqlQuery();
                $idgTT = $q->fetchOne();
                
                        //->fetchOne();
                if ($idgTT){
                    $jsonTT = json_decode($idgTT->getCaIndicador());
                    $metaTT = $jsonTT->tiempotransito;
                }else{
                    $q1 = Doctrine::getTable("IdgClientes")
                        ->createQuery("i")
                        ->addWhere("i.ca_transporte like ?", $transporte)
                        ->addWhere("i.ca_traorigen like ?", $idtrafico)
//                        ->addWhere("i.ca_ciuorigen like ?", $idorigen)
                        ->addWhere("i.ca_ciudestino like ?", $iddestino)
                        ->addWhere("i.ca_transportista like ?", $indicador["idlinea"])
                        ->addWhere("i.ca_periodo_inicial < ?", $indicador["ca_fchllegada_cd"])
                        ->addWhere("i.ca_periodo_final > ?", $indicador["ca_fchllegada_cd"]);
                    
                    //echo $q1->getSqlQuery();
                    $idgTT = $q1->fetchOne();
                            //->fetchOne();
                    if ($idgTT){
                        $jsonTT = json_decode($idgTT->getCaIndicador());
                        $metaTT = $jsonTT->tiempotransito;
                    }
                    else{
                        $q2 = Doctrine::getTable("IdgClientes")
                        ->createQuery("i")
                        ->addWhere("i.ca_transporte like ?", $transporte)
                        ->addWhere("i.ca_traorigen like ?", $idtrafico)
//                        ->addWhere("i.ca_ciuorigen like ?", $idorigen)
                        ->addWhere("i.ca_ciudestino like ?", $iddestino)
                        //->addWhere("i.ca_transportista like ?", $indicador["idlinea"])
                        ->addWhere("i.ca_periodo_inicial < ?", $indicador["ca_fchllegada_cd"])
                        ->addWhere("i.ca_periodo_final > ?", $indicador["ca_fchllegada_cd"]);
                    
                        //echo $q1->getSqlQuery();
                        $idgTT = $q2->fetchOne();
                        if ($idgTT){
                            $jsonTT = json_decode($idgTT->getCaIndicador());
                            $metaTT = $jsonTT->tiempotransito;
                        }
                        else{
                            $metaTT = "SIN META";                    
                        }
                    }
                }  
                
                if (!$datagtr[$mes]["porcentaje"]) {
                    $datagtr[$mes]["porcentaje"] = 0;
                }
                $gridtransito[$mes]["mes"] = $mes;
                
                if ($indicador["ca_fchllegada_cd"] != "" && $indicador["ca_fchsalida_eta"] != ""){
                    $indicador["t_transito"] = (strtotime($indicador["ca_fchllegada_cd"]) - strtotime($indicador["ca_fchsalida_eta"])) / 86400;
                }
                else{
                    $indicador["t_transito"] = 0;
                }

//echo 'meta'.$metaTT.'indicadorTT'.$indicador["t_transito"]."---";
                if ( $metaTT  != "SIN META"){
                    if ($indicador["t_transito"] <= $metaTT) {
                        $cumplett = 1;
                        $datagtr[$mes]["cumplel"] += 1;
                        $gridtransito[$mes]["cumple"] += 1;
                    } else {
                        $gridtransito[$mes]["nocumple"] += 1;
                        $cumplett = 0;
                    }
                    
                }
                else{
                    $gridtransito[$mes]["nocumple"] += 1;
                    $cumplett = 0;
                }
//echo "cumplett".$cumplett;
                
                $datagtr[$mes]["totall"] += 1;*/

                // Oportunidad en el Cargue                
                $datacargue[$mes]["negocios"] += 1;
                $datacargue[$mes]["name"] = $mes;
                $gridcargue[$mes]["mes"] = $mes;                                           
                $metacargueFCL = 3;
                $metacargueLCL = 5;
                
                $festivos = TimeUtils::getFestivos();                
                $restacargue = TimeUtils::workDiff($festivos, $indicador["ca_fechafinalizacion"], $indicador["ca_fchcargue"]);                
                
                $metacargue = $indicador["modalidad"]=="FCL"?$metacargueFCL:$metacargueLCL;
                
                if ($restacargue > $metacargue){
                    $indicador["cump_cargue"] = 0;
                } else {
                    $indicador["cump_cargue"] = 1;
                }
                
                if ($indicador["cump_cargue"] == 1) {
                    $datacargue[$mes]["cumplimientocargue"] += 1;
                    $gridcargue[$mes]["cumple"] += 1;
                } else {
                    $gridcargue[$mes]["nocumple"] += 1;
                }
                $datacargue[$mes]["porcentaje"] = round(($datacargue[$mes]["cumplimientocargue"] * 100) / $datacargue[$mes]["negocios"]);                
                
                /* Oportunidad en la Confirmación de Llegada */
                $datallegada[$mes]["negocios"] += 1;
                $datallegada[$mes]["name"] = $mes;
                $gridllegada[$mes]["mes"] = $mes;
                $metallegada = 5;                
                
                $restallegada = TimeUtils::dateDiff($indicador["ca_fechafinalizacion"], $indicador["ca_fchllegada_ultsta"]);                
                
                if ($restallegada > $metallegada){
                    $indicador["cump_llegada"] = 0;
                }else{
                    $indicador["cump_llegada"] = 1;
                }
                
                if ($indicador["cump_llegada"] == 1) {
                    $datallegada[$mes]["cumplimientollegada"] += 1;
                    $gridllegada[$mes]["cumple"] += 1;
                } else {
                    $gridllegada[$mes]["nocumple"] += 1;
                }
                
                $datallegada[$mes]["porcentaje"] = round(($datallegada[$mes]["cumplimientollegada"] * 100) / $datallegada[$mes]["negocios"]);
                
                /* Oportunidad en la Presentación OTM */
                
                $datapresentacion[$mes]["negocios"] += 1;
                $datapresentacion[$mes]["name"] = $mes;
                $datapresentacion[$mes]["mes"] = $mes;
                $metapresentacion = 1;                
                
                $restapresentacion = TimeUtils::dateDiff($indicador["ca_fechafinalizacion"], $indicador["ca_fchpresentacion"]);                
                
                if ($restapresentacion > $metapresentacion){
                    $indicador["cump_presentacion"] = 0;
                }else{
                    $indicador["cump_presentacion"] = 1;
                }
                
                if ($indicador["cump_presentacion"] == 1) {
                    $datapresentacion[$mes]["cumplimientopresentacion"] += 1;
                    $gridpresentacion[$mes]["cumple"] += 1;
                } else {
                    $gridpresentacion[$mes]["nocumple"] += 1;
                }
                
                $datapresentacion[$mes]["porcentaje"] = round(($datapresentacion[$mes]["cumplimientopresentacion"] * 100) / $datapresentacion[$mes]["negocios"]);
                
                /* Oportunidad en el Cierre */
                
                $datacierre[$mes]["negocios"] += 1;
                $datacierre[$mes]["name"] = $mes;
                $datacierre[$mes]["mes"] = $mes;
                $metacierre = 1;                
                
                $restacierre = TimeUtils::dateDiff($indicador["ca_fchllegada_ultsta"], $indicador["ca_fchcierre"]);                
                
                if ($restacierre > $metacierre){
                    $indicador["cump_cierre"] = 0;
                }else{
                    $indicador["cump_cierre"] = 1;
                }
                
                if ($indicador["cump_cierre"] == 1) {
                    $datacierre[$mes]["cumplimientocierre"] += 1;
                    $gridcierre[$mes]["cumple"] += 1;
                } else {
                    $gridcierre[$mes]["nocumple"] += 1;
                }
                
                $datacierre[$mes]["porcentaje"] = round(($datacierre[$mes]["cumplimientocierre"] * 100) / $datacierre[$mes]["negocios"]);

                /*$datafacturacion[$mes]["negocios"] += 1;
                $datafacturacion[$mes]["name"] = $mes;

                $gridfacturacion[$mes]["mes"] = $mes;

                $anio = explode("-", $filtros->fecha_inicio);
                $anio = $anio[0];
                $festivos = TimeUtils::getFestivos($anio);
                if($indicador["ca_fchllegada_cd"]==$indicador["ca_fchfactura"]){
                    $diffFchAsn = 0;
                }else{
                $diffFchAsn = TimeUtils::workDiff($festivos, $indicador["ca_fchllegada_cd"], $indicador["ca_fchfactura"]);
                }

                //Notas: Para a?reo son 2 d?as despu?s que llega la carga.(Facturacion)
                if ($transporte == Constantes::AEREO){
                    $meta = 2;                    
                }
                else{
                    $idcliente = $indicador["ca_idcliente"];
                    $idgclienteFact = Doctrine::getTable("IdgClientes")
                            ->createQuery("i")
                            ->addWhere("i.ca_transporte like ?", $transporte)
                            ->addWhere("i.ca_traorigen like ?", $idtrafico)
                            ->addWhere("i.ca_idcliente like ?", $idcliente)
                            ->addWhere("i.ca_periodo_inicial < ?", $indicador["ca_fchllegada_cd"])
                            ->addWhere("i.ca_periodo_final > ?", $indicador["ca_fchllegada_cd"])
                            ->fetchOne();
                    if ($idgclienteFact){
                        $jsonf = json_decode($idgclienteFact->getCaIndicador());
                        $meta = $jsonf->idgfacturacion;
                    }
                    else{
                        $meta = 0; // Maximo el mismo día que llega la carga
                    }
                }

                if ($diffFchAsn <= $meta) {
                        $cf = 1;
                        $datafacturacion[$mes]["cumplimientollegada"] += 1;
                        $gridfacturacion[$mes]["cumple"] += 1;
                    } else {
                        $cf = 0;
                        $gridfacturacion[$mes]["nocumple"] += 1;
                    }
                    $datafacturacion[$mes]["porcentaje"] = round(($datafacturacion[$mes]["cumplimientollegada"] * 100) / $datafacturacion[$mes]["negocios"]);

                $metav = 0;
                if ($indicador["modalidad"] == "LCL" || $indicador["mod"] == "COLOADING") {
                    
                    if ($indicador["mod"] == "COLOADING"){
                        $metav = 3;
                    }
                    else{                        
                        $caso = "CU268";
                        $muelle = ParametroTable::retrieveByCaso($caso, null, null, $indicador["idmuelle"]);
                        if ($muelle){
                            $nombremuelle = $muelle[0]["ca_valor"];                            
                        }
                        $idgclienteVac = Doctrine::getTable("IdgClientes")
                                ->createQuery("i")
                                ->addWhere("i.ca_transporte like ?", $transporte)
                                ->addWhere("i.ca_ciudestino like ?", $iddestino)
                                ->addWhere("i.ca_periodo_inicial < ?", $indicador["ca_fchllegada_cd"])
                                ->addWhere("i.ca_periodo_final > ?", $indicador["ca_fchllegada_cd"])
                                ->addWhere("i.ca_muelle like ?", $indicador["idmuelle"])
                                ->fetchOne();
                        if($idgclienteVac){
                            $jsonv = json_decode($idgclienteVac->getCaIndicador());
                            $metav = $jsonv->idgvaciado;
                        }
                        else{
                            $metav = 2;
                        }                        
                    }
                    
                    $datavaciado[$mes]["negocios"] += 1; 
                    $datavaciado[$mes]["name"] = $mes;
                    $gridvaciado[$mes]["mes"] = $mes;
                    
                    if ($indicador["ca_fchvaciado"] == "" || $indicador["ca_fchllegada_cd"] == ""){
                        $restavaciado = 0;
                    }
                    else{
                        $restavaciado = (strtotime($indicador["ca_fchvaciado"]) - strtotime($indicador["ca_fchllegada_cd"])) / 86400;
                    }

                    if ($restavaciado <= $metav){
                        $indicador["cump_vaciado"] = 1;
                    }
                    else{
                        $indicador["cump_vaciado"] = 0;
                    }
                    
                    if ($indicador["cump_vaciado"] == 1) {
                        $datavaciado[$mes]["cumplimientollegada"] += 1;
                        $gridvaciado[$mes]["cumple"] += 1;
                    } else {
                        $gridvaciado[$mes]["nocumple"] += 1;
                    }
                    $datavaciado[$mes]["porcentaje"] = round(($datavaciado[$mes]["cumplimientollegada"] * 100) / $datavaciado[$mes]["negocios"]);
                }

                $cumplevaciado = "0";
                if ($indicador["modalidad"] == "LCL" && $indicador["cump_vaciado"] != "")
                    $cumplevaciado = "1";*/
                
                                   
                $reporteneg = Doctrine::getTable("Reporte")->find($indicador["ca_idreporte"]);
                    
                if ($reporteneg){
                    $obscargue = $reporteneg->getProperty("idg7");
                    $obsllegadaotm = $reporteneg->getProperty("idg8");
                    $obspresentacion = $reporteneg->getProperty("idg9");
                    $obscierre = $reporteneg->getProperty("idg10");
                    
                }
                
                $gridindicadores[] = array(
                    "obscargue" => utf8_encode($obscargue),
                    "obsllegadaotm" => utf8_encode($obsllegadaotm),
                    "obspresentacion" => utf8_encode($obspresentacion),
                    "obscierre" => utf8_encode($obscierre),
                    
                    "anio" => utf8_encode($indicador["ca_ano"]),
                    "mes" => utf8_encode($mes),
                    "empresa" => utf8_encode($indicador["ca_compania"]),
                    "reporte" => utf8_encode($indicador["ca_idreporte"]),
                    "consecutivo" => utf8_encode($indicador["ca_consecutivo"]),
                    //"orden" => utf8_encode($indicador["ca_orden_clie"]),
                    "doctransporte" => utf8_encode($indicador["doctransporte"]),
                    "ciuorigen" => utf8_encode($indicador["ca_ciuorigen"]),
                    "destino" => utf8_encode($indicador["ca_ciudestino"]),
                    "transportador" => utf8_encode($indicador["transportador"]),
                    //"cido" => utf8_encode($indicador["ca_ciuorigen"]),
                    "modalidad" => utf8_encode($indicador["modalidad"]),
                    "piezas" => utf8_encode($piezas),
                    "peso" => utf8_encode($peso),
                    //"muelle"=>  utf8_encode($nombremuelle),
                    "volumen" => floatval($volumen),
                    "contenedorlcl" => utf8_encode($indicador["ca_contenedorlcl"]),
                    //"proveedor" => $proovedor,
                    //"fch_salida" => utf8_encode($indicador["ca_fchsalida_cd"]),
                    "fch_llegadaotm" => utf8_encode($indicador["ca_fchllegada_ultsta"]),
                    "fch_finalizacion" => utf8_encode($indicador["ca_fechafinalizacion"]),
                    "fch_presentacion" => $indicador["ca_fechafinalizacion"]    ,
                    "fch_cargue" => utf8_encode($indicador["ca_fchcargue"]),
                    "fch_cierre" => utf8_encode($indicador["ca_fchcierre"]),
                    /*"fch_factura" => utf8_encode($indicador["ca_fchfactura"]),
                    "fch_vaciado" => utf8_encode($indicador["ca_fchvaciado"]),
                    "fch_disponible" => utf8_encode($indicador["carga_disponible"]),
                    "cumplett" => $cumplett,
                    "cumplezarpe" => utf8_encode($indicador["cump_cargue"]),
                    "cumplellegada" => utf8_encode($indicador["cump_llegada"]),
                    "cumplefacturacion" => utf8_encode($cf),
                    "cumplevaciado" => utf8_encode($indicador["cump_vaciado"]),
                    "cumplecoor" => utf8_encode($cumpleco),*/
                    "metacargue" => utf8_encode($metacargue),
                    "metallegadaotm" => $metallegada,
                    "metapresentacion" => $metapresentacion,
                    "metacierre" => $metacierre,
                    /*"metavaciado" => utf8_encode($metav),
                    "metafacturacion" => utf8_encode($meta),
                    "metatransito" => utf8_encode($metaTT),*/
                    "idgcargue" => $restacargue,
                    "idgllegadaotm" => $restallegada,
                    "idgpresentacion" => $restapresentacion,
                    "idgcierre" => $restacierre
                    /*"idgvaciado" => utf8_encode($restavaciado),
                    "idgtiempotransito" => utf8_encode($indicador["t_transito"]),
                    "idgfacturacion" => utf8_encode($diffFchAsn),                    
                    "restazarpe" => $restazarpe*/
                );
            }

            foreach ($serieTraf as $traf) {
                $model["name"] = $traf;
            }

            foreach ($datag1 as $mes => $gridTrafico) {
                foreach ($serieTraf as $trafico) {
                
                   
                        if ($gridTrafico[$trafico]) {
                            $data5[$mes]["name"] = $mes;
                            $data5[$mes][$trafico] = $gridTrafico[$trafico];
                        } else {
                            $data5[$mes]["name"] = $mes;
                            $data5[$mes][$trafico] = null;
                        }
                    
                }
            }
            
            /*foreach ($datag1fcl as $mes => $gridTrafico) {
                foreach ($serieTraf as $trafico) {
                    if ($gridTrafico[$trafico]) {
                        $data8[$mes]["name"] = $mes;
                        $data8[$mes][$trafico] = $gridTrafico[$trafico];
                    } else {
                        $data8[$mes]["name"] = $mes;
                        $data8[$mes][$trafico] = null;
                    }
                }
            }

            foreach ($gridemba as $mes => $emb) {
                $gridembarque[] = $emb;
            }*/
            foreach ($data5 as $mes => $gridSerie) {
                $data4[] = $gridSerie;
            }
            /*foreach ($data8 as $mes => $gridSerie) {
                $datosFCL[] = $gridSerie;
            }

            $datat = array();
            $modelgrafica2 = array();
            foreach ($serieTraf as $trafico) {
                $modelgrafica2[] = array("name" => $trafico, "type" => "integer");
            }
            $modelgrafica2[] = array("name" => "name", "type" => "string");
            $modelgrafica2[] = array("name" => "porcentaje", "type" => "integer");

            foreach ($datagtr as $mes => $gridTrafico) {
                foreach ($serieTraf as $trafico) {

                    if ($gridTrafico[$trafico]) {
                        $datat[$mes]["name"] = $mes;
                        $datat[$mes][$trafico] = $gridTrafico[$trafico];
                        $datat[$mes]["porc"] += $gridTrafico[$trafico];
                    } else {
                        $datat[$mes]["name"] = $mes;
                        $datat[$mes][$trafico] = null;
                    }
                }

                $datat[$mes]["porcentaje"] = round((($datagtr[$mes]["cumplel"] * 100) / $datagtr[$mes]["totall"]), 2);
            }
            $datostransito = array();
            foreach ($datat as $traf => $negocios) {
                $datostransito[] = $negocios;
            }
            $coorembarque = array();
            foreach ($datacoord as $traf => $em) {
                $em['porcentaje'] = round(($em["cumple"] * 100 ) / $em["negocios"], 1);
                $coorembarque[] = $em;
            }*/

            $cargue = array();
            foreach ($datacargue as $traf => $zar) {
                $cargue[] = $zar;
            }
            $llegadaotm = array();
            foreach ($datallegada as $traf => $lleg) {
                $llegadaotm[] = $lleg;
            }
            
            $presentacion = array();
            foreach ($datapresentacion as $traf => $pre) {
                $presentacion[] = $pre;
            }
            
            $cierre = array();
            foreach ($datacierre as $traf => $cie) {
                $cierre[] = $cie;
            }
            /*$facturacion = array();
            foreach ($datafacturacion as $traf => $fact) {
                $facturacion[] = $fact;
            }
            $vaciado = array();
            foreach ($datavaciado as $traf => $vac) {
                $vaciado[] = $vac;
            }
            $empresas = array();
            foreach ($datosempresas as $emp => $neg) {
                $empresas[] = $neg;
            }
            $datosvaciado = array();
            foreach ($gridvaciado as $va => $datos) {
                $datosvaciado[] = $datos;
            }
            $datosfacturacion = array();
            foreach ($gridfacturacion as $fa => $datosf) {
                $datosfacturacion[] = $datosf;
            }
            $datosllegada = array();
            foreach ($gridllegada as $lle => $datosll) {
                $datosllegada[] = $datosll;
            }
            $datoszarpe = array();
            foreach ($gridcargue as $za => $datosza) {
                $datoszarpe[] = $datosza;
            }
            $datostransit = array();
            foreach ($gridtransito as $tr => $datostr) {
                $datostransit[] = $datostr;
            }
            $datosvolumen = array();
            foreach ($gridvolumen as $vl => $datosvl) {
                $datosvolumen[] = $datosvl;
            }
            
            $datosvolumenFCL = array();
            foreach ($gridvolumenFCL as $vl => $datosvl) {
                $datosvolumenFCL[] = $datosvl;
            }
            
            $datospie = array();
            foreach ($gridpie as $dp => $datosp) {
                $datospie[] = $datosp;
            }*/
        }
        
        $this->responseArray = array(
            "success" => true,
            "root" => $data4,
            /*"datosFCL" => $datosFCL,*/
            "y" => $serieTraf,
            /*"modelgrafica2" => $modelgrafica2,
            "grafica2" => $datostransito,*/
            "cargue" => $cargue,
            "llegadaotm" => $llegadaotm,
            "presentacion" => $presentacion,
            "cierre" => $cierre,
            /*"facturacion" => $facturacion,
            "vaciado" => $vaciado,
            "datospie" => $datospie,
            "model" => $model,
            "gridvaciado" => $datosvaciado,
            "gridfacturacion" => $datosfacturacion,
            "gridllegada" => $datosllegada,
            "gridzarpe" => $datoszarpe,
            "gridtransito" => $datostransit,
            "gridvolumen" => $datosvolumen,
            "gridvolumenFCL" => $datosvolumenFCL,*/
            "datosgrid" => $gridindicadores/*,
            "griddatoscumplimiento" => $griddatoscumplimiento,
            "gridpie" => $datospie,
            "proveedores" => $proovedores,
            "coordembarque" => $coorembarque,
            "gridembarque" => $gridembarque,
            "clienteEmbarque"=>$clienteEmbarque*/
        );
        $this->setTemplate("responseTemplate");
    }	

    public function executeDatosConceptosContenedores(sfWebRequest $request){
		$transporte = utf8_encode($request->getParameter("idtransporte"));
		$modalidad = utf8_encode($request->getParameter("idimpoexpo"));

	        $q = Doctrine_Query::create()
                ->select("c.ca_idconcepto, c.ca_concepto, c.ca_transporte, c.ca_modalidad, c.ca_liminferior")
                ->from("Concepto c")
                ->addWhere("c.ca_transporte=?", $transporte)
                ->addWhere("c.ca_modalidad=?", Constantes::FCL)
                ->addOrderBy("c.ca_liminferior")
                ->addOrderBy("c.ca_concepto");

		$q->fetchArray();

		$conceptos = $q->execute();

		$data = array();
		foreach ($conceptos as $concepto) {
		    $data[] = array("idconcepto" => $concepto['ca_idconcepto'],
		        "concepto" => utf8_encode($concepto['ca_concepto']),
		        "transporte" => utf8_encode($concepto['ca_transporte']),
		        "modalidad" => utf8_encode($concepto['ca_modalidad'])
		    );
		}
		$this->responseArray = array("success"=> true, "root" => $data);
		$this->setTemplate("responseTemplate");
	    }
            
            
    public function executeDatosContactos(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");

        $cliente = Doctrine::getTable("Cliente")->find($idcliente);
        $contactos = $cliente->getContacto();

        $data = array();
        foreach ($contactos as $contacto) {
            $data[] = array("id" => $contacto->getCaIdcontacto(),
                "name" => utf8_encode(strtoupper($contacto->getNombre())));
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executePaisesGraficasIndicadores(sfWebRequest $request) {
        $cliente = json_decode($request->getParameter("cliente"));

        $idscliente = Doctrine::getTable("Ids")
                ->createQuery("i")
                ->addWhere("i.ca_id = ?", $cliente)
                ->fetchOne();
        
        if ($idscliente) {
            $grupo = $idscliente->getCaIdgrupo();
            if ($grupo != "") {
                $miembrosgrupo = Doctrine::getTable("Ids")
                        ->createQuery("i")
                        ->addWhere("i.ca_idgrupo = ?", $grupo)
                        ->execute();
                $clientes = array();
                foreach ($miembrosgrupo as $miembrogrupo) {
                    $clientes[] = $miembrogrupo->getCaIdalterno();
                }
            }
            $clientes[] = $cliente;


            for ($i = 0; $i < count($clientes); $i++) {
                $clientes[$i] = "'" . $clientes[$i] . "'";
            }
            $listaclientes = implode(",", $clientes);

            $filtros = json_decode($request->getParameter("filtro"));
            $transporte = $filtros->transporte;

            $filtros = json_decode($request->getParameter("filtro"));
            $transporte = utf8_decode($filtros->transporte);
            $origen = utf8_decode($filtros->origen);
            $ciudadorigen = utf8_decode($filtros->ciudadorigenopc);
            $ciudaddestino = utf8_decode($filtros->destinopc);

            $nombreorigen = Doctrine::getTable("Ciudad")->find($ciudadorigen);
            $nombredest = Doctrine::getTable("Ciudad")->find($ciudaddestino);

            $sql = "select ca_traorigen from vi_indicadores WHERE ca_transporte = '$transporte' AND ca_idcliente IN ($listaclientes)";
            if ($filtros->fecha_inicio && $filtros->fecha_fin) {
                $sql .= " AND ca_fchllegada_cd BETWEEN '$filtros->fecha_inicio' AND '$filtros->fecha_fin' ";
            }

            if ($nombreorigen) {
                $nombreorigen = $nombreorigen->getCaCiudad();
                $sql .= " and ca_ciuorigen= '$nombreorigen'";
            }
            if ($nombredest) {
                $nombredest = $nombredest->getCaCiudad();
                $sql .= " and ca_ciudestino= '$nombredest'";
            }
            if ($origen != "")
                $sql .= " and ca_idtrafico = '$origen'";

            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $indicadores = $st->fetchAll();

            $data = array();
            foreach ($indicadores as $indicador) {
                $trafico = utf8_encode($indicador["ca_traorigen"]);
                if (!in_array($trafico, $data))
                    $data[] = $trafico;
            }
            $this->responseArray = array("paises" => $data, "success" => true);
        }else{
            $this->responseArray = array("success" => false, "errorInfo"=>"No existe");
        }
        $this->setTemplate("responseTemplate");        
    }

    public function executeDatosParametrizacionIdgClientes(sfWebRequest $request) {
        $idgs = Doctrine::getTable("Idgclientes")
                ->createQuery("i")
                //->addWhere("t.ca_aplicacion = ? ", "Proveedores")
                //->addOrderBy("t.ca_nombre")
                ->execute();
        $data = array();
        foreach ($idgs as $idg) {
            $nombrecliente = "";
            $nombretransportista = "";
            $nombretraficoorigen = "";
            $nombreciudaddestino = "";
            $nombremuelle = "";
            $nombretraficodestino = "";
            $nombreciudadorigen = "";
            $categoria = "";
            $idcategoria = "";
            
            $indicadores = json_decode($idg->getCaIndicador());
            if ($idg->getCaIdcliente() != " "){
                $cliente = Doctrine::getTable("Ids")->find($idg->getCaIdcliente());
                if ($cliente){
                    $nombrecliente = $cliente->getCaNombre();
                }
            }
            if ($idg->getCaTransportista() != " "){
                $transportista = Doctrine::getTable("IdsProveedor")->find($idg->getCaTransportista());
                if ($transportista){
                    $nombretransportista = $transportista->getIds()->getCaNombre();
                }
            }
            if ($idg->getCaTradestino() != " "){
                $traficodestino = Doctrine::getTable("Trafico")->find($idg->getCaTradestino());
                if ($traficodestino){
                    $nombretraficodestino = $traficodestino->getCaNombre();
                }
            }
             if ($idg->getCaTraorigen() != " "){
                $traficoorigen = Doctrine::getTable("Trafico")->find($idg->getCaTraorigen());
                if ($traficoorigen){
                    $nombretraficoorigen = $traficoorigen->getCaNombre();
                }
            }
            if ($idg->getCaCiudestino() != " "){
                $ciudaddestino = Doctrine::getTable("Ciudad")->find($idg->getCaCiudestino());
                if ($ciudaddestino){
                    $nombreciudaddestino = $ciudaddestino->getCaCiudad();
                }
            }
            if ($idg->getCaCiuorigen() != " "){
                $ciudadorigen = Doctrine::getTable("Ciudad")->find($idg->getCaCiuorigen());
                if ($ciudadorigen){
                    $nombreciudadorigen = $ciudadorigen->getCaCiudad();
                }
            }
            if ($idg->getCaMuelle() != " "){
                $caso = "CU268";
                $muelle = ParametroTable::retrieveByCaso($caso, null, null, $idg->getCaMuelle());
                if ($muelle){
                    $nombremuelle = $muelle[0]["ca_valor"];
                    $idmuelle = $muelle[0]["ca_identificacion"];
                }
            }
            
            $days = 0;

            if ($indicadores->idgvaciado && $indicadores->idgvaciado != ""){
                $categoria = "Vaciado";
                $idcategoria = 1;
                $days = $indicadores->idgvaciado;
            }
            if ($indicadores->idgfacturacion && $indicadores->idgfacturacion != ""){
                $categoria = "Facturacion";
                $idcategoria = 2;
                $days = $indicadores->idgfacturacion;
            }
            if ($indicadores->tiempotransito && $indicadores->tiempotransito != ""){
                $categoria = "Tiempo de Transito";
                $idcategoria = 3;
                $days = $indicadores->tiempotransito;
            }
            if ($indicadores->coordinacion && $indicadores->coordinacion != ""){
                $categoria = "Coord. de Embarque";
                $idcategoria = 4;
                $days = $indicadores->coordinacion;
            }
            
            $data[] = array(
                "consecutivo" => utf8_encode($idg->getCaConsecutivo()),
                "transporte" => utf8_encode($idg->getCaTransporte()),
                "origen" => utf8_encode($nombretraficoorigen),
                "destino" => utf8_encode($nombreciudaddestino),
                "ciudadorigen" => utf8_encode($nombreciudadorigen),
                "traficodestino" => utf8_encode($nombretraficodestino),
                "transportista" => utf8_encode($nombretransportista),
                "cliente" => utf8_encode($nombrecliente),
                "periodo_inicial" => utf8_encode($idg->getCaPeriodoInicial()),
                "periodo_final" => utf8_encode($idg->getCaPeriodoFinal()),
                "vaciado" => utf8_encode($indicadores->idgvaciado),
                "facturacion" => utf8_encode($indicadores->idgfacturacion),
                "tiempotransito" => utf8_encode($indicadores->tiempotransito),
                "coordinacion" => utf8_encode($indicadores->coordinacion),
                "muelle" => utf8_encode($nombremuelle),
                "idmuelle" => utf8_encode($idmuelle),
                "categoria" => utf8_encode($categoria),
                "idcategoria" => utf8_encode($idcategoria),
                "idciudestino" => utf8_encode($idg->getCaCiudestino()),
                "dias" => utf8_encode($days)
                
            );
            
        }
        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarIdgCliente(sfWebRequest $request) {
        $tipo = $request->getParameter("tipo");
        $transporte = ($request->getParameter("transporte") && $request->getParameter("transporte") != "") ? utf8_decode($request->getParameter("transporte")) : " ";
        $origen = ($request->getParameter("origen") && $request->getParameter("origen") != "") ? utf8_decode($request->getParameter("origen")) : " ";
        $destino = ($request->getParameter("destino") && $request->getParameter("destino") != "") ? utf8_decode($request->getParameter("destino")) : " ";
        $transportista = ($request->getParameter("transportista") && $request->getParameter("transportista") != "") ? utf8_decode($request->getParameter("transportista")) : " ";
        $idcliente = ($request->getParameter("cliente") && $request->getParameter("cliente") != "") ? utf8_decode($request->getParameter("cliente")) : " ";
        $periodo_inicial = ($request->getParameter("f_inicio") && $request->getParameter("f_inicio") != "") ? utf8_decode($request->getParameter("f_inicio")) : " ";
        $periodo_final = ($request->getParameter("f_fin") && $request->getParameter("f_fin") != "") ? utf8_decode($request->getParameter("f_fin")) : " ";
        $muelle = ($request->getParameter("muelle") && $request->getParameter("muelle") != "") ? utf8_decode($request->getParameter("muelle")) : " ";
        $ciudadorigen = ($request->getParameter("ciudadorigen") && $request->getParameter("ciudadorigen") != "") ? utf8_decode($request->getParameter("ciudadorigen")) : " ";
        $traficodestino = " ";
        if ($destino != " "){
            $trafico = Doctrine::getTable("Ciudad")->find($destino);
            $traficodestino = $trafico->getCaIdtrafico();
        }
        if ($tipo == "vaciado") {
            $dias = $request->getParameter("dias");
            $idgClientes = Doctrine::getTable("IdgClientes")
                    ->createQuery("i")
                    ->addWhere("i.ca_transporte like ? ", $transporte)
                    ->addWhere("i.ca_traorigen like ? ", $origen)
                    ->addWhere("i.ca_ciudestino like ? ", $destino)
                    ->addWhere("i.ca_transportista like ? ", $transportista)
                    ->addWhere("i.ca_idcliente like ? ", $idcliente)
                    ->addWhere("i.ca_muelle like ?", $muelle)
                    ->addWhere("i.ca_tradestino like ? ", $traficodestino)
                    ->addWhere("i.ca_ciuorigen like ? ", $ciudadorigen)
                    ->execute();
            if (count($idgClientes) > 0) {
                $todaslasfechas = array();
                foreach ($idgClientes as $idgCliente) {
                    $finicIDG = strtotime($idgCliente->getCaPeriodoInicial());
                    $ffinIDG = strtotime($idgCliente->getCaPeriodoFinal());
                    
                    $todaslasfechas[] = date('Y-m-d',$finicIDG);
                    while ($finicIDG < $ffinIDG){
                        $finicIDG += 86400; // add 24 hours
                        $todaslasfechas[] = date('Y-m-d',$finicIDG);
                    }
                }
                $finiForm = $periodo_inicial;
                $ffinForm = $periodo_final;
                
                for($i = 0; $i < count($todaslasfechas); $i++ ){
                    if (( $finiForm == $todaslasfechas[$i]) || ( $ffinForm == $todaslasfechas[$i])){
                        $error = 1;
                    }
                }
                
                if ($error == 1){
                    $this->responseArray = array("success" => false , "messagge" => "Ya existe un campo similar en este periodo");
                }
                else{
                    $idgCliente = new Idgclientes();
                    $idgCliente->setCaTransporte($transporte);
                    $idgCliente->setCaTraorigen($origen);
                    $idgCliente->setCaCiudestino($destino);
                    $idgCliente->setCaTransportista($transportista);
                    $idgCliente->setCaIdcliente($idcliente);
                    $idgCliente->setCaPeriodoInicial($periodo_inicial);
                    $idgCliente->setCaPeriodoFinal($periodo_final);
                    $idgCliente->setCaMuelle($muelle);
                    $idgCliente->setCaTradestino($traficodestino);
                    $idgCliente->setCaCiuorigen($ciudadorigen);
                    $json = array('idgvaciado' => $dias);
                    $json = json_encode($json);
                    $idgCliente->setCaIndicador($json);
                    $idgCliente->save();
                    $this->responseArray = array("success" => true);
                }
                
            } else {
                $idgCliente = new Idgclientes();
                $idgCliente->setCaTransporte($transporte);
                $idgCliente->setCaTraorigen($origen);
                $idgCliente->setCaCiudestino($destino);
                $idgCliente->setCaTransportista($transportista);
                $idgCliente->setCaIdcliente($idcliente);
                $idgCliente->setCaPeriodoInicial($periodo_inicial);
                $idgCliente->setCaPeriodoFinal($periodo_final);
                $idgCliente->setCaMuelle($muelle);
                $idgCliente->setCaTradestino($traficodestino);
                $idgCliente->setCaCiuorigen($ciudadorigen);
                $json = array('idgvaciado' => $dias);
                $json = json_encode($json);
                $idgCliente->setCaIndicador($json);
                $idgCliente->save();
                $this->responseArray = array("success" => true);
            }
        }
        if($tipo == "facturacion"){
            $dias = $request->getParameter("dias");
            $idgClientes = Doctrine::getTable("IdgClientes")
                    ->createQuery("i")
                    ->addWhere("i.ca_transporte like ? ", $transporte)
                    ->addWhere("i.ca_traorigen like ? ", $origen)
                    ->addWhere("i.ca_ciudestino like ? ", $destino)
                    ->addWhere("i.ca_transportista like ? ", $transportista)
                    ->addWhere("i.ca_idcliente like ? ", $idcliente)
                    ->addWhere("i.ca_muelle like ?", $muelle)
                    ->addWhere("i.ca_tradestino like ? ", $traficodestino)
                    ->addWhere("i.ca_ciuorigen like ? ", $ciudadorigen)
                      ->execute();
                    if (count($idgClientes) > 0) {
                        $todaslasfechas = array();
                        foreach ($idgClientes as $idgCliente) {
                            $finicIDG = strtotime($idgCliente->getCaPeriodoInicial());
                            $ffinIDG = strtotime($idgCliente->getCaPeriodoFinal());

                            $todaslasfechas[] = date('Y-m-d',$finicIDG);
                            while ($finicIDG < $ffinIDG){
                                $finicIDG += 86400; // add 24 hours
                                $todaslasfechas[] = date('Y-m-d',$finicIDG);
                            }
                        }
                        $finiForm = $periodo_inicial;
                        $ffinForm = $periodo_final;

                        for($i = 0; $i < count($todaslasfechas); $i++ ){
                            if (( $finiForm == $todaslasfechas[$i]) || ( $ffinForm == $todaslasfechas[$i])){
                                $error = 1;
                            }
                        }
                
                        if ($error == 1){
                            $this->responseArray = array("success" => false , "messagge" => "Ya existe un campo similar en este periodo");
                        }
                else{
                    $idgCliente = new Idgclientes();
                    $idgCliente->setCaTransporte($transporte);
                    $idgCliente->setCaTraorigen($origen);
                    $idgCliente->setCaCiudestino($destino);
                    $idgCliente->setCaTransportista($transportista);
                    $idgCliente->setCaIdcliente($idcliente);
                    $idgCliente->setCaPeriodoInicial($periodo_inicial);
                    $idgCliente->setCaPeriodoFinal($periodo_final);
                    $idgCliente->setCaMuelle($muelle);
                    $idgCliente->setCaTradestino($traficodestino);
                    $idgCliente->setCaCiuorigen($ciudadorigen);
                    $json = array('idgfacturacion' => $dias);
                    $json = json_encode($json);
                    $idgCliente->setCaIndicador($json);
                    $idgCliente->save();
                    $this->responseArray = array("success" => true);
                }
            } else {
                $idgCliente = new Idgclientes();
                $idgCliente->setCaTransporte($transporte);
                $idgCliente->setCaTraorigen($origen);
                $idgCliente->setCaCiudestino($destino);
                $idgCliente->setCaTransportista($transportista);
                $idgCliente->setCaIdcliente($idcliente);
                $idgCliente->setCaPeriodoInicial($periodo_inicial);
                $idgCliente->setCaPeriodoFinal($periodo_final);
                $idgCliente->setCaMuelle($muelle);
                $idgCliente->setCaCiuorigen($ciudadorigen);
                $idgCliente->setCaTradestino($traficodestino);
                $json = array('idgfacturacion' => $dias);
                $json = json_encode($json);
                $idgCliente->setCaIndicador($json);
                $idgCliente->save();
                $this->responseArray = array("success" => true);
            }
        }
        if($tipo == "tiempotransito"){
            $dias = $request->getParameter("dias");
            $idgClientes = Doctrine::getTable("IdgClientes")
                    ->createQuery("i")
                    ->addWhere("i.ca_transporte like ? ", $transporte)
                    ->addWhere("i.ca_traorigen like ? ", $origen)
                    ->addWhere("i.ca_ciudestino like ? ", $destino)
                    ->addWhere("i.ca_transportista like ? ", $transportista)
                    ->addWhere("i.ca_idcliente like ? ", $idcliente)
                    ->addWhere("i.ca_muelle like ?", $muelle)
                    ->addWhere("i.ca_tradestino like ? ", $traficodestino)
                    ->addWhere("i.ca_ciuorigen like ? ", $ciudadorigen)
                     ->execute();
            if (count($idgClientes) > 0) {
                        $todaslasfechas = array();
                        foreach ($idgClientes as $idgCliente) {
                            $finicIDG = strtotime($idgCliente->getCaPeriodoInicial());
                            $ffinIDG = strtotime($idgCliente->getCaPeriodoFinal());

                            $todaslasfechas[] = date('Y-m-d',$finicIDG);
                            while ($finicIDG < $ffinIDG){
                                $finicIDG += 86400; // add 24 hours
                                $todaslasfechas[] = date('Y-m-d',$finicIDG);
                            }
                        }
                        $finiForm = $periodo_inicial;
                        $ffinForm = $periodo_final;

                        for($i = 0; $i < count($todaslasfechas); $i++ ){
                            if (( $finiForm == $todaslasfechas[$i]) || ( $ffinForm == $todaslasfechas[$i])){
                                $error = 1;
                            }
                        }
                
                        if ($error == 1){
                            $this->responseArray = array("success" => false , "messagge" => "Ya existe un campo similar en este periodo");
                        }
                else{
                    $idgCliente = new Idgclientes();
                    $idgCliente->setCaTransporte($transporte);
                    $idgCliente->setCatraorigen($origen);
                    $idgCliente->setCaCiudestino($destino);
                    $idgCliente->setCaTransportista($transportista);
                    $idgCliente->setCaIdcliente($idcliente);
                    $idgCliente->setCaPeriodoInicial($periodo_inicial);
                    $idgCliente->setCaPeriodoFinal($periodo_final);
                    $idgCliente->setCaMuelle($muelle);
                    $idgCliente->setCaTradestino($traficodestino);
                    $idgCliente->setCaCiuorigen($ciudadorigen);
                    $json = array('tiempotransito' => $dias);
                    $json = json_encode($json);
                    $idgCliente->setCaIndicador($json);
                    $idgCliente->save();
                    $this->responseArray = array("success" => true);
                }
            } else {
                $idgCliente = new Idgclientes();
                $idgCliente->setCaTransporte($transporte);
                $idgCliente->setCaTraorigen($origen);
                $idgCliente->setCaCiudestino($destino);
                $idgCliente->setCaTransportista($transportista);
                $idgCliente->setCaIdcliente($idcliente);
                $idgCliente->setCaPeriodoInicial($periodo_inicial);
                $idgCliente->setCaPeriodoFinal($periodo_final);
                $idgCliente->setCaMuelle($muelle);
                $json = array('tiempotransito' => $dias);
                $json = json_encode($json);
                $idgCliente->setCaIndicador($json);
                $idgCliente->setCaCiuorigen($ciudadorigen);
                $idgCliente->setCaTradestino($traficodestino);
                $idgCliente->save();
                $this->responseArray = array("success" => true);
            }
        }
        if ( $tipo == "coordinacion"){
            $dias = $request->getParameter("dias");
            $idgClientes = Doctrine::getTable("IdgClientes")
                    ->createQuery("i")
                    ->addWhere("i.ca_transporte like ? ", $transporte)
                    ->addWhere("i.ca_traorigen like ? ", $origen)
                    ->addWhere("i.ca_ciudestino like ? ", $destino)
                    ->addWhere("i.ca_transportista like ? ", $transportista)
                    ->addWhere("i.ca_idcliente like ? ", $idcliente)
                    ->addWhere("i.ca_muelle like ?", $muelle)
                    ->addWhere("i.ca_tradestino like ? ", $traficodestino)
                    ->addWhere("i.ca_ciuorigen like ? ", $ciudadorigen)
                    ->execute();
            
           // print_r(count($idgClientes));
           // exit;
            
            if (count($idgClientes) > 0) {
                        $todaslasfechas = array();
                        foreach ($idgClientes as $idgCliente) {
                            $finicIDG = strtotime($idgCliente->getCaPeriodoInicial());
                            $ffinIDG = strtotime($idgCliente->getCaPeriodoFinal());

                            $todaslasfechas[] = date('Y-m-d',$finicIDG);
                            while ($finicIDG < $ffinIDG){
                                $finicIDG += 86400; // add 24 hours
                                $todaslasfechas[] = date('Y-m-d',$finicIDG);
                            }
                        }
                        $finiForm = $periodo_inicial;
                        $ffinForm = $periodo_final;

                        for($i = 0; $i < count($todaslasfechas); $i++ ){
                            if (( $finiForm == $todaslasfechas[$i]) || ( $ffinForm == $todaslasfechas[$i])){
                                $error = 1;
                            }
                        }
                
                        if ($error == 1){
                            $this->responseArray = array("success" => false , "messagge" => "Ya existe un campo similar en este periodo");
                        }
                else{
                    $idgCliente = new Idgclientes();
                    $idgCliente->setCaTransporte($transporte);
                    $idgCliente->setCaTraorigen($origen);
                    $idgCliente->setCaCiudestino($destino);
                    $idgCliente->setCaTransportista($transportista);
                    $idgCliente->setCaIdcliente($idcliente);
                    $idgCliente->setCaPeriodoInicial($periodo_inicial);
                    $idgCliente->setCaPeriodoFinal($periodo_final);
                    $idgCliente->setCaMuelle($muelle);
                    $idgCliente->setCaTradestino($traficodestino);
                    $idgCliente->setCaCiuorigen($ciudadorigen);
                    $json = array('coordinacion' => $dias);
                    $json = json_encode($json);
                    $idgCliente->setCaIndicador($json);
                    $idgCliente->save();
                    $this->responseArray = array("success" => true);
                }
            } else {
                $idgCliente = new Idgclientes();
                $idgCliente->setCaTransporte($transporte);
                $idgCliente->setCaTraorigen($origen);
                $idgCliente->setCaCiudestino($destino);
                $idgCliente->setCaTransportista($transportista);
                $idgCliente->setCaIdcliente($idcliente);
                $idgCliente->setCaPeriodoInicial($periodo_inicial);
                $idgCliente->setCaPeriodoFinal($periodo_final);
                $idgCliente->setCaMuelle($muelle);
                $idgCliente->setCaTradestino($traficodestino);
                $idgCliente->setCaCiuorigen($ciudadorigen);
                $json = array('coordinacion' => $dias);
                $json = json_encode($json);
                $idgCliente->setCaIndicador($json);
                $idgCliente->save();
                $this->responseArray = array("success" => true);
            }
        }
        $this->setTemplate("responseTemplate");
        
    }
    
    public function executeHtmlBienvenida(sfWebRequest $request) {
        
    }

}

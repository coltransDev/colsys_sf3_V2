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

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
  
    public function executeIndexExt5(sfWebRequest $request) {

    }


    function executeDatosIndex($request) {
        $idopcion = ($request->getParameter("node") != "" && $request->getParameter("node") != "root") ? $request->getParameter("node") : "0";
        $tree = array("text" => "Opciones","leaf" => true,"id" => "1");
        
        if($idopcion==0)
        {
            $childrens[] = array("text" => "Cuadro Matriz","leaf" => true,"id" => "1");            
            $childrens[] = array("text" => "Indicadores","leaf" => true,"id" => "2");            
            $childrens1[] = array("text" => "Generador","leaf" => true,"id" => "3");
            //$childrens1[] = array("text" => "Costos","leaf" => true,"id" => "4");
            //$childrens1[] = array("text" => "T. nacionalizacion","leaf" => true,"id" => "4");
            //$childrens1[] = array("text" => "Frec. Inspeccion","leaf" => true,"id" => "5");
            $childrens[] = array("text" => "Estadisticas","leaf" => false,"children"=>$childrens1);
            
            $childrensAdmin[] = array("text" => "Fechas de cierre","leaf" => true,"id" => "4");
            $childrensAdmin[] = array("text" => utf8_encode("Admin. Plantillas"),"leaf" => true,"id" => "5");
            $childrens[] = array("text" => utf8_encode("Administración"),"leaf" => false,"children"=>$childrensAdmin);

            
        }
        $tree["children"] = $childrens;
        
        $this->responseArray = $tree;
        $this->setTemplate("responseTemplate");
    }



    public function executeGuardarArchivoControl( sfWebRequest $request  ){
        
        //$file=sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';
                
        
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Shared/String.php';
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Reader/Excel5.php';
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Shared/OLERead.php';
        
        
        //include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Autoloader.php';
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel.php';
        include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';

        if ($request->isMethod('post')){
            $file = $_FILES["archivo"];
            //print_r($file);
            //exit;
            if($file["tmp_name"])
            {                
                $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . "falaadu" . DIRECTORY_SEPARATOR;
                
                $fileName = $file['name'];
                $existe=true;
                $con=0;

                while($existe)
                {
                    $con++;
                    if(file_exists($directory . $fileName))
                    {
                        $info = pathinfo($directory.$fileName);
                        $fileName =  basename($directory.$fileName,'.'.$info['extension']);
                        $fileName=$fileName.$con.".".$info['extension'];
                    }
                    else
                        $existe=false;
                }
                
                //echo $directory . $fileName;
                if (move_uploaded_file($file['tmp_name'], $directory . $fileName)) {
                    
                    //$objReader = new PHPExcel_Reader_Excel5();
                    //$objPHPExcel = $objReader->load($directory . $fileName);
                    $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . "falaadu" . DIRECTORY_SEPARATOR;
                    //echo PHPEXCEL_ROOT;
                    $objPHPExcel = PHPExcel_IOFactory::load($directory.$fileName);
                    //exit;
                    $hojas=array();
                    foreach($objPHPExcel->getSheetNames() as $s)
                    {
                        $hojas[]=array("name"=>$s);
                    }
                    
                    $this->responseArray = array("id" => base64_encode($fileName), "fileName" => $fileName, "fecha" => $fecha, "hojas"=>$hojas ,"success" => true);
                    
                    
                } else {
                    $this->responseArray = array("error" => "No se pudo mover el archivo", "filename" => $fileName, "folder" => $folder, "success" => false);
                }
            }
            else
            {
                $fileName=$request->getParameter("fileName");
            }
        }    
        
        $this->setTemplate("responseTemplate");
    }
    
    
    public function executeProcesarArchivoControl( sfWebRequest $request  ){
        
        $fileName = $request->getParameter("fileName");
        $hoja = $request->getParameter("hoja");
        $muelle = $request->getParameter("muelle");
        $fecha = $request->getParameter("fecha");
        $idcliente="900204182";//ARAUCO
        
        //include '/home/maquinche/Desarrollo/colsys_sf3/plugins/sfPhpEcxelPlugin/Classes/PHPExcel/IOFactory.php';
        include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';
        
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . "falaadu" . DIRECTORY_SEPARATOR;
        $objPHPExcel = PHPExcel_IOFactory::load($directory.$fileName);
        
        $ws = $objPHPExcel->getSheetByName($hoja);

        $array = $ws->toArray();
        
        $cab = new AduIndCabControl();
        $conn = $cab->getTable()->getConnection();
        $conn->beginTransaction();
        //try
        {
            //echo "<pre>";print_r($array);echo "</pre>";
            //exit;
            
            foreach( $array as $pos=>$row ){
                $datos=array();
                if($pos==0)
                {
                    $cab=new AduIndCabControl();
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
                            ->where("c.ca_idcliente=?","900204182")
                            ->orderBy("d.ca_orden");
                            //->execute();
                            //->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                        $debug=$q->getSqlQuery();
                        //echo $debug;
                        //exit;
                    $templates=$q->execute();
                    $columnas=$columnasDatos=array();
                    foreach($templates as $t)
                    {
                        if($t->getCaUbicacion())
                            $columnas[$t->getCaNombrejson()]=$t->getCaOrden();
                        else
                        {
                            $columnasDatos[$t->getCaNombre()]=array($t->getCaOrden(),$t->getCaNombrejson());
                        }
                    }
                }

                if( $pos < 3 || $row[$columnas["ca_referencia"]]==""  ){
                    continue;
                }
                
                $det= new AduIndDetControl();                
                foreach($columnas as $k=>$c)
                {

                    if(strpos($k, "fch")!==false)
                    {
                        $row[$c]=Utils::transformDate1(trim($row[$c]));
                    }

                    $det->set($k, trim($row[$c]));                    
                }
                
                foreach($columnasDatos as $k=>$c)
                {
                    $datos[$c[1]]=$row[$c[0]];
                }
                $det->setCaDatos(json_encode($datos));
                
                $det->setCaIdIndCabControl($cab->getCaIdIndCabControl());
                $det->save($conn);
            }

        
            $conn->commit();
            $success=true;
        }
        /*catch(Exception $e)
        {
            $error=$e->getmessage();
            $success=false;
        }*/
        //exit;
        
        $this->responseArray = array("id" => base64_encode($fileName), "fileName" => $fileName,  "hojas"=>$hoja ,"success" => $success,"error"=>$error);
        $this->setTemplate("responseTemplate");
    }
    

    public function executeConsultaCabControl( sfWebRequest $request  ){
        
        
        $q = Doctrine::getTable("AduIndCabControl")
                            ->createQuery("c")
                            ->select("*")                            
                             //->where("SUBSTR(ca_cod::TEXT,1,2)=? and ca_idempresa=?  ",array($ccosto->getCaCentro().$ccosto->getCaSubcentro() , $ccosto->getCaIdempresa()) )
                            ->addOrderBy( "c.ca_fchcreado desc" )
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

            $debug=$q->getSqlQuery();
        
        $datos=$q->execute();

        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos),"debug"=>$debug);
        $this->setTemplate("responseTemplate");
        
    }
    
    
    public function executeDatosDetControl( sfWebRequest $request  ){

        $idcabcontrol = $request->getParameter("idcabcontrol");
        $parametros="";
        
        if($request->getParameter("parametros"))
            $parametros = json_decode($request->getParameter("parametros"));
        
        
        $q = Doctrine::getTable("AduIndDetControl")
                            ->createQuery("c")
                            ->select("c.*,f.ca_fecha,f.ca_muelle")
                            ->innerJoin("c.AduIndCabControl f")
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
        if($idcabcontrol!="")
        {
            $q->addWhere("ca_id_ind_cab_control=?  ",$idcabcontrol );
            $q->addOrderBy( "c.ca_id_ind_det_control " );
        }
        
        if($parametros!="")
        {
            foreach($parametros->filtros as $f)
            {
                //echo "<pre>";print_r($filtro);echo "</pre>";
                //foreach($filtro as $f)
                {
                    //echo "<pre>";print_r($f);echo "</pre>";
                
                    if($f->name!="" && $f->operador!="" && $f->valor!="")
                        $q->addWhere($f->name.$f->operador."'".$f->valor."'" );
                    //echo $f->id.$f->operador.$f->valor;
                }
            }            
        }

        $debug=$q->getSqlQuery();
        //exit($debug);
        $datos=$q->execute();
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

        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos),"debug"=>$debug);
        $this->setTemplate("responseTemplate");
        
    }
    
    
    public function executeDatosPie( sfWebRequest $request  ){

        $datos=array();
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
                            ->addOrderBy( "c.ca_id_ind_det_control " )
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
        if($fecha1!="" && $fecha2!="")
        {
            $q->addWhere("c.ca_fchlevante BETWEEN ? AND ?  ",  array($fecha1,$fecha2) );
        }
        
        if($eta1!="" && $eta2!="")
        {
            $q->addWhere("c.ca_fcheta BETWEEN ? AND ?  ",  array($eta1,$eta2) );
        }

        $debug=$q->getSqlQuery();
        $datos=$q->execute();
        $festivos = TimeUtils::getFestivos(date("Y"));
        $sum_diashab=0;
        $prom_diashab=0;
        $sum_diaseta=0;
        $prom_diaseta=0;
        $consolidadosnc=array();
        
        $festivos = TimeUtils::getFestivos(date("Y"));
        $tmpRef=array();
        foreach($datos as $k=>$c)
        {

            $datos[$k]["dias1"]=(TimeUtils::workDiff($festivos,$c["c_ca_fcheta"],$c["c_ca_fchlevante"]));
            
            if($c["c_ca_inspeccion"]=="SI")
            {
                $ndias=4;                
            }
            else
            {
                $ndias=3;
            }
            if($datos[$k]["dias1"]>$ndias)
            {
                $indicadores["indicador1"][$c["c_ca_inspeccion"]]["nocumple"][$c["c_ca_referencia"]]=$c["c_ca_referencia"];
            }
            else
                $indicadores["indicador1"][$c["c_ca_inspeccion"]]["cumple"][$c["c_ca_referencia"]]=$c["c_ca_referencia"];
            
            //$indicadores["indicador4"][$c["c_ca_inspeccion"]][$c["c_ca_referencia"]]=$c["c_ca_referencia"];
            if(!in_array($c["c_ca_referencia"],$tmpRef ))
            {
                $indicadores["indicador4"]["tipo"][$c["c_ca_inspeccion"]][$datos[$k]["dias1"]]++;
                $indicadores["indicador4"]["dias"][$datos[$k]["dias1"]][$c["c_ca_inspeccion"]]++;
            }
            
            
            
            $fechasultimodoc=array($c["c_ca_fchbl"],$c["c_ca_fchrecibo"],$c["c_ca_fchaprobacionrim"], $c["c_ca_fchfletes"], $c["c_ca_fchinspeccion"]);
            $fechatmp=$fechasultimodoc[0];
            for($cont=1;$cont<$fechasultimododoc;$cont++)
            {
                $fechatmp=(Utils::compararFechas($fechatmp,$fechasultimododoc[$cont])==1)?$fechatmp:$fechasultimododoc[$cont];
            }
            $datos[$k]["ultimodoc"]=$fechatmp;
            $datos[$k]["dias2"]=(TimeUtils::workDiff($festivos,$fechatmp,$c["c_ca_fcheta"]));            
            $datos[$k]["dias3"]=(TimeUtils::workDiff($festivos,$c["c_ca_fchlevante"],$c["c_ca_fchplanillas"]));
            
            
            
            if($datos[$k]["dias3"]>1)
            {
                $indicadores["indicador3"][$c["c_ca_inspeccion"]]["nocumple"][$c["c_ca_referencia"]]=$c["c_ca_referencia"];
            }
            else
                $indicadores["indicador3"][$c["c_ca_inspeccion"]]["cumple"][$c["c_ca_referencia"]]=$c["c_ca_referencia"];
            
            
            
            
            //echo "<pre>";print_r($c);echo "</pre>";            
            $datosJson=  json_decode($c["c_ca_datos"]);
            //$contenedores[$c["c_ca_referencia"]][$datosJson->N]=$datosJson->O;
            if(!in_array($c["c_ca_referencia"],$tmpRef ))
            {
                $indicadores["contenedores"][$c["c_ca_terminal"]]+=$datosJson->O;//Q.CONT
            
                $indicadores["contenedores"][$c["c_ca_terminal"]]+=$datosJson->O;//Q.CONT
                $indicadores["contenedores1"][substr($c["c_ca_fcheta"], 0, 7)]+=$datosJson->O;
                //$c["c_ca_fcheta"]
                $tmpRef[]=$c["c_ca_referencia"];
            }
            
            $indicadores["total"]["contenedores"]+=$datosJson->O;//Q.CONT
            $indicadores["referencias"]["numeros"][$c["c_ca_referencia"]]=$c["c_ca_referencia"];
            $indicadores["referencias"]["muelles"][$c["c_ca_terminal"]][$c["c_ca_referencia"]]=$c["c_ca_referencia"];
            $indicadores["declaraciones"]["tipodim"][$c["c_ca_tipodim"]][$c["c_ca_referencia"]]=$c["c_ca_referencia"];//TIPO DIM
            $indicadores["declaraciones"]["muelle"][$c["c_ca_terminal"]][$c["c_ca_tipodim"]][$c["c_ca_referencia"]]=$c["c_ca_referencia"];//TIPO DIM
            
            $indicadores["declaracionesinsp"][$c["c_ca_inspeccion"]]["tipodim"][$c["c_ca_tipodim"]][$c["c_ca_referencia"]]=$c["c_ca_referencia"];//TIPO DIM
            $indicadores["declaracionesinsp"][$c["c_ca_inspeccion"]]["muelle"][$c["c_ca_terminal"]][$c["c_ca_tipodim"]][$c["c_ca_referencia"]]=$c["c_ca_referencia"];
        }

        // CONTENEDORES
        foreach($indicadores["referencias"]["muelles"] as $k=>$r )
        {            
            $indicadores["total"]["referencias"][$k]=count($r);
            $indicadores["total"]["referencias"]["t"]+=count($r);
        }

        $contenedores=$cont=$refs=null;
        foreach($indicadores["contenedores"] as $k=>$c)
        {
            $cont[$k]=$c;
        }
        $contenedores[]=array_merge(array("tipo"=>"Contenedores"),$cont);
        
        foreach($indicadores["referencias"]["muelles"] as $k=>$c)
        {
            $do[$k]=count($c);
        }
        $contenedores[]=  array_merge(array("tipo"=>"do"),$do);

        foreach($indicadores["contenedores"] as $k=>$c)
        {
            $contenedoresgrid[]=array(
                "terminal"=>$k,
                "contenedor"=>$c,
                "por_contenedor"=>round(($c*100)/$indicadores["total"]["contenedores"]),
                "referencias"=>$indicadores["total"]["referencias"][$k],
                "por_referencias"=>round(($indicadores["total"]["referencias"][$k]*100)/$indicadores["total"]["referencias"]["t"],2)
            );
        }
        
        foreach($indicadores["contenedores1"] as $k=>$r )
        {
            $indicador5[]=array("indicador"=>"$k","total"=>$r );
        }
        $tmp=null;
        foreach($indicadores["contenedores1"] as $periodo=>$r )
        {
            //foreach($r as $tipodim=>$d )
            {
                $tmp[$periodo]=$r;
            }
            
        }
        $indicador5grid[]= $tmp;
        
        //TIPO DIM
        foreach($indicadores["declaraciones"]["tipodim"] as $k=>$r )
        {
            $declaraciones[]=array("indicador"=>$k,"total"=>count($r) );            
        }
        
        foreach($indicadores["declaraciones"]["muelle"] as $muelle=>$r )
        {
            foreach($r as $tipodim=>$d )
            {
                $tmp[$tipodim]=count($d);
            }
            $declaracionesgrid[]= array_merge(array("TERMINAL"=>$muelle),$tmp);
        }
        
        $tmp=null;
        $conta=0;
        
        foreach($indicadores["declaracionesinsp"] as $insp=>$d)
        {
            $tipo=($insp=="NO"?"SIN ICA":"CON ICA");
            
            foreach($d["tipodim"] as $tipodim=>$e )
            {
                $tmp[$tipodim]=count($e);
            }
            $declaracionesinsp[]= array_merge(array("tipo"=>$tipo),$tmp);
            
            
            foreach($d["muelle"] as $muelle=>$e )
            {
                
                foreach($e as $tipodim=>$f)
                {
                    $tmp1[$tipodim]=count($f);
                }
                
                $declaracionesinspgrid[]=array_merge(array("TIPO"=>$tipo,"TERMINAL"=>$muelle),$tmp1);
                $tmp1=null;            
            
            }            
        }
        $tmp=null;
        foreach($indicadores["indicador1"] as $insp=>$d)
        {
            $tipo=($insp=="NO"?"SIN ICA":"CON ICA");
            
            //foreach($d["tipodim"] as $tipodim=>$e )
            {
                $tmp["Cumple"]=count($d["cumple"]);
                $tmp["No cumple"]=count($d["nocumple"]);
            }
            $indicador1[]= array_merge(array("tipo"=>$tipo),$tmp);
            $indicador1grid[]=array_merge(array("TIPO"=>$tipo),$tmp);

        }
        
        $tmp=null;
        foreach($indicadores["indicador3"] as $insp=>$d)
        {
            $tipo=($insp=="NO"?"SIN ICA":"CON ICA");
            
            //foreach($d["tipodim"] as $tipodim=>$e )
            {
                $tmp["Cumple"]=count($d["cumple"]);
                $tmp["No cumple"]=count($d["nocumple"]);
            }
            $indicador3[]= array_merge(array("tipo"=>$tipo),$tmp);
            $indicador3grid[]=array_merge(array("TIPO"=>$tipo),$tmp);
        }
        
        
        ksort($indicadores["indicador4"]["dias"]);
        $dkey=array_keys($indicadores["indicador4"]["dias"]);
        
        foreach($indicadores["indicador4"]["tipo"] as $insp=>$d)
        {
            $tmp=null;
            $tipo=($insp=="NO"?"SIN ICA":"CON ICA");

            foreach ($dkey as $dia)
            {
                $tmp["DIA ".$dia]=(isset($d[$dia])?$d[$dia]:0);
            }
            /*foreach($d as $ndiastmp=>$e )
            {
                $tmp["DIA ".$ndiastmp]=$e;
                //$tmp["No cumple"]=count($d["nocumple"]);
            }*/
            //$indicador4[$tipo]= $tmp;
            $indicador4[]= array_merge(array("tipo"=>$tipo),$tmp);
            //$indicador4grid[]=array_merge(array("TIPO"=>$tipo),$tmp);
        }
        
        
        //foreach($indicadores["indicador4"]["dias"] as $ndiastmp=>$d)
        $inspeccion=array("SI","NO");
        foreach ($dkey as $ndiastmp)
        {
            //echo "<pre>";print_r($indicadores["indicador4"]["dias"][$ndiastmp]);echo "</pre>";
            $d=isset($indicadores["indicador4"]["dias"][$ndiastmp])?$indicadores["indicador4"]["dias"][$ndiastmp]:array("SI"=>0,"NO"=>0);
            //echo "<pre>";print_r($d);echo "</pre>";
            $tmp=null;
            //foreach($d as $insp=>$e )
            /*foreach($inspeccion as $inps)
            {
                //echo ".".$inps.".<br>";
                $tipo=(($insp=="NO")?"SIN ICA":"CON ICA");                
                $tmp[$tipo]=(($d[$inps]!="")?$d[$inps]:0);
                //$tmp["No cumple"]=count($d["nocumple"]);
            }*/
            $tmp["SIN ICA"]=(($d["NO"]!="")?$d["NO"]:0);
            $tmp["CON ICA"]=(($d["SI"]!="")?$d["SI"]:0);
            //echo "<pre>";print_r($tmp);echo "</pre>";
            //$indicador4[$tipo]= $tmp;
            $indicador4grid[]= array_merge(array("DIA"=>$ndiastmp),$tmp);
            //$indicador4grid[]=array_merge(array("TIPO"=>$tipo),$tmp);
        }
        //$indicador4grid[]=array_merge(array("DIA"=>"1","SIN ICA"=>5,"CON ICA"=>33));
        //$indicador4grid[]=array_merge(array("DIA"=>"2","SIN ICA"=>62,"CON ICA"=>20));
        //$indicadores["indicador4"][$c["c_ca_inspeccion"]][$ndias]++;
        
        
        
        
        
        $this->responseArray = array("success" => true,"datos" => $datos,
            "contenedores"=>$contenedores,"contenedoresgrid"=>$contenedoresgrid,
            "declaraciones"=>$declaraciones,"declaracionesgrid"=>$declaracionesgrid,            
            "declaracionesinsp"=>$declaracionesinsp,"declaracionesinspgrid"=>$declaracionesinspgrid,
            "indicador1"=>$indicador1,"indicador1grid"=>$indicador1grid,
            "indicador3"=>$indicador3,"indicador3grid"=>$indicador3grid,
            "indicador4"=>$indicador4,"indicador4grid"=>$indicador4grid,
            "indicador5"=>$indicador5,"indicador5grid"=>$indicador5grid,
            "debug"=>$debug);
        //$this->responseArray = array("success" => true, "indicador"=>$indicador, "muelles"=>$count_values, "consolidados"=>$consolidados,"containers"=>$containers,"nacionalizaciongrid"=>$nacionalizaciongrid);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosGrafica( sfWebRequest $request  ){
        
        //$datos = $request->getParameter("datos");
        
        $datos = json_decode($request->getParameter("datos"));
        
        $this->responseArray = array("success" => true, "root" => $datos);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeGenReporte(sfWebRequest $request){
        
        
        $q = Doctrine::getTable("AduIndDetControl")
            ->createQuery("c")
            ->select("c.*,f.ca_fecha,f.ca_muelle")
            ->innerJoin("c.AduIndCabControl f") 
            //->where("ca_fchlevante BETWEEN ? AND ?  ",  array($fecha1,$fecha2) )
            ->addOrderBy( "c.ca_id_ind_det_control " )
            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
        
        $this->responseArray = array("success" => true);
        $this->setTemplate("responseTemplate");        
    }
    
    public function executeDatosFacturacion(sfWebRequest $request)
    {
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
                            ->addOrderBy( "c.ca_referencia,ic.ca_idcosto " )
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
                if($fecha1!="" && $fecha2!="")
        {
            $q->addWhere("ca_fchlevante BETWEEN ? AND ?  ",  array($fecha1,$fecha2) );
        }
        
        if($eta1!="" && $eta2!="")
        {
            $q->addWhere("f.ca_fecha BETWEEN ? AND ?  ",  array($eta1,$eta2) );
        }

        $debug=$q->getSqlQuery();
        $datos=$q->execute();
        //echo "<pre>";print_r($datos);echo "</pre>";
        $columnas=array();
        $columnas["zreferencia"]=array("name"=>"Do","dataindex"=>"zreferencia","summaryType"=>'count');
        foreach($datos as $d)
        {            
            $datosJson[$d["c_ca_referencia"]][$d["ic_ca_idcosto"]]=array("costo"=>$d["ic_ca_idcosto"],"neta"=>$d["ic_ca_neta"],"venta"=>$d["ic_ca_venta"]);
            if(!isset($columnas[$d["ic_ca_idcosto"]]))
            {
                $columnas["z".$d["ic_ca_idcosto"]]=array("name"=>utf8_encode($d["cos_ca_costo"]),"dataindex"=>"z".$d["ic_ca_idcosto"],"summaryType"=>'sum');
            }
        }
        $columnas["zpropio"]=array("name"=>"Propio","dataindex"=>"zpropio","summaryType"=>'sum');
        $columnas["ztercero"]=array("name"=>"Tercero","dataindex"=>"ztercero","summaryType"=>'sum');
        //echo "<pre>";print_r($columnas);echo "</pre>";
        $datos=array();
        
        foreach($datosJson as $r=>$d)
        {
            $costo=null;            
            $costo["zreferencia"]=$r;
            foreach($d as $c)
            {
                if($c["neta"]>0)
                {
                    $costo["z".$c["costo"]]=round(($c["neta"]!="")?$c["neta"]:"0");                    
                    $costo["ztercero"]+=round($costo["z".$c["costo"]]);
                }
                else
                {
                    $costo["z".$c["costo"]]=round(($c["venta"]!="")?$c["venta"]:"0");
                    $costo["zpropio"]+=round($costo["z".$c["costo"]]);
                }
            }
            //echo "<pre>";print_r($costo);echo "</pre>";
            $datos[]=$costo;
        }
        
        //echo "<pre>";print_r($columnas);echo "</pre>";

        $this->responseArray = array("success" => true, "datos" => $datos, "columnas" =>$columnas ,"total" => count($datosJson),"debug"=>$debug);
        //$this->responseArray = array("success" => true, "indicador"=>$indicador, "muelles"=>$count_values, "consolidados"=>$consolidados,"containers"=>$containers,"nacionalizaciongrid"=>$nacionalizaciongrid);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeEliminarCabControl(sfWebRequest $request)
    {
        $id = $request->getParameter("id");
        $success=true;
        $errorInfo="";
        try{
            Doctrine_Query::create()
                ->delete()
                ->from("AduIndCabControl c")
                ->where("c.ca_id_ind_cab_control = ? ", array($id))
                ->execute();            
        }catch(Exception $e)
        {
            $success=false;
            $errorInfo=$e->getMessage();
        }
        $this->responseArray = array("success" => $success,"errorInfo"=>$errorInfo);
        $this->setTemplate("responseTemplate");
    }
    
    
    
    //napuentes
    
    public function executeDatosGridFechaCierre(sfWebRequest $request) {
        
        $idcliente=$request->getParameter("idcliente");
        $q = Doctrine::getTable("AduFechaCierre")
                            ->createQuery("s")
                            ->select("s.ca_id_fecha_cierre,s.ca_fecha_cierre,s.ca_idcliente, c.ca_compania")
                            ->innerjoin("s.Cliente c")
                            ->addOrderBy( "s.ca_fecha_cierre desc" )
                            //->limit($request->getParameter("limit"))
                            ->limit(15)
                            ->offset($request->getParameter("start"))
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                            if($idcliente){
                                $q->Where("s.ca_idcliente= ?",$idcliente);
                            }
        $debug=$q->getSqlQuery();
        $datos=$q->execute();
        $c=Doctrine::getTable("AduFechaCierre")
                            ->createQuery("s")
                            ->select("count(*)")
                            ->where("s.ca_idcliente= ?",$idcliente/*,$request->getParameter("ca_idcliente")*/) 
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $debug=$c->getSqlQuery();
        
        $totalc=$c->execute();

        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos),"totalC"=>$totalc,"debug"=>$debug);
        $this->setTemplate("responseTemplate");
        
    }
    public function executeGuardarGridFechas ( $request){ 
        
        $datos = $request->getParameter("datos");        
        $fechas = json_decode($datos);
        $ids = array();

        foreach($fechas as  $c)
        { 
            $error = "";
            try{

                $fecha= Doctrine::getTable("AduFechaCierre")->find($c->ca_id_fecha_cierre);                    
                if(!$fecha)
                {
                    $fecha= new AduFechaCierre();
                    $fecha->setCaIdcliente($c->ca_idcliente);
                }

                if ($c->ca_fecha_cierre!=null) {
                    $fecha->setCaFechaCierre($c->ca_fecha_cierre);
                } else {
                    $error = "Fecha";

                }
                $fechaInvalida = Doctrine::getTable("AduFechaCierre")->find($dato->s_ca_fecha_cierre);
                if($fechaInvalida){
                   $error = "FechaExiste";
                }else{
                   $fecha->save();
                   $ids[] = $c->id;
                   $this->responseArray = array("errorInfo" => '', "id" => implode(",", $ids), "success" => true);
               }
            }catch (Exception $e){
                if($error="Fecha" or $error="FechaExiste"){
                    $errorInfo.="Error: Fecha Invalida".$e->getMessage();
                }else{
                   $errorInfo.="Error" . utf8_encode($c->item) . ": " . $error . " " . utf8_encode($e->getMessage()) . "<br>";
                }
            }
        }

        $this->setTemplate("responseTemplate");
    }
    public function executeEliminarGridFechas(sfWebRequest $request){
        
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);               
        $ids = array();
        $i=0;        
         
        foreach($datos as $dato){
            $i++;
            $AduFechaCierre = Doctrine::getTable("AduFechaCierre")->find($dato->s_ca_id_fecha_cierre);
            if($AduFechaCierre){
                $AduFechaCierre->delete();
            }            
            $ids[] = $dato->id;
        }         
        $this->responseArray = array("success" => true ,"ids" => $ids ,"count" => $i);   
        $this->setTemplate("responseTemplate");
    } 
        
        
        //metodos 
    
    public function executeDatosGridCabPlantilla($request){
        
            
        $idcliente=$request->getParameter("idcliente");
        $q = Doctrine::getTable("AduCabPlantilla")
                            ->createQuery("s")
                            ->select("s.ca_id_cab_plantilla,s.ca_idcliente,s.ca_estado, c.ca_nombres")
                            ->innerjoin("s.Cliente c")
                            ->addOrderBy( "s.ca_id_cab_plantilla asc" )
                            ->limit(5)
                            ->offset($request->getParameter("start"))
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                            if($idcliente){
                                $q->Where("s.ca_idcliente= ?",$idcliente);
                            }
        $debug=$q->getSqlQuery();
        
        $datos=$q->execute();   
        
        $c=Doctrine::getTable("AduCabPlantilla")
                            ->createQuery("s")
                            ->select ("count(*)")
                            ->where("s.ca_idcliente= ?",$idcliente) 
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $debug=$c->getSqlQuery();
        
        $totalc=$c->execute();

        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos),"totalC"=>$totalc,"debug"=>$debug);
        $this->setTemplate("responseTemplate");
        
        
    }
    public function executeDatosGridDetPlantilla(sfWebRequest $request,$request){
        $cab=$request->getParameter("id_cab_plantilla");
        
         $q = Doctrine::getTable("AduDetPlantilla")
                            ->createQuery("s")
                            ->select("*")
                            ->innerjoin("s.AduCabPlantilla c")
                            ->addOrderBy( "s.ca_orden" )
                            //->limit(20)
                            //->offset($request->getParameter("start"))
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                            if($cab){
                            $q->Where("s.ca_id_cab_plantilla= ?",$cab);
                            }
        $debug=$q->getSqlQuery();
        
        $datos=$q->execute();   
        
        $c=Doctrine::getTable("AduDetPlantilla")
                            ->createQuery("s")
                            ->select("count(*)")
                            ->where("s.ca_id_cab_plantilla= ?",$cab) 
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $debug=$c->getSqlQuery();
        
        $totalc=$c->execute();

        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos),"totalC"=>$totalc,"debug"=>$debug,"idCab"=>$cab);
        $this->setTemplate("responseTemplate");
        
    }

    public function executeGuardarCabPlantilla($request){
    
        $datos = $request->getParameter("datos");        
        $cabs = json_decode($datos);
        $ids = array();
        foreach($cabs as  $c)
        {
            try{
                $cab= Doctrine::getTable("AduCabPlantilla")->find($c->ca_id_cab_plantilla);                    
                if(!$cab){
                    $cab= new AduCabPlantilla();
                    $cab->setCaIdcliente($c->ca_idcliente);
                }
                $cab->setCaEstado($c->ca_estado);
                $cab->save();
                $ids[] = $c->id;
                $this->responseArray = array("errorInfo" => '', "id" => implode(",", $ids), "success" => true);
            }   
            catch (Exception $e){
                 $errorInfo.= $e->getMessage()."<br>";
            }
        }
        $this->setTemplate("responseTemplate");
    }
    public function executeGuardarDetPlantilla(sfWebRequest $request) {
       // $cab=$request->getParameter("id_cab_plantilla");
        $datos = $request->getParameter("datos");        
        $dets = json_decode($datos);
        $ids = array();
        foreach($dets as  $c)
        {
            try{
                $det= Doctrine::getTable("AduDetPlantilla")->find($c->ca_id_det_plantilla);                    
                if(!$det){
                    $det= new AduDetPlantilla();
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
            }   
            catch (Exception $e){
                 $errorInfo.= $e->getMessage()."<br>";
            }
        }
        $this->setTemplate("responseTemplate");
    }
    
    public function executeEliminarCabPlantilla(sfWebRequest $request){
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);               
        $ids = array();
        $i=0;        
         
        foreach($datos as $dato){
            $i++;
            $AduCabPlantilla = Doctrine::getTable("AduCabPlantilla")->find($dato->ca_id_cab_plantilla);
            if($AduCabPlantilla){
                $AduCabPlantilla->delete();
            }            
            $ids[] = $dato->id;
        }         
        $this->responseArray = array("success" => true ,"ids" => $ids ,"count" => $i);   
        $this->setTemplate("responseTemplate");
      
    
    }
    public function executeEliminarDetPlantilla(sfWebRequest $request){
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);               
        $ids = array();
        $i=0;        

        foreach($datos as $dato){
            $i++;
            $AduDetPlantilla = Doctrine::getTable("AduDetPlantilla")->find($dato->ca_id_det_plantilla);
            if($AduDetPlantilla){
                $AduDetPlantilla->delete();
            }            
            $ids[] = $dato->id;
        }         
        $this->responseArray = array("success" => true ,"ids" => $ids ,"count" => $i);   
        $this->setTemplate("responseTemplate");    
    }
    
    //end napuentes
    
    
    
    
}
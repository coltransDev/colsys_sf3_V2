<?php

/**
 * parametros actions.
 *
 * @package    symfony
 * @subpackage parametros
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class inoparametrosActions extends sfActions
{

    const RUTINA_TRM = 155;
    public function getNivel(){
        $this->modo = $this->getRequestParameter("modo");

        $this->nivel = -1;
		if( !$this->modo ){
			$this->forward( "parametros", "seleccionModo" );
		}
        return 1;
    }


    /*****************************************************************************
    *
    *   PARAMETRIZACION DE CONCEPTOS
    *
    *****************************************************************************/

    /**
    * Asocia los conceptos a cuentas contables
    *
    * @param sfRequest $request A request object
    */
    public function executeConceptos(){
        
    }


    /**
    * Datos de los conceptos para usar en pricing cotizaciones etc.
    *
    * @param sfRequest $request A request object
    */
    public function executeDatosPanelParametrosCuentas(sfWebRequest $request){
        $modo = $request->getParameter("modo");
        //$nivel = $this->getNivel();
        $nivel = 5;

        $idccosto = $request->getParameter("idccosto");

        $q = Doctrine::getTable("InoConcepto")
                         ->createQuery("c")
                         ->select("c.*, cu.ca_idcuenta, cu.ca_cuenta") //,
                         ->addOrderBy( "c.ca_concepto" );
        $modo = "fv";
        if( $modo == "fv" ){
            $q->leftJoin("c.InoParametroFacturacion p")
              ->leftJoin("p.InoCuenta cu")
              ->leftJoin("p.InoCuentaRetencion cr")
              ->addSelect("p.*, cu.ca_cuenta as ca_cuenta, cr.ca_cuenta as ca_cuentaretencion")
              ->addWhere("p.ca_idccosto = ? OR p.ca_idccosto IS NULL", $idccosto )
              ->addWhere("c.ca_recargolocal = ? OR c.ca_recargoorigen = ?", array(true, true));
        }

        if( $modo=="fc" ){
            $q->addWhere( "c.ca_costo = ? ", true);

            $q->leftJoin("c.InoParametroCosto p")
              ->leftJoin("p.InoCuenta cu")
              ->addSelect("p.*, cu.ca_cuenta as ca_cuenta ")
              ->addWhere("p.ca_idccosto = ? OR p.ca_idccosto IS NULL", $idccosto )
              ->addWhere("c.ca_costo = ? ", array(true));
        }
        

        $conceptos = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR )->execute();

        $k = 0;
        foreach( $conceptos as $key=>$val ){
            //echo $conceptos[ $key ]["c_ca_idconcepto"]." -> ".$conceptos[ $key ]["cu_ca_idcuenta"]."<br >";
            $conceptos[ $key ]["c_ca_concepto"]=utf8_encode( $conceptos[ $key ]["c_ca_concepto"] );
            $conceptos[ $key ]["orden"]=str_pad($k,4, "0",STR_PAD_LEFT);
            $k++;

            if( $modo != "edicion" ){
                $conceptos[ $key ]["idccosto"]=$idccosto;
            }

            /*$modalidadesConcepto = Doctrine_Query::create()
                                ->select("cm.ca_idmodalidad")
                                ->from("InoConceptoModalidad cm")
                                ->where("cm.ca_idconcepto = ? ", $conceptos[ $key ]["c_ca_idconcepto"] )
                                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                ->execute();
            $modalidades = array();

            foreach( $modalidadesConcepto as $modalidadConcepto ){
                $modalidades[]=$modalidadConcepto["ca_idmodalidad"];
            }
            $conceptos[ $key ]["modalidades"] = implode( "|", $modalidades );*/


            if( $modo == "fv" && $conceptos[ $key ]["p_ca_iva"] ){
                $conceptos[ $key ]["p_ca_iva"] = $conceptos[ $key ]["p_ca_iva"]*100;
            }

        }

        if( $nivel>=1 && $this->modo=="edicion" ){
            $conceptos[] = array("ca_idconcepto"=>"", "ca_concepto"=>"", "orden"=>"Z");
        }

        $this->responseArray = array( "totalCount"=>count( $conceptos ), "root"=>$conceptos  );

		$this->setTemplate("responseTemplate");
    }

    /*
    * guarda el panel de conceptos
    * @param sfRequest $request A request object
    */
    public function executeGuardarPanelParametrosCuentas(sfWebRequest $request){
        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>false);

        $modo = $request->getParameter("modo");

        $tipo = $request->getParameter("tipo");

        $idconcepto = $request->getParameter("idconcepto");

        $this->forward404unless( $idconcepto );

        $concepto = Doctrine::getTable("InoConcepto")->find($idconcepto);
        $this->forward404Unless($concepto);

        if( $modo=="fv" ){
            //ca_idparametro
            $idccosto = $request->getParameter("idccosto");
            $parametro = Doctrine::getTable("InoParametroFacturacion")
                                   ->createQuery("p")
                                   ->where("p.ca_idconcepto = ? AND p.ca_idccosto = ?", array($concepto->getCaIdconcepto(), $idccosto) )
                                   ->fetchOne();

            if( !$parametro ){
                $parametro = new InoParametroFacturacion();
                $parametro->setCaIdconcepto( $concepto->getCaIdconcepto() );
                $parametro->setCaIdccosto( $idccosto );
            }
            if( $request->getParameter("idcuenta") ){
                $parametro->setCaIdcuenta( $request->getParameter("idcuenta") );
            }

            if( $request->getParameter("ingreso_propio")!==null ){
                $parametro->setCaIngreso_propio( $request->getParameter("ingreso_propio") );
            }

            if( $request->getParameter("iva")!==null ){
                $parametro->setCaIva( $request->getParameter("iva")/100 );
            }

            if( $request->getParameter("baseretencion")!==null ){
                $parametro->setCaBaseretencion( $request->getParameter("baseretencion") );
            }

            if( $request->getParameter("idcuentaretencion")!==null ){
                $parametro->setCaIdcuentaretencion( $request->getParameter("idcuentaretencion") );
            }

            if( $request->getParameter("valor")!==null ){
                $parametro->setCaValor( $request->getParameter("valor") );
            }
            
           if( $request->getParameter("autoretencion")!==null ){
                $parametro->setCaAutoretencion($request->getParameter("valor"));
            }
            $parametro->save();
        }

        if( $modo=="fc" ){
            //ca_idparametro
            $idccosto = $request->getParameter("idccosto");
            $parametro = Doctrine::getTable("InoParametroCosto")
                                   ->createQuery("p")
                                   ->where("p.ca_idconcepto = ? AND p.ca_idccosto = ?", array($concepto->getCaIdconcepto(), $idccosto) )
                                   ->fetchOne();

            if( !$parametro ){
                $parametro = new InoParametroCosto();
                $parametro->setCaIdconcepto( $concepto->getCaIdconcepto() );
                $parametro->setCaIdccosto( $idccosto );
            }
            if( $request->getParameter("idcuenta")!==null ){
                $parametro->setCaIdcuenta( $request->getParameter("idcuenta") );
            }

            if( $request->getParameter("ingreso_propio")!==null ){
                $parametro->setCaIngreso_propio( $request->getParameter("ingreso_propio") );
            }

            if( $request->getParameter("iva")!==null ){
                $parametro->setCaIva( $request->getParameter("iva")/100 );
            }

            if( $request->getParameter("baseretencion")!==null ){
                $parametro->setCaBaseretencion( $request->getParameter("baseretencion") );
            }

            if( $request->getParameter("idcuentaretencion")!==null ){
                $parametro->setCaIdcuentaretencion( $request->getParameter("idcuentaretencion") );
            }

            if( $request->getParameter("valor")!==null ){
                $parametro->setCaValor( $request->getParameter("valor") );
            }
            
            if( $request->getParameter("autoretencion")!==null ){
                $parametro->setCaAutoretencion($request->getParameter("valor"));
            }
            $parametro->save();
        }

        $this->responseArray["success"]=true;
        $this->responseArray["idconcepto"]=$concepto->getCaIdconcepto();
        $this->setTemplate("responseTemplate");
    }


    /*****************************************************************************
    *
    *   PARAMETRIZACION DE CUENTAS
    *
    *****************************************************************************/
    /**
    * Parametrización del PUC
    *
    * @param sfRequest $request A request object
    */
    public function executeCuentas(){

    }


    /**
    * Importar Cuentas
    *
    * @param sfRequest $request A request object
    */
    public function executeImportarCuentas( sfWebRequest $request ){

        if ($request->isMethod('post')){

            $file = $_FILES["file"];

            if(is_uploaded_file($file["tmp_name"])){
                $objReader = new PHPExcel_Reader_Excel5();
                $objPHPExcel = $objReader->load($file["tmp_name"]);

                //print_r( $objPHPExcel );

                $ws = $objPHPExcel->getSheet(0);

                try{
                    $conn = Doctrine::getTable("InoCuenta")->getConnection();
                    $conn->beginTransaction();

                    $array = $ws->toArray();
                    $i = 0;
                    $nuevos = 0;
                    $actualizados = 0;
                    foreach( $array as $row ){
                        if( $i == 0){
                            foreach( $row as $key=>$col ){
                                if( trim($col) == "CUENTA" ){
                                    $colCuenta = $key;
                                }
                                if( trim($col) == "DESCRIPCION" ){
                                    $colDesc = $key;
                                }
                            }
                        }else{
                            $cuentaNo = trim(str_replace("-", "", $row[$colCuenta] ));
                            $desc = $row[$colDesc];

                            if( $cuentaNo ){
                                $cuenta = Doctrine::getTable("InoCuenta")
                                          ->createQuery("c")
                                          ->addWhere("c.ca_cuenta = ?", $cuentaNo)
                                          ->fetchOne();

                                if( !$cuenta ){
                                    $cuenta = new InoCuenta();
                                    $nuevos++;
                                }else{
                                    $actualizados++;
                                }
                                //echo $i." ".$cuenta."<br />";
                                $cuenta->setCaCuenta($cuentaNo);
                                $cuenta->setCaDescripcion($desc);
                                $cuenta->save( $conn );
                            }
                        }

                        $i++;
                    }
                    $conn->commit();
                    $this->actualizados = $actualizados;
                    $this->nuevos = $nuevos;
                    $this->setTemplate("importarCuentasOk");
                }
                catch (Exception $e){

                    throw $e;
                    $conn->rollBack();
                }

            }


        }
    }
    
    
    public function executeGenFileFact( sfWebRequest $request  ){
        
        
        
        if ($request->isMethod('post')){
            $file = $_FILES["file"];
            if(is_uploaded_file($file["tmp_name"])){
                //exit;
                $objReader = new PHPExcel_Reader_Excel5();
                $objPHPExcel = $objReader->load($file["tmp_name"]);

                //print_r( $objPHPExcel );

                $ws = $objPHPExcel->getSheet(0);
                
            
            $con = Doctrine_Manager::getInstance()->connection();            
            $sql = "select ca_fecha,ca_pesos from tb_trms t order by ca_fecha desc";
            $st = $con->execute($sql);
            $trmTmp = $st->fetchAll();
            $trms= array();
            foreach($trmTmp as $t)
            {
                $trms[$t["ca_fecha"]]=$t["ca_pesos"];
            }
            $trm_hoy=$trms[date("Y-m-d")];
            
            //print_r($trms);
            //exit;
                
                

                try{
                    //$conn = Doctrine::getTable("InoCuenta")->getConnection();
                    //$conn->beginTransaction();

                    $array = $ws->toArray();
                    
                    $colTipo=0;
                    $colNumTipo=1;
                    $colNumDoc=2;
                    $colFecDoc=4;
                    $colFecVen=5;
                    $colNit=6;
                    $colSaldo=10;
                    
                    //exit;
                    $i = 0;
                    $nuevos = 0;
                    $actualizados = 0;
                    $contador=1;
                    $this->error="";
                    $datos=array();
                    foreach( $array as $pos=>$row ){
                        if( $pos < 8){
                            continue;
                        }
                        else{
                            $nFactura=trim($row[$colTipo]).trim($row[$colNumTipo])."-".$row[$colNumDoc];
                            
                            if(trim($row[$colTipo])!="F")
                                continue;
                            
                            $inoIngreso = Doctrine::getTable("InoIngresosAll")->find($nFactura);
                            if(!$inoIngreso)
                            {
                                $this->error.=($contador++)." - Fila ".$pos.":{$row[$colFecDoc]} No se encontro la factura No. $nFactura en Colsys<br>";
                                continue;
                            }
                            else
                            {                                
                                $trm_tipo=($inoIngreso->getCaTipo()=="M")?30:0;
                            }
                            
                            $row[$colFecDoc]=  str_replace("/","-",$row[$colFecDoc]);
                            $row[$colFecVen]=  str_replace("/","-",$row[$colFecVen]);
                            
                            $saldo="";
                            if(isset($trms[$row[$colFecDoc]]))
                            {
                                if($trm_hoy>$trms[$row[$colFecDoc]])
                                {
                                    $saldo_dolares=$row[$colSaldo]/$trms[$row[$colFecDoc]];
                                    $saldo=round($saldo_dolares*($trm_hoy+$trm_tipo));
                                }else
                                    $saldo=round($row[$colSaldo]);
                            }else
                            {
                                $this->error.=($contador++)." - Fila ".$pos.":{$row[$colFecDoc]} No posee TRM para la fecha<br>";
                                continue;
                            }                            
                            $datos[]="0;".$nFactura.";".$row[$colNit].";".$row[$colFecDoc].";".$saldo.";0;0;".$row[$colFecVen].";0\n";
                        }
                        $i++;
                    }
                    
                    //echo "<br><br><b>".$error."</b>";
                    //$conn->commit();
                    
                    $this->nameFile="fac".date("Y-m-d H:i:s").".csv";
                    $this->folder="factopen";
                    $this->cachefile = $config = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$this->folder.DIRECTORY_SEPARATOR.$this->nameFile;
                    $fp = fopen($this->cachefile, 'c');
                    //fputcsv($fp, array($datos));
                    foreach($datos as $d)
                    {
                        fwrite($fp, $d);
                    }
                    fclose($fp);
                    //echo $this->cachefile;
                    //echo "<a href='/gestDocumental/verArchivo?idarchivo=".base64_encode($folder.$nameFile)+"'>".$nameFile."</a>";
                    //exit;
                }
                catch (Exception $e){
                    throw $e;
                    //$conn->rollBack();
                }
            }
        }
    }
    

    /**
    * Datos para el panel de parametros. 
    *
    * @param sfRequest $request A request object
    */
    public function executeDatosPanelCuentas( sfWebRequest $request  ){
        $q = Doctrine::getTable("InoCuenta")
                       ->createQuery("c")
                       ->addOrderBy("c.ca_cuenta");

        $cuentas = $q->execute();

        $data = array();

        foreach( $cuentas as $cuenta ){
            $row = array();
            $row["idcuenta"]=$cuenta->getCaIdcuenta();
            $row["cuenta"]=$cuenta->getCaCuenta();
            $row["descripcion"]=utf8_encode($cuenta->getCaDescripcion());
            $row["naturaleza"]=utf8_encode($cuenta->getCaNaturaleza());
            $row["grupo"]=substr($cuenta->getCaCuenta(), 0, 1 );
            $data[] = $row;
        }

        $this->responseArray = array("root"=>$data, "total"=>count($data), "success"=>true );

        $this->setTemplate("responseTemplate");
    }


    /*****************************************************************************
    *
    *   PARAMETRIZACION DE COMPROBANTES
    *
    *****************************************************************************/
    /**
    * Parametrización de tipos de documentos
    *
    * @param sfRequest $request A request object
    */
    public function executeTiposComprobante( sfWebRequest $request  ){

    }


    /**
    * Datos para el panel de tipos de comprobante.
    *
    * @param sfRequest $request A request object
    */
    public function executeDatosPanelTiposComprobante( sfWebRequest $request  ){
        $q = Doctrine::getTable("InoTipoComprobante")
                       ->createQuery("t");
                       

        $tipos = $q->execute();

        $data = array();

        foreach( $tipos as $tipo ){
            $row = array();
            $row["idtipo"]=$tipo->getCaIdtipo();
            $row["tipo"]=$tipo->getCaTipo();
            $row["comprobante"]=utf8_encode($tipo->getCaComprobante());
            $row["descripcion"]=utf8_encode($tipo->getCaDescripcion());
            $row["titulo"]=utf8_encode($tipo->getCaTitulo());
            $data[] = $row;
        }

        $this->responseArray = array("root"=>$data, "total"=>count($data), "success"=>true );

        $this->setTemplate("responseTemplate");
    }

    
    /**
    * Guarda el formulario donde se crea y edita el tipo de comprobante
    *
    * @param sfRequest $request A request object
    */
    public function executeFormTipoComprobanteGuardar( sfWebRequest $request ){

        if( $request->getParameter("idtipo") ){
            $tipo = Doctrine::getTable("InoTipoComprobante")->find( $request->getParameter("idtipo") );
            $this->forward404Unless( $tipo );
        }else{
            $tipo = new InoTipoComprobante();
        }
        $tipo->setCaTipo( $request->getParameter("tipo") );
        $tipo->setCaComprobante( $request->getParameter("comprobante") );
        if( $request->getParameter("numeracion_inicial") ){
            $tipo->setCaNumeracionInicial( $request->getParameter("numeracion_inicial") );
        }else{
            $tipo->setCaNumeracionInicial( null );
        }
        $tipo->setCaTitulo( $request->getParameter("titulo") );
        try{
            $tipo->save();
            $this->responseArray = array( "success"=>true );
        }catch(Exception $e){
            $this->responseArray = array( "success"=>false, "errorInfo"=>$e->getMessage() );
        }
        $this->setTemplate("responseTemplate");
    }

    /**
    * Datos para el panel de tipos de comprobante para mostrar en el formulario.
    *
    * @param sfRequest $request A request object
    */
    public function executeDatosTipoComprobante( sfWebRequest $request ){

        if( $request->getParameter("idtipo") ){
            $tipo = Doctrine::getTable("InoTipoComprobante")->find( $request->getParameter("idtipo") );
            $this->forward404Unless( $tipo );
            $data = array();

            $data["idtipo"] = $tipo->getCaIdtipo();
            $data["tipo"] = $tipo->getCaTipo();
            $data["comprobante"] = $tipo->getCaComprobante();
            $data["titulo"] = utf8_encode($tipo->getCaTitulo());
            $data["numeracion_inicial"] = $tipo->getCaNumeracionInicial();
            $this->responseArray = array("data"=>$data, "success"=>true );

        }else{
            $this->responseArray = array( "success"=>false, "errorInfo"=>"Se debe especificar el Id" );
        }
        
        $this->setTemplate("responseTemplate");
    }


    /*****************************************************************************
    *
    *   PARAMETRIZACION DE CENTROS DE COSTOS
    *
    *****************************************************************************/
    public function executeHomologacionFormExt4( sfWebRequest $request ){
        
        
    }

    public function executeDatosConceptosSiigo( sfWebRequest $request ){
        $idconcepto = $request->getParameter("idconcepto");
        $idccosto = $request->getParameter("idccosto");
        
        
        
        $modo = Doctrine::getTable("Modo")->find( $request->getParameter("modo") );
        $query = $request->getParameter("query");
        
        $idcomprobante = $request->getParameter("idcomprobante");
        $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
        if($comprobante)
        {
            $idsucursal=$comprobante->getInoTipoComprobante()->getCaIdsucursal();
        }
        else
        {
            $idsucursal="";//$this->getUser()->getSucursal()
        }
//        $idempresa = $request->getParameter("idempresa");

        //$ccosto = Doctrine::getTable("InoCentroCosto")->find($idccosto);

         $ccosto = Doctrine::getTable("InoCentroCosto")
                                  ->createQuery("c")
                                  ->addWhere("c.ca_impoexpo = ?", $modo->getCaImpoexpo())
                                  ->addWhere("c.ca_transporte = ?", $modo->getCaTransporte())
                                  ->addWhere("c.ca_idsucursal = ?", $idsucursal)
                                  ->fetchOne();
        if($ccosto)
        {
            $q = Doctrine::getTable("InoConSiigo")
                             ->createQuery("s")
                             ->select("*")                         
                             ->where("SUBSTR(ca_cod::TEXT,1,2)=? and ca_idempresa=?  ",array($ccosto->getCaCentro().$ccosto->getCaSubcentro() , $ccosto->getCaIdempresa()) )
                             ->addOrderBy( "s.ca_idconceptosiigo" );
            if($query!="")
            {
                $q->addWhere("UPPER(ca_descripcion) like ?",'%'.  strtoupper($query).'%');
            }
            $debug=$q->getSqlQuery();
        }
//        echo $debug;
        //echo $ccosto->getCaCentro() ."::". $ccosto->getCaSubcentro() ."::". $ccosto->getCaIdempresa();
//        exit;
        $conceptosSiigo=$q->execute();
        $data=$seleccionados=array();
        foreach ($conceptosSiigo as $s)
        {
            $data[]=array("id"=>$s->getCaCod(),"name"=>$s->getCaCod()."-".utf8_encode($s->getCaDescripcion()));
        }
        
        
        if($idconcepto!="")
        {
            $conceptosHomo = Doctrine::getTable("InoConHomologacion")
                         ->createQuery("ch")
                         ->select("ca_idconceptosiigo")
                         ->where("ca_idconcepto = ?  and ca_idccosto = ? ", array($idconcepto , $idccosto ))                         
                        ->execute();
//        print_r($conceptosHomo);
            foreach ($conceptosHomo as $s)
            {
                $seleccionados[]=$s->getCaIdconceptosiigo();
            }            
        }
        //print_r($seleccionados);
        //exit;

        $this->responseArray = array("root"=>$data,"seleccionados"=>$seleccionados, "success"=>true,"debug"=>$debug );
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosConceptosHomo( sfWebRequest $request ){
       
        $idconcepto = $request->getParameter("idconcepto");
        $idccosto = $request->getParameter("idccosto");
        $seleccionados=array();
        if($idconcepto!="" && $idccosto!="")
        {
            $conceptosHomo = Doctrine::getTable("InoConHomologacion")
                             ->createQuery("ch")
                             ->select("ca_idconceptosiigo")
                             ->where("ca_idconcepto = ?  and ca_idccosto = ? ", array($idconcepto , $idccosto ))
                            ->execute();

            foreach ($conceptosHomo as $s)
            {
                $seleccionados[]=$s->getCaIdconceptosiigo();
            }
        }

        $this->responseArray = array("seleccionados"=>$seleccionados, "success"=>true );
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarConceptosHomo( sfWebRequest $request ){

        $idconcepto = $request->getParameter("idconcepto");
        $idccosto = $request->getParameter("idccosto");
        $seleccionados=  explode(",", $request->getParameter("seleccionados"));
        //print_r($seleccionados);
        
        //$conn = Doctrine::getTable("InoConHomologacion")->getConnection();
        //$conn->beginTransaction();
        
        $conceptosHomo = Doctrine::getTable("InoConHomologacion")
                            ->createQuery("ch")
                            ->delete()
                            ->where("ca_idconcepto = ?  and ca_idccosto = ? ", array($idconcepto , $idccosto ))
                            ->execute();
        
        try {    
            foreach($seleccionados as $s) 
            {
                $conHomo = new InoConHomologacion();
                $conHomo->setCaIdccosto($idccosto);
                $conHomo->setCaIdconceptosiigo($s);
                $conHomo->setCaIdconcepto($idconcepto);
                $conHomo->save();
            }

            //$conn->commit();
            $success=true;
        }
        catch(Exception $e)
        {
            $success=false;
            $error=$e->getMessage();
        }
        $this->responseArray = array( "success"=>$success, "error"=>$error );
        $this->setTemplate("responseTemplate");
        
    }

    
    public function executeTrmsExt4( sfWebRequest $request ){
        
        $this->permiso = $this->getUser()->getNivelAcceso(inoparametrosActions::RUTINA_TRM);
        if($this->permiso<=0)            
            $this->setLayout("sinmenu");
        
        
    }
    
    public function executeDatosTrms( sfWebRequest $request ){
     
        
        //$q[]=array("ca_fecha"=>date("Y-m-d"),"ca_pesos"=>30,"ca_euro"=>20);
        
        $con = Doctrine_Manager::getInstance()->connection();            
        $sql = "select ca_fecha,ca_pesos,ca_euro from tb_trms t order by ca_fecha desc";
        $st = $con->execute($sql);
        $trmTmp = $st->fetchAll();
        
        $this->responseArray = array("success" => true,"root"=>$trmTmp);
        $this->setTemplate("responseTemplate");
    }
    
    
    public function executeGuardarGridTrms( sfWebRequest $request ){
        
        $datos =  json_decode($request->getParameter("datos"));
        foreach($datos as $d)
        {        
            if($d->fecha=="")
                continue;
            $trm = Doctrine::getTable("Trms")->find($d->fecha);
            if(!$trm)
            {
                $trm= new Trms();
                $trm->setCaFecha($d->fecha);
            }
            $trm->setCaPesos($d->pesos);
            if($d->euro!="")
                $trm->setCaEuro($d->euro);
            $trm->save();            
        }
        
        $this->responseArray = array("success" => true);
        $this->setTemplate("responseTemplate");
    }

}

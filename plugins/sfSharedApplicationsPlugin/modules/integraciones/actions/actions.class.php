<?php

/**
 * config actions.
 *
 * @package    symfony
 * @subpackage config
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class integracionesActions extends sfActions {

    //const userSap="manager";
    //const passSap="9876";
    private $hostFE = "https://apiqa.etlqa.open-eb.io/81" ;
    private $hostFE1 = "https://apiqa.etlqa.open-eb.io/" ;

    public function executeIndex(sfWebRequest $request) {
        
    }
    
    public function executeProcesarTransacciones(sfWebRequest $request) {
        
        
        $idtransaccion=IntTransaccionesOut::procesarTransacciones($request->getParameter("idtipo"), $request->getParameter("indice1"), $request->getParameter("indice2"));
       /* $q = Doctrine::getTable("IntTransaccionesOut")
                            ->createQuery("tr")
                            ->select("*")
                            ->innerJoin("tr.IntTipos s")
                            ->where("tr.ca_estado=? and tr.ca_datos is null", "A");

        if( $request->getParameter("idtipo")!=""  &&  $request->getParameter("indice1")!="" )
        {
            $q->addWhere("tr.ca_idtipo = ? and ca_indice1=?", array($request->getParameter("idtipo"),$request->getParameter("indice1")));
        }
        //echo $request->getParameter("idtipo")."<br>";
        //echo $request->getParameter("indice1")."<br>";
        //echo $q->getSqlQuery();
        //exit;
        $transacciones =$q->execute();
        
        foreach($transacciones as $tr)
        {            
            
            eval("\$this->json".$tr->getIntTipos()->getCaNombre()."(\$tr);");
            $idtransaccion=$tr->getCaIdtransaccion();
        }*/
//        echo $idtransaccion;
        $this->responseArray = array("success"=> true ,"idtransaccion" => $idtransaccion );
        $this->setTemplate("responseTemplate");
        
        //return $idtransaccion;
        
        //$this->responseArray = array("id" => "1", "success" => $success);
        //$this->setTemplate("responseTemplate");
        
    }
    
    
    public function executeProcesarTransaccionesxid(sfWebRequest $request) {
        
        
        /*print_r($request->getParameter("idtransaccion"));
        print_r(json_decode($request->getParameter("idtransaccion")));
        exit;*/
        $idtransaccion=IntTransaccionesOut::procesarTransaccionesxId($request->getParameter("idtransaccion"));
       /* $q = Doctrine::getTable("IntTransaccionesOut")
                            ->createQuery("tr")
                            ->select("*")
                            ->innerJoin("tr.IntTipos s")
                            ->where("tr.ca_estado=? and tr.ca_datos is null", "A");

        if( $request->getParameter("idtipo")!=""  &&  $request->getParameter("indice1")!="" )
        {
            $q->addWhere("tr.ca_idtipo = ? and ca_indice1=?", array($request->getParameter("idtipo"),$request->getParameter("indice1")));
        }
        //echo $request->getParameter("idtipo")."<br>";
        //echo $request->getParameter("indice1")."<br>";
        //echo $q->getSqlQuery();
        //exit;
        $transacciones =$q->execute();
        
        foreach($transacciones as $tr)
        {            
            
            eval("\$this->json".$tr->getIntTipos()->getCaNombre()."(\$tr);");
            $idtransaccion=$tr->getCaIdtransaccion();
        }*/
//        echo $idtransaccion;
        $this->responseArray = array("success"=> true ,"idtransaccion" => $idtransaccion );
        $this->setTemplate("responseTemplate");
        
        //return $idtransaccion;
        
        //$this->responseArray = array("id" => "1", "success" => $success);
        //$this->setTemplate("responseTemplate");
        
    }
    
    
    
    
    
    public function executeEnviarSap(sfWebRequest $request) {
    
        $reenvio=($request->getParameter("reenvio")=="si")?"si":"no";
        $respuesta=IntTransaccionesOut::enviarWs($request->getParameter("idtransaccion"),$this->getUser()->getUserId(),$reenvio);
        //$reporte=IntTransaccionesOut::reporteErrores();
        //exit;
        $this->responseArray = array("respuesta" => $respuesta, "success" => true);        
        $this->setTemplate("responseTemplate");
        
    }
    
    public function executeGetDocument(sfWebRequest $request) {
        //echo "dd";
        //$resul=IntTransaccionesOut::enviarWs($idtransaccion);            
        //echo "Inicio ".date("Y-m-d H:i:s")."<br>";
        $respuesta=IntTransaccionesOut::getDocuments($request->getParameter("idtransaccion"));
        //exit;
        $this->responseArray = array("respuesta" => $respuesta, "success" => true);
        //echo "<br>Fin ".date("Y-m-d H:i:s")."<br>";
        $this->setTemplate("responseTemplate");
        
    }
    
    public function executeGetDocumentnew(sfWebRequest $request) {
        //echo "dd";
        //$resul=IntTransaccionesOut::enviarWs($idtransaccion);            
        echo "Inicio ".date("Y-m-d H:i:s")."<br>";
        $respuesta=IntTransaccionesOut::getDocumentsnew($request->getParameter("idtransaccion"));
        //print_r($respuesta);
        //exit;
        $this->responseArray = array("respuesta" => $respuesta, "success" => true);        
        echo "<br>Fin ".date("Y-m-d H:i:s")."<br>";
        $this->setTemplate("responseTemplate");
        
        
    }
    
    public function executeGetDocument1(sfWebRequest $request) {        
        $datos=array();
        
        //{"User":"manager","Password":"912e79cd13c64069d91da65d62fbb78c","Company":"1","System":"2","NumeroReferencia":"910.10.07.0035.18","NumeroInterno":103518,"TipoDoc":"V"}
        
        $datos["NumeroReferencia"]="700.80.07.0009.18";//"500.05.06.0108.18";
        //$datos["TipoDoc"]="V";
        $datos["Company"]="COLOTM_PROD";
        echo "<pre>";
        print_r(IntTransaccionesOut::getDocumentsxParam($datos));
        echo "</pre>";
        exit;
    }

    
    function executeDatosTransaccionesOut($request) {
        
        
        $con = Doctrine_Manager::getInstance()->getConnection('master');
        
        
        
        
        /*$q = Doctrine::getTable("IntTransaccionesOut")
                ->createQuery("it")
                ->leftJoin("it.IntTipos t")
                ->orderBy("ca_idtransaccion DESC")
                ->limit(500);
        */
        
        $where="1=1";
        
        
        if($request->getParameter("idtipo")){
            //$q->addWhere("it.ca_idtipo = ?", $request->getParameter("idtipo"));
            $where.=" and it.ca_idtipo = '".$request->getParameter("idtipo")."'";
        }
        
        if($request->getParameter("date")){
            //$q->addWhere("it.ca_fchenvio > ?", $request->getParameter("date"));
            $where.=" and it.ca_fchenvio > '".$request->getParameter("date")."'";
        }
        
        if($request->getParameter("estado")!=""){
            //$q->addWhere("it.ca_estado = ?", $request->getParameter("estado"));
            $where.=" and it.ca_estado = '".$request->getParameter("estado")."'";
        }
        
        if($request->getParameter("indice")!=""){
            //$q->addWhere("(it.ca_indice1 like ? OR  it.ca_datos::text like ? )", array("%".$request->getParameter("indice")."%","%".$request->getParameter("indice")."%") );
            $where.=" and  ( it.ca_indice1 like '%".$request->getParameter("indice")."%' OR it.ca_datos::text like  '%".$request->getParameter("indice")."%' OR it.ca_idtransaccion =  ".$request->getParameter("indice").")";
        }
                //->addWhere("ca_idtransaccion > ? OR ca_idtransaccion < ?",array(1170, 1168))
        //$q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
        //$debug = $q->getSqlQuery();
        
        //$transacciones = $q->execute();
        
        
        $sql="Select it.*,t.ca_nombre
                from integracion.tb_transaccionesout it
                left join integracion.tb_tipos t ON it.ca_idtipo=t.ca_idtipo
                where $where 
                order by ca_idtransaccion DESC
                limit 200";
        
         $debug = $sql;

        $st = $con->execute($sql);
        $transacciones = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
        
        $class="row_orange";
        foreach ($transacciones as $k => $c) {
            
            if($request->getParameter("indice")!=""){
                $transacciones[$k]["ca_datos"]= str_replace($request->getParameter("indice"),"<span class=$class>".$request->getParameter("indice")."</span>",$transacciones[$k]["ca_datos"] );
                $transacciones[$k]["ca_indice1"]= str_replace($request->getParameter("indice"),"<span class=$class>".$request->getParameter("indice")."</span>",$transacciones[$k]["ca_indice1"] );
            }
            $transacciones[$k]["ca_datos"] = utf8_encode($transacciones[$k]["ca_datos"]);
            $transacciones[$k]["ca_respuesta"] = utf8_encode($transacciones[$k]["ca_respuesta"]);
            $transacciones[$k]["tipo"] = utf8_encode($transacciones[$k]["ca_idtipo"])." - ". utf8_encode($transacciones[$k]["ca_nombre"]);
            
            switch($transacciones[$k]["ca_estado"]){
                case "A":
                    $transacciones[$k]["estado_valor"] = "Abierto";
                    break;
                case "G":
                    $transacciones[$k]["estado_valor"] = "Generado";
                    break;
                case "P":
                    $transacciones[$k]["estado_valor"] = "Procesado";
                    break;
                case "E":
                    $transacciones[$k]["estado_valor"] = "Errado";
                    break;
                case "R":
                    $transacciones[$k]["estado_valor"] = "Reprogramado";
                    break;
            }
        }
        
        //print_r($transacciones);
        
        $this->responseArray = array("success" => true, "root" => $transacciones, "total" => count($transacciones), "debug" => $debug);
        
        $this->setTemplate("responseTemplate");
        
    }
    
    function executeDatosTransaccionesIn($request) {
        
        $con = Doctrine_Manager::getInstance()->getConnection('master');

        
        
        
        /*$q = Doctrine::getTable("IntTransaccionesIn")
                ->createQuery("it")
                ->limit(500)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
         * 
         */
        
        $where="1=1";
        if($request->getParameter("tipo")){
            $where.=" and it.ca_tipo = '".$request->getParameter("tipo")."'";
            //$q->addWhere("it.ca_tipo = ?", $request->getParameter("tipo"));
        }
        
        if($request->getParameter("indice")!=""){
            $where.=" and it.ca_datos::text like  '%".$request->getParameter("indice")."%'";
            //$q->addWhere("it.ca_datos like ?", "%".$request->getParameter("indice")."%" );
        }
        
        if($request->getParameter("date")){
            $where.=" and it.ca_fchenvio > '".$request->getParameter("date")."'";
            //$q->addWhere("it.ca_fchenvio > ?", $request->getParameter("date"));
            //$q->orderBy("ca_idtransaccion ASC");        
        }
        
        if($request->getParameter("estado")!=""){
            $where.=" and it.ca_estado = '".$request->getParameter("estado")."'";
            //$q->addWhere("it.ca_tipo = ?", $request->getParameter("tipo"));
        }
        
        //$transacciones = $q->execute();
        
        $sql="Select it.*
                from integracion.tb_transaccionesin it
                where $where order by ca_idtransaccion DESC
                limit 200";
        
        $debug = $sql;

        $st = $con->execute($sql);
        $transacciones = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
        
        //print_r($transacciones);
        //exit;

        foreach ($transacciones as $k => $c) {
            $transacciones[$k]["ca_datos"] = utf8_encode($transacciones[$k]["ca_datos"]);
            $transacciones[$k]["ca_respuesta"] = utf8_encode($transacciones[$k]["ca_respuesta"]);
            
            switch($transacciones[$k]["ca_tipo"]){
                case 1:
                    $transacciones[$k]["ca_tipodet"] = "Factura de Compra";
                    break;
                case 2:
                    $transacciones[$k]["ca_tipodet"] = utf8_encode("Cancelaci?n de comprobantes");
                    break;
                case 3:
                    $transacciones[$k]["ca_tipodet"] = utf8_encode("Pagos Recibidos");
                    break;
                case 4:
                    $transacciones[$k]["ca_tipodet"] = utf8_encode("Activaci?n Cliente");
                    break;
                case 5:
                    $transacciones[$k]["ca_tipodet"] = utf8_encode("Activaci?n Conceptos");
                    break;
            }
        }
        //print_r($transacciones);
        $this->responseArray = array("success" => true, "root" => $transacciones, "total" => count($transacciones), "debug" => $debug);
        $this->setTemplate("responseTemplate");
    }
    
    function executeEnviarColsys($request) {
        
        ProjectConfiguration::registerZend();  
       
        $config = sfConfig::get("app_soap_sap");
        $wsdl_uri = "http://172.16.1.13/ws/sap/IntegracionSapWS?wsdl";               
        $client = new Zend_Soap_Client($wsdl_uri, array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 , 'login'=>'seidor', 'password'=>'=Ye7zdT5u8$SDt#V'));       
       
        $json = $request->getParameter("datos");
        $tipo = $request->getParameter("tipo");
        $compania = $request->getParameter("compania");
        
        $result =  $client->tipoSolicitud( $compania, '9011', $tipo, $json);
        $this->responseArray = array("success" => true, "root" => $result, "total" => count($result), "Tipo"=>$tipo, "compania"=>$compania);
        
        $this->setTemplate("responseTemplate");        
    }
    
    function executeGuardarTransaccionesOut($request) {
        
        
        $datos = json_decode($request->getParameter("datos"));
        //print_r($datos->idtransaccion);
        //print_r($datos[0]->idtransaccion);
        
        
        try{
            $ids = array();
            
            $idtransaccion = $datos->idtransaccion;
            $transaccion = Doctrine::getTable("IntTransaccionesOut")->find($idtransaccion);

            if($transaccion){
                if($datos->estado_valor)
                    $transaccion->setCaEstado($datos->estado_valor);
                if($datos->tipo)
                    $transaccion->setCaIdtipo($datos->tipo);
                if($datos->indice2)
                    $transaccion->setCaIndice2($datos->indice2);
                $transaccion->save();                
            }
            array_push($ids, $datos->id);
            
            
            $this->responseArray = array("success" => true, "root" => $transaccion->getCaIdtransaccion(), "ids"=>$ids);
        }catch(Exception $e){
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()) );
        }
        
        $this->setTemplate("responseTemplate");
    }
    
    function executeDatosTiposOut($request) {
    
        $q = Doctrine::getTable("IntTipos")
                ->createQuery("t")                
                ->orderBy("ca_idtipo ASC")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
        $debug = $q->getSqlQuery();        
        $tipos = $q->execute();
        
        foreach ($tipos as $k => $c) {
            $tipos[$k]["tipo"] = $tipos[$k]["t_ca_idtipo"]." - ".utf8_encode($tipos[$k]["t_ca_nombre"]);
        }
 
        $this->responseArray = array("success" => true, "root" => $tipos, "total" => count($tipos), "debug" => $debug);
        
        $this->setTemplate("responseTemplate");        
    }
    
    function executeDatosTiposIn($request) {
        
        $data = array();
        
        $data[] = array("ca_idtipo"=>1, "ca_tipo"=>"Factura de Compra");
        $data[] = array("ca_idtipo"=>2, "ca_tipo"=>utf8_encode("Cancelaci?n de comprobantes"));
        $data[] = array("ca_idtipo"=>3, "ca_tipo"=>utf8_encode("Pagos Recibidos"));
        $data[] = array("ca_idtipo"=>4, "ca_tipo"=>utf8_encode("Activaci?n Cliente"));
        $data[] = array("ca_idtipo"=>5, "ca_tipo"=>utf8_encode("Activaci?n Conceptos"));
        
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        
        $this->setTemplate("responseTemplate");        
    }    
    
    function getToken($client){
        //ProjectConfiguration::registerZend();
        //$this->hostFE = "https://apiqa.etlqa.open-eb.io/81" ;
        $username = "maquinche@coltrans.com.co";
        $password = "123456";
        
        //$client = new Zend_Http_Client();

        $uri = $this->hostFE . "/api/login";
        $client->setUri($uri);

        $client->setHeaders('Content-Type', 'application/x-www-form-urlencoded');
        $client->setHeaders('X-Requested-With', 'XMLHttpRequest');
        $client->setHeaders('Accept', 'application/json');
        $client->setHeaders('Authorization', 'Bearer Token');

        
        
        $client->setEncType(Zend_Http_Client::ENC_URLENCODED);
        //$client->setAuth($username, $password, Zend_Http_Client::AUTH_BASIC); // Este m?todo de autenticaci?n dej? de funcionar inexplicablemente Dic 23/2019
        $client->setMethod(Zend_Http_Client::POST);
        
        $client->setParameterPost("email", "maquinche@coltrans.com.co" );
        $client->setParameterPost("password", "123456");
        //echo "dd";
        //exit;
        $result = $client->request();
        
        //print_r($result->getBody());
        $tk= json_decode($result->getBody());
        //print_r($tk);
        //echo "<br>".$tk->token."<br>";
        return $tk->token;
        
    }
    
    
    
    function executeOpenEb($request) {
        
       ProjectConfiguration::registerZend();
        $client = new Zend_Http_Client();
  
        $tk=$this->getToken($client);
        
        
        $uri = $this->hostFE . "/api/parametros/lista-paises";
        $client->setUri($uri);

        $client->setHeaders('Content-Type', 'application/x-www-form-urlencoded');
        $client->setHeaders('X-Requested-With', 'XMLHttpRequest');
        $client->setHeaders('Accept', 'application/json');
        $client->setHeaders('Authorization', 'Bearer '.$tk);
 
        //$client->setUri("/parametros/lista-paises?start=0&length=10&buscar=&columnaOrden=codigo&ordenDireccion=asc");
        $client->setParameterGet("start", "0" );
        $client->setParameterGet("length", "10");
        $client->setParameterGet("buscar", "");
        $client->setParameterGet("columnaOrden", "codigo");
        $client->setParameterGet("columnaOrden", "codigo");
        $client->setParameterGet("ordenDireccion", "ASC");
        //$client->request(Zend_Http_Client::GET);
        
        
        $result1 = $client->request(Zend_Http_Client::GET);
        
        print_r($result1->getBody());
        exit;
        
        $this->responseArray = array("success" => true, "root" => $result, "total" => count($result), "debug" => "Json=>".$json." Tipo=>".$tipo." Compania=>".$compania);
        
        $this->setTemplate("responseTemplate");        
    }
    
 
    function executeGetJsonDocumentoFE(sfWebRequest $request)
    {       
        $idcomprobante=$request->getParameter("idcomprobante");        
        $result1 =IntTransaccionesOut::enviarDocumentoFE($idcomprobante,true);
        print_r($result1->getBody());
        exit();
    }
    function executeGetJsonClienteFE(sfWebRequest $request)
    {
        ProjectConfiguration::registerZend();
        $client = new Zend_Http_Client();
  
        $tk=$this->getToken($client);
        $idcliente=$request->getParameter("idcliente");
        //860003168
        $datosJson=IntTransaccionesOut::documentoFECliente($idcliente);
        echo "<pre>";print_r($datosJson);echo "</pre>";
        echo "<pre>";json_encode($datosJson);echo "</pre>";
        
        
        $uri = $this->hostFE . "/api/configuracion/adquirentes";
        $client->setUri($uri);

        $client->setHeaders('Content-Type', 'application/json');
        $client->setHeaders('X-Requested-With', 'XMLHttpRequest');
        $client->setHeaders('Accept', 'application/json');
        $client->setHeaders('Authorization', 'Bearer '.$tk);

        
        $client->setRawData(json_encode($datosJson));
        
        
        $result1 = $client->request('POST');
        
        print_r($result1->getBody());
        exit;
        
        $this->responseArray = array("success" => true, "root" => $result, "total" => count($result), "debug" => "Json=>".$json." Tipo=>".$tipo." Compania=>".$compania);
        
        $this->setTemplate("responseTemplate");
        
        //$datosJson=IntTransaccionesOut::documentoFECliente(800024075);
        echo "<pre>";print_r($datosJson);echo "</pre>";
        //echo "<pre>";print_r($datosJson);echo "</pre>";
        
        exit();
    }
    
    function executeGetJsonDepartamentosFE(sfWebRequest $request)
    {
        ProjectConfiguration::registerZend();
        $client = new Zend_Http_Client();
  
        $tk=$this->getToken($client);
        
        $datosJson=IntTransaccionesOut::documentoFECliente(800024075);
        
        
            $uri = $this->hostFE . "/api/parametros/lista-departamentos";
            $client->setUri($uri);

            $client->setHeaders('Content-Type', 'application/x-www-form-urlencoded');
            $client->setHeaders('X-Requested-With', 'XMLHttpRequest');
            $client->setHeaders('Accept', 'application/json');
            $client->setHeaders('Authorization', 'Bearer '.$tk);
 
        //$client->setUri("/parametros/lista-paises?start=0&length=10&buscar=&columnaOrden=codigo&ordenDireccion=asc");
        $client->setParameterGet("start", "0" );
        $client->setParameterGet("length", "-1");
        $client->setParameterGet("buscar", "");
        $client->setParameterGet("columnaOrden", "codigo");        
        $client->setParameterGet("ordenDireccion", "ASC");
        //$client->request(Zend_Http_Client::GET);
        //$client->setRawData(json_encode($datosJson));
        
        
        $result1 = $client->request('GET');
        $json_result= json_decode($result1->getBody());
        //echo "<pre>";print_r($json_result);echo "</pre>";
        echo "<br>";
        foreach($json_result->data as $d)
        {
            echo $d->dep_codigo.":".utf8_decode($d->dep_descripcion)."<br>";
        }
        exit;
        
        $this->responseArray = array("success" => true, "root" => $result, "total" => count($result), "debug" => "Json=>".$json." Tipo=>".$tipo." Compania=>".$compania);
        
        $this->setTemplate("responseTemplate");
        
        $datosJson=IntTransaccionesOut::documentoFECliente(800024075);
        echo "<pre>";print_r($datosJson);echo "</pre>";
        exit();
    }
    
    function executeGetDocumentsFE(sfWebRequest $request)
    {
        ProjectConfiguration::registerZend();
        $client = new Zend_Http_Client();  
        $tk=$this->getToken($client);
        $idcomprobante=$request->getParameter("idcomprobante");        
        $r=IntTransaccionesOut::consultarDocumentoFE($idcomprobante);
         
        $this->responseArray = array("data" => $r, "success" => $success);
        $this->setTemplate("responseTemplate");
    }
    //{{URL_API}}/81/api/emision/documentos/consultar/ofe/{ofe_identificacion}/prefijo/{prefijo}/consecutivo/{consecutivo}
    
    
    function executeGetPdfDocumentoFE(sfWebRequest $request)
    {
        ProjectConfiguration::registerZend();
        $client = new Zend_Http_Client();  
        $tk=$this->getToken($client);        
        $uri = $this->hostFE1 . "/81/api/emision/documentos/obtener-pdf";        
        $client->setUri($uri);        
        $client->setEncType(Zend_Http_Client::ENC_URLENCODED);        
        $client->setMethod(Zend_Http_Client::POST);
        $client->setHeaders('Content-Type', 'application/x-www-form-urlencoded');
        $client->setHeaders('Authorization', 'Bearer '.$tk);
       
        /*$client->setParameterPost("'resultado", "base64" );
        $client->setParameterPost("ofe_identificacion", "800024075");
        $client->setParameterPost("tipo_documento", "FC");
        $client->setParameterPost("prefijo", "null");
        $client->setParameterPost("consecutivo", "720478");*/
        
        $data='resultado=base64   \\'. 
            'ofe_identificacion=800024075\\'. 
            'tipo_documento=FC\\' .
            'prefijo=null\\'.
            'consecutivo=720478';
        
        $client->setRawData($data);
        
        
        $result1 = $client->request('POST');
        
        print_r($result1->getBody());
        
        
        
        exit;
        
    //    $this->responseArray = array("success" => true, "root" => $result, "total" => count($result), "debug" => "Json=>".$json." Tipo=>".$tipo." Compania=>".$compania);
        
//        $this->setTemplate("responseTemplate");
        
        //$datosJson=IntTransaccionesOut::documentoFECliente(800024075);
        echo "<pre>";print_r($datosJson);echo "</pre>";
        //echo "<pre>";print_r($datosJson);echo "</pre>";
        
        exit();
    }
    
    function executeRevisionComprobantes(sfWebRequest $request)
    {
        try{
            $logFile = sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR . "facturas.log";
            $con = Doctrine_Manager::getInstance()->getConnection('master');
            $hoy = date('Y-m-d H:i:s');
            
            list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($hoy, "%d-%d-%d %d:%d:%d");
            $fchini = date('Y-m-d H:i:s', mktime($hor-1, $min, $seg, $mes, $dia, $ano));
            $fchend = date('Y-m-d H:i:s', mktime($hor, $min, $seg, $mes, $dia, $ano));
            
            $sql="
                SELECT c.ca_idcomprobante, t.ca_idtransaccion
                FROM integracion.tb_transaccionesout t
                    INNER JOIN ino.tb_comprobantes c ON c.ca_idcomprobante = t.ca_indice1::int
                WHERE t.ca_idtipo in (7,13) and ca_fchenvio BETWEEN '".$fchini."' AND '".$fchend."' AND (t.ca_estado = 'P' OR c.ca_estado = 5)";
            
            $stmt = $con->execute($sql);
            $datos = $stmt->fetchAll();
            
            $result = [];
            
//            echo "<pre>";print_r($datos);echo "<pre>";
//            exit;
            if(count($datos)> 0){
                foreach($datos as $dato){
                    $comp = Doctrine::getTable("InoComprobante")->find($dato["ca_idcomprobante"]);
                    $tipo = Doctrine::getTable("InoTipoComprobante")->find($comp->getCaIdtipo());
                    $empresa = $tipo->getSucursal()->getEmpresa();

                    $idmaster = null;
                    if($comp->getCaIdhouse()){
                        $idmaster = $comp->getInoHouse()->getCaIdmaster();
                        $master = Doctrine::getTable("InoMaster")->find($idmaster);                    
                    }

                    $error = array();

                    $resComp=IntTransaccionesOut::getDocuments($dato["ca_idtransaccion"]);
                    sleep (7); 
                    if(is_array($resComp) && count($resComp)==0){                    
                        $result[] = array("empresa"=>$empresa->getCaNombre(),"idcomprobante"=>$comp->getCaIdcomprobante(),"referencia"=>$referencia,"consecutivo"=>$tipo->getCaTipo().$tipo->getCaComprobante()."-".$comp->getCaConsecutivo(), "error"=>true, "mensaje"=> "No existe el documento en SAP", "idtransaccion"=>$dato["ca_idtransaccion"]);                                        
                    }else if(count($resComp)>0){

                        $resComp=$resComp[0];

                        $neto=floatval($resComp->VlrNeto);
                        $imp=floatval($resComp->VlrImpuestos);
                        $trm=floatval($resComp->DocRate);
                        $autoret=floatval($resComp->AutoRetencion);

                        $total=0;
                        $total2=(($neto-$imp)*$trm);
                        $top_codigo="10";
                        foreach($resComp->Lineas as $l)
                        {
                            $v=floatval($l->VlrArticulo);
                            $total+= $v;                                
                        }

                        $datosjson=json_decode(utf8_encode($comp->getCaDatos()));    

                        if(round($comp->getCaValor(),2) != round($total,2)){
                            $error[] = "El Valor Total de la factura está diferente. En SAP: ".$total. " En Colsys: ". $comp->getCaValor();
                        }

                        if($comp->getCaValor2() != $neto){
                            $error[] = "El Valor sin impuestos de la factura está diferente. En SAP: ".$neto. " En Colsys: ". $comp->getCaValor2();
                        }

                        if($datosjson->iva != $resComp->VlrImpuestos){
                            $error[] = "El Valor de Iva de la factura es diferente. En SAP: ".$resComp->VlrImpuestos. " En Colsys: ". $datosjson->iva;
                        }

                        if($datosjson->rteiva != $resComp->ReteIva){
                            $error[] = "El Valor de ReteIva de la factura es diferente. En SAP: ".$resComp->ReteIva. " En Colsys: ". $datosjson->rteiva;
                        }

                        if($datosjson->rteica != $resComp->ReteIca){
                            $error[] = "El Valor de ReteIva de la factura es diferente. En SAP: ".$resComp->ReteIca. " En Colsys: ". $datosjson->rteica;
                        }

                        if($datosjson->rtefuente != $resComp->ReteFuente){
                            $error[] = "El Valor de ReteFuente de la factura es diferente. En SAP: ".$resComp->ReteFuente. " En Colsys: ". $datosjson->rtefuente;
                        }

                        if($datosjson->autoretencion != $resComp->AutoRetencion){
                            $error[] = "El Valor de Autoretención de la factura es diferente. En SAP: ".$resComp->AutoRetencion. " En Colsys: ". $datosjson->autoretencion;
                        }

                        $referencia = $idmaster?"<a href='https://www.colsys.com.co/inoF2/indexExt5/idmaster/$idmaster' target='_blank'>".$master->getCaReferencia()."</a>":null;

                        if(count($error)>0){
                            $result[] = array("empresa"=>$empresa->getCaNombre(),"idcomprobante"=>$comp->getCaIdcomprobante(),"usugenero"=>$comp->getCaUsugenero(),"referencia"=>$referencia,"consecutivo"=>$tipo->getCaTipo().$tipo->getCaComprobante()."-".$comp->getCaConsecutivo(), "error"=>true, "mensaje"=> implode(",", $error), "idtransaccion"=>$dato["ca_idtransaccion"]);
                        }else
                            $result[] = array("empresa"=>$empresa->getCaNombre(),"idcomprobante"=>$comp->getCaIdcomprobante(),"referencia"=>$referencia,"consecutivo"=>$tipo->getCaTipo().$tipo->getCaComprobante()."-".$comp->getCaConsecutivo(), "error"=>false, "mensaje"=> "Sin errores", "idtransaccion"=>$dato["ca_idtransaccion"]);


                    }else{
                        $result[] = array("empresa"=>$empresa->getCaNombre(),"idcomprobante"=>$comp->getCaIdcomprobante(),"referencia"=>$referencia,"consecutivo"=>$tipo->getCaTipo().$tipo->getCaComprobante()."-".$comp->getCaConsecutivo(), "error"=>true, "mensaje"=> "Servidor no responde", "idtransaccion"=>$dato["ca_idtransaccion"]);                    
                    }
                }
//                echo "<pre>";print_r($result);"</pre>";
//                exit;
                $table = "<table width='100%' style='border-collapse: collapse; border: 1px solid;>'";
                $table.= "<tr style=border: 1px solid;'><th colspan='7' style='text-align: center; border: 1px solid;'>Comprobantes Verificados: ".$fchini." a ".$fchend."</th></tr>";
                $table.= "<tr style=border: 1px solid;'><th style='text-align: center; border: 1px solid;'>Empresa</th><th style='text-align: center; border: 1px solid;'>Idcomprobante</th><th style='text-align: center; border: 1px solid;'>Consecutivo</th><th style='text-align: center; border: 1px solid;'>Referencia</th><th style='text-align: center; border: 1px solid;'>Error</th><th>Mensaje</th><th style='text-align: center; border: 1px solid;'>Transaccion (GetDocument)</th></tr>";

                $errores = 0;
                foreach ($result as $key => $valor){                
                    
                    $color = "green";
                    $error = "NO";
                    $idtransaccion = $valor["idtransaccion"];

                    if($valor["error"]){
                        
                        $errores++;
                        $error = "SI";
                        $color = "red";

                        $arrayEmails = [];
                        $arrayEmails[] = "admin@coltrans.com.co";

                        $usuario = Doctrine::getTable("Usuario")->find($valor["usugenero"]);
                        if($usuario){
                            if($usuario->getCaEmail()){
                                $arrayEmails[] = $usuario->getCaEmail();
                            }
                        }

                        foreach ($arrayEmails as $key => $val){
                            $emails.= $val.",";
                        }                   
                        $data = array();
                        $data["idcaso"] = $idtransaccion;                        
                        $data["to"] = substr($emails, 0, -1);
                        $data["subject"] = "Inconsistencias Colsys Vs Sap Comprobante Id. ".$valor['ca_idcomprobante'];

                        $table.= "<tr style='border: 1px solid; color:$color'>"
                        . "<td>".$valor["empresa"]."</td>"
                        . "<td>".$valor["idcomprobante"]."</td>"
                        . "<td>".$valor["consecutivo"]."</td>"
                        . "<td>".$valor["referencia"]."</td>"
                        . "<td>".$error."</td>"
                        . "<td>".$valor["mensaje"]."</td>"
                        . "<td><a href='https://www.colsys.com.co/integraciones/getDocument/idtransaccion/$idtransaccion' target='_blank'>".$idtransaccion."</a></td></tr>";                        

                        $body = "La siguiente factura tiene inconsistencias con los registros en SAP".
                        $body.= "</table>".$table;
                        $data["body"] = $body;

                        Utils::sendEmail($data);

                    }else{                                           

                        $table.= "<tr style='border: 1px solid; color:$color'>"
                        . "<td>".$valor["empresa"]."</td>"
                        . "<td>".$valor["idcomprobante"]."</td>"
                        . "<td>".$valor["consecutivo"]."</td>"
                        . "<td>".$valor["referencia"]."</td>"
                        . "<td>".$error."</td>"
                        . "<td>".$valor["mensaje"]."</td>"
                        . "<td><a href='https://www.colsys.com.co/integraciones/getDocument/idtransaccion/$idtransaccion' target='_blank'>".$idtransaccion."</a></td></tr>";

                    }
                }
                if($errores == 0){
            
                    $table.= "</table>";
                    $data = array();

                    $data["subject"] = "Verificación de comprobantes generados desde Colsys: ". $fchini. " a ".$fchend;
                    $data["mensaje"] = $table;
                    $data["tipo"] = "Verificacion";                    
                    Utils::writeLog($logFile, date("Y-m-d H:i:s")."=>".$data["subject"]."\n".$data["mensaje"]);    
                    //Utils::sendEmail($data);
                }

            }else{
                $data = array();
                $data["subject"] = "Verificación de comprobantes generados desde Colsys: ". $fchini. " a ".$fchend;
                $data["mensaje"] = "Esta consulta no arrojó resultados";
                $data["tipo"] = "Verificacion";
                Utils::writeLog($logFile, date("Y-m-d H:i:s")."=>".$data["subject"]."<\n>".$data["mensaje"]);    
                //Utils::sendEmail($data);
            }
            
        }catch(Exception $e){
            echo $e->getMessage();
            
            $data = array();

            $data["subject"] = "Verificación de comprobantes generados desde Colsys: ". $fchini;
            $data["mensaje"] = $e->getMessage();
            $data["tipo"] = "Verificacion";
            
            Utils::sendEmail($data);
        }
        echo "# de comprobantes revisados".count($datos);
        $this->setTemplate("responseTemplate");        
        
        
    }
 /*   client = new Zend_Rest_Client('http://framework.zend.com/rest');
 
echo $client->sayHello('Davey', 'Day')->get();*/
}
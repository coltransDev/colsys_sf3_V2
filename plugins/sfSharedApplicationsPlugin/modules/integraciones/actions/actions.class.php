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
    
    
    
    
    
    public function executeEnviarSap(sfWebRequest $request) {
        //echo $request->getParameter("idtransaccion");
        //$resul=IntTransaccionesOut::enviarWs($idtransaccion);   
        $respuesta=IntTransaccionesOut::enviarWs($request->getParameter("idtransaccion"));
        //$reporte=IntTransaccionesOut::reporteErrores();
        //exit;
        $this->responseArray = array("respuesta" => $respuesta, "success" => true);        
        $this->setTemplate("responseTemplate");
        
    }
    
    public function executeGetDocument(sfWebRequest $request) {
        //echo "dd";
        //$resul=IntTransaccionesOut::enviarWs($idtransaccion);            
        $respuesta=IntTransaccionesOut::getDocuments($request->getParameter("idtransaccion"));
        //exit;
        $this->responseArray = array("respuesta" => $respuesta, "success" => true);        
        $this->setTemplate("responseTemplate");
        
    }
    
    function executeDatosTransaccionesOut($request) {
        
        $q = Doctrine::getTable("IntTransaccionesOut")
                ->createQuery("it")
                ->leftJoin("it.IntTipos t")
                ->orderBy("ca_idtransaccion DESC")                
                ->limit(500);
        
        if($request->getParameter("idtipo")){
            $q->addWhere("it.ca_idtipo = ?", $request->getParameter("idtipo"));
        }
                //->addWhere("ca_idtransaccion > ? OR ca_idtransaccion < ?",array(1170, 1168))
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
        $debug = $q->getSqlQuery();
        
        $transacciones = $q->execute();
        
        foreach ($transacciones as $k => $c) {
            $transacciones[$k]["it_ca_datos"] = utf8_encode($transacciones[$k]["it_ca_datos"]);
            $transacciones[$k]["it_ca_respuesta"] = utf8_encode($transacciones[$k]["it_ca_respuesta"]);
            $transacciones[$k]["tipo"] = utf8_encode($transacciones[$k]["it_ca_idtipo"])." - ". utf8_encode($transacciones[$k]["t_ca_nombre"]);
            
            switch($transacciones[$k]["it_ca_estado"]){
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
        
        $q = Doctrine::getTable("IntTransaccionesIn")
                ->createQuery("it")
                ->orderBy("ca_idtransaccion DESC")
                //->limit(200)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
        $debug = $q->getSqlQuery();
        
        $transacciones = $q->execute();
        
        
        foreach ($transacciones as $k => $c) {
            $transacciones[$k]["it_ca_datos"] = utf8_encode($transacciones[$k]["it_ca_datos"]);
            $transacciones[$k]["it_ca_respuesta"] = utf8_encode($transacciones[$k]["it_ca_respuesta"]);
            
            switch($transacciones[$k]["it_ca_tipo"]){
                case 1:
                    $transacciones[$k]["it_ca_tipodet"] = "Factura de Compra";
                    break;
                case 2:
                    $transacciones[$k]["it_ca_tipodet"] = utf8_encode("Cancelación de comprobantes");
                    break;
                case 3:
                    $transacciones[$k]["it_ca_tipodet"] = utf8_encode("Pagos Recibidos");
                    break;
                case 4:
                    $transacciones[$k]["it_ca_tipodet"] = utf8_encode("Activación Cliente");
                    break;
                case 5:
                    $transacciones[$k]["it_ca_tipodet"] = utf8_encode("Activación Conceptos");
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
        $wsdl_uri = "http://190.85.222.218/ws/sap/IntegracionSapWS?wsdl";               
        $client = new Zend_Soap_Client($wsdl_uri, array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 , 'login'=>'seidor', 'password'=>'=Ye7zdT5u8$SDt#V'));       
       
        $json = $request->getParameter("datos");
        $tipo = $request->getParameter("tipo");
        $compania = $request->getParameter("compania");
        
        $result =  $client->tipoSolicitud( $compania, '9011', $tipo, $json);
        $this->responseArray = array("success" => true, "root" => $result, "total" => count($result), "debug" => "Json=>".$json." Tipo=>".$tipo." Compania=>".$compania);
        
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
    
    function executeDatosTipos($request) {
    
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
    
}
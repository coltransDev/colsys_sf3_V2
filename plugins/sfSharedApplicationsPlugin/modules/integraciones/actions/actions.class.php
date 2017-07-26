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


    public function executeIndex(sfWebRequest $request) {
        
    }
    
    public function executeProcesarTransacciones(sfWebRequest $request) {
        
        
        $q = Doctrine::getTable("IntTransaccionesOut")
                            ->createQuery("tr")
                            ->select("*")
                            ->innerJoin("tr.IntTipos s")
                            ->where("tr.ca_estado=? and tr.ca_datos is null", "A");

        if( $request->getParameter("idtipo")!=""  &&  $request->getParameter("indice1")!="" )
        {
            $q->addWhere("tr.ca_idtipo = ? and ca_indice1=?", array($request->getParameter("idtipo"),$request->getParameter("indice1")));
        }
        $transacciones =$q->execute();
        
        foreach($transacciones as $tr)
        {            
            eval("\$this->json".$tr->getIntTipos()->getCaNombre()."(\$tr);");
            $idtransaccion=$tr->getCaIdtransaccion();
        }
        echo $idtransaccion;
        return $idtransaccion;
        exit;
    }
    
    public function jsonReferencias($transaccion) {
        
        $master = Doctrine::getTable("InoMaster")
                          ->createQuery("m")
                          ->select("*")
                          ->where($transaccion->getIntTipos()->getCaIndice1()." = ?", $transaccion->getCaindice1())
                          ->execute();
        
        
        $datos["Usuario"]="Colsys";
        $datos["Password"]="colsys";
        $datos["Company"]="1";
        $datos["System"]="2";
        $datos["Codigo"]=$master->getCaReferencia();
        $datos["Nombre"]=$master->getCaImpoexpo()."-".$master->getCaTransporte();
        $datos["FechaInicio"]=date("yyyy/mm/dd");
        $datos["Estado"]="A";        
        
        $transaccion->setCaEstado("G");
        $transaccion->setCaDatos(json_encode($datos));
        $transaccion->save();
        
    }
    
    public function jsonClientes($transaccion) {
        
        $reg = Doctrine::getTable("Cliente")
                          ->createQuery("c")
                          ->select("*")
                          ->where($transaccion->getIntTipos()->getCaIndice1()." = ?", $transaccion->getCaindice1())
                          ->execute();

        $datos["Usuario"]="Colsys";
        $datos["Password"]="colsys";
        $datos["Company"]="1";
        $datos["System"]="2";

        $datos["Tipo"]="C";
        $datos["EstadoSN"]="N";
        $datos["CodSN"]="C".$reg->getCaIdalterno();
        $datos["NombreSN"]=$reg->getCaCompania();
        $datos["NombreExtranjero"]=$reg->getCaCompania();
        $datos["Grupo"]="";
        $datos["Identificacion"]=$reg->getCaIdalterno();
        $datos["Fax"]="";
        $datos["Telefono"]="";
        $datos["Email"]="";
        $datos["CondicionPago"]="";
        $datos["LimiteCredito"]="";
        $datos["EmpVenta"]="";
        $datos["Activo"]="";
        
        $datos["Direcciones"]=$this->getJsonDirecciones($reg->getIds());        
        $datos["Contactos"]=$this->getJsonContatos($reg->getIds());
        
        $transaccion->setCaEstado("G");
        $transaccion->setCaDatos(json_encode($datos));
        $transaccion->save();
    }
    
    public function jsonAgentes($transaccion) {
        
         $reg = Doctrine::getTable("Ids")
                          ->createQuery("i")
                          ->select("*")
                          ->where($transaccion->getIntTipos()->getCaIndice1()." = ?", $transaccion->getCaindice1())
                          ->fetchOne();

        $datos["Usuario"]="Colsys";
        $datos["Password"]="colsys";
        $datos["Company"]="1";
        $datos["System"]="2";

        $datos["Tipo"]="P";
        $datos["EstadoSN"]="N";
        $datos["CodSN"]="A".$reg->getCaIdalterno();
        $datos["NombreSN"]=$reg->getCaNombre();
        $datos["NombreExtranjero"]=$reg->getCaNombre();
        $datos["Grupo"]="";
        $datos["Identificacion"]=$reg->getCaIdalterno();
        $datos["Fax"]="";
        $datos["Telefono"]="";
        $datos["Email"]="";
        $datos["CondicionPago"]="";
        $datos["LimiteCredito"]="";
        $datos["EmpVenta"]="";
        $datos["Activo"]="";

        $datos["Direcciones"]=$this->getJsonDireContac($reg);
        $datos["Contactos"]=$this->getJsonContatos($reg);

        $transaccion->setCaEstado("G");
        $transaccion->setCaDatos(json_encode($datos));
        $transaccion->save();
    }
    
    public function jsonProveedores($transaccion) {
        
         $reg = Doctrine::getTable("Ids")
                          ->createQuery("i")
                          ->select("*")
                          ->where($transaccion->getIntTipos()->getCaIndice1()." = ?", $transaccion->getCaindice1())
                          ->fetchOne();

        $datos["Usuario"]="Colsys";
        $datos["Password"]="colsys";
        $datos["Company"]="1";
        $datos["System"]="2";

        $datos["Tipo"]="P";
        $datos["EstadoSN"]="N";
        $datos["CodSN"]="P".$reg->getCaIdalterno();
        $datos["NombreSN"]=$reg->getCaNombre();
        $datos["NombreExtranjero"]=$reg->getCaNombre();
        $datos["Grupo"]="";
        $datos["Identificacion"]=$reg->getCaIdalterno();
        $datos["Fax"]="";
        $datos["Telefono"]="";
        $datos["Email"]="";
        $datos["CondicionPago"]="";
        $datos["LimiteCredito"]="";
        $datos["EmpVenta"]="";
        $datos["Activo"]="";

        $datos["Direcciones"]=$this->getJsonDireContac($reg);
        $datos["Contactos"]=$this->getJsonContatos($reg);

        $transaccion->setCaEstado("G");
        $transaccion->setCaDatos(json_encode($datos));
        $transaccion->save();
    }
    
    public function jsonEmpleados($transaccion) {
        
         $reg = Doctrine::getTable("Usuario")
                          ->createQuery("u")
                          ->select("*")
                          ->where($transaccion->getIntTipos()->getCaIndice1()." = ?", $transaccion->getCaindice1())
                          ->fetchOne();

        $datos["Usuario"]="Colsys";
        $datos["Password"]="colsys";
        $datos["Company"]="1";
        $datos["System"]="2";

        $datos["Tipo"]="P";
        $datos["EstadoSN"]="N";
        $datos["CodSN"]="E".$reg->getCaDocidentidad();
        $datos["NombreSN"]=$reg->getCaNombre();
        $datos["NombreExtranjero"]=$reg->getCaNombre();
        $datos["Grupo"]="";
        $datos["Identificacion"]=$reg->getCaDocidentidad();
        $datos["Fax"]="";
        $datos["Telefono"]=$reg->getCaTeloficina();
        $datos["Email"]=$reg->getCaEmail();
        $datos["CondicionPago"]="";
        $datos["LimiteCredito"]="";
        $datos["EmpVenta"]="Y";
        $datos["Activo"]="";

        //$datos["Direcciones"]=$this->getJsonDireContac($reg);
        //$datos["Contactos"]=$this->getJsonContatos($reg);

        $transaccion->setCaEstado("G");
        $transaccion->setCaDatos(json_encode($datos));
        $transaccion->save();
    }
    
    
    public function getJsonDireContac($ids)
    {
        $dir=$contactos=array();
        $suc=$ids->IdsSucursal();
        foreach($suc as  $k=>$s)
        {
            $dir[$k]["Tipo"]="Colsys";
            $dir[$k]["EsPrincipal"]=($s->getCaPrincipal()?"Y":"N");
            $dir[$k]["CodDireccion"]=$s->getCiudad()->getCaCiudad();
            $dir[$k]["Direccion"]=$s->getCaDireccion();
            $dir[$k]["CodigoPais"]=$s->getCiudad()->getTrafico()->getCaIdTrafico();
            $dir[$k]["Municipio"]=$s->getCiudad()->getCaDivipola();
            $dir[$k]["Telefono"]=$s->getCaTelefonos();
            $contactos=array_merge($contactos,getJsonContactos($s));
        }
    }
    
    public function getJsonContactos($suc)
    {
        $contactos=array();
        $con=$ids->IdsContacto();
        foreach($con as  $k=>$c)
        {
            if($c->getCaActivo())
            {
                /*ca_nombres: string(60)
    ca_papellido: string(60)
    ca_sapellido: string(60)*/
                $pos=strpos($c->getCaNombres(), " ");
                if($pos>0)
                {
                    $pnombre= substr($c->getCaNombres(), 0,$pos-1);
                    $snombre= substr($c->getCaNombres(), $pos, (strlen($c->getCaNombres())-$pos));
                }
                //$nombre=
                $contactos[$k]["IDContacto"]=$c->getCaIdcontacto();
                $contactos[$k]["Nombre"]=$pnombre; 
                $contactos[$k]["SegundoNombre"]= $snombre;
                $contactos[$k]["Apellido"]=$c->getCapapellido(). " ".$c->getCasapellido();
                $contactos[$k]["Direccion"]=$c->getCaDireccion();
                $contactos[$k]["Telefono"]=$c->getCaTelefonos();
                $contactos[$k]["Correo"]=$c->getCaEmail();
                $contactos[$k]["Cargo"]=$c->getCaCargo();
            }
        }
    }
    
    public function jsonConceptos($transaccion) {
        
         $reg = Doctrine::getTable("InoMaestraConceptos")
                          ->createQuery("u")
                          ->select("*")
                          ->where($transaccion->getIntTipos()->getCaIndice1()." = ?", $transaccion->getCaindice1())
                          ->fetchOne();

        $datos["Usuario"]="Colsys";
        $datos["Password"]="colsys";
        $datos["Company"]="1";
        $datos["System"]="2";

        $datos["ItemCode"]=$reg->getCaIdconcepto();
        $datos["ItemName"]=$reg->getCaCpncepto_esp();
        $datos["U_SEI_Estado"]="N";
        $datos["Venta"]=($reg->getCaVenta()=="1" || $reg->getCaVenta()=="true" || $reg->getCaVenta()==true)?"Y":"N";
        $datos["Compra"]=($reg->getCaCompra()=="1" || $reg->getCaCompra()=="true" || $reg->getCaCompra()==true)?"Y":"N";
        /*$datos[""]="";
        $datos[""]="";
        $datos[""]="";*/
        

        //$datos["Direcciones"]=$this->getJsonDireContac($reg);
        //$datos["Contactos"]=$this->getJsonContatos($reg);

        $transaccion->setCaEstado("G");
        $transaccion->setCaDatos(json_encode($datos));
        $transaccion->save();
    }
    
    public function jsonFacturasV($transaccion){
        
        $reg = Doctrine::getTable("InoComprobante")
                ->createQuery("c")
                ->select("*")
                ->where($transaccion->getIntTipos()->getIndice1()."= ?", $transaccion->getCaIndice1())
                ->fetchOne();
        
        $tipoComprobante = Doctrine::getTable("InoTipoComprobante")->find($reg->getCaIdtipo());
        $ccostos = Doctrine::getTable("InoCentroCosto")->find($reg->getCaIdccosto());
        
        $datos["Usuario"]="Colsys";
        $datos["Password"]="colsys";
        $datos["Company"]= $tipoComprobante->getCaIdempresa(); // Pendiente definir en tabla de empresas los Id de SAP
        $datos["System"]="2";
        
        $datos["Tipo"]="V";
        $datos["CodigoDoc"] = $tipoComprobante->getCaTipo();
        $datos["SerieNum"] = $tipoComprobante->getCaComprobante();
        $datos["NumeroInterno"] = $reg->getCaConsecutivo();
        $datos["CodSN"] = "C";
        $datos["DocDate"] = date("Y-m-d");
        $datos["DocDueDate"] = date('Y-m-d', strtotime($reg->getCaFchComprobante(). ' + '.$reg->getCaPlazo().' days')); // Pendiente asociar el plazo con el asignado al proveedor        
        $datos["Observaciones"] = $reg->getCaObservaciones();
        $datos["Moneda"] = $reg->getCaIdmoneda();
        $datos["TRM"] = $reg->getCaTcambio();
        $datos["Destino"] = "";// Pendiente por definir
        
        //Lineas        
        $lineas = Doctrine::getTable("InoDetalle")
                ->createQuery("d")
                ->select("*")
                ->where($transaccion->getIntTipos()->getIndice1()."= ?", $reg->getCaIdcomprobante())
                ->execute();
        
        $ccosto_sap = json_decode($ccostos->getCaCcostosap());
        
        foreach($lineas as $linea){
            $datos["CodArticulo"] = $linea->getCaIdconcepto();
            $datos["Cantidad"] = 1;
            $datos["PrecioUnitario"] = $linea->getCaCr();
            $datos["Linea"] = $ccosto_sap->idlinea;
            $datos["Departamento"] = $ccosto_sap->iddepartamento       ;
            $datos["Area"] = $ccosto_sap->idarea;
            //$datos["Dimension5"] =
            $datos["Proyecto"] = $linea->getInoMaster()->getCaReferencia();
        }
        
        $transaccion->setCaEstado("G");
        $transaccion->setCaDatos(json_encode($datos));
        $transaccion->save();
    }
    
    public function jsonFacturasC($transaccion){
        
        $reg = Doctrine::getTable("InoComprobante")
                ->createQuery("c")
                ->select("*")
                ->where($transaccion->getIntTipos()->getIndice1()."= ?", $transaccion->getCaIndice1())
                ->fetchOne();
        
        $tipoComprobante = Doctrine::getTable("InoTipoComprobante")->find($reg->getCaIdtipo());
        $ccostos = Doctrine::getTable("InoCentroCosto")->find($reg->getCaIdccosto());
        
        $datos["Usuario"]="Colsys";
        $datos["Password"]="colsys";
        $datos["Company"]= $tipoComprobante->getCaIdempresa(); // Pendiente definir en tabla de empresas los Id de SAP
        $datos["System"]="2";
        
        $datos["Tipo"]="C";
        $datos["CodigoDoc"] = "PU";//Factura de proveedores --Leyenda de abreviaturas de tipos de transacción 
        $datos["SerieNum"] = "#"; // Pendiente definir la serie de SAP
        $datos["NumeroInterno"] = $reg->getCaConsecutivo();
        $datos["CodSN"] = "P";
        $datos["DocDate"] = now();
        $datos["DocDueDate"] = date('Y-m-d', strtotime($reg->getCaFchComprobante(). ' + '.$reg->getCaPlazo().' days')); // Pendiente asociar el plazo con el asignado al proveedor        
        $datos["Observaciones"] = $reg->getCaObservaciones();
        $datos["Moneda"] = $reg->getCaIdmoneda();
        $datos["TRM"] = $reg->getCaTcambio();
        $datos["Destino"] = "";// Pendiente por definir
        
        //Lineas        
        $lineas = Doctrine::getTable("InoDetalle")
                ->createQuery("d")
                ->select("*")
                ->where($transaccion->getIntTipos()->getIndice1()."= ?", $reg->getCaIdcomprobante())
                ->execute();
        
        $ccosto_sap = json_decode($ccostos->getCaCcostosap());
        
        foreach($lineas as $linea){
            $datos["CodArticulo"] = $linea->getCaIdconcepto();
            $datos["Cantidad"] = 1;
            $datos["PrecioUnitario"] = $linea->getCaCr();
            $datos["Linea"] = $ccosto_sap->idlinea;
            $datos["Departamento"] = $ccosto_sap->iddepartamento       ;
            $datos["Area"] = $ccosto_sap->idarea;
            //$datos["Dimension5"] =
            $datos["Proyecto"] = $linea->getInoMaster()->getCaReferencia();
        }
        
        $transaccion->setCaEstado("G");
        $transaccion->setCaDatos(json_encode($datos));
        $transaccion->save();
    }
    
    public function jsonUtilidad($transaccion){
    
        $master = Doctrine::getTable("InoMaster")
                ->createQuery("c")
                ->select("*")
                ->where($transaccion->getIntTipos()->getCaIndice1()."= ?", $transaccion->getCaIndice1())
                ->fetchOne();
        
        $ccosto = Doctrine::getTable("InoCentroCosto")->findByDql("ca_impoexpo = ? AND ca_transporte = ?", array($master->getCaImpoexpo(), $master->getCaTransporte()))->getFirst();
        $linea = json_decode($ccosto->getCaCcostosap(), 1);

        $clientes = array();
        
        $datos["Usuario"]="Colsys";
        $datos["Password"]="colsys";
        $datos["Company"]= $master->getUsuCreado()->getSucursal()->getCaIdempresa(); // Se obtiene de la empresa a la que pertenece el usuario que la creó
        $datos["System"]="2";
        
        $datos["CodReferencia"] = $master->getCaReferencia();
        $datos["Fecha"] = $master->getCaFchcerrado();
        $datos["Comentarios"] = $master->getCaObservaciones();
        $datos["Linea"] = $linea["idlinea"];
                
        //Lineas        
        $lineas = Doctrine::getTable("InoHouse")
                ->createQuery("h")
                ->select("*")
                ->where("ca_idmaster = ?", $master->getCaIdmaster())
                ->execute();
        
        $distribucionUti = $this->calcularDistribucionxUtilidad($master, $lineas);
       
        foreach($lineas as $linea){            
            if(!in_array($linea->getCaIdcliente(), $clientes)){            
                $datos["Lineas"][] = array("CodSN"=>"C".$linea->getCaIdcliente(), "PorcUtilidad"=>$distribucionUti[$linea->getCaIdcliente()], "Sucursal"=>$linea->getVendedor()->getCaIdsucursal());
                $clientes[] = $linea->getCaIdcliente();
            }
        }
        
        echo "<pre>";print_r($datos)."</pre><br/><br/>";
        
        /*$transaccion->setCaEstado("G");
        $transaccion->setCaDatos(json_encode($datos));
        $transaccion->save();*/
        
        $this->setTemplate("responseTemplate");
    }
    
    public function jsonCostos($transaccion){
    
        $master = Doctrine::getTable("InoMaster")
                ->createQuery("c")
                ->select("*")
                ->where($transaccion->getIntTipos()->getCaIndice1()."= ?", $transaccion->getCaIndice1())
                ->fetchOne();
        
        $clientes = array();
        
        $datos["Usuario"]="Colsys";
        $datos["Password"]="colsys";
        $datos["Company"]= $master->getUsuCreado()->getSucursal()->getCaIdempresa(); // Se obtiene de la empresa a la que pertenece el usuario que la creó
        $datos["System"]="2";
        
        $datos["CodReferencia"] = $master->getCaReferencia();
        $datos["Fecha"] = $master->getCaFchcerrado();
        $datos["Comentarios"] = $master->getCaObservaciones();
                
        //Lineas        
        $lineas = Doctrine::getTable("InoHouse")
                ->createQuery("h")
                ->select("*")
                ->where("ca_idmaster = ?", $master->getCaIdmaster())
                ->execute();
        
        $costoxCliente = $this->calcularDistribucionxCostos($master, $lineas);
        $tot_costos = array_sum($costoxCliente);
       
        foreach($lineas as $linea){            
            if(!in_array($linea->getCaIdcliente(), $clientes)){            
                $datos["Lineas"][] = array("CodSN"=>"C".$linea->getCaIdcliente(), "PorcParticipa"=>round($costoxCliente[$linea->getCaIdcliente()]/$tot_costos,4));
                $clientes[] = $linea->getCaIdcliente();
            }
        }
        
        echo "<pre>";print_r($datos)."</pre><br/><br/>";
        
        /*$transaccion->setCaEstado("G");
        $transaccion->setCaDatos(json_encode($datos));
        $transaccion->save();*/
        
        $this->setTemplate("responseTemplate");
    }
    
    public function calcularDistribucionxUtilidad($master, $lineas){
        
        $clientes = array();
        $dd = array();
        
        $ingresos = Doctrine::getTable("InoViIngreso")
                ->createQuery("i")
                ->select("*")                
                ->where("ca_idmaster = ?", $master->getCaIdmaster())
                ->execute();        
        
        $deducciones = Doctrine::getTable("InoViDeduccion")
                ->createQuery("d")
                ->select("*")
                ->where("ca_idmaster = ?", $master->getCaIdmaster())
                ->execute();
        
        foreach($ingresos as $ingreso){
            $ig[$ingreso->getCaIdcliente()]+=$ingreso->getCaValor();
        }        
        $tot_ingreso = array_sum($ig);
        
        foreach($deducciones as $d){
            $dd[$d->getCaIdcliente()]+=$d->getCaValor();
        }
        $tot_deducciones = array_sum($dd);
        
        foreach($lineas as $linea){
            if(!in_array($linea->getCaIdcliente(), $clientes))
                $clientes[] = $linea->getCaIdcliente();
            }
        
        $costoxCliente = $this->calcularDistribucionxCostos($master, $lineas);
        
        foreach($clientes as $cliente){            
            $ctxCliente[$cliente]+= $costoxCliente[$cliente];
            $ut[$cliente] = $ig[$cliente]-($ctxCliente[$cliente]+$dd[$cliente]);        
        }
        $tot_utilidad = array_sum($ut);
        
        foreach($clientes as $cliente){            
            $distribucionUti[$cliente] = round($ut[$cliente]/$tot_utilidad,4);
        }
        
        /* IMPRESION DE DATOS PARA VERIFICACION  */        
        
        echo "<b>Ingresos:</b><br/>";
        echo "<pre>";print_r($ig)."</pre><br/><br/>";
        echo "<i>Total Ingresos:</i>". $tot_ingreso."<br/><br/>";
            
        echo "<b>Deducciones:</b><br/>";
        echo "<pre>";print_r($dd)."</pre><br><br>";
        echo "<i>Total Deducciones:</i>". $tot_deducciones."<br/><br/>";
        
        echo "<b>Utilidad:</b>";
        echo "<pre>";print_r($ut)."</pre><br/><br/>";        
        echo "<i>Total utilidad:</i>". $tot_utilidad."<br/><br/>";
                
        echo "<b>Distribucion x Utilidad:</b>";
        echo "<pre>";print_r($distribucionUti)."</pre><br/><br/>";
        
        return $distribucionUti;        
    }
    
    public function calcularDistribucionxCostos($master, $lineas){
        
        $clientes = array();
        
        $costos = Doctrine::getTable("InoCosto")
                ->createQuery("c")
                ->select("*")
                ->leftJoin("c.InoHouse h")
                ->where("ca_idmaster = ?", $master->getCaIdmaster())
                ->execute();
            
        
        foreach($costos as $costo){
            $idcliente = $costo->getCaIdhouse()?$costo->getInoHouse()->getCaIdcliente():null;
            if($idcliente){
                $ct[$idcliente]+=$costo->getCaNeto();
                }else{
                $ct["General"]+=$costo->getCaNeto();
                }
            }
        $tot_costo = array_sum($ct);
        
        foreach($lineas as $linea){            
            $peso[$linea->getCaIdcliente()]+= $master->getCaTransporte()=="Marítimo"?$linea->getVolumen():$linea->getCaPeso();;
            if(!in_array($linea->getCaIdcliente(), $clientes))
                $clientes[] = $linea->getCaIdcliente();
        }
        $tot_peso = array_sum($peso);
        
        foreach($lineas as $linea){            
            $distribucion[$linea->getCaIdcliente()] = round($peso[$linea->getCaIdcliente()]/$tot_peso,2);
        }
        
        foreach($clientes as $cliente){            
            $ctxCliente[$cliente]+= $ct[$cliente]+$ct["General"]*$distribucion[$cliente];
        }
        
        /*IMPRESION DE DATOS PARA VERIFICACION*/
        echo "<b>Idmaster</b>:".$master->getCaIdmaster()."<br/>";
        echo "<b>Referencia:</b>".$master->getCaReferencia()."<br/>";
        
        echo "<b>Peso:</b>";
        echo "<pre>";print_r($peso)."</pre><br><br>";
        echo "<i>Total peso:</i>".$tot_peso."<br/><br/>";
       
        echo "<b>Distribución x Peso:</b>";
        echo "<pre>";print_r($distribucion)."</pre><br/><br/>";
        
        echo "<b>Costos x Cliente:</b><br/>";
        echo "<pre>";print_r($ct)."</pre><br/><br/>";
        echo "<i>Total costos:</i>". $tot_costo."<br/><br/>";
        
        echo "<b>Costo x Cliente + Prorateo de Costo General:</b>";
        echo "<pre>";print_r($ctxCliente)."</pre><br/><br/>";
        
        return $ctxCliente;        
    }
    
    
    public static function enviarWs($idtransaccion='') {

        
        ProjectConfiguration::registerZend();        
        $config = sfConfig::get('app_soap_sap');
        $client = new Zend_Soap_Client($config["wsdl_uri"], array('encoding' => 'ISO-8859-1', 'soap_version' => SOAP_1_2));
        
        $transacciones = Doctrine::getTable("IntTransaccionesOut")
                            ->createQuery("tr")
                            ->select("*")
                            ->innerJoin("tr.IntTipos s")
                            ->where("tr.ca_estado=? and tr.ca_datos is not null", "G");
        
        if($idtransaccion>0)
            $q->addWhere("tr.ca_idtransaccion =? ", $idtransaccion );
        
        $transacciones=$q->execute();
        
        $result=array();
        foreach($transacciones as $tr)
        {
            $datos=json_decode($tr->getCaDatos());            
            
            $respuesta = $client->actualiza(
                array(
                    user => $datos->Usuario,
                    pass => $datos->Password,
                    compania => $datos->Company,
                    sistema => $datos->System,
                    jsonDoc => $tr->getCaDatos() 
                ));
                $tr->setRespuesta($respuesta);
                $tr->save();
                $result[]=$respuesta;
        }
        

        return $result;//array("success" => true, "consecutivo" => $consecutivo, "indincor" => $indincor, "wsdl" => $result, "info" => $info);
        //$this->responseArray = array("success" => true, "consecutivo" => $consecutivo, "indincor" => $indincor, "wsdl" => $result, "info" => $info);
        //$this->setTemplate("responseTemplate");
    }
    
    
    
    
    
}
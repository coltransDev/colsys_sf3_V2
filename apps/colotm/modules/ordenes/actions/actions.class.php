<?php

/**
 * ordenes actions.
 *
 * @package    symfony
 * @subpackage ordenes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ordenesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/CheckColumn",'last');
    }
  
  
    public function executeFormOrden(sfWebRequest $request)
    {
    
        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/FileUploadField",'last');
        //$this->nivel = $this->getNivel();
        $this->impoexpo = Constantes::IMPO;
        //$this->load_category();
		$reporte = new Reporte();
        //$this->user = $this->getUser();

        $this->reporte=$reporte;        
        
        if( $this->getRequestParameter("id") ){
			$this->reporte = Doctrine::getTable("Reporte")->findOneBy("ca_idreporte", $this->getRequestParameter("id")) ;
			$this->forward404Unless( $reporte );
		}else{
			$this->reporte = new Reporte();
		}
    }
    
    
    public function executeDatosReporte(sfWebRequest $request)
    {
        $reporte = Doctrine::getTable("Reporte")->find( $request->getParameter("idreporte")  );
        $data=array();
        if($reporte)
        {
            $data["idreporte"]=$reporte->getCaIdreporte();
            $data["impoexpo"]=utf8_encode($reporte->getCaImpoexpo());
            $data["transporte"]=utf8_encode($reporte->getCaTransporte());
            $data["idmodalidad"]=$reporte->getCaModalidad();
            
            $data["cotizacion"]=$reporte->getCaIdcotizacion();
            $data["cotizacionotm"]=$reporte->getCaIdcotizacionotm();
            $data["continuacion"]=$reporte->getCaContinuacion();
            $data["continuacion_dest"]=$reporte->getCaContinuacionDest();
            if(!$reporte->getCaContinuacionConf())
                    $reporte->setCaContinuacionConf("ninguno");
            $data["ca_continuacion_conf_".utf8_encode($reporte->getCaContinuacionConf())]= utf8_encode( $reporte->getCaContinuacionConf() );

            $data["cont-origen"]=$reporte->getCaContOrigen();
            $data["cont-destino"]=$reporte->getCaContDestino();

            //$reporte->setCaContinuacionConf

            $data["idlinea"]=$reporte->getCaIdlinea();
            $data["linea"]=utf8_encode($reporte->getIdsProveedor()->getIds()->getCaNombre());

            $data["idtra_origen_id"]=utf8_encode($reporte->getOrigen()->getTrafico()->getCaIdtrafico());
            $data["tra_origen_id"]=utf8_encode($reporte->getOrigen()->getTrafico()->getCaNombre());

            $data["origen"]=utf8_encode($reporte->getOrigen()->getCaCiudad());
            $data["idorigen"]=$reporte->getCaOrigen();

            $data["idtra_destino_id"]=utf8_encode($reporte->getDestino()->getTrafico()->getCaIdtrafico());
            $data["tra_destino_id"]=utf8_encode($reporte->getDestino()->getTrafico()->getCaNombre());
            $data["destino"]=utf8_encode($reporte->getDestino()->getCaCiudad());
            $data["iddestino"]=$reporte->getCaDestino();

            $ids=$reporte->getIdsAgente()->getIds();
            $data["idagente"]=$reporte->getCaIdagente();
            $data["agente"]=utf8_encode(/*$ids->getIdsSucursal()->getCiudad()->getCaCiudad() .*/" ".$ids->getCaNombre());

            $idsSucursal=$reporte->getIdsSucursal();
            $data["idsucursalagente"]=$idsSucursal->getCaIdsucursal();
            $data["sucursalagente"]=utf8_encode($idsSucursal->getCiudad()->getCaCiudad());


            $data["idcliente"]=$reporte->getCliente()->getCaIdcliente();
            $data["cliente"]=utf8_encode($reporte->getCliente()->getCaCompania());

            $data["idconcliente"]=$reporte->getCaIdconcliente();
            $data["contacto"]=utf8_encode($reporte->getContacto('2')->getCaNombres(). " ".$reporte->getContacto('2')->getCaPapellido()." ".$reporte->getContacto('2')->getCaSapellido());

            $data["orden_clie"]=utf8_encode($reporte->getCaOrdenClie());

            $clienteFac = $reporte->getClienteFac();
            if($clienteFac)
            {
                $data["idclientefac"]=$clienteFac->getCaIdcliente();
                $data["clientefac"]=utf8_encode($clienteFac->getCaCompania());
            }
            else
            {
                $data["clientefac"]="";
                $data["idclientefac"]="";
            }

            $clienteAg = $reporte->getClienteAg();
            if($clienteAg)
            {
                $data["clienteag"]=$clienteAg->getCaCompania();
                $data["idclienteag"]=utf8_encode($clienteAg->getCaIdcliente());
            }
            else
            {
                $data["clienteag"]="";
                $data["idclienteag"]="";
            }

            $clienteOtro = $reporte->getClienteOtro();
            if($clienteOtro)
            {
                $data["clienteotro"]=$clienteOtro->getCaCompania();
                $data["idclienteotro"]=utf8_encode($clienteOtro->getCaIdcliente());
            }
            else
            {
                $data["clienteotro"]="";
                $data["idclienteotro"]="";
            }

            $cliente=$reporte->getCliente();

            $data["ca_liberacion"] =($cliente->getLibCliente()->getCaDiascredito()>0)?"Si":"No";
            $data["ca_tiempocredito"] =$cliente->getLibCliente()->getCaDiascredito();
            $data["preferencias"] =utf8_encode($reporte->getCaPreferenciasClie());

            $data["ca_comodato"] =($reporte->getCaComodato()=="Sí" || $reporte->getCaComodato()=="on" )?true:false;
            if( $reporte->getCaIdproveedor() ){
                $values = explode("|", $reporte->getCaIdproveedor());
                for($i=0;$i<count($values);$i++)
                {
                    $tercero = Doctrine::getTable("Tercero")->find($values[$i]);
                    if($tercero)
                    {
                        $data["idproveedor".$i]=$values[$i];
                        $data["proveedor".$i] =Utils::replace($tercero->getCaNombre());
                    }
                }
            }

            if( $reporte->getCaIncoterms() ){
                $values = explode("|", $reporte->getCaIncoterms() );
                for($i=0;$i<count($values);$i++)
                {
                    $data["incoterms".$i]=$values[$i];
                }
            }

            if( $reporte->getCaOrdenProv() ){
                $values = explode("|", $reporte->getCaOrdenProv() );
                for($i=0;$i<count($values);$i++)
                {
                    $data["orden_pro".$i]=utf8_encode($values[$i]);
                }
            }

            
            if( $reporte->getCaConfirmarClie() ){
                $values = explode(",", $reporte->getCaConfirmarClie() );
                $f=0;
                $c=0;
                if(count($values)>0)
                {
                    for($i=0;$i<count($values) ;$i++)
                    {
                        if($values[$i]!="")
                        {
                            $cfijo = Doctrine::getTable("Contacto")
                                    ->createQuery("c")
                                    ->select("c.ca_fijo")
                                    ->where("c.ca_email=? and c.ca_idcliente=? and c.ca_fijo=true", array($values[$i],$cliente->getCaIdcliente()))
                                    ->execute();

                            if(count($cfijo)>0)
                            {
                                $data["contacto_fijos".$f] =utf8_encode($values[$i]);
                                $data["chkcontacto_fijos".$f] =true;
                                $f++;
                            }else{
                                $data["contacto_".$c] =utf8_encode($values[$i]);
                                $data["chkcontacto_".$c] =true;
                                $c++;
                            }
                        }
                    }
                }
            }

            $data["fchdespacho"]=$reporte->getCaFchdespacho();
            $data["idvendedor"]=utf8_encode($reporte->getCaLogin());
            $data["vendedor"]=utf8_encode($reporte->getUsuario()->getCaNombre());            

            $data["ca_mercancia_desc"]=utf8_encode($reporte->getCaMercanciaDesc());
            $data["ca_mcia_peligrosa"]=$reporte->getCaMciaPeligrosa();
            $data["ca_declaracionant"]=$reporte->getCaDeclaracionant();            
            
            $data["instrucciones"]=utf8_encode($reporte->getCaInstrucciones());

            $data["ca_colmas"]=utf8_encode($reporte->getCaColmas());
            $repaduana = Doctrine::getTable("RepAduana")->find( $reporte->getCaIdreporte());
            if( !$repaduana ){
                $repaduana = new RepAduana();
            }
            $data["ca_coordinador"]=utf8_encode($repaduana->getCaCoordinador());
            $data["ca_instrucciones"]=utf8_encode($repaduana->getCaInstrucciones());

            $repseguro = Doctrine::getTable("RepSeguro")->find( $reporte->getCaIdreporte());
            if( !$this->repseguro ){
                $this->repseguro = new RepSeguro();
            }
            $data["ca_seguro"]=utf8_encode($reporte->getCaSeguro());

            $repseguro = Doctrine::getTable("RepSeguro")->find( $reporte->getCaIdreporte());
            if( !$repseguro ){
                $repseguro = new RepSeguro();
            }
            $data["notificar"]=$repseguro->getCaSeguroConf();
            $data["ca_vlrasegurado"]=$repseguro->getCaVlrasegurado();
            $data["ca_idmoneda_vlr"]=$repseguro->getCaIdmonedaVlr();
            $data["ca_obtencionpoliza"]=Utils::formatNumber($repseguro->getCaObtencionpoliza(), 3);
            $data["ca_idmoneda_pol"]=$repseguro->getCaIdmonedaPol();
            $data["ca_primaventa"]=Utils::formatNumber($repseguro->getCaPrimaventa(), 3);
            $data["ca_minimaventa"]=Utils::formatNumber($repseguro->getCaMinimaventa(), 3);
            $data["ca_idmoneda_vta"]=$repseguro->getCaIdmonedaVta();


            $data["idconsignarmaster"]=$reporte->getCaIdconsignarmaster();
            $data["consignarmaster"]=utf8_encode($reporte->getConsignarmaster());
            $data["tipobodega"]=utf8_encode($reporte->getBodega()->getCaTipo());
            $data["idbodega_hd"]=$reporte->getCaIdbodega();
            $data["bodega_consignar"]=utf8_encode($reporte->getBodega()->getCaNombre());

            if($reporte->getCaIdconsignatario())
            {
                $data["idconsignatario"]=$reporte->getCaIdconsignatario();
                if($reporte->getCaIdconsignatario()=="1")
                {
                    $data["consignatario"]="Cliente/Consignatario";

                }
                else if($reporte->getCaIdconsignatario()=="2")
                {
                    $data["consignatario"]="Coltrans/Consignatario";
                }
                else
                    $data["consignatario"] =utf8_encode($reporte->getConsignatario()->getCaNombre());
            }
            else
            {
                $data["idconsignatario"]="";
                $data["consignatario"] ="";
            }

             if($reporte->getCaTiporep()>0)
                $idM=$reporte->getCaIdconsignarmaster();
            else
                $idM=$reporte->getCaIdmaster();

            $data["idconsigmaster"]=$idM;
            $data["consigmaster"]=utf8_encode($reporte->getConsignarmaster());
                        

            $data["idnotify"]=$reporte->getCaIdnotify();
            if($reporte->getCaIdnotify())
            {
                $tercero = Doctrine::getTable("Tercero")->find($reporte->getCaIdnotify());
                if($tercero)
                    $data["notify"] =utf8_encode($tercero->getCaNombre());
            }
            else
                $data["notify"]="";
            
            $data["idrepresentante"]=$reporte->getCaIdrepresentante();
            $data["representante"]=($reporte->getRepresentante())?$reporte->getRepresentante()->getCaNombre():"";
            $data["ca_informar_repr"]=$reporte->getCaInformarRepr();

            if($reporte->getCaImpoexpo()==constantes::EXPO)
            {
                $repExpo=$reporte->getRepExpo();

                if($repExpo)
                {
                    if($request->getParameter("motonave") )
                    {
                        $repExpo->setCaMotonave($request->getParameter("motonave"));
                    }
                    $tmp=explode("|",$repExpo->getCaPiezas());
                    if(count($tmp)==2)
                    {
                        $data["npiezas"]=$tmp[0];
                        $data["mpiezas"]=$tmp[1];
                    }
                    $tmp=explode("|",$repExpo->getCaPeso());
                    if(count($tmp)==2)
                    {
                        $data["npeso"]=$tmp[0];
                        $data["mpeso"]=$tmp[1];
                    }
                    $tmp=explode("|",$repExpo->getCaVolumen());
                    if(count($tmp)==2)
                    {
                        $data["nvolumen"]=$tmp[0];
                        $data["mvolumen"]=($tmp[1]);
                    }
                    $data["dimensiones"]=$repExpo->getCaDimensiones();
                    $data["valor_carga"]=$repExpo->getCaValorcarga();
                    $data["sia"]=$repExpo->getCaIdsia();
                    $data["idtipoexpo"]=$repExpo->getCaTipoexpo();
                    $data["tipoexpo"]=utf8_encode($repExpo->getTipoExpo());
                    $data["motonave"]=utf8_encode($repExpo->getCaMotonave());

                    $data["emisionbl"]=$repExpo->getCaEmisionbl();
                    $data["ca_numbl"]=$repExpo->getCaNumbl();
                    $data["ca_anticipo"]=($repExpo->getCaAnticipo()=="Sí")?"on":"";

    //                $data[""]=$repExpo->getCa();
                }
            }
            if($reporte->getCaTiporep()=="2")
                $data["asunto"]="Nuevo Reporte AG ".$data["proveedor0"]." / ".$data["cliente"];
            else if($reporte->getCaTiporep()=="4")
            {
                $repOtm=$reporte->getRepOtm();
                if($repOtm)
                {    
                    $data["ca_referencia"]=$repOtm->getCaReferencia();
                    $data["referencia"]=$repOtm->getCaReferencia();
                    $data["hbl"]=$repOtm->getCaHbls();
                    $data["npiezas"]=$repOtm->getCaNumpiezas();
                    $data["npeso"]=$repOtm->getCaPeso();
                    $data["nvolumen"]=$repOtm->getCaVolumen();
                    $data["valor_fob"]=$repOtm->getCaValorfob();

                    $data["ca_fcharribo"]=$repOtm->getCaFcharribo();
                    $data["ca_manifiesto"]=$repOtm->getCaManifiesto();
                    $data["ca_doctransporte"]=$repOtm->getCaDoctransporte();
                    $data["ca_fchdoctransporte"]=$repOtm->getCaFchdoctransporte();

                    $data["mpiezas"]=$repOtm->getCaNumpiezasun();
                    $data["mpeso"]=$repOtm->getCaPesoun();
                    $data["mvolumen"]=$repOtm->getCaVolumenun();

                    $data["ca_fchdoctransporte"]=$repOtm->getCaFchdoctransporte();
                    
                    $data["origenimpo"]=utf8_encode($repOtm->getOrigenimp()->getCaCiudad());
                    $data["ca_origenimpo"]=$repOtm->getCaOrigenimpo();
                    
                    $data["manifiesto"]=$repOtm->getCaManifiesto();
                    $data["hbls"]=$repOtm->getCaHbls();
                    
                    //echo $repOtm->getCaIdimportador();
                    $data["ca_idimportador"]=$repOtm->getCaIdimportador();
                    $data["idimportador"] =utf8_encode($repOtm->getImportador()->getCaNombre());
                    
                    $data["ca_motonave"] =utf8_encode($repOtm->getCaMotonave());
                    
                    $data["muelle"] =utf8_encode($repOtm->getInoDianDepositos()->getCaNombre());
                    $data["idmuelle"] =$repOtm->getCaMuelle();
                    //echo $repOtm->getCaLiberacion();
                    $data["liberacion_".$repOtm->getCaLiberacion()]= $repOtm->getCaLiberacion();
                    
                }
            }
                

        }

        $this->responseArray=array("success"=>true,"data"=>$data);
        $this->setTemplate("responseTemplate");
    }
    
    
    
    public function executeGuardarOrdenesOtm( sfWebRequest $request )
    {
    try
    {
        $idreporte=($request->getParameter("idreporte")!="")?$request->getParameter("idreporte"):"0";
        $reporte = Doctrine::getTable("Reporte")->find( $idreporte );  
        $tipo=$request->getParameter("tipo");
        
        $redirect=true;
        $opcion=$request->getParameter("opcion");
        $redirect=($request->getParameter("redirect")!="")?$request->getParameter("redirect"):"true";        
        
        $nuevo=true;        
        if(!$reporte)
        {
            $reporte = new Reporte();            
        }
        else
        {            
            $reporte->setCaUsuactualizado("web");
            $reporte->setCaFchactualizado(date('Y-m-d H:i:s'));
            $nuevo=false;
        }

        $errors =  array();
        $texto ="";
        
        switch( $opcion ){
            case 0:
                if( !$reporte->getCaIdreporte() ){
                    $reporte->setCaFchreporte( date("Y-m-d") );
                    $reporte->setCaConsecutivo( ReporteTable::siguienteConsecutivo(date("Y")) );
                    $reporte->setCaVersion( 1 );                    
                }
                break;
            case 1:
                $reporte = $reporte->copiar(1);
                break;
            case 2:
                $reporte = $reporte->copiar(2);
                break;
        }
        
        if($tipo!="full")
        {
            $reporte->setCaTiporep( 4 );
            $reporte->setCaLogin("web");
            $reporte->stopBlaming();
            $reporte->setCaUsucreado("web");
            $reporte->setCaFchcreado(date('Y-m-d H:i:s'));

            $reporte->setCaIdconsignar(1);
            $reporte->setCaIdbodega(1);
            $reporte->setCaIdconsignarmaster(0);
            $reporte->setCaIdlinea(0);

            $reporte->setCaContinuacion("OTM");
            $reporte->setCaTransporte(Constantes::TERRESTRE);

            $reporte->setCaImpoexpo(Constantes::OTMDTA);
            $reporte->setCaIdconcliente("2707");//john jairo castro de consolcargo

            $reporte->setCaContinuacionDest($request->getParameter("iddestino"));
            $texto="";

            $reporte->setCaFchdespacho(date("Y-m-d"));

            if($request->getParameter("idorigen") && $request->getParameter("idorigen")!="")
            {
                $reporte->setCaOrigen($request->getParameter("idorigen"));
            }
            else
            {
                $errors["idorigen"]="Debe seleccionar un origen";
                $texto.="Origen <br>";
            }

            if($request->getParameter("iddestino") && $request->getParameter("iddestino")!="")
            {
                $reporte->setCaDestino($request->getParameter("iddestino"));
            }
            else
            {
                $errors["iddestino"]="Debe seleccionar un destino";
                $texto.="Destino <br>";
            }        

            if($request->getParameter("idcliente") && $request->getParameter("idcliente")!="")
            {
                $idcliente=$request->getParameter("idcliente");
            }
            else
            {
                $errors["cliente"]="Debe seleccionar un destino";
                $texto.="cliente <br>";
            }

            
            $reporte->setCaIdagente("319");
            

            if($request->getParameter("idmodalidad") )
            {
                $reporte->setCaModalidad($request->getParameter("idmodalidad"));
            }
            else
            {
                $errors["modalidad"]="Debe seleccionar una modalidad";
                $texto.="Modalidad <br>";
            }

            if($request->getParameter("ca_mercancia_desc")  )
            {
                $reporte->setCaMercanciaDesc($request->getParameter("ca_mercancia_desc"));
            }else
            {
                $errors["ca_mercancia_desc"]="Debe colocar un texto de descripcion de la mercancia";
                $texto.="Desripcion de Mercacia <br>";
            }

            $prov="";
            $incoterms="";
            $orden="";
            for($i=0;$i<10;$i++)
            {
                if($request->getParameter("prov".$i) && $request->getParameter("prov".$i)!=""  )
                {
                    $prov.=($prov!="")?"|":"";
                    $prov.=$request->getParameter("prov".$i);
                }
            }

            if($prov!="" )
            {
                $reporte->setCaIdproveedor($prov);
            }
            else
            {
                $errors["proveedor0"]="Debe colocar un proveedor";
                $texto.="Proveedor <br>";
            }

            for($i=0;$i<10;$i++)
            {
                if($request->getParameter("orden_pro".$i) && $request->getParameter("prov".$i)!=""  )
                {
                    $orden.=($orden!="")?"|":"";
                    $orden.=$request->getParameter("orden_pro".$i);
                }
            }
            if($orden )
            {
                $reporte->setCaOrdenProv($orden);
            }
            
            for($i=0;$i<10;$i++)
            {
                if($request->getParameter("incoterms".$i)!="" && ($request->getParameter("prov".$i)!="" || $reporte->getCaImpoexpo() == Constantes::EXPO)  )
                {
                    $incoterms.=($incoterms!="")?"|":"";
                    $incoterms.=$request->getParameter("incoterms".$i);
                }
            }

            if($incoterms )
            {
                $reporte->setCaIncoterms($incoterms);
            }
            
            if($request->getParameter("orden_clie") )
                {
                    $reporte->setCaOrdenClie(utf8_decode($request->getParameter("orden_clie")));
                }
                else
                {
                    $reporte->setCaOrdenClie(" ");
                    //$errors["orden_clie"]="Debe colocar un texto de orden del cliente";
                    //$texto.="orden del cliente<br>";
                }

            $ca_confirmar_clie="";
            $cc="";
            for($i=0;$i<20;$i++)
            {
                if($request->getParameter("chkcontacto_".$i)=="on")
                {
                    if(trim($request->getParameter("contacto_".$i))!="")
                    {
                        $ca_confirmar_clie.=($ca_confirmar_clie!="")?",":"";
                        $ca_confirmar_clie.=$request->getParameter("contacto_".$i);
                    }                
                }
                if($request->getParameter("chkcontacto_fijos".$i)=="on")
                {
                    if(trim($request->getParameter("contacto_fijos".$i))!="")
                    {
                        $ca_confirmar_clie.=($ca_confirmar_clie!="")?",":"";
                        $ca_confirmar_clie.=$request->getParameter("contacto_fijos".$i);
                    }
                }
            }

            if($ca_confirmar_clie!="" )
            {
                $reporte->setCaConfirmarClie($ca_confirmar_clie);
            }
            else
            {
                $errors["contacto_0"]="Debe seleccionar un contacto";
                $texto.="Constacto de informaciones <br>";
            }

            if($request->getParameter("consig") )
            {
                $reporte->setCaIdconsignatario($request->getParameter("consig"));
            }

            if($request->getParameter("notify") )
            {
                $reporte->setCaIdnotify($request->getParameter("notify"));
                $reporte->setCaNotify("2");
            }

            if($request->getParameter("consigmaster") )
            {
                $reporte->setCaIdmaster($request->getParameter("consigmaster"));
            }

            if($request->getParameter("consignar") && $request->getParameter("consignar")>0  )
            {
                $reporte->setCaIdconsignar($request->getParameter("consignar"));
            }
            else
            {
                $reporte->setCaIdconsignar(1);
            }

            $reporte->setCaLogin("consolcargo");        

            if($request->getParameter("ca_mcia_peligrosa") && $request->getParameter("ca_mcia_peligrosa")=="on"  )
            {
                $reporte->setCaMciaPeligrosa(true);
            }
            else
            {
                $reporte->setCaMciaPeligrosa(false);
            }
        }


        if(count($errors)>0)
            $this->responseArray=array("success"=>false,"redirect"=>false,"errors"=>$errors,"texto"=>$texto);            
        else
        {
            $reporte->save();
            
            $repOtm = Doctrine::getTable("RepOtm")->find($reporte->getCaIdreporte() );
            
            if(!$repOtm)
            {
                $repOtm= new RepOtm();
                $repOtm->setCaIdreporte($reporte->getCaIdreporte());
                $repOtm->setCaUsucreado("maquinche");
                $repOtm->setCaFchcreado(date('Y-m-d H:i:s'));
            }
            $repOtm->stopBlaming();

            $repOtm->setCaIdcliente($idcliente);
            
            if($request->getParameter("ca_referencia") )
            {
                $repOtm->setCaReferencia($request->getParameter("ca_referencia"));
            }
            else
            {
                $repOtm->setCaReferencia(null);
            }
            if($request->getParameter("hbl"))
            {
                $repOtm->setCaHbls($request->getParameter("hbl"));
            }
            else
            {
                $repOtm->setCaHbls(null);
            }
            
            if($request->getParameter("ca_origenimpo") )
            {
                $repOtm->setCaOrigenimpo($request->getParameter("ca_origenimpo"));
            }
            else
            {
                $repOtm->setCaOrigenimpo(null);
            }
            
            if($request->getParameter("npiezas") )
            {
                $repOtm->setCaNumpiezas($request->getParameter("npiezas"));
            }
            else
            {
                $repOtm->setCaNumpiezas(null);
            }
            
            if($request->getParameter("mpiezas") )
            {
                $repOtm->setCaNumpiezasun($request->getParameter("mpiezas"));
            }
            else
            {
                $repOtm->setCaNumpiezasun(null);
            }            
            
            if($request->getParameter("npeso") )
            {
                $repOtm->setCaPeso($request->getParameter("npeso"));
            }
            else
            {
                $repOtm->setCaPeso(null);
            }
            
            if($request->getParameter("mpeso") )
            {
                $repOtm->setCaPesoun($request->getParameter("mpeso"));
            }
            else
            {
                $repOtm->setCaPesoun(null);
            }
            
            
            
            if($request->getParameter("nvolumen") )
            {
                $repOtm->setCaVolumen($request->getParameter("nvolumen"));
            }
            else
            {
                $repOtm->setCaVolumen(null);
            }
            
            if($request->getParameter("mvolumen") )
            {
                $repOtm->setCaVolumenun($request->getParameter("mvolumen"));
            }
            else
            {
                $repOtm->setCaVolumenun(null);
            }
            
            if($request->getParameter("valor_fob") )
            {
                $repOtm->setCaValorfob($request->getParameter("valor_fob"));
            }
            else
            {
                $repOtm->setCaValorfob(null);
            }
            
            if($request->getParameter("ca_fcharribo") )
            {
                $repOtm->setCaFcharribo($request->getParameter("ca_fcharribo"));
            }
            else
            {
                $repOtm->setCaFcharribo(null);
            }
            
            if($request->getParameter("manifiesto") )
            {
                $repOtm->setCaManifiesto($request->getParameter("manifiesto"));
            }
            else
            {
                $repOtm->setCaManifiesto(null);
            }
            
            if($request->getParameter("ca_idtransportador") )
            {
                $repOtm->setCaIdtransportador($request->getParameter("ca_idtransportador"));
            }
            else
            {
                $repOtm->setCaIdtransportador(null);
            }
            
            if($request->getParameter("ca_doctransporte") )
            {
                $repOtm->setCaDoctransporte($request->getParameter("ca_doctransporte"));
            }
            else
            {
                $repOtm->setCaDoctransporte(null);
            }
            
            if($request->getParameter("ca_fchdoctransporte") )
            {
                $repOtm->setCaFchdoctransporte($request->getParameter("ca_fchdoctransporte"));
            }
            else
            {
                $repOtm->setCaFchdoctransporte(null);
            }
            
            if($request->getParameter("ca_codadupartida") )
            {
                $repOtm->setCaCodadupartida($request->getParameter("ca_codadupartida"));
            }
            else
            {
                $repOtm->setCaCodadupartida(null);
            }
            
            if($request->getParameter("ca_codadudestino") )
            {
                $repOtm->setCaCodadudestino($request->getParameter("ca_codadudestino"));
            }
            else
            {
                $repOtm->setCaReferencia(null);
            }
            
            if($request->getParameter("ca_idimportador") )
            {
                $repOtm->setCaIdimportador($request->getParameter("ca_idimportador"));
            }
            else
            {
                $repOtm->setCaIdimportador(null);
            }
            
            if($request->getParameter("idmuelle") )
            {
                $repOtm->setCaMuelle($request->getParameter("idmuelle"));
            }
            else
            {
                $repOtm->setCaMuelle(null);
            }
            
            if($request->getParameter("ca_motonave") )
            {
                $repOtm->setCaMotonave($request->getParameter("ca_motonave"));
            }
            else
            {
                $repOtm->setCaMotonave(null);
            }
            
            if($request->getParameter("liberacion") )
            {
                $repOtm->setCaLiberacion($request->getParameter("liberacion"));
            }
            else
            {
                $repOtm->setCaLiberacion(null);
            }
            
            $repOtm->save();            
            
            $this->responseArray=array("success"=>true,"idreporte"=>$reporte->getCaIdreporte(),"redirect"=>$redirect,"consecutivo"=>$reporte->getCaConsecutivo() );
        }
    }
    catch(Exception $e)
    {
        $this->responseArray=array("success"=>false,"err"=>utf8_encode($e->getMessage()));
    }

    $this->setTemplate("responseTemplate");
    }

    public function executeConsultaOrden( sfWebRequest $request )
    {
        $reporte = Doctrine::getTable("Reporte")->find( $request->getParameter("id"));
        if(!$reporte)
        {
			$this->forward404Unless( $reporte );
		}
        //$url=url_for("reportes/detalleReporte?rep=".$reporte->getCaConsecutivo());
        $this->redirect( "reportes/detalleReporte?rep=".$reporte->getCaConsecutivo());
        //$this->redirect( "/colotm/reportes/detalleReporte/rep/".$reporte->getCaConsecutivo());
        exit;
    }
    
    
    public function executeEnviarSolicitud(sfWebRequest $request  ){
        //echo "<pre>";print_r($_SERVER);echo "</pre>";
        $user = $this->getUser();
        $conserep= substr($_SERVER["HTTP_REFERER"],stripos($_SERVER["HTTP_REFERER"],"rep/")+4);
        
        $email = new Email();
        $email->setCaUsuenvio("web");
        $email->setCaTipo("Orden OTM"); //Envío de Avisos
        $email->setCaIdcaso(null);

        $from = $this->getRequestParameter("from");
        if ($from) {
            $email->setCaFrom($from);
        } else {
            $email->setCaFrom("no-reply@coltrans.com.co");
        }
        $email->setCaFromname("Colsys Notificaciones");

        if ($this->getRequestParameter("readreceipt")) {
            $email->setCaReadreceipt(true);
        } else {
            $email->setCaReadreceipt(false);
        }

        //$email->setCaReplyto($user->getEmail());

/*        $recips = explode(",", $this->getRequestParameter("destinatario"));

        foreach ($recips as $recip) {
            $recip = str_replace(" ", "", $recip);
            if ($recip) {
                $email->addTo($recip);
            }
        }
 * 
 */
        //$email->addTo($user->getEmail());

/*        $recips = explode(",", $this->getRequestParameter("cc"));
        foreach ($recips as $recip) {
            $recip = str_replace(" ", "", $recip);
            if ($recip) {
                $email->addCc($recip);
            }
        }
*/
        $email->addCc("syepes@coltrans.com.co");
        $email->addTo("maquinche@coltrans.com.co");
        if ($from) {
            $email->addCc($from);
        } else {
            $email->addCc("no-reply@coltrans.com.co");
        }

        $email->setCaSubject("Nueva Orden OTM");
        $email->setCaBody($this->getRequestParameter("mensaje"));

        $mensaje = Utils::replace($this->getRequestParameter("mensaje")) . "<br />";
        $request->setParameter("format", "email");
        $request->setParameter("rep", $conserep);
        $mensaje .= sfContext::getInstance()->getController()->getPresentationFor('reportes', 'detalleReporte');
        $email->setCaBodyhtml($mensaje);
        
        $email->save();
        $this->setLayout("email");
        //exit;        
    }
}

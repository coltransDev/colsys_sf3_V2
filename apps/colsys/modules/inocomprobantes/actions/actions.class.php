<?php

/**
 * inocomprobantes actions.
 *
 * @package    colsys
 * @subpackage inocomprobantes
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inocomprobantesActions extends sfActions
{
    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(sfWebRequest $request)
    {

    }


    /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeFormComprobante(sfWebRequest $request)
    {
        $idhouse = $request->getParameter("idhouse");
       
        $this->tipo = $request->getParameter("tipo");
        /*
        if( $request->getParameter("idhouse") ){
            $this->house = Doctrine::getTable("InoHouse")->find($request->getParameter("idhouse"));
            $this->forward404Unless( $this->house );

             $request->setParameter("idmaster", $this->house->getCaIdmaster());
        }*/

       

        if( $request->getParameter("idcomprobante") ){
            $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
            $this->forward404Unless( $this->comprobante );
        }else{
            $this->comprobante = new InoComprobante();

        }

        $this->idhouse = $idhouse;

        /*if( $this->comprobante->getCaEstado()!=InoComprobante::ABIERTO ){
            $this->redirect("inocomprobantes/verComprobante?id=".$this->comprobante->getCaIdcomprobante());
        }*/


    }
    

     /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeDatosComprobanteFormComprobantePanel(sfWebRequest $request)
    {
        try{                
            $idcomprobante = $request->getParameter("idcomprobante");
            $this->forward404Unless( $idcomprobante );
            
            
            $comprobante = Doctrine::getTable("InoComprobante")->find( $idcomprobante );
            $this->forward404Unless( $comprobante );

            //$comprobante = new InoComprobante();

            $data["idcomprobante"]=$comprobante->getCaIdcomprobante();
            $data["idtipo"]=$comprobante->getCaIdtipo();
            $data["tipo"]=utf8_encode($comprobante->getInoTipoComprobante()->getCaTipo());
            $data["consecutivo"]=$comprobante->getCaConsecutivo();
            $data["fchcomprobante"]=$comprobante->getCaFchcomprobante();
            $data["plazo"]=$comprobante->getCaPlazo();
            $data["tcambio"]=$comprobante->getCaTcambio();
            $data["tcambio_usd"]=$comprobante->getCaTcambioUsd();            
            $data["ids_name"]=$comprobante->getIds()->getCaNombre();
            $data["ids"]=$comprobante->getCaId();
            $data["observaciones"]=utf8_encode($comprobante->getCaObservaciones());



            $this->responseArray = array("success" => true,"data"=>$data);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
            
        $this->setTemplate("responseTemplate");
    }

    /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeFormComprobanteData(sfWebRequest $request)
    {

        $this->modo = $request->getParameter("modo");
        
        $items = array();
        if(  $request->getParameter("idcomprobante") ){
            $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
            $this->forward404Unless( $comprobante );


            $tipo = $comprobante->getInoTipoComprobante();

            $baseRow = array( "idinocliente"=>$comprobante->getCaIdhouse(),
                              "idcomprobante"=>$comprobante->getCaIdcomprobante(),
                            );
            

            $q = Doctrine::getTable("InoDetalle")
                           ->createQuery("t")
                           ->select("t.ca_iddetalle, t.ca_idconcepto, t.ca_db, t.ca_cr,
                                    c.ca_idconcepto,c.ca_concepto, cc.ca_idccosto, cc.ca_centro,
                                    cc.ca_subcentro, cc.ca_nombre, cu.ca_cuenta, m.ca_referencia, m.ca_idmaster")
                           ->innerJoin("t.InoConcepto c")
                           ->leftJoin("t.InoCentroCosto cc")
                           ->leftJoin("t.InoCuenta cu")
                           ->leftJoin("t.InoMaster m")
                           ->where("t.ca_idcomprobante = ? ", $comprobante->getCaIdcomprobante() )
                           ->setHydrationMode(Doctrine::HYDRATE_SCALAR );

            $transacciones = $q->execute();


            $centros = Doctrine::getTable("InoCentroCosto")
                                  ->createQuery("c")
                                  ->select("c.*")
                                  ->where("c.ca_subcentro IS NULL")
                                  ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                  ->execute();
             $centrosArray = array();
             foreach( $centros as $centro ){
                $centrosArray[ $centro["c_ca_centro"] ] = $centro["c_ca_nombre"];
             }

            foreach( $transacciones as $transaccion ){
                if( $transaccion["t_ca_db"]!==null ){
                    $db = $transaccion["t_ca_db"]?"D":"C";
                }else{
                    $db = null;
                }
                $items[] = array_merge($baseRow, array(
                                "iddetalle"=>$transaccion["t_ca_iddetalle"],
                                "idconcepto"=>$transaccion["t_ca_idconcepto"],
                                "idccosto"=>$transaccion["cc_ca_idccosto"],
//                                "concepto"=>utf8_encode($centrosArray[$transaccion['cc_ca_centro']]." ".$transaccion['cc_ca_nombre']." » ".$transaccion["c_ca_concepto"]),
                                "centro" => str_pad($transaccion['cc_ca_centro'], 2, "0", STR_PAD_LEFT)."-".str_pad($transaccion['cc_ca_subcentro'], 2, "0", STR_PAD_LEFT),
                                "codigo" => str_pad($transaccion['cc_ca_centro'], 2, "0", STR_PAD_LEFT).str_pad($transaccion['cc_ca_subcentro'], 2, "0", STR_PAD_LEFT).str_pad($transaccion["c_ca_idconcepto"], 4, "0", STR_PAD_LEFT),                            
                                "valor"=>$transaccion["t_ca_cr"]-$transaccion["t_ca_db"],
                                "referencia"=>$transaccion["m_ca_referencia"],
                                "idmaster"=>$transaccion["m_ca_idmaster"]
                         ));

            }
        }

        $items[] = array( "idcuenta"=>"",
                            "idconcepto"=>"",
                            "concepto"=>"+"
                     );
        $this->responseArray = array("items"=>$items);
        $this->setTemplate("responseTemplate");
    }
    
    
     /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeSaveFormComprobantePanel(sfWebRequest $request)
    {
        try{               

            $idcomprobante = $request->getParameter("idcomprobante");
            if( $idcomprobante ){
                $comprobante = Doctrine::getTable("InoComprobante")->find( $idcomprobante );
                $this->forward404Unless( $comprobante );
            }else{
                $comprobante = new InoComprobante();
                $comprobante->setCaIdtipo($request->getParameter("idtipo"));
                $comprobante->setCaConsecutivo(InoComprobanteTable::siguienteConsecutivo($request->getParameter("idtipo")));
            }


            $conn = $comprobante->getTable()->getConnection();
            $conn->beginTransaction();

            if( $request->getParameter("consecutivo") ){
                $comprobante->setCaConsecutivo( $request->getParameter("consecutivo") );
            }
            $comprobante->setCaFchcomprobante($request->getParameter("fchcomprobante"));
            //$comprobante->setCaIdhouse($idhouse);
            $comprobante->setCaId($request->getParameter("ids"));
            $comprobante->setCaPlazo($request->getParameter("plazo"));
            $comprobante->setCaTcambio($request->getParameter("tcambio"));
            $comprobante->setCaTcambioUsd($request->getParameter("tcambio_usd"));
            $comprobante->save( $conn );
            

            if ($idcomprobante) {
                $detalles = Doctrine::getTable("InoDetalle")
                                ->createQuery("d")
                                ->addWhere("d.ca_idcomprobante=?", $idcomprobante)
                                ->execute();
                foreach( $detalles as $d ){
                    $d->delete( $conn );
                }
            }


            $detalles = $request->getParameter("detalles");
            $total = 0;
            if( $detalles ){
                $detalles = explode("|", $detalles);

                foreach( $detalles as $d ){
                    $params =  $array = sfToolkit::stringToArray( $d );   
                    if( $params["idconcepto"] ){
                        $inoDetalle = new InoDetalle();
                        $inoDetalle->setCaIdconcepto( $params["idconcepto"] );
                        $inoDetalle->setCaIdcomprobante( $comprobante->getCaIdcomprobante() );
                        $inoDetalle->setCaCr( $params["valor"] );                        
                        $inoDetalle->save( $conn );
                        $total+=$params["valor"];
                    }
                }
            }
            
            if( $total!=0 ){
                $inoDetalle = new InoDetalle();
                $inoDetalle->setCaIdconcepto( $params["idconcepto"] );
                $inoDetalle->setCaIdcomprobante( $comprobante->getCaIdcomprobante() );
                $inoDetalle->setCaCr( $params["valor"] );                        
                $inoDetalle->save( $conn );                
            }
            
            $conn->commit();
        
            $this->responseArray = array("success" => true, "id" => $request->getParameter("id"), "idcomprobante" => $comprobante->getCaIdcomprobante());
        } catch (Exception $e) {            
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }
    
    
    /**
    * Vista previa del comprobante (Prefactura)
    *
    * @param sfRequest $request A request object
    */
    public function executePreviewComprobante(sfWebRequest $request){
        $this->forward404Unless( $request->getParameter("id") );
        $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("id"));
        $this->forward404Unless( $this->comprobante );


        $this->transacciones = Doctrine::getTable("InoTransaccion")
                                         ->createQuery("t")
                                         ->innerJoin("t.InoConcepto con")
                                         ->innerJoin("con.InoCuenta c")
                                         ->where("t.ca_idcomprobante = ? ", $this->comprobante->getCaIdcomprobante() )
                                         ->addOrderBy("con.ca_ingreso_propio")
                                         ->addOrderBy("c.ca_cuenta")
                                         ->execute();

        $this->comprobante->getInoTransaccion();

    }

    /**
    * Genera el comprobante y lo transfiere a SIIGO
    *
    * @param sfRequest $request A request object
    */
    public function executeGenerarComprobante(sfWebRequest $request){
        $this->forward404Unless( $request->getParameter("id") );
        $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("id"));
        $this->forward404Unless( $comprobante );
        $modo = $request->getParameter("modo");
        $tipo = $comprobante->getInoTipoComprobante();

        //if( $comprobante->getcaEstado()==InoComprobante::ABIERTO ){
        if( true ){

            try{
                $tipo = $comprobante->getInoTipoComprobante();

                $conn = $comprobante->getTable()->getConnection();
                $conn->beginTransaction();


                $transacciones = Doctrine::getTable("InoTransaccion")
                                                 ->createQuery("t")
                                                 ->select("t.*")
                                                 ->where("t.ca_idcomprobante = ? ", $comprobante->getCaIdcomprobante() )
                                                 ->execute();

                $impuestos = array();

                $totales = array();
                $total = 0;
                
                if( $tipo->getCaTipo()=="F" ){
                    foreach( $transacciones as $transaccion ){
                        $concepto = $transaccion->getInoConcepto();



                        $parametro = $transaccion->getInoParametroFacturacion();
                        if( !$parametro ){
                            $conn->rollBack();
                            throw new Exception('La parametrizacion no esta correctamente definida: Comprobante:'.$comprobante->getCaIdcomprobante()." Transaccion: ".$transaccion->getCaIdtransaccion());
                        }

                        $total+=$transaccion->getCaValor();
                        $transaccion->setCaIdcuenta( $parametro->getCaIdcuenta() );
                        $transaccion->save( $conn );

                        $imp = $transaccion->getImpuestos();

                        foreach( $imp as $key=>$val ){
                            if(!isset( $impuestos[$key] )){
                                $impuestos[$key]["db"] = 0;
                                $impuestos[$key]["cr"] = 0;
                            }
                            $impuestos[$key]["db"]+=$imp[$key]["db"];
                            $impuestos[$key]["cr"]+=$imp[$key]["cr"];
                        }
                    }



                    if( $impuestos["iva"]>0 ){
                        $transaccion = new InoTransaccion();
                        $transaccion->setCaDb( false );
                        $transaccion->setCaValor( $impuestos["iva"]["cr"]-$impuestos["iva"]["db"] );
                        $transaccion->setCaIdmoneda( "USD" );
                        //$transaccion->setCaIdconcepto( 240 );
                        $transaccion->setCaIdcuenta( $tipo->getCaIdctaIva() );
                        $transaccion->setCaIdcomprobante( $comprobante->getCaIdcomprobante() );
                        $transaccion->save( $conn );
                        $total +=  $impuestos["iva"]["cr"]-$impuestos["iva"]["db"];
                    }
                }

                

                if( $tipo->getCaTipo()=="P" ){
                    foreach( $transacciones as $transaccion ){
                        $concepto = $transaccion->getInoConcepto();
                        $parametro = $transaccion->getInoParametroCosto();
                        if( !$parametro ){
                            $conn->rollBack();
                            throw new Exception('La parametrizacion no esta correctamente definida: Comprobante:'.$comprobante->getCaIdcomprobante()." Transaccion: ".$transaccion->getCaIdtransaccion());
                        }
                        if( $transaccion->getCaDb() ){
                            $total-=$transaccion->getCaValor();
                        }else{
                            $total+=$transaccion->getCaValor();
                        }
                        echo $parametro->getCaIdcuenta();
                        $transaccion->setCaIdcuenta( $parametro->getCaIdcuenta() );
                        $transaccion->save( $conn );
                    }
                }




                $transaccion = new InoTransaccion();
                if( $total>0 ){
                    $transaccion->setCaDb( true );
                    $transaccion->setCaValor( $total );
                }else{
                    $transaccion->setCaDb( false );
                    $transaccion->setCaValor( $total*(-1) );
                }
                $transaccion->setCaIdmoneda( "USD" );
                $transaccion->setCaIdcuenta( $tipo->getCaIdctaCierre() );
                $transaccion->setCaIdcomprobante( $comprobante->getCaIdcomprobante() );
                $transaccion->save( $conn );

                $comprobante->setCaEstado( InoComprobante::PARA_TRANSFERIR );
                $comprobante->save();


                $conn->commit();
                //$conn->rollBack();

            }
            catch (Exception $e){
                
                throw $e;
                $conn->rollBack();
            }
        }

        $this->redirect("inocomprobantes/verComprobante?id=".$comprobante->getCaIdcomprobante());


    }


    /**
    * Muestra el comprobante en un iframe
    *
    * @param sfRequest $request A request object
    */
    public function executeVerComprobante(sfWebRequest $request){
        $this->forward404Unless( $request->getParameter("id") );
        $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("id"));
        $this->forward404Unless( $this->comprobante );

        $inoHouse = $this->comprobante->getInoHouse();
        $request->setParameter("idmaster", $inoHouse->getcaIdmaster());

        


    }

    /**
    * Genera el comprobante 
    *
    * @param sfRequest $request A request object
    */
    public function executeGenerarComprobantePDF(sfWebRequest $request){
        $this->forward404Unless( $request->getParameter("id") );
        $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("id"));
        $this->forward404Unless( $this->comprobante );


        $this->filename = $request->getParameter("filename");

        $tipo = $this->comprobante->getInoTipoComprobante();

        switch( $tipo->getCaTipo() ){
            case "P":
                $this->setTemplate("generarComprobanteP");
                $this->transacciones = Doctrine::getTable("InoTransaccion")
                                         ->createQuery("t")
                                         ->select("t.*, con.*, p.*")
                                         ->innerJoin("t.InoConcepto con")
                                         ->innerJoin("con.InoParametroCosto p")
                                         ->addWhere("t.ca_idconcepto IS NOT NULL") //TEMPORAL
                                         //->innerJoin("con.InoCuenta c")
                                         ->addWhere("t.ca_idcomprobante = ? ", $this->comprobante->getCaIdcomprobante() )
                                         //->addOrderBy("c.ca_cuenta")
                                         ->execute();
                break;
            case "F":
                $this->setTemplate("generarComprobanteF");
                $this->transacciones = Doctrine::getTable("InoTransaccion")
                                         ->createQuery("t")
                                         ->select("t.*, con.*, p.*")
                                         ->innerJoin("t.InoConcepto con")
                                         ->innerJoin("con.InoParametroFacturacion p")
                                         ->addWhere("t.ca_idconcepto IS NOT NULL") //TEMPORAL
                                         //->innerJoin("con.InoCuenta c")
                                         ->addWhere("t.ca_idcomprobante = ? ", $this->comprobante->getCaIdcomprobante() )
                                         ->addOrderBy("p.ca_ingreso_propio")
                                         //->addOrderBy("c.ca_cuenta")
                                         ->execute();
                break;
        }
    }



    /**
    * Genera el archivo plano para transferir a SIIGO
    *
    * @param sfRequest $request A request object
    */
    public function executeGenerarArchivo1(sfWebRequest $request){
        $idcomprobante = $request->getParameter("idcomprobante");

        $this->filename = "cs.txt";
        $q = Doctrine::getTable("InoTransaccion")
                                         ->createQuery("t")
                                         ->innerJoin("t.InoComprobante c")
                                         ->innerJoin("t.InoCuenta cu");
        if( $idcomprobante ){
            $q->addWhere("t.ca_idcomprobante = ?", $idcomprobante);
            $comprobante = Doctrine::getTable("InoComprobante")->find( $idcomprobante );
            $this->filename = $comprobante.".txt";
        }
        $this->transacciones = $q->execute();
        $this->setLayout("none");
    }
    
    /**
    * Genera el archivo plano para transferir a SIIGO
    *
    * @param sfRequest $request A request object
    */
    public function executeTransferirFactura(sfWebRequest $request){
        ProjectConfiguration::registerZend();   
        
        $client = new Zend_Soap_Client( "http://10.192.1.102/WebService2/Service1.asmx?wsdl", array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 ));        
        
        $result = $client->Sumar(array("a" => "5", "b" =>"2"));
        
        print_r( $result);
        exit();
    }
    
    
    

}

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
       
        $this->tipo = $request->getParameter("tipo");

        if( $request->getParameter("idinocliente") ){
            $this->inocliente = Doctrine::getTable("InoCliente")->find($request->getParameter("idinocliente"));
            $this->forward404Unless( $this->inocliente );

             $request->setParameter("idmaestra", $this->inocliente->getCaIdmaestra());
        }

       

        if( $request->getParameter("idcomprobante") ){
            $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
            $this->forward404Unless( $this->comprobante );
        }else{
            $this->comprobante = new InoComprobante();

        }

        /*if( $this->comprobante->getCaEstado()!=InoComprobante::ABIERTO ){
            $this->redirect("inocomprobantes/verComprobante?id=".$this->comprobante->getCaIdcomprobante());
        }*/


    }


     /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeObserveFormComprobantePanel(sfWebRequest $request)
    {

        $idinocliente = $request->getParameter("idinocliente");
        $this->responseArray=array("idinocliente"=>$idinocliente,  "success"=>false);


        if( $request->getParameter("idcomprobante") ){
            $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
            $this->forward404Unless( $comprobante );
        }else{
            $comprobante = new InoComprobante();
            $comprobante->setCaIdtipo($request->getParameter("idtipo"));
            $comprobante->setCaConsecutivo(InoComprobanteTable::siguienteConsecutivo($request->getParameter("idtipo")));
        }
        if( $request->getParameter("consecutivo") ){
            $comprobante->setCaConsecutivo( $request->getParameter("consecutivo") );
        }
        $comprobante->setCaFchcomprobante($request->getParameter("fechacomprobante"));
        $comprobante->setCaIdinocliente($idinocliente);
        $comprobante->setCaId($request->getParameter("id"));
        $comprobante->setCaPlazo($request->getParameter("plazo"));
        $comprobante->setCaTasacambio($request->getParameter("tasacambio"));
        $comprobante->save();

        $this->responseArray["success"]=true;
        $this->responseArray["idcomprobante"]=$comprobante->getCaIdcomprobante();



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

        $this->forward404Unless( $request->getParameter("idcomprobante") );
        $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
        $this->forward404Unless( $comprobante );


        $tipo = $comprobante->getInoTipoComprobante();

        $baseRow = array( "idinocliente"=>$comprobante->getCaIdhouse(),
                          "idcomprobante"=>$comprobante->getCaIdcomprobante(),
                        );
        $items = array();

        $q = Doctrine::getTable("InoTransaccion")
                       ->createQuery("t")
                       ->select("t.ca_idtransaccion, t.ca_idconcepto, t.ca_db, t.ca_valor,
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
                            "idtransaccion"=>$transaccion["t_ca_idtransaccion"],
                            "idconcepto"=>$transaccion["t_ca_idconcepto"],
                            "idccosto"=>$transaccion["cc_ca_idccosto"],
                            "concepto"=>utf8_encode($centrosArray[$transaccion['cc_ca_centro']]." ".$transaccion['cc_ca_nombre']." » ".$transaccion["c_ca_concepto"]),
                            "centro" => str_pad($transaccion['cc_ca_centro'], 2, "0", STR_PAD_LEFT)."-".str_pad($transaccion['cc_ca_subcentro'], 2, "0", STR_PAD_LEFT),
                            "codigo" => str_pad($transaccion['cc_ca_centro'], 2, "0", STR_PAD_LEFT).str_pad($transaccion['cc_ca_subcentro'], 2, "0", STR_PAD_LEFT).str_pad($transaccion["c_ca_idconcepto"], 4, "0", STR_PAD_LEFT),
                            "db"=>$db,
                            "valor"=>$transaccion["t_ca_valor"],
                            "referencia"=>$transaccion["m_ca_referencia"],
                            "idmaestra"=>$transaccion["m_ca_idmaster"]
                     ));

        }

        $items[] = array_merge($baseRow, array( "idcuenta"=>"",
                            "idconcepto"=>"",
                            "concepto"=>"+"
                     ));
        $this->responseArray = array("items"=>$items);
        $this->setTemplate("responseTemplate");
    }

    /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeObserveFormComprobanteSubpanel(sfWebRequest $request)
    {

        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>false);


        $this->forward404Unless( $request->getParameter("idcomprobante") );
        $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
        $this->forward404Unless( $comprobante );

        $tipo = $comprobante->getInoTipoComprobante();

        if( $request->getParameter("idtransaccion") ){
            $transaccion = Doctrine::getTable("InoTransaccion")->find($request->getParameter("idtransaccion"));
        }else{
            $transaccion = new InoTransaccion();
            $transaccion->setCaIdcomprobante( $request->getParameter("idcomprobante") );
        }

        //$transaccion->setCaId( 1 );
        $transaccion->setCaIdconcepto( $request->getParameter("idconcepto") );
        if( $request->getParameter("valor")=="D"){
            $transaccion->setCaDb( true );
        }else{
            $transaccion->setCaDb( false );
        }
        if( $request->getParameter("valor")!==null ){
            $transaccion->setCaValor( $request->getParameter("valor") );
        }

        if( $request->getParameter("idmaestra")!==null ){
            $transaccion->setCaIdmaestra( $request->getParameter("idmaestra") );
        }

        $transaccion->setCaIdccosto( $request->getParameter("idccosto") );
        $transaccion->setCaIdmoneda( "USD" );
        $transaccion->save();

        $this->responseArray["success"]= true;
        $this->responseArray["idtransaccion"]= $transaccion->getCaIdtransaccion();

        $this->setTemplate("responseTemplate");
    }

    /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeEliminarFormComprobanteSubpanel(sfWebRequest $request){
        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>false);


        $this->forward404Unless( $request->getParameter("idcomprobante") );
        $comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
        $this->forward404Unless( $comprobante );

        if( $request->getParameter("idtransaccion") ){
            $transaccion = Doctrine::getTable("InoTransaccion")->find($request->getParameter("idtransaccion"));
            $this->forward404Unless( $transaccion );
            $transaccion->delete();
            $this->responseArray["success"]= true;
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

        if( $comprobante->getcaEstado()==InoComprobante::ABIERTO ){

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
        $request->setParameter("idmaestra", $inoHouse->getcaIdmaster());

        


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

        $this->transacciones = Doctrine::getTable("InoTransaccion")
                                         ->createQuery("t")
                                         ->innerJoin("t.InoComprobante c")
                                         ->innerJoin("t.InoCuenta cu")
                                         ->execute();
        $this->setLayout("none");
        
    }


    

}

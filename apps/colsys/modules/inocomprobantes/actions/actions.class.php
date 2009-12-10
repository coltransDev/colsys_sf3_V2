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
        
       

        $this->forward404Unless( $request->getParameter("id") );
        $this->inocliente = Doctrine::getTable("InoCliente")->find($request->getParameter("id"));
        $this->forward404Unless( $this->inocliente );

        $request->setParameter("idmaestra", $this->inocliente->getCaIdmaestra());

        if( $request->getParameter("idcomprobante") ){
            $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
            $this->forward404Unless( $this->comprobante );
        }else{
            $this->comprobante = new InoComprobante();

        }

        if( $this->comprobante->getCaEstado()!=InoComprobante::ABIERTO ){
            $this->redirect("ino/verComprobante?modo=".$this->modo."&id=".$this->comprobante->getCaIdcomprobante());
        }


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

        $baseRow = array( "idinocliente"=>$comprobante->getCaIdinocliente(),
                          "idcomprobante"=>$comprobante->getCaIdcomprobante(),

                        );
        $items = array();

        $q = Doctrine::getTable("InoTransaccion")
                       ->createQuery("t")
                       ->select("t.ca_idtransaccion, t.ca_idconcepto, t.ca_db, t.ca_cr, c.ca_idconcepto,c.ca_concepto, cc.ca_idccosto, cc.ca_centro, cc.ca_subcentro, cc.ca_nombre")
                       ->innerJoin("t.InoConcepto c")
                       ->leftJoin("t.InoCentroCosto cc")
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

            if( $tipo->isDb() ){
                $valor = $transaccion["t_ca_db"];
            }else{
                $valor = $transaccion["t_ca_cr"];
            }
            $items[] = array_merge($baseRow, array(
                            "idtransaccion"=>$transaccion["t_ca_idtransaccion"],
                            "idconcepto"=>$transaccion["t_ca_idconcepto"],
                            "concepto"=>utf8_encode($centrosArray[$transaccion['cc_ca_centro']]." ".$transaccion['cc_ca_nombre']." » ".$transaccion["c_ca_concepto"]),
                            "centro" => str_pad($transaccion['cc_ca_centro'], 2, "0", STR_PAD_LEFT)."-".str_pad($transaccion['cc_ca_subcentro'], 2, "0", STR_PAD_LEFT),
                            "codigo" => str_pad($transaccion['cc_ca_centro'], 2, "0", STR_PAD_LEFT).str_pad($transaccion['cc_ca_subcentro'], 2, "0", STR_PAD_LEFT).str_pad($transaccion["c_ca_idconcepto"], 4, "0", STR_PAD_LEFT),
                            "valor"=>$valor
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
        if( $tipo->isDb() ){
            $transaccion->setCaDb( $request->getParameter("valor") );
        }else{
            $transaccion->setCaCr( $request->getParameter("valor") );
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

                foreach( $transacciones as $transaccion ){
                    $concepto = $transaccion->getInoConcepto();

                    $parametro = $transaccion->getInoConceptoParametro();
                    if( !$parametro ){
                        $conn->rollBack();
                        throw new Exception('La parametrizacion no esta correctamente definida: Comprobante:'.$comprobante->getCaIdcomprobante()." Transaccion: ".$transaccion->getCaIdtransaccion());
                    }
                    $total+=($transaccion->getCaCr()-$transaccion->getCaDb());
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
                    $transaccion->setCaDb( 0 );
                    $transaccion->setCaCr( $impuestos["iva"]["cr"]-$impuestos["iva"]["db"] );
                    $transaccion->setCaIdmoneda( "USD" );
                    //$transaccion->setCaIdconcepto( 240 );
                    $transaccion->setCaIdcuenta( $tipo->getCaIdctaIva() );
                    $transaccion->setCaIdcomprobante( $comprobante->getCaIdcomprobante() );
                    $transaccion->save( $conn );
                    $total +=  $impuestos["iva"]["cr"]-$impuestos["iva"]["db"];
                }



                $transaccion = new InoTransaccion();
                $transaccion->setCaDb( $total );
                $transaccion->setCaCr( 0 );
                $transaccion->setCaIdmoneda( "USD" );
                $transaccion->setCaIdcuenta( $tipo->getCaIdctaCierre() );
                $transaccion->setCaIdcomprobante( $comprobante->getCaIdcomprobante() );
                $transaccion->save( $conn );

                $comprobante->setCaEstado( InoComprobante::PARA_TRANSFERIR );
                $comprobante->save();


                $conn->commit();
            }
            catch (Exception $e){
                $conn->rollBack();
                throw $e;
            }
        }

        $this->redirect("ino/verComprobante?modo=".$modo."&id=".$comprobante->getCaIdcomprobante());


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

        $inoCliente = $this->comprobante->getInoCliente();
        $request->setParameter("idmaestra", $inoCliente->getcaIdmaestra());
    }

    /**
    * Genera el comprobante y lo transfiere a SIIGO
    *
    * @param sfRequest $request A request object
    */
    public function executeGenerarComprobantePDF(sfWebRequest $request){
        $this->forward404Unless( $request->getParameter("id") );
        $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("id"));
        $this->forward404Unless( $this->comprobante );


        $this->transacciones = Doctrine::getTable("InoTransaccion")
                                         ->createQuery("t")
                                         ->select("t.*, con.*, p.*")
                                         ->innerJoin("t.InoConcepto con")
                                         ->innerJoin("con.InoConceptoParametro p")
                                         ->addWhere("t.ca_idconcepto IS NOT NULL") //TEMPORAL
                                         //->innerJoin("con.InoCuenta c")
                                         ->addWhere("t.ca_idcomprobante = ? ", $this->comprobante->getCaIdcomprobante() )
                                         ->addOrderBy("p.ca_ingreso_propio")
                                         //->addOrderBy("c.ca_cuenta")
                                         ->execute();


        $this->filename = $request->getParameter("filename");
    }

}

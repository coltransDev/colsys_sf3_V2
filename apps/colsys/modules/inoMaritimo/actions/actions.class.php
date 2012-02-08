<?php

/**
 * inoMaritimo actions.
 *
 * @package    symfony
 * @subpackage inoMaritimo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inoMaritimoActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
    }

    /**
     * Esta accion se eliminará cuando se haga la capacitación a nivel nacional del nuevo formulario
     *
     * @param sfRequest $request A request object
     */
    public function executeFormCostos(sfWebRequest $request) {
        
        
        
        $user = $this->getUser();
        $this->forward("inoMaritimo", "formCostosNew");
        
        $this->forward404Unless($request->getParameter("referencia"));
        $referencia = Doctrine::getTable("InoMaestraSea")->find($request->getParameter("referencia"));
        $this->forward404Unless($referencia);

        $this->utilidades = array();
        
        $oid = $request->getParameter("cl");
        if ($oid) {
            $inoCosto = Doctrine::getTable("InoCostosSea")->find($oid);
            $this->forward404Unless($inoCosto);
            
            $utilidades = Doctrine::getTable("InoUtilidadSea")
                ->createQuery("u")
                ->addWhere("u.ca_referencia = ?", $referencia->getCaReferencia())
                ->addWhere("u.ca_idcosto = ?", $inoCosto->getCaIdcosto())  
                ->addWhere("u.ca_factura = ?", $inoCosto->getCaFactura())        
                ->execute();
            foreach ($utilidades as $ut) {
                $this->utilidades[$ut->getCaHbls()] = $ut->getCaValor();
            }
            
        } else {
            $inoCosto = new InoCostosSea();
        }
        
        
        $this->inoClientes = Doctrine::getTable("InoClientesSea")
                ->createQuery("u")
                ->innerJoin("u.Cliente cl")
                ->addWhere("u.ca_referencia = ?", $referencia->getCaReferencia())
                ->addOrderBy("u.ca_hbls")
                ->execute();
        
        $this->form = new CostosForm();
        $this->form->setReferencia($referencia);
        $this->form->setInoClientes($this->inoClientes);
        $this->form->configure();

        if ($request->isMethod('post')) {

            $bindValues = array();
            $bindValues["referencia"] = $request->getParameter("referencia");
            $bindValues["idcosto"] = intval($request->getParameter("idcosto"));
            $bindValues["idmoneda"] = $request->getParameter("idmoneda");
            $bindValues["fchcreado"] = $request->getParameter("fchcreado");
            $bindValues["factura"] = $request->getParameter("factura");
            $bindValues["factura_ant"] = $request->getParameter("factura_ant");
            $bindValues["fchfactura"] = $request->getParameter("fchfactura");
            $bindValues["neto"] = $request->getParameter("neto");
            $bindValues["venta"] = $request->getParameter("venta");
            $bindValues["tcambio"] = $request->getParameter("tcambio");
            $bindValues["proveedor"] = $request->getParameter("proveedor");

            foreach ($this->inoClientes as $ic) {
                $bindValues["util_" . $ic->getCaIdinocliente()] = $request->getParameter("util_" . $ic->getCaIdinocliente());
            }

            $this->form->bind($bindValues);
            if ($this->form->isValid()) {
                $conn = Doctrine::getTable("Reporte")->getConnection();
                $conn->beginTransaction();
                try {

                    if ($bindValues["factura_ant"]) {
                        $utils = Doctrine::getTable("InoUtilidadSea")
                                ->createQuery("u")
                                ->addWhere("u.ca_referencia = ?", $bindValues["referencia"])
                                ->addWhere("u.ca_idcosto = ?", $bindValues["idcosto"])
                                ->addWhere("u.ca_factura = ?", $bindValues["factura_ant"])
                                ->execute();
                        foreach ($utils as $u) {
                            $u->delete($conn);
                        }
                    }


                    $inoCosto->setCaReferencia($bindValues["referencia"]);
                    $inoCosto->setCaIdcosto($bindValues["idcosto"]);
                    $inoCosto->setCaIdmoneda($bindValues["idmoneda"]);
                    $inoCosto->setCaFactura($bindValues["factura"]);
                    $inoCosto->setCaFchfactura($bindValues["fchfactura"]);
                    $inoCosto->setCaNeto($bindValues["neto"]);
                    $inoCosto->setCaVenta($bindValues["venta"]);
                    $inoCosto->setCaTcambio($bindValues["tcambio"]);
                    $inoCosto->setCaProveedor($bindValues["proveedor"]);
                    $inoCosto->save($conn);


                    foreach ($bindValues as $key => $val) {
                        if (substr($key, 0, 4) == "util") {
                            if ($val) {
                                $oid = substr($key, 5);                                
                                $ic = Doctrine::getTable("InoClientesSea")
                                        ->createQuery("ic")
                                        ->addWhere("ic.ca_idinocliente = ? ", $oid)
                                        ->fetchOne();

                                $ut = new InoUtilidadSea();
                                $ut->setCaReferencia($bindValues["referencia"]);
                                $ut->setCaIdcliente($ic->getCaIdcliente());
                                $ut->setCaHbls($ic->getCaHbls());
                                $ut->setCaIdcosto($bindValues["idcosto"]);
                                $ut->setCaFactura($bindValues["factura"]);
                                $ut->setCaValor($val);
                                $ut->save($conn);
                            }
                        }
                    }
                    $conn->commit();
                    $this->redirect("/colsys_php/inosea.php?boton=Consultar&id=" . $referencia->getCaReferencia());
                } catch (Exception $e) {                    
                    throw $e;
                }
            }
        }


        $this->oid = $oid;
        $this->referencia = $referencia;

        $this->inoCosto = $inoCosto;
    }
    
    
    
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeFormCostosNew(sfWebRequest $request) {
        
        
        
        $this->forward404Unless($request->getParameter("referencia"));
        $referencia = Doctrine::getTable("InoMaestraSea")->find($request->getParameter("referencia"));
        $this->forward404Unless($referencia);

        $this->utilidades = array();
        
        
        $monedaLocal = $this->getUser()->getIdmoneda();
        
        $oid = $request->getParameter("cl");
        if ($oid) {
            $inoCosto = Doctrine::getTable("InoCostosSea")->find($oid);
            $this->forward404Unless($inoCosto);
            
            $utilidades = Doctrine::getTable("InoUtilidadSea")
                ->createQuery("u")
                ->addWhere("u.ca_referencia = ?", $referencia->getCaReferencia())
                ->addWhere("u.ca_idcosto = ?", $inoCosto->getCaIdcosto())  
                ->addWhere("u.ca_factura = ?", $inoCosto->getCaFactura())        
                ->execute();
            foreach ($utilidades as $ut) {
                $this->utilidades[$ut->getCaHbls()] = $ut->getCaValor();
            }
            
        } else {
            $inoCosto = new InoCostosSea();
        }
        
        
        $this->inoClientes = Doctrine::getTable("InoClientesSea")
                ->createQuery("u")
                ->innerJoin("u.Cliente cl")
                ->addWhere("u.ca_referencia = ?", $referencia->getCaReferencia())
                ->addOrderBy("u.ca_hbls")
                ->execute();
        
        $this->form = new CostosNewForm();
        $this->form->setReferencia($referencia);
        $this->form->setInoClientes($this->inoClientes);
        $this->form->configure();

        if ($request->isMethod('post')) {

            $bindValues = array();
            $bindValues["referencia"] = $request->getParameter("referencia");
            $bindValues["idcosto"] = intval($request->getParameter("idcosto"));
            $bindValues["idmoneda"] = $request->getParameter("idmoneda");
            $bindValues["fchcreado"] = $request->getParameter("fchcreado");
            $bindValues["factura"] = $request->getParameter("factura");
            $bindValues["factura_ant"] = $request->getParameter("factura_ant");
            $bindValues["fchfactura"] = $request->getParameter("fchfactura");
            $bindValues["neto"] = $request->getParameter("neto");
            $bindValues["venta"] = $request->getParameter("venta");
            $bindValues["tcambio"] = $request->getParameter("tcambio");
            $bindValues["tcambio_usd"] = $request->getParameter("tcambio_usd");
            $bindValues["proveedor"] = $request->getParameter("proveedor");
            
            
            
            if( $bindValues["idmoneda"]=="USD" || $bindValues["idmoneda"]==$monedaLocal ){                   
                $bindValues["tcambio_usd"] = 1;
            }
            
            if( $bindValues["idmoneda"]==$monedaLocal ){
               $bindValues["tcambio"] = 1;  
            }
            
            foreach ($this->inoClientes as $ic) {
                $bindValues["util_" . $ic->getCaIdinocliente()] = $request->getParameter("util_" . $ic->getCaIdinocliente());
            }

            $this->form->bind($bindValues);
            if ($this->form->isValid()) {
                $conn = Doctrine::getTable("Reporte")->getConnection();
                $conn->beginTransaction();
                try {

                    if ($bindValues["factura_ant"]) {
                        $utils = Doctrine::getTable("InoUtilidadSea")
                                ->createQuery("u")
                                ->addWhere("u.ca_referencia = ?", $bindValues["referencia"])
                                ->addWhere("u.ca_idcosto = ?", $bindValues["idcosto"])
                                ->addWhere("u.ca_factura = ?", $bindValues["factura_ant"])
                                ->execute();
                        foreach ($utils as $u) {
                            $u->delete($conn);
                        }
                    }


                    $inoCosto->setCaReferencia($bindValues["referencia"]);
                    $inoCosto->setCaIdcosto($bindValues["idcosto"]);
                    $inoCosto->setCaIdmoneda($bindValues["idmoneda"]);
                    $inoCosto->setCaFactura($bindValues["factura"]);
                    $inoCosto->setCaFchfactura($bindValues["fchfactura"]);
                    $inoCosto->setCaNeto($bindValues["neto"]);
                    $inoCosto->setCaVenta($bindValues["venta"]);
                    $inoCosto->setCaTcambio($bindValues["tcambio"]);
                    $inoCosto->setCaTcambioUsd($bindValues["tcambio_usd"]);
                    $inoCosto->setCaProveedor($bindValues["proveedor"]);
                    $inoCosto->save($conn);


                    foreach ($bindValues as $key => $val) {
                        if (substr($key, 0, 4) == "util") {
                            if ($val) {
                                $oid = substr($key, 5);                                
                                $ic = Doctrine::getTable("InoClientesSea")
                                        ->createQuery("ic")
                                        ->addWhere("ic.ca_idinocliente = ? ", $oid)
                                        ->fetchOne();

                                $ut = new InoUtilidadSea();
                                $ut->setCaReferencia($bindValues["referencia"]);
                                $ut->setCaIdcliente($ic->getCaIdcliente());
                                $ut->setCaHbls($ic->getCaHbls());
                                $ut->setCaIdcosto($bindValues["idcosto"]);
                                $ut->setCaFactura($bindValues["factura"]);
                                $ut->setCaValor($val);
                                $ut->save($conn);
                            }
                        }
                    }
                    $conn->commit();
                    $this->redirect("/colsys_php/inosea.php?boton=Consultar&id=" . $referencia->getCaReferencia());
                } catch (Exception $e) {                    
                    throw $e;
                }
            }
        }


        $this->oid = $oid;
        $this->referencia = $referencia;

        $this->inoCosto = $inoCosto;
        
        $this->monedaLocal = $monedaLocal;
    }

}

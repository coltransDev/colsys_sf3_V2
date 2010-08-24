<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * ino components.
 *
 * @package    colsys
 * @subpackage ino
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */

class inoComponents extends sfComponents
{

    /*
     * Este panel contiene todos los tabs de la aplicación.
     */
    public function executeMainPanel(){

    }


    /*
     * Formulario para ingresar los datos del master
     */
    public function executeFormMasterPanel(){
        
    }

    /*
     * Formulario para ingresar los datos del house
     */
    public function executeFormHousePanel(){

    }

    /*
     * Grid que muestra los house de la referencia
     */
    public function executeGridHousePanel(){

       
    }


    /*
     * Grid que muestra las facturas de la referencia
     */
    public function executeGridFacturacionPanel(){
        
    }

    

    public function executeCostos(){
        $this->costos = Doctrine::getTable("InoTransaccion")
                                 ->createQuery("t")
                                 ->select("t.*, c.ca_consecutivo, con.ca_concepto, id.ca_nombre, tp.ca_tipo, tp.ca_comprobante")
                                 ->innerJoin("t.InoComprobante c")
                                 ->innerJoin("c.InoTipoComprobante tp")
                                 ->innerJoin("t.InoConcepto con")
                                 ->innerJoin("c.Ids id")
                                 ->where("t.ca_idmaster = ?", $this->referencia->getCaIdmaster())
                                 //->addWhere("c.ca_estado = ?", InoComprobante::TRANSFERIDO)
                                 ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                 ->execute();

    }

    public function executeAuditoria(){
        /*$this->costos = Doctrine::getTable("InoTransaccion")
                                 ->createQuery("t")
                                 ->select("t.*, c.ca_consecutivo, con.ca_concepto, id.ca_nombre, tp.ca_tipo, tp.ca_comprobante")
                                 ->innerJoin("t.InoComprobante c")
                                 ->innerJoin("c.InoTipoComprobante tp")
                                 ->innerJoin("t.InoConcepto con")
                                 ->innerJoin("c.Ids id")
                                 ->where("t.ca_idmaster = ?", $this->referencia->getCaIdmaster())
                                 //->addWhere("c.ca_estado = ?", InoComprobante::TRANSFERIDO)
                                 ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                 ->execute();*/

    }


}



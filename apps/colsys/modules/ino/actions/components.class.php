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

    /*
     * Grid que muestra las facturas de compra de la referencia
     */
    public function executeGridCostosPanel(){

    }
    /*
     * Grid que muestra las facturas de compra de la referencia
     */
    public function executeEditCostosWindow(){
        $this->conceptos = Doctrine::getTable("InoConcepto")
                                     ->createQuery("c")
                                     ->select("ca_idconcepto,ca_concepto, cc.ca_idccosto, cc.ca_centro, cc.ca_subcentro, cc.ca_nombre")
                                     ->innerJoin("c.InoParametroFacturacion p")
                                     ->innerJoin("p.InoCentroCosto cc")
                                     //->innerJoin("cc.CentroCosto cp")
                                     ->innerJoin("c.InoConceptoModalidad cm")
                                     ->innerJoin("cm.Modalidad m")
                                     //->addWhere("c.ca_tipo = ? ", Constantes::RECARGO_LOCAL )
                                     ->addWhere("p.ca_idcuenta IS NOT NULL" )
                                     //->addWhere("m.ca_impoexpo LIKE ? ", $impoexpo )
                                     //->addWhere("m.ca_transporte LIKE ? ", $this->reporte->getCaTransporte() )
                                     ->addOrderBy("c.ca_concepto")
                                     ->distinct()
                                     ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                     ->execute();
    }

    /*
     * Cuadro de eventos de auditoria
     */
    public function executeGridAuditoriaPanel(){
     

    }

    /*
     * Ventana para editar un evento
     */
    public function executeEditAuditoriaWindow(){
        

    }
    

    
    


}



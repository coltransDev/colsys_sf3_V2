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
class inomaritimoComponents extends sfComponents {

    public function executePanelGridHouse(sfWebRequest $request) {
        
    }

    public function executePanelLiquidacionHouses(sfWebRequest $request) {
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/CheckColumn",'last');
        $response->addJavaScript("extExtras/GroupSummary",'last');
        
        $this->numRef = $request->getParameter("referencia");

        $con = Doctrine_Manager::getInstance()->connection();
        
        $sql = "select distinct cs.ca_idcosto, cs.ca_costo from tb_costos cs inner join tb_inocostos_sea ic on ic.ca_idcosto = cs.ca_idcosto and ic.ca_referencia = '".$request->getParameter("referencia")."'"
                . " union select cs.ca_idcosto, cs.ca_costo from tb_costos cs where cs.ca_idcosto = 17";
        $rs = $con->execute($sql);
        $costos_rs = $rs->fetchAll();
        $this->costos = array();
        foreach ($costos_rs as $costo) {
            $this->costos[] = array("idcosto" => $costo["ca_idcosto"], "costo" => utf8_encode($costo["ca_costo"]));
        }
        
    }

    public function executePanelReferencias(sfWebRequest $request) {
        
    }

}

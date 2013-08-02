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
 * @subpackage inoReportes
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class inoReportesComponents extends sfComponents {
    
    /*
     * Formulario para realizar consultas en general
     */

    public function executeFormConsultaPanel() {
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/SuperBoxSelect", 'last');
        
        $this->meses = array();        
        $this->meses[]=array("valor"=>"a-Enero"       ,"id"=>1);
        $this->meses[]=array("valor"=>"b-Febrero"     ,"id"=>2);
        $this->meses[]=array("valor"=>"c-Marzo"       ,"id"=>3);
        $this->meses[]=array("valor"=>"d-Abril"       ,"id"=>4);
        $this->meses[]=array("valor"=>"e-Mayo"        ,"id"=>5);
        $this->meses[]=array("valor"=>"f-Junio"       ,"id"=>6);
        $this->meses[]=array("valor"=>"g-Julio"       ,"id"=>7);
        $this->meses[]=array("valor"=>"h-Agosto"      ,"id"=>8);
        $this->meses[]=array("valor"=>"i-Septiembre"  ,"id"=>9);
        $this->meses[]=array("valor"=>"j-Octubre"     ,"id"=>10);
        $this->meses[]=array("valor"=>"k-Noviembre"   ,"id"=>11);
        $this->meses[]=array("valor"=>"l-Diciembre"   ,"id"=>12);
        
    }

    public function executeFiltrosListados()
    {
        $user = $this->getUser();
        $this->mm = $this->getRequestParameter("mes");        
        $this->casos = $this->getRequestParameter("casos");
        $this->impoexpo = $this->getRequestParameter("impoexpo");
        $this->transporte = $this->getRequestParameter("transporte");
        $this->comercial = $this->getRequestParameter("comercial");
        $this->idcomercial = $this->getRequestParameter("idcomercial");
        $this->sucursal = $this->getRequestParameter("sucursal");
        
        $this->comerciales=UsuarioTable::getComerciales();
        
        $this->sucursales=$sucursales = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->select("s.ca_nombre")
                ->addOrderBy("s.ca_nombre")
                ->addWhere("s.ca_idempresa=?", $user->getIdempresa())                
                ->execute();

    
    }
    
}


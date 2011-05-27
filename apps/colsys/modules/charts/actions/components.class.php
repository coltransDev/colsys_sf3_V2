<?php

/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * cotizaciones components.
 *
 * @package    colsys
 * @subpackage reportes
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class chartsComponents extends sfComponents {

    public function executePie() {
        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("highcharts/js/highcharts",'last');
    }
    
    public function executeColumn() {
        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("highcharts/js/highcharts",'last');
        $response->addJavaScript("highcharts/js/modules/exporting",'last');
        
    }

}

?>

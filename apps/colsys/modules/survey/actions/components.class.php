<?php

/**
 * survey actions.
 *
 * @package    symfony
 * @subpackage survey
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class surveyComponents extends sfComponents {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeListaEvaluaciones(sfWebRequest $request) {

        $fecha = date("Y-m-d H:i:s", time() - (90 * 86400));
        $this->evaluaciones = Doctrine::getTable("SurvEvaluacion")
                        ->createQuery("e")
                        ->addWhere("e.ca_estado = ? ", SurvEvaluacion::ESTADO_SINCONTESTAR )
                        ->addWhere("e.ca_fchcreado >= ?", $fecha)
                        ->execute();

        


    }

   
}

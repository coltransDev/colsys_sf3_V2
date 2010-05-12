<?php

/**
 * homepage actions.
 *
 * @package    symfony
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homepageComponents extends sfComponents {
    /**
     * Componente que muestra las fechas de cumpleaños en la página principal
     *
     *
     */
    public function executeBirthday() {



        $inicial=date('m-d');
        $final=date('m-d',time()+ 86400*4);


        $this->usuarios= Doctrine::getTable('Usuario')
                ->createQuery('u')
                ->where('substring(ca_cumpleanos::text, 6,5) BETWEEN ? and ?', array($inicial, $final))
                ->addOrderBy('substring(ca_cumpleanos::text, 6,5)  ASC')
                ->execute();


    }

    public function executeMainMenu() {
    }

}


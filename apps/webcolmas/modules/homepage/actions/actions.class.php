
<?php

/**
 * homepage actions.
 *
 * @package    symfony
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homepageActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {

        $q = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->addWhere("u.ca_activo = ? ", true)
                ->addWhere("u.ca_cargoweb IS NOT NULL")
                ->addOrderBy("u.ca_cargoweb, u.ca_nombre");

        $this->users = $q->execute();
        $this->setLayout('home');
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeViewUser(sfWebRequest $request) {

        $q = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->addWhere("u.ca_activo = ? ", true)
                ->addWhere("u.ca_cargoweb IS NOT NULL")
                ->addWhere("MD5(u.ca_login) = ?", $request->getParameter("l"));

        $this->user = $q->fetchOne();
        $this->setLayout('home');       
    }

}


<?php

/**
 * users actions.
 *
 * @package    symfony
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usersActions extends sfActions {
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeViewUser(sfWebRequest $request) {
        $this->user=Doctrine::getTable('Usuario')->find($request->getParameter('login'));
    }

    public function executeDirectory(sfWebRequest $request) {

    }

    public function executeDoSearch(sfWebRequest $request) {
        $this->usuarios=Doctrine::getTable('Usuario')
                    ->createQuery('u')
                    ->addWhere('LOWER(u.ca_nombre) LIKE ?', '%'.strtolower($request->getParameter('criterio')).'%')
                    ->execute();

    }
}

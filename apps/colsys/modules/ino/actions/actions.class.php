<?php

/**
 * ino actions.
 *
 * @package    symfony
 * @subpackage ino
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class inoActions extends sfActions
{
    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(sfWebRequest $request)
    {
        $this->comerciales = UsuarioTable::getComerciales();

    }

    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeBusqueda(sfWebRequest $request)
    {
        

    }


    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeFormIno(sfWebRequest $request)
    {


    }
}

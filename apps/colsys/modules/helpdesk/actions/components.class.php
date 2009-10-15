<?php

/**
 * gestDocumental components.
 *
 * @package    colsys
 * @subpackage helpdesk
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class helpdeskComponents extends sfComponents
{
	/*
	* Muestra las referencias que el usuario ha buscado
	* @author: Andres Botero
	*/
	public function executeListaRespuestasTicket(){				

        $this->responses = Doctrine::getTable("HdeskResponse")
                           ->createQuery("r")
                           ->where("r.ca_idticket = ? ", $this->idticket )
                           ->addOrderBy("r.ca_createdat ASC")
                           ->addOrderBy("r.ca_idresponse ASC")
                           ->execute();
	}
	
	
	
}
?>
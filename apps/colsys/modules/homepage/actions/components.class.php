<?php

/**
 * homepage components.
 *
 * @package    colsys
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class homepageComponents  extends sfComponents
{
	/**
	* Muestra las novedades de colsys
	*	
	*/
	public function executeNovedades()
	{

        $this->novedades = Doctrine::getTable("ColNovedad")
                                     ->createQuery("n")
                                     ->where("n.ca_fcharchivar>=?", date("Y-m-d"))
                                     ->addOrderBy("n.ca_fchpublicacion DESC ")
                                     ->execute();
		
		
	}
}

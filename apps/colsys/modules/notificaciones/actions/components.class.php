<?php

/**
 * homepage components.
 *
 * @package    colsys
 * @subpackage notificaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class notificacionesComponents  extends sfComponents
{
	/**
	* Muestra las novedades de colsys
	*	
	*/
	public function executeTareasPendientes()
	{
		
		
		
        $this->listaTareas = Doctrine::getTable("NotListaTareas")
                                     ->createQuery("l")
                                     ->innerJoin("l.NotTarea t")
                                     ->innerJoin("t.NotTareaAsignacion a")
                                     ->select("l.*")
                                     ->where("t.ca_fchterminada Is NULL")
                                     ->addWhere("t.ca_fchvisible <= ?",date("Y-m-d H:i:s") )
                                     ->addWhere("a.ca_login = ?", $this->getUser()->getUserId())                                     
                                     ->distinct()
                                     ->execute();


		
		$this->user = $this->getUser()->getUserId();		
				
		
	}
}
?>
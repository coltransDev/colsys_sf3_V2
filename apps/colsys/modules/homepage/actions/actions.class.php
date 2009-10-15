<?php
 
/**
 * homepage actions.
 *
 * @package    colsys
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class homepageActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
			
		$this->numtareas = Doctrine::getTable("NotTarea")                                     
                                     ->createQuery("t")
                                     ->select("count(*)")
                                     ->innerJoin("t.NotTareaAsignacion a")
                                     ->where("t.ca_fchterminada Is NULL")
                                     ->addWhere("t.ca_fchvisible <= ?",date("Y-m-d H:i:s") )
                                     ->addWhere("a.ca_login = ?", $this->getUser()->getUserId())
                                     ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                                     ->distinct()
                                     ->execute();

		
		$response = sfContext::getInstance()->getResponse();
		$response->addStylesheet("homepage",'last');
		
		
		$this->novedades = Doctrine::getTable("ColNovedad")
                                     ->createQuery("n")
                                     ->where("n.ca_fcharchivar>=?", date("Y-m-d"))
                                     ->addOrderBy("n.ca_fchpublicacion")
                                     ->addOrderBy("n.ca_fcharchivar")

                                     ->execute();
		
		
		
	}

    /**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeGetTareas(sfWebRequest $request){


    }
}
?>
<?php

/**
 * kbase actions.
 *
 * @package    colsys
 * @subpackage kbase
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class kbaseActions extends sfActions
{
	const RUTINA = "38";

    public function getNivel(){        
        $this->nivel = $this->getUser()->getNivelAcceso( kbaseActions::RUTINA );
		if( $this->nivel==-1 ){
			$this->forward404();
		}

        return $this->nivel;
    }
	/**
	* Muestra un listado de la base de datos
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
	
		$this->nivel = $this->getNivel();
					
		$this->categorias = Doctrine::getTable("KBCategory")
                                      ->createQuery("c")
                                      ->addOrderBy("c.ca_parent")
                                      ->addOrderBy("c.ca_order")
                                      ->addOrderBy("c.ca_name")
                                      ->where("c.ca_parent IS NULL")
                                      ->execute();
			
	}

    /**
	*
	* @param sfRequest $request A request object
	*/
	public function executeViewSubcategory(sfWebRequest $request)
	{

		$this->nivel = $this->getNivel();

		$this->categoria = Doctrine::getTable("KBCategory")->find( $request->getParameter("id"));

        $response = sfContext::getInstance()->getResponse();
		$response->addStylesheet("kb",'last');

	}
	
	/**
	* Muestra el detalle de un item de la base de datos
	*
	* @param sfRequest $request A request object
	*/
	public function executeViewIssue(sfWebRequest $request)
	{
		$this->nivel = $this->getNivel();
		

		$this->issue = Doctrine::getTable("KBIssue")->find( $request->getParameter("id") );
		$this->forward404Unless( $this->issue );

        $this->category = $this->issue->getKBCategory();

        $q = Doctrine::getTable("KBCategory")
                            ->createQuery("c")
                            ->select("c.*");
        
        if( $this->category->getCaParent() ){
            $q->where("c.ca_parent = ?", $this->category->getCaParent());
        }else{
            $q->where("c.ca_parent = IS NULL");
        }

        //$q->addOrderBy("c.ca_");

        $this->categories = $q->execute();

        $response = sfContext::getInstance()->getResponse();
		$response->addStylesheet("kb",'last');
        
			
	}
	
	public function executeFormIssue( $request ){
		$this->nivel = $this->getNivel();

        if(  $request->getParameter("id") ){
            $issue = Doctrine::getTable("KBIssue")->find( $request->getParameter("id") );
            $this->forward404Unless( $issue );
        }else{
			$issue = new KBIssue();
		}
        $this->idcategory = $request->getParameter("idcategory");

        if ($request->isMethod('post')){
            $issue->setCaIdcategory( $request->getParameter("idcategory") );
            $issue->setCaInfo( $request->getParameter("info") );
            $issue->setCaSummary( $request->getParameter("summary") );
            $issue->setCaTitle( $request->getParameter("title") );

            $issue->save();
            //echo $request->getParameter("info");
            //exit();
            $this->redirect("kbase/viewIssue?id=".$issue->getCaIdissue());



        }
        //if( !is_dir($sf_config::get("sf_web_dir").DIRECTORY_SEPARATOR."ckfinder".DIRECTORY_SEPARATOR."userfiles".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR.)){


        
        $this->issue = $issue;

	}
	
	
	
	
}
?>
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

        
		
			
	}

	public function executeFormIssue( $request ){
		$this->nivel = $this->getNivel();


        if( $this->nivel <=0 ){
            $this->forward404();
        }


        if(  $request->getParameter("id") ){
            $issue = Doctrine::getTable("KBIssue")->find( $request->getParameter("id") );
            $this->forward404Unless( $issue );
        }else{
			$issue = new KBIssue();
		}
        $this->idcategory = $request->getParameter("idcategory");
        $this->message = "";
        if ($request->isMethod('post')){
            $issue->setCaIdcategory( $request->getParameter("idcategory") );
            $info = $request->getParameter("info");
            $info = str_replace("<strong>", "<b>", $info);
            $info = str_replace("</strong>", "</b>", $info);
            $issue->setCaInfo( $info );
            $issue->setCaSummary( $request->getParameter("summary") );
            $issue->setCaTitle( $request->getParameter("title") );

            $issue->save();
            //echo $request->getParameter("info");
            //exit();
            $this->message = "Se ha guardado correctamente";



        }
        //if( !is_dir($sf_config::get("sf_web_dir").DIRECTORY_SEPARATOR."ckfinder".DIRECTORY_SEPARATOR."userfiles".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR.)){


        $response = sfContext::getInstance()->getResponse();
        //Utility Dependencies
        $response->addJavaScript("yui/yahoo-dom-event/yahoo-dom-event.js",'last');
		$response->addJavaScript("yui/element/element-min.js",'last');
        //Needed for Menus, Buttons and Overlays used in the Toolbar
        $response->addJavaScript("yui/container/container_core-min.js",'last');
        $response->addJavaScript("yui/menu/menu-min.js",'last');
        $response->addJavaScript("yui/button/button-min.js",'last');
        //Source file for Rich Text Editor
        $response->addJavaScript("yui/editor/editor-min.js",'last');
        $response->addJavaScript("yui/connection/connection-min.js",'last');
        $response->addJavaScript("yui/logger/logger-min.js",'last');
        
        $response->addJavaScript("yui-image-uploader26.js",'last');

        $response->addStyleSheet("yui/assets/skins/sam/skin.css",'last');

        
        $this->issue = $issue;

	}


    /*
     * Carga los valores para editar un tooltip
     */
    public function executeCargarDatosTooltip( sfWebRequest $request ){
        
        $idcategory = $request->getParameter("idcategory");
        $elemId = $request->getParameter("elemId");
        $this->responseArray = array("success"=>true);

        $tooltip = Doctrine::getTable("KBTooltip")->find(array($idcategory, $elemId));

        if( $tooltip ){
            $this->responseArray["titulo"] = utf8_encode($tooltip->getCaTitle());
            $this->responseArray["contenido"] = utf8_encode($tooltip->getCaInfo());
        }else{
            $this->responseArray["titulo"] = "";
            $this->responseArray["contenido"] = "";
        }
        $this->setTemplate("responseTemplate");
    }

    /*
     * Guarda los valores para editar un tooltip
     */
    public function executeGuardarDatosTooltip( sfWebRequest $request ){

        $idcategory = $request->getParameter("idcategory");
        $elemId = $request->getParameter("elemId");
        $this->responseArray = array("success"=>true);

        $tooltip = Doctrine::getTable("KBTooltip")->find(array($idcategory, $elemId));

        if( !$tooltip ){
            $tooltip = new KBTooltip();
            $tooltip->setCaIdcategory( $idcategory );
            $tooltip->setCaFieldId( $elemId );
        }

        $tooltip->setCaTitle( utf8_decode($request->getParameter("titulo")));
        $tooltip->setCaInfo( utf8_decode($request->getParameter("contenido")));
        $tooltip->save();

        $this->responseArray["titulo"] = utf8_encode($tooltip->getCaTitle());
        $this->responseArray["contenido"] = utf8_encode($tooltip->getCaInfo());
        
        $this->setTemplate("responseTemplate");
    }


    


    /*
     * 
     */
    public function executeDatosPanelCategorias( $request ){
        $q  = Doctrine::getTable("KBCategory")
                                      ->createQuery("c")
                                      ->addOrderBy("c.ca_parent")
                                      ->addOrderBy("c.ca_order")
                                      ->addOrderBy("c.ca_name");
        $idcategoria = intval($request->getParameter("node"));
            
        if( $idcategoria ){
            $q->addWhere("c.ca_parent = ?", $idcategoria );
        }else{
            $q->addWhere("c.ca_parent IS NULL");
        }
        $this->categorias = $q->execute();
    }

    /*
     *
     */
    public function executeDatosPanelIssues( $request ){
        $idcategory = $request->getParameter("idcategory");
        $this->forward404Unless( $idcategory );

        $q  = Doctrine::getTable("KBIssue")
                                      ->createQuery("i");

        $q->addWhere("i.ca_idcategory = ?", $idcategory );
        //$q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $q->limit(200);
		$issues = $q->execute();
        $result = array();
        foreach( $issues as $issue){
            $row = array();
            $row["idissue"]=utf8_encode($issue->getCaIdissue());
            $row["idcategory"]=utf8_encode($issue->getCaIdcategory());
            $row["title"]=utf8_encode($issue->getCaTitle());
            $row["summary"]=utf8_encode($issue->getCaSummary()?$issue->getCaSummary():substr($issue->getCaInfo(),0,500)."...");
            $row["info"]=utf8_encode($issue->getCaInfo());
            $row["level"]=utf8_encode($issue->getCaLevel());
            $row["author"]=utf8_encode($issue->getCaUsuactualizado()?$issue->getCaUsuactualizado():$issue->getCaUsucreado());
            $row["pubDate"]=utf8_encode($issue->getCaFchactualizado()?$issue->getCaFchactualizado():$issue->getCaFchcreado());
            $result[]=$row;
        }

        $this->responseArray = array("success"=>true, "root"=>$result);

        $this->setTemplate("responseTemplate");
    }


    /*
     *
     */
    public function executePanelCategoriaGuardar( $request ){
        $idcategory = $request->getParameter("idcategory");

        if( $idcategory ){
            $categoria = Doctrine::getTable("KBCategory")->find($idcategory);
            $this->forward404Unless( $categoria );
        }else{
            $categoria = new KBCategory();
            $main = $this->getRequestParameter("main");
            $categoria->setCaMain($main=="on");
        }

        
        $categoria->setCaName(utf8_decode($this->getRequestParameter("name")));
        if( $this->getRequestParameter("parent") ){
            $categoria->setCaParent(utf8_decode($this->getRequestParameter("parent")));
        }else{
            $categoria->setCaParent(null);
        }
        
        try{
            $categoria->save();
            $this->responseArray = array("success"=>true);
        }catch( Exception $e ){
            $this->responseArray = array("success"=>false, "errorInfo"=>$e->getMessage());
        }
		
        $this->setTemplate("responseTemplate");
    }


    /*
     *
     */
    public function executeEliminarCategoria( $request ){
        $idcategory = $request->getParameter("idcategory");

        if( $idcategory ){
            $categoria = Doctrine::getTable("KBCategory")->find($idcategory);
            $this->forward404Unless( $categoria );
            
            try{
                $categoria->delete();
                $this->responseArray = array("success"=>true);
            }catch( Exception $e ){
                $this->responseArray = array("success"=>false, "errorInfo"=>$e->getMessage());
            }
            

        }else{
            $this->responseArray = array("success"=>false);
        }


        $this->setTemplate("responseTemplate");
    }
    /*
     *
     */
    public function executeCambiarCategoria( $request ){
        $idissue = $request->getParameter("idissue");
        $idcategory = $request->getParameter("idcategory");

        if( $idissue ){
            $issue = Doctrine::getTable("KBIssue")->find($idissue);
            $this->forward404Unless( $issue );

            try{
                $issue->setCaIdcategory($idcategory);
                $issue->stopBlaming();
                $issue->save();
                $this->responseArray = array("success"=>true);
            }catch( Exception $e ){
                $this->responseArray = array("success"=>false, "errorInfo"=>$e->getMessage());
            }


        }else{
            $this->responseArray = array("success"=>false);
        }


        $this->setTemplate("responseTemplate");
    }




}
?>
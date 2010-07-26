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


    public function executeUploadImage(){
        /*


        header("content-type: text/html"); // the return type must be text/html
        //if file has been sent successfully:
        if (isset($_FILES['image']['tmp_name'])) {
         // open the file
         $img = $_FILES['image']['tmp_name'];
         $himage = fopen ( $img, "r"); // read the temporary file into a buffer
         $image = fread ( $himage, filesize($img) );
         fclose($himage);
         //if image can't be opened, either its not a valid format or even an image:
         if ($image === FALSE) {
          echo "{status:'Error Reading Uploaded File.'}";
          return;
         }
         // create a new random numeric name to avoid rewriting other images already on the server...
         $ran = rand ();
         $ran2 = $ran.".";
         // define the uploading dir
         $path = "editor_images/";
         // join path and name
         $path = $path . $ran2.'jpg';
         // copy the image to the server, alert on fail
         $hout=fopen($path,"w");
         fwrite($hout,$image);
         fclose($hout);
         //you'll need to modify the path here to reflect your own server.
         $path = "/wp-content/uploads/2007/12/" . $path;
         echo "{status:'UPLOADED', image_url:'$path'}";
        } else {
         echo "{status:'No file was submitted'}";
        }
        
         */
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
        $namespace = $request->getParameter("namespace");

        $q->addWhere("c.ca_namespace = ?", $namespace );

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

}
?>
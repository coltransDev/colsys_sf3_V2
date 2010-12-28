<?php

/**
 * antecedentes actions.
 *
 * @package    symfony
 * @subpackage antecedentes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class antecedentesActions extends sfActions {


    private $filetypes = array("MBL", "HBL");
    /**
     * 
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {

    }

    /**
     * 
     *
     * @param sfRequest $request A request object
     */
    public function executeAsignacionMaster(sfWebRequest $request) {
        $this->master = $request->getParameter("master");
        $this->forward404Unless( $this->master );        

        
        $folder = "Antecedentes".DIRECTORY_SEPARATOR.$this->master;
        $directory = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR;

        if(!is_dir($directory)){
            @mkdir($directory, DEFAULT_PRIVILEGES, true);
        }


        $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);

        $filenames = array();
        $fileTypes = $this->filetypes;
        foreach( $fileTypes as $fileType ){
            
            foreach($archivos as $archivo ){
                if( substr(basename($archivo),0, strlen($fileType))==$fileType ){
                    $filenames[ $fileType ]["file"] = str_replace(sfConfig::get('app_digitalFile_root'), "", $archivo);
                }
            }
        }
        

        $this->folder = $folder;
        $this->filenames = $filenames;




        
    }


    /**
     * 
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosPanelReportesAntecedentes(sfWebRequest $request) {
        $q = Doctrine_Query::create()
                        ->select("r.*, cl.ca_compania")
                        ->from('Reporte r')
                        ->innerJoin('r.Contacto c')
                        ->innerJoin('c.Cliente cl');

        
        $q->addWhere("r.ca_idetapa = ? ", "IMETA");
        $q->addWhere("r.ca_master IS NULL");
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $q->limit(50);
        
        $reportes = $q->execute();

        foreach ($reportes as $key => $val) {
            $reportes[$key]["cl_ca_compania"] = utf8_encode($reportes[$key]["cl_ca_compania"]);
        }

        $this->responseArray = array("success" => true, "total"=>count($reportes), "root" => $reportes);

        $this->setTemplate("responseTemplate");
    }


    /**
     * 
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosPanelMasterAntecedentes(sfWebRequest $request) {
        $master = $request->getParameter("master");
        $this->forward404Unless( $master );


        $q = Doctrine_Query::create()
                        ->select("r.*, cl.ca_compania")
                        ->from('Reporte r')
                        ->innerJoin('r.Contacto c')
                        ->innerJoin('c.Cliente cl');

        $q->addWhere("r.ca_master = ? ", $master);
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);       

        $reportes = $q->execute();

        foreach ($reportes as $key => $val) {
            $reportes[$key]["cl_ca_compania"] = utf8_encode($reportes[$key]["cl_ca_compania"]);
        }

        $this->responseArray = array("success" => true, "total"=>count($reportes), "root" => $reportes);

        $this->setTemplate("responseTemplate");
    }


    /**
     * 
     *
     * @param sfRequest $request A request object
     */
    public function executeAsignarMaster(sfWebRequest $request) {
        
        
        $this->setTemplate("responseTemplate");



        try{

            $master = $request->getParameter("master");
            $this->forward404Unless( $master );

            $assign = $request->getParameter("assign");


            $data = $request->getParameter("data");
            $this->forward404Unless( $data );
            $data = explode(",", $data );

            $reportes = Doctrine::getTable("Reporte")
                        ->createQuery("r")
                        ->whereIn("r.ca_idreporte", $data)
                        ->execute();


            foreach( $reportes as $reporte ){
                if( $assign=="true" ){
                    $reporte->setCaMaster( $master );
                }else{
                    $reporte->setCaMaster( null );                    
                }
                $reporte->save();
            }

            
            $this->responseArray = array( "success" => true );
        }catch( Exception $e ){
            $this->responseArray = array( "success" => false, "errorInfo"=>$e->getMessage() );
        }
    }


    /**
     * 
     *
     * @param sfRequest $request A request object
     */
    public function executeEnviarPlanilla(sfWebRequest $request) {

        $master = $request->getParameter("master");
        $this->forward404Unless( $master );


            
        $this->master = $master;
        $this->user = $this->getUser();


    }

    /**
     * 
     *
     * @param sfRequest $request A request object
     */
    public function executeEnviarCorreo(sfWebRequest $request) {

        $master = $request->getParameter("master");
        $this->forward404Unless( $master );




        $this->reportes = Doctrine::getTable("Reporte")
                          ->createQuery("r")
                          ->addWhere("r.ca_master = ? ", $master )
                          ->execute();
        $this->master = $master;
        $user = $this->getUser();




        
        $email = new Email();

		$email->setCaUsuenvio( $user->getUserId() );
		$email->setCaTipo( "Antecedentes" ); //Envío de Avisos
		$email->setCaIdcaso( null );

		$from = $this->getRequestParameter("from");
		if( $from ){
			$email->setCaFrom( $from );
		}else{
			$email->setCaFrom( $user->getEmail() );
		}
		$email->setCaFromname( $user->getNombre() );


		if( $this->getRequestParameter("readreceipt") ){
			$email->setCaReadreceipt( true );
		}else{
            $email->setCaReadreceipt( false );
        }

		$email->setCaReplyto( $user->getEmail() );

		$recips = explode(",", $this->getRequestParameter("destinatario") );

		foreach( $recips as $recip ){
			$recip = str_replace(" ", "", $recip );
			if( $recip ){
				$email->addTo( $recip );
			}
		}

		$recips = explode(",", $this->getRequestParameter("cc") );
		foreach( $recips as $recip ){
			$recip = str_replace(" ", "", $recip );
			if( $recip ){
				$email->addCc( $recip );
			}
		}

		if( $from ){
			$email->addCc( $from );
		}else{
			$email->addCc( $this->getUser()->getEmail() );
		}

        $email->setCaSubject( $this->getRequestParameter("asunto") );
        $email->setCaBody( $this->getRequestParameter("mensaje"));

        $mensaje = Utils::replace($this->getRequestParameter("mensaje"))."<br />";
        $mensaje .= sfContext::getInstance()->getController()->getPresentationFor( 'antecedentes', 'emailAntecedentes');
		$email->setCaBodyhtml( $mensaje ) ;
		$email->save();


        $folder = "Antecedentes".DIRECTORY_SEPARATOR.$this->master;
        $directory = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR;

        if(!is_dir($directory)){
            @mkdir($directory, DEFAULT_PRIVILEGES, true);
        }


        $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);

        $fileTypes = $this->filetypes;
        foreach( $fileTypes as $fileType ){

            foreach($archivos as $archivo ){
                if( substr(basename($archivo),0, strlen($fileType))==$fileType ){
                    $name = str_replace(sfConfig::get('app_digitalFile_root'), "", $archivo);
                    $email->AddAttachment(  $name  );
                }
            }
        }
        
        $email->save();		
		$email->send();

    }
    /**
     * 
     *
     * @param sfRequest $request A request object
     */
    public function executeEmailAntecedentes(sfWebRequest $request) {

        $master = $request->getParameter("master");
        $this->forward404Unless( $master );
        
        $this->master = $master;

        $this->setLayout("email");

    }



}

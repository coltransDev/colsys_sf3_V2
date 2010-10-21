<?php

/**
 * homepage actions.
 *
 * @package    symfony
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homepageComponents extends sfComponents {
    /**
     * Componente que muestra las fechas de cumpleaños en la página principal
     *
     *
     */
   
    const RUTINA_COLSYS = 99;
    const RUTINA_INTRANET = 99;

    public function getNivel() {

        $app =  sfContext::getInstance()->getConfiguration()->getApplication();
        //   return 5;
        switch( $app ){
            case "colsys":
                $rutina = homepageComponents::RUTINA_COLSYS;
            break;
            case "intranet":
                $rutina = homepageComponents::RUTINA_INTRANET;
            break;
        }

        $this->nivel = $this->getUser()->getNivelAcceso($rutina);
        if (!$this->nivel) {
            $this->nivel = 0;
        }

        //$this->forward404Unless($this->nivel != -1);

        return $this->nivel;
    }

    public function executeBirthday() {

        $inicial=date('m-d');
        $final=date('m-d',time()+ 86400*3);

        $this->usuarios= Doctrine::getTable('Usuario')
                ->createQuery('u')
                ->where('substring(ca_cumpleanos::text, 6,5) BETWEEN ? and ?', array($inicial, $final))
                ->addWhere ('ca_activo = ?', true)
                ->addOrderBy('substring(ca_cumpleanos::text, 6,5)  ASC')
                ->execute();
    }

    public function executeMainMenu() {
    }
    
	public function executeIncomeLast() {

        $final=date('Y-m-d');
        $inicial=date('Y-m-d',time()- 86400*45);

        $this->usuarios= Doctrine::getTable('Usuario')
                ->createQuery('u')
                ->where('ca_fchingreso BETWEEN ? and ?', array($inicial, $final))
                ->addWhere ('ca_activo = ?', true)
                ->addOrderBy('ca_fchingreso ASC')
                ->execute();
    }
    
  public function executeLogos()
  {
    // $this->forward('default', 'module');
    $this->user = sfContext::getInstance()->getUser();
	
  }

    public function executeNoticias()
    {

    $this->nivel = $this->getNivel();

    $this->noticias = Doctrine::getTable("Noticia")
                             ->createQuery("n")
                             ->where("n.ca_fcharchivar>=?", date("Y-m-d"))
                             ->addOrderBy("n.ca_fchpublicacion DESC ")
                             ->execute();



    }
    public function executeSearch()
  {
  }

  
}


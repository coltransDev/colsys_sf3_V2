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

    const RUTINA_ADMUSUARIOS_COLSYS = 73;
    const RUTINA_ADMUSUARIOS_INTRANET = 98;

    public function getNivel() {

        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        //   return 5;
        switch ($app) {
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

        $usuario = Doctrine::getTable("usuario")->find($this->getUser()->getUserId()?$this->getUser()->getUserId():"Administrador");
        $grupoEmp = $usuario->getGrupoEmpresarial();

        $inicial = date('m-d');
        $final = date('m-d', time() + 86400 * 2);

        $this->usuarios = Doctrine::getTable('Usuario')
                        ->createQuery('u')
                        ->innerJoin('u.Sucursal s')
                        ->innerJoin('s.Empresa e')
                        ->where('substring(ca_cumpleanos::text, 6,5) BETWEEN ? AND ?', array($inicial,$final))
                        //->addWhere('e.ca_idempresa IN (?,?,?)',array('1','2','8'))
                        ->addWhere('ca_activo = ?', true)
                        ->andWhereIn("s.ca_idempresa", $grupoEmp)
                        ->addOrderBy('substring(ca_cumpleanos::text, 6,5)  ASC')
                        ->execute();    
    }    
    
    public function executeTiempoColaborador() {

        $usuario = Doctrine::getTable("usuario")->find($this->getUser()->getUserId()?$this->getUser()->getUserId():"Administrador");
        $grupoEmp = $usuario->getGrupoEmpresarial();

         $this->usuarios = Doctrine::getTable('Usuario')
                ->createQuery ('u')
                ->innerJoin('u.Sucursal s')
                ->innerJoin('s.Empresa e')                 
                ->where('u.ca_activo = ?', true)
                ->andWhereIn("s.ca_idempresa", $grupoEmp)
                ->addWhere("CASE WHEN substr((c.ca_fchingreso)::text,6,5) = substr(now()::text,6,5) THEN(CASE WHEN ((date_part('".year."', now()) - date_part('".year."', c.ca_fchingreso))::int) NOT IN (5,0) THEN ((date_part('".year."', now()) - date_part('".year."', c.ca_fchingreso))::int)%5=0 ELSE false END ) ELSE false END")
                ->orderby('u.ca_fchingreso DESC')
                ->execute();             
        }

    public function executeMainMenu() {
        
        $this->user = sfContext::getInstance()->getUser();
        $this->nivel = $this->getUser()->getNivelAcceso(homepageComponents::RUTINA_ADMUSUARIOS_INTRANET);
        
    }

    public function executeNuevosColaboradores() {

        $usuario = Doctrine::getTable("usuario")->find($this->getUser()->getUserId()?$this->getUser()->getUserId():"Administrador");
        $grupoEmp = $usuario->getGrupoEmpresarial();
        
        $final = date('Y-m-d');
        $inicial = date('Y-m-d', time() - 86400 * 30);

        $this->usuarios = Doctrine::getTable('Usuario')
                        ->createQuery('u')
                        ->leftJoin("u.Sucursal s")
                        ->where('ca_fchingreso BETWEEN ? and ?', array($inicial, $final))
                        ->addWhere('ca_activo = ?', true)
                        ->andWhereIn("s.ca_idempresa", $grupoEmp)
                        ->addOrderBy('ca_fchingreso DESC')
                        ->execute();
    }

    public function executeLogos() {
        // $this->forward('default', 'module');
        $this->user = sfContext::getInstance()->getUser();
    }

    public function executeNoticias() {

        $this->nivel = $this->getNivel();

        $this->noticias = Doctrine::getTable("Noticia")
                        ->createQuery("n")
                        ->where("n.ca_fcharchivar>=?", date("Y-m-d"))
                        ->addOrderBy("n.ca_fchpublicacion DESC ")
                        ->execute();
    }

    public function executeSearch() {
        
    }
        
    

}


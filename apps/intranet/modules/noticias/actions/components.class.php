<?php

/**
 * noticias actions.
 *
 * @package    symfony
 * @subpackage noticias
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class noticiasComponents extends sfComponents {
    /**
     * Componente que muestra las fechas de cumpleaños en la página principal
     *
     *
     */
    const RUTINA_COLSYS = 99;
    const RUTINA_INTRANET = 99;

    public function getNivel() {

        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        
        switch ($app) {
            case "colsys":
                $rutina = self::RUTINA_COLSYS;
                break;
            case "intranet":
                $rutina = self::RUTINA_INTRANET;
                break;
        }
               

        $this->nivel = $this->getUser()->getNivelAcceso($rutina);
        if (!$this->nivel) {
            $this->nivel = 0;
        }

        return $this->nivel;
    }

    public function executeNoticias(sfWebRequest $request) {

        $this->nivel = $this->getNivel();
        
        $usuario = Doctrine::getTable("usuario")->find($this->getUser()->getUserId()?$this->getUser()->getUserId():"Administrador");
        $grupoEmp = $usuario->getGrupoEmpresarial();

        $this->noticias = Doctrine::getTable("Noticia")
                ->createQuery("n")
                ->leftJoin("n.Sucursal s")
                ->where("n.ca_fchpublicacion <=?", date("Y-m-d"))
                ->addWhere("n.ca_fcharchivar>=?", date("Y-m-d"))
                ->andWhereIn("n.ca_idempresa", $grupoEmp)
                ->addOrderBy("n.ca_fchpublicacion DESC ")
                ->execute();
        
        $this->idsucursal = $this->getUser()->getSucursal();
    }

    public function executeSearch() {

    }
}
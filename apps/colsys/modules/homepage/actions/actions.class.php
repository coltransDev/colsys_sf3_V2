<?php

/**
 * homepage actions.
 *
 * @package    colsys
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class homepageActions extends sfActions {

    const RUTINA_NOTICIAS = 100;
    const RUTINA_TICKETS = 89;
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
        $this->numtareas = Doctrine::getTable("NotTarea")
                ->createQuery("t")
                ->select("count(*)")
                ->innerJoin("t.NotTareaAsignacion a")
                ->where("t.ca_fchterminada Is NULL")
                ->addWhere("t.ca_fchvisible <= ?", date("Y-m-d H:i:s"))
                ->addWhere("a.ca_login = ?", $this->getUser()->getUserId())
                ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                ->distinct()
                ->execute();

        $response = sfContext::getInstance()->getResponse();
        $response->addStylesheet("homepage", 'last');

        $this->grupos = $this->getUser()->getMenu();
        $this->nivelNoticias = $this->getUser()->getNivelAcceso(self::RUTINA_NOTICIAS);
        $this->nivelTickets = $this->getUser()->getNivelAcceso(self::RUTINA_TICKETS);
        
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());        
        $grupoEmp = $usuario->getGrupoEmpresarial();
        
        $this->plantillas  = Doctrine::getTable("Empresa")
                ->createQuery("e")
                ->select("e.*, s.*")
                ->leftJoin("e.Sucursal s")
                ->where("s.ca_plantilla IS NOT NULL")
                ->andwhereIn("s.ca_idempresa", $grupoEmp)
                ->orderBy("e.ca_nombre DESC, s.ca_nombre ASC") 
                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                ->execute();                
        
        $this->usuario = $usuario;
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeGetTareas(sfWebRequest $request) {
        
    }

    /**
     * Permite editar una noticia de la página principal
     *
     * @param sfRequest $request A request object
     */
    public function executeEditarNovedad(sfWebRequest $request) {

        $idnovedad = $request->getParameter("idnovedad");
        $this->novedad = Doctrine::getTable("ColNovedad")->find($idnovedad);

        if (!$this->novedad) {
            $this->novedad = new ColNovedad();
        }

        $this->forward404Unless($this->novedad);
        $this->idnovedad = $idnovedad;
        $response = sfContext::getInstance()->getResponse();

        //Utility Dependencies
        $response->addJavaScript("yui/yahoo-dom-event/yahoo-dom-event.js", 'last');
        $response->addJavaScript("yui/element/element-min.js", 'last');
        //Needed for Menus, Buttons and Overlays used in the Toolbar
        $response->addJavaScript("yui/container/container_core-min.js", 'last');
        $response->addJavaScript("yui/menu/menu-min.js", 'last');
        $response->addJavaScript("yui/button/button-min.js", 'last');
        //Source file for Rich Text Editor
        $response->addJavaScript("yui/editor/editor-min.js", 'last');
        $response->addJavaScript("yui/connection/connection-min.js", 'last');
        $response->addJavaScript("yui/logger/logger-min.js", 'last');
        $response->addJavaScript("yui-image-uploader26.js", 'last');
        $response->addStyleSheet("yui/assets/skins/sam/skin.css", 'last');
    }

    /**
     * Guarda los datos del formulario
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarNovedad(sfWebRequest $request) {

        $idnovedad = $request->getParameter("idnovedad");

        if ($idnovedad) {
            $novedad = Doctrine::getTable("ColNovedad")->find($idnovedad);
            $this->forward404Unless($novedad);
        } else {
            $novedad = new ColNovedad();
        }

        $novedad->setCaAsunto($request->getParameter("title"));
        $novedad->setCaDetalle($request->getParameter("info"));
        $novedad->setCaFchpublicacion($request->getParameter("fchpublicacion"));
        $novedad->setCaFcharchivar($request->getParameter("fcharchivar"));
        $novedad->setCaFchcreado(date("Y-m-d H:i:s"));
        $novedad->setCaUsucreado($this->getUser()->getUserId());
        $novedad->save();

        $this->idnovedad = $idnovedad;
    }
}
?>
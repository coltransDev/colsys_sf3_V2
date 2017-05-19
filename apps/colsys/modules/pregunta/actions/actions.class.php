<?php

/**
 * pregunta actions.
 *
 * @package    colmob
 * @subpackage pregunta
 * @author     Gabriel Martinez Rojas
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class preguntaActions extends sfActions {

    const RUTINA = 144;
    public function executeIndex(sfWebRequest $request) {
        $this->user = $this->getUser();
        $this->nivel = $this->user->getNivelAcceso(preguntaActions::RUTINA);
        $pregunta = new Pregunta();
        $this->filtroPregunta = new PreguntaFormFilter();
        $this->pager = new sfDoctrinePager('pregunta', 30);
        $this->pager->setQuery($pregunta->getQueryPregunta());
        $this->pager->setPage($request->getParameter('pagina', 1));
        $this->pager->init();
        $this->setLayout('layout_home');
    }

    public function executeFiltrar(sfWebRequest $request) {
        $this->filtroPregunta = new PreguntaFormFilter();
        $this->filtroPregunta->bind($request->getParameter(
                        $this->filtroPregunta->getName()));
        $this->pager = new sfDoctrinePager(
                        'pregunta', 300);
        $this->pager->setQuery($this->filtroPregunta->getQuery());
        $this->pager->setPage(
                $request->getParameter('pagina', 1));
        $this->pager->init();
        //refer back to the index template
        $this->setTemplate('index');
        $this->setLayout('layout_home');
    }

    public function executeVistaPrevia(sfWebRequest $request) {
        $idPregunta = $request->getParameter('ca_id');
        $this->pregunta = Doctrine_Core::getTable('pregunta')->getPregunta($idPregunta);
        $detect = new Mobile_Detect();
        $dispositivo = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
        $this->device = $dispositivo;
        //$this->error='';
        $this->setLayout('formulario');
    }

    public function executeShow(sfWebRequest $request) {
        $this->user = $this->getUser();
        $this->nivel = $this->user->getNivelAcceso(preguntaActions::RUTINA);
        $id = $request->getParameter('ca_id');
        $this->pregunta = Doctrine_Core::getTable('pregunta')->find(array($id));
        $this->forward404Unless($this->pregunta);
        $this->setLayout('layout_home');
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new preguntaForm();
        $this->setLayout('layout_home');
    }

    public function executeNuevo(sfWebRequest $request) {
        $id=$request->getParameter('ca_id');
        $this->form = new nuevaPreguntaForm();
        $this->form->setDefault('ca_idbloque', $id);
        $this->idForm=$id;
        $this->setLayout('layout_home');
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new preguntaForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
        $this->setLayout('layout_home');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($pregunta = Doctrine_Core::getTable('pregunta')->find(array($request->getParameter('ca_id'))), sprintf('El objeto tipo pregunta (%s) no existe.', $request->getParameter('ca_id')));
        $this->form = new preguntaForm($pregunta);
        $this->setLayout('layout_home');
    }

        public function executeTest(sfWebRequest $request) {
            $this->setLayout($request);


    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($pregunta = Doctrine_Core::getTable('pregunta')->find(array($request->getParameter('ca_id'))), sprintf('El objeto tipo pregunta (%s) no existe.', $request->getParameter('ca_id')));
        $this->form = new preguntaForm($pregunta);
        $this->processForm($request, $this->form);
        $this->setTemplate('edit');
        $this->setLayout('layout_home');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();
        $this->forward404Unless($pregunta = Doctrine_Core::getTable('pregunta')->find(array($request->getParameter('ca_id'))), sprintf('El objeto tipo pregunta (%s) no existe.', $request->getParameter('ca_id')));
        $pregunta->delete();
        $this->getUser()->setFlash('notice', 'Pregunta Eliminada.');
        $this->redirect('pregunta/index');
        $this->setLayout('layout_home');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $pregunta = $form->save();
            $this->getUser()->setFlash('notice', 'Datos de la Pregunta Guardados.');
            $this->redirect('pregunta/edit?ca_id=' . $pregunta->getCaId());
        } else {
            $this->getUser()->setFlash('error', 'No se pueden guardar los datos de la Pregunta.');
        }
    }

}

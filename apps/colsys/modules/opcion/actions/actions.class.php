<?php

/**
 * opcion actions.
 *
 * @package    colmob
 * @subpackage opcion
 * @author     Gabriel Martinez Rojas
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class opcionActions extends sfActions {

    const RUTINA = 136;
    public function executeIndex(sfWebRequest $request) {
        $this->user = $this->getUser();
        $this->nivel = $this->user->getNivelAcceso(opcionActions::RUTINA);
        $opcion = new Opcion();
        $this->filtroOpcion = new OpcionFormFilter();
        $this->pager = new sfDoctrinePager('opcion', 30);
        $this->pager->setQuery($opcion->getQueryOpcion());
        $this->pager->setPage($request->getParameter('pagina', 1));
        $this->pager->init();
        $this->setLayout('layout_home');
    }

    public function executeFiltrar(sfWebRequest $request) {
        $this->filtroOpcion = new OpcionFormFilter();
        $this->filtroOpcion->bind($request->getParameter(
                        $this->filtroOpcion->getName()));
        $this->pager = new sfDoctrinePager(
                        'opcion', 500);
        $this->pager->setQuery($this->filtroOpcion->getQuery());
        $this->pager->setPage(
                $request->getParameter('pagina', 1));
        $this->pager->init();
        $this->setTemplate('index');
        $this->setLayout('layout_home');
    }

    public function executeShow(sfWebRequest $request) {
        $this->user = $this->getUser();
        $this->nivel = $this->user->getNivelAcceso(opcionActions::RUTINA);
        $this->opcion = Doctrine_Core::getTable('opcion')->find(array($request->getParameter('ca_id')));
        $this->forward404Unless($this->opcion);
        $this->setLayout('layout_home');
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new opcionForm();
        $this->setLayout('layout_home');
    }

    public function executeCopy(sfWebRequest $request) {
        $id = $request->getParameter('ca_id');
        $data = new Opcion();
        $this->dato=$data->duplicarOpcion($id);
        $this->setTemplate('index');
        $this->setLayout('layout_home');
        //$this->forward404Unless($this->opcion);
    }

    public function executeNuevo(sfWebRequest $request) {
        $id = $request->getParameter('ca_id');
        $this->form = new nuevaOpcionForm();
        $this->form->setDefault('ca_idpregunta', $id);
        $this->idForm = $id;
        $this->setLayout('layout_home');
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new opcionForm();
        $this->processForm($request, $this->form);
        $this->setTemplate('new');
        $this->setLayout('layout_home');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($opcion = Doctrine_Core::getTable('opcion')->find(array($request->getParameter('ca_id'))), sprintf('El Objeto opcion no existe (%s).', $request->getParameter('ca_id')));
        $this->form = new opcionForm($opcion);
        $this->setLayout('layout_home');
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($opcion = Doctrine_Core::getTable('opcion')->find(array($request->getParameter('ca_id'))), sprintf('El Objeto opcion no existe (%s).', $request->getParameter('ca_id')));
        $this->form = new opcionForm($opcion);
        $this->processForm($request, $this->form);
        $this->setTemplate('edit');
        $this->setLayout('layout_home');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($opcion = Doctrine_Core::getTable('opcion')->find(array($request->getParameter('ca_id'))), sprintf('El Objeto opcion no existe (%s).', $request->getParameter('ca_id')));
        $opcion->delete();
        $this->getUser()->setFlash('notice', 'Opci&oacute;n eliminada.');
        $this->redirect('opcion/index');
        $this->setLayout('layout_home');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $opcion = $form->save();
            $this->getUser()->setFlash('notice', 'Datos de la Opci&oacute;n guardados.');
            $this->redirect('opcion/edit?ca_id=' . $opcion->getCaId());
        } else {
            $this->getUser()->setFlash('error', 'No se pueden guardar los datos de la Opci&oacute;n.');
        }
    }

}

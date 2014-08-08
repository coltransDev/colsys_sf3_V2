<?php

/**
 * bloque actions.
 *
 * @package    colmob
 * @subpackage bloque
 * @author     Gabriel Martinez Rojas
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class bloqueActions extends sfActions {

    const RUTINA = 144;
    public function executeIndex(sfWebRequest $request) {
        $this->user = $this->getUser();
        $this->nivel = $this->user->getNivelAcceso(bloqueActions::RUTINA);
        $bloque = new Bloque();
        $this->filtroBloque = new BloqueFormFilter();
        $this->pager = new sfDoctrinePager('bloque', 30);
        $this->pager->setQuery($bloque->getQueryBloque());
        $this->pager->setPage($request->getParameter('pagina', 1));
        $this->pager->init();
        $this->setLayout('layout_home');
    }

    public function executeFiltrar(sfWebRequest $request) {
        $this->filtroBloque = new BloqueFormFilter();
        $this->filtroBloque->bind($request->getParameter(
                        $this->filtroBloque->getName()));
        $this->pager = new sfDoctrinePager(
                        'bloque', 500);
        $this->pager->setQuery($this->filtroBloque->getQuery());
        $this->pager->setPage(
                $request->getParameter('pagina', 1));
        $this->pager->init();
        $this->setTemplate('index');
        $this->setLayout('layout_home');
    }

    public function executeVistaPrevia(sfWebRequest $request) {
        $idBloque = $request->getParameter('ca_id');
        $this->bloque = Doctrine_Core::getTable('bloque')->getBloque($idBloque);
        $this->setLayout('formulario');
    }

    public function executeShow(sfWebRequest $request) {
        $this->user = $this->getUser();
        $this->nivel = $this->user->getNivelAcceso(bloqueActions::RUTINA);
        $this->bloque = Doctrine_Core::getTable('bloque')->find(array($request->getParameter('ca_id')));
        $this->forward404Unless($this->bloque);
        $this->setLayout('layout_home');
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new bloqueForm();
        $this->setLayout('layout_home');
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new bloqueForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
        $this->setLayout('layout_home');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($bloque = Doctrine_Core::getTable('bloque')->find(array($request->getParameter('ca_id'))), sprintf('El Objeto (%s) tipo bloque no existe.', $request->getParameter('ca_id')));
        $this->form = new bloqueForm($bloque);
        $this->setLayout('layout_home');
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($bloque = Doctrine_Core::getTable('bloque')->find(array($request->getParameter('ca_id'))), sprintf('El Objeto (%s) tipo bloque no existe.', $request->getParameter('ca_id')));
        $this->form = new bloqueForm($bloque);
        $this->processForm($request, $this->form);
        $this->setTemplate('edit');
        $this->setLayout('layout_home');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($bloque = Doctrine_Core::getTable('bloque')->find(array($request->getParameter('ca_id'))), sprintf('El Objeto (%s)  tipo bloque no existe.', $request->getParameter('ca_id')));
        $bloque->delete();
        $this->getUser()->setFlash('notice', 'Bloque Eliminado!!!.');
        $this->redirect('bloque/index');
        $this->setLayout('layout_home');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $bloque = $form->save();
            $this->getUser()->setFlash('notice', 'Datos del Bloque guardados: ');
            $this->redirect('bloque/edit?ca_id=' . $bloque->getCaId());
        } else {
            $this->getUser()->setFlash('error', 'No se pueden guardar los datos del Bloque.');
        }
    }

}

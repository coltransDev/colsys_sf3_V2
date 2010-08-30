<?php

/**
 * noticias actions.
 *
 * @package    symfony
 * @subpackage noticias
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class noticiasActions extends sfActions {
    const RUTINA = 94;

    public function getNivel() {
        $this->nivel = $this->getUser()->getNivelAcceso(noticiasActions::RUTINA);
        if (!$this->nivel) {
            $this->nivel = 0;
        }

        $this->forward404Unless($this->nivel != -1);

        return $this->nivel;
    }

    public function executeIndex(sfWebRequest $request) {
        $this->nivel = $this->getNivel();
        
        $this->noticias = Doctrine::getTable('Noticia')
                        ->createQuery('a')
                        ->execute();
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new NoticiaForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new NoticiaForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($noticia = Doctrine::getTable('Noticia')->find(array($request->getParameter('ca_idnoticia'))), sprintf('Object noticia does not exist (%s).', $request->getParameter('ca_idnoticia')));
        $this->form = new NoticiaForm($noticia);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($noticia = Doctrine::getTable('Noticia')->find(array($request->getParameter('ca_idnoticia'))), sprintf('Object noticia does not exist (%s).', $request->getParameter('ca_idnoticia')));
        $this->form = new NoticiaForm($noticia);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($noticia = Doctrine::getTable('Noticia')->find(array($request->getParameter('ca_idnoticia'))), sprintf('Object noticia does not exist (%s).', $request->getParameter('ca_idnoticia')));
        $noticia->delete();

        $this->redirect('noticias/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $noticia = $form->save();

            $this->redirect('noticias/edit?ca_idnoticia=' . $noticia->getCaIdnoticia());
        }
    }

}

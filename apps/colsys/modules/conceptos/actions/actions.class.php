<?php

/**
 * conceptos actions.
 *
 * @package    colsys
 * @subpackage conceptos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class conceptosActions extends sfActions
{
	public function executeIndex(sfWebRequest $request){
	
	}
	
	/*
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->concepto_list = ConceptoPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ConceptoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new ConceptoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($concepto = ConceptoPeer::retrieveByPk($request->getParameter('ca_idconcepto')), sprintf('Object concepto does not exist (%s).', $request->getParameter('ca_idconcepto')));
    $this->form = new ConceptoForm($concepto);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($concepto = ConceptoPeer::retrieveByPk($request->getParameter('ca_idconcepto')), sprintf('Object concepto does not exist (%s).', $request->getParameter('ca_idconcepto')));
    $this->form = new ConceptoForm($concepto);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($concepto = ConceptoPeer::retrieveByPk($request->getParameter('ca_idconcepto')), sprintf('Object concepto does not exist (%s).', $request->getParameter('ca_idconcepto')));
    $concepto->delete();

    $this->redirect('conceptos/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $concepto = $form->save();

      $this->redirect('conceptos/index');
    }
  }
  */
}
?>
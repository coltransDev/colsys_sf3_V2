<?php

/**
 * Concepto form base class.
 *
 * @method Concepto getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseConceptoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idconcepto'  => new sfWidgetFormInputHidden(),
      'ca_concepto'    => new sfWidgetFormTextarea(),
      'ca_unidad'      => new sfWidgetFormTextarea(),
      'ca_transporte'  => new sfWidgetFormTextarea(),
      'ca_modalidad'   => new sfWidgetFormTextarea(),
      'ca_liminferior' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_idconcepto'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_concepto'    => new sfValidatorString(array('required' => false)),
      'ca_unidad'      => new sfValidatorString(array('required' => false)),
      'ca_transporte'  => new sfValidatorString(array('required' => false)),
      'ca_modalidad'   => new sfValidatorString(array('required' => false)),
      'ca_liminferior' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('concepto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Concepto';
  }

}

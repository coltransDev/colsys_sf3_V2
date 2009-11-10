<?php

/**
 * Modalidad form base class.
 *
 * @method Modalidad getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseModalidadForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idmodalidad' => new sfWidgetFormInputHidden(),
      'ca_impoexpo'    => new sfWidgetFormTextarea(),
      'ca_transporte'  => new sfWidgetFormTextarea(),
      'ca_modalidad'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idmodalidad' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idmodalidad', 'required' => false)),
      'ca_impoexpo'    => new sfValidatorString(array('required' => false)),
      'ca_transporte'  => new sfValidatorString(array('required' => false)),
      'ca_modalidad'   => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('modalidad[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Modalidad';
  }

}

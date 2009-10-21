<?php

/**
 * Sia form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseSiaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idsia'    => new sfWidgetFormInputHidden(),
      'ca_nombre'   => new sfWidgetFormTextarea(),
      'ca_tel'      => new sfWidgetFormTextarea(),
      'ca_contacto' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idsia'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idsia', 'required' => false)),
      'ca_nombre'   => new sfValidatorString(array('required' => false)),
      'ca_tel'      => new sfValidatorString(array('required' => false)),
      'ca_contacto' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sia';
  }

}

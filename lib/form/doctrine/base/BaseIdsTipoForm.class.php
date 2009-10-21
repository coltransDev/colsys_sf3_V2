<?php

/**
 * IdsTipo form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseIdsTipoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_tipo'       => new sfWidgetFormInputHidden(),
      'ca_nombre'     => new sfWidgetFormInputText(),
      'ca_aplicacion' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_tipo'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_tipo', 'required' => false)),
      'ca_nombre'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ca_aplicacion' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids_tipo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsTipo';
  }

}

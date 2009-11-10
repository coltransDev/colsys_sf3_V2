<?php

/**
 * Rutina form base class.
 *
 * @method Rutina getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseRutinaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_rutina'      => new sfWidgetFormInputHidden(),
      'ca_opcion'      => new sfWidgetFormInputText(),
      'ca_descripcion' => new sfWidgetFormInputText(),
      'ca_programa'    => new sfWidgetFormInputText(),
      'ca_grupo'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_rutina'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_rutina', 'required' => false)),
      'ca_opcion'      => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ca_descripcion' => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'ca_programa'    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'ca_grupo'       => new sfValidatorString(array('max_length' => 21, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rutina[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rutina';
  }

}

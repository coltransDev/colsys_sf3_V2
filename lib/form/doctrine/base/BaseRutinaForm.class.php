<?php

/**
 * Rutina form base class.
 *
 * @package    form
 * @subpackage rutina
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseRutinaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_rutina'      => new sfWidgetFormInputHidden(),
      'ca_opcion'      => new sfWidgetFormInput(),
      'ca_descripcion' => new sfWidgetFormInput(),
      'ca_programa'    => new sfWidgetFormInput(),
      'ca_grupo'       => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_rutina'      => new sfValidatorDoctrineChoice(array('model' => 'Rutina', 'column' => 'ca_rutina', 'required' => false)),
      'ca_opcion'      => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ca_descripcion' => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'ca_programa'    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'ca_grupo'       => new sfValidatorString(array('max_length' => 21, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rutina[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rutina';
  }

}
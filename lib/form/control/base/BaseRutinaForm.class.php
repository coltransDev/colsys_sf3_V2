<?php

/**
 * Rutina form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseRutinaForm extends BaseFormPropel
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
      'ca_rutina'      => new sfValidatorPropelChoice(array('model' => 'Rutina', 'column' => 'ca_rutina', 'required' => false)),
      'ca_opcion'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_descripcion' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_programa'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_grupo'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
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

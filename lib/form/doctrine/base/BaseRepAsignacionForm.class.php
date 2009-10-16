<?php

/**
 * RepAsignacion form base class.
 *
 * @package    form
 * @subpackage rep_asignacion
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseRepAsignacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte' => new sfWidgetFormInputHidden(),
      'ca_idtarea'   => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_idreporte' => new sfValidatorDoctrineChoice(array('model' => 'RepAsignacion', 'column' => 'ca_idreporte', 'required' => false)),
      'ca_idtarea'   => new sfValidatorDoctrineChoice(array('model' => 'RepAsignacion', 'column' => 'ca_idtarea', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_asignacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepAsignacion';
  }

}
<?php

/**
 * NotTareaAsignacion form base class.
 *
 * @package    form
 * @subpackage not_tarea_asignacion
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseNotTareaAsignacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtarea' => new sfWidgetFormInputHidden(),
      'ca_login'   => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_idtarea' => new sfValidatorDoctrineChoice(array('model' => 'NotTareaAsignacion', 'column' => 'ca_idtarea', 'required' => false)),
      'ca_login'   => new sfValidatorDoctrineChoice(array('model' => 'NotTareaAsignacion', 'column' => 'ca_login', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('not_tarea_asignacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'NotTareaAsignacion';
  }

}
<?php

/**
 * NotTareaAsignacion form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseNotTareaAsignacionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtarea' => new sfWidgetFormInputHidden(),
      'ca_login'   => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_idtarea' => new sfValidatorPropelChoice(array('model' => 'NotTarea', 'column' => 'ca_idtarea', 'required' => false)),
      'ca_login'   => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'ca_login', 'required' => false)),
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

<?php

/**
 * NotTareaAsignacion form base class.
 *
 * @method NotTareaAsignacion getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
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
      'ca_idtarea' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idtarea', 'required' => false)),
      'ca_login'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_login', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('not_tarea_asignacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NotTareaAsignacion';
  }

}

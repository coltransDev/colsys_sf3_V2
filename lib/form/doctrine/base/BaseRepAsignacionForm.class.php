<?php

/**
 * RepAsignacion form base class.
 *
 * @method RepAsignacion getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
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
      'ca_idreporte' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idreporte', 'required' => false)),
      'ca_idtarea'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idtarea', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_asignacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepAsignacion';
  }

}

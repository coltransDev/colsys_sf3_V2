<?php

/**
 * Notificacion form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseNotificacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtarea' => new sfWidgetFormInputHidden(),
      'ca_idemail' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_idtarea' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idtarea', 'required' => false)),
      'ca_idemail' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idemail', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('notificacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Notificacion';
  }

}

<?php

/**
 * Notificacion form base class.
 *
 * @package    form
 * @subpackage notificacion
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
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
      'ca_idtarea' => new sfValidatorDoctrineChoice(array('model' => 'Notificacion', 'column' => 'ca_idtarea', 'required' => false)),
      'ca_idemail' => new sfValidatorDoctrineChoice(array('model' => 'Notificacion', 'column' => 'ca_idemail', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('notificacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Notificacion';
  }

}
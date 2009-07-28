<?php

/**
 * Notificacion form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseNotificacionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtarea' => new sfWidgetFormInputHidden(),
      'ca_idemail' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_idtarea' => new sfValidatorPropelChoice(array('model' => 'NotTarea', 'column' => 'ca_idtarea', 'required' => false)),
      'ca_idemail' => new sfValidatorPropelChoice(array('model' => 'Email', 'column' => 'ca_idemail', 'required' => false)),
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

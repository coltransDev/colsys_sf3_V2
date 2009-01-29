<?php

/**
 * LogUsuario form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseLogUsuarioForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idlog'  => new sfWidgetFormInputHidden(),
      'ca_login'  => new sfWidgetFormInput(),
      'ca_event'  => new sfWidgetFormInput(),
      'ca_module' => new sfWidgetFormInput(),
      'ca_action' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idlog'  => new sfValidatorPropelChoice(array('model' => 'LogUsuario', 'column' => 'ca_idlog', 'required' => false)),
      'ca_login'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ca_event'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_module' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'ca_action' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('log_usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LogUsuario';
  }


}

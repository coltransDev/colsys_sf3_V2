<?php

/**
 * UsuarioLog form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseUsuarioLogForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_id'        => new sfWidgetFormInputHidden(),
      'ca_login'     => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_fchevento' => new sfWidgetFormDateTime(),
      'ca_url'       => new sfWidgetFormInput(),
      'ca_event'     => new sfWidgetFormInput(),
      'ca_ipaddress' => new sfWidgetFormInput(),
      'ca_useragent' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_id'        => new sfValidatorPropelChoice(array('model' => 'UsuarioLog', 'column' => 'ca_id', 'required' => false)),
      'ca_login'     => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'ca_login', 'required' => false)),
      'ca_fchevento' => new sfValidatorDateTime(array('required' => false)),
      'ca_url'       => new sfValidatorString(array('required' => false)),
      'ca_event'     => new sfValidatorString(array('required' => false)),
      'ca_ipaddress' => new sfValidatorString(array('required' => false)),
      'ca_useragent' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('usuario_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UsuarioLog';
  }


}

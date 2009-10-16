<?php

/**
 * UsuarioLog form base class.
 *
 * @package    form
 * @subpackage usuario_log
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseUsuarioLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_id'        => new sfWidgetFormInputHidden(),
      'ca_login'     => new sfWidgetFormDoctrineSelect(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_fchevento' => new sfWidgetFormDateTime(),
      'ca_url'       => new sfWidgetFormInput(),
      'ca_event'     => new sfWidgetFormInput(),
      'ca_ipaddress' => new sfWidgetFormInput(),
      'ca_useragent' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_id'        => new sfValidatorDoctrineChoice(array('model' => 'UsuarioLog', 'column' => 'ca_id', 'required' => false)),
      'ca_login'     => new sfValidatorDoctrineChoice(array('model' => 'Usuario', 'required' => false)),
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
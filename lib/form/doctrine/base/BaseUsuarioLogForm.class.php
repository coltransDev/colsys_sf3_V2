<?php

/**
 * UsuarioLog form base class.
 *
 * @method UsuarioLog getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseUsuarioLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_id'        => new sfWidgetFormInputHidden(),
      'ca_login'     => new sfWidgetFormDoctrineChoice(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_fchevento' => new sfWidgetFormDateTime(),
      'ca_url'       => new sfWidgetFormTextarea(),
      'ca_event'     => new sfWidgetFormTextarea(),
      'ca_ipaddress' => new sfWidgetFormTextarea(),
      'ca_useragent' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_id', 'required' => false)),
      'ca_login'     => new sfValidatorDoctrineChoice(array('model' => 'Usuario', 'required' => false)),
      'ca_fchevento' => new sfValidatorDateTime(array('required' => false)),
      'ca_url'       => new sfValidatorString(array('required' => false)),
      'ca_event'     => new sfValidatorString(array('required' => false)),
      'ca_ipaddress' => new sfValidatorString(array('required' => false)),
      'ca_useragent' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('usuario_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UsuarioLog';
  }

}

<?php

/**
 * Usuario form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseUsuarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_login'        => new sfWidgetFormInputHidden(),
      'ca_nombre'       => new sfWidgetFormInputText(),
      'ca_cargo'        => new sfWidgetFormInputText(),
      'ca_departamento' => new sfWidgetFormInputText(),
      'ca_email'        => new sfWidgetFormInputText(),
      'ca_extension'    => new sfWidgetFormInputText(),
      'ca_idsucursal'   => new sfWidgetFormDoctrineChoice(array('model' => 'Sucursal', 'add_empty' => true)),
      'ca_authmethod'   => new sfWidgetFormInputText(),
      'ca_passwd'       => new sfWidgetFormInputText(),
      'ca_salt'         => new sfWidgetFormInputText(),
      'ca_activo'       => new sfWidgetFormInputCheckbox(),
      'ca_forcechange'  => new sfWidgetFormInputCheckbox(),
      'ca_sucursal'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_login'        => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_login', 'required' => false)),
      'ca_nombre'       => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'ca_cargo'        => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'ca_departamento' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ca_email'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ca_extension'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ca_idsucursal'   => new sfValidatorDoctrineChoice(array('model' => 'Sucursal', 'required' => false)),
      'ca_authmethod'   => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'ca_passwd'       => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'ca_salt'         => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'ca_activo'       => new sfValidatorBoolean(array('required' => false)),
      'ca_forcechange'  => new sfValidatorBoolean(array('required' => false)),
      'ca_sucursal'     => new sfValidatorString(array('max_length' => 40, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usuario';
  }

}

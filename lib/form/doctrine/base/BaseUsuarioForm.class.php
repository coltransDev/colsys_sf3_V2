<?php

/**
 * Usuario form base class.
 *
 * @package    form
 * @subpackage usuario
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseUsuarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_login'        => new sfWidgetFormInputHidden(),
      'ca_nombre'       => new sfWidgetFormInput(),
      'ca_cargo'        => new sfWidgetFormInput(),
      'ca_departamento' => new sfWidgetFormInput(),
      'ca_email'        => new sfWidgetFormInput(),
      'ca_extension'    => new sfWidgetFormInput(),
      'ca_idsucursal'   => new sfWidgetFormDoctrineSelect(array('model' => 'Sucursal', 'add_empty' => true)),
      'ca_authmethod'   => new sfWidgetFormInput(),
      'ca_passwd'       => new sfWidgetFormInput(),
      'ca_salt'         => new sfWidgetFormInput(),
      'ca_activo'       => new sfWidgetFormInputCheckbox(),
      'ca_forcechange'  => new sfWidgetFormInputCheckbox(),
      'ca_sucursal'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_login'        => new sfValidatorDoctrineChoice(array('model' => 'Usuario', 'column' => 'ca_login', 'required' => false)),
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

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usuario';
  }

}
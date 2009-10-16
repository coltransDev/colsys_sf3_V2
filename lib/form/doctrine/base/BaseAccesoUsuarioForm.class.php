<?php

/**
 * AccesoUsuario form base class.
 *
 * @package    form
 * @subpackage acceso_usuario
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseAccesoUsuarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_rutina' => new sfWidgetFormInputHidden(),
      'ca_login'  => new sfWidgetFormInputHidden(),
      'ca_acceso' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_rutina' => new sfValidatorDoctrineChoice(array('model' => 'AccesoUsuario', 'column' => 'ca_rutina', 'required' => false)),
      'ca_login'  => new sfValidatorDoctrineChoice(array('model' => 'AccesoUsuario', 'column' => 'ca_login', 'required' => false)),
      'ca_acceso' => new sfValidatorString(array('max_length' => 30, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('acceso_usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccesoUsuario';
  }

}
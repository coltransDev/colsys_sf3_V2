<?php

/**
 * AccesoUsuario form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseAccesoUsuarioForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_rutina' => new sfWidgetFormInputHidden(),
      'ca_login'  => new sfWidgetFormInputHidden(),
      'ca_acceso' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_rutina' => new sfValidatorPropelChoice(array('model' => 'AccesoUsuario', 'column' => 'ca_rutina', 'required' => false)),
      'ca_login'  => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'ca_login', 'required' => false)),
      'ca_acceso' => new sfValidatorInteger(array('required' => false)),
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

<?php

/**
 * UsuarioPerfil form base class.
 *
 * @package    form
 * @subpackage usuario_perfil
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseUsuarioPerfilForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_login'  => new sfWidgetFormInputHidden(),
      'ca_perfil' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_login'  => new sfValidatorDoctrineChoice(array('model' => 'UsuarioPerfil', 'column' => 'ca_login', 'required' => false)),
      'ca_perfil' => new sfValidatorDoctrineChoice(array('model' => 'UsuarioPerfil', 'column' => 'ca_perfil', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('usuario_perfil[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UsuarioPerfil';
  }

}
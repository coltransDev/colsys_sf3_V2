<?php

/**
 * UsuarioPerfil form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseUsuarioPerfilForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_login'  => new sfWidgetFormInputHidden(),
      'ca_perfil' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_login'  => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'ca_login', 'required' => false)),
      'ca_perfil' => new sfValidatorPropelChoice(array('model' => 'Perfil', 'column' => 'ca_perfil', 'required' => false)),
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

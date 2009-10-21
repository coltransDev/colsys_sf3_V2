<?php

/**
 * UsuarioPerfil form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
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
      'ca_login'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_login', 'required' => false)),
      'ca_perfil' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_perfil', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('usuario_perfil[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UsuarioPerfil';
  }

}

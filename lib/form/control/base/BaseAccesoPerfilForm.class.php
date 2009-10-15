<?php

/**
 * AccesoPerfil form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseAccesoPerfilForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_rutina' => new sfWidgetFormInputHidden(),
      'ca_perfil' => new sfWidgetFormInputHidden(),
      'ca_acceso' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_rutina' => new sfValidatorPropelChoice(array('model' => 'AccesoPerfil', 'column' => 'ca_rutina', 'required' => false)),
      'ca_perfil' => new sfValidatorPropelChoice(array('model' => 'Perfil', 'column' => 'ca_perfil', 'required' => false)),
      'ca_acceso' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('acceso_perfil[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccesoPerfil';
  }


}

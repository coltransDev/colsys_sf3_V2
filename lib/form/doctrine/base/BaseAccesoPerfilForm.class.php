<?php

/**
 * AccesoPerfil form base class.
 *
 * @method AccesoPerfil getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseAccesoPerfilForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_rutina' => new sfWidgetFormInputHidden(),
      'ca_perfil' => new sfWidgetFormInputHidden(),
      'ca_acceso' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_rutina' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_rutina', 'required' => false)),
      'ca_perfil' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_perfil', 'required' => false)),
      'ca_acceso' => new sfValidatorString(array('max_length' => 30, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('acceso_perfil[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccesoPerfil';
  }

}

<?php

/**
 * Perfil form base class.
 *
 * @method Perfil getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BasePerfilForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_perfil'       => new sfWidgetFormInputHidden(),
      'ca_nombre'       => new sfWidgetFormInputText(),
      'ca_departamento' => new sfWidgetFormInputText(),
      'ca_descripcion'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_perfil'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_perfil', 'required' => false)),
      'ca_nombre'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ca_departamento' => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ca_descripcion'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('perfil[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Perfil';
  }

}

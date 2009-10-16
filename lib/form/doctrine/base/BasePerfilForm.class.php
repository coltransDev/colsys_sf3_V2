<?php

/**
 * Perfil form base class.
 *
 * @package    form
 * @subpackage perfil
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePerfilForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_perfil'       => new sfWidgetFormInputHidden(),
      'ca_nombre'       => new sfWidgetFormInput(),
      'ca_departamento' => new sfWidgetFormInput(),
      'ca_descripcion'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_perfil'       => new sfValidatorDoctrineChoice(array('model' => 'Perfil', 'column' => 'ca_perfil', 'required' => false)),
      'ca_nombre'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ca_departamento' => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ca_descripcion'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('perfil[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Perfil';
  }

}
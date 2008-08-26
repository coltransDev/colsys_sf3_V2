<?php

/**
 * NivelesAcceso form base class.
 *
 * @package    form
 * @subpackage niveles_acceso
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseNivelesAccesoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_login'       => new sfWidgetFormInputHidden(),
      'ca_basededatos' => new sfWidgetFormInputHidden(),
      'ca_nivel'       => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_login'       => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'ca_login', 'required' => false)),
      'ca_basededatos' => new sfValidatorPropelChoice(array('model' => 'NivelesAcceso', 'column' => 'ca_basededatos', 'required' => false)),
      'ca_nivel'       => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('niveles_acceso[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'NivelesAcceso';
  }


}

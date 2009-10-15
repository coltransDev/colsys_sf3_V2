<?php

/**
 * NivelesAcceso form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
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

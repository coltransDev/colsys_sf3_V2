<?php

/**
 * Usuario form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseUsuarioForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_login'        => new sfWidgetFormInputHidden(),
      'ca_nombre'       => new sfWidgetFormInput(),
      'ca_cargo'        => new sfWidgetFormInput(),
      'ca_departamento' => new sfWidgetFormInput(),
      'ca_sucursal'     => new sfWidgetFormPropelChoice(array('model' => 'Sucursal', 'add_empty' => true)),
      'ca_email'        => new sfWidgetFormInput(),
      'ca_rutinas'      => new sfWidgetFormInput(),
      'ca_extension'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_login'        => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'ca_login', 'required' => false)),
      'ca_nombre'       => new sfValidatorString(array('required' => false)),
      'ca_cargo'        => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'ca_departamento' => new sfValidatorString(array('required' => false)),
      'ca_sucursal'     => new sfValidatorPropelChoice(array('model' => 'Sucursal', 'column' => 'ca_nombre', 'required' => false)),
      'ca_email'        => new sfValidatorString(array('required' => false)),
      'ca_rutinas'      => new sfValidatorString(array('required' => false)),
      'ca_extension'    => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usuario';
  }


}

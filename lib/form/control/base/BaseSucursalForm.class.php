<?php

/**
 * Sucursal form base class.
 *
 * @package    form
 * @subpackage sucursal
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseSucursalForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_nombre'    => new sfWidgetFormInputHidden(),
      'ca_telefono'  => new sfWidgetFormInput(),
      'ca_fax'       => new sfWidgetFormInput(),
      'ca_direccion' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_nombre'    => new sfValidatorPropelChoice(array('model' => 'Sucursal', 'column' => 'ca_nombre', 'required' => false)),
      'ca_telefono'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ca_fax'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'ca_direccion' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sucursal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sucursal';
  }


}

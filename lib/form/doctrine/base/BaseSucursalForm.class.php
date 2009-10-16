<?php

/**
 * Sucursal form base class.
 *
 * @package    form
 * @subpackage sucursal
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseSucursalForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idsucursal' => new sfWidgetFormInputHidden(),
      'ca_nombre'     => new sfWidgetFormInput(),
      'ca_telefono'   => new sfWidgetFormInput(),
      'ca_fax'        => new sfWidgetFormInput(),
      'ca_direccion'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idsucursal' => new sfValidatorDoctrineChoice(array('model' => 'Sucursal', 'column' => 'ca_idsucursal', 'required' => false)),
      'ca_nombre'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ca_telefono'   => new sfValidatorString(array('required' => false)),
      'ca_fax'        => new sfValidatorString(array('required' => false)),
      'ca_direccion'  => new sfValidatorString(array('required' => false)),
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
<?php

/**
 * Sucursal form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseSucursalForm extends BaseFormPropel
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
      'ca_idsucursal' => new sfValidatorPropelChoice(array('model' => 'Sucursal', 'column' => 'ca_idsucursal', 'required' => false)),
      'ca_nombre'     => new sfValidatorString(array('max_length' => 50)),
      'ca_telefono'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ca_fax'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'ca_direccion'  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
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

<?php

/**
 * IdsSucursal form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseIdsSucursalForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idsucursal'     => new sfWidgetFormInputHidden(),
      'ca_id'             => new sfWidgetFormPropelChoice(array('model' => 'Ids', 'add_empty' => true)),
      'ca_principal'      => new sfWidgetFormInputCheckbox(),
      'ca_direccion'      => new sfWidgetFormInput(),
      'ca_oficina'        => new sfWidgetFormInput(),
      'ca_torre'          => new sfWidgetFormInput(),
      'ca_bloque'         => new sfWidgetFormInput(),
      'ca_interior'       => new sfWidgetFormInput(),
      'ca_localidad'      => new sfWidgetFormInput(),
      'ca_complemento'    => new sfWidgetFormInput(),
      'ca_telefonos'      => new sfWidgetFormInput(),
      'ca_fax'            => new sfWidgetFormInput(),
      'ca_idciudad'       => new sfWidgetFormPropelChoice(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idsucursal'     => new sfValidatorPropelChoice(array('model' => 'IdsSucursal', 'column' => 'ca_idsucursal', 'required' => false)),
      'ca_id'             => new sfValidatorPropelChoice(array('model' => 'Ids', 'column' => 'ca_id', 'required' => false)),
      'ca_principal'      => new sfValidatorBoolean(array('required' => false)),
      'ca_direccion'      => new sfValidatorString(array('required' => false)),
      'ca_oficina'        => new sfValidatorString(array('required' => false)),
      'ca_torre'          => new sfValidatorInteger(array('required' => false)),
      'ca_bloque'         => new sfValidatorString(array('required' => false)),
      'ca_interior'       => new sfValidatorString(array('required' => false)),
      'ca_localidad'      => new sfValidatorString(array('required' => false)),
      'ca_complemento'    => new sfValidatorString(array('required' => false)),
      'ca_telefonos'      => new sfValidatorString(array('required' => false)),
      'ca_fax'            => new sfValidatorString(array('required' => false)),
      'ca_idciudad'       => new sfValidatorPropelChoice(array('model' => 'Ciudad', 'column' => 'ca_idciudad', 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids_sucursal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsSucursal';
  }


}

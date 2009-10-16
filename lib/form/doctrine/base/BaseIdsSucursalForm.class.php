<?php

/**
 * IdsSucursal form base class.
 *
 * @package    form
 * @subpackage ids_sucursal
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseIdsSucursalForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idsucursal'     => new sfWidgetFormInputHidden(),
      'ca_id'             => new sfWidgetFormDoctrineSelect(array('model' => 'Ids', 'add_empty' => true)),
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
      'ca_idciudad'       => new sfWidgetFormDoctrineSelect(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_zipcode'        => new sfWidgetFormInput(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idsucursal'     => new sfValidatorDoctrineChoice(array('model' => 'IdsSucursal', 'column' => 'ca_idsucursal', 'required' => false)),
      'ca_id'             => new sfValidatorDoctrineChoice(array('model' => 'Ids', 'required' => false)),
      'ca_principal'      => new sfValidatorBoolean(array('required' => false)),
      'ca_direccion'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'ca_oficina'        => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'ca_torre'          => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'ca_bloque'         => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'ca_interior'       => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'ca_localidad'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_complemento'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ca_telefonos'      => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ca_fax'            => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ca_idciudad'       => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'required' => false)),
      'ca_zipcode'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
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
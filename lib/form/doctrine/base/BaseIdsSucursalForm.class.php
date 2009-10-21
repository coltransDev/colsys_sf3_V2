<?php

/**
 * IdsSucursal form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseIdsSucursalForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idsucursal'     => new sfWidgetFormInputHidden(),
      'ca_id'             => new sfWidgetFormDoctrineChoice(array('model' => 'Ids', 'add_empty' => true)),
      'ca_principal'      => new sfWidgetFormInputCheckbox(),
      'ca_direccion'      => new sfWidgetFormInputText(),
      'ca_oficina'        => new sfWidgetFormInputText(),
      'ca_torre'          => new sfWidgetFormInputText(),
      'ca_bloque'         => new sfWidgetFormInputText(),
      'ca_interior'       => new sfWidgetFormInputText(),
      'ca_localidad'      => new sfWidgetFormInputText(),
      'ca_complemento'    => new sfWidgetFormInputText(),
      'ca_telefonos'      => new sfWidgetFormInputText(),
      'ca_fax'            => new sfWidgetFormInputText(),
      'ca_idciudad'       => new sfWidgetFormDoctrineChoice(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_zipcode'        => new sfWidgetFormInputText(),
      'ca_usucreado'      => new sfWidgetFormInputText(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInputText(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idsucursal'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idsucursal', 'required' => false)),
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

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsSucursal';
  }

}

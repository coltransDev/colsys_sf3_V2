<?php

/**
 * IdsContacto form base class.
 *
 * @package    form
 * @subpackage ids_contacto
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseIdsContactoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcontacto'     => new sfWidgetFormInputHidden(),
      'ca_idsucursal'     => new sfWidgetFormDoctrineSelect(array('model' => 'IdsSucursal', 'add_empty' => true)),
      'ca_nombres'        => new sfWidgetFormInput(),
      'ca_papellido'      => new sfWidgetFormInput(),
      'ca_sapellido'      => new sfWidgetFormInput(),
      'ca_saludo'         => new sfWidgetFormInput(),
      'ca_direccion'      => new sfWidgetFormInput(),
      'ca_telefonos'      => new sfWidgetFormInput(),
      'ca_fax'            => new sfWidgetFormInput(),
      'ca_email'          => new sfWidgetFormInput(),
      'ca_impoexpo'       => new sfWidgetFormInput(),
      'ca_transporte'     => new sfWidgetFormInput(),
      'ca_cargo'          => new sfWidgetFormInput(),
      'ca_departamento'   => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_sugerido'       => new sfWidgetFormInputCheckbox(),
      'ca_visibilidad'    => new sfWidgetFormInput(),
      'ca_activo'         => new sfWidgetFormInputCheckbox(),
      'ca_codigoarea'     => new sfWidgetFormInput(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_fcheliminado'   => new sfWidgetFormDateTime(),
      'ca_usueliminado'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idcontacto'     => new sfValidatorDoctrineChoice(array('model' => 'IdsContacto', 'column' => 'ca_idcontacto', 'required' => false)),
      'ca_idsucursal'     => new sfValidatorDoctrineChoice(array('model' => 'IdsSucursal', 'required' => false)),
      'ca_nombres'        => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'ca_papellido'      => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'ca_sapellido'      => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'ca_saludo'         => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'ca_direccion'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'ca_telefonos'      => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ca_fax'            => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ca_email'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ca_impoexpo'       => new sfValidatorString(array('required' => false)),
      'ca_transporte'     => new sfValidatorString(array('required' => false)),
      'ca_cargo'          => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_departamento'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'ca_sugerido'       => new sfValidatorBoolean(array('required' => false)),
      'ca_visibilidad'    => new sfValidatorInteger(array('required' => false)),
      'ca_activo'         => new sfValidatorBoolean(array('required' => false)),
      'ca_codigoarea'     => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_fcheliminado'   => new sfValidatorDateTime(array('required' => false)),
      'ca_usueliminado'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids_contacto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsContacto';
  }

}
<?php

/**
 * IdsContacto form base class.
 *
 * @method IdsContacto getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseIdsContactoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcontacto'     => new sfWidgetFormInputHidden(),
      'ca_idsucursal'     => new sfWidgetFormDoctrineChoice(array('model' => 'IdsSucursal', 'add_empty' => true)),
      'ca_nombres'        => new sfWidgetFormInputText(),
      'ca_papellido'      => new sfWidgetFormInputText(),
      'ca_sapellido'      => new sfWidgetFormInputText(),
      'ca_saludo'         => new sfWidgetFormInputText(),
      'ca_direccion'      => new sfWidgetFormInputText(),
      'ca_telefonos'      => new sfWidgetFormInputText(),
      'ca_fax'            => new sfWidgetFormInputText(),
      'ca_email'          => new sfWidgetFormInputText(),
      'ca_impoexpo'       => new sfWidgetFormTextarea(),
      'ca_transporte'     => new sfWidgetFormTextarea(),
      'ca_cargo'          => new sfWidgetFormInputText(),
      'ca_departamento'   => new sfWidgetFormInputText(),
      'ca_observaciones'  => new sfWidgetFormInputText(),
      'ca_sugerido'       => new sfWidgetFormInputCheckbox(),
      'ca_visibilidad'    => new sfWidgetFormInputText(),
      'ca_activo'         => new sfWidgetFormInputCheckbox(),
      'ca_codigoarea'     => new sfWidgetFormInputText(),
      'ca_usucreado'      => new sfWidgetFormInputText(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInputText(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_fcheliminado'   => new sfWidgetFormDateTime(),
      'ca_usueliminado'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_idcontacto'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idcontacto', 'required' => false)),
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

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsContacto';
  }

}

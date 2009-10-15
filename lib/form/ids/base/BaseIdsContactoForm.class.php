<?php

/**
 * IdsContacto form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseIdsContactoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcontacto'     => new sfWidgetFormInputHidden(),
      'ca_idsucursal'     => new sfWidgetFormPropelChoice(array('model' => 'IdsSucursal', 'add_empty' => false)),
      'ca_nombres'        => new sfWidgetFormInput(),
      'ca_papellido'      => new sfWidgetFormInput(),
      'ca_sapellido'      => new sfWidgetFormInput(),
      'ca_saludo'         => new sfWidgetFormInput(),
      'ca_direccion'      => new sfWidgetFormInput(),
      'ca_telefonos'      => new sfWidgetFormInput(),
      'ca_fax'            => new sfWidgetFormInput(),
      'ca_idciudad'       => new sfWidgetFormPropelChoice(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_email'          => new sfWidgetFormInput(),
      'ca_impoexpo'       => new sfWidgetFormInput(),
      'ca_transporte'     => new sfWidgetFormInput(),
      'ca_cargo'          => new sfWidgetFormInput(),
      'ca_departamento'   => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_sugerido'       => new sfWidgetFormInputCheckbox(),
      'ca_activo'         => new sfWidgetFormInputCheckbox(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_fcheliminado'   => new sfWidgetFormDateTime(),
      'ca_usueliminado'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idcontacto'     => new sfValidatorPropelChoice(array('model' => 'IdsContacto', 'column' => 'ca_idcontacto', 'required' => false)),
      'ca_idsucursal'     => new sfValidatorPropelChoice(array('model' => 'IdsSucursal', 'column' => 'ca_idsucursal')),
      'ca_nombres'        => new sfValidatorString(),
      'ca_papellido'      => new sfValidatorString(),
      'ca_sapellido'      => new sfValidatorString(array('required' => false)),
      'ca_saludo'         => new sfValidatorString(array('required' => false)),
      'ca_direccion'      => new sfValidatorString(array('required' => false)),
      'ca_telefonos'      => new sfValidatorString(array('required' => false)),
      'ca_fax'            => new sfValidatorString(array('required' => false)),
      'ca_idciudad'       => new sfValidatorPropelChoice(array('model' => 'Ciudad', 'column' => 'ca_idciudad', 'required' => false)),
      'ca_email'          => new sfValidatorString(array('required' => false)),
      'ca_impoexpo'       => new sfValidatorString(array('required' => false)),
      'ca_transporte'     => new sfValidatorString(array('required' => false)),
      'ca_cargo'          => new sfValidatorString(array('required' => false)),
      'ca_departamento'   => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_sugerido'       => new sfValidatorBoolean(array('required' => false)),
      'ca_activo'         => new sfValidatorBoolean(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
      'ca_fcheliminado'   => new sfValidatorDateTime(array('required' => false)),
      'ca_usueliminado'   => new sfValidatorString(array('required' => false)),
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

<?php

/**
 * Contacto form base class.
 *
 * @package    form
 * @subpackage contacto
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseContactoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcontacto'     => new sfWidgetFormInputHidden(),
      'ca_idcliente'      => new sfWidgetFormPropelSelect(array('model' => 'Cliente', 'add_empty' => false)),
      'ca_papellido'      => new sfWidgetFormInput(),
      'ca_sapellido'      => new sfWidgetFormInput(),
      'ca_nombres'        => new sfWidgetFormInput(),
      'ca_saludo'         => new sfWidgetFormInput(),
      'ca_cargo'          => new sfWidgetFormInput(),
      'ca_departamento'   => new sfWidgetFormInput(),
      'ca_telefonos'      => new sfWidgetFormInput(),
      'ca_fax'            => new sfWidgetFormInput(),
      'ca_email'          => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDate(),
      'ca_fchactualizado' => new sfWidgetFormDate(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_cumpleanos'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idcontacto'     => new sfValidatorPropelChoice(array('model' => 'Contacto', 'column' => 'ca_idcontacto', 'required' => false)),
      'ca_idcliente'      => new sfValidatorPropelChoice(array('model' => 'Cliente', 'column' => 'ca_idcliente')),
      'ca_papellido'      => new sfValidatorString(),
      'ca_sapellido'      => new sfValidatorString(array('required' => false)),
      'ca_nombres'        => new sfValidatorString(array('required' => false)),
      'ca_saludo'         => new sfValidatorString(array('required' => false)),
      'ca_cargo'          => new sfValidatorString(array('required' => false)),
      'ca_departamento'   => new sfValidatorString(array('required' => false)),
      'ca_telefonos'      => new sfValidatorString(array('required' => false)),
      'ca_fax'            => new sfValidatorString(array('required' => false)),
      'ca_email'          => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDate(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDate(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
      'ca_cumpleanos'     => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contacto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contacto';
  }


}

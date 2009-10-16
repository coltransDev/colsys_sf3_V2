<?php

/**
 * Contacto form base class.
 *
 * @package    form
 * @subpackage contacto
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseContactoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcontacto'    => new sfWidgetFormInputHidden(),
      'ca_idcliente'     => new sfWidgetFormDoctrineSelect(array('model' => 'Cliente', 'add_empty' => true)),
      'ca_papellido'     => new sfWidgetFormInput(),
      'ca_sapellido'     => new sfWidgetFormInput(),
      'ca_nombres'       => new sfWidgetFormInput(),
      'ca_saludo'        => new sfWidgetFormInput(),
      'ca_cargo'         => new sfWidgetFormInput(),
      'ca_departamento'  => new sfWidgetFormInput(),
      'ca_telefonos'     => new sfWidgetFormInput(),
      'ca_fax'           => new sfWidgetFormInput(),
      'ca_email'         => new sfWidgetFormInput(),
      'ca_observaciones' => new sfWidgetFormInput(),
      'ca_fchcreado'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idcontacto'    => new sfValidatorDoctrineChoice(array('model' => 'Contacto', 'column' => 'ca_idcontacto', 'required' => false)),
      'ca_idcliente'     => new sfValidatorDoctrineChoice(array('model' => 'Cliente', 'required' => false)),
      'ca_papellido'     => new sfValidatorString(array('required' => false)),
      'ca_sapellido'     => new sfValidatorString(array('required' => false)),
      'ca_nombres'       => new sfValidatorString(array('required' => false)),
      'ca_saludo'        => new sfValidatorString(array('required' => false)),
      'ca_cargo'         => new sfValidatorString(array('required' => false)),
      'ca_departamento'  => new sfValidatorString(array('required' => false)),
      'ca_telefonos'     => new sfValidatorString(array('required' => false)),
      'ca_fax'           => new sfValidatorString(array('required' => false)),
      'ca_email'         => new sfValidatorString(array('required' => false)),
      'ca_observaciones' => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'     => new sfValidatorString(array('required' => false)),
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
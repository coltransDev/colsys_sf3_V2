<?php

/**
 * Contacto form base class.
 *
 * @method Contacto getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseContactoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcontacto'    => new sfWidgetFormInputHidden(),
      'ca_idcliente'     => new sfWidgetFormDoctrineChoice(array('model' => 'Cliente', 'add_empty' => true)),
      'ca_papellido'     => new sfWidgetFormTextarea(),
      'ca_sapellido'     => new sfWidgetFormTextarea(),
      'ca_nombres'       => new sfWidgetFormTextarea(),
      'ca_saludo'        => new sfWidgetFormTextarea(),
      'ca_cargo'         => new sfWidgetFormTextarea(),
      'ca_departamento'  => new sfWidgetFormTextarea(),
      'ca_telefonos'     => new sfWidgetFormTextarea(),
      'ca_fax'           => new sfWidgetFormTextarea(),
      'ca_email'         => new sfWidgetFormTextarea(),
      'ca_observaciones' => new sfWidgetFormTextarea(),
      'ca_fchcreado'     => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idcontacto'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idcontacto', 'required' => false)),
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

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contacto';
  }

}

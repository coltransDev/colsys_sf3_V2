<?php

/**
 * Tercero form base class.
 *
 * @method Tercero getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseTerceroForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtercero'      => new sfWidgetFormInputHidden(),
      'ca_nombre'         => new sfWidgetFormTextarea(),
      'ca_contacto'       => new sfWidgetFormTextarea(),
      'ca_direccion'      => new sfWidgetFormTextarea(),
      'ca_telefonos'      => new sfWidgetFormTextarea(),
      'ca_fax'            => new sfWidgetFormTextarea(),
      'ca_idciudad'       => new sfWidgetFormDoctrineChoice(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_email'          => new sfWidgetFormTextarea(),
      'ca_vendedor'       => new sfWidgetFormTextarea(),
      'ca_tipo'           => new sfWidgetFormTextarea(),
      'ca_identificacion' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idtercero'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idtercero', 'required' => false)),
      'ca_nombre'         => new sfValidatorString(array('required' => false)),
      'ca_contacto'       => new sfValidatorString(array('required' => false)),
      'ca_direccion'      => new sfValidatorString(array('required' => false)),
      'ca_telefonos'      => new sfValidatorString(array('required' => false)),
      'ca_fax'            => new sfValidatorString(array('required' => false)),
      'ca_idciudad'       => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'required' => false)),
      'ca_email'          => new sfValidatorString(array('required' => false)),
      'ca_vendedor'       => new sfValidatorString(array('required' => false)),
      'ca_tipo'           => new sfValidatorString(array('required' => false)),
      'ca_identificacion' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tercero[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tercero';
  }

}

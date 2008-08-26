<?php

/**
 * Tercero form base class.
 *
 * @package    form
 * @subpackage tercero
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseTerceroForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtercero'      => new sfWidgetFormInputHidden(),
      'ca_nombre'         => new sfWidgetFormInput(),
      'ca_contacto'       => new sfWidgetFormInput(),
      'ca_direccion'      => new sfWidgetFormInput(),
      'ca_telefonos'      => new sfWidgetFormInput(),
      'ca_fax'            => new sfWidgetFormInput(),
      'ca_idciudad'       => new sfWidgetFormInput(),
      'ca_email'          => new sfWidgetFormInput(),
      'ca_vendedor'       => new sfWidgetFormInput(),
      'ca_tipo'           => new sfWidgetFormInput(),
      'ca_identificacion' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idtercero'      => new sfValidatorPropelChoice(array('model' => 'Tercero', 'column' => 'ca_idtercero', 'required' => false)),
      'ca_nombre'         => new sfValidatorString(array('required' => false)),
      'ca_contacto'       => new sfValidatorString(array('required' => false)),
      'ca_direccion'      => new sfValidatorString(array('required' => false)),
      'ca_telefonos'      => new sfValidatorString(array('required' => false)),
      'ca_fax'            => new sfValidatorString(array('required' => false)),
      'ca_idciudad'       => new sfValidatorString(array('required' => false)),
      'ca_email'          => new sfValidatorString(array('required' => false)),
      'ca_vendedor'       => new sfValidatorString(array('required' => false)),
      'ca_tipo'           => new sfValidatorString(array('required' => false)),
      'ca_identificacion' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tercero[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tercero';
  }


}

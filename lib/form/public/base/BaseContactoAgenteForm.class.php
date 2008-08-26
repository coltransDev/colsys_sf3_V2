<?php

/**
 * ContactoAgente form base class.
 *
 * @package    form
 * @subpackage contacto_agente
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseContactoAgenteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcontacto' => new sfWidgetFormInputHidden(),
      'ca_idagente'   => new sfWidgetFormPropelSelect(array('model' => 'Agente', 'add_empty' => true)),
      'ca_nombre'     => new sfWidgetFormInput(),
      'ca_direccion'  => new sfWidgetFormInput(),
      'ca_telefonos'  => new sfWidgetFormInput(),
      'ca_fax'        => new sfWidgetFormInput(),
      'ca_idciudad'   => new sfWidgetFormPropelSelect(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_email'      => new sfWidgetFormInput(),
      'ca_impoexpo'   => new sfWidgetFormInput(),
      'ca_transporte' => new sfWidgetFormInput(),
      'ca_cargo'      => new sfWidgetFormInput(),
      'ca_detalle'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idcontacto' => new sfValidatorPropelChoice(array('model' => 'ContactoAgente', 'column' => 'ca_idcontacto', 'required' => false)),
      'ca_idagente'   => new sfValidatorPropelChoice(array('model' => 'Agente', 'column' => 'ca_idagente', 'required' => false)),
      'ca_nombre'     => new sfValidatorString(array('required' => false)),
      'ca_direccion'  => new sfValidatorString(array('required' => false)),
      'ca_telefonos'  => new sfValidatorString(array('required' => false)),
      'ca_fax'        => new sfValidatorString(array('required' => false)),
      'ca_idciudad'   => new sfValidatorPropelChoice(array('model' => 'Ciudad', 'column' => 'ca_idciudad', 'required' => false)),
      'ca_email'      => new sfValidatorString(array('required' => false)),
      'ca_impoexpo'   => new sfValidatorString(array('required' => false)),
      'ca_transporte' => new sfValidatorString(array('required' => false)),
      'ca_cargo'      => new sfValidatorString(array('required' => false)),
      'ca_detalle'    => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contacto_agente[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContactoAgente';
  }


}

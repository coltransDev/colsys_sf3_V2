<?php

/**
 * ContactoAgente form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseContactoAgenteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcontacto'     => new sfWidgetFormInputHidden(),
      'ca_idagente'       => new sfWidgetFormPropelChoice(array('model' => 'Agente', 'add_empty' => true)),
      'ca_nombre'         => new sfWidgetFormInput(),
      'ca_apellido'       => new sfWidgetFormInput(),
      'ca_direccion'      => new sfWidgetFormInput(),
      'ca_telefonos'      => new sfWidgetFormInput(),
      'ca_fax'            => new sfWidgetFormInput(),
      'ca_idciudad'       => new sfWidgetFormPropelChoice(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_email'          => new sfWidgetFormInput(),
      'ca_impoexpo'       => new sfWidgetFormInput(),
      'ca_transporte'     => new sfWidgetFormInput(),
      'ca_cargo'          => new sfWidgetFormInput(),
      'ca_detalle'        => new sfWidgetFormInput(),
      'ca_sugerido'       => new sfWidgetFormInputCheckbox(),
      'ca_activo'         => new sfWidgetFormInputCheckbox(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idcontacto'     => new sfValidatorPropelChoice(array('model' => 'ContactoAgente', 'column' => 'ca_idcontacto', 'required' => false)),
      'ca_idagente'       => new sfValidatorPropelChoice(array('model' => 'Agente', 'column' => 'ca_idagente', 'required' => false)),
      'ca_nombre'         => new sfValidatorString(array('required' => false)),
      'ca_apellido'       => new sfValidatorString(array('required' => false)),
      'ca_direccion'      => new sfValidatorString(array('required' => false)),
      'ca_telefonos'      => new sfValidatorString(array('required' => false)),
      'ca_fax'            => new sfValidatorString(array('required' => false)),
      'ca_idciudad'       => new sfValidatorPropelChoice(array('model' => 'Ciudad', 'column' => 'ca_idciudad', 'required' => false)),
      'ca_email'          => new sfValidatorString(array('required' => false)),
      'ca_impoexpo'       => new sfValidatorString(array('required' => false)),
      'ca_transporte'     => new sfValidatorString(array('required' => false)),
      'ca_cargo'          => new sfValidatorString(array('required' => false)),
      'ca_detalle'        => new sfValidatorString(array('required' => false)),
      'ca_sugerido'       => new sfValidatorBoolean(array('required' => false)),
      'ca_activo'         => new sfValidatorBoolean(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
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

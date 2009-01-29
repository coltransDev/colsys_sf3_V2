<?php

/**
 * Agente form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseAgenteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idagente'    => new sfWidgetFormInputHidden(),
      'ca_nombre'      => new sfWidgetFormInput(),
      'ca_direccion'   => new sfWidgetFormInput(),
      'ca_telefonos'   => new sfWidgetFormInput(),
      'ca_fax'         => new sfWidgetFormInput(),
      'ca_idciudad'    => new sfWidgetFormPropelChoice(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_zipcode'     => new sfWidgetFormInput(),
      'ca_website'     => new sfWidgetFormInput(),
      'ca_email'       => new sfWidgetFormInput(),
      'ca_divulgacion' => new sfWidgetFormInput(),
      'ca_activo'      => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'ca_idagente'    => new sfValidatorPropelChoice(array('model' => 'Agente', 'column' => 'ca_idagente', 'required' => false)),
      'ca_nombre'      => new sfValidatorString(array('required' => false)),
      'ca_direccion'   => new sfValidatorString(array('required' => false)),
      'ca_telefonos'   => new sfValidatorString(array('required' => false)),
      'ca_fax'         => new sfValidatorString(array('required' => false)),
      'ca_idciudad'    => new sfValidatorPropelChoice(array('model' => 'Ciudad', 'column' => 'ca_idciudad', 'required' => false)),
      'ca_zipcode'     => new sfValidatorString(array('required' => false)),
      'ca_website'     => new sfValidatorString(array('required' => false)),
      'ca_email'       => new sfValidatorString(array('required' => false)),
      'ca_divulgacion' => new sfValidatorString(array('required' => false)),
      'ca_activo'      => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('agente[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Agente';
  }


}

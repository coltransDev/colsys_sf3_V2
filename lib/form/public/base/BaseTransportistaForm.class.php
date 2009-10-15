<?php

/**
 * Transportista form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseTransportistaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtransportista' => new sfWidgetFormInputHidden(),
      'ca_digito'          => new sfWidgetFormInput(),
      'ca_nombre'          => new sfWidgetFormInput(),
      'ca_direccion'       => new sfWidgetFormInput(),
      'ca_telefonos'       => new sfWidgetFormInput(),
      'ca_fax'             => new sfWidgetFormInput(),
      'ca_idciudad'        => new sfWidgetFormInput(),
      'ca_website'         => new sfWidgetFormInput(),
      'ca_email'           => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idtransportista' => new sfValidatorPropelChoice(array('model' => 'Transportista', 'column' => 'ca_idtransportista', 'required' => false)),
      'ca_digito'          => new sfValidatorNumber(array('required' => false)),
      'ca_nombre'          => new sfValidatorString(array('required' => false)),
      'ca_direccion'       => new sfValidatorString(array('required' => false)),
      'ca_telefonos'       => new sfValidatorString(array('required' => false)),
      'ca_fax'             => new sfValidatorString(array('required' => false)),
      'ca_idciudad'        => new sfValidatorString(array('required' => false)),
      'ca_website'         => new sfValidatorString(array('required' => false)),
      'ca_email'           => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('transportista[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Transportista';
  }


}

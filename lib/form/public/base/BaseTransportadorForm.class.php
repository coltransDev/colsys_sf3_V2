<?php

/**
 * Transportador form base class.
 *
 * @package    form
 * @subpackage transportador
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseTransportadorForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idlinea'         => new sfWidgetFormInputHidden(),
      'ca_idtransportista' => new sfWidgetFormInput(),
      'ca_nombre'          => new sfWidgetFormInput(),
      'ca_sigla'           => new sfWidgetFormInput(),
      'ca_transporte'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idlinea'         => new sfValidatorPropelChoice(array('model' => 'Transportador', 'column' => 'ca_idlinea', 'required' => false)),
      'ca_idtransportista' => new sfValidatorNumber(array('required' => false)),
      'ca_nombre'          => new sfValidatorString(array('required' => false)),
      'ca_sigla'           => new sfValidatorString(array('required' => false)),
      'ca_transporte'      => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('transportador[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Transportador';
  }


}

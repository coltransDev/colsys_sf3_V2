<?php

/**
 * PricFlete form base class.
 *
 * @package    form
 * @subpackage pric_flete
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BasePricFleteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrayecto' => new sfWidgetFormInputHidden(),
      'ca_idconcepto' => new sfWidgetFormInputHidden(),
      'ca_vlrneto'    => new sfWidgetFormInput(),
      'ca_vlrminimo'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idtrayecto' => new sfValidatorPropelChoice(array('model' => 'Trayecto', 'column' => 'ca_idtrayecto', 'required' => false)),
      'ca_idconcepto' => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_vlrneto'    => new sfValidatorNumber(array('required' => false)),
      'ca_vlrminimo'  => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_flete[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricFlete';
  }


}

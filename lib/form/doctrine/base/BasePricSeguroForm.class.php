<?php

/**
 * PricSeguro form base class.
 *
 * @package    form
 * @subpackage pric_seguro
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePricSeguroForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idgrupo'            => new sfWidgetFormInputHidden(),
      'ca_transporte'         => new sfWidgetFormInputHidden(),
      'ca_vlrprima'           => new sfWidgetFormInput(),
      'ca_vlrminima'          => new sfWidgetFormInput(),
      'ca_vlrobtencionpoliza' => new sfWidgetFormInput(),
      'ca_idmoneda'           => new sfWidgetFormInput(),
      'ca_observaciones'      => new sfWidgetFormInput(),
      'ca_fchcreado'          => new sfWidgetFormDateTime(),
      'ca_usucreado'          => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idgrupo'            => new sfValidatorDoctrineChoice(array('model' => 'PricSeguro', 'column' => 'ca_idgrupo', 'required' => false)),
      'ca_transporte'         => new sfValidatorDoctrineChoice(array('model' => 'PricSeguro', 'column' => 'ca_transporte', 'required' => false)),
      'ca_vlrprima'           => new sfValidatorNumber(array('required' => false)),
      'ca_vlrminima'          => new sfValidatorNumber(array('required' => false)),
      'ca_vlrobtencionpoliza' => new sfValidatorNumber(array('required' => false)),
      'ca_idmoneda'           => new sfValidatorString(array('required' => false)),
      'ca_observaciones'      => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'          => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'          => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_seguro[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricSeguro';
  }

}
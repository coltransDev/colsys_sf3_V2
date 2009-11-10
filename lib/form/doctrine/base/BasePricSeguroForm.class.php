<?php

/**
 * PricSeguro form base class.
 *
 * @method PricSeguro getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BasePricSeguroForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idgrupo'            => new sfWidgetFormInputHidden(),
      'ca_transporte'         => new sfWidgetFormInputHidden(),
      'ca_vlrprima'           => new sfWidgetFormInputText(),
      'ca_vlrminima'          => new sfWidgetFormInputText(),
      'ca_vlrobtencionpoliza' => new sfWidgetFormInputText(),
      'ca_idmoneda'           => new sfWidgetFormTextarea(),
      'ca_observaciones'      => new sfWidgetFormTextarea(),
      'ca_fchcreado'          => new sfWidgetFormDateTime(),
      'ca_usucreado'          => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idgrupo'            => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idgrupo', 'required' => false)),
      'ca_transporte'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_transporte', 'required' => false)),
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

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricSeguro';
  }

}

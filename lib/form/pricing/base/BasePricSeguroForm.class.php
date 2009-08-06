<?php

/**
 * PricSeguro form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePricSeguroForm extends BaseFormPropel
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
      'ca_idgrupo'            => new sfValidatorPropelChoice(array('model' => 'TraficoGrupo', 'column' => 'ca_idgrupo', 'required' => false)),
      'ca_transporte'         => new sfValidatorPropelChoice(array('model' => 'PricSeguro', 'column' => 'ca_transporte', 'required' => false)),
      'ca_vlrprima'           => new sfValidatorNumber(array('required' => false)),
      'ca_vlrminima'          => new sfValidatorNumber(array('required' => false)),
      'ca_vlrobtencionpoliza' => new sfValidatorNumber(array('required' => false)),
      'ca_idmoneda'           => new sfValidatorString(array('max_length' => 3, 'required' => false)),
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

<?php

/**
 * PricRecargoParametro form base class.
 *
 * @package    form
 * @subpackage pric_recargo_parametro
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePricRecargoParametroForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idlinea'       => new sfWidgetFormInputHidden(),
      'ca_transporte'    => new sfWidgetFormInputHidden(),
      'ca_modalidad'     => new sfWidgetFormInputHidden(),
      'ca_impoexpo'      => new sfWidgetFormInputHidden(),
      'ca_concepto'      => new sfWidgetFormInputHidden(),
      'ca_valor'         => new sfWidgetFormInput(),
      'ca_observaciones' => new sfWidgetFormInput(),
      'ca_fchcreado'     => new sfWidgetFormDateTime(),
      'ca_usucreado'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idlinea'       => new sfValidatorDoctrineChoice(array('model' => 'PricRecargoParametro', 'column' => 'ca_idlinea', 'required' => false)),
      'ca_transporte'    => new sfValidatorDoctrineChoice(array('model' => 'PricRecargoParametro', 'column' => 'ca_transporte', 'required' => false)),
      'ca_modalidad'     => new sfValidatorDoctrineChoice(array('model' => 'PricRecargoParametro', 'column' => 'ca_modalidad', 'required' => false)),
      'ca_impoexpo'      => new sfValidatorDoctrineChoice(array('model' => 'PricRecargoParametro', 'column' => 'ca_impoexpo', 'required' => false)),
      'ca_concepto'      => new sfValidatorDoctrineChoice(array('model' => 'PricRecargoParametro', 'column' => 'ca_concepto', 'required' => false)),
      'ca_valor'         => new sfValidatorString(array('required' => false)),
      'ca_observaciones' => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'     => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'     => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_recargo_parametro[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricRecargoParametro';
  }

}
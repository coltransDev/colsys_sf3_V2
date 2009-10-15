<?php

/**
 * PricRecargoParametro form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePricRecargoParametroForm extends BaseFormPropel
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
      'ca_idlinea'       => new sfValidatorPropelChoice(array('model' => 'Transportador', 'column' => 'ca_idlinea', 'required' => false)),
      'ca_transporte'    => new sfValidatorPropelChoice(array('model' => 'PricRecargoParametro', 'column' => 'ca_transporte', 'required' => false)),
      'ca_modalidad'     => new sfValidatorPropelChoice(array('model' => 'PricRecargoParametro', 'column' => 'ca_modalidad', 'required' => false)),
      'ca_impoexpo'      => new sfValidatorPropelChoice(array('model' => 'PricRecargoParametro', 'column' => 'ca_impoexpo', 'required' => false)),
      'ca_concepto'      => new sfValidatorPropelChoice(array('model' => 'PricRecargoParametro', 'column' => 'ca_concepto', 'required' => false)),
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

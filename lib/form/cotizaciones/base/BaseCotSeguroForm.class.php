<?php

/**
 * CotSeguro form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseCotSeguroForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idseguro'       => new sfWidgetFormInputHidden(),
      'ca_idcotizacion'   => new sfWidgetFormPropelChoice(array('model' => 'Cotizacion', 'add_empty' => false)),
      'ca_idmoneda'       => new sfWidgetFormPropelChoice(array('model' => 'Moneda', 'add_empty' => false)),
      'ca_prima_tip'      => new sfWidgetFormInput(),
      'ca_prima_vlr'      => new sfWidgetFormInput(),
      'ca_prima_min'      => new sfWidgetFormInput(),
      'ca_obtencion'      => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_transporte'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idseguro'       => new sfValidatorPropelChoice(array('model' => 'CotSeguro', 'column' => 'ca_idseguro', 'required' => false)),
      'ca_idcotizacion'   => new sfValidatorPropelChoice(array('model' => 'Cotizacion', 'column' => 'ca_idcotizacion')),
      'ca_idmoneda'       => new sfValidatorPropelChoice(array('model' => 'Moneda', 'column' => 'ca_idmoneda')),
      'ca_prima_tip'      => new sfValidatorString(array('required' => false)),
      'ca_prima_vlr'      => new sfValidatorNumber(array('required' => false)),
      'ca_prima_min'      => new sfValidatorNumber(array('required' => false)),
      'ca_obtencion'      => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
      'ca_transporte'     => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cot_seguro[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CotSeguro';
  }


}

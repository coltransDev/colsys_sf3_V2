<?php

/**
 * CotSeguro form base class.
 *
 * @package    form
 * @subpackage cot_seguro
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCotSeguroForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idseguro'       => new sfWidgetFormInputHidden(),
      'ca_idcotizacion'   => new sfWidgetFormDoctrineSelect(array('model' => 'Cotizacion', 'add_empty' => true)),
      'ca_idmoneda'       => new sfWidgetFormInput(),
      'ca_prima_tip'      => new sfWidgetFormInput(),
      'ca_prima_vlr'      => new sfWidgetFormInput(),
      'ca_prima_min'      => new sfWidgetFormInput(),
      'ca_obtencion'      => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_transporte'     => new sfWidgetFormInput(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idseguro'       => new sfValidatorDoctrineChoice(array('model' => 'CotSeguro', 'column' => 'ca_idseguro', 'required' => false)),
      'ca_idcotizacion'   => new sfValidatorDoctrineChoice(array('model' => 'Cotizacion', 'required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('required' => false)),
      'ca_prima_tip'      => new sfValidatorString(array('required' => false)),
      'ca_prima_vlr'      => new sfValidatorNumber(array('required' => false)),
      'ca_prima_min'      => new sfValidatorNumber(array('required' => false)),
      'ca_obtencion'      => new sfValidatorNumber(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_transporte'     => new sfValidatorString(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
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
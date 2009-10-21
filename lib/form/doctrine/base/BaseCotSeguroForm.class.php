<?php

/**
 * CotSeguro form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseCotSeguroForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idseguro'       => new sfWidgetFormInputHidden(),
      'ca_idcotizacion'   => new sfWidgetFormDoctrineChoice(array('model' => 'Cotizacion', 'add_empty' => true)),
      'ca_idmoneda'       => new sfWidgetFormTextarea(),
      'ca_prima_tip'      => new sfWidgetFormTextarea(),
      'ca_prima_vlr'      => new sfWidgetFormInputText(),
      'ca_prima_min'      => new sfWidgetFormInputText(),
      'ca_obtencion'      => new sfWidgetFormInputText(),
      'ca_observaciones'  => new sfWidgetFormTextarea(),
      'ca_transporte'     => new sfWidgetFormTextarea(),
      'ca_usucreado'      => new sfWidgetFormInputText(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInputText(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idseguro'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idseguro', 'required' => false)),
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

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CotSeguro';
  }

}

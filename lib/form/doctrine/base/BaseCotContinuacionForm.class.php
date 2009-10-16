<?php

/**
 * CotContinuacion form base class.
 *
 * @package    form
 * @subpackage cot_continuacion
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCotContinuacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcontinuacion' => new sfWidgetFormInputHidden(),
      'ca_idcotizacion'   => new sfWidgetFormDoctrineSelect(array('model' => 'Cotizacion', 'add_empty' => true)),
      'ca_tipo'           => new sfWidgetFormInput(),
      'ca_modalidad'      => new sfWidgetFormInput(),
      'ca_origen'         => new sfWidgetFormDoctrineSelect(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_destino'        => new sfWidgetFormDoctrineSelect(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_idconcepto'     => new sfWidgetFormDoctrineSelect(array('model' => 'Concepto', 'add_empty' => true)),
      'ca_idequipo'       => new sfWidgetFormDoctrineSelect(array('model' => 'Concepto', 'add_empty' => true)),
      'ca_idmoneda'       => new sfWidgetFormInput(),
      'ca_frecuencia'     => new sfWidgetFormInput(),
      'ca_tiempotransito' => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_valor_tar'      => new sfWidgetFormInput(),
      'ca_valor_min'      => new sfWidgetFormInput(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idcontinuacion' => new sfValidatorDoctrineChoice(array('model' => 'CotContinuacion', 'column' => 'ca_idcontinuacion', 'required' => false)),
      'ca_idcotizacion'   => new sfValidatorDoctrineChoice(array('model' => 'Cotizacion', 'required' => false)),
      'ca_tipo'           => new sfValidatorString(array('required' => false)),
      'ca_modalidad'      => new sfValidatorString(array('required' => false)),
      'ca_origen'         => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'required' => false)),
      'ca_destino'        => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'required' => false)),
      'ca_idconcepto'     => new sfValidatorDoctrineChoice(array('model' => 'Concepto', 'required' => false)),
      'ca_idequipo'       => new sfValidatorDoctrineChoice(array('model' => 'Concepto', 'required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('required' => false)),
      'ca_frecuencia'     => new sfValidatorString(array('required' => false)),
      'ca_tiempotransito' => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_valor_tar'      => new sfValidatorNumber(array('required' => false)),
      'ca_valor_min'      => new sfValidatorNumber(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cot_continuacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CotContinuacion';
  }

}
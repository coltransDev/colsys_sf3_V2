<?php

/**
 * CotContinuacion form base class.
 *
 * @package    form
 * @subpackage cot_continuacion
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseCotContinuacionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcotizacion'   => new sfWidgetFormInputHidden(),
      'ca_tipo'           => new sfWidgetFormInputHidden(),
      'ca_modalidad'      => new sfWidgetFormInput(),
      'ca_origen'         => new sfWidgetFormInputHidden(),
      'ca_destino'        => new sfWidgetFormInputHidden(),
      'ca_idconcepto'     => new sfWidgetFormInputHidden(),
      'ca_idmoneda'       => new sfWidgetFormInput(),
      'ca_idequipo'       => new sfWidgetFormInput(),
      'ca_tarifa'         => new sfWidgetFormInput(),
      'ca_frecuencia'     => new sfWidgetFormInput(),
      'ca_tiempotransito' => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idcotizacion'   => new sfValidatorPropelChoice(array('model' => 'Cotizacion', 'column' => 'ca_idcotizacion', 'required' => false)),
      'ca_tipo'           => new sfValidatorPropelChoice(array('model' => 'CotContinuacion', 'column' => 'ca_tipo', 'required' => false)),
      'ca_modalidad'      => new sfValidatorString(array('required' => false)),
      'ca_origen'         => new sfValidatorPropelChoice(array('model' => 'CotContinuacion', 'column' => 'ca_origen', 'required' => false)),
      'ca_destino'        => new sfValidatorPropelChoice(array('model' => 'CotContinuacion', 'column' => 'ca_destino', 'required' => false)),
      'ca_idconcepto'     => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('required' => false)),
      'ca_idequipo'       => new sfValidatorInteger(array('required' => false)),
      'ca_tarifa'         => new sfValidatorString(array('required' => false)),
      'ca_frecuencia'     => new sfValidatorString(array('required' => false)),
      'ca_tiempotransito' => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
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

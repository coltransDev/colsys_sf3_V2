<?php

/**
 * CotContinuacion form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseCotContinuacionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcontinuacion' => new sfWidgetFormInputHidden(),
      'ca_idcotizacion'   => new sfWidgetFormPropelChoice(array('model' => 'Cotizacion', 'add_empty' => true)),
      'ca_tipo'           => new sfWidgetFormInput(),
      'ca_modalidad'      => new sfWidgetFormInput(),
      'ca_origen'         => new sfWidgetFormInput(),
      'ca_destino'        => new sfWidgetFormInput(),
      'ca_idconcepto'     => new sfWidgetFormPropelChoice(array('model' => 'Concepto', 'add_empty' => true)),
      'ca_idmoneda'       => new sfWidgetFormInput(),
      'ca_idequipo'       => new sfWidgetFormInput(),
      'ca_tarifa'         => new sfWidgetFormInput(),
      'ca_valor_tar'      => new sfWidgetFormInput(),
      'ca_valor_min'      => new sfWidgetFormInput(),
      'ca_frecuencia'     => new sfWidgetFormInput(),
      'ca_tiempotransito' => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idcontinuacion' => new sfValidatorPropelChoice(array('model' => 'CotContinuacion', 'column' => 'ca_idcontinuacion', 'required' => false)),
      'ca_idcotizacion'   => new sfValidatorPropelChoice(array('model' => 'Cotizacion', 'column' => 'ca_idcotizacion', 'required' => false)),
      'ca_tipo'           => new sfValidatorString(),
      'ca_modalidad'      => new sfValidatorString(array('required' => false)),
      'ca_origen'         => new sfValidatorString(array('required' => false)),
      'ca_destino'        => new sfValidatorString(array('required' => false)),
      'ca_idconcepto'     => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('required' => false)),
      'ca_idequipo'       => new sfValidatorInteger(array('required' => false)),
      'ca_tarifa'         => new sfValidatorString(array('required' => false)),
      'ca_valor_tar'      => new sfValidatorNumber(array('required' => false)),
      'ca_valor_min'      => new sfValidatorNumber(array('required' => false)),
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

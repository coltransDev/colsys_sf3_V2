<?php

/**
 * CotRecargo form base class.
 *
 * @package    form
 * @subpackage cot_recargo
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCotRecargoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcotrecargo'   => new sfWidgetFormInputHidden(),
      'ca_idcotizacion'   => new sfWidgetFormInput(),
      'ca_idproducto'     => new sfWidgetFormInput(),
      'ca_idopcion'       => new sfWidgetFormInput(),
      'ca_idconcepto'     => new sfWidgetFormDoctrineSelect(array('model' => 'Concepto', 'add_empty' => true)),
      'ca_idrecargo'      => new sfWidgetFormDoctrineSelect(array('model' => 'TipoRecargo', 'add_empty' => true)),
      'ca_modalidad'      => new sfWidgetFormInput(),
      'ca_valor_tar'      => new sfWidgetFormInput(),
      'ca_aplica_tar'     => new sfWidgetFormInput(),
      'ca_valor_min'      => new sfWidgetFormInput(),
      'ca_aplica_min'     => new sfWidgetFormInput(),
      'ca_idmoneda'       => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_consecutivo'    => new sfWidgetFormInput(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idcotrecargo'   => new sfValidatorDoctrineChoice(array('model' => 'CotRecargo', 'column' => 'ca_idcotrecargo', 'required' => false)),
      'ca_idcotizacion'   => new sfValidatorInteger(array('required' => false)),
      'ca_idproducto'     => new sfValidatorInteger(array('required' => false)),
      'ca_idopcion'       => new sfValidatorInteger(array('required' => false)),
      'ca_idconcepto'     => new sfValidatorDoctrineChoice(array('model' => 'Concepto', 'required' => false)),
      'ca_idrecargo'      => new sfValidatorDoctrineChoice(array('model' => 'TipoRecargo', 'required' => false)),
      'ca_modalidad'      => new sfValidatorString(array('required' => false)),
      'ca_valor_tar'      => new sfValidatorNumber(array('required' => false)),
      'ca_aplica_tar'     => new sfValidatorString(array('required' => false)),
      'ca_valor_min'      => new sfValidatorNumber(array('required' => false)),
      'ca_aplica_min'     => new sfValidatorString(array('required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_consecutivo'    => new sfValidatorInteger(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cot_recargo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CotRecargo';
  }

}
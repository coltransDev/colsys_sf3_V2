<?php

/**
 * CotRecargo form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseCotRecargoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcotizacion'   => new sfWidgetFormInputHidden(),
      'ca_idproducto'     => new sfWidgetFormInputHidden(),
      'ca_idopcion'       => new sfWidgetFormInputHidden(),
      'ca_idconcepto'     => new sfWidgetFormInputHidden(),
      'ca_idrecargo'      => new sfWidgetFormInputHidden(),
      'ca_tipo'           => new sfWidgetFormInput(),
      'ca_valor_tar'      => new sfWidgetFormInput(),
      'ca_aplica_tar'     => new sfWidgetFormInput(),
      'ca_valor_min'      => new sfWidgetFormInput(),
      'ca_aplica_min'     => new sfWidgetFormInput(),
      'ca_idmoneda'       => new sfWidgetFormInput(),
      'ca_modalidad'      => new sfWidgetFormInputHidden(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_consecutivo'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idcotizacion'   => new sfValidatorPropelChoice(array('model' => 'CotRecargo', 'column' => 'ca_idcotizacion', 'required' => false)),
      'ca_idproducto'     => new sfValidatorPropelChoice(array('model' => 'CotRecargo', 'column' => 'ca_idproducto', 'required' => false)),
      'ca_idopcion'       => new sfValidatorPropelChoice(array('model' => 'CotOpcion', 'column' => 'ca_idopcion', 'required' => false)),
      'ca_idconcepto'     => new sfValidatorPropelChoice(array('model' => 'CotRecargo', 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_idrecargo'      => new sfValidatorPropelChoice(array('model' => 'TipoRecargo', 'column' => 'ca_idrecargo', 'required' => false)),
      'ca_tipo'           => new sfValidatorString(array('required' => false)),
      'ca_valor_tar'      => new sfValidatorNumber(array('required' => false)),
      'ca_aplica_tar'     => new sfValidatorString(array('required' => false)),
      'ca_valor_min'      => new sfValidatorNumber(array('required' => false)),
      'ca_aplica_min'     => new sfValidatorString(array('required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('required' => false)),
      'ca_modalidad'      => new sfValidatorPropelChoice(array('model' => 'CotRecargo', 'column' => 'ca_modalidad', 'required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
      'ca_consecutivo'    => new sfValidatorInteger(array('required' => false)),
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

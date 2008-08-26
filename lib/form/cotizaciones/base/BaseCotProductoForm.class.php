<?php

/**
 * CotProducto form base class.
 *
 * @package    form
 * @subpackage cot_producto
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseCotProductoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcotizacion'   => new sfWidgetFormInputHidden(),
      'ca_idproducto'     => new sfWidgetFormInputHidden(),
      'ca_transporte'     => new sfWidgetFormInput(),
      'ca_modalidad'      => new sfWidgetFormInput(),
      'ca_origen'         => new sfWidgetFormInput(),
      'ca_destino'        => new sfWidgetFormInput(),
      'ca_impoexpo'       => new sfWidgetFormInput(),
      'ca_imprimir'       => new sfWidgetFormInput(),
      'ca_producto'       => new sfWidgetFormInput(),
      'ca_incoterms'      => new sfWidgetFormInput(),
      'ca_frecuencia'     => new sfWidgetFormInput(),
      'ca_tiempotransito' => new sfWidgetFormInput(),
      'ca_locrecargos'    => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_datosag'        => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idcotizacion'   => new sfValidatorPropelChoice(array('model' => 'Cotizacion', 'column' => 'ca_idcotizacion', 'required' => false)),
      'ca_idproducto'     => new sfValidatorPropelChoice(array('model' => 'CotProducto', 'column' => 'ca_idproducto', 'required' => false)),
      'ca_transporte'     => new sfValidatorString(array('required' => false)),
      'ca_modalidad'      => new sfValidatorString(array('required' => false)),
      'ca_origen'         => new sfValidatorString(array('required' => false)),
      'ca_destino'        => new sfValidatorString(array('required' => false)),
      'ca_impoexpo'       => new sfValidatorString(array('required' => false)),
      'ca_imprimir'       => new sfValidatorString(array('required' => false)),
      'ca_producto'       => new sfValidatorString(array('required' => false)),
      'ca_incoterms'      => new sfValidatorString(array('required' => false)),
      'ca_frecuencia'     => new sfValidatorString(array('required' => false)),
      'ca_tiempotransito' => new sfValidatorString(array('required' => false)),
      'ca_locrecargos'    => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
      'ca_datosag'        => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cot_producto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CotProducto';
  }


}

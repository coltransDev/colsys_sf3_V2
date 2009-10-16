<?php

/**
 * CotProducto form base class.
 *
 * @package    form
 * @subpackage cot_producto
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCotProductoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idproducto'     => new sfWidgetFormInputHidden(),
      'ca_idcotizacion'   => new sfWidgetFormDoctrineSelect(array('model' => 'Cotizacion', 'add_empty' => true)),
      'ca_transporte'     => new sfWidgetFormInput(),
      'ca_modalidad'      => new sfWidgetFormInput(),
      'ca_origen'         => new sfWidgetFormDoctrineSelect(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_destino'        => new sfWidgetFormDoctrineSelect(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_escala'         => new sfWidgetFormInput(),
      'ca_impoexpo'       => new sfWidgetFormInput(),
      'ca_imprimir'       => new sfWidgetFormInput(),
      'ca_producto'       => new sfWidgetFormInput(),
      'ca_incoterms'      => new sfWidgetFormInput(),
      'ca_frecuencia'     => new sfWidgetFormInput(),
      'ca_tiempotransito' => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_idlinea'        => new sfWidgetFormDoctrineSelect(array('model' => 'IdsProveedor', 'add_empty' => true)),
      'ca_postularlinea'  => new sfWidgetFormInputCheckbox(),
      'ca_etapa'          => new sfWidgetFormInput(),
      'ca_idtarea'        => new sfWidgetFormDoctrineSelect(array('model' => 'NotTarea', 'add_empty' => true)),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idproducto'     => new sfValidatorDoctrineChoice(array('model' => 'CotProducto', 'column' => 'ca_idproducto', 'required' => false)),
      'ca_idcotizacion'   => new sfValidatorDoctrineChoice(array('model' => 'Cotizacion', 'required' => false)),
      'ca_transporte'     => new sfValidatorString(array('required' => false)),
      'ca_modalidad'      => new sfValidatorString(array('required' => false)),
      'ca_origen'         => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'required' => false)),
      'ca_destino'        => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'required' => false)),
      'ca_escala'         => new sfValidatorString(array('required' => false)),
      'ca_impoexpo'       => new sfValidatorString(array('required' => false)),
      'ca_imprimir'       => new sfValidatorString(array('required' => false)),
      'ca_producto'       => new sfValidatorString(array('required' => false)),
      'ca_incoterms'      => new sfValidatorString(array('required' => false)),
      'ca_frecuencia'     => new sfValidatorString(array('required' => false)),
      'ca_tiempotransito' => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_idlinea'        => new sfValidatorDoctrineChoice(array('model' => 'IdsProveedor', 'required' => false)),
      'ca_postularlinea'  => new sfValidatorBoolean(array('required' => false)),
      'ca_etapa'          => new sfValidatorString(array('required' => false)),
      'ca_idtarea'        => new sfValidatorDoctrineChoice(array('model' => 'NotTarea', 'required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
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
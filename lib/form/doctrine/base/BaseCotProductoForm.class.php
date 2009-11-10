<?php

/**
 * CotProducto form base class.
 *
 * @method CotProducto getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseCotProductoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idproducto'     => new sfWidgetFormInputHidden(),
      'ca_idcotizacion'   => new sfWidgetFormDoctrineChoice(array('model' => 'Cotizacion', 'add_empty' => true)),
      'ca_transporte'     => new sfWidgetFormTextarea(),
      'ca_modalidad'      => new sfWidgetFormTextarea(),
      'ca_origen'         => new sfWidgetFormDoctrineChoice(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_destino'        => new sfWidgetFormDoctrineChoice(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_escala'         => new sfWidgetFormTextarea(),
      'ca_impoexpo'       => new sfWidgetFormTextarea(),
      'ca_imprimir'       => new sfWidgetFormTextarea(),
      'ca_producto'       => new sfWidgetFormTextarea(),
      'ca_incoterms'      => new sfWidgetFormTextarea(),
      'ca_frecuencia'     => new sfWidgetFormTextarea(),
      'ca_tiempotransito' => new sfWidgetFormTextarea(),
      'ca_observaciones'  => new sfWidgetFormTextarea(),
      'ca_idlinea'        => new sfWidgetFormDoctrineChoice(array('model' => 'IdsProveedor', 'add_empty' => true)),
      'ca_postularlinea'  => new sfWidgetFormInputCheckbox(),
      'ca_etapa'          => new sfWidgetFormTextarea(),
      'ca_idtarea'        => new sfWidgetFormDoctrineChoice(array('model' => 'NotTarea', 'add_empty' => true)),
      'ca_vigencia'       => new sfWidgetFormDate(),
      'ca_usucreado'      => new sfWidgetFormInputText(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInputText(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idproducto'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idproducto', 'required' => false)),
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
      'ca_vigencia'       => new sfValidatorDate(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cot_producto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CotProducto';
  }

}

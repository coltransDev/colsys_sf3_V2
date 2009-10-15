<?php

/**
 * CotProducto form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseCotProductoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idproducto'     => new sfWidgetFormInputHidden(),
      'ca_idcotizacion'   => new sfWidgetFormInputHidden(),
      'ca_transporte'     => new sfWidgetFormInput(),
      'ca_modalidad'      => new sfWidgetFormInput(),
      'ca_origen'         => new sfWidgetFormInput(),
      'ca_destino'        => new sfWidgetFormInput(),
      'ca_escala'         => new sfWidgetFormInput(),
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
      'ca_idlinea'        => new sfWidgetFormPropelChoice(array('model' => 'Transportador', 'add_empty' => true)),
      'ca_postularlinea'  => new sfWidgetFormInputCheckbox(),
      'ca_etapa'          => new sfWidgetFormInput(),
      'ca_idtarea'        => new sfWidgetFormPropelChoice(array('model' => 'NotTarea', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'ca_idproducto'     => new sfValidatorPropelChoice(array('model' => 'CotProducto', 'column' => 'ca_idproducto', 'required' => false)),
      'ca_idcotizacion'   => new sfValidatorPropelChoice(array('model' => 'Cotizacion', 'column' => 'ca_idcotizacion', 'required' => false)),
      'ca_transporte'     => new sfValidatorString(array('required' => false)),
      'ca_modalidad'      => new sfValidatorString(array('required' => false)),
      'ca_origen'         => new sfValidatorString(array('required' => false)),
      'ca_destino'        => new sfValidatorString(array('required' => false)),
      'ca_escala'         => new sfValidatorString(array('required' => false)),
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
      'ca_idlinea'        => new sfValidatorPropelChoice(array('model' => 'Transportador', 'column' => 'ca_idlinea', 'required' => false)),
      'ca_postularlinea'  => new sfValidatorBoolean(array('required' => false)),
      'ca_etapa'          => new sfValidatorString(array('required' => false)),
      'ca_idtarea'        => new sfValidatorPropelChoice(array('model' => 'NotTarea', 'column' => 'ca_idtarea', 'required' => false)),
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

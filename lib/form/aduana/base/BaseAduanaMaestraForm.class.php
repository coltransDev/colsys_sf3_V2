<?php

/**
 * AduanaMaestra form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseAduanaMaestraForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_fchreferencia'  => new sfWidgetFormDate(),
      'ca_referencia'     => new sfWidgetFormInputHidden(),
      'ca_origen'         => new sfWidgetFormInput(),
      'ca_destino'        => new sfWidgetFormInput(),
      'ca_idcliente'      => new sfWidgetFormPropelChoice(array('model' => 'Cliente', 'add_empty' => true)),
      'ca_vendedor'       => new sfWidgetFormInput(),
      'ca_coordinador'    => new sfWidgetFormInput(),
      'ca_proveedor'      => new sfWidgetFormInput(),
      'ca_pedido'         => new sfWidgetFormInput(),
      'ca_piezas'         => new sfWidgetFormInput(),
      'ca_peso'           => new sfWidgetFormInput(),
      'ca_mercancia'      => new sfWidgetFormInput(),
      'ca_deposito'       => new sfWidgetFormInput(),
      'ca_fcharribo'      => new sfWidgetFormDate(),
      'ca_modalidad'      => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDate(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDate(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_fchliquidado'   => new sfWidgetFormDate(),
      'ca_usuliquidado'   => new sfWidgetFormInput(),
      'ca_fchcerrado'     => new sfWidgetFormDate(),
      'ca_usucerrado'     => new sfWidgetFormInput(),
      'ca_nombrecontacto' => new sfWidgetFormInput(),
      'ca_email'          => new sfWidgetFormInput(),
      'ca_analista'       => new sfWidgetFormInput(),
      'ca_trackingcode'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_fchreferencia'  => new sfValidatorDate(),
      'ca_referencia'     => new sfValidatorPropelChoice(array('model' => 'AduanaMaestra', 'column' => 'ca_referencia', 'required' => false)),
      'ca_origen'         => new sfValidatorString(array('required' => false)),
      'ca_destino'        => new sfValidatorString(array('required' => false)),
      'ca_idcliente'      => new sfValidatorPropelChoice(array('model' => 'Cliente', 'column' => 'ca_idcliente', 'required' => false)),
      'ca_vendedor'       => new sfValidatorString(array('required' => false)),
      'ca_coordinador'    => new sfValidatorString(array('required' => false)),
      'ca_proveedor'      => new sfValidatorString(array('required' => false)),
      'ca_pedido'         => new sfValidatorString(array('required' => false)),
      'ca_piezas'         => new sfValidatorInteger(array('required' => false)),
      'ca_peso'           => new sfValidatorNumber(array('required' => false)),
      'ca_mercancia'      => new sfValidatorString(array('required' => false)),
      'ca_deposito'       => new sfValidatorString(array('required' => false)),
      'ca_fcharribo'      => new sfValidatorDate(array('required' => false)),
      'ca_modalidad'      => new sfValidatorInteger(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDate(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDate(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
      'ca_fchliquidado'   => new sfValidatorDate(array('required' => false)),
      'ca_usuliquidado'   => new sfValidatorString(array('required' => false)),
      'ca_fchcerrado'     => new sfValidatorDate(array('required' => false)),
      'ca_usucerrado'     => new sfValidatorString(array('required' => false)),
      'ca_nombrecontacto' => new sfValidatorString(array('required' => false)),
      'ca_email'          => new sfValidatorString(array('required' => false)),
      'ca_analista'       => new sfValidatorString(array('required' => false)),
      'ca_trackingcode'   => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('aduana_maestra[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AduanaMaestra';
  }


}

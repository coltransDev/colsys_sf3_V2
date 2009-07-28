<?php

/**
 * FalaDetail form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseFalaDetailForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_iddoc'                   => new sfWidgetFormInputHidden(),
      'ca_sku'                     => new sfWidgetFormInputHidden(),
      'ca_vpn'                     => new sfWidgetFormInput(),
      'ca_num_cont_part1'          => new sfWidgetFormInput(),
      'ca_num_cont_part2'          => new sfWidgetFormInput(),
      'ca_num_cont_sell'           => new sfWidgetFormInput(),
      'ca_container_iso'           => new sfWidgetFormInput(),
      'ca_cantidad_pedido'         => new sfWidgetFormInput(),
      'ca_cantidad_miles'          => new sfWidgetFormInput(),
      'ca_unidad_medidad_cantidad' => new sfWidgetFormInput(),
      'ca_descripcion_item'        => new sfWidgetFormInput(),
      'ca_cantidad_paquetes_miles' => new sfWidgetFormInput(),
      'ca_unidad_medida_paquetes'  => new sfWidgetFormInput(),
      'ca_cantidad_volumen_miles'  => new sfWidgetFormInput(),
      'ca_unidad_medida_volumen'   => new sfWidgetFormInput(),
      'ca_cantidad_peso_miles'     => new sfWidgetFormInput(),
      'ca_unidad_medida_peso'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_iddoc'                   => new sfValidatorPropelChoice(array('model' => 'FalaHeader', 'column' => 'ca_iddoc', 'required' => false)),
      'ca_sku'                     => new sfValidatorPropelChoice(array('model' => 'FalaDetail', 'column' => 'ca_sku', 'required' => false)),
      'ca_vpn'                     => new sfValidatorString(array('required' => false)),
      'ca_num_cont_part1'          => new sfValidatorString(array('required' => false)),
      'ca_num_cont_part2'          => new sfValidatorString(array('required' => false)),
      'ca_num_cont_sell'           => new sfValidatorString(array('required' => false)),
      'ca_container_iso'           => new sfValidatorString(array('required' => false)),
      'ca_cantidad_pedido'         => new sfValidatorInteger(array('required' => false)),
      'ca_cantidad_miles'          => new sfValidatorInteger(array('required' => false)),
      'ca_unidad_medidad_cantidad' => new sfValidatorString(array('required' => false)),
      'ca_descripcion_item'        => new sfValidatorString(array('required' => false)),
      'ca_cantidad_paquetes_miles' => new sfValidatorNumber(array('required' => false)),
      'ca_unidad_medida_paquetes'  => new sfValidatorString(array('required' => false)),
      'ca_cantidad_volumen_miles'  => new sfValidatorNumber(array('required' => false)),
      'ca_unidad_medida_volumen'   => new sfValidatorString(array('required' => false)),
      'ca_cantidad_peso_miles'     => new sfValidatorNumber(array('required' => false)),
      'ca_unidad_medida_peso'      => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fala_detail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FalaDetail';
  }


}

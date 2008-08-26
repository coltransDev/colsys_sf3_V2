<?php

/**
 * InoIngresosAir form base class.
 *
 * @package    form
 * @subpackage ino_ingresos_air
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseInoIngresosAirForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_referencia' => new sfWidgetFormInputHidden(),
      'ca_idcliente'  => new sfWidgetFormInputHidden(),
      'ca_hawb'       => new sfWidgetFormInputHidden(),
      'ca_factura'    => new sfWidgetFormInputHidden(),
      'ca_fchfactura' => new sfWidgetFormDate(),
      'ca_valor'      => new sfWidgetFormInput(),
      'ca_reccaja'    => new sfWidgetFormInput(),
      'ca_fchpago'    => new sfWidgetFormDate(),
      'ca_tcalaico'   => new sfWidgetFormInput(),
      'ca_fchcreado'  => new sfWidgetFormDateTime(),
      'ca_usucreado'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_referencia' => new sfValidatorPropelChoice(array('model' => 'InoMaestraAir', 'column' => 'ca_referencia', 'required' => false)),
      'ca_idcliente'  => new sfValidatorPropelChoice(array('model' => 'Cliente', 'column' => 'ca_idcliente', 'required' => false)),
      'ca_hawb'       => new sfValidatorPropelChoice(array('model' => 'InoIngresosAir', 'column' => 'ca_hawb', 'required' => false)),
      'ca_factura'    => new sfValidatorPropelChoice(array('model' => 'InoIngresosAir', 'column' => 'ca_factura', 'required' => false)),
      'ca_fchfactura' => new sfValidatorDate(array('required' => false)),
      'ca_valor'      => new sfValidatorNumber(array('required' => false)),
      'ca_reccaja'    => new sfValidatorString(array('required' => false)),
      'ca_fchpago'    => new sfValidatorDate(array('required' => false)),
      'ca_tcalaico'   => new sfValidatorNumber(array('required' => false)),
      'ca_fchcreado'  => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'  => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_ingresos_air[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoIngresosAir';
  }


}

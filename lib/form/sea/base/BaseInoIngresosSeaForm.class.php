<?php

/**
 * InoIngresosSea form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseInoIngresosSeaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_referencia'     => new sfWidgetFormInputHidden(),
      'ca_idcliente'      => new sfWidgetFormInputHidden(),
      'ca_hbls'           => new sfWidgetFormInputHidden(),
      'ca_factura'        => new sfWidgetFormInputHidden(),
      'ca_fchfactura'     => new sfWidgetFormDate(),
      'ca_valor'          => new sfWidgetFormInput(),
      'ca_reccaja'        => new sfWidgetFormInput(),
      'ca_fchpago'        => new sfWidgetFormDate(),
      'ca_tcambio'        => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_referencia'     => new sfValidatorPropelChoice(array('model' => 'InoMaestraSea', 'column' => 'ca_referencia', 'required' => false)),
      'ca_idcliente'      => new sfValidatorPropelChoice(array('model' => 'Cliente', 'column' => 'ca_idcliente', 'required' => false)),
      'ca_hbls'           => new sfValidatorPropelChoice(array('model' => 'InoIngresosSea', 'column' => 'ca_hbls', 'required' => false)),
      'ca_factura'        => new sfValidatorPropelChoice(array('model' => 'InoIngresosSea', 'column' => 'ca_factura', 'required' => false)),
      'ca_fchfactura'     => new sfValidatorDate(array('required' => false)),
      'ca_valor'          => new sfValidatorNumber(array('required' => false)),
      'ca_reccaja'        => new sfValidatorString(array('required' => false)),
      'ca_fchpago'        => new sfValidatorDate(array('required' => false)),
      'ca_tcambio'        => new sfValidatorNumber(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_ingresos_sea[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoIngresosSea';
  }


}

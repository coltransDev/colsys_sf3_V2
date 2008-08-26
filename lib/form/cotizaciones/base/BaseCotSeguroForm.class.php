<?php

/**
 * CotSeguro form base class.
 *
 * @package    form
 * @subpackage cot_seguro
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseCotSeguroForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcotizacion'   => new sfWidgetFormInputHidden(),
      'ca_idmoneda'       => new sfWidgetFormPropelSelect(array('model' => 'Moneda', 'add_empty' => false)),
      'ca_prima'          => new sfWidgetFormInput(),
      'ca_obtencion'      => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idcotizacion'   => new sfValidatorPropelChoice(array('model' => 'Cotizacion', 'column' => 'ca_idcotizacion', 'required' => false)),
      'ca_idmoneda'       => new sfValidatorPropelChoice(array('model' => 'Moneda', 'column' => 'ca_idmoneda')),
      'ca_prima'          => new sfValidatorString(array('required' => false)),
      'ca_obtencion'      => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cot_seguro[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CotSeguro';
  }


}

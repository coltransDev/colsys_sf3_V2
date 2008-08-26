<?php

/**
 * PricRecargoxConcepto form base class.
 *
 * @package    form
 * @subpackage pric_recargox_concepto
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BasePricRecargoxConceptoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrayecto' => new sfWidgetFormInputHidden(),
      'ca_idconcepto' => new sfWidgetFormInputHidden(),
      'ca_idrecargo'  => new sfWidgetFormInputHidden(),
      'ca_vlrrecargo' => new sfWidgetFormInput(),
      'ca_vlrminimo'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idtrayecto' => new sfValidatorPropelChoice(array('model' => 'Trayecto', 'column' => 'ca_idtrayecto', 'required' => false)),
      'ca_idconcepto' => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_idrecargo'  => new sfValidatorPropelChoice(array('model' => 'PricRecargoxConcepto', 'column' => 'ca_idrecargo', 'required' => false)),
      'ca_vlrrecargo' => new sfValidatorNumber(),
      'ca_vlrminimo'  => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_recargox_concepto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricRecargoxConcepto';
  }


}

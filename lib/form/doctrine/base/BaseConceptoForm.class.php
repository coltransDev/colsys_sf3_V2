<?php

/**
 * Concepto form base class.
 *
 * @package    form
 * @subpackage concepto
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseConceptoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idconcepto'  => new sfWidgetFormInputHidden(),
      'ca_concepto'    => new sfWidgetFormInput(),
      'ca_unidad'      => new sfWidgetFormInput(),
      'ca_transporte'  => new sfWidgetFormInput(),
      'ca_modalidad'   => new sfWidgetFormInput(),
      'ca_liminferior' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idconcepto'  => new sfValidatorDoctrineChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_concepto'    => new sfValidatorString(array('required' => false)),
      'ca_unidad'      => new sfValidatorString(array('required' => false)),
      'ca_transporte'  => new sfValidatorString(array('required' => false)),
      'ca_modalidad'   => new sfValidatorString(array('required' => false)),
      'ca_liminferior' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('concepto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Concepto';
  }

}
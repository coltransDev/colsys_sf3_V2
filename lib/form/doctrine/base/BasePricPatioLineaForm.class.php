<?php

/**
 * PricPatioLinea form base class.
 *
 * @package    form
 * @subpackage pric_patio_linea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePricPatioLineaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idpatio'       => new sfWidgetFormInputHidden(),
      'ca_idlinea'       => new sfWidgetFormInputHidden(),
      'ca_transporte'    => new sfWidgetFormInputHidden(),
      'ca_modalidad'     => new sfWidgetFormInputHidden(),
      'ca_impoexpo'      => new sfWidgetFormInputHidden(),
      'ca_observaciones' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idpatio'       => new sfValidatorDoctrineChoice(array('model' => 'PricPatioLinea', 'column' => 'ca_idpatio', 'required' => false)),
      'ca_idlinea'       => new sfValidatorDoctrineChoice(array('model' => 'PricPatioLinea', 'column' => 'ca_idlinea', 'required' => false)),
      'ca_transporte'    => new sfValidatorDoctrineChoice(array('model' => 'PricPatioLinea', 'column' => 'ca_transporte', 'required' => false)),
      'ca_modalidad'     => new sfValidatorDoctrineChoice(array('model' => 'PricPatioLinea', 'column' => 'ca_modalidad', 'required' => false)),
      'ca_impoexpo'      => new sfValidatorDoctrineChoice(array('model' => 'PricPatioLinea', 'column' => 'ca_impoexpo', 'required' => false)),
      'ca_observaciones' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_patio_linea[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricPatioLinea';
  }

}
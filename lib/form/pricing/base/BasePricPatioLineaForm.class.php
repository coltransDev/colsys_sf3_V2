<?php

/**
 * PricPatioLinea form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePricPatioLineaForm extends BaseFormPropel
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
      'ca_idpatio'       => new sfValidatorPropelChoice(array('model' => 'PricPatio', 'column' => 'ca_idpatio', 'required' => false)),
      'ca_idlinea'       => new sfValidatorPropelChoice(array('model' => 'Transportador', 'column' => 'ca_idlinea', 'required' => false)),
      'ca_transporte'    => new sfValidatorPropelChoice(array('model' => 'PricPatioLinea', 'column' => 'ca_transporte', 'required' => false)),
      'ca_modalidad'     => new sfValidatorPropelChoice(array('model' => 'PricPatioLinea', 'column' => 'ca_modalidad', 'required' => false)),
      'ca_impoexpo'      => new sfValidatorPropelChoice(array('model' => 'PricPatioLinea', 'column' => 'ca_impoexpo', 'required' => false)),
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

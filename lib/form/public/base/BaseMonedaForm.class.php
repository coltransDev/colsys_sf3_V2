<?php

/**
 * Moneda form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseMonedaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idmoneda'   => new sfWidgetFormInputHidden(),
      'ca_nombre'     => new sfWidgetFormInput(),
      'ca_referencia' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idmoneda'   => new sfValidatorPropelChoice(array('model' => 'Moneda', 'column' => 'ca_idmoneda', 'required' => false)),
      'ca_nombre'     => new sfValidatorString(array('required' => false)),
      'ca_referencia' => new sfValidatorString(array('max_length' => 3, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('moneda[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Moneda';
  }


}

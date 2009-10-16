<?php

/**
 * Moneda form base class.
 *
 * @package    form
 * @subpackage moneda
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseMonedaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idmoneda'   => new sfWidgetFormInputHidden(),
      'ca_nombre'     => new sfWidgetFormInput(),
      'ca_referencia' => new sfWidgetFormDoctrineSelect(array('model' => 'Moneda', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'ca_idmoneda'   => new sfValidatorDoctrineChoice(array('model' => 'Moneda', 'column' => 'ca_idmoneda', 'required' => false)),
      'ca_nombre'     => new sfValidatorString(array('max_length' => 30)),
      'ca_referencia' => new sfValidatorDoctrineChoice(array('model' => 'Moneda')),
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
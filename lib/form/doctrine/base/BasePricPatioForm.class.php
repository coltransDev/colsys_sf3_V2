<?php

/**
 * PricPatio form base class.
 *
 * @package    form
 * @subpackage pric_patio
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePricPatioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idpatio'   => new sfWidgetFormInputHidden(),
      'ca_nombre'    => new sfWidgetFormInput(),
      'ca_idciudad'  => new sfWidgetFormDoctrineSelect(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_direccion' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idpatio'   => new sfValidatorDoctrineChoice(array('model' => 'PricPatio', 'column' => 'ca_idpatio', 'required' => false)),
      'ca_nombre'    => new sfValidatorString(array('required' => false)),
      'ca_idciudad'  => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'required' => false)),
      'ca_direccion' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_patio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricPatio';
  }

}
<?php

/**
 * PricPatio form base class.
 *
 * @method PricPatio getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BasePricPatioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idpatio'   => new sfWidgetFormInputHidden(),
      'ca_nombre'    => new sfWidgetFormTextarea(),
      'ca_idciudad'  => new sfWidgetFormDoctrineChoice(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_direccion' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idpatio'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idpatio', 'required' => false)),
      'ca_nombre'    => new sfValidatorString(array('required' => false)),
      'ca_idciudad'  => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'required' => false)),
      'ca_direccion' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_patio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricPatio';
  }

}

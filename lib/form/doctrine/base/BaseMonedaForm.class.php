<?php

/**
 * Moneda form base class.
 *
 * @method Moneda getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseMonedaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idmoneda'   => new sfWidgetFormInputHidden(),
      'ca_nombre'     => new sfWidgetFormInputText(),
      'ca_referencia' => new sfWidgetFormDoctrineChoice(array('model' => 'Moneda', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'ca_idmoneda'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idmoneda', 'required' => false)),
      'ca_nombre'     => new sfValidatorString(array('max_length' => 30)),
      'ca_referencia' => new sfValidatorDoctrineChoice(array('model' => 'Moneda')),
    ));

    $this->widgetSchema->setNameFormat('moneda[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Moneda';
  }

}

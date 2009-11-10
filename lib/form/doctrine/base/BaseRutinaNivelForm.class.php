<?php

/**
 * RutinaNivel form base class.
 *
 * @method RutinaNivel getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseRutinaNivelForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_rutina' => new sfWidgetFormInputHidden(),
      'ca_nivel'  => new sfWidgetFormInputHidden(),
      'ca_valor'  => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_rutina' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_rutina', 'required' => false)),
      'ca_nivel'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_nivel', 'required' => false)),
      'ca_valor'  => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rutina_nivel[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RutinaNivel';
  }

}

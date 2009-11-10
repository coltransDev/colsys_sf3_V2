<?php

/**
 * Ciudad form base class.
 *
 * @method Ciudad getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseCiudadForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idciudad'  => new sfWidgetFormInputHidden(),
      'ca_ciudad'    => new sfWidgetFormInputText(),
      'ca_idtrafico' => new sfWidgetFormDoctrineChoice(array('model' => 'Trafico', 'add_empty' => false)),
      'ca_puerto'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_idciudad'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idciudad', 'required' => false)),
      'ca_ciudad'    => new sfValidatorString(array('max_length' => 50)),
      'ca_idtrafico' => new sfValidatorDoctrineChoice(array('model' => 'Trafico')),
      'ca_puerto'    => new sfValidatorString(array('max_length' => 10)),
    ));

    $this->widgetSchema->setNameFormat('ciudad[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ciudad';
  }

}

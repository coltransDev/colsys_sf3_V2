<?php

/**
 * Ciudad form base class.
 *
 * @package    form
 * @subpackage ciudad
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseCiudadForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idciudad'  => new sfWidgetFormInputHidden(),
      'ca_ciudad'    => new sfWidgetFormInput(),
      'ca_idtrafico' => new sfWidgetFormPropelSelect(array('model' => 'Trafico', 'add_empty' => true)),
      'ca_puerto'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idciudad'  => new sfValidatorPropelChoice(array('model' => 'Ciudad', 'column' => 'ca_idciudad', 'required' => false)),
      'ca_ciudad'    => new sfValidatorString(array('required' => false)),
      'ca_idtrafico' => new sfValidatorPropelChoice(array('model' => 'Trafico', 'column' => 'ca_idtrafico', 'required' => false)),
      'ca_puerto'    => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ciudad[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ciudad';
  }


}

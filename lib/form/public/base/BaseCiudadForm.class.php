<?php

/**
 * Ciudad form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseCiudadForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idciudad'  => new sfWidgetFormInputHidden(),
      'ca_ciudad'    => new sfWidgetFormInput(),
      'ca_idtrafico' => new sfWidgetFormPropelChoice(array('model' => 'Trafico', 'add_empty' => true)),
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

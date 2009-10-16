<?php

/**
 * Ciudad form base class.
 *
 * @package    form
 * @subpackage ciudad
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCiudadForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idciudad'  => new sfWidgetFormInputHidden(),
      'ca_ciudad'    => new sfWidgetFormInput(),
      'ca_idtrafico' => new sfWidgetFormDoctrineSelect(array('model' => 'Trafico', 'add_empty' => false)),
      'ca_puerto'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idciudad'  => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'column' => 'ca_idciudad', 'required' => false)),
      'ca_ciudad'    => new sfValidatorString(array('max_length' => 50)),
      'ca_idtrafico' => new sfValidatorDoctrineChoice(array('model' => 'Trafico')),
      'ca_puerto'    => new sfValidatorString(array('max_length' => 10)),
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
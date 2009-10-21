<?php

/**
 * InoMaestraAir form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseInoMaestraAirForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_referencia' => new sfWidgetFormInputHidden(),
      'ca_idlinea'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_referencia' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_referencia', 'required' => false)),
      'ca_idlinea'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_maestra_air[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoMaestraAir';
  }

}

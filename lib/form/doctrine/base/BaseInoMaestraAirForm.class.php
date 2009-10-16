<?php

/**
 * InoMaestraAir form base class.
 *
 * @package    form
 * @subpackage ino_maestra_air
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseInoMaestraAirForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_referencia' => new sfWidgetFormInputHidden(),
      'ca_idlinea'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_referencia' => new sfValidatorDoctrineChoice(array('model' => 'InoMaestraAir', 'column' => 'ca_referencia', 'required' => false)),
      'ca_idlinea'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_maestra_air[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoMaestraAir';
  }

}
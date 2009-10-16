<?php

/**
 * RutinaNivel form base class.
 *
 * @package    form
 * @subpackage rutina_nivel
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseRutinaNivelForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_rutina' => new sfWidgetFormInputHidden(),
      'ca_nivel'  => new sfWidgetFormInputHidden(),
      'ca_valor'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_rutina' => new sfValidatorDoctrineChoice(array('model' => 'RutinaNivel', 'column' => 'ca_rutina', 'required' => false)),
      'ca_nivel'  => new sfValidatorDoctrineChoice(array('model' => 'RutinaNivel', 'column' => 'ca_nivel', 'required' => false)),
      'ca_valor'  => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rutina_nivel[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RutinaNivel';
  }

}
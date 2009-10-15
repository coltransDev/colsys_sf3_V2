<?php

/**
 * RutinaNivel form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseRutinaNivelForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_rutina' => new sfWidgetFormInputHidden(),
      'ca_nivel'  => new sfWidgetFormInputHidden(),
      'ca_valor'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_rutina' => new sfValidatorPropelChoice(array('model' => 'Rutina', 'column' => 'ca_rutina', 'required' => false)),
      'ca_nivel'  => new sfValidatorPropelChoice(array('model' => 'RutinaNivel', 'column' => 'ca_nivel', 'required' => false)),
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

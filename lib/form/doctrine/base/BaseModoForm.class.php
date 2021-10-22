<?php

/**
 * Modo form base class.
 *
 * @method Modo getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseModoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idmodo'     => new sfWidgetFormInputHidden(),
      'ca_modulo'     => new sfWidgetFormTextarea(),
      'ca_impoexpo'   => new sfWidgetFormTextarea(),
      'ca_transporte' => new sfWidgetFormTextarea(),
      'ca_rutina'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_idmodo'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idmodo', 'required' => false)),
      'ca_modulo'     => new sfValidatorString(array('required' => false)),
      'ca_impoexpo'   => new sfValidatorString(array('required' => false)),
      'ca_transporte' => new sfValidatorString(array('required' => false)),
      'ca_rutina'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('modo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Modo';
  }

}

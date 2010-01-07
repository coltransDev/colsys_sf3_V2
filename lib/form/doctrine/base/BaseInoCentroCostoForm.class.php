<?php

/**
 * InoCentroCosto form base class.
 *
 * @method InoCentroCosto getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInoCentroCostoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idccosto'  => new sfWidgetFormInputHidden(),
      'ca_centro'    => new sfWidgetFormInputText(),
      'ca_subcentro' => new sfWidgetFormInputText(),
      'ca_nombre'    => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idccosto'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idccosto', 'required' => false)),
      'ca_centro'    => new sfValidatorInteger(),
      'ca_subcentro' => new sfValidatorInteger(array('required' => false)),
      'ca_nombre'    => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('ino_centro_costo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoCentroCosto';
  }

}

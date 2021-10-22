<?php

/**
 * InoViCosto form base class.
 *
 * @method InoViCosto getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInoViCostoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idmaster'   => new sfWidgetFormInputHidden(),
      'ca_referencia' => new sfWidgetFormTextarea(),
      'ca_valor'      => new sfWidgetFormInputText(),
      'ca_venta'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_idmaster'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idmaster', 'required' => false)),
      'ca_referencia' => new sfValidatorString(array('required' => false)),
      'ca_valor'      => new sfValidatorNumber(array('required' => false)),
      'ca_venta'      => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_vi_costo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoViCosto';
  }

}

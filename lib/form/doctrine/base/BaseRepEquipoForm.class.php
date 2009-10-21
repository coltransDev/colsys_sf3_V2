<?php

/**
 * RepEquipo form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseRepEquipoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte'     => new sfWidgetFormInputHidden(),
      'ca_idconcepto'    => new sfWidgetFormInputHidden(),
      'ca_cantidad'      => new sfWidgetFormInputText(),
      'ca_idequipo'      => new sfWidgetFormTextarea(),
      'ca_observaciones' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idreporte'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idreporte', 'required' => false)),
      'ca_idconcepto'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_cantidad'      => new sfValidatorNumber(array('required' => false)),
      'ca_idequipo'      => new sfValidatorString(array('required' => false)),
      'ca_observaciones' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_equipo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepEquipo';
  }

}

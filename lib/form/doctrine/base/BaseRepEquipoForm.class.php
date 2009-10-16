<?php

/**
 * RepEquipo form base class.
 *
 * @package    form
 * @subpackage rep_equipo
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseRepEquipoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte'     => new sfWidgetFormInputHidden(),
      'ca_idconcepto'    => new sfWidgetFormInputHidden(),
      'ca_cantidad'      => new sfWidgetFormInput(),
      'ca_idequipo'      => new sfWidgetFormInput(),
      'ca_observaciones' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idreporte'     => new sfValidatorDoctrineChoice(array('model' => 'RepEquipo', 'column' => 'ca_idreporte', 'required' => false)),
      'ca_idconcepto'    => new sfValidatorDoctrineChoice(array('model' => 'RepEquipo', 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_cantidad'      => new sfValidatorNumber(array('required' => false)),
      'ca_idequipo'      => new sfValidatorString(array('required' => false)),
      'ca_observaciones' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_equipo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepEquipo';
  }

}
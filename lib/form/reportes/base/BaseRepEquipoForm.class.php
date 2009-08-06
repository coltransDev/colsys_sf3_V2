<?php

/**
 * RepEquipo form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseRepEquipoForm extends BaseFormPropel
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
      'ca_idreporte'     => new sfValidatorPropelChoice(array('model' => 'Reporte', 'column' => 'ca_idreporte', 'required' => false)),
      'ca_idconcepto'    => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_cantidad'      => new sfValidatorNumber(array('required' => false)),
      'ca_idequipo'      => new sfValidatorString(array('max_length' => 12, 'required' => false)),
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

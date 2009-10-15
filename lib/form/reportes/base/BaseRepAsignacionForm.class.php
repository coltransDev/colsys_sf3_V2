<?php

/**
 * RepAsignacion form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseRepAsignacionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte' => new sfWidgetFormInputHidden(),
      'ca_idtarea'   => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_idreporte' => new sfValidatorPropelChoice(array('model' => 'Reporte', 'column' => 'ca_idreporte', 'required' => false)),
      'ca_idtarea'   => new sfValidatorPropelChoice(array('model' => 'NotTarea', 'column' => 'ca_idtarea', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_asignacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepAsignacion';
  }


}

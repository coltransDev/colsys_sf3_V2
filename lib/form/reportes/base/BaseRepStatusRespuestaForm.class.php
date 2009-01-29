<?php

/**
 * RepStatusRespuesta form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRepStatusRespuestaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte'             => new sfWidgetFormPropelChoice(array('model' => 'RepStatus', 'add_empty' => false)),
      'ca_idemail'               => new sfWidgetFormPropelChoice(array('model' => 'RepStatus', 'add_empty' => false)),
      'ca_idrepstatusrespuestas' => new sfWidgetFormInputHidden(),
      'ca_respuesta'             => new sfWidgetFormInput(),
      'ca_email'                 => new sfWidgetFormInput(),
      'ca_fchcreado'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idreporte'             => new sfValidatorPropelChoice(array('model' => 'RepStatus', 'column' => 'ca_idreporte')),
      'ca_idemail'               => new sfValidatorPropelChoice(array('model' => 'RepStatus', 'column' => 'ca_idreporte')),
      'ca_idrepstatusrespuestas' => new sfValidatorPropelChoice(array('model' => 'RepStatusRespuesta', 'column' => 'ca_idrepstatusrespuestas', 'required' => false)),
      'ca_respuesta'             => new sfValidatorString(array('required' => false)),
      'ca_email'                 => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'             => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_status_respuesta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepStatusRespuesta';
  }


}

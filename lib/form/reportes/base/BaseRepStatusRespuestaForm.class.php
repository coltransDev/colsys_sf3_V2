<?php

/**
 * RepStatusRespuesta form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseRepStatusRespuestaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idrepstatusrespuestas' => new sfWidgetFormInputHidden(),
      'ca_idstatus'              => new sfWidgetFormPropelChoice(array('model' => 'RepStatus', 'add_empty' => false)),
      'ca_respuesta'             => new sfWidgetFormInput(),
      'ca_email'                 => new sfWidgetFormInput(),
      'ca_login'                 => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_fchcreado'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idrepstatusrespuestas' => new sfValidatorPropelChoice(array('model' => 'RepStatusRespuesta', 'column' => 'ca_idrepstatusrespuestas', 'required' => false)),
      'ca_idstatus'              => new sfValidatorPropelChoice(array('model' => 'RepStatus', 'column' => 'ca_idstatus')),
      'ca_respuesta'             => new sfValidatorString(array('required' => false)),
      'ca_email'                 => new sfValidatorString(array('required' => false)),
      'ca_login'                 => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'ca_login', 'required' => false)),
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

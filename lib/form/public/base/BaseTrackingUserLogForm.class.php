<?php

/**
 * TrackingUserLog form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseTrackingUserLogForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_id'        => new sfWidgetFormInputHidden(),
      'ca_email'     => new sfWidgetFormPropelChoice(array('model' => 'TrackingUser', 'add_empty' => true)),
      'ca_fchevento' => new sfWidgetFormDateTime(),
      'ca_url'       => new sfWidgetFormInput(),
      'ca_evento'    => new sfWidgetFormInput(),
      'ca_ipaddress' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_id'        => new sfValidatorPropelChoice(array('model' => 'TrackingUserLog', 'column' => 'ca_id', 'required' => false)),
      'ca_email'     => new sfValidatorPropelChoice(array('model' => 'TrackingUser', 'column' => 'ca_email', 'required' => false)),
      'ca_fchevento' => new sfValidatorDateTime(array('required' => false)),
      'ca_url'       => new sfValidatorString(array('required' => false)),
      'ca_evento'    => new sfValidatorString(array('required' => false)),
      'ca_ipaddress' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tracking_user_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TrackingUserLog';
  }


}

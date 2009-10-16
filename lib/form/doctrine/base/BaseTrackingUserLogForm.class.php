<?php

/**
 * TrackingUserLog form base class.
 *
 * @package    form
 * @subpackage tracking_user_log
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTrackingUserLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_id'        => new sfWidgetFormInputHidden(),
      'ca_email'     => new sfWidgetFormDoctrineSelect(array('model' => 'TrackingUser', 'add_empty' => true)),
      'ca_fchevento' => new sfWidgetFormDateTime(),
      'ca_url'       => new sfWidgetFormInput(),
      'ca_evento'    => new sfWidgetFormInput(),
      'ca_ipaddress' => new sfWidgetFormInput(),
      'ca_useragent' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_id'        => new sfValidatorDoctrineChoice(array('model' => 'TrackingUserLog', 'column' => 'ca_id', 'required' => false)),
      'ca_email'     => new sfValidatorDoctrineChoice(array('model' => 'TrackingUser', 'required' => false)),
      'ca_fchevento' => new sfValidatorDateTime(array('required' => false)),
      'ca_url'       => new sfValidatorString(array('required' => false)),
      'ca_evento'    => new sfValidatorString(array('required' => false)),
      'ca_ipaddress' => new sfValidatorString(array('required' => false)),
      'ca_useragent' => new sfValidatorString(array('required' => false)),
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
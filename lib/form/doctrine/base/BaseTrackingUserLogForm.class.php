<?php

/**
 * TrackingUserLog form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseTrackingUserLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_id'        => new sfWidgetFormInputHidden(),
      'ca_email'     => new sfWidgetFormDoctrineChoice(array('model' => 'TrackingUser', 'add_empty' => true)),
      'ca_fchevento' => new sfWidgetFormDateTime(),
      'ca_url'       => new sfWidgetFormTextarea(),
      'ca_evento'    => new sfWidgetFormTextarea(),
      'ca_ipaddress' => new sfWidgetFormTextarea(),
      'ca_useragent' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_id', 'required' => false)),
      'ca_email'     => new sfValidatorDoctrineChoice(array('model' => 'TrackingUser', 'required' => false)),
      'ca_fchevento' => new sfValidatorDateTime(array('required' => false)),
      'ca_url'       => new sfValidatorString(array('required' => false)),
      'ca_evento'    => new sfValidatorString(array('required' => false)),
      'ca_ipaddress' => new sfValidatorString(array('required' => false)),
      'ca_useragent' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tracking_user_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TrackingUserLog';
  }

}

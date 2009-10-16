<?php

/**
 * TrackingUser form base class.
 *
 * @package    form
 * @subpackage tracking_user
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTrackingUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_email'           => new sfWidgetFormInputHidden(),
      'ca_blocked'         => new sfWidgetFormInputCheckbox(),
      'ca_activation_code' => new sfWidgetFormInput(),
      'ca_passwd'          => new sfWidgetFormInput(),
      'ca_password_expiry' => new sfWidgetFormDate(),
      'ca_activated'       => new sfWidgetFormInputCheckbox(),
      'ca_idcontacto'      => new sfWidgetFormDoctrineSelect(array('model' => 'Contacto', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'ca_email'           => new sfValidatorDoctrineChoice(array('model' => 'TrackingUser', 'column' => 'ca_email', 'required' => false)),
      'ca_blocked'         => new sfValidatorBoolean(array('required' => false)),
      'ca_activation_code' => new sfValidatorString(array('required' => false)),
      'ca_passwd'          => new sfValidatorString(array('required' => false)),
      'ca_password_expiry' => new sfValidatorDate(array('required' => false)),
      'ca_activated'       => new sfValidatorBoolean(array('required' => false)),
      'ca_idcontacto'      => new sfValidatorDoctrineChoice(array('model' => 'Contacto', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tracking_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TrackingUser';
  }

}
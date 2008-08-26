<?php

/**
 * TrackingUser form base class.
 *
 * @package    form
 * @subpackage tracking_user
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseTrackingUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_id'              => new sfWidgetFormInputHidden(),
      'ca_email'           => new sfWidgetFormInput(),
      'ca_blocked'         => new sfWidgetFormInputCheckbox(),
      'ca_activation_code' => new sfWidgetFormInput(),
      'ca_passwd'          => new sfWidgetFormInput(),
      'ca_password_expiry' => new sfWidgetFormDate(),
      'ca_activated'       => new sfWidgetFormInputCheckbox(),
      'ca_idcontacto'      => new sfWidgetFormPropelSelect(array('model' => 'Contacto', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'ca_id'              => new sfValidatorPropelChoice(array('model' => 'TrackingUser', 'column' => 'ca_id', 'required' => false)),
      'ca_email'           => new sfValidatorString(array('required' => false)),
      'ca_blocked'         => new sfValidatorBoolean(array('required' => false)),
      'ca_activation_code' => new sfValidatorString(array('required' => false)),
      'ca_passwd'          => new sfValidatorString(array('required' => false)),
      'ca_password_expiry' => new sfValidatorDate(array('required' => false)),
      'ca_activated'       => new sfValidatorBoolean(array('required' => false)),
      'ca_idcontacto'      => new sfValidatorPropelChoice(array('model' => 'Contacto', 'column' => 'ca_idcontacto', 'required' => false)),
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

<?php

/**
 * TrackingUser form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseTrackingUserForm extends BaseFormPropel
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
      'ca_idcontacto'      => new sfWidgetFormPropelChoice(array('model' => 'Contacto', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'ca_email'           => new sfValidatorPropelChoice(array('model' => 'TrackingUser', 'column' => 'ca_email', 'required' => false)),
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

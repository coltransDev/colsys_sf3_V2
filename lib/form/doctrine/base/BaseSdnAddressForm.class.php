<?php

/**
 * SdnAddress form base class.
 *
 * @method SdnAddress getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseSdnAddressForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_uid'         => new sfWidgetFormInputHidden(),
      'ca_uid_address' => new sfWidgetFormInputHidden(),
      'ca_address1'    => new sfWidgetFormTextarea(),
      'ca_address2'    => new sfWidgetFormTextarea(),
      'ca_address3'    => new sfWidgetFormTextarea(),
      'ca_city'        => new sfWidgetFormTextarea(),
      'ca_state'       => new sfWidgetFormTextarea(),
      'ca_postal'      => new sfWidgetFormTextarea(),
      'ca_country'     => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_uid'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_uid', 'required' => false)),
      'ca_uid_address' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_uid_address', 'required' => false)),
      'ca_address1'    => new sfValidatorString(array('required' => false)),
      'ca_address2'    => new sfValidatorString(array('required' => false)),
      'ca_address3'    => new sfValidatorString(array('required' => false)),
      'ca_city'        => new sfValidatorString(array('required' => false)),
      'ca_state'       => new sfValidatorString(array('required' => false)),
      'ca_postal'      => new sfValidatorString(array('required' => false)),
      'ca_country'     => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sdn_address[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SdnAddress';
  }

}

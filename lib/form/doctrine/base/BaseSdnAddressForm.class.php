<?php

/**
 * SdnAddress form base class.
 *
 * @package    form
 * @subpackage sdn_address
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseSdnAddressForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_uid'         => new sfWidgetFormInputHidden(),
      'ca_uid_address' => new sfWidgetFormInputHidden(),
      'ca_address1'    => new sfWidgetFormInput(),
      'ca_address2'    => new sfWidgetFormInput(),
      'ca_address3'    => new sfWidgetFormInput(),
      'ca_city'        => new sfWidgetFormInput(),
      'ca_state'       => new sfWidgetFormInput(),
      'ca_postal'      => new sfWidgetFormInput(),
      'ca_country'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_uid'         => new sfValidatorDoctrineChoice(array('model' => 'SdnAddress', 'column' => 'ca_uid', 'required' => false)),
      'ca_uid_address' => new sfValidatorDoctrineChoice(array('model' => 'SdnAddress', 'column' => 'ca_uid_address', 'required' => false)),
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

    parent::setup();
  }

  public function getModelName()
  {
    return 'SdnAddress';
  }

}
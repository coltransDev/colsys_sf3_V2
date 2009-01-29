<?php

/**
 * SdnAddress form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseSdnAddressForm extends BaseFormPropel
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
      'ca_uid'         => new sfValidatorPropelChoice(array('model' => 'Sdn', 'column' => 'ca_uid', 'required' => false)),
      'ca_uid_address' => new sfValidatorPropelChoice(array('model' => 'SdnAddress', 'column' => 'ca_uid_address', 'required' => false)),
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

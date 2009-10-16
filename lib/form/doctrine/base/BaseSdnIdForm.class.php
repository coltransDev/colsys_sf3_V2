<?php

/**
 * SdnId form base class.
 *
 * @package    form
 * @subpackage sdn_id
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseSdnIdForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_uid'            => new sfWidgetFormInputHidden(),
      'ca_uid_id'         => new sfWidgetFormInputHidden(),
      'ca_idType'         => new sfWidgetFormInput(),
      'ca_idNumber'       => new sfWidgetFormInput(),
      'ca_idCountry'      => new sfWidgetFormInput(),
      'ca_issueDate'      => new sfWidgetFormInput(),
      'ca_expirationDate' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_uid'            => new sfValidatorDoctrineChoice(array('model' => 'SdnId', 'column' => 'ca_uid', 'required' => false)),
      'ca_uid_id'         => new sfValidatorDoctrineChoice(array('model' => 'SdnId', 'column' => 'ca_uid_id', 'required' => false)),
      'ca_idType'         => new sfValidatorString(array('required' => false)),
      'ca_idNumber'       => new sfValidatorString(array('required' => false)),
      'ca_idCountry'      => new sfValidatorString(array('required' => false)),
      'ca_issueDate'      => new sfValidatorString(array('required' => false)),
      'ca_expirationDate' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sdn_id[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SdnId';
  }

}
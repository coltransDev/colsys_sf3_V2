<?php

/**
 * SdnId form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseSdnIdForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_uid'            => new sfWidgetFormInputHidden(),
      'ca_uid_id'         => new sfWidgetFormInputHidden(),
      'ca_idType'         => new sfWidgetFormTextarea(),
      'ca_idNumber'       => new sfWidgetFormTextarea(),
      'ca_idCountry'      => new sfWidgetFormTextarea(),
      'ca_issueDate'      => new sfWidgetFormTextarea(),
      'ca_expirationDate' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_uid'            => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_uid', 'required' => false)),
      'ca_uid_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_uid_id', 'required' => false)),
      'ca_idType'         => new sfValidatorString(array('required' => false)),
      'ca_idNumber'       => new sfValidatorString(array('required' => false)),
      'ca_idCountry'      => new sfValidatorString(array('required' => false)),
      'ca_issueDate'      => new sfValidatorString(array('required' => false)),
      'ca_expirationDate' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sdn_id[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SdnId';
  }

}

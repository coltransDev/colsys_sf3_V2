<?php

/**
 * SdnId form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseSdnIdForm extends BaseFormPropel
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
      'ca_uid'            => new sfValidatorPropelChoice(array('model' => 'Sdn', 'column' => 'ca_uid', 'required' => false)),
      'ca_uid_id'         => new sfValidatorPropelChoice(array('model' => 'SdnId', 'column' => 'ca_uid_id', 'required' => false)),
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

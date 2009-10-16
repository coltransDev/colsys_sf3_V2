<?php

/**
 * SdnAka form base class.
 *
 * @package    form
 * @subpackage sdn_aka
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseSdnAkaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_uid'       => new sfWidgetFormInputHidden(),
      'ca_uid_aka'   => new sfWidgetFormInputHidden(),
      'ca_type'      => new sfWidgetFormInput(),
      'ca_category'  => new sfWidgetFormInput(),
      'ca_firstName' => new sfWidgetFormInput(),
      'ca_lastName'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_uid'       => new sfValidatorDoctrineChoice(array('model' => 'SdnAka', 'column' => 'ca_uid', 'required' => false)),
      'ca_uid_aka'   => new sfValidatorDoctrineChoice(array('model' => 'SdnAka', 'column' => 'ca_uid_aka', 'required' => false)),
      'ca_type'      => new sfValidatorString(array('required' => false)),
      'ca_category'  => new sfValidatorString(array('required' => false)),
      'ca_firstName' => new sfValidatorString(array('required' => false)),
      'ca_lastName'  => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sdn_aka[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SdnAka';
  }

}
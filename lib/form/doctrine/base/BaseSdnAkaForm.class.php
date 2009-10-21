<?php

/**
 * SdnAka form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseSdnAkaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_uid'       => new sfWidgetFormInputHidden(),
      'ca_uid_aka'   => new sfWidgetFormInputHidden(),
      'ca_type'      => new sfWidgetFormTextarea(),
      'ca_category'  => new sfWidgetFormTextarea(),
      'ca_firstName' => new sfWidgetFormTextarea(),
      'ca_lastName'  => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_uid'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_uid', 'required' => false)),
      'ca_uid_aka'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_uid_aka', 'required' => false)),
      'ca_type'      => new sfValidatorString(array('required' => false)),
      'ca_category'  => new sfValidatorString(array('required' => false)),
      'ca_firstName' => new sfValidatorString(array('required' => false)),
      'ca_lastName'  => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sdn_aka[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SdnAka';
  }

}

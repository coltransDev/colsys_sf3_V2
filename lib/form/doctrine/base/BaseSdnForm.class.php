<?php

/**
 * Sdn form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseSdnForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_uid'       => new sfWidgetFormInputHidden(),
      'ca_firstName' => new sfWidgetFormTextarea(),
      'ca_lastName'  => new sfWidgetFormTextarea(),
      'ca_title'     => new sfWidgetFormTextarea(),
      'ca_sdnType'   => new sfWidgetFormTextarea(),
      'ca_remarks'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_uid'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_uid', 'required' => false)),
      'ca_firstName' => new sfValidatorString(array('required' => false)),
      'ca_lastName'  => new sfValidatorString(array('required' => false)),
      'ca_title'     => new sfValidatorString(array('required' => false)),
      'ca_sdnType'   => new sfValidatorString(array('required' => false)),
      'ca_remarks'   => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sdn[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sdn';
  }

}

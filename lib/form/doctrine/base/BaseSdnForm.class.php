<?php

/**
 * Sdn form base class.
 *
 * @package    form
 * @subpackage sdn
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseSdnForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_uid'       => new sfWidgetFormInputHidden(),
      'ca_firstName' => new sfWidgetFormInput(),
      'ca_lastName'  => new sfWidgetFormInput(),
      'ca_title'     => new sfWidgetFormInput(),
      'ca_sdnType'   => new sfWidgetFormInput(),
      'ca_remarks'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_uid'       => new sfValidatorDoctrineChoice(array('model' => 'Sdn', 'column' => 'ca_uid', 'required' => false)),
      'ca_firstName' => new sfValidatorString(array('required' => false)),
      'ca_lastName'  => new sfValidatorString(array('required' => false)),
      'ca_title'     => new sfValidatorString(array('required' => false)),
      'ca_sdnType'   => new sfValidatorString(array('required' => false)),
      'ca_remarks'   => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sdn[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sdn';
  }

}
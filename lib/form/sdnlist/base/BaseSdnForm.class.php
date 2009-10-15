<?php

/**
 * Sdn form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseSdnForm extends BaseFormPropel
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
      'ca_uid'       => new sfValidatorPropelChoice(array('model' => 'Sdn', 'column' => 'ca_uid', 'required' => false)),
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

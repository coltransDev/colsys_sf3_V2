<?php

/**
 * SdnAka form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseSdnAkaForm extends BaseFormPropel
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
      'ca_uid'       => new sfValidatorPropelChoice(array('model' => 'Sdn', 'column' => 'ca_uid', 'required' => false)),
      'ca_uid_aka'   => new sfValidatorPropelChoice(array('model' => 'SdnAka', 'column' => 'ca_uid_aka', 'required' => false)),
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

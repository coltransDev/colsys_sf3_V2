<?php

/**
 * Sdn form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseSdnForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_uid'       => new sfWidgetFormInputHidden(),
      'ca_firstname' => new sfWidgetFormInput(),
      'ca_lastname'  => new sfWidgetFormInput(),
      'ca_title'     => new sfWidgetFormInput(),
      'ca_sdntype'   => new sfWidgetFormInput(),
      'ca_remarks'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_uid'       => new sfValidatorPropelChoice(array('model' => 'Sdn', 'column' => 'ca_uid', 'required' => false)),
      'ca_firstname' => new sfValidatorString(array('required' => false)),
      'ca_lastname'  => new sfValidatorString(array('required' => false)),
      'ca_title'     => new sfValidatorString(array('required' => false)),
      'ca_sdntype'   => new sfValidatorString(array('required' => false)),
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

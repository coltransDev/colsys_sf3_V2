<?php

/**
 * HdeskResponse form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseHdeskResponseForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idresponse'         => new sfWidgetFormInputHidden(),
      'ca_idticket'           => new sfWidgetFormPropelChoice(array('model' => 'HdeskTicket', 'add_empty' => false)),
      'ca_responsetoresponse' => new sfWidgetFormInput(),
      'ca_login'              => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
      'ca_createdat'          => new sfWidgetFormDateTime(),
      'ca_text'               => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idresponse'         => new sfValidatorPropelChoice(array('model' => 'HdeskResponse', 'column' => 'ca_idresponse', 'required' => false)),
      'ca_idticket'           => new sfValidatorPropelChoice(array('model' => 'HdeskTicket', 'column' => 'ca_idticket')),
      'ca_responsetoresponse' => new sfValidatorInteger(),
      'ca_login'              => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'ca_login')),
      'ca_createdat'          => new sfValidatorDateTime(),
      'ca_text'               => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hdesk_response[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'HdeskResponse';
  }


}

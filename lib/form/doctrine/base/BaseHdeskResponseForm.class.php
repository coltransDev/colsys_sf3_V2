<?php

/**
 * HdeskResponse form base class.
 *
 * @package    form
 * @subpackage hdesk_response
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseHdeskResponseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idresponse' => new sfWidgetFormInputHidden(),
      'ca_idticket'   => new sfWidgetFormDoctrineSelect(array('model' => 'HdeskTicket', 'add_empty' => true)),
      'ca_login'      => new sfWidgetFormDoctrineSelect(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_createdat'  => new sfWidgetFormDateTime(),
      'ca_text'       => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idresponse' => new sfValidatorDoctrineChoice(array('model' => 'HdeskResponse', 'column' => 'ca_idresponse', 'required' => false)),
      'ca_idticket'   => new sfValidatorDoctrineChoice(array('model' => 'HdeskTicket', 'required' => false)),
      'ca_login'      => new sfValidatorDoctrineChoice(array('model' => 'Usuario', 'required' => false)),
      'ca_createdat'  => new sfValidatorDateTime(array('required' => false)),
      'ca_text'       => new sfValidatorString(array('required' => false)),
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
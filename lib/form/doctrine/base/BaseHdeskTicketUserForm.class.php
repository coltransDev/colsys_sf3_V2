<?php

/**
 * HdeskTicketUser form base class.
 *
 * @package    form
 * @subpackage hdesk_ticket_user
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseHdeskTicketUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idticket' => new sfWidgetFormInputHidden(),
      'ca_login'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_idticket' => new sfValidatorDoctrineChoice(array('model' => 'HdeskTicketUser', 'column' => 'ca_idticket', 'required' => false)),
      'ca_login'    => new sfValidatorDoctrineChoice(array('model' => 'HdeskTicketUser', 'column' => 'ca_login', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hdesk_ticket_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'HdeskTicketUser';
  }

}
<?php

/**
 * HdeskTicketUser form base class.
 *
 * @method HdeskTicketUser getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
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
      'ca_idticket' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idticket', 'required' => false)),
      'ca_login'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_login', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hdesk_ticket_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'HdeskTicketUser';
  }

}

<?php

/**
 * HdeskTicket form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseHdeskTicketForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idticket'      => new sfWidgetFormInputHidden(),
      'ca_idgroup'       => new sfWidgetFormPropelChoice(array('model' => 'HdeskGroup', 'add_empty' => false)),
      'ca_idproject'     => new sfWidgetFormPropelChoice(array('model' => 'HdeskProject', 'add_empty' => false)),
      'ca_login'         => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_title'         => new sfWidgetFormInput(),
      'ca_text'          => new sfWidgetFormInput(),
      'ca_priority'      => new sfWidgetFormInput(),
      'ca_opened'        => new sfWidgetFormDateTime(),
      'ca_type'          => new sfWidgetFormInput(),
      'ca_assignedto'    => new sfWidgetFormInput(),
      'ca_action'        => new sfWidgetFormInput(),
      'ca_idtarea'       => new sfWidgetFormPropelChoice(array('model' => 'NotTarea', 'add_empty' => true)),
      'ca_idseguimiento' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idticket'      => new sfValidatorPropelChoice(array('model' => 'HdeskTicket', 'column' => 'ca_idticket', 'required' => false)),
      'ca_idgroup'       => new sfValidatorPropelChoice(array('model' => 'HdeskGroup', 'column' => 'ca_idgroup')),
      'ca_idproject'     => new sfValidatorPropelChoice(array('model' => 'HdeskProject', 'column' => 'ca_idproject')),
      'ca_login'         => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'ca_login', 'required' => false)),
      'ca_title'         => new sfValidatorString(array('required' => false)),
      'ca_text'          => new sfValidatorString(array('required' => false)),
      'ca_priority'      => new sfValidatorString(array('required' => false)),
      'ca_opened'        => new sfValidatorDateTime(array('required' => false)),
      'ca_type'          => new sfValidatorString(array('required' => false)),
      'ca_assignedto'    => new sfValidatorString(array('required' => false)),
      'ca_action'        => new sfValidatorString(array('required' => false)),
      'ca_idtarea'       => new sfValidatorPropelChoice(array('model' => 'NotTarea', 'column' => 'ca_idtarea', 'required' => false)),
      'ca_idseguimiento' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hdesk_ticket[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'HdeskTicket';
  }


}

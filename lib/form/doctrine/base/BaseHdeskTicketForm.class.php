<?php

/**
 * HdeskTicket form base class.
 *
 * @method HdeskTicket getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseHdeskTicketForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idticket'       => new sfWidgetFormInputHidden(),
      'ca_idgroup'        => new sfWidgetFormDoctrineChoice(array('model' => 'HdeskGroup', 'add_empty' => true)),
      'ca_idproject'      => new sfWidgetFormDoctrineChoice(array('model' => 'HdeskProject', 'add_empty' => true)),
      'ca_login'          => new sfWidgetFormDoctrineChoice(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_title'          => new sfWidgetFormInputText(),
      'ca_text'           => new sfWidgetFormTextarea(),
      'ca_priority'       => new sfWidgetFormInputText(),
      'ca_opened'         => new sfWidgetFormDateTime(),
      'ca_type'           => new sfWidgetFormInputText(),
      'ca_assignedto'     => new sfWidgetFormInputText(),
      'ca_action'         => new sfWidgetFormInputText(),
      'ca_responsetime'   => new sfWidgetFormDateTime(),
      'ca_idtarea'        => new sfWidgetFormDoctrineChoice(array('model' => 'NotTarea', 'add_empty' => true)),
      'ca_idseguimiento'  => new sfWidgetFormInputText(),
      'ca_order'          => new sfWidgetFormInputText(),
      'ca_estimatedhours' => new sfWidgetFormInputText(),
      'ca_percentage'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_idticket'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idticket', 'required' => false)),
      'ca_idgroup'        => new sfValidatorDoctrineChoice(array('model' => 'HdeskGroup', 'required' => false)),
      'ca_idproject'      => new sfValidatorDoctrineChoice(array('model' => 'HdeskProject', 'required' => false)),
      'ca_login'          => new sfValidatorDoctrineChoice(array('model' => 'Usuario', 'required' => false)),
      'ca_title'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_text'           => new sfValidatorString(array('required' => false)),
      'ca_priority'       => new sfValidatorString(array('max_length' => 8, 'required' => false)),
      'ca_opened'         => new sfValidatorDateTime(array('required' => false)),
      'ca_type'           => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_assignedto'     => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'ca_action'         => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'ca_responsetime'   => new sfValidatorDateTime(array('required' => false)),
      'ca_idtarea'        => new sfValidatorDoctrineChoice(array('model' => 'NotTarea', 'required' => false)),
      'ca_idseguimiento'  => new sfValidatorInteger(array('required' => false)),
      'ca_order'          => new sfValidatorInteger(array('required' => false)),
      'ca_estimatedhours' => new sfValidatorInteger(array('required' => false)),
      'ca_percentage'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hdesk_ticket[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'HdeskTicket';
  }

}

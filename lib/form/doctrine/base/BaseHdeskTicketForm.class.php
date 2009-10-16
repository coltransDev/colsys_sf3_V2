<?php

/**
 * HdeskTicket form base class.
 *
 * @package    form
 * @subpackage hdesk_ticket
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseHdeskTicketForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idticket'       => new sfWidgetFormInputHidden(),
      'ca_idgroup'        => new sfWidgetFormDoctrineSelect(array('model' => 'HdeskGroup', 'add_empty' => true)),
      'ca_idproject'      => new sfWidgetFormDoctrineSelect(array('model' => 'HdeskProject', 'add_empty' => true)),
      'ca_login'          => new sfWidgetFormDoctrineSelect(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_title'          => new sfWidgetFormInput(),
      'ca_text'           => new sfWidgetFormInput(),
      'ca_priority'       => new sfWidgetFormInput(),
      'ca_opened'         => new sfWidgetFormDateTime(),
      'ca_type'           => new sfWidgetFormInput(),
      'ca_assignedto'     => new sfWidgetFormInput(),
      'ca_action'         => new sfWidgetFormInput(),
      'ca_responsetime'   => new sfWidgetFormDateTime(),
      'ca_idtarea'        => new sfWidgetFormDoctrineSelect(array('model' => 'NotTarea', 'add_empty' => true)),
      'ca_idseguimiento'  => new sfWidgetFormInput(),
      'ca_order'          => new sfWidgetFormInput(),
      'ca_estimatedhours' => new sfWidgetFormInput(),
      'ca_percentage'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idticket'       => new sfValidatorDoctrineChoice(array('model' => 'HdeskTicket', 'column' => 'ca_idticket', 'required' => false)),
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

    parent::setup();
  }

  public function getModelName()
  {
    return 'HdeskTicket';
  }

}
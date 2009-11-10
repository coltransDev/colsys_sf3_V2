<?php

/**
 * HdeskResponse form base class.
 *
 * @method HdeskResponse getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseHdeskResponseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idresponse' => new sfWidgetFormInputHidden(),
      'ca_idticket'   => new sfWidgetFormDoctrineChoice(array('model' => 'HdeskTicket', 'add_empty' => true)),
      'ca_login'      => new sfWidgetFormDoctrineChoice(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_createdat'  => new sfWidgetFormDateTime(),
      'ca_text'       => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idresponse' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idresponse', 'required' => false)),
      'ca_idticket'   => new sfValidatorDoctrineChoice(array('model' => 'HdeskTicket', 'required' => false)),
      'ca_login'      => new sfValidatorDoctrineChoice(array('model' => 'Usuario', 'required' => false)),
      'ca_createdat'  => new sfValidatorDateTime(array('required' => false)),
      'ca_text'       => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hdesk_response[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'HdeskResponse';
  }

}

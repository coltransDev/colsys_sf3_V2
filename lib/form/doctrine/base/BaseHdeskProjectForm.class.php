<?php

/**
 * HdeskProject form base class.
 *
 * @method HdeskProject getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseHdeskProjectForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idproject'   => new sfWidgetFormInputHidden(),
      'ca_idgroup'     => new sfWidgetFormDoctrineChoice(array('model' => 'HdeskGroup', 'add_empty' => true)),
      'ca_name'        => new sfWidgetFormTextarea(),
      'ca_description' => new sfWidgetFormTextarea(),
      'ca_active'      => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'ca_idproject'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idproject', 'required' => false)),
      'ca_idgroup'     => new sfValidatorDoctrineChoice(array('model' => 'HdeskGroup', 'required' => false)),
      'ca_name'        => new sfValidatorString(array('required' => false)),
      'ca_description' => new sfValidatorString(array('required' => false)),
      'ca_active'      => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hdesk_project[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'HdeskProject';
  }

}

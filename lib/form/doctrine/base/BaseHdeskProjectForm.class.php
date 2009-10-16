<?php

/**
 * HdeskProject form base class.
 *
 * @package    form
 * @subpackage hdesk_project
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseHdeskProjectForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idproject'   => new sfWidgetFormInputHidden(),
      'ca_idgroup'     => new sfWidgetFormDoctrineSelect(array('model' => 'HdeskGroup', 'add_empty' => true)),
      'ca_name'        => new sfWidgetFormInput(),
      'ca_description' => new sfWidgetFormInput(),
      'ca_active'      => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'ca_idproject'   => new sfValidatorDoctrineChoice(array('model' => 'HdeskProject', 'column' => 'ca_idproject', 'required' => false)),
      'ca_idgroup'     => new sfValidatorDoctrineChoice(array('model' => 'HdeskGroup', 'required' => false)),
      'ca_name'        => new sfValidatorString(array('required' => false)),
      'ca_description' => new sfValidatorString(array('required' => false)),
      'ca_active'      => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hdesk_project[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'HdeskProject';
  }

}
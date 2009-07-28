<?php

/**
 * HdeskProject form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseHdeskProjectForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idproject'   => new sfWidgetFormInputHidden(),
      'ca_idgroup'     => new sfWidgetFormPropelChoice(array('model' => 'HdeskGroup', 'add_empty' => false)),
      'ca_name'        => new sfWidgetFormInput(),
      'ca_description' => new sfWidgetFormInput(),
      'ca_active'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idproject'   => new sfValidatorPropelChoice(array('model' => 'HdeskProject', 'column' => 'ca_idproject', 'required' => false)),
      'ca_idgroup'     => new sfValidatorPropelChoice(array('model' => 'HdeskGroup', 'column' => 'ca_idgroup')),
      'ca_name'        => new sfValidatorString(),
      'ca_description' => new sfValidatorString(array('required' => false)),
      'ca_active'      => new sfValidatorString(array('required' => false)),
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

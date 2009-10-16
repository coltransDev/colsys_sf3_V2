<?php

/**
 * HdeskUserGroup form base class.
 *
 * @package    form
 * @subpackage hdesk_user_group
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseHdeskUserGroupForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idgroup' => new sfWidgetFormInputHidden(),
      'ca_login'   => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_idgroup' => new sfValidatorDoctrineChoice(array('model' => 'HdeskUserGroup', 'column' => 'ca_idgroup', 'required' => false)),
      'ca_login'   => new sfValidatorDoctrineChoice(array('model' => 'HdeskUserGroup', 'column' => 'ca_login', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hdesk_user_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'HdeskUserGroup';
  }

}
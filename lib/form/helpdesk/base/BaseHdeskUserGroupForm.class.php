<?php

/**
 * HdeskUserGroup form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseHdeskUserGroupForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idgroup' => new sfWidgetFormInputHidden(),
      'ca_login'   => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_idgroup' => new sfValidatorPropelChoice(array('model' => 'HdeskGroup', 'column' => 'ca_idgroup', 'required' => false)),
      'ca_login'   => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'ca_login', 'required' => false)),
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

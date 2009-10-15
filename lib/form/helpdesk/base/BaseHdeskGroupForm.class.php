<?php

/**
 * HdeskGroup form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseHdeskGroupForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idgroup'            => new sfWidgetFormInputHidden(),
      'ca_iddepartament'      => new sfWidgetFormPropelChoice(array('model' => 'Departamento', 'add_empty' => false)),
      'ca_name'               => new sfWidgetFormInput(),
      'ca_maxresponsetime'    => new sfWidgetFormInput(),
      'hdesk_user_group_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'Usuario')),
    ));

    $this->setValidators(array(
      'ca_idgroup'            => new sfValidatorPropelChoice(array('model' => 'HdeskGroup', 'column' => 'ca_idgroup', 'required' => false)),
      'ca_iddepartament'      => new sfValidatorPropelChoice(array('model' => 'Departamento', 'column' => 'ca_iddepartamento')),
      'ca_name'               => new sfValidatorString(array('required' => false)),
      'ca_maxresponsetime'    => new sfValidatorInteger(array('required' => false)),
      'hdesk_user_group_list' => new sfValidatorPropelChoiceMany(array('model' => 'Usuario', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hdesk_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'HdeskGroup';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['hdesk_user_group_list']))
    {
      $values = array();
      foreach ($this->object->getHdeskUserGroups() as $obj)
      {
        $values[] = $obj->getCaLogin();
      }

      $this->setDefault('hdesk_user_group_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveHdeskUserGroupList($con);
  }

  public function saveHdeskUserGroupList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['hdesk_user_group_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(HdeskUserGroupPeer::CA_IDGROUP, $this->object->getPrimaryKey());
    HdeskUserGroupPeer::doDelete($c, $con);

    $values = $this->getValue('hdesk_user_group_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new HdeskUserGroup();
        $obj->setCaIdgroup($this->object->getPrimaryKey());
        $obj->setCaLogin($value);
        $obj->save();
      }
    }
  }

}

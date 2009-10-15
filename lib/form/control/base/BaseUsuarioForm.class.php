<?php

/**
 * Usuario form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseUsuarioForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_login'                  => new sfWidgetFormInputHidden(),
      'ca_nombre'                 => new sfWidgetFormInput(),
      'ca_cargo'                  => new sfWidgetFormInput(),
      'ca_departamento'           => new sfWidgetFormInput(),
      'ca_idsucursal'             => new sfWidgetFormPropelChoice(array('model' => 'Sucursal', 'add_empty' => true)),
      'ca_email'                  => new sfWidgetFormInput(),
      'ca_rutinas'                => new sfWidgetFormInput(),
      'ca_extension'              => new sfWidgetFormInput(),
      'ca_authmethod'             => new sfWidgetFormInput(),
      'ca_passwd'                 => new sfWidgetFormInput(),
      'ca_salt'                   => new sfWidgetFormInput(),
      'ca_activo'                 => new sfWidgetFormInputCheckbox(),
      'ca_forcechange'            => new sfWidgetFormInputCheckbox(),
      'ca_sucursal'               => new sfWidgetFormInput(),
      'usuario_perfil_list'       => new sfWidgetFormPropelChoiceMany(array('model' => 'Perfil')),
      'not_tarea_asignacion_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'NotTarea')),
      'hdesk_user_group_list'     => new sfWidgetFormPropelChoiceMany(array('model' => 'HdeskGroup')),
    ));

    $this->setValidators(array(
      'ca_login'                  => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'ca_login', 'required' => false)),
      'ca_nombre'                 => new sfValidatorString(array('required' => false)),
      'ca_cargo'                  => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'ca_departamento'           => new sfValidatorString(array('required' => false)),
      'ca_idsucursal'             => new sfValidatorPropelChoice(array('model' => 'Sucursal', 'column' => 'ca_idsucursal', 'required' => false)),
      'ca_email'                  => new sfValidatorString(array('required' => false)),
      'ca_rutinas'                => new sfValidatorString(array('required' => false)),
      'ca_extension'              => new sfValidatorString(array('required' => false)),
      'ca_authmethod'             => new sfValidatorString(array('required' => false)),
      'ca_passwd'                 => new sfValidatorString(array('required' => false)),
      'ca_salt'                   => new sfValidatorString(array('required' => false)),
      'ca_activo'                 => new sfValidatorBoolean(array('required' => false)),
      'ca_forcechange'            => new sfValidatorBoolean(array('required' => false)),
      'ca_sucursal'               => new sfValidatorString(array('required' => false)),
      'usuario_perfil_list'       => new sfValidatorPropelChoiceMany(array('model' => 'Perfil', 'required' => false)),
      'not_tarea_asignacion_list' => new sfValidatorPropelChoiceMany(array('model' => 'NotTarea', 'required' => false)),
      'hdesk_user_group_list'     => new sfValidatorPropelChoiceMany(array('model' => 'HdeskGroup', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usuario';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['usuario_perfil_list']))
    {
      $values = array();
      foreach ($this->object->getUsuarioPerfils() as $obj)
      {
        $values[] = $obj->getCaPerfil();
      }

      $this->setDefault('usuario_perfil_list', $values);
    }

    if (isset($this->widgetSchema['not_tarea_asignacion_list']))
    {
      $values = array();
      foreach ($this->object->getNotTareaAsignacions() as $obj)
      {
        $values[] = $obj->getCaIdtarea();
      }

      $this->setDefault('not_tarea_asignacion_list', $values);
    }

    if (isset($this->widgetSchema['hdesk_user_group_list']))
    {
      $values = array();
      foreach ($this->object->getHdeskUserGroups() as $obj)
      {
        $values[] = $obj->getCaIdgroup();
      }

      $this->setDefault('hdesk_user_group_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveUsuarioPerfilList($con);
    $this->saveNotTareaAsignacionList($con);
    $this->saveHdeskUserGroupList($con);
  }

  public function saveUsuarioPerfilList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['usuario_perfil_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(UsuarioPerfilPeer::CA_LOGIN, $this->object->getPrimaryKey());
    UsuarioPerfilPeer::doDelete($c, $con);

    $values = $this->getValue('usuario_perfil_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new UsuarioPerfil();
        $obj->setCaLogin($this->object->getPrimaryKey());
        $obj->setCaPerfil($value);
        $obj->save();
      }
    }
  }

  public function saveNotTareaAsignacionList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['not_tarea_asignacion_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(NotTareaAsignacionPeer::CA_LOGIN, $this->object->getPrimaryKey());
    NotTareaAsignacionPeer::doDelete($c, $con);

    $values = $this->getValue('not_tarea_asignacion_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new NotTareaAsignacion();
        $obj->setCaLogin($this->object->getPrimaryKey());
        $obj->setCaIdtarea($value);
        $obj->save();
      }
    }
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
    $c->add(HdeskUserGroupPeer::CA_LOGIN, $this->object->getPrimaryKey());
    HdeskUserGroupPeer::doDelete($c, $con);

    $values = $this->getValue('hdesk_user_group_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new HdeskUserGroup();
        $obj->setCaLogin($this->object->getPrimaryKey());
        $obj->setCaIdgroup($value);
        $obj->save();
      }
    }
  }

}

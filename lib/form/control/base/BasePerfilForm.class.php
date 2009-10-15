<?php

/**
 * Perfil form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePerfilForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_perfil'           => new sfWidgetFormInputHidden(),
      'ca_nombre'           => new sfWidgetFormInput(),
      'ca_descripcion'      => new sfWidgetFormInput(),
      'ca_departamento'     => new sfWidgetFormPropelChoice(array('model' => 'Departamento', 'add_empty' => true, 'key_method' => 'getCaNombre')),
      'usuario_perfil_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'Usuario')),
    ));

    $this->setValidators(array(
      'ca_perfil'           => new sfValidatorPropelChoice(array('model' => 'Perfil', 'column' => 'ca_perfil', 'required' => false)),
      'ca_nombre'           => new sfValidatorString(array('required' => false)),
      'ca_descripcion'      => new sfValidatorString(array('required' => false)),
      'ca_departamento'     => new sfValidatorPropelChoice(array('model' => 'Departamento', 'column' => 'ca_nombre', 'required' => false)),
      'usuario_perfil_list' => new sfValidatorPropelChoiceMany(array('model' => 'Usuario', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('perfil[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Perfil';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['usuario_perfil_list']))
    {
      $values = array();
      foreach ($this->object->getUsuarioPerfils() as $obj)
      {
        $values[] = $obj->getCaLogin();
      }

      $this->setDefault('usuario_perfil_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveUsuarioPerfilList($con);
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
    $c->add(UsuarioPerfilPeer::CA_PERFIL, $this->object->getPrimaryKey());
    UsuarioPerfilPeer::doDelete($c, $con);

    $values = $this->getValue('usuario_perfil_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new UsuarioPerfil();
        $obj->setCaPerfil($this->object->getPrimaryKey());
        $obj->setCaLogin($value);
        $obj->save();
      }
    }
  }

}

<?php

/**
 * NotTarea form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseNotTareaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtarea'                => new sfWidgetFormInputHidden(),
      'ca_idlistatarea'           => new sfWidgetFormPropelChoice(array('model' => 'NotListaTareas', 'add_empty' => true)),
      'ca_url'                    => new sfWidgetFormInput(),
      'ca_titulo'                 => new sfWidgetFormInput(),
      'ca_texto'                  => new sfWidgetFormInput(),
      'ca_fchvisible'             => new sfWidgetFormDateTime(),
      'ca_fchvencimiento'         => new sfWidgetFormDateTime(),
      'ca_fchterminada'           => new sfWidgetFormDateTime(),
      'ca_usuterminada'           => new sfWidgetFormInput(),
      'ca_prioridad'              => new sfWidgetFormInput(),
      'ca_fchcreado'              => new sfWidgetFormDateTime(),
      'ca_usucreado'              => new sfWidgetFormInput(),
      'ca_observaciones'          => new sfWidgetFormInput(),
      'notificacion_list'         => new sfWidgetFormPropelChoiceMany(array('model' => 'Email')),
      'rep_asignacion_list'       => new sfWidgetFormPropelChoiceMany(array('model' => 'Reporte')),
      'not_tarea_asignacion_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'Usuario')),
    ));

    $this->setValidators(array(
      'ca_idtarea'                => new sfValidatorPropelChoice(array('model' => 'NotTarea', 'column' => 'ca_idtarea', 'required' => false)),
      'ca_idlistatarea'           => new sfValidatorPropelChoice(array('model' => 'NotListaTareas', 'column' => 'ca_idlistatarea', 'required' => false)),
      'ca_url'                    => new sfValidatorString(array('required' => false)),
      'ca_titulo'                 => new sfValidatorString(array('required' => false)),
      'ca_texto'                  => new sfValidatorString(array('required' => false)),
      'ca_fchvisible'             => new sfValidatorDateTime(array('required' => false)),
      'ca_fchvencimiento'         => new sfValidatorDateTime(array('required' => false)),
      'ca_fchterminada'           => new sfValidatorDateTime(array('required' => false)),
      'ca_usuterminada'           => new sfValidatorString(array('required' => false)),
      'ca_prioridad'              => new sfValidatorInteger(array('required' => false)),
      'ca_fchcreado'              => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'              => new sfValidatorString(array('required' => false)),
      'ca_observaciones'          => new sfValidatorString(array('required' => false)),
      'notificacion_list'         => new sfValidatorPropelChoiceMany(array('model' => 'Email', 'required' => false)),
      'rep_asignacion_list'       => new sfValidatorPropelChoiceMany(array('model' => 'Reporte', 'required' => false)),
      'not_tarea_asignacion_list' => new sfValidatorPropelChoiceMany(array('model' => 'Usuario', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('not_tarea[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'NotTarea';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['notificacion_list']))
    {
      $values = array();
      foreach ($this->object->getNotificacions() as $obj)
      {
        $values[] = $obj->getCaIdemail();
      }

      $this->setDefault('notificacion_list', $values);
    }

    if (isset($this->widgetSchema['rep_asignacion_list']))
    {
      $values = array();
      foreach ($this->object->getRepAsignacions() as $obj)
      {
        $values[] = $obj->getCaIdreporte();
      }

      $this->setDefault('rep_asignacion_list', $values);
    }

    if (isset($this->widgetSchema['not_tarea_asignacion_list']))
    {
      $values = array();
      foreach ($this->object->getNotTareaAsignacions() as $obj)
      {
        $values[] = $obj->getCaLogin();
      }

      $this->setDefault('not_tarea_asignacion_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveNotificacionList($con);
    $this->saveRepAsignacionList($con);
    $this->saveNotTareaAsignacionList($con);
  }

  public function saveNotificacionList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['notificacion_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(NotificacionPeer::CA_IDTAREA, $this->object->getPrimaryKey());
    NotificacionPeer::doDelete($c, $con);

    $values = $this->getValue('notificacion_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Notificacion();
        $obj->setCaIdtarea($this->object->getPrimaryKey());
        $obj->setCaIdemail($value);
        $obj->save();
      }
    }
  }

  public function saveRepAsignacionList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['rep_asignacion_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(RepAsignacionPeer::CA_IDTAREA, $this->object->getPrimaryKey());
    RepAsignacionPeer::doDelete($c, $con);

    $values = $this->getValue('rep_asignacion_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RepAsignacion();
        $obj->setCaIdtarea($this->object->getPrimaryKey());
        $obj->setCaIdreporte($value);
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
    $c->add(NotTareaAsignacionPeer::CA_IDTAREA, $this->object->getPrimaryKey());
    NotTareaAsignacionPeer::doDelete($c, $con);

    $values = $this->getValue('not_tarea_asignacion_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new NotTareaAsignacion();
        $obj->setCaIdtarea($this->object->getPrimaryKey());
        $obj->setCaLogin($value);
        $obj->save();
      }
    }
  }

}

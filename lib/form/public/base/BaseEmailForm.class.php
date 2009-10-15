<?php

/**
 * Email form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseEmailForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idemail'          => new sfWidgetFormInputHidden(),
      'ca_fchenvio'         => new sfWidgetFormDateTime(),
      'ca_usuenvio'         => new sfWidgetFormInput(),
      'ca_tipo'             => new sfWidgetFormInput(),
      'ca_idcaso'           => new sfWidgetFormInput(),
      'ca_from'             => new sfWidgetFormInput(),
      'ca_fromname'         => new sfWidgetFormInput(),
      'ca_cc'               => new sfWidgetFormInput(),
      'ca_replyto'          => new sfWidgetFormInput(),
      'ca_address'          => new sfWidgetFormInput(),
      'ca_attachment'       => new sfWidgetFormInput(),
      'ca_subject'          => new sfWidgetFormInput(),
      'ca_body'             => new sfWidgetFormInput(),
      'ca_bodyhtml'         => new sfWidgetFormInput(),
      'ca_readreceipt'      => new sfWidgetFormInputCheckbox(),
      'ino_avisos_sea_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'InoMaestraSea')),
      'notificacion_list'   => new sfWidgetFormPropelChoiceMany(array('model' => 'NotTarea')),
      'rep_aviso_list'      => new sfWidgetFormPropelChoiceMany(array('model' => 'Reporte')),
    ));

    $this->setValidators(array(
      'ca_idemail'          => new sfValidatorPropelChoice(array('model' => 'Email', 'column' => 'ca_idemail', 'required' => false)),
      'ca_fchenvio'         => new sfValidatorDateTime(),
      'ca_usuenvio'         => new sfValidatorString(),
      'ca_tipo'             => new sfValidatorString(array('required' => false)),
      'ca_idcaso'           => new sfValidatorString(array('required' => false)),
      'ca_from'             => new sfValidatorString(array('required' => false)),
      'ca_fromname'         => new sfValidatorString(array('required' => false)),
      'ca_cc'               => new sfValidatorString(array('required' => false)),
      'ca_replyto'          => new sfValidatorString(array('required' => false)),
      'ca_address'          => new sfValidatorString(array('required' => false)),
      'ca_attachment'       => new sfValidatorString(array('required' => false)),
      'ca_subject'          => new sfValidatorString(array('required' => false)),
      'ca_body'             => new sfValidatorString(array('required' => false)),
      'ca_bodyhtml'         => new sfValidatorString(array('required' => false)),
      'ca_readreceipt'      => new sfValidatorBoolean(array('required' => false)),
      'ino_avisos_sea_list' => new sfValidatorPropelChoiceMany(array('model' => 'InoMaestraSea', 'required' => false)),
      'notificacion_list'   => new sfValidatorPropelChoiceMany(array('model' => 'NotTarea', 'required' => false)),
      'rep_aviso_list'      => new sfValidatorPropelChoiceMany(array('model' => 'Reporte', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('email[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Email';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['ino_avisos_sea_list']))
    {
      $values = array();
      foreach ($this->object->getInoAvisosSeas() as $obj)
      {
        $values[] = $obj->getCaReferencia();
      }

      $this->setDefault('ino_avisos_sea_list', $values);
    }

    if (isset($this->widgetSchema['notificacion_list']))
    {
      $values = array();
      foreach ($this->object->getNotificacions() as $obj)
      {
        $values[] = $obj->getCaIdtarea();
      }

      $this->setDefault('notificacion_list', $values);
    }

    if (isset($this->widgetSchema['rep_aviso_list']))
    {
      $values = array();
      foreach ($this->object->getRepAvisos() as $obj)
      {
        $values[] = $obj->getCaIdreporte();
      }

      $this->setDefault('rep_aviso_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveInoAvisosSeaList($con);
    $this->saveNotificacionList($con);
    $this->saveRepAvisoList($con);
  }

  public function saveInoAvisosSeaList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['ino_avisos_sea_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(InoAvisosSeaPeer::CA_IDEMAIL, $this->object->getPrimaryKey());
    InoAvisosSeaPeer::doDelete($c, $con);

    $values = $this->getValue('ino_avisos_sea_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new InoAvisosSea();
        $obj->setCaIdemail($this->object->getPrimaryKey());
        $obj->setCaReferencia($value);
        $obj->save();
      }
    }
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
    $c->add(NotificacionPeer::CA_IDEMAIL, $this->object->getPrimaryKey());
    NotificacionPeer::doDelete($c, $con);

    $values = $this->getValue('notificacion_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Notificacion();
        $obj->setCaIdemail($this->object->getPrimaryKey());
        $obj->setCaIdtarea($value);
        $obj->save();
      }
    }
  }

  public function saveRepAvisoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['rep_aviso_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(RepAvisoPeer::CA_IDEMAIL, $this->object->getPrimaryKey());
    RepAvisoPeer::doDelete($c, $con);

    $values = $this->getValue('rep_aviso_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RepAviso();
        $obj->setCaIdemail($this->object->getPrimaryKey());
        $obj->setCaIdreporte($value);
        $obj->save();
      }
    }
  }

}

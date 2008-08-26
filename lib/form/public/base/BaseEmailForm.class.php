<?php

/**
 * Email form base class.
 *
 * @package    form
 * @subpackage email
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseEmailForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idemail'      => new sfWidgetFormInputHidden(),
      'ca_fchenvio'     => new sfWidgetFormDateTime(),
      'ca_usuenvio'     => new sfWidgetFormInput(),
      'ca_tipo'         => new sfWidgetFormInput(),
      'ca_idcaso'       => new sfWidgetFormInput(),
      'ca_from'         => new sfWidgetFormInput(),
      'ca_fromname'     => new sfWidgetFormInput(),
      'ca_cc'           => new sfWidgetFormInput(),
      'ca_replyto'      => new sfWidgetFormInput(),
      'ca_address'      => new sfWidgetFormInput(),
      'ca_attachment'   => new sfWidgetFormInput(),
      'ca_subject'      => new sfWidgetFormInput(),
      'ca_body'         => new sfWidgetFormInput(),
      'ca_readreceipt'  => new sfWidgetFormInputCheckbox(),
      'rep_aviso_list'  => new sfWidgetFormPropelSelectMany(array('model' => 'Reporte')),
      'rep_status_list' => new sfWidgetFormPropelSelectMany(array('model' => 'Reporte')),
    ));

    $this->setValidators(array(
      'ca_idemail'      => new sfValidatorPropelChoice(array('model' => 'Email', 'column' => 'ca_idemail', 'required' => false)),
      'ca_fchenvio'     => new sfValidatorDateTime(),
      'ca_usuenvio'     => new sfValidatorString(),
      'ca_tipo'         => new sfValidatorString(array('required' => false)),
      'ca_idcaso'       => new sfValidatorString(array('required' => false)),
      'ca_from'         => new sfValidatorString(array('required' => false)),
      'ca_fromname'     => new sfValidatorString(array('required' => false)),
      'ca_cc'           => new sfValidatorString(array('required' => false)),
      'ca_replyto'      => new sfValidatorString(array('required' => false)),
      'ca_address'      => new sfValidatorString(array('required' => false)),
      'ca_attachment'   => new sfValidatorString(array('required' => false)),
      'ca_subject'      => new sfValidatorString(array('required' => false)),
      'ca_body'         => new sfValidatorString(array('required' => false)),
      'ca_readreceipt'  => new sfValidatorBoolean(array('required' => false)),
      'rep_aviso_list'  => new sfValidatorPropelChoiceMany(array('model' => 'Reporte', 'required' => false)),
      'rep_status_list' => new sfValidatorPropelChoiceMany(array('model' => 'Reporte', 'required' => false)),
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

    if (isset($this->widgetSchema['rep_aviso_list']))
    {
      $values = array();
      foreach ($this->object->getRepAvisos() as $obj)
      {
        $values[] = $obj->getCaIdreporte();
      }

      $this->setDefault('rep_aviso_list', $values);
    }

    if (isset($this->widgetSchema['rep_status_list']))
    {
      $values = array();
      foreach ($this->object->getRepStatuss() as $obj)
      {
        $values[] = $obj->getCaIdreporte();
      }

      $this->setDefault('rep_status_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveRepAvisoList($con);
    $this->saveRepStatusList($con);
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

  public function saveRepStatusList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['rep_status_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(RepStatusPeer::CA_IDEMAIL, $this->object->getPrimaryKey());
    RepStatusPeer::doDelete($c, $con);

    $values = $this->getValue('rep_status_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RepStatus();
        $obj->setCaIdemail($this->object->getPrimaryKey());
        $obj->setCaIdreporte($value);
        $obj->save();
      }
    }
  }

}

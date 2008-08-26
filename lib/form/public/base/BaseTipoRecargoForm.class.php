<?php

/**
 * TipoRecargo form base class.
 *
 * @package    form
 * @subpackage tipo_recargo
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseTipoRecargoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idrecargo'       => new sfWidgetFormInputHidden(),
      'ca_recargo'         => new sfWidgetFormInput(),
      'ca_tipo'            => new sfWidgetFormInput(),
      'ca_transporte'      => new sfWidgetFormInput(),
      'ca_incoterms'       => new sfWidgetFormInput(),
      'ca_reporte'         => new sfWidgetFormInput(),
      'ca_impoexpo'        => new sfWidgetFormInput(),
      'ca_aplicacion'      => new sfWidgetFormInput(),
      'cot_recargo_list'   => new sfWidgetFormPropelSelectMany(array('model' => 'CotOpcion')),
      'recargo_flete_list' => new sfWidgetFormPropelSelectMany(array('model' => 'Flete')),
    ));

    $this->setValidators(array(
      'ca_idrecargo'       => new sfValidatorPropelChoice(array('model' => 'TipoRecargo', 'column' => 'ca_idrecargo', 'required' => false)),
      'ca_recargo'         => new sfValidatorString(),
      'ca_tipo'            => new sfValidatorString(),
      'ca_transporte'      => new sfValidatorString(),
      'ca_incoterms'       => new sfValidatorString(array('required' => false)),
      'ca_reporte'         => new sfValidatorString(array('required' => false)),
      'ca_impoexpo'        => new sfValidatorString(array('required' => false)),
      'ca_aplicacion'      => new sfValidatorString(array('required' => false)),
      'cot_recargo_list'   => new sfValidatorPropelChoiceMany(array('model' => 'CotOpcion', 'required' => false)),
      'recargo_flete_list' => new sfValidatorPropelChoiceMany(array('model' => 'Flete', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tipo_recargo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoRecargo';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['cot_recargo_list']))
    {
      $values = array();
      foreach ($this->object->getCotRecargos() as $obj)
      {
        $values[] = $obj->getCaIdopcion();
      }

      $this->setDefault('cot_recargo_list', $values);
    }

    if (isset($this->widgetSchema['recargo_flete_list']))
    {
      $values = array();
      foreach ($this->object->getRecargoFletes() as $obj)
      {
        $values[] = $obj->getCaIdtrayecto();
      }

      $this->setDefault('recargo_flete_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveCotRecargoList($con);
    $this->saveRecargoFleteList($con);
  }

  public function saveCotRecargoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['cot_recargo_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(CotRecargoPeer::CA_IDRECARGO, $this->object->getPrimaryKey());
    CotRecargoPeer::doDelete($c, $con);

    $values = $this->getValue('cot_recargo_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new CotRecargo();
        $obj->setCaIdrecargo($this->object->getPrimaryKey());
        $obj->setCaIdopcion($value);
        $obj->save();
      }
    }
  }

  public function saveRecargoFleteList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['recargo_flete_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(RecargoFletePeer::CA_IDRECARGO, $this->object->getPrimaryKey());
    RecargoFletePeer::doDelete($c, $con);

    $values = $this->getValue('recargo_flete_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RecargoFlete();
        $obj->setCaIdrecargo($this->object->getPrimaryKey());
        $obj->setCaIdtrayecto($value);
        $obj->save();
      }
    }
  }

}

<?php

/**
 * Concepto form base class.
 *
 * @package    form
 * @subpackage concepto
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseConceptoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idconcepto'               => new sfWidgetFormInputHidden(),
      'ca_concepto'                 => new sfWidgetFormInput(),
      'ca_unidad'                   => new sfWidgetFormInput(),
      'ca_transporte'               => new sfWidgetFormInput(),
      'ca_modalidad'                => new sfWidgetFormInput(),
      'ca_pregunta'                 => new sfWidgetFormInput(),
      'ca_liminferior'              => new sfWidgetFormInput(),
      'cot_continuacion_list'       => new sfWidgetFormPropelSelectMany(array('model' => 'Cotizacion')),
      'flete_list'                  => new sfWidgetFormPropelSelectMany(array('model' => 'Trayecto')),
      'pric_flete_list'             => new sfWidgetFormPropelSelectMany(array('model' => 'Trayecto')),
      'pric_recargox_concepto_list' => new sfWidgetFormPropelSelectMany(array('model' => 'Trayecto')),
      'rep_equipo_list'             => new sfWidgetFormPropelSelectMany(array('model' => 'Reporte')),
    ));

    $this->setValidators(array(
      'ca_idconcepto'               => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_concepto'                 => new sfValidatorString(),
      'ca_unidad'                   => new sfValidatorString(),
      'ca_transporte'               => new sfValidatorString(),
      'ca_modalidad'                => new sfValidatorString(),
      'ca_pregunta'                 => new sfValidatorString(),
      'ca_liminferior'              => new sfValidatorInteger(array('required' => false)),
      'cot_continuacion_list'       => new sfValidatorPropelChoiceMany(array('model' => 'Cotizacion', 'required' => false)),
      'flete_list'                  => new sfValidatorPropelChoiceMany(array('model' => 'Trayecto', 'required' => false)),
      'pric_flete_list'             => new sfValidatorPropelChoiceMany(array('model' => 'Trayecto', 'required' => false)),
      'pric_recargox_concepto_list' => new sfValidatorPropelChoiceMany(array('model' => 'Trayecto', 'required' => false)),
      'rep_equipo_list'             => new sfValidatorPropelChoiceMany(array('model' => 'Reporte', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('concepto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Concepto';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['cot_continuacion_list']))
    {
      $values = array();
      foreach ($this->object->getCotContinuacions() as $obj)
      {
        $values[] = $obj->getCaIdcotizacion();
      }

      $this->setDefault('cot_continuacion_list', $values);
    }

    if (isset($this->widgetSchema['flete_list']))
    {
      $values = array();
      foreach ($this->object->getFletes() as $obj)
      {
        $values[] = $obj->getCaIdtrayecto();
      }

      $this->setDefault('flete_list', $values);
    }

    if (isset($this->widgetSchema['pric_flete_list']))
    {
      $values = array();
      foreach ($this->object->getPricFletes() as $obj)
      {
        $values[] = $obj->getCaIdtrayecto();
      }

      $this->setDefault('pric_flete_list', $values);
    }

    if (isset($this->widgetSchema['pric_recargox_concepto_list']))
    {
      $values = array();
      foreach ($this->object->getPricRecargoxConceptos() as $obj)
      {
        $values[] = $obj->getCaIdtrayecto();
      }

      $this->setDefault('pric_recargox_concepto_list', $values);
    }

    if (isset($this->widgetSchema['rep_equipo_list']))
    {
      $values = array();
      foreach ($this->object->getRepEquipos() as $obj)
      {
        $values[] = $obj->getCaIdreporte();
      }

      $this->setDefault('rep_equipo_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveCotContinuacionList($con);
    $this->saveFleteList($con);
    $this->savePricFleteList($con);
    $this->savePricRecargoxConceptoList($con);
    $this->saveRepEquipoList($con);
  }

  public function saveCotContinuacionList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['cot_continuacion_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->object->getPrimaryKey());
    CotContinuacionPeer::doDelete($c, $con);

    $values = $this->getValue('cot_continuacion_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new CotContinuacion();
        $obj->setCaIdconcepto($this->object->getPrimaryKey());
        $obj->setCaIdcotizacion($value);
        $obj->save();
      }
    }
  }

  public function saveFleteList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['flete_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(FletePeer::CA_IDCONCEPTO, $this->object->getPrimaryKey());
    FletePeer::doDelete($c, $con);

    $values = $this->getValue('flete_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Flete();
        $obj->setCaIdconcepto($this->object->getPrimaryKey());
        $obj->setCaIdtrayecto($value);
        $obj->save();
      }
    }
  }

  public function savePricFleteList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['pric_flete_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(PricFletePeer::CA_IDCONCEPTO, $this->object->getPrimaryKey());
    PricFletePeer::doDelete($c, $con);

    $values = $this->getValue('pric_flete_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PricFlete();
        $obj->setCaIdconcepto($this->object->getPrimaryKey());
        $obj->setCaIdtrayecto($value);
        $obj->save();
      }
    }
  }

  public function savePricRecargoxConceptoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['pric_recargox_concepto_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->object->getPrimaryKey());
    PricRecargoxConceptoPeer::doDelete($c, $con);

    $values = $this->getValue('pric_recargox_concepto_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PricRecargoxConcepto();
        $obj->setCaIdconcepto($this->object->getPrimaryKey());
        $obj->setCaIdtrayecto($value);
        $obj->save();
      }
    }
  }

  public function saveRepEquipoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['rep_equipo_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(RepEquipoPeer::CA_IDCONCEPTO, $this->object->getPrimaryKey());
    RepEquipoPeer::doDelete($c, $con);

    $values = $this->getValue('rep_equipo_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RepEquipo();
        $obj->setCaIdconcepto($this->object->getPrimaryKey());
        $obj->setCaIdreporte($value);
        $obj->save();
      }
    }
  }

}
